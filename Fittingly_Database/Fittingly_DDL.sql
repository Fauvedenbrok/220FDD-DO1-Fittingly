SET
    FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `OrderLines`;
DROP TABLE IF EXISTS `Orders`;
DROP TABLE IF EXISTS `Stock`;
DROP TABLE IF EXISTS `UserAccounts`;
DROP TABLE IF EXISTS `Articles`;
DROP TABLE IF EXISTS `Customers`;
DROP TABLE IF EXISTS `Partners`;
DROP TABLE IF EXISTS `Addresses`;

SET
    FOREIGN_KEY_CHECKS = 1;

CREATE TABLE
    `Addresses` (
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        `StreetName` VARCHAR(60),
        `Country` VARCHAR(30) DEFAULT 'Nederland',
        CONSTRAINT `PK_addresses` PRIMARY KEY (`PostalCode`, `HouseNumber`)
    );

CREATE TABLE
    `Partners` (
        `PartnerID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `CompanyName` VARCHAR(255) NOT NULL,
        `VATNr` VARCHAR(15) NOT NULL,
        `CoCNr` INT NOT NULL,
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        `PhoneNumber` VARCHAR(15),
        CONSTRAINT `FK_Partner_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Addresses` (`PostalCode`, `HouseNumber`),
        CONSTRAINT `UQ_VATnr` UNIQUE (`VATNr`),
        CONSTRAINT `UQCoCNr` UNIQUE (`CoCNr`)
    );

CREATE TABLE
    `Customers` (
        `CustomerID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `FirstName` VARCHAR(50),
        `LastName` VARCHAR(50),
        `PhoneNumber` VARCHAR(15),
        `DateOfBirth` DATE,
        `Newsletter` BOOLEAN DEFAULT TRUE,
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        CONSTRAINT `FK_Customer_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Addresses` (`PostalCode`, `HouseNumber`)
    );

CREATE TABLE
    `UserAccounts` (
        `EmailAdres` VARCHAR(320) PRIMARY KEY,
        `Passwords` VARCHAR(255) NOT NULL,
        `AccountStatus` ENUM ('Non-active', 'Active', 'Suspended'), 
        `AccountAccessRights` ENUM ('Customer', 'Partner', 'Admin', 'Support'),
        `DateOfRegistration` DATE,
        `PartnerID` INT,
        `CustomerID` INT,
        CONSTRAINT `FK_UserAccount_Partner` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`),
        CONSTRAINT `FK_UserAccount_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`)
    );

CREATE TABLE
    `Articles` (
        `ArticleID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `Name` VARCHAR(50),
        `Size` VARCHAR(10),
        `Weight` FLOAT,
        `WeightUnit` ENUM ('Gram', 'Kilogram'),
        `Color` VARCHAR(20),
        `Description` TEXT,
        `Image` BLOB,
        `Category` ENUM ('Accessoires', 'Mannenkleding', 'Vrouwenkleding'),
        `SubCategory` ENUM (
            'Jurken',
            'T-Shirts',
            'Broeken',
            'Jassen',
            'Schoenen'
        ),
        `Material` ENUM (
            'Acryl',
            'Zijde',
            'Jute',
            'Katoen',
            'Linnen',
            'Spandex'
        ),
        `Brand` VARCHAR(50) NOT NULL,
        `Availability` BOOLEAN DEFAULT FALSE
    );

CREATE TABLE
    `Stock` (
        `ArticleID` INT NOT NULL,
        `PartnerID` INT NOT NULL,
        `QuantityOfStock` INT DEFAULT 0,
        `Price` DECIMAL(10, 2) DEFAULT 0,
        `DateAdded` DATE NOT NULL,
        CONSTRAINT `PK_Stock` PRIMARY KEY (`ArticleID`, `PartnerID`),
        CONSTRAINT `FK_Stock` FOREIGN KEY (`ArticleID`) REFERENCES `Articles` (`ArticleID`),
        FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`)
    );

CREATE TABLE
    `Orders` (
        `OrderID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `OrderDate` DATE,
        `PaymentStatus` BOOLEAN DEFAULT FALSE,
        `CustomerID` INT NOT NULL,
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        CONSTRAINT `FK_Order_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
        CONSTRAINT `FK_Order_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `addresses` (`PostalCode`, `HouseNumber`)
    );

CREATE TABLE
    `OrderLines` (
        `OrderID` INT NOT NULL,
        `ArticleID` INT NOT NULL,
        `PartnerID` INT NOT NULL,
        `Quantity` INT DEFAULT 0,
        `StartDateReservation` DATE,
        `EndDateReservation` DATE,
        CONSTRAINT `PK_OrderLine` PRIMARY KEY (`OrderID`, `PartnerID`, `ArticleID`),
        CONSTRAINT `FK_OrderLine_Order` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`OrderID`),
        CONSTRAINT `FK_OrderLine_Partner` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`),
        CONSTRAINT `FK_OrderLine_Article` FOREIGN KEY (`ArticleID`) REFERENCES `Articles` (`ArticleID`)
    );