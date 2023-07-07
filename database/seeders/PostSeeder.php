<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'naslov' => 'Prvi oglas',
            'opis' => 'Ovo je opis prvog oglasa',
            'kontakt' => 'Ulica 1. Maja, Bihac',
            'cijena' => 10.45,
        ]);

         Post::create([
            'naslov' => 'Drugi oglas',
            'opis' => 'Ovo je opis drugog oglasa',
            'kontakt' => 'Ulica ZAVNOBiH-a, Bihac',
            'cijena' => 70.45,
        ]);

         Post::create([
            'naslov' => 'Treci oglas',
            'opis' => 'Ovo je opis treceg oglasa',
            'kontakt' => 'Ulica 505. brdske brigade, Bihac',
            'cijena' => 50.45,
        ]);
    }
}
