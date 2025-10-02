<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
            ['title' => 'Complete project documentation', 'description' => 'Write comprehensive docs for the new feature', 'priority' => 'high', 'completed' => false],
            ['title' => 'Review pull requests', 'description' => 'Check and approve pending PRs', 'priority' => 'high', 'completed' => false],
            ['title' => 'Fix login bug', 'description' => 'Users reporting issues with login on mobile', 'priority' => 'high', 'completed' => true],
            ['title' => 'Update dependencies', 'description' => 'Upgrade Laravel and other packages', 'priority' => 'medium', 'completed' => false],
            ['title' => 'Write unit tests', 'description' => 'Add tests for new API endpoints', 'priority' => 'medium', 'completed' => false],
            ['title' => 'Database optimization', 'description' => 'Add indexes to improve query performance', 'priority' => 'medium', 'completed' => false],
            ['title' => 'Create API documentation', 'description' => 'Document all REST endpoints', 'priority' => 'medium', 'completed' => true],
            ['title' => 'Team meeting preparation', 'description' => 'Prepare slides for sprint review', 'priority' => 'medium', 'completed' => false],
            ['title' => 'Code review guidelines', 'description' => 'Update team code review standards', 'priority' => 'low', 'completed' => false],
            ['title' => 'Refactor helper functions', 'description' => 'Clean up utility functions', 'priority' => 'low', 'completed' => false],
            ['title' => 'Update README', 'description' => 'Add setup instructions for new developers', 'priority' => 'low', 'completed' => true],
            ['title' => 'Configure CI/CD pipeline', 'description' => 'Set up automated testing and deployment', 'priority' => 'high', 'completed' => false],
            ['title' => 'Security audit', 'description' => 'Review code for security vulnerabilities', 'priority' => 'high', 'completed' => false],
            ['title' => 'Performance testing', 'description' => 'Load test the application', 'priority' => 'medium', 'completed' => false],
            ['title' => 'User feedback analysis', 'description' => 'Review and categorize user feedback', 'priority' => 'medium', 'completed' => true],
            ['title' => 'Update design system', 'description' => 'Refresh UI components library', 'priority' => 'low', 'completed' => false],
            ['title' => 'Clean up old branches', 'description' => 'Remove merged branches from repository', 'priority' => 'low', 'completed' => false],
            ['title' => 'Backup database', 'description' => 'Create backup before major update', 'priority' => 'high', 'completed' => true],
            ['title' => 'Monitor application logs', 'description' => 'Check for errors and warnings', 'priority' => 'medium', 'completed' => false],
            ['title' => 'Organize workspace', 'description' => 'Clean up development environment', 'priority' => 'low', 'completed' => false],
        ];

        foreach ($todos as $todo) {
            DB::table('todos')->insert([
                'title' => $todo['title'],
                'description' => $todo['description'],
                'priority' => $todo['priority'],
                'completed' => $todo['completed'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
