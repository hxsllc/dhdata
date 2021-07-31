<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Record;
use App\Models\ValidationErrors;
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
    protected $signature = 'manifests:export {record?} {validate?}';

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

        $manifests = [];

        $record = $record->has('images')->orderBy('mCodexNumberNew', 'ASC')->chunk(20, function($records) use (&$manifests){
            foreach($records as $record){
                $manifest = Record::manifest($record);
                Storage::disk('manifests')->put('VFL_'.$record->mFolderNumber.'.json', json_encode($manifest, JSON_PRETTY_PRINT));
                $this->info('Exported: ' . 'VFL_'.$record->mFolderNumber.'.json');
                $manifests[] = Storage::disk('manifests')->url('VFL_'.$record->mFolderNumber.'.json');
            }
        });

        $this->info('Total Manifests Exported: ' . count($manifests));

        if(! empty($this->argument('validate'))) {
            foreach ($manifests as $manifest) {
                $this->validateManifest($manifest);
            }
        }

    }

    function validateManifest($manifest)
    {
        $this->info('Manifest URL: ' . $manifest);

        try{
            $response = Http::withOptions([
                'stream' => true,
                'version' => '1.0',
            ])->get('https://iiif.io/api/presentation/validator/service/validate?format=json&version=2.0&url=' . $manifest);

            if($response['okay'] == 1){
                $this->info('OK');
            }else{
                // TODO: save errors to database
                // TODO: should we save valid check when manifest is generated and not recheck?
                ValidationErrors::create([
                    'manifest' => $manifest,
                    'message' => $response['error'],
                ]);
                $this->error('Error: ' . $response['error']);
            }
        } catch (\Exception $e){
            ValidationErrors::create([
                'manifest' => $manifest,
                'message' => $e->getMessage(),
            ]);
            $this->error('Error: ' . $e->getMessage());
        }

    }
}
