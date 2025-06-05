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

DROP TABLE IF EXISTS `SearchLog`;

SET
    FOREIGN_KEY_CHECKS = 1;

CREATE TABLE
    `Addresses` (
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        `StreetName` VARCHAR(60),
        `City` VARCHAR(100),
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
        CONSTRAINT `FK_Partner_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Addresses` (`PostalCode`, `HouseNumber`) ON UPDATE CASCADE, -- Als een adres van een partner verandert, dan moet dat ook in de addresses tabel veranderen.
        CONSTRAINT `UQ_VATnr` UNIQUE (`VATNr`),
        CONSTRAINT `UQCoCNr` UNIQUE (`CoCNr`)
    );

CREATE TABLE
    `Customers` (
        `CustomerID` VARCHAR(36) NOT NULL PRIMARY KEY,
        `FirstName` VARCHAR(50),
        `LastName` VARCHAR(50),
        `DateOfBirth` VARCHAR(100),
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        CONSTRAINT `FK_Customer_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Addresses` (`PostalCode`, `HouseNumber`) ON UPDATE CASCADE -- Als een adres van een customer verandert, dan moet dat ook in de addresses tabel veranderen.
    );

CREATE TABLE
    `UserAccounts` (
        `EmailAddress` VARCHAR(320) PRIMARY KEY,
        `UserPassword` VARCHAR(255) NOT NULL,
        `AccountStatus` ENUM ('Non-active', 'Active', 'Suspended'),
        `AccountAccessRights` ENUM ('Customer', 'Partner', 'Admin', 'Support'),
        `DateOfRegistration` DATE,
        `PhoneNumber` VARCHAR(15),
        `Newsletter` BOOLEAN DEFAULT TRUE,
        `PartnerID` INT,
        `CustomerID` VARCHAR(36),
        CONSTRAINT `FK_UserAccount_Partner` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`),
        CONSTRAINT `FK_UserAccount_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`) ON DELETE CASCADE -- Als een customer (uiteindelijk) gedelete wordt, dan wordt ook de useraccount gedelete.
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
        `QuantityOfStock` INT DEFAULT 0,
        `Price` DECIMAL(10, 2) DEFAULT 0,
        `DateAdded` DATE NOT NULL,
        `InternalReference` VARCHAR(50) NOT NULL,
        `ArticleID` INT NOT NULL,
        `PartnerID` INT NOT NULL,
        CONSTRAINT `PK_Stock` PRIMARY KEY (`ArticleID`, `PartnerID`),
        CONSTRAINT `FK_Stock` FOREIGN KEY (`ArticleID`) REFERENCES `Articles` (`ArticleID`) ON DELETE CASCADE, -- Als een artikel gedelete wordt, dan wordt ook de stock van dat artikel gedelete.
        FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`)
    );

CREATE TABLE
    `Orders` (
        `OrderID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `OrderDate` DATE,
        `PaymentStatus` BOOLEAN DEFAULT FALSE,
        `PostalCode` VARCHAR(10),
        `HouseNumber` VARCHAR(10),
        `OrderStatus` ENUM ('Pending', 'Shipped', 'Delivered', 'Cancelled'),
        `CustomerID` VARCHAR(36) NOT NULL,
        CONSTRAINT `FK_Order_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`) ON DELETE CASCADE, -- Als een customer (uiteindelijk) gedelete wordt, dan worden ook de orders van die customer gedelete.
        CONSTRAINT `FK_Order_addresses` FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Addresses` (`PostalCode`, `HouseNumber`)
    );

CREATE TABLE
    `OrderLines` (
        `Quantity` INT DEFAULT 0,
        `StartDateReservation` DATE,
        `EndDateReservation` DATE,
        `OrderLinePrice` DECIMAL(10, 2) DEFAULT 0,
        `OrderID` INT NOT NULL,
        `ArticleID` INT NOT NULL,
        `PartnerID` INT NOT NULL,
        CONSTRAINT `PK_OrderLine` PRIMARY KEY (`OrderID`, `PartnerID`, `ArticleID`),
        CONSTRAINT `FK_OrderLine_Order` FOREIGN KEY (`OrderID`) REFERENCES `Orders` (`OrderID`) ON DELETE CASCADE, -- Als een order gedelete wordt, dan worden ook de orderlines van die order gedelete.
        CONSTRAINT `FK_OrderLine_Partner` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`),
        CONSTRAINT `FK_OrderLine_Article` FOREIGN KEY (`ArticleID`) REFERENCES `Articles` (`ArticleID`)
    );

CREATE TABLE
    `SearchLog` (
        `SearchWord` VARCHAR(50) PRIMARY KEY,
        `Count` INT DEFAULT 1
    );
