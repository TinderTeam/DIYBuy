# Host: localhost  (Version: 5.5.27)
# Date: 2014-12-08 14:28:35
# Generator: MySQL-Front 5.3  (Build 2.42)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

DROP DATABASE IF EXISTS `diygroup`;
CREATE DATABASE `diygroup` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `diygroup`;

#
# Source for table "diy_ad"
#

DROP TABLE IF EXISTS `diy_ad`;
CREATE TABLE `diy_ad` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `imgname` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `price` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "diy_ad"
#

/*!40000 ALTER TABLE `diy_ad` DISABLE KEYS */;
INSERT INTO `diy_ad` VALUES (1,'腾讯','543510e51d40e.PNG','http://im.qq.com/','222','页首',2),(2,'百度','543bd1273cb70.png','http://www.baidu.com/','','页尾',2),(3,'阿里巴巴','5412b21fb321b.PNG','http://www.1688.com/','阿里阿里','页尾',6),(4,'苹果','5412b25d942c3.PNG','http://www.apple.com/cn/','iphone6','页尾',4),(5,'新浪','5412b2b91de35.PNG','http://www.sina.com.cn/','新浪微博','页尾',3),(6,'雅芳','5412b2fd7af8e.PNG','http://avon.tmall.com/','啦啦啦','页尾',1);
/*!40000 ALTER TABLE `diy_ad` ENABLE KEYS */;

#
# Source for table "diy_admin"
#

DROP TABLE IF EXISTS `diy_admin`;
CREATE TABLE `diy_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `pwd` varchar(20) NOT NULL DEFAULT '',
  `limit` varchar(4) NOT NULL DEFAULT '0',
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "diy_admin"
#

/*!40000 ALTER TABLE `diy_admin` DISABLE KEYS */;
INSERT INTO `diy_admin` VALUES (1,'admin','123456','高','market@fuego.cn'),(2,'test','1234','中',NULL);
/*!40000 ALTER TABLE `diy_admin` ENABLE KEYS */;

#
# Source for table "diy_group_order"
#

DROP TABLE IF EXISTS `diy_group_order`;
CREATE TABLE `diy_group_order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) DEFAULT NULL,
  `userID` varchar(20) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=123778920 DEFAULT CHARSET=utf8;

#
# Data for table "diy_group_order"
#

/*!40000 ALTER TABLE `diy_group_order` DISABLE KEYS */;
INSERT INTO `diy_group_order` VALUES (123778909,128,'092723522325155','2014-10-10 00:31:46'),(123778910,138,'092800351533683','2014-10-11 00:58:50'),(123778911,140,'092800351533683','2014-10-13 17:45:22'),(123778912,139,'092800351533683','2014-10-13 17:45:59'),(123778913,140,'101514455332574','2014-10-15 15:26:28'),(123778914,141,'101514455332574','2014-10-15 15:26:54'),(123778915,183,'101621110124966','2014-10-17 08:41:08'),(123778916,183,'101708425499244','2014-10-17 08:46:35'),(123778917,146,'101621110124966','2014-10-17 09:56:04'),(123778918,147,'101708425499244','2014-10-17 10:04:25'),(123778919,147,'101621110124966','2014-10-17 10:06:11');
/*!40000 ALTER TABLE `diy_group_order` ENABLE KEYS */;

#
# Source for table "diy_order"
#

DROP TABLE IF EXISTS `diy_order`;
CREATE TABLE `diy_order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) DEFAULT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT '待付款',
  `totalPrices` float(11,2) unsigned DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=12345838 DEFAULT CHARSET=utf8;

#
# Data for table "diy_order"
#

/*!40000 ALTER TABLE `diy_order` DISABLE KEYS */;
INSERT INTO `diy_order` VALUES (12345817,142,'testsdfsdff','待付款',1.00,'test2','33521013104006'),(12345818,138,'凯威啤酒屋','已付款',2.00,'test2','54801013112208'),(12345819,136,'金滏山自助烤肉','已付款',2.00,'test2','78601013135203'),(12345820,142,'testsdfsdff','已付款',1.00,'test3','83801013135312'),(12345821,127,'test1','待付款',11.00,'nanbowen',NULL),(12345822,127,'test1','已付款',11.00,'nanbowen','15591013163852'),(12345823,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345824,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345825,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345826,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345827,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345828,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345829,136,'金滏山自助烤肉','待付款',2.00,'test2',NULL),(12345830,136,'金滏山自助烤肉','已付款',2.00,'test2','94551013193544'),(12345832,178,'华夏|嘉熙业国际影城','已付款',2.00,'hua612','75761016214947'),(12345833,178,'华夏|嘉熙业国际影城','已付款',2.00,'hua612','35801016215026'),(12345834,178,'华夏|嘉熙业国际影城','已付款',2.00,'hua613','35911017085401'),(12345835,178,'华夏|嘉熙业国际影城','已付款',2.00,'hua613','17451017101658'),(12345836,178,'华夏|嘉熙业国际影城','待付款',2.00,'hua612',NULL),(12345837,178,'华夏|嘉熙业国际影城','已付款',2.00,'hua614','62831017113819');
/*!40000 ALTER TABLE `diy_order` ENABLE KEYS */;

#
# Source for table "diy_product"
#

DROP TABLE IF EXISTS `diy_product`;
CREATE TABLE `diy_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `price_original` float(11,2) unsigned DEFAULT NULL,
  `price_low` float(11,2) unsigned DEFAULT NULL,
  `price_high` float(11,2) unsigned DEFAULT NULL,
  `total_num` int(11) DEFAULT NULL,
  `current_num` int(11) DEFAULT '0',
  `time_end` date DEFAULT NULL,
  `pic1` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_bin DEFAULT '待审核',
  `describ` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `note` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `pic2` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pic3` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pic4` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pic5` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `pic6` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `time_start` date DEFAULT NULL,
  `sponsor` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `link_add` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `link_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `html_info` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Data for table "diy_product"
#

/*!40000 ALTER TABLE `diy_product` DISABLE KEYS */;
INSERT INTO `diy_product` VALUES (136,'金滏山自助烤肉',50.00,2.00,39.90,2,2,'2014-10-16','5436604c7adaa.PNG','团购成功','4444444444444444444444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-10-09',NULL,'http://wh.nuomi.com/deal/flvv9kjx.html?s=1999514cbb3c9768d12ab23b5d7d8f34',NULL,'<p>&nbsp;4466666666666666666666666666</p>'),(138,'凯威啤酒屋',58.00,2.00,47.70,300,1,'2014-11-29','5437ff878472e.PNG','团购中','仅售49.9元，价值58元单人自助火锅！健康饮食，品种多样！优雅的环境，热情的服务！','请大家赶快来抢团！',NULL,'5437ff879c51e.PNG','5437ff87b14e3.PNG','5437ff87bffb8.PNG','5437ff87c8fc1.PNG','5437ff87d4c8c.PNG','2014-10-10','092723522325155','http://www.nuomi.com/deal/85ssarl7.html?s=a12ca8bcf2902bfa6abb253cafb0886f',NULL,'<div class=\"info-buy-content\" style=\"color: rgb(0, 0, 0); font-family: Arial, Tahoma, songti, Verdana, STHeiTi, sans-serif; font-size: 12px; line-height: normal; white-space: normal;\"><div class=\"w-rich-text\" style=\"margin-bottom: 0px;\"><h3 class=\"w-section-header\" id=\"\" style=\"margin: 0px; padding: 30px 0px 15px; font-size: 20px; width: 725px; line-height: normal; font-family: &#39;microsoft yahei&#39;; color: rgb(102, 102, 102); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(197, 197, 197);\">购买须知</h3><div class=\"rt-content\" style=\"padding: 15px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); line-height: 25px;\"><span style=\"font-weight: 700;\">- 单人自助</span>（1份，价值68元）<span style=\"font-weight: 700;\"><br/>- 包括：</span>荤菜、素菜、凉菜、糕点、水果、饮料<span style=\"font-weight: 700;\"><br/>- 仅限大厅使用，商家不提供包间<br/>- 仅限堂食，不提供餐前个带及餐后打包服务<br/>- 酒水、饮料问题请咨询商家<br/>-&nbsp;光谷店、二七店国庆期间10月1日至10月7日不接待团购顾客<br/></span><span style=\"font-weight: 700;\">- 徐东店国庆节期间到店照常接待，到店另加10元/位</span><span style=\"font-weight: 700;\"><br/>- 时尚店仅限10月8日前接待<br/></span></div></div></div><div class=\"info-buy-content\" style=\"color: rgb(0, 0, 0); font-family: Arial, Tahoma, songti, Verdana, STHeiTi, sans-serif; font-size: 12px; line-height: normal; white-space: normal;\"><div class=\"w-rich-text\" style=\"margin-bottom: 0px;\"><h3 class=\"w-section-header\" style=\"margin: 0px; padding: 30px 0px 15px; font-size: 20px; width: 725px; line-height: normal; font-family: &#39;microsoft yahei&#39;; color: rgb(102, 102, 102); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(197, 197, 197);\">消费提示</h3><div class=\"rt-content\" style=\"padding: 15px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); line-height: 25px;\">1、糯米券有效期为：2014年03月04日至2014年10月31日8月2日七夕情人节不接待<br/>2、糯米券使用时间：二七店/时尚店周一至周日11:00-14:00 ，17:00-21:00；光谷店：周一至周日11:00-21:30&nbsp;<br/>3、时尚店仅限10月8日前接待，徐东店国庆期间到店另补10元/位，原价68元/位，光谷店、二七店十一期间（10月1日-10月7日）不接待团购用户<br/>4、无需预约，消费高峰可能需要等位，咨询请致电商家<br/>5、仅限大厅用餐，商家无包间<br/>6、部分菜品因时令原因有所不同，请以店内当日实际供应为准<br/>7、每张糯米券限1人使用<br/>8、凭糯米券到店消费不可同时享受店内其他优惠<br/>9、二七店、光谷店、徐东店：限周一至周五午餐使用，周一至周五晚餐（原价68元）到店另加10元/；周六周日（原价68元）到店另加10元/位<br/></div></div></div><div class=\"info-buy-content\" style=\"color: rgb(0, 0, 0); font-family: Arial, Tahoma, songti, Verdana, STHeiTi, sans-serif; font-size: 12px; line-height: normal; white-space: normal;\"><div class=\"w-rich-text\" style=\"margin-bottom: 0px;\"><h3 class=\"w-section-header\" style=\"margin: 0px; padding: 30px 0px 15px; font-size: 20px; width: 725px; line-height: normal; font-family: &#39;microsoft yahei&#39;; color: rgb(102, 102, 102); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(197, 197, 197);\">团单详情</h3><div class=\"rt-content\" style=\"padding: 15px 0px 0px; font-size: 14px; color: rgb(102, 102, 102); line-height: 25px;\"><p style=\"margin-top: 0px; margin-bottom: 0px;\"></p><p class=\"wrap-img\" style=\"margin-top: 0px; margin-bottom: 0px; font-size: 0px; line-height: 0;\"><img title=\"图片\" src=\"http://nuomi.xnimg.cn/upload/2013/03-15/1363342800569-8638.jpg\" border=\"0\" style=\"border-style: solid; border-color: rgb(0, 0, 0); float: none;\"/></p><span style=\"font-weight: 700;\">锅底</span>：特聘请东北火锅大师主理，汁稠味浓、鲜美爽口。汤底有清汤、辣汤、麻辣汤、海鲜汤，适合不同口味需求的饕客们。凯威汤底遵循一次性锅底供应原则，一人一锅进餐方式，让您随享欢聚乐趣。<br/><p class=\"wrap-img\" style=\"margin-top: 0px; margin-bottom: 0px; font-size: 0px; line-height: 0;\"><img title=\"图片\" src=\"http://nuomi.xnimg.cn/upload/2013/03-13/1363155245185-4050.jpg\" style=\"float: none;\"/></p></div></div></div><p><img src=\"/DIYBuy/app/Public/ueditor/php/upload/20141013/14131677042642.png\" _src=\"http://localhost:7000/DIYBuy/app/Public/ueditor/php/upload/20141013/14131677042642.png\"/></p>'),(140,'金滏山自助烤肉',50.00,NULL,39.90,10,2,'2014-10-18','54388556abbb7.PNG','组团成功','单人自助午餐！多种丰富烤肉，热菜，水果可选，扶墙进，扶墙出！你行么？亲','大家赶快来抢团呀！','','54388556e7b43.PNG','54388556f0094.PNG','54388557043bc.PNG','543885570d0de.PNG','54388557156af.PNG','2014-10-11','092723522325155','http://wh.nuomi.com/deal/flvv9kjx.html?s=51c6d5df6178ac3f988ffb00f18da973',NULL,NULL),(143,'川色火锅',48.00,NULL,37.90,10,0,'2014-10-18','543bc8ef3faa6.PNG','组团中','仅售39.9元，价值48元自助单人火锅！性价比超高的川味火锅，多种菜肴，丰盛之极！','大家赶快来抢团！','','543bc8ef6d505.PNG','543bc8ef7b219.PNG','543bc8ef87a1e.PNG','543bc8ef94d43.png','543bc8efa0354.png','2014-10-13','092800351533683','http://wh.nuomi.com/deal/zvhnt1gc.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(144,'乔东家脆皮火烧',9.00,NULL,5.90,10,0,'2014-10-18','543bca38bfb50.png','组团中','仅售5.9元，价值9元脆皮火烧！外脆里软，富含丰富的蛋白质，油而不腻，味道丰富，鲜香自然！','大家赶快来组团！','','543bca38ce001.png','543bca38dd692.png','543bca38ebd5d.png','543bca39053ba.png','543bca3912787.png','2014-10-13','092800351533683','http://wh.nuomi.com/deal/xmgx0tk9.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(145,'金汉斯',55.00,NULL,44.60,15,0,'2014-10-18','543bcb5cf3edc.png','组团中','仅售47元，价值55元乐享自助！南美烤肉精髓，精选优质鲜嫩肉类，秉承传统，超值美味！','大家赶快来组团！','','543bcb5d0bed1.png','543bcb5d183a1.png','543bcb5d274f2.png','543bcb5d33bf0.png','543bcb5d3f1ac.png','2014-10-13','092800351533683','http://www.nuomi.com/deal/cukv4nij.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(146,'豆府花城',20.00,NULL,15.00,5,1,'2014-10-18','543bcc8027031.png','组团中','仅售15元，价值20元甜品17选1！浓香饮品，口感细腻，让舌尖体验百味，做快乐吃货！','大家赶快来组团！','','543bcc80327d7.png','543bcc803e5c3.png','543bcc804aa32.png','543bcc8059742.png','543bcc806718c.png','2014-10-13','092723522325155','http://wh.nuomi.com/deal/rf4ohjtu.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(147,'顺盛斋饭庄',600.00,NULL,400.00,5,2,'2014-10-18','543bcd71ba370.png','组团中','仅售400元，价值600元代金券！经典菜品，经典美味，飘香四溢，激活味蕾，超值实惠！','大家赶快来抢团！','','543bcd71c6cc3.png','543bcd71d4f42.png','543bcd71e289a.png','543bcd7205847.png','543bcd7218f7f.png','2014-10-13','092723522325155','http://wh.nuomi.com/deal/54dylopu.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(174,'豆府花城',20.00,NULL,15.00,12,0,'2014-10-24','543bcc8027031.png','组团中','仅售15元，价值20元甜品17选1！浓香饮品，口感细腻，让舌尖体验百味，做快乐吃货！','大家赶快来组团！',NULL,'543bcc80327d7.png','543bcc803e5c3.png','543bcc804aa32.png','543bcc8059742.png','543bcc806718c.png','2014-10-13','092723522325155','http://wh.nuomi.com/deal/rf4ohjtu.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(175,'顺盛斋饭庄',600.00,NULL,400.00,13,0,'2014-10-18','543bcd71ba370.png','组团中','仅售400元，价值600元代金券！经典菜品，经典美味，飘香四溢，激活味蕾，超值实惠！','大家赶快来抢团！',NULL,'543bcd71c6cc3.png','543bcd71d4f42.png','543bcd71e289a.png','543bcd7205847.png','543bcd7218f7f.png','2014-10-13','092723522325155','http://wh.nuomi.com/deal/54dylopu.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(176,'秀玉红茶坊',60.00,NULL,50.30,16,0,'2014-10-18','543bce8bebc12.png','组团中','仅售53元，价值60元代金券！复合型餐饮企业！中型连锁企业！深受年轻群体喜爱！','大家赶快来组团！',NULL,'543bce8c03b61.png','543bce8c11986.png','543bce8c21366.png','543bce8c2cdb7.png','543bce8c38805.png','2014-10-13','092723522325155','http://wh.nuomi.com/deal/yyoyur68.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(177,'泰纳果园',28.80,NULL,5.90,20,0,'2014-11-22','543bcf6e792e6.png','组团中','仅售5.9元，价值28.8元山东沾化特产新鲜冬枣500g/份！果肉饱满，细嫩多汁！','大家赶快来组团！',NULL,'543bcf6e85f3e.png','543bcf6e91599.png','543bcf6e9c56b.png','543bcf6ea8e74.png','543bcf6ebacc7.png','2014-10-13','092723522325155','http://w.nuomi.com/deal/6zgnfnna.html?s=d94f2412f78d24c964af3911e0d108b0',NULL,NULL),(178,'华夏|嘉熙业国际影城',70.00,2.00,26.60,2,3,'2014-11-12','543bd28ea9bc3.png','团购成功','仅售28元，价值70元单人2D影票！地理位置优越，交通便捷，环境舒适怡人，时尚装修！',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-10-13',NULL,'http://sz.nuomi.com/deal/cs89wuri.html?s=ef4a7c1007d2363b654b27fce2a75e8b',NULL,'<p>正在热映影片</p><div style=\"PADDING-BOTTOM: 0px; LINE-HEIGHT: 25px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; FONT-FAMILY: Arial, Tahoma, songti, Verdana, STHeiTi, sans-serif; WHITE-SPACE: normal; COLOR: rgb(102,102,102); FONT-SIZE: 14px; PADDING-TOP: 15px\" class=\"rt-content\"><img src=\"http://nuomi.xnimg.cn/upload/2014/09-12/1410491819501-9417.jpg\"/><p style=\"MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px\"><img style=\"BORDER-BOTTOM-STYLE: solid; BORDER-BOTTOM-COLOR: rgb(0,0,0); BORDER-RIGHT-STYLE: solid; BORDER-TOP-COLOR: rgb(0,0,0); BORDER-TOP-STYLE: solid; FLOAT: none; BORDER-RIGHT-COLOR: rgb(0,0,0); BORDER-LEFT-STYLE: solid; BORDER-LEFT-COLOR: rgb(0,0,0)\" title=\"图片\" border=\"0\" src=\"http://nuomi.xnimg.cn/upload/2014/09-12/1410491534668-1197.jpg\"/><br/>本片中，徐峥和黄渤从互虐的死对头变成互助的小伙伴。徐峥将带着恋情崩盘的黄渤一路向南，通过猎艳的方式洗涤黄渤受伤的心灵。而宁浩也从黑色幽默大师转身奔上纯喜剧的金光大道。</p><img src=\"http://nuomi.xnimg.cn/upload/2014/09-12/1410505132254-5850.jpg\"/><p style=\"MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px\"><img style=\"BORDER-BOTTOM-STYLE: solid; BORDER-BOTTOM-COLOR: rgb(0,0,0); BORDER-RIGHT-STYLE: solid; BORDER-TOP-COLOR: rgb(0,0,0); BORDER-TOP-STYLE: solid; FLOAT: none; BORDER-RIGHT-COLOR: rgb(0,0,0); BORDER-LEFT-STYLE: solid; BORDER-LEFT-COLOR: rgb(0,0,0)\" title=\"图片\" border=\"0\" src=\"http://nuomi.xnimg.cn/upload/2014/09-12/1410505002147-5344.jpg\"/><br/>那是一个民气十足、海阔天空的时代，一群年轻人经历了一段放任自流的时光，自由地追求梦想与爱情，有人在流离中刻骨求爱，有人在抗争中企盼家国未来……<br/></p><img src=\"http://nuomi.xnimg.cn/upload/2014/09-19/1411116772399-6856.jpg\"/><p style=\"MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px\"><img style=\"BORDER-BOTTOM-STYLE: solid; BORDER-BOTTOM-COLOR: rgb(0,0,0); BORDER-RIGHT-STYLE: solid; BORDER-TOP-COLOR: rgb(0,0,0); BORDER-TOP-STYLE: solid; FLOAT: none; BORDER-RIGHT-COLOR: rgb(0,0,0); BORDER-LEFT-STYLE: solid; BORDER-LEFT-COLOR: rgb(0,0,0)\" title=\"图片\" border=\"0\" src=\"http://nuomi.xnimg.cn/upload/2014/09-19/1411116698176-0514.jpg\"/><br/>多年过去，一个看似可靠的线索再次降临，促使田文军等人跋涉千里穿州过省，终在一户偏僻村落人家中，看到一个像极儿子的身影。在孩子的身后，却站着一个他喊着“妈妈”的农村妇人李红琴（赵薇 饰）。丢失的挚爱能否找回？残缺的家能否真的破镜重圆？ 寻子背后，一场亲情风暴正席卷而至……&nbsp;</p></div><p><img src=\"/DIYBuy/app/Public/ueditor/php/upload/20141013/14132065837550.png\" _src=\"http://localhost:7000/DIYBuy/app/Public/ueditor/php/upload/20141013/14132065837550.png\"/></p><p>&quot;&gt;</p>'),(182,'我的好东西',58.00,NULL,36.00,2,0,'2014-10-18','5440629f67bd2.jpg','已驳回','5555555555555555555555555555555','5555555555555555555555555555555555555555555','东西写得不够好，重写',NULL,NULL,NULL,NULL,NULL,'2014-10-17','101621110124966','http://www.baidu.com',NULL,NULL),(183,'4444444444444',56.00,NULL,20.00,2,2,'2014-10-18','544065523d616.jpg','议价成功','555555555555555555555555555555555555','5555555555555555555555555555555555555555555555','',NULL,NULL,NULL,NULL,NULL,'2014-10-17','101621110124966','http://www.baidu.com',NULL,NULL),(184,'555555555555555',5.00,NULL,555.00,10,0,'2014-10-18','54407e0c343c4.jpg','组团中','5555555555555555555555555',' 55555555555555555555555555555555555555555','',NULL,NULL,NULL,NULL,NULL,'2014-10-17','101708425499244','',NULL,NULL),(185,'我是国民党',80.00,1.00,53.00,20,0,'2014-10-20','5440945b4a9f9.jpg','团购中','444444444444444444444444444444\r\n如果这都没算爱,我还能咋办的',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-10-17',NULL,'',NULL,'');
/*!40000 ALTER TABLE `diy_product` ENABLE KEYS */;

#
# Source for table "diy_sys"
#

DROP TABLE IF EXISTS `diy_sys`;
CREATE TABLE `diy_sys` (
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "diy_sys"
#

/*!40000 ALTER TABLE `diy_sys` DISABLE KEYS */;
INSERT INTO `diy_sys` VALUES ('email','2935409638@qq.com'),('note_html','<p style=\"text-align: left;\"><a href=\"http://www.taobao.com\" target=\"_blank\" title=\"我要聚\"><iframe class=\"ueditor_baidumap\" src=\"http://218.244.133.177:7000/DIYBuy/app/Public/ueditor/dialogs/map/map.html#center=108.328638,22.791301&zoom=14&width=528&height=338&markers=undefined,undefined\" frameborder=\"0\" width=\"532\" height=\"342\"></iframe><img src=\"http://img.baidu.com/hi/jx2/j_0013.gif\" _src=\"http://img.baidu.com/hi/jx2/j_0013.gif\"/><img src=\"/DIYBuy/app/Public/ueditor/php/upload/20141017/14135308796879.jpg\" _src=\"http://218.244.133.177:7000/DIYBuy/app/Public/ueditor/php/upload/20141017/14135308796879.jpg\" style=\"width: 685px; height: 617px;\"/></a></p>'),('paipai','http://www.paipai.com/'),('phone','2935409638'),('taobao','http://item.taobao.com/item.htm?spm=686.1000925.1000774.13.75QxGy&id=41722987550'),('work_time','9:00~22:00');
/*!40000 ALTER TABLE `diy_sys` ENABLE KEYS */;

#
# Source for table "diy_user"
#

DROP TABLE IF EXISTS `diy_user`;
CREATE TABLE `diy_user` (
  `id` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `pwd` varchar(255) NOT NULL DEFAULT '',
  `identity` varchar(20) NOT NULL DEFAULT '待激活',
  `real_name` varchar(40) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `account` float(11,2) unsigned DEFAULT '5.00',
  `account_type` varchar(20) DEFAULT NULL,
  `account_name` varchar(40) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "diy_user"
#

/*!40000 ALTER TABLE `diy_user` DISABLE KEYS */;
INSERT INTO `diy_user` VALUES ('101621110124966','hua612','e10adc3949ba59abbe56e057f20f883e','已审核','11111111111111','669631783@qq.com',1.00,'财付通','444444444444444',''),('101708425499244','hua613','e10adc3949ba59abbe56e057f20f883e','已审核','55555555555555555555555','2935409638@qq.com',1.00,'财付通','55555555555555',''),('101711353664994','hua614','e10adc3949ba59abbe56e057f20f883e','已审核','666666666666666666','517452729@qq.com',3.00,'财付通','4444444444444444',''),('101717170998209','hua615','e10adc3949ba59abbe56e057f20f883e','待激活',NULL,'45466@qq.com',5.00,NULL,NULL,NULL),('101717244415440','hua6888','e10adc3949ba59abbe56e057f20f883e','待激活',NULL,'446566@qq.com',5.00,NULL,NULL,NULL),('101717295878576','hua6132','e10adc3949ba59abbe56e057f20f883e','待激活',NULL,'2656565@qq.com',5.00,NULL,NULL,NULL),('101717304437512','hua688','e10adc3949ba59abbe56e057f20f883e','待激活',NULL,'466565@qq.com',5.00,NULL,NULL,NULL);
/*!40000 ALTER TABLE `diy_user` ENABLE KEYS */;

#
# Source for view "diy_group_order_view"
#

DROP VIEW IF EXISTS `diy_group_order_view`;
CREATE VIEW `diy_group_order_view` AS 
  select `diygroup`.`diy_group_order`.`Id` AS `Id`,`diygroup`.`diy_group_order`.`productID` AS `productID`,`diygroup`.`diy_group_order`.`userID` AS `userID`,`diygroup`.`diy_group_order`.`datetime` AS `datetime`,`diygroup`.`diy_product`.`name` AS `productName`,`diygroup`.`diy_product`.`status` AS `status`,`diygroup`.`diy_product`.`total_num` AS `total_num`,`diygroup`.`diy_product`.`current_num` AS `current_num`,`diygroup`.`diy_product`.`time_end` AS `time_end`,`diygroup`.`diy_user`.`name` AS `username` from ((`diygroup`.`diy_group_order` join `diygroup`.`diy_product` on((`diygroup`.`diy_product`.`id` = `diygroup`.`diy_group_order`.`productID`))) join `diygroup`.`diy_user` on((`diygroup`.`diy_user`.`id` = `diygroup`.`diy_group_order`.`userID`)));

#
# Source for view "diy_order_view"
#

DROP VIEW IF EXISTS `diy_order_view`;
CREATE VIEW `diy_order_view` AS 
  select `diygroup`.`diy_order`.`Id` AS `Id`,`diygroup`.`diy_order`.`productID` AS `productID`,`diygroup`.`diy_order`.`productName` AS `productName`,`diygroup`.`diy_order`.`status` AS `orderStatus`,`diygroup`.`diy_order`.`totalPrices` AS `totalPrices`,`diygroup`.`diy_order`.`user` AS `userName`,`diygroup`.`diy_order`.`code` AS `code`,`diygroup`.`diy_product`.`status` AS `productStatus` from (`diygroup`.`diy_order` join `diygroup`.`diy_product` on((`diygroup`.`diy_product`.`id` = `diygroup`.`diy_order`.`productID`)));

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
