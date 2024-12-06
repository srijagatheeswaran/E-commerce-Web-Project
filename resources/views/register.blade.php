@extends('layout')
@section('title', 'Add Admin')
@section('content')

<!-- <div class="container">
    <div class="mt-5">
         -->

<!-- <div class="alert alert-success">{{session('success')}}</div> -->
<!-- </div>

</div> -->
<div class="loginBox">
    <h1>Create Admin</h1>
    <!-- action="{{route('login.post')}}" method="POST" -->
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

    </form>
</div>

@endsection
@section('script')
<script>
    $(function () {
        function showError(name, message) {
            if(name=='name'){
                $('#nameerr').text(message)
                $('#nameerr').show()
            }
            else if (name == 'email') {
                $('#emailerr').text(message)
                $('#emailerr').show()
            }
            else if (name == 'password'){
                    $('#passworderr').text(message)
                    $('#passworderr').show() 
            }
            else if (name == 'repassword'){
                    $('#repassworderr').text(message)
                    $('#repassworderr').show() 
            }
        }
        function showMessage(sty, message) {
            $('#loginAlert').html(`<p class=${sty} id='error'><b>${message}</b></p>`)

        }
        $('.form').submit(function (e) {
            $('#error').remove()
            $('#nameerr').hide()
            $('#repassworderr').hide()
            $('#emailerr').hide()
            $('#passworderr').hide()
            $(`.form input[name='${name}']`).removeClass('error');
            e.preventDefault();
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
                        $.map(res.message, function (value,index) {
                            if(index=='name'){
                                showError('name', value)
                            }
                            else if(index=='email'){
                                showError('email', value)
                            }
                            else if(index=='password'){
                                showError('password', value)
                            }else if(index=='repassword'){
                                showError('repassword', value)
                            }
                        
                        });
                    }

                    else {
                        if (res.status == 200 && res.message == "registered successfully") {
                            showMessage('text-success',res.message)
                        }

                    }
                }
            })
        })
    })

</script>

@endsection