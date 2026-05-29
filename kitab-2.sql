-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : sam. 23 mai 2026 à 21:10
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
-- Base de données : `kitab`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `condition` enum('neuf','bon','moyen','abimé') DEFAULT 'bon',
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `for_exchange` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `user_id`, `titre`, `auteur`, `prix`, `genre`, `condition`, `image`, `description`, `for_exchange`, `created_at`) VALUES
(2, 1, 'kalila w demna', 'Ibn Moukafaa', 12.00, 'roman', 'bon', 'book_69d00c647ed39.webp', 'Kalila wa Dimna est un célèbre recueil de fables animalières moralisatrices, traduit en arabe par Ibn al-Muqaffa\' vers 750 d\'après le Panchatantra indien. Il met en scène deux chacals, Kalila (satisfaite) et Dimna (ambitieux), qui conseillent un lion (le roi) à travers des contes traitant de politique, d\'amitié et de trahison, servant de miroir aux princes', 0, '2026-04-03 19:52:20'),
(3, 1, 'dix petit negre', 'Agatha Christie', 50.00, 'roman', 'neuf', 'book_69d014407b7b8.jfif', 'Dix personnes apparemment sans point commun se retrouvent sur l\'île du Nègre, invités par un mystérieux M. Owen, malheureusement absent.\r\n\r\nUn couple de domestiques, récemment engagé, veille au confort des invités. Sur une table du salon, dix statuettes de nègres. Dans les chambres, une comptine racontant l\'élimination minutieuse de dix petits nègres.\r\n\r\nAprès le premier repas, une voix mystérieuse s\'élève dans la maison, reprochant à chacun un ou plusieurs crimes. Un des convives s\'étrangle et meurt, comme la première victime de la comptine. Une statuette disparaît. Et les morts se succèdent, suivant le texte à la lettre. La psychose monte.', 0, '2026-04-03 20:25:52'),
(4, 1, 'في قلبي أنثى عبرية', ' خولة حمدي', 40.00, 'roman', 'abimé', 'book_69d1034da89d8.jpg', '\r\nفي قلب حارة اليهود في الجنوب التونسي تتشابك الأحداث حول المسلمة اليتيمة التي تربت بين أحضان عائلة يهودية، و بين ثنايا مدينة قانا العتيقة في الجنوب اللبناني تدخل بلبلة غير متوقعة في حياة ندى التي نشأت على اليهودية بعيدا عن والدها المسلم. تتتابع اللقاءات و الأحداث المثيرة حولهما لتخرج كلا منهما من حياة الرتابة و تسير بها إلى موعد مع القدر. (في قلبي أنثى عبرية) رواية مستوحاة من أحداث حقيقية في قالب روائي مشوق', 0, '2026-04-04 13:25:49'),
(6, 1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 15.00, 'roman', 'moyen', 'book_69d153f241fc1.webp', 'Le Petit Prince (1943) d\'Antoine de Saint-Exupéry est un conte philosophique poétique racontant la rencontre dans le Sahara entre un aviateur en panne et un jeune prince voyageant d\'astéroïde en astéroïde. À travers ses rencontres, le prince observe l\'absurdité du monde adulte et apprend la valeur de l\'amour, de l\'amitié et de la responsabilité, notamment auprès d\'une rose et d\'un renard', 0, '2026-04-04 19:09:54'),
(7, 1, 'Diary of a Wimpy Kid', 'Jeff Kinney', 34.00, 'roman', 'neuf', 'book_69d24e8d089a6.jfif', '(Diary of a Wimpy Kid) de Jeff Kinney est une série de romans illustrés à succès racontant la vie humoristique de Greg Heffley, un collégien chétif et immature. À travers son \"journal de bord\" (et non un journal intime), Greg relate ses tentatives ratées de popularité, ses problèmes d\'amitié et ses déboires familiaux au collège. ', 0, '2026-04-05 12:59:09'),
(8, 1, 'The Silent Patient', 'Alex Michaelides ', 43.00, 'roman', 'neuf', 'book_69d36da2f0356.jfif', 'Dans son silence (The Silent Patient) d\'Alex Michaelides est un thriller psychologique addictif centré sur Alicia Berenson, une peintre célèbre qui assassine son mari de cinq balles dans la tête, puis ne prononce plus jamais un mot. Internée en psychiatrie, son silence obsède le thérapeute Theo Faber, qui tente de percer son secret', 0, '2026-04-06 09:24:02'),
(9, 1, 'tu comprendras quand tu seras plus grande', ' Virginie Grimaldi', 40.00, 'roman', 'neuf', 'book_69d7b24a1dc07.jpg', '« Tu comprendras quand tu seras plus grande » est un roman « feel-good » de Virginie Grimaldi racontant la reconstruction de Julia, 32 ans, psychologue désabusée qui accepte un poste dans une maison de retraite à Biarritz après des deuils personnels. Entre humour et émotion, elle retrouve goût à la vie grâce aux résidents fantasques', 0, '2026-04-09 15:06:02'),
(10, 1, 'Le Crime de l\'Orient-Express', 'Agatha Christie', 39.00, 'roman', 'moyen', 'book_69d7b57e5ec71.jpg', ' Le Crime de l\'Orient-Express » (1934) est un célèbre roman policier d\'Agatha Christie mettant en scène Hercule Poirot. Bloqué par la neige, le train de luxe est le théâtre du meurtre d\'un passager américain, Samuel Ratchett. Les treize passagers sont suspects, forçant Poirot à résoudre une enquête complexe à huis clos. ', 0, '2026-04-09 15:19:42'),
(13, 1, 'السندباد الأعمى', 'بثينة العيسى', 40.00, 'roman', 'neuf', 'book_6a1189884d008.jpeg', 'تحكي رواية السندباد الأعمى عن حادثةٍ عرضية واحدة، من منظور لم تتناوله روايات عربية كثيرة. تشكّل هذه الحادثة تحولًا جذريًا ونهائيًا لمصائر شخصياتٍ كانت تتّسمُ بالاكتراثِ والحلمِ والتفاعل، فتؤول بعدها إلى مسوخٍ لا تشبه بداياتها أبدًا.\r\n\r\nهذه رواية عن الحب والصداقة والخيانة، عن الالتزام السياسي والحرب، عن سقوط الشعارات وعن التناقضات في عالمِ فقد نقاءه إلى الأبد، حيثُ تنتهي تلك العناوين العريضة الى حيوات عبثية في عاديّتها. إنها رواية عن هؤلاء الذين ظنوا بأنهم مختلفون، ومسكونون بالالتزام والعقائدية، فإذا بحادثةٍ واحدة تقلبُ المشهد رأسًا على عقِب.', 0, '2026-05-23 12:03:36'),
(17, 1, 'sans famille', ' Hector Malot', 10.00, 'roman', 'abimé', 'book_6a11b8f0b882e.webp', 'Sans famille est un célèbre roman français écrit par Hector Malot, publié en 1878. Ce chef-d\'œuvre de la littérature d\'initiation et de jeunesse raconte les aventures touchantes et formatrices du jeune Rémi, un enfant trouvé', 0, '2026-05-23 15:25:52'),
(20, 2, 'L\'Étranger', 'Albert Camus', 15.00, 'roman', 'bon', 'https://m.media-amazon.com/images/I/A1xqddzhpwL._AC_UF1000,1000_QL80_.jpg', NULL, 1, '2026-05-23 19:48:56');

-- --------------------------------------------------------

--
-- Structure de la table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(11) NOT NULL,
  `user_requesting_id` int(11) NOT NULL,
  `user_offering_id` int(11) NOT NULL,
  `your_book_id` int(11) NOT NULL,
  `partner_book_id` int(11) NOT NULL,
  `status` enum('pending','accepted','refused','in_progress','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `offered_date` datetime DEFAULT current_timestamp(),
  `arriving_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exchanges`
--

INSERT INTO `exchanges` (`id`, `user_requesting_id`, `user_offering_id`, `your_book_id`, `partner_book_id`, `status`, `created_at`, `offered_date`, `arriving_date`) VALUES
(1, 1, 1, 2, 3, 'pending', '2026-05-23 19:23:17', '2026-05-23 19:23:17', NULL),
(2, 1, 1, 6, 7, 'accepted', '2026-05-23 19:23:17', '2026-05-23 19:23:17', NULL),
(3, 1, 1, 8, 9, 'completed', '2026-05-23 19:23:17', '2026-05-23 19:23:17', NULL),
(4, 1, 1, 10, 13, 'refused', '2026-05-23 19:23:17', '2026-05-23 19:23:17', NULL),
(5, 1, 1, 2, 3, 'pending', '2026-05-23 19:30:54', '2026-05-23 19:30:54', NULL),
(6, 1, 1, 6, 7, 'accepted', '2026-05-23 19:30:54', '2026-05-23 19:30:54', NULL),
(7, 1, 1, 8, 9, 'completed', '2026-05-23 19:30:54', '2026-05-23 19:30:54', NULL),
(8, 1, 1, 10, 13, 'refused', '2026-05-23 19:30:54', '2026-05-23 19:30:54', NULL),
(10, 1, 1, 2, 3, 'pending', '2026-05-23 19:31:53', '2026-05-23 19:31:53', NULL),
(11, 1, 1, 6, 7, 'accepted', '2026-05-23 19:31:53', '2026-05-23 19:31:53', NULL),
(12, 1, 1, 8, 9, 'completed', '2026-05-23 19:31:53', '2026-05-23 19:31:53', NULL),
(13, 1, 1, 10, 13, 'refused', '2026-05-23 19:31:53', '2026-05-23 19:31:53', NULL),
(14, 1, 1, 2, 3, 'pending', '2026-05-23 19:32:24', '2026-05-23 19:32:24', NULL),
(15, 1, 1, 6, 7, 'accepted', '2026-05-23 19:32:24', '2026-05-23 19:32:24', NULL),
(16, 1, 1, 8, 9, 'completed', '2026-05-23 19:32:24', '2026-05-23 19:32:24', NULL),
(17, 1, 1, 10, 13, 'refused', '2026-05-23 19:32:24', '2026-05-23 19:32:24', NULL),
(18, 1, 1, 2, 3, 'pending', '2026-05-23 19:35:54', '2026-05-23 19:35:54', NULL),
(19, 1, 1, 6, 7, 'accepted', '2026-05-23 19:35:54', '2026-05-23 19:35:54', NULL),
(20, 1, 1, 8, 9, 'completed', '2026-05-23 19:35:54', '2026-05-23 19:35:54', NULL),
(21, 1, 1, 10, 13, 'refused', '2026-05-23 19:35:54', '2026-05-23 19:35:54', NULL),
(26, 1, 2, 2, 20, 'pending', '2026-05-23 19:48:56', '2026-05-23 19:48:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reading_rooms`
--

CREATE TABLE `reading_rooms` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `total_pages` int(11) NOT NULL,
  `type` enum('live','scheduled') DEFAULT 'live',
  `max_participants` int(11) DEFAULT 15,
  `genre` varchar(100) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `host_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reading_rooms`
--

INSERT INTO `reading_rooms` (`id`, `titre`, `auteur`, `total_pages`, `type`, `max_participants`, `genre`, `tags`, `description`, `host_id`, `created_at`, `image`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 180, 'live', 10, 'Classic', 'Classic,American Literature', NULL, 1, '2026-05-23 13:58:03', 'https://prodimage.images-bn.com/pimages/9798823186759_p0_v2_s600x595.jpg'),
(2, 'Pride and Prejudice', 'Jane Austen', 432, 'live', 20, 'Romance', 'Classic,Romance', NULL, 1, '2026-05-23 13:58:03', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUKqDMRHeygT485g4rZxw735snLqdX6zcTQQ&s'),
(3, 'The Hobbit', 'J.R.R. Tolkien', 180, 'live', 19, 'Fantasy', 'Fantasy,Adventure', NULL, 1, '2026-05-23 13:58:03', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHIzm56W-N4vQhJsDLWcsku0JUjqfaOPYapQ&s'),
(4, 'To Kill a Mockingbird', 'Harper Lee', 180, 'live', 19, 'Fiction', 'Fiction,Adventure', NULL, 1, '2026-05-23 13:58:03', 'https://images.unsplash.com/photo-1762482832119-bfebb31c5eda?w=400'),
(5, '1984', 'George Orwell', 390, 'scheduled', 15, 'Dystopian', 'Dystopian,Sci-Fi', NULL, 1, '2026-05-23 13:58:03', 'https://m.media-amazon.com/images/I/61NAx5pd6XL._AC_UF1000,1000_QL80_.jpg'),
(6, 'The Alchemist', 'Paulo Coelho', 290, 'scheduled', 15, 'Philosophy', 'Philosophy,Adventure', NULL, 1, '2026-05-23 13:58:03', 'https://i5.walmartimages.com/seo/The-Alchemist-A-Graphic-Novel-Hardcover-9780062024329_1a3e69cc-6f42-4595-a954-f39ad8f1d1f8.33bd5811edf7b1f49acfeef15af926a0.jpeg'),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 300, 'scheduled', 15, 'Classic', 'Philosophy,Classic', NULL, 1, '2026-05-23 13:58:03', 'https://images.unsplash.com/photo-1759662280683-520528fb4c5a?w=400'),
(8, 'Jane Eyre', 'Charlotte Brontë', 290, 'scheduled', 15, 'Romance', 'Romance,Classic', NULL, 1, '2026-05-23 13:58:03', 'https://static.wikia.nocookie.net/classical-literature/images/8/87/61c1BiBgvdL.jpg'),
(9, 'dix petit negre', 'Agatha Christie', 120, 'live', 8, 'Classic', 'Classic,Romance', 'ls étaient dix (initialement intitulé Dix petits nègres et renommé pour éviter un terme jugé offensant) est le chef-d\'œuvre policier d\'Agatha Christie. L\'histoire suit dix personnes isolées sur une île coupée du monde. Accusées de meurtres passés impunis, elles sont assassinées une par une selon une comptine macabre', 1, '2026-05-23 14:02:01', 'room_6a11b359ac14e.webp'),
(10, 'l avare', 'Molière', 40, 'scheduled', 9, 'Philosophy', 'Fantasy,Romance', 'L\'Avare est une comédie de Molière en cinq actes et en prose, inspirée par La Marmite de Plaute et représentée pour la première fois sur la scène du Palais-Royal le 9 septembre 1668. Il s\'agit d\'une comédie de caractère dont le personnage principal, Harpagon, est caractérisé par son avarice caricaturale', 1, '2026-05-23 14:32:18', 'room_6a11ba7283b47.webp');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `avatar`, `bio`, `created_at`) VALUES
(1, 'Jlassi', 'Malak', 'malak@example.com', '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnop', 'default.png', 'Utilisateur test', '2026-04-03 19:51:54'),
(2, 'Dupont', 'Jean', 'jean.dupont@example.com', '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnop', 'default.png', 'Passionné de thrillers', '2026-05-23 19:35:21'),
(3, 'Martin', 'Sophie', 'sophie.martin@example.com', '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnop', 'default.png', 'Lectrice de romans historiques', '2026-05-23 19:35:21'),
(4, 'Ben Ali', 'Ahmed', 'ahmed.benali@example.com', '$2y$10$abcdefghijklmnopqrstuv1234567890abcdefghijklmnop', 'default.png', 'Collectionneur de BD', '2026-05-23 19:35:21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_requesting_id` (`user_requesting_id`),
  ADD KEY `user_offering_id` (`user_offering_id`),
  ADD KEY `your_book_id` (`your_book_id`),
  ADD KEY `partner_book_id` (`partner_book_id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`book_id`);

--
-- Index pour la table `reading_rooms`
--
ALTER TABLE `reading_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reading_rooms`
--
ALTER TABLE `reading_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exchanges`
--
ALTER TABLE `exchanges`
  ADD CONSTRAINT `exchanges_ibfk_1` FOREIGN KEY (`user_requesting_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_2` FOREIGN KEY (`user_offering_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_3` FOREIGN KEY (`your_book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_4` FOREIGN KEY (`partner_book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
