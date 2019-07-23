

  $(document).ready(function(){
jQuery.exists = function(selector) {
   return ($(selector).length > 0);
}
if($.exists('#load_photo')){
    alert("Фотография загружена");
    $("#load_photo").remove();
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
               var selected_option = $("#mw-type-select option:selected").val();
               if(selected_option != 'Выберите тип'){
                   var Value = $('#mw-search-input').val();
                    $.post('ajax-getname-culture-or-chemicals',{type:selected_option,name:Value},function(data){
                    console.log(data);
                        //  var items = [];
                      // $.each(data,function(index,value){
                      //   console.log(value.name);
                      //
                      // })
                      // var name = data;
                        $(".search_result").html(data).fadeIn();
                        // console.log(name[0].id);
                      // console.log(data);
                    })
               }else{
                   alert("Сначала выберите тип");
               }
              // console.log(selected_option);



            $('.searchcontent1').text(Value);
            });
            $(".search_result").hover(function(){
                $(".who").blur(); //Убираем фокус с input
            });
            //При выборе результата поиска, прячем список и заносим выбранный результат в input
            $(".search_result").on("click", "li", function(){
                name_prod = $(this).text();
                id_item = $(this).attr('data-id');
                $("#name_product").val(id_item);
                $(".who").val(name_prod);
                $(".result_element_content.searchcontent1").html(name_prod);
                //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
                $(".search_result").fadeOut();


            })


          $('#mw-quantity').keyup(function(){
            var Value = $('#mw-quantity').val();
            $('.content-quantity').text(Value);
            });

          $('#mw-price').keyup(function(){
            var Value = $('#mw-price').val();
            $('.content-price').text(Value);
            });



          $('#mw-type-select').change(function(){
              var Value = $(this).val();
              var text = $('#mw-type-select option:selected').text();
              $('.mw-type-select').text(text);
              if(Value!='')
              $.ajax({
                  type: 'POST',
                  url: 'getParams',
                  data: {Value:Value, _token: $('#mw_csrf_token').val(),type:"type"},
                  success: function(data){
                      $('#mw-category-select').find('option').remove();
                      $('#mw-category-select').append('<option>Категория</option>');
                      if(data.length > 0)
                      for(i=0;i<data.length;i++){
                          $('#mw-category-select').append('<option value="'+data[i].id+'">'+data[i].category+'</option>');
                      }
                    //  alert('Type changed!');
                  },
                  error: function (error) {
                      console.log(error);
                      alert('Something went wrong. Try again.');
                  }
              });
          });

          $('#mw-category-select').change(function(){
             // var Value = $(this).val();
              var text = $('#mw-category-select option:selected').text();
              $('.mw-category-select').text(text);
               // console.log("value = "+Value);
              if(text!='Категория')
                  $.ajax({
                      type: 'POST',
                      url: 'getParams',
                      data: {Value:text, _token: $('#mw_csrf_token').val(),type:"category"},
                      success: function(data){
                         // console.log(data);
                          $('#mw-characteristic-select').find('option').remove();
                          $('#mw-characteristic-select').append('<option>Характеристики</option>');
                          if(data.length > 0)
                              for(i=0;i<data.length;i++){
                                  $('#mw-characteristic-select').append('<option value="'+data[i].id+'">'+data[i].feature+'</option>');
                              }
                          //  alert('Category changed!');
                      },
                      error: function (error) {
                          console.log(error);
                          alert('Something went wrong. Try again.');
                      }
                  });
          });
          $('#mw-characteristic-select').change(function(){
              var Value = $(this).val();
              var text = $('#mw-characteristic-select option:selected').text();
              $('.mw-characteristic-select').text(text);
          });
          $('#mw-unit').change(function(){
              var Value = $(this).val();
              $('.mw-unit').text(Value);
          });


          }

      if ($.exists('.datepicker-here')) {
          $('.datepicker-here').datepicker({
              autoClose:true
          })
      }


      $('#modalSubmitAddProduct').on('click', function(){
          $('#modalAddProduct').hide();

          var data = {
              userId: $('#mw_user_add_product_id').val(), //
              //iName: $('#mw-search-input').val(),
              iName: $('#name_product').val(),
              iQuantity: $('#mw-quantity').val(),        //
              iPrice: $('#mw-price').val(),              //
              iCategory: $('#mw-category-select').val(), //
              iType: $('#mw-type-select').val(),//
              iCharacteristic: $('#mw-characteristic-select').val(), //
              iUnit: $('#mw-unit').val(),          //
              iTextarea: $('#mw-text-area').val(), //
              _token: $('#mw_csrf_token').val() //
          };

          console.log(data);

          $.ajax({
              type: 'POST',
              url: 'modal/addProduct',
              data: data,
              success: function(data){
                  console.log(data);
                  alert('Product added successfully!');
                  window.location.reload();
              },
              error: function (error) {
                  console.log(error);
                  alert('Something went wrong. Try again.');
              }
          });
      });


});

  /*--------------всплывающее окно задать новый вопрос-------------------*/


  $('#modalSubmitAddQuestion').on('click', function(){
      $('#modalAddQuestion').hide();

      var data = {
          userId: $('#qw_user_id').val(),
          culture: $('#qw-search-input').val(),
          questionType: $('#qw-type-select').val(),
          questionText: $('#qw-question-text').val(),
          questionTitle: $('#qw-question-title').val(),
          _token: $('#qw_csrf_token').val()
      };

     // console.log(data);
      $.ajax({
          type: 'POST',
          url: '/index.php/modal/addQuestion/',
          data: data,
          success: function(){
              alert('Product added successfully!');
          },
          error: function (error) {
              console.log(error);
              alert('Something went wrong. Try again.');
          }
      });
  });

  $('#modalSubmitAddAnswer').on('click', function(){
      $('#modalAddAnswer').hide();

      var data = {
          userId: $('#qw_user_answer_id').val(),
          questionId: $('#qw_question_answer_id').val(),
          answerText: $('#qw-answer-text').val(),
          _token: $('#qw_csrf_answer_token').val()
      };

      // console.log(data);


      $.ajax({
          type: 'POST',
          url: '/index.php/modal/addAnswer/',
          data: data,
          success: function(){
              alert('Product added successfully!');
          },
          error: function (error) {
              console.log(error);
              alert('Something went wrong. Try again.');
          }
      });
  });
// Сохранение данных об изменении продукта
  $('#modalSubmitUpProduct').on('click', function(){
      $('#modalUpProduct').hide();

      var data = {
          Id: $('#up_add_product_id').val(),
          userId: $('#mw_user_add_product_id').val(),
          iName: $('#up-search-input').val(),
          iQuantity: $('#up-quantity').val(),
          iPrice: $('#up-price').val(),
          iCategory: $('#up-category-select').val(),
          iType: $('#up-type-select').val(),
          iCharacteristic: $('#up-characteristic-select').val(),
          iUnit: $('#up-unit').val(),
          iTextarea: $('#up-text-area').val(),
          _token: $('#mw_csrf_token').val()
      };

       console.log(data);

      $.ajax({
          type: 'POST',
          url: 'modal/UpProduct',
          data: data,
          success: function(data){
              console.log(data);
              alert('Product changed successfully!');
              $('.modal-backdrop.fade.show').removeClass('show');
              location.reload();
          },
          error: function (error) {
              console.log(error);
              alert('Something went wrong. Try again.');
              $('.modal-backdrop.fade.show').removeClass('show');
          }
      });
  });

  // Модальное окно редактировать товар
  $('#modalUpProduct').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var product = button.data('product');
     //  console.log(product);
      getDataForModalUpProductFromDB(product.id);

      $('#up_add_product_id').val(product.id);
      $('#up_user_add_product_id').val(product.userId);
      $('#up-search-input').val(product.name);
    //  $('#up-quantity').val(product.quantity);

    //  $('#up-price').val(product.price);
    //  $('#up-category-select').val(product.section_id);
      $('#up-type-select').val(product.type);
    //  $('#up-characteristic-select').val(product.characteristic);
   //   $('#up-unit').val(product.unit);
    //  $('#up-text-area').val(product.add_information);
      $('#up_csrf_token').val(product.token);

      // заполнение полей блока что будет изменено
      $('.mw-type-select').text(product.type);
  });

  // получение данных для модального окна редактирования позиции продукта
  function getDataForModalUpProductFromDB(id){
      $.post('getDataForModalUpProductFromDB',{id:id},function(data){
          //console.log(data);
          $('#up-characteristic-select').find('option').remove();
          $('#up-characteristic-select').append('<option>Характеристики</option>');
          if(data['feature'].length > 0) {
              for (i = 0; i < data['feature'].length; i++) {
                  if (data['feature'][i].id == data['products'].id) {
                      $('#up-characteristic-select').append('<option value="' + data['feature'][i].id + '" selected >' + data['feature'][i].feature + '</option>');
                  } else {
                      $('#up-characteristic-select').append('<option value="' + data['feature'][i].id + '">' + data['feature'][i].feature + '</option>');
                  }
              }
          }
          if(data['category'].length > 0){
              $('#up-category-select').find('option').remove();
              $('#up-category-select').append('<option>Категория</option>');
              for (var i=0;i<data['category'].length;i++){
               //   console.log(data['category'][i]);
                  if (data['category'][i].category == data['products'].category) {
                      $('#up-category-select').append('<option value="' + data['category'][i].id + '" selected >' + data['category'][i].category + '</option>');
                  } else {
                      $('#up-category-select').append('<option value="' + data['category'][i].id + '">' + data['category'][i].category + '</option>');
                  }
              }
          }
          if(data['products'].quantity){
              $('#up-quantity').val(data['products'].quantity);
          }else{
              $('#up-quantity').val();
          }

          if(data['products'].unit){
              $('#up-unit').val(data['products'].unit);
          }else{
              $('#up-unit').val();
          }

          if(data['products'].price){
              $('#up-price').val(data['products'].price);
          }else{
              $('#up-price').val();
          }

          if(data['products'].add_information){
              $('#up-text-area').val(data['products'].add_information);
          }else{
              $('#up-text-area').val();
          }

      });
  }
  // заполнение блока

  // обработка события изменения типа товара при изменении товара
  $('#up-type-select').on('change',function(){
     alert("change type");
      var Value = $(this).val();
      var text = $('#up-type-select option:selected').text();
      $('.mw-type-select').text(text);
      if(Value!='')
          $.ajax({
              type: 'POST',
              url: 'getParams',
              data: {Value:Value, _token: $('#mw_csrf_token').val(),type:"type"},
              success: function(data){
                  $('#up-category-select').find('option').remove();
                  $('#up-category-select').append('<option>Категория</option>');
                  if(data.length > 0)
                      for(i=0;i<data.length;i++){
                          $('#up-category-select').append('<option value="'+data[i].id+'">'+data[i].category+'</option>');
                      }
                  $('#up-characteristic-select').find('option').remove();
                  $('#up-characteristic-select').append('<option>Характеристики</option>');

                  //  alert('Type changed!');
              },
              error: function (error) {
                  console.log(error);
                  alert('Something went wrong. Try again.');
              }
          });
  });
  // изменение категории при изменении товара
  $('#up-category-select').on('change',function(){
      var text = $('#up-category-select option:selected').text();
      $('.mw-category-select').text(text);
      // console.log("value = "+Value);
      if(text!='Категория')
          $.ajax({
              type: 'POST',
              url: 'getParams',
              data: {Value:text, _token: $('#mw_csrf_token').val(),type:"category"},
              success: function(data){
                  // console.log(data);
                  $('#up-characteristic-select').find('option').remove();
                  $('#up-characteristic-select').append('<option>Характеристики</option>');
                  if(data.length > 0)
                      for(i=0;i<data.length;i++){
                          $('#up-characteristic-select').append('<option value="'+data[i].id+'">'+data[i].feature+'</option>');
                      }
                  //  alert('Category changed!');
              },
              error: function (error) {
                  console.log(error);
                  alert('Something went wrong. Try again.');
              }
          });
  });

  // изменение товара поле характеристики
  $('#up-chacteristic-select').on('change',function(){
          var Value = $(this).val();
          var text = $('#up-characteristic-select option:selected').text();
          $('.mw-characteristic-select').text(text);
  })
  // изменение товара поле количество
  $('#up-quantity').keyup(function(){
      var Value = $('#up-quantity').val();
      $('.content-quantity').text(Value);
  });
  // изменение товара единица измерения
  $('#up-unit').keyup(function(){
      var Value = $(this).val();
      $('.mw-unit').text(Value);
  });
  // изменение товара поле цена
  $('#up-price').keyup(function(){
      var Value = $('#up-price').val();
      $('.content-price').text(Value);
  });
  $('.addBasketProduct').on('click', function(){

      var that = $(this).parent().prev().children();

      var productId = $(this).data('productid');
      var quantity = that.val();
      var product = $('.price'+productId).text();
      var counter = $('.product'+ productId +' > td > input').val();
      var price = product * counter;
      price = Number(price);
      var oldPrice = $('#price').text();
      oldPrice = Number(oldPrice);
      var newPrice = oldPrice + price;
      $('#price').text(newPrice);
      var deliveryMethods = $('#userMethods').val();




      $.ajax({
          type: 'POST',
          url: '/index.php/addBasketProduct',
          data: {
              productId: productId,
              quantity: quantity,
              deliveryMethods: deliveryMethods,
              _token: $('#csrf_token').val(),
          },

          success: function(){
              $(that).val(1);
              alert('Product added successfully!');
          },
          error: function (error) {
              console.log(error);
              alert('Something went wrong. Try again.');
          }

      });

  });

  $('#checkout').on('click', function(){

      console.log($('#csrf_token').val());

      $.ajax({
          type: 'POST',
          url: '/index.php/createOrder',
          data: {
              _token: $('#csrf_token').val(),
          },

          success: function(){
              alert('Product added successfully!');
          },
          error: function (error) {
              console.log(error);
              alert('Something went wrong. Try again.');
          }

      });


  });


$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.product-table__smalltd-plus').on("click",function(){
       // alert("Hello my frend");
        event.preventDefault();
        var td = $(this).parent();
        console.log(td);
        var value = parseInt(td[0]['childNodes'][2]['childNodes'][0]['data']);
        $(td[0]['children'][1]).html(value+1);
    })

    $('.product-table__smalltd-minus').on("click",function(){
        event.preventDefault();
        var td = $(this).parent();
        var value = parseInt(td[0]['childNodes'][2]['childNodes'][0]['data']);
        if(value > 0) {
            $(td[0]['children'][1]).html(value - 1);
        }
    })

    $('.product-table__smalltd-refresh').on('click',function(){
       // alert('Hello world');
        event.preventDefault();
        var name =  $(this).data('name');
        var questionnair_id = $('.product-image__item.active.d-flex.align-items-center').data('questionnaire');
      //  console.log(name);
      //  console.log(questionnair_id);

        var td = $(this).parent().parent();
        if($(this).hasClass('text_field')){
            value = td[0]['cells'][2]['childNodes'][0]['value'];
          //  console.log(td);
        }else if ($(this).hasClass('select_field')){
            value = $(".form-select [name = "+name+"]").val();
         //   console.log($(".form-select [name = "+name+"]").val());
         //   console.log(td);
        }
        else if($(this).hasClass("date_picker")){
           value = $("input[name = "+name+"].datepicker-here").val();
        }else{
            var value = td[0]['children'][2]['children'][1]['childNodes'][0]['data'];
        }
       console.log('name='+name);
       console.log('questionnair_id='+questionnair_id);
       console.log('date = '+ value);
        $.ajax({
           type:'POST',
           url:'ajax-questionnair-update',
           data: {id:questionnair_id,name_field:name,val_field:value},
           success:function(data){
               console.log(data);
           }
        });
    })

    $(".product-image__item.d-flex.align-items-center").on("click",function () {
       // alert('ee');
        var sort_id = $(this).data('sort');
        var questionnaire_id = $(this).data('questionnaire');

        var checkbox = $(this);
        console.log(checkbox);
        $('.form-check-input-item').each(function(){
            console.log(1);

            $(this).removeAttr('checked');
        });
        $.ajax(
            {
                type:'POST',
                url:'ajax-questionnaire',
                data:{sort_id:sort_id,quest_id:questionnaire_id},
                success:function(data){
                  //  console.log(data);

                    var obj = $.parseJSON(data);
                        loadDataInTable(obj);
                  //  console.log(obj);
                  //  console.log(obj[0].name);
                    //alert(data['name']);
                },
            }
        )
        $('.product-image__item.d-flex.align-items-center.active').removeClass('active');
        $(checkbox).addClass('active');
        $(checkbox[0]['children'][1]['children'][1]['children'][0]).attr('checked',true);
    })
    function loadDataInTable(obj){
       // alert(obj[0].generation)
        $('#card').html(obj[0].name);
        var tableBody = $('.product-table tbody');
        // поколение растаний
        $(tableBody[0]['children'][1]['cells'][1]).html(obj[0].generation);
        $(tableBody[0]['children'][1]['cells'][2]['children'][1]).html(obj[0].generation);
        // посадочная площадь
        $(tableBody[0]['children'][2]['cells'][2]['children'][0]).attr("value",obj[0].landing_area);

        // Дата на посадки на расскаду
        $(tableBody[0]['children'][3]['cells'][1]).html(obj[0].seeding_date);
        $(tableBody[0]['children'][3]['cells'][2]['children'][0]).attr("value",obj[0].seeding_date);

        // Дата посадки на открытую площадку
        $(tableBody[0]['children'][4]['cells'][1]).html(obj[0].ground_transplantation_date);
        $(tableBody[0]['children'][4]['cells'][2]['children'][0]).attr("value",obj[0].ground_transplantation_date);

        // Условия выращивания

        // Дата пересадки на грунт

        // Дата проведения обрезки
        $(tableBody[0]['children'][7]['cells'][1]).html(obj[0].trimming_date);
        $(tableBody[0]['children'][7]['cells'][2]['children'][0]).attr("value",obj[0].trimming_date);

        //Дата проведения обработки

        //Болеет ли растение

        //Наличие искуственного полива

        //Наличие капельного полива
        if(obj[0].drip_irrigation == 1){
            $(tableBody[0]['children'][11]['cells'][1]).html("Да");
            //$('#drip_irrigation option ').filter('selected',1);
          //  alert('yes');

            $("#drip_irrigation-styler").html('<div class="jq-selectbox jqselect form-select changed" id="drip_irrigation-styler"><select class="form-select" name="drip_irrigation" id="drip_irrigation">\n' +
                '<option value=""></option>\n' +
                '<option value="1" selected="">Да</option>\n' +
                '<option value="0" >Нет</option>\n' +
                '</select><div class="jq-selectbox__select"><div class="jq-selectbox__select-text">Нет</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="display: none;"><ul><li style="display: none;"></li><li style="">Да</li><li class="selected sel" style="">Нет</li></ul></div></div>');

        }else {
            $(tableBody[0]['children'][11]['cells'][1]).html("Нет");
           //  alert("No");
            // $('select#drip_irrigation option').filter(function(){
            //     return this.text == "Да"
            // }).attr('selected',false);
            // $('select#drip_irrigation option').filter(function(){
            //     return this.text == "Нет"
            // }).attr('selected',true);

            $("#drip_irrigation-styler").html('<div class="jq-selectbox jqselect form-select changed" id="drip_irrigation-styler"><select class="form-select" name="drip_irrigation" id="drip_irrigation">\n' +
                ' <option value=""></option>\n' +
                '    <option value="1">Да</option>\n' +
                ' <option value="0" selected="">Нет</option>\n' +
                ' </select><div class="jq-selectbox__select"><div class="jq-selectbox__select-text">Нет</div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div><div class="jq-selectbox__dropdown" style="display: none;"><ul><li style="display: none;"></li><li style="">Да</li><li class="selected sel" style="">Нет</li></ul></div></div>');
        }
        //Количество осадков с момента посадки
        $(tableBody[0]['children'][12]['cells'][1]).html(obj[0].precipitation_from_planting);
        $(tableBody[0]['children'][12]['cells'][2]['children'][1]).html(obj[0].precipitation_from_planting);

        //Количество подкормок с момента посадки
        $(tableBody[0]['children'][13]['cells'][1]).html(obj[0].feeding_from_planting);
        $(tableBody[0]['children'][13]['cells'][2]['children'][1]).html(obj[0].feeding_from_planting);

        //Количество искуственного полива с момента посадки
        $(tableBody[0]['children'][14]['cells'][1]).html(obj[0].artificial_irrigation_from_planting);
        $(tableBody[0]['children'][14]['cells'][2]['children'][1]).html(obj[0].artificial_irrigation_from_planting);

        // Полученный сумарный урожай
        $(tableBody[0]['children'][15]['cells'][1]).html(obj[0].harvest+" кг");
        $(tableBody[0]['children'][15]['cells'][2]['children'][0]).attr("value",obj[0].harvest);
      //  console.log(tableBody);
    }
    // всплывающее окно для фильтров в категориях
    $('.sort').on('click',function(){
      // alert("check");
       var attrId = new Array();
       $('.col-2.sc-main-left-content  input:checkbox:checked').each(function(){
          attrId.push($(this).attr('data-id'));
       })
        console.log(attrId);
       if(attrId.length > 0){
           $.ajax({
               type:'POST',
                url:'filterCatalogSad',
               data: {data:attrId},
               success:function(data){
                   $('.col-12.sc-culture-all-container.d-flex.flex-wrap').html(data);
                   $('.pagination').remove();
               }
           });
       }else{
           location.reload();
       }
    });
    // фильтр для вредителей
    $('.pests').on('click',function(){
      //  event.preventDefault();
      // alert("all right");
        var type = window.location.pathname.split('/')[3];
        //console.log(path);
        var attrId = new Array();
        $('.col-2.sc-main-left-content  input:checkbox:checked').each(function(){
            attrId.push($(this).attr('data-id'));
        })
        console.log(attrId);
        if(attrId.length > 0){
            $.ajax({
                type:'POST',
                url:'filterCatalogPest',
                data: {data:attrId,type:type},
                success:function(data){
                   console.log(data);
                    $('#pest-container').html(data);
                    $('.pagination').remove();
                }
            });
        }else{
            location.reload();
        }
    });

    // фильтр для заболеваний
    $('.disease').on('click',function(){
        var type = window.location.pathname.split('/')[3];
        var attrId = new Array();
        $('.col-2.sc-main-left-content  input:checkbox:checked').each(function(){
            attrId.push($(this).attr('data-id'));
        })
        console.log(attrId);
        if(attrId.length > 0){
            $.ajax({
                type:'POST',
                url:'filterCatalogDisease',
                data: {data:attrId,type:type},
                success:function(data){
                   // console.log(data);
                    $('#diseases-container').html(data);
                    $('.pagination').remove();
                }
            });
        }else{
            location.reload();
        }
    });
    $("#menu_sort").on("click","a", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();

        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),

            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = $(id).offset().top;

        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);
    });

//Комментарий
    // добавление рейтинга
    $('.sc-star-rating-sorts').on('click','i.fa.set',function(){
       var id = parseInt($(this).attr('data-id'));
       var content="";
       for(var i=1;i<6;i++){
           if(id >= i){
               content+="<span class=\"star-rating__dark\"><i class=\"fa fa-star set\" data-id=\" "+i+"\"></i></span>";
           }else{
               content+="<span class=\"star-rating__dark\"><i class=\"fa fa-star-o set\" data-id=\" "+i+"\"></i></span>"
           }
       }
        $('#comment_rating').val(id);
        $('.sc-star-rating-sorts').html(content);
    });
    // отправка
    $('#send_comment').on('click',function(){
        event.preventDefault();
        if($('#comment_message').val().trim().length == 0){
            return false;
        }else{
          var data = $('#comment_form').serialize();

            var data = {
                user_id: $('#user_id').val(),
                item_id: $('#item_id').val(),
                type: $('#type').val(),
                rating: $('#comment_rating').val(),
                text: $('#comment_message').val(),
             //   _token: $("meta[name='csrf-token']").attr('content')
            };

            console.log(data);
            $.ajax({
                type: 'POST',
                url: 'addComment',
                data: data,

                success: function(data){
                    console.log(data);
                    alert('Comment added successfully!');
                },
                error: function (error) {
                    console.log(error);
                    alert('Something went wrong. Try again.');
                }
            });


        }
    })
})

