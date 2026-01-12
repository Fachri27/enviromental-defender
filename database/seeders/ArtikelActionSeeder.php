<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArtikelActionSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            // insert artikel
            $artikelId = DB::table('artikels')->insertGetId([
                'slug'         => Str::slug('Aksi Lingkungan ' . $i),
                'type'         => 'action',
                'status'       => 'publish',
                'published_at' => Carbon::now()->subDays(rand(1, 30)),
                'image'        => 'artikel/dummy-' . $i . '.jpg',
                'user_id'      => 4, // pastikan user id 1 ada
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // insert translation (ID)
            DB::table('artikel_translations')->insert([
                'artikel_id' => $artikelId,
                'locale'     => 'id',
                'title'      => 'Aksi Lingkungan ke-' . $i,
                'deskripsi'  => 'Ini adalah deskripsi singkat untuk aksi lingkungan ke-' . $i . '.',
                'content'    => '<p>Konten lengkap artikel aksi lingkungan ke-' . $i . ' berisi penjelasan detail kegiatan, tujuan, dan dampaknya.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
