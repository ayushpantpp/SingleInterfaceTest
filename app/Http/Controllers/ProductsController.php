<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductTemp;

use App\Models\Cart;

use Session;
use App\Http\Requests;
use DB;

class ProductsController extends Controller
{

    public function index()
    {
        // Set and reset filter session
        $products = Products::get_all_products();
        return view('products.index')->with('products', $products);
    }

    public function addToCart(Request $request, $id) {
      $products = Products::find($id);
      $products_in_cart_check = ProductTemp::where('product_id', $id)->first();
      if(empty($products_in_cart_check)) {
        $products_in_cart_check["qty"] = 0;
      }
      echo $products->inventory_available;
      echo $products_in_cart_check["qty"];
      echo $currently_in_stock = $products->inventory_available - $products_in_cart_check["qty"];
      if($currently_in_stock > 0) {
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($products,$products->id);

        $request->session()->put('cart', $cart);
        if(array_key_exists($id,$cart->items)) {
          $k = $cart->items[$id];
        }
        // echo $k["qty"];
        // dd($k["item"]["id"]);
          $products_in_cart = ProductTemp::where('product_id', $k["item"]["id"])->first();
            if(!empty($products_in_cart)) {
              $products_in_cart->qty = $k["qty"];
              $products_in_cart->save();
            } else {
              $products_in_cart_new = new ProductTemp;
              $products_in_cart_new->product_id = $k["item"]["id"];
              $products_in_cart_new->qty = $k["qty"];
              $products_in_cart_new->save();
            }
            //dd($request->session()->get('cart'));
            return redirect()->route('product.index');
      } else {
            return redirect()->route('product.index')->with('message', 'Out of Stock');
      }
      
    }

    public function shoppingCart() {
      if(!Session::has('cart')) {
        return view('products.shoppingCart')->with('products', null);
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('products.shoppingCart')
      ->with('products', $cart->items)
      ->with('totalPrice', $cart->totalPrice);

    }
}