<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\User;
use App\Http\Requests\ProductRequest;
use App\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $objUser;
    private $objProduct;

    public function __construct()
    {
        $this->middleware('auth');
        $this->objUser = new User();
        $this->objProduct = new Product();
    }

    public function index()
    {
        // dd($this->objProduct->all());
        $products = $this->objProduct->all();

        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->objUser->all();
        return view('create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $register = $this->objProduct->create([
            'name' => $request->name,
            'id_user' => $request->id_user,
            'value' => $request->value,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        for ($i = 0; $i < count($request->allFiles()['file']); $i ++) {
            $file = $request->allFiles()['file'][$i];

            $productImage = new ProductImage();
            $productImage->product_id = $register->id;
            $productImage->path = $file->store('products_images/'.$register->id);
            $productImage->save();
        }

        if ($register) {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->objProduct->find($id);
        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->objProduct->find($id);
        $users = $this->objUser->all();
        return view('create', compact('product', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->objProduct->where(['id' => $id])->update([
            'name' => $request->name,
            'id_user' => $request->id_user,
            'value' => $request->value,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        for ($i = 0; $i < count($request->allFiles()['file']); $i ++) {
            $file = $request->allFiles()['file'][$i];

            $productImage = new ProductImage();
            $productImage->product_id = $id;
            $productImage->path = $file->store('products_images/'.$id);
            $productImage->save();
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->objProduct->destroy($id);

        return redirect('/');
    }

    public function destroyImage($id, $imageId)
    {
        $product = $this->objProduct->find($id);

        foreach ($product->relImage as $image) {
            $deleted = $image->where(['id' => $imageId]);
            $deleted->delete();
        }

    }
}
