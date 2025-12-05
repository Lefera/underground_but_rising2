<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $news = [
            [
                'title' => 'La nouvelle scène underground explose en Afrique de l’Ouest',
                'content' => 'De plus en plus de jeunes artistes émergent avec des styles innovants.',
                'image' => null
            ],
            [
                'title' => 'Trois (3) artistes à surveiller absolument en 2025',
                'content' => 'Une sélection qui ouvre une fenêtre sur la scène émergente urbain.',
                'image' => null
            ]
        ];

        foreach ($news as $n) {
            News::create([
                'title' => $n['title'],
                'slug' => Str::slug($n['title']),
                'content' => $n['content'],
                'image' => null
            ]);
        }
    }
}
