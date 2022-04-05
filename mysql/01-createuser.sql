CREATE USER 'futbol'@'%' IDENTIFIED BY 'futbol';
GRANT ALL PRIVILEGES ON `futbolmania`.* TO 'futbol'@'%';

CREATE USER 'futbol'@'localhost' IDENTIFIED BY 'futbol';
GRANT ALL PRIVILEGES ON `futbolmania`.* TO 'futbol'@'localhost';