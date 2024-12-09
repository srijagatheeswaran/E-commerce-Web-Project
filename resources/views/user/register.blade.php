@extends('layout')
@section('title', 'Register')
@section('content')

<!-- <div class="container">
    <div class="mt-5">
         -->

<!-- <div class="alert alert-success">{{session('success')}}</div> -->
<!-- </div>

</div> -->
<div class="loginBox">
    <h1>Register</h1>

    <form class="form">
        @csrf
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" class="form-control" name="name" />
            <span class="text-danger" id="nameerr"></span>
        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email address</label>
            <input type="text" id="email" class="form-control" name="email" />
            <span class="text-danger" id="emailerr"></span>
        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="mobile_number">Mobile Number </label>
            <input type="text" id="mobile_number" class="form-control" name="mobile_number" />
            <span class="text-danger" id="mobile_numbererr"></span>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" class="form-control" name="password" />
            <span class="text-danger" id="passworderr"></span>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="repassword">Confirm Password</label>
            <input type="password" id="repassword" class="form-control" name="repassword" />
            <span class="text-danger" id="repassworderr"></span>
        </div>



        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
            id="loginbtn">Sign
            Up</button>
        <div id="loginAlert"></div>
        <div class="link">
            <span>I Already Have An Account <a href="{{route('login')}}">click</a></span>

        </div>

    </form>
</div>

@endsection
@section('script')
<script>
    $(function () {
        function showError(name, message) {
            if (name == 'name') {
                $('#nameerr').text(message)
                $('#nameerr').show()
            }
            else if (name == 'email') {
                $('#emailerr').text(message)
                $('#emailerr').show()
            }
            else if (name == 'mobile_number') {
                $('#mobile_numbererr').text(message)
                $('#mobile_numbererr').show()
            }
            else if (name == 'password') {
                $('#passworderr').text(message)
                $('#passworderr').show()
            }
            else if (name == 'repassword') {
                $('#repassworderr').text(message)
                $('#repassworderr').show()
            }
        }
        function showMessage(sty, message) {
            $('#loginAlert').html(`<p class=${sty} id='error'><b>${message}</b></p>`)

        }
        $('.form').submit(function (e) {
            e.preventDefault();
            $('#error').remove()
            $('#nameerr').hide()
            $('#repassworderr').hide()
            $('#emailerr').hide()
            $('#passworderr').hide()
            $('#mobile_numbererr').hide()

            $(`.form input[name='${name}']`).removeClass('error');

            let errors = true
            let nameval = $('#name').val().trim()
            let namePattern = /^[A-Za-z\s]{2,}$/
            // console.log(email)
            if (nameval == "") {
                // console.log('mo')
                console.log('hao')
                showError('name', 'name is required!')
                errors = false
            } else {
                if (!namePattern.test(nameval)) {
                    //  alert('not a valid e-mail address');
                    showError('name', 'Allows only Alphabets and Spaces, with a minimum length 2')
                    errors = false
                }

            }
            let email = $('#email').val().trim()
            let emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            // console.log(email)
            if (email == "") {
                // console.log('mo')
                showError('email', 'Email is required!')
                errors = false
            } else {
                if (!emailPattern.test(email)) {
                    //  alert('not a valid e-mail address');
                    showError('email', 'Not a valid e-mail address!')
                    errors = false
                }

            }

            let mobile_number = $('#mobile_number').val().trim()
            let mobile_numberPattern = /^\d{10}$/
            // console.log(email)
            if (mobile_number == "") {
                // console.log('mo')
                showError('mobile_number', 'Mobile Number is required!')
                errors = false
            } else {
                if (!mobile_numberPattern.test(mobile_number)) {
                    //  alert('not a valid e-mail address');
                    showError('mobile_number', 'Not a valid Mobile Number( must have 10 digits)!')
                    errors = false
                }

            }
            let password = $('#password').val().trim();
            let passwordPatten = /^.{6,}$/;

            if (password == "") {
                // console.log('mo')
                showError('password', 'password is required!')
                errors = false
            } else {

                if (!passwordPatten.test(password)) {
                    //  alert('not a valid e-mail address');
                    showError('password', 'Minimum 6 characters!')
                    errors = false
                }
            }
            let repassword = $('#repassword').val().trim();

            if (repassword == "") {
                // console.log('mo')
                showError('repassword', 'Confirm Password is required!')
                errors = false
            } else {
                if (repassword != password) {
                    //  alert('not a valid e-mail address');
                    showError('repassword', 'Confirm Password not match password!')
                    errors = false
                }
            }
            if (errors) {
                // console.log('hia')
                var btn = $('#loginbtn');
                btn.prop('disabled', true);
                btn.text('Please wait...');
                $.ajax({
                    url: '{{route("register.post")}}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        console.log(res)
                        btn.prop('disabled', false);
                        btn.text('Sign Up');
                        if (res.status == 400) {
                            console.log(res.message)
                            $.map(res.message, function (value, index) {
                                if (index == 'name') {
                                    showError('name', value)
                                }
                                else if (index == 'email') {
                                    showError('email', value)
                                }
                                else if (index == 'mobile_number') {
                                    showError('mobile_number', value)
                                }
                                else if (index == 'password') {
                                    showError('password', value)
                                } else if (index == 'repassword') {
                                    showError('repassword', value)
                                }

                            });
                        }

                        else {
                            if (res.status == 200 && res.message == "registered successfully") {
                                showMessage('text-success', res.message)
                                $('#name').val('');
                                $('#email').val('');
                                $('#mobile_number').val('');
                                $('#password').val('');
                                $('#repassword').val('');
                            }
                        }
                    }
                })
            }
        })
    })

</script>

@endsection