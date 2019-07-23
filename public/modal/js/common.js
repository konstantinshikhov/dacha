

  $(document).ready(function(){
jQuery.exists = function(selector) {
   return ($(selector).length > 0);
}

if ($.exists('.sc-slider-popular-container')) {
      $('.sc-slider-popular-container').slick({
          infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<div class="slick-arrow slick-prev "></div>',
        nextArrow: '<div class="slick-arrow slick-next "></div>',
        });

    };

    


    if ($.exists('.slider-empty-personal-info')) {
    $('.slider-empty-personal-info').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<div class="slick-arrow slick-prev "></div>',
      nextArrow: '<div class="slick-arrow slick-next "></div>',
    });
  };
  if ($.exists('.sc-slider-decorator')) {
    $('.sc-slider-decorator').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<div class="slick-arrow slick-prev "></div>',
      nextArrow: '<div class="slick-arrow slick-next "></div>',
    });
  };



    /*------------слайдер евент--------*/
    if ($.exists('.sc-slider-event')) {
    $('.sc-slider-event').slick({
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      arrows:false,
      
      });
    }
    /*------стиль селект---------*/
    $('select').styler();
    $('.form-control-info1').styler('destroy');

    /*-----------меню мобильное------------*/
    if ($.exists('.sc-header-menu-btn')) {
    $('.sc-header-menu-btn').click(function() {
        if ($('.sc-mobile-menu-section').hasClass('d-none')) {
            $('.sc-mobile-menu-section').removeClass('d-none')

        }
    });
    $('.apc-button-close-mobile').click(function() {

        $('.sc-mobile-menu-section').addClass('d-none')

    });
  };
    /*---------------галерея фото-------------------*/


    if ($.exists('.sc-foto-gallery-element-additional-foto')) {
      let scMainFoto= $('.sc-foto-gallery-element-main-foto');
      let scAdditionalFoto= $('.sc-foto-gallery-element-additional-foto');
      /*задаем первое фото главным*/
      scMainFoto.attr("style", scAdditionalFoto[0].getAttribute("style"));
      /*по клику меняем фото*/
      scAdditionalFoto.click(function(event) {
        var currentStyle = event.target.getAttribute("style");
        scMainFoto.attr("style", currentStyle);
      
    });
    };
    
    /*------добавление новых полей  место продажи---------*/
    var nevElementInput = $('#sc-input-more-place-container input:first');
    if ($.exists(nevElementInput)) {
      
      $('.sc-btn-add-place').click(function(event) {
        var inputLenght  = $('#sc-input-more-place-container input').length;
        var inputContainer = $('#sc-input-more-place-container');
      event.preventDefault();
      nevElementInput.clone().appendTo( "#sc-input-more-place-container" );
      
      if(inputLenght ===4)
        {
          inputContainer.addClass("sc-input-overflow-scroll");
      }
      });
    };
    /*--------------лунный календарь кнопка рекомендуеться/не-------------------*/

        if ($.exists('.sc-menu-moon-recommend')) {
            var scMoonBtn = $('.sc-menu-moon-recommend')
            scMoonBtn.click(function(event) {
              scMoonBtn.toggleClass("no-recommend");
              if (scMoonBtn.hasClass("no-recommend")) {
                scMoonBtn.text('не рекомендуется');
              }
              else {
                scMoonBtn.text('рекомендуется');
              }
            });

            };
/*--------------уведомления, свернуть, развернуть-------------------*/

        if ($.exists('.sc-notification-btn-more')) {
            
            $('.sc-notification-btn-more-container').click(function(event) {
              event.preventDefault();
              var elementParent=event.target.parentNode;
              var element=event.target;

              if ($(element).hasClass('sc-notification-btn-more')) {
                  $(element).toggleClass("active");
              if ($(element).hasClass("active")) {
                $(element).children(".notification-btn-text").text('Свернуть');
              }
              else {
                $(element).children(".notification-btn-text").text('Развернуть');
              }
            }
            else {
              $(elementParent).toggleClass("active");
              if ($(elementParent).hasClass("active")) {
                $(elementParent).children(".notification-btn-text").text('Свернуть');
              }
              else {
                $(elementParent).children(".notification-btn-text").text('Развернуть');
              }
            }
            });

            };
/*--------------всплывающее окно добавление новой позиции-------------------*/

        if ($.exists('#mw-search-input')) {
           $('#mw-search-input').keyup(function(){
            let Value = $('#mw-search-input').val();
            $('.searchcontent1').text(Value)
            });


           
          $('#mw-quantity').keyup(function(){
            let Value = $('#mw-quantity').val();
            $('.content-quantity').text(Value)
            });

          $('#mw-price').keyup(function(){
            let Value = $('#mw-price').val();
            $('.content-price').text(Value)
            });


                   
          $("#mw-type-select").change(function(){
              let Value = $(this).val();
              $('.mw-type-select').text(Value)
          });

          $("#mw-category-select").change(function(){
              let Value = $(this).val();
              $('.mw-category-select').text(Value)
          });
          $("#mw-characteristic-select").change(function(){
              let Value = $(this).val();
              $('.mw-characteristic-select').text(Value)
          });
          $("#mw-unit").change(function(){
              let Value = $(this).val();
              $('.mw-unit').text(Value)
          });


          }
});