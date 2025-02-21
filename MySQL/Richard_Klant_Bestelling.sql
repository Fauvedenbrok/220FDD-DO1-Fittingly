SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Adres`;
DROP TABLE IF EXISTS `Partner`;
DROP TABLE IF EXISTS `Article`;
DROP TABLE IF EXISTS `UserAccount`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `UserAccount` (
    `EmailAdres` VARCHAR(100) PRIMARY KEY,
    `Password` VARCHAR(100) NOT NULL,
    `AccountStatus` BOOLEAN DEFAULT 1,
    `AccountAccessRights` BOOLEAN DEFAULT 0,
    `RegistrationDate` DATE NOT NULL
);

CREATE TABLE `Article` (
    `ArticleID` INT AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(20) NOT NULL,
    `Size` VARCHAR(100),
    `Weight` VARCHAR(100),
    `Price` DECIMAL(10,2) NOT NULL CHECK (`Price` >= 0)
);

CREATE TABLE `Partner` (
    `PartnerID` INT AUTO_INCREMENT PRIMARY KEY,
    `BrandName` VARCHAR(25) NOT NULL
);

CREATE TABLE `Adres` (
    `StreetName` VARCHAR(60) NOT NULL,
    `ZipCode` VARCHAR(20) NOT NULL,
    `HouseNumber` VARCHAR(20) NOT NULL,
    `Country` VARCHAR(20) NOT NULL,

    CONSTRAINT `PKAdres`
    PRIMARY KEY (`StreetName`, `ZipCode`, `HouseNumber`, `Country`)
);

CREATE TABLE `Order` (
    `OrderID` INT AUTO_INCREMENT PRIMARY KEY,
    `StartDatumReservering` DATE NOT NULL,
    `EindDatumReservering` DATE NOT NULL,
    `Aantal` INT NOT NULL CHECK (`Aantal` > 0),
    `ArticleID` INT NOT NULL,
    `PartnerID` INT NOT NULL,
    `EmailAdres` VARCHAR(100) NOT NULL,

    CONSTRAINT `CHK_Datum` CHECK (`EindDatumReservering` > `StartDatumReservering`),

    FOREIGN KEY (`ArticleID`) REFERENCES `Article` (`ArticleID`) ON DELETE CASCADE,
    FOREIGN KEY (`PartnerID`) REFERENCES `Partner` (`PartnerID`) ON DELETE CASCADE,
    FOREIGN KEY (`EmailAdres`) REFERENCES `UserAccount` (`EmailAdres`) ON DELETE CASCADE
);





INSERT INTO `UserAccount` (`EmailAdres`, `Password`, `AccountStatus`, `AccountAccessRights`, `RegistrationDate`) VALUES
('daan.vanveen@example.com', 'securepass123', 1, 1, '2023-04-21'),
('emma.jansen@example.com', 'pass456', 1, 0, '2023-08-12'),
('noah.devries@example.com', 'qwerty789', 1, 1, '2022-11-30'),
('sophie.bakker@example.com', 'welcome123', 1, 0, '2024-01-05'),
('milan.koning@example.com', 'testpass456', 1, 1, '2023-06-18'),
('lisa.vandermeer@example.com', 'mypassword789', 1, 0, '2022-09-14');


INSERT INTO `Article` (`Name`, `Size`, `Weight`, `Price`) VALUES
('Smoking', 'M', '1.5kg', 110.00),
('Avondjurk', 'S', '1.2kg', 85.50),
('Bruidsjurk', 'L', '2.8kg', 275.00),
('Cocktailjurk', 'M', '1.0kg', 95.00),
('Pak', 'XL', '2.0kg', 150.00),
('Gala jurk', 'S', '1.3kg', 120.00);


INSERT INTO `Partner` (`BrandName`) VALUES
('DutchRentals'),
('GlamourNL'),
('HollandFashion'),
('RoyalWear'),
('EliteClothing'),
('LuxeHuren');


INSERT INTO `Adres` (`StreetName`, `ZipCode`, `HouseNumber`, `Country`) VALUES
('Kalverstraat', '1012NX', '15A', 'Netherlands'),
('Damrak', '1012LG', '22B', 'Netherlands'),
('Leidsestraat', '1017PA', '7C', 'Netherlands'),
('Coolsingel', '3011AD', '45D', 'Netherlands'),
('Grote Markt', '2511BG', '12E', 'Netherlands'),
('Brabantdam', '5611AM', '9F', 'Netherlands');


INSERT INTO `Order` (`StartDatumReservering`, `EindDatumReservering`, `Aantal`, `ArticleID`, `PartnerID`, `EmailAdres`) VALUES
('2024-05-10', '2024-05-17', 1, 1, 1, 'daan.vanveen@example.com'),
('2024-06-12', '2024-06-19', 2, 2, 2, 'emma.jansen@example.com'),
('2024-07-01', '2024-07-08', 1, 3, 3, 'noah.devries@example.com'),
('2024-08-15', '2024-08-22', 3, 4, 4, 'sophie.bakker@example.com'),
('2024-09-05', '2024-09-12', 1, 5, 5, 'milan.koning@example.com'),
('2024-10-20', '2024-10-27', 2, 6, 6, 'lisa.vandermeer@example.com');
