<head>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">{{ __('商品一覧画面') }}</div>
            </div>

            <div>
            <form action="{{ route('products.index') }}" method="GET">
                <input type="text" name="search" value="{{ old('search') }}" placeholder="検索キーワード">
                    <select name="maker">
                        <option value="">メーカー名</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                <input type="submit" value="検索">
            </form>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th>
                                    <a href="{{ route('products.create') }}" class="btn btn-warning">
                                        {{ __('新規登録') }}
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="FromControl">
                                    <td>{{ $product->id }}</td>
                                    <td><img src="{{ $product->img_path }}" alt="" class="Image"  onerror="this.style.display='none'"></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}円</td>
                                    <td>{{ $product->stock }}個</td>
                                    <td>{{ $product->company->company_name }}</td>
                                    <td class="button-group">
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <button type="submit" class="btn btn-primary">詳細</button>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="Pagination">
                        {{ $products->links('pagination::default', ['prev_next' => false, 'showPerPage' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection