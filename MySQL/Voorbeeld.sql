--Zorgt ervoor dat er geen foreign keys worden gechecked. Tijdens het verwijderen van tabellen is het namelijk zo dat als er een foreign key wordt gedetecteerd, deze niet verwijderd kan worden ALS er data in staat.
-- Door deze check uit te schakelen wordt alles mooi verwijderd. Goed voor testen HEEL GEVAARLIJK voor echte data.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `House`;
DROP TABLE IF EXISTS `Salesperson`;
DROP TABLE IF EXISTS `HousePerSalesperson`;

SET  FOREIGN_KEY_CHECKS = 1;


CREATE TABLE `House` (
`StreetNumber` varchar(255),
`PostalCode` varchar(10),
`City` varchar(50),
`ConstructionYear` int,
`Price` int,
`NumberofRooms` int,

CONSTRAINT `HousePK`
    PRIMARY KEY (`PostalCode`, `StreetNumber`)
);


DROP TABLE IF EXISTS `Salesperson`;

CREATE TABLE `Salesperson`(
    `SalespersonID` INT AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(60),
    `Salary` DECIMAL(10,2)
    );

DROP TABLE IF EXISTS `HousePerSalesperson`;

CREATE TABLE `HousePerSalesperson`(
    `PostalCode` varchar(10),
    `StreetNumber` varchar(10),
    `SalespersonID` int,

    CONSTRAINT `House_Salesperson`
    PRIMARY KEY (`SalespersonID`, `StreetNumber`, `PostalCode`),

    CONSTRAINT `HouseFK`
    FOREIGN KEY (`PostalCode`, `StreetNumber`) REFERENCES `House` (`PostalCode`, `StreetNumber`)
    ON UPDATE RESTRICT
    ON DELETE CASCADE,

    CONSTRAINT `SalespersonFK`
    FOREIGN KEY (`SalespersonID`) REFERENCES `Salesperson` (`SalespersonID`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

INSERT INTO `House` (`StreetNumber`, `PostalCode`, `City`, `ConstructionYear`, `Price`, `NumberofRooms`) VALUES
('10A', '1234AB', 'Breda', 1823, 123000, 4),
('10B', '1235AB', 'Breda', 1823, 140000, 6);



--Huizen tabel uit powerpoint

DROP TABLE IF EXISTS `Huizen`;

CREATE TABLE `Huizen` (
    `Straat` VARCHAR(64),
    `Huisnummer` VARCHAR(16),
    `Postcode` VARCHAR(8),
    `Plaats` VARCHAR(16),
    `Bouwjaar` INT,
    `Vraagprijs` DECIMAL(10,2),
    `AantalKamers` INT DEFAULT 4,

    CONSTRAINT `Huis`
    PRIMARY KEY (`Huisnummer`, `Postcode`)
);



-- Oefening 3.3 Powerpoints MYSQL

DROP TABLE IF EXISTS `Makelaren`;
DROP TABLE IF EXISTS `Verkopers`;

CREATE TABLE `Makelaren` (
    `BedrijfsNaam` VARCHAR(64),
    `Straat` VARCHAR(64),
    `Huisnummer` VARCHAR(16),
    `Postcode` VARCHAR(16),
    `NaamMakelaar` VARCHAR(64),

    CONSTRAINT `Makelaar`
        PRIMARY KEY (`Huisnummer`, `Postcode`)
);


CREATE TABLE `Verkopers` (
    `Naam` VARCHAR(64),
    `Telefoon` VARCHAR(16),
    `BSN` INT NOT NULL PRIMARY KEY,
    `Huisnummer` VARCHAR(16),
    `Postcode` VARCHAR(16),

    CONSTRAINT
    FOREIGN KEY (`Huisnummer`, `Postcode`) REFERENCES `Makelaren` (`Huisnummer`, `Postcode`)
);





-- SQL - GROUP BY Opdracht


DROP TABLE IF EXISTS `Orders`;

DROP TABLE IF EXISTS `Customers`; 

    CREATE TABLE `Orders`(
        `OrderID` INT AUTO_INCREMENT PRIMARY KEY,
        `OrderDate` DATE,
        `TotalAmount` DECIMAL,
        `CustomerID` INT NOT NULL,

        CONSTRAINT 
        FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`)

    );




    CREATE TABLE `Customers`(
        `CustomerID` INT AUTO_INCREMENT PRIMARY KEY,
        `CustomerName` VARCHAR(64),
        `Email` VARCHAR(64)

    );




DROP TABLE IF EXISTS `Orders`;
DROP TABLE IF EXISTS `Customers`; 

CREATE TABLE `Customers`(
    `CustomerID` INT AUTO_INCREMENT PRIMARY KEY,
    `CustomerName` VARCHAR(64),
    `Email` VARCHAR(64)
);

CREATE TABLE `Orders`(
    `OrderID` INT AUTO_INCREMENT PRIMARY KEY,
    `OrderDate` DATE,
    `TotalAmount` DECIMAL(10,2),
    `CustomerID` INT, 

    CONSTRAINT `fk_customer`
    FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO `Customers` (`CustomerName`, `Email`)
VALUES 
    ('Jan de Vries', 'Jan.devries@example.com'),
    ('Piet Jansen', 'Piet.Jansen@example.com'),
    ('Anneke Visser', 'Anneke.Visser@example.com');


INSERT INTO `Orders` (`OrderDate`, `TotalAmount`)
VALUES
    ('2024-02-10', 150.00),
    ('2024-10-01', 200),
    ('2013-11-12', 300),
    ('2024-03-15', 50),
    ('2024-04-20', 100),
    ('2024-05-25', 75);


