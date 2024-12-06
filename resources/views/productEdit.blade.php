@extends('layout')
@section('title', 'Edit Product')
@section('content')

<div class="productCreate">
    <a class="btn btn-primary backbtn" href="{{url('/home')}}"> <- Back</a>
            <form class="form-horizontal">
                @csrf
                <fieldset>
                    <!-- Form Name -->
                    <legend> EDIT PRODUCTS</legend>


                    <!-- Text input-->
                    <div class="form-group">
                        <label class=" control-label" for="product_name">PRODUCT NAME</label>
                        <div class="">
                            <input id="product_name" name="product_name" placeholder="PRODUCT NAME"
                                class="form-control input-md" type="text" value="{{$product->product_name}}">
                        </div>
                        <span class="text-danger" id="product_nameErr"></span>
                    </div>



                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class=" control-label" for="product_categorie">PRODUCT CATEGORY</label>
                        <div class="">
                            <select id="product_categorie" name="product_categorie" class="form-control">
                                <option value=" ">Select</option>
                                <option value="male" {{ ($product->product_categorie == "male") ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ ($product->product_categorie == "female") ? 'selected' : '' }}>
                                    Female
                                </option>
                                <option value="kidsMale" {{ ($product->product_categorie == "kidsMale") ? 'selected' : '' }}>Kids
                                    Male</option>
                                <option value="kidsfemale" {{ ($product->product_categorie == "kidsfemale") ? 'selected' : '' }}>
                                    Kids Female</option>
                            </select>
                        </div>
                        <span class="text-danger" id="categorieErr"></span>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class=" control-label" for="available_quantity">AVAILABLE QUANTITY</label>
                        <div class="">
                            <input id="available_quantity" name="quantity" placeholder="AVAILABLE QUANTITY"
                                class="form-control input-md" type="text" value="{{$product->quantity}}">
                        </div>
                        <span class="text-danger" id="quantityErr"></span>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class=" control-label" for="product_description">PRODUCT DESCRIPTION</label>
                        <div class="">
                            <textarea class="form-control" id="product_description"
                                name="description">{{$product->description}}</textarea>
                        </div>
                        <span class="text-danger" id="descriptionErr"></span>

                    </div>

                    <div class="form-group">
                        <label class=" control-label" for="filebutton">Product Image</label>
                        <div>
                            <input id="filebutton" name="image" class="input-file" type="file"
                                value="{{$product->image}}">
                        </div>
                        <img src="/productImg/{{$product->image}}" class="proimg" id="img"/>
                        <span class="text-danger" id="imageErr"></span>
                    </div>



                    <!-- Button -->
                    <button id="button" name="singlebutton" type="submit" class="btn btn-primary">Update</button>

                </fieldset>

                <div id="loginAlert"></div>
            </form>
</div>



@endsection
@section('script')
<script>
    $(function () {
        $('#filebutton').on("change", function () {
            var input = this;
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        });
        function showError(name, message) {
            if (name == 'product_name') {
                $('#product_nameErr').text(message)
                $('#product_nameErr').show()
            }
            if (name == 'product_categorie') {
                $('#categorieErr').text(message)
                $('#categorieErr').show()
            }
            if (name == 'quantity') {
                $('#quantityErr').text(message)
                $('#quantityErr').show()
            } if (name == 'description') {
                $('#descriptionErr').text(message)
                $('#descriptionErr').show()
            } if (name == 'image') {
                $('#imageErr').text(message)
                $('#imageErr').show()
            }
        }

        function showMessage(sty, message) {
            $('#loginAlert').html(`<p class=${sty} id='error'><b>${message}</b></p>`)

        }

        $('.form-horizontal').submit(function (e) {
            e.preventDefault();
            // $('#error').remove()
            $('#product_nameErr').hide()
            $('#categorieErr').hide()
            $('#quantityErr').hide()
            $('#descriptionErr').hide()
            $('#imageErr').hide()
            let noErrors = true;
            let product_namePattern = /^[A-Za-z\s]{2,}$/
            let product_name = $('#product_name').val().trim();
            if (product_name == "") {
                showError('product_name', 'The product name field is required.')
                noErrors = false
            }
            else {
                if (!product_namePattern.test(product_name)) {
                    //  alert('not a valid e-mail address');
                    showError('product_name', 'Allows only Alphabets and Spaces, with a minimum length 2')
                    noErrors = false
                }

            }


            let product_categorie = $('#product_categorie').val().trim();
            if (product_categorie == "") {
                showError('product_categorie', 'The product categorie field is required.')
                noErrors = false

            }
            let quantityPatten = /^\d+$/
            let quantity = $('#available_quantity').val().trim();
            if (quantity == "") {
                // console.log('quantity')
                showError('quantity', 'The quantity field is required.')
                noErrors = false
            } else {
                if (!quantityPatten.test(quantity)) {
                    showError('quantity', "Invalid number")
                    // console.log("Valid number");
                    noErrors = false
                }
            }

            let descriptionPatten = /^.{5,}$/
            let description = $('#product_description').val().trim();

            if (description == "") {
                showError('description', 'The description field is required.')
                noErrors = false
            }
            else {
                if (!descriptionPatten.test(description)) {
                    // console.log("Valid input");
                    showError('description', 'Minimum 5 characters  required')
                    noErrors = false
                }
            }
            let update = false;
            var fileInput = $('#filebutton')[0];
            var file = fileInput.files[0];
            // let image = $('#filebutton').val().trim();
            if (file) {
                console.log('1')
                var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if ($.inArray(file.type, allowedTypes) === -1) {
                    showError('image', 'Only JPG, JPEG, PNG files are allowed.');
                    console.log('2')
                    noErrors = false

                }
                else {
                    update = true
                }
                var maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    console.log('3')
                    showError('image', 'File size should be less than 2MB.');
                    noErrors = false
                }
                else {
                    update = true
                }


            }

            if (product_name != '{{$product->product_name}}' ||
                product_categorie != '{{$product->product_categorie}}' ||
                quantity != '{{$product->quantity}}' || description != '{{$product->description}}') {
                update = true
            }
            else {
                console.log('ll')
                showMessage('text-danger', "No Changes Detected ")
            }



            if (noErrors && update) {
                // console.log(noErrors)
                $(`.form input[name='${name}']`).removeClass('error');
                // console.log('hia')
                var btn = $('#button');
                btn.prop('disabled', true);
                btn.text('Please wait...');
                // console.log($(".form-horizontal").serialize())
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('product.update', ['id' => $product->id]) }}',
                    method: 'post',
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function (res) {
                        // console.log(res)
                        btn.prop('disabled', false);
                        btn.text('Sign in');
                        if (res.status == 400) {
                            // console.log(res.message, res.message.email)
                            $.each(res.message, function (index, value) {
                                // console.log('Index: ' + index + ', Value: ' + value);
                                showError(index, value)
                            });
                        }
                        else if (res.status == 401) {
                            console.log(res.message)
                            showMessage('text-danger', res.message)
                        }
                        else {
                            if (res.status == 200 && res.message) {
                                // window.location = '{{route('home')}}'
                                showMessage('text-success', res.message)
                                // $('#product_name').val("")

                            }

                        }
                    }
                })
            }
        })
    })

</script>
@endsection