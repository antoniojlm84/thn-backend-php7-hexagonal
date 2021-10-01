CREATE DATABASE thnbackendtest;
CREATE USER 'thnbackendtest'@'%' IDENTIFIED BY 'thnbackendtest';
GRANT ALL PRIVILEGES ON thnbackendtest . * TO 'thnbackendtest'@'%';
FLUSH PRIVILEGES;

SHOW DATABASES;
