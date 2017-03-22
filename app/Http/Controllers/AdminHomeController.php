<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;
use Storage;
use Session;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
	public function __construct(){
		$this->middleware('admin.user');
	}


    public function index(){
    	return view('Admin_home');
    }

    public function createProduct()
    {     
        return view('shop.createProduct');
    }



    public function storeProduct(Request $request)
    {
        // dd($request);
        // validate the data
        $this->validate($request,array(
            // associative array
            'title'         => 'required|max:255',
            'price'          => 'required|integer',
            'description'          => 'required'
         ));

        // store in the database
        $product = new Product;
        $product->title= $request->title;
        $product->price= $request->price;
        $product->description= $request->description;

        // save our image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            // this is part of the library we included
            $filename = time() . '.' . $image->getClientOriginalExtension(); 
            $location = public_path('images/' . $filename);
            // we create an image object to resize it
            Image::make($image)->resize(800,400)->save($location);
            // we need to put its name in the database as well so we can find it later
            $product->imagePath = $filename;
        }

        $product->save(); // save in the database

        // flash is only saved for 1 request then deleted
        // you can use Put instead of flash and it makes it last the whole 120 min
        Session::flash('success','The product was successfully Created! ');

        // redirct to another page
         return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        //find our product
        $product = product::find($id);
        Storage::delete($product->imagePath);

        $product->delete();
        Session::flash('success','The product was deleted! ');
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        //find the product in the database and save it as a variable
        $product = product::find($id);
        // return the view and pass in the variable we got
        return view('shop.editProduct')->with('product',$product);
    }

    public function redirectAfterRegister()
    {
        // return the view and pass in the variable we got
        return redirect()->route('product.index');
    }


    public function update(Request $request, $id) //controller only function
        {
            // Validate the new data
            $product = product::find($id);
            
            $this->validate($request,array(
            // associative array
            'title'         => 'required|max:255',
            'price'          => 'required|integer',
            'description'          => 'required',
            'featured_image' => 'image|required'
        ));

        // Save the data to the database
        $product = product::find($id);


        // here we handle the image
        if ($request->hasFile('featured_image')) {
            // add the new photo 
            $image = $request->file('featured_image');
            // this is part of the library we included
            $filename = time() . '.' . $image->getClientOriginalExtension(); 
            $location = public_path('images/' . $filename);
            // we create an image object to resize it
            Image::make($image)->resize(800,400)->save($location);
            $oldFilename = $product->imagePath;

            // delete the old photo 
            Storage::delete($oldFilename);
        

        DB::table('products')
            ->where('id', $id)
            ->update(['title' => $request->title , 'price' =>$request->price, 'description' =>$request->description , 'imagePath' => $filename ]); 

            }
             
        // set flash data with success message
        Session::flash('success', 'This product was successfully edited.');

        // redirect with flash data to product.show
        // return redirect()->route('product.show', $product->id);
        return redirect()->route('product.index');
    }

}
