<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class CreateDatabase extends Command
{
    protected $signature = 'app:create-database {name}';
    protected $description = 'Create a new MySQL database';

    public function handle()
    {
        $name = $this->argument('name');
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');

        try {
            $pdo = new PDO("mysql:host=$host;port=$port", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $this->info(" Database '$name' created successfully!");
        } catch (\Exception $e) {
            $this->error(" Failed: " . $e->getMessage());
        }
    }
}