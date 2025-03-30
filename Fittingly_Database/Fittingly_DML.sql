    -- Insert data into Addresses
    INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `Country`) VALUES
    ('1234AB', '10', 'Main Street', 'Nederland'),
    ('5678CD', '20', 'Second Avenue', 'Nederland'),
    ('9101EF', '30', 'Third Boulevard', 'Nederland'),
    ('1121GH', '40', 'Fourth Lane', 'Nederland'),
    ('3141IJ', '50', 'Fifth Road', 'Nederland'),
    ('5161KL', '60', 'Sixth Street', 'Nederland');

    -- Insert data into Partners
    INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`) VALUES
    ('Partner A', 'NL123456789B01', 12345678, '1234AB', '10'),
    ('Partner B', 'NL987654321B02', 87654321, '5678CD', '20'),
    ('Partner C', 'NL112233445B03', 11223344, '9101EF', '30'),
    ('Partner D', 'NL556677889B04', 55667788, '1121GH', '40'),
    ('Partner E', 'NL998877665B05', 99887766, '3141IJ', '50'),
    ('Partner F', 'NL443322110B06', 44332211, '5161KL', '60');

    -- Insert data into Customers
    INSERT INTO `Customers` (`FirstName`, `LastName`, `DateOfBirth`, `PostalCode`, `HouseNumber`) VALUES
    ('John', 'Doe', '1990-01-01', '1234AB', '10'),
    ('Jane', 'Smith', '1985-05-15', '5678CD', '20'),
    ('Alice', 'Johnson', '1992-07-20', '9101EF', '30'),
    ('Bob', 'Brown', '1988-03-10', '1121GH', '40'),
    ('Charlie', 'Davis', '1995-09-25', '3141IJ', '50'),
    ('Diana', 'Miller', '1993-12-30', '5161KL', '60');

    -- Insert data into UserAccounts
    INSERT INTO `UserAccounts` (`EmailAdres`, `Passwords`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PhoneNumber`, `Newsletter`, `PartnerID`, `CustomerID`) VALUES
    ('john.doe@example.com', 'password123', 'Active', 'Customer', '2023-01-01', '0612345678', TRUE, NULL, 1),
    ('jane.smith@example.com', 'password456', 'Active', 'Customer', '2023-02-01', '0612345679', TRUE, NULL, 2),
    ('partner.a@example.com', 'partnerpass1', 'Active', 'Partner', '2023-03-01', '0612345680', FALSE, 1, NULL),
    ('partner.b@example.com', 'partnerpass2', 'Active', 'Partner', '2023-04-01', '0612345681', FALSE, 2, NULL),
    ('admin@example.com', 'adminpass', 'Active', 'Admin', '2023-05-01', '0612345682', FALSE, NULL, NULL),
    ('support@example.com', 'supportpass', 'Active', 'Support', '2023-06-01', '0612345683', TRUE, NULL, NULL);

    -- Insert data into Articles
    INSERT INTO `Articles` (`Name`, `Size`, `Weight`, `WeightUnit`, `Color`, `Description`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`) VALUES
    ('T-Shirt', 'M', 0.5, 'Kilogram', 'Red', 'Comfortable cotton t-shirt', 'Mannenkleding', 'T-Shirts', 'Katoen', 'Brand A', TRUE),
    ('Jeans', 'L', 1.2, 'Kilogram', 'Blue', 'Stylish denim jeans', 'Mannenkleding', 'Broeken', 'Linnen', 'Brand B', TRUE),
    ('Jacket', 'XL', 2.0, 'Kilogram', 'Black', 'Warm winter jacket', 'Mannenkleding', 'Jassen', 'Spandex', 'Brand C', FALSE),
    ('Dress', 'S', 0.8, 'Kilogram', 'Green', 'Elegant evening dress', 'Vrouwenkleding', 'Jurken', 'Zijde', 'Brand D', TRUE),
    ('Shoes', '42', 1.5, 'Kilogram', 'White', 'Comfortable running shoes', 'Accessoires', 'Schoenen', 'Acryl', 'Brand E', TRUE),
    ('Hat', 'One Size', 0.3, 'Kilogram', 'Brown', 'Stylish summer hat', 'Accessoires', 'Accessoires', 'Jute', 'Brand F', FALSE);

    -- Insert data into Stock
    INSERT INTO `Stock` (`QuantityOfStock`, `Price`, `DateAdded`, `ArticleID`, `PartnerID`) VALUES
    (100, 19.99, '2023-01-01', 1, 1),
    (50, 49.99, '2023-02-01', 2, 2),
    (30, 99.99, '2023-03-01', 3, 3),
    (20, 79.99, '2023-04-01', 4, 4),
    (10, 59.99, '2023-05-01', 5, 5),
    (5, 29.99, '2023-06-01', 6, 6);

    -- Insert data into Orders
    INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `PostalCode`, `HouseNumber`, `OrderStatus`, `CustomerID`) VALUES
    ('2023-01-10', TRUE, '1234AB', '10', 'Delivered', 1),
    ('2023-02-15', FALSE, '5678CD', '20', 'Pending', 2),
    ('2023-03-20', TRUE, '9101EF', '30', 'Shipped', 3),
    ('2023-04-25', TRUE, '1121GH', '40', 'Cancelled', 4),
    ('2023-05-30', FALSE, '3141IJ', '50', 'Pending', 5),
    ('2023-06-05', TRUE, '5161KL', '60', 'Delivered', 6);

    -- Insert data into OrderLines
    INSERT INTO `OrderLines` (`Quantity`, `StartDateReservation`, `EndDateReservation`, `OrderLinePrice`, `OrderID`, `ArticleID`, `PartnerID`) VALUES
    (2, '2023-01-01', '2023-01-05', 39.98, 1, 1, 1),
    (1, '2023-02-01', '2023-02-03', 49.99, 2, 2, 2),
    (3, '2023-03-01', '2023-03-07', 299.97, 3, 3, 3),
    (1, '2023-04-01', '2023-04-02', 79.99, 4, 4, 4),
    (2, '2023-05-01', '2023-05-10', 119.98, 5, 5, 5),
    (1, '2023-06-01', '2023-06-03', 29.99, 6, 6, 6);