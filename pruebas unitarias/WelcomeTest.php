<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use App\Models\User;

class WelcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);

    //     $this->assertTrue(false);
    // }

    public function test_saludo_invitado(){
        $this->assertSame(welcome(), 'Bienvenido invitado');
        // $this->assertNotSame(welcome(), 'Bienvenido invitado');
    }

    public function test_saludo_usuario(){
        //simulamos que ha iniciado sesión un usuario determinado
        //Creamos una instancia de la clase User con el nombre Ana 
        $user = new \App\Models\User(['name' => 'Ana', 'email' => 'ana@gmail.com']);
        //$user = new Usuario('Ana');
        //Le decimos que autentifique este usuario
        auth()->login($user);
        //Afirmamos que lo que devuelve el método welcome es igual a Ana
        $this->assertSame(welcome(), 'Bienvenido/a Ana');
        $this->assertSame(devuelveEmail(), 'ana@gmail.com');
    }
} //fin de la clase

if (!function_exists('welcome')){ //si la función welcome no existe
    function welcome(){
        //Chequeamos si se ha autenticado un usuario
        if(auth()->check()){
            //Obtenemos el name del usuario autenticado
            return  'Bienvenido/a ' . auth()->user()->name; 
            // return 'Bienvenido/a Ana';
        }else {
            return 'Bienvenido invitado';
        }
    }
}

if (!function_exists('devuelveEmail')){
    function devuelveEmail(){
        //return 'ana@gmail.com';
        return auth()->user()->email;
    }
}

