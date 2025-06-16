CREATE ROLE `Admin`;
CREATE ROLE `Customer`;
CREATE ROLE `Partner`;
CREATE ROLE `Support`;
CREATE ROLE `Guest`;

-- GRANT `Customer` TO 'user1@example.com';
-- GRANT `Partner` TO 'business@example.com';
-- GRANT `Support` TO 'support@example.com';
-- GRANT `Admin` TO 'admin@example.com';
-- GRANT `Guest` TO 'guest@example.com'@'%';	



/* Admin role features */
GRANT ALL PRIVILEGES ON fittingly_database.* TO 'Admin';



-- Addresses Table
GRANT SELECT, INSERT, UPDATE ON `Addresses` TO `Customer`, `Support`, `Partner`;

-- nog ID's aan de views toevoegen, zodat de views ook kunnen worden gebruikt voor het updaten van de tabellen
-- Partner Table
CREATE VIEW `View_CompanyName_VATNr_CoCNr` AS
SELECT PartnerID, CompanyName, VATNr, CoCNr
FROM Partners;

CREATE VIEW `View_CompanyName` AS
SELECT PartnerID, CompanyName
FROM Partners;

GRANT UPDATE ON `View_CompanyName` TO `Partner`;
GRANT SELECT ON `View_CompanyName_VATNr_CoCNr` TO `Customer`;
GRANT SELECT, INSERT ON `Partners` TO `Partner`, `Support`;
GRANT UPDATE ON `View_CompanyName_VATNr_CoCNr` TO `Support`;



-- Customer Table
CREATE VIEW `View_FirstName_LastName_DateofBirth` AS
SELECT CustomerID, FirstName, LastName, DateOfBirth
FROM Customers;

CREATE VIEW `View_FirstName_LastName` AS
SELECT CustomerID, FirstName, LastName	
FROM Customers;

GRANT SELECT ON `View_FirstName_LastName` TO `Partner`;
GRANT SELECT, DELETE ON Customers TO `Customer`, `Support`;
GRANT SELECT, INSERT, UPDATE ON `View_FirstName_LastName_DateofBirth` TO `Customer`, `Support`;


-- UserAccounts Table
CREATE VIEW `View_EmailAddress_UserPassword_PhoneNumber_Newsletter` AS
SELECT EmailAddress, UserPassword, PhoneNumber, Newsletter
FROM UserAccounts;

CREATE VIEW `View_EmailAddress_Password_AccountStatus_PhoneNumber_Newsletter` AS
SELECT EmailAddress, UserPassword, AccountStatus, PhoneNumber, Newsletter
FROM UserAccounts;

CREATE VIEW `View_EmailAddress_UserPassword_PhoneNumber` AS
SELECT EmailAddress, UserPassword, PhoneNumber
FROM UserAccounts;

CREATE VIEW `View_Newsletter` AS
SELECT EmailAddress, Newsletter
FROM UserAccounts;

CREATE VIEW `View_EmailAddress_UserPassword_Newsletter` AS
SELECT EmailAddress, UserPassword, Newsletter
FROM UserAccounts;

CREATE VIEW `View_EmailAddress_UserPassword_AccountStatus_PhoneNumber` AS
SELECT EmailAddress, UserPassword, AccountStatus, PhoneNumber
FROM UserAccounts;


GRANT INSERT ON `UserAccounts` TO `Customer`, `Support`, `Partner`, `Guest`;
GRANT SELECT, UPDATE, DELETE ON `View_EmailAddress_UserPassword_PhoneNumber_Newsletter` TO `Customer`, `Support`, `Partner`;
GRANT SELECT ON `View_EmailAddress_Password_AccountStatus_PhoneNumber_Newsletter` TO `Partner`;
GRANT DELETE ON `View_EmailAddress_UserPassword_PhoneNumber` TO `Customer`, `Partner`;
GRANT UPDATE ON `View_EmailAddress_Password_AccountStatus_PhoneNumber_Newsletter` TO `Support`;
GRANT UPDATE ON `View_Newsletter` TO `Guest`;


-- Articles Table
GRANT UPDATE ON Articles TO 'Partner', 'Support';
GRANT SELECT ON Articles TO 'Customer', 'Partner', 'Support';
GRANT INSERT ON Articles TO 'Partner';


-- Stock Table
CREATE VIEW `View_Price_InternalReference` AS
SELECT Price, InternalReference, ArticleID, PartnerID
FROM Stock;

CREATE VIEW `View_Price_InternalReference_QuantityOfStock` AS
SELECT Price, InternalReference, QuantityOfStock, ArticleID, PartnerID
FROM Stock;

GRANT SELECT ON `View_Price_InternalReference` TO 'Customer', 'Guest';
GRANT UPDATE ON `View_Price_InternalReference_QuantityOfStock` TO 'Partner';
GRANT SELECT ON Stock TO 'Partner', 'Support';
GRANT INSERT ON Stock TO 'Partner';


-- Orders Table
CREATE VIEW `View_OrderStatus` AS
SELECT OrderID, OrderStatus
FROM Orders;

CREATE VIEW `View_OrderStatus_PaymentStatus` AS
SELECT OrderID, OrderStatus, PaymentStatus
FROM Orders;

GRANT UPDATE ON `View_OrderStatus` TO 'Customer', 'Partner';
GRANT UPDATE ON `View_OrderStatus_PaymentStatus` TO 'Support';
GRANT SELECT ON Orders TO 'Customer', 'Partner', 'Support';


-- OrderLines Table
CREATE VIEW `View_Start_EndDateReservation` AS
SELECT OrderID, ArticleID, PartnerID, StartDateReservation, EndDateReservation
FROM OrderLines;

GRANT UPDATE ON `View_Start_EndDateReservation` TO `Partner`;
GRANT SELECT ON OrderLines TO `Customer`, `Partner`, `Support`;
