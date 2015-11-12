CREATE DATABASE IF NOT EXISTS my_test_db;

CREATE TABLE IF NOT EXISTS `BLOGTEST` (
  `PostId` int NOT NULL AUTO_INCREMENT,
  `PostOrder` int DEFAULT NULL,
  `PostCategory` varchar(25) DEFAULT NULL,
  `PostTitle` varchar(50) DEFAULT NULL,
  `PostBrief` varchar(200) DEFAULT NULL,
  `PostDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PostPath` varchar(100) DEFAULT NULL,
  `PostButtonLink` varchar(100) DEFAULT NULL,
  PRIMARY KEY(PostId)
);

INSERT INTO `BLOGTEST`(`PostId`, `PostOrder`, `PostCategory`, `PostTitle`, `PostBrief`, `PostDateTime`, `PostPath`, `PostButtonLink`) 
VALUES (1,1,'Category1','Title1','This is post brief no1.' ,NOW(), 'path1','link1');

INSERT INTO `BLOGTEST`(`PostId`, `PostOrder`, `PostCategory`, `PostTitle`, `PostBrief`, `PostDateTime`, `PostPath`, `PostButtonLink`) 
VALUES (2,2,'Category2','Title2','This is post brief no2.' ,NOW(), 'path2','link2');


