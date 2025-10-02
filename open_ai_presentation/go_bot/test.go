package main

import (
    "context"
    "fmt"
    openai "github.com/sashabaranov/go-openai"
)

func main() {
    // TODO: Replace with your OpenAI API key or load from environment variable
    // apiKey := os.Getenv("OPENAI_API_KEY")
    client := openai.NewClient("YOUR_OPENAI_API_KEY_HERE")

    // Initialize the conversation with the system message
    messages := []openai.ChatCompletionMessage{
        {
            Role:    openai.ChatMessageRoleSystem,
            Content: "You are a dinosaur.",
        },
    }

	var user_input string
    for {
        fmt.Println()
        // read user input
        fmt.Print("Enter Message: ")
        fmt.Scanln(&user_input)

        // Add the user's message to the conversation
        messages = append(messages, openai.ChatCompletionMessage{
            Role:    openai.ChatMessageRoleUser,
            Content: user_input,
        })

        resp, err := client.CreateChatCompletion(
            context.Background(),
            openai.ChatCompletionRequest{
                Model:    openai.GPT3Dot5Turbo,
                Messages: messages,
            },
        )

        if err != nil {
            fmt.Printf("ChatCompletion error: %v\n", err)
            return
        } else {
            // Add the model's response to the conversation
            messages = append(messages, openai.ChatCompletionMessage{
                Role:    openai.ChatMessageRoleAssistant,
                Content: resp.Choices[0].Message.Content,
            })

            fmt.Println(resp.Choices[0].Message.Content)
        }
        //fmt.Println()
    }
}