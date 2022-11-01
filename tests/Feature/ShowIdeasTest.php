<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;

class ShowIdeasTest extends TestCase
{
    /**
     * Test database connection
     *
     * 
     */
    use RefreshDatabase;

    /** @test */
    public function list_of_ideas_shows_on_main_page()
    {
        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);
        $ideaTwo = Idea::factory()->create([
            'title' => 'My Second Idea',
            'description' => 'Description of my second idea',
        ]);
        
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaTwo->description);
    }

    /** @test */
    public function single_idea_shows_correctly_on_the_show_page()
    {
        $idea = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description of my first idea',
        ]);
        
        
        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful();
        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }
}

