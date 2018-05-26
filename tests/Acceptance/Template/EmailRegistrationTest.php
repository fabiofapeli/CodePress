<?php

class EmailRegistrationTest extends TestCase
{
  //Criação de rota fake para testar email
  protected function createRoute(){ 
    Route::group(['middleware' => ['web']], function (){
      Route::get('/email/registration', function (){
        return view('email.registration', [
          'username' => 'teste@teste.com',
          'password' => '123456'
        ]);
      });
    });
  }

  public function test_can_generate_html_from_template(){
    $this->createRoute();
    $this->visit('/email/registration')
        ->see('teste@teste.com')
        ->see('123456');
  }

}
