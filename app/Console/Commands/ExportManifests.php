<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Record;
use App\Models\ValidationErrors;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ExportManifests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manifests:export {record?} {validate?} {period?}';

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

        if(! empty($this->argument('period'))){
            switch($this->argument('period')){
                case 'all':
                    break;
                case 'errors':
                    $errors = ValidationErrors::pluck('manifest');
                    dd($errors);
                    $record = $record->whereIn('manifest', $errors);
                    break;
                case 'day':
                    $record = $record->where(function ($query) {
                        $query->where('lastExportedOn', '<', now()->subHours(24))
                            ->orWhereNull('lastExportedOn');
                    });
                    break;
                case 'never':
                    $record = $record->whereNull('lastExportedOn');
                    break;
            }
        }

        $manifests = [];

        $record->has('images')->orderBy('mCodexNumberNew', 'ASC')->chunk(20, function($records) use (&$manifests){
            foreach($records as $record){
                $exported = false;
                $manifest = Record::manifest($record);
                Storage::disk('manifests')->put('VFL_'.$record->mFolderNumber.'.json', json_encode($manifest, JSON_PRETTY_PRINT));
                $this->info('Exported: ' . 'VFL_'.$record->mFolderNumber.'.json');
                $path = [
                    'full' => Storage::disk('manifests')->url('VFL_'.$record->mFolderNumber.'.json'),
                    'name' => $record->mFolderNumber,
                ];

                if(! empty($this->argument('validate')) && ($this->argument('validate') == 1 || $this->argument('validate') == true)) {
                    $exported = $this->validateManifest($path);
                } else {
                    $exported = true;
                }
                if($exported){
                    $record->update(['lastExportedOn' => now()]);
                    $manifests[] = $path;
                }
            }
        });

        $this->info('Total Manifests Exported: ' . count($manifests));
    }

    function validateManifest($manifest)
    {
        $validated = false;

        $this->info('Manifest URL: ' . $manifest['full']);

        try{
            $response = Http::withOptions([
                'stream' => true,
                'version' => '1.0',
            ])->get('https://iiif.io/api/presentation/validator/service/validate?format=json&version=2.0&url=' . $manifest['full']);

            if($response['okay'] == 1){
                $this->info('OK');
                $validated = true;
            }else{
                // TODO: save errors to database
                // TODO: should we save valid check when manifest is generated and not recheck?
                ValidationErrors::create([
                    'manifest' => $manifest['name'],
                    'message' => 'Validation Error: ' . $response['error'],
                ]);
                $this->error('Error: ' . $response['error']);
            }
        } catch (\Exception $e){
            ValidationErrors::create([
                'manifest' => $manifest['name'],
                'message' => 'Connection Error: ' . $e->getMessage(),
            ]);
            $this->error('Error: ' . $e->getMessage());
            usleep(5000000); // Wait 5 seconds
        }

        return $validated;
    }
}
