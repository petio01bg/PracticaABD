CREATE USER 'chestnut'@'%' IDENTIFIED BY 'futbol';
GRANT ALL PRIVILEGES ON `futbolmania`.* TO 'futbol'@'%';

CREATE USER 'chestnut'@'localhost' IDENTIFIED BY 'futbol';
GRANT ALL PRIVILEGES ON `futbolmania`.* TO 'futbol'@'localhost';