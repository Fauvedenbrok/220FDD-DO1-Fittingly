CREATE ROLE `Admin`;
CREATE ROLE `Customer`;
CREATE ROLE `Partner`;
CREATE ROLE `Support`;

-- Admin role features
GRANT ALL PRIVILIGES ON fittingly_database TO `Admin`;



-- Customer role features
-- Read/write/update acces on `Addressess` PostalCode, HouseNumber, StreetName, Country
CREATE VIEW `Customer_Addresses` AS
SELECT `PostalCode`, `HouseNumber`, `StreetName`, `Country` FROM `Addresses`;


-- Read acces to `partner` companyname, vatnr, cocnr
CREATE VIEW `Customer_Partners` AS
SELECT `CompanyName`, `VATNr`, `CoCNr` FROM `Partners`;


-- Read/delete access on `customers` customerid
-- Read/write/update access on `customers` firstname, lastname, dateofbirth.
CREATE VIEW `Customer_Customers` AS
SELECT `CustomerID`, `FirstName`, `LastName`, `DateOfBirth` FROM `Customers`;



-- Read/write/update/delete access on `useraccouns` emailadres, password, phonenumber
-- Read/write/update on `useraccounts` newsletter
CREATE VIEW `Customer_UserAccounts` AS
SELECT `EmailAdres`, `Passwords`, `PhoneNumber`, `Newsletter` FROM `UserAccounts`;







-- Read access on `article`

-- Read access on `stock` price, internelreference

-- Read access on `orders`
-- update access on `orders` orderstatus

-- read acces on `orderlines`






-- Partner role features




-- Support role features