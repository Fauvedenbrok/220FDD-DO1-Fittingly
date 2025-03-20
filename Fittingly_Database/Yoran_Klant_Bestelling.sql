CREATE TABLE UserAccount (
    `EmailAddress` PRIMARY KEY VARCHAR (255) NOT NULL,
    `Password` VARCHAR (255) NOT NULL,
    `AccountStatus` BOOLEAN,
    `AccountAccessRights` BOOLEAN, -- Wat gebeurd er nu met een nieuw account als hier geen default value wordt ingezet? leg uit.
    `DateOfRegistration` INT  -- kijk even naar 'DATE'
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
    `DateOfBirth` INT,    -- dit kan misschien beter DATE zijn voor minder aanpassingen op lang termijn.
    `Newsletter` BOOLEAN   -- wil je hier een default value aan koppelen? krijgen ze standaard een nieuwsbrief of moeten ze zich eerst hiervoor aanmelden.
);

CREATE TABLE Address (
    `PostalCode` PRIMARY KEY VARCHAR (8) NOT NULL,
    `HouseNumber` VARCHAR (6) NOT NULL,   -- wat was de primary key van address ookalweer? Houdt het relationeel schema erbij als hulpmiddel.
    `StreetName` VARCHAR (255) NOT NULL,
    `Country` VARCHAR (255) NOT NULL
);

CREATE TABLE Article (
    `ArticleID` PRIMARY KEY INT NOT NULL,
    `Name` VARCHAR (255) NOT NULL,
    `Category` VARCHAR (255) NOT NULL, -- Hoe denk je over een 'ENUM' in plaats van een VARCHAR?
    `SubCategory` VARCHAR (255), -- idem dito
    `Size` VARCHAR (5) NOT NULL,  -- idem dito
    `Weight` DECIMAL (5,2),
    `Color` VARCHAR (255) NOT NULL,  -- idem dito
    `Material` VARCHAR (255) NOT NULL, -- idem dito
    `Brand` VARCHAR (255) NOT NULL,
    `Description` VARCHAR (255) NOT NULL, -- Check het verschil tussen VARCHAR en TEXT!. De lengte van een bericht hangt er natuurlijk wel af wat we willen.
    `Image` BOOLEAN NOT NULL,  -- is een image een boolean? zoek op: BLOB
    `Availability` BOOLEAN NOT NULL -- aangezien dit een boolean is, wat is de default value? 
);

CREATE TABLE OrderLine (
    `PartnerID` PRIMARY KEY INT NOT NULL,
    `OrderID` PRIMARY KEY INT NOT NULL,
    `ArticleID` PRIMARY KEY INT NOT NULL, -- voor deze drie primary keys moet je even 'Constraints'  bekijken. Ik weet niet of phpMyAdmin dit zo accepteerd namelijk, aangezien je maar 1 primary key kunt hebben.
    `Quantity` INT NOT NULL,  --Hoeveel default quantity zou er minimaal zijn bij het aanmaken van een nieuw artikel?
    `StartDateReservation` INT NOT NULL, -- zelfde alse dateofbirth
    `EndDateReservation` INT NOT NULL -- idem dito
);

CREATE TABLE Order (
    `OrderID` PRIMARY KEY INT NOT NULL,
    `CustomerID` INT NOT NULL,
    `PaymentStatus` BOOLEAN NOT NULL,
    `OrderDate` INT NOT NULL   -- zelfde als dateofbirth
);