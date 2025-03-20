-- CREATE TABLE Users (
--     first_name VARCHAR(30) NOT NULL,
--     last_name VARCHAR (50) NOT NULL,
--     email VARCHAR (100) NOT NULL PRIMARY KEY,
--     user_password VARCHAR(255) NOT NULL,
--     created_at DATETIME NOT NULL  DEFAULT CURRENT_TIME
-- );

CREATE TABLE User_Accounts (
        `First_Name` VARCHAR(30) NOT NULL,
        `Last_Name` VARCHAR (50) NOT NULL,
        `User_Password` VARCHAR(255) NOT NULL,
        `Email_Adres` VARCHAR(320) PRIMARY KEY,
        `Password` VARCHAR(255) NOT NULL,
        `Account_Status` BOOLEAN DEFAULT 0,
        `Account_Access_Rights` ENUM ('Customer', 'Partner', 'Admin'),
        `Date_of_Registration` DATE,
        `Partner_ID` INT,
        `Customer_ID` INT,
        `Created_At` DATETIME NOT NULL  DEFAULT CURRENT_TIME,
        CONSTRAINT `FK_UserAccount` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`) ,
        CONSTRAINT `FK_UserAccount_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`) ,
    );

ALTER TABLE Users
DROP PRIMARY KEY
ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST;



CREATE TABLE
    `UserAccounts` (
        `EmailAdres` VARCHAR(320) PRIMARY KEY,
        `Password` VARCHAR(255) NOT NULL,
        `AccountStatus` BOOLEAN DEFAULT 0,
        `AccountAccessRights` ENUM ('Customer', 'Partner', 'Admin'),
        `DateOfRegistration` DATE,
        `PartnerID` INT,
        `CustomerID` INT,
        CONSTRAINT `FK_UserAccount` FOREIGN KEY (`PartnerID`) REFERENCES `Partners` (`PartnerID`) ,
        CONSTRAINT `FK_UserAccount_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`) ,
    );