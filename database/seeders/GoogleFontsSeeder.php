<?php

namespace Database\Seeders;

use App\Models\GoogleFont;
use Illuminate\Database\Seeder;

class GoogleFontsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roboto = GoogleFont::firstOrCreate(['google_fonts'=>'Roboto']);
        $overpass = GoogleFont::firstOrCreate(['google_fonts'=>'Overpass']);
        $open_Sans = GoogleFont::firstOrCreate(['google_fonts'=>'Open Sans']);
        $lato = GoogleFont::firstOrCreate(['google_fonts'=>'Lato']);
        $montserrat = GoogleFont::firstOrCreate(['google_fonts'=>'Montserrat']);
        $oswald = GoogleFont::firstOrCreate(['google_fonts'=>'Oswald']);
        $source = GoogleFont::firstOrCreate(['google_fonts'=>'Source Sans Pro']);
        $raleway = GoogleFont::firstOrCreate(['google_fonts'=>'Raleway']);
        $sans = GoogleFont::firstOrCreate(['google_fonts'=>'PT Sans']);
        $aguafina_Script = GoogleFont::firstOrCreate(['google_fonts'=>'Aguafina Script']);
        $aclonica = GoogleFont::firstOrCreate(['google_fonts'=>'Aclonica']);
        $akronim = GoogleFont::firstOrCreate(['google_fonts'=>'Akronim']);
        $aldrich = GoogleFont::firstOrCreate(['google_fonts'=>'Aldrich']);
        $alfa_Slab_One = GoogleFont::firstOrCreate(['google_fonts'=>'Alfa Slab One']);
        $pt_serif = GoogleFont::firstOrCreate(['google_fonts'=>'PT Serif']);
        $poppins = GoogleFont::firstOrCreate(['google_fonts'=>'Poppins']);
        $titillium = GoogleFont::firstOrCreate(['google_fonts'=>'Titillium']);
        $helvetica_neue = GoogleFont::firstOrCreate(['google_fonts'=>'Helvetica Neue']);
    }
}
