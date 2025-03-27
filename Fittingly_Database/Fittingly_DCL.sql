CREATE ROLE `Admin`;
CREATE ROLE `Customer`;
CREATE ROLE `Partner`;
CREATE ROLE `Support`;

-- Admin role features
GRANT ALL PRIVILEGES ON fittingly_database TO `Admin`;

-- Support role features
-- Select op customers, partners, useraccounts > passwords, orderlines, orders, stocks, articles
-- revoke op alle primary en foreign keys
CREATE VIEW
    fittingly_database_View_Support_Customers AS
SELECT DISTINCT
    c.CustomerID,
    c.FirstName,
    c.LastName,
    c.PhoneNumber,
GRANT SELECT ON fittingly_database.Customers TO `Support`;

GRANT SELECT
    ON fittingly_database.OrderLines TO `Support`;

GRANT SELECT
    ON fittingly_database.Partners TO `Support`;

GRANT SELECT
,
UPDATE ON fittingly_database.UserAccounts.Passwords TO `Support`,




-- Partner role features
<<<<<<< HEAD
<<<<<<< HEAD
CREATE VIEW fittingly_database_View_Partner_Customer AS
=======
CREATE VIEW
    fittingly_database_View_Partner_Customer AS
>>>>>>> 29693b5 (test)
SELECT DISTINCT
    c.CustomerID,
    c.PostalCode,
    c.HouseNumber
FROM fittingly_database.Customers c
=======
CREATE VIEW fittingly_database_View_Partner AS
SELECT DISTINCT
    o.PaymentStatus AS OrderPaymentStatus,  --misschien kan de AS statement weg
    a.ArticleID,
    ol.Quantity,
    ol.StartDateReservation,
    ol.EndDateReservation,
    o.OrderID,
    o.OrderDate
FROM fittingly_database.Customers c
JOIN fittingly_database.Orders o ON c.CustomerID = o.CustomerID
JOIN fittingly_database.OrderLines ol ON o.OrderID = ol.OrderID
JOIN fittingly_database.Articles a ON ol.ArticleID = a.ArticleID
JOIN fittingly_database.Partners p ON ol.PartnerID = p.PartnerID
WHERE p.PartnerID = 2;



CREATE VIEW fittingly_database_View_Partner_Customer AS
SELECT DISTINCT
c.CustomerID,
c.PostalCode,
c.HouseNumber
FROM fittingly_database.Customers c
>>>>>>> 0b7979e (wat een gedoe)
WHERE p.PartnerID = 2;

GRANT SELECT
    ON fittingly_database_View_Partner_Customer TO `Partner`;

CREATE VIEW
    fittingly_database_View_Partner_Articles AS
SELECT DISTINCT
    a.ArticleID,
    a.Category,
    a.SubCategory,
    a.Material,
    a.Brand,
    a.Availability
FROM fittingly_database.Articles a
WHERE p.PartnerID = 2;

GRANT SELECT
    ON fittingly_database_View_Partner_Articles TO `Partner`;

CREATE VIEW
    fittingly_database_View_Partner_Orders AS
SELECT DISTINCT
    o.OrderID,
    o.OrderDate,
    o.PaymentStatus
FROM fittingly_database.Orders o
WHERE p.PartnerID = 2;

GRANT SELECT
    ON fittingly_database_View_Partner_Orders TO `Partner`;

CREATE VIEW
    fittingly_database_View_Partner_OrderLines AS
SELECT DISTINCT
    ol.OrderID,
    ol.ArticleID,
    ol.Quantity,
    ol.StartDateReservation,
    ol.EndDateReservation
FROM fittingly_database.OrderLines ol
WHERE p.PartnerID = 2;

<<<<<<< HEAD
GRANT SELECT ON fittingly_database_View_Partner_OrderLines TO `Partner`;



GRANT SELECT ON fittingly_database_View_Partner TO `Partner`;
GRANT INSERT, UPDATE ON fittingly_database.Articles TO `Partner`
WHERE PartnerID = 2;

GRANT INSERT, UPDATE, DELETE ON fittingly_database.Orders TO `Partner`
WHERE PartnerID = 2;

GRANT INSERT, UPDATE, DELETE ON fittingly_database.OrderLines TO `Partner`
WHERE PartnerID = 2;



=======
GRANT SELECT
    ON fittingly_database_View_Partner_OrderLines TO `Partner`;
>>>>>>> 29693b5 (test)

-- Customer role features
View articles and categories and subcategories, view and manage orders, update customer information, update useraccount_password, view useraccount_status, update newsletter_subscription,
CREATE VIEW
    fittingly_database_View_Customer AS
SELECT DISTINCT

GRANT SELECT, INSERT, UPDATE ON fittingly_database.Customer TO `Customer`;
<<<<<<< HEAD
REVOKE UPDATE, INSERT, DELETE (CustomerID) ON fittingly_database.Customer TO `Customer`;
<<<<<<< HEAD
=======






>>>>>>> 0b7979e (wat een gedoe)













<<<<<<< HEAD

=======
-- Grant only SELECT access on PartnerOrders to partners
GRANT SELECT ON PartnerOrders TO 'partner_role';

-- Grant only SELECT access on CustomerOrders to customers
GRANT SELECT ON CustomerOrders TO 'customer_role';

-- Ensure partners cannot access raw customer data
REVOKE SELECT, INSERT, UPDATE, DELETE ON Customers FROM 'partner_role';

-- Ensure partners cannot access user accounts
REVOKE SELECT, INSERT, UPDATE, DELETE ON UserAccounts FROM 'partner_role';
>>>>>>> 0b7979e (wat een gedoe)


=======
>>>>>>> 29693b5 (test)

REVOKE UPDATE, INSERT, DELETE (CustomerID) ON fittingly_database.Customer TO `Customer`;