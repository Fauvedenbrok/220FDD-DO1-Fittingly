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

