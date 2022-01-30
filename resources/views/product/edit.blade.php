@extends('layouts.master')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .image_block {
        position: relative;
    }

    .image_remove {
        position: absolute;
        top: 0;
        right: 0;
        height: 30px;
        width: 30px;
        background: rgba(245, 50, 50, 0.719);
        text-align: center;
        line-height: 30px;
        color: aliceblue;
    }
</style>
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('products.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="product_name" class="col-sm-2">Product Name<span class="text-danger">*</span> :</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="product_name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                        value="{{ $item->name ?? old('name') }}" required>
                </div>
            </div>
            <div id="parent_div" class="form-group row">
                <label for="category_id" class="col-sm-2">Category</label>
                <div class="col-sm-8">
                    <select name="category_id[]" id="category_id" class="form-control select2" multiple required>
                        <option value="">-- Select Any --</option>
                        @php
                        $keys = [];
                        foreach ($item->categories as $key => $value) {
                        array_push($keys, $value->pivot->category_id);
                        }
                        @endphp
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($keys) && in_array($category->id,$keys))selected
                            @endif>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="product_image" class="col-sm-2">Product Image :</label>
                <div class="col-sm-8">
                    <input type="file" name="product_image" id="product_image" class="{{ $errors->has('product_image') ? 'is-invalid' : ''}}" accept="image/*">
                    @if(isset($item) && $item->image!=null &&
                    file_exists(public_path().'/uploads/products/'.$item->image))
                    <div class="product_image image_block col-sm-4" style="margin-top:5px;">
                        <input type="hidden" name="old_image" value="{{ $item->image }}">
                        @error('product_image')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <img src="{{ $item->image_url }}" alt="Delivery Image" class="img-fluid">
                        <span class="image_remove" title="remove image"><i class="fa fa-times"></i></span>
                    </div>
                    @endif
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
        
        $('.image_remove').on('click', function(){
            $(this).parent().remove();
        });
    });
</script>
@endsection