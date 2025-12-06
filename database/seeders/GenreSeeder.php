<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Rap',
            'Afro',
            'Trap',
            'Reggae',
            'RnB',
            'Dancehall',
            'Soul',
            'Fusion',
        ];

        foreach ($genres as $g) {
            Genre::create([
                'name' => $g,
                'slug' => Str::slug($g),
            ]);
        }
    }
}
