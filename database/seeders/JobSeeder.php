<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(3)->create();

        Job::factory(3)->hasAttached($tags)->create([
            'featured' => true,
        ]);

        Job::factory(17)->hasAttached($tags)->create([
            'featured' => false,
        ]);
    }
}
