ALTER TABLE `user` ADD `onetimepassword` VARCHAR(10) NOT NULL AFTER `user_type`;
ALTER TABLE `user` ADD `userprofilepicture` VARCHAR(50) NOT NULL AFTER `onetimepassword`;
ALTER TABLE `user` CHANGE `status` `status` SMALLINT(6) NOT NULL DEFAULT '0';
INSERT INTO `email_templates` (`pkEmailID`, `emailTitle`, `emailFromName`, `emailFromEmail`, `emailSubject`, `emailContent`, `emailDateAdded`, `emailDateUpdated`) VALUES (NULL, 'Reset Password Link', 'Tixilo', 'testingkumar111@gmail.com', 'Password Change Request || Tixilo', '<p>Dear {to_email},</p><p>We received a&nbsp;request to&nbsp;reset the&nbsp;password associated with this email address.</p><p><strong>If you made this request please click on below link to reset your password:</strong><br /><a href="{password_reset_link}" target="_blank">{password_reset_link}</a></p><p><br />Regards,<br />Tixilo</p>''', '2016-09-27 00:00:00', CURRENT_TIMESTAMP);
ALTER TABLE `bookings` CHANGE `extrakmintour` `extrakmintour` VARCHAR(20) NULL, CHANGE `extrahrintour` `extrahrintour` VARCHAR(20) NULL;
ALTER TABLE `user` ADD `userFullName` VARCHAR(128) NOT NULL AFTER `id`;

ALTER TABLE `user` ADD `userSocialID` VARCHAR(128) NOT NULL AFTER `userprofilepicture`;
ALTER TABLE `user` ADD `userSocialPartner` ENUM('facebook','google') NOT NULL AFTER `userSocialID`;


ALTER TABLE `bookings` ADD `startkm` FLOAT NOT NULL AFTER `mobileno`, ADD `startdatetime` DATETIME NOT NULL AFTER `startkm`, ADD `startlat` FLOAT NOT NULL AFTER `startdatetime`, ADD `startlong` FLOAT NOT NULL AFTER `startlat`;

ALTER TABLE `driverridedetail` CHANGE `status` `status` ENUM('Upcoming','completed','cancelled','process') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `bookings` ADD `bookingTimeType` ENUM('0','1') NOT NULL COMMENT '0=Half day and 1 = Full day' AFTER `bookingtype`;

ALTER TABLE `bookings` CHANGE `startlat` `pickuplat` FLOAT NOT NULL, CHANGE `startlong` `pickuplong` FLOAT NOT NULL;

ALTER TABLE `bookings` ADD `extraHourCost` FLOAT NOT NULL AFTER `extrahrintour`, ADD `extraKMCost` FLOAT NOT NULL AFTER `extraHourCost`;

ALTER TABLE `bookings` CHANGE `status` `status` ENUM('confirm','cancel','pending','process','completed') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending';

ALTER TABLE `bookings` ADD `droplat` FLOAT NOT NULL AFTER `pickuplong`, ADD `droplong` FLOAT NOT NULL AFTER `droplat`;

ALTER TABLE `bookings` CHANGE `status` `status` ENUM('confirm','cancelled','pending','process','completed') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending';

ALTER TABLE `bookings` ADD `cancelby` ENUM('user','driver') NULL DEFAULT NULL AFTER `cancelreason`;

ALTER TABLE `bookings` ADD `endkm` FLOAT NOT NULL AFTER `pickuplong`;

ALTER TABLE `bookings` ADD `enddatetime` DATETIME NOT NULL AFTER `endkm`;

ALTER TABLE `user` ADD `userHomeCity` INT(11) NOT NULL AFTER `userSocialPartner`, ADD `userCurrentCity` INT(11) NOT NULL AFTER `userHomeCity`;

ALTER TABLE `user` ADD `userDeviceToken` VARCHAR(256) NOT NULL AFTER `userCurrentCity`;

ALTER TABLE `vehiclerentals` ADD `outstationvehiclebasekm` INT(11) NOT NULL AFTER `outstationExtrakmcost`;

ALTER TABLE `bookings` CHANGE `tocities` `tocities` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `bookings` ADD `bookingBaseKM` INT(11) NOT NULL AFTER `bookingTimeType`;
ALTER TABLE `bookings` CHANGE `bookingBaseKM` `bookingBaseKM` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `vehiclerentals` ADD `nightCharge` FLOAT NOT NULL AFTER `outstationvehiclebasekm`;

ALTER TABLE `bookings` ADD `nightCharge` FLOAT NOT NULL AFTER `bookingBaseKM`;


ALTER TABLE `driverdutylog` CHANGE `driverdutylogStartTime` `driverdutylogStartTime` DATETIME NOT NULL, CHANGE `driverdutylogEndTime` `driverdutylogEndTime` DATETIME NOT NULL;

ALTER TABLE `bookings` ADD `assignedBY` INT(11) NOT NULL AFTER `merchant_commision`;


ALTER TABLE `bookings` CHANGE `tocities` `tocities` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `user` ADD `userlicensepicture` VARCHAR(128) NOT NULL AFTER `userprofilepicture`;
ALTER TABLE `user` ADD `userlicenseexpirydate` DATE NOT NULL AFTER `userlicensepicture`;

ALTER TABLE `user` ADD `vehiclemaster_id` INT(11) NOT NULL AFTER `userDeviceToken`;
ALTER TABLE `user` ADD `vehicle_id` INT(11) NOT NULL AFTER `vehiclemaster_id`;


ALTER TABLE `vehicles` ADD `vehicleRC` VARCHAR(128) NOT NULL AFTER `vehiclestatus`, ADD `vehicleInsurance` VARCHAR(128) NOT NULL AFTER `vehicleRC`;

ALTER TABLE vehicles DROP INDEX `name`
ALTER TABLE `vehicles` ADD `vehicleAddedeBy` INT(11) NOT NULL AFTER `vehicleDatecreated`;
ALTER TABLE `vehicles` ADD `vehicleNumber` VARCHAR(128) NOT NULL AFTER `vehicleInsurance`;


ALTER TABLE `vehicles` DROP `vehicleName`, DROP `vehicleImage`, DROP `vehicleCapicity`, DROP `vehicleDescription`, DROP `vehiclemaxpass`, DROP `vehiclemaxlugg`, DROP `vehicleorder`, DROP `vehicleIsPackage`;
ALTER TABLE `vehicles` DROP `vehicleacornot`;
ALTER TABLE `vehiclerentals` CHANGE `fkVehicleTypeID` `fkSubcategoryID` INT(11) NULL DEFAULT NULL;
ALTER TABLE `vehiclerentals` DROP `outstationHalfdaybasefair`, DROP `onewayHalfdaybasefair`;
ALTER TABLE `vehiclerentals` DROP `outstation_desc`, DROP `railwaystation_trf`, DROP `b2b_railwaystation_trf`, DROP `railwaystation_maxkm`, DROP `railwaystation_desc`, DROP `airport_trf`, DROP `b2b_airport_trf`, DROP `airport_maxkm`, DROP `airport_desc`, DROP `maxbookingoneday`, DROP `garage_airport`, DROP `garage_railway`;

ALTER TABLE `vehiclerentals` ADD `isAC` ENUM('Y','N') NOT NULL AFTER `driver_allowance`;
ALTER TABLE `vehicletypes` CHANGE `vehiclesname` `fkSubcategoryID` INT(11) NULL DEFAULT NULL;
ALTER TABLE `vehicles` ADD `vehicleManufactureYear` INT(11) NOT NULL AFTER `vehicleNumber`;

ALTER TABLE `vehicles` ADD `vehicleAllindiapermit` ENUM('0','1') NOT NULL AFTER `vehicleDateupdated`, ADD `vehicleAuthorisationValidity` DATE NOT NULL AFTER `vehicleAllindiapermit`, ADD `vehiclePermitValidity` DATE NOT NULL AFTER `vehicleAuthorisationValidity`, ADD `vehicleFCetificateValidity` DATE NOT NULL AFTER `vehiclePermitValidity`, ADD `vehicleInsuranceValidity` DATE NOT NULL AFTER `vehicleFCetificateValidity`;

ALTER TABLE `vehicles` ADD `vehicleRcertificateFront` VARCHAR(128) NOT NULL AFTER `vehicleInsuranceValidity`;

ALTER TABLE `vehicles` ADD `vehicleRcertificateBack` VARCHAR(128) NOT NULL AFTER `vehicleRcertificateFront`;

ALTER TABLE `user` CHANGE `userlicensepicture` `userLicenseFront` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, CHANGE `userlicenseexpirydate` `userlicenseValidity` DATE NOT NULL;

ALTER TABLE `user` ADD `userLicenseBack` VARCHAR(128) NOT NULL AFTER `userlicenseValidity`;

ALTER TABLE `user` ADD `userPoliceverification` ENUM('0','1') NOT NULL AFTER `userLicenseBack`, ADD `userPinnumber` VARCHAR(10) NOT NULL AFTER `userPoliceverification`, ADD `userAddress` TEXT NOT NULL AFTER `userPinnumber`;
ALTER TABLE `user` ADD `userlicensenumber` VARCHAR(50) NOT NULL AFTER `userprofilepicture`;

ALTER TABLE `user` ADD `userBatchnumber` VARCHAR(20) NOT NULL AFTER `userAddress`;

ALTER TABLE `user` ADD `userAlternatenumber` VARCHAR(20) NOT NULL AFTER `userBatchnumber`;

ALTER TABLE `user` CHANGE `userLicenseFront` `userLicenseFront` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, CHANGE `userLicenseBack` `userLicenseBack` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;4

ALTER TABLE `user` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `user` CHANGE `username` `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `user` DROP INDEX username;
ALTER TABLE `user` DROP INDEX email;

ALTER TABLE `vehicletypes` ADD `addedBY` INT(11) NOT NULL AFTER `status`;
ALTER TABLE `vehicles` DROP `vehicleRC`;

ALTER TABLE `vehicles` ADD `vehicleInsuranceImage` VARCHAR(128) NOT NULL AFTER `vehicleRcertificateBack`;
ALTER TABLE `vehicles` DROP `vehicleInsurance`;

ALTER TABLE `vehiclesubcategory` ADD `capacity` INT(11) NOT NULL AFTER `subcategoryName`;