<head>
    <link rel="stylesheet" type="text/css" href="../../../public/css/style.css">
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報詳細') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>商品画像</th>
                            <td><img src="{{ asset($product->img_path) }}" alt="" class="Image" onerror="this.style.display='none'"></td>
                        </tr>
                        <tr>
                            <th>商品名</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>メーカー</th>
                            <td>{{ $product->company->company_name }}</td>
                        </tr>
                        <tr>
                            <th>価格</th>
                            <td>{{ $product->price }}円</td>
                        </tr>
                        <tr>
                            <th>在庫数</th>
                            <td>{{ $product->stock }}個</td>
                        </tr>
                        <tr>
                            <th>コメント</th>
                            <td>{{ $product->comment }}</td>
                        </tr>
                    </table>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                {{ __('編集') }}
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                {{ __('戻る') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection