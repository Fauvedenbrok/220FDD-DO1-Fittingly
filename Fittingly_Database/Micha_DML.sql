-- Insert data into Address
INSERT INTO Address (PostalCode, HouseNumber, StreetName, Country) VALUES
('1000AA', '1', 'Damstraat', 'NL'),
('1000AB', '2', 'Kalverstraat', 'NL'),
('1000AC', '3', 'Leidseplein', 'NL'),
('1000AD', '4', 'Rembrandtplein', 'NL'),
('1000AE', '5', 'Museumstraat', 'NL'),
('2000AA', '10', 'Meir', 'BE'),
('2000AB', '11', 'Keyserlei', 'BE'),
('2000AC', '12', 'Groenplaats', 'BE'),
('2000AD', '13', 'Astridplein', 'BE'),
('3000AA', '20', 'Boulevard Royal', 'LU'),
('3000AB', '21', 'Grand Rue', 'LU'),
('3000AC', '22', 'Avenue de la Gare', 'LU'),
('3000AD', '23', 'Place d Armes', 'LU'),
('3000AE', '24', 'Rue de la Reine', 'LU'),
('4000AA', '30', 'Champs-Élysées', 'FR'),
('4000AB', '31', 'Rue de Rivoli', 'FR'),
('4000AC', '32', 'Boulevard Haussmann', 'FR'),
('4000AD', '33', 'Avenue Montaigne', 'FR'),
('4000AE', '34', 'Rue Saint-Honoré', 'FR'),
('4000AF', '35', 'Place Vendôme', 'FR');


-- Insert data into Customer
INSERT INTO Customer (FirstName, LastName, PhoneNumber, DateOfBirth, Newsletter, PostalCode, HouseNumber) VALUES
('Jan', 'Jansen', '0612345678', '1985-05-15', TRUE, '1000AA', '1'),
('Piet', 'Peters', '0623456789', '1990-07-20', FALSE, '1000AB', '2'),
('Lisa', 'Smit', '0634567890', '1995-08-10', TRUE, '1000AC', '3'),
('Tom', 'Hendriks', '0645678901', '1988-03-25', FALSE, '1000AD', '4'),
('Emma', 'Vermeer', '0656789012', '1993-12-14', TRUE, '1000AE', '5'),
('Lucas', 'De Vries', '0667890123', '1979-09-17', TRUE, '2000AA', '10'),
('Sophie', 'De Jong', '0678901234', '1986-02-05', FALSE, '2000AB', '11'),
('Noah', 'Bos', '0689012345', '1992-06-30', TRUE, '2000AC', '12'),
('Mila', 'Bakker', '0690123456', '1998-04-21', FALSE, '2000AD', '13'),
('Daan', 'Mulder', '0611122233', '1983-11-29', TRUE, '3000AA', '20'),
('Sara', 'Visser', '0622233344', '1997-01-11', TRUE, '3000AB', '21'),
('Tijn', 'Maas', '0633344455', '1980-08-23', FALSE, '3000AC', '22'),
('Sanne', 'Kuipers', '0644455566', '1991-07-07', TRUE, '3000AD', '23'),
('Lotte', 'Kramer', '0655566677', '1996-10-13', FALSE, '3000AE', '24'),
('Jasper', 'Groen', '0666677788', '1982-05-02', TRUE, '4000AA', '30'),
('Hanna', 'Schouten', '0677788899', '1994-09-09', FALSE, '4000AB', '31'),
('David', 'Meijer', '0688899900', '1989-03-18', TRUE, '4000AC', '32'),
('Elise', 'Vos', '0699900112', '1975-12-25', FALSE, '4000AD', '33'),
('Thomas', 'Schipper', '0610101010', '1984-06-06', TRUE, '4000AE', '34'),
('Julia', 'Willems', '0620202020', '1993-02-14', FALSE, '4000AF', '35');


-- Insert data into Order
INSERT INTO `Order` (OrderDate, PaymentStatus, CustomerID, PostalCode, HouseNumber) VALUES
('2025-03-01', 'Paid', 1, '1000AA', '1'),
('2025-03-02', 'Pending', 2, '1000AB', '2'),
('2025-03-03', 'Failed', 3, '1000AC', '3'),
('2025-03-04', 'Refunded', 4, '1000AD', '4'),
('2025-03-05', 'Paid', 5, '1000AE', '5'),
('2025-03-06', 'Paid', 6, '2000AA', '10'),
('2025-03-07', 'Pending', 7, '2000AB', '11'),
('2025-03-08', 'Paid', 8, '2000AC', '12'),
('2025-03-09', 'Failed', 9, '2000AD', '13'),
('2025-03-10', 'Refunded', 10, '3000AA', '20'),
('2025-03-11', 'Paid', 11, '3000AB', '21'),
('2025-03-12', 'Pending', 12, '3000AC', '22'),
('2025-03-13', 'Failed', 13, '3000AD', '23'),
('2025-03-14', 'Refunded', 14, '3000AE', '24'),
('2025-03-15', 'Paid', 15, '4000AA', '30'),
('2025-03-16', 'Pending', 16, '4000AB', '31'),
('2025-03-17', 'Paid', 17, '4000AC', '32'),
('2025-03-18', 'Failed', 18, '4000AD', '33'),
('2025-03-19', 'Refunded', 19, '4000AE', '34'),
('2025-03-20', 'Paid', 20, '4000AF', '35');


-- Insert data into Article
INSERT INTO Article (Name, Size, Weight, Color, Description, Image, Category, SubCategory, Material, Brand, Availability) VALUES
('T-Shirt', 'M', 200, 'Red', 'Comfortable cotton T-Shirt', 'tshirt_red.jpg', 'Clothing', 'Shirts', 'Cotton', 'Nike', TRUE),
('Jeans', 'L', 800, 'Blue', 'Denim slim-fit jeans', 'jeans_blue.jpg', 'Clothing', 'Pants', 'Denim', 'Levis', TRUE),
('Sneakers', '42', 1000, 'White', 'Sporty running shoes', 'sneakers_white.jpg', 'Footwear', 'Shoes', 'Mesh', 'Adidas', TRUE),
('Jacket', 'XL', 1500, 'Black', 'Warm winter jacket', 'jacket_black.jpg', 'Clothing', 'Outerwear', 'Polyester', 'North Face', FALSE),
('Hat', 'One Size', 150, 'Blue', 'Stylish baseball cap', 'hat_blue.jpg', 'Accessories', 'Caps', 'Cotton', 'Puma', TRUE),
('Sweater', 'M', 600, 'Green', 'Soft woolen sweater', 'sweater_green.jpg', 'Clothing', 'Sweaters', 'Wool', 'H&M', TRUE),
('Dress', 'S', 500, 'Black', 'Elegant evening dress', 'dress_black.jpg', 'Clothing', 'Dresses', 'Silk', 'Zara', FALSE),
('Shorts', 'L', 300, 'Yellow', 'Comfortable summer shorts', 'shorts_yellow.jpg', 'Clothing', 'Shorts', 'Linen', 'Uniqlo', TRUE),
('Blouse', 'S', 250, 'White', 'Light cotton blouse', 'blouse_white.jpg', 'Clothing', 'Shirts', 'Cotton', 'Mango', TRUE),
('Boots', '43', 1200, 'Brown', 'Leather ankle boots', 'boots_brown.jpg', 'Footwear', 'Boots', 'Leather', 'Dr. Martens', FALSE),
('Scarf', 'One Size', 100, 'Purple', 'Cozy winter scarf', 'scarf_purple.jpg', 'Accessories', 'Scarves', 'Wool', 'Gucci', TRUE),
('Suit', 'M', 1000, 'Gray', 'Formal business suit', 'suit_gray.jpg', 'Clothing', 'Suits', 'Wool', 'Tommy Hilfiger', TRUE),
('Belt', 'One Size', 200, 'Black', 'Leather belt', 'belt_black.jpg', 'Accessories', 'Belts', 'Leather', 'Louis Vuitton', FALSE),
('Skirt', 'M', 400, 'Red', 'Charming cotton skirt', 'skirt_red.jpg', 'Clothing', 'Skirts', 'Cotton', 'Forever 21', TRUE),
('Sweatshirt', 'L', 800, 'Gray', 'Comfortable hoodie sweatshirt', 'sweatshirt_gray.jpg', 'Clothing', 'Hoodies', 'Polyester', 'Adidas', TRUE),
('Sandals', '40', 500, 'Pink', 'Fashionable summer sandals', 'sandals_pink.jpg', 'Footwear', 'Sandals', 'Rubber', 'Nike', TRUE),
('Pants', 'M', 700, 'Gray', 'Casual cotton pants', 'pants_gray.jpg', 'Clothing', 'Pants', 'Cotton', 'Levis', TRUE),
('Tote Bag', 'One Size', 250, 'Black', 'Spacious tote bag', 'tote_bag_black.jpg', 'Accessories', 'Bags', 'Canvas', 'Chanel', TRUE),
('Sweatpants', 'L', 800, 'Blue', 'Cozy sweatpants for lounging', 'sweatpants_blue.jpg', 'Clothing', 'Pants', 'Cotton', 'Adidas', TRUE),
('Raincoat', 'XL', 1100, 'Yellow', 'Waterproof raincoat', 'raincoat_yellow.jpg', 'Clothing', 'Outerwear', 'Nylon', 'Columbia', TRUE),
('Gloves', 'One Size', 150, 'Black', 'Winter gloves', 'gloves_black.jpg', 'Accessories', 'Gloves', 'Wool', 'North Face', FALSE);


-- Insert data into Partner
INSERT INTO Partner (CompanyName, VatNr, CoCNr, PostalCode, HouseNumber) VALUES
('Fashion Hub', 'NL123456789B01', '123456789', '1000AA', '1'),
('Outdoor Gear', 'NL987654321B01', '987654321', '1000AB', '2'),
('Sports World', 'BE123456789', '112233445', '2000AA', '10'),
('Tech Haven', 'BE987654321', '998877665', '2000AB', '11'),
('Home Essentials', 'LU123456789B01', '998877664', '3000AA', '20'),
('Eco Fashion', 'LU987654321B01', '556677889', '3000AB', '21'),
('Gadget Shop', 'FR123456789B01', '112233445', '4000AA', '30'),
('Luxury Living', 'FR987654321B01', '667788990', '4000AB', '31'),
('Health & Fitness', 'NL112233445B01', '223344556', '1000AC', '3'),
('Beauty Store', 'NL223344556B01', '334455667', '1000AD', '4'),
('Kids World', 'BE334455667', '445566778', '2000AC', '12'),
('Home Tech', 'BE445566778', '556677889', '2000AD', '13'),
('Fashionistas', 'LU556677889B01', '667788990', '3000AC', '22'),
('Stylish Living', 'LU667788990B01', '778899001', '3000AD', '23'),
('Smart Devices', 'FR778899001B01', '889900112', '4000AC', '32'),
('Fitness Experts', 'FR889900112B01', '990011223', '4000AD', '33'),
('Garden Supplies', 'NL990011223B01', '112233445', '1000AE', '5'),
('Trendy Fashion', 'NL112233445B01', '223344556', '1000AF', '6'),
('Tech Products', 'BE223344556', '334455667', '2000AE', '13'),
('Fashion Forward', 'BE334455667', '445566778', '2000AF', '14');


-- Insert data into OrderLine
INSERT INTO OrderLine (OrderID, ArticleID, PartnerID, Quantity, StartDate, EndDate) VALUES
(1, 1, 1, 2, '2025-03-01', '2025-03-10'),
(1, 2, 2, 1, '2025-03-01', '2025-03-10'),
(2, 3, 3, 5, '2025-03-02', '2025-03-12'),
(2, 4, 4, 3, '2025-03-02', '2025-03-12'),
(3, 1, 5, 1, '2025-03-03', '2025-03-13'),
(4, 2, 6, 2, '2025-03-04', '2025-03-14'),
(5, 3, 7, 4, '2025-03-05', '2025-03-15'),
(6, 4, 8, 2, '2025-03-06', '2025-03-16'),
(7, 1, 9, 3, '2025-03-07', '2025-03-17'),
(8, 2, 10, 1, '2025-03-08', '2025-03-18'),
(9, 3, 11, 5, '2025-03-09', '2025-03-19'),
(10, 4, 12, 2, '2025-03-10', '2025-03-20'),
(11, 1, 13, 3, '2025-03-11', '2025-03-21'),
(12, 2, 14, 1, '2025-03-12', '2025-03-22'),
(13, 3, 15, 4, '2025-03-13', '2025-03-23'),
(14, 4, 16, 2, '2025-03-14', '2025-03-24'),
(15, 1, 17, 3, '2025-03-15', '2025-03-25'),
(16, 2, 18, 1, '2025-03-16', '2025-03-26'),
(17, 3, 19, 5, '2025-03-17', '2025-03-27'),
(18, 4, 20, 2, '2025-03-18', '2025-03-28');


-- Insert data into Stock
INSERT INTO Stock (ArticleID, PartnerID, StockQuantity, Price, DateAdded) VALUES
(1, 1, 100, 19.99, '2025-02-01'),
(2, 2, 200, 49.99, '2025-02-02'),
(3, 3, 150, 89.99, '2025-02-03'),
(4, 4, 50, 149.99, '2025-02-04'),
(1, 5, 80, 21.99, '2025-02-05'),
(2, 6, 250, 45.99, '2025-02-06'),
(3, 7, 120, 85.99, '2025-02-07'),
(4, 8, 60, 139.99, '2025-02-08'),
(1, 9, 90, 20.99, '2025-02-09'),
(2, 10, 220, 48.99, '2025-02-10'),
(3, 11, 130, 88.99, '2025-02-11'),
(4, 12, 40, 149.99, '2025-02-12'),
(1, 13, 70, 19.99, '2025-02-13'),
(2, 14, 210, 47.99, '2025-02-14'),
(3, 15, 140, 87.99, '2025-02-15'),
(4, 16, 55, 145.99, '2025-02-16'),
(1, 17, 110, 22.99, '2025-02-17'),
(2, 18, 240, 46.99, '2025-02-18'),
(3, 19, 160, 90.99, '2025-02-19'),
(4, 20, 45, 155.99, '2025-02-20');

-- Insert data into UserAccount
INSERT INTO UserAccount (UserID, Emailaddress, Password, AccountStatus, AccountAccessRights, DateOfRegistration, PartnerID, CustomerID) VALUES
('0a3e9ab1-6bba-4c16-a0c3-0e9e1b2c6d1e', 'jan.jansen@example.com', 'password123', TRUE, 'Customer', '2025-01-01', NULL, 1),
('4b2175c6-b0ba-470f-a5ca-397db2a9e8e1', 'piet.peters@example.com', 'mypassword', TRUE, 'Customer', '2025-01-02', NULL, 2),
('8d27f34d-6f88-44b7-8834-dbd974b24c3a', 'lisa.smit@example.com', 'securepass', FALSE, 'Customer', '2025-01-03', NULL, 3),
('123c5f79-914e-47fd-a488-9ca70fd9258d', 'tom.hendriks@example.com', 'qwerty123', TRUE, 'Customer', '2025-01-04', NULL, 4),
('9e0d3d79-930d-49c5-8c6d-fb5a2f519823', 'emma.vermeer@example.com', 'emmapass', TRUE, 'Customer', '2025-01-05', NULL, 5),
('ec70da59-b130-4d26-bd91-d30ad2ff6a16', 'lucas.devries@example.com', 'lucas123', TRUE, 'Customer', '2025-01-06', NULL, 6),
('c2e1b97a-5224-4041-bb2d-82abedb6ea85', 'sophie.dejong@example.com', 'sophie123', FALSE, 'Customer', '2025-01-07', NULL, 7),
('d5b373c8-7bc1-4c78-9a5f-7c73904a975b', 'noah.bos@example.com', 'noahpass', TRUE, 'Customer', '2025-01-08', NULL, 8),
('c63b27d9-bdbd-43d1-b16b-f3b763d08829', 'mila.bakker@example.com', 'milabakker', TRUE, 'Customer', '2025-01-09', NULL, 9),
('5d4d2f60-6cfb-4ec2-bd88-e6d9c7e4c5c4', 'daan.mulder@example.com', 'mulder123', FALSE, 'Customer', '2025-01-10', NULL, 10),
('3c2a9872-fb2a-46c9-917f-e2491b6be0cd', 'sara.visser@example.com', 'saravisser', TRUE, 'Customer', '2025-01-11', NULL, 11),
('7b730a4e-9f0e-4c6a-b045-56c6c8e2f0e5', 'tijn.maas@example.com', 'tijnmaas', TRUE, 'Customer', '2025-01-12', NULL, 12),
('3d3e10c0-0a33-4e91-9ed4-d1c20889b9d4', 'sanne.kuipers@example.com', 'sannepass', TRUE, 'Customer', '2025-01-13', NULL, 13),
('48b7d59d-7bbf-44d7-b7c1-83513f0c40c7', 'lotte.kramer@example.com', 'lotte123', FALSE, 'Customer', '2025-01-14', NULL, 14),
('9c2a5ad3-3c77-402a-8c35-f4fe38b88ef4', 'jasper.groen@example.com', 'jasperpass', TRUE, 'Customer', '2025-01-15', NULL, 15),
('27f4c4c3-9b8f-4d09-8108-d0fd56a3029f', 'hanna.schouten@example.com', 'hanna123', FALSE, 'Customer', '2025-01-16', NULL, 16),
('1c9e632b-0e2c-4600-b12a-82c45387da96', 'david.meijer@example.com', 'davidmeijer', TRUE, 'Customer', '2025-01-17', NULL, 17),
('60f2cce0-c9f7-4a97-96c1-5862b1e9c687', 'elise.vos@example.com', 'elisevos', FALSE, 'Customer', '2025-01-18', NULL, 18),
('eb41f507-38b5-4b77-8b70-d5f169ce58c2', 'thomas.schipper@example.com', 'thomasschipper', TRUE, 'Customer', '2025-01-19', NULL, 19),
('f6d5cb8b-3cf3-4a1e-a3be-73ad3d263f92', 'julia.willems@example.com', 'juliawillems', TRUE, 'Customer', '2025-01-20', NULL, 20);



