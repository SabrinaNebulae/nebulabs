<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        User::factory(19)->create();

        Category::factory()->create(['name' => 'Category 1', 'name_fr' => 'Catégorie 1']);
        Category::factory()->create(['name' => 'Category 2', 'name_fr' => 'Catégorie 2']);
        Category::factory()->create(['name' => 'Category 3', 'name_fr' => 'Catégorie 3']);
        Category::factory()->create(['name' => 'Category 4', 'name_fr' => 'Catégorie 4']);

        Status::factory()->create(['name' => 'Open', 'name_fr' => 'Ouverte']);
        Status::factory()->create(['name' => 'Considering', 'name_fr' => 'À l\'étude']);
        Status::factory()->create(['name' => 'In Progress', 'name_fr' => 'En cours']);
        Status::factory()->create(['name' => 'Implemented', 'name_fr' => 'Implémentée']);
        Status::factory()->create(['name' => 'Closed', 'name_fr' => 'Fermée']);

        Idea::factory(100)->existing()->create();

        // Gerenate unique votes ; Ensure idea_id and user_id are unique for each row
        foreach (range(1, 20) as $user_id) {
            foreach (range(1, 100) as $idea_id) {
                if ($idea_id % 2 === 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id
                    ]);
                }
            }
        }

        //Generate comments for ideas
        foreach (Idea::all() as $idea) {
            Comment::factory(5)->existing()->create(['idea_id' => $idea->id]);
        }
    }
}
