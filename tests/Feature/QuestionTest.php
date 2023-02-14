<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function test_lis_questions(){
        $this->withoutExceptionHandling();

        Artisan::call('migrate');
        /* $acces = $this->post(route('login'), [
            "email"=>"admin@amate.co", "password"=>"12345678"
        ]);
        $acces->assertStatus(302)->assertRedirect(route('home')); */

        $response =$this->get('/home');
        $response->assertOk();

    }

    public function test_create_question()
    {
        $this->withoutExceptionHandling();
        
        /* $ss = Question::factory()->create();
        $test_post = [
            'ask' => 'prueba',
            'category' => 'urgente',
        ];
        $response = $this->actingAs($ss)->post('/preguntas-test/store', $test_post); */
        $acces = $this->post(route('login'), [
            'email'=>'admin@amate.co', 'password'=>'12345678'
        ]);
        $acces->assertStatus(200);
        $response = $this->post('/preguntas-test/store', [
            'ask' => 'prueba',
            'category' => 'urgente',
        ]); 

        $response->assertOk();
        $this->assertCount(1, Question::all());

        $question = Question::first();

        $this->assertEquals($question->ask, 'prueba');
        $this->assertEquals($question->category, 'urgente');

    }

}
