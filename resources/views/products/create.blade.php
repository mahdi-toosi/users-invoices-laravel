@extends('layouts.app')

@section('content')

<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header pt-3">
                <h5>ثبت محصول جدید</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="invoice_id" class="form-label">صورتحساب:</label>
                        <select id="invoice_id" name="invoice_id" class="form-control @error('invoice_id') is-invalid @enderror">
                            <option value="0" selected>انتخاب صورتحساب</option>
                        </select>
                        <x-form.form-error name="invoice_id" />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">نام محصول</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        <x-form.form-error name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">قیمت</label>
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        <x-form.form-error name="price" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description') }}</textarea>
                        <x-form.form-error name="description" />
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت محصول</button>
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
