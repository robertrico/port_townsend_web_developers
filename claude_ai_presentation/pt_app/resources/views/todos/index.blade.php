<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-4 max-w-5xl">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">My Todo List</h1>
            <button onclick="toggleDarkMode()" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                <svg class="w-5 h-5 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path class="dark:hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    <path class="hidden dark:block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-3 py-2 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-3 py-2 rounded mb-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add Todo Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-4">
            <h2 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Add New Todo</h2>
            <form action="{{ route('todos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium mb-1 text-sm">Title</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                        placeholder="Enter todo title">
                </div>
                <div class="mb-3">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium mb-1 text-sm">Description</label>
                    <textarea name="description" id="description" rows="2"
                        class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                        placeholder="Enter description (optional)"></textarea>
                </div>
                <div class="mb-3">
                    <label for="priority" class="block text-gray-700 dark:text-gray-300 font-medium mb-1 text-sm">Priority</label>
                    <select name="priority" id="priority" required
                        class="w-full px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white font-semibold px-4 py-1.5 rounded transition text-sm">
                    Add Todo
                </button>
            </form>
        </div>

        <!-- Todo List -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <h2 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-100">Todos ({{ $todos->count() }})</h2>

            @if($todos->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-center py-6 text-sm">No todos yet. Add one above!</p>
            @else
                <div class="space-y-1.5">
                    @foreach($todos as $todo)
                        <div class="flex items-center justify-between p-2.5 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-700 transition
                            {{ $todo->completed ? 'bg-gray-50 dark:bg-gray-700/50 opacity-60' : '' }}" id="todo-{{ $todo->id }}">
                            <div class="flex items-center space-x-3 flex-1">
                                <button onclick="toggleTodo({{ $todo->id }})" class="w-5 h-5 border-2 rounded flex-shrink-0
                                    {{ $todo->completed ? 'bg-green-500 border-green-500 dark:bg-green-600 dark:border-green-600' : 'border-gray-300 dark:border-gray-600' }}
                                    hover:border-green-500 dark:hover:border-green-600 transition flex items-center justify-center">
                                    @if($todo->completed)
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </button>

                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200 text-sm {{ $todo->completed ? 'line-through' : '' }} truncate">
                                        {{ $todo->title }}
                                    </h3>
                                    @if($todo->description)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5 truncate">{{ $todo->description }}</p>
                                    @endif
                                </div>

                                <span class="px-2 py-0.5 rounded-full text-xs font-medium flex-shrink-0
                                    @if($todo->priority === 'high') bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300
                                    @elseif($todo->priority === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300
                                    @else bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300
                                    @endif">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                            </div>

                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition"
                                    onclick="return confirm('Are you sure you want to delete this todo?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        // Dark mode toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }

        // Initialize dark mode from localStorage or system preference
        (function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true' || (darkMode === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();

        function toggleTodo(id) {
            fetch(`/todos/${id}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
