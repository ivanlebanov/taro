<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class CheckoutTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckout()
    {
      $user =  new User(array(
        'id' => 6,
        'name' => 'Ivan Lebanov',
        'email' => 'lebanovivan@gmail.com',
        'password' => 'Test',
        'telephone' => '2904841230',
        'address' => 'test',
        'town_city' => 'dadada',
        'country' => 'GB',
        'postcode' => 'dadada',
        'delivery_type_id' => 2,
        'is_admin' => 0,
      ));
      $this->be($user);

      $params = [
          'quantity' => 10,
      ];


      $cart = ['cart' => \Crypt::encrypt('{"5":1}')];
      $responsetwo = $this->call('POST', '/checkout', $params, [$cart]);


      $this->assertTrue(true);
    }
}
