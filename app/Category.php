<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product_category';

  protected $primaryKey = 'pc_id';
  protected $fillable = array('pc_name');

}
