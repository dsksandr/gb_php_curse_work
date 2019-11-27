-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 28 2019 г., 02:30
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `access` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `access`
--

INSERT INTO `access` (`id`, `access`) VALUES
(1, 'root'),
(2, 'admin'),
(3, 'user'),
(4, 'guest');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `count` int(11) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `session_id`, `order_id`, `count`) VALUES
(320, 3, '0unqlu7e35n3oh1t2q34ss916j5jlqa5', NULL, 2),
(322, 4, '0unqlu7e35n3oh1t2q34ss916j5jlqa5', NULL, 2),
(324, 3, 'i8jhdokt4k6a1lfatcpkq8c586fdojsm', NULL, 3),
(343, 4, 'itju1kq0boqr02mp691k8mtvghclith6', NULL, 9),
(344, 5, 'itju1kq0boqr02mp691k8mtvghclith6', NULL, 9),
(349, 3, 'itju1kq0boqr02mp691k8mtvghclith6', NULL, 2),
(362, 3, 'bupdrokkvfbgkbjmimbralvelmls5tjm', NULL, 3),
(363, 4, 'bupdrokkvfbgkbjmimbralvelmls5tjm', NULL, 2),
(368, 3, 'lk9b38t97v9k8scsk5chocdepgmg7k11', NULL, 0),
(382, 4, 'lk9b38t97v9k8scsk5chocdepgmg7k11', NULL, 7),
(394, 5, 'lk9b38t97v9k8scsk5chocdepgmg7k11', NULL, 4),
(821, 4, 'aqovg589kdegk772c8il7edorj94p8b9', NULL, 1),
(834, 3, '425v10olfu0bi3t81g27q7ibcud78lpv', 9, 1),
(850, 5, '425v10olfu0bi3t81g27q7ibcud78lpv', NULL, 0),
(862, 4, '425v10olfu0bi3t81g27q7ibcud78lpv', 8, 13),
(972, 4, '36ti2egkg5ugi6uh0vmdel1it812kimi', 11, 2),
(973, 5, '36ti2egkg5ugi6uh0vmdel1it812kimi', 11, 1),
(975, 4, '4ksmkj6jk7sc8hq1v4lo07r69ti7ldfp', 12, 1),
(976, 3, '4ksmkj6jk7sc8hq1v4lo07r69ti7ldfp', 12, 2),
(978, 5, 'vek47at8tf45uuhodiebc7t2m0kelss9', 13, 1),
(979, 4, 'vek47at8tf45uuhodiebc7t2m0kelss9', 13, 1),
(980, 3, 'vek47at8tf45uuhodiebc7t2m0kelss9', 13, 2),
(982, 3, 'j6daf5pflr06uhiqf3k7sifssl6suci8', 14, 1),
(983, 4, 'j6daf5pflr06uhiqf3k7sifssl6suci8', 14, 1),
(984, 3, 'jidpfvj2db2gmjo1c3aprsfsdi30qqql', 15, 1),
(985, 4, 'jidpfvj2db2gmjo1c3aprsfsdi30qqql', NULL, 0),
(991, 3, 'g9kvv8ceac5ubd331674fai9lc59m7ki', 16, 1),
(996, 5, 'g9kvv8ceac5ubd331674fai9lc59m7ki', 16, 1),
(997, 4, '', NULL, 2),
(998, 3, '', NULL, 2),
(1001, 3, 'arc0mtf6jcp5ef0quhm63an6guki05oj', 17, 4),
(1009, 3, 'a2onu3o7n2alvmuijhdun2vtb27ij92u', 18, 4),
(1017, 5, 'a2onu3o7n2alvmuijhdun2vtb27ij92u', 18, 1),
(1018, 4, 'o3knak0urik3nio7q1a1jssjk61egcsh', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `alt` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `path` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `alt`, `path`, `views`) VALUES
(1, 'Творит данный закон внешнего мира', 'stock-photo-image-of-a-thinking-dreaming-young-beautiful-woman-posing-isolated-over-pink-wall-background-using-1416496991.jpg', 51),
(2, 'Смысл жизни, следовательно', 'stock-photo-image-of-happy-young-business-woman-posing-isolated-over-grey-wall-background-1215373642.jpg', 31),
(3, 'Гедонизм осмысляет дедуктивный метод', 'stock-photo-portrait-of-a-cute-casual-girl-drinking-orange-juice-from-a-glass-and-looking-at-camera-isolated-742433851.jpg', 21),
(4, 'Аксиома силлогизма, по определению, представляет собой', 'stock-photo-portrait-of-happy-woman-with-short-hair-in-basic-t-shirt-rejoicing-and-pointing-finger-at-copyspace-1410550274.jpg', 31),
(5, 'Аксиома силлогизма, по определению, представляет', 'stock-photo-surprised-elegant-woman-in-straw-hat-take-off-sunglasses-while-looking-at-the-camera-over-violet-1170669250.jpg', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `email` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `email`, `status`) VALUES
(1, '425v10olfu0bi3t81g27q7ibcud78lpv', 'cudukassu-4702@yopmail.com', 3),
(2, '425v10olfu0bi3t81g27q7ibcud78lpv', 'tinape1710@tmail1.com', 3),
(3, '425v10olfu0bi3t81g27q7ibcud78lpv', 'cudukassu-4702@yopmail.com', 3),
(4, '425v10olfu0bi3t81g27q7ibcud78lpv', 'tinape1710@tmail1.com', 3),
(5, '425v10olfu0bi3t81g27q7ibcud78lpv', 'tinape1710@tmail1.com', 3),
(6, '425v10olfu0bi3t81g27q7ibcud78lpv', 'uppofappo-1965@yopmail.com', 3),
(7, '425v10olfu0bi3t81g27q7ibcud78lpv', 'uwottozad-9743@yopmail.com', 3),
(8, '425v10olfu0bi3t81g27q7ibcud78lpv', 'uppofappo-1965@yopmail.com', 2),
(9, '425v10olfu0bi3t81g27q7ibcud78lpv', 'uwottozad-9743@yopmail.com', 3),
(10, '32hpvgglmb2ms23npmhennunfea4ifop', 'uwottozad-9743@yopmail.com', 3),
(11, '36ti2egkg5ugi6uh0vmdel1it812kimi', 'cudukassu-4702@yopmail.com', 3),
(12, '4ksmkj6jk7sc8hq1v4lo07r69ti7ldfp', 'uppofappo-1965@yopmail.com', 3),
(13, 'vek47at8tf45uuhodiebc7t2m0kelss9', 'uwottozad-9743@yopmail.com', 3),
(14, 'j6daf5pflr06uhiqf3k7sifssl6suci8', 'uppofappo-1965@yopmail.com', 1),
(15, 'jidpfvj2db2gmjo1c3aprsfsdi30qqql', 'ivanov@ivan.ru', 1),
(16, 'g9kvv8ceac5ubd331674fai9lc59m7ki', 'mail@mail.ru', 1),
(17, 'arc0mtf6jcp5ef0quhm63an6guki05oj', 'Abc@cbA.ru', 1),
(18, 'a2onu3o7n2alvmuijhdun2vtb27ij92u', '123', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `type`) VALUES
(1, 'Принят'),
(2, 'Оплачен'),
(3, 'Отправлен');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`) VALUES
(3, 'Кресло Harry', 69650, 'HARRY_shadow_armchai.jpg', 'Harry выглядит щедро и уверенно стильно. Кресло, которое действительно доказывает, насколько чистый и простой дизайн может стать рецептом чего-то необычного'),
(4, 'Стол обеденный Anne', 96800, '5008.jpg', 'Дубовый обеденный стол Anne - это воплощение классического скандинавского дизайна. Его конструкция и материалы, используемые для производства, делают стол вне времени, и превращают его в сердце столовой или кухни'),
(5, 'Диван Karin', 114350, 'KARIN_shadow_2seater.jpg', 'Пышная элегантность Karin привносит современный стиль в любой интерьер, притягивает вас и обволакивает с комфортом. Выберете цвет и тип ткани, ножки в соответствии с вашими предпочтениями');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hash` text NOT NULL,
  `access_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`, `access_id`) VALUES
(1, 'admin', '$2y$10$oZ1nzuSGL6RTRedTlePyvOuIGfsGpGRrZekGok.vhZwLhtCeq2F0i', '13686850175ddeb42eae1bb7.55446202', 2),
(2, 'a.zhilin', '$2y$10$oZ1nzuSGL6RTRedTlePyvOuIGfsGpGRrZekGok.vhZwLhtCeq2F0i', '10010109355dd609f71046e2.55135784', 2),
(3, 'guest', '$2y$10$oZ1nzuSGL6RTRedTlePyvOuIGfsGpGRrZekGok.vhZwLhtCeq2F0i', '', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`,`product_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access` (`access_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status`) REFERENCES `order_status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
