        -- Insert fake data for Addresses
        INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `City`, `Country`) VALUES
        ('1111AA', '15', 'Luxe Laan', 'Amsterdam', 'Nederland'),
        ('2222BB', '27', 'Designerstraat', 'Rotterdam', 'Nederland'),
        ('3333CC', '39', 'Modehof', 'Utrecht', 'Nederland'),
        ('4444DD', '51', 'Fashion Boulevard', 'Eindhoven', 'Nederland'),
        ('5555EE', '63', 'Catwalkweg', 'Den Haag', 'Nederland'),
        ('4321XY', '12', 'Exclusieve Straat', 'Groningen', 'Nederland'),
        ('8765ZW', '24', 'Stijlplein', 'Maastricht', 'Nederland'),
        ('3456UV', '36', 'Trendy Steeg', 'Leeuwarden', 'Nederland'),
        ('7890TS', '48', 'Voguepad', 'Arnhem', 'Nederland'),
        ('9087QR', '60', 'Glamourgracht', 'Zwolle', 'Nederland');

        -- Insert fake data for Partners
        INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`) VALUES
        ('Prestige Wardrobe Rentals', 'NL101010101B06', 12345001, '4321XY', '12'),
        ('Elite Fashion Hire', 'NL202020202B07', 22345002, '8765ZW', '24'),
        ('HauteCouture Leasing', 'NL303030303B08', 32345003, '3456UV', '36'),
        ('LuxeWear On-Demand', 'NL404040404B09', 42345004, '7890TS', '48'),
        ('Runway Glam Rentals', 'NL505050505B10', 52345005, '9087QR', '60');

        -- Insert fake data for Customers
        INSERT INTO `Customers` (`CustomerID`, `FirstName`, `LastName`, `DateOfBirth`, `PostalCode`, `HouseNumber`) VALUES
    ('550e8400-e29b-41d4-a716-446655440000', 'Michael', 'Jones', '1987-08-12', '1111AA', '15'),
    ('6e8f1010-b0f1-4e21-bfcf-12af0d234567', 'Sophia', 'Miller', '1991-03-25', '2222BB', '27'),
    ('bd0c129a-19d0-4a3e-900c-84b5b82d7890', 'Daniel', 'Wilson', '1985-11-05', '3333CC', '39'),
    ('a3f57a2b-881e-477f-a0a7-d98ab1234567', 'Emily', 'Clark', '1998-06-18', '4444DD', '51'),
    ('f9b2754e-3db3-493d-976f-e1a4567890ab', 'David', 'Martinez', '1993-09-30', '5555EE', '63');
        
        -- Insert fake data for UserAccounts
        INSERT INTO `UserAccounts` (`EmailAddress`, `UserPassword`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PhoneNumber`, `Newsletter`, `partnerID`, `customerID`) VALUES
    ('michael.jones@example.com', 'pass987', 'Active', 'Customer', '2024-01-10', '0611111111', TRUE, NULL, '550e8400-e29b-41d4-a716-446655440000'),
    ('sophia.miller@example.com', 'pass654', 'Active', 'Customer', '2024-02-15', '0622222222', FALSE, NULL, '6e8f1010-b0f1-4e21-bfcf-12af0d234567'),
    ('daniel.wilson@example.com', 'pass321', 'Suspended', 'Customer', '2024-03-20', '0633333333', TRUE, NULL, 'bd0c129a-19d0-4a3e-900c-84b5b82d7890'),
    ('emily.clark@example.com', 'pass456', 'Active', 'Customer', '2024-04-25', '0644444444', FALSE, NULL, 'a3f57a2b-881e-477f-a0a7-d98ab1234567'),
    ('david.martinez@example.com', 'pass789', 'Non-active', 'Customer', '2024-05-30', '0655555555', TRUE, NULL, 'f9b2754e-3db3-493d-976f-e1a4567890ab'),
    ('prestige.contact@example.com', 'pass111', 'Active', 'Partner', '2024-06-10', '0666666666', TRUE, 1, NULL),
    ('elite.support@example.com', 'pass222', 'Suspended', 'Partner', '2024-07-15', '0677777777', TRUE, 2, NULL),
    ('hautecouture.team@example.com', 'pass333', 'Active', 'Partner', '2024-08-20', '0688888888', FALSE, 3, NULL),
    ('luxewear.sales@example.com', 'pass444', 'Non-active', 'Partner', '2024-09-25', '0699999999', TRUE, 4, NULL),
    ('runway.glam@example.com', 'pass555', 'Active', 'Partner', '2024-10-30', '0670000000', FALSE, 5, NULL);

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
        (50, 49.99, '2023-02-01', 'REF002', 2, 1),
        (200, 29.99, '2023-03-01', 'REF003', 3, 1),
        (150, 99.99, '2023-04-01', 'REF004', 4, 1),
        (75, 39.99, '2023-05-01', 'REF005', 5, 1);

        -- Insert fake data for Orders
        INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `PostalCode`, `HouseNumber`, `OrderStatus`, `CustomerID`) VALUES
    ('2023-01-10', TRUE, '1111AA', '15', 'Shipped', '550e8400-e29b-41d4-a716-446655440000'),
    ('2023-02-15', FALSE, '2222BB', '27', 'Pending', '6e8f1010-b0f1-4e21-bfcf-12af0d234567'),
    ('2023-03-20', TRUE, '3333CC', '39', 'Delivered', 'bd0c129a-19d0-4a3e-900c-84b5b82d7890'),
    ('2023-04-25', FALSE, '4444DD', '51', 'Cancelled', 'a3f57a2b-881e-477f-a0a7-d98ab1234567'),
    ('2023-05-30', TRUE, '5555EE', '63', 'Shipped', 'f9b2754e-3db3-493d-976f-e1a4567890ab');

        -- Insert fake data for OrderLines
        INSERT INTO `OrderLines` (`Quantity`, `StartDateReservation`, `EndDateReservation`, `OrderLinePrice`, `OrderID`, `ArticleID`, `PartnerID`) VALUES
        (2, '2023-01-10', '2023-01-15', 39.98, 1, 1, 1),
        (1, '2023-02-15', '2023-02-20', 49.99, 2, 2, 1),
        (3, '2023-03-20', '2023-03-25', 89.97, 3, 3, 1),
        (1, '2023-04-25', '2023-04-30', 99.99, 4, 4, 1),
        (4, '2023-05-30', '2023-06-05', 159.96, 5, 5, 1);


        -- Insert admin accounts
        INSERT INTO `useraccounts` (`EmailAddress`, `UserPassword`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`,`PhoneNumber`,`Newsletter`,`PartnerID`,`CustomerID`) VALUES
        ('Richard@fittingly.nl','$2y$10$yb1kASao8ei5QhhxD5pMuOW/d80u.bezLnG0w1WqdVVEgdCVLrDT.', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL),
        ('Fauve@fittingly.nl', '$2y$10$CtCcR3XZxYimPRkuBQjLHeuz/RULwjF/yNev9VGshUSQCBnGTyeca', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL),
        ('Yoran@fittingly.nl', '$2y$10$JIJbxSoALFTIj/qXsLuOTOg9a649YjhaRK7D6v5ScEleQErrr1R1W', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL),
        ('Bart@fittingly.nl',  '$2y$10$ahcEE61CQ6k3RxPZtkON1uR1Yshz4tITCV8AtblOqYHhcP4DFPTjm', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL),
        ('Micha@fittingly.nl', '$2y$10$SYqSgzSJPfHGWwAF3mo9cut5yP7u/ocOgIEllQu13.ar8kCmSml1O', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL),
        ('Freek@fittingly.nl', '$2y$10$pbfN/.7JoY0xzcVWeVuND.nd8CZ..CPA56qrmr4sQe0e/XPd.jFd2', 'Active', 'Admin', CURDATE(), NULL, TRUE, NULL, NULL);

