create table `monitoring` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `status` BOOLEAN NOT NULL,
  `header` TEXT,
  `body` TEXT,
  `date_request` DATETIME,
  `date_response` DATETIME,
  `latency` FLOAT NOT NULL,
   PRIMARY KEY (`id`)
);
