<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Collection::create(['name' => 'Arch. Cap. S. Pietro', 'acronym' => 'AP[+]']);
            Collection::create(['name' => 'Barb. gr.', 'acronym' => 'BAG']);
            Collection::create(['name' => 'Barb. lat.', 'acronym' => 'BAL']);
            Collection::create(['name' => 'Barb. or.', 'acronym' => 'BAO']);
            Collection::create(['name' => 'Borgh.', 'acronym' => 'BHS']);
            Collection::create(['name' => 'Borg. ar.', 'acronym' => 'BOA']);
            Collection::create(['name' => 'Borg. ebr.', 'acronym' => 'BOH']);
            Collection::create(['name' => 'Borg. et.', 'acronym' => 'BOE']);
            Collection::create(['name' => 'Borg. gr.', 'acronym' => 'BOG']);
            Collection::create(['name' => 'Borg. lat.', 'acronym' => 'BOL']);
            Collection::create(['name' => 'Borg. sir.', 'acronym' => 'BOS']);
            Collection::create(['name' => 'Capp. Giulia', 'acronym' => 'CPG']);
            Collection::create(['name' => 'Capp. Sist.', 'acronym' => 'CPS']);
            Collection::create(['name' => 'Cappon.', 'acronym' => 'CPP']);
            Collection::create(['name' => 'Cerulli et.', 'acronym' => 'CRE']);
            Collection::create(['name' => 'Chig.', 'acronym' => 'CH[+]']);
            Collection::create(['name' => 'Ferr.', 'acronym' => 'FRR']);
            Collection::create(['name' => 'Neofiti', 'acronym' => 'NEO']);
            Collection::create(['name' => 'Ott. gr.', 'acronym' => 'OTG']);
            Collection::create(['name' => 'Ott. lat.', 'acronym' => 'OTL']);
            Collection::create(['name' => 'Pal. gr.', 'acronym' => 'PLG']);
            Collection::create(['name' => 'Pal. lat.', 'acronym' => 'PLL']);
            Collection::create(['name' => 'Patetta', 'acronym' => 'PAT']);
            Collection::create(['name' => 'Reg. gr.', 'acronym' => 'RGG']);
            Collection::create(['name' => 'Reg. gr. Pio II', 'acronym' => 'RGP']);
            Collection::create(['name' => 'Reg. lat.', 'acronym' => 'RGL']);
            Collection::create(['name' => 'Ross.', 'acronym' => 'RSS']);
            Collection::create(['name' => 'Sala cons. mss.', 'acronym' => 'SCM']);
            Collection::create(['name' => 'Urb. ebr.', 'acronym' => 'UBH']);
            Collection::create(['name' => 'Urb. gr.', 'acronym' => 'UBG']);
            Collection::create(['name' => 'Urb. lat.', 'acronym' => 'UBL']);
            Collection::create(['name' => 'Vat. ar.', 'acronym' => 'VTA']);
            Collection::create(['name' => 'Vat. ebr.', 'acronym' => 'VTH']);
            Collection::create(['name' => 'Vat. et.', 'acronym' => 'VTE']);
            Collection::create(['name' => 'Vat. gr.', 'acronym' => 'VTG']);
            Collection::create(['name' => 'Vat. lat.', 'acronym' => 'VTL']);
            Collection::create(['name' => 'Vat. sir.', 'acronym' => 'VTS']);
    }
}
