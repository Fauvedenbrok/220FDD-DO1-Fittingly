CREATE ROLE `Admin`,
CREATE ROLE `Customers`,
CREATE ROLE `Partners`,
CREATE ROLE `Support`,




-- Admin role features
GRANT ALL PRIVILEGES ON fittingly_database TO `Admin`,
GRANT SELECT ON fittingly_database.orders TO `Customers`,
GRANT SELECT, INSERT, UPDATE ON fittingly_database.stocks TO `Partners`,









-- Support role features
-- Select op customers, partners, useraccounts > passwords, orderlines, orders, stocks, articles
-- revoke op alle primary en foreign keys

CREATE VIEW fittingly_database_View_Support AS 
SELECT Passwords, AccountStatus, CustomerID, PartnerID
FROM fittingly_database.UserAccounts;

GRANT SELECT ON fittingly_database.Customers TO `Support`;
GRANT SELECT ON fittingly_database.OrderLines TO `Support`;
GRANT SELECT ON fittingly_database.Partners TO `Support`;
GRANT SELECT, UPDATE ON fittingly_database.UserAccounts.Passwords TO `Support`,



-- Partner role features
CREATE VIEW fittingly_database_View_Partner AS
SELECT DISTINCT c.CustomerID, c.PostalCode, c.HouseNumber, c.PaymentStatus
FROM fittingly_database.Customers c
JOIN fittingly_database.OrderLines ol ON o.OrderID = ol.OrderID
JOIN fittingly_database.Partners p ON ol.PartnerID = p.PartnerID
WHERE p.PartnerID = @LoggedInPartnerID

SET @LoggedInPartnerID = [2];


-- Customer role features










GRANT SELECT (column1, column2), INSERT (column1), UPDATE (column2) 
ON fittingly_database.stocks TO 'username'@'host';






-- Chatgpt, even uitzoeken.
CREATE VIEW PartnerOrders AS
SELECT 
    o.OrderID,
    o.OrderDate,
    o.PaymentStatus,
    ol.ArticleID,
    ol.Quantity,
    ol.StartDateReservation,
    ol.EndDateReservation,
    o.PostalCode, 
    o.HouseNumber
FROM Orders o
JOIN OrderLines ol ON o.OrderID = ol.OrderID
WHERE ol.PartnerID = CURRENT_USER_ID(); -- Replace with session-based filtering if needed


CREATE VIEW CustomerOrders AS
SELECT 
    o.OrderID,
    o.OrderDate,
    o.PaymentStatus,
    ol.ArticleID,
    ol.Quantity,
    ol.StartDateReservation,
    ol.EndDateReservation
FROM Orders o
JOIN OrderLines ol ON o.OrderID = ol.OrderID
WHERE o.CustomerID = CURRENT_USER_ID();


-- Grant only SELECT access on PartnerOrders to partners
GRANT SELECT ON PartnerOrders TO 'partner_role';

-- Grant only SELECT access on CustomerOrders to customers
GRANT SELECT ON CustomerOrders TO 'customer_role';

-- Ensure partners cannot access raw customer data
REVOKE SELECT, INSERT, UPDATE, DELETE ON Customers FROM 'partner_role';

-- Ensure partners cannot access user accounts
REVOKE SELECT, INSERT, UPDATE, DELETE ON UserAccounts FROM 'partner_role';


GRANT ALL PRIVILEGES ON *.* TO 'admin_role';
