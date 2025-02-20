SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `House`;
DROP TABLE IF EXISTS `Salesperson`;
DROP TABLE IF EXISTS `HousePerSalesperson`;

SET  FOREIGN_KEY_CHECKS = 1;


CREATE TABLE `House` (
`StreetNumber` varchar(255),
`PostalCode` varchar(10),
`City` varchar(50),
`ConstructionYear` int,
`Price` int,
`NumberofRooms` int,

CONSTRAINT `HousePK`
    PRIMARY KEY (`PostalCode`, `StreetNumber`)
);


DROP TABLE IF EXISTS `Salesperson`;

CREATE TABLE `Salesperson`(
    `SalespersonID` INT AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(60),
    `Salary` DECIMAL(10,2)
    );

DROP TABLE IF EXISTS `HousePerSalesperson`;

CREATE TABLE `HousePerSalesperson`(
    `PostalCode` varchar(10),
    `StreetNumber` varchar(10),
    `SalespersonID` int,

    CONSTRAINT `House_Salesperson`
    PRIMARY KEY (`SalespersonID`, `StreetNumber`, `PostalCode`),

    CONSTRAINT `HouseFK`
    FOREIGN KEY (`PostalCode`, `StreetNumber`) REFERENCES `House` (`PostalCode`, `StreetNumber`)
    ON UPDATE RESTRICT
    ON DELETE CASCADE,

    CONSTRAINT `SalespersonFK`
    FOREIGN KEY (`SalespersonID`) REFERENCES `Salesperson` (`SalespersonID`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

INSERT INTO `House` (`StreetNumber`, `PostalCode`, `City`, `ConstructionYear`, `Price`, `NumberofRooms`) VALUES
('10A', '1234AB', 'Breda', 1823, 123000, 4),
('10B', '1235AB', 'Breda', 1823, 140000, 6);