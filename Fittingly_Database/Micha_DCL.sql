USE `Fittingly_database`;
CREATE USER 'Admin '@' % ' IDENTIFIED BY 'AdminPassword';
GRANT ALL PRIVILEGES ON EBOOST.* TO ‘Admin’@'%' WITH GRANT OPTION;