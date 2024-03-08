<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Technology;

//Helpers
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Foreach_;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Technology::truncate();
        });

        $allTechnology=[
            'News',
            'Updated',
            'Relased',
            'Technology',
            'Web',
            'Software',
            'Hardware',
            'AI'
        ];

        foreach ($allTechnology as $singleTechnology) {
            $technology = Technology::create([
                'title' => $singleTechnology,
                'slug' => str()->slug($singleTechnology),
            ]);
        }
    }
}
