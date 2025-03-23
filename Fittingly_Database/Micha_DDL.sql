CREATE DATABASE IF NOT EXISTS `Fittingly_Database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; 

USE `Fittingly_Database`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `Address`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `OrderLine`;
DROP TABLE IF EXISTS `Article`;
DROP TABLE IF EXISTS `Customer`;
DROP TABLE IF EXISTS `Partner`;
DROP TABLE IF EXISTS `Stock`;
DROP TABLE IF EXISTS `UserAccount`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `Address` (
    `PostalCode` VARCHAR(10) NOT NULL,
    `HouseNumber` VARCHAR(10) NOT NULL,
    `StreetName` VARCHAR(100) NOT NULL,
    `Country` ENUM('NL', 'BE', 'LU') NOT NULL, -- #ISO3166 2-letter country code
    CONSTRAINT PK_Address PRIMARY KEY (`PostalCode`, `HouseNumber`) -- Eerst Postalcode dan HouseNumber, omdat postcode uniek is en daardoor sneller te vinden
);

CREATE TABLE `Customer` (
    `CustomerID` INT NOT NULL AUTO_INCREMENT,
    `FirstName` VARCHAR(50) NOT NULL,
    `LastName` VARCHAR(50) NOT NULL,
    `PhoneNumber` VARCHAR(30),
    `DateOfBirth` DATE,
    `Newsletter` BOOLEAN NOT NULL DEFAULT FALSE,
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),
    CONSTRAINT PK_Customer PRIMARY KEY (`CustomerID`),
    CONSTRAINT FK_Customer_Address FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address`(`PostalCode`, `HouseNumber`) -- Eerst Postalcode dan HouseNumber, omdat postcode uniek is en daardoor sneller te vinden
);

CREATE TABLE `Order` (
    `OrderID` INT NOT NULL AUTO_INCREMENT,
    `OrderDate` DATE NOT NULL,
    `PaymentStatus` ENUM('Pending', 'Paid', 'Failed', 'Refunded') NOT NULL DEFAULT 'Pending',
    `CustomerID` INT NOT NULL,
    `PostalCode` VARCHAR(10) NOT NULL, 
    `HouseNumber` VARCHAR(10) NOT NULL, 
    CONSTRAINT PK_Order PRIMARY KEY (`OrderID`),
    CONSTRAINT FK_Order_Customer FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`),
    CONSTRAINT FK_Order_Address FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address`(`PostalCode`, `HouseNumber`)
);


CREATE TABLE `Article` (
    `ArticleID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `Size` ENUM('One Size', 'S', 'M', 'L', 'XL', 'XXL'),
    `Weight` INT, -- Soort gewicht?
    `Color` VARCHAR(30), -- Kleur of kleurcode?
    `Description` TEXT,
    `Image` TEXT NOT NULL, -- URL to image
    `Category` VARCHAR(255), -- Enum? of tabel?
    `SubCategory` VARCHAR(255), -- Enum? of tabel?
    `Material` VARCHAR(50), -- Enum? of tabel?
    `Brand` VARCHAR(100), -- Enum? of tabel?
    `Availability` BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT PK_Article PRIMARY KEY (`ArticleID`)
);

CREATE TABLE `Partner`(
    `PartnerID` INT NOT NULL AUTO_INCREMENT,
    `CompanyName` VARCHAR(100) NOT NULL,
    `VatNr` VARCHAR(20) NOT NULL,
    `CoCNr` VARCHAR(20) NOT NULL,
    `PostalCode` VARCHAR(10) NOT NULL,
    `HouseNumber` VARCHAR(10) NOT NULL,
    CONSTRAINT PK_Partner PRIMARY KEY (`PartnerID`),
    CONSTRAINT FK_Partner_Address FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address`(`PostalCode`, `HouseNumber`)
    CONSTRAINT UQ_Partner_VatNr UNIQUE (`VatNr`),
    CONSTRAINT UQ_Partner_CoCNr UNIQUE (`CoCNr`),
);

CREATE TABLE `OrderLine` (
    `OrderID` INT NOT NULL,
    `ArticleID` INT NOT NULL,
    `PartnerID` INT NOT NULL,
    `Quantity` INT NOT NULL,
    `StartDate` DATE NOT NULL,
    `EndDate` DATE NOT NULL,
    CONSTRAINT PK_OrderLine PRIMARY KEY (`OrderID`, `ArticleID`, `PartnerID`),
    CONSTRAINT FK_OrderLine_Order FOREIGN KEY (`OrderID`) REFERENCES `Order`(`OrderID`),
    CONSTRAINT FK_OrderLine_Article FOREIGN KEY (`ArticleID`) REFERENCES `Article`(`ArticleID`),
    CONSTRAINT FK_OrderLine_Partner FOREIGN KEY (`PartnerID`) REFERENCES `Partner`(`PartnerID`)
);

CREATE TABLE `Stock`(
    `ArticleID` INT NOT NULL,
    `PartnerID` INT NOT NULL,
    `StockQuantity` INT NOT NULL,
    `Price` DECIMAL(10,2) NOT NULL, -- Prijs per stuk
    `DateAdded` DATE NOT NULL,
    CONSTRAINT PK_Stock PRIMARY KEY (`PartnerID`, `ArticleID`), -- Eerst partner dan artikel, omdat er minder partners zijn dan artikelen
    CONSTRAINT FK_Stock_Partner FOREIGN KEY (`PartnerID`) REFERENCES `Partner`(`PartnerID`),
    CONSTRAINT FK_Stock_Article FOREIGN KEY (`ArticleID`) REFERENCES `Article`(`ArticleID`)
);

CREATE TABLE `UserAccount`(
    `UserID` CHAR(36) NOT NULL DEFAULT (UUID()),
    `Emailaddress` VARCHAR(100) NOT NULL,
    `Password` VARCHAR(100) NOT NULL,
    `AccountStatus` BOOLEAN NOT NULL DEFAULT FALSE, -- 0 = inactive, 1 = active of true/false?
    `AccountAccessRights` ENUM('Admin', 'Customer', 'Partner') NOT NULL,
    `DateOfRegistration` DATE NOT NULL,
    `PartnerID` INT,
    `CustomerID` INT,
    CONSTRAINT PK_UserAccount PRIMARY KEY (`UserID`),
    CONSTRAINT FK_UserAccount_Partner FOREIGN KEY (`PartnerID`) REFERENCES `Partner`(`PartnerID`),
    CONSTRAINT FK_UserAccount_Customer FOREIGN KEY (`CustomerID`) REFERENCES `Customer`(`CustomerID`),
    CONSTRAINT UQ_UserAccount_Email UNIQUE (`Emailaddress`)
);