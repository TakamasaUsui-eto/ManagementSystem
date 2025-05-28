<head>
    <link rel="stylesheet" type="text/css" href="../../../public/css/style.css">
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">{{ __('商品情報編集画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="{{ $product->id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('商品名') }}<span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name', $product->product_name) }}">

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">{{ __('メーカー名') }}<span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('価格') }}<span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="price" type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">{{ __('在庫数') }}<span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="stock" type="number" min="0" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}">

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('コメント') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment">{{ old('comment', $product->comment) }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('商品画像') }}</label>

                            <div class="col-md-6">
                                <div class="custom-file">
                                    <label for="form-image" class="customFileLabel">ファイルを選択</label>
                                    <input id="form-image" type="file" class="custom-file-input @error('img_path') is-invalid @enderror" name="img_path" style="display: none">
                                    <span class="select_image" >
                                        @if($product->img_path)
                                            {{ basename($product->img_path) }}
                                        @else
                                            選択されていません
                                        @endif
                                    </span>

                                    @error('img_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('更新') }}
                                </button>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">
                                    {{ __('戻る') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection