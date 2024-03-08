<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Type;

//Helpers
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Foreach_;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Type::truncate();
        });

        $allType=[
            'Html',
            'Css',
            'JavaScript',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];

        foreach ($allType as $singleType) {
            $type = Type::create([
                'title' => $singleType,
                'slug' => str()->slug($singleType),
            ]);
        }
    }
}
