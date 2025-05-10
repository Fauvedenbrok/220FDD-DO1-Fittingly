-- Simpele queries waarbij je de WHERE clause gebruikt om te filteren op een bepaalde waarde
-- en de AND operator om meerdere voorwaarden te combineren.
SELECT * FROM Customers WHERE FirstName = 'John' AND LastName = 'Doe';
SELECT * FROM Partners WHERE CompanyName = 'Partner A' AND PostalCode = '1234AB';
SELECT * FROM Articles WHERE Name = 'T-Shirt A' AND Category = 'Mannenkleding';
SELECT * FROM Stock WHERE QuantityOfStock > 50 AND Price < 30.00;
SELECT * FROM Orders WHERE OrderDate BETWEEN '2023-01-01' AND '2023-12-31' AND PaymentStatus = TRUE;
SELECT * FROM OrderLines WHERE Quantity > 2 AND OrderLinePrice < 100.00;
SELECT * FROM UserAccounts WHERE AccountStatus = 'Active' AND Newsletter = TRUE;
SELECT * FROM Customers WHERE DateOfBirth < '1990-01-01' AND PostalCode = '1234AB';
SELECT * FROM Partners WHERE VATNr = 'NL123456789B01' AND CoCNr = 12345678;
SELECT * FROM Articles WHERE WeightUnit = 'Kilogram' AND Availability = TRUE;
SELECT * FROM Stock WHERE DateAdded > '2023-01-01' AND InternalReference = 'REF001';
SELECT * FROM Orders WHERE OrderStatus = 'Shipped' AND CustomerID = 1;
SELECT * FROM OrderLines WHERE StartDateReservation < '2023-01-10' AND EndDateReservation > '2023-01-15';

-- eerst groeperen voordat je de HAVING clause kan gebruiken
SELECT City, COUNT(*) AS NumberOfCities
FROM Addresses
JOIN Customers ON Addresses.PostalCode = Customers.PostalCode AND Addresses.HouseNumber = Customers.HouseNumber
GROUP BY City
HAVING NumberOfCities = 1;

-- Distinct om unieke waarden te selecteren
SELECT DISTINCT Country FROM Addresses;

-- Selecteren van een subset van kolommen
SELECT FirstName, LastName FROM Customers;
SELECT CompanyName, VATNr FROM Partners;
SELECT `Name`, `Description` FROM Articles;
SELECT Price, QuantityOfStock FROM Stock;

-- Selecteren van een subset van kolommen om de gegevens te groeperen en een andere volgorde te geven
SELECT `PostalCode`, `HouseNumber`, `StreetName`, `City` FROM Addresses ORDER BY City, PostalCode;
SELECT `OrderDate`, `PaymentStatus`, `OrderStatus` FROM Orders ORDER BY OrderDate DESC;
SELECT `QuantityOfStock`, `Price`, `InternalReference` FROM Stock ORDER BY Price ASC;

-- Statistische functies gebruiken om samenvattende statistieken te berekenen
SELECT COUNT(*) AS TotalCustomers FROM Customers;
SELECT AVG(Price) AS AveragePrice FROM Stock;
SELECT SUM(Quantity) AS TotalQuantity FROM OrderLines;
SELECT MAX(`Weight`) AS MaxWeight FROM Articles;
SELECT MIN(QuantityOfStock) AS MinStock FROM Stock;

-- gebruik van inner join om gegevens uit meerdere tabellen te combineren
SELECT Customers.FirstName, Customers.LastName, Orders.OrderDate
FROM Customers
INNER JOIN Orders ON Customers.CustomerID = Orders.CustomerID;

SELECT Partners.CompanyName, Articles.Name, Stock.Price
FROM Partners
INNER JOIN Stock ON Partners.PartnerID = Stock.PartnerID
INNER JOIN Articles ON Stock.ArticleID = Articles.ArticleID;

-- gebruik van left join om gegevens uit meerdere tabellen te combineren
SELECT Customers.FirstName, Customers.LastName, Orders.OrderDate
FROM Customers
LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID;

-- gebruik van right join om gegevens uit meerdere tabellen te combineren
SELECT Partners.CompanyName, Articles.Name, Stock.Price
FROM Partners
RIGHT JOIN Stock ON Partners.PartnerID = Stock.PartnerID
INNER JOIN Articles ON Stock.ArticleID = Articles.ArticleID;

-- gebruik van full outer join om gegevens uit meerdere tabellen te combineren
SELECT Customers.FirstName, Customers.LastName, Orders.OrderDate
FROM Customers
FULL OUTER JOIN Orders ON Customers.CustomerID = Orders.CustomerID;
-- FULL OUTER JOIN wordt niet ondersteund door MariaDB, maar kan worden nagebootst.
-- - De eerste SELECT-query gebruikt een LEFT JOIN om alle klanten te krijgen, inclusief degenen zonder overeenkomende orders.
-- De tweede SELECT-query gebruikt een RIGHT JOIN om alle orders op te halen, inclusief degenen zonder overeenkomende klanten.
-- Beide resultaten worden gecombineerd met UNION om een volledige outer join na te bootsen.
SELECT Customers.FirstName, Customers.LastName, Orders.OrderDate
FROM Customers
LEFT JOIN Orders
ON Customers.CustomerID = Orders.CustomerID
UNION
SELECT Customers.FirstName, Customers.LastName, Orders.OrderDate
FROM Customers
RIGHT JOIN Orders
ON Customers.CustomerID = Orders.CustomerID;








