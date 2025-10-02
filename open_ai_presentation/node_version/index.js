import OpenAI from "openai";
import 'dotenv/config';
import readline from 'readline';

const openai = new OpenAI();

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

async function askQuestion() {
    rl.question('Enter your message (or type "quit" to exit): ', async (message) => {
        if (message.toLowerCase() === 'quit') {
            console.log("Exiting...");
            rl.close();
            return;
        }

        const response = await openai.chat.completions.create({
            model: 'gpt-4',
            messages: [
                { role: 'system', content: 'You are a vampire.' },
                { role: 'user', content: message }
            ],
            stream: true,
        });

        for await (const part of response) {
            process.stdout.write(part.choices[0]?.delta?.content || '');
        }
        console.log("\n\n");

        // After processing the response, call askQuestion again to continue the loop
        askQuestion();
    });
}

askQuestion();  // Start the loop
