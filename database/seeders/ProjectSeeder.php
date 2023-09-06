<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 0; $i < 12; $i++) {
            $project = new Project();

            $project->title = $faker->sentence(3);
            // $project->cover = $faker->imageUrl();
            $project->description = $faker->paragraphs(10, true);

            $project->save();
        }
    }
}
