CREATE TABLE IF NOT EXISTS `students` ( 
    `id` int(11) NOT NULL AUTO_INCREMENT, 
    `name` varchar(255) NOT NULL, 
    `class` varchar(255) NOT NULL, 
    `email` varchar(255) NOT NULL, 
    `created_at` datetime NOT NULL, 
    `updated_at` datetime NOT NULL, PRIMARY KEY (`id`) 
)ENGINE=InnoDB