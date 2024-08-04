SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `usua`;
CREATE TABLE IF NOT EXISTS `usua` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(140) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `usua` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'admin', 'adm@admin.com', '$argon2id$v=19$m=65536,t=4,p=1$TVYySUllSDBmbThGaVZjQQ$8nC/L17Dq6pKTwsLbPk7ZLF9kAulqGmJGHxbRatDC/M');
-- nome:admin, email: adm@admin.com, senha: Admin01*
COMMIT;
