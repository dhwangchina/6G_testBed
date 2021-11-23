/*
* SQLyog 企业版 - MySQL GUI v8.14 
* MySQL - 5.5.40 : Database - HdMarket
* File  : 6GtestBed.sql
* Author: Duohua(Edward) Wang
* Email : dhwangchina@gmail.com
* Time  : 10/10/2021
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*
CREATE DATABASE /*!32312 IF NOT EXISTS*/`testWEB` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;*/
/*
CREATE TABLE `users` 
(
  `id`           bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `contact`      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系人姓名',
  `addressDesc`  varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '收货地址明细',
  `postCode`     varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮编',
  `tel`          varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系人电话',
  `createdBy`    bigint(20) DEFAULT NULL COMMENT '创建者',
  `creationDate` datetime   DEFAULT NULL COMMENT '创建时间',
  `modifyBy`     bigint(20) DEFAULT NULL COMMENT '修改者',
  `modifyDate`   datetime   DEFAULT NULL COMMENT '修改时间',
  `userId`       bigint(20) DEFAULT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
*/

CREATE DATABASE  `6GtestBed` ;

USE `6GtestBed`;


/*
DROP TABLE IF EXISTS `XXXXXXTbl`;

CREATE TABLE `XXXXXXTbl`
(
    `devID`      bigint(20)   NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    PRIMARY KEY  (`macAddr`),
    UNIQUE KEY  `devID`(`devID`,`macAddr`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
*/

/*Table structure for table `usersInfoTbl` BGN*/
DROP TABLE IF EXISTS `usersInfoTbl`;

CREATE TABLE `usersInfoTbl` 
(
    `usrid`        bigint(20)   NOT NULL AUTO_INCREMENT COMMENT              'Key ID',
/*    `usrid`        bigint(20)   NOT NULL                             COMMENT 'Key ID',*/
    `name`         varchar(15)  COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name',
    `passwd`       varchar( 50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'password',
    `umail`        varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'userMail',
    `timestamp`    datetime    DEFAULT NULL COMMENT 'created time',
    `logTmStamp`   datetime    DEFAULT NULL COMMENT 'last login time',
    PRIMARY KEY (`usrid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usersInfoTbl(`usrid`,`name`,`passwd`,`umail`, `timestamp`,`logTmStamp`) values(1,'dhwang','123456','dhwangchina@gmail.com',now(),now());
INSERT INTO usersInfoTbl(`usrid`,`name`,`passwd`,`umail`, `timestamp`,`logTmStamp`) values(2,'admin','admin','dhwangchina@gmail.com',now(),now());
/*Table structure for table `usersInfoTbl` END*/

/* Device network parameters table*/
DROP TABLE IF EXISTS `devNetworkTbl`;

CREATE TABLE `devNetworkTbl`
(
    `devID`      bigint(20)   NOT NULL,
    `netType`    tinyint(2)   NOT NULL,/*0:WLAN;1:3G;2:LTE;3:LTE-A;4:5GNR;5:6G*/
    `netRole`    tinyint(2)   NOT NULL,/*0:AP;1:STA;2:3gNodeB;3:3gUE;4:4gNB;5:4gUE;6:5gNB;7:5gUE;8:6gNB;9:6gUE*/
    `homedDevID` bigint(20)   NOT NULL,/*UE's NodeB_ID'*/
    `macAddr`    varchar(18)  NOT NULL UNIQUE,
    `IPv4Addr`   varchar(16)  NOT NULL,
    `portID`     int(4)       NOT NULL,
    `status`     tinyint(1)   NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    PRIMARY KEY  (`macAddr`),
    UNIQUE KEY  `devID`(`devID`,`macAddr`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into devNetworkTbl values(  1,5,8,1,'AA:BB:CC:DD:EE:FF','192.168.0.1',1001,1,now());
insert into devNetworkTbl values(102,5,9,1,'BB:CC:DD:EE:FF:AA','192.168.0.2',1002,1,now());
insert into devNetworkTbl values(103,5,9,1,'CC:DD:EE:FF:AA:BB','192.168.0.3',1003,1,now());
insert into devNetworkTbl values(104,5,9,1,'DD:EE:FF:AA:BB:CC','192.168.0.4',1004,0,now());
insert into devNetworkTbl values(105,5,9,1,'EE:FF:AA:BB:CC:DD','192.168.0.5',1005,0,now());
insert into devNetworkTbl values(106,5,9,1,'FF:AA:BB:CC:DD:EE','192.168.0.6',1006,0,now());

/*Device Event Information table*/
DROP TABLE IF EXISTS `devEventTbl`;

CREATE TABLE `devEventTbl`
(
    `indx`       bigint(20)   NOT NULL AUTO_INCREMENT,
    `devID`      bigint(20)   NOT NULL,
    `eventLevel` tinyint(4)   NOT NULL,
    `eventInfo`  varchar(256) NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    PRIMARY KEY  (`indx`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into devEventTbl values(1,1,2,"Hello world, I'm event info.",now());
/*Device Alarm Infoomation table*/
DROP TABLE IF EXISTS `devAlarmTbl`;

CREATE TABLE `devAlarmTbl`
(
    `indx`      bigint(20)   NOT NULL AUTO_INCREMENT,
    `devID`      bigint(20)   NOT NULL,
    `alarmLevel` tinyint(4)   NOT NULL,
    `alarmInfo`  varchar(256) NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    PRIMARY KEY  (`indx`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into devAlarmTbl values(1,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(2,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(3,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(4,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(5,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(6,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(7,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(8,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(9,1,2,"Hello world, I'm alarm info.",now());
insert into devAlarmTbl values(10,1,2,"Hello world, I'm alarm info.",now());

/*Device Operation Log Information table*/
DROP TABLE IF EXISTS `devLogTbl`;

CREATE TABLE `devLogTbl`
(
    `indx`       bigint(20)   NOT NULL AUTO_INCREMENT,
    `devID`      bigint(20)   NOT NULL,
    `logLevel`   tinyint(4)   NOT NULL,
    `logInfo`    varchar(256) NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    PRIMARY KEY  (`indx`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into devLogTbl values(1,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(2,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(3,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(4,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(5,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(6,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(7,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(8,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(9,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(10,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(11,1,2,"Hello world, I'm OptLog info.",now());
insert into devLogTbl values(12,1,2,"Hello world, I'm OptLog info.",now());

/*Node Radio Performance Parameters table*/
DROP TABLE IF EXISTS `nodeRadioPerfParaTbl`;

CREATE TABLE `nodeRadioPerfParaTbl`
(
    `nodeID`     bigint(20)   NOT NULL,
    `radioID`    bigint(20)   NOT NULL,
    `TxPwr`      bigint(20)   NOT NULL,
    `RxPwr`      bigint(20)   NOT NULL,
    `SNR`        bigint(20)   NOT NULL,
    `RSSI`       bigint(20)   NOT NULL,
    `thrghput`   bigint(20)   NOT NULL,
    `bler`       bigint(20)   NOT NULL,
    `aclr`       bigint(20)   NOT NULL,
    `sem`        bigint(20)   NOT NULL,
    `evm`        bigint(20)   NOT NULL,
    `par`        bigint(20)   NOT NULL,
    `blocking`   bigint(20)   NOT NULL,
    `amSuppr`    bigint(20)   NOT NULL,
    `adjChSuppr` bigint(20)   NOT NULL,
    `coChSuppr`  bigint(20)   NOT NULL,
    `RxSensiv`   bigint(20)   NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    UNIQUE KEY   `radioID`(`radioID`,`nodeID`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*
PRIMARY KEY  (`nodeID`),
ALTER TABLE nodeRadioPerfParaTbl ADD UNIQUE KEY(`nodeID`,`radioID`);
*/

INSERT INTO nodeRadioPerfParaTbl VALUES(1,0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,now());
INSERT INTO nodeRadioPerfParaTbl VALUES(1,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,now());
INSERT INTO nodeRadioPerfParaTbl VALUES(2,0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,now());
INSERT INTO nodeRadioPerfParaTbl VALUES(2,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,now());


/*Node Radio Performance Parameters table*/
DROP TABLE IF EXISTS `nodeNetWorkPerfParaTbl`;

CREATE TABLE `nodeNetWorkPerfParaTbl`
(
    `nodeID`      bigint(20)   NOT NULL,
    `portID`      bigint(20)   NOT NULL,
    `mtu`         bigint(20)   NOT NULL,
    `rate`        bigint(20)   NOT NULL,
    `BandWidth`   bigint(20)   NOT NULL,
    `throughput`  bigint(20)   NOT NULL,
    `delay`       bigint(20)   NOT NULL,
    `rtt`         bigint(20)   NOT NULL,
    `ratio`       bigint(20)   NOT NULL,
    `TxPktNo`     bigint(20)   NOT NULL,
    `TxByteNo`    bigint(20)   NOT NULL,
    `TxPktErrNo`  bigint(20)   NOT NULL,
    `TxByteErrNo` bigint(20)   NOT NULL,
    `RxPktNo`     bigint(20)   NOT NULL,
    `RxByteNo`    bigint(20)   NOT NULL,
    `RxPktErrNo`  bigint(20)   NOT NULL,
    `RxByteErrNo` bigint(20)   NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    UNIQUE KEY   `portID`(`portID`,`nodeID`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO nodeNetWorkPerfParaTbl VALUES(1,0,1500,1000,1000,900,10,32,90,1000,1000,10,10,10,200,200,10,now());
INSERT INTO nodeNetWorkPerfParaTbl VALUES(1,1,1500,1000,1000,900,10,32,90,1000,1000,10,10,10,200,200,10,now());
INSERT INTO nodeNetWorkPerfParaTbl VALUES(2,0,1500,1000,1000,900,10,32,90,1000,1000,10,10,10,200,200,10,now());
INSERT INTO nodeNetWorkPerfParaTbl VALUES(2,1,1500,1000,1000,900,10,32,90,1000,1000,10,10,10,200,200,10,now());

/*Node Radio Performance Parameters table*/
DROP TABLE IF EXISTS `radioKPITbl`;

CREATE TABLE `radioKPITbl`
(
    `nodeID`      bigint(20)   NOT NULL,
    `radioID`     bigint(20)   NOT NULL,
    `bler`        bigint(20)   NOT NULL,
    `thrghput`    bigint(20)   NOT NULL,
    `snr`         bigint(20)   NOT NULL,
    `rssi`        bigint(20)   NOT NULL,
    `evm`         bigint(20)   NOT NULL,
    `rxPwr`       bigint(20)   NOT NULL,
    `timestamp`  datetime     DEFAULT NULL COMMENT 'CreateTime',
    UNIQUE KEY   `radioID`(`radioID`,`nodeID`)
)ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO radioKPITbl VALUES(1,0,10,2000,30,50,4,67,now());
INSERT INTO radioKPITbl VALUES(1,1,10,2000,30,50,4,67,now());
INSERT INTO radioKPITbl VALUES(1,2,10,2000,30,50,4,67,now());
INSERT INTO radioKPITbl VALUES(2,0,10,2000,30,50,4,67,now());
INSERT INTO radioKPITbl VALUES(2,1,10,2000,30,50,4,67,now());
INSERT INTO radioKPITbl VALUES(2,2,10,2000,30,50,4,67,now());
