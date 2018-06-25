SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP DATABASE IF EXISTS `minigrid_db`;
CREATE DATABASE  `minigrid_db` ;

USE `minigrid_db`;

DROP TABLE IF EXISTS `customer` ;
CREATE TABLE IF NOT EXISTS `customer` (
  `HouseID` VARCHAR(25) NOT NULL,
  `Password` VARCHAR(25) NOT NULL,
  `Name` VARCHAR(25) NOT NULL,
  `Address` VARCHAR(50) NOT NULL,
  `Phone` VARCHAR(20) NOT NULL,
  `OpenDate` DATE NOT NULL,
  `IfSell` VARCHAR(1) NOT NULL,
  `IfModify` VARCHAR(1) NOT NULL,
  `PrimaryLoad` FLOAT NOT NULL,
  `BatteryCapacity` FLOAT NOT NULL,
  `IP` VARCHAR(25) NOT NULL,
  `CompanyName` VARCHAR(50) NOT NULL,
  `Lv1rifq` INT NOT NULL,
  `Lv1rifp` FLOAT NOT NULL,
  `Lv1bulbq` INT NOT NULL,
  `Lv1bulbp` FLOAT NOT NULL,
  `Lv1phoneq` INT NOT NULL,
  `Lv1phonep` FLOAT NOT NULL,
  `Lv1mdq` INT NOT NULL,
  `Lv1mdp` FLOAT NOT NULL,
  `Lv1otherp` FLOAT NOT NULL,
  `Lv2bulbq` INT NOT NULL,
  `Lv2bulbp` FLOAT NOT NULL,
  `Lv2acq` INT NOT NULL,
  `Lv2acp` FLOAT NOT NULL,
  `Lv2heaterq` INT NOT NULL,
  `Lv2heaterp` FLOAT NOT NULL,
  `Lv2pcq` INT NOT NULL,
  `Lv2pcp` FLOAT NOT NULL,
  `Lv2otherp` FLOAT NOT NULL,
  `Lv2status` VARCHAR(1) NOT NULL,
  `Lv3status` VARCHAR(1) NOT NULL,
  `Bstatus` VARCHAR(1) NOT NULL,
  `Gstatus` VARCHAR(1) NOT NULL,
  `Alls` VARCHAR(1) NOT NULL,
  `CriticalBL` FLOAT NOT NULL,
  PRIMARY KEY (`HouseID`),
  FOREIGN KEY (`CompanyName`) REFERENCES company (`CompanyName`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `company` ;
CREATE TABLE IF NOT EXISTS `company` (
  `CompanyName` VARCHAR(50) NOT NULL,
  `CompanyID` VARCHAR(25) NOT NULL,
  `SellFee` Float(6,3) NOT NULL,
  `F0` Float(6,3) NOT NULL,
  `F1` Float(6,3) NOT NULL,
  `F2` Float(6,3) NOT NULL,
  `F3` Float(6,3) NOT NULL,
  `F4` Float(6,3) NOT NULL,
  `F5` Float(6,3) NOT NULL,
  `F6` Float(6,3) NOT NULL,
  `F7` Float(6,3) NOT NULL,
  `F8` Float(6,3) NOT NULL,
  `F9` Float(6,3) NOT NULL,
  `F10` Float(6,3) NOT NULL,
  `F11` Float(6,3) NOT NULL,
  `F12` Float(6,3) NOT NULL,
  `F13` Float(6,3) NOT NULL,
  `F14` Float(6,3) NOT NULL,
  `F15` Float(6,3) NOT NULL,
  `F16` Float(6,3) NOT NULL,
  `F17` Float(6,3) NOT NULL,
  `F18` Float(6,3) NOT NULL,
  `F19` Float(6,3) NOT NULL,
  `F20` Float(6,3) NOT NULL,
  `F21` Float(6,3) NOT NULL,
  `F22` Float(6,3) NOT NULL,
  `F23` Float(6,3) NOT NULL,
  `T0` Float(6,3) NOT NULL,
  `T1` Float(6,3) NOT NULL,
  `T2` Float(6,3) NOT NULL,
  `T3` Float(6,3) NOT NULL,
  `T4` Float(6,3) NOT NULL,
  `T5` Float(6,3) NOT NULL,
  `T6` Float(6,3) NOT NULL,
  `T7` Float(6,3) NOT NULL,
  `T8` Float(6,3) NOT NULL,
  `T9` Float(6,3) NOT NULL,
  `T10` Float(6,3) NOT NULL,
  `T11` Float(6,3) NOT NULL,
  `T12` Float(6,3) NOT NULL,
  `T13` Float(6,3) NOT NULL,
  `T14` Float(6,3) NOT NULL,
  `T15` Float(6,3) NOT NULL,
  `T16` Float(6,3) NOT NULL,
  `T17` Float(6,3) NOT NULL,
  `T18` Float(6,3) NOT NULL,
  `T19` Float(6,3) NOT NULL,
  `T20` Float(6,3) NOT NULL,
  `T21` Float(6,3) NOT NULL,
  `T22` Float(6,3) NOT NULL,
  `T23` Float(6,3) NOT NULL,
  PRIMARY KEY (`CompanyName`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `staff` ;
CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` VARCHAR(25) NOT NULL,
  `Password` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`StaffID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


DROP TABLE IF EXISTS `detailusage1` ;
CREATE TABLE IF NOT EXISTS `detailusage1` (
  `TimePointNumber` INT NOT NULL,
  `PowerBuy` FLOAT(10,3) NOT NULL,
  `PowerSell` FLOAT(10,3) NOT NULL,
  `BatteryLevel` FLOAT(10,3) NOT NULL,
  `ElectricityFee` FLOAT(10,3) NOT NULL,
  `SavedMoney` FLOAT(10,3) NOT NULL,
  PRIMARY KEY (`TimePointNumber`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `detailusage2` ;
CREATE TABLE IF NOT EXISTS `detailusage2` (
  `TimePointNumber` INT NOT NULL,
  `PowerBuy` FLOAT(10,3) NOT NULL,
  `PowerSell` FLOAT(10,3) NOT NULL,
  `BatteryLevel` FLOAT(10,3) NOT NULL,
  `ElectricityFee` FLOAT(10,3) NOT NULL,
  `SavedMoney` FLOAT(10,3) NOT NULL,
  PRIMARY KEY (`TimePointNumber`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `monthlyusage` ;
CREATE TABLE IF NOT EXISTS `monthlyusage` (
  `HouseID` VARCHAR(25) NOT NULL,
  `Year` INT NOT NULL,
  `Month` INT NOT NULL,
  `UsagePerMonth` FLOAT(10,3) NOT NULL,
  `SelloutPerMonth` FLOAT(10,3) NOT NULL,
  `FeePerMonth` FLOAT(10,3) NOT NULL,
  `SavedMoney` FLOAT(10,3) NOT NULL,
  PRIMARY KEY (`HouseID`,`Year`,`Month`),
  FOREIGN KEY (`HouseID`) REFERENCES customer (`HouseID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
