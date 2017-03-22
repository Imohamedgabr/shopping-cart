<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use Session;
use App\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Order;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = DB::table('products')->get();
        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request,$id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart); // it expects it
        $cart->add($product , $product->id);
        $request->session()->put('cart',$cart);
        // dd($request->session()->get('cart'));
        return redirect()->route('product.index');
        
    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart); // it expects it
        $cart->reduceByOne($id);

        if (count($cart->items) > 0  ) {
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart); // it expects it
        $cart->removeItem($id);

        if (count($cart->items) > 0  ) {
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        
        return redirect()->route('product.shoppingCart');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here i need to be able to fetch my cart
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart',['products'=> $cart->items , 'totalPrice' => $cart->totalPrice ]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout',['total'=>$total]);
    }

    public function postCheckout(Request $request)
    {
         if (!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey("sk_test_SylISVf8ZtzuBujkEDAIcHz6");
        try{
            
            $charge = Charge::create(array(
              "amount" => $cart->totalPrice * 100 ,
              "currency" => "usd",
              "source" => $request->input('stripeToken'),
              "description" => "Test Charge"
            ));

            $order = new Order();
            // takes my php object and convert it into a string
            $order->cart = serialize($cart); 
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            // now we make the relation
            // how to make a query and save something database 
            // thats how to save related objects in the database
            Auth::user()->orders()->save($order);


        } catch(\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
              
        Session::forget('cart');
        return redirect()->route('product.index')->with('success' , 'successfully purchased products');
    }

// ----------------------------------------------------------------



    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('product.index')->with('success' , 'successfully logged out');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('shop.showItem',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
