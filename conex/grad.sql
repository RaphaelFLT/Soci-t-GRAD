CREATE DATABASE IF NOT EXISTS `grad` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `grad`;


CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `message` text NOT NULL
)



COMMIT;