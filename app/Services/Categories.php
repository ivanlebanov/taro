<?php

namespace App\Services;

use App\Category as Category;

class Categories
{
    /**
     * The mailer implementation.
     */

     public $categories = [];


    /**
     * Create a new instance.
     *
     * @param  Mailer  $mailer
     * @return void
     */
    public function __construct()
    {
      $this->handle();
    }

    /**
     * Purchase a podcast.
     *
     * @return void
     */
    public function handle()
    {
      $this->categories = Category::all();

      $this->categories = $this->categories->toArray();
      

    }
}
