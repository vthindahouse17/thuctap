

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon"
        href="https://scontent.fhan14-1.fna.fbcdn.net/v/t39.30808-6/291746184_769150660950106_9022025498033681382_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=tR1lQVhHFa8AX9uy8Xi&tn=D7p54ZetywhaBBwA&_nc_ht=scontent.fhan14-1.fna&oh=00_AT_hze_CJRwfkb1_EgSvXI8UXvhbmKbSP84cbclCGPfYaw&oe=62DC17E8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://fonts.adobe.com/fonts/poppins#details-section+poppins-thin"> -->
    <link rel="stylesheet" href="https://www.dafontfree.net/playfair-display-bold/f59120.html">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--Notify-->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>

    <title> COZA STORE_MC </title>
    @yield('css')
    <style>
        a {
            text-decoration: none;
        }
    </style>

<body>
    @include('sweetalert::alert')
    <div id="thongbao"></div>
    <div id="app">





        @include('clients.blocks.header')


        <div id="main" class="container-fluid p-0 w-100">

            @yield('content')

        </div>


        @include('clients.blocks.footer')



    </div>


    <script src="{{ asset('assets/clients/js/main.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script>
        AOS.init();

        $(function() {
            var cartcount = "{{ route('cart.count') }}";
            var cartadd = "{{ route('cart.add') }}";
            var cartchange = "{{ route('cart.change') }}";
            var cartchangeQty = "{{ route('cart.changeQty') }}";
            $(".addItemBtn2").click(function(e) {
                e.preventDefault(); // ngừng reload
                var $el = $(this).closest('body');
                var $form = $(this).closest(".form-submit");
                // var uid = $form.find(".uid").val();
                var pid = $form.find(".pid").val();
                var pname = $form.find(".pname").val();
                var pprice = $form.find(".pprice").val();
                var pimage = $form.find(".pimage").val();
                var pqty = $form.find(".pqty").val();
                var qty = $el.find(".itemQty2").val();
                $.ajax({
                    url: cartadd,
                    method: 'POST', // Change method to POST
                    data: {
                        pid: pid,
                        pname: pname,
                        pprice: pprice,
                        pqty: pqty,
                        pimage: pimage,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                        load_cart_item_number();
                    },
                    complete: function() {
                        $.ajax({
                            url: cartchange,
                            method: 'POST', // Change method to POST
                            data: {
                                qty: qty,
                                pid: pid,
                                pprice: pprice,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $("#thongbao").html(response);
                            }
                        });
                    }
                });

            });

            // Change the item quantity
            $(".itemQty").on('change', function() {
                var $el = $(this).closest('tbody');
                var pid = $el.find(".pid").val();
                var pprice = $el.find(".pprice").val();
                var procid = $el.find(".procid").val();
                var qty = $el.find(".itemQty").val();
                // location.reload(true);
                $.ajax({
                    url: cartchangeQty,
                    method: 'post',
                    cahce: 'false',
                    data: {
                        qty: qty,
                        pid: pid,
                        procid: procid,
                        pprice: pprice,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                        $("#thongbao").html(response);
                        location.reload(true);
                    }
                });
            });
            // Load total no.of items added in the cart and display in the navbar
            if ($("#cart-item").hasClass("amount")) {
                load_cart_item_number();
                function load_cart_item_number() {
                    $.ajax({
                        url: cartcount,
                        method: 'get',
                        dataType: 'json',
                        data: {
                            cartItem: "cart_item"
                        },
                        success: function(response) {
                            $("#cart-item").html(response);
                        }
                    });
                }
            }
        });

        // A $( document ).ready() block.
        $(document).ready(function() {
            $("#showToast").click(function() {
                $('.toast').toast({
                    'animation': true,
                    'autohide': false
                });
                $('.toast').toast('show');
            });
        });
    </script>
    @yield('js')
</body>

</html>
