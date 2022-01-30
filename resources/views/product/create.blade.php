@extends('layouts.master')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="category_name" class="col-sm-2">Product Name<span class="text-danger">*</span> :</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="category_name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" value="{{ old('name') }}"
                        required>
                    @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div id="parent_div" class="form-group row">
                <label for="category_id" class="col-sm-2">Category<span class="text-danger">*</span> :</label>
                <div class="col-sm-8">
                    <select name="category_id[]" id="category_id" class="form-control select2" multiple required>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="product_image" class="col-sm-2">Product Image :</label>
                <div class="col-sm-8">
                    <input type="file" name="product_image" id="product_image"
                        class="{{ $errors->has('product_image') ? 'is-invalid' : ''}}" accept="image/*">
                    @error('product_image')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8 offset-sm-2">
                    <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#category_id").select2({
            placeholder: "-- Select Category --",
            width: 'resolve',
        });
    });
</script>
@endsection