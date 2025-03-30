CREATE ROLE `Admin`;
CREATE ROLE `Customer`;
CREATE ROLE `Partner`;
CREATE ROLE `Support`;
CREATE ROLE `Guest`;

GRANT `Customer` TO 'user1@example.com';
GRANT `Partner` TO 'business@example.com';
GRANT `Support` TO 'support@example.com';
GRANT `Admin` TO 'admin@example.com';
GRANT `Guest` TO 'guest@example.com'@'%';	



/* Admin role features */
GRANT ALL PRIVILIGES ON fittingly_database TO `Admin`;


-- Addresses Table
GRANT SELECT, INSERT, UPDATE ON `Addresses` TO `Customer`, `Support`, `Partner`;


-- Partner Table
CREATE VIEW `View_CompanyName_VATNr_CoCNr` AS
SELECT CompanyName, VATNr, CoCNr
FROM Partners;

CREATE VIEW `View_CompanyName` AS
SELECT CompanyName
FROM Partners;

CREATE VIEW `View_PartnerID` AS
SELECT PartnerID
FROM Partners;

GRANT UPDATE ON `View_CompanyName` TO `Partner`;
GRANT DELETE ON `View_PartnerID` TO `Partner`;
GRANT SELECT ON `View_CompanyName_VATNr_CoCNr` TO `Customer`;
GRANT SELECT, INSERT ON `Partners` TO `Partner`, `Support`;
GRANT UPDATE ON `View_CompanyName_VATNr_CoCNr` TO `Support`;



-- Customer Table
CREATE VIEW `View_FirstName_LastName_DateofBirth` AS
SELECT FirstName, LastName, DateOfBirth
FROM Customers;

CREATE VIEW `View_FirstName_LastName` AS
SELECT FirstName, LastName	
FROM Customers;

CREATE VIEW `View_CustomerID` AS
SELECT CustomerID
FROM Customers;

GRANT SELECT ON `View_FirstName_LastName` TO `Partners`;
GRANT SELECT, DELETE ON `View_CustomerID` TO `Customer`, `Support`;
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
SELECT Newsletter
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

-- Articles Table
CREATE VIEW `View_Article_Without_ID` AS
SELECT `Name`, `Description`, `Availability`, `Size`, `Weight`, WeightUnit, Color, `Image`, Category, SubCategory, Material, Brand
FROM Articles;

GRANT UPDATE ON `View_Article_Without_ID` TO 'Partner', 'Support';
GRANT SELECT ON Articles TO 'Customer', 'Partner', 'Support';
GRANT INSERT ON Articles TO 'Partner';




-- Stock Table
CREATE VIEW 'View_Price_InternalReference' AS
SELECT Price, InternalReference
FROM Stock;

CREATE VIEW 'View_Price_InternalReference_QuantityOfStock' AS
SELECT Price, InternalReference, QuantityOfStock
FROM Stock;

GRANT SELECT ON 'View_Price_InternalReference' TO 'Customer', 'Guest';
GRANT UPDATE ON 'View_Price_InternalReference_QuantityOfStock' TO 'Partner';
GRANT SELECT ON Stock TO 'Partner', 'Support';
GRANT INSERT ON Stock TO 'Partner';


-- Orders Table

CREATE VIEW 'View_OrderStatus' AS
SELECT OrderStatus
FROM Orders;

CREATE VIEW 'View_OrderStatus_PaymentStatus' AS
SELECT OrderStatus, PaymentStatus
FROM Orders;

GRANT UPDATE ON 'View_OrderStatus' TO 'Customer', 'Partner';
GRANT UPDATE ON 'View_OrderStatus_PaymentStatus' TO 'Support';
GRANT SELECT ON Orders TO 'Customer', 'Partner', 'Support';


-- OrderLines Table
CREATE VIEW `View_Start_EndDateReservation` AS
SELECT StartDateReservation, EndDateReservation
FROM OrderLines;

GRANT UPDATE ON `View_Start_EndDateReservation` TO `Partner`;
GRANT SELECT ON OrderLines TO `Customer`, `Partner`, `Support`;
