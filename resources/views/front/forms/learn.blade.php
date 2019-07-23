@extends('front.main_learn')

@section('form')

<section class="sc-main sc-learningpage-container">
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Справка по сайту</li>
                </ol>
            </div>
            <div class="sc-learningpage-list-container">
                <ul class="sc-learningpage-list">
                    <li><a href="#">Структура сайта</a></li>
                    <li><a href="#">Роли пользователей</a></li>
                    <li><a href="#">Совершение покупок</a></li>
                    <li><a href="#">Дополнительный функционал</a></li>
                    <li><a href="#">Просмотр событий</a></li>
                    <li><a href="#">Загрузка фото, статей, анкет</a></li>
                    <li><a href="#">Проблемы, возникающие при пользовании сайтом</a></li>
                </ul>
            </div>

            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Структура сайта</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>Портал “Умная дача” состоит из трех основных разделов. Они называются: “Сад”, “Огород” и “Клумба”. Каждый из этих разделов охватывает виды культур и другую сопутствующую информацию в соответствии со своей тематикой и как результат уникальны. Но кроме отличия по содержанию, реализовано неповторимое визуальное оформление: разделы имеют цветовые отличия, поэтому находясь на любой странице будет понимание в каком конкретно разделе вы сейчас находитесь.</p>

                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card mt-4 mb-5">
                            <div class="sc-section-card-bg d-flex flex-column pb-5">
                                <div class="text-center pt-4">
                                    <img src="images/logo-sad.png" alt="">
                                </div>
                                <div class="sc-section-card-content text-center">
                                    <h3>Раздел «Сад»</h3>
                                    <p>Включает в себя информацию по всем плодовым растениям, кустарникам, ореховым деревьям, ягодам и фруктам, т.е. все что обычно выращивается в саду и ассоциируется у нас с понятием сада.</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card mt-4 mb-5">
                            <div class="sc-section-card-bg d-flex flex-column pb-5">
                                <div class="text-center pt-4">
                                    <img src="images/logo-ogorod.png" alt="">
                                </div>
                                <div class="sc-section-card-content sc-ogorod-card text-center">
                                    <h3>Раздел «Огород»</h3>
                                    <p>Объединяет все сельскохозяйственные культуры, овощи, приправы, лекарственные растения и прочие растения.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card mt-4 mb-5">
                            <div class="sc-section-card-bg d-flex flex-column pb-5">
                                <div class="text-center pt-4">
                                    <img src="images/logo-clumba.png" alt="">
                                </div>
                                <div class="sc-section-card-content sc-clumba-card text-center">
                                    <h3>Раздел «Клумба»</h3>
                                    <p>Отвечает за растения радующие нас своей красотой. Цветы, комнатные растения, декоративные растения, деревья и кустарники, травянистые покрытия все они находятся в этой части портала.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>Портал “Умная дача” состоит из трех основных разделов. Они называются: “Сад”, “Огород” и “Клумба”. Каждый из этих разделов охватывает виды культур и другую сопутствующую информацию в соответствии со своей тематикой и как результат уникальны. Но кроме отличия по содержанию, реализовано неповторимое визуальное оформление: разделы имеют цветовые отличия, поэтому находясь на любой странице будет понимание в каком конкретно разделе вы сейчас находитесь.</p>
                </div>
            </div>
            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Роли пользователей</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>На портале реализовано 4 роли пользователей, которые влияют на возможный функционал. Каждая роль обладает своими особенностями. ”Покупатель” - это основная роль. Для ее открытия достаточно просто зарегистрироваться на портале. Весь функционал, доступный этой роли, вы получаете сразу и никаких дополнительных финансовых затрат для работы в ней не потребуется. ”Продавец” - эта роль нужна, если вы хотите начать зарабатывать с помощью “Умной дачи”, вы будете показываться на карте для ближайших потенциальных покупателей в зависимости от ассортимента культур, который вы продаете. Соответственно, чем больший ассортимент вы имеете, тем больше вероятность его реализации, либо вы должны продавать специфичные культуры, дабы не иметь конкурентов в реализации. Этот функционал нужно дополнительно открывать. Для этого вы можете выбрать один из предлагаемых тарифов и приобрести его, либо с помощью своей активности на портале, содействовать в его наполнении, участвовать в конкурсах, помогать модерировать уже присланную информацию. В последнем случае уровень получаемого тарифа будет зависеть от степени оказанной помощи. Для приобретения необходимо написать нам через форму обратной связи, либо на почту с темой “Оплата” , оплатить полученный в ответном письме счет, указав в комментарии номер счета или почтовый адрес личного кабинета и дождаться открытия доступа. Роли “Организатор” и “Флорист” приобретаются аналогичным способом. В личном кабинете “Продавца”, вы сможете сформировать свой ассортимент, контролировать остатки, исполнение заказов, фиксировать товары, которые забронировали на следующие посадочные сезоны и таким образом спланировать объем своих работ.

                        ”Организатор мероприятий” - это дополнительная роль. Она позволяет выкладывать на страницах портала информацию о проводимых мероприятиях, выставках и фестивалях по тематике ресурса. Включение роли требует символической оплаты. ”Декоратор, флорист” - еще одна дополнительная роль, которая создана для пользователей, желающих продемонстрировать свое мастерство и увеличить объем своих заказов. Включение ее также требует оплаты, поскольку вы планируете зарабатывать с помощью ресурса “Умная дача”.</p>
                </div>

            </div>
            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Совершение покупок</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>Просматривая каталоги растений и химикатов, вы можете приобрести понравившийся вам товар. Для покупки вам необходимо все добавлять в свою корзину. Затем, войдя в личный кабинет в подменю “Мои заказы” вы увидите неоформленный заказ. Он будет оставаться в этом статусе пока не будет выбран конечный продавец . Для этого необходимо нажать кнопку подбора продавца, после чего мы предложим вам ближайших продавцов, которые продадут выбранный товар с принципом максимального закрытия по ассортименту (т.е. максимальное число наименований у одного продавца), ближайшего его расположения к вам и рейтинга этого продавца. После этого “неоформленный заказ” будет оформлен с одним или разбит на нескольких продавцов с присвоением номера заказа. После чего вы сможете отслеживать ситуацию с ними до момента получения товара. До момента оформления вы можете зайти на страницу предполагаемого продавца, посмотреть его ассортимент и что-то добавить к уже имеющемуся набору, скорректировать свой заказ.</p>
                </div>

            </div>
            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Дополнительный функционал</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>Этот функционал можно найти в личном кабинете роли “Покупатель”, нажав подменю “Мои растения” и там в верхнем правом углу кнопку “Отчеты”. На текущий момент реализовано 4 основных отчета: ”Информационная таблица” позволяет инфографику всех культур, добавленных в мои растения, вывести в единую таблицу и распечатать ее. Это позволяет удобнее и нагляднее видеть сроки посадки , пересадки, обработки растений. Таким образом спланировать работы в дачный сезон будет намного проще. “Активность культур” покажет вам статистику популярности культур добавленных в список “Моих”, поможет оценить ряд параметров по каждому сорту. “Лунный календарь” даст информацию по каждой вашей культуре, когда и какие мероприятия благоприятно с ней производить, а когда лучше определенные действия отложить . Это один из инструментов получения отличного урожая. “Прогноз урожая” данный функционал тестовый и будет совершенствовать по мере поступления анкет от пользователей, в идеале получать прогнозируемый урожай исходя из параметров заданных пользователем с высокой долей точности. “Виртуальный сад” в разработке.</p>
                </div>

            </div>
            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Просмотр событий</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>Раздел “Календарь мероприятий” показывает все намеченные на месяц события возможностью фильтрации по типам событий. Если вы представитель заинтересованных лиц, либо хотите провести демонстрацию своей продукции, то можете сами создать мероприятие , которое будет видно остальным пользователям. Для открытия этой возможности необходимо приобрести роль “Организатор мероприятий”.</p>
                </div>

            </div>
            <div class="col-12 sc-learningpage-article-container pb-5">
                <div class="text-center">
                    <h2>Загрузка фото, статей, анкет</h2>
                </div>
                <div class="sc-learningpage-article">
                    <p>Мы просим наших пользователь помогать в развитии портала “Умная дача” разными способами. Одним из них является отправка из разделов “Вредители” и “Заболевания” фотографии предполагаемых недугов. За определенное количество материала вы будете получать прибавку к своему рейтингу и возможность открыть роль “Продавец”. Эти фотографии в дальнейшем нам пригодятся для обучения алгоритмов искусственного интеллекта, чтобы упростить задачу излечения культур. Кроме этого будем признательны, если поделитесь своим опытом в деле садоводства. Можете присылать ваши статьи и видео по определенным культурам к нам, самые лучшие будут выложены на портале, за это вы тоже будете получать большое количество рейтинга. В личном кабинете Покупателя мы добавили функционал по ведению анкет Моих растений. Заполняя данные анкеты по каждой вашей культуре на протяжении всего периода выращивания вы помогаете нам спрогнозировать конечный результат для других пользователей и понять зависимость его от вводимых данных. Чем больше их будет, тем более точным окажется прогноз.Мы с радостью окажем помощь в решении ваших проблем.</p>
                </div>

            </div>
            <div class="col-12 description-wrap ">
                <div class="d-alert-wrap mx-auto">По всем возникающим проблемам пользуйтесь функционалом обратной связи. <br> Мы с радостью окажем помощь в решении ваших проблем.
                </div>
            </div>
            {{--<div class="col-12">--}}
            {{--<div class="sc-section-form">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-12 text-center">--}}
                        {{--<h2>Мы готовы к сотрудничеству</h2>--}}
                    {{--</div>--}}
                    {{--<div class="col-8 sc-rate-form-container mx-auto">--}}
                        {{--<form class="sc-form-element text-center" action="">--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="email" class="form-control" placeholder="E-mail">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<textarea class="form-control" rows="5" placeholder="Ваше сообщение"></textarea>--}}
                            {{--</div>--}}
                            {{--<button type="button" class="sc-form-button" href="#">Отправить</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


        </div>
    </div>
</section>
<section class="sc-section-form">
    <div class="container position-relative">
        <diw class="row">
            <div class="col-12 text-center">
                <h2>Мы готовы к сотрудничеству</h2>
            </div>
            <img class="sc-section-form-img-vase" src="images/221.png" alt="">
            <div class="col-0 col-md-8 col-lg-6 mx-auto">
                <div class="sc-section-form-leaf"></div>

                <form class="sc-form-element text-center" id="sendform" method="post" >
                    {{ csrf_field() }}

                    <div id="sendmessage">
                        Ваше сообщение отправлено!
                    </div>
                    <div id="senderror">
                        При отправке сообщения произошла ошибка. Продублируйте его, пожалуйста, на почту администратора <span>{{ env('MAIL_ADMIN_EMAIL') }}</span>
                    </div>
                    <div class="form-group">

                        <input type="email" class="form-control" name="mail" id="mail-form" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="mess"  id="mess-form" placeholder="Ваше сообщение"></textarea>
                    </div>
                    <button type="submit" class="sc-form-button" id="send" name="submit">Отправить</button>
                </form>

            </div>
        </diw>

    </div>



</section>
@endsection