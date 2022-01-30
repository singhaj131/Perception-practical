@extends('layouts.master')
@section('styles')
<link href="{{ asset('system/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Category</h1>
<div class="row">
    <div class="col-12">
        <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm float-right mb-2">Add Category</a>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Category Code</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Category Code</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->category_code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->parent_category->name ?? '-' }}</td>
                        <td>
                            @if($item->deleted_at == null)
                            <a href="{{ route('categories.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button type="button" data-href="{{ route('categories.destroy', $item->id) }}"
                                class="btn btn-sm btn-danger btn-delete" data-toggle="modal"
                                data-target="#deleteModal">Delete</button>
                            @endif
                            @if($item->deleted_at != null)
                            <a href="{{ route('categories.restore', $item->id) }}"
                                class="btn btn-sm btn-secondary">Restore</a>

                            <a href="{{ route('categories.forceDelete', $item->id) }}"
                                onClick="return confirm('Please confirm deletion?')"
                                class="btn btn-sm btn-danger">Permanently Delete
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('system/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('system/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    // Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>
@endsection