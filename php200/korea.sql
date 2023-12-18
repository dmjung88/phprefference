-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.4.27-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 테이블 korea.board 구조 내보내기
CREATE TABLE IF NOT EXISTS `board` (
  `boardID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memberID` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `regTime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`boardID`)
) ENGINE=InnoDB AUTO_INCREMENT=680 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 korea.controlcss 구조 내보내기
CREATE TABLE IF NOT EXISTS `controlcss` (
  `controlCSSID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `selectorName` enum('wrap','header','leftArea','rightArea','footer') NOT NULL,
  `floata` enum('left','right','none','unset') DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `background` varchar(10) DEFAULT NULL,
  `marginTop` int(11) DEFAULT NULL,
  `marginRight` int(11) DEFAULT NULL,
  `marginBottom` int(11) DEFAULT NULL,
  `marginLeft` int(11) DEFAULT NULL,
  PRIMARY KEY (`controlCSSID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 korea.member 구조 내보내기
CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `pw` varchar(40) DEFAULT NULL,
  `birthday` varchar(10) NOT NULL,
  `regTime` int(11) NOT NULL,
  PRIMARY KEY (`memberID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 korea.realtimekeyword 구조 내보내기
CREATE TABLE IF NOT EXISTS `realtimekeyword` (
  `realtimekeywordID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) DEFAULT NULL,
  `media` enum('naver','daum') DEFAULT NULL,
  `regTime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`realtimekeywordID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 korea.survey 구조 내보내기
CREATE TABLE IF NOT EXISTS `survey` (
  `surveyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memberID` int(10) unsigned DEFAULT NULL,
  `kind` enum('offlineStore','onlineStore','website','friends','academy','noMemory','etc') DEFAULT NULL,
  `regTime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`surveyID`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
