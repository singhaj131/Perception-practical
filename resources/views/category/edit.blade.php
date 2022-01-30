@extends('layouts.master')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $item->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="category_name" class="col-sm-2">Category Name<span class="text-danger">*</span> :</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="category_name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" value="{{ $item->name ?? old('name') }}"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="is_parent" class="col-sm-2">Is Parent?:</label>
                <div class="col-sm-8">
                    <input type="checkbox" name="is_parent" value="1" id="is_parent" {{ $item->parent_category_id == null ? "checked" : '' }}> Yes
                </div>
            </div>
            <div id="parent_div" class="form-group row d-none">
                <label for="parent_category" class="col-sm-2">Parent Category:</label>
                <div class="col-sm-8">
                    <select name="parent_category_id" id="parent_category" class="form-controlform-control {{ $errors->has('parent_category_id') ? 'is-invalid' : ''}}">
                        <option value="">-- Select Any --</option>
                        @foreach($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}" {{ ($item->parent_category_id ?? old('parent_category_id')) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
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
<script>
    $(document).ready(function(){
        $('#is_parent').change();
    });
    $('#is_parent').change(function(){
        let isChecked = $(this).prop('checked');
        if(isChecked){
            $('#parent_category').val('').removeAttr('required');
            $('#parent_div').addClass('d-none');
        } else {
            $('#parent_div').removeClass('d-none');
            $('#parent_category').attr('required', 'required');
        }
    });
</script>
@endsection