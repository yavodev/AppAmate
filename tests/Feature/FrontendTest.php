<?php

namespace Tests\Feature;

use stdClass;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Question;
use App\Models\Directory;
use App\Models\Information;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontendTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function test_inicio()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->get('/');

        // Simular la logica que está en el controlador
        $noticias = Information::latest()->take(8)->get();
        $noticias_count = Information::count();
        $eventos = Event::get();
        $eventos_count = Event::count();

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.inicio');
        $response->assertViewHasAll([
            'noticias' => $noticias,
            'noticias_count' => $noticias_count,
            'eventos' => $eventos,
            'eventos_count' => $eventos_count
        ]);
    }


    /** @test  */
    public function test_directorio()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->get('/directorio');

        // Simular la logica que está en el controlador
        $directorios = Directory::all();
        $directorios_count = Directory::count();

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.directorio');
        $response->assertViewHasAll([
            'directorios' => $directorios,
            'directorios_count' => $directorios_count,
        ]);
    }


    /** @test  */
    public function test_noticias()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->get('/noticias');

        // Simular la logica que está en el controlador
        $noticias = Information::all();
        $noticias_count = Information::count();

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.noticias.noticias');
        $response->assertViewHasAll([
            'noticias' => $noticias,
            'noticias_count' => $noticias_count,
        ]);
    }


    /** @test  */
    public function test_noticiashow()
    {
        $this->withoutExceptionHandling();

        // Flujo que debe estar listo antes de correr la URL.
        Information::factory(['id' => 1])->create();

        // Correr url
        $response = $this->get('/noticias/1');

        // Simular la logica que está en el controlador
        $lastestnoticia = Information::latest()
            ->take(4)
            ->get();
        $noticia = Information::find(1);

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.noticias.show');
        $response->assertViewHasAll([
            'noticia' => $noticia,
            'lastestnoticia' => $lastestnoticia,
        ]);
    }


    /** @test  */
    public function test_eventos()
    {
        $this->withoutExceptionHandling();

        if(!function_exists("fechaCastellano")){
            // Correr url
            $response = $this->get('/eventos');

            // Simular la logica que está en el controlador
            $eventos = Event::all();
            $eventos_count = Event::count();

            // Validar las Aserciones (Chequear que todo funcione según lo planeado)
            $response->assertStatus(200);
            $response->assertOk();
            $response->assertViewIs('frontend.eventos.index');
            $response->assertViewHasAll([
                'eventos' => $eventos,
                'eventos_count' => $eventos_count,
            ]);
        }
    }


    /** @test  */
    public function test_eventoshow()
    {
        $this->withoutExceptionHandling();

        // Flujo que debe estar listo antes de correr la URL.
        Event::factory(['id' => 1])->create();

        // Correr url
        $response = $this->get('/eventos/1');

        // Simular la logica que está en el controlador
        $lastesteven = Event::latest()
            ->take(4)
            ->get();
        $evento = Event::find(1);

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.eventos.show');
        $response->assertViewHasAll([
            'evento' => $evento,
            'lastesteven' => $lastesteven,
        ]);
    }


    /** @test  */
    public function test_contacto()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->get('/contacto');

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.contacto');
    }


    /** @test  */
    public function test_contacto_store()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->post('/contacto/enviar', [
            'name' => 'Yerson',
            'email' => 'yersonvargas18@gmail.com',
            'phone' => '3167777888',
            'subject' => 'Asunto de Test',
            'message' => 'Mensaje de Test'
        ]);

        // Simular la logica que está en el controlador

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        // $response->assertViewIs('frontend.eventos.show');
        // $response->assertViewHasAll([
        //     'evento' => $evento,
        //     'lastesteven' => $lastesteven,
        // ]);
    }


    /** @test  */
    public function test_anonimo()
    {
        $this->withoutExceptionHandling();

        // Correr url
        $response = $this->get('/test-anonimo');

        // Simular la logica que está en el controlador
        $quesions = Question::where('deleted_up', null)->get();

        // Validar las Aserciones (Chequear que todo funcione según lo planeado)
        $response->assertStatus(200);
        $response->assertOk();
        $response->assertViewIs('frontend.anonimo.testanonimo');
        $response->assertViewHasAll([
            'quesions' => $quesions
        ]);
    }
}
