<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Anil z" name="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Shopwise is Powerful features and You Can Use The Perfect Build this Template For Any eCommerce Website. The template is built for sell Fashion Products, Shoes, Bags, Cosmetics, Clothes, Sunglasses, Furniture, Kids Products, Electronics, Stationery Products and Sporting Goods.">
    <meta name="keywords"
        content="ecommerce, electronics store, Fashion store, furniture store,  bootstrap 4, clean, minimal, modern, online store, responsive, retail, shopping, ecommerce store">

    <!-- SITE TITLE -->
    <title>Shop</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/clients/images/favicon.png') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/animate.css') }}">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/simple-line-icons.css') }}">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ asset('assets/clients/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/magnific-popup.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/slick-theme.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/responsive.css') }}">

</head>

<body>
    @include('sweetalert::alert')
    <div id="thongbao"></div>
    <!-- LOADER -->
    {{-- <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div> --}}
    <!-- END LOADER -->


    <!-- START HEADER -->
    @include('clients.blocks.header')
    <!-- END HEADER -->



    <!-- END MAIN CONTENT -->
    <div class="main_content">
        @yield('content')
    </div>
    <!-- END MAIN CONTENT -->

    <!-- START FOOTER -->
    @include('clients.blocks.footer')
    <!-- END FOOTER -->

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

    <!-- Latest jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- popper min js -->
    <script src="{{ asset('assets/clients/js/popper.min.js') }}"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="{{ asset('assets/clients/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- owl-carousel min js  -->
    <script src="{{ asset('assets/clients/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <!-- magnific-popup min js  -->
    <script src="{{ asset('assets/clients/js/magnific-popup.min.js') }}"></script>
    <!-- waypoints min js  -->
    <script src="{{ asset('assets/clients/js/waypoints.min.js') }}"></script>
    <!-- parallax js  -->
    <script src="{{ asset('assets/clients/js/parallax.js') }}"></script>
    <!-- countdown js  -->
    <script src="{{ asset('assets/clients/js/jquery.countdown.min.js') }}"></script>
    <!-- imagesloaded js -->
    <script src="{{ asset('assets/clients/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- isotope min js -->
    <script src="{{ asset('assets/clients/js/isotope.min.js') }}"></script>
    <!-- jquery.dd.min js -->
    <script src="{{ asset('assets/clients/js/jquery.dd.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('assets/clients/js/slick.min.js') }}"></script>
    <!-- elevatezoom js -->
    <script src="{{ asset('assets/clients/js/jquery.elevatezoom.js') }}"></script>
    <!-- scripts js -->
    <script src="{{ asset('assets/clients/js/scripts.js') }}"></script>
    <script>
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
