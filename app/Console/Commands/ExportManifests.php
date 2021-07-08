<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Record;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ExportManifests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manifests:export {record?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save manifests to server';

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
     */
    public function handle()
    {
        $record = new Record;

        if(! empty($this->argument('record'))){
            $record = $record->where('mFolderNumber', $this->argument('record'));
        }

        $record = $record->whereNotNull('mFolderNumber')->chunk(20, function($records){
            foreach($records as $record){
                $manifest = Record::manifest($record);
                Storage::disk('manifests')->put('manifests/'.$record->mFolderNumber.'.json', json_encode($manifest, JSON_PRETTY_PRINT));
            }
        });
    }
}
