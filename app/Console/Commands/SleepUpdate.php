<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PetsModel;
use App\ServiceClass;

class SleepUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sleep_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sleep update';

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
        $pets = PetsModel::where('die', 0)->where('sleep', '>', 4)->get();

        foreach ($pets as $pet) {
            $sleep = $pet->sleep;
            PetsModel::where('id', $pet->id)->update(['sleep' => $sleep - 1]);
        }

        $service = new ServiceClass();
        $service->eventUpdate();
    }
}
