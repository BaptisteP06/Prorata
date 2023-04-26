-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 fév. 2023 à 13:38
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testprorata`
--

-- --------------------------------------------------------

--
-- Structure de la table `refunds`
--

CREATE TABLE `refunds` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `refund_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `refunds`
--

INSERT INTO `refunds` (`id`, `subscription_id`, `amount`, `refund_date`) VALUES
(1, 1, '5.00', '2022-02-15'),
(2, 2, '2.50', '2022-03-01'),
(3, 3, '1.00', '2022-02-28');

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `tax_rate` decimal(5,2) DEFAULT NULL,
  `new_end_date` date DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `capacity_uti` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `start_date`, `end_date`, `capacity`, `unit_price`, `currency`, `tax_rate`, `new_end_date`, `new_price`, `capacity_uti`) VALUES
(1, 'Gold Plan', '2022-01-01', '2023-02-01', 500, '49.99', 'USD', '20.00', NULL, NULL, 0),
(2, 'Silver Plan', '2022-01-01', '2022-11-15', 1000, '2964.00', 'EUR', '20.00', NULL, NULL, 0),
(3, 'Bronze Plan', '2022-01-01', '2022-12-31', 3500, '19.99', 'USD', '20.00', NULL, NULL, 0),
(4, 'gntrnh', '2022-03-29', '2023-03-30', 1000, '2964.00', 'EUR', '20.00', NULL, NULL, 0),
(5, 'SADE CGTH', '2022-03-29', '2022-10-28', 1000, '2964.00', 'EUR', '20.00', '2023-10-29', '6786.00', 0),
(6, 'TestProra', '2022-05-18', '2022-08-26', 3500, '4845.00', NULL, '20.00', '2023-08-26', '6773.50', 2000),
(9, 'Prora2', '2022-03-14', '2023-02-16', 2000, '2470.00', NULL, NULL, '2024-02-16', '5655.00', 111);

-- --------------------------------------------------------

--
-- Structure de la table `usageee`
--

CREATE TABLE `usageee` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `usage_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `usageee`
--

INSERT INTO `usageee` (`id`, `subscription_id`, `date`, `usage_amount`) VALUES
(1, 1, '2023-02-01', 30),
(2, 1, '2023-03-01', 40),
(3, 2, '2023-02-01', 20),
(4, 2, '2023-03-01', 25),
(5, 3, '2023-02-01', 10),
(6, 3, '2023-03-01', 15);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Baptiste', 'Test');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_ibfk_1` (`subscription_id`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usageee`
--
ALTER TABLE `usageee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usage_ibfk_1` (`subscription_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `usageee`
--
ALTER TABLE `usageee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`);

--
-- Contraintes pour la table `usageee`
--
ALTER TABLE `usageee`
  ADD CONSTRAINT `usageee_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
