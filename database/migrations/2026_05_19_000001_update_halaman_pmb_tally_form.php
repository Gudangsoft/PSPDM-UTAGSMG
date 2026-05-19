<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $konten = '<iframe data-tally-src="https://tally.so/embed/Bzjgj1?alignLeft=1&hideTitle=1&transparentBackground=1&dynamicHeight=1" loading="lazy" width="100%" height="4775" frameborder="0" marginheight="0" marginwidth="0" title="PROGRAM STUDI MANAJEMEN PROGRAM DOKTOR"></iframe>';

        DB::table('halaman')->where('slug', 'pmb')->update([
            'konten'     => $konten,
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        $konten = '<iframe data-tally-src="https://tally.so/embed/BzA981?alignLeft=1&hideTitle=1&transparentBackground=1&dynamicHeight=1" loading="lazy" width="100%" height="4775" frameborder="0" marginheight="0" marginwidth="0" title="PROGRAM STUDI MANAJEMEN PROGRAM DOKTOR"></iframe>';

        DB::table('halaman')->where('slug', 'pmb')->update([
            'konten'     => $konten,
            'updated_at' => now(),
        ]);
    }
};
