        -- Insert fake data for Addresses
        INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `City`, `Country`) VALUES
        ('1234AB', '10', 'Main Street', 'Amsterdam', 'Nederland'),
        ('5678CD', '20', 'Second Avenue', 'Rotterdam', 'Nederland'),
        ('9101EF', '30', 'Third Boulevard', 'Utrecht', 'Nederland'),
        ('1121GH', '40', 'Fourth Lane', 'Eindhoven', 'Nederland'),
        ('3141IJ', '50', 'Fifth Road', 'Groningen', 'Nederland');

        -- Insert fake data for Partners
        INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`) VALUES
        ('Partner A', 'NL123456789B01', 12345678, '1234AB', '10'),
        ('Partner B', 'NL987654321B02', 87654321, '5678CD', '20'),
        ('Partner C', 'NL112233445B03', 11223344, '9101EF', '30'),
        ('Partner D', 'NL556677889B04', 55667788, '1121GH', '40'),
        ('Partner E', 'NL998877665B05', 99887766, '3141IJ', '50');

        -- Insert fake data for Customers
        INSERT INTO `Customers` (`FirstName`, `LastName`, `DateOfBirth`, `PostalCode`, `HouseNumber`) VALUES
        ('John', 'Doe', '1990-01-01', '1234AB', '10'),
        ('Jane', 'Smith', '1985-05-15', '5678CD', '20'),
        ('Alice', 'Johnson', '1992-07-20', '9101EF', '30'),
        ('Bob', 'Brown', '1988-03-10', '1121GH', '40'),
        ('Eve', 'Davis', '1995-11-25', '3141IJ', '50');

        -- Insert fake data for UserAccounts
        INSERT INTO `UserAccounts` (`EmailAddress`, `UserPassword`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PhoneNumber`, `Newsletter`) VALUES
        ('john.doe@example.com', 'password123', 'Active', 'Customer', '2023-01-01', '0612345678', TRUE),
        ('jane.smith@example.com', 'password456', 'Active', 'Customer', '2023-02-01', '0612345679', FALSE),
        ('alice.johnson@example.com', 'password789', 'Suspended', 'Customer', '2023-03-01', '0612345680', TRUE),
        ('bob.brown@example.com', 'password321', 'Non-active', 'Customer', '2023-04-01', '0612345681', TRUE),
        ('eve.davis@example.com', 'password654', 'Active', 'Customer', '2023-05-01', '0612345682', FALSE);

        -- Insert fake data for Articles
        INSERT INTO `Articles` (`Name`, `Size`, `Weight`, `WeightUnit`, `Color`, `Description`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`) VALUES
        ('T-Shirt A', 'M', 0.5, 'Kilogram', 'Red', 'Comfortable cotton t-shirt', 'Mannenkleding', 'T-Shirts', 'Katoen', 'Brand A', TRUE),
        ('Dress B', 'L', 0.8, 'Kilogram', 'Blue', 'Elegant silk dress', 'Vrouwenkleding', 'Jurken', 'Zijde', 'Brand B', TRUE),
        ('Shoes C', '42', 1.2, 'Kilogram', 'Black', 'Durable leather shoes', 'Accessoires', 'Schoenen', 'Linnen', 'Brand C', FALSE),
        ('Jacket D', 'XL', 1.5, 'Kilogram', 'Green', 'Warm winter jacket', 'Mannenkleding', 'Jassen', 'Spandex', 'Brand D', TRUE),
        ('Pants E', 'S', 0.7, 'Kilogram', 'Gray', 'Stylish casual pants', 'Vrouwenkleding', 'Broeken', 'Acryl', 'Brand E', TRUE);

        -- Insert fake data for Stock
        INSERT INTO `Stock` (`QuantityOfStock`, `Price`, `DateAdded`, `InternalReference`, `ArticleID`, `PartnerID`) VALUES
        (100, 19.99, '2023-01-01', 'REF001', 1, 1),
        (50, 49.99, '2023-02-01', 'REF002', 2, 2),
        (200, 29.99, '2023-03-01', 'REF003', 3, 3),
        (150, 99.99, '2023-04-01', 'REF004', 4, 4),
        (75, 39.99, '2023-05-01', 'REF005', 5, 5);

        -- Insert fake data for Orders
        INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `PostalCode`, `HouseNumber`, `OrderStatus`, `CustomerID`) VALUES
        ('2023-01-10', TRUE, '1234AB', '10', 'Shipped', 1),
        ('2023-02-15', FALSE, '5678CD', '20', 'Pending', 2),
        ('2023-03-20', TRUE, '9101EF', '30', 'Delivered', 3),
        ('2023-04-25', FALSE, '1121GH', '40', 'Cancelled', 4),
        ('2023-05-30', TRUE, '3141IJ', '50', 'Shipped', 5);

        -- Insert fake data for OrderLines
        INSERT INTO `OrderLines` (`Quantity`, `StartDateReservation`, `EndDateReservation`, `OrderLinePrice`, `OrderID`, `ArticleID`, `PartnerID`) VALUES
        (2, '2023-01-10', '2023-01-15', 39.98, 1, 1, 1),
        (1, '2023-02-15', '2023-02-20', 49.99, 2, 2, 2),
        (3, '2023-03-20', '2023-03-25', 89.97, 3, 3, 3),
        (1, '2023-04-25', '2023-04-30', 99.99, 4, 4, 4),
        (4, '2023-05-30', '2023-06-05', 159.96, 5, 5, 5);
