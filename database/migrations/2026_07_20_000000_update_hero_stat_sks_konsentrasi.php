<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        Setting::set('hero_stat1_angka', '50'); // SKS
        Setting::set('hero_stat3_angka', '4');  // Konsentrasi
    }

    public function down(): void {}
};
