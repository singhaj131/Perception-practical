@if (session('success'))
<div class="alert alert-success alert-bordered alert-dismissable fade show" role="alert">
    <button class="close" data-dismiss="alert" aria-label="close">
        X
    </button>
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-bordered alert-dismissable fade show" role="alert">
    <button class="close" data-dismiss="alert" aria-label="close">
        X
    </button>
    {{ session('error') }}
</div>
@endif
@if (session('warning'))
<div class="alert alert-warning alert-bordered alert-dismissable fade show" role="alert">
    <button class="close" data-dismiss="alert" aria-label="close">
        X
    </button>
    {{ session('warning') }}
</div>
@endif