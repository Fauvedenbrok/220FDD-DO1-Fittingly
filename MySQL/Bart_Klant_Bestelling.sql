CREATE TABLE `UserAccount` (
    `EmailAddress` VARCHAR(255) PRIMARY KEY, --Een email adres kan 320 chars hebben dus misschien moeten we hier iets anders dan een VARCHAR van maken.
    `Password` VARCHAR(255) NOT NULL,
    `AccountStatus` BOOLEAN,
    `AccountAccessRights` ENUM ('admin', 'partner', 'customer'),
    `PartnerID` INT,
    `CustomerID` INT,
    CONSTRAINT FK_Partner_Account FOREIGN KEY (PartnerID) REFERENCES `Partner`(PartnerID),
    CONSTRAINT FK_Customer_Account FOREIGN KEY (CustomerID) REFERENCES `Customer`(CustomerID)
);

CREATE TABLE `Partner` (
    `PartnerID` INT PRIMARY KEY, 
    `CompanyName` VARCHAR(255) NOT NULL,
    `VATnr` VARCHAR(11) NOT NULL,
    `CoCnr` VARCHAR(25) NOT NULL,
    `HouseNumber` VARCHAR(10),
    `PostalCode` VARCHAR(10),
    CONSTRAINT FK_Partner_Address FOREIGN KEY (HouseNumber, PostalCode) REFERENCES `Address`(HouseNumber, PostalCode)
);

CREATE TABLE Customer (
    `CustomerID` INT PRIMARY KEY, 
    `FirstName` VARCHAR(255) NOT NULL,
    `LastName` VARCHAR(255) NOT NULL,
    `PhoneNumber` VARCHAR(30),
    `DateOfBirth` DATE,
    `Newsletter` BOOLEAN,
    `HouseNumber` VARCHAR(10),
    `PostalCode` VARCHAR(10),
    CONSTRAINT FK_Customer_Address FOREIGN KEY (HouseNumber, PostalCode) REFERENCES `Address`(HouseNumber, PostalCode)

);

CREATE TABLE Address (
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10), 
    `Country` VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Address PRIMARY KEY (HouseNumber, PostalCode)
);

CREATE TABLE Articles (
    `ArticleID` INT PRIMARY KEY,
    `Name` VARCHAR(100),
    `Description` TEXT,
    `Price` DECIMAL(10, 2),
    `Availability` BOOLEAN DEFAULT FALSE,
    `Size` VARCHAR(7),
    `Weight` INT, -- in gram?
    `Color` VARCHAR(30), -- langste engelse naam van een kleur heeft 24 tekens...
    `Image` TEXT NOT NULL, -- link to image
    `Category` VARCHAR(255),
    `SubCategory` VARCHAR(255),
    `Material` VARCHAR(50),
    `Brand` VARCHAR(100)
);


CREATE TABLE Order (
    `OrderID` INT PRIMARY KEY,
    `CustomerID` INT,
    `OrderDate` DATE NOT NULL,
    `PaymentStatus` BOOLEAN,
    `PostalCode` VARCHAR(10),
    `HouseNumber` VARCHAR(10),
    CONSTRAINT FK_Order_Customer FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    CONSTRAINT FK_Order_Address FOREIGN KEY (HouseNumber, PostalCode) REFERENCES `Address`(HouseNumber, PostalCode)
);

CREATE TABLE OrderLine (
    `OrderID` INT,
    `ArticleID` INT,
    `PartnerID` INT,
    `Quantity` INT NOT NULL,
    `StartDate` DATE NOT NULL,
    `EndDate` DATE NOT NULL,
    CONSTRAINT PK_OrderDetails PRIMARY KEY (OrderID, ArticleID, PartnerID),
    CONSTRAINT FK_OrderDetails_Order FOREIGN KEY (OrderID) REFERENCES `Orders`(OrderID),
    CONSTRAINT FK_OrderDetails_Article FOREIGN KEY (Article_ID) REFERENCES `Articles`(ArticleID),
    CONSTRAINT FK_OrderDetails_Partner FOREIGN KEY (PartnerID) REFERENCES `Partner`(PartnerID)
);

CREATE TABLE Stock (
    `ArticleID` INT,
    `PartnerID` INT,
    `QuantityOfStock` INT NOT NULL,
    `Price` DECIMAL(4,2),
    `DateAdded` DATE,
    CONSTRAINT PK_Stock PRIMARY KEY (ArticleID, PartnerID),
    CONSTRAINT FK_Stock_Articles FOREIGN KEY (ArticleID) REFERENCES `Articles`(ArticleID),
    CONSTRAINT FK_Stock_Users FOREIGN KEY (PartnerID) REFERENCES `Partner`(PartnerID)
);



--SAMPLE DATA:
INSERT INTO Partner (PartnerID, CompanyName, VATnr, CoCnr, HouseNumber, PostalCode)
VALUES
(1, 'Tech Rentals', 'NL123456789B01', '12345678', '10', '1234AB'),
(2, 'EventGear', 'NL987654321B02', '87654321', '22', '5678CD'),
(3, 'PartySupplies Inc.', 'NL192837465B03', '23456789', '8', '3456EF'),
(4, 'CampingWorld', 'NL019283746B04', '34567890', '12', '7890GH'),
(5, 'AV Masters', 'NL564738291B05', '45678901', '33', '4567JK'),
(6, 'Outdoor Adventures', 'NL837465192B06', '56789012', '17', '8912LM'),
(7, 'Stage Works', 'NL746291837B07', '67890123', '25', '2345NO'),
(8, 'Photography Plus', 'NL384756192B08', '78901234', '42', '5678PQ'),
(9, 'Lighting Experts', 'NL817364928B09', '89012345', '7', '8765RS'),
(10, 'RentalPros', 'NL928374615B10', '90123456', '19', '1234TU');

INSERT INTO Customer (CustomerID, FirstName, LastName, PhoneNumber, DateOfBirth, Newsletter, HouseNumber, PostalCode)
VALUES
(1, 'John', 'Doe', '0612345678', '1985-04-15', TRUE, '10', '1234AB'),
(2, 'Jane', 'Smith', '0687654321', '1990-09-05', FALSE, '22', '5678CD'),
(3, 'Sam', 'Taylor', '0611122233', '1988-07-21', TRUE, '8', '3456EF'),
(4, 'Emma', 'Brown', '0623344455', '1995-03-12', TRUE, '12', '7890GH'),
(5, 'Liam', 'Jones', '0634456677', '1979-11-30', FALSE, '33', '4567JK'),
(6, 'Sophia', 'Miller', '0645567788', '1982-06-06', TRUE, '17', '8912LM'),
(7, 'Noah', 'Garcia', '0656678899', '1993-02-14', FALSE, '25', '2345NO'),
(8, 'Olivia', 'Martinez', '0667788990', '2000-08-08', TRUE, '42', '5678PQ'),
(9, 'Mason', 'Rodriguez', '0678899001', '1987-01-25', FALSE, '7', '8765RS'),
(10, 'Ava', 'Wilson', '0689900123', '1992-12-31', TRUE, '19', '1234TU');

INSERT INTO UserAccount (EmailAddress, Password, AccountStatus, AccountAccessRights, PartnerID, CustomerID)
VALUES
('admin1@platform.nl', 'hashedpassword1', TRUE, 'admin', NULL, NULL),
('partner1@techrentals.com', 'hashedpassword2', TRUE, 'partner', 1, NULL),
('partner2@eventgear.com', 'hashedpassword3', TRUE, 'partner', 2, NULL),
('partner3@partysupplies.com', 'hashedpassword4', TRUE, 'partner', 3, NULL),
('customer1@doemail.com', 'hashedpassword5', TRUE, 'customer', NULL, 1),
('customer2@smithmail.com', 'hashedpassword6', TRUE, 'customer', NULL, 2),
('customer3@taylormail.com', 'hashedpassword7', TRUE, 'customer', NULL, 3),
('customer4@brownemail.com', 'hashedpassword8', TRUE, 'customer', NULL, 4),
('customer5@jonesmail.com', 'hashedpassword9', TRUE, 'customer', NULL, 5),
('customer6@millermail.com', 'hashedpassword10', TRUE, 'customer', NULL, 6);

INSERT INTO Address (PostalCode, HouseNumber, Country)
VALUES
('1234AB', '10', 'Netherlands'),
('5678CD', '22', 'Netherlands'),
('3456EF', '8', 'Netherlands'),
('7890GH', '12', 'Netherlands'),
('4567JK', '33', 'Netherlands'),
('8912LM', '17', 'Netherlands'),
('2345NO', '25', 'Netherlands'),
('5678PQ', '42', 'Netherlands'),
('8765RS', '7', 'Netherlands'),
('1234TU', '19', 'Netherlands');

INSERT INTO Articles (ArticleID, Name, Description, Availability, Size, Weight, Color, Image, Category, SubCategory, Material, Brand)
VALUES
(1, 'T-shirt', 'Basic cotton T-shirt', TRUE, 'M', 200, 'Blue', 'image1.jpg', 'Clothing', 'Topwear', 'Cotton', 'H&M'),
(2, 'Jeans', 'Slim fit denim jeans', TRUE, 'L', 800, 'Black', 'image2.jpg', 'Clothing', 'Bottomwear', 'Denim', "Levi\'s"),
(3, 'Jacket', 'Waterproof winter jacket', TRUE, 'L', 1200, 'Red', 'image3.jpg', 'Clothing', 'Outerwear', 'Polyester', 'North Face'),
(4, 'Dress', 'Floral summer dress', TRUE, 'M', 600, 'Yellow', 'image4.jpg', 'Clothing', 'One-piece', 'Cotton', 'Zara'),
(5, 'Sneakers', 'Comfortable walking shoes', TRUE, 'M', 1000, 'White', 'image5.jpg', 'Footwear', 'Shoes', 'Rubber', 'Nike'),
(6, 'Cap', 'Stylish baseball cap', TRUE, 'S', 300, 'Green', 'image6.jpg', 'Accessories', 'Headwear', 'Canvas', 'Adidas'),
(7, 'Socks', 'Pack of 5 cotton socks', TRUE, 'S', 150, 'Grey', 'image7.jpg', 'Accessories', 'Footwear', 'Cotton', 'Puma'),
(8, 'Scarf', 'Woolen winter scarf', TRUE, 'L', 400, 'Purple', 'image8.jpg', 'Accessories', 'Neckwear', 'Wool', 'Gucci'),
(9, 'Shorts', 'Casual cotton shorts', TRUE, 'M', 500, 'Brown', 'image9.jpg', 'Clothing', 'Bottomwear', 'Cotton', 'Uniqlo'),
(10, 'Sweater', 'Cozy knit sweater', TRUE, 'L', 900, 'Beige', 'image10.jpg', 'Clothing', 'Topwear', 'Wool', 'Benetton');


INSERT INTO `Order` (OrderID, CustomerID, OrderDate, PaymentStatus, PostalCode, HouseNumber)
VALUES
(1, 1, '2025-03-01', TRUE, '1234AB', '10'),
(2, 2, '2025-03-02', FALSE, '5678CD', '22'),
(3, 3, '2025-03-03', TRUE, '3456EF', '8'),
(4, 4, '2025-03-04', TRUE, '7890GH', '12'),
(5, 5, '2025-03-05', FALSE, '4567JK', '33'),
(6, 6, '2025-03-06', TRUE, '8912LM', '17'),
(7, 7, '2025-03-07', TRUE, '2345NO', '25'),
(8, 8, '2025-03-08', FALSE, '5678PQ', '42'),
(9, 9, '2025-03-09', TRUE, '8765RS', '7'),
(10, 10, '2025-03-10', TRUE, '1234TU', '19');

INSERT INTO OrderLine (OrderID, ArticleID, PartnerID, Quantity, StartDate, EndDate)
VALUES
(1, 1, 1, 2, '2025-03-05', '2025-03-10'),
(1, 2, 1, 1, '2025-03-05', '2025-03-10'),
(2, 3, 2, 1, '2025-03-08', '2025-03-15'),
(3, 4, 3, 3, '2025-03-09', '2025-03-12'),
(4, 5, 4, 2, '2025-03-14', '2025-03-18'),
(5, 6, 5, 4, '2025-03-20', '2025-03-25'),
(6, 7, 6, 1, '2025-03-22', '2025-03-28'),
(7, 8, 7, 2, '2025-03-24', '2025-03-30'),
(8, 9, 8, 1, '2025-03-26', '2025-04-01'),
(9, 10, 9, 3, '2025-03-28', '2025-04-04');

INSERT INTO Stock (ArticleID, PartnerID, QuantityOfStock, Price, DateAdded)
VALUES
(1, 1, 100, 10.00, '2025-03-01'),
(2, 1, 50, 30.00, '2025-03-02'),
(3, 2, 30, 70.00, '2025-03-03'),
(4, 2, 40, 25.00, '2025-03-04'),
(5, 3, 20, 50.00, '2025-03-05'),
(6, 3, 80, 15.00, '2025-03-06'),
(7, 4, 150, 5.00, '2025-03-07'),
(8, 4, 60, 20.00, '2025-03-08'),
(9, 5, 70, 12.00, '2025-03-09'),
(10, 5, 35, 40.00, '2025-03-10');

