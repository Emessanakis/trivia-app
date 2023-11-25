<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_search_form()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('search-form');
    }

    /** @test */
    public function it_processes_the_search_form_and_returns_trivia_questions()
    {
        $response = $this->post('/trivia-questions/process', [
            'full_name' => 'John Doe',
            'email_address' => 'john@example.com',
            'questions_amount' => 5,
            'select_difficulty' => 'medium',
            'select_type' => 'multiple',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('trivia-questions');
    }
}