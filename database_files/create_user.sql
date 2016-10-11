CREATE USER 'shr'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON `student-hospital-records`.* TO 'shr'@'localhost';
FLUSH PRIVILEGES;