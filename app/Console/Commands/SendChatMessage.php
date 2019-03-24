<?php

namespace App\Console\Commands;

use App\Events\UpdatePets;
use Illuminate\Console\Command;
use App\Events\ChatMessageWasReceived;
use Illuminate\Support\Facades\Log;

class SendChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send001';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Terminal');
        event(new UpdatePets("Test message", 1));
    }
}
