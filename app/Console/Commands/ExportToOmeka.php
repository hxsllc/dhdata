<?php

namespace App\Console\Commands;

use App\Models\Omeka;
use App\Models\Record;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ExportToOmeka extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omeka:export {record?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export to Omeka';

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

        $record->has('images')->chunk(20, function($records) use (&$manifests){
            foreach($records as $record){
                $this->info('Exported: ' . $record->mFolderNumber);
                ( new Omeka())->createItem($record);
                $manifests[] = $record->mFolderNumber;
            }
        });

        $this->info('Total Manifests Exported to Omeka: ' . count($manifests));
    }
}
