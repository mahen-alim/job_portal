@if (session()->has('success'))
<div class="alert alert-success alert-dismissable d-flex justify-content-between" role="alert" id="successAlert">
    <p class="mb-0 pb-0">{{ session('success') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger alert-dismissable d-flex justify-content-between" role="alert" id="errorAlert">
    <p class="mb-0 pb-0">{{ session('error') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
