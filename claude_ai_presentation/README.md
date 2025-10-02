# Programming Language Showcase

**Written by Claude**

This collection contains various programming examples demonstrating the same concepts implemented across different languages, along with a Laravel web application.

## 📁 Files Included

### Assembly
- **6809.s** - Assembly code for the Motorola 6809 processor

### Classic Languages
- **hello.cbl** - Hello World program in COBOL (Common Business-Oriented Language)
- **hello.f90** - Hello World program in Fortran 90
- **test.c** - Example C program
- **test.cpp** - Example C++ program

### Modern Languages
- **matrix.go** - Matrix rain animation effect in Go
  - Features falling character streams with color gradients
  - Terminal-based animation with ANSI escape codes

- **matrix.js** - Matrix rain animation effect in JavaScript/Node.js
  - Port of the Go version
  - Same visual effect using Node.js terminal capabilities

### Web Application
- **pt_app/** - Laravel PHP web application
  - Full-stack framework setup
  - Dependencies cleaned (run `composer install` and `npm install` to restore)

### Documentation
- **session.md** - Development session notes

---

## 🚀 Try It Yourself!

Want to explore more programming languages? Here are some fun challenges:

### Challenge 1: Hello World Tour
Write "Hello, World!" in languages you've never tried before:
- **Rust** - Modern systems programming with memory safety
- **Haskell** - Pure functional programming language
- **Lua** - Lightweight scripting language
- **Elixir** - Functional, concurrent language for the Erlang VM
- **Zig** - Modern alternative to C
- **OCaml** - Functional programming with powerful type inference

### Challenge 2: Matrix Rain Variations
Recreate the Matrix rain animation in different languages:
- **Python** with `curses` library
- **Rust** with `crossterm` crate
- **C** with `ncurses` library
- **Ruby** with ANSI escape codes
- **Java** with terminal manipulation
- **Bash** script (yes, it's possible!)

### Challenge 3: Cross-Language Comparison
Pick a simple algorithm (sorting, fibonacci, etc.) and implement it in 5 different languages to compare:
- Syntax differences
- Performance characteristics
- Code readability
- Language paradigms (imperative vs functional)

---

## 💡 Getting Started

Each file can be compiled/run with its respective toolchain:

```bash
# C
gcc test.c -o test && ./test

# C++
g++ test.cpp -o test_cpp && ./test_cpp

# Go
go run matrix.go

# JavaScript/Node.js
node matrix.js

# Fortran
gfortran hello.f90 -o hello_f90 && ./hello_f90

# COBOL (requires GnuCOBOL)
cobc -x hello.cbl && ./hello

# Laravel (pt_app)
cd pt_app
composer install
npm install
php artisan serve
```

---

*Happy coding! Explore, experiment, and enjoy the journey through different programming paradigms.*
