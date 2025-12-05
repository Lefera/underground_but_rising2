<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use Illuminate\Support\Str;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $artists = [
            [
                'name' => 'omo lumo',
                'city' => 'Lomé',
                'genre_id' => 1,
                'bio' => 'Artiste RnB lyrics engagés.',
                'photo' => null,
                'youtube_link' => 'https://youtube.com',
                'instagram' => 'https://instagram.com/kxngunda'
            ],
            [
                'name' => 'Lekid28',
                'city' => 'Lome',
                'genre_id' => 4,
                'bio' => 'Artiste Hip/Hop en pleine montée dans la scène urbaine Togolaise.',
                'photo' => null,
                'youtube_link' => 'https://youtube.com',
                'instagram' => 'https://instagram.com/nessawave'
            ],
            [
                'name' => 'Remasly',
                'city' => 'Lome',
                'genre_id' => 2,
                'bio' => ' Artiste Hip/Hop très visuel, production minimaliste et flows percutants.',
                'photo' => null,
                'youtube_link' => 'https://youtube.com',
                'instagram' => 'https://instagram.com/jaydrip'
            ]
        ];

        foreach ($artists as $a) {
            Artist::create([
                'name' => $a['name'],
                'slug' => Str::slug($a['name']),
                'city' => $a['city'],
                'genre_id' => $a['genre_id'],
                'bio' => $a['bio'],
                'photo' => null,
                'youtube_link' => $a['youtube_link'],
                'instagram' => $a['instagram'],
                'facebook' => null
            ]);
        }
    }
}
