<<<<<<< HEAD
INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `Country`) VALUES
('1011AB', '12', 'Damstraat', 'Nederland'),
('2011BB', '34', 'Keizersgracht', 'Nederland'),
('3011CD', '56', 'Burgwal', 'Nederland'),
('4011DE', '78', 'Westerstraat', 'Nederland'),
('5011EF', '90', 'Langezijds', 'Nederland'),
('6011FG', '21', 'Valkenpad', 'Nederland'),
('7011GH', '11', 'Houtplein', 'Nederland'),
('8011HI', '13', 'Zandstraat', 'Nederland'),
('9011IJ', '45', 'Torenlaan', 'Nederland'),
('1001KL', '67', 'Stadhoudersweg', 'Nederland');


INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`, `PhoneNumber`) VALUES
('Fashion House', 'NL123456789B01', 123456789, '1011AB', '12', '0201234567'),
('Luxury Wear', 'NL987654321B01', 987654321, '2011BB', '34', '0207654321'),
('Style Factory', 'NL543216789B01', 543216789, '3011CD', '56', '0309876543'),
('Elegance Clothing', 'NL135792468B01', 135792468, '4011DE', '78', '0403456789'),
('Chic Attire', 'NL246813579B01', 246813579, '5011EF', '90', '0501237890'),
('Urban Fashion', 'NL369258147B01', 369258147, '6011FG', '21', '0602345678'),
('Trendy Wardrobe', 'NL258369147B01', 258369147, '7011GH', '11', '0703456789'),
('Street Style', 'NL741852963B01', 741852963, '8011HI', '13', '0802345678'),
('Classy Trends', 'NL963741258B01', 963741258, '9011IJ', '45', '0903456789'),
('Modern Couture', 'NL852963741B01', 852963741, '1001KL', '67', '0101234567');


INSERT INTO `Customers` (`FirstName`, `LastName`, `PhoneNumber`, `DateOfBirth`, `Newsletter`, `PostalCode`, `HouseNumber`) VALUES
('Jan', 'Jansen', '0612345678', '1985-04-10', TRUE, '1011AB', '12'),
('Piet', 'Pietersen', '0623456789', '1990-08-15', FALSE, '2011BB', '34'),
('Sanne', 'Smit', '0634567890', '1982-11-20', TRUE, '3011CD', '56'),
('Kees', 'Keesen', '0645678901', '1995-02-28', FALSE, '4011DE', '78'),
('Emma', 'Evers', '0656789012', '1988-06-12', TRUE, '5011EF', '90'),
('Tom', 'Timmerman', '0667890123', '1981-03-05', TRUE, '6011FG', '21'),
('Anna', 'Ankersmit', '0678901234', '1993-07-25', FALSE, '7011GH', '11'),
('Joris', 'Janssen', '0689012345', '1992-05-30', TRUE, '8011HI', '13'),
('Lotte', 'Laan', '0690123456', '1986-09-10', FALSE, '9011IJ', '45'),
('Mark', 'Mans', '0610234567', '1984-12-22', TRUE, '1001KL', '67');


INSERT INTO `UserAccounts` (`EmailAdres`, `Passwords`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PartnerID`, `CustomerID`) VALUES
('jan.jansen@example.com', 'password123', TRUE, 'Customer', '2025-03-01', NULL, 1),
('piet.pietersen@example.com', 'password456', FALSE, 'Partner', '2025-03-02', 1, NULL),
('sanne.smit@example.com', 'password789', TRUE, 'Admin', '2025-03-03', NULL, NULL),
('kees.keesen@example.com', 'keespassword', TRUE, 'Customer', '2025-03-04', NULL, 4),
('emma.evers@example.com', 'emmapassword', FALSE, 'Partner', '2025-03-05', 2, NULL),
('tom.timmerman@example.com', 'timpassword', TRUE, 'Customer', '2025-03-06', NULL, 6),
('anna.ankersmit@example.com', 'annapassword', TRUE, 'Admin', '2025-03-07', NULL, NULL),
('joris.janssen@example.com', 'jorispassword', TRUE, 'Customer', '2025-03-08', NULL, 8),
('lotte.laan@example.com', 'lottepassword', FALSE, 'Partner', '2025-03-09', 3, NULL),
('mark.mans@example.com', 'markpassword', TRUE, 'Admin', '2025-03-10', NULL, NULL);



INSERT INTO `Articles` (`Name`, `Size`, `Weight`, `WeightUnit`, `Color`, `Description`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`) VALUES
('Blue Dress', 'M', 250, 'Gram', 'Blauw', 'Elegant blue dress for parties', 'Vrouwenkleding', 'Jurken', 'Zijde', 'Chic Attire', TRUE),
('White T-Shirt', 'L', 200, 'Gram', 'Wit', 'Comfortable white cotton T-shirt', 'Mannenkleding', 'T-Shirts', 'Katoen', 'Fashion House', TRUE),
('Leather Jacket', 'M', 1000, 'Gram', 'Zwart', 'Stylish leather jacket for winter', 'Vrouwenkleding', 'Jassen', 'Linnen', 'Modern Couture', TRUE),
('Red Shoes', '40', 500, 'Gram', 'Rood', 'Stylish red shoes for events', 'Vrouwenkleding', 'Schoenen', 'Spandex', 'Urban Fashion', FALSE),
('Grey Suit', 'XL', 1500, 'Gram', 'Grijs', 'Elegant grey suit', 'Mannenkleding', 'Broeken', 'Acryl', 'Luxury Wear', TRUE),
('Black Trousers', 'S', 400, 'Gram', 'Zwart', 'Slim-fit black trousers', 'Mannenkleding', 'Broeken', 'Spandex', 'Style Factory', TRUE),
('Pink Handbag', 'One Size', 300, 'Gram', 'Roze', 'Fashionable pink handbag', 'Accessoires', 'Schoenen', 'Zijde', 'Elegance Clothing', TRUE),
('White Sneakers', '42', 600, 'Gram', 'Wit', 'Casual white sneakers', 'Mannenkleding', 'Schoenen', 'Katoen', 'Trendy Wardrobe', TRUE),
('Blue Blouse', 'L', 150, 'Gram', 'Blauw', 'Elegant blue blouse for office wear', 'Vrouwenkleding', 'Jurken', 'Jute', 'Street Style', TRUE),
('Black Belt', 'One Size', 100, 'Gram', 'Zwart', 'Classic black leather belt', 'Accessoires', 'Schoenen', 'Linnen', 'Classy Trends', TRUE);


INSERT INTO `Stock` (`ArticleID`, `PartnerID`, `QuantityOfStock`, `Price`, `DateAdded`) VALUES
(1, 1, 15, 99.99, '2025-03-01'),
(2, 2, 20, 19.99, '2025-03-02'),
(3, 3, 10, 150.00, '2025-03-03'),
(4, 4, 5, 129.99, '2025-03-04'),
(5, 5, 12, 200.00, '2025-03-05'),
(6, 6, 30, 49.99, '2025-03-06'),
(7, 7, 25, 59.99, '2025-03-07'),
(8, 8, 40, 69.99, '2025-03-08'),
(9, 9, 35, 89.99, '2025-03-09'),
(10, 10, 50, 39.99, '2025-03-10');


INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `CustomerID`, `PostalCode`, `HouseNumber`) VALUES
('2025-03-01', TRUE, 1, '1011AB', '12'),
('2025-03-02', FALSE, 2, '2011BB', '34'),
('2025-03-03', TRUE, 3, '3011CD', '56'),
('2025-03-04', TRUE, 4, '4011DE', '78'),
('2025-03-05', FALSE, 5, '5011EF', '90'),
('2025-03-06', TRUE, 6, '6011FG', '21'),
('2025-03-07', TRUE, 7, '7011GH', '11'),
('2025-03-08', FALSE, 8, '8011HI', '13'),
('2025-03-09', TRUE, 9, '9011IJ', '45'),
('2025-03-10', TRUE, 10, '1001KL', '67');


INSERT INTO `OrderLines` (`OrderID`, `ArticleID`, `PartnerID`, `Quantity`, `StartDateReservation`, `EndDateReservation`) VALUES
(1, 1, 1, 2, '2025-03-01', '2025-03-10'),
(2, 2, 2, 3, '2025-03-02', '2025-03-12'),
(3, 3, 3, 1, '2025-03-03', '2025-03-13'),
(4, 4, 4, 1, '2025-03-04', '2025-03-14'),
(5, 5, 5, 2, '2025-03-05', '2025-03-15'),
(6, 6, 6, 1, '2025-03-06', '2025-03-16'),
(7, 7, 7, 2, '2025-03-07', '2025-03-17'),
(8, 8, 8, 1, '2025-03-08', '2025-03-18'),
(9, 9, 9, 2, '2025-03-09', '2025-03-19'),
(10, 10, 10, 1, '2025-03-10', '2025-03-20');
=======
INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `Country`)
VALUES
    ('1234AB', '10', 'Main Street', 'Nederland'),
    ('5678CD', '25', 'Pine Avenue', 'Nederland'),
    ('2345EF', '12', 'Elm Road', 'Nederland'),
    ('6789GH', '30', 'Oak Lane', 'Nederland'),
    ('3456IJ', '7', 'Maple Boulevard', 'Nederland');

INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`, `PhoneNumber`)
VALUES
    ('Fashion Hub', 'NL123456789B01', 12345, '1234AB', '10', '0612345678'),
    ('StyleWorks', 'NL987654321B02', 54321, '5678CD', '25', '0698765432'),
    ('Trendsetter', 'NL135792468B03', 11223, '2345EF', '12', '0611122334'),
    ('Luxury Apparel', 'NL246813579B04', 33221, '6789GH', '30', '0687654321'),
    ('Chic Couture', 'NL369258147B05', 44556, '3456IJ', '7', '0654321098');

INSERT INTO `Customers` (`FirstName`, `LastName`, `PhoneNumber`, `DateOfBirth`, `Newsletter`, `PostalCode`, `HouseNumber`)
VALUES
    ('John', 'Doe', '0612345678', '1990-05-12', TRUE, '1234AB', '10'),
    ('Jane', 'Smith', '0698765432', '1985-08-24', FALSE, '5678CD', '25'),
    ('Bob', 'Johnson', '0611122334', '2000-02-01', TRUE, '2345EF', '12'),
    ('Alice', 'Brown', '0687654321', '1995-11-30', TRUE, '6789GH', '30'),
    ('Charlie', 'Davis', '0654321098', '1992-03-15', FALSE, '3456IJ', '7');

INSERT INTO `UserAccounts` (`EmailAdres`, `Passwords`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PartnerID`, `CustomerID`)
VALUES
    ('john.doe@example.com', 'password123', 'Active', 'Customer', '2025-01-01', NULL, 1),
    ('jane.smith@example.com', 'mypassword456', 'Active', 'Partner', '2025-01-02', 1, NULL),
    ('bob.johnson@example.com', 'securepassword789', 'Suspended', 'Admin', '2025-01-03', NULL, 3),
    ('alice.brown@example.com', 'supersecure321', 'Active', 'Support', '2025-01-04', NULL, 4),
    ('charlie.davis@example.com', 'password789', 'Non-active', 'Customer', '2025-01-05', NULL, 5);

INSERT INTO `Articles` (`Name`, `Size`, `Weight`, `WeightUnit`, `Color`, `Description`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`)
VALUES
    ('Summer Dress', 'M', 200.5, 'Gram', 'Red', 'A beautiful red dress for summer events.', 'Vrouwenkleding', 'Jurken', 'Katoen', 'BrandA', TRUE),
    ('T-Shirt', 'L', 150.0, 'Gram', 'Blue', 'A classic blue t-shirt for everyday wear.', 'Mannenkleding', 'T-Shirts', 'Katoen', 'BrandB', TRUE),
    ('Leather Jacket', 'XL', 500.0, 'Gram', 'Black', 'A stylish black leather jacket.', 'Mannenkleding', 'Jassen', 'Katoen', 'BrandC', FALSE),
    ('Running Shoes', '42', 800.0, 'Gram', 'White', 'Comfortable white running shoes.', 'Accessoires', 'Schoenen', 'Spandex', 'BrandD', TRUE),
    ('Silk Scarf', 'One Size', 150.0, 'Gram', 'Pink', 'A luxurious pink silk scarf.', 'Accessoires', 'Schoenen', 'Zijde', 'BrandE', TRUE); 


INSERT INTO `Stock` (`ArticleID`, `PartnerID`, `QuantityOfStock`, `Price`, `DateAdded`)
VALUES
    (1, 1, 100, 29.99, '2025-01-01'),
    (2, 2, 200, 19.99, '2025-01-02'),
    (3, 3, 50, 99.99, '2025-01-03'),
    (4, 4, 150, 49.99, '2025-01-04'),
    (5, 5, 75, 59.99, '2025-01-05');

INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `CustomerID`, `PostalCode`, `HouseNumber`)
VALUES
    ('2025-01-01', TRUE, 1, '1234AB', '10'),
    ('2025-01-02', FALSE, 2, '5678CD', '25'),
    ('2025-01-03', TRUE, 3, '2345EF', '12'),
    ('2025-01-04', TRUE, 4, '6789GH', '30'),
    ('2025-01-05', FALSE, 5, '3456IJ', '7');

INSERT INTO `OrderLines` (`OrderID`, `ArticleID`, `PartnerID`, `Quantity`, `StartDateReservation`, `EndDateReservation`)
VALUES
    (1, 1, 1, 2, '2025-02-01', '2025-02-07'),
    (2, 2, 2, 1, '2025-02-01', '2025-02-10'),
    (3, 3, 3, 1, '2025-02-05', '2025-02-12'),
    (4, 4, 4, 3, '2025-02-01', '2025-02-15'),
    (5, 5, 5, 1, '2025-02-03', '2025-02-08');

>>>>>>> c15164f9438317e7b59deeda47e9e7e632af7091
