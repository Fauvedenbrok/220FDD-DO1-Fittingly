CREATE ROLE `Admin`;
CREATE ROLE `Customer`;
CREATE ROLE `Partner`;
CREATE ROLE `Support`;


-- Admin role features
GRANT ALL PRIVILEGES ON fittingly_database TO `Admin`;


-- Support role features
-- Select op customers, partners, useraccounts > passwords, orderlines, orders, stocks, articles
-- revoke op alle primary en foreign keys

CREATE VIEW fittingly_database_View_Support_Customers AS 
SELECT DISTINCT
c.CustomerID,
c.FirstName,
c.LastName,
c.PhoneNumber,


GRANT SELECT ON fittingly_database.Customers TO `Support`;
GRANT SELECT ON fittingly_database.OrderLines TO `Support`;
GRANT SELECT ON fittingly_database.Partners TO `Support`;
GRANT SELECT, UPDATE ON fittingly_database.UserAccounts.Passwords TO `Support`,



-- Partner role features
CREATE VIEW fittingly_database_View_Partner_Customer AS
SELECT DISTINCT
c.CustomerID,
c.PostalCode,
c.HouseNumber
FROM fittingly_database.Customers c
WHERE p.PartnerID = 2;

GRANT SELECT ON fittingly_database_View_Partner_Customer TO `Partner`;


CREATE VIEW fittingly_database_View_Partner_Articles AS
SELECT DISTINCT
a.ArticleID,
a.Category,
a.SubCategory,
a.Material,
a.Brand,
a.Availability
FROM fittingly_database.Articles a
WHERE p.PartnerID = 2;

GRANT SELECT ON fittingly_database_View_Partner_Articles TO `Partner`;


CREATE VIEW fittingly_database_View_Partner_Orders AS
SELECT DISTINCT
o.OrderID,
o.OrderDate,
o.PaymentStatus
FROM fittingly_database.Orders o
WHERE p.PartnerID = 2;

GRANT SELECT ON fittingly_database_View_Partner_Orders TO `Partner`;


CREATE VIEW fittingly_database_View_Partner_OrderLines AS
SELECT DISTINCT
ol.OrderID,
ol.ArticleID,
ol.Quantity,
ol.StartDateReservation,
ol.EndDateReservation
FROM fittingly_database.OrderLines ol
WHERE p.PartnerID = 2;

GRANT SELECT ON fittingly_database_View_Partner_OrderLines TO `Partner`;






-- Customer role features

View articles and categories and subcategories, view and manage orders, update customer information, update useraccount_password, view useraccount_status, update newsletter_subscription,

CREATE VIEW fittingly_database_View_Customer AS
SELECT DISTINCT 



GRANT SELECT, INSERT, UPDATE ON fittingly_database.Customer TO `Customer`;
REVOKE UPDATE, INSERT, DELETE (CustomerID) ON fittingly_database.Customer TO `Customer`;















