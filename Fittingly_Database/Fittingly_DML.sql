-- Insert fake data into Addresses
    INSERT INTO `Addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `City`, `Country`) VALUES
        ('1234AB', '1', 'Main Street', 'Amsterdam', 'Nederland'),
        ('5678CD', '2', 'Second Avenue', 'Rotterdam', 'Nederland'),
        ('9101EF', '3', 'Third Boulevard', 'Utrecht', 'Nederland'),
        ('1121GH', '4', 'Fourth Lane', 'Eindhoven', 'Nederland'),
        ('3141IJ', '5', 'Fifth Road', 'Groningen', 'Nederland'),
        ('5161KL', '6', 'Sixth Drive', 'Maastricht', 'Nederland');

    -- Insert fake data into Partners
    INSERT INTO `Partners` (`CompanyName`, `VATNr`, `CoCNr`, `PostalCode`, `HouseNumber`) VALUES
        ('Partner A', 'NL123456789B01', 12345678, '1234AB', '1'),
        ('Partner B', 'NL987654321B02', 87654321, '5678CD', '2'),
        ('Partner C', 'NL112233445B03', 11223344, '9101EF', '3'),
        ('Partner D', 'NL556677889B04', 55667788, '1121GH', '4'),
        ('Partner E', 'NL998877665B05', 99887766, '3141IJ', '5'),
        ('Partner F', 'NL443322110B06', 44332211, '5161KL', '6');

    -- Insert fake data into Customers
    INSERT INTO `Customers` (`FirstName`, `LastName`, `DateOfBirth`, `PostalCode`, `HouseNumber`) VALUES
        ('John', 'Doe', '1990-01-01', '1234AB', '1'),
        ('Jane', 'Smith', '1985-05-15', '5678CD', '2'),
        ('Alice', 'Johnson', '1992-07-20', '9101EF', '3'),
        ('Bob', 'Brown', '1988-03-10', '1121GH', '4'),
        ('Charlie', 'Davis', '1995-11-25', '3141IJ', '5'),
        ('Eve', 'Wilson', '1993-09-30', '5161KL', '6');

    -- Insert fake data into UserAccounts
    INSERT INTO `UserAccounts` (`EmailAddress`, `UserPassword`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `PhoneNumber`, `Newsletter`, `PartnerID`, `CustomerID`) VALUES
        ('john.doe@example.com', 'password123', 'Active', 'Customer', '2023-01-01', '0612345678', TRUE, NULL, 1),
        ('jane.smith@example.com', 'password456', 'Active', 'Customer', '2023-02-01', '0623456789', FALSE, NULL, 2),
        ('partner.a@example.com', 'password789', 'Active', 'Partner', '2023-03-01', '0634567890', TRUE, 1, NULL),
        ('partner.b@example.com', 'password321', 'Active', 'Partner', '2023-04-01', '0645678901', FALSE, 2, NULL),
        ('admin@example.com', 'adminpass', 'Active', 'Admin', '2023-05-01', '0656789012', TRUE, NULL, NULL),
        ('support@example.com', 'supportpass', 'Active', 'Support', '2023-06-01', '0667890123', TRUE, NULL, NULL);

    -- Insert fake data into Articles
    INSERT INTO `Articles` (`Name`, `Size`, `Weight`, `WeightUnit`, `Color`, `Description`, `Category`, `SubCategory`, `Material`, `Brand`, `Availability`) VALUES
        ('T-Shirt', 'M', 0.5, 'Kilogram', 'Red', 'Comfortable cotton T-shirt', 'Mannenkleding', 'T-Shirts', 'Katoen', 'Brand A', TRUE),
        ('Dress', 'L', 0.8, 'Kilogram', 'Blue', 'Elegant silk dress', 'Vrouwenkleding', 'Jurken', 'Zijde', 'Brand B', TRUE),
        ('Shoes', '42', 1.2, 'Kilogram', 'Black', 'Durable leather shoes', 'Accessoires', 'Schoenen', 'Linnen', 'Brand C', FALSE),
        ('Jacket', 'XL', 1.5, 'Kilogram', 'Green', 'Warm winter jacket', 'Mannenkleding', 'Jassen', 'Spandex', 'Brand D', TRUE),
        ('Pants', 'M', 1.0, 'Kilogram', 'Gray', 'Stylish cotton pants', 'Mannenkleding', 'Broeken', 'Katoen', 'Brand E', TRUE),
        ('Hat', 'One Size', 0.3, 'Kilogram', 'Yellow', 'Trendy summer hat', 'Accessoires', 'Hoeden', 'Stro', 'Brand F', TRUE);