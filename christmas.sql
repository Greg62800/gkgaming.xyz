-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.21 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5249
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de données de la table laravel.blog : 5 rows
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT IGNORE INTO `blog` (`id`, `name`, `slug`, `content`, `user_id`, `created_at`, `updated_at`, `online`) VALUES
	(1, 'Mon article edité 2', 'mon-article-edite-2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.', 1, '2018-07-15 18:32:05', '2018-07-17 18:15:53', 1),
	(2, 'Lorem ipsum dolor sit amet, consectetur adipisicin', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicin', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.', 1, '2018-07-15 18:32:05', '2018-07-17 14:05:09', 1),
	(3, 'Mon article', 'mon-article-3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.', 2, '2018-07-15 18:32:05', '2018-07-15 20:51:38', 1),
	(4, 'Mon article', 'mon-article-4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto atque est facilis harum inventore minima quisquam repellat temporibus? Ab deleniti dolorum eum nostrum officia quod? Deserunt fugit modi possimus quam.', 1, '2018-07-15 18:32:05', '2018-07-15 20:53:11', 1),
	(5, 'Je fais un petit test', 'je-fais-un-petit-test', 'Salut les gens je fais des test en local pour des articles', 1, '2018-07-17 10:23:40', '2018-07-17 10:23:40', NULL);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- Export de données de la table laravel.comments : 10 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT IGNORE INTO `comments` (`id`, `name`, `email`, `content`, `user_id`, `blog_id`, `created_at`, `updated_at`, `parent_id`) VALUES
	(1, 'Greg', 'greg', 'Hello', 2, 1, '2018-07-16 22:10:46', '2018-07-16 23:10:46', 0),
	(2, 'Greg', 'greg', 'Réponse', 2, 1, '2018-07-16 22:10:46', '2018-07-16 23:10:46', 1),
	(6, 'admin', 'admin@live.fr', 'Rép', 1, 1, '2018-07-16 23:21:03', '2018-07-16 23:21:03', 1),
	(4, 'Greg', 'greg', 'Hello', 2, 1, '2018-07-16 22:10:46', '2018-07-16 23:10:46', 1),
	(5, 'admin', 'admin@live.fr', 'Test', 1, 1, '2018-07-16 22:55:41', '2018-07-16 22:55:41', 0),
	(7, 'admin', 'admin@live.fr', 'Hello ;)', 1, 1, '2018-07-16 23:21:22', '2018-07-16 23:21:22', 5),
	(8, 'Test', 'webmasterhtmlcss@outlook.fr', 'Je tes un commentaire', 0, 2, '2018-07-17 10:29:40', '2018-07-17 10:29:40', 0),
	(9, 'John doe', 'john@doe.fr', 'Je suis une réponse', 0, 2, '2018-07-17 10:32:33', '2018-07-17 10:32:33', 8),
	(10, 'admin', 'admin@live.fr', 'Hello :D', 1, 2, '2018-07-17 15:09:20', '2018-07-17 15:09:20', 8),
	(11, 'admin', 'admin@live.fr', 'test', 1, 2, '2018-07-17 16:38:40', '2018-07-17 16:38:40', 10);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Export de données de la table laravel.migrations : 8 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2018_07_15_161718_create_blog_table', 2),
	(3, '2018_07_15_174628_add_online_to_users', 3),
	(4, '2018_07_15_174800_add_online_to_blog', 4),
	(10, '2018_07_15_214041_create_comments_table', 8),
	(7, '2018_07_16_114040_create_thumbs_table', 6),
	(8, '2018_07_16_120355_add_role_to_users', 7),
	(11, '2018_07_16_210705_add_parent_id_to_comments', 8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Export de données de la table laravel.thumbs : 0 rows
/*!40000 ALTER TABLE `thumbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `thumbs` ENABLE KEYS */;

-- Export de données de la table laravel.users : 2 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `online`, `role`) VALUES
	(1, 'admin', 'admin@live.fr', '$2y$10$YRY/QftKhSlslENpmAv4B.tdt5zgyhIHFN3l8cZsaxCMQZy9RYcEO', '1.png', 'SpFHB2X5Bt5afgLALedMkw6nGCtaBa7ENoSnvfJkoyZhmL6IiYdUQwDG0ILx', '2018-07-14 14:09:15', '2018-07-15 20:53:04', 0, 'admin'),
	(2, 'Greg', 'greg@gmail.com', '$2y$10$pbk/6LPaJX9utO6EEOjrguVE/67Lm/.62Lx7wnI7JB4VeBwyPYeLi', '2.png', '8U4AudOTscZ5yubEczQRdvoPj63JW6pUpKKqdhY8qulyWSBEBK4T8WxiNAZS', '2018-07-14 21:50:16', '2018-07-15 19:20:54', 0, 'user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
