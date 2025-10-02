# Port Townsend Web Developers - Presentation Materials

This repository contains code examples, demos, and materials from my presentations to the Port Townsend Web Developers group.

## 📚 Presentations

### 1. Claude AI Presentation
**Topic:** Building with Claude AI
**Date:** October 2025

A comprehensive demonstration of using Claude AI to build a full-stack Laravel todo application.

#### What's Inside
- **[Todo Application](claude_ai_presentation/pt_app/)** - Complete Laravel 11.x web application featuring:
  - Full CRUD operations for todo management
  - Dark mode with system preference detection and manual toggle
  - Priority-based task organization (low/medium/high)
  - Responsive, dense UI built with Tailwind CSS
  - AJAX-powered interactions for smooth UX
  - SQLite database with 20 seeded sample todos
  - Form validation with error handling

- **[Programming Language Showcase](claude_ai_presentation/)** - Diverse language examples including:
  - Assembly (Motorola 6809)
  - Classic languages (COBOL, Fortran 90, C, C++)
  - Modern languages (Go, JavaScript/Node.js)
  - Matrix rain animations in multiple languages
  - [Session notes](claude_ai_presentation/session.md) documenting the development process

#### Running the Todo App
```bash
cd claude_ai_presentation/pt_app
composer install
npm install
php artisan migrate --seed
php artisan serve
```
Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

### 2. OpenAI API Presentation
**Topic:** Integrating OpenAI APIs
**Date:** 2024

Demonstrations of OpenAI API integration across multiple programming languages.

#### What's Inside
- **[PHP Version](open_ai_presentation/php_version/)** - PSR-4 compliant chatbot
  - Uses OpenAI PHP SDK
  - Requires Composer for dependency management
  - Environment-based API key configuration

- **[Node.js Version](open_ai_presentation/node_version/)** - Minimal chatbot implementation
  - Simple setup with npm
  - Environment variable configuration

- **[Go Version](open_ai_presentation/go_bot/)** - Interactive CLI chatbot
  - Stateful conversation management
  - System prompt customization (default: "You are a dinosaur")
  - Uses GPT-3.5-turbo model

- **[Presentation Slides](open_ai_presentation/OpenAI.pptx)** - PowerPoint deck from the talk

#### Running the Examples

**PHP:**
```bash
cd open_ai_presentation/php_version
composer install
cp .env.example .env
# Edit .env and add your OpenAI API key
php main.php
```

**Node.js:**
```bash
cd open_ai_presentation/node_version
npm install
cp .env.example .env
# Edit .env and add your OpenAI API key
node index.js
```

**Go:**
```bash
cd open_ai_presentation/go_bot
# Edit test.go and replace YOUR_OPENAI_API_KEY_HERE with your actual key
go mod download
go run test.go
```

---

### 3. Docker Presentation
**Topic:** Docker Fundamentals
**Date:** 2024

Introduction to containerization with Docker, featuring a practical PHP/Apache example.

#### What's Inside
- **[Dockerfile](docker_presentation/Dockerfile)** - Heavily commented Docker configuration
  - PHP 7.4 with Apache
  - Step-by-step explanations of each Docker command
  - Build and run instructions included

- **[Source Code](docker_presentation/src/)** - Sample PHP application

#### Running the Docker Demo
```bash
cd docker_presentation
docker build -t pt-php-app .
docker run -d -p 8080:80 pt-php-app
```
Visit [http://localhost:8080](http://localhost:8080)

---

## 🎯 About These Projects

These materials were created for the Port Townsend Web Developers meetup group. Each presentation focuses on practical, hands-on demonstrations that developers can run themselves and learn from.

### Key Features
- **Multi-language examples** - PHP, Node.js, Go, and more
- **Detailed documentation** - READMEs and session notes for context
- **Copy-paste ready** - All code should be functional and ready to run

---

## 🚀 Quick Start

1. Clone this repository:
```bash
git clone <repository-url>
cd port_townsend_web_developers
```

2. Choose a presentation folder and follow its README

3. Make sure you have the required dependencies installed:
   - **PHP projects:** PHP 7.4+, Composer
   - **Node.js projects:** Node.js, npm
   - **Go projects:** Go 1.16+
   - **Docker projects:** Docker Desktop

---

## 📝 Notes

- OpenAI API examples require an API key from [OpenAI Platform](https://platform.openai.com/docs/quickstart)
- Laravel todo app uses SQLite by default (no additional database setup required)

## 🔒 Security

**IMPORTANT:** This repository does not contain any API keys or credentials. You must provide your own:

- For OpenAI examples, copy `.env.example` to `.env` and add your API key
- Never commit `.env` files or hardcode API keys in source code
- The `.gitignore` file is configured to prevent accidental commits of sensitive data

---

## 🤝 Connect

Feel free to reach out if you have questions about any of these examples!

---

**Happy Coding!** 🎉
