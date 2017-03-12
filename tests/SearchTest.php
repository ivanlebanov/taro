<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * A basic test based on the current data in the database.
     *
     * @return void
     */
    public function testSearchBasic()
    {
        $params = [
          'phrase' => 'mak'
        ];
        $response = $this->call('GET', '/search', $params);
        $content = $response->getOriginalContent();

        $content = $content->getData();
        $products = $content['products'];

        $params = [
          'phrase' => 'mac'
        ];
        $response = $this->call('GET', '/search', $params);
        $content = $response->getOriginalContent();

        $content = $content->getData();
        $products_two = $content['products'];

        $this->assertTrue((count($products) == count($products_two)) ? true : false );
    }
    /**
     * A test if the user will be allowed to type nothing as a phrase.
     *
     * @return void
     */
    public function testSearchNoPhrase()
    {
      $params = [
        'phrase' => ''
      ];
      $response = $this->call('GET', '/search', $params);
      $this->assertSessionHasErrors();
    }
}
