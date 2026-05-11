<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $response = file_get_contents("https://fakestoreapi.com/products");
    $allProducts = json_decode($response);

    $categories = array_unique(array_map(fn($p) => $p->category, $allProducts));

    $products = $allProducts;

    if ($request->search) {
        $products = array_filter($products, function ($p) use ($request) {
            return str_contains(
                strtolower($p->title),
                strtolower($request->search)
            );
        });
    }

    if ($request->category) {
        $products = array_filter($products, function ($p) use ($request) {
            return $p->category == $request->category;
        });
    }

    if ($request->sort == 'price_asc') {
        usort($products, fn($a, $b) => $a->price <=> $b->price);
    }

    if ($request->sort == 'price_desc') {
        usort($products, fn($a, $b) => $b->price <=> $a->price);
    }

    return view('products', [
        'products' => $products,
        'categories' => $categories
    ]);
}
}
