<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class importCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import countries data from JSON file';

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
     * @return int
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $counters = [
          'success' => 0,
          'failed'  => 0
        ];
        $file = Storage::disk('public')->get('countries.json');
        if ($file){
            foreach (json_decode($file) as $country){
                try {
                    Country::query()->updateOrCreate([
                        'country_name' => $country->name
                    ],[
                        'flag' => $country->flag,
                        'calling_code' => $country->idd
                    ]);
                    $counters['success'] ++ ;
                } catch (Exception $exception){
                    Log::error('Failed to add/update country ' . $country->name . '.' . $exception->getMessage());
                    $counters['failed'] ++;
                }

            }
        }

        $this->info('Successfully added ' . $counters['success'] . ' countries');
        $this->info('Failed to add ' . $counters['failed'] . ' countries');

        return 0;
    }
}
