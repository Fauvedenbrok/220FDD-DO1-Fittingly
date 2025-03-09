SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `OrderLine`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Stock`;
DROP TABLE IF EXISTS `UserAccount`;
DROP TABLE IF EXISTS `Article`;
DROP TABLE IF EXISTS `Customer`;
DROP TABLE IF EXISTS `Partner`;
DROP TABLE IF EXISTS `Address`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `Address` (
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),
    `StreetName` VARCHAR(60),
    `Country` VARCHAR(30) DEFAULT 'Nederland',

    CONSTRAINT
    PRIMARY KEY(`PostalCode`, `HouseNumber`)
);


CREATE TABLE `Partner` (
    `PartnerID` INT NOT NULL PRIMARY KEY, 
    `CompanyName` VARCHAR(255) NOT NULL,
    `VATNr` INT NOT NULL,
    `CoCNr` INT NOT NULL,
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),

    CONSTRAINT `FK_Partner_Address`
    FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address` (`PostalCode`, `HouseNumber`) ON DELETE CASCADE

);


CREATE TABLE `Customer` (
    `CustomerID` INT NOT NULL PRIMARY KEY,
    `FirstName` VARCHAR(50),
    `LastName` VARCHAR(50),
    `PhoneNumber` VARCHAR(12),
    `DateOfBirth` DATE,
    `Newsletter` BOOLEAN,
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),

    CONSTRAINT `FK__Customer_Address`
    FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address` (`PostalCode`, `HouseNumber`) ON DELETE CASCADE

);

CREATE TABLE `UserAccount` (
    `EmailAdres` VARCHAR(320) PRIMARY KEY,
    `Password` VARCHAR(255) NOT NULL,
    `AccountStatus` BOOLEAN DEFAULT 0,
    `AccountAccessRights` ENUM('Klant', 'Partner', 'Admin'),
    `DateOfRegistration` DATE,
    `PartnerID` INT,
    `CustomerID` INT,

    CONSTRAINT `FK_UserAccount`
    FOREIGN KEY (`PartnerID`) REFERENCES `Partner` (`PartnerID`) ON DELETE CASCADE,
    FOREIGN KEY (`CustomerID`) REFERENCES `Customer` (`CustomerID`) ON DELETE CASCADE
);

CREATE TABLE `Article` (
    `ArticleID` INT PRIMARY KEY,
    `Name` VARCHAR(50),
    `Size` VARCHAR(10),
    `Color` VARCHAR(20),
    `Description` TEXT,
    `Image` BLOB,
    `Category` ENUM ('Accessoires', 'Schoenen', 'Kleding'),
    `SubCategory` ENUM ('Jurken', 'T-Shirts', 'Broeken', 'Jassen'),
    `Material` ENUM ('Acryl', 'Zijde', 'Jute', 'Katoen', 'Linnen', 'Spandex'),
    `Brand` VARCHAR(50) NOT NULL,
    `Availability` BOOLEAN DEFAULT 0
);


CREATE TABLE `Stock` (
    `ArticleID` INT NOT NULL,
    `PartnerID` INT NOT NULL,
    `QuantityOfStock` INT DEFAULT 0,
    `Price` DECIMAL DEFAULT 0,
    `DateAdded` DATE NOT NULL,

    CONSTRAINT `PK_Stock`
    PRIMARY KEY (`ArticleID`, `PartnerID`)
);



CREATE TABLE `Order` (
    `OrderID` INT NOT NULL PRIMARY KEY,
    `OrderDate` DATE,
    `PaymentStatus` BOOLEAN DEFAULT 0,
    `CustomerID` INT NOT NULL,
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),

    CONSTRAINT `FK_Order`
    FOREIGN KEY (`CustomerID`) REFERENCES `Customer` (`CustomerID`) ON DELETE CASCADE,
    FOREIGN KEY (`PostalCode`, `HouseNumber`) REFERENCES `Address` (`PostalCode`, `HouseNumber`) ON DELETE CASCADE

);

CREATE TABLE `OrderLine` (
    `OrderID` INT NOT NULL,
    `ArticleID` INT NOT NULL,
    `PartnerID` INT NOT NULL,
    `Quantity` INT DEFAULT 0,
    `StartDateReservation` DATE,
    `EndDateReservation` DATE,

    CONSTRAINT `PK_OrderLine`
    PRIMARY KEY (`OrderID`, `PartnerID`, `ArticleID`)
);



INSERT INTO `Address` (`PostalCode`, `HouseNumber`, `StreetName`, `Country`) VALUES
('1234AB', '12', 'Main Street', 'Nederland'),
('5678CD', '34', 'Baker Road', 'Nederland'),
('9876EF', '56', 'Church Lane', 'Nederland'),
('1122GH', '78', 'Park Avenue', 'Nederland'),
('3344IJ', '23', 'Sunset Blvd', 'Nederland'),
('5566KL', '45', 'Oak Street', 'Nederland'),
('7788MN', '89', 'River Road', 'Nederland'),
('9900OP', '67', 'Mountain Drive', 'Nederland');

INSERT INTO `Partner` (`PartnerID`, `CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`) VALUES
(1, 'Fashion Co.', 123456789, 987654321, '1234AB', '12'),
(2, 'Sporty Apparel', 234567890, 876543210, '5678CD', '34'),
(3, 'Trendsetters', 345678901, 765432109, '9876EF', '56'),
(4, 'Eco Wear', 456789012, 654321098, '1122GH', '78'),
(5, 'Luxury Styles', 567890123, 543210987, '3344IJ', '23'),
(6, 'Comfort Shoes', 678901234, 432109876, '5566KL', '45'),
(7, 'Urban Clothing', 789012345, 321098765, '7788MN', '89'),
(8, 'Chic Collections', 890123456, 210987654, '9900OP', '67');

INSERT INTO `Customer` (`CustomerID`, `FirstName`, `LastName`, `PhoneNumber`, `DateOfBirth`, `Newsletter`, `PostalCode`, `HouseNumber`) VALUES
(1, 'John', 'Doe', '0612345678', '1990-06-15', TRUE, '1234AB', '12'),
(2, 'Jane', 'Smith', '0698765432', '1985-03-22', FALSE, '5678CD', '34'),
(3, 'Alice', 'Johnson', '0611223344', '1995-11-10', TRUE, '9876EF', '56'),
(4, 'Bob', 'Williams', '0698761234', '1992-02-28', TRUE, '1122GH', '78'),
(5, 'Charlie', 'Brown', '0613344556', '1988-07-10', FALSE, '3344IJ', '23'),
(6, 'David', 'Martinez', '0695432109', '1981-05-05', TRUE, '5566KL', '45'),
(7, 'Eva', 'Garcia', '0612233445', '1993-11-20', TRUE, '7788MN', '89'),
(8, 'Frank', 'Miller', '0696677889', '1990-09-09', FALSE, '9900OP', '67');

INSERT INTO `UserAccount` (`EmailAdres`, `Password`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PartnerID`, `CustomerID`) VALUES
('john.doe@example.com', 'hashedpassword1', TRUE, 'Klant', '2025-03-01', NULL, 1),
('jane.smith@example.com', 'hashedpassword2', TRUE, 'Partner', '2025-02-15', 2, NULL),
('alice.johnson@example.com', 'hashedpassword3', TRUE, 'Admin', '2025-01-20', NULL, 3),
('bob.williams@example.com', 'hashedpassword4', TRUE, 'Klant', '2025-03-05', NULL, 4),
('charlie.brown@example.com', 'hashedpassword5', TRUE, 'Partner', '2025-02-18', 4, NULL),
('david.martinez@example.com', 'hashedpassword6', TRUE, 'Admin', '2025-01-25', NULL, 5),
('eva.garcia@example.com', 'hashedpassword7', TRUE, 'Klant', '2025-03-10', NULL, 6),
('frank.miller@example.com', 'hashedpassword8', TRUE, 'Partner', '2025-02-22', 6, NULL);

INSERT INTO `Article` (`ArticleID`, `Name`, `Size`, `Color`, `Description`, `Image`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`) VALUES
(1, 'Elegant Dress', 'M', 'Red', 'A beautiful red dress perfect for parties', NULL, 'Kleding', 'Jurken', 'Zijde', 'Fashion Co.', TRUE),
(2, 'Running Shoes', 'L', 'Blue', 'Comfortable shoes for running', NULL, 'Schoenen', 'T-Shirts', 'Katoen', 'Sporty Apparel', TRUE),
(3, 'Leather Jacket', 'XL', 'Black', 'Stylish black leather jacket', NULL, 'Kleding', 'Jassen', 'Linnen', 'Trendsetters', FALSE),
(4, 'Sports Bra', 'S', 'Pink', 'Comfortable and breathable sports bra', NULL, 'Kleding', 'T-Shirts', 'Spandex', 'Eco Wear', TRUE),
(5, 'Silk Scarf', 'One Size', 'White', 'Luxurious silk scarf for every occasion', NULL, 'Accessoires', 'T-Shirts', 'Zijde', 'Luxury Styles', TRUE),
(6, 'Sneakers', 'M', 'Gray', 'Stylish and comfortable sneakers for everyday wear', NULL, 'Schoenen', 'T-Shirts', 'Katoen', 'Comfort Shoes', TRUE),
(7, 'Hoodie', 'L', 'Red', 'Soft hoodie for casual wear', NULL, 'Kleding', 'Jassen', 'Spandex', 'Urban Clothing', TRUE),
(8, 'Gold Necklace', 'One Size', 'Gold', 'Elegant gold necklace for special occasions', NULL, 'Accessoires', 'T-Shirts', 'Zijde', 'Chic Collections', TRUE);

INSERT INTO `Stock` (`ArticleID`, `PartnerID`, `QuantityOfStock`, `Price`, `DateAdded`) VALUES
(1, 1, 100, 49.99, '2025-03-01'),
(2, 2, 50, 79.99, '2025-02-15'),
(3, 3, 30, 199.99, '2025-01-20'),
(4, 4, 120, 29.99, '2025-03-05'),
(5, 5, 200, 89.99, '2025-02-18'),
(6, 6, 150, 59.99, '2025-01-25'),
(7, 7, 80, 49.99, '2025-03-10'),
(8, 8, 50, 149.99, '2025-02-22');

INSERT INTO `Order` (`OrderID`, `OrderDate`, `PaymentStatus`, `CustomerID`, `PostalCode`, `HouseNumber`) VALUES
(1, '2025-03-05', TRUE, 1, '1234AB', '12'),
(2, '2025-02-18', FALSE, 2, '5678CD', '34'),
(3, '2025-01-25', TRUE, 3, '9876EF', '56'),
(4, '2025-03-08', TRUE, 4, '1122GH', '78'),
(5, '2025-02-20', FALSE, 5, '3344IJ', '23'),
(6, '2025-01-15', TRUE, 6, '5566KL', '45'),
(7, '2025-03-12', FALSE, 7, '7788MN', '89'),
(8, '2025-02-28', TRUE, 8, '9900OP', '67');

INSERT INTO `OrderLine` (`OrderID`, `ArticleID`, `PartnerID`, `Quantity`, `StartDateReservation`, `EndDateReservation`) VALUES
(1, 1, 1, 1, '2025-03-05', '2025-03-12'),
(2, 2, 2, 2, '2025-02-18', '2025-02-25'),
(3, 3, 3, 1, '2025-01-25', '2025-02-01'),
(4, 4, 4, 1, '2025-03-08', '2025-03-15'),
(5, 5, 5, 3, '2025-02-20', '2025-02-27'),
(6, 6, 6, 2, '2025-01-15', '2025-01-22'),
(7, 7, 7, 1, '2025-03-12', '2025-03-19'),
(8, 8, 8, 1, '2025-02-28', '2025-03-07');
