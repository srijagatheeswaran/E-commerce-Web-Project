@extends('layout')
@section('title', 'Create Products')
@section('content')

<div class="productCreate">
    <form class="form-horizontal" >
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend>PRODUCTS</legend>


            <!-- Text input-->
            <div class="form-group">
                <label class=" control-label" for="product_name">PRODUCT NAME</label>
                <div class="">
                    <input id="product_name" name="product_name" placeholder="PRODUCT NAME"
                        class="form-control input-md" type="text">

                </div>
            </div>



            <!-- Select Basic -->
            <div class="form-group">
                <label class=" control-label" for="product_categorie">PRODUCT CATEGORY</label>
                <div class="">
                    <select id="product_categorie" name="product_categorie" class="form-control">
                        <option value=" ">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="kidsMale">Kids Male</option>
                        <option value="kidsfemale">Kids Female</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class=" control-label" for="available_quantity">AVAILABLE QUANTITY</label>
                <div class="">
                    <input id="available_quantity" name="quantity" placeholder="AVAILABLE QUANTITY"
                        class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class=" control-label" for="product_description">PRODUCT DESCRIPTION</label>
                <div class="">
                    <textarea class="form-control" id="product_description" name="description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label" for="filebutton">Product Image</label>
                <div>
                    <input id="filebutton" name="image" class="input-file" type="file">
                </div>
            </div>



            <!-- Button -->
            <button id="button" name="singlebutton" type="submit" class="btn btn-primary">create</button>

        </fieldset>
    </form>
</div>



@endsection
@section('script')
<script>
    $(function () {
        // function showError(name, message) {
        //     if (name == 'email' && name == 'password') {
        //         $('#emailerr').text(message)
        //         $('#emailerr').show()
        //         $('#passworderr').text(message)
        //         $('#passworderr').show()
        //     }
        //     else {
        //         if (name == 'email') {
        //             $('#emailerr').text(message)
        //             $('#emailerr').show()

        //         } else {
        //             $('#passworderr').text(message)
        //             $('#passworderr').show()
        //         }
        //     }
        // }
        // function showMessage(sty,message){
        //     $('#loginAlert').html(`<p class=${sty} id='error'><b>${message}</b></p>`)

        // }
        $('.form-horizontal').submit(function (e) {
            // $('#error').remove()
            // $('#emailerr').hide()
            // $('#passworderr').hide()
            // $(`.form input[name='${name}']`).removeClass('error');
            e.preventDefault();
            // console.log('hia')
            var btn = $('#button');
            btn.prop('disabled', true);
            btn.text('Please wait...');
            console.log($(".form-horizontal").serialize())
            $.ajax({
                url: '{{route('product.create')}}',
                method: 'post',
                data: $(".form-horizontal").serialize(),
                dataType: 'json',
                success: function (res) {
                    console.log(res)
                    btn.prop('disabled', false);
                    btn.text('Sign in');
                    if (res.status == 400) {
                        console.log(res.message, res.message.email)
                        if (res.message.email && res.message.password) {
                            showError('email', res.message.email)
                            showError('password', res.message.password)
                        }
                        else {
                            if (res.message.email) {
                                showError('email', res.message.email)
                            } else if (res.message.password) {
                                showError('password', res.message.password)
                            }
                        }
                    }
                    else if (res.status == 401) {
                        console.log(res.message)
                        showMessage('text-danger', res.message)
                    }
                    else {
                        if (res.status == 200 && res.message == "success") {
                            window.location = '{{route('home')}}'
                        }

                    }
                }
            })
        })
    })

</script>
@endsection