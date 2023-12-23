CREATE DATABASE IF NOT EXISTS testing;
CREATE USER IF NOT EXISTS 'test-user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON testing.* TO 'test-user'@'%' WITH GRANT OPTION;
