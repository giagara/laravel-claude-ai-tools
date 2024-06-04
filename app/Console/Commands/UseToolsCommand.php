<?php

namespace App\Console\Commands;

use App\Classes\ClaudeAiToolManager;
use App\Tools\WriteLogTool;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UseToolsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tool example';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = [
            [
                'role' => 'user',
                'content' => 'I have these usernames with scores: Zoey (50), Drake (20), Jake (99), Michael (12), Scott (77), Ryan(11). I need to log the username with high score and the score',
            ],
        ];


        (new ClaudeAiToolManager())
        ->addTool(WriteLogTool::class)
        ->run($messages);

        $this->info("Operation completed successfully");        

    }
}
