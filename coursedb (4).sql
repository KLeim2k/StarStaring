-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 26 2024 г., 15:37
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `coursedb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `order_cost` decimal(11,2) NOT NULL,
  `order_status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `user_phone` bigint NOT NULL,
  `user_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, '28100.00', 'Доставляется', 1, 12345678, 'Ekb', 'donbaskya ', '2024-12-17 15:11:49'),
(2, '28100.00', 'Ожидает в магазине', 1, 12345678, 'Ekb', 'donbaskya ', '2024-12-17 15:11:49'),
(10, '117350.00', 'в ожидании', 1, 9292132944, 'Екатеринбург', 'Донбасская 21, 175', '2024-12-26 03:32:40');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_price` decimal(11,2) NOT NULL,
  `product_quantity` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 0, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 03:18:43'),
(2, 0, '3', 'StarLine E97', 'E97.png', '20650.00', 1, 1, '2024-12-17 03:18:43'),
(3, 0, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 03:22:41'),
(4, 0, '3', 'StarLine E97', 'E97.png', '20650.00', 1, 1, '2024-12-17 03:22:41'),
(5, 0, '3', 'StarLine E97', 'E97.png', '20650.00', 1, 1, '2024-12-17 03:23:11'),
(6, 0, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 03:33:32'),
(7, 0, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 03:33:52'),
(8, 0, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 03:39:28'),
(9, 1, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 12:59:39'),
(10, 2, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 13:22:09'),
(11, 3, '2', 'StarLine S96 v2 LTE GPS', 'S96 v2 LTE-GPS PRO.png', '28100.00', 1, 1, '2024-12-17 16:30:22'),
(12, 0, '11', 'A90', 'A90.png', '10000.00', 1, 1, '2024-12-17 19:38:37'),
(13, 4, '11', 'A90', 'A90.png', '10000.00', 1, 1, '2024-12-17 19:39:13'),
(14, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:15:47'),
(15, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:15:47'),
(16, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:18:38'),
(17, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:18:38'),
(18, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:20:30'),
(19, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:20:30'),
(20, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:23:00'),
(21, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:23:00'),
(22, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:24:53'),
(23, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:24:53'),
(24, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:25:01'),
(25, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:25:01'),
(26, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:26:02'),
(27, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:26:02'),
(28, 5, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:27:50'),
(29, 5, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:27:50'),
(30, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:28:27'),
(31, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:28:27'),
(32, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:28:37'),
(33, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:28:37'),
(34, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:29:14'),
(35, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:29:14'),
(36, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:29:24'),
(37, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:29:24'),
(38, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:29:32'),
(39, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:29:32'),
(40, 6, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:29:57'),
(41, 6, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:29:57'),
(42, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:30:08'),
(43, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:30:08'),
(44, 0, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:30:51'),
(45, 0, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:30:51'),
(46, 7, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:31:00'),
(47, 7, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:31:00'),
(48, 8, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:31:48'),
(49, 8, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:31:48'),
(50, 9, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:32:02'),
(51, 9, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:32:02'),
(52, 10, '4', 'StarLine B97 v2 LTE GPS', 'assets/img/B97v2 LTE GPS.png', '54300.00', 2, 1, '2024-12-26 03:32:40'),
(53, 10, '23', 'StarLine M66 V2 S', 'assets/img/f2.png', '8750.00', 1, 1, '2024-12-26 03:32:40');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` enum('Телефон','Автозапуск','CAN','Метка') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_description` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`) VALUES
(4, 'StarLine B97 v2 LTE GPS', 'Автозапуск', 'Надежный автомобильный охранно-телематический комплекс с интеллектуальным автозапуском с вашего смартфона, несканируемым диалоговым кодом управления, возможностью авторизации по защищенному протоколу через персональную метку, интегрированными 2CAN+4LIN, LTE (4G), GPS-ГЛОНАСС интерфейсами.', 'assets/img/B97v2 LTE GPS.png', 'assets/img/f12.png', 'assets/img/f4.png', 'assets/img/f10.png', '54300.00'),
(5, 'StarLine А93 v2 ECO', 'Автозапуск', 'Надежный автомобильный охранно-телематический комплекс с интеллектуальным автозапуском с вашего смартфона, несканируемым диалоговым кодом управления, возможностью авторизации по защищенному протоколу через персональную метку, интегрированными 2CAN+4LIN, LTE (4G), GPS-ГЛОНАСС интерфейсами.', 'assets/img/А93 v2 ECO.png', 'assets/img/f5.png', 'assets/img/f8.png', 'assets/img/f10.png', '11800.00'),
(7, 'StarLine S66 v2 LTE', 'Телефон', 'Надежный автомобильный охранно-телематический комплекс с несканируемым диалоговым кодом управления, возможностью авторизации по защищенному протоколу через персональную метку StarLine, интегрированными 2CAN+4LIN и LTE (4G) интерфейсами.', 'assets/img/S66.jpg', 'assets/img/f12.png', 'assets/img/f4.png', '', '19700.00'),
(12, 'StarLine A90 ECO', 'Телефон', 'Умный охранно-телематический комплекс StarLine А90 включает лучшие решения в области автобезопасности и гарантирует надежную защиту от угона благодаря устойчивому к электронному взлому диалоговому коду управления и широким возможностям для авторских блокировок двигателя.', 'assets/img/A90.png', 'assets/img/f5.png', 'assets/img/f10.png', 'assets/img/f8.png', '10950.00'),
(16, 'StarLine A60 eco', 'Метка', 'Ананасовая долина – это невероятное место, где время словно останавливается, чтобы дать возможность насладиться красотой природы. Это долина, покрытая зелеными растениями и золотистыми ананасами, которые сияют под лучами солнца, создавая атмосферу сказочной гармонии. Лёгкий ветерок разносит сладкий аромат, смешанный с терпкими нотами свежих фруктов. Повсюду слышны звуки природы: щебет птиц, шелест листвы и мягкое журчание ручейков.', 'assets/img/A60eco.png', 'assets/img/f5.png', 'assets/img/f5.png', 'assets/img/f5.png', '5600.00'),
(18, 'StarLine B97 v2 LTE GPS CAN', 'CAN', 'Надежный автомобильный охранно-телематический комплекс с интеллектуальным автозапуском с вашего смартфона, несканируемым диалоговым кодом управления, возможностью авторизации по защищенному протоколу через персональную метку, интегрированными 2CAN+4LIN, LTE (4G), GPS-ГЛОНАСС интерфейсами.', 'assets/img/B97v2 LTE GPS.png', 'assets/img/f12.png', 'assets/img/f4.png', 'assets/img/f10.png', '54300.00'),
(19, 'S96 v2 LTE-GPS PRO', 'Телефон', 'Ананасыыыыыыыыыыыыыыы вксусныееееееееееееееееееееееееееееееееееееееееееее очеееееееееееееееееееееееееееень вскусные\r\nАнанас, амыеё', 'assets/img/S96 v2 LTE-GPS PRO.png', 'assets/img/f12.png', 'assets/img/f4.png', 'assets/img/f10.png', '26500.00'),
(23, 'StarLine M66 V2 S', 'CAN', 'Компактный умный трекер StarLine M66 V2 c 2CAN-интерфейсом предназначен для умного мониторинга и надежной защиты легкового и грузового транспорта. Защищает. Сообщает. Показывает.', 'assets/img/f2.png', 'assets/img/f8.png', 'assets/img/f4.png', '', '8750.00'),
(28, 'StarLine E97', 'Автозапуск', 'Надежный автомобильный охранно-телематический комплекс с интеллектуальным автозапуском с вашего смартфона, несканируемым диалоговым кодом управления, возможностью авторизации по защищенному протоколу через персональную метку, интегрированными 2CAN+4LIN, LTE (4G), GPS-ГЛОНАСС интерфейсами.', 'assets/img/E97.png', 'assets/img/f12.png', 'assets/img/f4.png', 'assets/img/f10.png', '20650.00'),
(31, '123', 'Телефон', '123', 'A60eco.png', '', '', '', '123.00'),
(32, '123', 'Телефон', '123', 'A60eco.png', '', '', '', '123.00'),
(33, '123', 'Телефон', '1231', 'assets/img/A60eco.png', '', '', '', '23.00'),
(34, '123', 'Телефон', '1231', 'assets/img/A60eco.png', '', '', '', '23.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `user_name` varchar(108) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `role`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'user', 'dail', 'danil@mail.com', 'e86fdc2283aff4717103f2d44d0610f7'),
(2, 'admin', 'Администратор Коля', 'admin@starstaring.ru', '21232f297a57a5a743894a0e4a801fc3'),
(8, 'user', 'Данил', 'danila@mail.com', '22d7fe8c185003c98f97e5d6ced420c7'),
(9, 'user', 'asdasdasdasdfфывфыв', 'danilaф@mail.com', '25d55ad283aa400af464c76d713c07ad'),
(10, 'user', 'Саламус', 'danilaфmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'user', 'Danilаа', 'danilaq@mail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'user', 'Danilффф', 'danilaq1@mail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'user', 'Данил', 'danilaq2@mail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'user', 'asasas', 'danilaq12@mail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
