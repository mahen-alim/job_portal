@extends('front.layouts.app')
@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                       @include('bread')
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('alert')
                <form method="POST" action="{{ route('account.updateProfile', ['id' => $profil->id]) }}" id="profileForm" name="profileForm">
                    @csrf
                    @method('PUT')
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="mb-4">
                                <label for="name" class="mb-2">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ old('name', $profil->name) }}">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ old('email', $profil->email) }}">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="designation" class="mb-2">Designation</label>
                                <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control" value="{{ old('designation', $profil->designation) }}">
                                <p class="invalid-feedback"></p>
                            </div>
                            <div class="mb-4">
                                <label for="mobile" class="mb-2">Mobile</label>
                                <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ old('mobile', $profil->mobile) }}">
                                <p class="invalid-feedback"></p>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>

@section('customJs')
<script>
    $(document).ready(function() {
        $("#profileForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'put',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Clear previous errors
                    $(".form-control").removeClass('is-invalid').siblings('p').empty();

                    if (response.status == false) {
                        var errors = response.errors;

                        // Set errors for each input field
                        $.each(errors, function(key, value) {
                            $("#" + key).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                        });
                    } else {
                        // Clear previous errors
                        $(".form-control").removeClass('is-invalid').siblings('p').empty();
                        
                        // Redirect to profile page if update is successful
                        window.location = '{{ route("front.account.profile") }}';

                    }
                }
            });
        });
    });
</script>

@endsection