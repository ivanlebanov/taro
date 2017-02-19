<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product';
  protected $primaryKey = 'p_id';
  protected $fillable = array('p_stock', 'p_sales');

}
