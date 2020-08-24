<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Contacto;

class ContactosController extends Controller
{
    public function index(){
       return view('contactos.index');
   }

   public function enviar(Request $request){
   		$dados = $request->validate ([
            'email'=>['required','email'],  
            'assunto'=>['required'],
            'mensagem'=>['required'],
        ],
        [
            'email.email' => 'Percisa de introduzir um email valido!',
            'email.required' => 'Percisa de introduzir um email valido!',
            'assunto.required' => 'Percisa de introduzir um assunto!',
            'mensagem.required' => 'Percisa de introduzir uma mensagem!',
        ]);
        
        Mail::to('6bcb8fe3eb-c1fada@inbox.mailtrap.io')->send(new Contacto($dados));

        return redirect()->route('contactos.index')->with('mensagem','Email enviado com sucesso!');
   }


   
   public function recuperarPassword(Request $request){
        $dados = $request->validate ([
        'email'=>['required','email'],  
    ],
    [
        'email.email' => 'Percisa de introduzir um email valido!',
        'email.required' => 'Percisa de introduzir um email valido!',
    ]);
    $dados['assunto'] = 'Recuperar Password';
    $dados['mensagem'] = 'Este utilizador '.$dados['email'].' perdeu a sua password.';
    
    Mail::to('6bcb8fe3eb-c1fada@inbox.mailtrap.io')->send(new Contacto($dados));

    return redirect()->route('login')->with('mensagem','Email enviado com sucesso!');
}


}
