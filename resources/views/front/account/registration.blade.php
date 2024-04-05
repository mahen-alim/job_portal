@extends('front.layouts.app')
@section('content')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="{{ route('account.processRegistration') }}" name="registrationForm" id="registrationForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p class="invalid-feedback"></p>
                        </div> 
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p class="invalid-feedback"></p>
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            <p class="invalid-feedback"></p>
                        </div> 
                        <div class="mb-3">
                            <label for="confirm_password" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please Confirm Password">
                            <p class="invalid-feedback"></p>
                        </div> 
                        <button type="submit" class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a href="{{ route("account.login") }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $(document).ready(function() {
        $("#registrationForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
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

                        // Redirect to login page if registration is successful
                        window.location = '{{ route("account.login") }}';
                    }
                }
            });
        });
    });
</script>


@endsection
