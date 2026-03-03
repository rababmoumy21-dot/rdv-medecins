-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 mars 2026 à 03:00
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rdv_medecins`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

CREATE TABLE `creneaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medecin_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `creneaux`
--

INSERT INTO `creneaux` (`id`, `medecin_id`, `date`, `heure_debut`, `heure_fin`, `disponible`, `created_at`, `updated_at`) VALUES
(11, 2, '2026-02-28', '11:00:00', '11:30:00', 0, '2026-02-11 12:54:38', '2026-02-11 13:05:00'),
(14, 2, '2026-03-11', '08:37:00', '08:55:00', 0, '2026-02-11 14:34:36', '2026-02-11 14:34:49'),
(16, 4, '2026-02-25', '15:00:00', '15:30:00', 0, '2026-02-11 14:46:00', '2026-02-11 14:46:11'),
(25, 9, '2026-03-05', '11:20:00', '11:44:00', 0, '2026-02-12 07:20:55', '2026-02-12 10:14:53'),
(36, 18, '2026-02-27', '18:07:00', '18:30:00', 0, '2026-02-12 21:07:21', '2026-02-12 21:11:46'),
(47, 19, '2026-03-19', '11:19:00', '11:59:00', 1, '2026-03-02 11:19:20', '2026-03-03 00:47:43'),
(52, 15, '2026-03-19', '16:42:00', '16:59:00', 1, '2026-03-02 15:42:23', '2026-03-03 01:06:30'),
(63, 19, '2026-03-18', '11:23:00', '12:23:00', 0, '2026-03-02 20:23:46', '2026-03-02 20:24:08'),
(65, 35, '2026-03-18', '14:56:00', '15:16:00', 0, '2026-03-03 00:57:15', '2026-03-03 00:57:47');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `cin` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `specialite_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `prenom`, `cin`, `email`, `telephone`, `specialite_id`, `created_at`, `updated_at`) VALUES
(2, 'Oubni', 'ilham', 'Z665678', 'oubni.ilham@gmail.com', '0659874518', 1, '2026-02-10 13:20:47', '2026-03-02 20:37:42'),
(4, 'Arass', 'bouchaib', 'DF98754', 'arass.bouchaib@gmail.com', '0789652369', 3, '2026-02-10 14:30:56', '2026-03-02 20:37:31'),
(9, 'Bensaida', 'Lamiae', 'TU83049', 'Bensaida.lamiae@gmail.com', '0678543234', 10, '2026-02-12 07:18:38', '2026-03-01 20:16:12'),
(15, 'Benjaloun', 'Hind', 'YU46538', 'hind.benjaloun@gmail.com', '0652369874', 1, '2026-02-12 19:29:18', '2026-03-01 20:15:59'),
(18, 'Fikri', 'Chaimae', 'GZ346578', 'fikri.chaimae@gmail.com', '0652365897', 14, '2026-02-12 21:06:29', '2026-03-01 20:17:22'),
(19, 'Bouhri', 'Hamza', 'BV53642', 'bouhri.hamza@gmail.com', '0678982323', 11, '2026-02-24 11:47:25', '2026-03-01 20:16:25'),
(32, 'Aboudi', 'Adil', 'k175255', 'aboudi.adil@gmail.com', '0678982345', 14, '2026-03-02 20:39:44', '2026-03-02 20:39:44'),
(33, 'Ismaili', 'Kamal', 'TR65676', 'Ismaili.kamal@gmail.com', '0678982398', 14, '2026-03-02 20:40:31', '2026-03-02 20:40:31'),
(35, 'Alhajouji', 'Karima', 'DI13456', 'alhajouji.karima@gmail.com', '0647102360', 8, '2026-03-03 00:55:54', '2026-03-03 00:55:54');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_09_165303_create_specialites_table', 1),
(5, '2026_02_09_165403_create_medecins_table', 1),
(6, '2026_02_09_165415_create_patients_table', 1),
(7, '2026_02_09_165426_create_creneaux_table', 1),
(8, '2026_02_09_165437_create_rendez_vous_table', 1),
(9, '2026_02_10_205707_add_telephone_to_patients_table', 2),
(10, '2026_02_11_083217_add_fields_to_patients_table', 3),
(11, '2026_02_11_091144_modify_email_nullable_in_patients_table', 4),
(14, '2026_02_12_075112_add_adresse_to_patients_table', 5),
(15, '2026_03_01_163525_add_cin_to_patients_table', 1),
(16, '2026_03_01_195143_add_cin_to_medecins_table', 6);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `nom`, `prenom`, `cin`, `email`, `created_at`, `updated_at`, `telephone`, `date_naissance`, `adresse`) VALUES
(1, 'Naimi', 'khaoula', 'DI13456', 'khaoula.naimi@gmail.com', '2026-02-11 08:06:20', '2026-03-01 20:31:42', '0689754896', '1991-06-13', 'Combata N°: 45 Meknès'),
(3, 'Lamhamdi', 'Malak', 'DI13956', 'lamhamdi.malak@gmail.com', '2026-02-11 10:36:04', '2026-03-01 20:30:34', '0647102360', '1984-07-05', 'El Omrane N°: 45 Meknès'),
(4, 'Makaoui', 'amine', 'IM98567', 'makaoui.amine@gmail.com', '2026-02-11 12:55:59', '2026-03-01 20:32:09', '0678543234', '2017-02-01', 'Bassatine Meknès'),
(5, 'Hmidouch', 'Mouna', 'L654324', 'hmiidouch.mouna@gmail.com', '2026-02-11 12:58:56', '2026-03-01 20:30:10', '0678059483', '1990-07-24', 'toulal N°: 356 Meknès'),
(7, 'Salami', 'Abdessalam', 'R654325', 'salami.abdessalam@gmail.com', '2026-02-12 07:14:31', '2026-03-01 20:31:16', '0689754894', '1985-06-12', 'Wjeh arous Meknès'),
(9, 'Lamrini', 'Hanae', 'TR65678', 'Hanae.lamrini@gmail.com', '2026-02-12 16:00:33', '2026-03-01 20:32:31', '0789654789', '1986-07-25', 'Mamounia N°: 876 Meknès'),
(11, 'Bennani', 'Ahmed', 'DN15654', 'bennani.ahmed@gmail.com', '2026-03-01 17:10:03', '2026-03-02 20:49:27', '0647108763', '1972-06-02', 'Narjis Fès'),
(12, 'Hamouchi', 'Youssef', 'AR25436', 'hamouch.youssef@gmail.com', '2026-03-01 20:35:10', '2026-03-02 01:05:03', '0765432123', '2026-03-13', 'Ouislane Meknès'),
(13, 'Hamadi', 'soumia', 'PM98757', 'hamadi.soumia@gmail.com', '2026-03-02 01:04:35', '2026-03-02 01:04:35', '0647102360', '1990-07-10', 'El Omrane N°: 876 Meknès'),
(15, 'Hamoudan', 'Badereddine', 'IL87654', 'hamoudan@gmail.com', '2026-03-02 21:06:09', '2026-03-02 21:06:09', '0623482345', '1973-06-02', 'zagoura');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `creneau_id` bigint(20) UNSIGNED NOT NULL,
  `statut` enum('confirme','annule') NOT NULL DEFAULT 'confirme',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `patient_id`, `creneau_id`, `statut`, `created_at`, `updated_at`) VALUES
(6, 3, 11, 'confirme', '2026-02-11 13:05:00', '2026-02-11 13:05:00'),
(22, 7, 25, 'confirme', '2026-02-12 10:14:53', '2026-02-12 10:14:53'),
(25, 4, 65, 'confirme', '2026-02-12 12:44:41', '2026-03-03 00:57:47'),
(30, 5, 36, 'confirme', '2026-02-12 21:11:46', '2026-02-12 21:11:46'),
(35, 1, 47, 'annule', '2026-03-02 00:00:46', '2026-03-03 00:47:43'),
(40, 11, 52, 'annule', '2026-03-02 21:18:23', '2026-03-03 00:51:03'),
(42, 13, 52, 'annule', '2026-03-03 01:04:39', '2026-03-03 01:06:30');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bZveDQmOmETi65inaH9AWrPuFAMVGJTAp4oFQW6X', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicjNCTXA5TFdTYnhuUXY5TW1LUGRmTlpuMUxab1lCanlXcDJ6Umd6diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTA2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2FsZW5kYXIvZXZlbnRzP2VuZD0yMDI2LTA0LTEyVDAwJTNBMDAlM0EwMCUyQjAxJTNBMDAmc3RhcnQ9MjAyNi0wMy0wMVQwMCUzQTAwJTNBMDBaIjtzOjU6InJvdXRlIjtzOjI3OiJnZW5lcmF0ZWQ6OklQU0JUbmQ1NHEyZHVOVGIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1772500137);

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

CREATE TABLE `specialites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `specialites`
--

INSERT INTO `specialites` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Biochimie', '2026-02-10 10:28:26', '2026-03-01 20:46:09'),
(3, 'Dermatologie', '2026-02-10 13:21:11', '2026-02-10 13:21:11'),
(6, 'Chirurgie pédiatrique', '2026-02-10 14:31:26', '2026-02-10 14:31:26'),
(8, 'Réanimation Médicale', '2026-02-12 07:16:42', '2026-02-12 07:16:42'),
(9, 'Pneumophtysiologie', '2026-02-12 07:17:06', '2026-02-12 07:17:06'),
(10, 'Néphrologie', '2026-02-12 07:17:24', '2026-03-02 20:41:56'),
(11, 'Chirurgie générale', '2026-02-12 14:44:06', '2026-02-12 14:44:06'),
(12, 'Endocrinologie et Maladies Métaboliques', '2026-02-12 20:27:51', '2026-02-12 20:27:51'),
(13, 'Oncologie Médicale', '2026-02-12 20:30:53', '2026-02-12 20:30:53'),
(14, 'Psychiatrie', '2026-02-12 21:03:17', '2026-02-12 21:03:17'),
(15, 'Médico-techniques', '2026-03-01 20:20:27', '2026-03-01 20:20:40'),
(16, 'Cardiologie', '2026-03-02 20:42:13', '2026-03-02 20:42:13'),
(17, 'Hépatologie', '2026-03-02 21:07:56', '2026-03-02 21:08:17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creneaux_medecin_id_foreign` (`medecin_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medecins_email_unique` (`email`),
  ADD KEY `medecins_specialite_id_foreign` (`specialite_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendez_vous_patient_id_foreign` (`patient_id`),
  ADD KEY `rendez_vous_creneau_id_foreign` (`creneau_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `specialites`
--
ALTER TABLE `specialites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `specialites`
--
ALTER TABLE `specialites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `creneaux`
--
ALTER TABLE `creneaux`
  ADD CONSTRAINT `creneaux_medecin_id_foreign` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD CONSTRAINT `medecins_specialite_id_foreign` FOREIGN KEY (`specialite_id`) REFERENCES `specialites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_creneau_id_foreign` FOREIGN KEY (`creneau_id`) REFERENCES `creneaux` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rendez_vous_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
