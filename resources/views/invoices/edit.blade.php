@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Create Invoice</h1>
</div>

<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('invoices.update', $invoice) }}" method="POST" id="form">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="user_id">User:</label>
                        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="{{ $invoice->user_id }}" selected>{{ $invoice->user->full_name }}</option>
                        </select>
                        <x-form.form-error name="user_id" />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $invoice->name) }}">
                        <x-form.form-error name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" id="date" name="date" class="form-control date @error('date') is-invalid @enderror" value="{{ old('date', jdate($invoice->date)->format('Y/m/d')) }}" data-jdp>
                        <x-form.form-error name="date" />
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Invoice</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#user_id').select2({
            ajax: {
                url: '/users/search',
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
                                text: item.full_name
                            }
                        })
                    };
                },
            }
        });
    });
</script>
@endsection
