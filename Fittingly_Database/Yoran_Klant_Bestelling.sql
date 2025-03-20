CREATE TABLE UserAccount (
    `EmailAddress` PRIMARY KEY VARCHAR (255) NOT NULL,
    `Password` VARCHAR (255) NOT NULL,
    `AccountStatus` BOOLEAN,
    `AccountAccessRights` BOOLEAN,
    `DateOfRegistration` INT
    );

CREATE TABLE Partner (
    `PartnerID` PRIMARY KEY INT NOT NULL,
    `CompanyName` VARCHAR (255) NOT NULL,
    `VATNr` INT NOT NULL,
    `CoCNr` INT NOT NULL
);

CREATE TABLE Customer (
    `CustomerID` PRIMARY KEY INT NOT NULL,
    `FirstName` VARCHAR (255) NOT NULL,
    `LastName` VARCHAR (255) NOT NULL,
    `PhoneNumber` INT,
    `DateOfBirth` INT,
    `Newsletter` BOOLEAN
);

CREATE TABLE Address (
    `PostalCode` PRIMARY KEY VARCHAR (8) NOT NULL,
    `HouseNumber` VARCHAR (6) NOT NULL,
    `StreetName` VARCHAR (255) NOT NULL,
    `Country` VARCHAR (255) NOT NULL
);

CREATE TABLE Article (
    `ArticleID` PRIMARY KEY INT NOT NULL,
    `Name` VARCHAR (255) NOT NULL,
    `Category` VARCHAR (255) NOT NULL,
    `SubCategory` VARCHAR (255),
    `Size` VARCHAR (5) NOT NULL,
    `Weight` DECIMAL (5,2),
    `Color` VARCHAR (255) NOT NULL,
    `Material` VARCHAR (255) NOT NULL,
    `Brand` VARCHAR (255) NOT NULL,
    `Description` VARCHAR (255) NOT NULL,
    `Image` BOOLEAN NOT NULL,
    `Availability` BOOLEAN NOT NULL
);

CREATE TABLE OrderLine (
    `PartnerID` PRIMARY KEY INT NOT NULL,
    `OrderID` PRIMARY KEY INT NOT NULL,
    `ArticleID` PRIMARY KEY INT NOT NULL,
    `Quantity` INT NOT NULL,
    `StartDateReservation` INT NOT NULL,
    `EndDateReservation` INT NOT NULL
);

CREATE TABLE Order (
    `OrderID` PRIMARY KEY INT NOT NULL,
    `CustomerID` INT NOT NULL,
    `PaymentStatus` BOOLEAN NOT NULL,
    `OrderDate` INT NOT NULL
);