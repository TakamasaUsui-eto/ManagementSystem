<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductsController extends Controller
{
    
    public function index(Request $request) {
        $search = $request->input('search');
        $maker = $request->input('maker');
    
        $products = Product::query();
    
        if (!empty($search)) {
            $products = $products->where('product_name', 'like', "%{$search}%");
        }
    
        if (!empty($maker)) {
            $products = $products->where('company_id', $maker);
        }
    
        $products = $products->paginate(10)->appends(['search' => $search, 'maker' => $maker]);
    
        $companies = Company::all();
    
        return view('products.index', compact('products', 'companies'));
    }

    public function create() {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }
    
    public function store(Request $request) {
        // フォームデータのバリデーション
        $validated_data = $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'nullable','img_path' => 'nullable|image|max:2048'
        ]);

        // 新しい商品インスタンスを作成
        $product = new Product();
        $product->product_name = $validated_data['product_name'];
        $product->company_id = $validated_data['company_id'];
        $product->price = $validated_data['price'];
        $product->stock = $validated_data['stock'];
        $product->comment = $validated_data['comment'];

        // 画像パスを保存
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $image_name = '../../images/' . $image->getClientOriginalName();
            $product->img_path = $image_name;
        }

        // 商品をデータベースに保存
        $product->save();

        // 商品一覧ページにリダイレクト
        return redirect()->route('products.index');
    }

    public function update(Request $request, $id) {
        // フォームデータのバリデーション
        $validated_data = $request->validate([
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'nullable',
            'img_path' => 'nullable',
        ]);

        // 商品インスタンスを取得
        $product = Product::find($id);

        // 商品情報を更新
        $product->product_name = $validated_data['product_name'];
        $product->company_id = $validated_data['company_id'];
        $product->price = $validated_data['price'];
        $product->stock = $validated_data['stock'];
        $product->comment = $validated_data['comment'];

        // 画像パスを更新
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $image_name = '../../images/' . $image->getClientOriginalName();
            $product->img_path = $image_name;
        }

        // 商品をデータベースに保存
        $product->save();

        // 自画面にリダイレクト
        return redirect()->back();
    }

    public function destroy($id) {

        // 商品を削除
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function show($id) {

        // 商品詳細を取得
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    // app/Http/Controllers/ProductsController.php
    public function edit($id) {

        // 商品情報を取得
        $product = Product::find($id);
        $companies = \App\Models\Company::all();
        return view('products.edit', ['product' => $product, 'companies' => $companies]);
    }

}