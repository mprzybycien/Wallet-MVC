-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Gru 2021, 15:50
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wallet_mvc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(5) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `currencies`
--

INSERT INTO `currencies` (`id`, `name`) VALUES
(1, 'USD'),
(2, 'EUR'),
(3, 'PLN'),
(4, 'GBP'),
(5, 'CHF'),
(6, 'NOK'),
(7, 'SEK'),
(8, 'BTC'),
(9, 'ETH');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expense_category_assigned_to_user_id` int(11) UNSIGNED NOT NULL,
  `payment_method_assigned_to_user_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `date_of_expense` date NOT NULL,
  `expense_comment` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `expense_category_assigned_to_user_id`, `payment_method_assigned_to_user_id`, `amount`, `date_of_expense`, `expense_comment`) VALUES
(8, 2, 33, 11, '1666.00', '2021-04-11', 'okokok'),
(9, 2, 40, 12, '222.00', '2021-04-11', 'trtyuiooi'),
(10, 6, 110, 28, '2.13', '2021-04-13', ''),
(11, 6, 112, 29, '54.19', '2021-04-07', ''),
(12, 6, 112, 29, '32.09', '2021-04-04', ''),
(13, 6, 113, 28, '43.18', '2021-04-01', ''),
(14, 6, 114, 30, '67.18', '2021-04-06', ''),
(15, 6, 116, 30, '3.14', '2021-04-08', ''),
(16, 6, 111, 29, '34.19', '2021-03-09', ''),
(17, 6, 114, 29, '89.18', '2021-03-30', ''),
(23, 2, 190, 8, '90.00', '2021-12-07', ''),
(24, 2, 188, 8, '1233.00', '2021-12-07', ''),
(25, 2, 202, 11, '900.00', '2021-12-08', 'qwfdfvdfvervqvdsvervdfvfv'),
(26, 2, 202, 8, '1111.00', '2021-10-07', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_assigned_to_users`
--

CREATE TABLE `expenses_category_assigned_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `maximum` decimal(8,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_assigned_to_users`
--

INSERT INTO `expenses_category_assigned_to_users` (`id`, `user_id`, `name`, `maximum`) VALUES
(1, 1, 'Another', '0.00'),
(2, 1, 'Apartments', '0.00'),
(3, 1, 'Books', '0.00'),
(4, 1, 'Debt Repayment', '0.00'),
(5, 1, 'Food', '0.00'),
(6, 1, 'For Retirement', '0.00'),
(7, 1, 'Gift', '0.00'),
(8, 1, 'Health', '0.00'),
(9, 1, 'Hygiene', '0.00'),
(10, 1, 'Kids', '0.00'),
(11, 1, 'Recreation', '0.00'),
(12, 1, 'Savings', '0.00'),
(13, 1, 'Telecommunication', '0.00'),
(14, 1, 'Transport', '0.00'),
(15, 1, 'Trip', '0.00'),
(16, 1, 'Other', '0.00'),
(33, 2, 'Apartments', '0.00'),
(35, 2, 'Debt Repayment', '0.00'),
(37, 2, 'For Retirement', '0.00'),
(39, 2, 'Health', '0.00'),
(40, 2, 'Hygiene', '0.00'),
(42, 2, 'Recreation', '0.00'),
(44, 2, 'Telecommunication', '0.00'),
(45, 2, 'Transport', '880.00'),
(47, 2, 'Other', '0.00'),
(48, 4, 'Another', '0.00'),
(49, 4, 'Apartments', '0.00'),
(50, 4, 'Books', '0.00'),
(51, 4, 'Debt Repayment', '0.00'),
(52, 4, 'Food', '0.00'),
(53, 4, 'For Retirement', '0.00'),
(54, 4, 'Gift', '0.00'),
(55, 4, 'Health', '0.00'),
(56, 4, 'Hygiene', '0.00'),
(57, 4, 'Kids', '0.00'),
(58, 4, 'Recreation', '0.00'),
(59, 4, 'Savings', '0.00'),
(60, 4, 'Telecommunication', '0.00'),
(61, 4, 'Transport', '0.00'),
(62, 4, 'Trip', '0.00'),
(63, 4, 'Other', '0.00'),
(79, 5, 'Another', '0.00'),
(80, 5, 'Apartments', '0.00'),
(81, 5, 'Books', '0.00'),
(82, 5, 'Debt Repayment', '0.00'),
(83, 5, 'Food', '0.00'),
(84, 5, 'For Retirement', '0.00'),
(85, 5, 'Gift', '0.00'),
(86, 5, 'Health', '0.00'),
(87, 5, 'Hygiene', '0.00'),
(88, 5, 'Kids', '0.00'),
(89, 5, 'Recreation', '0.00'),
(90, 5, 'Savings', '0.00'),
(91, 5, 'Telecommunication', '0.00'),
(92, 5, 'Transport', '0.00'),
(93, 5, 'Trip', '0.00'),
(94, 5, 'Other', '0.00'),
(110, 6, 'Another', '0.00'),
(111, 6, 'Apartments', '0.00'),
(112, 6, 'Books', '0.00'),
(113, 6, 'Debt Repayment', '0.00'),
(114, 6, 'Food', '0.00'),
(115, 6, 'For Retirement', '0.00'),
(116, 6, 'Gift', '0.00'),
(117, 6, 'Health', '0.00'),
(118, 6, 'Hygiene', '0.00'),
(119, 6, 'Kids', '0.00'),
(120, 6, 'Recreation', '0.00'),
(121, 6, 'Savings', '0.00'),
(122, 6, 'Telecommunication', '0.00'),
(123, 6, 'Transport', '0.00'),
(124, 6, 'Trip', '0.00'),
(125, 6, 'Other', '0.00'),
(141, 7, 'Another', '0.00'),
(142, 7, 'Apartments', '0.00'),
(143, 7, 'Books', '0.00'),
(144, 7, 'Debt Repayment', '0.00'),
(145, 7, 'Food', '0.00'),
(146, 7, 'For Retirement', '0.00'),
(147, 7, 'Gift', '0.00'),
(148, 7, 'Health', '0.00'),
(149, 7, 'Hygiene', '0.00'),
(150, 7, 'Kids', '0.00'),
(151, 7, 'Recreation', '0.00'),
(152, 7, 'Savings', '0.00'),
(153, 7, 'Telecommunication', '0.00'),
(154, 7, 'Transport', '0.00'),
(155, 7, 'Trip', '0.00'),
(156, 7, 'Other', '0.00'),
(172, 8, 'Another', '0.00'),
(173, 8, 'Apartments', '0.00'),
(174, 8, 'Books', '0.00'),
(175, 8, 'Debt Repayment', '0.00'),
(176, 8, 'Food', '0.00'),
(177, 8, 'For Retirement', '0.00'),
(178, 8, 'Gift', '0.00'),
(179, 8, 'Health', '0.00'),
(180, 8, 'Hygiene', '0.00'),
(181, 8, 'Kids', '0.00'),
(182, 8, 'Recreation', '0.00'),
(183, 8, 'Savings', '0.00'),
(184, 8, 'Telecommunication', '0.00'),
(185, 8, 'Transport', '0.00'),
(186, 8, 'Trip', '0.00'),
(187, 8, 'Other', '0.00'),
(188, 2, 'asd', '0.00'),
(189, 2, 'test', '123.00'),
(190, 2, 'new', '100.00'),
(192, 2, 'ert', '0.00'),
(194, 2, 'awfsdg', '0.00'),
(197, 2, 'ass', '0.00'),
(202, 2, 'anew', '1000.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_default`
--

CREATE TABLE `expenses_category_default` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_default`
--

INSERT INTO `expenses_category_default` (`id`, `name`) VALUES
(1, 'Another'),
(2, 'Apartments'),
(3, 'Books'),
(4, 'Debt Repayment'),
(5, 'Food'),
(6, 'For Retirement'),
(7, 'Gift'),
(8, 'Health'),
(9, 'Hygiene'),
(10, 'Kids'),
(11, 'Recreation'),
(12, 'Savings'),
(13, 'Telecommunication'),
(14, 'Transport'),
(15, 'Trip'),
(16, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `income_category_assigned_to_user_id` int(11) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `date_of_income` date NOT NULL,
  `income_comment` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `income_category_assigned_to_user_id`, `amount`, `date_of_income`, `income_comment`) VALUES
(7, 2, 8, '65.00', '2021-04-11', ''),
(8, 2, 8, '65.00', '2021-04-11', ''),
(10, 2, 10, '123.00', '2021-04-12', '123'),
(11, 2, 8, '3.00', '2021-04-12', ''),
(12, 2, 13, '234.00', '2021-04-12', '44'),
(15, 2, 10, '123.00', '2021-04-12', ''),
(18, 2, 10, '444.00', '2021-04-12', ''),
(19, 6, 33, '1234.56', '2021-04-13', ''),
(20, 6, 34, '32.12', '2021-04-07', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_assigned_to_users`
--

CREATE TABLE `incomes_category_assigned_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_assigned_to_users`
--

INSERT INTO `incomes_category_assigned_to_users` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Salary'),
(2, 1, 'Allegro'),
(3, 1, 'Bonus'),
(4, 1, 'Orders'),
(5, 1, 'Services'),
(6, 1, 'Other'),
(8, 2, 'Salary'),
(10, 2, 'Bonus'),
(13, 2, 'Other'),
(16, 2, 'test'),
(19, 4, 'Salary'),
(20, 4, 'Allegro'),
(21, 4, 'Bonus'),
(22, 4, 'Orders'),
(23, 4, 'Services'),
(24, 4, 'Other'),
(26, 5, 'Salary'),
(27, 5, 'Allegro'),
(28, 5, 'Bonus'),
(29, 5, 'Orders'),
(30, 5, 'Services'),
(31, 5, 'Other'),
(33, 6, 'Salary'),
(34, 6, 'Allegro'),
(35, 6, 'Bonus'),
(36, 6, 'Orders'),
(37, 6, 'Services'),
(38, 6, 'Other'),
(40, 7, 'Salary'),
(41, 7, 'Allegro'),
(42, 7, 'Bonus'),
(43, 7, 'Orders'),
(44, 7, 'Services'),
(45, 7, 'Other'),
(47, 8, 'Salary'),
(48, 8, 'Allegro'),
(49, 8, 'Bonus'),
(50, 8, 'Orders'),
(51, 8, 'Services'),
(52, 8, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_default`
--

CREATE TABLE `incomes_category_default` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_default`
--

INSERT INTO `incomes_category_default` (`id`, `name`) VALUES
(1, 'Salary'),
(2, 'Allegro'),
(3, 'Bonus'),
(4, 'Orders'),
(5, 'Services'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_assigned_to_users`
--

CREATE TABLE `payment_methods_assigned_to_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_assigned_to_users`
--

INSERT INTO `payment_methods_assigned_to_users` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Cash'),
(2, 1, 'Credit Card'),
(3, 1, 'Debit Card'),
(4, 1, 'Other'),
(8, 2, 'Cash'),
(11, 2, 'Other'),
(12, 2, 'Credit card'),
(13, 2, 'Debit card'),
(14, 4, 'Cash'),
(15, 4, 'Credit Card'),
(16, 4, 'Debit Card'),
(17, 4, 'Other'),
(21, 5, 'Cash'),
(22, 5, 'Credit Card'),
(23, 5, 'Debit Card'),
(24, 5, 'Other'),
(28, 6, 'Cash'),
(29, 6, 'Credit Card'),
(30, 6, 'Debit Card'),
(31, 6, 'Other'),
(35, 7, 'Cash'),
(36, 7, 'Credit Card'),
(37, 7, 'Debit Card'),
(38, 7, 'Other'),
(42, 8, 'Cash'),
(43, 8, 'Credit Card'),
(44, 8, 'Debit Card'),
(45, 8, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_default`
--

CREATE TABLE `payment_methods_default` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_default`
--

INSERT INTO `payment_methods_default` (`id`, `name`) VALUES
(1, 'Cash'),
(2, 'Credit Card'),
(3, 'Debit Card'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `remembered_logins`
--

CREATE TABLE `remembered_logins` (
  `token_hash` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `remembered_logins`
--

INSERT INTO `remembered_logins` (`token_hash`, `user_id`, `expires_at`) VALUES
('f586e002ac30f65be731af295de21358603a6013fa1d4644a4fd7ace72aebb14', 2, '2022-01-18 20:02:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password_reset_hash` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `password_reset_expires_at` datetime DEFAULT NULL,
  `activation_hash` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `are_cat_loaded` tinyint(1) NOT NULL DEFAULT 0,
  `theme` tinyint(1) NOT NULL DEFAULT 0,
  `currency` varchar(5) COLLATE utf8_polish_ci NOT NULL DEFAULT 'USD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `activation_hash`, `is_active`, `are_cat_loaded`, `theme`, `currency`) VALUES
(2, 'Mateusz', 'demo@mateuszprzybycien.pl', '$2y$10$tVmZJ27ltahyZGcDduA3qOYzXI6KQ2doEnmkOV6Gp/aSnTja02jBK', NULL, NULL, NULL, 1, 1, 1, 'PLN'),
(5, 'Mateusz', 'mateusz.przybycien@outlook.com', '$2y$10$sg.255DVbl06IsJ4t.BsFOA6pQulgpveTM.TDZ6iBP7NNkEnNZEGe', NULL, NULL, NULL, 1, 1, 0, 'USD'),
(6, 'Projekt', 'projekt@przyszlyprogramista.pl', '$2y$10$ZtOrt0Q11kgVelLWgOcfD.meyPiuPFPxg6oA4cux7PgJbXOjI4aM2', NULL, NULL, NULL, 1, 1, 0, 'USD'),
(7, 'Mateusz', 'poczta@mateuszprzybycien.pl', '$2y$10$B.oxBs.rh/SZrL7m2R5HIuVfg23cPaeY6XsgfKZzowX/ww00w7ne.', NULL, NULL, '62f414145e0b2f285da6fd0cd39ec551d741588e1bdda6e14a80be894899c1d8', 0, 1, 0, 'USD'),
(8, 'Ewelina Kozioł', 'ewelinakoziol.91@o2.pl', '$2y$10$WapoeyVKwTD2vBNjWJiiUuGVOzXG4J640gtCHUCfURL9fDOCkqIPm', NULL, NULL, NULL, 1, 1, 0, 'USD'),
(10, 'mat', 'm.przybycien@tia.com.pl', '$2y$10$7oQpsYmoBtYinKZp7578we7HBUrfH9MOC7Gg3Zygg5OnCIAIckpXa', NULL, NULL, '945abbca8ebbc412508b809e42e4cd40eb3d04257e2344f90a9c385266d29c99', 0, 0, 0, 'USD'),
(12, 'mat', 'przybycien@outlook.com', '$2y$10$6BA7AqMFsEZzQZXb.cLVNuDJ7quaaFY6G9CKm1V71AXpX2ucxeX6O', NULL, NULL, '15dca956ccde2c333eb2e6f06d6b6e08fcb66acfd4cd223878510e5d0db6c56d', 0, 0, 0, 'USD');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses_category_assigned_to_users`
--
ALTER TABLE `expenses_category_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes_category_assigned_to_users`
--
ALTER TABLE `incomes_category_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_methods_assigned_to_users`
--
ALTER TABLE `payment_methods_assigned_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD PRIMARY KEY (`token_hash`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_hash` (`password_reset_hash`),
  ADD UNIQUE KEY `activation_hash` (`activation_hash`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_assigned_to_users`
--
ALTER TABLE `expenses_category_assigned_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_assigned_to_users`
--
ALTER TABLE `incomes_category_assigned_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_assigned_to_users`
--
ALTER TABLE `payment_methods_assigned_to_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
