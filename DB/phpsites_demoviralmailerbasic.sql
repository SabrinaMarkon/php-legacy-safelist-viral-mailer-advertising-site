-- MySQL dump 10.13  Distrib 5.5.40, for Linux (x86_64)
--
-- Host: localhost    Database: phpsites_demoviralmailerbasic
-- ------------------------------------------------------
-- Server version	5.5.40-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adminemail_saved`
--

DROP TABLE IF EXISTS `adminemail_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminemail_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `sendtopaid` varchar(4) NOT NULL DEFAULT 'no',
  `sendtofree` varchar(4) NOT NULL DEFAULT 'no',
  `sendtouserid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminemail_saved`
--

LOCK TABLES `adminemail_saved` WRITE;
/*!40000 ALTER TABLE `adminemail_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminemail_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminemails`
--

DROP TABLE IF EXISTS `adminemails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminemails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `clicks` int(10) unsigned NOT NULL,
  `sent` tinyint(4) NOT NULL,
  `datesent` int(10) unsigned NOT NULL,
  `sendtopaid` varchar(4) NOT NULL DEFAULT 'no',
  `sendtofree` varchar(4) NOT NULL DEFAULT 'no',
  `sendtouserid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminemails`
--

LOCK TABLES `adminemails` WRITE;
/*!40000 ALTER TABLE `adminemails` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminemails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminemails_viewed`
--

DROP TABLE IF EXISTS `adminemails_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminemails_viewed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adid` int(10) unsigned NOT NULL,
  `userid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminemails_viewed`
--

LOCK TABLES `adminemails_viewed` WRITE;
/*!40000 ALTER TABLE `adminemails_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminemails_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminnavigation`
--

DROP TABLE IF EXISTS `adminnavigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminnavigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adminnavtitle` varchar(255) NOT NULL,
  `adminnavurl` varchar(255) NOT NULL,
  `adminnavwindow` varchar(255) NOT NULL DEFAULT '_top',
  `adminnavenabled` varchar(4) NOT NULL DEFAULT 'yes',
  `adminnavsequence` int(10) unsigned NOT NULL,
  `adminnavcategory` varchar(255) NOT NULL DEFAULT 'MAIN',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminnavigation`
--

LOCK TABLES `adminnavigation` WRITE;
/*!40000 ALTER TABLE `adminnavigation` DISABLE KEYS */;
INSERT INTO `adminnavigation` (`id`, `adminnavtitle`, `adminnavurl`, `adminnavwindow`, `adminnavenabled`, `adminnavsequence`, `adminnavcategory`) VALUES (1,'EDIT ADMIN NAVIGATION','editadminnavigation.php','_top','yes',30,'MAIN'),(2,'EDIT MEMBER NAVIGATION','editmembernavigation.php','_top','yes',29,'MAIN'),(3,'MAIN SITE','http://demoviralmailerbasic.phpsitescripts.com','_blank','yes',1,'MAIN'),(4,'ADMIN MAIN','controlpanel.php','_top','yes',2,'MAIN'),(5,'SITE SETTINGS','sitecontrol.php','_top','yes',3,'MAIN'),(6,'TRANSACTIONS','transactions.php','_top','yes',6,'MAIN'),(7,'EMAIL MEMBERS','contactmembers.php','_top','yes',8,'MAIN'),(8,'MEMBER ACCOUNTS','membercontrol.php','_top','yes',9,'MAIN'),(9,'MEMBER SUPPORT','http://e-webs.us/helpdesk','_blank','yes',11,'MAIN'),(10,'ADD ADS TO MEMBERS','addads.php','_top','yes',12,'MAIN'),(11,'APPROVE ADS','approveads.php','_top','yes',13,'MAIN'),(12,'VIEW ADS','viewads.php','_top','yes',14,'MAIN'),(13,'EDIT PAGE HTML','editpages.php','_top','yes',27,'MAIN'),(14,'EDIT PROMOTIONAL ADS','editpromotional.php','_top','yes',26,'MAIN'),(15,'LOG OUT','index.php','_top','yes',33,'MAIN'),(16,'EMAIL SIGNUP FILTER','signupemailcontrol.php','_top','yes',5,'MAIN'),(17,'CASH OUT REQUESTS','cashoutrequests.php','_top','yes',7,'MAIN'),(18,'AD PACKS','adpacks_admin.php','_top','yes',4,'MAIN'),(19,'MEMBER E-WALLETS','ewalletcontrol.php','_top','yes',10,'MAIN'),(20,'MEMBER TESTIMONIALS','testimonialsview.php','_top','yes',31,'MAIN'),(21,'SITE STATS','sitestats.php','_top','yes',32,'MAIN'),(22,'EDIT LAYOUT FILES','editlayout.php','_top','yes',28,'MAIN'),(23,'SPONSOR LEADER BOARD','leaderboardadmin.php','_top','yes',15,'MAIN'),(24,'SITE GRAPHICS CONTROL','graphicscontrol.php','_top','yes',34,'MAIN'),(25,'SPECIAL OFFERS ADMIN','offerpages_admin.php','_top','yes',17,'MAIN'),(26,'MEMBER BONUSES','bonuses_admin.php','_top','yes',35,'MAIN'),(27,'SELL EXTRA ADVERTISING','advertisingtosell.php','_top','yes',30,'MAIN'),(28,'ADMIN PROMO CODES','promo_code_admin.php','_top','yes',30,'MAIN'),(29,'BOUNCE VIEWER','bounce_viewer.php','_top','yes',30,'MAIN');
/*!40000 ALTER TABLE `adminnavigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminnotes`
--

DROP TABLE IF EXISTS `adminnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminnotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '',
  `htmlcode` longtext NOT NULL,
  KEY `index` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminnotes`
--

LOCK TABLES `adminnotes` WRITE;
/*!40000 ALTER TABLE `adminnotes` DISABLE KEYS */;
INSERT INTO `adminnotes` (`id`, `name`, `htmlcode`) VALUES (1,'Admin Notes','');
/*!40000 ALTER TABLE `adminnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminpromotional`
--

DROP TABLE IF EXISTS `adminpromotional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminpromotional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'banner',
  `promotionalimage` varchar(255) NOT NULL,
  `promotionalsubject` varchar(255) NOT NULL,
  `promotionaladbody` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminpromotional`
--

LOCK TABLES `adminpromotional` WRITE;
/*!40000 ALTER TABLE `adminpromotional` DISABLE KEYS */;
/*!40000 ALTER TABLE `adminpromotional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminsettings`
--

DROP TABLE IF EXISTS `adminsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminsettings` (
  `name` varchar(255) NOT NULL,
  `setting` varchar(255) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminsettings`
--

LOCK TABLES `adminsettings` WRITE;
/*!40000 ALTER TABLE `adminsettings` DISABLE KEYS */;
INSERT INTO `adminsettings` (`name`, `setting`) VALUES ('row1','x'),('adminuserid','Admin'),('adminpassword','admin'),('adminmemberuserid','programmer_account'),('adminname','Sabrina'),('domain','http://demoviralmailerbasic.phpsitescripts.com'),('sitename','DEMO Viral Mailer & Advertising Basic Version Script'),('adminemail','YOUR ADMIN SUPPORT EMAIL'),('egopay_store_id','EGOPAY STORE ID'),('egopay_store_password','EGOPAY STORE PASSWORD'),('adminpayza','YOUR ADMIN PAYZA EMAIL'),('adminpayzaseccode','YOUR ADMIN PAYZA SECCODE'),('adminperfectmoney','CHANGE TO YOUR PERFECT MONEY ACCOUNT'),('adminperfectmoneyalternatepassphrase','CHANGE TO YOUR PERFECT MONEY ALTERNATE PASSPHRASE'),('adminokpay','CHANGE TO YOUR OKAPAY ACCOUNT'),('adminsolidtrustpay','CHANGE TO YOUR SOLID TRUST PAY USERNAME'),('adminpaypal','payments@pearlsofwealth.com'),('emailsignupmethod','denyallexcept'),('joinprice','30.00'),('joinpriceinterval','Monthly'),('testimonialgroupmax','10'),('testimonialrotateorgroup','group'),('testimonialphotopath','/home/phpsites/public_html/demos/demoviralmailerbasic/photos/'),('paymentprocessorfeetoadd','10'),('ewalletname','E-Wallet'),('ewalletfundingincrement','3.00'),('ewalletfundinghowmanyincrements','10'),('minimumpayout','20.00'),('minimumewalletbalancetowithdraw','20.00'),('maximumpercentageofewalletthatcanbewithdrawnascash','80'),('soloprice','3.95'),('solotimer','10'),('memberhoursbetweensoloposts','24'),('solosaveadsfree','1'),('solosaveadspaid','5'),('textadprice','1.50'),('textadmaxviews','3000'),('textadtimer','10'),('textadsaveadsfree','1'),('textadsaveadspaid','5'),('bannermaxviews','3000'),('bannerprice','1.50'),('bannertimer','10'),('bannersaveadsfree','1'),('bannersaveadspaid','5'),('buttonmaxviews','3000'),('buttonprice','1.50'),('buttontimer','10'),('buttonsaveadsfree','1'),('buttonsaveadspaid','5'),('adpackprice','25.00'),('payoutegopay','yes'),('payoutpayza','yes'),('payoutperfectmoney','yes'),('payoutokpay','yes'),('payoutsolidtrustpay','yes'),('payoutpaypal','yes'),('adminemailtimer','10'),('howoftensponsorscanmailreferrals','24'),('enablecreditssystem','yes'),('adminemailscreditsfree','20'),('adminemailscreditspaid','100'),('soloscreditsfree','20'),('soloscreditspaid','100'),('creditsoloscreditsfree','20'),('creditsoloscreditspaid','100'),('bannerscreditsfree','20'),('bannerscreditspaid','100'),('buttonscreditsfree','20'),('buttonscreditspaid','100'),('textadscreditsfree','20'),('textadscreditspaid','100'),('creditspriceperlot','5.00'),('creditshowmanyperlot','1000'),('creditshowmanylots','10'),('creditcommissionfree','1'),('creditcommissionpaid','1'),('soloscreditstradefree','2000'),('soloscreditstradepaid','500'),('bannerscreditstradefree','2000'),('bannerscreditstradepaid','500'),('buttonscreditstradefree','2000'),('buttonscreditstradepaid','500'),('textadscreditstradefree','2000'),('textadscreditstradepaid','500'),('adpackscreditstradefree','10000'),('adpackscreditstradepaid','5000'),('enableautodowngrade','no'),('autodowngradeafterhowmanydayslatepay','7'),('solocommissionfree','0.00'),('solocommissionpaid','0.00'),('bannercommissionfree','0.00'),('bannercommissionpaid','0.00'),('buttoncommissionfree','0.00'),('buttoncommissionpaid','0.00'),('textadcommissionfree','0.00'),('textadcommissionpaid','0.00'),('adpackcommissionfree','0.00'),('adpackcommissionpaid','0.00'),('creditsolotimer','10'),('memberhoursbetweencreditsolopostsfree','72'),('memberhoursbetweencreditsolopostspaid','24'),('creditsolosaveadsfree','1'),('creditsolosaveadspaid','5'),('creditsolomaxrecipientsfree','100'),('creditsolomaxrecipientspaid','500'),('level1name','Free'),('level2name','Upgraded'),('enableautoapprove','no'),('fullloginadprice','1.50'),('fullloginadmaxviews','100'),('fullloginadtimer','10'),('fullloginadsaveadsfree','1'),('fullloginadsaveadspaid','5'),('fullloginadscreditsfree','20'),('fullloginadscreditspaid','100'),('fullloginadscreditstradefree','2000'),('fullloginadscreditstradepaid','500'),('fullloginadcommissionfree','0.00'),('fullloginadcommissionpaid','0.00'),('bounceemail','bounce@phpsitescripts.com'),('bouncesmax','5'),('showmembercount','yes'),('turingkeyenable','yes'),('editpageshtmleditor','yes');
/*!40000 ALTER TABLE `adminsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adpacks`
--

DROP TABLE IF EXISTS `adpacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adpacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `howmanytimeschosen` int(10) unsigned NOT NULL DEFAULT '0',
  `enable` varchar(4) NOT NULL DEFAULT 'no',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `solo_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_views` int(10) unsigned NOT NULL DEFAULT '0',
  `button_num` int(10) unsigned NOT NULL DEFAULT '0',
  `button_views` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_views` int(10) unsigned NOT NULL DEFAULT '0',
  `upgrade` varchar(4) NOT NULL DEFAULT 'no',
  `fullloginad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adpacks`
--

LOCK TABLES `adpacks` WRITE;
/*!40000 ALTER TABLE `adpacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `adpacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertisingforsale`
--

DROP TABLE IF EXISTS `advertisingforsale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisingforsale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `howmany` int(10) unsigned NOT NULL DEFAULT '1',
  `max` int(10) unsigned NOT NULL DEFAULT '100',
  `price` decimal(9,2) NOT NULL DEFAULT '10.00',
  `creditsprice` int(10) unsigned NOT NULL,
  `commissionfree` int(10) unsigned NOT NULL DEFAULT '0',
  `commissionpaid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisingforsale`
--

LOCK TABLES `advertisingforsale` WRITE;
/*!40000 ALTER TABLE `advertisingforsale` DISABLE KEYS */;
/*!40000 ALTER TABLE `advertisingforsale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertisingtypes`
--

DROP TABLE IF EXISTS `advertisingtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisingtypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisingtypes`
--

LOCK TABLES `advertisingtypes` WRITE;
/*!40000 ALTER TABLE `advertisingtypes` DISABLE KEYS */;
INSERT INTO `advertisingtypes` (`id`, `adtype`) VALUES (1,'Credits'),(2,'Solos'),(3,'Banners'),(4,'Buttons'),(5,'Text Ads');
/*!40000 ALTER TABLE `advertisingtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `bannerurl` varchar(100) NOT NULL DEFAULT '',
  `targeturl` varchar(70) NOT NULL DEFAULT '',
  `userid` varchar(20) NOT NULL DEFAULT '',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `clicks` int(10) unsigned NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `added` tinyint(4) NOT NULL DEFAULT '0',
  `purchase` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` (`id`, `name`, `bannerurl`, `targeturl`, `userid`, `approved`, `hits`, `clicks`, `max`, `added`, `purchase`) VALUES (1,'','','','grqinc',0,0,0,3000,0,1409940169),(2,'','','','grqinc',0,0,0,3000,0,1409940169),(3,'','','','grqinc',0,0,0,3000,0,1409940169),(4,'','','','grqinc',0,0,0,3000,0,1409940169);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners_saved`
--

DROP TABLE IF EXISTS `banners_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `bannerurl` varchar(255) NOT NULL DEFAULT '',
  `targeturl` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners_saved`
--

LOCK TABLES `banners_saved` WRITE;
/*!40000 ALTER TABLE `banners_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bannerviews`
--

DROP TABLE IF EXISTS `bannerviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bannerviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(30) NOT NULL DEFAULT '',
  `blid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `blid` (`blid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bannerviews`
--

LOCK TABLES `bannerviews` WRITE;
/*!40000 ALTER TABLE `bannerviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `bannerviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonuses`
--

DROP TABLE IF EXISTS `bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bonusname` varchar(255) NOT NULL,
  `bonustype` varchar(255) NOT NULL DEFAULT 'Sign-Up',
  `bonusfree` varchar(4) NOT NULL DEFAULT 'yes',
  `bonuspaid` varchar(4) NOT NULL DEFAULT 'yes',
  `enable` varchar(4) NOT NULL DEFAULT 'no',
  `howmanytimesgiven` int(10) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `solo_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_views` int(10) unsigned NOT NULL DEFAULT '0',
  `button_num` int(10) unsigned NOT NULL DEFAULT '0',
  `button_views` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_views` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonuses`
--

LOCK TABLES `bonuses` WRITE;
/*!40000 ALTER TABLE `bonuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bounces`
--

DROP TABLE IF EXISTS `bounces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bounces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bounceerror` longtext NOT NULL,
  `bouncedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bounces`
--

LOCK TABLES `bounces` WRITE;
/*!40000 ALTER TABLE `bounces` DISABLE KEYS */;
/*!40000 ALTER TABLE `bounces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buttons`
--

DROP TABLE IF EXISTS `buttons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `bannerurl` varchar(100) NOT NULL DEFAULT '',
  `targeturl` varchar(70) NOT NULL DEFAULT '',
  `userid` varchar(20) NOT NULL DEFAULT '',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `clicks` int(10) unsigned NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `added` tinyint(4) NOT NULL DEFAULT '0',
  `purchase` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buttons`
--

LOCK TABLES `buttons` WRITE;
/*!40000 ALTER TABLE `buttons` DISABLE KEYS */;
/*!40000 ALTER TABLE `buttons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buttons_saved`
--

DROP TABLE IF EXISTS `buttons_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buttons_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `bannerurl` varchar(255) NOT NULL DEFAULT '',
  `targeturl` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buttons_saved`
--

LOCK TABLES `buttons_saved` WRITE;
/*!40000 ALTER TABLE `buttons_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `buttons_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buttonviews`
--

DROP TABLE IF EXISTS `buttonviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buttonviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(30) NOT NULL DEFAULT '',
  `blid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `blid` (`blid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buttonviews`
--

LOCK TABLES `buttonviews` WRITE;
/*!40000 ALTER TABLE `buttonviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `buttonviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cashoutrequests`
--

DROP TABLE IF EXISTS `cashoutrequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cashoutrequests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `egopay` varchar(255) NOT NULL,
  `payza` varchar(255) NOT NULL,
  `perfectmoney` varchar(255) NOT NULL,
  `okpay` varchar(255) NOT NULL,
  `solidtrustpay` varchar(255) NOT NULL,
  `paypal` varchar(255) NOT NULL,
  `amountrequested` decimal(9,2) NOT NULL DEFAULT '0.00',
  `daterequested` datetime NOT NULL,
  `paid` decimal(9,2) NOT NULL,
  `lastpaid` datetime NOT NULL,
  `preferredpaymentprocessor` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashoutrequests`
--

LOCK TABLES `cashoutrequests` WRITE;
/*!40000 ALTER TABLE `cashoutrequests` DISABLE KEYS */;
/*!40000 ALTER TABLE `cashoutrequests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) NOT NULL DEFAULT '',
  `iso_code2` char(2) NOT NULL DEFAULT '',
  `iso_code3` char(3) NOT NULL DEFAULT '',
  `reserved1` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`),
  KEY `IDX_COUNTRIES_NAME` (`country_name`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`country_id`, `country_name`, `iso_code2`, `iso_code3`, `reserved1`) VALUES (1,'Afghanistan','AF','AFG',0),(2,'Albania','AL','ALB',0),(3,'Algeria','DZ','DZA',0),(4,'American Samoa','AS','ASM',0),(5,'Andorra','AD','AND',0),(6,'Angola','AO','AGO',0),(7,'Anguilla','AI','AIA',0),(8,'Antarctica','AQ','ATA',0),(9,'Antigua and Barbuda','AG','ATG',0),(10,'Argentina','AR','ARG',0),(11,'Armenia','AM','ARM',0),(12,'Aruba','AW','ABW',0),(13,'Australia','AU','AUS',0),(14,'Austria','AT','AUT',0),(15,'Azerbaijan','AZ','AZE',0),(16,'Bahamas','BS','BHS',0),(17,'Bahrain','BH','BHR',0),(18,'Bangladesh','BD','BGD',0),(19,'Barbados','BB','BRB',0),(20,'Belarus','BY','BLR',0),(21,'Belgium','BE','BEL',0),(22,'Belize','BZ','BLZ',0),(23,'Benin','BJ','BEN',0),(24,'Bermuda','BM','BMU',0),(25,'Bhutan','BT','BTN',0),(26,'Bolivia','BO','BOL',0),(27,'Bosnia and Herzegowina','BA','BIH',0),(28,'Botswana','BW','BWA',0),(29,'Bouvet Island','BV','BVT',0),(30,'Brazil','BR','BRA',0),(31,'British Indian Ocean Territory','IO','IOT',0),(32,'Brunei Darussalam','BN','BRN',0),(33,'Bulgaria','BG','BGR',0),(34,'Burkina Faso','BF','BFA',0),(35,'Burundi','BI','BDI',0),(36,'Cambodia','KH','KHM',0),(37,'Cameroon','CM','CMR',0),(38,'Canada','CA','CAN',0),(39,'Cape Verde','CV','CPV',0),(40,'Cayman Islands','KY','CYM',0),(41,'Central African Republic','CF','CAF',0),(42,'Chad','TD','TCD',0),(43,'Chile','CL','CHL',0),(44,'China','CN','CHN',0),(45,'Christmas Island','CX','CXR',0),(46,'Cocos (Keeling) Islands','CC','CCK',0),(47,'Colombia','CO','COL',0),(48,'Comoros','KM','COM',0),(49,'Congo','CG','COG',0),(50,'Cook Islands','CK','COK',0),(51,'Costa Rica','CR','CRI',0),(52,'Cote D\'Ivoire','CI','CIV',0),(53,'Croatia','HR','HRV',0),(54,'Cuba','CU','CUB',0),(55,'Cyprus','CY','CYP',0),(56,'Czech Republic','CZ','CZE',0),(57,'Denmark','DK','DNK',0),(58,'Djibouti','DJ','DJI',0),(59,'Dominica','DM','DMA',0),(60,'Dominican Republic','DO','DOM',0),(61,'East Timor','TP','TMP',0),(62,'Ecuador','EC','ECU',0),(63,'Egypt','EG','EGY',0),(64,'El Salvador','SV','SLV',0),(65,'Equatorial Guinea','GQ','GNQ',0),(66,'Eritrea','ER','ERI',0),(67,'Estonia','EE','EST',0),(68,'Ethiopia','ET','ETH',0),(69,'Falkland Islands (Malvinas)','FK','FLK',0),(70,'Faroe Islands','FO','FRO',0),(71,'Fiji','FJ','FJI',0),(72,'Finland','FI','FIN',0),(73,'France','FR','FRA',0),(74,'France, Metropolitan','FX','FXX',0),(75,'French Guiana','GF','GUF',0),(76,'French Polynesia','PF','PYF',0),(77,'French Southern Territories','TF','ATF',0),(78,'Gabon','GA','GAB',0),(79,'Gambia','GM','GMB',0),(80,'Georgia','GE','GEO',0),(81,'Germany','DE','DEU',0),(82,'Ghana','GH','GHA',0),(83,'Gibraltar','GI','GIB',0),(84,'Greece','GR','GRC',0),(85,'Greenland','GL','GRL',0),(86,'Grenada','GD','GRD',0),(87,'Guadeloupe','GP','GLP',0),(88,'Guam','GU','GUM',0),(89,'Guatemala','GT','GTM',0),(90,'Guinea','GN','GIN',0),(91,'Guinea-bissau','GW','GNB',0),(92,'Guyana','GY','GUY',0),(93,'Haiti','HT','HTI',0),(94,'Heard and Mc Donald Islands','HM','HMD',0),(95,'Honduras','HN','HND',0),(96,'Hong Kong','HK','HKG',0),(97,'Hungary','HU','HUN',0),(98,'Iceland','IS','ISL',0),(99,'India','IN','IND',0),(100,'Indonesia','ID','IDN',0),(101,'Iran (Islamic Republic of)','IR','IRN',0),(102,'Iraq','IQ','IRQ',0),(103,'Ireland','IE','IRL',0),(104,'Israel','IL','ISR',0),(105,'Italy','IT','ITA',0),(106,'Jamaica','JM','JAM',0),(107,'Japan','JP','JPN',0),(108,'Jordan','JO','JOR',0),(109,'Kazakhstan','KZ','KAZ',0),(110,'Kenya','KE','KEN',0),(111,'Kiribati','KI','KIR',0),(112,'Korea','KP','PRK',0),(114,'Kuwait','KW','KWT',0),(115,'Kyrgyzstan','KG','KGZ',0),(116,'Lao People\'s Democratic Republic','LA','LAO',0),(117,'Latvia','LV','LVA',0),(118,'Lebanon','LB','LBN',0),(119,'Lesotho','LS','LSO',0),(120,'Liberia','LR','LBR',0),(121,'Libyan Arab Jamahiriya','LY','LBY',0),(122,'Liechtenstein','LI','LIE',0),(123,'Lithuania','LT','LTU',0),(124,'Luxembourg','LU','LUX',0),(125,'Macau','MO','MAC',0),(126,'Macedonia','MK','MKD',0),(127,'Madagascar','MG','MDG',0),(128,'Malawi','MW','MWI',0),(129,'Malaysia','MY','MYS',0),(130,'Maldives','MV','MDV',0),(131,'Mali','ML','MLI',0),(132,'Malta','MT','MLT',0),(133,'Marshall Islands','MH','MHL',0),(134,'Martinique','MQ','MTQ',0),(135,'Mauritania','MR','MRT',0),(136,'Mauritius','MU','MUS',0),(137,'Mayotte','YT','MYT',0),(138,'Mexico','MX','MEX',0),(139,'Micronesia, Federated States of','FM','FSM',0),(140,'Moldova, Republic of','MD','MDA',0),(141,'Monaco','MC','MCO',0),(142,'Mongolia','MN','MNG',0),(143,'Montserrat','MS','MSR',0),(144,'Morocco','MA','MAR',0),(145,'Mozambique','MZ','MOZ',0),(146,'Myanmar','MM','MMR',0),(147,'Namibia','NA','NAM',0),(148,'Nauru','NR','NRU',0),(149,'Nepal','NP','NPL',0),(150,'Netherlands','NL','NLD',0),(151,'Netherlands Antilles','AN','ANT',0),(152,'New Caledonia','NC','NCL',0),(153,'New Zealand','NZ','NZL',0),(154,'Nicaragua','NI','NIC',0),(155,'Niger','NE','NER',0),(156,'Nigeria','NG','NGA',0),(157,'Niue','NU','NIU',0),(158,'Norfolk Island','NF','NFK',0),(159,'Northern Mariana Islands','MP','MNP',0),(160,'Norway','NO','NOR',0),(161,'Oman','OM','OMN',0),(162,'Pakistan','PK','PAK',0),(163,'Palau','PW','PLW',0),(164,'Panama','PA','PAN',0),(165,'Papua New Guinea','PG','PNG',0),(166,'Paraguay','PY','PRY',0),(167,'Peru','PE','PER',0),(168,'Philippines','PH','PHL',0),(169,'Pitcairn','PN','PCN',0),(170,'Poland','PL','POL',0),(171,'Portugal','PT','PRT',0),(172,'Puerto Rico','PR','PRI',0),(173,'Qatar','QA','QAT',0),(174,'Reunion','RE','REU',0),(175,'Romania','RO','ROM',0),(176,'Russian Federation','RU','RUS',0),(177,'Rwanda','RW','RWA',0),(178,'Saint Kitts and Nevis','KN','KNA',0),(179,'Saint Lucia','LC','LCA',0),(180,'Saint Vincent and the Grenadines','VC','VCT',0),(181,'Samoa','WS','WSM',0),(182,'San Marino','SM','SMR',0),(183,'Sao Tome and Principe','ST','STP',0),(184,'Saudi Arabia','SA','SAU',0),(185,'Senegal','SN','SEN',0),(186,'Seychelles','SC','SYC',0),(187,'Sierra Leone','SL','SLE',0),(188,'Singapore','SG','SGP',0),(189,'Slovakia (Slovak Republic)','SK','SVK',0),(190,'Slovenia','SI','SVN',0),(191,'Solomon Islands','SB','SLB',0),(192,'Somalia','SO','SOM',0),(193,'South Africa','ZA','ZAF',0),(194,'South Georgia','GS','SGS',0),(195,'Spain','ES','ESP',0),(196,'Sri Lanka','LK','LKA',0),(197,'St. Helena','SH','SHN',0),(198,'St. Pierre and Miquelon','PM','SPM',0),(199,'Sudan','SD','SDN',0),(200,'Suriname','SR','SUR',0),(201,'Svalbard and Jan Mayen Islands','SJ','SJM',0),(202,'Swaziland','SZ','SWZ',0),(203,'Sweden','SE','SWE',0),(204,'Switzerland','CH','CHE',0),(205,'Syrian Arab Republic','SY','SYR',0),(206,'Taiwan','TW','TWN',0),(207,'Tajikistan','TJ','TJK',0),(208,'Tanzania, United Republic of','TZ','TZA',0),(209,'Thailand','TH','THA',0),(210,'Togo','TG','TGO',0),(211,'Tokelau','TK','TKL',0),(212,'Tonga','TO','TON',0),(213,'Trinidad and Tobago','TT','TTO',0),(214,'Tunisia','TN','TUN',0),(215,'Turkey','TR','TUR',0),(216,'Turkmenistan','TM','TKM',0),(217,'Turks and Caicos Islands','TC','TCA',0),(218,'Tuvalu','TV','TUV',0),(219,'Uganda','UG','UGA',0),(220,'Ukraine','UA','UKR',0),(221,'United Arab Emirates','AE','ARE',0),(222,'United Kingdom','GB','GBR',0),(223,'United States','US','USA',0),(224,'United States Minor Outlying Islands','UM','UMI',0),(225,'Uruguay','UY','URY',0),(226,'Uzbekistan','UZ','UZB',0),(227,'Vanuatu','VU','VUT',0),(228,'Vatican City State (Holy See)','VA','VAT',0),(229,'Venezuela','VE','VEN',0),(230,'Viet Nam','VN','VNM',0),(231,'Virgin Islands (British)','VG','VGB',0),(232,'Virgin Islands (U.S.)','VI','VIR',0),(233,'Wallis and Futuna Islands','WF','WLF',0),(234,'Western Sahara','EH','ESH',0),(235,'Yemen','YE','YEM',0),(236,'Yugoslavia','YU','YUG',0),(237,'Zaire','ZR','ZAR',0),(238,'Zambia','ZM','ZMB',0),(239,'Zimbabwe','ZW','ZWE',0);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditsolos`
--

DROP TABLE IF EXISTS `creditsolos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditsolos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `sent` tinyint(4) NOT NULL,
  `creditcost` int(10) unsigned NOT NULL DEFAULT '0',
  `clicks` int(10) unsigned NOT NULL,
  `purchase` int(10) unsigned NOT NULL,
  `datesent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditsolos`
--

LOCK TABLES `creditsolos` WRITE;
/*!40000 ALTER TABLE `creditsolos` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditsolos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditsolos_saved`
--

DROP TABLE IF EXISTS `creditsolos_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditsolos_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditsolos_saved`
--

LOCK TABLES `creditsolos_saved` WRITE;
/*!40000 ALTER TABLE `creditsolos_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditsolos_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditsolos_viewed`
--

DROP TABLE IF EXISTS `creditsolos_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditsolos_viewed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adid` int(10) unsigned NOT NULL,
  `userid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditsolos_viewed`
--

LOCK TABLES `creditsolos_viewed` WRITE;
/*!40000 ALTER TABLE `creditsolos_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditsolos_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downlinemails`
--

DROP TABLE IF EXISTS `downlinemails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `downlinemails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `adbody` longtext NOT NULL,
  `sent` varchar(4) NOT NULL DEFAULT 'no',
  `datesent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downlinemails`
--

LOCK TABLES `downlinemails` WRITE;
/*!40000 ALTER TABLE `downlinemails` DISABLE KEYS */;
/*!40000 ALTER TABLE `downlinemails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` (`id`, `title`, `subject`, `message`) VALUES (1,'newticket','New Support Request','Dear ~fullname~, Your support request has been received.  You will receive a response as quickly as possible. Thank You for using ~sitename~! Sincerely, ~sitename~ Support'),(2,'ticketreply','Support Ticket Updated','--------------------PLEASE DO NOT REPLY TO THIS EMAIL.  GO TO THE ONLINE HELP DESK INSTEAD--------------------\r\n~domain~\r\nSubject: ~subj~ \r\nCreated: ~timesubmitted~ \r\nName: ~fullname~ Hello ~fullname~, Your ticket has been updated.  \r\nPlease visit our online support center to view our response to you. \r\nThank you for using our Online Support Center. Best Regards, ~domain~ Support Center \r\nContext of your support request\r\nStatus: ~ticketstatus~ ~mesg~'),(3,'reply','New Reply Added','Dear ~fullname~,Your added reply has been received.  You will receive a response as quickly as possible. Thank You for using ~sitename~! Sincerely, ~sitename~ Support');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailsignupcontrol`
--

DROP TABLE IF EXISTS `emailsignupcontrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailsignupcontrol` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emaildomain` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailsignupcontrol`
--

LOCK TABLES `emailsignupcontrol` WRITE;
/*!40000 ALTER TABLE `emailsignupcontrol` DISABLE KEYS */;
/*!40000 ALTER TABLE `emailsignupcontrol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fullloginads`
--

DROP TABLE IF EXISTS `fullloginads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fullloginads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,
  `added` tinyint(4) NOT NULL DEFAULT '0',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(9) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `purchase` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fullloginads`
--

LOCK TABLES `fullloginads` WRITE;
/*!40000 ALTER TABLE `fullloginads` DISABLE KEYS */;
/*!40000 ALTER TABLE `fullloginads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fullloginads_saved`
--

DROP TABLE IF EXISTS `fullloginads_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fullloginads_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fullloginads_saved`
--

LOCK TABLES `fullloginads_saved` WRITE;
/*!40000 ALTER TABLE `fullloginads_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `fullloginads_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fullloginadviews`
--

DROP TABLE IF EXISTS `fullloginadviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fullloginadviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(30) NOT NULL DEFAULT '',
  `adid` int(11) NOT NULL DEFAULT '0',
  `dateviewed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fullloginadviews`
--

LOCK TABLES `fullloginadviews` WRITE;
/*!40000 ALTER TABLE `fullloginadviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `fullloginadviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membernavigation`
--

DROP TABLE IF EXISTS `membernavigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membernavigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membernavtitle` varchar(255) NOT NULL,
  `membernavurl` varchar(255) NOT NULL,
  `membernavwindow` varchar(255) NOT NULL DEFAULT '_top',
  `membernavenabled` varchar(4) NOT NULL DEFAULT 'yes',
  `membernavsequence` int(10) unsigned NOT NULL,
  `membernavcategory` varchar(255) NOT NULL DEFAULT 'MAIN',
  `membernavallowedlevels` varchar(12) NOT NULL DEFAULT 'PAID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membernavigation`
--

LOCK TABLES `membernavigation` WRITE;
/*!40000 ALTER TABLE `membernavigation` DISABLE KEYS */;
INSERT INTO `membernavigation` (`id`, `membernavtitle`, `membernavurl`, `membernavwindow`, `membernavenabled`, `membernavsequence`, `membernavcategory`, `membernavallowedlevels`) VALUES (1,'UPDATES','members.php','_top','yes',1,'MAIN','ALL'),(2,'ORDER ADVERTISING','orderads.php','_top','yes',4,'MAIN','ALL'),(3,'PROFILE','profile.php','_top','yes',7,'MAIN','ALL'),(4,'PROMOTE','promote.php','_top','yes',9,'MAIN','ALL'),(6,'ADD TESTIMONIAL','testimonialsadd.php','_top','yes',12,'MAIN','ALL'),(7,'BROWSE ADS','browseads.php','_top','yes',11,'MAIN','ALL'),(8,'LOG OUT','logout.php','_top','yes',17,'MAIN','ALL'),(9,'YOUR AD STATS','adstats.php','_top','yes',6,'MAIN','ALL'),(10,'POST ADS','postads.php','_top','yes',5,'MAIN','ALL'),(12,'DELETE ACCOUNT','delete.php','_top','yes',13,'MAIN','ALL'),(13,'REQUEST CASH OUT','requestcashout.php','_top','yes',14,'MAIN','PAID'),(14,'UPGRADE','upgrade.php','_top','yes',15,'MAIN','FREE'),(15,'YOUR TRANSACTION HISTORY','your_transactions.php','_top','yes',16,'MAIN','ALL'),(16,'TEXT ADS','textads.php','_top','yes',8,'MAIN','ALL'),(17,'SUPPORT','http://e-webs.us/helpdesk','_blank','yes',10,'MAIN','ALL'),(19,'EMAIL DOWNLINE','maildownline.php','_top','yes',8,'MAIN','PAID'),(20,'FUND YOUR ACCOUNT','fundewallet.php','_top','yes',8,'MAIN','ALL'),(21,'CREDIT MAILER','creditmailer.php','_top','yes',8,'MAIN','ALL'),(22,'GET YOUR OWN SITE LIKE THIS!','http://demoviralmailerbasic.phpsitescripts.com','_blank','yes',17,'MAIN','ALL'),(24,'AUTO-SUBMIT TO ALL SITES!','http://100solos.com/100solos_directory.php','_blank','yes',17,'MAIN','ALL'),(25,'AUTO-JOIN ALL SITES FREE!','http://100solos.com/100solos_autojoin.php','_blank','yes',17,'MAIN','ALL');
/*!40000 ALTER TABLE `membernavigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accounttype` varchar(255) NOT NULL DEFAULT 'FREE',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `egopay` varchar(255) NOT NULL,
  `payza` varchar(255) NOT NULL,
  `perfectmoney` varchar(255) NOT NULL DEFAULT '',
  `okpay` varchar(255) NOT NULL DEFAULT '',
  `solidtrustpay` varchar(255) NOT NULL DEFAULT '',
  `paypal` varchar(255) NOT NULL DEFAULT '',
  `transaction` varchar(255) NOT NULL DEFAULT '',
  `paychoice` varchar(255) NOT NULL DEFAULT '',
  `signupdate` datetime NOT NULL,
  `signupip` varchar(255) NOT NULL,
  `verified` varchar(4) NOT NULL DEFAULT 'no',
  `verifieddate` datetime NOT NULL,
  `referid` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `vacation` varchar(4) NOT NULL DEFAULT 'no',
  `vacationdate` datetime NOT NULL,
  `lastsolopost` varchar(20) NOT NULL,
  `nextsolopost` varchar(20) NOT NULL,
  `ewallet` decimal(9,2) NOT NULL DEFAULT '0.00',
  `ewalletlastpaid` datetime NOT NULL,
  `credits` int(10) unsigned NOT NULL,
  `lastmailedreferrals` datetime NOT NULL,
  `membershiplastpaid` varchar(255) NOT NULL,
  `lastcreditsolopost` varchar(20) NOT NULL,
  `nextcreditsolopost` varchar(20) NOT NULL,
  `verifycode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `userid`, `password`, `accounttype`, `firstname`, `lastname`, `country`, `email`, `egopay`, `payza`, `perfectmoney`, `okpay`, `solidtrustpay`, `paypal`, `transaction`, `paychoice`, `signupdate`, `signupip`, `verified`, `verifieddate`, `referid`, `lastlogin`, `vacation`, `vacationdate`, `lastsolopost`, `nextsolopost`, `ewallet`, `ewalletlastpaid`, `credits`, `lastmailedreferrals`, `membershiplastpaid`, `lastcreditsolopost`, `nextcreditsolopost`, `verifycode`) VALUES (1,'programmer_account','programmer_password','PAID','Sabrina','Markon','Canada','sabrina.markon@gmail.com','','','','','','','','','2013-08-18 04:11:12','68.144.7.130','yes','2013-08-18 04:15:17','','2014-05-06 15:21:02','no','0000-00-00 00:00:00','2013-08-18 04:11:12','2013-08-18 04:11:12',0.00,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2020-01-16','','',''),(8,'teflondon14','skyline','FREE','willism','kennedy','United States','cloudtechmarketing14@gmail.com','','','','','','','','','2014-08-30 20:39:12','174.21.197.49','yes','2014-09-06 11:24:25','programmer_account','0000-00-00 00:00:00','no','0000-00-00 00:00:00','2014-08-30 20:39:12','2014-08-30 20:39:12',0.00,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2014-08-30','2014-08-30 20:39:12','2014-08-30 20:39:12','1409452752'),(7,'grqinc','dandy546','FREE','Wilbert','Fenton','Canada','sleinc.wilbert@gmail.com','','','','','','','','','2014-07-15 08:35:46','99.237.146.122','yes','2014-07-15 08:41:35','programmer_account','0000-00-00 00:00:00','no','0000-00-00 00:00:00','2014-07-15 08:35:46','2014-07-15 08:35:46',0.00,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2014-07-15','2014-07-15 08:35:46','2014-07-15 08:35:46','1405434945'),(6,'demomember','demopass','PAID','Demo','Member','Canada','webmaster@pearlsofwealth.com','','','','','','','','','2014-05-04 22:59:01','68.144.7.130','yes','2014-07-13 19:17:16','programmer_account','2015-04-29 12:47:47','no','0000-00-00 00:00:00','2014-05-04 22:59:01','2014-05-04 22:59:01',0.00,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00','2020-01-01','2014-05-04 22:59:01','2014-05-04 22:59:01','1399265941');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offerpages`
--

DROP TABLE IF EXISTS `offerpages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offerpages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `commissionfree` decimal(9,2) NOT NULL DEFAULT '0.00',
  `commissionpaid` decimal(9,2) NOT NULL DEFAULT '0.00',
  `enable` varchar(4) NOT NULL DEFAULT 'no',
  `showwhen` varchar(255) NOT NULL DEFAULT 'After Login',
  `howmanytimestoshow` varchar(255) NOT NULL DEFAULT 'Always',
  `credits` int(10) unsigned NOT NULL,
  `solo_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_views` int(10) unsigned NOT NULL DEFAULT '0',
  `button_num` int(10) unsigned NOT NULL DEFAULT '0',
  `button_views` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_views` int(10) unsigned NOT NULL DEFAULT '0',
  `upgrade` varchar(4) NOT NULL DEFAULT 'no',
  `htmlcode` longtext NOT NULL,
  `fullloginad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offerpages`
--

LOCK TABLES `offerpages` WRITE;
/*!40000 ALTER TABLE `offerpages` DISABLE KEYS */;
/*!40000 ALTER TABLE `offerpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offerpages_viewed`
--

DROP TABLE IF EXISTS `offerpages_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offerpages_viewed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offerpageid` int(10) unsigned NOT NULL,
  `userid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offerpages_viewed`
--

LOCK TABLES `offerpages_viewed` WRITE;
/*!40000 ALTER TABLE `offerpages_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `offerpages_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `htmlcode` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `name`, `htmlcode`) VALUES (1,'Home Page','<div style=\"text-align: center; width: 500px\"><font size=\"2\"><strong><br /></strong></font><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"> <tbody><tr><td><font size=\"2\"><strong><font style=\"font-size: 36px; color: #0000ff\">Viral Mailer & Advertising Script Basic Version</font></strong></font></td></tr> </tbody></table><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\">&nbsp;</div><ul style=\"padding-left: 0px; text-align: left; font-size: 24px; color: #0000ff\"><li><font size=\"3\"><strong>State Of The Art Credit Mailer. Ultra Fast!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Downline Mailer that may be enabled or disabled </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Credit System you can switch on or off! </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Ability to turn on Auto-Approval of Ads</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Flexible Special Offer System! Set up as many rotating offers you like for Member Login, Log Out, and After Verification</strong></font><br />&nbsp;</li>\r\n<li><font size=\"3\"><strong>Create Customized Signup and Monthly Bonuses for your Members</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Full Page Login Ads, Banners, Buttons, Text Ads, and Solos in addition to your Mailers! </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Professional approach to Popular Ad Types without the </strong><strong>over-the-top ad clutter of a TAE script!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Secure, clean E-Wallet system and cashouts!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Members fund their E-Wallets to make purchases with on your site using the payment processor of their choice!</strong></font><br />&nbsp;</li>\r\n<li><font size=\"3\"><strong>Upgrade payment subscriptions are automatically deducted from Member E-Wallets! Auto-Downgrade overdue accounts</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Multiple Payment Processors Supported</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Two straightforward, customizable membership levels you name yourself. Professional, yet easy for members to understand. </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Gain new members and grow your site much more quickly with your site\'s included membership in our 100Solos.com Submitter!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Extremely user-friendly! Even a beginner can easily start a beautiful, professional-looking business website!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Custom PHP programming available for your custom add-on mods to make your site truly unique!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Custom built one-of-a-kind Template Design included free! </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>OR supply your own and we will be happy to help you set it up (freely, of course)! We can refer you to the very best graphic designers in the industry! </strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>Move to us from anywhere and we will help you move for free!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>OR  start a fresh, new <u>modernized</u> site with a new domain name of your own, or choose a subdomain and benefit from one of our network domain\'s established traffic.</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>At signup, if you need a domain, we are happy to offer you a .info domain for <font size=\"3\" color=\"#3366FF\">FREE</font> too!</strong></font><br />&nbsp;</li><li><font size=\"3\"><strong>FAST set-up and constant communication!</strong></font><br />&nbsp;</li></ul></div>\r\n<div style=\"text-align: center; width: 500px\"><br />\r\n<table cellpadding=\"8\" cellspacing=\"8\" border=\"0\" align=\"center\" width=\"500\">\r\n<tr>\r\n<td align=\"center\"><img src=\"/images/Marc_and_Julie.jpg\" alt=\"Marc Tori\" border=\"0\" width=\"115\" style=\"border:3px solid #0000ff;\"></td>\r\n<td align=\"center\"><font size=\"3\" color=\"#3366FF\"><strong>Warm Regards,<br /><br />Marc T. &amp; Sabrina M.<br /><br />Your Proud Admins!<br /></strong></font></td>\r\n<td align=\"center\"><img src=\"http:///images/Sabrina.jpg\" alt=\"Sabrina Markon\" border=\"0\" width=\"115\" style=\"border:3px solid #0000ff;\"></td>\r\n</tr>\r\n</table>\r\n</div>\r\n<div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\"><font size=\"3\" color=\"#0000ff\"><strong>We Welcome you to login to the Admin Area of this DEMO of the Pasta Script! </strong></font></div><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\"><font size=\"3\" color=\"#0000ff\"><strong>Check it out by <a href=\"/admin\" target=\"_blank\"><font size=\"3\" color=\"#FF9900\"><strong>CLICKING HERE!</strong></font></a><br /></strong></font></div><div style=\"text-align: center; width: 500px\">&nbsp;</div><div style=\"text-align: center; width: 500px\">&nbsp; <br /></div><div style=\"text-align: center; width: 500px\"><div align=\"justify\"><font size=\"3\" color=\"#0000ff\"><strong>The admin username and password are already filled in for you.</strong></font></div><div align=\"justify\"><br /><font size=\"3\" color=\"#0000ff\"><strong>Some features are disabled for security reasons on the demo website.</strong></font><br /></div></div>\r\n<div style=\"text-align: center; width: 500px\">&nbsp;</div>'),(2,'Thank You Page - Paid Member Signup',''),(3,'Payment Page',''),(4,'Login Page',''),(5,'FAQ Page',''),(6,'Terms and Conditions',''),(7,'Solo Ad Message Rules',''),(8,'Members Area Main Page','<table border=\"0\"><tbody><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table>'),(9,'Members Area Profile Page',''),(10,'Members Area Promotion Page',''),(11,'Members Area Support Page',''),(12,'Members Area Add Testimonial Page',''),(13,'Members Area Advertising Order Page','<div style=\"text-align: center;\">\r\n<img src=\"/images/adpac.gif\" alt=\"\" border=\"0\">  <p style=\"font-family: Times; font-size: medium\" align=\"left\">&nbsp;</p><p style=\"font-family: Times; font-size: medium\" align=\"left\">&nbsp;</p><p style=\"font-family: Times; font-size: medium\" align=\"left\"><font color=\"#ff0000\" face=\"verdana,geneva\" size=\"2\"><em><strong>Purchase Instructions:</strong></em></font></p><div style=\"font-family: Times; font-size: medium\" align=\"left\"><ol><li><font size=\"2\">Fund Your Ewallet first via the payment processor buttons below.</font></li><li><font size=\"2\">Come back to the site and check if your ewallet has been credited, then purchase the Advertising or Adpack of your choice.&nbsp; Please also check other advertising below this page!</font></li><li><font size=\"2\">Contact us if your ewallet is not funded correctly.&nbsp; Please Allow 24 hours.</font></li><li><font size=\"2\">Once the E-wallet is funded , Please select your Advertising or Adpack &amp; click order.</font></li><li><font size=\"2\">Your Advertising or Adpack should be in the Post Ads and Status will be <strong>Paid</strong>&nbsp;in your Account Profile.</font></li><li><font size=\"2\">Enjoy Advertising!&nbsp;</font></li></ol></div> </div>'),(14,'Members Area Upgrade Page',''),(15,'Members Area Ad Stats Page',''),(16,'Members Area Transaction History Page',''),(17,'Members Area Fund E-Wallet Order Page','<div style=\"text-align: center;\">\r\n<img src=\"/images/adpac.gif\" alt=\"\" border=\"0\">  <p style=\"font-family: Times; font-size: medium\" align=\"left\">&nbsp;</p><p style=\"font-family: Times; font-size: medium\" align=\"left\">&nbsp;</p><p style=\"font-family: Times; font-size: medium\" align=\"left\"><font color=\"#ff0000\" face=\"verdana,geneva\" size=\"2\"><em><strong>Purchase Instructions:</strong></em></font></p><div style=\"font-family: Times; font-size: medium\" align=\"left\"><ol><li><font size=\"2\">Fund Your Ewallet first via the payment processor buttons below.</font></li><li><font size=\"2\">Come back to the site and check if your ewallet has been credited, then purchase the Advertising or Adpack of your choice.&nbsp; Please also check other advertising below this page!</font></li><li><font size=\"2\">Contact us if your ewallet is not funded correctly.&nbsp; Please Allow 24 hours.</font></li><li><font size=\"2\">Once the E-wallet is funded , Please select your Advertising or Adpack &amp; click order.</font></li><li><font size=\"2\">Your Advertising or Adpack should be in the Post Ads and Status will be <strong>Paid</strong>&nbsp;in your Account Profile.</font></li><li><font size=\"2\">Enjoy Advertising!&nbsp;</font></li></ol></div> </div>'),(18,'Request Cash Out Page',''),(19,'Testimonial Page',''),(20,'Program Details Page',''),(21,'Thank You Page - E-Wallet Funded',''),(22,'Spam Page',''),(23,'Privacy Page',''),(24,'About Us Page',''),(25,'Registration Page',''),(26,'Thank You Page - New Free Member Signup',''),(27,'Thank You Page - Special Offer Purchased',''),(28,'Members Area Text Ads Page',''),(29,'Members Area Credit Mailer Page','');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payouts`
--

DROP TABLE IF EXISTS `payouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `paid` decimal(9,2) NOT NULL,
  `datepaid` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payouts`
--

LOCK TABLES `payouts` WRITE;
/*!40000 ALTER TABLE `payouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `payouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocodes`
--

DROP TABLE IF EXISTS `promocodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `enable` varchar(4) NOT NULL DEFAULT 'no',
  `maximum` int(10) unsigned NOT NULL DEFAULT '100',
  `howmanytimesclaimed` int(10) unsigned NOT NULL DEFAULT '0',
  `promocodefree` varchar(4) NOT NULL DEFAULT 'yes',
  `promocodepaid` varchar(4) NOT NULL DEFAULT 'yes',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `solo_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_num` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_views` int(10) unsigned NOT NULL DEFAULT '0',
  `button_num` int(10) unsigned NOT NULL DEFAULT '0',
  `button_views` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `textad_views` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_num` int(10) unsigned NOT NULL DEFAULT '0',
  `fullloginad_views` int(10) unsigned NOT NULL DEFAULT '0',
  `upgrade` varchar(4) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocodes`
--

LOCK TABLES `promocodes` WRITE;
/*!40000 ALTER TABLE `promocodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocodes_used`
--

DROP TABLE IF EXISTS `promocodes_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocodes_used` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `promocode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocodes_used`
--

LOCK TABLES `promocodes_used` WRITE;
/*!40000 ALTER TABLE `promocodes_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocodes_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solos`
--

DROP TABLE IF EXISTS `solos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `added` tinyint(4) NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `sent` tinyint(4) NOT NULL,
  `clicks` int(10) unsigned NOT NULL,
  `purchase` int(10) unsigned NOT NULL,
  `datesent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solos`
--

LOCK TABLES `solos` WRITE;
/*!40000 ALTER TABLE `solos` DISABLE KEYS */;
/*!40000 ALTER TABLE `solos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solos_saved`
--

DROP TABLE IF EXISTS `solos_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solos_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `adbody` longtext NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solos_saved`
--

LOCK TABLES `solos_saved` WRITE;
/*!40000 ALTER TABLE `solos_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `solos_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solos_viewed`
--

DROP TABLE IF EXISTS `solos_viewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solos_viewed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adid` int(10) unsigned NOT NULL,
  `userid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solos_viewed`
--

LOCK TABLES `solos_viewed` WRITE;
/*!40000 ALTER TABLE `solos_viewed` DISABLE KEYS */;
/*!40000 ALTER TABLE `solos_viewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memberid` varchar(25) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `subj` varchar(200) DEFAULT NULL,
  `mesg` text,
  `timesubmitted` datetime DEFAULT NULL,
  `membertype` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `origid` int(11) NOT NULL DEFAULT '0',
  `span` int(11) NOT NULL DEFAULT '0',
  `ticketstatus` varchar(20) DEFAULT NULL,
  `replyto` varchar(100) DEFAULT NULL,
  `lastreply` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `rating` int(10) unsigned NOT NULL DEFAULT '10',
  `dateadded` datetime NOT NULL,
  `approved` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `textads`
--

DROP TABLE IF EXISTS `textads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `textads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `added` tinyint(4) NOT NULL DEFAULT '0',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `purchase` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `textads`
--

LOCK TABLES `textads` WRITE;
/*!40000 ALTER TABLE `textads` DISABLE KEYS */;
/*!40000 ALTER TABLE `textads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `textads_saved`
--

DROP TABLE IF EXISTS `textads_saved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `textads_saved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `textads_saved`
--

LOCK TABLES `textads_saved` WRITE;
/*!40000 ALTER TABLE `textads_saved` DISABLE KEYS */;
/*!40000 ALTER TABLE `textads_saved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `textadviews`
--

DROP TABLE IF EXISTS `textadviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `textadviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `adid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `textadviews`
--

LOCK TABLES `textadviews` WRITE;
/*!40000 ALTER TABLE `textadviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `textadviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `amountreceived` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `userid`, `transaction`, `description`, `paymentdate`, `amountreceived`) VALUES (1,'programmer_account','E-Wallet','E-Wallet Purchase - Upgraded Membership Renewal','2014-02-17 19:49:14',30.00);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'phpsites_demoviralmailerbasic'
--

--
-- Dumping routines for database 'phpsites_demoviralmailerbasic'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-30  9:49:17
