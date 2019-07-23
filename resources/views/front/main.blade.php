<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Умная дача</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/common.css')}}">

</head>

<body class="d-flex flex-column">

    @component('front.header')
    @endcomponent


        @component('front.content')
        @endcomponent

        @yield('form')



    @component('front.footer')
    @endcomponent

    @section('script')
        <script src="{{asset('js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/slick.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.formstyler.min.js')}}" type="text/javascript"></script>

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

           $('.sc-learningpage-article-help-link').on('click',function(e){
               event.preventDefault();
               console.log('work');
               $('#myfond_gris').fadeIn(300);
               var iddiv = $(this).attr("iddiv");
               $('#'+iddiv).fadeIn(300);
               $('#myfond_gris').attr('opendiv',iddiv);
               return false;
             //  alert("Реквизиты");
           })
            $('#myfond_gris, .close_modal').click(function()
            {
                console.log("not works");
                var iddiv = $("#myfond_gris").attr('opendiv');
                $('#myfond_gris').fadeOut(300);
                $('#'+iddiv).fadeOut(300);
            });

        })
    </script>
</body>
</html>