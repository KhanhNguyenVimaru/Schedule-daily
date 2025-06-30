<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SaveRealtimeTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-realtime-tasks';

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
            \Log::info('Đã lưu task lúc: ' . now());
    }
    
}
