<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AddItemsToCartTest extends TestCase
{
    /**
     * Adding 20 products.
     *
     * @return void
     */
    public function testAddTwentyProducts()
    {
      \Cookie::queue(\Cookie::forget('cart'));
      $user =  new User(array('email', 'lebanovivan@gmail.com'));
      $this->be($user);

      $params = [
          'quantity' => 20,
      ];

      $response = $this->call('POST', '/product/2', $params);

      $responseText = json_decode($response->original, true);



      $this->assertTrue( ($responseText['status'] == "success") ? true : false );


    }

    /**
     * A test for adding more than a 50 items.
     *
     * @return void
     */
    public function testAddToCartTwo()
    {

      \Cookie::queue(\Cookie::forget('cart'));
      $user =  new User(array('email', 'lebanovivan@gmail.com'));
      $this->be($user);

      $params = [
          'quantity' => 60,
      ];

      $response = $this->call('POST', '/product/2', $params);

      $responseText = json_decode($response->original, true);


      $this->assertTrue( ($responseText['message'] == "Maximum items in the cart is 50") ? true : false );
    }

    /**
     * A test for a product with less stock.
     *
     * @return void
     */
    public function testAddUnavailable()
    {

      \Cookie::queue(\Cookie::forget('cart'));
      $user =  new User(array('email', 'lebanovivan@gmail.com'));
      $this->be($user);

      $params = [
          'quantity' => 3,
      ];

      $response = $this->call('POST', '/product/1', $params);
      $responseText = json_decode($response->original, true);

      $this->assertTrue( ($responseText['message'] == "There is not enough stock") ? true : false );
    }
    /**
     * A test for a product with no stock.
     *
     * @return void
     */
    public function testStock()
    {

      \Cookie::queue(\Cookie::forget('cart'));
      $user =  new User(array('email', 'lebanovivan@gmail.com'));
      $this->be($user);

      $params = [
          'quantity' => 1,
      ];

      $response = $this->call('POST', '/product/3', $params);
      $responseText = json_decode($response->original, true);

      $this->assertTrue( ($responseText['message'] == "There is not enough stock") ? true : false );
    }

}
