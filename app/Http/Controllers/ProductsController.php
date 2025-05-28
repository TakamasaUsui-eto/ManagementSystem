<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductsController extends Controller {

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
    
    public function store(ProductRequest $request) {
        try {
            
            // バリデーションされたデータを取得
            $validated_data = $request->validated();

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
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            return redirect()->back()->withInput()->withErrors(['error' => '新規登録に失敗しました。']);
        }
    }

    public function update(ProductRequest $request, $id) {
        try {

            // バリデーションされたデータを取得
            $validated_data = $request->validated();

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
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            return redirect()->back()->withInput()->withErrors(['error' => '更新に失敗しました。']);
        }
    }

    public function destroy($id) {
        try {

            // 商品を削除
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            return redirect()->back()->withErrors(['error' => '削除に失敗しました。']);
        }
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