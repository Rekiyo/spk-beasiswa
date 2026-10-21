-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2026 at 04:24 AM
-- Server version: 8.4.11
-- PHP Version: 8.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-roster:project:v3:77edf260886afc93d2bf967a16bb3bad', 'O:26:\"Laravel\\Roster\\ProjectScan\":8:{s:8:\"basePath\";s:28:\"C:\\laragon\\www\\spk-beasiswa\\\";s:3:\"php\";O:35:\"Laravel\\Roster\\Ecosystems\\Ecosystem\":2:{s:9:\"\0*\0byName\";a:115:{s:10:\"brick/math\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"brick/math\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";E:43:\"Laravel\\Roster\\Enums\\PackageSource:Composer\";s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\brick\\math\";}s:31:\"carbonphp/carbon-doctrine-types\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"carbonphp/carbon-doctrine-types\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\carbonphp\\carbon-doctrine-types\";}s:23:\"dflydev/dot-access-data\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"dflydev/dot-access-data\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\dflydev\\dot-access-data\";}s:18:\"doctrine/inflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"doctrine/inflector\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\doctrine\\inflector\";}s:14:\"doctrine/lexer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"doctrine/lexer\";s:10:\"\0*\0version\";s:5:\"3.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\doctrine\\lexer\";}s:29:\"dragonmantank/cron-expression\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"dragonmantank/cron-expression\";s:10:\"\0*\0version\";s:5:\"3.6.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\dragonmantank\\cron-expression\";}s:23:\"egulias/email-validator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"egulias/email-validator\";s:10:\"\0*\0version\";s:5:\"4.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\egulias\\email-validator\";}s:18:\"fruitcake/php-cors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"fruitcake/php-cors\";s:10:\"\0*\0version\";s:5:\"1.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\fruitcake\\php-cors\";}s:27:\"graham-campbell/result-type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"graham-campbell/result-type\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\graham-campbell\\result-type\";}s:17:\"guzzlehttp/guzzle\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"guzzlehttp/guzzle\";s:10:\"\0*\0version\";s:5:\"8.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\guzzlehttp\\guzzle\";}s:19:\"guzzlehttp/promises\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"guzzlehttp/promises\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\guzzlehttp\\promises\";}s:15:\"guzzlehttp/psr7\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"guzzlehttp/psr7\";s:10:\"\0*\0version\";s:5:\"3.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\guzzlehttp\\psr7\";}s:23:\"guzzlehttp/uri-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"guzzlehttp/uri-template\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\guzzlehttp\\uri-template\";}s:17:\"laravel/framework\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"13.35.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^13.17\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\framework\";}s:15:\"laravel/prompts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.25\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\prompts\";}s:28:\"laravel/serializable-closure\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"laravel/serializable-closure\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\serializable-closure\";}s:14:\"laravel/tinker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/tinker\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.0\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\tinker\";}s:17:\"league/commonmark\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"league/commonmark\";s:10:\"\0*\0version\";s:6:\"2.10.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\commonmark\";}s:13:\"league/config\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"league/config\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\config\";}s:16:\"league/flysystem\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"league/flysystem\";s:10:\"\0*\0version\";s:6:\"3.36.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\flysystem\";}s:22:\"league/flysystem-local\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"league/flysystem-local\";s:10:\"\0*\0version\";s:6:\"3.35.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\flysystem-local\";}s:26:\"league/mime-type-detection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"league/mime-type-detection\";s:10:\"\0*\0version\";s:6:\"1.17.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\mime-type-detection\";}s:10:\"league/uri\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"league/uri\";s:10:\"\0*\0version\";s:5:\"7.8.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\uri\";}s:21:\"league/uri-interfaces\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"league/uri-interfaces\";s:10:\"\0*\0version\";s:5:\"7.8.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\league\\uri-interfaces\";}s:15:\"monolog/monolog\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"monolog/monolog\";s:10:\"\0*\0version\";s:6:\"3.12.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\monolog\\monolog\";}s:13:\"nesbot/carbon\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"nesbot/carbon\";s:10:\"\0*\0version\";s:6:\"3.14.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nesbot\\carbon\";}s:12:\"nette/schema\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"nette/schema\";s:10:\"\0*\0version\";s:5:\"1.3.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nette\\schema\";}s:11:\"nette/utils\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"nette/utils\";s:10:\"\0*\0version\";s:5:\"4.1.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nette\\utils\";}s:16:\"nikic/php-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"nikic/php-parser\";s:10:\"\0*\0version\";s:5:\"5.9.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nikic\\php-parser\";}s:19:\"nunomaduro/termwind\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"nunomaduro/termwind\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nunomaduro\\termwind\";}s:19:\"phpoption/phpoption\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpoption/phpoption\";s:10:\"\0*\0version\";s:6:\"1.10.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpoption\\phpoption\";}s:9:\"psr/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psr/clock\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\clock\";}s:13:\"psr/container\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"psr/container\";s:10:\"\0*\0version\";s:5:\"2.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\container\";}s:20:\"psr/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"psr/event-dispatcher\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\event-dispatcher\";}s:15:\"psr/http-client\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"psr/http-client\";s:10:\"\0*\0version\";s:5:\"1.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\http-client\";}s:16:\"psr/http-factory\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-factory\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\http-factory\";}s:16:\"psr/http-message\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/http-message\";s:10:\"\0*\0version\";s:3:\"2.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\http-message\";}s:7:\"psr/log\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"psr/log\";s:10:\"\0*\0version\";s:5:\"3.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:42:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\log\";}s:16:\"psr/simple-cache\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"psr/simple-cache\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psr\\simple-cache\";}s:9:\"psy/psysh\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"psy/psysh\";s:10:\"\0*\0version\";s:7:\"0.12.24\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\psy\\psysh\";}s:17:\"ramsey/collection\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"ramsey/collection\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\ramsey\\collection\";}s:11:\"ramsey/uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"ramsey/uuid\";s:10:\"\0*\0version\";s:5:\"4.9.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\ramsey\\uuid\";}s:13:\"symfony/clock\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"symfony/clock\";s:10:\"\0*\0version\";s:5:\"7.4.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\clock\";}s:15:\"symfony/console\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/console\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\console\";}s:20:\"symfony/css-selector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"symfony/css-selector\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\css-selector\";}s:29:\"symfony/deprecation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/deprecation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\deprecation-contracts\";}s:21:\"symfony/error-handler\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/error-handler\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\error-handler\";}s:24:\"symfony/event-dispatcher\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"symfony/event-dispatcher\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\event-dispatcher\";}s:34:\"symfony/event-dispatcher-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"symfony/event-dispatcher-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\event-dispatcher-contracts\";}s:14:\"symfony/finder\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/finder\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\finder\";}s:23:\"symfony/http-foundation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"symfony/http-foundation\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\http-foundation\";}s:19:\"symfony/http-kernel\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/http-kernel\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\http-kernel\";}s:14:\"symfony/mailer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/mailer\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\mailer\";}s:12:\"symfony/mime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/mime\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\mime\";}s:22:\"symfony/polyfill-ctype\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-ctype\";s:10:\"\0*\0version\";s:6:\"1.37.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-ctype\";}s:30:\"symfony/polyfill-intl-grapheme\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"symfony/polyfill-intl-grapheme\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-intl-grapheme\";}s:25:\"symfony/polyfill-intl-idn\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-intl-idn\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-intl-idn\";}s:32:\"symfony/polyfill-intl-normalizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"symfony/polyfill-intl-normalizer\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-intl-normalizer\";}s:25:\"symfony/polyfill-mbstring\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/polyfill-mbstring\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-mbstring\";}s:22:\"symfony/polyfill-php80\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php80\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php80\";}s:22:\"symfony/polyfill-php82\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php82\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php82\";}s:22:\"symfony/polyfill-php83\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php83\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php83\";}s:22:\"symfony/polyfill-php84\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php84\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php84\";}s:22:\"symfony/polyfill-php85\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php85\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php85\";}s:22:\"symfony/polyfill-php86\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"symfony/polyfill-php86\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-php86\";}s:21:\"symfony/polyfill-uuid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"symfony/polyfill-uuid\";s:10:\"\0*\0version\";s:6:\"1.43.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\polyfill-uuid\";}s:15:\"symfony/process\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/process\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\process\";}s:15:\"symfony/routing\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"symfony/routing\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\routing\";}s:25:\"symfony/service-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"symfony/service-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\service-contracts\";}s:14:\"symfony/string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"symfony/string\";s:10:\"\0*\0version\";s:6:\"7.4.19\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\string\";}s:19:\"symfony/translation\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"symfony/translation\";s:10:\"\0*\0version\";s:6:\"7.4.17\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\translation\";}s:29:\"symfony/translation-contracts\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"symfony/translation-contracts\";s:10:\"\0*\0version\";s:5:\"3.7.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\translation-contracts\";}s:11:\"symfony/uid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"symfony/uid\";s:10:\"\0*\0version\";s:6:\"7.4.20\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\uid\";}s:18:\"symfony/var-dumper\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"symfony/var-dumper\";s:10:\"\0*\0version\";s:6:\"7.4.18\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\var-dumper\";}s:33:\"tijsverkoyen/css-to-inline-styles\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"tijsverkoyen/css-to-inline-styles\";s:10:\"\0*\0version\";s:5:\"2.4.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\tijsverkoyen\\css-to-inline-styles\";}s:16:\"vlucas/phpdotenv\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"vlucas/phpdotenv\";s:10:\"\0*\0version\";s:5:\"5.7.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\vlucas\\phpdotenv\";}s:19:\"voku/portable-ascii\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"voku/portable-ascii\";s:10:\"\0*\0version\";s:5:\"2.1.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\voku\\portable-ascii\";}s:15:\"composer/semver\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"composer/semver\";s:10:\"\0*\0version\";s:5:\"3.5.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\composer\\semver\";}s:14:\"fakerphp/faker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"fakerphp/faker\";s:10:\"\0*\0version\";s:6:\"1.24.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.23\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\fakerphp\\faker\";}s:11:\"filp/whoops\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"filp/whoops\";s:10:\"\0*\0version\";s:6:\"2.18.6\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\filp\\whoops\";}s:21:\"hamcrest/hamcrest-php\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"hamcrest/hamcrest-php\";s:10:\"\0*\0version\";s:5:\"3.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\hamcrest\\hamcrest-php\";}s:22:\"laravel/agent-detector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"laravel/agent-detector\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\agent-detector\";}s:13:\"laravel/boost\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"laravel/boost\";s:10:\"\0*\0version\";s:6:\"2.10.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^2.10\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\boost\";}s:11:\"laravel/mcp\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"1.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\mcp\";}s:12:\"laravel/pail\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pail\";s:10:\"\0*\0version\";s:5:\"1.2.7\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.2.5\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\pail\";}s:11:\"laravel/pao\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"laravel/pao\";s:10:\"\0*\0version\";s:5:\"1.1.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.0.6\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\pao\";}s:12:\"laravel/pint\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.32.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.27\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\pint\";}s:14:\"laravel/roster\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"laravel/roster\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\laravel\\roster\";}s:15:\"mockery/mockery\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"mockery/mockery\";s:10:\"\0*\0version\";s:6:\"1.6.15\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^1.6\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\mockery\\mockery\";}s:17:\"myclabs/deep-copy\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"myclabs/deep-copy\";s:10:\"\0*\0version\";s:6:\"1.14.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\myclabs\\deep-copy\";}s:20:\"nunomaduro/collision\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"nunomaduro/collision\";s:10:\"\0*\0version\";s:5:\"8.9.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^8.6\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\nunomaduro\\collision\";}s:16:\"phar-io/manifest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"phar-io/manifest\";s:10:\"\0*\0version\";s:5:\"2.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phar-io\\manifest\";}s:15:\"phar-io/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phar-io/version\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phar-io\\version\";}s:25:\"phpunit/php-code-coverage\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-code-coverage\";s:10:\"\0*\0version\";s:6:\"12.5.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\php-code-coverage\";}s:25:\"phpunit/php-file-iterator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-file-iterator\";s:10:\"\0*\0version\";s:5:\"6.0.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\php-file-iterator\";}s:19:\"phpunit/php-invoker\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"phpunit/php-invoker\";s:10:\"\0*\0version\";s:5:\"6.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\php-invoker\";}s:25:\"phpunit/php-text-template\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"phpunit/php-text-template\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\php-text-template\";}s:17:\"phpunit/php-timer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"phpunit/php-timer\";s:10:\"\0*\0version\";s:5:\"8.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\php-timer\";}s:15:\"phpunit/phpunit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"12.5.38\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:8:\"^12.5.12\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\phpunit\\phpunit\";}s:20:\"sebastian/cli-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/cli-parser\";s:10:\"\0*\0version\";s:5:\"4.2.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\cli-parser\";}s:20:\"sebastian/comparator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/comparator\";s:10:\"\0*\0version\";s:5:\"7.1.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\comparator\";}s:20:\"sebastian/complexity\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"sebastian/complexity\";s:10:\"\0*\0version\";s:5:\"5.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\complexity\";}s:14:\"sebastian/diff\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/diff\";s:10:\"\0*\0version\";s:5:\"7.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\diff\";}s:21:\"sebastian/environment\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"sebastian/environment\";s:10:\"\0*\0version\";s:5:\"8.1.2\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\environment\";}s:18:\"sebastian/exporter\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"sebastian/exporter\";s:10:\"\0*\0version\";s:5:\"7.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\exporter\";}s:22:\"sebastian/global-state\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:22:\"sebastian/global-state\";s:10:\"\0*\0version\";s:5:\"8.0.3\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\global-state\";}s:23:\"sebastian/lines-of-code\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"sebastian/lines-of-code\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\lines-of-code\";}s:27:\"sebastian/object-enumerator\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/object-enumerator\";s:10:\"\0*\0version\";s:5:\"7.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\object-enumerator\";}s:26:\"sebastian/object-reflector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"sebastian/object-reflector\";s:10:\"\0*\0version\";s:5:\"5.0.0\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\object-reflector\";}s:27:\"sebastian/recursion-context\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"sebastian/recursion-context\";s:10:\"\0*\0version\";s:5:\"7.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\recursion-context\";}s:14:\"sebastian/type\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"sebastian/type\";s:10:\"\0*\0version\";s:5:\"6.0.4\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\type\";}s:17:\"sebastian/version\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"sebastian/version\";s:10:\"\0*\0version\";s:5:\"6.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\sebastian\\version\";}s:28:\"staabm/side-effects-detector\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"staabm/side-effects-detector\";s:10:\"\0*\0version\";s:5:\"1.0.5\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:63:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\staabm\\side-effects-detector\";}s:12:\"symfony/yaml\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"symfony/yaml\";s:10:\"\0*\0version\";s:5:\"8.1.8\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\symfony\\yaml\";}s:17:\"theseer/tokenizer\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"theseer/tokenizer\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:8;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\vendor\\theseer\\tokenizer\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:115:{i:0;r:5;i:1;r:13;i:2;r:21;i:3;r:29;i:4;r:37;i:5;r:45;i:6;r:53;i:7;r:61;i:8;r:69;i:9;r:77;i:10;r:85;i:11;r:93;i:12;r:101;i:13;r:109;i:14;r:117;i:15;r:125;i:16;r:133;i:17;r:141;i:18;r:149;i:19;r:157;i:20;r:165;i:21;r:173;i:22;r:181;i:23;r:189;i:24;r:197;i:25;r:205;i:26;r:213;i:27;r:221;i:28;r:229;i:29;r:237;i:30;r:245;i:31;r:253;i:32;r:261;i:33;r:269;i:34;r:277;i:35;r:285;i:36;r:293;i:37;r:301;i:38;r:309;i:39;r:317;i:40;r:325;i:41;r:333;i:42;r:341;i:43;r:349;i:44;r:357;i:45;r:365;i:46;r:373;i:47;r:381;i:48;r:389;i:49;r:397;i:50;r:405;i:51;r:413;i:52;r:421;i:53;r:429;i:54;r:437;i:55;r:445;i:56;r:453;i:57;r:461;i:58;r:469;i:59;r:477;i:60;r:485;i:61;r:493;i:62;r:501;i:63;r:509;i:64;r:517;i:65;r:525;i:66;r:533;i:67;r:541;i:68;r:549;i:69;r:557;i:70;r:565;i:71;r:573;i:72;r:581;i:73;r:589;i:74;r:597;i:75;r:605;i:76;r:613;i:77;r:621;i:78;r:629;i:79;r:637;i:80;r:645;i:81;r:653;i:82;r:661;i:83;r:669;i:84;r:677;i:85;r:685;i:86;r:693;i:87;r:701;i:88;r:709;i:89;r:717;i:90;r:725;i:91;r:733;i:92;r:741;i:93;r:749;i:94;r:757;i:95;r:765;i:96;r:773;i:97;r:781;i:98;r:789;i:99;r:797;i:100;r:805;i:101;r:813;i:102;r:821;i:103;r:829;i:104;r:837;i:105;r:845;i:106;r:853;i:107;r:861;i:108;r:869;i:109;r:877;i:110;r:885;i:111;r:893;i:112;r:901;i:113;r:909;i:114;r:917;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:2:\"js\";O:37:\"Laravel\\Roster\\Ecosystems\\JsEcosystem\":3:{s:9:\"\0*\0byName\";a:126:{s:24:\"@alcalzone/ansi-tokenize\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"@alcalzone/ansi-tokenize\";s:10:\"\0*\0version\";s:5:\"0.3.1\";s:9:\"\0*\0source\";E:38:\"Laravel\\Roster\\Enums\\PackageSource:Npm\";s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@alcalzone\\ansi-tokenize\";}s:18:\"@laravel/multiplex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@laravel/multiplex\";s:10:\"\0*\0version\";s:5:\"0.4.5\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^0.4.1\";s:7:\"\0*\0path\";s:59:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@laravel\\multiplex\";}s:12:\"ansi-escapes\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"ansi-escapes\";s:10:\"\0*\0version\";s:5:\"7.3.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\ansi-escapes\";}s:10:\"ansi-regex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"ansi-regex\";s:10:\"\0*\0version\";s:5:\"6.4.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\ansi-regex\";}s:11:\"ansi-styles\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"ansi-styles\";s:10:\"\0*\0version\";s:5:\"6.2.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\ansi-styles\";}s:9:\"auto-bind\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"auto-bind\";s:10:\"\0*\0version\";s:5:\"5.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\auto-bind\";}s:5:\"chalk\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"chalk\";s:10:\"\0*\0version\";s:5:\"5.6.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\chalk\";}s:9:\"cli-boxes\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"cli-boxes\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\cli-boxes\";}s:10:\"cli-cursor\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"cli-cursor\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\cli-cursor\";}s:12:\"cli-truncate\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"cli-truncate\";s:10:\"\0*\0version\";s:5:\"6.1.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\cli-truncate\";}s:12:\"code-excerpt\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"code-excerpt\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\code-excerpt\";}s:9:\"commander\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"commander\";s:10:\"\0*\0version\";s:6:\"15.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\commander\";}s:17:\"convert-to-spaces\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"convert-to-spaces\";s:10:\"\0*\0version\";s:5:\"2.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\convert-to-spaces\";}s:11:\"environment\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"environment\";s:10:\"\0*\0version\";s:5:\"1.1.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\environment\";}s:10:\"es-toolkit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"es-toolkit\";s:10:\"\0*\0version\";s:6:\"1.52.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\es-toolkit\";}s:20:\"escape-string-regexp\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"escape-string-regexp\";s:10:\"\0*\0version\";s:5:\"2.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\escape-string-regexp\";}s:20:\"get-east-asian-width\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"get-east-asian-width\";s:10:\"\0*\0version\";s:5:\"1.7.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\get-east-asian-width\";}s:13:\"indent-string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"indent-string\";s:10:\"\0*\0version\";s:5:\"5.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\indent-string\";}s:3:\"ink\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:3:\"ink\";s:10:\"\0*\0version\";s:5:\"7.1.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:44:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\ink\";}s:23:\"is-fullwidth-code-point\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"is-fullwidth-code-point\";s:10:\"\0*\0version\";s:5:\"5.1.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\is-fullwidth-code-point\";}s:8:\"is-in-ci\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"is-in-ci\";s:10:\"\0*\0version\";s:5:\"2.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\is-in-ci\";}s:8:\"mimic-fn\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"mimic-fn\";s:10:\"\0*\0version\";s:5:\"2.1.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\mimic-fn\";}s:7:\"onetime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"onetime\";s:10:\"\0*\0version\";s:5:\"5.1.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\onetime\";}s:13:\"patch-console\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"patch-console\";s:10:\"\0*\0version\";s:5:\"2.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\patch-console\";}s:5:\"react\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"react\";s:10:\"\0*\0version\";s:6:\"19.3.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\react\";}s:16:\"react-reconciler\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"react-reconciler\";s:10:\"\0*\0version\";s:6:\"0.33.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\react-reconciler\";}s:14:\"restore-cursor\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"restore-cursor\";s:10:\"\0*\0version\";s:5:\"4.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\restore-cursor\";}s:9:\"scheduler\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"scheduler\";s:10:\"\0*\0version\";s:6:\"0.27.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\scheduler\";}s:11:\"signal-exit\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"signal-exit\";s:10:\"\0*\0version\";s:5:\"3.0.7\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\signal-exit\";}s:10:\"slice-ansi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"slice-ansi\";s:10:\"\0*\0version\";s:5:\"9.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\slice-ansi\";}s:11:\"stack-utils\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"stack-utils\";s:10:\"\0*\0version\";s:5:\"2.0.6\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\stack-utils\";}s:10:\"strip-ansi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"strip-ansi\";s:10:\"\0*\0version\";s:5:\"7.2.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\strip-ansi\";}s:10:\"tagged-tag\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"tagged-tag\";s:10:\"\0*\0version\";s:5:\"1.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tagged-tag\";}s:13:\"terminal-size\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"terminal-size\";s:10:\"\0*\0version\";s:5:\"4.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\terminal-size\";}s:9:\"type-fest\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"type-fest\";s:10:\"\0*\0version\";s:6:\"5.10.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\type-fest\";}s:11:\"widest-line\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"widest-line\";s:10:\"\0*\0version\";s:5:\"6.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\widest-line\";}s:2:\"ws\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:2:\"ws\";s:10:\"\0*\0version\";s:6:\"8.22.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:43:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\ws\";}s:11:\"yoga-layout\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"yoga-layout\";s:10:\"\0*\0version\";s:5:\"3.2.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:0;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\yoga-layout\";}s:23:\"@jridgewell/gen-mapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"@jridgewell/gen-mapping\";s:10:\"\0*\0version\";s:6:\"0.3.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@jridgewell\\gen-mapping\";}s:21:\"@jridgewell/remapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@jridgewell/remapping\";s:10:\"\0*\0version\";s:5:\"2.3.5\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@jridgewell\\remapping\";}s:23:\"@jridgewell/resolve-uri\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"@jridgewell/resolve-uri\";s:10:\"\0*\0version\";s:5:\"3.1.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@jridgewell\\resolve-uri\";}s:27:\"@jridgewell/sourcemap-codec\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"@jridgewell/sourcemap-codec\";s:10:\"\0*\0version\";s:5:\"1.6.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@jridgewell\\sourcemap-codec\";}s:25:\"@jridgewell/trace-mapping\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"@jridgewell/trace-mapping\";s:10:\"\0*\0version\";s:6:\"0.3.31\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@jridgewell\\trace-mapping\";}s:18:\"@oxc-project/types\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@oxc-project/types\";s:10:\"\0*\0version\";s:7:\"0.153.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@oxc-project\\types\";}s:34:\"@rolldown/binding-android-arm-eabi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@rolldown/binding-android-arm-eabi\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:75:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-android-arm-eabi\";}s:31:\"@rolldown/binding-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rolldown/binding-android-arm64\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:72:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-android-arm64\";}s:30:\"@rolldown/binding-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@rolldown/binding-darwin-arm64\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-darwin-arm64\";}s:28:\"@rolldown/binding-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"@rolldown/binding-darwin-x64\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-darwin-x64\";}s:29:\"@rolldown/binding-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@rolldown/binding-freebsd-x64\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-freebsd-x64\";}s:37:\"@rolldown/binding-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:37:\"@rolldown/binding-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:78:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-arm-gnueabihf\";}s:33:\"@rolldown/binding-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@rolldown/binding-linux-arm64-gnu\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-arm64-gnu\";}s:34:\"@rolldown/binding-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@rolldown/binding-linux-arm64-musl\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:75:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-arm64-musl\";}s:33:\"@rolldown/binding-linux-ppc64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@rolldown/binding-linux-ppc64-gnu\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-ppc64-gnu\";}s:33:\"@rolldown/binding-linux-s390x-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@rolldown/binding-linux-s390x-gnu\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-s390x-gnu\";}s:31:\"@rolldown/binding-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@rolldown/binding-linux-x64-gnu\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:72:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-x64-gnu\";}s:32:\"@rolldown/binding-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@rolldown/binding-linux-x64-musl\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-linux-x64-musl\";}s:35:\"@rolldown/binding-openharmony-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@rolldown/binding-openharmony-arm64\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:76:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-openharmony-arm64\";}s:34:\"@rolldown/binding-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@rolldown/binding-win32-arm64-msvc\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:75:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-win32-arm64-msvc\";}s:32:\"@rolldown/binding-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@rolldown/binding-win32-x64-msvc\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\binding-win32-x64-msvc\";}s:21:\"@rolldown/pluginutils\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@rolldown/pluginutils\";s:10:\"\0*\0version\";s:5:\"1.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@rolldown\\pluginutils\";}s:17:\"@tailwindcss/node\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@tailwindcss/node\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\node\";}s:18:\"@tailwindcss/oxide\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:18:\"@tailwindcss/oxide\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:59:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide\";}s:32:\"@tailwindcss/oxide-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@tailwindcss/oxide-android-arm64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-android-arm64\";}s:31:\"@tailwindcss/oxide-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:31:\"@tailwindcss/oxide-darwin-arm64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:72:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-darwin-arm64\";}s:29:\"@tailwindcss/oxide-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"@tailwindcss/oxide-darwin-x64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-darwin-x64\";}s:30:\"@tailwindcss/oxide-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@tailwindcss/oxide-freebsd-x64\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-freebsd-x64\";}s:38:\"@tailwindcss/oxide-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:38:\"@tailwindcss/oxide-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:79:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-linux-arm-gnueabihf\";}s:34:\"@tailwindcss/oxide-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:34:\"@tailwindcss/oxide-linux-arm64-gnu\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:75:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-linux-arm64-gnu\";}s:35:\"@tailwindcss/oxide-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@tailwindcss/oxide-linux-arm64-musl\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:76:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-linux-arm64-musl\";}s:32:\"@tailwindcss/oxide-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"@tailwindcss/oxide-linux-x64-gnu\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-linux-x64-gnu\";}s:33:\"@tailwindcss/oxide-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@tailwindcss/oxide-linux-x64-musl\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-linux-x64-musl\";}s:30:\"@tailwindcss/oxide-wasm32-wasi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:30:\"@tailwindcss/oxide-wasm32-wasi\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:71:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-wasm32-wasi\";}s:35:\"@tailwindcss/oxide-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:35:\"@tailwindcss/oxide-win32-arm64-msvc\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:76:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-win32-arm64-msvc\";}s:33:\"@tailwindcss/oxide-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:33:\"@tailwindcss/oxide-win32-x64-msvc\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:74:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\oxide-win32-x64-msvc\";}s:17:\"@tailwindcss/vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:17:\"@tailwindcss/vite\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:58:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tailwindcss\\vite\";}s:5:\"cliui\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"cliui\";s:10:\"\0*\0version\";s:5:\"9.0.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\cliui\";}s:12:\"concurrently\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"concurrently\";s:10:\"\0*\0version\";s:6:\"10.0.6\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:7:\"^10.0.3\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\concurrently\";}s:11:\"detect-libc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"detect-libc\";s:10:\"\0*\0version\";s:5:\"2.1.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\detect-libc\";}s:11:\"emoji-regex\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"emoji-regex\";s:10:\"\0*\0version\";s:6:\"10.6.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\emoji-regex\";}s:16:\"enhanced-resolve\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"enhanced-resolve\";s:10:\"\0*\0version\";s:6:\"5.26.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\enhanced-resolve\";}s:8:\"escalade\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"escalade\";s:10:\"\0*\0version\";s:5:\"3.2.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\escalade\";}s:4:\"fdir\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"fdir\";s:10:\"\0*\0version\";s:5:\"6.5.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\fdir\";}s:8:\"fsevents\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"fsevents\";s:10:\"\0*\0version\";s:5:\"2.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\fsevents\";}s:15:\"get-caller-file\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"get-caller-file\";s:10:\"\0*\0version\";s:5:\"2.0.5\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\get-caller-file\";}s:11:\"graceful-fs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"graceful-fs\";s:10:\"\0*\0version\";s:6:\"4.2.11\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\graceful-fs\";}s:4:\"jiti\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"jiti\";s:10:\"\0*\0version\";s:5:\"2.7.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\jiti\";}s:19:\"laravel-vite-plugin\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:19:\"laravel-vite-plugin\";s:10:\"\0*\0version\";s:5:\"3.2.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.1\";s:7:\"\0*\0path\";s:60:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\laravel-vite-plugin\";}s:12:\"lightningcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"lightningcss\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss\";}s:26:\"lightningcss-android-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"lightningcss-android-arm64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-android-arm64\";}s:25:\"lightningcss-darwin-arm64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:25:\"lightningcss-darwin-arm64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:66:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-darwin-arm64\";}s:23:\"lightningcss-darwin-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"lightningcss-darwin-x64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-darwin-x64\";}s:24:\"lightningcss-freebsd-x64\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:24:\"lightningcss-freebsd-x64\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:65:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-freebsd-x64\";}s:32:\"lightningcss-linux-arm-gnueabihf\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:32:\"lightningcss-linux-arm-gnueabihf\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:73:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-linux-arm-gnueabihf\";}s:28:\"lightningcss-linux-arm64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:28:\"lightningcss-linux-arm64-gnu\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:69:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-linux-arm64-gnu\";}s:29:\"lightningcss-linux-arm64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"lightningcss-linux-arm64-musl\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-linux-arm64-musl\";}s:26:\"lightningcss-linux-x64-gnu\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:26:\"lightningcss-linux-x64-gnu\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:67:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-linux-x64-gnu\";}s:27:\"lightningcss-linux-x64-musl\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"lightningcss-linux-x64-musl\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-linux-x64-musl\";}s:29:\"lightningcss-win32-arm64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:29:\"lightningcss-win32-arm64-msvc\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:70:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-win32-arm64-msvc\";}s:27:\"lightningcss-win32-x64-msvc\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:27:\"lightningcss-win32-x64-msvc\";s:10:\"\0*\0version\";s:6:\"1.32.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:68:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\lightningcss-win32-x64-msvc\";}s:12:\"magic-string\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"magic-string\";s:10:\"\0*\0version\";s:7:\"0.30.21\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\magic-string\";}s:6:\"nanoid\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:6:\"nanoid\";s:10:\"\0*\0version\";s:6:\"3.3.20\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:47:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\nanoid\";}s:10:\"picocolors\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"picocolors\";s:10:\"\0*\0version\";s:5:\"1.1.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\picocolors\";}s:9:\"picomatch\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"picomatch\";s:10:\"\0*\0version\";s:5:\"4.0.7\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\picomatch\";}s:7:\"postcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"postcss\";s:10:\"\0*\0version\";s:6:\"8.5.29\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\postcss\";}s:8:\"rolldown\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:8:\"rolldown\";s:10:\"\0*\0version\";s:6:\"1.2.13\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:49:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\rolldown\";}s:4:\"rxjs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"rxjs\";s:10:\"\0*\0version\";s:5:\"7.8.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\rxjs\";}s:11:\"shell-quote\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"shell-quote\";s:10:\"\0*\0version\";s:6:\"1.12.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\shell-quote\";}s:13:\"source-map-js\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:13:\"source-map-js\";s:10:\"\0*\0version\";s:5:\"1.2.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:54:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\source-map-js\";}s:12:\"string-width\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"string-width\";s:10:\"\0*\0version\";s:5:\"7.2.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\string-width\";}s:14:\"supports-color\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:14:\"supports-color\";s:10:\"\0*\0version\";s:6:\"10.2.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:55:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\supports-color\";}s:11:\"tailwindcss\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:5:\"4.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:7:\"\0*\0path\";s:52:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tailwindcss\";}s:7:\"tapable\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:7:\"tapable\";s:10:\"\0*\0version\";s:5:\"2.3.3\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:48:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tapable\";}s:10:\"tinyglobby\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:10:\"tinyglobby\";s:10:\"\0*\0version\";s:6:\"0.2.17\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:51:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tinyglobby\";}s:9:\"tree-kill\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"tree-kill\";s:10:\"\0*\0version\";s:5:\"1.2.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tree-kill\";}s:5:\"tslib\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"tslib\";s:10:\"\0*\0version\";s:5:\"2.8.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\tslib\";}s:4:\"vite\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"vite\";s:10:\"\0*\0version\";s:5:\"8.3.4\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^8.0.0\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\vite\";}s:23:\"vite-plugin-full-reload\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:23:\"vite-plugin-full-reload\";s:10:\"\0*\0version\";s:5:\"1.2.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:64:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\vite-plugin-full-reload\";}s:9:\"wrap-ansi\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:9:\"wrap-ansi\";s:10:\"\0*\0version\";s:5:\"9.0.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:50:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\wrap-ansi\";}s:4:\"y18n\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:4:\"y18n\";s:10:\"\0*\0version\";s:5:\"5.0.8\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:45:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\y18n\";}s:5:\"yargs\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:5:\"yargs\";s:10:\"\0*\0version\";s:6:\"18.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:46:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\yargs\";}s:12:\"yargs-parser\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"yargs-parser\";s:10:\"\0*\0version\";s:6:\"22.0.0\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\yargs-parser\";}s:12:\"@emnapi/core\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:12:\"@emnapi/core\";s:10:\"\0*\0version\";s:6:\"1.11.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:53:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@emnapi\\core\";}s:15:\"@emnapi/runtime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:15:\"@emnapi/runtime\";s:10:\"\0*\0version\";s:6:\"1.11.1\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:56:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@emnapi\\runtime\";}s:20:\"@emnapi/wasi-threads\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:20:\"@emnapi/wasi-threads\";s:10:\"\0*\0version\";s:5:\"1.2.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:61:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@emnapi\\wasi-threads\";}s:21:\"@napi-rs/wasm-runtime\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:21:\"@napi-rs/wasm-runtime\";s:10:\"\0*\0version\";s:5:\"1.1.4\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:62:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@napi-rs\\wasm-runtime\";}s:16:\"@tybys/wasm-util\";O:22:\"Laravel\\Roster\\Package\":7:{s:7:\"\0*\0name\";s:16:\"@tybys/wasm-util\";s:10:\"\0*\0version\";s:6:\"0.10.2\";s:9:\"\0*\0source\";r:1048;s:6:\"\0*\0dev\";b:1;s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:7:\"\0*\0path\";s:57:\"C:\\laragon\\www\\spk-beasiswa\\node_modules\\@tybys\\wasm-util\";}}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:126:{i:0;r:1045;i:1;r:1053;i:2;r:1061;i:3;r:1069;i:4;r:1077;i:5;r:1085;i:6;r:1093;i:7;r:1101;i:8;r:1109;i:9;r:1117;i:10;r:1125;i:11;r:1133;i:12;r:1141;i:13;r:1149;i:14;r:1157;i:15;r:1165;i:16;r:1173;i:17;r:1181;i:18;r:1189;i:19;r:1197;i:20;r:1205;i:21;r:1213;i:22;r:1221;i:23;r:1229;i:24;r:1237;i:25;r:1245;i:26;r:1253;i:27;r:1261;i:28;r:1269;i:29;r:1277;i:30;r:1285;i:31;r:1293;i:32;r:1301;i:33;r:1309;i:34;r:1317;i:35;r:1325;i:36;r:1333;i:37;r:1341;i:38;r:1349;i:39;r:1357;i:40;r:1365;i:41;r:1373;i:42;r:1381;i:43;r:1389;i:44;r:1397;i:45;r:1405;i:46;r:1413;i:47;r:1421;i:48;r:1429;i:49;r:1437;i:50;r:1445;i:51;r:1453;i:52;r:1461;i:53;r:1469;i:54;r:1477;i:55;r:1485;i:56;r:1493;i:57;r:1501;i:58;r:1509;i:59;r:1517;i:60;r:1525;i:61;r:1533;i:62;r:1541;i:63;r:1549;i:64;r:1557;i:65;r:1565;i:66;r:1573;i:67;r:1581;i:68;r:1589;i:69;r:1597;i:70;r:1605;i:71;r:1613;i:72;r:1621;i:73;r:1629;i:74;r:1637;i:75;r:1645;i:76;r:1653;i:77;r:1661;i:78;r:1669;i:79;r:1677;i:80;r:1685;i:81;r:1693;i:82;r:1701;i:83;r:1709;i:84;r:1717;i:85;r:1725;i:86;r:1733;i:87;r:1741;i:88;r:1749;i:89;r:1757;i:90;r:1765;i:91;r:1773;i:92;r:1781;i:93;r:1789;i:94;r:1797;i:95;r:1805;i:96;r:1813;i:97;r:1821;i:98;r:1829;i:99;r:1837;i:100;r:1845;i:101;r:1853;i:102;r:1861;i:103;r:1869;i:104;r:1877;i:105;r:1885;i:106;r:1893;i:107;r:1901;i:108;r:1909;i:109;r:1917;i:110;r:1925;i:111;r:1933;i:112;r:1941;i:113;r:1949;i:114;r:1957;i:115;r:1965;i:116;r:1973;i:117;r:1981;i:118;r:1989;i:119;r:1997;i:120;r:2005;i:121;r:2013;i:122;r:2021;i:123;r:2029;i:124;r:2037;i:125;r:2045;}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:17:\"\0*\0packageManager\";E:41:\"Laravel\\Roster\\Enums\\JsPackageManager:Npm\";}s:6:\"stacks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:1:{i:0;E:32:\"Laravel\\Roster\\Enums\\Stack:Blade\";}}s:21:\"browserTestFrameworks\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:9:\"frontends\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}s:6:\"agents\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:2:{i:0;E:37:\"Laravel\\Roster\\Enums\\Agent:ClaudeCode\";i:1;E:32:\"Laravel\\Roster\\Enums\\Agent:Codex\";}}s:7:\"editors\";O:30:\"Laravel\\Roster\\Support\\EnumSet\":1:{s:8:\"\0*\0cases\";a:0:{}}}', 1792423628);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calon_penerimas`
--

CREATE TABLE `calon_penerimas` (
  `id` bigint UNSIGNED NOT NULL,
  `periode_id` bigint UNSIGNED NOT NULL,
  `nim` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_studi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Semester 5',
  `jalur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Reguler Pagi',
  `skor_saw` decimal(8,4) DEFAULT NULL,
  `ranking` int UNSIGNED DEFAULT NULL,
  `status_kelulusan` enum('lolos','cadangan','tidak_lolos') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak_lolos',
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calon_penerimas`
--

INSERT INTO `calon_penerimas` (`id`, `periode_id`, `nim`, `nama`, `program_studi`, `semester`, `jalur`, `skor_saw`, `ranking`, `status_kelulusan`, `catatan`, `created_at`, `updated_at`) VALUES
(31, 7, '80001000', 'Rina Santoso', 'Otomotif', 'XI TKR 1', 'Reguler Prestasi SMK', 0.7567, 12, 'lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(32, 7, '80001001', 'Andi Indah', 'Akuntansi', 'X AKL 1', 'Reguler Prestasi SMK', 0.7129, 22, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(33, 7, '80001002', 'Sari Lestari', 'Otomotif', 'XII TKR 3', 'Reguler Prestasi SMK', 0.6632, 58, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(34, 7, '80001003', 'Budi Hidayat', 'Teknik Komputer & Jaringan', 'XII TKJ 2', 'Reguler Prestasi SMK', 0.6406, 77, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(35, 7, '80001004', 'Andi Setiawan', 'Rekayasa Perangkat Lunak', 'XI RPL 2', 'Reguler Prestasi SMK', 0.8333, 5, 'lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(36, 7, '80001005', 'Rina Kurniawan', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.6406, 78, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(37, 7, '80001006', 'Siti Saputra', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.7065, 24, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(38, 7, '80001007', 'Lia Pratama', 'Desain Komunikasi Visual', 'XI DKV 1', 'Reguler Prestasi SMK', 0.8128, 6, 'lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(39, 7, '80001008', 'Sari Wahyuni', 'Teknik Komputer & Jaringan', 'X TKJ 2', 'Reguler Prestasi SMK', 0.5543, 141, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(40, 7, '80001009', 'Siti Lestari', 'Rekayasa Perangkat Lunak', 'XI RPL 2', 'Reguler Prestasi SMK', 0.6776, 49, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(41, 7, '80001010', 'Joko Saputra', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.5084, 164, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(42, 7, '80001011', 'Sari Wijaya', 'Otomotif', 'XII TKR 2', 'Reguler Prestasi SMK', 0.5956, 115, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(43, 7, '80001012', 'Iwan Sari', 'Rekayasa Perangkat Lunak', 'X RPL 1', 'Reguler Prestasi SMK', 0.6637, 57, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(44, 7, '80001013', 'Andi Setiawan', 'Akuntansi', 'XII AKL 2', 'Reguler Prestasi SMK', 0.6192, 100, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(45, 7, '80001014', 'Sari Hidayat', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.5782, 127, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(46, 7, '80001015', 'Fajar Nugroho', 'Teknik Komputer & Jaringan', 'XII TKJ 1', 'Reguler Prestasi SMK', 0.7208, 16, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(47, 7, '80001016', 'Joko Pratama', 'Desain Komunikasi Visual', 'X DKV 3', 'Reguler Prestasi SMK', 0.5662, 134, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(48, 7, '80001017', 'Putri Santoso', 'Rekayasa Perangkat Lunak', 'XI RPL 2', 'Reguler Prestasi SMK', 0.6409, 76, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(49, 7, '80001018', 'Putri Purnama', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5318, 154, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(50, 7, '80001019', 'Iwan Purnama', 'Bisnis Daring dan Pemasaran', 'XI BDP 1', 'Reguler Prestasi SMK', 0.7043, 25, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(51, 7, '80001020', 'Lia Sari', 'Bisnis Daring dan Pemasaran', 'XI BDP 1', 'Reguler Prestasi SMK', 0.5698, 131, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(52, 7, '80001021', 'Sari Lestari', 'Bisnis Daring dan Pemasaran', 'X BDP 1', 'Reguler Prestasi SMK', 0.6897, 40, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(53, 7, '80001022', 'Eko Rahmawati', 'Bisnis Daring dan Pemasaran', 'X BDP 2', 'Reguler Prestasi SMK', 0.6236, 93, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(54, 7, '80001023', 'Rudi Sari', 'Teknik Komputer & Jaringan', 'XI TKJ 2', 'Reguler Prestasi SMK', 0.7167, 18, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(55, 7, '80001024', 'Nita Setiawan', 'Akuntansi', 'XII AKL 1', 'Reguler Prestasi SMK', 0.6359, 81, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(56, 7, '80001025', 'Rina Lestari', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.5105, 163, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(57, 7, '80001026', 'Dewi Purnama', 'Rekayasa Perangkat Lunak', 'XI RPL 3', 'Reguler Prestasi SMK', 0.4015, 180, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(58, 7, '80001027', 'Ayu Setiawan', 'Akuntansi', 'XI AKL 1', 'Reguler Prestasi SMK', 0.8384, 4, 'lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(59, 7, '80001028', 'Hendra Wijaya', 'Akuntansi', 'XI AKL 2', 'Reguler Prestasi SMK', 0.6869, 42, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(60, 7, '80001029', 'Dodi Lestari', 'Desain Komunikasi Visual', 'X DKV 1', 'Reguler Prestasi SMK', 0.5491, 145, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(61, 7, '80001030', 'Siti Santoso', 'Bisnis Daring dan Pemasaran', 'XI BDP 3', 'Reguler Prestasi SMK', 0.4944, 170, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(62, 7, '80001031', 'Andi Purnama', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.5127, 162, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(63, 7, '80001032', 'Dewi Indah', 'Bisnis Daring dan Pemasaran', 'X BDP 3', 'Reguler Prestasi SMK', 0.4960, 169, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(64, 7, '80001033', 'Eko Lestari', 'Desain Komunikasi Visual', 'XI DKV 1', 'Reguler Prestasi SMK', 0.6876, 41, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(65, 7, '80001034', 'Budi Sari', 'Bisnis Daring dan Pemasaran', 'XII BDP 1', 'Reguler Prestasi SMK', 0.6198, 98, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(66, 7, '80001035', 'Lia Kurniawan', 'Rekayasa Perangkat Lunak', 'X RPL 2', 'Reguler Prestasi SMK', 0.6357, 82, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(67, 7, '80001036', 'Tari Hidayat', 'Otomotif', 'XII TKR 1', 'Reguler Prestasi SMK', 0.6863, 43, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(68, 7, '80001037', 'Dodi Wijaya', 'Rekayasa Perangkat Lunak', 'X RPL 3', 'Reguler Prestasi SMK', 0.6296, 88, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(69, 7, '80001038', 'Eko Lestari', 'Otomotif', 'XII TKR 2', 'Reguler Prestasi SMK', 0.4625, 177, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(70, 7, '80001039', 'Nita Purnama', 'Desain Komunikasi Visual', 'X DKV 1', 'Reguler Prestasi SMK', 0.6975, 32, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(71, 7, '80001040', 'Agus Nugroho', 'Otomotif', 'XI TKR 3', 'Reguler Prestasi SMK', 0.6465, 71, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(72, 7, '80001041', 'Siti Purnama', 'Desain Komunikasi Visual', 'XII DKV 3', 'Reguler Prestasi SMK', 0.5187, 159, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(73, 7, '80001042', 'Siti Kurniawan', 'Desain Komunikasi Visual', 'X DKV 3', 'Reguler Prestasi SMK', 0.6626, 59, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(74, 7, '80001043', 'Tari Wahyuni', 'Teknik Komputer & Jaringan', 'X TKJ 1', 'Reguler Prestasi SMK', 0.6687, 55, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(75, 7, '80001044', 'Eko Hidayat', 'Akuntansi', 'XII AKL 3', 'Reguler Prestasi SMK', 0.7154, 20, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(76, 7, '80001045', 'Hendra Purnama', 'Rekayasa Perangkat Lunak', 'XI RPL 1', 'Reguler Prestasi SMK', 0.5167, 160, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(77, 7, '80001046', 'Dewi Santoso', 'Otomotif', 'X TKR 2', 'Reguler Prestasi SMK', 0.6209, 96, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(78, 7, '80001047', 'Iwan Setiawan', 'Otomotif', 'XII TKR 2', 'Reguler Prestasi SMK', 0.6642, 56, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(79, 7, '80001048', 'Fajar Santoso', 'Rekayasa Perangkat Lunak', 'XII RPL 2', 'Reguler Prestasi SMK', 0.6028, 110, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(80, 7, '80001049', 'Rina Setiawan', 'Bisnis Daring dan Pemasaran', 'X BDP 2', 'Reguler Prestasi SMK', 0.4841, 171, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(81, 7, '80001050', 'Joko Kusuma', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.6399, 79, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(82, 7, '80001051', 'Iwan Wijaya', 'Otomotif', 'XI TKR 2', 'Reguler Prestasi SMK', 0.6008, 113, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(83, 7, '80001052', 'Nita Saputra', 'Akuntansi', 'XII AKL 3', 'Reguler Prestasi SMK', 0.7556, 13, 'lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(84, 7, '80001053', 'Maya Wijaya', 'Teknik Komputer & Jaringan', 'XI TKJ 3', 'Reguler Prestasi SMK', 0.6103, 104, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(85, 7, '80001054', 'Joko Nugroho', 'Akuntansi', 'XII AKL 1', 'Reguler Prestasi SMK', 0.6931, 35, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(86, 7, '80001055', 'Tari Kusuma', 'Rekayasa Perangkat Lunak', 'X RPL 3', 'Reguler Prestasi SMK', 0.5697, 132, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(87, 7, '80001056', 'Dewi Sari', 'Bisnis Daring dan Pemasaran', 'X BDP 2', 'Reguler Prestasi SMK', 0.7162, 19, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(88, 7, '80001057', 'Putri Setiawan', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.7008, 29, 'cadangan', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(89, 7, '80001058', 'Iwan Sari', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6909, 38, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(90, 7, '80001059', 'Iwan Nugroho', 'Bisnis Daring dan Pemasaran', 'XI BDP 2', 'Reguler Prestasi SMK', 0.6038, 109, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(91, 7, '80001060', 'Ayu Wahyuni', 'Akuntansi', 'XI AKL 2', 'Reguler Prestasi SMK', 0.6590, 64, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(92, 7, '80001061', 'Dewi Wijaya', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.5380, 152, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(93, 7, '80001062', 'Andi Pratama', 'Teknik Komputer & Jaringan', 'X TKJ 2', 'Reguler Prestasi SMK', 0.5703, 130, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(94, 7, '80001063', 'Eko Nugroho', 'Akuntansi', 'XI AKL 1', 'Reguler Prestasi SMK', 0.6626, 60, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(95, 7, '80001064', 'Rudi Setiawan', 'Akuntansi', 'X AKL 2', 'Reguler Prestasi SMK', 0.5896, 118, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(96, 7, '80001065', 'Tari Kurniawan', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.4811, 172, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(97, 7, '80001066', 'Hendra Wahyuni', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.5388, 151, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(98, 7, '80001067', 'Rudi Saputra', 'Rekayasa Perangkat Lunak', 'X RPL 3', 'Reguler Prestasi SMK', 0.4627, 176, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(99, 7, '80001068', 'Hendra Kusuma', 'Teknik Komputer & Jaringan', 'XI TKJ 2', 'Reguler Prestasi SMK', 0.5570, 136, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(100, 7, '80001069', 'Andi Sari', 'Rekayasa Perangkat Lunak', 'XII RPL 3', 'Reguler Prestasi SMK', 0.6243, 91, 'tidak_lolos', NULL, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(101, 7, '80001070', 'Siti Hidayat', 'Rekayasa Perangkat Lunak', 'X RPL 1', 'Reguler Prestasi SMK', 0.5902, 117, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(102, 7, '80001071', 'Rina Indah', 'Teknik Komputer & Jaringan', 'XI TKJ 3', 'Reguler Prestasi SMK', 0.5398, 150, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(103, 7, '80001072', 'Rina Hidayat', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.6911, 37, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(104, 7, '80001073', 'Hendra Wahyuni', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.6219, 95, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(105, 7, '80001074', 'Tari Hidayat', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6859, 45, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(106, 7, '80001075', 'Iwan Saputra', 'Desain Komunikasi Visual', 'X DKV 2', 'Reguler Prestasi SMK', 0.6991, 30, 'cadangan', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(107, 7, '80001076', 'Agus Wahyuni', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.6829, 46, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(108, 7, '80001077', 'Agus Setiawan', 'Otomotif', 'XII TKR 2', 'Reguler Prestasi SMK', 0.5076, 167, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(109, 7, '80001078', 'Dewi Hidayat', 'Akuntansi', 'XII AKL 3', 'Reguler Prestasi SMK', 0.5433, 147, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(110, 7, '80001079', 'Ayu Sari', 'Teknik Komputer & Jaringan', 'XI TKJ 2', 'Reguler Prestasi SMK', 0.5526, 144, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(111, 7, '80001080', 'Joko Rahmawati', 'Teknik Komputer & Jaringan', 'XII TKJ 2', 'Reguler Prestasi SMK', 0.6737, 51, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(112, 7, '80001081', 'Putri Sari', 'Rekayasa Perangkat Lunak', 'X RPL 2', 'Reguler Prestasi SMK', 0.6118, 103, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(113, 7, '80001082', 'Lia Sari', 'Bisnis Daring dan Pemasaran', 'XII BDP 2', 'Reguler Prestasi SMK', 0.5141, 161, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(114, 7, '80001083', 'Fajar Wijaya', 'Desain Komunikasi Visual', 'X DKV 1', 'Reguler Prestasi SMK', 0.5854, 122, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(115, 7, '80001084', 'Ayu Lestari', 'Teknik Komputer & Jaringan', 'XII TKJ 2', 'Reguler Prestasi SMK', 0.6320, 84, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(116, 7, '80001085', 'Joko Wijaya', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.5563, 137, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(117, 7, '80001086', 'Siti Nugroho', 'Desain Komunikasi Visual', 'XII DKV 1', 'Reguler Prestasi SMK', 0.4452, 179, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(118, 7, '80001087', 'Maya Sari', 'Akuntansi', 'XI AKL 2', 'Reguler Prestasi SMK', 0.7933, 8, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(119, 7, '80001088', 'Andi Setiawan', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.6859, 44, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(120, 7, '80001089', 'Maya Rahmawati', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.6805, 47, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(121, 7, '80001090', 'Agus Wijaya', 'Bisnis Daring dan Pemasaran', 'XI BDP 2', 'Reguler Prestasi SMK', 0.9297, 1, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(122, 7, '80001091', 'Joko Saputra', 'Teknik Komputer & Jaringan', 'XI TKJ 3', 'Reguler Prestasi SMK', 0.6330, 83, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(123, 7, '80001092', 'Ayu Santoso', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.5078, 166, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(124, 7, '80001093', 'Maya Wahyuni', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.6526, 66, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(125, 7, '80001094', 'Joko Setiawan', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5888, 119, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(126, 7, '80001095', 'Ayu Hidayat', 'Desain Komunikasi Visual', 'XII DKV 3', 'Reguler Prestasi SMK', 0.5788, 126, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(127, 7, '80001096', 'Maya Wahyuni', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.6066, 108, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(128, 7, '80001097', 'Nita Wahyuni', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.6480, 70, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(129, 7, '80001098', 'Budi Hidayat', 'Otomotif', 'XI TKR 3', 'Reguler Prestasi SMK', 0.6204, 97, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(130, 7, '80001099', 'Agus Kurniawan', 'Desain Komunikasi Visual', 'X DKV 3', 'Reguler Prestasi SMK', 0.4983, 168, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(131, 7, '80001100', 'Nita Kusuma', 'Desain Komunikasi Visual', 'XII DKV 1', 'Reguler Prestasi SMK', 0.6800, 48, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(132, 7, '80001101', 'Maya Saputra', 'Akuntansi', 'XII AKL 1', 'Reguler Prestasi SMK', 0.6272, 89, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(133, 7, '80001102', 'Hendra Purnama', 'Bisnis Daring dan Pemasaran', 'X BDP 3', 'Reguler Prestasi SMK', 0.5691, 133, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(134, 7, '80001103', 'Iwan Kusuma', 'Bisnis Daring dan Pemasaran', 'XI BDP 3', 'Reguler Prestasi SMK', 0.6898, 39, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(135, 7, '80001104', 'Dodi Kurniawan', 'Desain Komunikasi Visual', 'XI DKV 3', 'Reguler Prestasi SMK', 0.8623, 3, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(136, 7, '80001105', 'Ayu Wijaya', 'Bisnis Daring dan Pemasaran', 'X BDP 3', 'Reguler Prestasi SMK', 0.6193, 99, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(137, 7, '80001106', 'Dodi Sari', 'Otomotif', 'XI TKR 3', 'Reguler Prestasi SMK', 0.6297, 86, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(138, 7, '80001107', 'Agus Nugroho', 'Teknik Komputer & Jaringan', 'XI TKJ 1', 'Reguler Prestasi SMK', 0.7038, 27, 'cadangan', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(139, 7, '80001108', 'Fajar Hidayat', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.7750, 9, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(140, 7, '80001109', 'Rudi Indah', 'Otomotif', 'XI TKR 1', 'Reguler Prestasi SMK', 0.5230, 158, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(141, 7, '80001110', 'Sari Setiawan', 'Akuntansi', 'XI AKL 1', 'Reguler Prestasi SMK', 0.7211, 15, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(142, 7, '80001111', 'Nita Santoso', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.6514, 67, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(143, 7, '80001112', 'Dodi Sari', 'Rekayasa Perangkat Lunak', 'X RPL 3', 'Reguler Prestasi SMK', 0.6499, 69, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(144, 7, '80001113', 'Iwan Kurniawan', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.5449, 146, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(145, 7, '80001114', 'Eko Indah', 'Otomotif', 'XI TKR 3', 'Reguler Prestasi SMK', 0.6315, 85, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(146, 7, '80001115', 'Eko Saputra', 'Otomotif', 'XI TKR 3', 'Reguler Prestasi SMK', 0.6297, 87, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(147, 7, '80001116', 'Maya Lestari', 'Otomotif', 'X TKR 2', 'Reguler Prestasi SMK', 0.7077, 23, 'cadangan', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(148, 7, '80001117', 'Budi Santoso', 'Desain Komunikasi Visual', 'X DKV 2', 'Reguler Prestasi SMK', 0.4777, 173, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(149, 7, '80001118', 'Nita Indah', 'Otomotif', 'X TKR 1', 'Reguler Prestasi SMK', 0.6443, 74, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(150, 7, '80001119', 'Putri Kurniawan', 'Bisnis Daring dan Pemasaran', 'X BDP 1', 'Reguler Prestasi SMK', 0.5803, 124, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(151, 7, '80001120', 'Budi Kurniawan', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.6712, 52, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(152, 7, '80001121', 'Maya Saputra', 'Akuntansi', 'XII AKL 2', 'Reguler Prestasi SMK', 0.5534, 142, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(153, 7, '80001122', 'Rina Lestari', 'Akuntansi', 'XII AKL 2', 'Reguler Prestasi SMK', 0.5858, 121, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(154, 7, '80001123', 'Fajar Santoso', 'Bisnis Daring dan Pemasaran', 'XII BDP 3', 'Reguler Prestasi SMK', 0.5547, 139, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(155, 7, '80001124', 'Lia Lestari', 'Otomotif', 'X TKR 3', 'Reguler Prestasi SMK', 0.6075, 105, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(156, 7, '80001125', 'Siti Wijaya', 'Akuntansi', 'X AKL 3', 'Reguler Prestasi SMK', 0.5414, 148, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(157, 7, '80001126', 'Nita Pratama', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.6966, 34, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(158, 7, '80001127', 'Ayu Wijaya', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.6982, 31, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(159, 7, '80001128', 'Dewi Purnama', 'Otomotif', 'XII TKR 3', 'Reguler Prestasi SMK', 0.5309, 155, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(160, 7, '80001129', 'Budi Wijaya', 'Bisnis Daring dan Pemasaran', 'X BDP 2', 'Reguler Prestasi SMK', 0.6188, 101, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(161, 7, '80001130', 'Lia Rahmawati', 'Otomotif', 'X TKR 2', 'Reguler Prestasi SMK', 0.5339, 153, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(162, 7, '80001131', 'Andi Saputra', 'Akuntansi', 'XII AKL 2', 'Reguler Prestasi SMK', 0.6695, 53, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(163, 7, '80001132', 'Maya Sari', 'Rekayasa Perangkat Lunak', 'X RPL 1', 'Reguler Prestasi SMK', 0.6968, 33, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(164, 7, '80001133', 'Sari Setiawan', 'Bisnis Daring dan Pemasaran', 'XII BDP 3', 'Reguler Prestasi SMK', 0.5411, 149, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(165, 7, '80001134', 'Tari Setiawan', 'Desain Komunikasi Visual', 'X DKV 3', 'Reguler Prestasi SMK', 0.5265, 157, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(166, 7, '80001135', 'Rina Saputra', 'Desain Komunikasi Visual', 'XII DKV 3', 'Reguler Prestasi SMK', 0.5866, 120, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(167, 7, '80001136', 'Agus Rahmawati', 'Otomotif', 'X TKR 3', 'Reguler Prestasi SMK', 0.7038, 28, 'cadangan', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(168, 7, '80001137', 'Dodi Hidayat', 'Bisnis Daring dan Pemasaran', 'X BDP 1', 'Reguler Prestasi SMK', 0.5920, 116, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(169, 7, '80001138', 'Dewi Kusuma', 'Teknik Komputer & Jaringan', 'XII TKJ 1', 'Reguler Prestasi SMK', 0.6068, 107, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(170, 7, '80001139', 'Ayu Rahmawati', 'Otomotif', 'X TKR 1', 'Reguler Prestasi SMK', 0.6612, 63, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(171, 7, '80001140', 'Ayu Wijaya', 'Rekayasa Perangkat Lunak', 'X RPL 3', 'Reguler Prestasi SMK', 0.6695, 54, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(172, 7, '80001141', 'Agus Hidayat', 'Desain Komunikasi Visual', 'XII DKV 3', 'Reguler Prestasi SMK', 0.5795, 125, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(173, 7, '80001142', 'Iwan Wijaya', 'Akuntansi', 'XII AKL 1', 'Reguler Prestasi SMK', 0.5281, 156, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(174, 7, '80001143', 'Rina Sari', 'Otomotif', 'XI TKR 1', 'Reguler Prestasi SMK', 0.7043, 26, 'cadangan', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(175, 7, '80001144', 'Dodi Wijaya', 'Bisnis Daring dan Pemasaran', 'XII BDP 3', 'Reguler Prestasi SMK', 0.6242, 92, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(176, 7, '80001145', 'Maya Sari', 'Bisnis Daring dan Pemasaran', 'XII BDP 2', 'Reguler Prestasi SMK', 0.7437, 14, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(177, 7, '80001146', 'Joko Setiawan', 'Akuntansi', 'X AKL 2', 'Reguler Prestasi SMK', 0.6424, 75, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(178, 7, '80001147', 'Eko Setiawan', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.7712, 10, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(179, 7, '80001148', 'Andi Purnama', 'Rekayasa Perangkat Lunak', 'X RPL 2', 'Reguler Prestasi SMK', 0.6070, 106, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(180, 7, '80001149', 'Rudi Nugroho', 'Bisnis Daring dan Pemasaran', 'XI BDP 3', 'Reguler Prestasi SMK', 0.6930, 36, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(181, 7, '80001150', 'Maya Indah', 'Desain Komunikasi Visual', 'XI DKV 1', 'Reguler Prestasi SMK', 0.6259, 90, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(182, 7, '80001151', 'Dewi Purnama', 'Rekayasa Perangkat Lunak', 'XI RPL 3', 'Reguler Prestasi SMK', 0.5813, 123, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(183, 7, '80001152', 'Sari Hidayat', 'Bisnis Daring dan Pemasaran', 'XII BDP 3', 'Reguler Prestasi SMK', 0.8669, 2, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(184, 7, '80001153', 'Budi Pratama', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.5543, 140, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(185, 7, '80001154', 'Rudi Saputra', 'Akuntansi', 'X AKL 1', 'Reguler Prestasi SMK', 0.7602, 11, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(186, 7, '80001155', 'Joko Setiawan', 'Akuntansi', 'XI AKL 2', 'Reguler Prestasi SMK', 0.6020, 112, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(187, 7, '80001156', 'Tari Rahmawati', 'Rekayasa Perangkat Lunak', 'X RPL 1', 'Reguler Prestasi SMK', 0.7954, 7, 'lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(188, 7, '80001157', 'Agus Saputra', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.6550, 65, 'tidak_lolos', NULL, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(189, 7, '80001158', 'Lia Setiawan', 'Rekayasa Perangkat Lunak', 'XI RPL 3', 'Reguler Prestasi SMK', 0.6772, 50, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(190, 7, '80001159', 'Siti Lestari', 'Akuntansi', 'XII AKL 1', 'Reguler Prestasi SMK', 0.4728, 174, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(191, 7, '80001160', 'Maya Kusuma', 'Rekayasa Perangkat Lunak', 'X RPL 2', 'Reguler Prestasi SMK', 0.6226, 94, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(192, 7, '80001161', 'Dewi Nugroho', 'Bisnis Daring dan Pemasaran', 'XII BDP 2', 'Reguler Prestasi SMK', 0.6612, 62, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(193, 7, '80001162', 'Andi Purnama', 'Desain Komunikasi Visual', 'XII DKV 2', 'Reguler Prestasi SMK', 0.5083, 165, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(194, 7, '80001163', 'Budi Kusuma', 'Teknik Komputer & Jaringan', 'XII TKJ 2', 'Reguler Prestasi SMK', 0.6360, 80, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(195, 7, '80001164', 'Dewi Setiawan', 'Bisnis Daring dan Pemasaran', 'XI BDP 3', 'Reguler Prestasi SMK', 0.6150, 102, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(196, 7, '80001165', 'Eko Hidayat', 'Teknik Komputer & Jaringan', 'X TKJ 3', 'Reguler Prestasi SMK', 0.5718, 129, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(197, 7, '80001166', 'Lia Wahyuni', 'Otomotif', 'X TKR 1', 'Reguler Prestasi SMK', 0.4697, 175, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(198, 7, '80001167', 'Dodi Hidayat', 'Otomotif', 'X TKR 1', 'Reguler Prestasi SMK', 0.6445, 73, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(199, 7, '80001168', 'Agus Saputra', 'Bisnis Daring dan Pemasaran', 'XII BDP 3', 'Reguler Prestasi SMK', 0.7144, 21, 'cadangan', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(200, 7, '80001169', 'Agus Rahmawati', 'Akuntansi', 'XI AKL 3', 'Reguler Prestasi SMK', 0.5559, 138, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(201, 7, '80001170', 'Iwan Rahmawati', 'Desain Komunikasi Visual', 'XI DKV 2', 'Reguler Prestasi SMK', 0.4544, 178, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(202, 7, '80001171', 'Andi Indah', 'Bisnis Daring dan Pemasaran', 'XII BDP 2', 'Reguler Prestasi SMK', 0.5532, 143, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(203, 7, '80001172', 'Rudi Saputra', 'Teknik Komputer & Jaringan', 'XI TKJ 3', 'Reguler Prestasi SMK', 0.6506, 68, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(204, 7, '80001173', 'Eko Wahyuni', 'Rekayasa Perangkat Lunak', 'XII RPL 3', 'Reguler Prestasi SMK', 0.6447, 72, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(205, 7, '80001174', 'Iwan Nugroho', 'Bisnis Daring dan Pemasaran', 'X BDP 2', 'Reguler Prestasi SMK', 0.6025, 111, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(206, 7, '80001175', 'Tari Santoso', 'Otomotif', 'XII TKR 2', 'Reguler Prestasi SMK', 0.7176, 17, 'cadangan', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(207, 7, '80001176', 'Maya Wijaya', 'Otomotif', 'XII TKR 3', 'Reguler Prestasi SMK', 0.5771, 128, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(208, 7, '80001177', 'Dodi Kurniawan', 'Desain Komunikasi Visual', 'XI DKV 3', 'Reguler Prestasi SMK', 0.6617, 61, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(209, 7, '80001178', 'Maya Nugroho', 'Akuntansi', 'XII AKL 2', 'Reguler Prestasi SMK', 0.5639, 135, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(210, 7, '80001179', 'Nita Nugroho', 'Desain Komunikasi Visual', 'X DKV 2', 'Reguler Prestasi SMK', 0.5982, 114, 'tidak_lolos', NULL, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(211, 8, '81234001', 'Syahrul', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6178, 5, 'cadangan', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(212, 8, '81234002', 'Ifin', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.7269, 2, 'lolos', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(213, 8, '81234003', 'Christoper', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5395, 7, 'tidak_lolos', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(214, 8, '81234004', 'Reinhard', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.7551, 1, 'lolos', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(215, 8, '81234005', 'Zahra', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6371, 3, 'lolos', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(216, 8, '81234006', 'Rara', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5289, 8, 'tidak_lolos', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(217, 8, '81234007', 'Nana', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5589, 6, 'cadangan', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(218, 8, '81234008', 'Wawa', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6260, 4, 'cadangan', NULL, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(219, 9, '81234001', 'Syahrul', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6203, 5, 'cadangan', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(220, 9, '81234002', 'Ifin', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.7269, 2, 'lolos', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(221, 9, '81234003', 'Christoper', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5395, 7, 'tidak_lolos', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(222, 9, '81234004', 'Reinhard', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.8928, 1, 'lolos', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(223, 9, '81234005', 'Zahra', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6371, 3, 'lolos', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(224, 9, '81234006', 'Rara', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5289, 8, 'tidak_lolos', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(225, 9, '81234007', 'Nana', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.5589, 6, 'cadangan', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(226, 9, '81234008', 'Wawa', 'Rekayasa Perangkat Lunak', 'XII RPL 1', 'Reguler Prestasi SMK', 0.6260, 4, 'cadangan', NULL, '2026-10-20 09:11:48', '2026-10-20 09:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_kriterias`
--

CREATE TABLE `konfigurasi_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `konfigurasi_seleksi_id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atribut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'benefit',
  `tipe_input` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'angka',
  `rentang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_val` double DEFAULT '0',
  `max_val` double DEFAULT '100',
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` decimal(8,6) NOT NULL DEFAULT '0.200000',
  `urutan` smallint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konfigurasi_kriterias`
--

INSERT INTO `konfigurasi_kriterias` (`id`, `konfigurasi_seleksi_id`, `kode`, `nama`, `atribut`, `tipe_input`, `rentang`, `min_val`, `max_val`, `satuan`, `bobot`, `urutan`, `created_at`, `updated_at`) VALUES
(6, 2, 'C1', 'Nilai Akademik', 'benefit', 'angka', '0 – 100 (Nilai Rapor Siswa SMK)', 0, 100, '/ 100 (Rapor)', 0.396971, 1, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(7, 2, 'C2', 'Penghasilan Orang Tua', 'cost', 'angka', 'Rp 0 s/d > Rp 10.000.000', 0, 10000000, 'Rupiah (Slip Gaji)', 0.241819, 2, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(8, 2, 'C3', 'Tanggungan Orang Tua', 'benefit', 'pilihan', '1 s/d > 4 Orang Tanggungan', 1, 5, 'Orang', 0.157330, 3, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(9, 2, 'C4', 'Ekstrakurikuler', 'benefit', 'pilihan', 'Menu Paket: Paket 1 s/d 5 (Konversi SAW Nilai 1 s/d 5)', 1, 5, 'Paket', 0.109408, 4, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(10, 2, 'C5', 'Ketidakhadiran', 'cost', 'angka', '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)', 0, 30, 'Hari Alpa', 0.094473, 5, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(16, 4, 'C1', 'Nilai Akademik', 'benefit', 'angka', '0 – 100 (Nilai Rapor Siswa SMK)', 0, 100, '/ 100 (Rapor)', 0.396971, 1, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(17, 4, 'C2', 'Penghasilan Orang Tua', 'cost', 'angka', 'Rp 0 s/d > Rp 10.000.000', 0, 10000000, 'Rupiah (Slip Gaji)', 0.241819, 2, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(18, 4, 'C3', 'Tanggungan Orang Tua', 'benefit', 'pilihan', '1 s/d > 4 Orang Tanggungan', 1, 5, 'Orang', 0.157330, 3, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(19, 4, 'C4', 'Ekstrakurikuler', 'benefit', 'pilihan', 'Menu Paket: Paket 1 s/d 5 (Konversi SAW Nilai 1 s/d 5)', 1, 5, 'Paket', 0.109408, 4, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(20, 4, 'C5', 'Ketidakhadiran', 'cost', 'angka', '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)', 0, 30, 'Hari Alpa', 0.094473, 5, '2026-10-20 05:52:44', '2026-10-20 05:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_seleksis`
--

CREATE TABLE `konfigurasi_seleksis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `versi` int UNSIGNED NOT NULL DEFAULT '1',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `matriks_ahp` json DEFAULT NULL,
  `lambda_max` decimal(8,5) DEFAULT NULL,
  `ci` decimal(8,5) DEFAULT NULL,
  `cr` decimal(8,5) DEFAULT NULL,
  `is_konsisten` tinyint(1) NOT NULL DEFAULT '1',
  `is_siap` tinyint(1) NOT NULL DEFAULT '1',
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konfigurasi_seleksis`
--

INSERT INTO `konfigurasi_seleksis` (`id`, `nama`, `deskripsi`, `versi`, `parent_id`, `matriks_ahp`, `lambda_max`, `ci`, `cr`, `is_konsisten`, `is_siap`, `is_aktif`, `created_at`, `updated_at`) VALUES
(2, 'Standar Seleksi Siswa Prestasi SMK', 'Paket kriteria seleksi beasiswa prestasi dengan 5 kriteria akademik, sosio-ekonomi, dan kedisiplinan berbobot AHP.', 1, NULL, '{\"C1\": {\"C1\": 1, \"C2\": 2, \"C3\": 3, \"C4\": 4, \"C5\": 3}, \"C2\": {\"C1\": 0.5, \"C2\": 1, \"C3\": 2, \"C4\": 3, \"C5\": 2}, \"C3\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 1, \"C4\": 2, \"C5\": 2}, \"C4\": {\"C1\": 0.25, \"C2\": 0.333333, \"C3\": 0.5, \"C4\": 1, \"C5\": 2}, \"C5\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 0.5, \"C4\": 0.5, \"C5\": 1}}', 5.20204, 0.05051, 0.04510, 1, 1, 1, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(4, 'Standar Seleksi Beasiswa Prestasi SMK', 'Paket kriteria seleksi beasiswa prestasi dengan 5 kriteria akademik, sosio-ekonomi, dan kedisiplinan berbobot AHP.', 2, 2, '{\"C1\": {\"C1\": 1, \"C2\": 2, \"C3\": 3, \"C4\": 4, \"C5\": 3}, \"C2\": {\"C1\": 0.5, \"C2\": 1, \"C3\": 2, \"C4\": 3, \"C5\": 2}, \"C3\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 1, \"C4\": 2, \"C5\": 2}, \"C4\": {\"C1\": 0.25, \"C2\": 0.333333, \"C3\": 0.5, \"C4\": 1, \"C5\": 2}, \"C5\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 0.5, \"C4\": 0.5, \"C5\": 1}}', 5.20204, 0.05051, 0.04510, 1, 1, 1, '2026-10-20 05:52:44', '2026-10-20 05:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_sub_kriterias`
--

CREATE TABLE `konfigurasi_sub_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `konfigurasi_kriteria_id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int NOT NULL DEFAULT '1',
  `urutan` smallint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konfigurasi_sub_kriterias`
--

INSERT INTO `konfigurasi_sub_kriterias` (`id`, `konfigurasi_kriteria_id`, `label`, `nilai`, `urutan`, `created_at`, `updated_at`) VALUES
(11, 8, '1 Orang Tanggungan', 1, 1, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(12, 8, '2 Orang Tanggungan', 2, 2, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(13, 8, '3 Orang Tanggungan', 3, 3, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(14, 8, '4 Orang Tanggungan', 4, 4, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(15, 8, '> 4 Orang Tanggungan', 5, 5, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(16, 9, 'Paket 1: Pramuka, Komputer, dan Paskibra', 1, 1, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(17, 9, 'Paket 2: Komputer dan Paskibra', 2, 2, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(18, 9, 'Paket 3: Pramuka dan Paskibra', 3, 3, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(19, 9, 'Paket 4: Olahraga', 4, 4, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(20, 9, 'Paket 5: Palang Merah / PMR & Organisasi', 5, 5, '2026-10-19 09:13:19', '2026-10-19 09:13:19'),
(31, 18, '1 Orang Tanggungan', 1, 1, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(32, 18, '2 Orang Tanggungan', 2, 2, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(33, 18, '3 Orang Tanggungan', 3, 3, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(34, 18, '4 Orang Tanggungan', 4, 4, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(35, 18, '> 4 Orang Tanggungan', 5, 5, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(36, 19, 'Paket 1: Pramuka, Komputer, dan Paskibra', 1, 1, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(37, 19, 'Paket 2: Komputer dan Paskibra', 2, 2, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(38, 19, 'Paket 3: Pramuka dan Paskibra', 3, 3, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(39, 19, 'Paket 4: Olahraga', 4, 4, '2026-10-20 05:52:44', '2026-10-20 05:52:44'),
(40, 19, 'Paket 5: Palang Merah / PMR & Organisasi', 5, 5, '2026-10-20 05:52:44', '2026-10-20 05:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `periode_id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `atribut` enum('benefit','cost') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_input` enum('angka','pilihan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'angka',
  `rentang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_val` double DEFAULT NULL,
  `max_val` double DEFAULT NULL,
  `satuan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` decimal(10,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `periode_id`, `kode`, `nama`, `atribut`, `tipe_input`, `rentang`, `min_val`, `max_val`, `satuan`, `bobot`, `created_at`, `updated_at`) VALUES
(31, 7, 'C1', 'Nilai Akademik', 'benefit', 'angka', '0 – 100 (Nilai Rapor Siswa SMK)', 0, 100, '/ 100 (Rapor)', 0.396971, '2026-10-20 05:53:59', '2026-10-20 05:53:59'),
(32, 7, 'C2', 'Penghasilan Orang Tua', 'cost', 'angka', 'Rp 0 s/d > Rp 10.000.000', 0, 10000000, 'Rupiah (Slip Gaji)', 0.241819, '2026-10-20 05:53:59', '2026-10-20 05:53:59'),
(33, 7, 'C3', 'Tanggungan Orang Tua', 'benefit', 'pilihan', 'Pilihan: 1 Orang Tanggungan, 2 Orang Tanggungan, 3 Orang Tanggungan...', 1, 5, 'Orang', 0.157330, '2026-10-20 05:53:59', '2026-10-20 07:03:25'),
(34, 7, 'C4', 'Ekstrakurikuler', 'benefit', 'pilihan', 'Pilihan: Paket 1: Pramuka, Komputer, dan Paskibra, Paket 2: Komputer dan Paskibra, Paket 3: Pramuka dan Paskibra...', 1, 5, 'Paket', 0.109408, '2026-10-20 05:53:59', '2026-10-20 07:03:25'),
(35, 7, 'C5', 'Ketidakhadiran', 'cost', 'angka', '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)', 0, 30, 'Hari Alpa', 0.094473, '2026-10-20 05:53:59', '2026-10-20 05:53:59'),
(36, 8, 'C1', 'Nilai Akademik', 'benefit', 'angka', '0 – 100 (Nilai Rapor Siswa SMK)', 0, 100, '/ 100 (Rapor)', 0.396971, '2026-10-20 09:08:10', '2026-10-20 09:08:10'),
(37, 8, 'C2', 'Penghasilan Orang Tua', 'cost', 'angka', 'Rp 0 s/d > Rp 10.000.000', 0, 10000000, 'Rupiah (Slip Gaji)', 0.241819, '2026-10-20 09:08:10', '2026-10-20 09:08:10'),
(38, 8, 'C3', 'Tanggungan Orang Tua', 'benefit', 'pilihan', 'Pilihan: 1 Orang Tanggungan, 2 Orang Tanggungan, 3 Orang Tanggungan...', 1, 5, 'Orang', 0.157330, '2026-10-20 09:08:10', '2026-10-20 09:08:37'),
(39, 8, 'C4', 'Ekstrakurikuler', 'benefit', 'pilihan', 'Pilihan: Paket 1: Pramuka, Komputer, dan Paskibra, Paket 2: Komputer dan Paskibra, Paket 3: Pramuka dan Paskibra...', 1, 5, 'Paket', 0.109408, '2026-10-20 09:08:10', '2026-10-20 09:08:37'),
(40, 8, 'C5', 'Ketidakhadiran', 'cost', 'angka', '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)', 0, 30, 'Hari Alpa', 0.094473, '2026-10-20 09:08:10', '2026-10-20 09:08:10'),
(41, 9, 'C1', 'Nilai Akademik', 'benefit', 'angka', '0 – 100 (Nilai Rapor Siswa SMK)', 0, 100, '/ 100 (Rapor)', 0.396971, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(42, 9, 'C2', 'Penghasilan Orang Tua', 'cost', 'angka', 'Rp 0 s/d > Rp 10.000.000', 0, 10000000, 'Rupiah (Slip Gaji)', 0.241819, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(43, 9, 'C3', 'Tanggungan Orang Tua', 'benefit', 'pilihan', '1 s/d > 4 Orang Tanggungan', 1, 5, 'Orang', 0.157330, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(44, 9, 'C4', 'Ekstrakurikuler', 'benefit', 'pilihan', 'Menu Paket: Paket 1 s/d 5 (Konversi SAW Nilai 1 s/d 5)', 1, 5, 'Paket', 0.109408, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(45, 9, 'C5', 'Ketidakhadiran', 'cost', 'angka', '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)', 0, 30, 'Hari Alpa', 0.094473, '2026-10-20 09:10:54', '2026-10-20 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_07_051018_create_periodes_table', 1),
(5, '2026_10_07_053837_create_kriterias_table', 2),
(6, '2026_10_07_060600_add_tipe_input_to_kriterias_table', 3),
(7, '2026_10_07_060750_create_sub_kriterias_table', 3),
(8, '2026_10_11_000001_create_calon_penerimas_and_penilaians_tables', 4),
(9, '2026_10_11_035824_add_rentang_to_kriterias_table', 5),
(10, '2026_10_11_042027_add_min_max_satuan_to_kriterias_table', 6),
(11, '2026_10_11_045822_alter_nilai_in_penilaians_and_kriterias_table', 7),
(12, '2026_10_20_000001_create_konfigurasi_seleksis_tables', 8),
(13, '2026_10_20_000002_add_total_siswa_to_periodes_table', 9),
(14, '2026_10_20_000003_add_ambang_batas_to_periodes_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `calon_penerima_id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `sub_kriteria_id` bigint UNSIGNED DEFAULT NULL,
  `nilai` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `calon_penerima_id`, `kriteria_id`, `sub_kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(151, 31, 31, NULL, 75.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(152, 31, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(153, 31, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(154, 31, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(155, 31, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(156, 32, 31, NULL, 72.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(157, 32, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(158, 32, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(159, 32, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(160, 32, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(161, 33, 31, NULL, 83.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(162, 33, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(163, 33, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(164, 33, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(165, 33, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(166, 34, 31, NULL, 78.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(167, 34, 32, NULL, 2000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(168, 34, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(169, 34, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(170, 34, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(171, 35, 31, NULL, 85.1, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(172, 35, 32, NULL, 1000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(173, 35, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(174, 35, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(175, 35, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(176, 36, 31, NULL, 77.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(177, 36, 32, NULL, 3500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(178, 36, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(179, 36, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(180, 36, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(181, 37, 31, NULL, 91.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(182, 37, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(183, 37, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(184, 37, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(185, 37, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(186, 38, 31, NULL, 86.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(187, 38, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(188, 38, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(189, 38, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(190, 38, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(191, 39, 31, NULL, 79.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(192, 39, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(193, 39, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(194, 39, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(195, 39, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(196, 40, 31, NULL, 76.7, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(197, 40, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(198, 40, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(199, 40, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(200, 40, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(201, 41, 31, NULL, 81.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(202, 41, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(203, 41, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(204, 41, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(205, 41, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(206, 42, 31, NULL, 92.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(207, 42, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(208, 42, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(209, 42, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(210, 42, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(211, 43, 31, NULL, 73.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(212, 43, 32, NULL, 2000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(213, 43, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(214, 43, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(215, 43, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(216, 44, 31, NULL, 83.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(217, 44, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(218, 44, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(219, 44, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(220, 44, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(221, 45, 31, NULL, 72.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(222, 45, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(223, 45, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(224, 45, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(225, 45, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(226, 46, 31, NULL, 91.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(227, 46, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(228, 46, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(229, 46, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(230, 46, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(231, 47, 31, NULL, 93.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(232, 47, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(233, 47, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(234, 47, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(235, 47, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(236, 48, 31, NULL, 76, '2026-10-20 05:58:18', '2026-10-20 09:05:18'),
(237, 48, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(238, 48, 33, 85, 5, '2026-10-20 05:58:18', '2026-10-20 09:05:18'),
(239, 48, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(240, 48, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(241, 49, 31, NULL, 73.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(242, 49, 32, NULL, 5000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(243, 49, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(244, 49, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(245, 49, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(246, 50, 31, NULL, 93.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(247, 50, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(248, 50, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(249, 50, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(250, 50, 35, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(251, 51, 31, NULL, 76.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(252, 51, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(253, 51, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(254, 51, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(255, 51, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(256, 52, 31, NULL, 71.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(257, 52, 32, NULL, 1000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(258, 52, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(259, 52, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(260, 52, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(261, 53, 31, NULL, 86.7, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(262, 53, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(263, 53, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(264, 53, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(265, 53, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(266, 54, 31, NULL, 74.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(267, 54, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(268, 54, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(269, 54, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(270, 54, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(271, 55, 31, NULL, 86.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(272, 55, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(273, 55, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(274, 55, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(275, 55, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(276, 56, 31, NULL, 81.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(277, 56, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(278, 56, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(279, 56, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(280, 56, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(281, 57, 31, NULL, 72.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(282, 57, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(283, 57, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(284, 57, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(285, 57, 35, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(286, 58, 31, NULL, 91.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(287, 58, 32, NULL, 1000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(288, 58, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(289, 58, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(290, 58, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(291, 59, 31, NULL, 87.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(292, 59, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(293, 59, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(294, 59, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(295, 59, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(296, 60, 31, NULL, 84.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(297, 60, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(298, 60, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(299, 60, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(300, 60, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(301, 61, 31, NULL, 93, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(302, 61, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(303, 61, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(304, 61, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(305, 61, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(306, 62, 31, NULL, 71.7, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(307, 62, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(308, 62, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(309, 62, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(310, 62, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(311, 63, 31, NULL, 72, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(312, 63, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(313, 63, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(314, 63, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(315, 63, 35, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(316, 64, 31, NULL, 86.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(317, 64, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(318, 64, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(319, 64, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(320, 64, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(321, 65, 31, NULL, 71.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(322, 65, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(323, 65, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(324, 65, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(325, 65, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(326, 66, 31, NULL, 77.1, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(327, 66, 32, NULL, 5000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(328, 66, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(329, 66, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(330, 66, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(331, 67, 31, NULL, 86.7, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(332, 67, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(333, 67, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(334, 67, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(335, 67, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(336, 68, 31, NULL, 83.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(337, 68, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(338, 68, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(339, 68, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(340, 68, 35, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(341, 69, 31, NULL, 82.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(342, 69, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(343, 69, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(344, 69, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(345, 69, 35, NULL, 10, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(346, 70, 31, NULL, 78.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(347, 70, 32, NULL, 2000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(348, 70, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(349, 70, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(350, 70, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(351, 71, 31, NULL, 70.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(352, 71, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(353, 71, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(354, 71, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(355, 71, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(356, 72, 31, NULL, 73.7, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(357, 72, 32, NULL, 2000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(358, 72, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(359, 72, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(360, 72, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(361, 73, 31, NULL, 76.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(362, 73, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(363, 73, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(364, 73, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(365, 73, 35, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(366, 74, 31, NULL, 94.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(367, 74, 32, NULL, 2000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(368, 74, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(369, 74, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(370, 74, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(371, 75, 31, NULL, 90.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(372, 75, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(373, 75, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(374, 75, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(375, 75, 35, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(376, 76, 31, NULL, 75, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(377, 76, 32, NULL, 5000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(378, 76, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(379, 76, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(380, 76, 35, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(381, 77, 31, NULL, 78.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(382, 77, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(383, 77, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(384, 77, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(385, 77, 35, NULL, 10, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(386, 78, 31, NULL, 93.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(387, 78, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(388, 78, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(389, 78, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(390, 78, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(391, 79, 31, NULL, 78.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(392, 79, 32, NULL, 3500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(393, 79, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(394, 79, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(395, 79, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(396, 80, 31, NULL, 71.1, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(397, 80, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(398, 80, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(399, 80, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(400, 80, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(401, 81, 31, NULL, 93, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(402, 81, 32, NULL, 3500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(403, 81, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(404, 81, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(405, 81, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(406, 82, 31, NULL, 80.1, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(407, 82, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(408, 82, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(409, 82, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(410, 82, 35, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(411, 83, 31, NULL, 92.6, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(412, 83, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(413, 83, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(414, 83, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(415, 83, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(416, 84, 31, NULL, 85.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(417, 84, 32, NULL, 3500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(418, 84, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(419, 84, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(420, 84, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(421, 85, 31, NULL, 86.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(422, 85, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(423, 85, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(424, 85, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(425, 85, 35, NULL, 10, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(426, 86, 31, NULL, 77.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(427, 86, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(428, 86, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(429, 86, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(430, 86, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(431, 87, 31, NULL, 80.4, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(432, 87, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(433, 87, 33, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(434, 87, 34, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(435, 87, 35, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(436, 88, 31, NULL, 87.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(437, 88, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(438, 88, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(439, 88, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(440, 88, 35, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(441, 89, 31, NULL, 92.9, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(442, 89, 32, NULL, 1500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(443, 89, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(444, 89, 34, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(445, 89, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(446, 90, 31, NULL, 85.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(447, 90, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(448, 90, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(449, 90, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(450, 90, 35, NULL, 7, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(451, 91, 31, NULL, 88.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(452, 91, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(453, 91, 33, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(454, 91, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(455, 91, 35, NULL, 10, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(456, 92, 31, NULL, 77.1, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(457, 92, 32, NULL, 3000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(458, 92, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(459, 92, 34, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(460, 92, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(461, 93, 31, NULL, 87.3, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(462, 93, 32, NULL, 2500000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(463, 93, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(464, 93, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(465, 93, 35, NULL, 6, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(466, 94, 31, NULL, 75.2, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(467, 94, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(468, 94, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(469, 94, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(470, 94, 35, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(471, 95, 31, NULL, 77.5, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(472, 95, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(473, 95, 33, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(474, 95, 34, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(475, 95, 35, NULL, 8, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(476, 96, 31, NULL, 76.8, '2026-10-20 05:58:18', '2026-10-20 09:21:09'),
(477, 96, 32, NULL, 5000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(478, 96, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(479, 96, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(480, 96, 35, NULL, 5, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(481, 97, 31, NULL, 94.5, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(482, 97, 32, NULL, 6000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(483, 97, 33, NULL, 1, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(484, 97, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(485, 97, 35, NULL, 9, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(486, 98, 31, NULL, 80.7, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(487, 98, 32, NULL, 5000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(488, 98, 33, NULL, 2, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(489, 98, 34, NULL, 0, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(490, 98, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(491, 99, 31, NULL, 78.4, '2026-10-20 05:58:18', '2026-10-20 09:21:10'),
(492, 99, 32, NULL, 4000000, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(493, 99, 33, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(494, 99, 34, NULL, 3, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(495, 99, 35, NULL, 4, '2026-10-20 05:58:18', '2026-10-20 05:58:18'),
(496, 100, 31, NULL, 71.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(497, 100, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(498, 100, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(499, 100, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(500, 100, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(501, 101, 31, NULL, 91, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(502, 101, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(503, 101, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(504, 101, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(505, 101, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(506, 102, 31, NULL, 76.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(507, 102, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(508, 102, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(509, 102, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(510, 102, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(511, 103, 31, NULL, 84.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(512, 103, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(513, 103, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(514, 103, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(515, 103, 35, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(516, 104, 31, NULL, 87.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(517, 104, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(518, 104, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(519, 104, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(520, 104, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(521, 105, 31, NULL, 78.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(522, 105, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(523, 105, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(524, 105, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(525, 105, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(526, 106, 31, NULL, 90.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(527, 106, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(528, 106, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(529, 106, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(530, 106, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(531, 107, 31, NULL, 88.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(532, 107, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(533, 107, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(534, 107, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(535, 107, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(536, 108, 31, NULL, 78.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(537, 108, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(538, 108, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(539, 108, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(540, 108, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(541, 109, 31, NULL, 86.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(542, 109, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(543, 109, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(544, 109, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(545, 109, 35, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(546, 110, 31, NULL, 78.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(547, 110, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(548, 110, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(549, 110, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(550, 110, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(551, 111, 31, NULL, 82.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(552, 111, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(553, 111, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(554, 111, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(555, 111, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(556, 112, 31, NULL, 75.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(557, 112, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(558, 112, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(559, 112, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(560, 112, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(561, 113, 31, NULL, 80.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(562, 113, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(563, 113, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(564, 113, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(565, 113, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(566, 114, 31, NULL, 88, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(567, 114, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(568, 114, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(569, 114, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(570, 114, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(571, 115, 31, NULL, 76.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(572, 115, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(573, 115, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(574, 115, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(575, 115, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(576, 116, 31, NULL, 77.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(577, 116, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(578, 116, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(579, 116, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(580, 116, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(581, 117, 31, NULL, 85.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(582, 117, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(583, 117, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(584, 117, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(585, 117, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(586, 118, 31, NULL, 74.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(587, 118, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(588, 118, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(589, 118, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(590, 118, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(591, 119, 31, NULL, 85.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(592, 119, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(593, 119, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(594, 119, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(595, 119, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(596, 120, 31, NULL, 89.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(597, 120, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(598, 120, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(599, 120, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(600, 120, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(601, 121, 31, NULL, 84.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(602, 121, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(603, 121, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(604, 121, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(605, 121, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(606, 122, 31, NULL, 72, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(607, 122, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(608, 122, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(609, 122, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(610, 122, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(611, 123, 31, NULL, 84.8, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(612, 123, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(613, 123, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(614, 123, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(615, 123, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(616, 124, 31, NULL, 75.8, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(617, 124, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(618, 124, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(619, 124, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(620, 124, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(621, 125, 31, NULL, 86.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(622, 125, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(623, 125, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(624, 125, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(625, 125, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(626, 126, 31, NULL, 90.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(627, 126, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(628, 126, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(629, 126, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(630, 126, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(631, 127, 31, NULL, 83.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(632, 127, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(633, 127, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(634, 127, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(635, 127, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(636, 128, 31, NULL, 70.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(637, 128, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(638, 128, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(639, 128, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(640, 128, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(641, 129, 31, NULL, 71, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(642, 129, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(643, 129, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(644, 129, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(645, 129, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(646, 130, 31, NULL, 80.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(647, 130, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(648, 130, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(649, 130, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(650, 130, 35, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(651, 131, 31, NULL, 91.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(652, 131, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(653, 131, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(654, 131, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(655, 131, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(656, 132, 31, NULL, 81.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(657, 132, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(658, 132, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(659, 132, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(660, 132, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(661, 133, 31, NULL, 91.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(662, 133, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(663, 133, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(664, 133, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(665, 133, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(666, 134, 31, NULL, 81.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(667, 134, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(668, 134, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(669, 134, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(670, 134, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(671, 135, 31, NULL, 82.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(672, 135, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(673, 135, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(674, 135, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(675, 135, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(676, 136, 31, NULL, 80.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(677, 136, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(678, 136, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(679, 136, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(680, 136, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(681, 137, 31, NULL, 87.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(682, 137, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(683, 137, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(684, 137, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(685, 137, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(686, 138, 31, NULL, 93, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(687, 138, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(688, 138, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(689, 138, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(690, 138, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(691, 139, 31, NULL, 76.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(692, 139, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(693, 139, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(694, 139, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(695, 139, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(696, 140, 31, NULL, 81.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(697, 140, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(698, 140, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(699, 140, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(700, 140, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(701, 141, 31, NULL, 94.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(702, 141, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(703, 141, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(704, 141, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(705, 141, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(706, 142, 31, NULL, 87.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(707, 142, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(708, 142, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(709, 142, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(710, 142, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(711, 143, 31, NULL, 94.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(712, 143, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(713, 143, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(714, 143, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(715, 143, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(716, 144, 31, NULL, 73.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(717, 144, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(718, 144, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(719, 144, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(720, 144, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(721, 145, 31, NULL, 72, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(722, 145, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(723, 145, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(724, 145, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(725, 145, 35, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(726, 146, 31, NULL, 70.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(727, 146, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(728, 146, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(729, 146, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(730, 146, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(731, 147, 31, NULL, 94.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(732, 147, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(733, 147, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(734, 147, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(735, 147, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(736, 148, 31, NULL, 79, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(737, 148, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(738, 148, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(739, 148, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(740, 148, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(741, 149, 31, NULL, 74.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(742, 149, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(743, 149, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(744, 149, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(745, 149, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(746, 150, 31, NULL, 81.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(747, 150, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(748, 150, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(749, 150, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(750, 150, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(751, 151, 31, NULL, 83.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(752, 151, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(753, 151, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(754, 151, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(755, 151, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(756, 152, 31, NULL, 81.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(757, 152, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(758, 152, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(759, 152, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(760, 152, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(761, 153, 31, NULL, 84.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(762, 153, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(763, 153, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(764, 153, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(765, 153, 35, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(766, 154, 31, NULL, 94.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(767, 154, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(768, 154, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(769, 154, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(770, 154, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(771, 155, 31, NULL, 76.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(772, 155, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(773, 155, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(774, 155, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(775, 155, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(776, 156, 31, NULL, 79.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(777, 156, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(778, 156, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(779, 156, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(780, 156, 35, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(781, 157, 31, NULL, 91.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(782, 157, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(783, 157, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(784, 157, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(785, 157, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(786, 158, 31, NULL, 91.8, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(787, 158, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(788, 158, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(789, 158, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(790, 158, 35, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(791, 159, 31, NULL, 94.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(792, 159, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(793, 159, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(794, 159, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(795, 159, 35, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(796, 160, 31, NULL, 79.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(797, 160, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(798, 160, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(799, 160, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(800, 160, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(801, 161, 31, NULL, 70.6, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(802, 161, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(803, 161, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(804, 161, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(805, 161, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(806, 162, 31, NULL, 86.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(807, 162, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(808, 162, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(809, 162, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(810, 162, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(811, 163, 31, NULL, 92.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(812, 163, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(813, 163, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(814, 163, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(815, 163, 35, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(816, 164, 31, NULL, 73.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(817, 164, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(818, 164, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(819, 164, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(820, 164, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(821, 165, 31, NULL, 79.3, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(822, 165, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(823, 165, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(824, 165, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(825, 165, 35, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(826, 166, 31, NULL, 79, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(827, 166, 32, NULL, 4000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(828, 166, 33, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(829, 166, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(830, 166, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(831, 167, 31, NULL, 86, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(832, 167, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(833, 167, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(834, 167, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(835, 167, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(836, 168, 31, NULL, 90.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(837, 168, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(838, 168, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(839, 168, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(840, 168, 35, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(841, 169, 31, NULL, 76.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(842, 169, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(843, 169, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(844, 169, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(845, 169, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(846, 170, 31, NULL, 70.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(847, 170, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(848, 170, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(849, 170, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(850, 170, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(851, 171, 31, NULL, 80.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(852, 171, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(853, 171, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(854, 171, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(855, 171, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(856, 172, 31, NULL, 72.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(857, 172, 32, NULL, 6000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(858, 172, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(859, 172, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19');
INSERT INTO `penilaians` (`id`, `calon_penerima_id`, `kriteria_id`, `sub_kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES
(860, 172, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(861, 173, 31, NULL, 71.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(862, 173, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(863, 173, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(864, 173, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(865, 173, 35, NULL, 10, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(866, 174, 31, NULL, 92.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(867, 174, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(868, 174, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(869, 174, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(870, 174, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(871, 175, 31, NULL, 83.7, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(872, 175, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(873, 175, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(874, 175, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(875, 175, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(876, 176, 31, NULL, 72.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(877, 176, 32, NULL, 1500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(878, 176, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(879, 176, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(880, 176, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(881, 177, 31, NULL, 78.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(882, 177, 32, NULL, 5000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(883, 177, 33, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(884, 177, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(885, 177, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(886, 178, 31, NULL, 79.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(887, 178, 32, NULL, 2000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(888, 178, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(889, 178, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(890, 178, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(891, 179, 31, NULL, 72.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(892, 179, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(893, 179, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(894, 179, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(895, 179, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(896, 180, 31, NULL, 73.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(897, 180, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(898, 180, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(899, 180, 34, NULL, 3, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(900, 180, 35, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(901, 181, 31, NULL, 84.4, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(902, 181, 32, NULL, 2500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(903, 181, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(904, 181, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(905, 181, 35, NULL, 7, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(906, 182, 31, NULL, 79.2, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(907, 182, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(908, 182, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(909, 182, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(910, 182, 35, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(911, 183, 31, NULL, 86.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(912, 183, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(913, 183, 33, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(914, 183, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(915, 183, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(916, 184, 31, NULL, 93, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(917, 184, 32, NULL, 3500000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(918, 184, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(919, 184, 34, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(920, 184, 35, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(921, 185, 31, NULL, 88.5, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(922, 185, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(923, 185, 33, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(924, 185, 34, NULL, 5, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(925, 185, 35, NULL, 8, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(926, 186, 31, NULL, 73.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(927, 186, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(928, 186, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(929, 186, 34, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(930, 186, 35, NULL, 9, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(931, 187, 31, NULL, 88.9, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(932, 187, 32, NULL, 1000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(933, 187, 33, NULL, 6, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(934, 187, 34, NULL, 0, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(935, 187, 35, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(936, 188, 31, NULL, 81.1, '2026-10-20 05:58:19', '2026-10-20 09:21:10'),
(937, 188, 32, NULL, 3000000, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(938, 188, 33, NULL, 2, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(939, 188, 34, NULL, 4, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(940, 188, 35, NULL, 1, '2026-10-20 05:58:19', '2026-10-20 05:58:19'),
(941, 189, 31, NULL, 87, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(942, 189, 32, NULL, 5000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(943, 189, 33, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(944, 189, 34, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(945, 189, 35, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(946, 190, 31, NULL, 70.2, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(947, 190, 32, NULL, 3000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(948, 190, 33, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(949, 190, 34, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(950, 190, 35, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(951, 191, 31, NULL, 88.7, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(952, 191, 32, NULL, 2000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(953, 191, 33, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(954, 191, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(955, 191, 35, NULL, 8, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(956, 192, 31, NULL, 71.8, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(957, 192, 32, NULL, 1000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(958, 192, 33, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(959, 192, 34, NULL, 0, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(960, 192, 35, NULL, 7, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(961, 193, 31, NULL, 84.3, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(962, 193, 32, NULL, 4000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(963, 193, 33, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(964, 193, 34, NULL, 0, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(965, 193, 35, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(966, 194, 31, NULL, 90.8, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(967, 194, 32, NULL, 3500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(968, 194, 33, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(969, 194, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(970, 194, 35, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(971, 195, 31, NULL, 72, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(972, 195, 32, NULL, 3000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(973, 195, 33, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(974, 195, 34, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(975, 195, 35, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(976, 196, 31, NULL, 85.8, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(977, 196, 32, NULL, 6000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(978, 196, 33, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(979, 196, 34, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(980, 196, 35, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(981, 197, 31, NULL, 72.6, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(982, 197, 32, NULL, 3000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(983, 197, 33, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(984, 197, 34, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(985, 197, 35, NULL, 9, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(986, 198, 31, NULL, 93.8, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(987, 198, 32, NULL, 5000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(988, 198, 33, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(989, 198, 34, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(990, 198, 35, NULL, 9, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(991, 199, 31, NULL, 94.7, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(992, 199, 32, NULL, 3500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(993, 199, 33, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(994, 199, 34, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(995, 199, 35, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(996, 200, 31, NULL, 77.6, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(997, 200, 32, NULL, 3000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(998, 200, 33, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(999, 200, 34, NULL, 0, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1000, 200, 35, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1001, 201, 31, NULL, 70.9, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1002, 201, 32, NULL, 3500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1003, 201, 33, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1004, 201, 34, NULL, 0, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1005, 201, 35, NULL, 10, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1006, 202, 31, NULL, 81.6, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1007, 202, 32, NULL, 6000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1008, 202, 33, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1009, 202, 34, NULL, 0, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1010, 202, 35, NULL, 7, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1011, 203, 31, NULL, 81.9, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1012, 203, 32, NULL, 2000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1013, 203, 33, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1014, 203, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1015, 203, 35, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1016, 204, 31, NULL, 74.3, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1017, 204, 32, NULL, 2500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1018, 204, 33, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1019, 204, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1020, 204, 35, NULL, 7, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1021, 205, 31, NULL, 79.3, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1022, 205, 32, NULL, 3000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1023, 205, 33, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1024, 205, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1025, 205, 35, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1026, 206, 31, NULL, 71.6, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1027, 206, 32, NULL, 1500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1028, 206, 33, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1029, 206, 34, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1030, 206, 35, NULL, 6, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1031, 207, 31, NULL, 91.8, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1032, 207, 32, NULL, 3500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1033, 207, 33, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1034, 207, 34, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1035, 207, 35, NULL, 10, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1036, 208, 31, NULL, 87.5, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1037, 208, 32, NULL, 4000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1038, 208, 33, NULL, 2, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1039, 208, 34, NULL, 4, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1040, 208, 35, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1041, 209, 31, NULL, 90.3, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1042, 209, 32, NULL, 6000000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1043, 209, 33, NULL, 1, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1044, 209, 34, NULL, 5, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1045, 209, 35, NULL, 10, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1046, 210, 31, NULL, 77.7, '2026-10-20 05:58:20', '2026-10-20 09:21:10'),
(1047, 210, 32, NULL, 2500000, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1048, 210, 33, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1049, 210, 34, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1050, 210, 35, NULL, 3, '2026-10-20 05:58:20', '2026-10-20 05:58:20'),
(1051, 211, 36, NULL, 78, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1052, 211, 37, NULL, 2500000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1053, 211, 38, 104, 4, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1054, 211, 39, 108, 3, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1055, 211, 40, NULL, 3, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1056, 212, 36, NULL, 91, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1057, 212, 37, NULL, 1800000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1058, 212, 38, NULL, 6, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1059, 212, 39, 107, 2, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1060, 212, 40, NULL, 4, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1061, 213, 36, NULL, 72, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1062, 213, 37, NULL, 4500000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1063, 213, 38, 102, 2, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1064, 213, 39, 109, 4, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1065, 213, 40, NULL, 2, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1066, 214, 36, NULL, 95, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1067, 214, 37, NULL, 1200000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1068, 214, 38, NULL, 0, '2026-10-20 09:08:59', '2026-10-20 09:09:23'),
(1069, 214, 39, 106, 1, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1070, 214, 40, NULL, 1, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1071, 215, 36, NULL, 84, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1072, 215, 37, NULL, 3200000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1073, 215, 38, 105, 5, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1074, 215, 39, 108, 3, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1075, 215, 40, NULL, 3, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1076, 216, 36, NULL, 68, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1077, 216, 37, NULL, 5500000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1078, 216, 38, 103, 3, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1079, 216, 39, 110, 5, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1080, 216, 40, NULL, 4, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1081, 217, 36, NULL, 89, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1082, 217, 37, NULL, 3800000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1083, 217, 38, 101, 1, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1084, 217, 39, 107, 2, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1085, 217, 40, NULL, 2, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1086, 218, 36, NULL, 76, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1087, 218, 37, NULL, 6500000, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1088, 218, 38, NULL, 8, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1089, 218, 39, 109, 4, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1090, 218, 40, NULL, 5, '2026-10-20 09:08:59', '2026-10-20 09:08:59'),
(1091, 219, 41, NULL, 78.6, '2026-10-20 09:11:48', '2026-10-20 09:21:10'),
(1092, 219, 42, NULL, 2500000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1093, 219, 43, 114, 4, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1094, 219, 44, 118, 3, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1095, 219, 45, NULL, 3, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1096, 220, 41, NULL, 91, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1097, 220, 42, NULL, 1800000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1098, 220, 43, NULL, 6, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1099, 220, 44, 117, 2, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1100, 220, 45, NULL, 4, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1101, 221, 41, NULL, 72, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1102, 221, 42, NULL, 4500000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1103, 221, 43, 112, 2, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1104, 221, 44, 119, 4, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1105, 221, 45, NULL, 2, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1106, 222, 41, NULL, 95, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1107, 222, 42, NULL, 1200000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1108, 222, 43, NULL, 7, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1109, 222, 44, 116, 1, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1110, 222, 45, NULL, 1, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1111, 223, 41, NULL, 84, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1112, 223, 42, NULL, 3200000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1113, 223, 43, 115, 5, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1114, 223, 44, 118, 3, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1115, 223, 45, NULL, 3, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1116, 224, 41, NULL, 68, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1117, 224, 42, NULL, 5500000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1118, 224, 43, 113, 3, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1119, 224, 44, 120, 5, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1120, 224, 45, NULL, 4, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1121, 225, 41, NULL, 89, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1122, 225, 42, NULL, 3800000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1123, 225, 43, 111, 1, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1124, 225, 44, 117, 2, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1125, 225, 45, NULL, 2, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1126, 226, 41, NULL, 76, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1127, 226, 42, NULL, 6500000, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1128, 226, 43, NULL, 8, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1129, 226, 44, 119, 4, '2026-10-20 09:11:48', '2026-10-20 09:11:48'),
(1130, 226, 45, NULL, 5, '2026-10-20 09:11:48', '2026-10-20 09:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year NOT NULL,
  `kuota` int UNSIGNED NOT NULL DEFAULT '0',
  `total_siswa` int UNSIGNED DEFAULT '0',
  `ambang_batas` decimal(4,3) DEFAULT '0.800',
  `tanggal_mulai` date NOT NULL,
  `deadline` date NOT NULL,
  `konfigurasi_seleksi_id` bigint UNSIGNED DEFAULT NULL,
  `lambda_max` decimal(10,5) DEFAULT NULL,
  `ci` decimal(10,5) DEFAULT NULL,
  `cr` decimal(10,5) DEFAULT NULL,
  `matriks_ahp` json DEFAULT NULL,
  `is_final` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id`, `nama`, `tahun`, `kuota`, `total_siswa`, `ambang_batas`, `tanggal_mulai`, `deadline`, `konfigurasi_seleksi_id`, `lambda_max`, `ci`, `cr`, `matriks_ahp`, `is_final`, `created_at`, `updated_at`) VALUES
(7, 'TES 1', '2026', 15, 180, 0.800, '2026-10-20', '2026-11-19', 4, 5.20204, 0.05051, 0.04510, '{\"C1\": {\"C1\": 1, \"C2\": 2, \"C3\": 3, \"C4\": 4, \"C5\": 3}, \"C2\": {\"C1\": 0.5, \"C2\": 1, \"C3\": 2, \"C4\": 3, \"C5\": 2}, \"C3\": {\"C1\": 0.3333333333333333, \"C2\": 0.5, \"C3\": 1, \"C4\": 2, \"C5\": 2}, \"C4\": {\"C1\": 0.25, \"C2\": 0.3333333333333333, \"C3\": 0.5, \"C4\": 1, \"C5\": 2}, \"C5\": {\"C1\": 0.3333333333333333, \"C2\": 0.5, \"C3\": 0.5, \"C4\": 0.5, \"C5\": 1}}', 0, '2026-10-20 05:53:59', '2026-10-20 07:03:25'),
(8, 'TES 2', '2026', 3, 8, 0.800, '2026-10-20', '2026-10-21', 4, 5.20204, 0.05051, 0.04510, '{\"C1\": {\"C1\": 1, \"C2\": 2, \"C3\": 3, \"C4\": 4, \"C5\": 3}, \"C2\": {\"C1\": 0.5, \"C2\": 1, \"C3\": 2, \"C4\": 3, \"C5\": 2}, \"C3\": {\"C1\": 0.3333333333333333, \"C2\": 0.5, \"C3\": 1, \"C4\": 2, \"C5\": 2}, \"C4\": {\"C1\": 0.25, \"C2\": 0.3333333333333333, \"C3\": 0.5, \"C4\": 1, \"C5\": 2}, \"C5\": {\"C1\": 0.3333333333333333, \"C2\": 0.5, \"C3\": 0.5, \"C4\": 0.5, \"C5\": 1}}', 0, '2026-10-20 09:08:10', '2026-10-20 09:08:37'),
(9, 'TES 3', '2026', 3, 8, 0.800, '2026-10-01', '2026-10-22', 4, 5.20204, 0.05051, 0.04510, '{\"C1\": {\"C1\": 1, \"C2\": 2, \"C3\": 3, \"C4\": 4, \"C5\": 3}, \"C2\": {\"C1\": 0.5, \"C2\": 1, \"C3\": 2, \"C4\": 3, \"C5\": 2}, \"C3\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 1, \"C4\": 2, \"C5\": 2}, \"C4\": {\"C1\": 0.25, \"C2\": 0.333333, \"C3\": 0.5, \"C4\": 1, \"C5\": 2}, \"C5\": {\"C1\": 0.333333, \"C2\": 0.5, \"C3\": 0.5, \"C4\": 0.5, \"C5\": 1}}', 0, '2026-10-20 09:10:54', '2026-10-20 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0UwV25rqUqQQib7CQPdvtNdprahYZEWjfiBHE27U', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJmaEo0YncxdXg1TXJMbUZCZ01iejJqc3NRS1RwQzg2UzQ2NUx4b21PIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2Rhc2hib2FyZD9wZXJpb2RlX2lkPTciLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1792510605),
('2bIXUsLoXFPoqpo28mAask7LphOn57aLuC2XRroF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiJGVWk5bnZjZFVhMmRpTTFXcHUyYlRKcXc4Z0JFU3p2TzBCWmJDUVhKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImRhc2hib2FyZF9wZXJpb2RlX2lkIjo3fQ==', 1792509810),
('5qq4DIH3XWTtWaJDvoEVP4ok786b8iMgkYsFUXFk', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJmM0ZuMlRyckpPRWhsQkk2TGNZTHJ5V0hYeE5nMmU5R0ZGbnlId1dHIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2Rhc2hib2FyZD9wZXJpb2RlX2lkPTciLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1792511275),
('7Ezsml5xNc6xypOREz2xuhuhJSZQi4hJzdoFhdOC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiJSSjM2T2dsNEhKMkw3OGdheTUyeGhadGVtTWlKbm5Ra29EcDVSWVdxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImRhc2hib2FyZF9wZXJpb2RlX2lkIjo3fQ==', 1792508301),
('9idZhxzPLmpqN9ILVHMqw3MgioKJ1HOjMkZKLmq2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJBd1lsdXVRZUw1dUt0WlhEbVhpZGpDZTlhTjhNY0M4WUtEemZjMkFZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9zcGstYmVhc2lzd2EudGVzdFwvZGFzaGJvYXJkP3BlcmlvZGVfaWQ9NyIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjd9', 1792513474),
('cemJhnCOh6BWtigwZyjFYyKRY0niIATRGya7p436', NULL, '127.0.0.1', '', 'eyJfdG9rZW4iOiJIaDdmbnBvb1FpV1ZJWUVXbm96NERIczNaQU9JYXR0VnFuaWs0TWJZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1792508361),
('CZPWGWQTHHAdwJb3XNsSgZiT18fO997zrd7LVP2R', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJtRE81QzZUWUk4YjhaeXhDbVVPNEoyc2h4aVdNTEowSXVxRWFmdzc4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvP3BlcmlvZGVfaWQ9NyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792509941),
('Fms7wUu8qQ9sBxzu0rnXwM8poqtmCdhNSrvx0gjF', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJhclVmOFdKM05FUlh1SEJOQW02eDk5NnU3NWRzaHF5NG42OFZ3d21iIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvP3BlcmlvZGVfaWQ9NyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792509921),
('kxGTtNMmGZPf6zgWHjXtClNmFKcZAKHzgveUgHOs', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiIxdUVUdzRseWtybXUwMnVLVTlNSHd1QzdwNW9reHd4U2ZXSkFhdThxIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2Rhc2hib2FyZD9wZXJpb2RlX2lkPTciLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1792509955),
('nlcB1UynWJKIHNbM1cRXpQq36whhdexMYewQB171', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJMT3MwSWdZSkFUcWdRSG1IUHJ3R0R6dnRNZFc5cVo1cVdGZEFCRmd6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvP3BlcmlvZGVfaWQ9NyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792509879),
('o518wbiKnLPa6g7kMUQeEBfKQZ7IhLJU8oposCcL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiJ3TXVIVGFCYkYzTnlucXNBeVdmaGh3Y29aMVVQNjFkSGJwM3VZQ0R6IiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792505806),
('SXItnNGLUOqM5UAdOvLYadqS0LpA11yx1JS7i3DV', NULL, '127.0.0.1', '', 'eyJfdG9rZW4iOiIzSXVrMjdzcldFazRCRVgxRUZvcXVzY2V4Tjl2SnE0aG1JTkI3V2oyIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792508361),
('Uf6wCegfFyBeAIzbth9tVV9MWzbJdsKo0lZIzzcu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiJieTMweHA5bTdJRmVCZXFvNzJlclFGMnZDeTJIZGxFQ01sYmJwQkxtIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792505423),
('wUTViIaTFzfHC90U6CimXF2hXKAhbHs7sA9x1t4x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiI0amNLcmVLbE9YNjFMekpMYmtKanVqcFlQR2ZONFJPREVJN1NBZWZuIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1792506263),
('zRr3CLUuLjdQjOwkAscOTZgmcSSS3CMbI4kYdeaz', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJwTmxkQ2JMQ2l5em5aM0ZqQU43OENyQjhUTzBreHZVbldxaWhrVnVQIiwiZGFzaGJvYXJkX3BlcmlvZGVfaWQiOjcsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2Rhc2hib2FyZD9wZXJpb2RlX2lkPTciLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1792511251),
('zzw5C1zkYRQkpbVqwOgYwRQRxAOaH6sbtV41trDM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'eyJfdG9rZW4iOiJ1RFV1bk81ZWk2NmloVmF1dW4wbmxXSW9hM0lyMUdhVlFkMk9UUjNkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImRhc2hib2FyZF9wZXJpb2RlX2lkIjo3fQ==', 1792508313);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriterias`
--

CREATE TABLE `sub_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` smallint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kriterias`
--

INSERT INTO `sub_kriterias` (`id`, `kriteria_id`, `label`, `nilai`, `created_at`, `updated_at`) VALUES
(81, 33, '1 Orang Tanggungan', 1, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(82, 33, '2 Orang Tanggungan', 2, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(83, 33, '3 Orang Tanggungan', 3, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(84, 33, '4 Orang Tanggungan', 4, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(85, 33, '> 4 Orang Tanggungan', 5, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(86, 34, 'Paket 1: Pramuka, Komputer, dan Paskibra', 1, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(87, 34, 'Paket 2: Komputer dan Paskibra', 2, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(88, 34, 'Paket 3: Pramuka dan Paskibra', 3, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(89, 34, 'Paket 4: Olahraga', 4, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(90, 34, 'Paket 5: Palang Merah / PMR & Organisasi', 5, '2026-10-20 07:03:25', '2026-10-20 07:03:25'),
(101, 38, '1 Orang Tanggungan', 1, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(102, 38, '2 Orang Tanggungan', 2, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(103, 38, '3 Orang Tanggungan', 3, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(104, 38, '4 Orang Tanggungan', 4, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(105, 38, '> 4 Orang Tanggungan', 5, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(106, 39, 'Paket 1: Pramuka, Komputer, dan Paskibra', 1, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(107, 39, 'Paket 2: Komputer dan Paskibra', 2, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(108, 39, 'Paket 3: Pramuka dan Paskibra', 3, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(109, 39, 'Paket 4: Olahraga', 4, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(110, 39, 'Paket 5: Palang Merah / PMR & Organisasi', 5, '2026-10-20 09:08:37', '2026-10-20 09:08:37'),
(111, 43, '1 Orang Tanggungan', 1, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(112, 43, '2 Orang Tanggungan', 2, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(113, 43, '3 Orang Tanggungan', 3, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(114, 43, '4 Orang Tanggungan', 4, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(115, 43, '> 4 Orang Tanggungan', 5, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(116, 44, 'Paket 1: Pramuka, Komputer, dan Paskibra', 1, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(117, 44, 'Paket 2: Komputer dan Paskibra', 2, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(118, 44, 'Paket 3: Pramuka dan Paskibra', 3, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(119, 44, 'Paket 4: Olahraga', 4, '2026-10-20 09:10:54', '2026-10-20 09:10:54'),
(120, 44, 'Paket 5: Palang Merah / PMR & Organisasi', 5, '2026-10-20 09:10:54', '2026-10-20 09:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `calon_penerimas`
--
ALTER TABLE `calon_penerimas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `calon_penerimas_periode_id_nim_unique` (`periode_id`,`nim`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfigurasi_kriterias`
--
ALTER TABLE `konfigurasi_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konfigurasi_kriterias_konfigurasi_seleksi_id_foreign` (`konfigurasi_seleksi_id`);

--
-- Indexes for table `konfigurasi_seleksis`
--
ALTER TABLE `konfigurasi_seleksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konfigurasi_seleksis_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `konfigurasi_sub_kriterias`
--
ALTER TABLE `konfigurasi_sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konfigurasi_sub_kriterias_konfigurasi_kriteria_id_foreign` (`konfigurasi_kriteria_id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kriterias_periode_id_kode_unique` (`periode_id`,`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penilaians_calon_penerima_id_kriteria_id_unique` (`calon_penerima_id`,`kriteria_id`),
  ADD KEY `penilaians_kriteria_id_foreign` (`kriteria_id`),
  ADD KEY `penilaians_sub_kriteria_id_foreign` (`sub_kriteria_id`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodes_konfigurasi_seleksi_id_foreign` (`konfigurasi_seleksi_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_kriterias_kriteria_id_label_unique` (`kriteria_id`,`label`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calon_penerimas`
--
ALTER TABLE `calon_penerimas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konfigurasi_kriterias`
--
ALTER TABLE `konfigurasi_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `konfigurasi_seleksis`
--
ALTER TABLE `konfigurasi_seleksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konfigurasi_sub_kriterias`
--
ALTER TABLE `konfigurasi_sub_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1131;

--
-- AUTO_INCREMENT for table `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calon_penerimas`
--
ALTER TABLE `calon_penerimas`
  ADD CONSTRAINT `calon_penerimas_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konfigurasi_kriterias`
--
ALTER TABLE `konfigurasi_kriterias`
  ADD CONSTRAINT `konfigurasi_kriterias_konfigurasi_seleksi_id_foreign` FOREIGN KEY (`konfigurasi_seleksi_id`) REFERENCES `konfigurasi_seleksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konfigurasi_seleksis`
--
ALTER TABLE `konfigurasi_seleksis`
  ADD CONSTRAINT `konfigurasi_seleksis_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `konfigurasi_seleksis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `konfigurasi_sub_kriterias`
--
ALTER TABLE `konfigurasi_sub_kriterias`
  ADD CONSTRAINT `konfigurasi_sub_kriterias_konfigurasi_kriteria_id_foreign` FOREIGN KEY (`konfigurasi_kriteria_id`) REFERENCES `konfigurasi_kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `kriterias_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_calon_penerima_id_foreign` FOREIGN KEY (`calon_penerima_id`) REFERENCES `calon_penerimas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaians_sub_kriteria_id_foreign` FOREIGN KEY (`sub_kriteria_id`) REFERENCES `sub_kriterias` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `periodes`
--
ALTER TABLE `periodes`
  ADD CONSTRAINT `periodes_konfigurasi_seleksi_id_foreign` FOREIGN KEY (`konfigurasi_seleksi_id`) REFERENCES `konfigurasi_seleksis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD CONSTRAINT `sub_kriterias_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
