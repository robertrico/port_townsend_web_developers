const readline = require('readline');

const GREEN_COLOR = '\x1b[32m';
const RESET_COLOR = '\x1b[0m';
const CLEAR_SCREEN = '\x1b[2J';
const HIDE_CURSOR = '\x1b[?25l';
const SHOW_CURSOR = '\x1b[?25h';

class Drop {
    constructor(x, y, speed, length, chars) {
        this.x = x;
        this.y = y;
        this.speed = speed;
        this.length = length;
        this.chars = chars;
    }
}

function main() {
    // Get terminal size
    const { width, height } = getTerminalSize();

    // Hide cursor and clear screen
    process.stdout.write(HIDE_CURSOR + CLEAR_SCREEN);

    // Restore cursor on exit
    process.on('exit', () => {
        process.stdout.write(SHOW_CURSOR);
    });

    // Characters to use (Katakana, Latin, numbers)
    const chars = 'ﾊﾐﾋｰｳｼﾅﾓﾆｻﾜﾂｵﾘｱﾎﾃﾏｹﾒｴｶｷﾑﾕﾗｾﾈｽﾀﾇﾍ01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

    // Create drops
    const numDrops = Math.floor(width / 2);
    const drops = [];
    for (let i = 0; i < numDrops; i++) {
        const length = Math.floor(Math.random() * 15) + 5;
        const dropChars = [];
        for (let j = 0; j < length; j++) {
            dropChars.push(chars[Math.floor(Math.random() * chars.length)]);
        }
        drops.push(new Drop(
            Math.floor(Math.random() * width),
            Math.floor(Math.random() * height),
            Math.floor(Math.random() * 3) + 1,
            length,
            dropChars
        ));
    }

    // Handle Ctrl+C gracefully
    process.on('SIGINT', () => {
        process.stdout.write(SHOW_CURSOR + CLEAR_SCREEN);
        process.exit(0);
    });

    // Animation loop
    setInterval(() => {
        // Clear screen
        process.stdout.write(CLEAR_SCREEN);

        // Update and draw drops
        for (const drop of drops) {
            // Draw the drop
            for (let i = 0; i < drop.length; i++) {
                const yPos = drop.y - i;
                if (yPos >= 0 && yPos < height && drop.x < width) {
                    // Move cursor to position
                    process.stdout.write(`\x1b[${yPos + 1};${drop.x + 1}H`);

                    // Progressive fade from bright white to very dim green
                    if (i === 0) {
                        process.stdout.write('\x1b[1;37m'); // Bright white (head)
                    } else if (i === 1) {
                        process.stdout.write('\x1b[1;32m'); // Bright green
                    } else if (i === 2) {
                        process.stdout.write('\x1b[92m'); // Light green
                    } else if (i < 5) {
                        process.stdout.write('\x1b[32m'); // Normal green
                    } else if (i < 8) {
                        process.stdout.write('\x1b[2;32m'); // Dim green
                    } else {
                        process.stdout.write('\x1b[2;90m'); // Very dim gray-green (tail)
                    }

                    process.stdout.write(drop.chars[i % drop.chars.length]);
                }
            }

            // Update position
            drop.y += drop.speed;

            // Reset if off screen
            if (drop.y - drop.length > height) {
                drop.y = 0;
                drop.x = Math.floor(Math.random() * width);
                drop.speed = Math.floor(Math.random() * 3) + 1;
                drop.length = Math.floor(Math.random() * 15) + 5;
                drop.chars = [];
                for (let j = 0; j < drop.length; j++) {
                    drop.chars.push(chars[Math.floor(Math.random() * chars.length)]);
                }
            }

            // Occasionally change a character
            if (Math.random() < 0.1) {
                const idx = Math.floor(Math.random() * drop.chars.length);
                drop.chars[idx] = chars[Math.floor(Math.random() * chars.length)];
            }
        }

        process.stdout.write(RESET_COLOR);
    }, 50);
}

function getTerminalSize() {
    const width = process.stdout.columns || 80;
    const height = process.stdout.rows || 24;
    return { width, height };
}

main();
