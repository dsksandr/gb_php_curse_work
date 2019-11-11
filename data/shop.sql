-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 11 2019 г., 18:30
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
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `count` int(11) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `session_id`, `count`) VALUES
(320, 3, '0unqlu7e35n3oh1t2q34ss916j5jlqa5', 2),
(322, 4, '0unqlu7e35n3oh1t2q34ss916j5jlqa5', 2),
(324, 3, 'i8jhdokt4k6a1lfatcpkq8c586fdojsm', 3),
(343, 4, 'itju1kq0boqr02mp691k8mtvghclith6', 2),
(344, 5, 'itju1kq0boqr02mp691k8mtvghclith6', 3);

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
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`) VALUES
(1, 'admin', '$2y$10$oZ1nzuSGL6RTRedTlePyvOuIGfsGpGRrZekGok.vhZwLhtCeq2F0i', '6531934115db2e4d945e889.80745736');

--
-- Индексы сохранённых таблиц
--

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
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
