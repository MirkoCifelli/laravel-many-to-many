<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Project;
use App\Models\Type;

//Helpers
use Illuminate\Support\Str;
// Helpers
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        
        
            for ($i = 0; $i < 10; $i++) {

                $randomType = Type::inRandomOrder()->first();
                $titleForMassAssignment = fake()->sentence();
                $slugForMassAssignment = Str::slug($titleForMassAssignment);
                $postWithMassAssignment = Project::create([
                'title' => $titleForMassAssignment,
                'slug' => $slugForMassAssignment,
                'content' => fake()->paragraph(),
                'type_id'=> $randomType->id,
            ]);
        }
            
    }
}
