package main

import (
	"fmt"
	"math/rand"
	"os"
	"os/exec"
	"time"
)

const (
	greenColor = "\033[32m"
	resetColor = "\033[0m"
	clearScreen = "\033[2J"
	hideCursor = "\033[?25l"
	showCursor = "\033[?25h"
)

type Drop struct {
	x      int
	y      int
	speed  int
	length int
	chars  []rune
}

func main() {
	// Get terminal size
	width, height := getTerminalSize()

	// Hide cursor and clear screen
	fmt.Print(hideCursor + clearScreen)
	defer fmt.Print(showCursor)

	// Seed random
	rand.Seed(time.Now().UnixNano())

	// Characters to use (Katakana, Latin, numbers)
	chars := []rune("ﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱﾎﾃﾏｹﾒｴｶｷﾑﾕﾗｾﾈｽﾀﾇﾍ01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ")

	// Create drops
	numDrops := width / 2
	drops := make([]*Drop, numDrops)
	for i := 0; i < numDrops; i++ {
		drops[i] = &Drop{
			x:      rand.Intn(width),
			y:      rand.Intn(height),
			speed:  rand.Intn(3) + 1,
			length: rand.Intn(15) + 5,
			chars:  make([]rune, 0),
		}
		// Initialize with random chars
		for j := 0; j < drops[i].length; j++ {
			drops[i].chars = append(drops[i].chars, chars[rand.Intn(len(chars))])
		}
	}

	// Animation loop
	ticker := time.NewTicker(50 * time.Millisecond)
	defer ticker.Stop()

	// Handle Ctrl+C gracefully
	go func() {
		c := make(chan os.Signal, 1)
		<-c
		fmt.Print(showCursor + clearScreen)
		os.Exit(0)
	}()

	for range ticker.C {
		// Clear screen
		fmt.Print(clearScreen)

		// Update and draw drops
		for _, drop := range drops {
			// Draw the drop
			for i := 0; i < drop.length; i++ {
				yPos := drop.y - i
				if yPos >= 0 && yPos < height && drop.x < width {
					// Move cursor to position
					fmt.Printf("\033[%d;%dH", yPos+1, drop.x+1)

					// Progressive fade from bright white to very dim green
					if i == 0 {
						fmt.Print("\033[1;37m") // Bright white (head)
					} else if i == 1 {
						fmt.Print("\033[1;32m") // Bright green
					} else if i == 2 {
						fmt.Print("\033[92m") // Light green
					} else if i < 5 {
						fmt.Print("\033[32m") // Normal green
					} else if i < 8 {
						fmt.Print("\033[2;32m") // Dim green
					} else {
						fmt.Print("\033[2;90m") // Very dim gray-green (tail)
					}

					fmt.Printf("%c", drop.chars[i%len(drop.chars)])
				}
			}

			// Update position
			drop.y += drop.speed

			// Reset if off screen
			if drop.y-drop.length > height {
				drop.y = 0
				drop.x = rand.Intn(width)
				drop.speed = rand.Intn(3) + 1
				drop.length = rand.Intn(15) + 5
				drop.chars = make([]rune, 0)
				for j := 0; j < drop.length; j++ {
					drop.chars = append(drop.chars, chars[rand.Intn(len(chars))])
				}
			}

			// Occasionally change a character
			if rand.Float32() < 0.1 {
				idx := rand.Intn(len(drop.chars))
				drop.chars[idx] = chars[rand.Intn(len(chars))]
			}
		}

		fmt.Print(resetColor)
	}
}

func getTerminalSize() (int, int) {
	cmd := exec.Command("stty", "size")
	cmd.Stdin = os.Stdin
	out, err := cmd.Output()
	if err != nil {
		return 80, 24 // Default fallback
	}

	var height, width int
	fmt.Sscanf(string(out), "%d %d", &height, &width)
	return width, height
}
