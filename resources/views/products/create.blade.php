@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品新規登録画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('商品名') }}<span style="color: red">*</span></label>

                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" autocomplete="product_name" autofocus required>

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
                                <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" required>
                                        <option hidden value="">メーカー名を選択してください</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
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
                                <input id="price" type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" required>

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
                                <input id="stock" type="number" min="0" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" autocomplete="stock" required>

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
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" autocomplete="comment">{{ old('comment') }}</textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img_path" class="col-md-4 col-form-label text-md-end">{{ __('商品画像') }}</label>

                            <div class="col-md-6">
                                <input id="img_path" type="file" class="form-control @error('img_path') is-invalid @enderror" name="img_path" autocomplete="img_path">

                                @error('img_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('新規登録') }}
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
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