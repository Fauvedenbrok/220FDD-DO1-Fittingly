DELIMITER $$
CREATE PROCEDURE SimulatePurchase()
BEGIN
    DECLARE available_stock INT;
    DECLARE order_id INT;
    -- Set the parameters for the purchase
    SET @ArticleID = 1001; 
    SET @PartnerID = 1;  
    SET @UserID = 123;     
    SET @new_quantity = 2; 
    -- Start the transaction
    START TRANSACTION;
    -- Step 1: Check if there is enough stock available for the purchase
    SELECT `QuantityOfStock` INTO available_stock
    FROM `Stock`
    WHERE `ArticleID` = @ArticleID AND `PartnerID` = @PartnerID;
    -- Step 2: If stock is sufficient, reduce the stock and record the purchase
    IF available_stock >= @new_quantity THEN
        -- Update the stock: reduce available stock
        UPDATE `Stock`
        SET `QuantityOfStock` = `QuantityOfStock` - @new_quantity
        WHERE `ArticleID` = @ArticleID AND `PartnerID` = @PartnerID;
        -- Insert into Orders (representing the purchase)
        INSERT INTO `Orders` (UserID, OrderDate)
        VALUES (@UserID, NOW());
        -- Get the last inserted OrderID for the new order
        SET order_id = LAST_INSERT_ID();
        -- Insert into OrderLine (representing the article purchased)
        INSERT INTO `OrderLine` (OrderID, ArticleID, Quantity)
        VALUES (order_id, @ArticleID, @new_quantity);
        -- Commit the transaction
        COMMIT;
        -- Return success message with OrderID
        SELECT 'Purchase successful' AS message, order_id AS OrderID;
    ELSE
        -- If stock is insufficient, rollback the transaction
        ROLLBACK;
        -- Return error message
        SELECT 'Not enough stock available' AS message;
    END IF;
END$$
DELIMITER ;



DELIMITER //

CREATE TRIGGER Customer_insert
AFTER INSERT ON `Customers`
FOR EACH ROW
BEGIN
   INSERT INTO `UserAccounts` (EmailAdres, Password, AccountStatus, AccountAccessRights, DateOfRegistration, CustomerID)
   VALUES (CONCAT(NEW.FirstName, '.', NEW.LastName, '@example.com'), 'hashedpassword', 1, 'Customer', CURDATE(), NEW.CustomerID);
END //

DELIMITER ;



DELIMITER $$

CREATE PROCEDURE CreateRandomCustomerAccount()
BEGIN
    DECLARE first_name VARCHAR(50);
    DECLARE last_name VARCHAR(50);
    DECLARE phone_number VARCHAR(12);
    DECLARE email_address VARCHAR(320);
    DECLARE password VARCHAR(255);
    DECLARE postal_code VARCHAR(10);
    DECLARE house_number VARCHAR(10);
    DECLARE street_name VARCHAR(60);
    DECLARE country VARCHAR(30);
    
    -- Step 1: Generate Random Customer Data
    SET first_name = CONCAT('First', FLOOR(1 + (RAND() * 1000)));
    SET last_name = CONCAT('Last', FLOOR(1 + (RAND() * 1000)));
    SET phone_number = CONCAT('06', FLOOR(100000000 + (RAND() * 900000000)));
    SET email_address = CONCAT(first_name, '.', last_name, '@example.com');
    SET password = CONCAT('secure', FLOOR(1000 + (RAND() * 9000)));
    SET postal_code = CONCAT(FLOOR(1000 + (RAND() * 9000)), 'BV');
    SET house_number = FLOOR(1 + (RAND() * 100));

    SET street_name = 'Random Street';  -- Fixed street name
    SET country = 'Nederland';          -- Fixed country
    
    -- Step 2: Insert the address into the 'addresses' table if not exists
    INSERT INTO `addresses` (`PostalCode`, `HouseNumber`, `StreetName`, `Country`)
    SELECT postal_code, house_number, street_name, country
    WHERE NOT EXISTS (
        SELECT 1 FROM `addresses` WHERE `PostalCode` = postal_code AND `HouseNumber` = house_number
    );
    
    -- Step 3: Insert the customer into the 'Customers' table
    INSERT INTO `Customers` (`FirstName`, `LastName`, `PhoneNumber`, `PostalCode`, `HouseNumber`)
    VALUES (first_name, last_name, phone_number, postal_code, house_number);
    
    -- Step 4: Get the newly created CustomerID
    SET @CustomerID = LAST_INSERT_ID();
    
    -- Step 5: Insert the user account
    INSERT INTO `UserAccounts` (`EmailAdres`, `Password`, `AccountStatus`, `AccountAccessRights`, `DateOfRegistration`, `CustomerID`)
    VALUES (email_address, CONCAT('\'', password, '\''), TRUE, 'Customer', CURDATE(), @CustomerID);

END $$

DELIMITER ;

