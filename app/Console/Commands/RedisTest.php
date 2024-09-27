<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $before = microtime(true);

        // Database
//        $posts = Post::all();
//        Cache::put('posts:all', $posts); // 0.043826818466187
//        Cache::get('posts:all'); // 0.018982887268066

        // Redis
//      Cache::put('posts:all', Post::all());
//      Cache::get('posts:all'); // 0.010872840881348
//      Post::all(); // // 0.023048877716064


        $after = microtime(true);

        $this->info($after - $before);
    }
}
