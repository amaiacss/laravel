<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaludoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
        public function test_usuario_invitado(){
        $this->assertSame(welcome(), 'Bienvenido invitado');        
    }

    public function test_usario_conocido(){        
        $user = new \App\Models\User(['name' => 'Amaia']);
     
        auth()->login($user);
       
        $this->assertSame(welcome(), 'Bienvenido/a Amaia');        
    }
} //fin de la clase

if (!function_exists('welcome')){
    function welcome(){        
        if(auth()->check()){            
            return  'Bienvenido/a ' . auth()->user()->name;            
        }else {
            return 'Bienvenido invitado';
        }
    }
}
