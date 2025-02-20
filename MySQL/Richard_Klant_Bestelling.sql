-- Ja Bart I know dit hoort hier eigenlijk niet, maar zo raken we de code niet per ongeluk kwijt. kusje

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `UserAccount`;
DROP TABLE IF EXISTS `Article`;
DROP TABLE IF EXISTS `Adres`;
DROP TABLE IF EXISTS `Order`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `UserAccount` (
    `EmailAdres` VARCHAR(100) PRIMARY KEY,
    `Password` VARCHAR(100),
    `AccountStatus` BOOLEAN,
    `AccountAccessRights` BOOLEAN,
    `RegistrationDate` int,
);

CREATE TABLE `Article` (
    `ArticleID` int AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(20),
    `Size` VARCHAR(100),
    `Weight` VARCHAR(100),
    `Price` DECIMAL(10,2)
);

CREATE TABLE `Adres` (
    `StreetName` VARCHAR(60),
    `ZipCode` VARCHAR(20),
    `HouseNumber` VARCHAR(20),
    `Country` VARCHAR(20)
);


CREATE TABLE `Order` (
    `StartDatumReservering` DATE,
    `EindDatumReservering` DATE,
    `Aantal` INT,

    CONSTRAINT `OrderPK`
    PRIMARY KEY (`StartDatumReservering`, `EindDatumReservering`, `Aantal`, `ArticleID`, `EmailAdres`) REFERENCES `Article` (`ArticleID`), `UserAccount` (`EmailAdres`);
)