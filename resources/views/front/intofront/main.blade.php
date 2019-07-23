<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Умная дача</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('modal/css/common.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/datepicker.min.css')}}">
</head>

<body class="d-flex flex-column">
    @component('front.intofront.header')
    @endcomponent

    @component('front.intofront.content')
    @endcomponent

    @component('front.footer')
    @endcomponent


    @section('script')
        <script src="{{asset('js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/slick.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.formstyler.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    @show

    <script>
        $( document ).ready(function() {
            $('#send').on('click', function(e){
                e.preventDefault();
                let mail = $('#mail-form').val();
                let mess = $('#mess-form').val();
                let rate = $('#rate').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/feedback') }}",
                    data: {mail: mail,mess: mess, rate: rate ,_token: '{{csrf_token()}}'},
                    success: function(){
                        $('#sendmessage').show();
                    }
                });
            });
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>