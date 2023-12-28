@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form action="" name="registrationForm" id="registrationForm">
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Name" >
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email" >
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password" >
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="confirm_password" name="confirmpassword" id="name" class="form-control"
                                    placeholder="please confirm Password" >
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="login.html">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $("#registrationForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('account.processRegistration') }}',
                type: 'post',
                data: $("#registrationForm").serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name)

                        }else{
                            $("#name").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html('')
                        }
                    }
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.email) {
                            $("#email").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email)

                        }else{
                            $("#email").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html('')
                        }
                    }
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.password) {
                            $("#password").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password)

                        }else{
                            $("#password").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html('')
                        }
                    }
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.confirmpassword) {
                            $("#name").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password)

                        }else{
                            $("#confirmpassword").addClass('is.invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html('')
                        }
                    }


                }

            })

        });
    </script>
@endsection