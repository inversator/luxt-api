<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear db before seeding
        $this->truncateTables([
            'users',
            'posts'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
    }

    /**
     * Clear specified tables
     *
     * @param array $tables
     * @return void
     */
    protected function truncateTables(array $tables): void
    {
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
