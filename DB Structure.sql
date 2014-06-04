
CREATE TABLE IF NOT EXISTS `campaign` (
  `campaignID` varchar(15) NOT NULL,
  `campaign` text NOT NULL,
  PRIMARY KEY (`campaignID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `adgroup` (
  `adgroupID` varchar(15) NOT NULL,
  `campaignID` varchar(15) NOT NULL,
  `adgroup` text NOT NULL,
  PRIMARY KEY (`adgroupID`),
  KEY `campaignID` (`campaignID`),
  KEY `campaignID_2` (`campaignID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `keywords` (
  `keywordID` varchar(15) NOT NULL,
  `adgroupID` varchar(15) NOT NULL,
  `keyword` text NOT NULL,
  `clicks` text NOT NULL,
  `cost` text NOT NULL,
  `impressions` text NOT NULL,
  KEY `adgroupID` (`adgroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `adgroup`
  ADD CONSTRAINT `campaignFK` FOREIGN KEY (`campaignID`) REFERENCES `campaign` (`campaignID`);


ALTER TABLE `keywords`
  ADD CONSTRAINT `adgroupFK` FOREIGN KEY (`adgroupID`) REFERENCES `adgroup` (`adgroupID`);
