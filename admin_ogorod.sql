-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 01 2018 г., 10:21
-- Версия сервера: 5.5.56-MariaDB
-- Версия PHP: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin_ogorod`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `moderator` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `path`, `user_id`, `moderator`, `created_at`, `updated_at`) VALUES
(3, 'article/article_5bc7180125ec1.docx', 78, 'new', '2018-10-17 08:07:45', '2018-10-17 08:07:45'),
(4, 'article/article_5bc71801df03b.docx', 78, 'new', '2018-10-17 08:07:45', '2018-10-17 08:07:45'),
(5, 'article/article_5bc71ffe9123a.docx', 78, 'new', '2018-10-17 08:41:50', '2018-10-17 08:41:50'),
(6, 'article/article_5bc724dfbae74.docx', 78, 'new', '2018-10-17 09:02:39', '2018-10-17 09:02:39'),
(7, 'article/article_5bc72542d5840.jpg', 78, 'new', '2018-10-17 09:04:18', '2018-10-17 09:04:18'),
(8, 'article/article_5bc7269a3665d.docx', 78, 'new', '2018-10-17 09:10:02', '2018-10-17 09:10:02'),
(11, 'article/article_5bc729e9e81c7.docx', 78, 'new', '2018-10-17 09:24:09', '2018-10-17 09:24:09'),
(12, 'article/article_5bc72a14c6df5.jpg', 78, 'new', '2018-10-17 09:24:52', '2018-10-17 09:24:52'),
(13, 'article/article_5bd0cf9d32df0.pdf', 61, 'new', '2018-10-24 17:01:33', '2018-10-24 17:01:33');

-- --------------------------------------------------------

--
-- Структура таблицы `assortments`
--

CREATE TABLE `assortments` (
  `id` int(10) UNSIGNED NOT NULL,
  `target_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sort',
  `quantity` decimal(11,3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `not_done` int(11) NOT NULL DEFAULT '0',
  `selled` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `assortments`
--

INSERT INTO `assortments` (`id`, `target_id`, `owner_id`, `type`, `quantity`, `price`, `not_done`, `selled`, `category_id`) VALUES
(6, 48, 61, 'sort', '130.000', '7.40', 0, 0, 3),
(7, 49, 61, 'sort', '100.000', '9.00', 0, 0, 3),
(8, 38, 61, 'chemical', '120.000', '7.20', 0, 0, 3),
(9, 48, 61, 'sort', '140.000', '7.60', 0, 0, 2),
(49, 47, 61, 'sort', '130.000', '300.00', 0, 0, 4),
(50, 48, 23, 'sort', '1.000', '200.00', 0, 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `target_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `type`, `folder_id`, `user_id`, `created_at`, `updated_at`, `target_id`) VALUES
(27, 'seller', 4, 61, '2018-08-16 14:25:38', '2018-08-16 14:25:38', 61),
(38, 'seller', 0, 22, '2018-08-27 05:02:30', '2018-08-27 05:02:30', 61),
(39, 'seller', 0, 32, '2018-08-27 11:25:24', '2018-08-27 11:25:24', 22),
(40, 'decorator', 0, 61, '2018-08-27 16:35:31', '2018-08-27 16:35:31', 21),
(41, 'decorator', 0, 61, '2018-08-27 16:36:11', '2018-08-27 16:36:11', 21),
(42, 'decorator', 0, 61, '2018-08-27 16:40:36', '2018-08-27 16:40:36', 61),
(45, 'question', 0, 22, '2018-08-28 07:32:49', '2018-08-28 07:32:49', 3),
(56, 'handbook', 0, 78, '2018-10-17 10:09:28', '2018-10-17 10:09:28', 41),
(97, 'question', 0, 23, '2018-10-22 16:56:22', '2018-10-22 16:56:22', 17),
(110, 'disease', 0, 32, '2018-10-24 05:53:06', '2018-10-24 05:53:06', 38),
(111, 'handbook', 0, 32, '2018-10-24 05:53:10', '2018-10-24 05:53:10', 41),
(112, 'question', 0, 32, '2018-10-24 06:15:03', '2018-10-24 06:15:03', 16),
(113, 'question', 0, 32, '2018-10-24 06:22:49', '2018-10-24 06:22:49', 3),
(114, 'pest', 0, 32, '2018-10-24 10:30:37', '2018-10-24 10:30:37', 35),
(124, 'seller', 0, 61, '2018-10-26 10:44:09', '2018-10-26 10:44:09', 61),
(127, 'seller', 0, 61, '2018-10-26 10:44:25', '2018-10-26 10:44:25', 22),
(128, 'seller', 0, 61, '2018-10-26 10:49:17', '2018-10-26 10:49:17', 61);

-- --------------------------------------------------------

--
-- Структура таблицы `bookmarks_folders`
--

CREATE TABLE `bookmarks_folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bookmarks_folders`
--

INSERT INTO `bookmarks_folders` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Огурцы', '0000-00-00 00:00:00', NULL),
(2, 6111, 'Йаблоки', NULL, '2018-08-02 06:20:01'),
(3, 611, 'Малина', '2018-08-02 06:25:11', '2018-08-02 06:25:11'),
(4, 61, 'Солнце 2', '2018-08-02 08:45:36', '2018-08-02 08:46:35'),
(5, 23, 'Tanuhaftudg', '2018-10-25 09:48:51', '2018-10-25 10:32:38'),
(6, 23, 'Ruslik', '2018-10-25 10:33:50', '2018-10-25 10:33:50'),
(8, 23, 'ftdrf', '2018-10-25 11:01:44', '2018-10-25 11:01:44'),
(9, 23, 'ftdrf', '2018-10-25 11:01:52', '2018-10-25 11:01:52'),
(10, 23, 'ftdrf', '2018-10-25 11:01:54', '2018-10-25 11:01:54'),
(11, 23, 'ftdrf', '2018-10-25 11:01:58', '2018-10-25 11:01:58'),
(13, 23, 'тио', '2018-10-25 11:09:31', '2018-10-25 11:09:31'),
(14, 23, 'тиол', '2018-10-25 11:10:01', '2018-10-25 11:10:01'),
(15, 23, 'тиол', '2018-10-25 11:12:24', '2018-10-25 11:12:24');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sort',
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `type`, `category`) VALUES
(1, 'sort', 'Семена'),
(2, 'sort', 'Рассада'),
(3, 'sort', 'Росток'),
(4, 'sort', 'Урожай'),
(5, 'chemical', 'шт'),
(6, 'chemical', 'фас.'),
(8, 'sort', 'Вторичная переработка');

-- --------------------------------------------------------

--
-- Структура таблицы `category_relations`
--

CREATE TABLE `category_relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sort',
  `target_id` int(11) NOT NULL,
  `target_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_relations`
--

INSERT INTO `category_relations` (`id`, `type`, `target_id`, `target_category`) VALUES
(25, 'sort', 35, 1),
(26, 'sort', 35, 2),
(27, 'sort', 35, 3),
(28, 'sort', 35, 4),
(29, 'sort', 37, 1),
(30, 'sort', 37, 2),
(31, 'sort', 37, 3),
(41, 'sort', 47, 3),
(42, 'sort', 47, 4),
(43, 'sort', 47, 8),
(44, 'sort', 48, 3),
(45, 'sort', 48, 4),
(46, 'sort', 48, 8),
(47, 'sort', 49, 3),
(48, 'sort', 49, 4),
(49, 'sort', 50, 3),
(50, 'sort', 50, 4),
(51, 'sort', 51, 3),
(52, 'sort', 51, 4),
(53, 'sort', 52, 3),
(54, 'sort', 52, 4),
(55, 'sort', 53, 3),
(56, 'sort', 53, 4),
(57, 'sort', 61, 1),
(58, 'sort', 61, 2),
(59, 'sort', 61, 3),
(60, 'sort', 61, 4),
(61, 'sort', 61, 8),
(65, 'chemical', 35, 6),
(66, 'chemical', 36, 6),
(67, 'chemical', 37, 6),
(68, 'chemical', 38, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `chemicals`
--

CREATE TABLE `chemicals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer_site` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_path` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `composition` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `average_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `characteristics` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchantability` int(11) NOT NULL DEFAULT '0',
  `topselled` tinyint(1) NOT NULL DEFAULT '0',
  `rating` double(3,2) NOT NULL DEFAULT '0.00',
  `responses` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `chemicals`
--

INSERT INTO `chemicals` (`id`, `name`, `manufacturer`, `manufacturer_site`, `logo_path`, `vendor_code`, `main_photo`, `composition`, `average_price`, `currency`, `description`, `characteristics`, `merchantability`, `topselled`, `rating`, `responses`, `created_at`, `updated_at`) VALUES
(27, 'Парус', 'ООО \"Компания Агропрогресс\"', 'http://agroprogress.org/products/insekticidi-i-akaricidi/parus-/', '', '', 'chemical/chemical_27_photo_5ba390d71cdce.jpg', 'Хлорпирифос<div><br></div><div>\r\n\r\n<div><u>Культура:</u>&nbsp;<u></u>Яблоня, груша<u></u></div><div><u>Вредный объект:</u>&nbsp;Плодожорки, листовертки, моли, клещи, щитовки, тли<u></u></div><div><u>Способ, время, особенности применения препарата:</u>&nbsp;Опрыскивание в период вегетации.</div><div><u>Норма применения препарата, л/га:</u>&nbsp; Расход рабочей жидкости – 800-1200 л/га</div><div><u>Срок ожидания (кратность обработок): </u>&nbsp;2 40 (2)<u></u></div><div><br></div><div>&nbsp;</div>\r\n\r\n<br></div>', '3.00', '', '<div><b>\r\n\r\n</b>Парус - фосфорорганический инсектицид для борьбы с широким спектром насекомых на яблоне, винограде и груше. Действующее вещество: хлорпирифос, 480 г/л.&nbsp;</div><div>Препаративная форма: концентрат эмульсии, КЭ&nbsp;</div><div>Тарная единица: канистра 10 кг.&nbsp;</div><div>Класс опасности: 2 класс опасности (умеренно опасное соединение). Гарантийный срок хранения: 2 года в заводской упаковке при температуре от минус 30С до плюс 30С.&nbsp;</div><div>Механизм действия Инсектицид контактно-кишечного действия: при попадании в организм насекомых ингибирует фермент ацетилхолинэстеразу. Угнетение активности ацетилхолинэстеразы тормозит передачу нервного импульса в холинэргических синапсах с одного нейрона на другой, что вызывает судороги, паралич, а в конечном счете, гибель насекомого.&nbsp;</div>', '<p>\r\n\r\n</p><div><br>Влияние условий окружающей среды на действие препарата Препарат желательно применять в утренние или вечерние часы при температуре не выше 25С. Дождь сразу после обработки снижает эффективность препарата. Опрыскивание должно проводиться при скорости ветра не более 5 м/сек во избежание сноса аэрозоля на соседние культуры. Совместимость с другими препаратами Совместим со многими пестицидами, за исключением щелочных препаратов и препаратов на основе меди. <br></div><b><br>\r\n\r\n</b><br><p></p>', 0, 0, 5.00, 0, '2018-09-20 09:20:31', '2018-10-18 14:58:29'),
(28, 'Бордосская смесь', '', '', '', '', 'chemical/chemical_28_photo_5badc15e5d8cd.png', 'Раствор медного купороса CuSO₄ · 5H₂O в известковом молоке Ca(OH)₂. Жидкость небесно-голубого цвета.  (Оба ингредиента показаны на фото)', '0.00', '', 'Приготовление бордосской жидкости\r\nСтоит учитывать, что приготовление бордосской смеси достаточно сложное, поэтому все нужно делать правильно.\r\n\r\nВ противном случае раствор может получиться слишком концентрированный, и при опрыскивании нежных растений навредит им. Или же наоборот слабой концентрации, тогда он не принесет ожидаемый эффект.\r\n\r\nИтак, рассмотрим пошаговое приготовление 1% раствора на 10 литров:\r\n\r\nДля разведения раствора нужно использовать любую неметаллическую тару.\r\nВ теплой воде нужно развести 10 грамм медного купороса. Все тщательно перемешивается.\r\nДалее в эту смесь нужно долить холодной воды так, чтобы общий объем составил 5 литров.\r\nВ отдельной посуде нужно развести в 1 литре воды 120-130 грамм гашеной извести. Все тщательно размешивается в результате должна получиться смесь по консистенции, напоминающая сметану.\r\nЗатем в известковую массу нужно долить воды, чтобы объем составил 5. Хорошо перемешивается.\r\nПроцеживаем известковый раствор через марлевый материал. Это нужно для того, чтобы опрыскиватель не забивался частичками извести.\r\nНи в коем случае не перепутайте, что и куда вливать! Помешивая деревянной палочкой или лопаточкой, медный купорос аккуратно заливаем в известковую смесь.\r\nВсе хорошо перемешивается. Желательно одновременно помешивать известь и вливать медный купорос.\r\nПриготовление 3% раствора такое же, только отличается концентрацией. Для этого раствора потребуется 300 грамм медного купороса и 400 грамм гашеной извести.\r\nТакже после приготовления необходимо проверить кислотную реакцию раствора. Для этого в него следует опустить любую металлическую проволоку или гвоздь. Если после опускания металл приобретет красный цвет, то в раствор следует добавить еще немного извести.\r\n\r\nТакже помните о том, что нельзя делать:\r\n\r\nНельзя заливать известковую смесь в раствор медного купороса. Это намного снизит качество раствора.\r\nНе нужно смешивать теплые и холодные составляющие.\r\nСоединять сухие компоненты.\r\nНаливать в готовый раствор воды.\r\nДобавлять сухой медный купорос в разбавленную известь.', 'Для молодых деревьев, возраст которых составляет не более 6 лет — понадобится 2 литра на одно дерево.\r\nПри обрабатывании плодоносящих растений потребуется 10 литров.\r\nДля кустарниковых растений – 1,5 литра на один кустарник.\r\nПри профилактических мероприятиях у винограда, малины и земляники – на 10 квадратных метров достаточно полтора литра раствора.\r\nДля обработки томатов и огурцов – на 10 квадратных метров потребуется 2 литра раствора.\r\nПри обрабатывании дыни, арбузов, лука, свеклы – на 10 кв.метров понадобится 1 литр раствора.', 0, 0, 0.00, 0, '2018-09-28 02:51:26', '2018-10-15 07:38:52'),
(35, 'Хом', 'GREEN BELT', 'http://www.greenbelt-market.ru', '', '', 'chemical/chemical_35_photo_5bc8c4328433f.jpg', '<p>\r\n\r\nДля проведения профилактических и лечебных опрыскиваний, культурных растений, готовят рабочую жидкость: 30-40 г препарата разводят небольшим количеством воды, тщательно размешивают и доводят объём раствора до 10 литров. Обработку необходимо проводить в прохладную погоду, в утренние или вечерние часы при отсутствии сильных ветров. Следует обратить внимание на прогноз погоды, так как перед дождём обрабатывать растения фунгицидом Хом не имеет смысла из-за быстрой его смываемости.\r\n\r\n<br></p><p><br></p>', '0.00', '', '<p>\r\n\r\n</p><p><b>Достоинства препарата Хом:</b></p><ol><li>Хом обладает профилактическим действием.</li><li>Эффективен против множества инфекций на различных культурах.</li><li>Фунгицид обладает высокой толерантностью к другим препаратам.</li><li>Прост в применении, удобная упаковка.</li><li>Сравнительно низкая стоимость препарата.</li></ol><p><b>Недостатки препарата:</b></p><ol><li>Препарат Хом не обладает устойчивостью к осадкам, быстро смывается дождём и требует проведения повторной обработки растений.</li><li>Малоэффективен в лечении грибковых инфекций, так как не проникает в ткани.</li><li>Не является экономичным. Требует большое количество препарата для приготовления раствора, опрыскивание производят с обеих сторон листа, поэтому жидкости для обработки нужно много.</li><li>Действующее вещество вызывает коррозийную порчу металлов.</li><li>Короткий срок защиты для овощных культур.</li><li>Фунгицид запрещается применять в период цветения.</li></ol>\r\n\r\n<br><p></p>', '<p>\r\n\r\n</p><p>Фунгицид Хом хорошо проявил себя в смесях с органическими пестицидами, которые относятся к группе дитиокарбаматов.</p><p>Для полезных насекомых и растений фунгицид малотоксичен. Хом применяют вблизи ферм по разведению рыбы, но следят, чтобы остатки препарата не попадали в водоёмы и колодцы с питьевой водой. Для человека Хом не опасен, если придерживаться правил обработки. При попадании препарата в пищеварительный тракт принимают активированный уголь, запивая его большим количеством воды (до 1 л), после чего обращаются к врачу. Чтобы средство не загрязняло окружающую среду, упаковку после его использования сжигают.</p>\r\n\r\n<br><p></p>', 0, 0, 0.00, 0, '2018-10-18 14:34:42', '2018-10-18 14:46:15'),
(36, 'Топсин-М', 'Саммит Агро', 'http://sumiagro.ru', '', '', 'chemical/chemical_36_photo_5bccb54fd6b03.jpg', '<p>Обязательным условием является приготовление раствора в день обработки растения. Необходимо взять емкость с небольшим количеством воды и растворить в ней дозу препарата. После этого смесь тщательно перемешивается и переливается в опрыскиватель. Предварительно в бак необходимо налить воду так, чтобы она заполняла его на ¼. Оптимальной считается пропорция, когда на 10 л воды берут 10-15 г препарата. Наиболее благоприятным для проведения опрыскивания растений считается вегетативный период.&nbsp;</p><p><b>Запрещено проводить мероприятие в момент цветения: опрыскать растение нужно либо до того, как оно начнет цвести, либо после. Рекомендуется проводить две обработки культур в сезон.</b></p><p><b>\r\n\r\n</b>Выбирайте для обработки культур ясные, безветренные дни. Придерживайтесь интервала между процедурами — он должен составлять не менее двух недель.<b><br></b></p>', '0.00', '', '<p>\r\n\r\nПрепарат <b>«Топсин-М»</b> представляет собой фунгицид, который оказывает влияние на растения благодаря контактно-системному воздействию на источник инфекции. Средство можно использовать в целях профилактики и борьбы с грибковыми заболеваниями, атакующими культурные растения, а также для уничтожения вредных насекомых: златоглазки, листоеда, тли.&nbsp;</p><p>Действующее вещество и форма выпуска Препарат выпускается в виде порошка, обладает хорошими растворимыми свойствами. При необходимости приобретения больших объемов средства, его можно купить в мешке (10 кг). Также на рынке предложен вариант «Топсина-М» в виде концентрированной эмульсии по 5 л в бутыли. Для единоразового применения можно приобрести порошок в упаковках по 10, 25 или 500 г.<br></p><p>\r\n\r\n<b>К основным преимуществам фунгицида относятся:&nbsp;</b></p><p>- активная борьба против микоз разных видов;&nbsp;</p><p>- блокирование роста и размножения патогенных микроорганизмов в течение первых 24 часов;&nbsp;</p><p>- способность оказывать лечебное воздействие на уже пораженные грибками растения;&nbsp;</p><p>- возможность использовать порошок одновременно и для профилактики, и для уничтожения фитопатогенных грибов;</p><p>- препарат не фитотоксичен, поэтому может использоваться для восстановления сильно ослабленных и больных растений;&nbsp;</p><p>- допускается применение средства в бак-смесях;&nbsp;</p><p>- хорошая экономичность в расходе;&nbsp;</p><p>- отсутствие вреда для медоносных насекомых; эффективная борьба с насекомыми.<br><br></p>', '<p>\r\n\r\n<b>Важно! Препарат вызывает привыкание у растений, и частое его использование может не дать результатов.</b></p><p><b>\r\n\r\nПрепарат не опасен для птиц, обладает незначительной токсичностью по отношению к пчелам. Очень осторожно стоит работать с препаратом возле водоемов, так как он пагубно влияет на рыб. Запрещено использовать водоемы для мытья оборудования, которое применялось при опрыскивании растений.</b></p><p><b>Плохо взаимодействует с щелочными препаратами (Бордосская смесь)<br></b><br><br></p>', 0, 0, 0.00, 0, '2018-10-21 14:19:51', '2018-10-21 14:22:04'),
(37, 'Топаз', 'Сингента', 'https://www.syngenta.ru', '', '', 'chemical/chemical_37_photo_5bccb88e93c46.jpg', '<p>\r\n\r\n</p><p>Действующее вещество топаза высокоэффективно, прежде всего, против возбудителей настоящих мучнистых рос, особенно при первичном поражении. Топаз также широко применяется для лечения плодовой гнили, пурпуровой пятнистости, сетчатой пятнистости, серой гнили, ржавчины, парши, септориоза, церкоспореллеза, оидиума.</p><p>Приготовленным раствором тщательно опрыскивают растения в сухую безветренную погоду.</p><p>Топаз на винограде и косточковых (вишни, персики, яблони) &nbsp;первый раз применяется перед цветением, второй раз – после цветения.  Допускается всего 3-4 обработки.</p><p>На овощах и комнатных цветах Топаз применяют при первых признаках заболевания.</p><p>Топаз на ягодах первый раз применяется в момент образования бутонов, второй раз – после сбора ягод.  Допускается только 2 обработки.</p><p>Особенно удачно сочетание препаратов Топаз и Купроксат. Следует учитывать, возможность возникновения резистентности к фунгициду, поэтому в садах, где инфекции наиболее распространены (например, когда неблагонадёжные соседи не хотят обрабатывать деревья от парши), лучше чередовать Топаз с фунгицидами из других химических групп.</p><p>\r\n\r\n</p><p>2 мл препарата Топаз рассчитаны в среднем на 10 л для различных болезней и только против ржавчины норма составляет 4 мл на 10 л воды.</p><p>Для применения на комнатных цветах фунгицид Топаз лучше разводить в малом количестве воды. Весь объём ампулы нужно набрать в шприц на 2 мл, и затем дозировать нужное количество, например, 1 мл на 5 л воды. Оставшийся в шприце препарат хранить с закрытым колпачком при комнатной температуре, в темноте и недоступном для детей месте.</p><p>Возможно увеличение концентрации не более чем в 1,5-2 раза, т.е. 3-4 мл Топаза на 10 л воды. Растения при этом не чувствуют угнетенности. Если проявляется вялость листьев, это может быть реакция нарушения в уходе, например, на переувлажнение грунта.</p><p>[URL=<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru/full/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html][IMG]https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg[/IMG][/URL\">https://savepice.ru/full/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html][IMG]https://cdn1...</a>] [URL=<a target=\"_blank\" rel=\"nofollow\" href=\"http://glibzagoriy.me]Загорій/URL\">http://glibzagoriy.me]Загорій/URL</a>]<br></p><p>&lt;a href=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru/view/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html&quot;\">https://savepice.ru/view/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html\"</a>; target=\"_blank\" title=\"хостинг картинок\"&gt;&lt;img src=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg&quot;\">https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg\"</a>; border=\"0\"/&gt;&lt;/a&gt;<br></p><p><br></p><p>&lt;a href=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru&quot;\">https://savepice.ru\"</a>; target=\"_blank\" title=\"хостинг картинок\"&gt;&lt;img src=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg&quot;\">https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg\"</a>; border=\"0\"/&gt;&lt;/a&gt;<br></p><p>Нормы расхода рабочей жидкости: 2 л на небольшое дерево, до 5 л на больше дерево, 1,5-2 л на куст (смородины, крыжовника), овощи - до 5 л на сотку.</p>\r\n\r\n<br><p></p>\r\n\r\n<br><p></p>', '0.00', '', '<p>\r\n\r\n<strong>Топаз </strong>– системный фунгицид для защиты семечковых, косточковых, ягодных, овощных, декоративных культур и виноградной лозы от настоящей мучнистой росы и других болезней.\r\n\r\n<br></p>', '<p>\r\n\r\n<b>Запрещено применение в водоохранной зоне водоемов\r\n</b>\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 14:34:06', '2018-10-22 08:10:16'),
(38, 'Тест для Р', 'производитель', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 4.00, 4, '2018-10-21 15:30:47', '2018-10-23 08:12:08'),
(39, 'Тест для Р 2', 'производитель 2', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 15:30:47', '2018-10-21 15:30:47'),
(40, 'Тест для Р 3', 'производитель', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 15:30:47', '2018-10-21 15:30:47'),
(41, 'Тест для Р 4', 'производитель 4', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 15:30:47', '2018-10-21 15:30:47'),
(42, 'Тест для Р 6', 'производитель', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 15:30:47', '2018-10-21 15:30:47'),
(43, 'Тест для Р 7', 'производитель 4', '', '', '', 'chemical/chemical_38_photo_5bccc5d7129a9.gif', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p>', '0.00', '', '<p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p>', '<p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 0, 0.00, 0, '2018-10-21 15:30:47', '2018-10-21 15:30:47');

-- --------------------------------------------------------

--
-- Структура таблицы `cultures`
--

CREATE TABLE `cultures` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cultures`
--

INSERT INTO `cultures` (`id`, `name`, `photo`, `section_id`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Яблоня', 'culture/culture_1_photo_5bb4a490060d4.jpg', 6, NULL, '2018-10-26 07:22:49', NULL),
(4, 'Груша', 'sad_4_photo.jpg', 6, NULL, '2018-09-12 08:26:45', NULL),
(52, 'Клубника', 'culture_52_photo_5ba4d8add2307.jpg', 6, '2018-09-17 05:54:56', '2018-09-21 08:40:29', NULL),
(53, 'Малина', 'sad_53_photo.jpg', 6, '2018-09-17 05:55:41', '2018-09-17 05:55:41', NULL),
(54, 'Черешня', 'culture_54_photo_5ba87acc931e9.jpg', 6, '2018-09-17 05:56:14', '2018-10-26 07:22:49', NULL),
(55, 'Персик', 'culture/culture_55_photo_5bc97c029f743.jpg', 6, '2018-09-17 05:57:45', '2018-10-26 07:22:49', NULL),
(56, 'Шелковица', 'sad_56_photo.jpg', 6, '2018-09-17 05:58:14', '2018-09-17 05:58:14', NULL),
(57, 'Слива', 'sad_57_photo.jpg', 6, '2018-09-21 08:48:44', '2018-09-21 08:48:44', NULL),
(58, 'Абрикос', 'culture_58_photo_5bab6a12ab65c.jpg', 6, '2018-09-21 08:49:57', '2018-10-26 07:22:49', NULL),
(59, 'Алыча', 'culture/culture_59_photo_5bc97c12b5d41.jpg', 6, '2018-09-21 08:52:10', '2018-10-26 07:22:49', NULL),
(60, 'Рябина', 'sad_60_photo.jpg', 6, '2018-09-21 08:56:36', '2018-09-21 08:56:36', NULL),
(61, 'Айва', 'culture/culture_61_photo_5bc97c22249bc.jpg', 6, '2018-09-21 09:00:36', '2018-10-26 07:22:49', NULL),
(62, 'Боярышник', 'culture_62_photo_5ba8bfd5180b1.jpg', 6, '2018-09-21 09:02:07', '2018-10-26 07:22:49', NULL),
(63, 'Вишня', 'sad_63_photo.jpg', 6, '2018-09-21 09:04:16', '2018-09-21 09:04:16', NULL),
(64, 'Ежевика', 'sad_64_photo.jpg', 6, '2018-09-21 09:07:36', '2018-09-21 09:07:36', NULL),
(65, 'Вишня войлочная', 'culture_65_photo_5ba8cec546e4b.jpg', 6, '2018-09-21 09:08:32', '2018-10-26 07:22:49', NULL),
(66, 'Виноград', 'sad_66_photo.jpg', 6, '2018-09-21 09:11:22', '2018-09-21 09:11:22', NULL),
(67, 'Крыжовник', 'sad_67_photo.jpg', 6, '2018-09-21 09:14:04', '2018-09-21 09:14:04', NULL),
(68, 'Ирга', 'sad_68_photo.jpg', 6, '2018-09-21 09:15:11', '2018-09-21 09:15:24', NULL),
(69, 'Облепиха', 'culture/culture_69_photo_5bc97c9b68295.png', 6, '2018-09-21 09:17:34', '2018-10-26 07:22:49', NULL),
(70, 'Жимолость', 'culture_70_photo_5ba878bbd05f6.jpg', 6, '2018-09-21 09:19:51', '2018-10-26 07:22:49', NULL),
(71, 'Калина', 'sad_71_photo.jpg', 6, '2018-09-21 09:21:45', '2018-09-21 09:21:45', NULL),
(72, 'Смородина красная', 'sad_72_photo.png', 6, '2018-09-21 09:24:26', '2018-09-21 09:24:26', NULL),
(74, 'Смородина черная', 'sad_74_photo.jpg', 6, '2018-09-21 09:24:48', '2018-09-21 09:24:48', NULL),
(75, 'Ананас', 'culture_75_photo_5ba4f5001f2e7.jpg', 6, '2018-09-21 09:59:11', '2018-10-26 07:22:48', NULL),
(76, 'Кокос', 'sad_76_photo.jpg', 6, '2018-09-21 10:01:08', '2018-09-21 10:01:08', NULL),
(77, 'Апельсин', 'culture_77_photo_5ba8701281c0b.jpg', 6, '2018-09-21 10:02:19', '2018-10-26 07:22:49', NULL),
(78, 'Мандарин', 'sad_78_photo.jpg', 6, '2018-09-21 10:23:55', '2018-09-21 10:23:55', NULL),
(79, 'Кумкват', 'sad_79_photo.jpg', 6, '2018-09-21 10:25:14', '2018-09-21 10:25:14', NULL),
(80, 'Фейхоа', 'sad_80_photo.jpg', 6, '2018-09-21 10:27:42', '2018-09-21 10:27:42', NULL),
(81, 'Киви', 'culture_81_photo_5ba879397ed90.jpg', 6, '2018-09-21 10:32:14', '2018-10-26 07:22:49', NULL),
(82, 'Черника', 'sad_82_photo.jpg', 6, '2018-09-21 10:36:16', '2018-09-21 10:36:16', NULL),
(83, 'Голубика', 'sad_83_photo.jpg', 6, '2018-09-21 10:37:35', '2018-09-21 10:37:35', NULL),
(84, 'Брусника', 'sad_84_photo.jpg', 6, '2018-09-21 10:38:24', '2018-09-21 10:38:24', NULL),
(85, 'Нектарин', 'culture_85_photo_5ba879c3d2ade.jpg', 6, '2018-09-21 10:39:59', '2018-10-26 07:22:49', NULL),
(86, 'Лимон', 'sad_86_photo.jpg', 6, '2018-09-21 10:43:08', '2018-09-21 10:43:08', NULL),
(87, 'Грейпфрут', 'culture_87_photo_5ba8c37509dec.jpg', 6, '2018-09-21 10:44:21', '2018-10-26 07:22:49', NULL),
(88, 'Банан', 'sad_88_photo.jpg', 6, '2018-09-21 10:45:27', '2018-09-21 10:45:27', NULL),
(89, 'Гранат', 'sad_89_photo.jpg', 6, '2018-09-21 10:46:32', '2018-09-21 10:46:32', NULL),
(90, 'Манго', 'culture_90_photo_5ba879d1927e8.jpg', 6, '2018-09-21 10:48:22', '2018-10-26 07:22:49', NULL),
(91, 'Авокадо', 'culture_91_photo_5ba8c414d40c0.jpg', 6, '2018-09-21 10:52:22', '2018-10-26 07:22:49', NULL),
(92, 'Земляника', 'sad_92_photo.jpg', 6, '2018-09-21 10:56:33', '2018-09-21 10:56:33', NULL),
(93, 'Картофель', 'ogorod_93_photo.jpg', 5, '2018-09-21 10:59:23', '2018-09-21 10:59:23', NULL),
(94, 'Томат', 'ogorod_94_photo.jpg', 5, '2018-09-22 06:09:23', '2018-09-22 06:09:23', NULL),
(95, 'Огурец', 'ogorod_95_photo.jpg', 5, '2018-09-22 06:12:03', '2018-09-22 06:12:03', NULL),
(96, 'Капуста', 'ogorod_96_photo.jpg', 5, '2018-09-22 06:20:30', '2018-09-22 06:20:30', NULL),
(97, 'Морковь', 'ogorod_97_photo.jpg', 5, '2018-09-22 06:22:42', '2018-09-22 06:22:42', NULL),
(98, 'Свекла столовая', 'culture/culture_98_photo_5bcc9b6be585c.jpg', 5, '2018-09-22 06:25:50', '2018-10-26 07:22:49', NULL),
(99, 'Свекла сахарная', 'ogorod_99_photo.jpg', 5, '2018-09-22 06:26:15', '2018-09-22 06:26:15', NULL),
(100, 'Редис', 'culture/culture_100_photo_5bcc9b77176b3.jpg', 5, '2018-09-22 06:31:26', '2018-10-26 07:22:49', NULL),
(101, 'Редька', 'culture/culture_101_photo_5bcc9b8534cdc.jpg', 5, '2018-09-22 06:31:44', '2018-10-26 07:22:49', NULL),
(102, 'Репа', 'ogorod_102_photo.jpg', 5, '2018-09-22 06:32:08', '2018-09-22 06:32:08', NULL),
(103, 'Пшеница', 'culture/culture_103_photo_5bcc9b9cb17b4.jpg', 5, '2018-09-22 06:45:55', '2018-10-26 07:22:49', NULL),
(104, 'Гречиха', 'ogorod_104_photo.jpg', 5, '2018-09-22 06:46:23', '2018-09-22 06:46:23', NULL),
(105, 'Соя', 'ogorod_105_photo.png', 5, '2018-09-22 06:46:35', '2018-09-22 06:46:35', NULL),
(106, 'Рис', 'ogorod_106_photo.jpg', 5, '2018-09-22 06:46:49', '2018-09-22 06:46:50', NULL),
(107, 'Ячмень', 'culture/culture_107_photo_5bcc9bb14fa42.jpg', 5, '2018-09-22 06:47:27', '2018-10-26 07:22:49', NULL),
(108, 'Овес', 'ogorod_108_photo.jpg', 5, '2018-09-22 06:47:44', '2018-09-22 06:47:44', NULL),
(109, 'Рожь', 'ogorod_109_photo.jpg', 5, '2018-09-22 06:48:11', '2018-09-22 06:48:11', NULL),
(110, 'Кориандр', 'culture/culture_110_photo_5bcc9bbb60313.jpg', 5, '2018-09-22 06:53:43', '2018-10-26 07:22:49', NULL),
(111, 'Лен', 'culture/culture_111_photo_5bcc9bce42646.jpg', 5, '2018-09-22 06:55:00', '2018-10-26 07:22:49', NULL),
(112, 'Подсолнечник', 'ogorod_112_photo.jpg', 5, '2018-09-22 06:55:28', '2018-09-22 06:56:12', NULL),
(113, 'Кукуруза', 'ogorod_113_photo.jpg', 5, '2018-09-22 06:56:46', '2018-09-22 06:56:46', NULL),
(114, 'Руккола', 'culture/culture_114_photo_5bcc9be26fd0b.jpg', 5, '2018-09-22 07:03:26', '2018-10-26 07:22:49', NULL),
(115, 'Салат', 'ogorod_115_photo.jpg', 5, '2018-09-22 07:03:40', '2018-09-22 07:03:40', NULL),
(116, 'Анис', 'culture_116_photo_5ba8c6aa356f1.jpg', 5, '2018-09-22 07:03:51', '2018-10-26 07:22:49', NULL),
(117, 'Базилик', 'culture/culture_117_photo_5bcc9bec658a7.jpg', 5, '2018-09-22 07:04:03', '2018-10-26 07:22:49', NULL),
(118, 'Укроп', 'ogorod_118_photo.jpg', 5, '2018-09-22 07:04:13', '2018-09-22 07:04:13', NULL),
(119, 'Хлопок', 'ogorod_119_photo.jpg', 5, '2018-09-22 07:04:34', '2018-09-22 07:04:34', NULL),
(120, 'Петрушка', 'ogorod_120_photo.jpg', 5, '2018-09-22 07:04:44', '2018-09-22 07:04:44', NULL),
(121, 'Мята', 'ogorod_121_photo.jpg', 5, '2018-09-22 07:05:01', '2018-09-22 07:05:01', NULL),
(122, 'Сельдерей', 'culture/culture_122_photo_5bcc9bfa1b6f3.jpg', 5, '2018-09-22 07:10:41', '2018-10-26 07:22:49', NULL),
(123, 'Капуста цветная', 'ogorod_123_photo.png', 5, '2018-09-22 07:10:55', '2018-09-22 07:24:13', NULL),
(124, 'Хрен', 'ogorod_124_photo.jpg', 5, '2018-09-22 07:11:31', '2018-09-22 07:11:31', NULL),
(125, 'Спаржа', 'ogorod_125_photo.jpg', 5, '2018-09-22 07:11:45', '2018-09-22 07:11:45', NULL),
(126, 'Шпинат', 'ogorod_126_photo.jpg', 5, '2018-09-22 07:11:59', '2018-10-26 07:22:00', NULL),
(127, 'Тмин', 'ogorod_127_photo.jpg', 5, '2018-09-22 07:12:36', '2018-09-22 07:12:36', NULL),
(128, 'Артишок', 'ogorod_128_photo.jpg', 5, '2018-09-22 07:21:39', '2018-10-26 07:22:00', NULL),
(129, 'Имбирь', 'culture/culture_129_photo_5bcc9c06319bb.jpeg', 5, '2018-09-22 07:21:52', '2018-10-26 07:22:49', NULL),
(130, 'Фасоль', 'ogorod_130_photo.jpg', 5, '2018-09-22 07:22:08', '2018-09-22 07:22:08', NULL),
(131, 'Лук  (на зеленку)', 'ogorod_131_photo.jpg', 5, '2018-09-22 07:22:24', '2018-10-26 07:22:00', NULL),
(132, 'Горох', 'ogorod_132_photo.jpg', 5, '2018-09-22 07:22:41', '2018-10-26 07:22:00', NULL),
(133, 'Лук репчатый', 'ogorod_133_photo.jpg', 5, '2018-09-22 07:22:57', '2018-09-22 07:22:57', NULL),
(134, 'Арахис', 'ogorod_134_photo.png', 5, '2018-09-22 07:23:10', '2018-10-26 07:22:00', NULL),
(135, 'Чеснок', 'ogorod_135_photo.jpg', 5, '2018-09-22 07:23:21', '2018-09-22 07:23:21', NULL),
(136, 'Дыня', 'culture_136_photo_5ba61a2ae1563.jpg', 5, '2018-09-22 07:29:54', '2018-10-26 07:22:49', NULL),
(137, 'Арбуз', 'ogorod_137_photo.gif', 5, '2018-09-22 07:30:09', '2018-09-22 07:30:09', NULL),
(138, 'Баклажан', 'ogorod_138_photo.png', 5, '2018-09-22 07:30:25', '2018-09-22 07:30:25', NULL),
(139, 'Перец сладкий', 'ogorod_139_photo.jpg', 5, '2018-09-22 07:30:50', '2018-09-22 07:30:50', NULL),
(140, 'Перец острый', 'ogorod_140_photo.jpg', 5, '2018-09-22 07:31:08', '2018-09-22 07:31:08', NULL),
(141, 'Кабачки', 'ogorod_141_photo.jpg', 5, '2018-09-22 07:31:23', '2018-10-26 07:22:00', NULL),
(142, 'Тыква', 'ogorod_142_photo.jpeg', 5, '2018-09-22 07:32:49', '2018-09-22 07:32:49', NULL),
(143, 'Мелисса', 'ogorod_143_photo.png', 5, '2018-09-22 07:46:55', '2018-09-22 07:46:55', NULL),
(144, 'Патиссон', 'ogorod_144_photo.jpeg', 5, '2018-09-22 07:47:10', '2018-10-26 07:22:00', NULL),
(145, 'Брюква', 'ogorod_145_photo.jpg', 5, '2018-09-22 07:47:24', '2018-09-22 07:47:24', NULL),
(146, 'Щавель', 'ogorod_146_photo.jpg', 5, '2018-09-22 07:47:37', '2018-10-26 07:22:00', NULL),
(147, 'Цукини', 'ogorod_147_photo.jpg', 5, '2018-09-22 07:47:51', '2018-09-22 07:47:51', NULL),
(148, 'Фенхель', 'ogorod_148_photo.jpg', 5, '2018-09-22 07:48:06', '2018-09-22 07:48:06', NULL),
(149, 'Маслята', 'ogorod_149_photo.jpg', 5, '2018-09-22 07:51:24', '2018-10-26 07:22:00', NULL),
(150, 'Опята', 'ogorod_150_photo.jpg', 5, '2018-09-22 07:51:36', '2018-09-22 07:51:36', NULL),
(151, 'Белый гриб', 'ogorod_151_photo.jpg', 5, '2018-09-22 07:51:51', '2018-10-26 07:22:00', NULL),
(152, 'Лисички', 'ogorod_152_photo.jpg', 5, '2018-09-22 07:52:04', '2018-09-22 07:52:04', NULL),
(153, 'Шампиньон', 'ogorod_153_photo.jpg', 5, '2018-09-22 07:52:23', '2018-09-22 07:52:23', NULL),
(154, 'Вешенки', 'culture_154_photo_5ba8c6daa775f.jpeg', 5, '2018-09-22 12:39:20', '2018-10-26 07:22:49', NULL),
(155, 'Агератум', 'culture_155_photo_5ba6633b92fd1.jpg', 4, '2018-09-22 12:43:46', '2018-09-22 12:43:55', NULL),
(156, 'Азарина', 'klumba_156_photo.jpg', 4, '2018-09-22 12:46:20', '2018-09-22 12:46:20', NULL),
(157, 'Алиссум', 'klumba_157_photo.jpg', 4, '2018-09-22 12:49:00', '2018-09-22 12:49:00', NULL),
(158, 'Амарант', 'culture_158_photo_5ba88d124af73.jpg', 4, '2018-09-22 12:50:34', '2018-10-26 07:22:49', NULL),
(159, 'Антирринум', 'klumba_159_photo.jpg', 4, '2018-09-22 12:53:40', '2018-09-22 12:53:40', NULL),
(160, 'Астры', 'klumba_160_photo.jpg', 4, '2018-09-22 12:55:05', '2018-09-22 12:55:05', NULL),
(161, 'Бальзамин', 'klumba_161_photo.jpg', 4, '2018-09-22 12:56:08', '2018-09-22 12:56:08', NULL),
(162, 'Барвинка', 'klumba_162_photo.jpg', 4, '2018-09-22 12:57:04', '2018-09-22 12:57:04', NULL),
(163, 'Бархатцы', 'klumba_163_photo.jpg', 4, '2018-09-22 12:59:25', '2018-09-22 12:59:25', NULL),
(164, 'Бегония', 'klumba_164_photo.jpg', 4, '2018-09-22 13:01:05', '2018-09-22 13:01:05', NULL),
(165, 'Брахикома', 'culture_165_photo_5bab241c3d3b6.jpg', 4, '2018-09-22 15:24:51', '2018-10-26 07:22:49', NULL),
(166, 'Василек', 'klumba_166_photo.jpg', 4, '2018-09-22 15:26:21', '2018-09-22 15:26:21', NULL),
(167, 'Вербена', 'klumba_167_photo.jpg', 4, '2018-09-22 15:28:14', '2018-09-22 15:28:14', NULL),
(168, 'Вьюнок', 'klumba_168_photo.jpg', 4, '2018-09-22 15:29:46', '2018-09-22 15:29:46', NULL),
(169, 'Газания', 'klumba_169_photo.jpg', 4, '2018-09-22 15:30:39', '2018-09-25 09:28:18', NULL),
(170, 'Гвоздика', 'klumba_170_photo.jpg', 4, '2018-09-22 15:31:29', '2018-09-22 15:31:29', NULL),
(171, 'Георгин', 'klumba_171_photo.jpg', 4, '2018-09-22 15:32:52', '2018-09-22 15:32:52', NULL),
(172, 'Гипсофила', 'klumba_172_photo.jpg', 4, '2018-09-22 15:34:28', '2018-09-22 15:34:28', NULL),
(173, 'Датура(дурман)', 'klumba_173_photo.jpg', 4, '2018-09-22 15:36:09', '2018-09-22 15:36:09', NULL),
(174, 'Дельфиниум', 'klumba_174_photo.jpg', 4, '2018-09-22 15:38:01', '2018-09-22 15:38:01', NULL),
(175, 'Диморфотек', 'klumba_175_photo.jpg', 4, '2018-09-22 15:40:13', '2018-09-22 15:40:13', NULL),
(176, 'Душистый горошек', 'klumba_176_photo.jpg', 4, '2018-09-22 15:41:53', '2018-09-22 15:41:53', NULL),
(177, 'Иберис', 'klumba_177_photo.jpg', 4, '2018-09-22 15:44:25', '2018-09-22 15:44:25', NULL),
(178, 'Ипомея', 'klumba_178_photo.jpg', 4, '2018-09-22 15:46:06', '2018-09-22 15:46:06', NULL),
(179, 'Календула', 'klumba_179_photo.jpg', 4, '2018-09-22 15:46:59', '2018-09-22 15:46:59', NULL),
(180, 'Кларкия', 'klumba_180_photo.jpg', 4, '2018-09-22 15:48:12', '2018-09-22 15:48:12', NULL),
(181, 'Клеома', 'klumba_181_photo.jpg', 4, '2018-09-22 15:49:32', '2018-09-22 15:49:32', NULL),
(182, 'Клещевина', 'klumba_182_photo.jpg', 4, '2018-09-22 15:51:36', '2018-09-22 15:51:36', NULL),
(183, 'Колеус', 'klumba_183_photo.jpg', 4, '2018-09-22 15:52:57', '2018-09-22 15:52:57', NULL),
(184, 'Кореопсис', 'klumba_184_photo.jpg', 4, '2018-09-22 15:53:57', '2018-09-22 15:53:57', NULL),
(185, 'Космея', 'klumba_185_photo.jpg', 4, '2018-09-22 15:54:57', '2018-09-22 15:54:57', NULL),
(186, 'Лаватера', 'klumba_186_photo.jpg', 4, '2018-09-22 15:57:30', '2018-09-22 15:57:30', NULL),
(187, 'Левкой', 'klumba_187_photo.jpg', 4, '2018-09-22 15:58:59', '2018-09-22 15:58:59', NULL),
(188, 'Лобелия', 'klumba_188_photo.jpg', 4, '2018-09-22 16:01:26', '2018-09-22 16:01:26', NULL),
(189, 'Лобулярия', 'klumba_189_photo.jpg', 4, '2018-09-22 16:02:40', '2018-09-22 16:02:40', NULL),
(190, 'Мак', 'klumba_190_photo.jpg', 4, '2018-09-22 16:04:05', '2018-09-22 16:04:05', NULL),
(191, 'Маттиола', 'klumba_191_photo.jpg', 4, '2018-09-22 16:05:39', '2018-09-22 16:05:53', NULL),
(192, 'Мимулюс', 'klumba_192_photo.jpg', 4, '2018-09-22 16:07:11', '2018-09-22 16:07:11', NULL),
(193, 'Настурция', 'klumba_193_photo.jpg', 4, '2018-09-22 16:08:07', '2018-09-22 16:08:07', NULL),
(194, 'Немезия', 'klumba_194_photo.jpg', 4, '2018-09-22 16:09:27', '2018-09-22 16:09:27', NULL),
(195, 'Немофила', 'klumba_195_photo.jpg', 4, '2018-09-22 16:18:19', '2018-09-22 16:18:19', NULL),
(196, 'Нигелла', 'klumba_196_photo.jpg', 4, '2018-09-22 16:19:25', '2018-09-22 16:19:25', NULL),
(197, 'Остеоспермум', 'klumba_197_photo.jpg', 4, '2018-09-22 16:22:22', '2018-09-22 16:22:22', NULL),
(198, 'Пеларгония', 'klumba_198_photo.jpg', 4, '2018-09-22 16:24:28', '2018-09-22 16:24:28', NULL),
(199, 'Петуния', 'klumba_199_photo.jpg', 4, '2018-09-22 16:27:06', '2018-09-22 16:27:06', NULL),
(200, 'Портулак', 'klumba_200_photo.jpg', 4, '2018-09-22 16:29:59', '2018-09-22 16:29:59', NULL),
(201, 'Рудбекия', 'klumba_201_photo.jpg', 4, '2018-09-22 16:31:48', '2018-09-22 16:31:48', NULL),
(202, 'Сальвия', 'klumba_202_photo.jpg', 4, '2018-09-22 16:33:19', '2018-09-22 16:33:19', NULL),
(203, 'Флокс', 'klumba_203_photo.jpg', 4, '2018-09-22 16:33:55', '2018-09-22 16:33:55', NULL),
(204, 'Хризантема', 'klumba_204_photo.jpg', 4, '2018-09-22 16:36:45', '2018-09-22 16:36:45', NULL),
(205, 'Целозия', 'klumba_205_photo.jpg', 4, '2018-09-22 16:38:39', '2018-09-22 16:38:39', NULL),
(206, 'Цинерария', 'klumba_206_photo.jpg', 4, '2018-09-22 16:41:40', '2018-09-22 16:41:40', NULL),
(207, 'Цинния', 'klumba_207_photo.jpg', 4, '2018-09-22 16:43:03', '2018-09-22 16:43:03', NULL),
(208, 'Эустома', 'klumba_208_photo.jpg', 4, '2018-09-22 16:44:47', '2018-09-22 16:44:47', NULL),
(209, 'Эшшольция', 'klumba_209_photo.jpg', 4, '2018-09-22 16:45:45', '2018-09-22 16:45:45', NULL),
(210, 'Клематис', 'klumba_210_photo.jpg', 4, '2018-09-24 08:27:08', '2018-09-24 08:27:08', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `decorator_photos`
--

CREATE TABLE `decorator_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `decorator_photos`
--

INSERT INTO `decorator_photos` (`id`, `project_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'bolesn2.jpg', NULL, NULL),
(2, 1, 'bolesn1.jpg', NULL, NULL),
(3, 4, 'decorators/4/15323581480-02-01-9ab81e0a7e3bfb7b1251e1d50c3e1c8237178872093ddd4c9cca5056eb995490_c07be4b0.jpg', '2018-07-23 12:02:28', '2018-07-23 12:02:28'),
(4, 4, 'decorators/4/15323589000-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', '2018-07-23 12:15:00', '2018-07-23 12:15:00'),
(5, 4, 'decorators/4/15323589100-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', '2018-07-23 12:15:10', '2018-07-23 12:15:10'),
(6, 4, 'decorators/4/15323589530-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', '2018-07-23 12:15:53', '2018-07-23 12:15:53'),
(7, 4, 'decorators/4/15323590370-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', '2018-07-23 12:17:17', '2018-07-23 12:17:17');

-- --------------------------------------------------------

--
-- Структура таблицы `decorator_projects`
--

CREATE TABLE `decorator_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `decorator_projects`
--

INSERT INTO `decorator_projects` (`id`, `user_id`, `project_title`, `description`, `main_photo`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 21, 'Проект', 'авно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 'decorators/4/15323589530-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', 1, NULL, '2018-07-23 12:15:53'),
(2, 21, 'Проект 2', 'авно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 'фото2', 0, NULL, NULL),
(3, 61, 'Проект', 'авно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 'bolesn2.jpg', 0, NULL, NULL),
(4, 61, 'Проект 2', 'авно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 'decorators/4/15323590370-02-04-2fd0591b3cb899efa89dafc67d5b471cbd933868f53283f6d21fdc8d9a906da4_ad50395d.jpg', 0, NULL, '2018-07-23 12:17:17');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Самовывоз', NULL, '2018-10-18 03:30:15'),
(2, 'Почта РФ', NULL, '2018-10-18 03:30:15'),
(3, 'CDЭК', NULL, '2018-10-18 03:30:15'),
(4, 'Деловые линии', NULL, '2018-10-18 03:30:15');

-- --------------------------------------------------------

--
-- Структура таблицы `diseases`
--

CREATE TABLE `diseases` (
  `id` int(10) UNSIGNED NOT NULL,
  `culture_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '6',
  `name` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fight` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `diseases`
--

INSERT INTO `diseases` (`id`, `culture_id`, `section_id`, `name`, `slug`, `main_photo`, `description`, `fight`, `date`, `created_at`, `updated_at`) VALUES
(38, 0, 6, 'Парша', 'Парша', 'disease_38_photo_5ba0a7f3d0d3d.jpg', 'Первые признаки заболевания     На листьях не сразу появляются характерные черные пятна с бархатистым налетом. Вначале болезнь на листьях заметна в виде не четких, округлых расплывчатых хлоротичных пятен. К этому времени гриб уже успел причинить вред, начав разрушать растительные ткани. Через несколько дней пятна приобретают видимые признаки темных пятен с характерным бархатистым налетом. При благоприятных условиях гриб распространяется по всей кроне.\r\n\r\nПрофилактика парши яблонь и груш     Кроны деревьев должны хорошо освещаться солнцем, быстро продуваться ветром при влажной погоде. Для этого необходима ежегодная обрезка кроны. Хорошо освещенная и быстро продуваемая крона яблони меньше подвержена заражению.     Приствольные круги лучше содержать под черным паром в течении всего периода вегетации. Это снижает вредоносность парши.     Практически единственным источником весенней инфекции являются опавшие листья, пораженные паршой в пошлом сезоне. Чтобы защитить свои деревья от болезни, нужно осенью тщательно собрать и заделать в землю всю опавшую листву, перекопать междурядья с заделкой листьев в почву.  На грушах следует уничтожать не только листья, но пораженные паршой побеги.&nbsp;&nbsp;', 'Как лечить паршу яблони и груши     Если болезнь только начинается, или проявляется слабо, можно обработать яблони агатом — 25 К или цирконом.     Лечение  «Бордоской смесью»     Наиболее известным и проверенным способом лечения парши яблони и груши, является бордоская жидкость. Действие бордоской жидкости сохраняется до двух недель, поэтому за один сезон приходится делать 6 — 7 обработок.     Самое первое опрыскивание делается перед распусканием почек. ( 300 гр. медного купороса, 350 гр. извести развести в ведре воды )     Последующие обработки проводят через каждые две недели. Концентрацию раствора делают слабее ( 100 гр. медного купороса, 100 гр. извести на ведро воды ) Бордоскую жидкость допускается заменить на любой другой медьсодержащий препарат. Опрыскивание яблони.     Лечение  препаратами системного действия     Скор. За один сезон допустимо сделать две обработки этим препаратом. Обработки проводят с интервалом в 2 недели, до цветения и сразу после цветения ( 2 мл. на 10л. воды ) Препарат сохраняет свое действие 20 дней.     Строби. «Строби» используется для лечения парши яблони, груши, мучнистой росы. За лето можно провести до 3 обработок, интервал — 2 недели. Срок действия препарата — 35 дней. Применение «Строби» можно совмещать с другими фунгицидами.     Хорус. Препарат эффективен при низких + 3 — 10*С температурах, не смывается дождем. Обработки проводят дважды за сезон, при распускании почек и в самом конце цветения. Срок действия — 30 дней.     Лечение минеральными удобрениями     Лечить паршу  можно с помощью мин. удобрений. В этом случае одновременно с лечением проводится и внекорневая подкормка растений. Деревья опрыскивают раствором любого из этих удобрений: аммиачная селитра, концентрация 10% сульфат аммония, концентрация 10% хлористый калий, концентрация 3 — 10% сульфат калия, концентрация 3 — 10% калийная селитра, концентрация 5 — 15% калийная соль, концентрация 5 — 10%     Комплексное лечение   Чтобы добиться наилучших результатов, следует использовать комплексный подход для лечения парши.     Для этого осенью обрабатывают деревья одним из растворов мин. удобрения (как описано выше ). Обработку проводят после сбора урожая, перед листопадом. Температура воздуха должна быть не ниже +4*С. Это будет способствовать уничтожению и других вредителей, да еще и повысит урожайность яблони.     Весной перед цветением опрыскивают деревья и приствольные круги бордоской жидкостью ( или любым другим медьсодержащим препаратом ).     После цветения проводят опрыскивание деревьев каким либо фунгицидом ( строби, скор ) или любым другим.     Чтобы облегчить уход за садом, подбирайте сорта яблонь и груш устойчивых к этому распространенному заболеванию.', '2018-09-18', '2018-09-18 04:23:31', '2018-10-17 06:05:03'),
(46, 0, 6, 'Цитоспороз', 'Цитоспороз', 'disease_46_photo_5bcca36c142e0.jpg', '<p>\r\n\r\n</p><p><b>Цитоспороз </b>- на коре появляются мелкие небольшие бугорки серого цвета, которые и являются грибковым заболеванием. Листья на таких побегах постепенно засыхают, за ними засыхает побег и , если не принимать никаких действий, умирает все растение.</p>\r\n\r\n<br><p></p>', '<p><b>Профилактика:</b></p><p>- своевременное удаление сухих веток, чтобы заболевание не распространялось на здоровые побеги.</p><p>- в качестве профилактики каждый год весной опрыскивание деревьев 1%-ной бордоской смесью или другим <b><u>медьсодержащим</u></b> препаратом.\r\n\r\n<br></p>', '2018-10-21', '2018-10-21 13:03:56', '2018-10-21 13:03:56'),
(47, 0, 6, 'Бактериальный некроз, или рак (ожог)', 'Бактериальный некроз, или рак (ожог)', 'disease_47_photo_5bcca4f4c1cea.jpg', '<p>\r\n\r\n<b>Бактериальный рак </b>поражает все дерево. Может проявляться в различном виде но самым популярным является появление весной ожогов на растении, после чего на их месте происходит образование язв и течет камедь.Постепенно дерево отмирает.&nbsp; Болезнь может перебираться на семечковые типы растений и на сирень. Если рядом находятся эти растения - необходимо производить разв год их профилактический осмотр.&nbsp;<br></p>', '<p>\r\n\r\n</p><p>При первых признаках болезни нужно обрезать пораженные ветки до здоровой ткани и сжечь их. Срезы продезинфицировать 1% раствором медного купороса&nbsp; (CuSO4) и замазать садовым варом. В профилактических целях необходимо опрыскивать деревья 1% бордоской жидкостью – весной и летом и 3%-й бордоской жидкостью – осенью во время листопада.</p><p>Своевременно удалять камедь. Почву в том месте, где раньше росли пораженные деревья, посыпьте хлорной известью (200 г на 1 кв.м) и необходимо мерекопать.&nbsp;</p><p><b>Устойчивые к заболеванию сорта:</b></p><p><b>\r\n\r\n<em>Ананасный цюрупинский, Венгерский лучший, Выносливый, Комсомолец, Краснощекий, Никитский, Парнас, Шиндахлан</em>.\r\n\r\n<br></b></p><p><br></p>\r\n\r\n<br><p></p>', '2018-10-21', '2018-10-21 13:10:28', '2018-10-21 13:21:24'),
(48, 0, 6, 'Монилиальный ожог (монилиоз)', 'Монилиальный ожог (монилиоз)', 'disease_48_photo_5bccb0a43aa80.jpg', '<p>\r\n\r\nБлагоприятным условием развития болезни является сырая и влажная погода. Чаще всего растения заражаются монилиозом во время цветения. В результате побеги и листья засыхают и отмирают. Болезнь на плодах проявляется в виде гнили и белесого грибкового налета.<br></p>', '<p>- своевременный сбор и уничтожение (сжигание) поврежденных побегов и плодов. - обработка во время цветения 3% бордоской смесью.&nbsp;</p><p>- обработка кроны заболевшего растения Топсином-М, Строби или Топазом (по инструкции) с добавлением в раствор хозяйственного мыла.&nbsp;<br></p>', '2018-10-21', '2018-10-21 14:00:00', '2018-10-21 14:00:33');

-- --------------------------------------------------------

--
-- Структура таблицы `disease_chemicals`
--

CREATE TABLE `disease_chemicals` (
  `id` int(10) UNSIGNED NOT NULL,
  `disease_id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `disease_chemicals`
--

INSERT INTO `disease_chemicals` (`id`, `disease_id`, `chemical_id`, `created_at`, `updated_at`) VALUES
(16, 38, 27, '2018-10-12 10:37:47', '2018-10-12 10:37:47'),
(17, 46, 28, '2018-10-21 13:03:56', '2018-10-21 13:03:56'),
(18, 47, 28, '2018-10-21 13:14:04', '2018-10-21 13:14:04'),
(19, 48, 28, '2018-10-21 14:00:00', '2018-10-21 14:00:00'),
(20, 48, 36, '2018-10-21 14:21:08', '2018-10-21 14:21:08'),
(21, 48, 37, '2018-10-21 14:34:22', '2018-10-21 14:34:22');

-- --------------------------------------------------------

--
-- Структура таблицы `ethnosciences`
--

CREATE TABLE `ethnosciences` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_day` int(2) NOT NULL,
  `start_month` int(2) NOT NULL,
  `end_day` int(2) NOT NULL,
  `end_month` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ethnosciences`
--

INSERT INTO `ethnosciences` (`id`, `title`, `description`, `start_day`, `start_month`, `end_day`, `end_month`, `created_at`, `updated_at`) VALUES
(1, 'Никита.', 'Никита. Если к этому дню лед не прошел, то лов рыбы обещает быть плохим.', 17, 4, 17, 4, NULL, '2018-10-17 03:06:13'),
(2, 'Ирина-рассадница.', 'Ирина-рассадница. Земледельцы в этот день высаживали рассаду в грунт.', 30, 4, 30, 4, NULL, '2018-10-17 03:06:13'),
(6, 'Зосима-печальник.', 'Зосима-печальник. В этот день повсеместно выставляли ульи из омшаников.', 1, 5, 1, 5, '2018-10-17 03:05:17', '2018-10-17 03:05:17'),
(7, 'Кузьма.', 'Кузьма, покровитель коров в старой Руси. Крестьяне средней полосы России заметили, что именно в этот день лучше всего сеять морковь и свеклу.', 2, 5, 2, 5, '2018-10-17 03:07:05', '2018-10-17 03:07:05'),
(8, 'Егорий.', 'После Егория вешнего бывает ещё 20 морозов.', 7, 5, 7, 5, '2018-10-17 03:07:56', '2018-10-17 03:07:56'),
(9, 'Тест октябрь', 'Примета 1. Лорем ипсун и т.д.', 15, 10, 16, 10, '2018-10-18 07:58:07', '2018-10-18 07:58:07'),
(10, 'Тест сентябрь - октябрь', 'Новая примета. Если вы ее видите на экране, значит, вы ее видите на экране', 10, 9, 15, 12, '2018-10-18 07:59:46', '2018-10-18 07:59:46');

-- --------------------------------------------------------

--
-- Структура таблицы `ethnoscience_months`
--

CREATE TABLE `ethnoscience_months` (
  `id` int(10) UNSIGNED NOT NULL,
  `ethnoscience_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ethnoscience_months`
--

INSERT INTO `ethnoscience_months` (`id`, `ethnoscience_id`, `month`, `created_at`, `updated_at`) VALUES
(12, 2, 4, NULL, NULL),
(23, 1, 4, '2018-10-08 10:49:27', '2018-10-08 10:49:27'),
(45, 6, 5, '2018-10-17 03:05:17', '2018-10-17 03:05:17'),
(46, 7, 5, '2018-10-17 03:07:05', '2018-10-17 03:07:05'),
(47, 8, 5, '2018-10-17 03:07:56', '2018-10-17 03:07:56'),
(48, 9, 10, '2018-10-18 07:58:07', '2018-10-18 07:58:07'),
(49, 10, 9, '2018-10-18 07:59:46', '2018-10-18 07:59:46'),
(50, 10, 10, '2018-10-18 07:59:46', '2018-10-18 07:59:46'),
(51, 10, 11, '2018-10-18 07:59:46', '2018-10-18 07:59:46'),
(52, 10, 12, '2018-10-18 07:59:46', '2018-10-18 07:59:46');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `event_category_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` int(11) NOT NULL DEFAULT '0',
  `main_photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `date`, `event_category_id`, `description`, `participants`, `main_photo`, `created_at`, `updated_at`) VALUES
(3, 61, 'VII \"Moscow Flower Show\"', '2018-11-02', 3, '<p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>', 3, 'event_3_photo_5bc98f2d6b811.jpg', '2018-08-21 11:03:55', '2018-10-19 05:00:45'),
(13, 61, 'фильтр', '2018-09-20', 0, 'фильтр', 0, 'event/event__photo_5bae1c846fe8c.jpg', '2018-09-28 09:20:20', '2018-09-28 09:20:20'),
(15, 61, 'Мероприятие', '2018-11-20', 0, 'Мероприятие в ноябре', 0, 'event/event__photo_5bae21a8b59cc.jpg', '2018-09-28 09:42:16', '2018-09-28 09:42:16'),
(16, 61, 'Еще мероприятие', '2018-11-20', 0, 'фильтр', 0, 'event/event__photo_5bae21dfdbfed.jpg', '2018-09-28 09:43:11', '2018-09-28 09:43:11'),
(17, 61, 'фильтр', '2018-09-20', 0, 'фильтр', 0, 'event/event__photo_5bae221299cda.jpg', '2018-09-28 09:44:02', '2018-09-28 09:44:02'),
(30, 61, 'Мероприятие 30', '2018-09-20', 0, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"<br>', 0, 'event/event_30_photo_5bae51e2222ce.jpg', '2018-09-28 12:50:38', '2018-10-11 07:56:00'),
(42, 0, '', '2018-10-19', 0, '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n<br><p></p>', 0, 'event_42_photo_5bc9afa1970e0.jpg', '2018-10-19 07:17:05', '2018-10-19 07:19:13'),
(43, 0, '111', '2018-10-17', 0, '<p>\r\n\r\n</p><p><strong><img alt=\"\" src=\"http://\">VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.</p><p><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 1, 'event_43_photo_5bc9afdc4f67f.jpg', '2018-10-19 07:20:12', '2018-10-24 05:44:17'),
(44, 0, '111', '2018-10-10', 0, '<p>\r\n\r\n</p><p><strong><img alt=\"\" src=\"http://78.155.206.219/backend/public/storage/event_44_photo_5bc9aff10268e.jpg\"><br></strong></p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 1, 'event_44_photo_5bc9aff10268e.jpg', '2018-10-19 07:20:33', '2018-10-23 05:37:08'),
(45, 0, '222', '2018-10-10', 0, '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 1, 'event_45_photo_5bc9b007967fa.jpg', '2018-10-19 07:20:55', '2018-10-24 16:24:15'),
(46, 0, '333', '2018-10-10', 0, '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event_46_photo_5bc9b01e6527c.jpg', '2018-10-19 07:21:18', '2018-10-19 10:33:35'),
(47, 0, '333', '2018-10-18', 0, '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.</p><p><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event_47_photo_5bc9b02eaa315.jpg', '2018-10-19 07:21:34', '2018-10-19 10:33:51'),
(48, 0, '444', '2018-10-20', 0, '', 0, 'event_48_photo_5bc9b03d2a734.jpg', '2018-10-19 07:21:49', '2018-10-24 16:12:22'),
(49, 0, '444', '2018-10-31', 0, '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event_49_photo_5bc9b053584e8.jpg', '2018-10-19 07:22:11', '2018-10-19 07:22:11');

-- --------------------------------------------------------

--
-- Структура таблицы `event_participants`
--

CREATE TABLE `event_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `event_participants`
--

INSERT INTO `event_participants` (`id`, `event_id`, `participant_id`, `created_at`, `updated_at`) VALUES
(5, 3, 12, NULL, NULL),
(6, 3, 63, '2018-07-27 06:07:08', '2018-07-27 06:07:08'),
(9, 3, 23, '2018-10-23 05:36:33', '2018-10-23 05:36:33'),
(10, 44, 23, '2018-10-23 05:37:08', '2018-10-23 05:37:08'),
(11, 43, 32, '2018-10-24 05:44:17', '2018-10-24 05:44:17'),
(13, 45, 61, '2018-10-24 16:24:15', '2018-10-24 16:24:15');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cooperation',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `text`, `type`, `is_read`, `created_at`, `updated_at`) VALUES
(153, 'sdfsdf@fsdf.sdf', 'sdfdf', 'cooperation', 0, '2018-10-16 11:13:24', '2018-10-16 11:13:24'),
(154, 'sdf@dsdgs.dg', 'sdfsgd', 'cooperation', 0, '2018-10-16 11:18:32', '2018-10-16 11:18:32'),
(155, 'sdfij@sdf.sdfsdf', 'fsgsdg', 'cooperation', 0, '2018-10-17 09:14:20', '2018-10-17 09:14:20'),
(156, '11@11.ru', '111', 'cooperation', 0, '2018-10-23 05:51:13', '2018-10-23 05:51:13'),
(157, '111@111.ru', '111', 'cooperation', 0, '2018-10-25 05:25:47', '2018-10-25 05:25:47'),
(158, '111@111.ru', '111', 'cooperation', 0, '2018-10-25 05:25:59', '2018-10-25 05:25:59'),
(159, 'sdgf@mail.ru', NULL, 'tariff', 0, '2018-10-25 08:30:58', '2018-10-25 08:30:58');

-- --------------------------------------------------------

--
-- Структура таблицы `filter_attributes`
--

CREATE TABLE `filter_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filter_attributes`
--

INSERT INTO `filter_attributes` (`id`, `section_id`, `culture_id`, `type`, `name`) VALUES
(5, 4, 0, 'disease', 'Повреждение листовой части'),
(6, 4, 0, 'disease', 'Повреждение ствола:'),
(8, 0, 0, 'chemical', 'Тип'),
(9, 0, 0, 'chemical', 'Производитель'),
(14, 4, 0, 'culture', 'Тип области выращивания'),
(16, 4, 0, 'question', 'Категория вопросов'),
(27, 6, 0, 'culture', 'Тип плода'),
(28, 6, 0, 'sort', 'Скорость созревания'),
(30, 6, 0, 'sort', 'Форма ствола'),
(31, 6, 0, 'sort', 'Срок хранения'),
(32, 6, 0, 'sort', 'Вкусовые качества'),
(33, 6, 0, 'sort', 'Прочее'),
(35, 5, 0, 'sort', 'Срок жизни'),
(36, 5, 0, 'sort', 'Скорость созревания'),
(37, 5, 0, 'sort', 'Срок хранения'),
(38, 5, 0, 'sort', 'Урожайность'),
(39, 5, 0, 'sort', 'Прочее'),
(40, 5, 0, 'sort', 'Цвет'),
(50, 6, 0, 'culture', 'По морфологическому признаку'),
(51, 5, 0, 'culture', 'По морфологическому признаку'),
(53, 5, 0, 'sort', 'Способ выращивания'),
(56, 4, 0, 'culture', 'По назначению'),
(58, 0, 0, 'chemical', 'Основное вещество'),
(85, 4, 0, 'culture', 'Прочее'),
(86, 4, 0, 'sort', 'Срок жизни'),
(87, 4, 0, 'sort', 'Время суток цветения'),
(89, 4, 0, 'sort', 'Наличие запаха'),
(90, 4, 0, 'sort', 'Прочее'),
(91, 4, 0, 'sort', 'Форма растения'),
(92, 0, 0, 'event', 'Тип мероприятия'),
(95, 0, 0, 'decorator', 'Специализация мастера'),
(139, 6, 58, 'sort', 'Цвет плода'),
(142, 6, 0, 'sort', 'Размещение на участке'),
(143, 6, 58, 'sort', 'Особенности ухода'),
(145, 0, 0, 'seller', 'Тип поставщика'),
(147, 5, 0, 'handbook', 'Категория статей'),
(148, 6, 0, 'handbook', 'Категория статей'),
(149, 6, 58, 'sort', 'Районированность'),
(150, 6, 0, 'question', 'Категория топиков'),
(151, 5, 0, 'question', 'Категория топиков'),
(152, 4, 0, 'handbook', 'Категория статей'),
(153, 4, 0, 'question', 'Категория топиков'),
(171, 6, 0, 'handbook', 'Категории статей'),
(172, 0, 0, 'decorator', 'Область работы мастера'),
(173, 4, 0, 'pest', 'Повреждение листьев'),
(174, 4, 0, 'pest', 'Повреждение ствола'),
(175, 4, 0, 'pest', 'Повреждение соцветий'),
(176, 5, 0, 'pest', 'Повреждение листовой части'),
(178, 6, 0, 'pest', 'Повреждение плодов'),
(180, 6, 0, 'pest', 'Повреждение листьев'),
(181, 5, 0, 'pest', 'Повреждение плодов'),
(182, 6, 0, 'pest', 'Повреждение ствола'),
(183, 4, 0, 'disease', 'Повреждение плодов'),
(184, 5, 0, 'disease', 'Повреждение плодов'),
(185, 5, 0, 'disease', 'Повреждение листовой части'),
(187, 6, 0, 'disease', 'Повреждение плодов'),
(188, 6, 0, 'disease', 'Повреждение листовой части'),
(190, 6, 0, 'disease', 'Повреждение ствола');

-- --------------------------------------------------------

--
-- Структура таблицы `filter_attr_entities`
--

CREATE TABLE `filter_attr_entities` (
  `id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filter_attr_entities`
--

INSERT INTO `filter_attr_entities` (`id`, `entity_id`, `entity_type`, `attribute_id`, `attribute_value`) VALUES
(106, 1, 'culture', 27, '64'),
(107, 1, 'culture', 50, '156'),
(108, 4, 'culture', 27, '64'),
(109, 4, 'culture', 50, '156'),
(110, 52, 'culture', 27, '66'),
(111, 53, 'culture', 27, '66'),
(112, 53, 'culture', 50, '157'),
(113, 54, 'culture', 27, '65'),
(115, 55, 'culture', 27, '65'),
(116, 55, 'culture', 50, '156'),
(117, 56, 'culture', 27, '66'),
(119, 35, 'sort', 28, '69'),
(121, 35, 'sort', 30, '77'),
(122, 35, 'sort', 31, '78'),
(123, 35, 'sort', 32, '82'),
(124, 35, 'sort', 33, '86'),
(125, 35, 'sort', 33, '88'),
(129, 37, 'sort', 28, '69'),
(131, 37, 'sort', 30, '77'),
(132, 37, 'sort', 31, '79'),
(133, 37, 'sort', 32, '81'),
(134, 37, 'sort', 33, '86'),
(140, 27, 'chemical', 8, '22'),
(141, 27, 'chemical', 58, '204'),
(142, 52, 'culture', 50, '161'),
(143, 57, 'culture', 27, '65'),
(144, 57, 'culture', 50, '156'),
(145, 58, 'culture', 27, '65'),
(146, 58, 'culture', 50, '156'),
(147, 59, 'culture', 27, '65'),
(148, 59, 'culture', 50, '156'),
(149, 60, 'culture', 27, '64'),
(151, 61, 'culture', 27, '64'),
(152, 61, 'culture', 50, '156'),
(153, 62, 'culture', 27, '64'),
(155, 63, 'culture', 27, '65'),
(158, 64, 'culture', 27, '66'),
(159, 64, 'culture', 50, '157'),
(160, 65, 'culture', 27, '65'),
(161, 65, 'culture', 50, '159'),
(162, 66, 'culture', 27, '66'),
(163, 66, 'culture', 27, '163'),
(164, 66, 'culture', 50, '160'),
(165, 67, 'culture', 27, '66'),
(166, 67, 'culture', 50, '157'),
(167, 68, 'culture', 27, '64'),
(168, 68, 'culture', 50, '159'),
(169, 69, 'culture', 27, '64'),
(171, 70, 'culture', 27, '66'),
(172, 70, 'culture', 50, '157'),
(173, 71, 'culture', 27, '64'),
(176, 72, 'culture', 27, '66'),
(177, 72, 'culture', 50, '157'),
(182, 74, 'culture', 27, '66'),
(183, 74, 'culture', 50, '157'),
(184, 75, 'culture', 27, '164'),
(185, 75, 'culture', 50, '161'),
(186, 76, 'culture', 27, '67'),
(187, 76, 'culture', 27, '164'),
(188, 76, 'culture', 50, '248'),
(190, 77, 'culture', 27, '164'),
(191, 77, 'culture', 50, '156'),
(192, 78, 'culture', 27, '162'),
(193, 78, 'culture', 27, '164'),
(194, 78, 'culture', 50, '156'),
(195, 79, 'culture', 27, '162'),
(196, 79, 'culture', 27, '164'),
(197, 79, 'culture', 50, '156'),
(200, 80, 'culture', 27, '164'),
(201, 80, 'culture', 50, '156'),
(203, 81, 'culture', 27, '164'),
(204, 81, 'culture', 50, '159'),
(205, 82, 'culture', 27, '66'),
(206, 82, 'culture', 50, '157'),
(207, 83, 'culture', 27, '66'),
(208, 83, 'culture', 50, '157'),
(209, 84, 'culture', 27, '66'),
(210, 84, 'culture', 50, '157'),
(211, 85, 'culture', 27, '65'),
(212, 85, 'culture', 50, '156'),
(214, 86, 'culture', 27, '162'),
(215, 86, 'culture', 27, '164'),
(216, 86, 'culture', 50, '156'),
(218, 87, 'culture', 27, '162'),
(219, 87, 'culture', 27, '164'),
(220, 87, 'culture', 50, '156'),
(221, 88, 'culture', 27, '164'),
(222, 88, 'culture', 50, '248'),
(225, 89, 'culture', 27, '164'),
(228, 90, 'culture', 27, '164'),
(230, 90, 'culture', 50, '160'),
(231, 90, 'culture', 50, '248'),
(233, 91, 'culture', 50, '156'),
(234, 92, 'culture', 27, '66'),
(235, 92, 'culture', 50, '161'),
(236, 93, 'culture', 51, '168'),
(237, 94, 'culture', 51, '167'),
(238, 95, 'culture', 51, '167'),
(239, 96, 'culture', 51, '171'),
(240, 97, 'culture', 51, '168'),
(241, 98, 'culture', 51, '168'),
(242, 99, 'culture', 51, '168'),
(243, 100, 'culture', 51, '168'),
(244, 101, 'culture', 51, '168'),
(245, 102, 'culture', 51, '168'),
(246, 103, 'culture', 51, '184'),
(247, 104, 'culture', 51, '184'),
(248, 105, 'culture', 51, '175'),
(249, 106, 'culture', 51, '184'),
(250, 107, 'culture', 51, '184'),
(251, 108, 'culture', 51, '184'),
(252, 109, 'culture', 51, '184'),
(253, 110, 'culture', 51, '173'),
(259, 116, 'culture', 51, '173'),
(260, 117, 'culture', 51, '173'),
(261, 118, 'culture', 51, '173'),
(263, 120, 'culture', 51, '173'),
(264, 121, 'culture', 51, '173'),
(265, 122, 'culture', 51, '173'),
(267, 124, 'culture', 51, '168'),
(268, 124, 'culture', 51, '171'),
(272, 127, 'culture', 51, '173'),
(274, 129, 'culture', 51, '173'),
(275, 130, 'culture', 51, '175'),
(276, 132, 'culture', 51, '175'),
(277, 133, 'culture', 51, '169'),
(278, 134, 'culture', 51, '175'),
(279, 131, 'culture', 51, '169'),
(281, 137, 'culture', 51, '167'),
(282, 138, 'culture', 51, '167'),
(283, 139, 'culture', 51, '167'),
(284, 140, 'culture', 51, '167'),
(285, 141, 'culture', 51, '167'),
(286, 142, 'culture', 51, '167'),
(287, 143, 'culture', 51, '173'),
(288, 144, 'culture', 51, '167'),
(289, 145, 'culture', 51, '168'),
(291, 147, 'culture', 51, '167'),
(292, 149, 'culture', 51, '174'),
(293, 151, 'culture', 51, '174'),
(294, 152, 'culture', 51, '174'),
(295, 153, 'culture', 51, '174'),
(296, 154, 'culture', 51, '174'),
(300, 156, 'culture', 14, '129'),
(302, 156, 'culture', 56, '191'),
(303, 157, 'culture', 14, '129'),
(305, 157, 'culture', 56, '191'),
(309, 159, 'culture', 14, '129'),
(311, 160, 'culture', 14, '129'),
(313, 160, 'culture', 56, '191'),
(314, 161, 'culture', 14, '129'),
(316, 161, 'culture', 56, '191'),
(317, 162, 'culture', 14, '129'),
(319, 162, 'culture', 56, '191'),
(320, 163, 'culture', 14, '129'),
(322, 163, 'culture', 56, '191'),
(323, 164, 'culture', 14, '128'),
(324, 164, 'culture', 14, '129'),
(326, 164, 'culture', 56, '191'),
(327, 165, 'culture', 14, '129'),
(329, 166, 'culture', 14, '129'),
(331, 166, 'culture', 56, '191'),
(332, 167, 'culture', 14, '129'),
(334, 167, 'culture', 56, '191'),
(335, 168, 'culture', 14, '129'),
(337, 168, 'culture', 56, '191'),
(339, 169, 'culture', 56, '191'),
(340, 170, 'culture', 14, '129'),
(342, 170, 'culture', 56, '191'),
(343, 171, 'culture', 14, '129'),
(345, 171, 'culture', 56, '191'),
(346, 172, 'culture', 14, '129'),
(348, 172, 'culture', 56, '191'),
(349, 173, 'culture', 14, '129'),
(351, 173, 'culture', 56, '191'),
(352, 174, 'culture', 14, '129'),
(353, 174, 'culture', 56, '191'),
(354, 175, 'culture', 14, '129'),
(355, 175, 'culture', 56, '191'),
(356, 176, 'culture', 14, '129'),
(357, 176, 'culture', 56, '191'),
(358, 177, 'culture', 14, '129'),
(359, 177, 'culture', 56, '191'),
(360, 178, 'culture', 14, '129'),
(362, 178, 'culture', 56, '191'),
(363, 179, 'culture', 14, '129'),
(364, 179, 'culture', 56, '191'),
(365, 180, 'culture', 14, '129'),
(366, 180, 'culture', 56, '191'),
(367, 181, 'culture', 14, '129'),
(368, 181, 'culture', 56, '191'),
(369, 182, 'culture', 14, '129'),
(370, 182, 'culture', 56, '191'),
(371, 183, 'culture', 14, '129'),
(372, 183, 'culture', 56, '192'),
(373, 184, 'culture', 14, '129'),
(374, 184, 'culture', 56, '191'),
(375, 185, 'culture', 14, '129'),
(376, 185, 'culture', 56, '191'),
(377, 186, 'culture', 14, '129'),
(378, 186, 'culture', 56, '191'),
(379, 187, 'culture', 14, '129'),
(380, 187, 'culture', 56, '191'),
(381, 188, 'culture', 14, '129'),
(382, 188, 'culture', 56, '191'),
(383, 189, 'culture', 14, '129'),
(384, 189, 'culture', 56, '191'),
(385, 190, 'culture', 14, '129'),
(386, 190, 'culture', 56, '191'),
(389, 192, 'culture', 14, '129'),
(390, 192, 'culture', 56, '191'),
(391, 193, 'culture', 14, '129'),
(392, 193, 'culture', 56, '191'),
(393, 194, 'culture', 14, '129'),
(394, 194, 'culture', 56, '191'),
(395, 195, 'culture', 14, '129'),
(396, 195, 'culture', 56, '191'),
(397, 196, 'culture', 14, '129'),
(398, 196, 'culture', 56, '191'),
(399, 197, 'culture', 56, '191'),
(400, 198, 'culture', 14, '129'),
(401, 198, 'culture', 56, '191'),
(402, 199, 'culture', 14, '129'),
(403, 199, 'culture', 56, '191'),
(404, 200, 'culture', 14, '129'),
(405, 200, 'culture', 56, '191'),
(406, 201, 'culture', 14, '129'),
(407, 201, 'culture', 56, '191'),
(408, 202, 'culture', 14, '129'),
(409, 202, 'culture', 56, '191'),
(410, 203, 'culture', 14, '129'),
(411, 203, 'culture', 56, '191'),
(412, 204, 'culture', 14, '129'),
(413, 204, 'culture', 56, '191'),
(414, 205, 'culture', 14, '129'),
(415, 205, 'culture', 56, '191'),
(416, 206, 'culture', 56, '192'),
(417, 207, 'culture', 14, '129'),
(418, 207, 'culture', 56, '191'),
(419, 208, 'culture', 14, '129'),
(420, 208, 'culture', 56, '191'),
(421, 209, 'culture', 14, '129'),
(422, 209, 'culture', 56, '191'),
(425, 54, 'culture', 50, '156'),
(426, 56, 'culture', 50, '156'),
(427, 60, 'culture', 50, '159'),
(428, 62, 'culture', 50, '159'),
(429, 63, 'culture', 50, '156'),
(430, 65, 'culture', 50, '157'),
(431, 69, 'culture', 27, '66'),
(433, 69, 'culture', 50, '156'),
(434, 71, 'culture', 27, '66'),
(435, 71, 'culture', 50, '159'),
(436, 77, 'culture', 27, '162'),
(437, 91, 'culture', 27, '164'),
(438, 155, 'culture', 14, '129'),
(439, 155, 'culture', 56, '191'),
(442, 91, 'culture', 27, '65'),
(445, 210, 'culture', 14, '129'),
(446, 210, 'culture', 56, '191'),
(454, 157, 'culture', 14, '261'),
(460, 158, 'culture', 14, '129'),
(461, 158, 'culture', 56, '191'),
(465, 159, 'culture', 56, '191'),
(468, 159, 'culture', 85, '264'),
(471, 160, 'culture', 85, '264'),
(478, 163, 'culture', 14, '261'),
(486, 165, 'culture', 56, '191'),
(492, 166, 'culture', 85, '264'),
(506, 170, 'culture', 85, '264'),
(508, 171, 'culture', 85, '264'),
(513, 172, 'culture', 85, '264'),
(518, 28, 'chemical', 8, '266'),
(519, 28, 'chemical', 8, '299'),
(527, 30, 'event', 92, '297'),
(541, 47, 'sort', 28, '69'),
(542, 47, 'sort', 30, '77'),
(543, 47, 'sort', 31, '78'),
(544, 47, 'sort', 32, '82'),
(545, 47, 'sort', 33, '86'),
(546, 47, 'sort', 33, '87'),
(547, 48, 'sort', 28, '68'),
(548, 48, 'sort', 30, '77'),
(549, 48, 'sort', 31, '79'),
(550, 48, 'sort', 32, '82'),
(551, 48, 'sort', 33, '86'),
(552, 49, 'sort', 28, '70'),
(553, 49, 'sort', 30, '77'),
(554, 49, 'sort', 31, '78'),
(555, 49, 'sort', 32, '81'),
(556, 49, 'sort', 33, '86'),
(558, 49, 'sort', 33, '324'),
(559, 50, 'sort', 28, '70'),
(560, 50, 'sort', 30, '77'),
(561, 50, 'sort', 32, '82'),
(562, 50, 'sort', 33, '86'),
(563, 50, 'sort', 33, '327'),
(564, 50, 'sort', 142, '326'),
(565, 51, 'sort', 28, '69'),
(566, 51, 'sort', 30, '77'),
(567, 51, 'sort', 31, '78'),
(568, 51, 'sort', 32, '81'),
(569, 51, 'sort', 33, '86'),
(570, 51, 'sort', 33, '327'),
(571, 51, 'sort', 142, '326'),
(572, 52, 'sort', 28, '70'),
(573, 52, 'sort', 30, '77'),
(574, 52, 'sort', 31, '78'),
(575, 52, 'sort', 32, '82'),
(576, 52, 'sort', 33, '86'),
(577, 52, 'sort', 33, '87'),
(578, 52, 'sort', 33, '324'),
(579, 52, 'sort', 142, '326'),
(580, 53, 'sort', 28, '71'),
(581, 53, 'sort', 30, '77'),
(582, 53, 'sort', 31, '80'),
(583, 53, 'sort', 32, '82'),
(584, 53, 'sort', 33, '86'),
(585, 53, 'sort', 33, '324'),
(586, 53, 'sort', 142, '326'),
(587, 53, 'sort', 143, '328'),
(588, 52, 'sort', 143, '328'),
(589, 52, 'sort', 143, '329'),
(590, 47, 'sort', 143, '331'),
(591, 48, 'sort', 143, '331'),
(592, 49, 'sort', 143, '328'),
(593, 50, 'sort', 143, '329'),
(594, 51, 'sort', 143, '331'),
(595, 61, 'sort', 28, '68'),
(596, 61, 'sort', 28, '69'),
(597, 61, 'sort', 28, '70'),
(598, 61, 'sort', 28, '71'),
(599, 61, 'sort', 30, '76'),
(600, 61, 'sort', 30, '77'),
(601, 61, 'sort', 31, '78'),
(602, 61, 'sort', 31, '79'),
(603, 61, 'sort', 31, '80'),
(604, 61, 'sort', 32, '81'),
(605, 61, 'sort', 32, '82'),
(606, 61, 'sort', 32, '83'),
(607, 61, 'sort', 32, '84'),
(608, 61, 'sort', 32, '165'),
(609, 61, 'sort', 33, '86'),
(610, 61, 'sort', 33, '87'),
(611, 61, 'sort', 33, '88'),
(612, 61, 'sort', 33, '324'),
(613, 61, 'sort', 33, '327'),
(614, 61, 'sort', 142, '325'),
(615, 61, 'sort', 142, '326'),
(616, 61, 'sort', 139, '330'),
(617, 61, 'sort', 143, '328'),
(618, 61, 'sort', 143, '329'),
(619, 61, 'sort', 143, '331'),
(626, 30, 'event', 92, '298'),
(678, 16, 'event', 92, '297'),
(682, 15, 'event', 92, '376'),
(683, 35, 'chemical', 8, '299'),
(684, 35, 'chemical', 9, '404'),
(685, 35, 'chemical', 58, '406'),
(686, 3, 'event', 92, '298'),
(687, 42, 'event', 92, '298'),
(688, 43, 'event', 92, '298'),
(689, 44, 'event', 92, '298'),
(690, 45, 'event', 92, '298'),
(691, 46, 'event', 92, '297'),
(692, 47, 'event', 92, '375'),
(693, 48, 'event', 92, '376'),
(694, 49, 'event', 92, '398'),
(695, 37, 'pest', 180, '412'),
(696, 37, 'pest', 180, '413'),
(697, 37, 'pest', 182, '414'),
(703, 46, 'disease', 190, '415'),
(704, 47, 'disease', 190, '416'),
(705, 47, 'disease', 190, '417'),
(706, 48, 'disease', 187, '419'),
(707, 48, 'disease', 187, '420'),
(708, 48, 'disease', 188, '421'),
(709, 36, 'chemical', 8, '22'),
(710, 36, 'chemical', 8, '299'),
(711, 36, 'chemical', 9, '422'),
(712, 36, 'chemical', 58, '206'),
(713, 37, 'chemical', 8, '299'),
(714, 37, 'chemical', 9, '423'),
(715, 37, 'chemical', 58, '201'),
(716, 38, 'chemical', 8, '22'),
(717, 38, 'chemical', 8, '24'),
(718, 38, 'chemical', 9, '404'),
(719, 38, 'chemical', 58, '205'),
(720, 38, 'chemical', 58, '206'),
(721, 41, 'handbook', 171, '393'),
(722, 41, 'handbook', 171, '394');

-- --------------------------------------------------------

--
-- Структура таблицы `filter_attr_values`
--

CREATE TABLE `filter_attr_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filter_attr_values`
--

INSERT INTO `filter_attr_values` (`id`, `attribute_id`, `attribute_value`) VALUES
(11, 5, 'Поедены'),
(12, 5, 'Скручены'),
(13, 5, 'Гниют'),
(14, 5, 'Покрыты пятнами'),
(15, 6, 'Ветки в паутине'),
(16, 6, 'Поедена кора'),
(21, 8, 'Гербециды'),
(22, 8, 'Инсектициды'),
(23, 8, 'Удобрение'),
(24, 8, 'Питательная смесь'),
(33, 16, 'Посадка'),
(35, 16, 'Обрезка'),
(64, 27, 'Семечковые (яблоня, груша, ирга, айва, боярышник и др.)'),
(65, 27, 'Косточковые (вишня, слива, абрикос, персик и др.)'),
(66, 27, 'Ягодные (клубника, малина, крыжовник, облепиха и др.)'),
(67, 27, 'Орехи (лещина, грецкий и др.)'),
(68, 28, 'Ультраранние'),
(69, 28, 'Ранние'),
(70, 28, 'Среднеспелые'),
(71, 28, 'Поздние'),
(76, 30, 'Колоновидные'),
(77, 30, 'Древовидные'),
(78, 31, 'Скоропортящиеся'),
(79, 31, 'Средний срок хранения'),
(80, 31, 'Долгохранимые'),
(81, 32, 'Сладкие'),
(82, 32, 'Кисло-сладкие'),
(83, 32, 'Кислые'),
(84, 32, 'Терпкие'),
(86, 33, 'Морозостойкие'),
(87, 33, 'Устойчивые к заболеваниям'),
(88, 33, 'Сокосодержащие'),
(99, 35, 'Однолетнее'),
(100, 35, 'Двулетнее'),
(101, 35, 'Многолетнее'),
(102, 36, 'Ультраранние'),
(103, 36, 'Раннеспелые'),
(104, 36, 'Среднеспелые'),
(105, 36, 'Позднеспелые'),
(106, 37, 'Скоропортящиеся'),
(107, 37, 'Средний срок хранения'),
(108, 37, 'Долгохранимые'),
(109, 38, 'Высокоурожайные'),
(110, 38, 'Среднеурожайные'),
(111, 39, 'Устойчивые к заболеваниям'),
(112, 39, 'Морозостойкие'),
(113, 40, 'Красные'),
(114, 40, 'Желтые'),
(115, 40, 'Белые'),
(116, 40, 'Черные'),
(128, 14, 'Комнатные растения'),
(129, 14, 'Растения для открытого грунта'),
(130, 14, 'Теплицы'),
(156, 50, 'Плодовые деревья'),
(157, 50, 'Кустарники'),
(159, 50, 'Древесно-кустарниковые'),
(160, 50, 'Вьющиеся'),
(161, 50, 'Травянистые'),
(162, 27, 'Цитрусовые'),
(163, 27, 'Виноградовые'),
(164, 27, 'Растения тропических зон'),
(165, 32, 'Вяжущие'),
(167, 51, 'Плодовые (помидор, арбуз, дыня и др.)'),
(168, 51, 'Корнеплодные и клубнеподобные (морковь, картофель и др.)'),
(169, 51, 'Луковые (лук, чеснок и др.)'),
(171, 51, 'Листовые (капуста, сельдерей и др.)'),
(173, 51, 'Пряно-вкусовые (мята, кориандр,анис и др.)'),
(174, 51, 'Грибы'),
(175, 51, 'Бобовые (горох, фасоль и др.)'),
(179, 53, 'Открытый грунт'),
(180, 53, 'Теплица'),
(184, 51, 'Злаковые'),
(191, 56, 'Декоративно-цветущие'),
(192, 56, 'Декоративно-лиственные'),
(193, 56, 'Суккуленты(запасают воду)'),
(194, 56, 'Лекарственные растения'),
(200, 8, 'Грунты'),
(201, 58, 'Азот'),
(202, 58, 'Калий'),
(203, 58, 'Магний'),
(204, 58, 'Фосфор'),
(205, 58, 'Железо'),
(206, 58, 'Сера'),
(248, 50, 'Пальмовые'),
(261, 14, 'Для кашпо'),
(264, 85, 'Подходит для букетов'),
(266, 8, 'Народное средство'),
(267, 53, 'Дома/на балконе'),
(269, 85, 'ЯДОВИТЫЕ части растений!'),
(270, 56, 'Декоративные овощи'),
(271, 86, 'Однолетнее'),
(272, 86, 'Двулетнее'),
(273, 86, 'Многолетнее'),
(274, 87, 'Утро'),
(275, 87, 'Вечер'),
(276, 87, 'Ночь'),
(279, 89, 'Приятный'),
(280, 89, 'Отталкивающий'),
(281, 90, 'Длительное цветение (4 мес. и более)'),
(282, 90, 'ЯДОВИТЫЕ части растений!'),
(283, 90, 'Подходит для букетов'),
(284, 90, 'Не требуется посадка на рассаду'),
(286, 91, 'Одиночное соцветие'),
(287, 91, 'Группа соцветий'),
(288, 91, 'Вьющееся'),
(289, 91, 'Стелющееся растение'),
(291, 56, 'Бонсай'),
(294, 95, 'Торжества и праздники'),
(295, 95, 'Фитодизайн интерьера'),
(296, 95, 'Дизайн официальных мероприятий'),
(297, 92, 'Ярмарка'),
(298, 92, 'Фестиваль'),
(299, 8, 'Фунгициды'),
(324, 33, 'Позднее цветение'),
(325, 142, 'Полутень'),
(326, 142, 'Солнце'),
(327, 33, 'Получаются вкусные заготовки'),
(328, 143, 'Самоплодность'),
(329, 143, 'Плодоношение на молодых однолетних побегах'),
(330, 139, 'Красные плоды'),
(331, 143, 'Нет дополнительной информации'),
(335, 145, 'Фермерской хозяйство'),
(336, 145, 'Физическое лицо (ИП)'),
(337, 145, 'Интернет магазин'),
(339, 148, 'Посадка'),
(340, 148, 'Обрезка'),
(341, 148, 'Обработка/лечение'),
(342, 148, 'Сбор урожая'),
(343, 148, 'Хранение'),
(344, 148, 'Переработка'),
(345, 150, 'Посадка'),
(346, 150, 'Обрезка'),
(347, 150, 'Обработка'),
(348, 150, 'Сбор урожая'),
(349, 150, 'Хранение'),
(350, 150, 'Переработка'),
(351, 147, 'Посадка'),
(352, 147, 'Обрезка'),
(353, 147, 'Обработка'),
(354, 147, 'Сбор урожая'),
(355, 147, 'Хранение'),
(356, 147, 'Переработка'),
(357, 151, 'Посадка'),
(358, 151, 'Обрезка'),
(359, 151, 'Обработка'),
(360, 151, 'Сбор урожая'),
(361, 151, 'Хранение'),
(362, 151, 'Переработка'),
(363, 152, 'Посадка'),
(364, 152, 'Обрезка'),
(365, 152, 'Обработка'),
(366, 152, 'Сбор урожая'),
(367, 152, 'Хранение'),
(368, 152, 'Переработка'),
(369, 153, 'Посадка'),
(370, 153, 'Обрезка'),
(371, 153, 'Обработка'),
(372, 153, 'Сбор урожая'),
(373, 153, 'Хранение'),
(374, 153, 'Переработка'),
(375, 92, 'Выставка'),
(376, 92, 'Новости сайта'),
(392, 171, 'Посадка'),
(393, 171, 'Обрезка'),
(394, 171, 'Уход'),
(395, 171, 'Сбор урожая'),
(396, 171, 'Хранение'),
(397, 171, 'Переработка'),
(398, 92, 'Другое...'),
(399, 172, 'Флорист'),
(400, 172, 'Ландшафтный дизайнер'),
(401, 172, 'Декоратор'),
(402, 95, 'Работа с физическими лицами'),
(403, 145, 'Сертифицированный питомник'),
(404, 9, 'GREEN BELT'),
(405, 9, 'ООО \"Компания Агропрогресс\"'),
(406, 58, 'Медь'),
(407, 173, 'Скручиваются'),
(408, 173, 'Отмирают'),
(409, 174, 'Покрытие налетом'),
(410, 176, 'Скручиваются'),
(411, 176, 'Отмирают'),
(412, 180, 'Скручиваются'),
(413, 180, 'Отмирают'),
(414, 182, 'Покрытие налетом'),
(415, 190, 'Изменение структуры внешнего слоя побега(не повреждение)'),
(416, 190, 'Повреждение структуры внешнего слоя побега'),
(417, 190, 'Ожоги'),
(418, 5, 'Погибают'),
(419, 187, 'Гниют'),
(420, 187, 'Покрытие налетом'),
(421, 188, 'Отмирает'),
(422, 9, '\"Саммит Агро\"'),
(423, 9, 'ООО «Сингента»');

-- --------------------------------------------------------

--
-- Структура таблицы `footers`
--

CREATE TABLE `footers` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `text` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `footers`
--

INSERT INTO `footers` (`id`, `order`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'телефон 809596656', NULL, '2018-10-03 09:52:33'),
(2, 3, 'емейл', NULL, '2018-10-03 09:52:33'),
(3, 2, 'вайбер 809596656', NULL, '2018-10-03 09:52:33');

-- --------------------------------------------------------

--
-- Структура таблицы `handbooks`
--

CREATE TABLE `handbooks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `handbooks`
--

INSERT INTO `handbooks` (`id`, `title`, `description`, `full_description`, `main_photo`, `section_id`, `category_id`, `culture_id`, `date`, `comments_count`, `user_id`) VALUES
(41, 'Справка по абрикосу', '<p>\r\n\r\nЯму для посадки абрикоса лучше приготовить предварительно в осенний период. Оптимальными являются размеры 70 см/70 см/70 см. Ведь надо не забывать, что размеры корневой системы развивающегося дерева в два раза больше размеров кроны. Дно ямы засыпается дренажной подушкой, которая будет предохранять наше дерево от избытка влаги. Для этого хорошо подойдёт щебень, гравий или мелкие куски кирпича. Затем в яму засыпается подготовленная почва, которая состоит из верхнего чернозёма, перегноя и добавок древесной золы или извести (в зависимости от типа грунта) и аммиачной селитры. Всё это должно быть хорошо перемешано и покрыто слоем земли для предотвращения прямого контактирования с корнями. Из земли в яме делают небольшое возвышение, на которое устанавливают корни дерева, хорошо их расправляют и засыпают оставшейся землёй. Ствол абрикоса засыпают до уровня шейки ствола так, чтобы дерево находилось на небольшом возвышении, а шейка не засыпалась землёй. По окружности возвышения надо сделать поливочный круг, после чего обильно полить деревце водой. При этом надо следить, чтобы вода не попадала непосредственно под ствол дерева, а разливалась по окружности поливочного круга. Такой способ посадки оградит дерево от застоя воды в весенний период, увеличивает площадь для роста корней и улучшает снабжение корневой системы водой и кислородом&nbsp;<br><br><a target=\"_blank\" rel=\"nofollow\" href=\"https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r\">https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r</a>\r\n\r\n<br></p>', '<p><u></u>Тест<u></u><u>овое</u> описание <b>1</b><br></p><br>', 'handbook_41_photo_5bc72ba91ddf3.jpg', 6, 339, 58, '2018-10-12', 0, 0),
(44, 'Тест Справка по абрикосу', '<p>\r\n\r\nЯму для посадки абрикоса лучше приготовить предварительно в осенний период. Оптимальными являются размеры 70 см/70 см/70 см. Ведь надо не забывать, что размеры корневой системы ря дерева в два раза больше размеров кроны. Дно ямы засыпается дренажной <b>подушкой, которая будет предохранять</b> наше дерево от избытка влаги. Для этого хорошо подойдёт щебень, гравий или мелкие куски кирпича. <i>Затем в яму засыпается </i>подготовленная почва, которая состоит из верхнего чернозёма, перегноя и добавок древесной золы или извести (в зависимости от типа грунта) и аммиачной селитры. Всё это должно быть хорошо перемешано и покрыто слоем земли для предотвращения прямого контактирования с корнями. Из земли в яме делают небольшое возвышение, на которое устанавливают корни дерева, хорошо их расправляют и засыпают оставшейся землёй. Ствол абрикоса засыпают до уровня шейки ствола так, чтобы дерево находилось на небольшом возвышении, а шейка не засыпалась землёй. По окружности возвышения надо сделать поливочный круг, после чего обильно полить деревце водой. При этом надо следить, чтобы вода не попадала непосредственно под ствол дерева, а разливалась по окружности поливочного круга. Такой способ посадки оградит дерево от застоя воды в весенний период, увеличивает площадь для роста корней и улучшает снабжение корневой системы водой и кислородом<br><br><a target=\"_blank\" rel=\"nofollow\" href=\"https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r\">https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r</a>&nbsp;&nbsp;<br></p>', '<u>Тест</u>овое описание 2<br>', '', 6, 339, 58, '2018-10-12', 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `handbook_photos`
--

CREATE TABLE `handbook_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `handbook_id` int(11) NOT NULL,
  `path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `handbook_videolinks`
--

CREATE TABLE `handbook_videolinks` (
  `id` int(10) UNSIGNED NOT NULL,
  `handbook_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `moderator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `handbook_videolinks`
--

INSERT INTO `handbook_videolinks` (`id`, `handbook_id`, `title`, `link`, `user_id`, `moderator`, `created_at`, `updated_at`) VALUES
(5, 41, 'Video TITLE', 'https://www.youtube.com/watch?v=Puu3cFoHzP8', 1, 'new', NULL, '2018-10-15 11:07:58');

-- --------------------------------------------------------

--
-- Структура таблицы `main_page_infos`
--

CREATE TABLE `main_page_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `main_page_infos`
--

INSERT INTO `main_page_infos` (`id`, `title`, `text`, `created_at`, `updated_at`) VALUES
(1, 'О НАС', 'Приветствуем Вас на портале о садоводстве “Умная дача”. Идея создания удобного ресурса, где можно найти любую информацию по данной тематике, формировалась на протяжении длительного времени. Сейчас существует немалое количество сайтов по садоводству. Каждый из них дает свой кусочек информации, не раскрывая всех аспектов проблем, что является их отрицательной чертой. Отсутствие систематизации и огромное количество беспорядочного текста, приводит в уныние при попытке найти что-то действительно полезное . Мы постарались решить эту проблему, придумать что-то новое, что действительно пригодится и будет понятно каждому человеку, даже не обладающему навыками опытных садоводов.<br>', NULL, '2018-10-15 09:10:49'),
(2, 'НАШИ ЦЕЛИ', 'Основной целью, как сказано выше, является систематизировать информацию по садоводству, чтобы было удобно найти все, что необходимо в одном месте.Таким образом на портале объединены садовые культуры с сельскохозяйственными, домашнее цветоводство с растениями выращиваемыми на клумбе, тут же можно найти информацию по существующем удобрениям, химикатам от вредителей.\r\n\r\nВторая цель - это дать возможность реализовать свое хобби, получить выгоду от своей деятельности, к примеру вы увлекаетесь разведением пионов, это ваша страсть . У вас в коллекции 50 неповторимых сортов этих цветов, получите выгоду, продавайте на нашем сайте лишний посадочный материал. Пусть люди перехватят ваше стремление к прекрасному и украсят свой дом, участок.\r\n\r\nТак же мы посчитали необходимым дать возможность показать свою работу людям, занимающимся флористикой, ландшафтным дизайном и декораторам.\r\n\r\nДополнительно мы хотим собрать как можно больше информации о растениях для дальнейшего ее анализа и использования для развития проекта.', NULL, NULL),
(3, 'ПЛАНЫ НА БУДУЩЕЕ', 'На страницах портала “Умная дача” мы просим пользователей присылать фотографии своих растений , если они подвержены каким то болезням или страдают от каки-то вредителей. Отправляя эти снимки со страницы предполагаемой проблемы вы ставите метку, свидетельствующие о роде этой проблемы. В дальнейшем эти фотографии будут использованы в качестве исходного материала для обучения алгоритмов искусственного интеллекта, чтобы вы делая фотографии могли с большой долей вероятности знать, что за недуг постиг растение или какой жучок его губит и как от него избавиться, где купить лекарство и как им пользоваться для достижения положительного эффекта. Второй момент, который хотелось бы пояснить , это анкеты растений, которые мы просим Вас заполнять. Как вам идея : предсказать урожай? Предсказать не только урожай зерновых культур, а вообще любого растения. Задача амбициозна, но почему нет.\r\n\r\nТак же мы будем рады услышать ваши идеи и предложения, попробовать реализовать их вместе. Для этого воспользуйтесь формой обратной связи, либо свяжитесь с нами через социальные сети.', NULL, NULL),
(4, 'ПОМОЩЬ ПРОЕКТУ', 'Данный ресурс создается на собственные средства, в свободное от основного рода деятельности время. Если вас вдохновили наши идеи, вы хотите помочь их реализовать, мы будем рады всякой посильной помощи от написания/модерации статей , моделирования групп в соц. сетях до любой финансовой поддержки.', NULL, NULL),
(5, 'НАШИ КОНТАКТЫ', '+7 965 450-00-00\r\n\r\n+7 965 450-00-00\r\n\r\nУл. Куропятникова 28, офис 166', NULL, NULL),
(6, 'СТРУКТУРА САЙТА', 'Портал “Умная дача” состоит из трех основных разделов. Они называются: “Сад”, “Огород” и “Клумба”. Каждый из этих разделов охватывает виды культур и другую сопутствующую информацию в соответствии со своей тематикой и как результат уникальны. Но кроме отличия по содержанию, реализовано неповторимое визуальное оформление: разделы имеют цветовые отличия, поэтому находясь на любой странице будет понимание в каком конкретно разделе вы сейчас находитесь.', NULL, NULL),
(7, 'Раздел “Огород”', 'объединяет все сельскохозяйственные культуры, овощи, приправы, лекарственные растения и прочие растения.', NULL, NULL),
(8, 'Раздел “Сад”', 'включает в себя информацию по всем плодовым растениям, кустарникам, ореховым деревьям, ягодам и фруктам, т.е. все что обычно выращивается в саду и ассоциируется у нас с понятием сада.', NULL, NULL),
(9, 'Раздел “Клумба”', 'отвечает за растения радующие нас своей красотой. Цветы, комнатные растения, декоративные растения, деревья и кустарники, травянистые покрытия все они находятся в этой части портала.', NULL, '2018-10-15 05:25:21'),
(10, '', 'Каждая культура, находящаяся в разделах, представляет из себя блок информации состоящий из следующих составляющих ее элементов: “сорта”, в ней описываются все сорта культуры со своими уникальными характеристиками и особенностями. Каждое название сорта культуры является уникальным и не имеет повторений. Открыв страницу искомого сорта, вы получаете его подробное описание, характеристики, отзывы пользователей, которые имеют опыт выращивания, видите продавцов, которые могу продать вам посадочны материал, а на подразделе “карт” вы увидите места совершения покупок другими пользователями, т.е. сможете сориентироваться на предмет широты выращивания данного сорта. “вредители”, в этой части описываются все возможные вредители , которые могут погубить данную культуру, как с ними бороться, какие лекарственные препараты подходят со ссылкой на них в каталоге сайта, пройдя по которым вы сразу можете прочитать описание химиката, как найти и приобрести в ближайшем магазине то, что необходимо для избавления культуры от насекомого. ”заболевания”, функционал аналогичен части “вредители”. ”справочная информация” включает полезные статьи по культуре. Статьи можно отфильтровать по различным категориям . Это может информация о том как хранить урожай, как его убирать, как подготовить растение к зимнему периоду, особенности периода цветения, как ухаживать за культурой и многое многое другое. ”вопрос-ответ” в этой части блока сами пользователи могут задать интересующий их вопрос о культуре, если необходимая информация отсутствует в предыдущем разделе.', NULL, '2018-10-15 05:25:21'),
(11, 'РОЛИ ПОЛЬЗОВАТЕЛЕЙ', 'На портале реализовано 4 роли пользователей, которые влияют на возможный функционал. Каждая роль обладает своими особенностями. ”Покупатель” - это основная роль. Для ее открытия достаточно просто зарегистрироваться на портале. Весь функционал, доступный этой роли, вы получаете сразу и никаких дополнительных финансовых затрат для работы в ней не потребуется. ”Продавец” - эта роль нужна, если вы хотите начать зарабатывать с помощью “Умной дачи”, вы будете показываться на карте для ближайших потенциальных покупателей в зависимости от ассортимента культур, который вы продаете. Соответственно, чем больший ассортимент вы имеете, тем больше вероятность его реализации, либо вы должны продавать специфичные культуры, дабы не иметь конкурентов в реализации. Этот функционал нужно дополнительно открывать. Для этого вы можете выбрать один из предлагаемых тарифов и приобрести его, либо с помощью своей активности на портале, содействовать в его наполнении, участвовать в конкурсах, помогать модерировать уже присланную информацию. В последнем случае уровень получаемого тарифа будет зависеть от степени оказанной помощи. Для приобретения необходимо написать нам через форму обратной связи, либо на почту с темой “Оплата” , оплатить полученный в ответном письме счет, указав в комментарии номер счета или почтовый адрес личного кабинета и дождаться открытия доступа. Роли “Организатор” и “Флорист” приобретаются аналогичным способом. В личном кабинете “Продавца”, вы сможете сформировать свой ассортимент, контролировать остатки, исполнение заказов, фиксировать товары, которые забронировали на следующие посадочные сезоны и таким образом спланировать объем своих работ.\r\n\r\n”Организатор мероприятий” - это дополнительная роль. Она позволяет выкладывать на страницах портала информацию о проводимых мероприятиях, выставках и фестивалях по тематике ресурса. Включение роли требует символической оплаты. ”Декоратор, флорист” - еще одна дополнительная роль, которая создана для пользователей, желающих продемонстрировать свое мастерство и увеличить объем своих заказов. Включение ее также требует оплаты, поскольку вы планируете зарабатывать с помощью ресурса “Умная дача”.', NULL, '2018-10-15 05:25:21'),
(12, 'СОВЕРШЕНИЕ ПОКУПОК', 'Просматривая каталоги растений и химикатов, вы можете приобрести понравившийся вам товар. Для покупки вам необходимо все добавлять в свою корзину. Затем, войдя в личный кабинет в подменю “Мои заказы” вы увидите неоформленный заказ. Он будет оставаться в этом статусе пока не будет выбран конечный продавец . Для этого необходимо нажать кнопку подбора продавца, после чего мы предложим вам ближайших продавцов, которые продадут выбранный товар с принципом максимального закрытия по ассортименту (т.е. максимальное число наименований у одного продавца), ближайшего его расположения к вам и рейтинга этого продавца. После этого “неоформленный заказ” будет оформлен с одним или разбит на нескольких продавцов с присвоением номера заказа. После чего вы сможете отслеживать ситуацию с ними до момента получения товара. До момента оформления вы можете зайти на страницу предполагаемого продавца, посмотреть его ассортимент и что-то добавить к уже имеющемуся набору, скорректировать свой заказ.', NULL, NULL),
(13, 'ДОПОЛНИТЕЛЬНЫЙ ФУНКЦИОНАЛ', 'Этот функционал можно найти в личном кабинете роли “Покупатель”, нажав подменю “Мои растения” и там в верхнем правом углу кнопку “Отчеты”. На текущий момент реализовано 4 основных отчета: ”Информационная таблица” позволяет инфографику всех культур, добавленных в мои растения, вывести в единую таблицу и распечатать ее. Это позволяет удобнее и нагляднее видеть сроки посадки , пересадки, обработки растений. Таким образом спланировать работы в дачный сезон будет намного проще. “Активность культур” покажет вам статистику популярности культур добавленных в список “Моих”, поможет оценить ряд параметров по каждому сорту. “Лунный календарь” даст информацию по каждой вашей культуре, когда и какие мероприятия благоприятно с ней производить, а когда лучше определенные действия отложить . Это один из инструментов получения отличного урожая. “Прогноз урожая” данный функционал тестовый и будет совершенствовать по мере поступления анкет от пользователей, в идеале получать прогнозируемый урожай исходя из параметров заданных пользователем с высокой долей точности. “Виртуальный сад” в разработке.', NULL, '2018-10-15 05:25:21'),
(14, 'ПРОСМОТР СОБЫТИЙ', 'Раздел “Календарь мероприятий” показывает все намеченные на месяц события возможностью фильтрации по типам событий. Если вы представитель заинтересованных лиц, либо хотите провести демонстрацию своей продукции, то можете сами создать мероприятие , которое будет видно остальным пользователям. Для открытия этой возможности необходимо приобрести роль “Организатор мероприятий”.', NULL, NULL),
(15, 'Загрузка фото, статей, анкет', 'Мы просим наших пользователь помогать в развитии портала “Умная дача” разными способами. Одним из них является отправка из разделов “Вредители” и “Заболевания” фотографии предполагаемых недугов. За определенное количество материала вы будете получать прибавку к своему рейтингу и возможность открыть роль “Продавец”. Эти фотографии в дальнейшем нам пригодятся для обучения алгоритмов искусственного интеллекта, чтобы упростить задачу излечения культур. Кроме этого будем признательны, если поделитесь своим опытом в деле садоводства. Можете присылать ваши статьи и видео по определенным культурам к нам, самые лучшие будут выложены на портале, за это вы тоже будете получать большое количество рейтинга. В личном кабинете Покупателя мы добавили функционал по ведению анкет Моих растений. Заполняя данные анкеты по каждой вашей культуре на протяжении всего периода выращивания вы помогаете нам спрогнозировать конечный результат для других пользователей и понять зависимость его от вводимых данных. Чем больше их будет, тем более точным окажется прогноз.Мы с радостью окажем помощь в решении ваших проблем.', NULL, NULL),
(16, 'Проблемы, возникающие при пользовании сайтом.', 'По всем возникающим проблемам пользуйтесь функционалом обратной связи.\r\nМы с радостью окажем помощь в решении ваших проблем.', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `markets`
--

CREATE TABLE `markets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '0',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `markets`
--

INSERT INTO `markets` (`id`, `user_id`, `name`, `phone`, `address`, `description`, `rating`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(2, 61, 'Магазин 2', '0969279121', 'адрес 2', 'широкий ассортимент по низким ценам', 5, 30, 30, '2018-08-03 05:16:56', '2018-08-03 05:16:56'),
(3, 61, 'Все для сада', '096922464545', 'г. Саратов, ул. Пушкина 5', 'узкий ассортимент  по высоким ценам', 4, 50, 50, NULL, NULL),
(4, 61, 'sadfghg', 'adsfdgfhg', 'adsfdgfhg', '', 0, NULL, NULL, '2018-10-22 10:43:21', '2018-10-22 10:43:21'),
(5, 61, 'sadfghg', 'adsfdgfhg', 'adsfdgfhg', '', 0, NULL, NULL, '2018-10-22 10:44:04', '2018-10-22 10:44:04'),
(7, 23, 'имя', '684446', 'адрем', 'ывапр', 0, 52.48, 51.45, '2018-10-23 06:47:55', '2018-10-23 06:47:55');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_21_135630_create_profiles_table', 1),
(4, '2018_05_21_135630_create_socials_table', 1),
(5, '2018_06_05_141821_create_questions_filters_table', 2),
(6, '2018_06_05_141821_create_questions_table', 2),
(7, '2018_06_05_141918_create_answers_table', 2),
(8, '2018_06_05_142042_create_bookmarks_table', 2),
(9, '2018_06_05_142057_create_bookmarks_category_table', 2),
(10, '2018_06_05_141918_create_sections_table', 3),
(11, '2018_06_05_141821_create_questions_likes_table', 4),
(12, '2018_06_05_141821_questions_drop_like_it', 5),
(13, '2018_06_05_142042_bookmarks_add_target_id', 6),
(14, '2018_06_05_141918_create_cultures_table', 7),
(15, '2018_06_05_141918_sections_add_image_and_slug', 7),
(16, '2019_06_05_141918_create_sorts_table', 8),
(17, '2019_06_05_141918_cultures_add_slug', 8),
(18, '2018_07_10_205453_create_chemicals_table', 9),
(19, '2018_07_16_125603_create_sort_responses_table', 10),
(20, '2018_07_17_090136_create_sort_photos_table', 11),
(21, '2018_07_17_110653_create_sort_characteristics_table', 12),
(22, '2018_07_17_112423_create_sort_charact_relations_table', 13),
(23, '2018_07_17_131900_create_sort_responses_answers_table', 14),
(24, '2018_07_18_095035_create_pests_table', 15),
(25, '2018_07_18_111343_create_pest_photos_table', 16),
(26, '2018_07_18_113215_create_pest_chemicals_table', 17),
(27, '2018_07_18_135113_create_disease_photos_table', 18),
(28, '2018_07_18_135128_create_diseases_table', 18),
(29, '2018_07_18_135155_create_disease_chemicals_table', 18),
(30, '2018_07_19_103050_create_handbooks_table', 19),
(31, '2018_07_19_103129_create_handbook_photos_table', 19),
(32, '2018_07_19_103200_create_handbook_categories_table', 20),
(34, '2018_07_19_121412_create_ethnosciences_table', 21),
(35, '2018_07_19_134845_create_ethnoscience_months_table', 22),
(36, '2018_07_20_141607_create_handbook_videolinks_table', 23),
(38, '2018_07_21_102701_create_order_sorts_table', 25),
(39, '2018_07_21_102719_create_order_chemicals_table', 25),
(40, '2018_07_21_105610_create_decorators_table', 26),
(41, '2018_07_21_105638_create_decorator_photos_table', 27),
(42, '2018_07_21_110105_create_decorator_projects_table', 28),
(43, '2018_07_21_123417_create_decorator_roles_table', 29),
(44, '2018_07_21_123510_create_decorator_roles_users_table', 29),
(45, '2018_07_21_123649_create_decorator_responses_table', 29),
(46, '2018_07_23_074651_create_user_entrances_table', 30),
(47, '2018_07_21_101039_create_orders_table', 31),
(48, '2018_07_24_122256_create_sellers_table', 32),
(49, '2018_07_24_122325_create_seller_filials_table', 32),
(50, '2018_07_24_122827_create_seller_sort_assortments_table', 32),
(51, '2018_07_24_123103_create_sort_categories_table', 33),
(52, '2018_07_24_124227_create_sort_cat_relations_table', 34),
(53, '2018_07_25_100720_create_order_statuses_table', 35),
(54, '2018_07_25_101334_create_order_sort_status_rels_table', 36),
(55, '2018_07_25_145641_create_assortments_table', 37),
(56, '2018_07_26_132019_create_tariffs_table', 38),
(57, '2018_07_26_141644_create_user_sorts_table', 39),
(58, '2018_07_26_154328_create_events_table', 40),
(59, '2018_07_26_154356_create_event_categories_table', 40),
(60, '2018_07_26_190324_create_event_participants_table', 41),
(61, '2018_07_27_120757_create_sort_questionaries_table', 42),
(62, '2018_07_27_121929_create_sort_ques_general_infos_table', 42),
(63, '2018_08_02_074415_create_bookmarks_folders_table', 43),
(64, '2018_08_02_082424_create_chemical_photos_table', 44),
(65, '2018_08_02_133133_create_markets_table', 45),
(66, '2018_08_03_105030_create_filter_attributes_table', 46),
(67, '2018_08_03_105452_create_filter_attr_values_table', 46),
(68, '2018_08_03_105843_create_filter_attr_entities_table', 46),
(69, '2018_08_08_141732_create_chemical_categories_table', 47),
(70, '2018_08_08_141926_create_chemical_cat_relations_table', 47),
(71, '2018_08_14_083552_create_questions_table', 48),
(72, '2018_08_14_084205_create_question_answers_table', 48),
(73, '2018_08_14_084612_create_question_likes_table', 48),
(74, '2018_08_15_143623_create_articles_table', 49),
(75, '2018_08_15_180654_create_feedback_table', 49),
(76, '2018_08_16_140752_create_comments_table', 50),
(77, '2018_08_17_080153_create_searches_table', 51),
(78, '2018_08_21_083822_create_chemical_responces_table', 52),
(79, '2018_08_21_084158_create_chemical_responces_answers_table', 52),
(80, '2018_08_28_141857_create_order__items_table', 53),
(81, '2018_08_29_123132_create_regions_table', 54),
(82, '2018_08_29_125700_create_sort_operations_table', 55),
(83, '2018_08_29_125808_create_sort_calendars_table', 55),
(84, '2018_08_29_141719_create_order_regions_table', 56),
(85, '2018_08_31_114843_create_notifications_table', 57),
(86, '2018_09_06_092108_create_models_delivery_methods_table', 58),
(87, '2018_09_06_092309_create_delivery_methods_table', 59),
(91, '2018_09_26_140028_create_footers_table', 60),
(92, '2018_09_29_114755_create_tarif_histories_table', 61),
(93, '2018_10_02_193824_create_moon_phases_table', 62),
(94, '2018_10_02_200938_create_moon_dates_table', 62),
(95, '2018_10_02_200952_create_moon_attributes_table', 62),
(96, '2018_10_02_201005_create_moon_actions_table', 62),
(97, '2018_10_03_130145_create_articles_table', 63),
(98, '2018_10_11_122206_create_user_delivery_methods_table', 64),
(99, '2018_10_11_130330_create_main_page_infos_table', 65);

-- --------------------------------------------------------

--
-- Структура таблицы `moon_actions`
--

CREATE TABLE `moon_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `phase_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `element` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'земля вода огонь воздух',
  `plant_attribute` int(11) NOT NULL,
  `sort_operation_id` int(11) NOT NULL,
  `value` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'рекомендовано, не рекомендовано, нейтрально',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `moon_actions`
--

INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(3, 'новолуние', 'земля', 156, 1, 'не рекомендовано', NULL, '2018-10-16 04:20:04'),
(121, 'новолуние', 'вода', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(122, 'новолуние', 'вода', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(123, 'новолуние', 'вода', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(124, 'новолуние', 'вода', 156, 4, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(125, 'новолуние', 'вода', 156, 5, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:11:24'),
(126, 'новолуние', 'вода', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:11:24'),
(127, 'новолуние', 'вода', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(128, 'новолуние', 'вода', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(129, 'растущая', 'вода', 156, 1, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(130, 'растущая', 'вода', 156, 2, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(131, 'растущая', 'вода', 156, 3, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:32:11'),
(132, 'растущая', 'вода', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(133, 'растущая', 'вода', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(134, 'растущая', 'вода', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(135, 'растущая', 'вода', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(136, 'растущая', 'вода', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(137, 'убывающая', 'вода', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(138, 'убывающая', 'вода', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(139, 'убывающая', 'вода', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(140, 'убывающая', 'вода', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(141, 'убывающая', 'вода', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(142, 'убывающая', 'вода', 156, 6, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(143, 'убывающая', 'вода', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(144, 'убывающая', 'вода', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(145, 'полнолуние', 'вода', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(146, 'полнолуние', 'вода', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(147, 'полнолуние', 'вода', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:11:24'),
(148, 'полнолуние', 'вода', 156, 4, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:11:24'),
(149, 'полнолуние', 'вода', 156, 5, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:32:11'),
(150, 'полнолуние', 'вода', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-11 16:44:14'),
(151, 'полнолуние', 'вода', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 05:55:22'),
(152, 'полнолуние', 'вода', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 05:55:22'),
(153, 'новолуние', 'земля', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(154, 'новолуние', 'земля', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(155, 'новолуние', 'земля', 156, 4, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(156, 'новолуние', 'земля', 156, 5, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(157, 'новолуние', 'земля', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(158, 'новолуние', 'земля', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(159, 'новолуние', 'земля', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(160, 'растущая', 'земля', 156, 1, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(161, 'растущая', 'земля', 156, 2, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(162, 'растущая', 'земля', 156, 3, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(163, 'растущая', 'земля', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(164, 'растущая', 'земля', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(165, 'растущая', 'земля', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(166, 'растущая', 'земля', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(167, 'растущая', 'земля', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(168, 'убывающая', 'земля', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(169, 'убывающая', 'земля', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(170, 'убывающая', 'земля', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(171, 'убывающая', 'земля', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(172, 'убывающая', 'земля', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(173, 'убывающая', 'земля', 156, 6, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(174, 'убывающая', 'земля', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(175, 'убывающая', 'земля', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(176, 'полнолуние', 'земля', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(177, 'полнолуние', 'земля', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(178, 'полнолуние', 'земля', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(179, 'полнолуние', 'земля', 156, 4, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(180, 'полнолуние', 'земля', 156, 5, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 03:58:06'),
(181, 'полнолуние', 'земля', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:20:04'),
(182, 'полнолуние', 'земля', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(183, 'полнолуние', 'земля', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(184, 'новолуние', 'огонь', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(185, 'новолуние', 'огонь', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(186, 'новолуние', 'огонь', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(187, 'новолуние', 'огонь', 156, 4, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:00:29'),
(188, 'новолуние', 'огонь', 156, 5, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(189, 'новолуние', 'огонь', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(190, 'новолуние', 'огонь', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(191, 'новолуние', 'огонь', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(192, 'растущая', 'огонь', 156, 1, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:00:29'),
(193, 'растущая', 'огонь', 156, 2, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:00:29'),
(194, 'растущая', 'огонь', 156, 3, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:00:29'),
(195, 'растущая', 'огонь', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(196, 'растущая', 'огонь', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(197, 'растущая', 'огонь', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(198, 'растущая', 'огонь', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(199, 'растущая', 'огонь', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(200, 'убывающая', 'огонь', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(201, 'убывающая', 'огонь', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(202, 'убывающая', 'огонь', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(203, 'убывающая', 'огонь', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(204, 'убывающая', 'огонь', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(205, 'убывающая', 'огонь', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:17'),
(206, 'убывающая', 'огонь', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(207, 'убывающая', 'огонь', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(208, 'полнолуние', 'огонь', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:16'),
(209, 'полнолуние', 'огонь', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:16'),
(210, 'полнолуние', 'огонь', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:16'),
(211, 'полнолуние', 'огонь', 156, 4, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:16'),
(212, 'полнолуние', 'огонь', 156, 5, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:00:29'),
(213, 'полнолуние', 'огонь', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:32:16'),
(214, 'полнолуние', 'огонь', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(215, 'полнолуние', 'огонь', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(216, 'новолуние', 'воздух', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(217, 'новолуние', 'воздух', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(218, 'новолуние', 'воздух', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(219, 'новолуние', 'воздух', 156, 4, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:03:02'),
(220, 'новолуние', 'воздух', 156, 5, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(221, 'новолуние', 'воздух', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(222, 'новолуние', 'воздух', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(223, 'новолуние', 'воздух', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(224, 'растущая', 'воздух', 156, 1, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:03:02'),
(225, 'растущая', 'воздух', 156, 2, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:03:02'),
(226, 'растущая', 'воздух', 156, 3, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:03:02'),
(227, 'растущая', 'воздух', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(228, 'растущая', 'воздух', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(229, 'растущая', 'воздух', 156, 6, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(230, 'растущая', 'воздух', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(231, 'растущая', 'воздух', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(232, 'убывающая', 'воздух', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(233, 'убывающая', 'воздух', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(234, 'убывающая', 'воздух', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(235, 'убывающая', 'воздух', 156, 4, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(236, 'убывающая', 'воздух', 156, 5, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(237, 'убывающая', 'воздух', 156, 6, 'рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:03:02'),
(238, 'убывающая', 'воздух', 156, 7, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(239, 'убывающая', 'воздух', 156, 8, 'нейтрально', '2018-10-11 02:03:19', '2018-10-11 02:03:19'),
(240, 'полнолуние', 'воздух', 156, 1, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(241, 'полнолуние', 'воздух', 156, 2, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(242, 'полнолуние', 'воздух', 156, 3, 'не рекомендовано', '2018-10-11 02:03:19', '2018-10-16 04:36:31'),
(243, 'полнолуние', 'воздух', 156, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:31'),
(244, 'полнолуние', 'воздух', 156, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(245, 'полнолуние', 'воздух', 156, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:31'),
(246, 'полнолуние', 'воздух', 156, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(247, 'полнолуние', 'воздух', 156, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(248, 'новолуние', 'вода', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(249, 'новолуние', 'вода', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(250, 'новолуние', 'вода', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(251, 'новолуние', 'вода', 157, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(252, 'новолуние', 'вода', 157, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(253, 'новолуние', 'вода', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(254, 'новолуние', 'вода', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(255, 'новолуние', 'вода', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(256, 'растущая', 'вода', 157, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(257, 'растущая', 'вода', 157, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(258, 'растущая', 'вода', 157, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(259, 'растущая', 'вода', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(260, 'растущая', 'вода', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(261, 'растущая', 'вода', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(262, 'растущая', 'вода', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(263, 'растущая', 'вода', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(264, 'убывающая', 'вода', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(265, 'убывающая', 'вода', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(266, 'убывающая', 'вода', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(267, 'убывающая', 'вода', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(268, 'убывающая', 'вода', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(269, 'убывающая', 'вода', 157, 6, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(270, 'убывающая', 'вода', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(271, 'убывающая', 'вода', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(272, 'полнолуние', 'вода', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(273, 'полнолуние', 'вода', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(274, 'полнолуние', 'вода', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(275, 'полнолуние', 'вода', 157, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(276, 'полнолуние', 'вода', 157, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:29:31'),
(277, 'полнолуние', 'вода', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:24'),
(278, 'полнолуние', 'вода', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(279, 'полнолуние', 'вода', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(280, 'новолуние', 'земля', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(281, 'новолуние', 'земля', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(282, 'новолуние', 'земля', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(283, 'новолуние', 'земля', 157, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(284, 'новолуние', 'земля', 157, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(285, 'новолуние', 'земля', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(286, 'новолуние', 'земля', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(287, 'новолуние', 'земля', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(288, 'растущая', 'земля', 157, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(289, 'растущая', 'земля', 157, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(290, 'растущая', 'земля', 157, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(291, 'растущая', 'земля', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(292, 'растущая', 'земля', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(293, 'растущая', 'земля', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(294, 'растущая', 'земля', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(295, 'растущая', 'земля', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(296, 'убывающая', 'земля', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(297, 'убывающая', 'земля', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(298, 'убывающая', 'земля', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(299, 'убывающая', 'земля', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(300, 'убывающая', 'земля', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(301, 'убывающая', 'земля', 157, 6, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(302, 'убывающая', 'земля', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(303, 'убывающая', 'земля', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(304, 'полнолуние', 'земля', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(305, 'полнолуние', 'земля', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(306, 'полнолуние', 'земля', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(307, 'полнолуние', 'земля', 157, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(308, 'полнолуние', 'земля', 157, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(309, 'полнолуние', 'земля', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(310, 'полнолуние', 'земля', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(311, 'полнолуние', 'земля', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(312, 'новолуние', 'огонь', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(313, 'новолуние', 'огонь', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(314, 'новолуние', 'огонь', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(315, 'новолуние', 'огонь', 157, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(316, 'новолуние', 'огонь', 157, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(317, 'новолуние', 'огонь', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(318, 'новолуние', 'огонь', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(319, 'новолуние', 'огонь', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(320, 'растущая', 'огонь', 157, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(321, 'растущая', 'огонь', 157, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(322, 'растущая', 'огонь', 157, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(323, 'растущая', 'огонь', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(324, 'растущая', 'огонь', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(325, 'растущая', 'огонь', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(326, 'растущая', 'огонь', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(327, 'растущая', 'огонь', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(328, 'убывающая', 'огонь', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(329, 'убывающая', 'огонь', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(330, 'убывающая', 'огонь', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(331, 'убывающая', 'огонь', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(332, 'убывающая', 'огонь', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(333, 'убывающая', 'огонь', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(334, 'убывающая', 'огонь', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(335, 'убывающая', 'огонь', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(336, 'полнолуние', 'огонь', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(337, 'полнолуние', 'огонь', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(338, 'полнолуние', 'огонь', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(339, 'полнолуние', 'огонь', 157, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(340, 'полнолуние', 'огонь', 157, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(341, 'полнолуние', 'огонь', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(342, 'полнолуние', 'огонь', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(343, 'полнолуние', 'огонь', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(344, 'новолуние', 'воздух', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(345, 'новолуние', 'воздух', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(346, 'новолуние', 'воздух', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(347, 'новолуние', 'воздух', 157, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(348, 'новолуние', 'воздух', 157, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(349, 'новолуние', 'воздух', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(350, 'новолуние', 'воздух', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(351, 'новолуние', 'воздух', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(352, 'растущая', 'воздух', 157, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(353, 'растущая', 'воздух', 157, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(354, 'растущая', 'воздух', 157, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(355, 'растущая', 'воздух', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(356, 'растущая', 'воздух', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(357, 'растущая', 'воздух', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(358, 'растущая', 'воздух', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(359, 'растущая', 'воздух', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(360, 'убывающая', 'воздух', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(361, 'убывающая', 'воздух', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(362, 'убывающая', 'воздух', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(363, 'убывающая', 'воздух', 157, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(364, 'убывающая', 'воздух', 157, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(365, 'убывающая', 'воздух', 157, 6, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(366, 'убывающая', 'воздух', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(367, 'убывающая', 'воздух', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(368, 'полнолуние', 'воздух', 157, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(369, 'полнолуние', 'воздух', 157, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(370, 'полнолуние', 'воздух', 157, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(371, 'полнолуние', 'воздух', 157, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(372, 'полнолуние', 'воздух', 157, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:03:02'),
(373, 'полнолуние', 'воздух', 157, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:36:32'),
(374, 'полнолуние', 'воздух', 157, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(375, 'полнолуние', 'воздух', 157, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(376, 'новолуние', 'вода', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(377, 'новолуние', 'вода', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(378, 'новолуние', 'вода', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(379, 'новолуние', 'вода', 159, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(380, 'новолуние', 'вода', 159, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(381, 'новолуние', 'вода', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(382, 'новолуние', 'вода', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(383, 'новолуние', 'вода', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(384, 'растущая', 'вода', 159, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(385, 'растущая', 'вода', 159, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(386, 'растущая', 'вода', 159, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(387, 'растущая', 'вода', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(388, 'растущая', 'вода', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(389, 'растущая', 'вода', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-11 04:39:22'),
(390, 'растущая', 'вода', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(391, 'растущая', 'вода', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(392, 'убывающая', 'вода', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(393, 'убывающая', 'вода', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(394, 'убывающая', 'вода', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(395, 'убывающая', 'вода', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(396, 'убывающая', 'вода', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(397, 'убывающая', 'вода', 159, 6, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:32:11'),
(398, 'убывающая', 'вода', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(399, 'убывающая', 'вода', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(400, 'полнолуние', 'вода', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(401, 'полнолуние', 'вода', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(402, 'полнолуние', 'вода', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(403, 'полнолуние', 'вода', 159, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:11:25'),
(404, 'полнолуние', 'вода', 159, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:29:32'),
(405, 'полнолуние', 'вода', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-11 16:44:14'),
(406, 'полнолуние', 'вода', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(407, 'полнолуние', 'вода', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(408, 'новолуние', 'земля', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(409, 'новолуние', 'земля', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(410, 'новолуние', 'земля', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(411, 'новолуние', 'земля', 159, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(412, 'новолуние', 'земля', 159, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(413, 'новолуние', 'земля', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(414, 'новолуние', 'земля', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(415, 'новолуние', 'земля', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(416, 'растущая', 'земля', 159, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(417, 'растущая', 'земля', 159, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(418, 'растущая', 'земля', 159, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(419, 'растущая', 'земля', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(420, 'растущая', 'земля', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(421, 'растущая', 'земля', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(422, 'растущая', 'земля', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(423, 'растущая', 'земля', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(424, 'убывающая', 'земля', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(425, 'убывающая', 'земля', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(426, 'убывающая', 'земля', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(427, 'убывающая', 'земля', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(428, 'убывающая', 'земля', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(429, 'убывающая', 'земля', 159, 6, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(430, 'убывающая', 'земля', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(431, 'убывающая', 'земля', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(432, 'полнолуние', 'земля', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(433, 'полнолуние', 'земля', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(434, 'полнолуние', 'земля', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(435, 'полнолуние', 'земля', 159, 4, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(436, 'полнолуние', 'земля', 159, 5, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 03:58:07'),
(437, 'полнолуние', 'земля', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:20:05'),
(438, 'полнолуние', 'земля', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(439, 'полнолуние', 'земля', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(440, 'новолуние', 'огонь', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(441, 'новолуние', 'огонь', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(442, 'новолуние', 'огонь', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(443, 'новолуние', 'огонь', 159, 4, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(444, 'новолуние', 'огонь', 159, 5, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(445, 'новолуние', 'огонь', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(446, 'новолуние', 'огонь', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(447, 'новолуние', 'огонь', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(448, 'растущая', 'огонь', 159, 1, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(449, 'растущая', 'огонь', 159, 2, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(450, 'растущая', 'огонь', 159, 3, 'рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:00:29'),
(451, 'растущая', 'огонь', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(452, 'растущая', 'огонь', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(453, 'растущая', 'огонь', 159, 6, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(454, 'растущая', 'огонь', 159, 7, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(455, 'растущая', 'огонь', 159, 8, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(456, 'убывающая', 'огонь', 159, 1, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(457, 'убывающая', 'огонь', 159, 2, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(458, 'убывающая', 'огонь', 159, 3, 'не рекомендовано', '2018-10-11 02:03:20', '2018-10-16 04:32:17'),
(459, 'убывающая', 'огонь', 159, 4, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(460, 'убывающая', 'огонь', 159, 5, 'нейтрально', '2018-10-11 02:03:20', '2018-10-11 02:03:20'),
(461, 'убывающая', 'огонь', 159, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(462, 'убывающая', 'огонь', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(463, 'убывающая', 'огонь', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(464, 'полнолуние', 'огонь', 159, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(465, 'полнолуние', 'огонь', 159, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(466, 'полнолуние', 'огонь', 159, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(467, 'полнолуние', 'огонь', 159, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(468, 'полнолуние', 'огонь', 159, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(469, 'полнолуние', 'огонь', 159, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(470, 'полнолуние', 'огонь', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(471, 'полнолуние', 'огонь', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(472, 'новолуние', 'воздух', 159, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(473, 'новолуние', 'воздух', 159, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(474, 'новолуние', 'воздух', 159, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(475, 'новолуние', 'воздух', 159, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(476, 'новолуние', 'воздух', 159, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(477, 'новолуние', 'воздух', 159, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(478, 'новолуние', 'воздух', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(479, 'новолуние', 'воздух', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(480, 'растущая', 'воздух', 159, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(481, 'растущая', 'воздух', 159, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(482, 'растущая', 'воздух', 159, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(483, 'растущая', 'воздух', 159, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(484, 'растущая', 'воздух', 159, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(485, 'растущая', 'воздух', 159, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(486, 'растущая', 'воздух', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(487, 'растущая', 'воздух', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(488, 'убывающая', 'воздух', 159, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(489, 'убывающая', 'воздух', 159, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(490, 'убывающая', 'воздух', 159, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(491, 'убывающая', 'воздух', 159, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(492, 'убывающая', 'воздух', 159, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(493, 'убывающая', 'воздух', 159, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(494, 'убывающая', 'воздух', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(495, 'убывающая', 'воздух', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(496, 'полнолуние', 'воздух', 159, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(497, 'полнолуние', 'воздух', 159, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(498, 'полнолуние', 'воздух', 159, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(499, 'полнолуние', 'воздух', 159, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(500, 'полнолуние', 'воздух', 159, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(501, 'полнолуние', 'воздух', 159, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(502, 'полнолуние', 'воздух', 159, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(503, 'полнолуние', 'воздух', 159, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(504, 'новолуние', 'вода', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(505, 'новолуние', 'вода', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(506, 'новолуние', 'вода', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(507, 'новолуние', 'вода', 160, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(508, 'новолуние', 'вода', 160, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(509, 'новолуние', 'вода', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(510, 'новолуние', 'вода', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:26:11'),
(511, 'новолуние', 'вода', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(512, 'растущая', 'вода', 160, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:11'),
(513, 'растущая', 'вода', 160, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:11'),
(514, 'растущая', 'вода', 160, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:11'),
(515, 'растущая', 'вода', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(516, 'растущая', 'вода', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(517, 'растущая', 'вода', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(518, 'растущая', 'вода', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(519, 'растущая', 'вода', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(520, 'убывающая', 'вода', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(521, 'убывающая', 'вода', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(522, 'убывающая', 'вода', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(523, 'убывающая', 'вода', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(524, 'убывающая', 'вода', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(525, 'убывающая', 'вода', 160, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:11'),
(526, 'убывающая', 'вода', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(527, 'убывающая', 'вода', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(528, 'полнолуние', 'вода', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(529, 'полнолуние', 'вода', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(530, 'полнолуние', 'вода', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(531, 'полнолуние', 'вода', 160, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(532, 'полнолуние', 'вода', 160, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:29:32'),
(533, 'полнолуние', 'вода', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(534, 'полнолуние', 'вода', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(535, 'полнолуние', 'вода', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(536, 'новолуние', 'земля', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(537, 'новолуние', 'земля', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(538, 'новолуние', 'земля', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(539, 'новолуние', 'земля', 160, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(540, 'новолуние', 'земля', 160, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(541, 'новолуние', 'земля', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(542, 'новолуние', 'земля', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(543, 'новолуние', 'земля', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(544, 'растущая', 'земля', 160, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(545, 'растущая', 'земля', 160, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(546, 'растущая', 'земля', 160, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(547, 'растущая', 'земля', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(548, 'растущая', 'земля', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(549, 'растущая', 'земля', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(550, 'растущая', 'земля', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(551, 'растущая', 'земля', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(552, 'убывающая', 'земля', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(553, 'убывающая', 'земля', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(554, 'убывающая', 'земля', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(555, 'убывающая', 'земля', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(556, 'убывающая', 'земля', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(557, 'убывающая', 'земля', 160, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(558, 'убывающая', 'земля', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(559, 'убывающая', 'земля', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(560, 'полнолуние', 'земля', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(561, 'полнолуние', 'земля', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(562, 'полнолуние', 'земля', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(563, 'полнолуние', 'земля', 160, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(564, 'полнолуние', 'земля', 160, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(565, 'полнолуние', 'земля', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:05'),
(566, 'полнолуние', 'земля', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(567, 'полнолуние', 'земля', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(568, 'новолуние', 'огонь', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(569, 'новолуние', 'огонь', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(570, 'новолуние', 'огонь', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(571, 'новолуние', 'огонь', 160, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(572, 'новолуние', 'огонь', 160, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(573, 'новолуние', 'огонь', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(574, 'новолуние', 'огонь', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(575, 'новолуние', 'огонь', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(576, 'растущая', 'огонь', 160, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(577, 'растущая', 'огонь', 160, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(578, 'растущая', 'огонь', 160, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(579, 'растущая', 'огонь', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(580, 'растущая', 'огонь', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(581, 'растущая', 'огонь', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(582, 'растущая', 'огонь', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(583, 'растущая', 'огонь', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(584, 'убывающая', 'огонь', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(585, 'убывающая', 'огонь', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(586, 'убывающая', 'огонь', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(587, 'убывающая', 'огонь', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(588, 'убывающая', 'огонь', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(589, 'убывающая', 'огонь', 160, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(590, 'убывающая', 'огонь', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(591, 'убывающая', 'огонь', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(592, 'полнолуние', 'огонь', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(593, 'полнолуние', 'огонь', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(594, 'полнолуние', 'огонь', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(595, 'полнолуние', 'огонь', 160, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(596, 'полнолуние', 'огонь', 160, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:00:29'),
(597, 'полнолуние', 'огонь', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:32:17'),
(598, 'полнолуние', 'огонь', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(599, 'полнолуние', 'огонь', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(600, 'новолуние', 'воздух', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(601, 'новолуние', 'воздух', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(602, 'новолуние', 'воздух', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(603, 'новолуние', 'воздух', 160, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(604, 'новолуние', 'воздух', 160, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(605, 'новолуние', 'воздух', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(606, 'новолуние', 'воздух', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(607, 'новолуние', 'воздух', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(608, 'растущая', 'воздух', 160, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(609, 'растущая', 'воздух', 160, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(610, 'растущая', 'воздух', 160, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(611, 'растущая', 'воздух', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(612, 'растущая', 'воздух', 160, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(613, 'растущая', 'воздух', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(614, 'растущая', 'воздух', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(615, 'растущая', 'воздух', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(616, 'убывающая', 'воздух', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(617, 'убывающая', 'воздух', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(618, 'убывающая', 'воздух', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(619, 'убывающая', 'воздух', 160, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(620, 'убывающая', 'воздух', 160, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(621, 'убывающая', 'воздух', 160, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(622, 'убывающая', 'воздух', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(623, 'убывающая', 'воздух', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(624, 'полнолуние', 'воздух', 160, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(625, 'полнолуние', 'воздух', 160, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(626, 'полнолуние', 'воздух', 160, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32');
INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(627, 'полнолуние', 'воздух', 160, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(628, 'полнолуние', 'воздух', 160, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:03:02'),
(629, 'полнолуние', 'воздух', 160, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:36:32'),
(630, 'полнолуние', 'воздух', 160, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(631, 'полнолуние', 'воздух', 160, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(632, 'новолуние', 'вода', 161, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(633, 'новолуние', 'вода', 161, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(634, 'новолуние', 'вода', 161, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(635, 'новолуние', 'вода', 161, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(636, 'новолуние', 'вода', 161, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(637, 'новолуние', 'вода', 161, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(638, 'новолуние', 'вода', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(639, 'новолуние', 'вода', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(640, 'растущая', 'вода', 161, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:12'),
(641, 'растущая', 'вода', 161, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:12'),
(642, 'растущая', 'вода', 161, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:12'),
(643, 'растущая', 'вода', 161, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(644, 'растущая', 'вода', 161, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(645, 'растущая', 'вода', 161, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(646, 'растущая', 'вода', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(647, 'растущая', 'вода', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(648, 'убывающая', 'вода', 161, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(649, 'убывающая', 'вода', 161, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(650, 'убывающая', 'вода', 161, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(651, 'убывающая', 'вода', 161, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(652, 'убывающая', 'вода', 161, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(653, 'убывающая', 'вода', 161, 6, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:32:12'),
(654, 'убывающая', 'вода', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(655, 'убывающая', 'вода', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(656, 'полнолуние', 'вода', 161, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(657, 'полнолуние', 'вода', 161, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(658, 'полнолуние', 'вода', 161, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(659, 'полнолуние', 'вода', 161, 4, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(660, 'полнолуние', 'вода', 161, 5, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:29:32'),
(661, 'полнолуние', 'вода', 161, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:11:25'),
(662, 'полнолуние', 'вода', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(663, 'полнолуние', 'вода', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(664, 'новолуние', 'земля', 161, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(665, 'новолуние', 'земля', 161, 2, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(666, 'новолуние', 'земля', 161, 3, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(667, 'новолуние', 'земля', 161, 4, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(668, 'новолуние', 'земля', 161, 5, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(669, 'новолуние', 'земля', 161, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(670, 'новолуние', 'земля', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(671, 'новолуние', 'земля', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(672, 'растущая', 'земля', 161, 1, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(673, 'растущая', 'земля', 161, 2, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(674, 'растущая', 'земля', 161, 3, 'рекомендовано', '2018-10-11 02:03:21', '2018-10-16 03:58:07'),
(675, 'растущая', 'земля', 161, 4, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(676, 'растущая', 'земля', 161, 5, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(677, 'растущая', 'земля', 161, 6, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(678, 'растущая', 'земля', 161, 7, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(679, 'растущая', 'земля', 161, 8, 'нейтрально', '2018-10-11 02:03:21', '2018-10-11 02:03:21'),
(680, 'убывающая', 'земля', 161, 1, 'не рекомендовано', '2018-10-11 02:03:21', '2018-10-16 04:20:06'),
(681, 'убывающая', 'земля', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(682, 'убывающая', 'земля', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(683, 'убывающая', 'земля', 161, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:07'),
(684, 'убывающая', 'земля', 161, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(685, 'убывающая', 'земля', 161, 6, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(686, 'убывающая', 'земля', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(687, 'убывающая', 'земля', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(688, 'полнолуние', 'земля', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(689, 'полнолуние', 'земля', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(690, 'полнолуние', 'земля', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(691, 'полнолуние', 'земля', 161, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(692, 'полнолуние', 'земля', 161, 5, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:07'),
(693, 'полнолуние', 'земля', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(694, 'полнолуние', 'земля', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(695, 'полнолуние', 'земля', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(696, 'новолуние', 'огонь', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(697, 'новолуние', 'огонь', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(698, 'новолуние', 'огонь', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(699, 'новолуние', 'огонь', 161, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(700, 'новолуние', 'огонь', 161, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(701, 'новолуние', 'огонь', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(702, 'новолуние', 'огонь', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(703, 'новолуние', 'огонь', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(704, 'растущая', 'огонь', 161, 1, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(705, 'растущая', 'огонь', 161, 2, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(706, 'растущая', 'огонь', 161, 3, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(707, 'растущая', 'огонь', 161, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(708, 'растущая', 'огонь', 161, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(709, 'растущая', 'огонь', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(710, 'растущая', 'огонь', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(711, 'растущая', 'огонь', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(712, 'убывающая', 'огонь', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(713, 'убывающая', 'огонь', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(714, 'убывающая', 'огонь', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(715, 'убывающая', 'огонь', 161, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(716, 'убывающая', 'огонь', 161, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(717, 'убывающая', 'огонь', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(718, 'убывающая', 'огонь', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(719, 'убывающая', 'огонь', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(720, 'полнолуние', 'огонь', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(721, 'полнолуние', 'огонь', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(722, 'полнолуние', 'огонь', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(723, 'полнолуние', 'огонь', 161, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(724, 'полнолуние', 'огонь', 161, 5, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(725, 'полнолуние', 'огонь', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(726, 'полнолуние', 'огонь', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(727, 'полнолуние', 'огонь', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(728, 'новолуние', 'воздух', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(729, 'новолуние', 'воздух', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(730, 'новолуние', 'воздух', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(731, 'новолуние', 'воздух', 161, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(732, 'новолуние', 'воздух', 161, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(733, 'новолуние', 'воздух', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(734, 'новолуние', 'воздух', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(735, 'новолуние', 'воздух', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(736, 'растущая', 'воздух', 161, 1, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(737, 'растущая', 'воздух', 161, 2, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(738, 'растущая', 'воздух', 161, 3, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(739, 'растущая', 'воздух', 161, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(740, 'растущая', 'воздух', 161, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(741, 'растущая', 'воздух', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(742, 'растущая', 'воздух', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(743, 'растущая', 'воздух', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(744, 'убывающая', 'воздух', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(745, 'убывающая', 'воздух', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(746, 'убывающая', 'воздух', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(747, 'убывающая', 'воздух', 161, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(748, 'убывающая', 'воздух', 161, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(749, 'убывающая', 'воздух', 161, 6, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(750, 'убывающая', 'воздух', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(751, 'убывающая', 'воздух', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(752, 'полнолуние', 'воздух', 161, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(753, 'полнолуние', 'воздух', 161, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(754, 'полнолуние', 'воздух', 161, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(755, 'полнолуние', 'воздух', 161, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(756, 'полнолуние', 'воздух', 161, 5, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:03:03'),
(757, 'полнолуние', 'воздух', 161, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:36:32'),
(758, 'полнолуние', 'воздух', 161, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(759, 'полнолуние', 'воздух', 161, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(760, 'новолуние', 'вода', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(761, 'новолуние', 'вода', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(762, 'новолуние', 'вода', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(763, 'новолуние', 'вода', 248, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(764, 'новолуние', 'вода', 248, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(765, 'новолуние', 'вода', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(766, 'новолуние', 'вода', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(767, 'новолуние', 'вода', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(768, 'растущая', 'вода', 248, 1, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:32:12'),
(769, 'растущая', 'вода', 248, 2, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:32:12'),
(770, 'растущая', 'вода', 248, 3, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:32:12'),
(771, 'растущая', 'вода', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(772, 'растущая', 'вода', 248, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(773, 'растущая', 'вода', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(774, 'растущая', 'вода', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(775, 'растущая', 'вода', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(776, 'убывающая', 'вода', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(777, 'убывающая', 'вода', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(778, 'убывающая', 'вода', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(779, 'убывающая', 'вода', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(780, 'убывающая', 'вода', 248, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(781, 'убывающая', 'вода', 248, 6, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:32:12'),
(782, 'убывающая', 'вода', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(783, 'убывающая', 'вода', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(784, 'полнолуние', 'вода', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(785, 'полнолуние', 'вода', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(786, 'полнолуние', 'вода', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(787, 'полнолуние', 'вода', 248, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(788, 'полнолуние', 'вода', 248, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(789, 'полнолуние', 'вода', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:11:25'),
(790, 'полнолуние', 'вода', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(791, 'полнолуние', 'вода', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(792, 'новолуние', 'земля', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(793, 'новолуние', 'земля', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(794, 'новолуние', 'земля', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(795, 'новолуние', 'земля', 248, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(796, 'новолуние', 'земля', 248, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(797, 'новолуние', 'земля', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(798, 'новолуние', 'земля', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(799, 'новолуние', 'земля', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(800, 'растущая', 'земля', 248, 1, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(801, 'растущая', 'земля', 248, 2, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(802, 'растущая', 'земля', 248, 3, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(803, 'растущая', 'земля', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(804, 'растущая', 'земля', 248, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(805, 'растущая', 'земля', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(806, 'растущая', 'земля', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(807, 'растущая', 'земля', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(808, 'убывающая', 'земля', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(809, 'убывающая', 'земля', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(810, 'убывающая', 'земля', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(811, 'убывающая', 'земля', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(812, 'убывающая', 'земля', 248, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(813, 'убывающая', 'земля', 248, 6, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(814, 'убывающая', 'земля', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(815, 'убывающая', 'земля', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(816, 'полнолуние', 'земля', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(817, 'полнолуние', 'земля', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(818, 'полнолуние', 'земля', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(819, 'полнолуние', 'земля', 248, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(820, 'полнолуние', 'земля', 248, 5, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 03:58:08'),
(821, 'полнолуние', 'земля', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:20:06'),
(822, 'полнолуние', 'земля', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(823, 'полнолуние', 'земля', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(824, 'новолуние', 'огонь', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(825, 'новолуние', 'огонь', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(826, 'новолуние', 'огонь', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(827, 'новолуние', 'огонь', 248, 4, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(828, 'новолуние', 'огонь', 248, 5, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(829, 'новолуние', 'огонь', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(830, 'новолуние', 'огонь', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(831, 'новолуние', 'огонь', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(832, 'растущая', 'огонь', 248, 1, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(833, 'растущая', 'огонь', 248, 2, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(834, 'растущая', 'огонь', 248, 3, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(835, 'растущая', 'огонь', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(836, 'растущая', 'огонь', 248, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(837, 'растущая', 'огонь', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(838, 'растущая', 'огонь', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(839, 'растущая', 'огонь', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(840, 'убывающая', 'огонь', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(841, 'убывающая', 'огонь', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(842, 'убывающая', 'огонь', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(843, 'убывающая', 'огонь', 248, 4, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(844, 'убывающая', 'огонь', 248, 5, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(845, 'убывающая', 'огонь', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(846, 'убывающая', 'огонь', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(847, 'убывающая', 'огонь', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(848, 'полнолуние', 'огонь', 248, 1, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(849, 'полнолуние', 'огонь', 248, 2, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(850, 'полнолуние', 'огонь', 248, 3, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(851, 'полнолуние', 'огонь', 248, 4, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(852, 'полнолуние', 'огонь', 248, 5, 'рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:00:30'),
(853, 'полнолуние', 'огонь', 248, 6, 'не рекомендовано', '2018-10-11 02:03:22', '2018-10-16 04:32:18'),
(854, 'полнолуние', 'огонь', 248, 7, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(855, 'полнолуние', 'огонь', 248, 8, 'нейтрально', '2018-10-11 02:03:22', '2018-10-11 02:03:22'),
(856, 'новолуние', 'воздух', 248, 1, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(857, 'новолуние', 'воздух', 248, 2, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(858, 'новолуние', 'воздух', 248, 3, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(859, 'новолуние', 'воздух', 248, 4, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(860, 'новолуние', 'воздух', 248, 5, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(861, 'новолуние', 'воздух', 248, 6, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(862, 'новолуние', 'воздух', 248, 7, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(863, 'новолуние', 'воздух', 248, 8, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(864, 'растущая', 'воздух', 248, 1, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(865, 'растущая', 'воздух', 248, 2, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(866, 'растущая', 'воздух', 248, 3, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(867, 'растущая', 'воздух', 248, 4, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(868, 'растущая', 'воздух', 248, 5, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(869, 'растущая', 'воздух', 248, 6, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(870, 'растущая', 'воздух', 248, 7, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(871, 'растущая', 'воздух', 248, 8, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(872, 'убывающая', 'воздух', 248, 1, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(873, 'убывающая', 'воздух', 248, 2, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(874, 'убывающая', 'воздух', 248, 3, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(875, 'убывающая', 'воздух', 248, 4, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(876, 'убывающая', 'воздух', 248, 5, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(877, 'убывающая', 'воздух', 248, 6, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(878, 'убывающая', 'воздух', 248, 7, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(879, 'убывающая', 'воздух', 248, 8, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(880, 'полнолуние', 'воздух', 248, 1, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(881, 'полнолуние', 'воздух', 248, 2, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(882, 'полнолуние', 'воздух', 248, 3, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(883, 'полнолуние', 'воздух', 248, 4, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(884, 'полнолуние', 'воздух', 248, 5, 'рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:03:03'),
(885, 'полнолуние', 'воздух', 248, 6, 'не рекомендовано', '2018-10-11 02:03:23', '2018-10-16 04:36:33'),
(886, 'полнолуние', 'воздух', 248, 7, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(887, 'полнолуние', 'воздух', 248, 8, 'нейтрально', '2018-10-11 02:03:23', '2018-10-11 02:03:23'),
(888, 'новолуние', 'вода', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(889, 'новолуние', 'вода', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(890, 'новолуние', 'вода', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(891, 'новолуние', 'вода', 167, 4, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(892, 'новолуние', 'вода', 167, 5, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(893, 'новолуние', 'вода', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(894, 'новолуние', 'вода', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(895, 'новолуние', 'вода', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(896, 'растущая', 'вода', 167, 1, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(897, 'растущая', 'вода', 167, 2, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(898, 'растущая', 'вода', 167, 3, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(899, 'растущая', 'вода', 167, 4, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(900, 'растущая', 'вода', 167, 5, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(901, 'растущая', 'вода', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(902, 'растущая', 'вода', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(903, 'растущая', 'вода', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(904, 'убывающая', 'вода', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(905, 'убывающая', 'вода', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(906, 'убывающая', 'вода', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:32:30'),
(907, 'убывающая', 'вода', 167, 4, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(908, 'убывающая', 'вода', 167, 5, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(909, 'убывающая', 'вода', 167, 6, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(910, 'убывающая', 'вода', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(911, 'убывающая', 'вода', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(912, 'полнолуние', 'вода', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:27:27'),
(913, 'полнолуние', 'вода', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:27:27'),
(914, 'полнолуние', 'вода', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:27:27'),
(915, 'полнолуние', 'вода', 167, 4, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:27:27'),
(916, 'полнолуние', 'вода', 167, 5, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:47:25'),
(917, 'полнолуние', 'вода', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:27:27'),
(918, 'полнолуние', 'вода', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(919, 'полнолуние', 'вода', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(920, 'новолуние', 'земля', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(921, 'новолуние', 'земля', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(922, 'новолуние', 'земля', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(923, 'новолуние', 'земля', 167, 4, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(924, 'новолуние', 'земля', 167, 5, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(925, 'новолуние', 'земля', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(926, 'новолуние', 'земля', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(927, 'новолуние', 'земля', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(928, 'растущая', 'земля', 167, 1, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(929, 'растущая', 'земля', 167, 2, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(930, 'растущая', 'земля', 167, 3, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(931, 'растущая', 'земля', 167, 4, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(932, 'растущая', 'земля', 167, 5, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(933, 'растущая', 'земля', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(934, 'растущая', 'земля', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(935, 'растущая', 'земля', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(936, 'убывающая', 'земля', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(937, 'убывающая', 'земля', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(938, 'убывающая', 'земля', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(939, 'убывающая', 'земля', 167, 4, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(940, 'убывающая', 'земля', 167, 5, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(941, 'убывающая', 'земля', 167, 6, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(942, 'убывающая', 'земля', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(943, 'убывающая', 'земля', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(944, 'полнолуние', 'земля', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(945, 'полнолуние', 'земля', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(946, 'полнолуние', 'земля', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(947, 'полнолуние', 'земля', 167, 4, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(948, 'полнолуние', 'земля', 167, 5, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:51:52'),
(949, 'полнолуние', 'земля', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:41:30'),
(950, 'полнолуние', 'земля', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(951, 'полнолуние', 'земля', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(952, 'новолуние', 'огонь', 167, 1, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:58:26'),
(953, 'новолуние', 'огонь', 167, 2, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:58:26'),
(954, 'новолуние', 'огонь', 167, 3, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:58:26'),
(955, 'новолуние', 'огонь', 167, 4, 'рекомендовано', '2018-10-11 02:38:02', '2018-10-16 04:55:55'),
(956, 'новолуние', 'огонь', 167, 5, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:58:26'),
(957, 'новолуние', 'огонь', 167, 6, 'не рекомендовано', '2018-10-11 02:38:02', '2018-10-16 05:58:26'),
(958, 'новолуние', 'огонь', 167, 7, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(959, 'новолуние', 'огонь', 167, 8, 'нейтрально', '2018-10-11 02:38:02', '2018-10-11 02:38:02'),
(960, 'растущая', 'огонь', 167, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(961, 'растущая', 'огонь', 167, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(962, 'растущая', 'огонь', 167, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(963, 'растущая', 'огонь', 167, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(964, 'растущая', 'огонь', 167, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(965, 'растущая', 'огонь', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(966, 'растущая', 'огонь', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(967, 'растущая', 'огонь', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(968, 'убывающая', 'огонь', 167, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(969, 'убывающая', 'огонь', 167, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(970, 'убывающая', 'огонь', 167, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(971, 'убывающая', 'огонь', 167, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(972, 'убывающая', 'огонь', 167, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(973, 'убывающая', 'огонь', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(974, 'убывающая', 'огонь', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(975, 'убывающая', 'огонь', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(976, 'полнолуние', 'огонь', 167, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(977, 'полнолуние', 'огонь', 167, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(978, 'полнолуние', 'огонь', 167, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(979, 'полнолуние', 'огонь', 167, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(980, 'полнолуние', 'огонь', 167, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(981, 'полнолуние', 'огонь', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(982, 'полнолуние', 'огонь', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(983, 'полнолуние', 'огонь', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(984, 'новолуние', 'воздух', 167, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(985, 'новолуние', 'воздух', 167, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(986, 'новолуние', 'воздух', 167, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(987, 'новолуние', 'воздух', 167, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(988, 'новолуние', 'воздух', 167, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(989, 'новолуние', 'воздух', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(990, 'новолуние', 'воздух', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(991, 'новолуние', 'воздух', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(992, 'растущая', 'воздух', 167, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(993, 'растущая', 'воздух', 167, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(994, 'растущая', 'воздух', 167, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(995, 'растущая', 'воздух', 167, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(996, 'растущая', 'воздух', 167, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(997, 'растущая', 'воздух', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(998, 'растущая', 'воздух', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(999, 'растущая', 'воздух', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1000, 'убывающая', 'воздух', 167, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1001, 'убывающая', 'воздух', 167, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1002, 'убывающая', 'воздух', 167, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1003, 'убывающая', 'воздух', 167, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1004, 'убывающая', 'воздух', 167, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1005, 'убывающая', 'воздух', 167, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1006, 'убывающая', 'воздух', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1007, 'убывающая', 'воздух', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1008, 'полнолуние', 'воздух', 167, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1009, 'полнолуние', 'воздух', 167, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1010, 'полнолуние', 'воздух', 167, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1011, 'полнолуние', 'воздух', 167, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1012, 'полнолуние', 'воздух', 167, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1013, 'полнолуние', 'воздух', 167, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1014, 'полнолуние', 'воздух', 167, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1015, 'полнолуние', 'воздух', 167, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1016, 'новолуние', 'вода', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1017, 'новолуние', 'вода', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1018, 'новолуние', 'вода', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1019, 'новолуние', 'вода', 168, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:25'),
(1020, 'новолуние', 'вода', 168, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1021, 'новолуние', 'вода', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1022, 'новолуние', 'вода', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1023, 'новолуние', 'вода', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1024, 'растущая', 'вода', 168, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:25'),
(1025, 'растущая', 'вода', 168, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1026, 'растущая', 'вода', 168, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:25'),
(1027, 'растущая', 'вода', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1028, 'растущая', 'вода', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1029, 'растущая', 'вода', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1030, 'растущая', 'вода', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1031, 'растущая', 'вода', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1032, 'убывающая', 'вода', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1033, 'убывающая', 'вода', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1034, 'убывающая', 'вода', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1035, 'убывающая', 'вода', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1036, 'убывающая', 'вода', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1037, 'убывающая', 'вода', 168, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:25'),
(1038, 'убывающая', 'вода', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1039, 'убывающая', 'вода', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1040, 'полнолуние', 'вода', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1041, 'полнолуние', 'вода', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1042, 'полнолуние', 'вода', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1043, 'полнолуние', 'вода', 168, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1044, 'полнолуние', 'вода', 168, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:25'),
(1045, 'полнолуние', 'вода', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1046, 'полнолуние', 'вода', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1047, 'полнолуние', 'вода', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1048, 'новолуние', 'земля', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1049, 'новолуние', 'земля', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1050, 'новолуние', 'земля', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1051, 'новолуние', 'земля', 168, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1052, 'новолуние', 'земля', 168, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1053, 'новолуние', 'земля', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1054, 'новолуние', 'земля', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1055, 'новолуние', 'земля', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1056, 'растущая', 'земля', 168, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1057, 'растущая', 'земля', 168, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1058, 'растущая', 'земля', 168, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1059, 'растущая', 'земля', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1060, 'растущая', 'земля', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1061, 'растущая', 'земля', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1062, 'растущая', 'земля', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1063, 'растущая', 'земля', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1064, 'убывающая', 'земля', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1065, 'убывающая', 'земля', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1066, 'убывающая', 'земля', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1067, 'убывающая', 'земля', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1068, 'убывающая', 'земля', 168, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1069, 'убывающая', 'земля', 168, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1070, 'убывающая', 'земля', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1071, 'убывающая', 'земля', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1072, 'полнолуние', 'земля', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1073, 'полнолуние', 'земля', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1074, 'полнолуние', 'земля', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1075, 'полнолуние', 'земля', 168, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1076, 'полнолуние', 'земля', 168, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1077, 'полнолуние', 'земля', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:30'),
(1078, 'полнолуние', 'земля', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1079, 'полнолуние', 'земля', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1080, 'новолуние', 'огонь', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1081, 'новолуние', 'огонь', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1082, 'новолуние', 'огонь', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1083, 'новолуние', 'огонь', 168, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1084, 'новолуние', 'огонь', 168, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1085, 'новолуние', 'огонь', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1086, 'новолуние', 'огонь', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1087, 'новолуние', 'огонь', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1088, 'растущая', 'огонь', 168, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1089, 'растущая', 'огонь', 168, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1090, 'растущая', 'огонь', 168, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1091, 'растущая', 'огонь', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1092, 'растущая', 'огонь', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1093, 'растущая', 'огонь', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1094, 'растущая', 'огонь', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1095, 'растущая', 'огонь', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1096, 'убывающая', 'огонь', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1097, 'убывающая', 'огонь', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1098, 'убывающая', 'огонь', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1099, 'убывающая', 'огонь', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1100, 'убывающая', 'огонь', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1101, 'убывающая', 'огонь', 168, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1102, 'убывающая', 'огонь', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1103, 'убывающая', 'огонь', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1104, 'полнолуние', 'огонь', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1105, 'полнолуние', 'огонь', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1106, 'полнолуние', 'огонь', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1107, 'полнолуние', 'огонь', 168, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1108, 'полнолуние', 'огонь', 168, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1109, 'полнолуние', 'огонь', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1110, 'полнолуние', 'огонь', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1111, 'полнолуние', 'огонь', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1112, 'новолуние', 'воздух', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1113, 'новолуние', 'воздух', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1114, 'новолуние', 'воздух', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1115, 'новолуние', 'воздух', 168, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1116, 'новолуние', 'воздух', 168, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1117, 'новолуние', 'воздух', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1118, 'новолуние', 'воздух', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1119, 'новолуние', 'воздух', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1120, 'растущая', 'воздух', 168, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1121, 'растущая', 'воздух', 168, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1122, 'растущая', 'воздух', 168, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1123, 'растущая', 'воздух', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1124, 'растущая', 'воздух', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1125, 'растущая', 'воздух', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1126, 'растущая', 'воздух', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1127, 'растущая', 'воздух', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1128, 'убывающая', 'воздух', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1129, 'убывающая', 'воздух', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1130, 'убывающая', 'воздух', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1131, 'убывающая', 'воздух', 168, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1132, 'убывающая', 'воздух', 168, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03');
INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(1133, 'убывающая', 'воздух', 168, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1134, 'убывающая', 'воздух', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1135, 'убывающая', 'воздух', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1136, 'полнолуние', 'воздух', 168, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1137, 'полнолуние', 'воздух', 168, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1138, 'полнолуние', 'воздух', 168, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1139, 'полнолуние', 'воздух', 168, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1140, 'полнолуние', 'воздух', 168, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:55:55'),
(1141, 'полнолуние', 'воздух', 168, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:58:26'),
(1142, 'полнолуние', 'воздух', 168, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1143, 'полнолуние', 'воздух', 168, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1144, 'новолуние', 'вода', 169, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1145, 'новолуние', 'вода', 169, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1146, 'новолуние', 'вода', 169, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1147, 'новолуние', 'вода', 169, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1148, 'новолуние', 'вода', 169, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1149, 'новолуние', 'вода', 169, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1150, 'новолуние', 'вода', 169, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1151, 'новолуние', 'вода', 169, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1152, 'растущая', 'вода', 169, 1, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1153, 'растущая', 'вода', 169, 2, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1154, 'растущая', 'вода', 169, 3, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1155, 'растущая', 'вода', 169, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1156, 'растущая', 'вода', 169, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1157, 'растущая', 'вода', 169, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1158, 'растущая', 'вода', 169, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1159, 'растущая', 'вода', 169, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1160, 'убывающая', 'вода', 169, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1161, 'убывающая', 'вода', 169, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1162, 'убывающая', 'вода', 169, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:32:31'),
(1163, 'убывающая', 'вода', 169, 4, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1164, 'убывающая', 'вода', 169, 5, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1165, 'убывающая', 'вода', 169, 6, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1166, 'убывающая', 'вода', 169, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1167, 'убывающая', 'вода', 169, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1168, 'полнолуние', 'вода', 169, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1169, 'полнолуние', 'вода', 169, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1170, 'полнолуние', 'вода', 169, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1171, 'полнолуние', 'вода', 169, 4, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1172, 'полнолуние', 'вода', 169, 5, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:47:26'),
(1173, 'полнолуние', 'вода', 169, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:27:28'),
(1174, 'полнолуние', 'вода', 169, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1175, 'полнолуние', 'вода', 169, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1176, 'новолуние', 'земля', 169, 1, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:31'),
(1177, 'новолуние', 'земля', 169, 2, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:31'),
(1178, 'новолуние', 'земля', 169, 3, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:31'),
(1179, 'новолуние', 'земля', 169, 4, 'рекомендовано', '2018-10-11 02:38:03', '2018-10-16 04:51:52'),
(1180, 'новолуние', 'земля', 169, 5, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:31'),
(1181, 'новолуние', 'земля', 169, 6, 'не рекомендовано', '2018-10-11 02:38:03', '2018-10-16 05:41:31'),
(1182, 'новолуние', 'земля', 169, 7, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1183, 'новолуние', 'земля', 169, 8, 'нейтрально', '2018-10-11 02:38:03', '2018-10-11 02:38:03'),
(1184, 'растущая', 'земля', 169, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1185, 'растущая', 'земля', 169, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1186, 'растущая', 'земля', 169, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1187, 'растущая', 'земля', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1188, 'растущая', 'земля', 169, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1189, 'растущая', 'земля', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1190, 'растущая', 'земля', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1191, 'растущая', 'земля', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1192, 'убывающая', 'земля', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1193, 'убывающая', 'земля', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1194, 'убывающая', 'земля', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1195, 'убывающая', 'земля', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1196, 'убывающая', 'земля', 169, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1197, 'убывающая', 'земля', 169, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1198, 'убывающая', 'земля', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1199, 'убывающая', 'земля', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1200, 'полнолуние', 'земля', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1201, 'полнолуние', 'земля', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1202, 'полнолуние', 'земля', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1203, 'полнолуние', 'земля', 169, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1204, 'полнолуние', 'земля', 169, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:52'),
(1205, 'полнолуние', 'земля', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:30'),
(1206, 'полнолуние', 'земля', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1207, 'полнолуние', 'земля', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1208, 'новолуние', 'огонь', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1209, 'новолуние', 'огонь', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1210, 'новолуние', 'огонь', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1211, 'новолуние', 'огонь', 169, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1212, 'новолуние', 'огонь', 169, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1213, 'новолуние', 'огонь', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1214, 'новолуние', 'огонь', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1215, 'новолуние', 'огонь', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1216, 'растущая', 'огонь', 169, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1217, 'растущая', 'огонь', 169, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1218, 'растущая', 'огонь', 169, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1219, 'растущая', 'огонь', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1220, 'растущая', 'огонь', 169, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1221, 'растущая', 'огонь', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1222, 'растущая', 'огонь', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1223, 'растущая', 'огонь', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1224, 'убывающая', 'огонь', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1225, 'убывающая', 'огонь', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1226, 'убывающая', 'огонь', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1227, 'убывающая', 'огонь', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1228, 'убывающая', 'огонь', 169, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1229, 'убывающая', 'огонь', 169, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1230, 'убывающая', 'огонь', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1231, 'убывающая', 'огонь', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1232, 'полнолуние', 'огонь', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:26'),
(1233, 'полнолуние', 'огонь', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:26'),
(1234, 'полнолуние', 'огонь', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:26'),
(1235, 'полнолуние', 'огонь', 169, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:26'),
(1236, 'полнолуние', 'огонь', 169, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1237, 'полнолуние', 'огонь', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1238, 'полнолуние', 'огонь', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1239, 'полнолуние', 'огонь', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1240, 'новолуние', 'воздух', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1241, 'новолуние', 'воздух', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1242, 'новолуние', 'воздух', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1243, 'новолуние', 'воздух', 169, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1244, 'новолуние', 'воздух', 169, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1245, 'новолуние', 'воздух', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1246, 'новолуние', 'воздух', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1247, 'новолуние', 'воздух', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1248, 'растущая', 'воздух', 169, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1249, 'растущая', 'воздух', 169, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1250, 'растущая', 'воздух', 169, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1251, 'растущая', 'воздух', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1252, 'растущая', 'воздух', 169, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1253, 'растущая', 'воздух', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1254, 'растущая', 'воздух', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1255, 'растущая', 'воздух', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1256, 'убывающая', 'воздух', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1257, 'убывающая', 'воздух', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1258, 'убывающая', 'воздух', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1259, 'убывающая', 'воздух', 169, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1260, 'убывающая', 'воздух', 169, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1261, 'убывающая', 'воздух', 169, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1262, 'убывающая', 'воздух', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1263, 'убывающая', 'воздух', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1264, 'полнолуние', 'воздух', 169, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1265, 'полнолуние', 'воздух', 169, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1266, 'полнолуние', 'воздух', 169, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1267, 'полнолуние', 'воздух', 169, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1268, 'полнолуние', 'воздух', 169, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1269, 'полнолуние', 'воздух', 169, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1270, 'полнолуние', 'воздух', 169, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1271, 'полнолуние', 'воздух', 169, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1272, 'новолуние', 'вода', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1273, 'новолуние', 'вода', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1274, 'новолуние', 'вода', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1275, 'новолуние', 'вода', 171, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:47:26'),
(1276, 'новолуние', 'вода', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1277, 'новолуние', 'вода', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1278, 'новолуние', 'вода', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1279, 'новолуние', 'вода', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1280, 'растущая', 'вода', 171, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:47:26'),
(1281, 'растущая', 'вода', 171, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:47:26'),
(1282, 'растущая', 'вода', 171, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:47:26'),
(1283, 'растущая', 'вода', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1284, 'растущая', 'вода', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1285, 'растущая', 'вода', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1286, 'растущая', 'вода', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1287, 'растущая', 'вода', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1288, 'убывающая', 'вода', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1289, 'убывающая', 'вода', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1290, 'убывающая', 'вода', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1291, 'убывающая', 'вода', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1292, 'убывающая', 'вода', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:32:31'),
(1293, 'убывающая', 'вода', 171, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:47:26'),
(1294, 'убывающая', 'вода', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1295, 'убывающая', 'вода', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1296, 'полнолуние', 'вода', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1297, 'полнолуние', 'вода', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1298, 'полнолуние', 'вода', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1299, 'полнолуние', 'вода', 171, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1300, 'полнолуние', 'вода', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1301, 'полнолуние', 'вода', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:27:28'),
(1302, 'полнолуние', 'вода', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1303, 'полнолуние', 'вода', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1304, 'новолуние', 'земля', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1305, 'новолуние', 'земля', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1306, 'новолуние', 'земля', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1307, 'новолуние', 'земля', 171, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1308, 'новолуние', 'земля', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1309, 'новолуние', 'земля', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1310, 'новолуние', 'земля', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1311, 'новолуние', 'земля', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1312, 'растущая', 'земля', 171, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1313, 'растущая', 'земля', 171, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1314, 'растущая', 'земля', 171, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1315, 'растущая', 'земля', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1316, 'растущая', 'земля', 171, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1317, 'растущая', 'земля', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1318, 'растущая', 'земля', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1319, 'растущая', 'земля', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1320, 'убывающая', 'земля', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1321, 'убывающая', 'земля', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1322, 'убывающая', 'земля', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1323, 'убывающая', 'земля', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1324, 'убывающая', 'земля', 171, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1325, 'убывающая', 'земля', 171, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1326, 'убывающая', 'земля', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1327, 'убывающая', 'земля', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1328, 'полнолуние', 'земля', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1329, 'полнолуние', 'земля', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1330, 'полнолуние', 'земля', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1331, 'полнолуние', 'земля', 171, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1332, 'полнолуние', 'земля', 171, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:51:53'),
(1333, 'полнолуние', 'земля', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:41:31'),
(1334, 'полнолуние', 'земля', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1335, 'полнолуние', 'земля', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1336, 'новолуние', 'огонь', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1337, 'новолуние', 'огонь', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1338, 'новолуние', 'огонь', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1339, 'новолуние', 'огонь', 171, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1340, 'новолуние', 'огонь', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1341, 'новолуние', 'огонь', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1342, 'новолуние', 'огонь', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1343, 'новолуние', 'огонь', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1344, 'растущая', 'огонь', 171, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1345, 'растущая', 'огонь', 171, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1346, 'растущая', 'огонь', 171, 3, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1347, 'растущая', 'огонь', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1348, 'растущая', 'огонь', 171, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1349, 'растущая', 'огонь', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1350, 'растущая', 'огонь', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1351, 'растущая', 'огонь', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1352, 'убывающая', 'огонь', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1353, 'убывающая', 'огонь', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1354, 'убывающая', 'огонь', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1355, 'убывающая', 'огонь', 171, 4, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1356, 'убывающая', 'огонь', 171, 5, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1357, 'убывающая', 'огонь', 171, 6, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1358, 'убывающая', 'огонь', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1359, 'убывающая', 'огонь', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1360, 'полнолуние', 'огонь', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1361, 'полнолуние', 'огонь', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1362, 'полнолуние', 'огонь', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1363, 'полнолуние', 'огонь', 171, 4, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1364, 'полнолуние', 'огонь', 171, 5, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1365, 'полнолуние', 'огонь', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1366, 'полнолуние', 'огонь', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1367, 'полнолуние', 'огонь', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1368, 'новолуние', 'воздух', 171, 1, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1369, 'новолуние', 'воздух', 171, 2, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1370, 'новолуние', 'воздух', 171, 3, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1371, 'новолуние', 'воздух', 171, 4, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1372, 'новолуние', 'воздух', 171, 5, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1373, 'новолуние', 'воздух', 171, 6, 'не рекомендовано', '2018-10-11 02:38:04', '2018-10-16 05:58:27'),
(1374, 'новолуние', 'воздух', 171, 7, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1375, 'новолуние', 'воздух', 171, 8, 'нейтрально', '2018-10-11 02:38:04', '2018-10-11 02:38:04'),
(1376, 'растущая', 'воздух', 171, 1, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1377, 'растущая', 'воздух', 171, 2, 'рекомендовано', '2018-10-11 02:38:04', '2018-10-16 04:55:56'),
(1378, 'растущая', 'воздух', 171, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1379, 'растущая', 'воздух', 171, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1380, 'растущая', 'воздух', 171, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1381, 'растущая', 'воздух', 171, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1382, 'растущая', 'воздух', 171, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1383, 'растущая', 'воздух', 171, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1384, 'убывающая', 'воздух', 171, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1385, 'убывающая', 'воздух', 171, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1386, 'убывающая', 'воздух', 171, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1387, 'убывающая', 'воздух', 171, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1388, 'убывающая', 'воздух', 171, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1389, 'убывающая', 'воздух', 171, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1390, 'убывающая', 'воздух', 171, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1391, 'убывающая', 'воздух', 171, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1392, 'полнолуние', 'воздух', 171, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1393, 'полнолуние', 'воздух', 171, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1394, 'полнолуние', 'воздух', 171, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1395, 'полнолуние', 'воздух', 171, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1396, 'полнолуние', 'воздух', 171, 5, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1397, 'полнолуние', 'воздух', 171, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1398, 'полнолуние', 'воздух', 171, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1399, 'полнолуние', 'воздух', 171, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1400, 'новолуние', 'вода', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1401, 'новолуние', 'вода', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1402, 'новолуние', 'вода', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1403, 'новолуние', 'вода', 173, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:26'),
(1404, 'новолуние', 'вода', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1405, 'новолуние', 'вода', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1406, 'новолуние', 'вода', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1407, 'новолуние', 'вода', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1408, 'растущая', 'вода', 173, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:26'),
(1409, 'растущая', 'вода', 173, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:26'),
(1410, 'растущая', 'вода', 173, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:26'),
(1411, 'растущая', 'вода', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1412, 'растущая', 'вода', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1413, 'растущая', 'вода', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1414, 'растущая', 'вода', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1415, 'растущая', 'вода', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1416, 'убывающая', 'вода', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1417, 'убывающая', 'вода', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1418, 'убывающая', 'вода', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1419, 'убывающая', 'вода', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1420, 'убывающая', 'вода', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:31'),
(1421, 'убывающая', 'вода', 173, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:26'),
(1422, 'убывающая', 'вода', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1423, 'убывающая', 'вода', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1424, 'полнолуние', 'вода', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1425, 'полнолуние', 'вода', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1426, 'полнолуние', 'вода', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1427, 'полнолуние', 'вода', 173, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1428, 'полнолуние', 'вода', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1429, 'полнолуние', 'вода', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:28'),
(1430, 'полнолуние', 'вода', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1431, 'полнолуние', 'вода', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1432, 'новолуние', 'земля', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1433, 'новолуние', 'земля', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1434, 'новолуние', 'земля', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1435, 'новолуние', 'земля', 173, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1436, 'новолуние', 'земля', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1437, 'новолуние', 'земля', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1438, 'новолуние', 'земля', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1439, 'новолуние', 'земля', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1440, 'растущая', 'земля', 173, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1441, 'растущая', 'земля', 173, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1442, 'растущая', 'земля', 173, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1443, 'растущая', 'земля', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1444, 'растущая', 'земля', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1445, 'растущая', 'земля', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1446, 'растущая', 'земля', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1447, 'растущая', 'земля', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1448, 'убывающая', 'земля', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1449, 'убывающая', 'земля', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1450, 'убывающая', 'земля', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1451, 'убывающая', 'земля', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1452, 'убывающая', 'земля', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1453, 'убывающая', 'земля', 173, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1454, 'убывающая', 'земля', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1455, 'убывающая', 'земля', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1456, 'полнолуние', 'земля', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1457, 'полнолуние', 'земля', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1458, 'полнолуние', 'земля', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1459, 'полнолуние', 'земля', 173, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1460, 'полнолуние', 'земля', 173, 5, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1461, 'полнолуние', 'земля', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:41:31'),
(1462, 'полнолуние', 'земля', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1463, 'полнолуние', 'земля', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1464, 'новолуние', 'огонь', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1465, 'новолуние', 'огонь', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1466, 'новолуние', 'огонь', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1467, 'новолуние', 'огонь', 173, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1468, 'новолуние', 'огонь', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1469, 'новолуние', 'огонь', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1470, 'новолуние', 'огонь', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1471, 'новолуние', 'огонь', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1472, 'растущая', 'огонь', 173, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1473, 'растущая', 'огонь', 173, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1474, 'растущая', 'огонь', 173, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1475, 'растущая', 'огонь', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1476, 'растущая', 'огонь', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1477, 'растущая', 'огонь', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1478, 'растущая', 'огонь', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1479, 'растущая', 'огонь', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1480, 'убывающая', 'огонь', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1481, 'убывающая', 'огонь', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1482, 'убывающая', 'огонь', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1483, 'убывающая', 'огонь', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1484, 'убывающая', 'огонь', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1485, 'убывающая', 'огонь', 173, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1486, 'убывающая', 'огонь', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1487, 'убывающая', 'огонь', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1488, 'полнолуние', 'огонь', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1489, 'полнолуние', 'огонь', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1490, 'полнолуние', 'огонь', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1491, 'полнолуние', 'огонь', 173, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1492, 'полнолуние', 'огонь', 173, 5, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1493, 'полнолуние', 'огонь', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1494, 'полнолуние', 'огонь', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1495, 'полнолуние', 'огонь', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1496, 'новолуние', 'воздух', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1497, 'новолуние', 'воздух', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1498, 'новолуние', 'воздух', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1499, 'новолуние', 'воздух', 173, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1500, 'новолуние', 'воздух', 173, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1501, 'новолуние', 'воздух', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1502, 'новолуние', 'воздух', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1503, 'новолуние', 'воздух', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1504, 'растущая', 'воздух', 173, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1505, 'растущая', 'воздух', 173, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1506, 'растущая', 'воздух', 173, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1507, 'растущая', 'воздух', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1508, 'растущая', 'воздух', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1509, 'растущая', 'воздух', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1510, 'растущая', 'воздух', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1511, 'растущая', 'воздух', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1512, 'убывающая', 'воздух', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1513, 'убывающая', 'воздух', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1514, 'убывающая', 'воздух', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1515, 'убывающая', 'воздух', 173, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1516, 'убывающая', 'воздух', 173, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1517, 'убывающая', 'воздух', 173, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1518, 'убывающая', 'воздух', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1519, 'убывающая', 'воздух', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1520, 'полнолуние', 'воздух', 173, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1521, 'полнолуние', 'воздух', 173, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1522, 'полнолуние', 'воздух', 173, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1523, 'полнолуние', 'воздух', 173, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1524, 'полнолуние', 'воздух', 173, 5, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:55:56'),
(1525, 'полнолуние', 'воздух', 173, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:27'),
(1526, 'полнолуние', 'воздух', 173, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1527, 'полнолуние', 'воздух', 173, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1528, 'новолуние', 'вода', 174, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1529, 'новолуние', 'вода', 174, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1530, 'новолуние', 'вода', 174, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1531, 'новолуние', 'вода', 174, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1532, 'новолуние', 'вода', 174, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1533, 'новолуние', 'вода', 174, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1534, 'новолуние', 'вода', 174, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1535, 'новолуние', 'вода', 174, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1536, 'растущая', 'вода', 174, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1537, 'растущая', 'вода', 174, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1538, 'растущая', 'вода', 174, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1539, 'растущая', 'вода', 174, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1540, 'растущая', 'вода', 174, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1541, 'растущая', 'вода', 174, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1542, 'растущая', 'вода', 174, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1543, 'растущая', 'вода', 174, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1544, 'убывающая', 'вода', 174, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1545, 'убывающая', 'вода', 174, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1546, 'убывающая', 'вода', 174, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:32:32'),
(1547, 'убывающая', 'вода', 174, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1548, 'убывающая', 'вода', 174, 5, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1549, 'убывающая', 'вода', 174, 6, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1550, 'убывающая', 'вода', 174, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1551, 'убывающая', 'вода', 174, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1552, 'полнолуние', 'вода', 174, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:29'),
(1553, 'полнолуние', 'вода', 174, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:29'),
(1554, 'полнолуние', 'вода', 174, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:29'),
(1555, 'полнолуние', 'вода', 174, 4, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:29'),
(1556, 'полнолуние', 'вода', 174, 5, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:47:27'),
(1557, 'полнолуние', 'вода', 174, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:27:29'),
(1558, 'полнолуние', 'вода', 174, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1559, 'полнолуние', 'вода', 174, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1560, 'новолуние', 'земля', 174, 1, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1561, 'новолуние', 'земля', 174, 2, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1562, 'новолуние', 'земля', 174, 3, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1563, 'новолуние', 'земля', 174, 4, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1564, 'новолуние', 'земля', 174, 5, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1565, 'новолуние', 'земля', 174, 6, 'не рекомендовано', '2018-10-11 02:38:05', '2018-10-16 05:58:28'),
(1566, 'новолуние', 'земля', 174, 7, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1567, 'новолуние', 'земля', 174, 8, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1568, 'растущая', 'земля', 174, 1, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1569, 'растущая', 'земля', 174, 2, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1570, 'растущая', 'земля', 174, 3, 'рекомендовано', '2018-10-11 02:38:05', '2018-10-16 04:51:53'),
(1571, 'растущая', 'земля', 174, 4, 'нейтрально', '2018-10-11 02:38:05', '2018-10-11 02:38:05'),
(1572, 'растущая', 'земля', 174, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1573, 'растущая', 'земля', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1574, 'растущая', 'земля', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1575, 'растущая', 'земля', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1576, 'убывающая', 'земля', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1577, 'убывающая', 'земля', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1578, 'убывающая', 'земля', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1579, 'убывающая', 'земля', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1580, 'убывающая', 'земля', 174, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1581, 'убывающая', 'земля', 174, 6, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1582, 'убывающая', 'земля', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1583, 'убывающая', 'земля', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1584, 'полнолуние', 'земля', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:31'),
(1585, 'полнолуние', 'земля', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:31'),
(1586, 'полнолуние', 'земля', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:31'),
(1587, 'полнолуние', 'земля', 174, 4, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1588, 'полнолуние', 'земля', 174, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1589, 'полнолуние', 'земля', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1590, 'полнолуние', 'земля', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1591, 'полнолуние', 'земля', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1592, 'новолуние', 'огонь', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1593, 'новолуние', 'огонь', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1594, 'новолуние', 'огонь', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1595, 'новолуние', 'огонь', 174, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1596, 'новолуние', 'огонь', 174, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1597, 'новолуние', 'огонь', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1598, 'новолуние', 'огонь', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1599, 'новолуние', 'огонь', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1600, 'растущая', 'огонь', 174, 1, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1601, 'растущая', 'огонь', 174, 2, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1602, 'растущая', 'огонь', 174, 3, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1603, 'растущая', 'огонь', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1604, 'растущая', 'огонь', 174, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1605, 'растущая', 'огонь', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1606, 'растущая', 'огонь', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1607, 'растущая', 'огонь', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1608, 'убывающая', 'огонь', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1609, 'убывающая', 'огонь', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1610, 'убывающая', 'огонь', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1611, 'убывающая', 'огонь', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1612, 'убывающая', 'огонь', 174, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1613, 'убывающая', 'огонь', 174, 6, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1614, 'убывающая', 'огонь', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1615, 'убывающая', 'огонь', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1616, 'полнолуние', 'огонь', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1617, 'полнолуние', 'огонь', 174, 2, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1618, 'полнолуние', 'огонь', 174, 3, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1619, 'полнолуние', 'огонь', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1620, 'полнолуние', 'огонь', 174, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1621, 'полнолуние', 'огонь', 174, 6, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1622, 'полнолуние', 'огонь', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1623, 'полнолуние', 'огонь', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1624, 'новолуние', 'воздух', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1625, 'новолуние', 'воздух', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1626, 'новолуние', 'воздух', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1627, 'новолуние', 'воздух', 174, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1628, 'новолуние', 'воздух', 174, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1629, 'новолуние', 'воздух', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1630, 'новолуние', 'воздух', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1631, 'новолуние', 'воздух', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1632, 'растущая', 'воздух', 174, 1, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1633, 'растущая', 'воздух', 174, 2, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1634, 'растущая', 'воздух', 174, 3, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57');
INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(1635, 'растущая', 'воздух', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1636, 'растущая', 'воздух', 174, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1637, 'растущая', 'воздух', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1638, 'растущая', 'воздух', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1639, 'растущая', 'воздух', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1640, 'убывающая', 'воздух', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1641, 'убывающая', 'воздух', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1642, 'убывающая', 'воздух', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1643, 'убывающая', 'воздух', 174, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1644, 'убывающая', 'воздух', 174, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1645, 'убывающая', 'воздух', 174, 6, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1646, 'убывающая', 'воздух', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1647, 'убывающая', 'воздух', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1648, 'полнолуние', 'воздух', 174, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1649, 'полнолуние', 'воздух', 174, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1650, 'полнолуние', 'воздух', 174, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1651, 'полнолуние', 'воздух', 174, 4, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1652, 'полнолуние', 'воздух', 174, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1653, 'полнолуние', 'воздух', 174, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1654, 'полнолуние', 'воздух', 174, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1655, 'полнолуние', 'воздух', 174, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1656, 'новолуние', 'вода', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1657, 'новолуние', 'вода', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1658, 'новолуние', 'вода', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1659, 'новолуние', 'вода', 175, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1660, 'новолуние', 'вода', 175, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1661, 'новолуние', 'вода', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1662, 'новолуние', 'вода', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1663, 'новолуние', 'вода', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1664, 'растущая', 'вода', 175, 1, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1665, 'растущая', 'вода', 175, 2, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1666, 'растущая', 'вода', 175, 3, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1667, 'растущая', 'вода', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1668, 'растущая', 'вода', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1669, 'растущая', 'вода', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1670, 'растущая', 'вода', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1671, 'растущая', 'вода', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1672, 'убывающая', 'вода', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1673, 'убывающая', 'вода', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1674, 'убывающая', 'вода', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:32:32'),
(1675, 'убывающая', 'вода', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1676, 'убывающая', 'вода', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1677, 'убывающая', 'вода', 175, 6, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1678, 'убывающая', 'вода', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1679, 'убывающая', 'вода', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1680, 'полнолуние', 'вода', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:27:29'),
(1681, 'полнолуние', 'вода', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:27:29'),
(1682, 'полнолуние', 'вода', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:27:29'),
(1683, 'полнолуние', 'вода', 175, 4, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:27:29'),
(1684, 'полнолуние', 'вода', 175, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:47:27'),
(1685, 'полнолуние', 'вода', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:27:29'),
(1686, 'полнолуние', 'вода', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1687, 'полнолуние', 'вода', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1688, 'новолуние', 'земля', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1689, 'новолуние', 'земля', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1690, 'новолуние', 'земля', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1691, 'новолуние', 'земля', 175, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:54'),
(1692, 'новолуние', 'земля', 175, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1693, 'новолуние', 'земля', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1694, 'новолуние', 'земля', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1695, 'новолуние', 'земля', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1696, 'растущая', 'земля', 175, 1, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1697, 'растущая', 'земля', 175, 2, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1698, 'растущая', 'земля', 175, 3, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1699, 'растущая', 'земля', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1700, 'растущая', 'земля', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1701, 'растущая', 'земля', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1702, 'растущая', 'земля', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1703, 'растущая', 'земля', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1704, 'убывающая', 'земля', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1705, 'убывающая', 'земля', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1706, 'убывающая', 'земля', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1707, 'убывающая', 'земля', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1708, 'убывающая', 'земля', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1709, 'убывающая', 'земля', 175, 6, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:54'),
(1710, 'убывающая', 'земля', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1711, 'убывающая', 'земля', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1712, 'полнолуние', 'земля', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1713, 'полнолуние', 'земля', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1714, 'полнолуние', 'земля', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1715, 'полнолуние', 'земля', 175, 4, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1716, 'полнолуние', 'земля', 175, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:51:53'),
(1717, 'полнолуние', 'земля', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:41:32'),
(1718, 'полнолуние', 'земля', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1719, 'полнолуние', 'земля', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1720, 'новолуние', 'огонь', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1721, 'новолуние', 'огонь', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1722, 'новолуние', 'огонь', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1723, 'новолуние', 'огонь', 175, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1724, 'новолуние', 'огонь', 175, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1725, 'новолуние', 'огонь', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1726, 'новолуние', 'огонь', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1727, 'новолуние', 'огонь', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1728, 'растущая', 'огонь', 175, 1, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1729, 'растущая', 'огонь', 175, 2, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1730, 'растущая', 'огонь', 175, 3, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1731, 'растущая', 'огонь', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1732, 'растущая', 'огонь', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1733, 'растущая', 'огонь', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1734, 'растущая', 'огонь', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1735, 'растущая', 'огонь', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1736, 'убывающая', 'огонь', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1737, 'убывающая', 'огонь', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1738, 'убывающая', 'огонь', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1739, 'убывающая', 'огонь', 175, 4, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1740, 'убывающая', 'огонь', 175, 5, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1741, 'убывающая', 'огонь', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1742, 'убывающая', 'огонь', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1743, 'убывающая', 'огонь', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1744, 'полнолуние', 'огонь', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1745, 'полнолуние', 'огонь', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1746, 'полнолуние', 'огонь', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1747, 'полнолуние', 'огонь', 175, 4, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1748, 'полнолуние', 'огонь', 175, 5, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1749, 'полнолуние', 'огонь', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1750, 'полнолуние', 'огонь', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1751, 'полнолуние', 'огонь', 175, 8, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1752, 'новолуние', 'воздух', 175, 1, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1753, 'новолуние', 'воздух', 175, 2, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1754, 'новолуние', 'воздух', 175, 3, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1755, 'новолуние', 'воздух', 175, 4, 'рекомендовано', '2018-10-11 02:38:06', '2018-10-16 04:55:57'),
(1756, 'новолуние', 'воздух', 175, 5, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1757, 'новолуние', 'воздух', 175, 6, 'не рекомендовано', '2018-10-11 02:38:06', '2018-10-16 05:58:28'),
(1758, 'новолуние', 'воздух', 175, 7, 'нейтрально', '2018-10-11 02:38:06', '2018-10-11 02:38:06'),
(1759, 'новолуние', 'воздух', 175, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1760, 'растущая', 'воздух', 175, 1, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1761, 'растущая', 'воздух', 175, 2, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1762, 'растущая', 'воздух', 175, 3, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1763, 'растущая', 'воздух', 175, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1764, 'растущая', 'воздух', 175, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1765, 'растущая', 'воздух', 175, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1766, 'растущая', 'воздух', 175, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1767, 'растущая', 'воздух', 175, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1768, 'убывающая', 'воздух', 175, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1769, 'убывающая', 'воздух', 175, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1770, 'убывающая', 'воздух', 175, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1771, 'убывающая', 'воздух', 175, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1772, 'убывающая', 'воздух', 175, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1773, 'убывающая', 'воздух', 175, 6, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1774, 'убывающая', 'воздух', 175, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1775, 'убывающая', 'воздух', 175, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1776, 'полнолуние', 'воздух', 175, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1777, 'полнолуние', 'воздух', 175, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1778, 'полнолуние', 'воздух', 175, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1779, 'полнолуние', 'воздух', 175, 4, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1780, 'полнолуние', 'воздух', 175, 5, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1781, 'полнолуние', 'воздух', 175, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1782, 'полнолуние', 'воздух', 175, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1783, 'полнолуние', 'воздух', 175, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1784, 'новолуние', 'вода', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1785, 'новолуние', 'вода', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1786, 'новолуние', 'вода', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1787, 'новолуние', 'вода', 184, 4, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:28'),
(1788, 'новолуние', 'вода', 184, 5, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1789, 'новолуние', 'вода', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1790, 'новолуние', 'вода', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1791, 'новолуние', 'вода', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1792, 'растущая', 'вода', 184, 1, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:27'),
(1793, 'растущая', 'вода', 184, 2, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:27'),
(1794, 'растущая', 'вода', 184, 3, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:27'),
(1795, 'растущая', 'вода', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1796, 'растущая', 'вода', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1797, 'растущая', 'вода', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1798, 'растущая', 'вода', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1799, 'растущая', 'вода', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1800, 'убывающая', 'вода', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1801, 'убывающая', 'вода', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1802, 'убывающая', 'вода', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:32:33'),
(1803, 'убывающая', 'вода', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1804, 'убывающая', 'вода', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1805, 'убывающая', 'вода', 184, 6, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:27'),
(1806, 'убывающая', 'вода', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1807, 'убывающая', 'вода', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1808, 'полнолуние', 'вода', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:27:29'),
(1809, 'полнолуние', 'вода', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:27:29'),
(1810, 'полнолуние', 'вода', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:27:29'),
(1811, 'полнолуние', 'вода', 184, 4, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:27:29'),
(1812, 'полнолуние', 'вода', 184, 5, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:47:27'),
(1813, 'полнолуние', 'вода', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:27:29'),
(1814, 'полнолуние', 'вода', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1815, 'полнолуние', 'вода', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1816, 'новолуние', 'земля', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1817, 'новолуние', 'земля', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1818, 'новолуние', 'земля', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1819, 'новолуние', 'земля', 184, 4, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1820, 'новолуние', 'земля', 184, 5, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1821, 'новолуние', 'земля', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:28'),
(1822, 'новолуние', 'земля', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1823, 'новолуние', 'земля', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1824, 'растущая', 'земля', 184, 1, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1825, 'растущая', 'земля', 184, 2, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1826, 'растущая', 'земля', 184, 3, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1827, 'растущая', 'земля', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1828, 'растущая', 'земля', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1829, 'растущая', 'земля', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1830, 'растущая', 'земля', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1831, 'растущая', 'земля', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1832, 'убывающая', 'земля', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1833, 'убывающая', 'земля', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1834, 'убывающая', 'земля', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1835, 'убывающая', 'земля', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1836, 'убывающая', 'земля', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1837, 'убывающая', 'земля', 184, 6, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1838, 'убывающая', 'земля', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1839, 'убывающая', 'земля', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1840, 'полнолуние', 'земля', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1841, 'полнолуние', 'земля', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1842, 'полнолуние', 'земля', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1843, 'полнолуние', 'земля', 184, 4, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1844, 'полнолуние', 'земля', 184, 5, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:51:54'),
(1845, 'полнолуние', 'земля', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:41:32'),
(1846, 'полнолуние', 'земля', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1847, 'полнолуние', 'земля', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1848, 'новолуние', 'огонь', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1849, 'новолуние', 'огонь', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1850, 'новолуние', 'огонь', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1851, 'новолуние', 'огонь', 184, 4, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1852, 'новолуние', 'огонь', 184, 5, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1853, 'новолуние', 'огонь', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1854, 'новолуние', 'огонь', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1855, 'новолуние', 'огонь', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1856, 'растущая', 'огонь', 184, 1, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1857, 'растущая', 'огонь', 184, 2, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1858, 'растущая', 'огонь', 184, 3, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1859, 'растущая', 'огонь', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1860, 'растущая', 'огонь', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1861, 'растущая', 'огонь', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1862, 'растущая', 'огонь', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1863, 'растущая', 'огонь', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1864, 'убывающая', 'огонь', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1865, 'убывающая', 'огонь', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1866, 'убывающая', 'огонь', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1867, 'убывающая', 'огонь', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1868, 'убывающая', 'огонь', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1869, 'убывающая', 'огонь', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1870, 'убывающая', 'огонь', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1871, 'убывающая', 'огонь', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1872, 'полнолуние', 'огонь', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1873, 'полнолуние', 'огонь', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1874, 'полнолуние', 'огонь', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1875, 'полнолуние', 'огонь', 184, 4, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1876, 'полнолуние', 'огонь', 184, 5, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1877, 'полнолуние', 'огонь', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1878, 'полнолуние', 'огонь', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1879, 'полнолуние', 'огонь', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1880, 'новолуние', 'воздух', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1881, 'новолуние', 'воздух', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1882, 'новолуние', 'воздух', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1883, 'новолуние', 'воздух', 184, 4, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:58'),
(1884, 'новолуние', 'воздух', 184, 5, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1885, 'новолуние', 'воздух', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1886, 'новолуние', 'воздух', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1887, 'новолуние', 'воздух', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1888, 'растущая', 'воздух', 184, 1, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1889, 'растущая', 'воздух', 184, 2, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1890, 'растущая', 'воздух', 184, 3, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1891, 'растущая', 'воздух', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1892, 'растущая', 'воздух', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1893, 'растущая', 'воздух', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1894, 'растущая', 'воздух', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1895, 'растущая', 'воздух', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1896, 'убывающая', 'воздух', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1897, 'убывающая', 'воздух', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1898, 'убывающая', 'воздух', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1899, 'убывающая', 'воздух', 184, 4, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1900, 'убывающая', 'воздух', 184, 5, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1901, 'убывающая', 'воздух', 184, 6, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1902, 'убывающая', 'воздух', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 04:41:05'),
(1903, 'убывающая', 'воздух', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1904, 'полнолуние', 'воздух', 184, 1, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1905, 'полнолуние', 'воздух', 184, 2, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1906, 'полнолуние', 'воздух', 184, 3, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1907, 'полнолуние', 'воздух', 184, 4, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1908, 'полнолуние', 'воздух', 184, 5, 'рекомендовано', '2018-10-11 02:38:07', '2018-10-16 04:55:57'),
(1909, 'полнолуние', 'воздух', 184, 6, 'не рекомендовано', '2018-10-11 02:38:07', '2018-10-16 05:58:29'),
(1910, 'полнолуние', 'воздух', 184, 7, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 02:38:07'),
(1911, 'полнолуние', 'воздух', 184, 8, 'нейтрально', '2018-10-11 02:38:07', '2018-10-11 04:41:05'),
(1912, 'полнолуние', 'вода', 191, 1, 'не рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:23:15'),
(1913, 'полнолуние', 'вода', 191, 2, 'не рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:23:15'),
(1914, 'полнолуние', 'вода', 191, 3, 'не рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:23:15'),
(1915, 'полнолуние', 'вода', 191, 4, 'не рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:23:15'),
(1916, 'полнолуние', 'вода', 191, 5, 'рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:04:19'),
(1917, 'полнолуние', 'вода', 191, 6, 'не рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:23:15'),
(1918, 'полнолуние', 'вода', 191, 7, 'нейтрально', '2018-10-16 06:09:48', '2018-10-16 06:09:48'),
(1919, 'полнолуние', 'вода', 191, 8, 'нейтрально', '2018-10-16 06:09:48', '2018-10-16 06:09:48'),
(1920, 'растущая', 'вода', 191, 1, 'рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:04:19'),
(1921, 'растущая', 'вода', 191, 2, 'рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:04:19'),
(1922, 'растущая', 'вода', 191, 3, 'рекомендовано', '2018-10-16 06:09:48', '2018-10-16 08:04:19'),
(1923, 'растущая', 'вода', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1924, 'растущая', 'вода', 191, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1925, 'растущая', 'вода', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1926, 'растущая', 'вода', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1927, 'растущая', 'вода', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1928, 'убывающая', 'вода', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1929, 'убывающая', 'вода', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1930, 'убывающая', 'вода', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1931, 'убывающая', 'вода', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1932, 'убывающая', 'вода', 191, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1933, 'убывающая', 'вода', 191, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1934, 'убывающая', 'вода', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1935, 'убывающая', 'вода', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1936, 'новолуние', 'вода', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1937, 'новолуние', 'вода', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1938, 'новолуние', 'вода', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1939, 'новолуние', 'вода', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1940, 'новолуние', 'вода', 191, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1941, 'новолуние', 'вода', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(1942, 'новолуние', 'вода', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1943, 'новолуние', 'вода', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1944, 'полнолуние', 'земля', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1945, 'полнолуние', 'земля', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1946, 'полнолуние', 'земля', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1947, 'полнолуние', 'земля', 191, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1948, 'полнолуние', 'земля', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1949, 'полнолуние', 'земля', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1950, 'полнолуние', 'земля', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1951, 'полнолуние', 'земля', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1952, 'растущая', 'земля', 191, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1953, 'растущая', 'земля', 191, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1954, 'растущая', 'земля', 191, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1955, 'растущая', 'земля', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1956, 'растущая', 'земля', 191, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1957, 'растущая', 'земля', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1958, 'растущая', 'земля', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1959, 'растущая', 'земля', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1960, 'убывающая', 'земля', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1961, 'убывающая', 'земля', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1962, 'убывающая', 'земля', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1963, 'убывающая', 'земля', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1964, 'убывающая', 'земля', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1965, 'убывающая', 'земля', 191, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1966, 'убывающая', 'земля', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1967, 'убывающая', 'земля', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1968, 'новолуние', 'земля', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1969, 'новолуние', 'земля', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1970, 'новолуние', 'земля', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1971, 'новолуние', 'земля', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1972, 'новолуние', 'земля', 191, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1973, 'новолуние', 'земля', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(1974, 'новолуние', 'земля', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1975, 'новолуние', 'земля', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1976, 'полнолуние', 'огонь', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1977, 'полнолуние', 'огонь', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1978, 'полнолуние', 'огонь', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1979, 'полнолуние', 'огонь', 191, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1980, 'полнолуние', 'огонь', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1981, 'полнолуние', 'огонь', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1982, 'полнолуние', 'огонь', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1983, 'полнолуние', 'огонь', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1984, 'растущая', 'огонь', 191, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1985, 'растущая', 'огонь', 191, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1986, 'растущая', 'огонь', 191, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1987, 'растущая', 'огонь', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1988, 'растущая', 'огонь', 191, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1989, 'растущая', 'огонь', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1990, 'растущая', 'огонь', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1991, 'растущая', 'огонь', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1992, 'убывающая', 'огонь', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1993, 'убывающая', 'огонь', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1994, 'убывающая', 'огонь', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(1995, 'убывающая', 'огонь', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1996, 'убывающая', 'огонь', 191, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1997, 'убывающая', 'огонь', 191, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(1998, 'убывающая', 'огонь', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(1999, 'убывающая', 'огонь', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2000, 'новолуние', 'огонь', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2001, 'новолуние', 'огонь', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2002, 'новолуние', 'огонь', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2003, 'новолуние', 'огонь', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2004, 'новолуние', 'огонь', 191, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2005, 'новолуние', 'огонь', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2006, 'новолуние', 'огонь', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2007, 'новолуние', 'огонь', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2008, 'полнолуние', 'воздух', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2009, 'полнолуние', 'воздух', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2010, 'полнолуние', 'воздух', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2011, 'полнолуние', 'воздух', 191, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2012, 'полнолуние', 'воздух', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2013, 'полнолуние', 'воздух', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2014, 'полнолуние', 'воздух', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2015, 'полнолуние', 'воздух', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2016, 'растущая', 'воздух', 191, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2017, 'растущая', 'воздух', 191, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2018, 'растущая', 'воздух', 191, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2019, 'растущая', 'воздух', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2020, 'растущая', 'воздух', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2021, 'растущая', 'воздух', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2022, 'растущая', 'воздух', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2023, 'растущая', 'воздух', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2024, 'убывающая', 'воздух', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2025, 'убывающая', 'воздух', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2026, 'убывающая', 'воздух', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2027, 'убывающая', 'воздух', 191, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2028, 'убывающая', 'воздух', 191, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2029, 'убывающая', 'воздух', 191, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2030, 'убывающая', 'воздух', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2031, 'убывающая', 'воздух', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2032, 'новолуние', 'воздух', 191, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2033, 'новолуние', 'воздух', 191, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2034, 'новолуние', 'воздух', 191, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2035, 'новолуние', 'воздух', 191, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:08:07'),
(2036, 'новолуние', 'воздух', 191, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2037, 'новолуние', 'воздух', 191, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2038, 'новолуние', 'воздух', 191, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2039, 'новолуние', 'воздух', 191, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2040, 'полнолуние', 'вода', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2041, 'полнолуние', 'вода', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2042, 'полнолуние', 'вода', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2043, 'полнолуние', 'вода', 192, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2044, 'полнолуние', 'вода', 192, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2045, 'полнолуние', 'вода', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2046, 'полнолуние', 'вода', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2047, 'полнолуние', 'вода', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2048, 'растущая', 'вода', 192, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2049, 'растущая', 'вода', 192, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2050, 'растущая', 'вода', 192, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2051, 'растущая', 'вода', 192, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2052, 'растущая', 'вода', 192, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2053, 'растущая', 'вода', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2054, 'растущая', 'вода', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2055, 'растущая', 'вода', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2056, 'убывающая', 'вода', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2057, 'убывающая', 'вода', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2058, 'убывающая', 'вода', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2059, 'убывающая', 'вода', 192, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2060, 'убывающая', 'вода', 192, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2061, 'убывающая', 'вода', 192, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2062, 'убывающая', 'вода', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2063, 'убывающая', 'вода', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2064, 'новолуние', 'вода', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2065, 'новолуние', 'вода', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2066, 'новолуние', 'вода', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2067, 'новолуние', 'вода', 192, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2068, 'новолуние', 'вода', 192, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2069, 'новолуние', 'вода', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:23:15'),
(2070, 'новолуние', 'вода', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2071, 'новолуние', 'вода', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2072, 'полнолуние', 'земля', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2073, 'полнолуние', 'земля', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2074, 'полнолуние', 'земля', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2075, 'полнолуние', 'земля', 192, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2076, 'полнолуние', 'земля', 192, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2077, 'полнолуние', 'земля', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2078, 'полнолуние', 'земля', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2079, 'полнолуние', 'земля', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2080, 'растущая', 'земля', 192, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2081, 'растущая', 'земля', 192, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2082, 'растущая', 'земля', 192, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2083, 'растущая', 'земля', 192, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2084, 'растущая', 'земля', 192, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2085, 'растущая', 'земля', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2086, 'растущая', 'земля', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2087, 'растущая', 'земля', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2088, 'убывающая', 'земля', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2089, 'убывающая', 'земля', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2090, 'убывающая', 'земля', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2091, 'убывающая', 'земля', 192, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2092, 'убывающая', 'земля', 192, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2093, 'убывающая', 'земля', 192, 6, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2094, 'убывающая', 'земля', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2095, 'убывающая', 'земля', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2096, 'новолуние', 'земля', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2097, 'новолуние', 'земля', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2098, 'новолуние', 'земля', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2099, 'новолуние', 'земля', 192, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2100, 'новолуние', 'земля', 192, 5, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2101, 'новолуние', 'земля', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:27:32'),
(2102, 'новолуние', 'земля', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2103, 'новолуние', 'земля', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2104, 'полнолуние', 'огонь', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2105, 'полнолуние', 'огонь', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:35:59'),
(2106, 'полнолуние', 'огонь', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2107, 'полнолуние', 'огонь', 192, 4, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2108, 'полнолуние', 'огонь', 192, 5, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2109, 'полнолуние', 'огонь', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2110, 'полнолуние', 'огонь', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2111, 'полнолуние', 'огонь', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2112, 'растущая', 'огонь', 192, 1, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2113, 'растущая', 'огонь', 192, 2, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2114, 'растущая', 'огонь', 192, 3, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2115, 'растущая', 'огонь', 192, 4, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2116, 'растущая', 'огонь', 192, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2117, 'растущая', 'огонь', 192, 6, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2118, 'растущая', 'огонь', 192, 7, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2119, 'растущая', 'огонь', 192, 8, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2120, 'убывающая', 'огонь', 192, 1, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2121, 'убывающая', 'огонь', 192, 2, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2122, 'убывающая', 'огонь', 192, 3, 'не рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:36:00'),
(2123, 'убывающая', 'огонь', 192, 4, 'рекомендовано', '2018-10-16 06:09:49', '2018-10-16 08:04:19'),
(2124, 'убывающая', 'огонь', 192, 5, 'нейтрально', '2018-10-16 06:09:49', '2018-10-16 06:09:49'),
(2125, 'убывающая', 'огонь', 192, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:19'),
(2126, 'убывающая', 'огонь', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2127, 'убывающая', 'огонь', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2128, 'новолуние', 'огонь', 192, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2129, 'новолуние', 'огонь', 192, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2130, 'новолуние', 'огонь', 192, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2131, 'новолуние', 'огонь', 192, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2132, 'новолуние', 'огонь', 192, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2133, 'новолуние', 'огонь', 192, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2134, 'новолуние', 'огонь', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2135, 'новолуние', 'огонь', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2136, 'полнолуние', 'воздух', 192, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00');
INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(2137, 'полнолуние', 'воздух', 192, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2138, 'полнолуние', 'воздух', 192, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2139, 'полнолуние', 'воздух', 192, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2140, 'полнолуние', 'воздух', 192, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:07'),
(2141, 'полнолуние', 'воздух', 192, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2142, 'полнолуние', 'воздух', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2143, 'полнолуние', 'воздух', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2144, 'растущая', 'воздух', 192, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:07'),
(2145, 'растущая', 'воздух', 192, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:07'),
(2146, 'растущая', 'воздух', 192, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:07'),
(2147, 'растущая', 'воздух', 192, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2148, 'растущая', 'воздух', 192, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2149, 'растущая', 'воздух', 192, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2150, 'растущая', 'воздух', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2151, 'растущая', 'воздух', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2152, 'убывающая', 'воздух', 192, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2153, 'убывающая', 'воздух', 192, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2154, 'убывающая', 'воздух', 192, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2155, 'убывающая', 'воздух', 192, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2156, 'убывающая', 'воздух', 192, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2157, 'убывающая', 'воздух', 192, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2158, 'убывающая', 'воздух', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2159, 'убывающая', 'воздух', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2160, 'новолуние', 'воздух', 192, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2161, 'новолуние', 'воздух', 192, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2162, 'новолуние', 'воздух', 192, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2163, 'новолуние', 'воздух', 192, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2164, 'новолуние', 'воздух', 192, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2165, 'новолуние', 'воздух', 192, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2166, 'новолуние', 'воздух', 192, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2167, 'новолуние', 'воздух', 192, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2168, 'полнолуние', 'вода', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2169, 'полнолуние', 'вода', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2170, 'полнолуние', 'вода', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2171, 'полнолуние', 'вода', 193, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2172, 'полнолуние', 'вода', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2173, 'полнолуние', 'вода', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2174, 'полнолуние', 'вода', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2175, 'полнолуние', 'вода', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2176, 'растущая', 'вода', 193, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2177, 'растущая', 'вода', 193, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2178, 'растущая', 'вода', 193, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2179, 'растущая', 'вода', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2180, 'растущая', 'вода', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2181, 'растущая', 'вода', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2182, 'растущая', 'вода', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2183, 'растущая', 'вода', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2184, 'убывающая', 'вода', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2185, 'убывающая', 'вода', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2186, 'убывающая', 'вода', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2187, 'убывающая', 'вода', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2188, 'убывающая', 'вода', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2189, 'убывающая', 'вода', 193, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2190, 'убывающая', 'вода', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2191, 'убывающая', 'вода', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2192, 'новолуние', 'вода', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2193, 'новолуние', 'вода', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2194, 'новолуние', 'вода', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2195, 'новолуние', 'вода', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2196, 'новолуние', 'вода', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2197, 'новолуние', 'вода', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2198, 'новолуние', 'вода', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2199, 'новолуние', 'вода', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2200, 'полнолуние', 'земля', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2201, 'полнолуние', 'земля', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2202, 'полнолуние', 'земля', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2203, 'полнолуние', 'земля', 193, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2204, 'полнолуние', 'земля', 193, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2205, 'полнолуние', 'земля', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2206, 'полнолуние', 'земля', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2207, 'полнолуние', 'земля', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2208, 'растущая', 'земля', 193, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2209, 'растущая', 'земля', 193, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2210, 'растущая', 'земля', 193, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2211, 'растущая', 'земля', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2212, 'растущая', 'земля', 193, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2213, 'растущая', 'земля', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2214, 'растущая', 'земля', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2215, 'растущая', 'земля', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2216, 'убывающая', 'земля', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2217, 'убывающая', 'земля', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2218, 'убывающая', 'земля', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2219, 'убывающая', 'земля', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2220, 'убывающая', 'земля', 193, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2221, 'убывающая', 'земля', 193, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2222, 'убывающая', 'земля', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2223, 'убывающая', 'земля', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2224, 'новолуние', 'земля', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2225, 'новолуние', 'земля', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2226, 'новолуние', 'земля', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2227, 'новолуние', 'земля', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2228, 'новолуние', 'земля', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2229, 'новолуние', 'земля', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2230, 'новолуние', 'земля', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2231, 'новолуние', 'земля', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2232, 'полнолуние', 'огонь', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2233, 'полнолуние', 'огонь', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2234, 'полнолуние', 'огонь', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2235, 'полнолуние', 'огонь', 193, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2236, 'полнолуние', 'огонь', 193, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2237, 'полнолуние', 'огонь', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2238, 'полнолуние', 'огонь', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2239, 'полнолуние', 'огонь', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2240, 'растущая', 'огонь', 193, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2241, 'растущая', 'огонь', 193, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2242, 'растущая', 'огонь', 193, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2243, 'растущая', 'огонь', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2244, 'растущая', 'огонь', 193, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2245, 'растущая', 'огонь', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2246, 'растущая', 'огонь', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2247, 'растущая', 'огонь', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2248, 'убывающая', 'огонь', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2249, 'убывающая', 'огонь', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2250, 'убывающая', 'огонь', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2251, 'убывающая', 'огонь', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2252, 'убывающая', 'огонь', 193, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2253, 'убывающая', 'огонь', 193, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2254, 'убывающая', 'огонь', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2255, 'убывающая', 'огонь', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2256, 'новолуние', 'огонь', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2257, 'новолуние', 'огонь', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2258, 'новолуние', 'огонь', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2259, 'новолуние', 'огонь', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2260, 'новолуние', 'огонь', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2261, 'новолуние', 'огонь', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2262, 'новолуние', 'огонь', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2263, 'новолуние', 'огонь', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2264, 'полнолуние', 'воздух', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2265, 'полнолуние', 'воздух', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2266, 'полнолуние', 'воздух', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2267, 'полнолуние', 'воздух', 193, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2268, 'полнолуние', 'воздух', 193, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2269, 'полнолуние', 'воздух', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2270, 'полнолуние', 'воздух', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2271, 'полнолуние', 'воздух', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2272, 'растущая', 'воздух', 193, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2273, 'растущая', 'воздух', 193, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2274, 'растущая', 'воздух', 193, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2275, 'растущая', 'воздух', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2276, 'растущая', 'воздух', 193, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2277, 'растущая', 'воздух', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2278, 'растущая', 'воздух', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2279, 'растущая', 'воздух', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2280, 'убывающая', 'воздух', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2281, 'убывающая', 'воздух', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2282, 'убывающая', 'воздух', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2283, 'убывающая', 'воздух', 193, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2284, 'убывающая', 'воздух', 193, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2285, 'убывающая', 'воздух', 193, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2286, 'убывающая', 'воздух', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2287, 'убывающая', 'воздух', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2288, 'новолуние', 'воздух', 193, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2289, 'новолуние', 'воздух', 193, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2290, 'новолуние', 'воздух', 193, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2291, 'новолуние', 'воздух', 193, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:08:08'),
(2292, 'новолуние', 'воздух', 193, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2293, 'новолуние', 'воздух', 193, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:36:00'),
(2294, 'новолуние', 'воздух', 193, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2295, 'новолуние', 'воздух', 193, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2296, 'полнолуние', 'вода', 194, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2297, 'полнолуние', 'вода', 194, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2298, 'полнолуние', 'вода', 194, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2299, 'полнолуние', 'вода', 194, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2300, 'полнолуние', 'вода', 194, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2301, 'полнолуние', 'вода', 194, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2302, 'полнолуние', 'вода', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2303, 'полнолуние', 'вода', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2304, 'растущая', 'вода', 194, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2305, 'растущая', 'вода', 194, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2306, 'растущая', 'вода', 194, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2307, 'растущая', 'вода', 194, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2308, 'растущая', 'вода', 194, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2309, 'растущая', 'вода', 194, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2310, 'растущая', 'вода', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2311, 'растущая', 'вода', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2312, 'убывающая', 'вода', 194, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2313, 'убывающая', 'вода', 194, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2314, 'убывающая', 'вода', 194, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2315, 'убывающая', 'вода', 194, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2316, 'убывающая', 'вода', 194, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2317, 'убывающая', 'вода', 194, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2318, 'убывающая', 'вода', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2319, 'убывающая', 'вода', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2320, 'новолуние', 'вода', 194, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2321, 'новолуние', 'вода', 194, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2322, 'новолуние', 'вода', 194, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2323, 'новолуние', 'вода', 194, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2324, 'новолуние', 'вода', 194, 5, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2325, 'новолуние', 'вода', 194, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:23:16'),
(2326, 'новолуние', 'вода', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2327, 'новолуние', 'вода', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2328, 'полнолуние', 'земля', 194, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2329, 'полнолуние', 'земля', 194, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2330, 'полнолуние', 'земля', 194, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2331, 'полнолуние', 'земля', 194, 4, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2332, 'полнолуние', 'земля', 194, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2333, 'полнолуние', 'земля', 194, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2334, 'полнолуние', 'земля', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2335, 'полнолуние', 'земля', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2336, 'растущая', 'земля', 194, 1, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2337, 'растущая', 'земля', 194, 2, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2338, 'растущая', 'земля', 194, 3, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2339, 'растущая', 'земля', 194, 4, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2340, 'растущая', 'земля', 194, 5, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2341, 'растущая', 'земля', 194, 6, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2342, 'растущая', 'земля', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2343, 'растущая', 'земля', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2344, 'убывающая', 'земля', 194, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2345, 'убывающая', 'земля', 194, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2346, 'убывающая', 'земля', 194, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2347, 'убывающая', 'земля', 194, 4, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2348, 'убывающая', 'земля', 194, 5, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2349, 'убывающая', 'земля', 194, 6, 'рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:04:20'),
(2350, 'убывающая', 'земля', 194, 7, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2351, 'убывающая', 'земля', 194, 8, 'нейтрально', '2018-10-16 06:09:50', '2018-10-16 06:09:50'),
(2352, 'новолуние', 'земля', 194, 1, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2353, 'новолуние', 'земля', 194, 2, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2354, 'новолуние', 'земля', 194, 3, 'не рекомендовано', '2018-10-16 06:09:50', '2018-10-16 08:27:33'),
(2355, 'новолуние', 'земля', 194, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2356, 'новолуние', 'земля', 194, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2357, 'новолуние', 'земля', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2358, 'новолуние', 'земля', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2359, 'новолуние', 'земля', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2360, 'полнолуние', 'огонь', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2361, 'полнолуние', 'огонь', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2362, 'полнолуние', 'огонь', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2363, 'полнолуние', 'огонь', 194, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2364, 'полнолуние', 'огонь', 194, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2365, 'полнолуние', 'огонь', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2366, 'полнолуние', 'огонь', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2367, 'полнолуние', 'огонь', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2368, 'растущая', 'огонь', 194, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2369, 'растущая', 'огонь', 194, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2370, 'растущая', 'огонь', 194, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2371, 'растущая', 'огонь', 194, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2372, 'растущая', 'огонь', 194, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2373, 'растущая', 'огонь', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2374, 'растущая', 'огонь', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2375, 'растущая', 'огонь', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2376, 'убывающая', 'огонь', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2377, 'убывающая', 'огонь', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2378, 'убывающая', 'огонь', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2379, 'убывающая', 'огонь', 194, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2380, 'убывающая', 'огонь', 194, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2381, 'убывающая', 'огонь', 194, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2382, 'убывающая', 'огонь', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2383, 'убывающая', 'огонь', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2384, 'новолуние', 'огонь', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2385, 'новолуние', 'огонь', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2386, 'новолуние', 'огонь', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2387, 'новолуние', 'огонь', 194, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2388, 'новолуние', 'огонь', 194, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2389, 'новолуние', 'огонь', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2390, 'новолуние', 'огонь', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2391, 'новолуние', 'огонь', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2392, 'полнолуние', 'воздух', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2393, 'полнолуние', 'воздух', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2394, 'полнолуние', 'воздух', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2395, 'полнолуние', 'воздух', 194, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2396, 'полнолуние', 'воздух', 194, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2397, 'полнолуние', 'воздух', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:00'),
(2398, 'полнолуние', 'воздух', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2399, 'полнолуние', 'воздух', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2400, 'растущая', 'воздух', 194, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2401, 'растущая', 'воздух', 194, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2402, 'растущая', 'воздух', 194, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2403, 'растущая', 'воздух', 194, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2404, 'растущая', 'воздух', 194, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2405, 'растущая', 'воздух', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2406, 'растущая', 'воздух', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2407, 'растущая', 'воздух', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2408, 'убывающая', 'воздух', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2409, 'убывающая', 'воздух', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2410, 'убывающая', 'воздух', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2411, 'убывающая', 'воздух', 194, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2412, 'убывающая', 'воздух', 194, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2413, 'убывающая', 'воздух', 194, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2414, 'убывающая', 'воздух', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2415, 'убывающая', 'воздух', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2416, 'новолуние', 'воздух', 194, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2417, 'новолуние', 'воздух', 194, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2418, 'новолуние', 'воздух', 194, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2419, 'новолуние', 'воздух', 194, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:08'),
(2420, 'новолуние', 'воздух', 194, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2421, 'новолуние', 'воздух', 194, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2422, 'новолуние', 'воздух', 194, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2423, 'новолуние', 'воздух', 194, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2424, 'полнолуние', 'вода', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2425, 'полнолуние', 'вода', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2426, 'полнолуние', 'вода', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2427, 'полнолуние', 'вода', 270, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2428, 'полнолуние', 'вода', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2429, 'полнолуние', 'вода', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2430, 'полнолуние', 'вода', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2431, 'полнолуние', 'вода', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2432, 'растущая', 'вода', 270, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2433, 'растущая', 'вода', 270, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2434, 'растущая', 'вода', 270, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2435, 'растущая', 'вода', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2436, 'растущая', 'вода', 270, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2437, 'растущая', 'вода', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2438, 'растущая', 'вода', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2439, 'растущая', 'вода', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2440, 'убывающая', 'вода', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2441, 'убывающая', 'вода', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2442, 'убывающая', 'вода', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2443, 'убывающая', 'вода', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2444, 'убывающая', 'вода', 270, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2445, 'убывающая', 'вода', 270, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2446, 'убывающая', 'вода', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2447, 'убывающая', 'вода', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2448, 'новолуние', 'вода', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2449, 'новолуние', 'вода', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2450, 'новолуние', 'вода', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2451, 'новолуние', 'вода', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2452, 'новолуние', 'вода', 270, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2453, 'новолуние', 'вода', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:16'),
(2454, 'новолуние', 'вода', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2455, 'новолуние', 'вода', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2456, 'полнолуние', 'земля', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2457, 'полнолуние', 'земля', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2458, 'полнолуние', 'земля', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2459, 'полнолуние', 'земля', 270, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2460, 'полнолуние', 'земля', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2461, 'полнолуние', 'земля', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2462, 'полнолуние', 'земля', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2463, 'полнолуние', 'земля', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2464, 'растущая', 'земля', 270, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2465, 'растущая', 'земля', 270, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2466, 'растущая', 'земля', 270, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:20'),
(2467, 'растущая', 'земля', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2468, 'растущая', 'земля', 270, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2469, 'растущая', 'земля', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2470, 'растущая', 'земля', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2471, 'растущая', 'земля', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2472, 'убывающая', 'земля', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2473, 'убывающая', 'земля', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2474, 'убывающая', 'земля', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2475, 'убывающая', 'земля', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2476, 'убывающая', 'земля', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2477, 'убывающая', 'земля', 270, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2478, 'убывающая', 'земля', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2479, 'убывающая', 'земля', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2480, 'новолуние', 'земля', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2481, 'новолуние', 'земля', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2482, 'новолуние', 'земля', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2483, 'новолуние', 'земля', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2484, 'новолуние', 'земля', 270, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2485, 'новолуние', 'земля', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:27:33'),
(2486, 'новолуние', 'земля', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2487, 'новолуние', 'земля', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2488, 'полнолуние', 'огонь', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2489, 'полнолуние', 'огонь', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2490, 'полнолуние', 'огонь', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2491, 'полнолуние', 'огонь', 270, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2492, 'полнолуние', 'огонь', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2493, 'полнолуние', 'огонь', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2494, 'полнолуние', 'огонь', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2495, 'полнолуние', 'огонь', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2496, 'растущая', 'огонь', 270, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2497, 'растущая', 'огонь', 270, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2498, 'растущая', 'огонь', 270, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2499, 'растущая', 'огонь', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2500, 'растущая', 'огонь', 270, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2501, 'растущая', 'огонь', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2502, 'растущая', 'огонь', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2503, 'растущая', 'огонь', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2504, 'убывающая', 'огонь', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2505, 'убывающая', 'огонь', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2506, 'убывающая', 'огонь', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2507, 'убывающая', 'огонь', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2508, 'убывающая', 'огонь', 270, 5, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2509, 'убывающая', 'огонь', 270, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2510, 'убывающая', 'огонь', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2511, 'убывающая', 'огонь', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2512, 'новолуние', 'огонь', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2513, 'новолуние', 'огонь', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2514, 'новолуние', 'огонь', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2515, 'новолуние', 'огонь', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:04:21'),
(2516, 'новолуние', 'огонь', 270, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2517, 'новолуние', 'огонь', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2518, 'новолуние', 'огонь', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2519, 'новолуние', 'огонь', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2520, 'полнолуние', 'воздух', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2521, 'полнолуние', 'воздух', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2522, 'полнолуние', 'воздух', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2523, 'полнолуние', 'воздух', 270, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2524, 'полнолуние', 'воздух', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2525, 'полнолуние', 'воздух', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2526, 'полнолуние', 'воздух', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2527, 'полнолуние', 'воздух', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2528, 'растущая', 'воздух', 270, 1, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2529, 'растущая', 'воздух', 270, 2, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2530, 'растущая', 'воздух', 270, 3, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2531, 'растущая', 'воздух', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2532, 'растущая', 'воздух', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2533, 'растущая', 'воздух', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2534, 'растущая', 'воздух', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2535, 'растущая', 'воздух', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2536, 'убывающая', 'воздух', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2537, 'убывающая', 'воздух', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2538, 'убывающая', 'воздух', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2539, 'убывающая', 'воздух', 270, 4, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2540, 'убывающая', 'воздух', 270, 5, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2541, 'убывающая', 'воздух', 270, 6, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2542, 'убывающая', 'воздух', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2543, 'убывающая', 'воздух', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2544, 'новолуние', 'воздух', 270, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2545, 'новолуние', 'воздух', 270, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2546, 'новолуние', 'воздух', 270, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2547, 'новолуние', 'воздух', 270, 4, 'рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:08:09'),
(2548, 'новолуние', 'воздух', 270, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2549, 'новолуние', 'воздух', 270, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:36:01'),
(2550, 'новолуние', 'воздух', 270, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2551, 'новолуние', 'воздух', 270, 8, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2552, 'полнолуние', 'вода', 291, 1, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2553, 'полнолуние', 'вода', 291, 2, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2554, 'полнолуние', 'вода', 291, 3, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2555, 'полнолуние', 'вода', 291, 4, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2556, 'полнолуние', 'вода', 291, 5, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2557, 'полнолуние', 'вода', 291, 6, 'не рекомендовано', '2018-10-16 06:09:51', '2018-10-16 08:23:17'),
(2558, 'полнолуние', 'вода', 291, 7, 'нейтрально', '2018-10-16 06:09:51', '2018-10-16 06:09:51'),
(2559, 'полнолуние', 'вода', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2560, 'растущая', 'вода', 291, 1, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2561, 'растущая', 'вода', 291, 2, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2562, 'растущая', 'вода', 291, 3, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2563, 'растущая', 'вода', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2564, 'растущая', 'вода', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2565, 'растущая', 'вода', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2566, 'растущая', 'вода', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2567, 'растущая', 'вода', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2568, 'убывающая', 'вода', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2569, 'убывающая', 'вода', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2570, 'убывающая', 'вода', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2571, 'убывающая', 'вода', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2572, 'убывающая', 'вода', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2573, 'убывающая', 'вода', 291, 6, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2574, 'убывающая', 'вода', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2575, 'убывающая', 'вода', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2576, 'новолуние', 'вода', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2577, 'новолуние', 'вода', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2578, 'новолуние', 'вода', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2579, 'новолуние', 'вода', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2580, 'новолуние', 'вода', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2581, 'новолуние', 'вода', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:23:17'),
(2582, 'новолуние', 'вода', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2583, 'новолуние', 'вода', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2584, 'полнолуние', 'земля', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2585, 'полнолуние', 'земля', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2586, 'полнолуние', 'земля', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2587, 'полнолуние', 'земля', 291, 4, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2588, 'полнолуние', 'земля', 291, 5, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2589, 'полнолуние', 'земля', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2590, 'полнолуние', 'земля', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2591, 'полнолуние', 'земля', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2592, 'растущая', 'земля', 291, 1, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2593, 'растущая', 'земля', 291, 2, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2594, 'растущая', 'земля', 291, 3, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2595, 'растущая', 'земля', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2596, 'растущая', 'земля', 291, 5, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2597, 'растущая', 'земля', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2598, 'растущая', 'земля', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2599, 'растущая', 'земля', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2600, 'убывающая', 'земля', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2601, 'убывающая', 'земля', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2602, 'убывающая', 'земля', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2603, 'убывающая', 'земля', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2604, 'убывающая', 'земля', 291, 5, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2605, 'убывающая', 'земля', 291, 6, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2606, 'убывающая', 'земля', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2607, 'убывающая', 'земля', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2608, 'новолуние', 'земля', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2609, 'новолуние', 'земля', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2610, 'новолуние', 'земля', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2611, 'новолуние', 'земля', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2612, 'новолуние', 'земля', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2613, 'новолуние', 'земля', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:27:34'),
(2614, 'новолуние', 'земля', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2615, 'новолуние', 'земля', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2616, 'полнолуние', 'огонь', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2617, 'полнолуние', 'огонь', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2618, 'полнолуние', 'огонь', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2619, 'полнолуние', 'огонь', 291, 4, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2620, 'полнолуние', 'огонь', 291, 5, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2621, 'полнолуние', 'огонь', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2622, 'полнолуние', 'огонь', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2623, 'полнолуние', 'огонь', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2624, 'растущая', 'огонь', 291, 1, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2625, 'растущая', 'огонь', 291, 2, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2626, 'растущая', 'огонь', 291, 3, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2627, 'растущая', 'огонь', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2628, 'растущая', 'огонь', 291, 5, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2629, 'растущая', 'огонь', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2630, 'растущая', 'огонь', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2631, 'растущая', 'огонь', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2632, 'убывающая', 'огонь', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2633, 'убывающая', 'огонь', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2634, 'убывающая', 'огонь', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2635, 'убывающая', 'огонь', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2636, 'убывающая', 'огонь', 291, 5, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2637, 'убывающая', 'огонь', 291, 6, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2638, 'убывающая', 'огонь', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52');
INSERT INTO `moon_actions` (`id`, `phase_type`, `element`, `plant_attribute`, `sort_operation_id`, `value`, `created_at`, `updated_at`) VALUES
(2639, 'убывающая', 'огонь', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2640, 'новолуние', 'огонь', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2641, 'новолуние', 'огонь', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2642, 'новолуние', 'огонь', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2643, 'новолуние', 'огонь', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:04:21'),
(2644, 'новолуние', 'огонь', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2645, 'новолуние', 'огонь', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2646, 'новолуние', 'огонь', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2647, 'новолуние', 'огонь', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2648, 'полнолуние', 'воздух', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2649, 'полнолуние', 'воздух', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2650, 'полнолуние', 'воздух', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2651, 'полнолуние', 'воздух', 291, 4, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2652, 'полнолуние', 'воздух', 291, 5, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2653, 'полнолуние', 'воздух', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2654, 'полнолуние', 'воздух', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2655, 'полнолуние', 'воздух', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2656, 'растущая', 'воздух', 291, 1, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2657, 'растущая', 'воздух', 291, 2, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2658, 'растущая', 'воздух', 291, 3, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2659, 'растущая', 'воздух', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2660, 'растущая', 'воздух', 291, 5, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2661, 'растущая', 'воздух', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2662, 'растущая', 'воздух', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2663, 'растущая', 'воздух', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2664, 'убывающая', 'воздух', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2665, 'убывающая', 'воздух', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2666, 'убывающая', 'воздух', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2667, 'убывающая', 'воздух', 291, 4, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2668, 'убывающая', 'воздух', 291, 5, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2669, 'убывающая', 'воздух', 291, 6, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2670, 'убывающая', 'воздух', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2671, 'убывающая', 'воздух', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2672, 'новолуние', 'воздух', 291, 1, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2673, 'новолуние', 'воздух', 291, 2, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2674, 'новолуние', 'воздух', 291, 3, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2675, 'новолуние', 'воздух', 291, 4, 'рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:08:09'),
(2676, 'новолуние', 'воздух', 291, 5, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2677, 'новолуние', 'воздух', 291, 6, 'не рекомендовано', '2018-10-16 06:09:52', '2018-10-16 08:36:01'),
(2678, 'новолуние', 'воздух', 291, 7, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52'),
(2679, 'новолуние', 'воздух', 291, 8, 'нейтрально', '2018-10-16 06:09:52', '2018-10-16 06:09:52');

-- --------------------------------------------------------

--
-- Структура таблицы `moon_dates`
--

CREATE TABLE `moon_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `phase_id` int(11) NOT NULL,
  `element` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'земля воздух огонь вода',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `moon_dates`
--

INSERT INTO `moon_dates` (`id`, `date`, `phase_id`, `element`, `created_at`, `updated_at`) VALUES
(9, '2018-11-07', 1, 'вода', '2018-10-16 09:32:44', '2018-10-16 10:12:40'),
(13, '2018-11-06', 27, 'вода', '2018-10-16 09:33:38', '2018-10-16 10:14:16'),
(14, '2018-11-05', 26, 'воздух', '2018-10-16 09:33:55', '2018-10-16 10:14:16'),
(15, '2018-11-04', 25, 'воздух', '2018-10-16 09:34:08', '2018-10-16 10:14:16'),
(16, '2018-11-03', 24, 'земля', '2018-10-16 09:34:29', '2018-10-16 10:14:16'),
(17, '2018-11-02', 23, 'земля', '2018-10-16 09:34:43', '2018-10-16 10:14:16'),
(18, '2018-11-01', 22, 'земля', '2018-10-16 09:34:58', '2018-10-16 10:14:16'),
(19, '2018-11-08', 2, 'вода', '2018-10-16 09:35:45', '2018-10-16 10:12:40'),
(21, '2018-11-09', 3, 'огонь', '2018-10-16 09:36:55', '2018-10-16 10:12:40'),
(22, '2018-11-10', 4, 'огонь', '2018-10-16 09:37:13', '2018-10-16 10:12:40'),
(23, '2018-11-11', 5, 'земля', '2018-10-16 09:37:33', '2018-10-16 10:12:40'),
(25, '2018-11-13', 6, 'воздух', '2018-10-16 09:38:09', '2018-10-16 10:14:16'),
(26, '2018-11-14', 6, 'воздух', '2018-10-16 09:38:52', '2018-10-16 10:15:37'),
(27, '2018-11-15', 7, 'воздух', '2018-10-16 09:39:05', '2018-10-16 10:15:20'),
(28, '2018-11-16', 8, 'вода', '2018-10-16 09:39:52', '2018-10-16 10:17:28'),
(29, '2018-11-17', 9, 'вода', '2018-10-16 09:40:10', '2018-10-16 10:17:28'),
(30, '2018-11-18', 10, 'огонь', '2018-10-16 09:40:26', '2018-10-16 10:17:28'),
(32, '2018-11-19', 11, 'огонь', '2018-10-16 09:41:02', '2018-10-16 09:43:50'),
(33, '2018-11-20', 12, 'огонь', '2018-10-16 09:41:24', '2018-10-16 09:43:50'),
(34, '2018-11-21', 13, 'земля', '2018-10-16 09:41:43', '2018-10-16 09:43:50'),
(35, '2018-11-22', 14, 'земля', '2018-10-16 09:42:47', '2018-10-16 09:43:50'),
(36, '2018-11-23', 15, 'воздух', '2018-10-16 09:43:15', '2018-10-16 09:43:50'),
(38, '2018-11-24', 16, 'воздух', '2018-10-16 09:46:09', '2018-10-16 09:46:09'),
(39, '2018-11-25', 17, 'вода', '2018-10-16 09:51:40', '2018-10-16 09:51:40'),
(40, '2018-11-26', 18, 'вода', '2018-10-16 09:52:09', '2018-10-16 09:52:09'),
(41, '2018-11-27', 19, 'огонь', '2018-10-16 09:52:34', '2018-10-16 09:52:34'),
(43, '2018-11-29', 20, 'земля', '2018-10-16 09:53:19', '2018-10-16 09:53:19'),
(45, '2018-11-30', 22, 'земля', '2018-10-16 09:54:13', '2018-10-16 10:27:18'),
(46, '2018-12-01', 23, 'воздух', '2018-10-16 09:56:12', '2018-10-16 10:27:18'),
(47, '2018-12-02', 24, 'воздух', '2018-10-16 09:56:22', '2018-10-16 10:27:18'),
(48, '2018-12-03', 25, 'вода', '2018-10-16 09:57:11', '2018-10-16 10:27:18'),
(49, '2018-12-04', 26, 'вода', '2018-10-16 09:57:19', '2018-10-16 10:27:18'),
(50, '2018-12-05', 27, 'вода', '2018-10-16 09:58:16', '2018-10-16 10:27:18'),
(51, '2018-12-06', 28, 'огонь', '2018-10-16 09:59:03', '2018-10-16 10:27:18'),
(52, '2018-12-07', 1, 'огонь', '2018-10-16 09:59:36', '2018-10-16 10:12:40');

-- --------------------------------------------------------

--
-- Структура таблицы `moon_phases`
--

CREATE TABLE `moon_phases` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phase_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'полнолуние новолуние растущая убывающая',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `moon_phases`
--

INSERT INTO `moon_phases` (`id`, `title`, `icon`, `phase_type`, `created_at`, `updated_at`) VALUES
(1, 'фаза 1', 'moon/1.png', 'новолуние', NULL, '2018-10-10 09:15:38'),
(2, 'фаза 2', 'moon/2.png', 'растущая', NULL, '2018-10-16 10:19:14'),
(3, 'фаза 3', 'moon/3.png', 'растущая', NULL, NULL),
(4, 'фаза 4', 'moon/4.png', 'растущая', NULL, NULL),
(5, 'фаза 5', 'moon/5.png', 'растущая', NULL, NULL),
(6, 'фаза 6', 'moon/6.png', 'растущая', '2018-10-03 05:45:46', '2018-10-03 05:45:46'),
(7, 'фаза 7', 'moon/7.png', 'растущая', '2018-10-03 05:45:46', '2018-10-03 05:45:46'),
(8, 'фаза 8', 'moon/8.png', 'растущая', '2018-10-03 05:45:46', '2018-10-03 05:45:46'),
(9, 'фаза 9', 'moon/9.png', 'растущая', '2018-10-03 05:45:46', '2018-10-03 05:45:46'),
(10, 'фаза 10', 'moon/10.png', 'растущая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(11, 'фаза 11', 'moon/11.png', 'растущая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(12, 'фаза 12', 'moon/12.png', 'растущая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(13, 'фаза 13', 'moon/13.png', 'растущая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(14, 'фаза 14', 'moon/14.png', 'растущая', '2018-10-03 05:45:46', '2018-10-16 10:19:14'),
(15, 'фаза 15', 'moon/15.png', 'полнолуние', '2018-10-03 05:45:46', '2018-10-10 09:15:02'),
(16, 'фаза 16', 'moon/16.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(17, 'фаза 17', 'moon/17.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(18, 'фаза 18', 'moon/18.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(19, 'фаза 19', 'moon/19.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(20, 'фаза 20', 'moon/20.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(21, 'фаза 21', 'moon/21.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(22, 'фаза 22', 'moon/22.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(23, 'фаза 23', 'moon/23.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(24, 'фаза 24', 'moon/24.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(25, 'фаза 25', 'moon/25.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(26, 'фаза 26', 'moon/26.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(27, 'фаза 27', 'moon/27.png', 'убывающая', '2018-10-03 05:45:46', '2018-10-16 03:15:02'),
(28, 'фаза 28', 'moon/28.png', 'полнолуние', '2018-10-03 05:45:46', '2018-10-16 10:19:14');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `type`, `text`, `topic`, `item_type`, `item_id`, `is_read`, `created_at`, `updated_at`) VALUES
(2, 23, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ Ферст нейм Петрович', NULL, NULL, 0, '2018-09-07 06:08:06', '2018-09-07 06:08:06'),
(3, 61, 23, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 14:36:06', '2018-09-17 14:36:06'),
(4, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Отказ заказа №58. Заказчик Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 14:58:55', '2018-09-17 14:58:55'),
(5, 61, 23, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1\\n Комментарий заказчикагад', 'Отказ заказа №58. Заказчик Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:01:11', '2018-09-17 15:01:11'),
(6, 61, 31, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1\\n Комментарий продавца: скотиняка така', 'Отказ заказа №58. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:04:30', '2018-09-17 15:04:30'),
(7, 61, 31, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1\\n Комментарий продавца: скотиняка така', 'Отказ заказа №58. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:09:26', '2018-09-17 15:09:26'),
(8, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Отказ заказа №58. Заказчик Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:23:23', '2018-09-17 15:23:23'),
(9, 23, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Отказ заказа №58. Заказчик Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:24:36', '2018-09-17 15:24:36'),
(10, 61, 61, 'order', 'Подробности заказа <br> Яблоко Семеренко 5 15<br> Яблоко Меркурий 3 0.1', 'Заказ №58 принят. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-17 15:30:00', '2018-09-17 15:30:00'),
(11, 61, 62, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Предложено забронировать заказ №58. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-19 16:20:07', '2018-09-19 16:20:07'),
(12, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Принято предложение забронировать заказ №58 принят. Продавец Ферст нейм Петрович', NULL, NULL, 1, '2018-09-19 16:22:11', '2018-10-22 06:34:55'),
(13, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Забронированный заказ №58 готов. Продавец Ферст нейм Петрович', NULL, NULL, 1, '2018-09-19 16:51:43', '2018-10-22 06:34:55'),
(14, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ №58 отправлен. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-19 16:56:33', '2018-09-19 16:56:33'),
(15, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ №58 готов к выдаче. Продавец Ферст нейм Петрович', NULL, NULL, 0, '2018-09-19 16:56:50', '2018-09-19 16:56:50'),
(16, 61, 61, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ №58 получен. Покупатель Ферст нейм Петрович', NULL, NULL, 0, '2018-09-19 17:01:12', '2018-09-19 17:01:12'),
(17, 62, 61, 'order', 'приветики', NULL, NULL, NULL, 0, '2018-09-20 16:06:35', '2018-09-20 16:06:35'),
(18, 61, 23, 'order', 'приветики', NULL, NULL, NULL, 0, '2018-09-20 16:07:35', '2018-09-20 16:07:35'),
(19, 61, 61, 'order', 'приветики', NULL, NULL, NULL, 0, '2018-09-20 16:07:57', '2018-09-20 16:07:57'),
(20, 61, 23, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ №58 получен. Покупатель Ферст нейм Петрович', NULL, NULL, 0, '2018-09-23 14:45:33', '2018-09-23 14:45:33'),
(21, 61, 20, 'order', 'Подробности заказа\\n Яблоко Семеренко 5 15\\n Яблоко Меркурий 3 0.1', 'Заказ №58 получен. Покупатель Ферст нейм Петрович', NULL, NULL, 0, '2018-09-23 15:09:02', '2018-09-23 15:09:02'),
(27, 0, 23, 'notification', '111', '111', NULL, NULL, 0, '2018-10-02 02:59:44', '2018-10-02 02:59:44'),
(81, 0, 23, 'support', 'Акция: если ты Руслан - держи баклажан. ', 'Новинка', NULL, NULL, 1, '2018-10-04 02:39:54', '2018-10-17 11:02:29'),
(87, 0, 61, 'response', 'примерно', 'Пользователь  прокоментировал Ваш отзыв', 'decorator', 61, 0, '2018-10-22 08:55:20', '2018-10-22 08:55:20'),
(88, 0, 61, 'response', 'И зачем?', 'Пользователь  прокоментировал Ваш отзыв', 'chemical', 38, 0, '2018-10-22 08:55:51', '2018-10-22 08:55:51'),
(89, 23, 23, 'response', 'И зачем?', 'Пользователь dfefef прокоментировал Ваш отзыв', 'chemical', 38, 0, '2018-10-22 08:57:45', '2018-10-22 08:57:45');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `delivery_method_id` int(11) DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `owner_id`, `status_id`, `delivery_method_id`, `address`, `created_at`, `updated_at`) VALUES
(54, 39, NULL, 1, 1, NULL, '2018-08-21 10:07:16', '2018-08-21 10:07:16'),
(55, 22, NULL, 1, 1, NULL, '2018-08-27 04:57:57', '2018-08-27 04:57:57'),
(56, 32, NULL, 1, 1, NULL, '2018-08-27 10:58:01', '2018-08-27 10:58:01'),
(57, 61, NULL, 2, 1, NULL, '2018-08-29 05:38:36', '2018-08-29 05:38:36'),
(58, 61, 20, 6, 1, 'ул Пушкина, дом Колотушкина', '2018-08-29 09:24:06', '2018-09-23 15:09:02'),
(60, 69, 20, 1, 1, '', '2018-08-29 09:24:06', '2018-09-23 15:09:02'),
(61, 78, NULL, 1, NULL, NULL, '2018-10-19 10:43:51', '2018-10-19 10:43:51'),
(62, 23, NULL, 1, NULL, NULL, '2018-10-23 09:02:29', '2018-10-23 09:02:29');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `type`, `category_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(2, 57, 49, 'sort', NULL, 0, 0.00, '2018-08-29 05:38:36', '2018-08-29 05:38:36'),
(3, 58, 49, 'sort', 3, 5, 15.00, '2018-08-29 05:39:04', '2018-09-07 04:38:56'),
(4, 57, 49, 'sort', 1, 0, 0.00, '2018-08-29 05:45:05', '2018-08-29 05:45:05'),
(5, 55, 49, 'sort', NULL, 0, 0.00, '2018-08-29 07:55:56', '2018-08-29 07:55:56'),
(6, 55, 49, 'sort', NULL, 0, 0.00, '2018-08-29 07:56:25', '2018-08-29 07:56:25'),
(7, 55, 49, 'sort', NULL, 0, 0.00, '2018-08-29 08:02:59', '2018-08-29 08:02:59'),
(8, 58, 49, 'sort', 1, 3, 0.10, '2018-08-29 09:24:06', '2018-08-29 09:24:06'),
(9, 55, 49, 'sort', NULL, 0, 0.00, '2018-08-30 04:29:50', '2018-08-30 04:29:50'),
(10, 55, 49, 'sort', NULL, 0, 0.00, '2018-09-18 14:23:09', '2018-09-18 14:23:09'),
(11, 55, 49, 'sort', NULL, 0, 0.00, '2018-09-28 13:05:31', '2018-09-28 13:05:31'),
(12, 55, 47, 'sort', NULL, 0, 0.00, '2018-10-05 06:49:31', '2018-10-05 06:49:31'),
(13, 60, 27, 'chemical', NULL, 4, 0.00, '2018-10-05 06:49:31', '2018-10-05 06:49:31'),
(14, 61, 47, 'sort', NULL, 0, 0.00, '2018-10-19 10:43:51', '2018-10-19 10:43:51'),
(15, 56, 47, 'sort', NULL, 0, 0.00, '2018-10-22 07:18:42', '2018-10-22 07:18:42'),
(16, 62, 47, 'sort', NULL, 0, 0.00, '2018-10-23 09:02:29', '2018-10-23 09:02:29'),
(17, 62, 48, 'sort', NULL, 0, 0.00, '2018-10-23 09:07:49', '2018-10-23 09:07:49'),
(18, 62, 49, 'sort', NULL, 0, 0.00, '2018-10-23 09:16:29', '2018-10-23 09:16:29'),
(19, 62, 51, 'sort', NULL, 0, 0.00, '2018-10-23 09:38:24', '2018-10-23 09:38:24'),
(20, 62, 51, 'sort', NULL, 0, 0.00, '2018-10-23 09:38:37', '2018-10-23 09:38:37'),
(21, 62, 61, 'sort', NULL, 0, 0.00, '2018-10-23 09:41:14', '2018-10-23 09:41:14'),
(22, 57, 21, 'chemical', 0, 0, 0.00, '2018-10-23 10:05:22', '2018-10-23 10:05:22'),
(23, 57, 21, 'chemical', 0, 0, 0.00, '2018-10-23 10:07:54', '2018-10-23 10:07:54'),
(24, 61, 28, 'sort', NULL, 0, 0.00, '2018-10-23 10:13:32', '2018-10-23 10:13:32'),
(25, 61, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:14:49', '2018-10-23 10:14:49'),
(26, 57, 21, 'chemical', 0, 0, 0.00, '2018-10-23 10:16:25', '2018-10-23 10:16:25'),
(27, 57, 21, 'chemical', 5, 5, 0.00, '2018-10-23 10:17:08', '2018-10-23 10:17:08'),
(28, 61, 36, 'sort', NULL, 0, 0.00, '2018-10-23 10:17:39', '2018-10-23 10:17:39'),
(29, 61, 38, 'sort', NULL, 0, 0.00, '2018-10-23 10:18:32', '2018-10-23 10:18:32'),
(30, 61, 38, 'sort', NULL, 0, 0.00, '2018-10-23 10:18:32', '2018-10-23 10:18:32'),
(31, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:25:15', '2018-10-23 10:25:15'),
(32, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:25:15', '2018-10-23 10:25:15'),
(33, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:25:15', '2018-10-23 10:25:15'),
(34, 57, 47, 'sort', NULL, 0, 0.00, '2018-10-23 10:25:37', '2018-10-23 10:25:37'),
(35, 62, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:30:00', '2018-10-23 10:30:00'),
(36, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:31:03', '2018-10-23 10:31:03'),
(37, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:37:25', '2018-10-23 10:37:25'),
(38, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:38:05', '2018-10-23 10:38:05'),
(39, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:39:21', '2018-10-23 10:39:21'),
(40, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:39:46', '2018-10-23 10:39:46'),
(41, 61, 41, 'sort', NULL, 0, 0.00, '2018-10-23 10:40:01', '2018-10-23 10:40:01'),
(42, 61, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:42:19', '2018-10-23 10:42:19'),
(43, 61, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:42:43', '2018-10-23 10:42:43'),
(44, 62, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:43:19', '2018-10-23 10:43:19'),
(45, 62, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:43:37', '2018-10-23 10:43:37'),
(46, 61, 27, 'sort', NULL, 0, 0.00, '2018-10-23 10:44:30', '2018-10-23 10:44:30'),
(47, 57, 15, 'chemical', NULL, 0, 0.00, '2018-10-23 10:49:58', '2018-10-23 10:49:58'),
(48, 62, 36, 'chemical', NULL, 0, 0.00, '2018-10-23 10:50:47', '2018-10-23 10:50:47'),
(49, 57, 35, 'chemical', NULL, 0, 0.00, '2018-10-23 10:52:38', '2018-10-23 10:52:38'),
(50, 57, 35, 'chemical', NULL, 5, 0.00, '2018-10-23 10:58:24', '2018-10-23 10:58:24'),
(51, 57, 47, 'sort', NULL, 5, 0.00, '2018-10-23 11:01:46', '2018-10-23 11:01:46'),
(52, 61, 38, 'chemical', NULL, 0, 0.00, '2018-10-24 05:43:04', '2018-10-24 05:43:04'),
(53, 56, 27, 'chemical', NULL, 0, 0.00, '2018-10-25 06:17:57', '2018-10-25 06:17:57'),
(54, 61, 48, 'sort', NULL, 0, 0.00, '2018-10-25 09:40:20', '2018-10-25 09:40:20');

-- --------------------------------------------------------

--
-- Структура таблицы `order_regions`
--

CREATE TABLE `order_regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_regions`
--

INSERT INTO `order_regions` (`id`, `item_id`, `type`, `region_id`, `count`, `created_at`, `updated_at`) VALUES
(1, 47, 'sort', 77, 20, NULL, '2018-09-23 15:09:02'),
(2, 47, 'sort', 2, 2, NULL, NULL),
(3, 47, 'sort', 3, 15, NULL, NULL),
(4, 2, 'sort', 77, 25, '2018-09-07 08:01:46', '2018-09-23 15:09:02'),
(5, 34, 'chemical', 2, 15, NULL, NULL),
(6, 34, 'chemical', 77, 25, '2018-09-07 08:01:46', '2018-09-23 15:09:02');

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `status_name`) VALUES
(1, 'неоформлен'),
(2, 'оформлен'),
(3, 'на согласовании'),
(4, 'оформлена бронь'),
(5, 'отправлен (готов к выдаче)'),
(6, 'принят  '),
(7, 'исполнен'),
(8, 'отказано (покупателем)'),
(9, 'забронировать'),
(10, 'отказано (продавцом)'),
(11, 'Бронь готова');

-- --------------------------------------------------------

--
-- Структура таблицы `order_status_rels`
--

CREATE TABLE `order_status_rels` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_status_rels`
--

INSERT INTO `order_status_rels` (`id`, `order_id`, `order_status_id`, `date`, `created_at`, `updated_at`) VALUES
(48, 58, 8, '2018-09-17', '2018-09-17 15:23:23', '2018-09-17 15:23:23'),
(49, 58, 8, '2018-09-17', '2018-09-17 15:24:36', '2018-09-17 15:24:36'),
(50, 58, 6, '2018-09-17', '2018-09-17 15:30:00', '2018-09-17 15:30:00'),
(51, 58, 9, '2018-09-19', '2018-09-19 16:20:07', '2018-09-19 16:20:07'),
(52, 58, 4, '2018-09-19', '2018-09-19 16:22:11', '2018-09-19 16:22:11'),
(53, 58, 11, '2018-09-19', '2018-09-19 16:51:43', '2018-09-19 16:51:43'),
(54, 58, 5, '2018-09-19', '2018-09-19 16:56:33', '2018-09-19 16:56:33'),
(55, 58, 5, '2018-09-19', '2018-09-19 16:56:50', '2018-09-19 16:56:50'),
(56, 58, 7, '2018-09-19', '2018-09-19 17:01:12', '2018-09-19 17:01:12'),
(57, 58, 7, '2018-09-23', '2018-09-23 14:45:33', '2018-09-23 14:45:33'),
(58, 58, 7, '2018-09-23', '2018-09-23 15:09:02', '2018-09-23 15:09:02');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `pests`
--

CREATE TABLE `pests` (
  `id` int(10) UNSIGNED NOT NULL,
  `culture_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `name` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fight` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pests`
--

INSERT INTO `pests` (`id`, `culture_id`, `section_id`, `name`, `slug`, `main_photo`, `description`, `fight`, `date`, `created_at`, `updated_at`) VALUES
(35, 0, 6, 'Грушевая плодожорка', 'Грушевая плодожорка', 'pest_35_photo_5ba0a3e982c45.jpg', 'Грушевая плодожорка – монофаг, повреждает только плоды груши. Наиболее подвержены повреждениям ранние сорта. Размножение двуполое. Зимуют гусеницы в коконах в почве. Генерация в основном одногодичная, иногда наблюдается частичное развитие второго поколения. \r\nВредоносность\r\nПлодожорка грушевая повреждает только груши. Вредит на стадии гусеницы, наиболее опасна для ранних сортов груш, которые к моменту отрождения личинок имеют пригодные для питания семена. Наиболее значительный вред приносит в лесостепной и степной зоне, где повреждает 80–90 % плодов груш.', 'Меры борьбы\r\n1. Агротехнические мероприятия. Зяблевая вспашка, рыхление и перекопка почвы в приствольных кругах.\r\n2. Пояс из мешковины на высоте 50 см.  от уровня земли.\r\n3. Химический способ. Своевременное опрыскивание деревьев, фосфорорганическими соединениями.\r\n\r\nПрепараты:\r\n- Парус, КЭ\r\n- Агравертин до и после цветения – 5 мл на 1,5 литра воды.&nbsp;', '2018-09-18', '2018-09-18 04:06:17', '2018-10-17 06:02:03'),
(37, 0, 6, 'Тля', 'Тля', 'pest_37_photo_5bb4e544b8d43.jpg', '<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.', '<b>Профилактика:&nbsp;</b><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге.&nbsp;</div><div>- удаление сорняков вокруг растения.&nbsp;</div><div>- борьба с разносчиками (муравьями)&nbsp;\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n</div>', '2018-10-03', '2018-10-03 12:50:28', '2018-10-22 07:25:38'),
(40, 0, 4, 'Тля', 'Тля', 'pest_40_photo_5bcc9f1db70eb.jpg', '<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n.', '<b>Профилактика: </b><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге. </div><div>- удаление сорняков вокруг растения. </div><div>- борьба с разносчиками (муравьями) </div>', '2018-10-03', '2018-10-03 12:50:28', '2018-10-21 12:46:01'),
(41, 0, 5, 'Тля', 'Тля', 'pest_41_photo_5bcc9e962e28d.jpg', '<p>\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n<br></p>', '<p>\r\n\r\n<b>Профилактика: </b></p><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге. </div><div>- удаление сорняков вокруг растения. </div><div>- борьба с разносчиками (муравьями) </div>\r\n\r\n<br><p></p>', '2018-10-21', '2018-10-21 12:43:18', '2018-10-21 12:44:04');

-- --------------------------------------------------------

--
-- Структура таблицы `pest_chemicals`
--

CREATE TABLE `pest_chemicals` (
  `id` int(10) UNSIGNED NOT NULL,
  `pest_id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pest_chemicals`
--

INSERT INTO `pest_chemicals` (`id`, `pest_id`, `chemical_id`, `created_at`, `updated_at`) VALUES
(10, 35, 27, '2018-09-27 12:06:53', '2018-09-27 12:06:53'),
(11, 37, 36, '2018-10-21 14:22:41', '2018-10-21 14:22:41'),
(12, 41, 36, '2018-10-21 14:22:51', '2018-10-21 14:22:51'),
(13, 40, 36, '2018-10-21 14:23:01', '2018-10-21 14:23:01');

-- --------------------------------------------------------

--
-- Структура таблицы `pest_disease_relations`
--

CREATE TABLE `pest_disease_relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pest_disease_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pest_disease_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pest_disease_relations`
--

INSERT INTO `pest_disease_relations` (`id`, `item_id`, `item_type`, `pest_disease_type`, `pest_disease_id`, `created_at`, `updated_at`) VALUES
(29, 4, 'culture', 'pest', 35, '2018-10-03 12:35:59', '2018-10-03 12:35:59');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moderator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'who add photo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `path`, `is_main`, `item_id`, `type`, `moderator`, `user_id`, `created_at`, `updated_at`) VALUES
(169, 'sort_37_photo_5b98fa4a05d61.jpg', 1, 37, 'sort', 'accepted', 0, '2018-09-12 08:36:42', '2018-10-26 07:22:00'),
(196, 'culture_52_photo_5b9f6bf321c75.jpg', 0, 52, 'culture', 'accepted', 0, '2018-09-17 05:55:15', '2018-09-19 09:00:59'),
(197, 'sad_53_photo.jpg', 0, 53, 'culture', 'accepted', 0, '2018-09-17 05:55:41', '2018-09-19 09:00:59'),
(198, 'sad_54_photo.jpg', 0, 54, 'culture', 'accepted', 0, '2018-09-17 05:56:14', '2018-09-19 09:00:59'),
(199, 'culture_1_photo_5b9f6c6fd0103.jpg', 0, 1, 'culture', 'accepted', 0, '2018-09-17 05:57:19', '2018-09-19 09:00:58'),
(200, 'sad_55_photo.jpg', 0, 55, 'culture', 'accepted', 0, '2018-09-17 05:57:45', '2018-09-19 09:00:59'),
(201, 'sad_56_photo.jpg', 0, 56, 'culture', 'accepted', 0, '2018-09-17 05:58:14', '2018-09-19 09:00:59'),
(202, 'pest_35_photo_5ba0a3e982c45.jpg', 1, 35, 'pest', 'accepted', 0, '2018-09-18 04:06:17', '2018-10-26 07:22:00'),
(203, 'disease_38_photo_5ba0a7f3d0d3d.jpg', 1, 38, 'disease', 'accepted', 0, '2018-09-18 04:23:31', '2018-10-26 07:22:00'),
(204, 'disease_38_photo_5ba0a7f3d273e.jpg', 0, 38, 'disease', 'accepted', 0, '2018-09-18 04:23:31', '2018-09-19 09:00:59'),
(206, 'chemical/chemical_27_photo_5ba390d71cdce.jpg', 1, 27, 'chemical', 'accepted', 0, '2018-09-20 09:21:43', '2018-10-26 07:22:00'),
(208, 'culture_52_photo_5ba4d8add2307.jpg', 1, 52, 'culture', 'accepted', 0, '2018-09-21 08:40:29', '2018-10-26 07:22:00'),
(209, 'culture_54_photo_5ba4d8d0e58cb.jpg', 1, 54, 'culture', 'accepted', 0, '2018-09-21 08:41:04', '2018-10-26 07:22:00'),
(210, 'culture_55_photo_5ba4d8e9c607a.jpg', 1, 55, 'culture', 'accepted', 0, '2018-09-21 08:41:29', '2018-10-26 07:22:00'),
(211, 'sad_57_photo.jpg', 1, 57, 'culture', 'accepted', 0, '2018-09-21 08:48:44', '2018-10-26 07:22:00'),
(212, 'sad_58_photo.jpg', 1, 58, 'culture', 'accepted', 0, '2018-09-21 08:49:57', '2018-10-26 07:22:00'),
(213, 'sad_59_photo.jpg', 1, 59, 'culture', 'accepted', 0, '2018-09-21 08:52:10', '2018-10-26 07:22:00'),
(214, 'sad_60_photo.jpg', 1, 60, 'culture', 'accepted', 0, '2018-09-21 08:56:36', '2018-10-26 07:22:00'),
(215, 'sad_61_photo.jpg', 1, 61, 'culture', 'accepted', 0, '2018-09-21 09:00:36', '2018-10-26 07:22:00'),
(216, 'sad_62_photo.jpg', 1, 62, 'culture', 'accepted', 0, '2018-09-21 09:02:07', '2018-10-26 07:22:00'),
(217, 'sad_63_photo.jpg', 1, 63, 'culture', 'accepted', 0, '2018-09-21 09:04:16', '2018-10-26 07:22:00'),
(218, 'sad_64_photo.jpg', 1, 64, 'culture', 'accepted', 0, '2018-09-21 09:07:36', '2018-09-21 09:07:36'),
(219, 'sad_65_photo.jpg', 1, 65, 'culture', 'accepted', 0, '2018-09-21 09:08:32', '2018-09-21 09:08:32'),
(220, 'sad_66_photo.jpg', 1, 66, 'culture', 'accepted', 0, '2018-09-21 09:11:22', '2018-09-21 09:11:22'),
(221, 'sad_67_photo.jpg', 1, 67, 'culture', 'accepted', 0, '2018-09-21 09:14:04', '2018-09-21 09:14:04'),
(222, 'sad_68_photo.jpg', 1, 68, 'culture', 'accepted', 0, '2018-09-21 09:15:11', '2018-09-21 09:15:11'),
(223, 'sad_69_photo.jpg', 1, 69, 'culture', 'accepted', 0, '2018-09-21 09:17:34', '2018-09-21 09:17:34'),
(224, 'sad_70_photo.jpg', 1, 70, 'culture', 'accepted', 0, '2018-09-21 09:19:52', '2018-09-21 09:19:52'),
(225, 'sad_71_photo.jpg', 1, 71, 'culture', 'accepted', 0, '2018-09-21 09:21:45', '2018-09-21 09:21:45'),
(226, 'sad_72_photo.png', 1, 72, 'culture', 'accepted', 0, '2018-09-21 09:24:26', '2018-09-21 09:24:26'),
(228, 'sad_74_photo.jpg', 1, 74, 'culture', 'accepted', 0, '2018-09-21 09:24:48', '2018-09-21 09:24:48'),
(229, 'culture_55_photo_5ba4ea775e82f.jpg', 1, 55, 'culture', 'accepted', 0, '2018-09-21 09:56:23', '2018-09-21 09:56:23'),
(230, 'sad_75_photo.jpg', 1, 75, 'culture', 'accepted', 0, '2018-09-21 09:59:11', '2018-09-21 09:59:11'),
(231, 'sad_76_photo.jpg', 1, 76, 'culture', 'accepted', 0, '2018-09-21 10:01:08', '2018-09-21 10:01:08'),
(232, 'culture_77_photo_5ba4ec00c80e4.jpg', 1, 77, 'culture', 'accepted', 0, '2018-09-21 10:02:56', '2018-09-21 10:02:56'),
(233, 'sad_78_photo.jpg', 1, 78, 'culture', 'accepted', 0, '2018-09-21 10:23:55', '2018-09-21 10:23:55'),
(234, 'sad_79_photo.jpg', 1, 79, 'culture', 'accepted', 0, '2018-09-21 10:25:14', '2018-09-21 10:25:14'),
(235, 'sad_80_photo.jpg', 1, 80, 'culture', 'accepted', 0, '2018-09-21 10:27:42', '2018-09-21 10:27:42'),
(236, 'sad_81_photo.jpg', 1, 81, 'culture', 'accepted', 0, '2018-09-21 10:32:14', '2018-09-21 10:32:14'),
(237, 'sad_82_photo.jpg', 1, 82, 'culture', 'accepted', 0, '2018-09-21 10:36:16', '2018-09-21 10:36:16'),
(238, 'sad_83_photo.jpg', 1, 83, 'culture', 'accepted', 0, '2018-09-21 10:37:35', '2018-09-21 10:37:35'),
(239, 'sad_84_photo.jpg', 1, 84, 'culture', 'accepted', 0, '2018-09-21 10:38:24', '2018-09-21 10:38:24'),
(240, 'sad_85_photo.jpg', 1, 85, 'culture', 'accepted', 0, '2018-09-21 10:39:59', '2018-09-21 10:39:59'),
(241, 'culture_75_photo_5ba4f5001f2e7.jpg', 1, 75, 'culture', 'accepted', 0, '2018-09-21 10:41:20', '2018-09-21 10:41:20'),
(242, 'sad_86_photo.jpg', 1, 86, 'culture', 'accepted', 0, '2018-09-21 10:43:08', '2018-09-21 10:43:08'),
(243, 'sad_87_photo.jpg', 1, 87, 'culture', 'accepted', 0, '2018-09-21 10:44:21', '2018-09-21 10:44:21'),
(244, 'sad_88_photo.jpg', 1, 88, 'culture', 'accepted', 0, '2018-09-21 10:45:27', '2018-09-21 10:45:27'),
(245, 'sad_89_photo.jpg', 1, 89, 'culture', 'accepted', 0, '2018-09-21 10:46:32', '2018-09-21 10:46:32'),
(246, 'sad_90_photo.jpg', 1, 90, 'culture', 'accepted', 0, '2018-09-21 10:48:22', '2018-09-21 10:48:22'),
(247, 'sad_91_photo.jpg', 1, 91, 'culture', 'accepted', 0, '2018-09-21 10:52:22', '2018-09-21 10:52:22'),
(248, 'sad_92_photo.jpg', 1, 92, 'culture', 'accepted', 0, '2018-09-21 10:56:33', '2018-09-21 10:56:33'),
(249, 'ogorod_93_photo.jpg', 1, 93, 'culture', 'accepted', 0, '2018-09-21 10:59:23', '2018-09-21 10:59:23'),
(250, 'ogorod_94_photo.jpg', 1, 94, 'culture', 'accepted', 0, '2018-09-22 06:09:23', '2018-09-22 06:09:23'),
(251, 'ogorod_95_photo.jpg', 1, 95, 'culture', 'accepted', 0, '2018-09-22 06:12:03', '2018-09-22 06:12:03'),
(252, 'ogorod_96_photo.jpg', 1, 96, 'culture', 'accepted', 0, '2018-09-22 06:20:30', '2018-09-22 06:20:30'),
(253, 'ogorod_97_photo.jpg', 1, 97, 'culture', 'accepted', 0, '2018-09-22 06:22:42', '2018-09-22 06:22:42'),
(254, 'ogorod_98_photo.jpg', 1, 98, 'culture', 'accepted', 0, '2018-09-22 06:25:50', '2018-09-22 06:25:50'),
(255, 'ogorod_99_photo.jpg', 1, 99, 'culture', 'accepted', 0, '2018-09-22 06:26:15', '2018-09-22 06:26:15'),
(256, 'ogorod_100_photo.jpg', 1, 100, 'culture', 'accepted', 0, '2018-09-22 06:31:26', '2018-09-22 06:31:26'),
(257, 'ogorod_101_photo.jpg', 1, 101, 'culture', 'accepted', 0, '2018-09-22 06:31:44', '2018-09-22 06:31:44'),
(258, 'ogorod_102_photo.jpg', 1, 102, 'culture', 'accepted', 0, '2018-09-22 06:32:08', '2018-09-22 06:32:08'),
(259, 'ogorod_103_photo.jpg', 1, 103, 'culture', 'accepted', 0, '2018-09-22 06:45:55', '2018-09-22 06:45:55'),
(260, 'ogorod_104_photo.jpg', 1, 104, 'culture', 'accepted', 0, '2018-09-22 06:46:23', '2018-09-22 06:46:23'),
(261, 'ogorod_105_photo.png', 1, 105, 'culture', 'accepted', 0, '2018-09-22 06:46:35', '2018-09-22 06:46:35'),
(262, 'ogorod_106_photo.jpg', 1, 106, 'culture', 'accepted', 0, '2018-09-22 06:46:50', '2018-09-22 06:46:50'),
(263, 'ogorod_107_photo.jpg', 1, 107, 'culture', 'accepted', 0, '2018-09-22 06:47:27', '2018-09-22 06:47:27'),
(264, 'ogorod_108_photo.jpg', 1, 108, 'culture', 'accepted', 0, '2018-09-22 06:47:44', '2018-09-22 06:47:44'),
(265, 'ogorod_109_photo.jpg', 1, 109, 'culture', 'accepted', 0, '2018-09-22 06:48:11', '2018-09-22 06:48:11'),
(266, 'ogorod_110_photo.jpg', 1, 110, 'culture', 'accepted', 0, '2018-09-22 06:53:43', '2018-09-22 06:53:43'),
(267, 'ogorod_111_photo.jpg', 1, 111, 'culture', 'accepted', 0, '2018-09-22 06:55:00', '2018-09-22 06:55:00'),
(268, 'ogorod_112_photo.jpg', 1, 112, 'culture', 'accepted', 0, '2018-09-22 06:55:28', '2018-09-22 06:55:28'),
(269, 'ogorod_113_photo.jpg', 1, 113, 'culture', 'accepted', 0, '2018-09-22 06:56:46', '2018-09-22 06:56:46'),
(270, 'ogorod_114_photo.jpg', 1, 114, 'culture', 'accepted', 0, '2018-09-22 07:03:26', '2018-09-22 07:03:26'),
(271, 'ogorod_115_photo.jpg', 1, 115, 'culture', 'accepted', 0, '2018-09-22 07:03:40', '2018-09-22 07:03:40'),
(272, 'ogorod_116_photo.jpg', 1, 116, 'culture', 'accepted', 0, '2018-09-22 07:03:51', '2018-09-22 07:03:51'),
(273, 'ogorod_117_photo.jpg', 1, 117, 'culture', 'accepted', 0, '2018-09-22 07:04:03', '2018-09-22 07:04:03'),
(274, 'ogorod_118_photo.jpg', 1, 118, 'culture', 'accepted', 0, '2018-09-22 07:04:13', '2018-09-22 07:04:13'),
(275, 'ogorod_119_photo.jpg', 1, 119, 'culture', 'accepted', 0, '2018-09-22 07:04:34', '2018-09-22 07:04:34'),
(276, 'ogorod_120_photo.jpg', 1, 120, 'culture', 'accepted', 0, '2018-09-22 07:04:44', '2018-09-22 07:04:44'),
(277, 'ogorod_121_photo.jpg', 1, 121, 'culture', 'accepted', 0, '2018-09-22 07:05:01', '2018-09-22 07:05:01'),
(278, 'ogorod_122_photo.jpg', 1, 122, 'culture', 'accepted', 0, '2018-09-22 07:10:41', '2018-09-22 07:10:41'),
(279, 'ogorod_123_photo.png', 1, 123, 'culture', 'accepted', 0, '2018-09-22 07:10:55', '2018-09-22 07:10:55'),
(280, 'ogorod_124_photo.jpg', 1, 124, 'culture', 'accepted', 0, '2018-09-22 07:11:31', '2018-09-22 07:11:31'),
(281, 'ogorod_125_photo.jpg', 1, 125, 'culture', 'accepted', 0, '2018-09-22 07:11:45', '2018-09-22 07:11:45'),
(282, 'ogorod_126_photo.jpg', 1, 126, 'culture', 'accepted', 0, '2018-09-22 07:11:59', '2018-09-22 07:11:59'),
(283, 'ogorod_127_photo.jpg', 1, 127, 'culture', 'accepted', 0, '2018-09-22 07:12:36', '2018-09-22 07:12:36'),
(284, 'ogorod_128_photo.jpg', 1, 128, 'culture', 'accepted', 0, '2018-09-22 07:21:39', '2018-09-22 07:21:39'),
(285, 'ogorod_129_photo.jpeg', 1, 129, 'culture', 'accepted', 0, '2018-09-22 07:21:52', '2018-09-22 07:21:52'),
(286, 'ogorod_130_photo.jpg', 1, 130, 'culture', 'accepted', 0, '2018-09-22 07:22:08', '2018-09-22 07:22:08'),
(287, 'ogorod_131_photo.jpg', 1, 131, 'culture', 'accepted', 0, '2018-09-22 07:22:24', '2018-09-22 07:22:24'),
(288, 'ogorod_132_photo.jpg', 1, 132, 'culture', 'accepted', 0, '2018-09-22 07:22:41', '2018-09-22 07:22:41'),
(289, 'ogorod_133_photo.jpg', 1, 133, 'culture', 'accepted', 0, '2018-09-22 07:22:57', '2018-09-22 07:22:57'),
(290, 'ogorod_134_photo.png', 1, 134, 'culture', 'accepted', 0, '2018-09-22 07:23:10', '2018-09-22 07:23:10'),
(291, 'ogorod_135_photo.jpg', 1, 135, 'culture', 'accepted', 0, '2018-09-22 07:23:21', '2018-09-22 07:23:21'),
(292, 'ogorod_136_photo.jpeg', 1, 136, 'culture', 'accepted', 0, '2018-09-22 07:29:54', '2018-09-22 07:29:54'),
(293, 'ogorod_137_photo.gif', 1, 137, 'culture', 'accepted', 0, '2018-09-22 07:30:09', '2018-09-22 07:30:09'),
(294, 'ogorod_138_photo.png', 1, 138, 'culture', 'accepted', 0, '2018-09-22 07:30:25', '2018-09-22 07:30:25'),
(295, 'ogorod_139_photo.jpg', 1, 139, 'culture', 'accepted', 0, '2018-09-22 07:30:50', '2018-09-22 07:30:50'),
(296, 'ogorod_140_photo.jpg', 1, 140, 'culture', 'accepted', 0, '2018-09-22 07:31:08', '2018-09-22 07:31:08'),
(297, 'ogorod_141_photo.jpg', 1, 141, 'culture', 'accepted', 0, '2018-09-22 07:31:23', '2018-09-22 07:31:23'),
(298, 'culture_136_photo_5ba61a2ae1563.jpg', 1, 136, 'culture', 'accepted', 0, '2018-09-22 07:32:10', '2018-09-22 07:32:10'),
(299, 'ogorod_142_photo.jpeg', 1, 142, 'culture', 'accepted', 0, '2018-09-22 07:32:49', '2018-09-22 07:32:49'),
(300, 'ogorod_143_photo.png', 1, 143, 'culture', 'accepted', 0, '2018-09-22 07:46:55', '2018-09-22 07:46:55'),
(301, 'ogorod_144_photo.jpeg', 1, 144, 'culture', 'accepted', 0, '2018-09-22 07:47:10', '2018-09-22 07:47:10'),
(302, 'ogorod_145_photo.jpg', 1, 145, 'culture', 'accepted', 0, '2018-09-22 07:47:24', '2018-09-22 07:47:24'),
(303, 'ogorod_146_photo.jpg', 1, 146, 'culture', 'accepted', 0, '2018-09-22 07:47:37', '2018-09-22 07:47:37'),
(304, 'ogorod_147_photo.jpg', 1, 147, 'culture', 'accepted', 0, '2018-09-22 07:47:51', '2018-09-22 07:47:51'),
(305, 'ogorod_148_photo.jpg', 1, 148, 'culture', 'accepted', 0, '2018-09-22 07:48:06', '2018-09-22 07:48:06'),
(306, 'ogorod_149_photo.jpg', 1, 149, 'culture', 'accepted', 0, '2018-09-22 07:51:25', '2018-09-22 07:51:25'),
(307, 'ogorod_150_photo.jpg', 1, 150, 'culture', 'accepted', 0, '2018-09-22 07:51:36', '2018-09-22 07:51:36'),
(308, 'ogorod_151_photo.jpg', 1, 151, 'culture', 'accepted', 0, '2018-09-22 07:51:51', '2018-09-22 07:51:51'),
(309, 'ogorod_152_photo.jpg', 1, 152, 'culture', 'accepted', 0, '2018-09-22 07:52:04', '2018-09-22 07:52:04'),
(310, 'ogorod_153_photo.jpg', 1, 153, 'culture', 'accepted', 0, '2018-09-22 07:52:23', '2018-09-22 07:52:23'),
(311, 'ogorod_154_photo.jpeg', 1, 154, 'culture', 'accepted', 0, '2018-09-22 12:39:20', '2018-09-22 12:39:20'),
(312, 'culture_155_photo_5ba6633b92fd1.jpg', 1, 155, 'culture', 'accepted', 0, '2018-09-22 12:43:55', '2018-09-22 12:43:55'),
(313, 'klumba_156_photo.jpg', 1, 156, 'culture', 'accepted', 0, '2018-09-22 12:46:20', '2018-09-22 12:46:20'),
(314, 'klumba_157_photo.jpg', 1, 157, 'culture', 'accepted', 0, '2018-09-22 12:49:00', '2018-09-22 12:49:00'),
(315, 'klumba_158_photo.jpg', 1, 158, 'culture', 'accepted', 0, '2018-09-22 12:50:34', '2018-09-22 12:50:34'),
(316, 'klumba_159_photo.jpg', 1, 159, 'culture', 'accepted', 0, '2018-09-22 12:53:40', '2018-09-22 12:53:40'),
(317, 'klumba_160_photo.jpg', 1, 160, 'culture', 'accepted', 0, '2018-09-22 12:55:05', '2018-09-22 12:55:05'),
(318, 'klumba_161_photo.jpg', 1, 161, 'culture', 'accepted', 0, '2018-09-22 12:56:08', '2018-09-22 12:56:08'),
(319, 'klumba_162_photo.jpg', 1, 162, 'culture', 'accepted', 0, '2018-09-22 12:57:04', '2018-09-22 12:57:04'),
(320, 'klumba_163_photo.jpg', 1, 163, 'culture', 'accepted', 0, '2018-09-22 12:59:25', '2018-09-22 12:59:25'),
(321, 'klumba_164_photo.jpg', 1, 164, 'culture', 'accepted', 0, '2018-09-22 13:01:05', '2018-09-22 13:01:05'),
(322, 'klumba_165_photo.jpg', 1, 165, 'culture', 'accepted', 0, '2018-09-22 15:24:51', '2018-09-22 15:24:51'),
(323, 'klumba_166_photo.jpg', 1, 166, 'culture', 'accepted', 0, '2018-09-22 15:26:21', '2018-09-22 15:26:21'),
(324, 'klumba_167_photo.jpg', 1, 167, 'culture', 'accepted', 0, '2018-09-22 15:28:14', '2018-09-22 15:28:14'),
(325, 'klumba_168_photo.jpg', 1, 168, 'culture', 'accepted', 0, '2018-09-22 15:29:46', '2018-09-22 15:29:46'),
(326, 'klumba_169_photo.jpg', 1, 169, 'culture', 'accepted', 0, '2018-09-22 15:30:39', '2018-09-22 15:30:39'),
(327, 'klumba_170_photo.jpg', 1, 170, 'culture', 'accepted', 0, '2018-09-22 15:31:29', '2018-09-22 15:31:29'),
(328, 'klumba_171_photo.jpg', 1, 171, 'culture', 'accepted', 0, '2018-09-22 15:32:52', '2018-09-22 15:32:52'),
(329, 'klumba_172_photo.jpg', 1, 172, 'culture', 'accepted', 0, '2018-09-22 15:34:28', '2018-09-22 15:34:28'),
(330, 'klumba_173_photo.jpg', 1, 173, 'culture', 'accepted', 0, '2018-09-22 15:36:09', '2018-09-22 15:36:09'),
(331, 'klumba_174_photo.jpg', 1, 174, 'culture', 'accepted', 0, '2018-09-22 15:38:01', '2018-09-22 15:38:01'),
(332, 'klumba_175_photo.jpg', 1, 175, 'culture', 'accepted', 0, '2018-09-22 15:40:13', '2018-09-22 15:40:13'),
(333, 'klumba_176_photo.jpg', 1, 176, 'culture', 'accepted', 0, '2018-09-22 15:41:53', '2018-09-22 15:41:53'),
(334, 'klumba_177_photo.jpg', 1, 177, 'culture', 'accepted', 0, '2018-09-22 15:44:25', '2018-09-22 15:44:25'),
(335, 'klumba_178_photo.jpg', 1, 178, 'culture', 'accepted', 0, '2018-09-22 15:46:06', '2018-09-22 15:46:06'),
(336, 'klumba_179_photo.jpg', 1, 179, 'culture', 'accepted', 0, '2018-09-22 15:46:59', '2018-09-22 15:46:59'),
(337, 'klumba_180_photo.jpg', 1, 180, 'culture', 'accepted', 0, '2018-09-22 15:48:12', '2018-09-22 15:48:12'),
(338, 'klumba_181_photo.jpg', 1, 181, 'culture', 'accepted', 0, '2018-09-22 15:49:32', '2018-09-22 15:49:32'),
(339, 'klumba_182_photo.jpg', 1, 182, 'culture', 'accepted', 0, '2018-09-22 15:51:36', '2018-09-22 15:51:36'),
(340, 'klumba_183_photo.jpg', 1, 183, 'culture', 'accepted', 0, '2018-09-22 15:52:57', '2018-09-22 15:52:57'),
(341, 'klumba_184_photo.jpg', 1, 184, 'culture', 'accepted', 0, '2018-09-22 15:53:57', '2018-09-22 15:53:57'),
(342, 'klumba_185_photo.jpg', 1, 185, 'culture', 'accepted', 0, '2018-09-22 15:54:57', '2018-09-22 15:54:57'),
(343, 'klumba_186_photo.jpg', 1, 186, 'culture', 'accepted', 0, '2018-09-22 15:57:30', '2018-09-22 15:57:30'),
(344, 'klumba_187_photo.jpg', 1, 187, 'culture', 'accepted', 0, '2018-09-22 15:58:59', '2018-09-22 15:58:59'),
(345, 'klumba_188_photo.jpg', 1, 188, 'culture', 'accepted', 0, '2018-09-22 16:01:26', '2018-09-22 16:01:26'),
(346, 'klumba_189_photo.jpg', 1, 189, 'culture', 'accepted', 0, '2018-09-22 16:02:40', '2018-09-22 16:02:40'),
(347, 'klumba_190_photo.jpg', 1, 190, 'culture', 'accepted', 0, '2018-09-22 16:04:05', '2018-09-22 16:04:05'),
(348, 'klumba_191_photo.jpg', 1, 191, 'culture', 'accepted', 0, '2018-09-22 16:05:39', '2018-09-22 16:05:39'),
(349, 'klumba_192_photo.jpg', 1, 192, 'culture', 'accepted', 0, '2018-09-22 16:07:11', '2018-09-22 16:07:11'),
(350, 'klumba_193_photo.jpg', 1, 193, 'culture', 'accepted', 0, '2018-09-22 16:08:07', '2018-09-22 16:08:07'),
(351, 'klumba_194_photo.jpg', 1, 194, 'culture', 'accepted', 0, '2018-09-22 16:09:27', '2018-09-22 16:09:27'),
(352, 'klumba_195_photo.jpg', 1, 195, 'culture', 'accepted', 0, '2018-09-22 16:18:19', '2018-09-22 16:18:19'),
(353, 'klumba_196_photo.jpg', 1, 196, 'culture', 'accepted', 0, '2018-09-22 16:19:25', '2018-09-22 16:19:25'),
(354, 'klumba_197_photo.jpg', 1, 197, 'culture', 'accepted', 0, '2018-09-22 16:22:22', '2018-09-22 16:22:22'),
(355, 'klumba_198_photo.jpg', 1, 198, 'culture', 'accepted', 0, '2018-09-22 16:24:28', '2018-09-22 16:24:28'),
(356, 'klumba_199_photo.jpg', 1, 199, 'culture', 'accepted', 0, '2018-09-22 16:27:06', '2018-09-22 16:27:06'),
(357, 'klumba_200_photo.jpg', 1, 200, 'culture', 'accepted', 0, '2018-09-22 16:29:59', '2018-09-22 16:29:59'),
(358, 'klumba_201_photo.jpg', 1, 201, 'culture', 'accepted', 0, '2018-09-22 16:31:48', '2018-09-22 16:31:48'),
(359, 'klumba_202_photo.jpg', 1, 202, 'culture', 'accepted', 0, '2018-09-22 16:33:19', '2018-09-22 16:33:19'),
(360, 'klumba_203_photo.jpg', 1, 203, 'culture', 'accepted', 0, '2018-09-22 16:33:55', '2018-09-22 16:33:55'),
(361, 'klumba_204_photo.jpg', 1, 204, 'culture', 'accepted', 0, '2018-09-22 16:36:45', '2018-09-22 16:36:45'),
(362, 'klumba_205_photo.jpg', 1, 205, 'culture', 'accepted', 0, '2018-09-22 16:38:39', '2018-09-22 16:38:39'),
(363, 'klumba_206_photo.jpg', 1, 206, 'culture', 'accepted', 0, '2018-09-22 16:41:40', '2018-09-22 16:41:40'),
(364, 'klumba_207_photo.jpg', 1, 207, 'culture', 'accepted', 0, '2018-09-22 16:43:03', '2018-09-22 16:43:03'),
(365, 'klumba_208_photo.jpg', 1, 208, 'culture', 'accepted', 0, '2018-09-22 16:44:47', '2018-09-22 16:44:47'),
(366, 'klumba_209_photo.jpg', 1, 209, 'culture', 'accepted', 0, '2018-09-22 16:45:45', '2018-09-22 16:45:45'),
(367, 'culture_77_photo_5ba8701281c0b.jpg', 1, 77, 'culture', 'accepted', 0, '2018-09-24 02:03:14', '2018-09-24 02:03:14'),
(368, 'culture_70_photo_5ba878bbd05f6.jpg', 1, 70, 'culture', 'accepted', 0, '2018-09-24 02:40:11', '2018-09-24 02:40:11'),
(369, 'culture_81_photo_5ba879397ed90.jpg', 1, 81, 'culture', 'accepted', 0, '2018-09-24 02:42:17', '2018-09-24 02:42:17'),
(370, 'culture_85_photo_5ba879c3d2ade.jpg', 1, 85, 'culture', 'accepted', 0, '2018-09-24 02:44:35', '2018-09-24 02:44:35'),
(371, 'culture_90_photo_5ba879d1927e8.jpg', 1, 90, 'culture', 'accepted', 0, '2018-09-24 02:44:49', '2018-09-24 02:44:49'),
(372, 'culture_54_photo_5ba87acc931e9.jpg', 1, 54, 'culture', 'accepted', 0, '2018-09-24 02:49:00', '2018-09-24 02:49:00'),
(373, 'culture_158_photo_5ba88cea4a3c9.jpg', 1, 158, 'culture', 'accepted', 0, '2018-09-24 04:06:18', '2018-09-24 04:06:18'),
(374, 'culture_158_photo_5ba88d124af73.jpg', 1, 158, 'culture', 'accepted', 0, '2018-09-24 04:06:58', '2018-09-24 04:06:58'),
(375, 'culture_62_photo_5ba8bfd5180b1.jpg', 1, 62, 'culture', 'accepted', 0, '2018-09-24 07:43:33', '2018-09-24 07:43:33'),
(376, 'culture_87_photo_5ba8c37509dec.jpg', 1, 87, 'culture', 'accepted', 0, '2018-09-24 07:59:01', '2018-09-24 07:59:01'),
(377, 'culture_91_photo_5ba8c414d40c0.jpg', 1, 91, 'culture', 'accepted', 0, '2018-09-24 08:01:40', '2018-09-24 08:01:40'),
(378, 'culture_116_photo_5ba8c611bea28.jpg', 1, 116, 'culture', 'accepted', 0, '2018-09-24 08:10:09', '2018-09-24 08:10:09'),
(379, 'culture_116_photo_5ba8c6aa356f1.jpg', 1, 116, 'culture', 'accepted', 0, '2018-09-24 08:12:42', '2018-09-24 08:12:42'),
(380, 'culture_154_photo_5ba8c6daa775f.jpeg', 1, 154, 'culture', 'accepted', 0, '2018-09-24 08:13:30', '2018-09-24 08:13:30'),
(381, 'klumba_210_photo.jpg', 1, 210, 'culture', 'accepted', 0, '2018-09-24 08:27:08', '2018-09-24 08:27:08'),
(382, 'culture_65_photo_5ba8cec546e4b.jpg', 1, 65, 'culture', 'accepted', 0, '2018-09-24 08:47:17', '2018-09-24 08:47:17'),
(384, 'culture_165_photo_5bab241c3d3b6.jpg', 1, 165, 'culture', 'accepted', 0, '2018-09-26 03:15:56', '2018-09-26 03:15:56'),
(385, 'culture_58_photo_5bab6a12ab65c.jpg', 1, 58, 'culture', 'accepted', 0, '2018-09-26 08:14:26', '2018-09-26 08:14:26'),
(393, 'chemical/chemical_28_photo_5badc15e5d8cd.png', 1, 28, 'chemical', 'accepted', 0, '2018-09-28 02:51:26', '2018-10-15 07:38:52'),
(394, 'chemical/chemical_28_photo_5badc15e604ca.jpg', 0, 28, 'chemical', 'accepted', 0, '2018-09-28 02:51:26', '2018-09-28 02:51:26'),
(405, 'sort_47_photo_5bb35bbcd2861.jpg', 1, 47, 'sort', 'accepted', 0, '2018-10-02 08:51:24', '2018-10-18 15:07:53'),
(406, 'sort_48_photo_5bb3651d23c4c.jpg', 1, 48, 'sort', 'accepted', 0, '2018-10-02 09:31:25', '2018-10-03 05:46:28'),
(407, 'sort_49_photo_5bb37398b436a.jpg', 1, 49, 'sort', 'accepted', 0, '2018-10-02 10:33:12', '2018-10-03 05:48:38'),
(408, 'sort_50_photo_5bb378ee3d6da.jpg', 1, 50, 'sort', 'accepted', 0, '2018-10-02 10:55:58', '2018-10-03 05:49:26'),
(410, 'sort_49_photo_5bb4580be1698.jpg', 0, 49, 'sort', 'accepted', 0, '2018-10-03 02:47:55', '2018-10-03 02:47:55'),
(411, 'sort_51_photo_5bb45e1b3b5d7.jpg', 1, 51, 'sort', 'accepted', 0, '2018-10-03 03:13:47', '2018-10-03 05:49:47'),
(412, 'sort_52_photo_5bb4663b22f33.jpg', 0, 52, 'sort', 'accepted', 0, '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(413, 'sort_52_photo_5bb4663b241d9.jpg', 1, 52, 'sort', 'accepted', 0, '2018-10-03 03:48:27', '2018-10-03 05:50:19'),
(417, 'sort_53_photo_5bb47feebe507.jpg', 1, 53, 'sort', 'accepted', 0, '2018-10-03 05:38:06', '2018-10-03 05:38:32'),
(418, 'sort_53_photo_5bb47feec0599.jpg', 0, 53, 'sort', 'accepted', 0, '2018-10-03 05:38:06', '2018-10-03 05:38:06'),
(425, 'culture/culture_1_photo_5bb4a34a40840.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:08:58', '2018-10-03 08:08:58'),
(426, 'culture/culture_1_photo_5bb4a3fd0426f.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:11:57', '2018-10-03 08:11:57'),
(427, 'culture/culture_1_photo_5bb4a407d754f.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:12:07', '2018-10-03 08:12:07'),
(428, 'culture/culture_1_photo_5bb4a45a59635.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:13:30', '2018-10-03 08:13:30'),
(429, 'culture/culture_1_photo_5bb4a4692b310.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:13:45', '2018-10-03 08:13:45'),
(430, 'culture/culture_1_photo_5bb4a4856dfe3.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:14:13', '2018-10-03 08:14:13'),
(431, 'culture/culture_1_photo_5bb4a490060d4.jpg', 1, 1, 'culture', 'accepted', 0, '2018-10-03 08:14:24', '2018-10-03 08:14:24'),
(453, 'pest_37_photo_5bb4e544b662c.jpg', 0, 37, 'pest', 'accepted', 0, '2018-10-03 12:50:28', '2018-10-03 12:50:35'),
(454, 'pest_37_photo_5bb4e544b8d43.jpg', 1, 37, 'pest', 'accepted', 0, '2018-10-03 12:50:28', '2018-10-22 07:25:38'),
(455, 'sort/sort_61_photo_5bb5bcb8a1576.jpg', 1, 61, 'sort', 'accepted', 0, '2018-10-04 04:09:44', '2018-10-04 04:10:12'),
(463, 'handbook_35_photo.jpg', 1, 35, 'handbook', 'accepted', 0, '2018-10-08 05:37:56', '2018-10-08 06:24:14'),
(466, 'handbook_36_photo_5bbb318f92981.jpg', 1, 36, 'handbook', 'accepted', 0, '2018-10-08 07:29:35', '2018-10-08 07:29:43'),
(467, 'handbook_36_photo_5bbb318f93da3.jpg', 0, 36, 'handbook', 'accepted', 0, '2018-10-08 07:29:35', '2018-10-08 07:29:35'),
(469, 'handbook_39_photo.jpg', 1, 39, 'handbook', 'accepted', 0, '2018-10-12 11:10:18', '2018-10-12 11:10:18'),
(472, 'pest/pest35_photo_5bc4ce4d9d352.jpg', 0, 35, 'pest', 'new', 23, '2018-10-15 14:28:45', '2018-10-15 14:28:45'),
(478, 'handbook_41_photo_5bc72ba91ddf3.jpg', 1, 41, 'handbook', 'accepted', 0, '2018-10-17 09:31:37', '2018-10-17 09:32:22'),
(479, 'pest/pest35_photo_5bc851a9c0f26.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:26:01', '2018-10-18 06:26:01'),
(480, 'pest/pest35_photo_5bc851bb2da05.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:26:19', '2018-10-18 06:26:19'),
(481, 'pest/pest35_photo_5bc8526a9d287.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:29:14', '2018-10-18 06:29:14'),
(482, 'pest/pest35_photo_5bc852ece8963.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:31:24', '2018-10-18 06:31:24'),
(483, 'pest/pest35_photo_5bc853273cc3b.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:32:23', '2018-10-18 06:32:23'),
(484, 'pest/pest35_photo_5bc853601bc51.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:33:20', '2018-10-18 06:33:20'),
(485, 'pest/pest35_photo_5bc854327056a.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:36:50', '2018-10-18 06:36:50'),
(486, 'pest/pest35_photo_5bc8548094c6a.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:38:08', '2018-10-18 06:38:08'),
(487, 'pest/pest35_photo_5bc854abeceb8.png', 0, 35, 'pest', 'new', 23, '2018-10-18 06:38:51', '2018-10-18 06:38:51'),
(492, 'chemical/chemical_35_photo_5bc8c4328433f.jpg', 1, 35, 'chemical', 'accepted', 0, '2018-10-18 14:34:42', '2018-10-18 15:04:00'),
(493, 'culture/culture_55_photo_5bc97c029f743.jpg', 1, 55, 'culture', 'accepted', 0, '2018-10-19 03:38:58', '2018-10-19 03:38:58'),
(494, 'culture/culture_59_photo_5bc97c12b5d41.jpg', 1, 59, 'culture', 'accepted', 0, '2018-10-19 03:39:14', '2018-10-19 03:39:14'),
(495, 'culture/culture_61_photo_5bc97c22249bc.jpg', 1, 61, 'culture', 'accepted', 0, '2018-10-19 03:39:30', '2018-10-19 03:39:30'),
(496, 'culture/culture_69_photo_5bc97c9b68295.png', 1, 69, 'culture', 'accepted', 0, '2018-10-19 03:41:31', '2018-10-19 03:41:31'),
(497, 'event_3_photo_5bc98f2d6b811.jpg', 1, 3, 'event', 'accepted', 0, '2018-10-19 05:00:45', '2018-10-19 05:00:45'),
(499, 'event_42_photo_5bc9afa1970e0.jpg', 1, 42, 'event', 'accepted', 0, '2018-10-19 07:19:13', '2018-10-19 07:19:13'),
(501, 'event_44_photo_5bc9aff10268e.jpg', 1, 44, 'event', 'accepted', 0, '2018-10-19 07:20:33', '2018-10-19 07:20:33'),
(502, 'event_45_photo_5bc9b007967fa.jpg', 1, 45, 'event', 'accepted', 0, '2018-10-19 07:20:55', '2018-10-19 07:20:55'),
(503, 'event_46_photo_5bc9b01e6527c.jpg', 1, 46, 'event', 'accepted', 0, '2018-10-19 07:21:18', '2018-10-19 07:21:18'),
(504, 'event_47_photo_5bc9b02eaa315.jpg', 1, 47, 'event', 'accepted', 0, '2018-10-19 07:21:34', '2018-10-19 07:21:34'),
(505, 'event_48_photo_5bc9b03d2a734.jpg', 1, 48, 'event', 'accepted', 0, '2018-10-19 07:21:49', '2018-10-19 07:21:49'),
(506, 'event_49_photo_5bc9b053584e8.jpg', 1, 49, 'event', 'accepted', 0, '2018-10-19 07:22:11', '2018-10-19 07:22:11'),
(507, 'culture/culture_98_photo_5bcc9b6be585c.jpg', 1, 98, 'culture', 'accepted', 0, '2018-10-21 12:29:47', '2018-10-21 12:29:47'),
(508, 'culture/culture_100_photo_5bcc9b77176b3.jpg', 1, 100, 'culture', 'accepted', 0, '2018-10-21 12:29:59', '2018-10-21 12:29:59'),
(509, 'culture/culture_101_photo_5bcc9b8534cdc.jpg', 1, 101, 'culture', 'accepted', 0, '2018-10-21 12:30:13', '2018-10-21 12:30:13'),
(510, 'culture/culture_103_photo_5bcc9b9cb17b4.jpg', 1, 103, 'culture', 'accepted', 0, '2018-10-21 12:30:36', '2018-10-21 12:30:36'),
(511, 'culture/culture_107_photo_5bcc9bb14fa42.jpg', 1, 107, 'culture', 'accepted', 0, '2018-10-21 12:30:57', '2018-10-21 12:30:57'),
(512, 'culture/culture_110_photo_5bcc9bbb60313.jpg', 1, 110, 'culture', 'accepted', 0, '2018-10-21 12:31:07', '2018-10-21 12:31:07'),
(513, 'culture/culture_111_photo_5bcc9bce42646.jpg', 1, 111, 'culture', 'accepted', 0, '2018-10-21 12:31:26', '2018-10-21 12:31:26'),
(514, 'culture/culture_114_photo_5bcc9be26fd0b.jpg', 1, 114, 'culture', 'accepted', 0, '2018-10-21 12:31:46', '2018-10-21 12:31:46'),
(515, 'culture/culture_117_photo_5bcc9bec658a7.jpg', 1, 117, 'culture', 'accepted', 0, '2018-10-21 12:31:56', '2018-10-21 12:31:56'),
(516, 'culture/culture_122_photo_5bcc9bfa1b6f3.jpg', 1, 122, 'culture', 'accepted', 0, '2018-10-21 12:32:10', '2018-10-21 12:32:10'),
(517, 'culture/culture_129_photo_5bcc9c06319bb.jpeg', 1, 129, 'culture', 'accepted', 0, '2018-10-21 12:32:22', '2018-10-21 12:32:22'),
(518, 'culture/culture_128_photo_5bcc9c1898d42.jpg', 0, 128, 'culture', 'accepted', 0, '2018-10-21 12:32:40', '2018-10-26 07:22:01'),
(519, 'culture/culture_126_photo_5bcc9c2c1e8cc.jpg', 0, 126, 'culture', 'accepted', 0, '2018-10-21 12:33:00', '2018-10-26 07:22:01'),
(520, 'culture/culture_131_photo_5bcc9c3851207.jpg', 0, 131, 'culture', 'accepted', 0, '2018-10-21 12:33:12', '2018-10-26 07:22:01'),
(521, 'culture/culture_132_photo_5bcc9c41dd5e5.jpg', 0, 132, 'culture', 'accepted', 0, '2018-10-21 12:33:21', '2018-10-26 07:22:01'),
(522, 'culture/culture_141_photo_5bcc9c50c093b.jpg', 0, 141, 'culture', 'accepted', 0, '2018-10-21 12:33:36', '2018-10-26 07:22:01'),
(523, 'culture/culture_134_photo_5bcc9c61ed8da.png', 0, 134, 'culture', 'accepted', 0, '2018-10-21 12:33:53', '2018-10-26 07:22:01'),
(524, 'culture/culture_149_photo_5bcc9c70242cb.jpg', 0, 149, 'culture', 'accepted', 0, '2018-10-21 12:34:08', '2018-10-26 07:22:01'),
(525, 'culture/culture_144_photo_5bcc9c77ac3f5.jpeg', 0, 144, 'culture', 'accepted', 0, '2018-10-21 12:34:15', '2018-10-26 07:22:01'),
(526, 'culture/culture_146_photo_5bcc9c81d66c2.jpg', 0, 146, 'culture', 'accepted', 0, '2018-10-21 12:34:25', '2018-10-26 07:22:01'),
(527, 'culture/culture_151_photo_5bcc9c8d78887.jpg', 0, 151, 'culture', 'accepted', 0, '2018-10-21 12:34:37', '2018-10-26 07:22:01'),
(528, 'pest_41_photo_5bcc9e962e28d.jpg', 0, 41, 'pest', 'accepted', 0, '2018-10-21 12:43:18', '2018-10-26 07:22:01'),
(529, 'pest_41_photo_5bcc9e962f954.jpg', 0, 41, 'pest', 'accepted', 0, '2018-10-21 12:43:18', '2018-10-21 12:43:18'),
(530, 'pest_40_photo_5bcc9f1db70eb.jpg', 0, 40, 'pest', 'accepted', 0, '2018-10-21 12:45:33', '2018-10-26 07:22:01'),
(531, 'pest_40_photo_5bcc9f1db7bc6.jpg', 0, 40, 'pest', 'accepted', 0, '2018-10-21 12:45:33', '2018-10-21 12:45:33'),
(532, 'disease_46_photo_5bcca36c142e0.jpg', 0, 46, 'disease', 'accepted', 0, '2018-10-21 13:03:56', '2018-10-26 07:22:01'),
(533, 'disease_46_photo_5bcca36c157b2.jpg', 0, 46, 'disease', 'accepted', 0, '2018-10-21 13:03:56', '2018-10-21 13:03:56'),
(534, 'disease_47_photo_5bcca4f4c0e70.jpg', 0, 47, 'disease', 'accepted', 0, '2018-10-21 13:10:28', '2018-10-21 13:14:04'),
(535, 'disease_47_photo_5bcca4f4c1cea.jpg', 0, 47, 'disease', 'accepted', 0, '2018-10-21 13:10:28', '2018-10-26 07:22:01'),
(536, 'disease_48_photo_5bccb0a43aa80.jpg', 0, 48, 'disease', 'accepted', 0, '2018-10-21 14:00:20', '2018-10-26 07:22:01'),
(537, 'disease_48_photo_5bccb0a43bdaa.jpg', 0, 48, 'disease', 'accepted', 0, '2018-10-21 14:00:20', '2018-10-21 14:00:20'),
(538, 'chemical/chemical_36_photo_5bccb54fd6b03.jpg', 0, 36, 'chemical', 'accepted', 0, '2018-10-21 14:20:15', '2018-10-26 07:22:30'),
(539, 'chemical/chemical_37_photo_5bccb88e93c46.jpg', 0, 37, 'chemical', 'accepted', 0, '2018-10-21 14:34:06', '2018-10-26 07:22:30'),
(540, 'chemical/chemical_38_photo_5bccc5d7129a9.gif', 1, 38, 'chemical', 'accepted', 0, '2018-10-21 15:30:47', '2018-10-21 15:32:00'),
(541, 'chemical/chemical_38_photo_5bccc6208caf6.jpg', 0, 38, 'chemical', 'accepted', 0, '2018-10-21 15:32:00', '2018-10-21 15:32:00'),
(544, 'sort/sort_35_photo_5bd2ea1e130cb.jpg', 0, 35, 'sort', 'accepted', 0, '2018-10-26 07:19:10', '2018-10-26 07:22:01');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ' ',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_vkotakte` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_facebook` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_odnoklasniki` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_youtube` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `is_seller` tinyint(1) NOT NULL DEFAULT '0',
  `comment_seller` int(11) NOT NULL DEFAULT '0',
  `rating_seller` float NOT NULL DEFAULT '0',
  `min_price_seller` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_price_seller` decimal(10,2) NOT NULL DEFAULT '0.00',
  `about_me_seller` text COLLATE utf8mb4_unicode_ci,
  `inn_seller` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpp_seller` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_s_seller` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_decorator` tinyint(1) NOT NULL DEFAULT '0',
  `rating_decorator` float NOT NULL DEFAULT '0',
  `min_price_decorator` int(11) NOT NULL DEFAULT '0',
  `max_price_decorator` int(11) NOT NULL DEFAULT '0',
  `about_me_decorator` text COLLATE utf8mb4_unicode_ci,
  `decorator_end` date DEFAULT NULL,
  `is_partymaker` tinyint(1) NOT NULL DEFAULT '0',
  `partymaker_end` date DEFAULT NULL,
  `tariff_id` int(11) NOT NULL DEFAULT '1',
  `tariff_end` date DEFAULT '3000-01-20',
  `region_id` int(11) NOT NULL DEFAULT '77',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `birthday`, `address`, `photo`, `site`, `social_vkotakte`, `social_facebook`, `social_odnoklasniki`, `social_twitter`, `social_instagram`, `social_youtube`, `about_me`, `is_seller`, `comment_seller`, `rating_seller`, `min_price_seller`, `max_price_seller`, `about_me_seller`, `inn_seller`, `kpp_seller`, `r_s_seller`, `is_decorator`, `rating_decorator`, `min_price_decorator`, `max_price_decorator`, `about_me_decorator`, `decorator_end`, `is_partymaker`, `partymaker_end`, `tariff_id`, `tariff_end`, `region_id`, `nickname`, `created_at`, `updated_at`) VALUES
(9, 21, 'Alexander', 'Semenets', 'null', 'null', 'null', '1533845170.ico', 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 2, '0.00', '0.00', NULL, NULL, NULL, '', 1, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-10-30', 77, 'liger', '2018-05-24 06:45:15', '2018-09-30 14:33:57'),
(10, 22, 'Denis', 'Kravchenko', '+380665009700', '31.01.1996', 'Волкова 55', '1529395649.jpg', 'vk.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-01', 77, 'krava', '2018-05-25 05:25:21', '2018-09-30 10:05:13'),
(11, 23, 'dfe', 'fef', 'eet4', '1998-03-15', 'ee', '1539267569.png', 'e4t', 'de', 'ge', 'seg', 'eg', 'e', 'eg', NULL, 1, 0, 0, '200.00', '200.00', NULL, 'ryt', 'fe', '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-01', 77, 'null', '2018-05-25 10:31:59', '2018-10-25 15:44:08'),
(12, 24, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 1, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-01', 77, NULL, '2018-05-25 19:43:33', '2018-09-30 10:02:42'),
(13, 25, 'руслан', 'Гимир', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-01', 77, NULL, '2018-05-26 05:40:03', '2018-10-31 06:03:22'),
(14, 26, 'руслан', 'гимиранов', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-05-26 05:52:39', '2018-05-26 05:52:39'),
(15, 27, 'руся', 'Пинокио', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-01', 77, NULL, '2018-05-26 05:53:50', '2018-09-30 10:02:42'),
(16, 28, 'Гимиранов', 'Руслан', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 1, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-10-28', 77, NULL, '2018-05-26 06:06:57', '2018-09-27 22:28:53'),
(17, 29, 'Дима', 'Марков', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-05-27 06:25:21', '2018-05-27 06:25:21'),
(18, 30, 'Кирил', 'Акадич', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-10-28', 77, NULL, '2018-05-29 04:22:05', '2018-09-27 22:46:41'),
(19, 31, 'Alexander', 'Semenets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-05-30 09:03:40', '2018-05-30 09:03:40'),
(20, 32, 'Татьяна', 'Якунина', '+380665009700', '31.11.1783', 'Волкова', '1533562457.jpg', 'jknkjdsgf', NULL, NULL, NULL, NULL, NULL, NULL, 'Проджект менеджер всея огорода', 1, 0, 5, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, 'tata', '2018-05-30 10:38:01', '2018-08-06 10:34:17'),
(22, 34, 'Кирил', 'Максим', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-05-31 06:35:06', '2018-05-31 06:35:06'),
(23, 35, 'werttt', 'asdad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-05-31 10:03:55', '2018-05-31 10:03:55'),
(24, 36, 'Сергей', 'Хмара', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-01 04:59:03', '2018-06-01 04:59:03'),
(25, 37, 'Igor', 'Pokidko', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-05 07:10:39', '2018-06-05 07:10:39'),
(26, 38, 'Anton', 'Yakunin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-05 10:20:55', '2018-06-05 10:20:55'),
(27, 39, 'Сергей', 'Хмара', 'null', NULL, 'null', NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-11-08', 77, 'CkoMopoX', '2018-06-06 07:07:41', '2018-10-08 09:04:42'),
(28, 40, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 08:39:46', '2018-06-06 08:39:46'),
(29, 41, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 08:51:27', '2018-06-06 08:51:27'),
(30, 42, 'марина', 'дол', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:21:18', '2018-06-06 11:21:18'),
(31, 43, 'Денис', 'Крава', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:22:03', '2018-06-06 11:22:03'),
(32, 44, 'Максимка', 'Мапинка', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:23:08', '2018-06-06 11:23:08'),
(33, 45, 'Кравченко', 'Денис', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-10-28', 77, NULL, '2018-06-06 11:29:03', '2018-09-27 22:29:01'),
(34, 46, 'Денис', 'sdfsdfsd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:33:55', '2018-06-06 11:33:55'),
(35, 47, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:41:37', '2018-06-06 11:41:37'),
(36, 48, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:44:41', '2018-06-06 11:44:41'),
(37, 49, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:45:57', '2018-06-06 11:45:57'),
(38, 50, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-06 11:49:06', '2018-06-06 11:49:06'),
(39, 51, 'Denis', 'Kravchenko', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-07 04:40:24', '2018-06-07 04:40:24'),
(40, 52, 'Tony', 'Montana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-07 05:15:29', '2018-06-07 05:15:29'),
(41, 53, 'Сергей', 'хмара', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-11 13:10:52', '2018-06-11 13:10:52'),
(42, 54, 'Clever', 'Dacha', 'null', '31.02.1889', 'null', '1530003269.jpg', 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2018-10-28', 77, 'null', '2018-06-12 06:39:55', '2018-09-27 22:29:13'),
(43, 55, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-18 05:23:26', '2018-06-18 05:23:26'),
(44, 56, 'Денис', 'Кравченко', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-06-18 08:23:52', '2018-06-18 08:23:52'),
(45, 57, 'Костя', 'Чухас', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-07-02 04:55:42', '2018-07-02 04:55:42'),
(46, 58, 'Irina', 'Yakunina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-07-02 05:39:20', '2018-07-02 05:39:20'),
(47, 59, 'Дениска', 'Дениска', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-07-02 11:23:24', '2018-07-02 11:23:24'),
(48, 60, 'Сергей', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-07-04 15:38:43', '2018-07-04 15:38:43'),
(61, 61, 'Роман', 'Петрович', '0999999999', '26-12-1999', '123', '1536219654.jpg', 'сайт', '123', '123', '123', '123', '123', '123', '123', 1, 6, 2.6667, '5.25', '2500.00', '123', '123', '123', '546465465465465465', 1, 3, 123, 123, '123', '2018-11-16', 0, '2018-11-16', 1, '2018-11-16', 77, 'Дзяка', '2018-07-09 06:20:09', '2018-10-23 06:38:10'),
(62, 62, 'Гимиранов', 'Руслан', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '2001-01-20', 77, NULL, '2018-07-15 11:14:36', '2018-09-24 06:39:57'),
(69, 69, 'Admin', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '678', 0, 0, 0, '0.00', '0.00', '123', NULL, NULL, '', 0, 0, 0, 0, '345', '2018-11-16', 0, '2018-11-16', 1, '2018-11-16', 77, NULL, '2018-08-31 08:09:44', '2018-10-16 06:17:32'),
(71, 71, 'еагвке', 'варвар', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, '', 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-09 18:02:57', '2018-10-09 18:02:57'),
(72, 77, 'test', 'test2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-12 07:12:53', '2018-10-12 07:12:53'),
(73, 78, 'qwe', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-12 07:15:34', '2018-10-12 07:15:34'),
(74, 79, 'Juliette', 'Juliette', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-12 10:57:59', '2018-10-12 10:57:59'),
(75, 81, 'Новая', 'Регистрация', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-15 05:43:47', '2018-10-15 05:43:47'),
(77, 83, 'Имя', 'Фамилия', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0.00', '0.00', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, 1, '3000-01-20', 77, NULL, '2018-10-15 06:47:44', '2018-10-15 06:47:44');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `comments_count` int(11) NOT NULL DEFAULT '0',
  `moderator` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `section_id`, `title`, `text`, `date`, `time`, `comments_count`, `moderator`, `is_closed`, `created_at`, `updated_at`) VALUES
(2, 61, 4, 'Вопрос 1', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры позволяет оценить значение новых предложений.\r\n\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', '2018-08-13', '15:25:00', 3, 'accepted', 0, '2018-08-14 07:08:15', '2018-10-24 06:21:31'),
(3, 61, 4, 'Вопрос 1', 'Значимость этих проблем настолько очевидна, что сложившаяся структура организации требуют от нас анализа соответствующий условий активизации. Разнообразный и богатый опыт начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач. Задача организации, в особенности же сложившаяся структура организации обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Не следует, однако забывать, что реализация намеченных плановых заданий требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также сложившаяся структура организации позволяет выполнять важные задания по разработке систем массового участия. Таким образом сложившаяся структура организации влечет за собой процесс внедрения и модернизации форм развития.Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации существенных финансовых и административных условий. Задача организации, в особенности же рамки и место обучения кадров требуют от нас анализа систем массового участия.\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', '2018-10-23', '11:25:00', 2, 'accepted', 1, '2018-08-14 07:09:38', '2018-09-06 03:46:35'),
(4, 61, 4, 'Вопрос5', 'Текст', '2018-08-13', '15:25:00', 1, 'accepted', 0, '2018-08-14 07:11:56', '2018-10-22 17:30:56'),
(17, 23, 4, 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при', 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', '2018-10-22', '15:42:00', 1, 'accepted', 1, '2018-10-22 09:42:09', '2018-10-26 07:57:42'),
(26, 61, 6, 'Тест', 'ырввиьжадьидлапид', '2018-10-30', '10:52:00', 0, 'accepted', 0, '2018-10-30 05:52:25', '2018-10-30 05:52:46'),
(27, 32, 6, 'еее', 'ееп5', '2018-10-30', '11:13:00', 0, 'new', 0, '2018-10-30 06:13:32', '2018-10-30 06:13:32');

-- --------------------------------------------------------

--
-- Структура таблицы `question_answers`
--

CREATE TABLE `question_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `is_best` tinyint(1) NOT NULL DEFAULT '0',
  `moderator` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question_answers`
--

INSERT INTO `question_answers` (`id`, `question_id`, `user_id`, `text`, `date`, `is_best`, `moderator`, `created_at`, `updated_at`) VALUES
(3, 3, 61, 'памрпмр гнпгнп гнп гн ори ори ои о', '2018-08-28', 1, 'accepted', '0000-00-00 00:00:00', '2018-09-20 06:46:56'),
(4, 3, 61, 'Значимость этих проблем настолько очевидна, что постоянный количественный рост и', '2018-08-28', 0, 'accepted', '0000-00-00 00:00:00', '2018-09-20 06:46:56'),
(21, 2, 61, 'fdghjkl;', '2018-10-22', 0, 'new', '2018-10-22 13:27:19', '2018-10-22 13:27:19'),
(22, 2, 23, 'qwefqwfeqwf', '2018-10-22', 0, 'accepted', '2018-10-22 16:24:03', '2018-10-22 17:06:46'),
(23, 2, 23, 'Тест один', '2018-10-22', 1, 'accepted', '2018-10-22 16:24:51', '2018-10-24 06:21:31'),
(24, 2, 23, 'Текст 2', '2018-10-22', 0, 'accepted', '2018-10-22 16:24:57', '2018-10-22 16:34:22'),
(25, 17, 61, 'такой себе вопрос', '2018-10-22', 1, 'accepted', '2018-10-22 16:35:24', '2018-10-22 16:42:58'),
(28, 4, 0, 'sdfb', '2018-10-22', 0, 'accepted', '2018-10-22 17:30:56', '2018-10-22 18:02:27'),
(30, 2, 61, 'asdfgfh', '2017-08-08', 0, 'new', '2018-10-26 08:24:30', '2018-10-26 08:24:30'),
(31, 26, 32, 'ууу', '2018-10-31', 0, 'new', '2018-10-31 08:20:43', '2018-10-31 08:20:43'),
(32, 26, 32, 'ууу', '2018-10-31', 0, 'new', '2018-10-31 08:20:57', '2018-10-31 08:20:57');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `region_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 'Республика Адыгея (Адыгея)', NULL, NULL),
(2, 'Республика Башкортостан', NULL, NULL),
(3, 'Республика Бурятия', NULL, NULL),
(4, 'Республика Алтай', NULL, NULL),
(5, 'Республика Дагестан', NULL, NULL),
(6, 'Республика Ингушетия', NULL, NULL),
(7, 'Кабардино-Балкарская Республика', NULL, NULL),
(8, 'Республика Калмыкия', NULL, NULL),
(9, 'Карачаево-Черкесская Республика', NULL, NULL),
(10, 'Республика Карелия', NULL, NULL),
(11, 'Республика Коми', NULL, NULL),
(12, 'Республика Марий Эл', NULL, NULL),
(13, '	Республика Мордовия', NULL, NULL),
(77, 'г. Москва', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `responses`
--

CREATE TABLE `responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sort',
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `date` date NOT NULL,
  `moderator` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `responses`
--

INSERT INTO `responses` (`id`, `user_id`, `item_id`, `type`, `text`, `rating`, `date`, `moderator`, `created_at`, `updated_at`) VALUES
(1, 22, 47, 'sort', 'Чумовой сорт', 3, '0000-00-00', 'accepted', '2018-07-15 21:00:00', '2018-10-16 11:50:57'),
(2, 32, 47, 'sort', 'Чумовой сорт 2', 5, '0000-00-00', 'accepted', '2018-07-15 21:00:00', '2018-07-15 21:00:00'),
(3, 61, 47, 'sort', 'Ням ням', 1, '2018-08-13', 'accepted', '2018-08-13 08:32:24', '2018-08-13 08:32:24'),
(4, 22, 38, 'chemical', 'Чумовой chemical', 4, '0000-00-00', 'new', '2018-07-15 21:00:00', '2018-10-23 08:10:15'),
(5, 32, 38, 'chemical', 'Чумовой сорт chemical', 5, '0000-00-00', 'accepted', '2018-07-15 21:00:00', '2018-10-23 08:12:08'),
(6, 61, 38, 'chemical', 'chemical', 1, '2018-08-13', 'accepted', '2018-08-13 08:32:24', '2018-10-23 08:12:08'),
(7, 61, 61, 'decorator', 'Кто б меня еще похвалил', 3, '0000-00-00', 'accepted', NULL, '2018-10-06 17:12:14'),
(8, 61, 61, 'seller', 'Кто б меня еще похвалил', 3, '0000-00-00', 'accepted', NULL, '2018-09-24 06:54:52'),
(9, 28, 47, 'sort', 'Такое', 4, '2018-08-29', 'accepted', '2018-08-29 12:01:36', '2018-08-29 12:01:36'),
(13, 61, 38, 'chemical', 'Так себе', 5, '2018-10-16', 'accepted', '2018-10-16 11:43:35', '2018-10-23 08:12:08'),
(14, 61, 38, 'chemical', 'Не вкусно, теще не понравилось', 5, '2018-10-16', 'accepted', '2018-10-16 11:43:37', '2018-10-23 08:11:44'),
(16, 78, 48, 'sort', '123', 3, '2018-10-25', 'new', '2018-10-25 08:15:20', '2018-10-25 13:30:53'),
(17, 78, 48, 'sort', '123', 5, '2018-10-25', 'accepted', '2018-10-25 08:15:40', '2018-10-25 13:30:53'),
(18, 78, 48, 'sort', 'привет', 1, '2018-10-25', 'accepted', '2018-10-25 08:18:56', '2018-10-25 13:31:23'),
(19, 78, 48, 'sort', 'привет!', 3, '2018-10-25', 'new', '2018-10-25 08:19:17', '2018-10-25 13:31:23'),
(20, 78, 48, 'sort', '123', 2, '2018-10-25', 'new', '2018-10-25 08:50:13', '2018-10-25 13:31:23'),
(21, 78, 48, 'sort', '123', 4, '2018-10-25', 'new', '2018-10-25 08:50:31', '2018-10-25 13:31:23'),
(22, 78, 48, 'sort', '123', 4, '2018-10-25', 'new', '2018-10-25 08:53:03', '2018-10-25 13:33:35'),
(39, 78, 48, 'sort', 'asfagas e gsdgsdgf sdgf sds', 2, '2018-10-25', 'accepted', '2018-10-25 09:46:30', '2018-10-25 13:34:46');

-- --------------------------------------------------------

--
-- Структура таблицы `responses_answers`
--

CREATE TABLE `responses_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `response_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `moderator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `responses_answers`
--

INSERT INTO `responses_answers` (`id`, `response_id`, `user_id`, `profile_id`, `response`, `date`, `moderator`, `created_at`, `updated_at`) VALUES
(1, 1, 23, 11, 'Очень пондавилось. Хочу еще такой же', '2018-05-01', 'accepted', NULL, '2018-09-21 04:08:09'),
(2, 1, 32, 20, 'Хороший сорт', '2018-05-11', 'accepted', NULL, '2018-09-21 04:08:09'),
(3, 4, 23, 11, 'Очень пондавилось. Хочу еще такой же', '2018-05-01', 'accepted', NULL, NULL),
(4, 4, 32, 20, 'Хороший сорт', '2018-05-11', 'accepted', NULL, NULL),
(16, 7, 0, 0, 'примерно', '2018-10-22', 'accepted', '2018-10-22 08:55:20', '2018-10-22 08:55:20'),
(17, 6, 23, 0, 'И зачем?', '2018-10-22', 'accepted', '2018-10-22 08:55:51', '2018-10-22 08:57:45');

-- --------------------------------------------------------

--
-- Структура таблицы `searches`
--

CREATE TABLE `searches` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `section_id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `searches`
--

INSERT INTO `searches` (`id`, `title`, `text`, `section_id`, `type`, `target_id`, `created_at`, `updated_at`) VALUES
(17, 'VII \"Moscow Flower Show\"', '<p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>', 0, 'event', 3, '2018-10-19 08:00:45', '2018-10-19 05:00:45'),
(36, 'Абрикос Лескора', 'Этот сорт был выведен неизвестным селекционером и перекочевал к нам из Чехии. Широко не офишировался, поэтому не так известен среди любителей культуры, хотя и обладает рядом неоспоримых преимуществ. Там сорт выращивается довольно давно, так как дачникам очень нравится его скороспелость.\r\n\r\nАбрикос характеризуется сильным  деревом, его крона  обратнопирамидальная, что является необычным для этой культуры. Плоды дерева средней величины, а иногда и большие,обычно до 60 г, обладают приятным характерным вкусом и сильным, естественным ароматом. Одним из немногих недостатков сорта является слабая устойчивость к некоторым заболеваниям, например монилиозу.\r\n\r\nВажно для нормального роста регулярно проводить профилактику растения  и обрабатывать его специальными препаратами против грибковых заболеваний. Также необходимо обеспечить полив в летнее время.', 6, 'sort', 48, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(37, 'Краснощекий', 'Растение хорошо растет преимущественно в южных районах. Крупное дерево с длинными ветвями и раскидистой  кроной.  Дерево показывают одну из самых высоких урожайностей – до 90 кг с дерева.\r\nПлоды образуются на прошлогодних молодых ветках, поэтому это нужно учитывать при обрезке дерева.\r\n\r\nПлоды\r\nСозревает абрикос в конце июля. Если урожай выдается хорошим, то процесс созревания плодов может растянуться на длительный период. Сбор урожая осуществляется поэтому в несколько волн. Абрикосы могут полностью осыпаться, когда достигнут созревания. Ориентировочный срок хранения плодов после сбора составляет 10 дней.\r\n\r\nПлоды  вытянутой округлой формы и светло-оранжевого цвета. Название свое сорт получил из-за красноватого оттенка на «щеках» фрукта. Вкус сладкий, с некоторой кислинкой.\r\nАбрикос самоплодный, прекрасно себя чувствует в односортных посадках, ему не требуется присутствие других абрикосовых деревьев для опыления и формирования завязей. Поскольку цветение происходит поздно-весенние заморозки не оказывают сильного влияния на урожайность.\r\n\r\nСорт подвержен инфекциям пятнистости и монилиозу. Особенно страдают деревья от этих заболеваний, если весной и в первой половине лета обильные туманы, дожди, а также при значительном загущении кроны. Поэтому надо внимательно следить за состоянием листьев и при первых признаках заболевания обработать соответствующими препаратами. А так же рекомендуется проводить профилактические обработки. Поэтому не рекомендуется сажать этот сорт в низинах, влажных участках с застоем воздушных потоков.', 6, 'sort', 49, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(38, 'Полесский крупноплодный', 'Сорт обладает средней скороплодностью, дает стабильный урожай , плоды крупные (от 50-55 г до 70-80 г), зимостойкий ствол.\r\nПлоды  округло-овальные, слегка сдавленные с боков. Кожица жёлто-оранжевая, с лёгким румянцем. Мякоть золотисто-оранжевая, нежная, ароматная, хорошего кисло-сладкого вкуса. Косточка мелкая, хорошо отделяется от мякоти.\r\n\r\nПлоды созревают в конце июля.\r\n\r\nПлоды образуется на однолетних молодых побегах, это нужно учитывать при обрезке!!!', 6, 'sort', 50, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(39, 'Ялтинец', 'Дерево обладает  необычными плодами, раскидной кроной и сильным ростом. Плоды крупные, до 60 г, яйцевидные, по бокам приплюснутые, бывают и ярко-желтые со специфическим оттенком, но чаще всего оранжевые. Вкус обладает ярко-выраженным характерным оттенком. Одно из основных отличий сорта от других.\r\n\r\nЗамечательно подходит как для консервирования и заготовок, так и для свежего употребления.\r\n\r\nРастение устойчиво к заморозкам и засухам,  не подвержено многим заболеваниям и дает стабильный высокий урожай.', 6, 'sort', 51, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(40, 'Ананасный', 'Описание сорта\r\nАбрикос ананасный начинает плодоносить на 3-4 году после высадки. Поскольку плоды образуются на однолетних побегах, для увеличения урожая следует проводить регулярную обрезку и прищипывание молодых побегов.\r\n\r\nДанный абрикос относится к самоплодным сортам. Что дает высокий урожай, если растение будет на участке единственным в своем роде. Однако наличие других сортов абрикоса и персика заметно улучшает вкусовые качества данного сорта.\r\nПосле созревания плоды сильно осыпаются.\r\n\r\nПлоды средние, массой 35-45 г. Имеют неправильно округлую, продолговатую форму. Кожица не сильно плотная, средне опушена. Поверхность немного бугристая, шершавая. Спелые абрикосы матового, светло желтого или золотистого цвета, почти без румянца. Мякоть имеет светло-желтый ананасовый цвет с оранжевым оттенком и приятный аромат. Очень сочная, средней плотности, нежноволокнистая, сладкая с особенным привкусом. Косточка маленького размера, семя сладкое.\r\n\r\nСорт устойчив к курчавости листьев и клястероспориозу. Хорошо переносит морозы и быстро восстанавливается. Достаточно позднее цветение позволяет показывать стабильность в урожае. Правильный уход позволяет собирать  до 130-150 кг абрикос с одного дерева.', 6, 'sort', 52, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(41, 'Фаворит', 'Этот сорт Абрикоса рекомендован для выращивания в центральном регионе РФ, хотя и является теплолюбивым растением со всеми присущими этой культуре особенностями. \r\nДерево сорта Фаворит вырастает средних размеров, до 4м. Крона метельчатая, раскидистая, редкая. Однолетние побеги ветвистые. \r\nСорт самоплодный, тем не менее является хорошим опылителем для других представителей своей культуры.\r\nУрожайность в среднем 30 ц/га, что не много по сравнению с другими сортами.\r\nЯгоды не очень крупные (30 г), округлой, слегка вытянутой формы. Опушение плодов слабое, они почти глянцевые. Цвет оранжевый с густым и большим румянцем. Мякоть сочная, тающая, сладко-кислая. Дегустационная оценка 5 баллов (при регистрации было 4,5 балла). Косточка маленькая и отлично отделяется.\r\nПлоды хорошо лежат и транспортабельны. В прохладном и проветриваемом помещении могут лежать до одного месяца.\r\n\r\nГлавным недостатком сорта является позднее созревание. В условиях холодного лета и поздней весны  плоды могут не успевать вызревать. В эти же годы возможно заражение клястероспориозом, к которому у Фаворита средний иммунитет.', 6, 'sort', 53, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(42, 'Без сорта', 'Под эту категорию попадают все растения, сорт которых неизвестен. По ним нет какой-либо информации.', 6, 'sort', 61, '2018-10-09 07:24:38', '2018-10-09 07:24:38'),
(43, 'Роман Петрович', '123', 0, 'decorator', 61, '2018-10-10 09:43:23', '2018-10-10 06:43:23'),
(44, 'dfe fef', NULL, 0, 'seller', 23, '2018-10-09 15:35:04', '2018-10-09 12:35:04'),
(45, 'Белый налив', '<b>ОПИСАНИЕ:&nbsp;</b>Летний сорт: яблочки первые, по-весеннему свежие, ароматно хрустящие. Дерево высокое, раскидистое. Горизонтально растущие ветви придают кроне округлую форму. Плоды крупные, светло-кремовые, покрыты белой восковой пыльцой. Мякоть сочная, зернистая, снежно-крахмального оттенка.&nbsp;<div><b>ОСОБЕННОСТИ ВЫРАЩИВАНИЯ:&nbsp;&nbsp;</b>Деревца лучше высаживать на северных склонах холмов: растение обладает отличной зимостойкостью, но хуже переносит засухи и жару. К структуре и типу почв Налив равнодушен: главное, чтобы земля была плодородной и регулярно увлажняемой. Формирующую обрезку выполняют по традиционной схеме: ежегодно оставляют 4–5 скелетный ветвей соответствующего порядка. Санитарную обрезку проводят регулярно: крона склонна к загущению.\r\n\r\n \r\n\r\n<b>ДОСТОИНСТВА СОРТА:&nbsp;</b>Урожайность молодого дерева может составить 1,5 центнера. Растение исключительно зимостойко: его можно выращивать и северных районах. Рекомендуем заказать саженцы Белый налив: скороспелая яблоня – источник ранних витаминов и отличное средство для быстрого приготовления соков, сидров, компотов.</div>', 6, 'sort', 35, '2018-10-18 18:05:07', '2018-10-18 15:05:07'),
(46, 'Груша медовая', '<b>ОПИСАНИЕ</b>\r\nОгромные плоды груши Медовая созревают глубокой осенью – культура относится к позднеспелым сортам. На дереве формируются огромные плоды, которые достигают веса от 400 до 520 г. Тонкая кожица плодов имеет желто-зеленую окраску с коричневато-рыжей пигментацией, структура поверхности бугристая, матовая. Мякоть – нежная, кремово-белого оттенка, сочная, приятная на вкус, отличается высоким содержанием сахара и аскорбиновой кислоты. Урожайность – до 1 ц отборных плодов с дерева.&nbsp;<div><br></div>', 6, 'sort', 37, '2018-10-18 18:07:43', '2018-10-18 15:07:43'),
(48, 'Мелитопольский ранний', 'Этот сорт замечательно будет смотреться на любом участке, ведь он устойчив ко многим заболеваниям, а также отличается высокой степенью зимостойкости, выдерживая температуры до -30 градусов. Форма растения древовидная, средняя урожайность, плоды размеров до 50-60 г. каждый. Форма плодов овальная, немного приплюснутая, оранжево-желтые с тонкой кожицей, ароматная мякоть без волокон,которая не оставит никого равнодушным. Кисло-сладкий вкус и естественный аромат не оставят равнодушным любого любителя этого плода.\r\n\r\nМелитопольский ранний -сорт,который не требует особенного ухода, главное – это регулярная обрезка, чтобы не получить загущенную крону.\r\nЕдинственным недостатком является плохая транспортировка плодов и их хранение, только в недозревшем виде.', 6, 'sort', 47, '2018-10-09 09:06:12', '2018-10-09 09:06:12'),
(59, 'Парус', ' ООО \"Компания Агропрогресс\" Хлорпирифос<div><br></div><div>\r\n\r\n<div><u>Культура:</u>&nbsp;<u></u>Яблоня, груша<u></u></div><div><u>Вредный объект:</u>&nbsp;Плодожорки, листовертки, моли, клещи, щитовки, тли<u></u></div><div><u>Способ, время, особенности применения препарата:</u>&nbsp;Опрыскивание в период вегетации.</div><div><u>Норма применения препарата, л/га:</u>&nbsp; Расход рабочей жидкости – 800-1200 л/га</div><div><u>Срок ожидания (кратность обработок): </u>&nbsp;2 40 (2)<u></u></div><div><br></div><div>&nbsp;</div>\r\n\r\n<br></div> <div><b>\r\n\r\n</b>Парус - фосфорорганический инсектицид для борьбы с широким спектром насекомых на яблоне, винограде и груше. Действующее вещество: хлорпирифос, 480 г/л.&nbsp;</div><div>Препаративная форма: концентрат эмульсии, КЭ&nbsp;</div><div>Тарная единица: канистра 10 кг.&nbsp;</div><div>Класс опасности: 2 класс опасности (умеренно опасное соединение). Гарантийный срок хранения: 2 года в заводской упаковке при температуре от минус 30С до плюс 30С.&nbsp;</div><div>Механизм действия Инсектицид контактно-кишечного действия: при попадании в организм насекомых ингибирует фермент ацетилхолинэстеразу. Угнетение активности ацетилхолинэстеразы тормозит передачу нервного импульса в холинэргических синапсах с одного нейрона на другой, что вызывает судороги, паралич, а в конечном счете, гибель насекомого.&nbsp;</div> <p>\r\n\r\n</p><div><br>Влияние условий окружающей среды на действие препарата Препарат желательно применять в утренние или вечерние часы при температуре не выше 25С. Дождь сразу после обработки снижает эффективность препарата. Опрыскивание должно проводиться при скорости ветра не более 5 м/сек во избежание сноса аэрозоля на соседние культуры. Совместимость с другими препаратами Совместим со многими пестицидами, за исключением щелочных препаратов и препаратов на основе меди. <br></div><b><br>\r\n\r\n</b><br><p></p>', 0, 'chemical', 27, '2018-10-18 17:58:29', '2018-10-18 14:58:29'),
(60, 'Бордосская смесь', '  Раствор медного купороса CuSO₄ · 5H₂O в известковом молоке Ca(OH)₂. Жидкость небесно-голубого цвета.  (Оба ингредиента показаны на фото) Приготовление бордосской жидкости\r\nСтоит учитывать, что приготовление бордосской смеси достаточно сложное, поэтому все нужно делать правильно.\r\n\r\nВ противном случае раствор может получиться слишком концентрированный, и при опрыскивании нежных растений навредит им. Или же наоборот слабой концентрации, тогда он не принесет ожидаемый эффект.\r\n\r\nИтак, рассмотрим пошаговое приготовление 1% раствора на 10 литров:\r\n\r\nДля разведения раствора нужно использовать любую неметаллическую тару.\r\nВ теплой воде нужно развести 10 грамм медного купороса. Все тщательно перемешивается.\r\nДалее в эту смесь нужно долить холодной воды так, чтобы общий объем составил 5 литров.\r\nВ отдельной посуде нужно развести в 1 литре воды 120-130 грамм гашеной извести. Все тщательно размешивается в результате должна получиться смесь по консистенции, напоминающая сметану.\r\nЗатем в известковую массу нужно долить воды, чтобы объем составил 5. Хорошо перемешивается.\r\nПроцеживаем известковый раствор через марлевый материал. Это нужно для того, чтобы опрыскиватель не забивался частичками извести.\r\nНи в коем случае не перепутайте, что и куда вливать! Помешивая деревянной палочкой или лопаточкой, медный купорос аккуратно заливаем в известковую смесь.\r\nВсе хорошо перемешивается. Желательно одновременно помешивать известь и вливать медный купорос.\r\nПриготовление 3% раствора такое же, только отличается концентрацией. Для этого раствора потребуется 300 грамм медного купороса и 400 грамм гашеной извести.\r\nТакже после приготовления необходимо проверить кислотную реакцию раствора. Для этого в него следует опустить любую металлическую проволоку или гвоздь. Если после опускания металл приобретет красный цвет, то в раствор следует добавить еще немного извести.\r\n\r\nТакже помните о том, что нельзя делать:\r\n\r\nНельзя заливать известковую смесь в раствор медного купороса. Это намного снизит качество раствора.\r\nНе нужно смешивать теплые и холодные составляющие.\r\nСоединять сухие компоненты.\r\nНаливать в готовый раствор воды.\r\nДобавлять сухой медный купорос в разбавленную известь. Для молодых деревьев, возраст которых составляет не более 6 лет — понадобится 2 литра на одно дерево.\r\nПри обрабатывании плодоносящих растений потребуется 10 литров.\r\nДля кустарниковых растений – 1,5 литра на один кустарник.\r\nПри профилактических мероприятиях у винограда, малины и земляники – на 10 квадратных метров достаточно полтора литра раствора.\r\nДля обработки томатов и огурцов – на 10 квадратных метров потребуется 2 литра раствора.\r\nПри обрабатывании дыни, арбузов, лука, свеклы – на 10 кв.метров понадобится 1 литр раствора.', 0, 'chemical', 28, '2018-10-15 10:38:52', '2018-10-15 07:38:52'),
(61, 'фильтр', 'фильтр', 0, 'event', 13, '2018-10-09 09:30:45', '2018-10-09 09:30:45'),
(62, 'Мероприятие', 'Мероприятие в ноябре', 0, 'event', 15, '2018-10-19 13:25:23', '2018-10-19 10:25:23'),
(63, 'Еще мероприятие', 'фильтр', 0, 'event', 16, '2018-10-19 13:25:23', '2018-10-19 10:25:23'),
(64, 'фильтр', 'фильтр', 0, 'event', 17, '2018-10-09 09:30:45', '2018-10-09 09:30:45'),
(65, 'Мероприятие 30', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"<br>', 0, 'event', 30, '2018-10-11 10:56:00', '2018-10-11 07:56:00'),
(67, 'Роман Петрович', '123', 0, 'seller', 61, '2018-10-10 09:43:23', '2018-10-10 06:43:23'),
(68, 'Alexander Semenets', NULL, 0, 'decorator', 21, '2018-10-10 05:14:42', '2018-10-10 05:14:42'),
(69, 'Денис Кравченко', NULL, 0, 'decorator', 24, '2018-10-10 05:14:42', '2018-10-10 05:14:42'),
(70, 'Гимиранов Руслан', NULL, 0, 'decorator', 28, '2018-10-10 05:14:42', '2018-10-10 05:14:42'),
(71, 'Alexander Semenets', NULL, 0, 'seller', 21, '2018-10-10 05:25:32', '2018-10-10 05:25:32'),
(72, 'Denis Kravchenko', NULL, 0, 'seller', 22, '2018-10-10 05:25:32', '2018-10-10 05:25:32'),
(73, 'руся Пинокио', NULL, 0, 'seller', 27, '2018-10-10 05:25:32', '2018-10-10 05:25:32'),
(74, 'Дима Марков', NULL, 0, 'seller', 29, '2018-10-10 05:25:32', '2018-10-10 05:25:32'),
(75, 'Татьяна Якунина', NULL, 0, 'seller', 32, '2018-10-10 05:25:32', '2018-10-10 05:25:32'),
(81, 'Грушевая плодожорка', ' Грушевая плодожорка – монофаг, повреждает только плоды груши. Наиболее подвержены повреждениям ранние сорта. Размножение двуполое. Зимуют гусеницы в коконах в почве. Генерация в основном одногодичная, иногда наблюдается частичное развитие второго поколения. \r\nВредоносность\r\nПлодожорка грушевая повреждает только груши. Вредит на стадии гусеницы, наиболее опасна для ранних сортов груш, которые к моменту отрождения личинок имеют пригодные для питания семена. Наиболее значительный вред приносит в лесостепной и степной зоне, где повреждает 80–90 % плодов груш. Меры борьбы\r\n1. Агротехнические мероприятия. Зяблевая вспашка, рыхление и перекопка почвы в приствольных кругах.\r\n2. Пояс из мешковины на высоте 50 см.  от уровня земли.\r\n3. Химический способ. Своевременное опрыскивание деревьев, фосфорорганическими соединениями.\r\n\r\nПрепараты:\r\n- Парус, КЭ\r\n- Агравертин до и после цветения – 5 мл на 1,5 литра воды.&nbsp;', 6, 'pest', 35, '2018-10-17 06:02:03', '2018-10-17 06:02:03'),
(82, 'Тля', ' <b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых. <b>Профилактика:&nbsp;</b><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге.&nbsp;</div><div>- удаление сорняков вокруг растения.&nbsp;</div><div>- борьба с разносчиками (муравьями)&nbsp;\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n</div>', 6, 'pest', 37, '2018-10-22 10:25:38', '2018-10-22 07:25:38'),
(84, 'Тля', ' <b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n. <b>Профилактика: </b><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге. </div><div>- удаление сорняков вокруг растения. </div><div>- борьба с разносчиками (муравьями) </div>', 4, 'pest', 40, '2018-10-21 15:46:01', '2018-10-21 12:46:01'),
(85, 'Справка по абрикосу', ' <p>\r\n\r\nЯму для посадки абрикоса лучше приготовить предварительно в осенний период. Оптимальными являются размеры 70 см/70 см/70 см. Ведь надо не забывать, что размеры корневой системы развивающегося дерева в два раза больше размеров кроны. Дно ямы засыпается дренажной подушкой, которая будет предохранять наше дерево от избытка влаги. Для этого хорошо подойдёт щебень, гравий или мелкие куски кирпича. Затем в яму засыпается подготовленная почва, которая состоит из верхнего чернозёма, перегноя и добавок древесной золы или извести (в зависимости от типа грунта) и аммиачной селитры. Всё это должно быть хорошо перемешано и покрыто слоем земли для предотвращения прямого контактирования с корнями. Из земли в яме делают небольшое возвышение, на которое устанавливают корни дерева, хорошо их расправляют и засыпают оставшейся землёй. Ствол абрикоса засыпают до уровня шейки ствола так, чтобы дерево находилось на небольшом возвышении, а шейка не засыпалась землёй. По окружности возвышения надо сделать поливочный круг, после чего обильно полить деревце водой. При этом надо следить, чтобы вода не попадала непосредственно под ствол дерева, а разливалась по окружности поливочного круга. Такой способ посадки оградит дерево от застоя воды в весенний период, увеличивает площадь для роста корней и улучшает снабжение корневой системы водой и кислородом&nbsp;<br><br><a target=\"_blank\" rel=\"nofollow\" href=\"https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r\">https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r</a>\r\n\r\n<br></p> <p><u></u>Тест<u></u><u>овое</u> описание <b>1</b><br></p><br>', 6, 'handbook', 41, '2018-10-22 10:53:34', '2018-10-22 07:53:34'),
(86, 'Тест Справка по абрикосу', ' <p>\r\n\r\nЯму для посадки абрикоса лучше приготовить предварительно в осенний период. Оптимальными являются размеры 70 см/70 см/70 см. Ведь надо не забывать, что размеры корневой системы ря дерева в два раза больше размеров кроны. Дно ямы засыпается дренажной <b>подушкой, которая будет предохранять</b> наше дерево от избытка влаги. Для этого хорошо подойдёт щебень, гравий или мелкие куски кирпича. <i>Затем в яму засыпается </i>подготовленная почва, которая состоит из верхнего чернозёма, перегноя и добавок древесной золы или извести (в зависимости от типа грунта) и аммиачной селитры. Всё это должно быть хорошо перемешано и покрыто слоем земли для предотвращения прямого контактирования с корнями. Из земли в яме делают небольшое возвышение, на которое устанавливают корни дерева, хорошо их расправляют и засыпают оставшейся землёй. Ствол абрикоса засыпают до уровня шейки ствола так, чтобы дерево находилось на небольшом возвышении, а шейка не засыпалась землёй. По окружности возвышения надо сделать поливочный круг, после чего обильно полить деревце водой. При этом надо следить, чтобы вода не попадала непосредственно под ствол дерева, а разливалась по окружности поливочного круга. Такой способ посадки оградит дерево от застоя воды в весенний период, увеличивает площадь для роста корней и улучшает снабжение корневой системы водой и кислородом<br><br><a target=\"_blank\" rel=\"nofollow\" href=\"https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r\">https://ogorod.guru/derevya/abrikos/posadka-abrikosa-vesnoy-nyuansy-i-sovety.html#hcq=5rbli6r</a>&nbsp;&nbsp;<br></p> <u>Тест</u>овое описание 2<br>', 6, 'handbook', 44, '2018-10-22 10:53:34', '2018-10-22 07:53:34'),
(88, 'Хом', ' GREEN BELT <p>\r\n\r\nДля проведения профилактических и лечебных опрыскиваний, культурных растений, готовят рабочую жидкость: 30-40 г препарата разводят небольшим количеством воды, тщательно размешивают и доводят объём раствора до 10 литров. Обработку необходимо проводить в прохладную погоду, в утренние или вечерние часы при отсутствии сильных ветров. Следует обратить внимание на прогноз погоды, так как перед дождём обрабатывать растения фунгицидом Хом не имеет смысла из-за быстрой его смываемости.\r\n\r\n<br></p><p><br></p> <p>\r\n\r\n</p><p><b>Достоинства препарата Хом:</b></p><ol><li>Хом обладает профилактическим действием.</li><li>Эффективен против множества инфекций на различных культурах.</li><li>Фунгицид обладает высокой толерантностью к другим препаратам.</li><li>Прост в применении, удобная упаковка.</li><li>Сравнительно низкая стоимость препарата.</li></ol><p><b>Недостатки препарата:</b></p><ol><li>Препарат Хом не обладает устойчивостью к осадкам, быстро смывается дождём и требует проведения повторной обработки растений.</li><li>Малоэффективен в лечении грибковых инфекций, так как не проникает в ткани.</li><li>Не является экономичным. Требует большое количество препарата для приготовления раствора, опрыскивание производят с обеих сторон листа, поэтому жидкости для обработки нужно много.</li><li>Действующее вещество вызывает коррозийную порчу металлов.</li><li>Короткий срок защиты для овощных культур.</li><li>Фунгицид запрещается применять в период цветения.</li></ol>\r\n\r\n<br><p></p> <p>\r\n\r\n</p><p>Фунгицид Хом хорошо проявил себя в смесях с органическими пестицидами, которые относятся к группе дитиокарбаматов.</p><p>Для полезных насекомых и растений фунгицид малотоксичен. Хом применяют вблизи ферм по разведению рыбы, но следят, чтобы остатки препарата не попадали в водоёмы и колодцы с питьевой водой. Для человека Хом не опасен, если придерживаться правил обработки. При попадании препарата в пищеварительный тракт принимают активированный уголь, запивая его большим количеством воды (до 1 л), после чего обращаются к врачу. Чтобы средство не загрязняло окружающую среду, упаковку после его использования сжигают.</p>\r\n\r\n<br><p></p>', 0, 'chemical', 35, '2018-10-18 17:46:15', '2018-10-18 14:46:15'),
(90, '', '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n<br><p></p>', 0, 'event', 42, '2018-10-19 07:17:05', '2018-10-19 07:17:05'),
(91, '111', '<p>\r\n\r\n</p><p><strong><img alt=\"\" src=\"http://\">VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.</p><p><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 43, '2018-10-19 13:32:57', '2018-10-19 10:32:57'),
(92, '111', '<p>\r\n\r\n</p><p><strong><img alt=\"\" src=\"http://78.155.206.219/backend/public/storage/event_44_photo_5bc9aff10268e.jpg\"><br></strong></p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 44, '2018-10-19 13:47:16', '2018-10-19 10:47:16');
INSERT INTO `searches` (`id`, `title`, `text`, `section_id`, `type`, `target_id`, `created_at`, `updated_at`) VALUES
(93, '222', '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 45, '2018-10-19 07:20:55', '2018-10-19 07:20:55'),
(94, '333', '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 46, '2018-10-19 13:33:35', '2018-10-19 10:33:35'),
(95, '333', '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.</p><p><img alt=\"\" src=\"https://ibb.co/nemt5f\"><br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 47, '2018-10-19 13:33:51', '2018-10-19 10:33:51'),
(96, '444', '', 0, 'event', 48, '2018-10-19 07:21:49', '2018-10-19 07:21:49'),
(97, '444', '<p>\r\n\r\n</p><p><strong>VII \"Moscow Flower Show\"</strong></p><p><strong>На фестивале садов и цветов Moscow Flower Show-2018<br>установят огромный футбольный мяч из цветов</strong></p><p>С 29 июня по 8 июля в столице пройдет VII фестиваль садов и цветов Moscow Flower Show. Это главное событие в области ландшафтного дизайна в России, на который приезжают лучшие мастера и эксперты со всего мира. Посетителей ждет выставка работ победителей конкурса и авторские сады знаменитых ландшафтных дизайнеров с мировым именем, конкурс детских мини-садов, мастер-классы и шоу-программа. Впервые мероприятия фестиваля пройдут на двух центральных площадках города: в парке искусств Музеон и Зарядье, таким образом, Moscow Flower Show-2018 станет самым масштабным в своей истории.<br><br>Главными премьерами фестиваля станет участие звезд ландшафтной моды. Знаменитые английские ландшафтные дизайнеры Пол Брукс и Джеймс Александр-Синклер построят на фестивале свои авторские сады - &nbsp;\"Сад Прометея\" и \"Listening garden/listening theatre\". Джеймс Александр-Синклер - председатель жюри самого престижного в мире Chelsea Flower Show, любимец английской королевы, он также бессменный глава жюри московского фестиваля. Однако впервые в Москве он дебютирует со своим садом.<br><br>Организаторы фестиваля не смогли обойти вниманием главную тему нынешнего лета - проведение чемпионата мира по футболу в России.  В честь этого события на Moscow Flower Show из живых цветов будет построен гигантский футбольный мяч высотой 3 метра.<br><br>29 июня состоится презентация нового сорта одного из самых красивых цветов в мире - гортензии метельчатой. По существующей практике, новый сорт пройдет процедуру «крещения» с участием сразу трех крестных мам: Посла Франции в России мадам Сильви Берманн, Президента фестиваля Карины Лазаревой и представителя французского питомника Renault Татьяны Смирновой. Новый сорт гортензии выведен во Франции, но посвящен Moscow Flower Show и получил название «Жемчужина Фестиваля». В течение года с 1 сентября гортензия будет распространяться только на территории России. <br><br>В 2018 году впервые в московском фестивале будет участвовать Япония. 5 июля станет тематическим днем Японии на фестивале, в котором примут участие представители посольства этой страны. В этот день здесь пройдет чайная церемония от мастеров знаменитой школы Омотэ Сэнкэ (одной из трёх главных школ Японии) с угощением всех желающих, мастер-классы по суми-ё (рисование на рисовой бумаге) и созданию шаров \"темари\", в образовательную программу будут включены лекции по созданию японского сада, а на одной из главных аллей парка Музеон появится японское кимоно, сделанное из живых цветов.<br><br>В этом году на MFS-2018 первый раз запланировано целых два детских проекта – \"Сады в миниатюре\" и \"Планета цветов\". «Планета цветов» - традиционный конкурс садов, выполненных по рисункам детей, в этом году им было предложено создать свои эскизы садов на тему \"Парк мечты\". Второй детский проект - \"Сады в миниатюре\" – новая образовательная ландшафтная программа для школьников от 9 до 15 лет, которая стартовала в парке Зарядье в мае этого года. Участники программы изучают климатические зоны, видовые точки, разбирают симметрию французских садов, учатся разбивать сады в стеклянных колбах и многое другое. <br><br>В день открытия Moscow Flower Show всех конкурсантов поздравят участники шоу \"Голос. Дети\". Также запланировано масштабное цветочное шествие под аккомпанемент духового оркестра Brevis Brass Band, сольный концерт шотландских волынщиков и ежедневная музыкальная программа с участием солистки Геликон-оперы заслуженной артистки РФ Ксении Вязниковой, выдающегося джазового пианиста Эльмара Сафаралиева и других звезд. </p><p>Даты проведения: 29 июня - 8 июля<br>Время работы: с 10 до 22 ч.<br>Место: парк \"Музеон\"<br>Билеты: от 300 до 600 рублей<br>Сайт: <a target=\"_blank\" rel=\"nofollow\" href=\"http://flowershowmoscow.ru/\">http://flowershowmoscow.ru</a></p>\r\n\r\n\r\n\r\n<br><p></p>', 0, 'event', 49, '2018-10-19 07:22:11', '2018-10-19 07:22:11'),
(98, 'Тля', ' <p>\r\n\r\n<b>Тля</b> это насекомое-вредитель,которое молниеносно размножается. Она повреждает молодые побеги растений, высасывая из них соки. Прекращается рост молодых побегов, а старые умирают. В итоге погибает все дерево целиком. Кроме этого, тля способствует распространению грибковых заболеваний, после нее остается липкая жидкость на побегах, которая привлекает других насекомых.\r\n\r\n<br></p> <p>\r\n\r\n<b>Профилактика: </b></p><div>- весенняя или осенняя побелка стволов известью, удаление старой коры.\r\n- уборка опавшей листвы в приствольном круге. </div><div>- удаление сорняков вокруг растения. </div><div>- борьба с разносчиками (муравьями) </div>\r\n\r\n<br><p></p>', 5, 'pest', 41, '2018-10-21 15:44:04', '2018-10-21 12:44:04'),
(99, 'Цитоспороз', ' <p>\r\n\r\n</p><p><b>Цитоспороз </b>- на коре появляются мелкие небольшие бугорки серого цвета, которые и являются грибковым заболеванием. Листья на таких побегах постепенно засыхают, за ними засыхает побег и , если не принимать никаких действий, умирает все растение.</p>\r\n\r\n<br><p></p> <p><b>Профилактика:</b></p><p>- своевременное удаление сухих веток, чтобы заболевание не распространялось на здоровые побеги.</p><p>- в качестве профилактики каждый год весной опрыскивание деревьев 1%-ной бордоской смесью или другим <b><u>медьсодержащим</u></b> препаратом.\r\n\r\n<br></p>', 6, 'disease', 46, '2018-10-21 13:03:56', '2018-10-21 13:03:56'),
(100, 'Бактериальный некроз, или рак (ожог)', ' <p>\r\n\r\n<b>Бактериальный рак </b>поражает все дерево. Может проявляться в различном виде но самым популярным является появление весной ожогов на растении, после чего на их месте происходит образование язв и течет камедь.Постепенно дерево отмирает.&nbsp; Болезнь может перебираться на семечковые типы растений и на сирень. Если рядом находятся эти растения - необходимо производить разв год их профилактический осмотр.&nbsp;<br></p> <p>\r\n\r\n</p><p>При первых признаках болезни нужно обрезать пораженные ветки до здоровой ткани и сжечь их. Срезы продезинфицировать 1% раствором медного купороса&nbsp; (CuSO4) и замазать садовым варом. В профилактических целях необходимо опрыскивать деревья 1% бордоской жидкостью – весной и летом и 3%-й бордоской жидкостью – осенью во время листопада.</p><p>Своевременно удалять камедь. Почву в том месте, где раньше росли пораженные деревья, посыпьте хлорной известью (200 г на 1 кв.м) и необходимо мерекопать.&nbsp;</p><p><b>Устойчивые к заболеванию сорта:</b></p><p><b>\r\n\r\n<em>Ананасный цюрупинский, Венгерский лучший, Выносливый, Комсомолец, Краснощекий, Никитский, Парнас, Шиндахлан</em>.\r\n\r\n<br></b></p><p><br></p>\r\n\r\n<br><p></p>', 6, 'disease', 47, '2018-10-21 16:21:24', '2018-10-21 13:21:24'),
(101, 'Монилиальный ожог (монилиоз)', ' <p>\r\n\r\nБлагоприятным условием развития болезни является сырая и влажная погода. Чаще всего растения заражаются монилиозом во время цветения. В результате побеги и листья засыхают и отмирают. Болезнь на плодах проявляется в виде гнили и белесого грибкового налета.<br></p> <p>- своевременный сбор и уничтожение (сжигание) поврежденных побегов и плодов. - обработка во время цветения 3% бордоской смесью.&nbsp;</p><p>- обработка кроны заболевшего растения Топсином-М, Строби или Топазом (по инструкции) с добавлением в раствор хозяйственного мыла.&nbsp;<br></p>', 6, 'disease', 48, '2018-10-21 14:00:00', '2018-10-21 14:00:00'),
(102, 'Топсин-М', ' Саммит Агро <p>Обязательным условием является приготовление раствора в день обработки растения. Необходимо взять емкость с небольшим количеством воды и растворить в ней дозу препарата. После этого смесь тщательно перемешивается и переливается в опрыскиватель. Предварительно в бак необходимо налить воду так, чтобы она заполняла его на ¼. Оптимальной считается пропорция, когда на 10 л воды берут 10-15 г препарата. Наиболее благоприятным для проведения опрыскивания растений считается вегетативный период.&nbsp;</p><p><b>Запрещено проводить мероприятие в момент цветения: опрыскать растение нужно либо до того, как оно начнет цвести, либо после. Рекомендуется проводить две обработки культур в сезон.</b></p><p><b>\r\n\r\n</b>Выбирайте для обработки культур ясные, безветренные дни. Придерживайтесь интервала между процедурами — он должен составлять не менее двух недель.<b><br></b></p> <p>\r\n\r\nПрепарат <b>«Топсин-М»</b> представляет собой фунгицид, который оказывает влияние на растения благодаря контактно-системному воздействию на источник инфекции. Средство можно использовать в целях профилактики и борьбы с грибковыми заболеваниями, атакующими культурные растения, а также для уничтожения вредных насекомых: златоглазки, листоеда, тли.&nbsp;</p><p>Действующее вещество и форма выпуска Препарат выпускается в виде порошка, обладает хорошими растворимыми свойствами. При необходимости приобретения больших объемов средства, его можно купить в мешке (10 кг). Также на рынке предложен вариант «Топсина-М» в виде концентрированной эмульсии по 5 л в бутыли. Для единоразового применения можно приобрести порошок в упаковках по 10, 25 или 500 г.<br></p><p>\r\n\r\n<b>К основным преимуществам фунгицида относятся:&nbsp;</b></p><p>- активная борьба против микоз разных видов;&nbsp;</p><p>- блокирование роста и размножения патогенных микроорганизмов в течение первых 24 часов;&nbsp;</p><p>- способность оказывать лечебное воздействие на уже пораженные грибками растения;&nbsp;</p><p>- возможность использовать порошок одновременно и для профилактики, и для уничтожения фитопатогенных грибов;</p><p>- препарат не фитотоксичен, поэтому может использоваться для восстановления сильно ослабленных и больных растений;&nbsp;</p><p>- допускается применение средства в бак-смесях;&nbsp;</p><p>- хорошая экономичность в расходе;&nbsp;</p><p>- отсутствие вреда для медоносных насекомых; эффективная борьба с насекомыми.<br><br></p> <p>\r\n\r\n<b>Важно! Препарат вызывает привыкание у растений, и частое его использование может не дать результатов.</b></p><p><b>\r\n\r\nПрепарат не опасен для птиц, обладает незначительной токсичностью по отношению к пчелам. Очень осторожно стоит работать с препаратом возле водоемов, так как он пагубно влияет на рыб. Запрещено использовать водоемы для мытья оборудования, которое применялось при опрыскивании растений.</b></p><p><b>Плохо взаимодействует с щелочными препаратами (Бордосская смесь)<br></b><br><br></p>', 0, 'chemical', 36, '2018-10-21 17:22:04', '2018-10-21 14:22:04'),
(103, 'Топаз', ' Сингента <p>\r\n\r\n</p><p>Действующее вещество топаза высокоэффективно, прежде всего, против возбудителей настоящих мучнистых рос, особенно при первичном поражении. Топаз также широко применяется для лечения плодовой гнили, пурпуровой пятнистости, сетчатой пятнистости, серой гнили, ржавчины, парши, септориоза, церкоспореллеза, оидиума.</p><p>Приготовленным раствором тщательно опрыскивают растения в сухую безветренную погоду.</p><p>Топаз на винограде и косточковых (вишни, персики, яблони) &nbsp;первый раз применяется перед цветением, второй раз – после цветения.  Допускается всего 3-4 обработки.</p><p>На овощах и комнатных цветах Топаз применяют при первых признаках заболевания.</p><p>Топаз на ягодах первый раз применяется в момент образования бутонов, второй раз – после сбора ягод.  Допускается только 2 обработки.</p><p>Особенно удачно сочетание препаратов Топаз и Купроксат. Следует учитывать, возможность возникновения резистентности к фунгициду, поэтому в садах, где инфекции наиболее распространены (например, когда неблагонадёжные соседи не хотят обрабатывать деревья от парши), лучше чередовать Топаз с фунгицидами из других химических групп.</p><p>\r\n\r\n</p><p>2 мл препарата Топаз рассчитаны в среднем на 10 л для различных болезней и только против ржавчины норма составляет 4 мл на 10 л воды.</p><p>Для применения на комнатных цветах фунгицид Топаз лучше разводить в малом количестве воды. Весь объём ампулы нужно набрать в шприц на 2 мл, и затем дозировать нужное количество, например, 1 мл на 5 л воды. Оставшийся в шприце препарат хранить с закрытым колпачком при комнатной температуре, в темноте и недоступном для детей месте.</p><p>Возможно увеличение концентрации не более чем в 1,5-2 раза, т.е. 3-4 мл Топаза на 10 л воды. Растения при этом не чувствуют угнетенности. Если проявляется вялость листьев, это может быть реакция нарушения в уходе, например, на переувлажнение грунта.</p><p>[URL=<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru/full/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html][IMG]https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg[/IMG][/URL\">https://savepice.ru/full/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html][IMG]https://cdn1...</a>] [URL=<a target=\"_blank\" rel=\"nofollow\" href=\"http://glibzagoriy.me]Загорій/URL\">http://glibzagoriy.me]Загорій/URL</a>]<br></p><p>&lt;a href=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru/view/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html&quot;\">https://savepice.ru/view/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg.html\"</a>; target=\"_blank\" title=\"хостинг картинок\"&gt;&lt;img src=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg&quot;\">https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-prev.jpg\"</a>; border=\"0\"/&gt;&lt;/a&gt;<br></p><p><br></p><p>&lt;a href=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://savepice.ru&quot;\">https://savepice.ru\"</a>; target=\"_blank\" title=\"хостинг картинок\"&gt;&lt;img src=\"<a target=\"_blank\" rel=\"nofollow\" href=\"https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg&quot;\">https://cdn1.savepice.ru/uploads/2018/10/22/6d21dc66a3c018ff3f8147677e8b85ba-full.jpg\"</a>; border=\"0\"/&gt;&lt;/a&gt;<br></p><p>Нормы расхода рабочей жидкости: 2 л на небольшое дерево, до 5 л на больше дерево, 1,5-2 л на куст (смородины, крыжовника), овощи - до 5 л на сотку.</p>\r\n\r\n<br><p></p>\r\n\r\n<br><p></p> <p>\r\n\r\n<strong>Топаз </strong>– системный фунгицид для защиты семечковых, косточковых, ягодных, овощных, декоративных культур и виноградной лозы от настоящей мучнистой росы и других болезней.\r\n\r\n<br></p> <p>\r\n\r\n<b>Запрещено применение в водоохранной зоне водоемов\r\n</b>\r\n<br></p>', 0, 'chemical', 37, '2018-10-22 11:10:16', '2018-10-22 08:10:16'),
(104, 'Тест для Р', ' производитель <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 38, '2018-10-21 15:30:47', '2018-10-21 15:30:47'),
(105, 'Тест для Р 2', ' производитель 2 <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 39, '2018-10-22 07:38:04', '2018-10-22 07:38:04'),
(106, 'Тест для Р 3', ' производитель <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 40, '2018-10-22 07:38:04', '2018-10-22 07:38:04'),
(107, 'Тест для Р 4', ' производитель 4 <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 41, '2018-10-22 07:38:04', '2018-10-22 07:38:04'),
(108, 'Тест для Р 6', ' производитель <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 42, '2018-10-22 07:38:04', '2018-10-22 07:38:04'),
(109, 'Тест для Р 7', ' производитель 4 <p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris finibus ac odio ut tincidun<b>t. Vivamus blandit sed velit in blandit. Sed porttitor id leo at elementum.</b> Nullam varius lacus at dictum accumsan. In risus enim, blandit id gravida at, tincidunt et nibh. Proin id maximus tortor, non blandit sapien. Sed in semper sem, ac dignissim purus. Curabitur quis vestibulum arcu, sed efficitur tortor. Cras elit ex, condimentum ut interdum a, dignissim sed nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus eget nibh lacus. Curabitur vitae dui sit amet ipsum efficitur tincidunt sed sit amet diam. Integer commodo mattis nisl, eget vestibulum risus. Nunc euismod elementum nunc quis vulputate.\r\n\r\n<br></p> <p>\r\n\r\nInteger posuere nisi eget lectus suscipit suscipit. Nunc imperdiet eros eu quam ullamcorper ullamcorper. Maecenas sollicitudin nibh lacus. Aenean ut sapien lectus. Etiam vitae turpis tincidunt mauris hendrerit consectetur. Vestibulum imperdiet consectetur congue. Nullam volutpat venenatis tortor id fermentum.<b> Pellentesque pellentesque lacinia sem. N</b>am dignissim mattis euismod. Nunc placerat at mi imperdiet pulvinar.\r\n\r\n<br></p> <p>\r\n\r\nPraesent rhoncus augue sapien, id rutrum augue fermentum sed. Vestibulum accumsan ultrices tellus, ac venenatis enim ultricies nec. Morbi maximus tempus rutrum. Quisque in dolor cursus, egestas nisi at, ultrices odio. Sed semper hendrerit sapien id molestie. Integer sollicitudin, ex ornare scelerisque tincidunt, odio dui mattis diam, non interdum lorem enim non tellus. Pellentesque a lobortis augue. Praesent dignissim magna vel lectus finibus porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam efficitur ligula at euismod dapibus. Fusce tincidunt, lectus ut scelerisque faucibus, dui tortor porta metus, nec pulvinar lectus neque quis ipsum. Mauris in mi eros.\r\n\r\n<br></p>', 0, 'chemical', 43, '2018-10-22 07:38:04', '2018-10-22 07:38:04'),
(110, 'Парша', ' Первые признаки заболевания     На листьях не сразу появляются характерные черные пятна с бархатистым налетом. Вначале болезнь на листьях заметна в виде не четких, округлых расплывчатых хлоротичных пятен. К этому времени гриб уже успел причинить вред, начав разрушать растительные ткани. Через несколько дней пятна приобретают видимые признаки темных пятен с характерным бархатистым налетом. При благоприятных условиях гриб распространяется по всей кроне.\r\n\r\nПрофилактика парши яблонь и груш     Кроны деревьев должны хорошо освещаться солнцем, быстро продуваться ветром при влажной погоде. Для этого необходима ежегодная обрезка кроны. Хорошо освещенная и быстро продуваемая крона яблони меньше подвержена заражению.     Приствольные круги лучше содержать под черным паром в течении всего периода вегетации. Это снижает вредоносность парши.     Практически единственным источником весенней инфекции являются опавшие листья, пораженные паршой в пошлом сезоне. Чтобы защитить свои деревья от болезни, нужно осенью тщательно собрать и заделать в землю всю опавшую листву, перекопать междурядья с заделкой листьев в почву.  На грушах следует уничтожать не только листья, но пораженные паршой побеги.&nbsp;&nbsp; Как лечить паршу яблони и груши     Если болезнь только начинается, или проявляется слабо, можно обработать яблони агатом — 25 К или цирконом.     Лечение  «Бордоской смесью»     Наиболее известным и проверенным способом лечения парши яблони и груши, является бордоская жидкость. Действие бордоской жидкости сохраняется до двух недель, поэтому за один сезон приходится делать 6 — 7 обработок.     Самое первое опрыскивание делается перед распусканием почек. ( 300 гр. медного купороса, 350 гр. извести развести в ведре воды )     Последующие обработки проводят через каждые две недели. Концентрацию раствора делают слабее ( 100 гр. медного купороса, 100 гр. извести на ведро воды ) Бордоскую жидкость допускается заменить на любой другой медьсодержащий препарат. Опрыскивание яблони.     Лечение  препаратами системного действия     Скор. За один сезон допустимо сделать две обработки этим препаратом. Обработки проводят с интервалом в 2 недели, до цветения и сразу после цветения ( 2 мл. на 10л. воды ) Препарат сохраняет свое действие 20 дней.     Строби. «Строби» используется для лечения парши яблони, груши, мучнистой росы. За лето можно провести до 3 обработок, интервал — 2 недели. Срок действия препарата — 35 дней. Применение «Строби» можно совмещать с другими фунгицидами.     Хорус. Препарат эффективен при низких + 3 — 10*С температурах, не смывается дождем. Обработки проводят дважды за сезон, при распускании почек и в самом конце цветения. Срок действия — 30 дней.     Лечение минеральными удобрениями     Лечить паршу  можно с помощью мин. удобрений. В этом случае одновременно с лечением проводится и внекорневая подкормка растений. Деревья опрыскивают раствором любого из этих удобрений: аммиачная селитра, концентрация 10% сульфат аммония, концентрация 10% хлористый калий, концентрация 3 — 10% сульфат калия, концентрация 3 — 10% калийная селитра, концентрация 5 — 15% калийная соль, концентрация 5 — 10%     Комплексное лечение   Чтобы добиться наилучших результатов, следует использовать комплексный подход для лечения парши.     Для этого осенью обрабатывают деревья одним из растворов мин. удобрения (как описано выше ). Обработку проводят после сбора урожая, перед листопадом. Температура воздуха должна быть не ниже +4*С. Это будет способствовать уничтожению и других вредителей, да еще и повысит урожайность яблони.     Весной перед цветением опрыскивают деревья и приствольные круги бордоской жидкостью ( или любым другим медьсодержащим препаратом ).     После цветения проводят опрыскивание деревьев каким либо фунгицидом ( строби, скор ) или любым другим.     Чтобы облегчить уход за садом, подбирайте сорта яблонь и груш устойчивых к этому распространенному заболеванию.', 6, 'disease', 38, '2018-10-22 07:38:43', '2018-10-22 07:38:43'),
(111, 'Вопрос 1', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры позволяет оценить значение новых предложений.\r\n\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', 4, 'question', 2, '2018-10-22 09:09:11', '2018-10-22 09:09:11'),
(112, 'Вопрос 1', 'Значимость этих проблем настолько очевидна, что сложившаяся структура организации требуют от нас анализа соответствующий условий активизации. Разнообразный и богатый опыт начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач. Задача организации, в особенности же сложившаяся структура организации обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Не следует, однако забывать, что реализация намеченных плановых заданий требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также сложившаяся структура организации позволяет выполнять важные задания по разработке систем массового участия. Таким образом сложившаяся структура организации влечет за собой процесс внедрения и модернизации форм развития.Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации существенных финансовых и административных условий. Задача организации, в особенности же рамки и место обучения кадров требуют от нас анализа систем массового участия.\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', 4, 'question', 3, '2018-10-22 09:09:11', '2018-10-22 09:09:11'),
(113, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 09:09:11', '2018-10-22 09:09:11'),
(118, 'Вопрос 1', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры позволяет оценить значение новых предложений.\r\n\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', 4, 'question', 2, '2018-10-22 09:24:03', '2018-10-22 09:24:03'),
(121, 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при ', 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 4, 'question', 17, '2018-10-25 11:33:08', '2018-10-25 08:33:08'),
(132, 'asdasd', 'asdasdasdas', 4, 'question', 17, '2018-10-22 16:35:24', '2018-10-22 16:35:24'),
(133, 'asdasd', 'asdasdasdas', 4, 'question', 17, '2018-10-22 16:42:58', '2018-10-22 16:42:58');
INSERT INTO `searches` (`id`, `title`, `text`, `section_id`, `type`, `target_id`, `created_at`, `updated_at`) VALUES
(134, 'Вопрос 1', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры позволяет оценить значение новых предложений.\r\n\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', 4, 'question', 2, '2018-10-22 17:06:46', '2018-10-22 17:06:46'),
(135, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:28:07', '2018-10-22 17:28:07'),
(136, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:28:07', '2018-10-22 17:28:07'),
(137, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:28:16', '2018-10-22 17:28:16'),
(138, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:28:16', '2018-10-22 17:28:16'),
(139, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:29:58', '2018-10-22 17:29:58'),
(140, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:29:58', '2018-10-22 17:29:58'),
(141, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:30:21', '2018-10-22 17:30:21'),
(142, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:30:21', '2018-10-22 17:30:21'),
(143, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:30:56', '2018-10-22 17:30:56'),
(144, 'Вопрос5', 'Текст', 4, 'question', 4, '2018-10-22 17:30:56', '2018-10-22 17:30:56'),
(145, 'Вопрос 1', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры позволяет оценить значение новых предложений.\r\n\r\n\r\nНе следует, однако забывать, что укрепление и развитие структуры требуют определения и уточнения модели развития. Таким образом реализация намеченных плановых заданий требуют определения и уточнения соответствующий условий активизации. Повседневная практика показывает, что укрепление и развитие структуры требуют определения и уточнения новых предложений. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. Разнообразный и богатый опыт новая модель организационной деятельности представляет собой интересный эксперимент проверки новых предложений.', 4, 'question', 2, '2018-10-24 06:21:31', '2018-10-24 06:21:31'),
(149, 'Яблоня', '', 6, 'culture', 1, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(150, 'Груша', '', 6, 'culture', 4, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(151, 'Клубника', '', 6, 'culture', 52, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(152, 'Малина', '', 6, 'culture', 53, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(153, 'Черешня', '', 6, 'culture', 54, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(154, 'Персик', '', 6, 'culture', 55, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(155, 'Шелковица', '', 6, 'culture', 56, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(156, 'Слива', '', 6, 'culture', 57, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(157, 'Абрикос', '', 6, 'culture', 58, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(158, 'Алыча', '', 6, 'culture', 59, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(159, 'Рябина', '', 6, 'culture', 60, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(160, 'Айва', '', 6, 'culture', 61, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(161, 'Боярышник', '', 6, 'culture', 62, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(162, 'Вишня', '', 6, 'culture', 63, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(163, 'Ежевика', '', 6, 'culture', 64, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(164, 'Вишня войлочная', '', 6, 'culture', 65, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(165, 'Виноград', '', 6, 'culture', 66, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(166, 'Крыжовник', '', 6, 'culture', 67, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(167, 'Ирга', '', 6, 'culture', 68, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(168, 'Облепиха', '', 6, 'culture', 69, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(169, 'Жимолость', '', 6, 'culture', 70, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(170, 'Калина', '', 6, 'culture', 71, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(171, 'Смородина красная', '', 6, 'culture', 72, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(172, 'Смородина черная', '', 6, 'culture', 74, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(173, 'Ананас', '', 6, 'culture', 75, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(174, 'Кокос', '', 6, 'culture', 76, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(175, 'Апельсин', '', 6, 'culture', 77, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(176, 'Мандарин', '', 6, 'culture', 78, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(177, 'Кумкват', '', 6, 'culture', 79, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(178, 'Фейхоа', '', 6, 'culture', 80, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(179, 'Киви', '', 6, 'culture', 81, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(180, 'Черника', '', 6, 'culture', 82, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(181, 'Голубика', '', 6, 'culture', 83, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(182, 'Брусника', '', 6, 'culture', 84, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(183, 'Нектарин', '', 6, 'culture', 85, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(184, 'Лимон', '', 6, 'culture', 86, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(185, 'Грейпфрут', '', 6, 'culture', 87, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(186, 'Банан', '', 6, 'culture', 88, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(187, 'Гранат', '', 6, 'culture', 89, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(188, 'Манго', '', 6, 'culture', 90, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(189, 'Авокадо', '', 6, 'culture', 91, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(190, 'Земляника', '', 6, 'culture', 92, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(191, 'Картофель', '', 5, 'culture', 93, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(192, 'Томат', '', 5, 'culture', 94, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(193, 'Огурец', '', 5, 'culture', 95, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(194, 'Капуста', '', 5, 'culture', 96, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(195, 'Морковь', '', 5, 'culture', 97, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(196, 'Свекла столовая', '', 5, 'culture', 98, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(197, 'Свекла сахарная', '', 5, 'culture', 99, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(198, 'Редис', '', 5, 'culture', 100, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(199, 'Редька', '', 5, 'culture', 101, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(200, 'Репа', '', 5, 'culture', 102, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(201, 'Пшеница', '', 5, 'culture', 103, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(202, 'Гречиха', '', 5, 'culture', 104, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(203, 'Соя', '', 5, 'culture', 105, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(204, 'Рис', '', 5, 'culture', 106, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(205, 'Ячмень', '', 5, 'culture', 107, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(206, 'Овес', '', 5, 'culture', 108, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(207, 'Рожь', '', 5, 'culture', 109, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(208, 'Кориандр', '', 5, 'culture', 110, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(209, 'Лен', '', 5, 'culture', 111, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(210, 'Подсолнечник', '', 5, 'culture', 112, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(211, 'Кукуруза', '', 5, 'culture', 113, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(212, 'Руккола', '', 5, 'culture', 114, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(213, 'Салат', '', 5, 'culture', 115, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(214, 'Анис', '', 5, 'culture', 116, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(215, 'Базилик', '', 5, 'culture', 117, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(216, 'Укроп', '', 5, 'culture', 118, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(217, 'Хлопок', '', 5, 'culture', 119, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(218, 'Петрушка', '', 5, 'culture', 120, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(219, 'Мята', '', 5, 'culture', 121, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(220, 'Сельдерей', '', 5, 'culture', 122, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(221, 'Капуста цветная', '', 5, 'culture', 123, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(222, 'Хрен', '', 5, 'culture', 124, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(223, 'Спаржа', '', 5, 'culture', 125, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(224, 'Шпинат', '', 5, 'culture', 126, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(225, 'Тмин', '', 5, 'culture', 127, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(226, 'Артишок', '', 5, 'culture', 128, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(227, 'Имбирь', '', 5, 'culture', 129, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(228, 'Фасоль', '', 5, 'culture', 130, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(229, 'Лук  (на зеленку)', '', 5, 'culture', 131, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(230, 'Горох', '', 5, 'culture', 132, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(231, 'Лук репчатый', '', 5, 'culture', 133, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(232, 'Арахис', '', 5, 'culture', 134, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(233, 'Чеснок', '', 5, 'culture', 135, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(234, 'Дыня', '', 5, 'culture', 136, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(235, 'Арбуз', '', 5, 'culture', 137, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(236, 'Баклажан', '', 5, 'culture', 138, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(237, 'Перец сладкий', '', 5, 'culture', 139, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(238, 'Перец острый', '', 5, 'culture', 140, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(239, 'Кабачки', '', 5, 'culture', 141, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(240, 'Тыква', '', 5, 'culture', 142, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(241, 'Мелисса', '', 5, 'culture', 143, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(242, 'Патиссон', '', 5, 'culture', 144, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(243, 'Брюква', '', 5, 'culture', 145, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(244, 'Щавель', '', 5, 'culture', 146, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(245, 'Цукини', '', 5, 'culture', 147, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(246, 'Фенхель', '', 5, 'culture', 148, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(247, 'Маслята', '', 5, 'culture', 149, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(248, 'Опята', '', 5, 'culture', 150, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(249, 'Белый гриб', '', 5, 'culture', 151, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(250, 'Лисички', '', 5, 'culture', 152, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(251, 'Шампиньон', '', 5, 'culture', 153, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(252, 'Вешенки', '', 5, 'culture', 154, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(253, 'Агератум', '', 4, 'culture', 155, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(254, 'Азарина', '', 4, 'culture', 156, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(255, 'Алиссум', '', 4, 'culture', 157, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(256, 'Амарант', '', 4, 'culture', 158, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(257, 'Антирринум', '', 4, 'culture', 159, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(258, 'Астры', '', 4, 'culture', 160, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(259, 'Бальзамин', '', 4, 'culture', 161, '2018-10-25 10:38:13', '2018-10-25 10:38:13'),
(260, 'Барвинка', '', 4, 'culture', 162, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(261, 'Бархатцы', '', 4, 'culture', 163, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(262, 'Бегония', '', 4, 'culture', 164, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(263, 'Брахикома', '', 4, 'culture', 165, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(264, 'Василек', '', 4, 'culture', 166, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(265, 'Вербена', '', 4, 'culture', 167, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(266, 'Вьюнок', '', 4, 'culture', 168, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(267, 'Газания', '', 4, 'culture', 169, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(268, 'Гвоздика', '', 4, 'culture', 170, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(269, 'Георгин', '', 4, 'culture', 171, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(270, 'Гипсофила', '', 4, 'culture', 172, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(271, 'Датура(дурман)', '', 4, 'culture', 173, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(272, 'Дельфиниум', '', 4, 'culture', 174, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(273, 'Диморфотек', '', 4, 'culture', 175, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(274, 'Душистый горошек', '', 4, 'culture', 176, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(275, 'Иберис', '', 4, 'culture', 177, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(276, 'Ипомея', '', 4, 'culture', 178, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(277, 'Календула', '', 4, 'culture', 179, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(278, 'Кларкия', '', 4, 'culture', 180, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(279, 'Клеома', '', 4, 'culture', 181, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(280, 'Клещевина', '', 4, 'culture', 182, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(281, 'Колеус', '', 4, 'culture', 183, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(282, 'Кореопсис', '', 4, 'culture', 184, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(283, 'Космея', '', 4, 'culture', 185, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(284, 'Лаватера', '', 4, 'culture', 186, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(285, 'Левкой', '', 4, 'culture', 187, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(286, 'Лобелия', '', 4, 'culture', 188, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(287, 'Лобулярия', '', 4, 'culture', 189, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(288, 'Мак', '', 4, 'culture', 190, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(289, 'Маттиола', '', 4, 'culture', 191, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(290, 'Мимулюс', '', 4, 'culture', 192, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(291, 'Настурция', '', 4, 'culture', 193, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(292, 'Немезия', '', 4, 'culture', 194, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(293, 'Немофила', '', 4, 'culture', 195, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(294, 'Нигелла', '', 4, 'culture', 196, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(295, 'Остеоспермум', '', 4, 'culture', 197, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(296, 'Пеларгония', '', 4, 'culture', 198, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(297, 'Петуния', '', 4, 'culture', 199, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(298, 'Портулак', '', 4, 'culture', 200, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(299, 'Рудбекия', '', 4, 'culture', 201, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(300, 'Сальвия', '', 4, 'culture', 202, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(301, 'Флокс', '', 4, 'culture', 203, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(302, 'Хризантема', '', 4, 'culture', 204, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(303, 'Целозия', '', 4, 'culture', 205, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(304, 'Цинерария', '', 4, 'culture', 206, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(305, 'Цинния', '', 4, 'culture', 207, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(306, 'Эустома', '', 4, 'culture', 208, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(307, 'Эшшольция', '', 4, 'culture', 209, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(308, 'Клематис', '', 4, 'culture', 210, '2018-10-25 10:38:14', '2018-10-25 10:38:14'),
(310, 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при', 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', 4, 'question', 17, '2018-10-26 07:57:42', '2018-10-26 07:57:42'),
(311, 'Тест', 'ырввиьжадьидлапид', 6, 'question', 26, '2018-10-30 05:52:46', '2018-10-30 05:52:46');

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `name`, `title`, `text`, `created_at`, `updated_at`, `image`, `slug`) VALUES
(4, 'Клумба', 'титулка клумбы', 'текст клумбы', '2018-06-06 07:05:36', '2018-10-03 09:52:33', NULL, NULL),
(5, 'Огород', 'титулка огорода', 'текст огорода', '2018-06-06 07:05:41', '2018-10-03 09:52:57', NULL, NULL),
(6, 'Сад', 'титулка сада', 'текст сада', '2018-06-06 07:05:45', '2018-10-03 09:52:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `sorts`
--

CREATE TABLE `sorts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `main_photo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` int(11) NOT NULL,
  `culture_id` int(11) NOT NULL,
  `rating` double(2,1) DEFAULT '0.0',
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `merchantability` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sorts`
--

INSERT INTO `sorts` (`id`, `name`, `slug`, `vendor_code`, `content`, `main_photo`, `section_id`, `culture_id`, `rating`, `is_new`, `merchantability`, `created`, `created_at`, `updated_at`) VALUES
(35, 'Белый налив', 'Белый налив', '', '<b>ОПИСАНИЕ:&nbsp;</b>Летний сорт: яблочки первые, по-весеннему свежие, ароматно хрустящие. Дерево высокое, раскидистое. Горизонтально растущие ветви придают кроне округлую форму. Плоды крупные, светло-кремовые, покрыты белой восковой пыльцой. Мякоть сочная, зернистая, снежно-крахмального оттенка.&nbsp;<div><b>ОСОБЕННОСТИ ВЫРАЩИВАНИЯ:&nbsp;&nbsp;</b>Деревца лучше высаживать на северных склонах холмов: растение обладает отличной зимостойкостью, но хуже переносит засухи и жару. К структуре и типу почв Налив равнодушен: главное, чтобы земля была плодородной и регулярно увлажняемой. Формирующую обрезку выполняют по традиционной схеме: ежегодно оставляют 4–5 скелетный ветвей соответствующего порядка. Санитарную обрезку проводят регулярно: крона склонна к загущению.\r\n\r\n \r\n\r\n<b>ДОСТОИНСТВА СОРТА:&nbsp;</b>Урожайность молодого дерева может составить 1,5 центнера. Растение исключительно зимостойко: его можно выращивать и северных районах. Рекомендуем заказать саженцы Белый налив: скороспелая яблоня – источник ранних витаминов и отличное средство для быстрого приготовления соков, сидров, компотов.</div>', 'sort/sort_35_photo_5bd2ea1e130cb.jpg', 6, 1, 0.0, 1, 0, '2018-09-12 08:09:40', '2018-09-12 08:09:40', '2018-10-26 07:19:16'),
(37, 'Груша медовая', 'Груша медовая', '', '<b>ОПИСАНИЕ</b>\r\nОгромные плоды груши Медовая созревают глубокой осенью – культура относится к позднеспелым сортам. На дереве формируются огромные плоды, которые достигают веса от 400 до 520 г. Тонкая кожица плодов имеет желто-зеленую окраску с коричневато-рыжей пигментацией, структура поверхности бугристая, матовая. Мякоть – нежная, кремово-белого оттенка, сочная, приятная на вкус, отличается высоким содержанием сахара и аскорбиновой кислоты. Урожайность – до 1 ц отборных плодов с дерева.&nbsp;<div><br></div>', 'sort_37_photo_5b98fa4a05d61.jpg', 6, 4, 0.0, 1, 0, '2018-09-12 08:36:42', '2018-09-12 08:36:42', '2018-10-18 15:07:43'),
(47, 'Мелитопольский ранний', 'Мелитопольский ранний', '', 'Этот сорт замечательно будет смотреться на любом участке, ведь он устойчив ко многим заболеваниям, а также отличается высокой степенью зимостойкости, выдерживая температуры до -30 градусов. Форма растения древовидная, средняя урожайность, плоды размеров до 50-60 г. каждый. Форма плодов овальная, немного приплюснутая, оранжево-желтые с тонкой кожицей, ароматная мякоть без волокон,которая не оставит никого равнодушным. Кисло-сладкий вкус и естественный аромат не оставят равнодушным любого любителя этого плода.\r\n\r\nМелитопольский ранний -сорт,который не требует особенного ухода, главное – это регулярная обрезка, чтобы не получить загущенную крону.\r\nЕдинственным недостатком является плохая транспортировка плодов и их хранение, только в недозревшем виде.', 'sort_47_photo_5bb35bbcd2861.jpg', 6, 58, 3.5, 1, 0, '2018-10-02 08:51:24', '2018-10-02 08:51:24', '2018-10-02 08:51:25'),
(48, 'Абрикос Лескора', 'Абрикос Лескора', '', 'Этот сорт был выведен неизвестным селекционером и перекочевал к нам из Чехии. Широко не офишировался, поэтому не так известен среди любителей культуры, хотя и обладает рядом неоспоримых преимуществ. Там сорт выращивается довольно давно, так как дачникам очень нравится его скороспелость.\r\n\r\nАбрикос характеризуется сильным  деревом, его крона  обратнопирамидальная, что является необычным для этой культуры. Плоды дерева средней величины, а иногда и большие,обычно до 60 г, обладают приятным характерным вкусом и сильным, естественным ароматом. Одним из немногих недостатков сорта является слабая устойчивость к некоторым заболеваниям, например монилиозу.\r\n\r\nВажно для нормального роста регулярно проводить профилактику растения  и обрабатывать его специальными препаратами против грибковых заболеваний. Также необходимо обеспечить полив в летнее время.', 'sort_48_photo_5bb3651d23c4c.jpg', 6, 58, 2.7, 1, 0, '2018-10-02 09:31:25', '2018-10-02 09:31:25', '2018-10-25 13:34:46'),
(49, 'Краснощекий', 'Краснощекий', '', 'Растение хорошо растет преимущественно в южных районах. Крупное дерево с длинными ветвями и раскидистой  кроной.  Дерево показывают одну из самых высоких урожайностей – до 90 кг с дерева.\r\nПлоды образуются на прошлогодних молодых ветках, поэтому это нужно учитывать при обрезке дерева.\r\n\r\nПлоды\r\nСозревает абрикос в конце июля. Если урожай выдается хорошим, то процесс созревания плодов может растянуться на длительный период. Сбор урожая осуществляется поэтому в несколько волн. Абрикосы могут полностью осыпаться, когда достигнут созревания. Ориентировочный срок хранения плодов после сбора составляет 10 дней.\r\n\r\nПлоды  вытянутой округлой формы и светло-оранжевого цвета. Название свое сорт получил из-за красноватого оттенка на «щеках» фрукта. Вкус сладкий, с некоторой кислинкой.\r\nАбрикос самоплодный, прекрасно себя чувствует в односортных посадках, ему не требуется присутствие других абрикосовых деревьев для опыления и формирования завязей. Поскольку цветение происходит поздно-весенние заморозки не оказывают сильного влияния на урожайность.\r\n\r\nСорт подвержен инфекциям пятнистости и монилиозу. Особенно страдают деревья от этих заболеваний, если весной и в первой половине лета обильные туманы, дожди, а также при значительном загущении кроны. Поэтому надо внимательно следить за состоянием листьев и при первых признаках заболевания обработать соответствующими препаратами. А так же рекомендуется проводить профилактические обработки. Поэтому не рекомендуется сажать этот сорт в низинах, влажных участках с застоем воздушных потоков.', 'sort_49_photo_5bb37398b436a.jpg', 6, 58, 0.0, 1, 0, '2018-10-02 10:33:12', '2018-10-02 10:33:12', '2018-10-02 10:33:13'),
(50, 'Полесский крупноплодный', 'Полесский крупноплодный', '', 'Сорт обладает средней скороплодностью, дает стабильный урожай , плоды крупные (от 50-55 г до 70-80 г), зимостойкий ствол.\r\nПлоды  округло-овальные, слегка сдавленные с боков. Кожица жёлто-оранжевая, с лёгким румянцем. Мякоть золотисто-оранжевая, нежная, ароматная, хорошего кисло-сладкого вкуса. Косточка мелкая, хорошо отделяется от мякоти.\r\n\r\nПлоды созревают в конце июля.\r\n\r\nПлоды образуется на однолетних молодых побегах, это нужно учитывать при обрезке!!!', 'sort_50_photo_5bb378ee3d6da.jpg', 6, 58, 0.0, 1, 0, '2018-10-02 10:55:58', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(51, 'Ялтинец', 'Ялтинец', '', 'Дерево обладает  необычными плодами, раскидной кроной и сильным ростом. Плоды крупные, до 60 г, яйцевидные, по бокам приплюснутые, бывают и ярко-желтые со специфическим оттенком, но чаще всего оранжевые. Вкус обладает ярко-выраженным характерным оттенком. Одно из основных отличий сорта от других.\r\n\r\nЗамечательно подходит как для консервирования и заготовок, так и для свежего употребления.\r\n\r\nРастение устойчиво к заморозкам и засухам,  не подвержено многим заболеваниям и дает стабильный высокий урожай.', 'sort_51_photo_5bb45e1b3b5d7.jpg', 6, 58, 0.0, 1, 0, '2018-10-03 03:13:47', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(52, 'Ананасный', 'Ананасный', '', 'Описание сорта\r\nАбрикос ананасный начинает плодоносить на 3-4 году после высадки. Поскольку плоды образуются на однолетних побегах, для увеличения урожая следует проводить регулярную обрезку и прищипывание молодых побегов.\r\n\r\nДанный абрикос относится к самоплодным сортам. Что дает высокий урожай, если растение будет на участке единственным в своем роде. Однако наличие других сортов абрикоса и персика заметно улучшает вкусовые качества данного сорта.\r\nПосле созревания плоды сильно осыпаются.\r\n\r\nПлоды средние, массой 35-45 г. Имеют неправильно округлую, продолговатую форму. Кожица не сильно плотная, средне опушена. Поверхность немного бугристая, шершавая. Спелые абрикосы матового, светло желтого или золотистого цвета, почти без румянца. Мякоть имеет светло-желтый ананасовый цвет с оранжевым оттенком и приятный аромат. Очень сочная, средней плотности, нежноволокнистая, сладкая с особенным привкусом. Косточка маленького размера, семя сладкое.\r\n\r\nСорт устойчив к курчавости листьев и клястероспориозу. Хорошо переносит морозы и быстро восстанавливается. Достаточно позднее цветение позволяет показывать стабильность в урожае. Правильный уход позволяет собирать  до 130-150 кг абрикос с одного дерева.', 'sort_52_photo_5bb4663b241d9.jpg', 6, 58, 0.0, 1, 0, '2018-10-03 03:48:27', '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(53, 'Фаворит', 'Фаворит', '', 'Этот сорт Абрикоса рекомендован для выращивания в центральном регионе РФ, хотя и является теплолюбивым растением со всеми присущими этой культуре особенностями. \r\nДерево сорта Фаворит вырастает средних размеров, до 4м. Крона метельчатая, раскидистая, редкая. Однолетние побеги ветвистые. \r\nСорт самоплодный, тем не менее является хорошим опылителем для других представителей своей культуры.\r\nУрожайность в среднем 30 ц/га, что не много по сравнению с другими сортами.\r\nЯгоды не очень крупные (30 г), округлой, слегка вытянутой формы. Опушение плодов слабое, они почти глянцевые. Цвет оранжевый с густым и большим румянцем. Мякоть сочная, тающая, сладко-кислая. Дегустационная оценка 5 баллов (при регистрации было 4,5 балла). Косточка маленькая и отлично отделяется.\r\nПлоды хорошо лежат и транспортабельны. В прохладном и проветриваемом помещении могут лежать до одного месяца.\r\n\r\nГлавным недостатком сорта является позднее созревание. В условиях холодного лета и поздней весны  плоды могут не успевать вызревать. В эти же годы возможно заражение клястероспориозом, к которому у Фаворита средний иммунитет.', 'sort_53_photo_5bb47feebe507.jpg', 6, 58, 0.0, 1, 0, '2018-10-03 05:38:06', '2018-10-03 05:38:06', '2018-10-03 05:38:07'),
(61, 'Без сорта', 'Без сорта', '', 'Под эту категорию попадают все растения, сорт которых неизвестен. По ним нет какой-либо информации.', 'sort/sort_61_photo_5bb5bcb8a1576.jpg', 6, 58, 0.0, 1, 0, '2018-10-04 04:09:44', '2018-10-04 04:09:44', '2018-10-04 04:09:45');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_calendars`
--

CREATE TABLE `sort_calendars` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `m1` int(11) DEFAULT NULL,
  `m2` int(11) DEFAULT NULL,
  `m3` int(11) DEFAULT NULL,
  `m4` int(11) DEFAULT NULL,
  `m5` int(11) DEFAULT NULL,
  `m6` int(11) DEFAULT NULL,
  `m7` int(11) DEFAULT NULL,
  `m8` int(11) DEFAULT NULL,
  `m9` int(11) DEFAULT NULL,
  `m10` int(11) DEFAULT NULL,
  `m11` int(11) DEFAULT NULL,
  `m12` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sort_calendars`
--

INSERT INTO `sort_calendars` (`id`, `sort_id`, `year`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `m9`, `m10`, `m11`, `m12`, `created_at`, `updated_at`) VALUES
(85, 35, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-12 08:09:40', '2018-09-25 09:04:25'),
(86, 35, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-12 08:09:40', '2018-09-25 09:04:25'),
(87, 35, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-12 08:09:40', '2018-09-25 09:04:25'),
(88, 35, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-12 08:09:40', '2018-09-25 09:04:25'),
(93, 37, 1, NULL, NULL, 2, 2, 2, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2018-09-12 08:36:42', '2018-10-10 07:44:58'),
(94, 37, 2, NULL, NULL, 6, 6, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, '2018-09-12 08:36:42', '2018-09-18 03:51:00'),
(95, 37, 3, NULL, NULL, 6, 6, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2018-09-12 08:36:42', '2018-09-18 03:51:00'),
(96, 37, 4, NULL, NULL, 6, 6, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2018-09-12 08:36:42', '2018-09-18 03:51:00'),
(137, 47, 1, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 08:51:25', '2018-10-02 08:53:38'),
(138, 47, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 08:51:25', '2018-10-03 05:42:57'),
(139, 47, 3, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-02 08:51:25', '2018-10-02 08:53:38'),
(140, 47, 4, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-02 08:51:25', '2018-10-02 08:53:38'),
(141, 48, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 09:31:25', '2018-10-02 09:33:08'),
(142, 48, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 09:31:25', '2018-10-02 09:33:08'),
(143, 48, 3, NULL, NULL, 6, 4, NULL, 5, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 09:31:25', '2018-10-02 09:33:08'),
(144, 48, 4, NULL, NULL, 6, 4, NULL, 5, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 09:31:25', '2018-10-02 09:33:23'),
(145, 49, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 10:33:13', '2018-10-02 10:38:13'),
(146, 49, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-02 10:33:13', '2018-10-02 10:38:13'),
(147, 49, 3, NULL, NULL, 6, NULL, 4, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-02 10:33:13', '2018-10-02 10:38:13'),
(148, 49, 4, NULL, NULL, 6, NULL, 4, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-02 10:33:13', '2018-10-02 10:38:13'),
(149, 50, 1, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, '2018-10-02 10:55:58', '2018-10-03 05:49:26'),
(150, 50, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, '2018-10-02 10:55:58', '2018-10-03 05:49:26'),
(151, 50, 3, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, 6, NULL, NULL, NULL, '2018-10-02 10:55:58', '2018-10-03 05:49:26'),
(152, 50, 4, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, 6, NULL, NULL, NULL, '2018-10-02 10:55:58', '2018-10-03 05:49:26'),
(153, 51, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:13:47', '2018-10-03 03:18:32'),
(154, 51, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:13:47', '2018-10-03 03:18:32'),
(155, 51, 3, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:13:47', '2018-10-03 03:18:32'),
(156, 51, 4, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:13:47', '2018-10-03 03:18:32'),
(157, 52, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(158, 52, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(159, 52, 3, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(160, 52, 4, NULL, NULL, 6, 4, NULL, NULL, 5, NULL, NULL, 6, NULL, NULL, '2018-10-03 03:48:27', '2018-10-03 03:49:09'),
(161, 53, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 05:38:07', '2018-10-03 05:38:32'),
(162, 53, 2, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2018-10-03 05:38:07', '2018-10-03 05:38:32'),
(163, 53, 3, NULL, NULL, 6, 4, 4, NULL, NULL, 5, NULL, 6, NULL, NULL, '2018-10-03 05:38:07', '2018-10-03 05:38:32'),
(164, 53, 4, NULL, NULL, 6, 4, 4, NULL, NULL, 5, NULL, 6, NULL, NULL, '2018-10-03 05:38:07', '2018-10-03 05:38:32'),
(193, 61, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-04 04:09:45', '2018-10-04 04:10:13'),
(194, 61, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-04 04:09:45', '2018-10-04 04:10:13'),
(195, 61, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-04 04:09:45', '2018-10-04 04:10:13'),
(196, 61, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-04 04:09:45', '2018-10-04 04:10:13');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_characteristics`
--

CREATE TABLE `sort_characteristics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sort_characteristics`
--

INSERT INTO `sort_characteristics` (`id`, `name`, `icon_path`, `created_at`, `updated_at`) VALUES
(1, 'Особенности', 'characteristic_1_photo.jpg', NULL, '2018-09-13 08:39:29'),
(8, 'Урожайность', 'characteristic_8_photo.jpg', '2018-09-14 12:15:38', '2018-09-14 12:15:38'),
(9, 'Высота растения', 'characteristic_9_photo.jpg', '2018-09-14 12:18:14', '2018-09-14 12:18:14'),
(10, 'Расстояние между растениями', 'characteristic_10_photo.jpg', '2018-09-14 12:18:44', '2018-09-14 12:19:01'),
(11, 'Местоположение', 'characteristic_11_photo.jpg', '2018-09-14 12:19:23', '2018-09-14 12:19:23'),
(12, 'Глубина посадки', 'characteristic_12_photo.jpg', '2018-09-14 12:19:49', '2018-09-14 12:19:49'),
(13, 'Вес плода', 'characteristic_13_photo.jpg', '2018-09-14 12:20:07', '2018-09-14 12:20:07'),
(14, 'Морозостойкость', 'characteristic_14_photo.jpg', '2018-09-14 12:20:26', '2018-09-14 12:20:26'),
(15, 'Стойкость к заболеваниям', '', '2018-09-20 09:09:33', '2018-09-20 09:09:33'),
(16, 'Требуется интенсивный полив', '', '2018-09-20 09:09:54', '2018-09-24 05:43:56');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_charact_relations`
--

CREATE TABLE `sort_charact_relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sort_charact_relations`
--

INSERT INTO `sort_charact_relations` (`id`, `sort_id`, `characteristic_id`, `order`, `value`, `created_at`, `updated_at`) VALUES
(20, 37, 1, 1, 'Устойчива к монилиозу и клястероспориозу, стабильный урожай.', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(21, 37, 8, 1, '80-100кг', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(22, 37, 9, 1, '2 м', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(23, 37, 10, 1, '2-3 м', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(24, 37, 11, 1, 'солнце - полутень', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(25, 37, 12, 1, '40-60 см.', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(26, 37, 13, 1, '400 -520гр', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(27, 37, 14, 1, '-30 °С', '2018-09-18 03:51:00', '2018-09-18 03:51:00'),
(28, 47, 1, 1, 'Устойчив к грибковым заболеваниям', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(29, 47, 8, 1, 'до 55 ц/га', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(30, 47, 9, 1, '5-6м', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(31, 47, 10, 1, '3м', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(32, 47, 11, 1, 'Солнце', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(33, 47, 12, 1, '70*70*70', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(34, 47, 13, 1, '50-60г', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(35, 47, 14, 1, 'Присутствует', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(36, 47, 15, 1, 'Присутствует', '2018-10-02 08:51:25', '2018-10-02 08:51:25'),
(37, 48, 1, 1, 'Плохоустойчив к монилиозу', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(38, 48, 8, 1, 'до 50 ц/га', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(39, 48, 9, 1, '5-6м', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(40, 48, 10, 1, '3м', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(41, 48, 11, 1, 'Солнце', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(42, 48, 12, 1, '70*70*70', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(43, 48, 13, 1, '40-60г', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(44, 48, 14, 1, 'Присутствует', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(45, 48, 15, 1, 'Требуется профилактика заболеваний', '2018-10-02 09:31:25', '2018-10-02 09:31:25'),
(46, 49, 1, 1, 'Неприхотливый сорт', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(47, 49, 8, 1, 'до 90кг с дерева', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(48, 49, 9, 1, '5-6м', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(49, 49, 10, 1, '4м', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(50, 49, 11, 1, 'Солнце', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(51, 49, 12, 1, '70*70*70', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(52, 49, 13, 1, '40-60г', '2018-10-02 10:33:13', '2018-10-02 10:33:13'),
(53, 50, 1, 1, 'Получается вкусный компот', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(54, 50, 8, 1, 'до 90кг с дерева', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(55, 50, 9, 1, '4-5м', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(56, 50, 10, 1, '3м', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(57, 50, 11, 1, 'Солнце', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(58, 50, 12, 1, '70*70*70', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(59, 50, 13, 1, '50-80г', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(60, 50, 14, 1, 'Присутствует', '2018-10-02 10:55:58', '2018-10-02 10:55:58'),
(61, 51, 1, 1, 'Отличные вкусовые качества', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(62, 51, 8, 1, '12,5 т/га', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(63, 51, 9, 1, '4-5м', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(64, 51, 10, 1, '3м', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(65, 51, 11, 1, 'Солнце', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(66, 51, 12, 1, '70*70*70', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(67, 51, 13, 1, '40-60г', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(68, 51, 14, 1, 'Присутствует', '2018-10-03 03:13:47', '2018-10-03 03:13:47'),
(69, 52, 1, 1, 'Устойчив к некоторым заболеваниям', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(70, 52, 8, 1, 'до 130-150 кг с дерева', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(71, 52, 9, 1, '4-5м', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(72, 52, 10, 1, '3м', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(73, 52, 11, 1, 'Солнце', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(74, 52, 12, 1, '70*70*70', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(75, 52, 13, 1, '35-45г', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(76, 52, 14, 1, 'Присутствует', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(77, 52, 15, 1, 'Присутствует', '2018-10-03 03:48:27', '2018-10-03 03:48:27'),
(78, 53, 1, 1, 'Ярко-выраженных особенностей нет', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(79, 53, 8, 1, '30 ц/га', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(80, 53, 9, 1, '3-4м', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(81, 53, 10, 1, '3м', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(82, 53, 11, 1, 'Солнце', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(83, 53, 12, 1, '70*70*70', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(84, 53, 13, 1, '30-40г', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(85, 53, 14, 1, 'Присутствует', '2018-10-03 05:38:07', '2018-10-03 05:38:07'),
(86, 61, 1, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(87, 61, 8, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(88, 61, 9, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(89, 61, 10, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(90, 61, 11, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(91, 61, 12, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(92, 61, 13, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(93, 61, 14, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(94, 61, 15, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45'),
(95, 61, 16, 1, 'Нет информации', '2018-10-04 04:09:45', '2018-10-04 04:09:45');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_operations`
--

CREATE TABLE `sort_operations` (
  `id` int(10) UNSIGNED NOT NULL,
  `operation_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sort_operations`
--

INSERT INTO `sort_operations` (`id`, `operation_name`, `icon_path`, `created_at`, `updated_at`) VALUES
(1, 'Посадка в грунт', 'actions/1.png', NULL, '2018-10-11 09:48:19'),
(2, 'Посадка на рассаду', 'actions/2.png', NULL, '2018-10-11 09:50:28'),
(3, 'Высадка рассады', 'actions/3.png', NULL, '2018-10-12 10:59:34'),
(4, 'Прополка/Уборка сорняков', ' actions/4.png', NULL, '2018-10-16 03:33:29'),
(5, 'Сбор урожая', ' actions/5.png', NULL, NULL),
(6, 'Обрезка/прищипывания', 'actions/6.png', NULL, '2018-10-16 03:32:31'),
(7, 'Никакие действия', 'actions/7.png', NULL, '2018-10-16 03:30:06'),
(8, 'Все действия', 'actions/8.png', NULL, '2018-10-16 03:30:06');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_questionaries`
--

CREATE TABLE `sort_questionaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `generation` int(11) NOT NULL,
  `landing_area` int(11) DEFAULT NULL,
  `landing_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seeding_date` date DEFAULT NULL,
  `cultivation_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ground_transplantation_date` date DEFAULT NULL,
  `trimming_date` date DEFAULT NULL,
  `is_ill` tinyint(1) DEFAULT NULL,
  `artificial_irrigation` tinyint(1) DEFAULT NULL,
  `drip_irrigation` tinyint(1) DEFAULT NULL,
  `precipitation_from_planting` int(11) DEFAULT NULL,
  `feeding_from_planting` int(11) DEFAULT NULL,
  `artificial_irrigation_from_planting` int(11) DEFAULT NULL,
  `harvest` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sort_ques_general_infos`
--

CREATE TABLE `sort_ques_general_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soil` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `high` int(11) NOT NULL,
  `precipitation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sort_ques_general_infos`
--

INSERT INTO `sort_ques_general_infos` (`id`, `user_id`, `region`, `locality`, `soil`, `high`, `precipitation`, `created_at`, `updated_at`) VALUES
(6, 69, 'ab', 'de', '10', 1, 3, '2018-10-05 08:36:39', '2018-10-05 08:36:54'),
(7, 39, '', '', '', 0, 0, '2018-10-08 09:04:06', '2018-10-08 09:04:06'),
(8, 61, 'апро', 'рол', '15', 50, 50, '2018-10-10 06:43:23', '2018-10-10 06:43:23');

-- --------------------------------------------------------

--
-- Структура таблицы `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `tariff_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_sorts` int(11) NOT NULL,
  `max_chemicals` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tariffs`
--

INSERT INTO `tariffs` (`id`, `tariff_name`, `max_sorts`, `max_chemicals`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Мастер', 15, 15, '2000.00', NULL, '2018-10-25 06:02:41'),
(2, 'Эксперт', 45, 45, '10.99', NULL, NULL),
(3, 'Гуру', 100, 100, '99.99', NULL, '2018-10-25 06:02:41'),
(4, 'Безлимит', 9999999, 9999999, '1000.00', NULL, '2018-10-25 06:02:41'),
(6, 'Пользователь', 0, 0, '0.00', NULL, '2018-10-25 06:02:41');

-- --------------------------------------------------------

--
-- Структура таблицы `tarif_histories`
--

CREATE TABLE `tarif_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `tariff_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tarif_histories`
--

INSERT INTO `tarif_histories` (`id`, `user_id`, `tariff_id`, `created_at`, `updated_at`) VALUES
(1, 21, 3, '2018-09-29 09:17:50', '2018-09-29 09:17:50'),
(2, 25, 3, '2018-09-29 09:18:25', '2018-09-29 09:18:25');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'u',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'paolo.rohan@example.com', 'u', '$2y$10$SLbVMP3y8dAl.3YOfxuBnOy70fjgmUF8zZPitKolCU6nuf7NbT2IC', 'QPGKySKycG', '2018-05-24 05:40:08', '2018-05-24 05:40:08'),
(2, 'rick.huel@example.net', 'u', '$2y$10$W.zQYrEltczXZ1Mpv67pHuzMg05bxWHh7xDvUStxVkoJ.LmQmitJ6', 'P45lAHRpQl', '2018-05-24 05:40:08', '2018-05-24 05:40:08'),
(3, 'cconsidine@example.net', 'u', '$2y$10$UVGTZ0TX4YRGc81f/91QCutW/oDvcaEsRHpAyVWoDzAxemfqBNRTy', 'fTWmLeTM4p', '2018-05-24 05:40:08', '2018-05-24 05:40:08'),
(4, 'torphy.fatima@example.org', 'u', '$2y$10$7SpFPYo84TH8g0ZmjxPAKue/5/dbnzsv13cTYiCtsfk.HHGj/mJfi', 'uJGzJmyraH', '2018-05-24 05:40:08', '2018-05-24 05:40:08'),
(5, 'vicky.collins@example.org', 'u', '$2y$10$kgGmRIIFvNw7Ze49LkB9.e9CtXVKrpRFU3cIk8Chjmc7boOD1xVae', 'yg6wFgg2kP', '2018-05-24 05:59:12', '2018-05-24 05:59:12'),
(6, 'janiya08@example.org', 'u', '$2y$10$bPRajqkTVC1luIJz9aAr/e3VyY7uw1jG2X52S6UHO.ub9hQFtPhXO', 'E2iidPkc6q', '2018-05-24 05:59:12', '2018-05-24 05:59:12'),
(7, 'eugenia.bayer@example.org', 'u', '$2y$10$IFq5VMomLfuxMNV7.5DhXO5roiXoiIoOd/rHCQnkIJdavFLPeva46', 'fI8UHV8RKP', '2018-05-24 05:59:12', '2018-05-24 05:59:12'),
(8, 'maureen.toy@example.com', 'u', '$2y$10$1o0uK91BFhoRUmrx/wMZZeTwF5SOJDyfmPupHevJdbJO8BRVIrbV.', 'ZfegxIaLL6', '2018-05-24 05:59:12', '2018-05-24 05:59:12'),
(21, 'liger800kg@gmail.com', 'u', '$2y$10$ivy.OdR/7zysNcSn5YE2Z.gk3XisVmY6cmHO9aQEEpgmU6ci9b1vS', NULL, '2018-05-24 06:45:15', '2018-09-27 21:17:14'),
(22, 'kravchenkodg96@gmail.com', 'u', '$2y$10$IySqCRGo8gQxQAABZ1F.deGhMt.ipDYwPbeQIXhQG0BexbGLrmwCi', NULL, '2018-05-25 05:25:21', '2018-05-25 05:25:21'),
(23, 'piplor40@gmail.com', 'u', '$2y$10$P9e5qrz6n7O7DnpB7sTWiei56Ve24wa9ipsk2MMNgVX98z9EAPIfK', NULL, '2018-05-25 10:31:59', '2018-10-10 04:36:24'),
(24, 'kravchenkodg@gmail.com', 'u', '$2y$10$HdJ/IrhusCrL6puB2KCmies9JKzGYQQwAj14uYytXQ90A8HFkx9VS', NULL, '2018-05-25 19:43:33', '2018-05-25 19:43:33'),
(25, 'piplor@mail.com', 'u', '$2y$10$tiODMksoWQEwKIm1CmMzWuuUIgxfG6C0yFDqX7XX0UVnjwju51fDC', NULL, '2018-05-26 05:40:03', '2018-05-26 05:40:03'),
(26, 'sabaka@gmail.com', 'u', '$2y$10$EQsIxeCXFQS8X4Ph2vZao.xDAWPL7sV52M6.efUy14jQuETbrKDWm', NULL, '2018-05-26 05:52:39', '2018-05-26 05:52:39'),
(27, 'koshka@gmail.com', 'u', '$2y$10$6ozWv4yeJa57TVm6Rmp0DeQsA5tbcgu/RznFEFFS4n7osKYsvhfKm', NULL, '2018-05-26 05:53:50', '2018-05-26 05:53:50'),
(28, 'piplor1@gmail.com', 'u', '$2y$10$W9xzvcgnOO3sIJccoA6tO.fghc/T.6s7fxHK2BTtudUHyCCs.wHRW', NULL, '2018-05-26 06:06:57', '2018-05-26 06:06:57'),
(29, 'dima@gmail.com', 'u', '$2y$10$WWTaMDrRgj8dgsurdrXej.vCQ2Hh2D/8SQMg7.dwSBlXKqceCMZNu', NULL, '2018-05-27 06:25:21', '2018-05-27 06:25:21'),
(30, 'famas@gmail.com', 'u', '$2y$10$A1PSEfJjLkh.oq2kMYu0xuc23sjuLBfWugNfbAQVC/DDH6dFKLJrO', NULL, '2018-05-29 04:22:05', '2018-05-29 04:22:05'),
(31, 'tiglon150kg@yahoo.com', 'u', '$2y$10$CE33TPqlDM2l2r/3xNR4k.02kqske/xuKLTWQrxGb8J8ZEnvP/Uby', NULL, '2018-05-30 09:03:40', '2018-05-30 10:16:21'),
(32, 'y.t.vladimirovna@gmail.com', 'u', '$2y$10$D/K/5lOQGE1f8RKN1cubS.bj7i8MI/m5hJPm6vSRJlgoNzqZwpwRC', NULL, '2018-05-30 10:38:01', '2018-05-30 10:38:01'),
(33, 'krava@gmail.com', 'u', '$2y$10$YUmdcOYf3IxexRNYm60MQ.4JyBD6cKOZ3PhhZ2/eernP9RM16rgka', NULL, '2018-05-31 05:05:39', '2018-05-31 05:05:39'),
(34, 'kirkorov@mail.ru', 'u', '$2y$10$gFDGYl2MSbOcvJdFyq6VyOBBcHVEYXN0k66nQ91lGOg6PVx70bakq', NULL, '2018-05-31 06:35:06', '2018-05-31 06:35:06'),
(35, 'kampanos@mail.ru', 'u', '$2y$10$/vHKOpuYuzeldvek0L0LgOhrMJgsr8/.bxKBzHwiDHAjQsWKBR6VS', NULL, '2018-05-31 10:03:55', '2018-05-31 10:03:55'),
(36, 'ckomopoix-k@yandex.ru', 'u', '$2y$10$Nx/pwIUUlpGp6VUA/wj6Ku2W1TdktFu8gE6Gjbq6YdL1B1Qd5XWse', NULL, '2018-06-01 04:59:03', '2018-06-01 04:59:03'),
(37, 'igor.pokidko@gmail.com', 'u', '$2y$10$885LUMvtbUPJEN64YjmfTOuPa0Yk9BYxoY/seGgvT1ylIpq8S0xSC', NULL, '2018-06-05 07:10:39', '2018-06-05 07:10:39'),
(38, 'rudazik@gmail.com', 'u', '$2y$10$ipJ.KPQaFWEh8dz7XwRvW.hZbi1YLrs0ENkhLq/gf0PwO2rlHc2X.', NULL, '2018-06-05 10:20:55', '2018-06-05 10:20:55'),
(39, 'ckomopox-k@yandex.ru', 'u', '$2y$10$C/SvScJgxDpLfuYgZK91zeMr.Gq2Y3LX22Ii9BAzuRTtOrJyODVMC', NULL, '2018-06-06 07:07:41', '2018-10-15 15:10:41'),
(40, 'krava@com.ua', 'u', '$2y$10$nfD4bArewRAHw3d4r9RhKuQrggLNkkDfv7toO45YUFP9kV.q5lroC', NULL, '2018-06-06 08:39:46', '2018-06-06 08:39:46'),
(41, 'kravafav@i.ua', 'u', '$2y$10$WSh6SwmRXi4NIN2q/7KJGexzHivqqxOx9hbbzVHmvShCvu7w19OsW', NULL, '2018-06-06 08:51:27', '2018-06-06 08:51:27'),
(42, 'rudazik@gmail.su', 'u', '$2y$10$6L55yoNxT5nGrD5Z1s8fI.YmN5C1gZ.SGmz/A8Zv2DlZAFC0Timgq', NULL, '2018-06-06 11:21:18', '2018-06-06 11:21:18'),
(43, 'tony@com.com', 'u', '$2y$10$X7pwNjk5Zpt21H38dyvkge9O/4iK85GPTxr/7oXOoswULGb/FGAHi', NULL, '2018-06-06 11:22:03', '2018-06-06 11:22:03'),
(44, 'farit@gmail.com', 'u', '$2y$10$bg8knZBm7gG/KislISkuV.gScLh76tN1e5T3aofSUnJsHPNuM0VZK', NULL, '2018-06-06 11:23:08', '2018-06-06 11:23:08'),
(45, 'kravaa@gmail.com', 'u', '$2y$10$Klj9GjlqSo39H8FvPxYTROu929mjZTF.so1WN4H.PCMuHUWBTv822', NULL, '2018-06-06 11:29:03', '2018-06-06 11:29:03'),
(46, 'sdfsdfsd@fdgfd.fgdf', 'u', '$2y$10$PxCW/hWlZYdi8qOVamRGM.i0fHURKKDl63ezwvd5vibJAbAqv7IFu', NULL, '2018-06-06 11:33:55', '2018-06-06 11:33:55'),
(47, 'kewfwerava@com.ua', 'u', '$2y$10$M/rfLDnJ3aSAVABv4jJYb.Kj9WSEsO1lZE1i9nL2SLuUhUdBGXojy', NULL, '2018-06-06 11:41:37', '2018-06-06 11:41:37'),
(48, 'kravchdfgdfgodg96@gmail.com', 'u', '$2y$10$oQuroza84JkuW2gZDGOP6.DRJHVRMkwF5o0KxgvlC5Zx5edKkfqAW', NULL, '2018-06-06 11:44:41', '2018-06-06 11:44:41'),
(49, 'kravdsdasd@vxcvx.sfe', 'u', '$2y$10$/.s2QIOBCZ7VQkqUgOYx4.G3mjamsZhhBxYGwvsj28crd5l9BaTB2', NULL, '2018-06-06 11:45:57', '2018-06-06 11:45:57'),
(50, 'dsfsdgdsf@sdfsd.sdfsd', 'u', '$2y$10$f1M/8t.aWYL650PUH4No5.5JZSaPrhtE3cMo9kHpP7fdsW9Fj1/xy', NULL, '2018-06-06 11:49:06', '2018-06-06 11:49:06'),
(51, 'kravasdfsd@sdfsd.sdfs', 'u', '$2y$10$Q90VTNXQkTxwXLbiyVlkDO57JcRoqcVTIZhjyBjzVzKNrOUtmuIKa', NULL, '2018-06-07 04:40:24', '2018-06-07 04:40:24'),
(52, 'sdsdfsd@ffds.fgfd', 'u', '$2y$10$qpv.BJDxAC/zS7NF87LWAeda5Q064yZRTK1Va4C4c3lU/LE6twg5S', NULL, '2018-06-07 05:15:29', '2018-06-07 05:15:29'),
(53, 'khmarik@mail.ru', 'u', '$2y$10$cU4Bptu3kYEu.pnFF98Lw.LRSfwIeJTMFeCN41.gWZnxV1NVCQBby', NULL, '2018-06-11 13:10:52', '2018-06-11 13:10:52'),
(54, 'cleverdacha@gmail.com', 'u', '$2y$10$GDeJFqFbr5fhEfIdlUaBTeR94Za86VrhrNKtWUnAqV/4Am8/liyS2', NULL, '2018-06-12 06:39:55', '2018-06-12 06:39:55'),
(55, 'krava13@gmail.com', 'u', '$2y$10$Pf1kMOWqWMYwECirqM63Ouvg0YIfQjPXZ.QrLa/udvPkAp3kQP1Ya', NULL, '2018-06-18 05:23:26', '2018-06-18 05:23:26'),
(56, 'krava1313@gmail.com', 'u', '$2y$10$4y.nHj3zeh2ymyhh.gYBp.WSYanFLb5ah/975uz2.cmy5kzyRhTri', NULL, '2018-06-18 08:23:52', '2018-06-18 08:23:52'),
(57, 'kravafav@gmail.com', 'u', '$2y$10$A4TT1/V2ShfalTJ4zR4aOeE29Wk4f91QKIoI0lz028ZHpAkFiQt5u', NULL, '2018-07-02 04:55:42', '2018-07-02 04:55:42'),
(59, 'krakaaaaaaa@gmail.com', 'u', '$2y$10$MaXrXMsoXj4p.jiI3C0nb.ihNheUnRMRlhmVdAJdjhax22kqKGoH2', NULL, '2018-07-02 11:23:24', '2018-07-02 11:23:24'),
(60, 'mrptichko@gmail.com', 'u', '$2y$10$j69B6FcTt.am33S6tEsmWOby78LjoJT5.afn8Oub66Ommw8teL3Y2', NULL, '2018-07-04 15:38:43', '2018-07-04 15:38:43'),
(61, 'katetometr@gmail.com', 'a', '$2y$10$LYJcvy1Z6m88aYf1hSn6h.3eot.pjtRkwTOp4yfcQF3PtauwWsiWm', 'e2df1b494c82d73b7a37562f24c40b2ffa5721dc095dcfc66d74b01347d69024', NULL, '2018-10-16 03:49:34'),
(62, 'piplor44@gmail.com', 'u', '$2y$10$mxdMsliZBtaeMuSLd8TwLezBsXrZGHV6G3z9Po4hy6zjLoVdC.sYK', NULL, '2018-07-15 11:14:36', '2018-09-24 06:37:40'),
(66, 'admin@server.com', 'a', '$2y$10$pkj0xrLVR4o1ZgfLR7NdkO0q7ToVnD2aOKDSJFOjV.iFnsGBAaIq6', '6bfca407aa2a85922254c285ae7a9ab586c72fc6c2664ad280662d077e17d03c', '2018-09-11 06:02:40', '2018-11-01 07:05:38'),
(68, 'nick@server.com', 'a', '$2y$10$aCGs9xBYm2wQWvmKU4cCce/w7QiZgaU1cx7AXS36Oi2ksyYCOmFri', NULL, '2018-09-11 09:35:09', '2018-10-26 07:21:50'),
(69, 'nikita.mayorov@gmail.com', 'a', '$2y$10$aCGs9xBYm2wQWvmKU4cCce/w7QiZgaU1cx7AXS36Oi2ksyYCOmFri', '', '2018-09-11 09:35:09', '2018-10-03 11:12:10'),
(70, 'katetometr@ukr.net', 'u', '$2y$10$cfA5PBgish3cqHtqQ4vcCeE2.uKz3QIkiEH0Y22BWlJWz/4yGhXPu', NULL, '2018-09-26 11:17:40', '2018-09-26 11:51:22'),
(71, 'qwe@gmail.com', 'u', '$2y$10$ZPL.uSyg/62.qa3aTFYxD.HiglFcMD4WRRbDSJHDR0sGfl6F1.AJe', NULL, '2018-10-09 18:02:57', '2018-10-09 18:02:57'),
(72, '1@gmail.com', 'u', '$2y$10$Gqr7Qmia7whOY7.nobN.8e0skkd7RXR09kXruDz33dA4rtvsppnZu', NULL, '2018-10-11 11:57:44', '2018-10-11 11:57:44'),
(73, 'qwedsfdfsdf@gmail.com', 'u', '$2y$10$XulfFez0ashgu9ZvLNmtZ.7vj64DZxgeG6Yojpbb2yR5pHMLtmBK6', NULL, '2018-10-12 07:07:50', '2018-10-12 07:07:50'),
(74, 'qwefcgudfuf8uftuftutfutfuftufdsfdfsdf@gmail.com', 'u', '$2y$10$LCqL6RSvmVp3dG2u9iiFDu2rohCE4n7KYgP/.a1G70yBhrFajEJlu', NULL, '2018-10-12 07:08:34', '2018-10-12 07:08:34'),
(75, 'shcdh@qwer.ru', 'u', '$2y$10$C85kizysDpJ9VH1a9Ib9gOe7eKKfAsdzejxsfi3jHrxdTpgEkP6sy', NULL, '2018-10-12 07:10:21', '2018-10-12 07:10:21'),
(76, 'testemail@ukr.net', 'u', '$2y$10$bRpcMyRcSqqhRZ9gNkMT0u2A51ms0e2zt94Rdl/alLvhPB8Lnx0n.', NULL, '2018-10-12 07:11:49', '2018-10-12 07:11:49'),
(77, 'testemail1@ukr.net', 'u', '$2y$10$AZJWseXaSMKDla67FF9pQOFmeHoUa78QEkpMFOlQK9dou2GjbUI.2', NULL, '2018-10-12 07:12:53', '2018-10-12 07:12:53'),
(78, 'fiusehrvbiuwhiucnwu@gkdfjgkdfjg.dsfsdf', 'u', '$2y$10$ykJf/YOLGVYslbke6ygzi.QgMgMtzY.ZBJmj2hbpZFaS3bBwZMLO6', NULL, '2018-10-12 07:15:34', '2018-10-12 07:15:34'),
(79, 'kovshova_yulya@mail.ru', 'u', '$2y$10$wTk3RFU7sKAQizoiuFBepun8SSDrMKHY09EYKOV2RIKcC8lergo1S', NULL, '2018-10-12 10:57:59', '2018-10-12 10:57:59'),
(80, 'azarov.iurii@gmail.com', 'a', '$2y$10$71rZSYqcjYXU8g2a8uK1c.eDtbZV6k9z9OYm.MtVE4Tr8coYCmWrO', '7deeff3a269262935c46721feb1b4f8d1795ab1832c9c1005b7546c023b02d7b', '2018-10-15 05:35:24', '2018-10-15 05:56:48'),
(81, 'qwertyui@mail.ru', 'u', '$2y$10$zbKRubQ.gFag58yeUOJXje9i2nIzazO6pVkPF29OJIG30yugnrYay', NULL, '2018-10-15 05:43:47', '2018-10-15 07:00:19'),
(82, 'qwertyuiokjhg@mail.ru', 'u', '$2y$10$jv31hGpOx2cnOTQnB4v5T.wL.8xLdUxU85DhBZoV3V2v5EEuUr2rC', NULL, '2018-10-15 05:45:39', '2018-10-15 05:45:39'),
(83, '12345678@ukr.net', 'u', '$2y$10$Z3S3w9ZJh7oLFx.W98c6c.QPSK1nTWAtzoOOJDFA/2gX4rjzoqXkC', NULL, '2018-10-15 06:47:08', '2018-10-15 06:54:58');

-- --------------------------------------------------------

--
-- Структура таблицы `user_delivery_methods`
--

CREATE TABLE `user_delivery_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_delivery_methods`
--

INSERT INTO `user_delivery_methods` (`id`, `user_id`, `method_id`, `created_at`, `updated_at`) VALUES
(10, 61, 2, '2018-10-23 09:07:06', '2018-10-23 09:07:06');

-- --------------------------------------------------------

--
-- Структура таблицы `user_entrances`
--

CREATE TABLE `user_entrances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_entrances`
--

INSERT INTO `user_entrances` (`id`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(2, 61, '2018-07-23', '2018-07-23 07:07:49', '2018-07-23 07:07:49'),
(3, 22, '2018-07-24', '2018-07-24 04:42:06', '2018-07-24 04:42:06'),
(4, 22, '2018-07-25', '2018-07-25 04:58:57', '2018-07-25 04:58:57'),
(5, 61, '2018-07-25', '2018-07-25 06:37:52', '2018-07-25 06:37:52'),
(6, 22, '2018-07-26', '2018-07-26 04:55:27', '2018-07-26 04:55:27'),
(7, 61, '2018-07-26', '2018-07-26 05:39:05', '2018-07-26 05:39:05'),
(8, 61, '2018-07-27', '2018-07-27 04:15:21', '2018-07-27 04:15:21'),
(9, 22, '2018-07-27', '2018-07-27 04:52:11', '2018-07-27 04:52:11'),
(10, 22, '2018-07-30', '2018-07-30 05:21:07', '2018-07-30 05:21:07'),
(11, 22, '2018-07-31', '2018-07-31 04:54:17', '2018-07-31 04:54:17'),
(12, 23, '2018-08-01', '2018-08-01 04:13:45', '2018-08-01 04:13:45'),
(13, 22, '2018-08-01', '2018-08-01 06:10:17', '2018-08-01 06:10:17'),
(14, 61, '2018-08-01', '2018-08-01 16:26:40', '2018-08-01 16:26:40'),
(15, 22, '2018-08-02', '2018-08-02 04:53:55', '2018-08-02 04:53:55'),
(16, 61, '2018-08-02', '2018-08-02 06:01:43', '2018-08-02 06:01:43'),
(17, 61, '2018-08-03', '2018-08-03 05:14:57', '2018-08-03 05:14:57'),
(18, 23, '2018-08-03', '2018-08-03 18:51:41', '2018-08-03 18:51:41'),
(19, 22, '2018-08-06', '2018-08-06 09:24:59', '2018-08-06 09:24:59'),
(20, 32, '2018-08-06', '2018-08-06 09:34:56', '2018-08-06 09:34:56'),
(21, 61, '2018-08-07', '2018-08-07 07:32:48', '2018-08-07 07:32:48'),
(22, 23, '2018-08-09', '2018-08-09 06:40:55', '2018-08-09 06:40:55'),
(23, 22, '2018-08-09', '2018-08-09 07:35:16', '2018-08-09 07:35:16'),
(24, 61, '2018-08-09', '2018-08-09 11:35:39', '2018-08-09 11:35:39'),
(25, 21, '2018-08-09', '2018-08-09 17:05:52', '2018-08-09 17:05:52'),
(26, 61, '2018-08-10', '2018-08-10 07:43:37', '2018-08-10 07:43:37'),
(27, 23, '2018-08-10', '2018-08-10 12:34:58', '2018-08-10 12:34:58'),
(28, 61, '2018-08-13', '2018-08-13 05:53:32', '2018-08-13 05:53:32'),
(29, 22, '2018-08-13', '2018-08-13 07:39:41', '2018-08-13 07:39:41'),
(30, 61, '2018-08-14', '2018-08-14 06:47:21', '2018-08-14 06:47:21'),
(31, 23, '2018-08-15', '2018-08-15 10:05:06', '2018-08-15 10:05:06'),
(32, 22, '2018-08-16', '2018-08-16 05:24:32', '2018-08-16 05:24:32'),
(33, 61, '2018-08-16', '2018-08-16 14:22:50', '2018-08-16 14:22:50'),
(34, 22, '2018-08-20', '2018-08-20 04:44:12', '2018-08-20 04:44:12'),
(35, 61, '2018-08-21', '2018-08-21 08:01:51', '2018-08-21 08:01:51'),
(36, 39, '2018-08-21', '2018-08-21 09:29:14', '2018-08-21 09:29:14'),
(37, 39, '2018-08-22', '2018-08-22 08:13:42', '2018-08-22 08:13:42'),
(38, 61, '2018-08-27', '2018-08-27 10:16:40', '2018-08-27 10:16:40'),
(39, 39, '2018-08-27', '2018-08-27 10:46:20', '2018-08-27 10:46:20'),
(40, 32, '2018-08-27', '2018-08-27 10:49:50', '2018-08-27 10:49:50'),
(41, 61, '2018-08-29', '2018-08-29 05:20:48', '2018-08-29 05:20:48'),
(42, 22, '2018-08-30', '2018-08-30 07:47:48', '2018-08-30 07:47:48'),
(43, 63, '2018-08-31', '2018-08-31 08:12:43', '2018-08-31 08:12:43'),
(44, 61, '2018-08-31', '2018-08-31 08:21:53', '2018-08-31 08:21:53'),
(45, 64, '2018-08-31', '2018-08-31 09:07:47', '2018-08-31 09:07:47'),
(46, 61, '2018-09-02', '2018-09-02 09:42:02', '2018-09-02 09:42:02'),
(47, 61, '2018-09-03', '2018-09-03 11:46:29', '2018-09-03 11:46:29'),
(48, 61, '2018-09-06', '2018-09-06 03:36:04', '2018-09-06 03:36:04'),
(49, 61, '2018-09-07', '2018-09-07 04:27:56', '2018-09-07 04:27:56'),
(50, 64, '2018-09-07', '2018-09-07 06:34:03', '2018-09-07 06:34:03'),
(51, 61, '2018-09-09', '2018-09-09 08:19:28', '2018-09-09 08:19:28'),
(52, 64, '2018-09-11', '2018-09-11 05:57:40', '2018-09-11 05:57:40'),
(53, 61, '2018-09-12', '2018-09-12 13:53:40', '2018-09-12 13:53:40'),
(54, 61, '2018-09-17', '2018-09-17 14:32:15', '2018-09-17 14:32:15'),
(55, 22, '2018-09-18', '2018-09-18 14:22:26', '2018-09-18 14:22:26'),
(56, 23, '2018-09-18', '2018-09-18 18:04:00', '2018-09-18 18:04:00'),
(57, 23, '2018-09-19', '2018-09-19 08:52:26', '2018-09-19 08:52:26'),
(58, 32, '2018-09-21', '2018-09-21 04:47:41', '2018-09-21 04:47:41'),
(59, 61, '2018-09-23', '2018-09-23 09:44:10', '2018-09-23 09:44:10'),
(60, 23, '2018-09-23', '2018-09-23 17:34:44', '2018-09-23 17:34:44'),
(61, 32, '2018-09-24', '2018-09-24 04:56:38', '2018-09-24 04:56:38'),
(62, 22, '2018-09-24', '2018-09-24 15:10:00', '2018-09-24 15:10:00'),
(63, 70, '2018-09-26', '2018-09-26 11:48:35', '2018-09-26 11:48:35'),
(64, 61, '2018-09-28', '2018-09-28 06:36:39', '2018-09-28 06:36:39'),
(65, 32, '2018-09-28', '2018-09-28 07:34:22', '2018-09-28 07:34:22'),
(66, 68, '2018-09-28', '2018-09-28 07:36:20', '2018-09-28 07:36:20'),
(67, 61, '2018-09-30', '2018-09-30 08:57:10', '2018-09-30 08:57:10'),
(68, 61, '2018-10-03', '2018-10-03 06:20:11', '2018-10-03 06:20:11'),
(69, 61, '2018-10-04', '2018-10-04 05:36:37', '2018-10-04 05:36:37'),
(70, 61, '2018-10-05', '2018-10-05 15:30:46', '2018-10-05 15:30:46'),
(71, 23, '2018-10-08', '2018-10-08 10:31:12', '2018-10-08 10:31:12'),
(72, 23, '2018-10-09', '2018-10-09 04:28:34', '2018-10-09 04:28:34'),
(73, 68, '2018-10-09', '2018-10-09 07:41:49', '2018-10-09 07:41:49'),
(74, 69, '2018-10-09', '2018-10-09 07:54:13', '2018-10-09 07:54:13'),
(75, 61, '2018-10-09', '2018-10-09 08:16:36', '2018-10-09 08:16:36'),
(76, 61, '2018-10-10', '2018-10-10 09:37:19', '2018-10-10 09:37:19'),
(77, 23, '2018-10-10', '2018-10-10 18:21:40', '2018-10-10 18:21:40'),
(78, 61, '2018-10-11', '2018-10-11 06:51:15', '2018-10-11 06:51:15'),
(79, 23, '2018-10-12', '2018-10-12 05:19:14', '2018-10-12 05:19:14'),
(80, 61, '2018-10-12', '2018-10-12 05:56:56', '2018-10-12 05:56:56'),
(81, 23, '2018-10-13', '2018-10-13 08:05:57', '2018-10-13 08:05:57'),
(82, 23, '2018-10-14', '2018-10-14 14:38:17', '2018-10-14 14:38:17'),
(83, 80, '2018-10-15', '2018-10-15 05:37:56', '2018-10-15 05:37:56'),
(84, 83, '2018-10-15', '2018-10-15 06:47:44', '2018-10-15 06:47:44'),
(85, 61, '2018-10-15', '2018-10-15 08:36:21', '2018-10-15 08:36:21'),
(86, 23, '2018-10-15', '2018-10-15 11:10:01', '2018-10-15 11:10:01'),
(87, 39, '2018-10-15', '2018-10-15 15:11:14', '2018-10-15 15:11:14'),
(88, 61, '2018-10-16', '2018-10-16 11:36:14', '2018-10-16 11:36:14'),
(89, 61, '2018-10-17', '2018-10-17 10:06:05', '2018-10-17 10:06:05'),
(90, 23, '2018-10-17', '2018-10-17 15:09:02', '2018-10-17 15:09:02'),
(91, 23, '2018-10-18', '2018-10-18 06:15:00', '2018-10-18 06:15:00'),
(92, 23, '2018-10-21', '2018-10-21 08:25:46', '2018-10-21 08:25:46'),
(93, 61, '2018-10-22', '2018-10-22 06:21:35', '2018-10-22 06:21:35'),
(94, 23, '2018-10-22', '2018-10-22 16:23:40', '2018-10-22 16:23:40'),
(95, 23, '2018-10-24', '2018-10-24 11:24:34', '2018-10-24 11:24:34'),
(96, 23, '2018-10-25', '2018-10-25 04:47:06', '2018-10-25 04:47:06'),
(97, 61, '2018-10-26', '2018-10-26 07:44:11', '2018-10-26 07:44:11'),
(98, 32, '2018-10-30', '2018-10-30 10:48:15', '2018-10-30 10:48:15'),
(99, 22, '2018-10-31', '2018-10-31 11:50:09', '2018-10-31 11:50:09');

-- --------------------------------------------------------

--
-- Структура таблицы `user_sorts`
--

CREATE TABLE `user_sorts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_sorts`
--

INSERT INTO `user_sorts` (`id`, `user_id`, `sort_id`, `created_at`, `updated_at`) VALUES
(4, 61, 50, NULL, NULL),
(5, 61, 51, '2018-07-26 11:33:56', '2018-07-26 11:33:56'),
(6, 61, 48, NULL, NULL),
(7, 61, 2, NULL, NULL),
(15, 22, 2, '2018-07-30 05:21:32', '2018-07-30 05:21:32'),
(21, 22, 7, '2018-08-02 16:00:36', '2018-08-02 16:00:36'),
(27, 61, 53, '2018-08-21 07:24:12', '2018-08-21 07:24:12'),
(29, 22, 1, '2018-08-29 06:37:15', '2018-08-29 06:37:15'),
(30, 39, 37, '2018-09-24 03:06:41', '2018-09-24 03:06:41'),
(36, 23, 48, '2018-10-20 15:26:14', '2018-10-20 15:26:14'),
(38, 23, 49, '2018-10-21 08:44:29', '2018-10-21 08:44:29'),
(39, 23, 51, '2018-10-21 08:44:49', '2018-10-21 08:44:49'),
(42, 23, 35, '2018-10-21 09:15:31', '2018-10-21 09:15:31'),
(54, 32, 51, '2018-10-24 05:45:01', '2018-10-24 05:45:01'),
(61, 23, 47, '2018-10-25 04:47:50', '2018-10-25 04:47:50'),
(63, 32, 49, '2018-10-25 08:48:38', '2018-10-25 08:48:38'),
(71, 78, 48, '2018-10-26 10:55:34', '2018-10-26 10:55:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `assortments`
--
ALTER TABLE `assortments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bookmarks_folders`
--
ALTER TABLE `bookmarks_folders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_relations`
--
ALTER TABLE `category_relations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chemicals`
--
ALTER TABLE `chemicals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cultures`
--
ALTER TABLE `cultures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `decorator_photos`
--
ALTER TABLE `decorator_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `decorator_projects`
--
ALTER TABLE `decorator_projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `disease_chemicals`
--
ALTER TABLE `disease_chemicals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ethnosciences`
--
ALTER TABLE `ethnosciences`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ethnoscience_months`
--
ALTER TABLE `ethnoscience_months`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filter_attributes`
--
ALTER TABLE `filter_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filter_attr_entities`
--
ALTER TABLE `filter_attr_entities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filter_attr_values`
--
ALTER TABLE `filter_attr_values`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `handbooks`
--
ALTER TABLE `handbooks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `handbook_photos`
--
ALTER TABLE `handbook_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `handbook_videolinks`
--
ALTER TABLE `handbook_videolinks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `main_page_infos`
--
ALTER TABLE `main_page_infos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `moon_actions`
--
ALTER TABLE `moon_actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `moon_dates`
--
ALTER TABLE `moon_dates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Индексы таблицы `moon_phases`
--
ALTER TABLE `moon_phases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_regions`
--
ALTER TABLE `order_regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status_rels`
--
ALTER TABLE `order_status_rels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `pests`
--
ALTER TABLE `pests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pest_chemicals`
--
ALTER TABLE `pest_chemicals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pest_disease_relations`
--
ALTER TABLE `pest_disease_relations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `responses_answers`
--
ALTER TABLE `responses_answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sorts`
--
ALTER TABLE `sorts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_calendars`
--
ALTER TABLE `sort_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_characteristics`
--
ALTER TABLE `sort_characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_charact_relations`
--
ALTER TABLE `sort_charact_relations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_operations`
--
ALTER TABLE `sort_operations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_questionaries`
--
ALTER TABLE `sort_questionaries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort_ques_general_infos`
--
ALTER TABLE `sort_ques_general_infos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tarif_histories`
--
ALTER TABLE `tarif_histories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_delivery_methods`
--
ALTER TABLE `user_delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_entrances`
--
ALTER TABLE `user_entrances`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_sorts`
--
ALTER TABLE `user_sorts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `assortments`
--
ALTER TABLE `assortments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT для таблицы `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT для таблицы `bookmarks_folders`
--
ALTER TABLE `bookmarks_folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `category_relations`
--
ALTER TABLE `category_relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT для таблицы `chemicals`
--
ALTER TABLE `chemicals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `cultures`
--
ALTER TABLE `cultures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT для таблицы `decorator_photos`
--
ALTER TABLE `decorator_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `decorator_projects`
--
ALTER TABLE `decorator_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT для таблицы `disease_chemicals`
--
ALTER TABLE `disease_chemicals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `ethnosciences`
--
ALTER TABLE `ethnosciences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `ethnoscience_months`
--
ALTER TABLE `ethnoscience_months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `event_participants`
--
ALTER TABLE `event_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT для таблицы `filter_attributes`
--
ALTER TABLE `filter_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT для таблицы `filter_attr_entities`
--
ALTER TABLE `filter_attr_entities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=723;
--
-- AUTO_INCREMENT для таблицы `filter_attr_values`
--
ALTER TABLE `filter_attr_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;
--
-- AUTO_INCREMENT для таблицы `footers`
--
ALTER TABLE `footers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `handbooks`
--
ALTER TABLE `handbooks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `handbook_photos`
--
ALTER TABLE `handbook_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `handbook_videolinks`
--
ALTER TABLE `handbook_videolinks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `main_page_infos`
--
ALTER TABLE `main_page_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT для таблицы `moon_actions`
--
ALTER TABLE `moon_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2680;
--
-- AUTO_INCREMENT для таблицы `moon_dates`
--
ALTER TABLE `moon_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT для таблицы `moon_phases`
--
ALTER TABLE `moon_phases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `order_regions`
--
ALTER TABLE `order_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `order_status_rels`
--
ALTER TABLE `order_status_rels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT для таблицы `pests`
--
ALTER TABLE `pests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `pest_chemicals`
--
ALTER TABLE `pest_chemicals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `pest_disease_relations`
--
ALTER TABLE `pest_disease_relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;
--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблицы `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT для таблицы `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `responses_answers`
--
ALTER TABLE `responses_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `sorts`
--
ALTER TABLE `sorts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `sort_calendars`
--
ALTER TABLE `sort_calendars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT для таблицы `sort_characteristics`
--
ALTER TABLE `sort_characteristics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `sort_charact_relations`
--
ALTER TABLE `sort_charact_relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT для таблицы `sort_operations`
--
ALTER TABLE `sort_operations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `sort_questionaries`
--
ALTER TABLE `sort_questionaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sort_ques_general_infos`
--
ALTER TABLE `sort_ques_general_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `tarif_histories`
--
ALTER TABLE `tarif_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT для таблицы `user_delivery_methods`
--
ALTER TABLE `user_delivery_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `user_entrances`
--
ALTER TABLE `user_entrances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT для таблицы `user_sorts`
--
ALTER TABLE `user_sorts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
