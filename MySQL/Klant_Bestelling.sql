-- Ja Bart I know dit hoort hier eigenlijk niet, maar zo raken we de code niet per ongeluk kwijt. kusje

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS ``;
DROP TABLE IF EXISTS ``;
DROP TABLE IF EXISTS ``;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `UserAccount` (
    `EmailAdres` VARCHAR(100) PRIMARY KEY,
    `Password` VARCHAR(100),
    `AccountStatus` BOOLEAN,
    `AccountAccessRights` BOOLEAN,
    `RegistrationDate` int,
);

CREATE TABLE `Article` (
    
)