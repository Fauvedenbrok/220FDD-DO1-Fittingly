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
        INSERT INTO `Customers` (`FirstName`, `LastName`, `DateOfBirth`, `PostalCode`, `HouseNumber`) VALUES
        ('Michael', 'Jones', '1987-08-12', '1111AA', '15'),
        ('Sophia', 'Miller', '1991-03-25', '2222BB', '27'),
        ('Daniel', 'Wilson', '1985-11-05', '3333CC', '39'),
        ('Emily', 'Clark', '1998-06-18', '4444DD', '51'),
        ('David', 'Martinez', '1993-09-30', '5555EE', '63');

        -- Insert fake data for UserAccounts
        INSERT INTO `UserAccounts` (`EmailAddress`, `UserPassword`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PhoneNumber`, `Newsletter`, `partnerID`, `customerID`) VALUES
        ('michael.jones@example.com', 'pass987', 'Active', 'Customer', '2024-01-10', '0611111111', TRUE, NULL, 1), 
        ('sophia.miller@example.com', 'pass654', 'Active', 'Customer', '2024-02-15', '0622222222', FALSE, NULL, 2), 
        ('daniel.wilson@example.com', 'pass321', 'Suspended', 'Customer', '2024-03-20', '0633333333', TRUE, NULL, 3), 
        ('emily.clark@example.com', 'pass456', 'Active', 'Customer', '2024-04-25', '0644444444', FALSE, NULL, 4), 
        ('david.martinez@example.com', 'pass789', 'Non-active', 'Customer', '2024-05-30', '0655555555', TRUE, NULL, 5), 
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
        (50, 49.99, '2023-02-01', 'REF002', 2, 2),
        (200, 29.99, '2023-03-01', 'REF003', 3, 3),
        (150, 99.99, '2023-04-01', 'REF004', 4, 4),
        (75, 39.99, '2023-05-01', 'REF005', 5, 5);

        -- Insert fake data for Orders
        INSERT INTO `Orders` (`OrderDate`, `PaymentStatus`, `PostalCode`, `HouseNumber`, `OrderStatus`, `CustomerID`) VALUES
        ('2023-01-10', TRUE, '1111AA', '15', 'Shipped', 1),  
        ('2023-02-15', FALSE, '2222BB', '27', 'Pending', 2), 
        ('2023-03-20', TRUE, '3333CC', '39', 'Delivered', 3), 
        ('2023-04-25', FALSE, '4444DD', '51', 'Cancelled', 4), 
        ('2023-05-30', TRUE, '5555EE', '63', 'Shipped', 5); 

        -- Insert fake data for OrderLines
        INSERT INTO `OrderLines` (`Quantity`, `StartDateReservation`, `EndDateReservation`, `OrderLinePrice`, `OrderID`, `ArticleID`, `PartnerID`) VALUES
        (2, '2023-01-10', '2023-01-15', 39.98, 1, 1, 1),
        (1, '2023-02-15', '2023-02-20', 49.99, 2, 2, 2),
        (3, '2023-03-20', '2023-03-25', 89.97, 3, 3, 3),
        (1, '2023-04-25', '2023-04-30', 99.99, 4, 4, 4),
        (4, '2023-05-30', '2023-06-05', 159.96, 5, 5, 5);
