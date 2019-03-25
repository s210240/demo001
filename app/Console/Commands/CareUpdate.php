<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PetsModel;
use App\ServiceClass;

class CareUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:care_update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Care update';

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
        $pets = PetsModel::where('die', 0)->get();

        foreach ($pets as $pet) {
            $care = $pet->care;

            PetsModel::where('id', $pet->id)->update(['care' => $care - 1]);

            if ($care == 1) {
                PetsModel::where('id', $pet->id)->update(['die' => 0]);
            }
        }

        $service = new ServiceClass();
        $service->eventUpdate();
    }
}
