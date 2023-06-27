@extends('layouts.app')

@section('content')
<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header pt-3">
                <h5>بروزرسانی محصول</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" id="form">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="invoice_id">صورتحساب:</label>
                        <select id="invoice_id" name="invoice_id" class="form-control @error('invoice_id') is-invalid @enderror">
                            <option value="{{ $product->invoice_id }}" selected>{{ $product->invoice->name }}</option>
                        </select>
                        <x-form.form-error name="invoice_id" />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">نام محصول</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',  $product->name) }}">
                        <x-form.form-error name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">قیمت</label>
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                        <x-form.form-error name="price" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea name="description"  class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $product->description) }}</textarea>
                        <x-form.form-error name="description" />
                    </div>
                    <button type="submit" class="btn btn-primary">ویرایش محصول</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#invoice_id').select2({
            ajax: {
                url: '/invoices/search',
                data: function (params) {
                    console.log(params)
                    return {
                        search: params.term,
                        type: 'public'
                    };
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                },
            }
        });
    });
</script>
@endsection
