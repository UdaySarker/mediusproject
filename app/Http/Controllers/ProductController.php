<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(2);
        $variantLists = ProductVariant::distinct()->get(['variant_id', 'variant']);
        $variant = Variant::all();
        $productPrices = ProductVariantPrice::all();
        return view('products.index')
            ->with('products', $products)
            ->with('variants', $variant)
            ->with('variantLists', $variantLists)
            ->with('productPrices', $productPrices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        $product = Product::find($product->id);
        return view('products.edit', compact('variants'))->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function search(Request $request)
    {
        $search = $request->query();
        foreach ($search as $searchParam) {
            echo $searchParam;
        }
        $products = Product::where('price', '<', $search['price'])->paginate(2);
        $variantLists = ProductVariant::distinct()->get(['variant_id', 'variant']);
        $variant = Variant::all();
        $productPrices = ProductVariantPrice::all();
        return view('products.index')
            ->with('products', $products)
            ->with('variants', $variant)
            ->with('variantLists', $variantLists)
            ->with('productPrices', $productPrices);
    }
}
