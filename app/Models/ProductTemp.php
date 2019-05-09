<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ProductTemp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', '	product_id', 'qty',
    ];
    protected $table = 'product_temp';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     function get_all_products() {
       return ProductTemp::all();
     }
}
