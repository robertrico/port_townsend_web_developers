<?php 
// Load PHP Composer
require_once __DIR__ . '/vendor/autoload.php';

// Load Environment Variables
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Load and Run Main Class
$main = new Hackbook\OpenAiPresent\Present();
$main->run();

?>