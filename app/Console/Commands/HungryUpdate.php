<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PetsModel;
use App\ServiceClass;

class HungryUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:hungry_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update hungry';

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
        $pets = PetsModel::where('die', 0)->where('hunger', '>', 4)->get();

        foreach ($pets as $pet) {
            $hunger = $pet->hunger;
            PetsModel::where('id', $pet->id)->update(['hunger' => $hunger - 1]);
        }

        $service = new ServiceClass();
        $service->eventUpdate();
    }
}
