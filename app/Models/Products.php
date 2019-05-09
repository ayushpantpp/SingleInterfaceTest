<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    static function get_all_products() {
        return Products::all();
      }
}
