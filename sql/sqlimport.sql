-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Värd: blu-ray.student.bth.se
-- Tid vid skapande: 24 nov 2015 kl 15:08
-- Serverversion: 5.5.46-0+deb8u1-log
-- PHP-version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `tijo15`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_answers`
--

CREATE TABLE IF NOT EXISTS `phpmvc_answers` (
`id` int(11) NOT NULL,
  `answer` text,
  `author` varchar(80) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `gravatar` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_answers`
--

INSERT INTO `phpmvc_answers` (`id`, `answer`, `author`, `question_id`, `timestamp`, `userid`, `gravatar`) VALUES
(1, '<p>Vi kan alltid börja med att rita en karta</p>\n', 'admin', 1, '2015-11-23 17:47:42', 5, 'http://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028?s=50&d=monsterid'),
(2, '<p>Låter som en bra idé!</p>\n', 'monster', 1, '2015-11-23 17:48:07', 15, 'http://www.gravatar.com/avatar/300f5bb219acdefa2842282611f41e03?s=50&d=monsterid'),
(3, '<p>jag med</p>\n', 'doe', 3, '2015-11-23 20:25:57', 3, 'http://www.gravatar.com/avatar/c7b0ccceb173cf7967fc42bc0e029131?s=50&d=monsterid');

-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_answersreply`
--

CREATE TABLE IF NOT EXISTS `phpmvc_answersreply` (
`id` int(11) NOT NULL,
  `answers` text,
  `author` varchar(80) DEFAULT NULL,
  `answers_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL,
  `gravatar` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `phpmvc_answersreplyview`
--
CREATE TABLE IF NOT EXISTS `phpmvc_answersreplyview` (
`answers_id` int(11)
,`answers` text
,`gravatar` varchar(80)
,`userid` int(11)
,`author` varchar(80)
,`timestamp` timestamp
,`id` int(11)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `phpmvc_answersview`
--
CREATE TABLE IF NOT EXISTS `phpmvc_answersview` (
`question_id` int(11)
,`answer` text
,`author` varchar(80)
,`timestamp` datetime
,`id` int(11)
,`content` text
,`gravatar` varchar(80)
);
-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_comments`
--

CREATE TABLE IF NOT EXISTS `phpmvc_comments` (
`id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `author` varchar(80) DEFAULT NULL,
  `comments` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL,
  `gravatar` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_comments`
--

INSERT INTO `phpmvc_comments` (`id`, `question_id`, `author`, `comments`, `timestamp`, `userid`, `gravatar`) VALUES
(1, 1, 'Test', '<p>Det kan vi testa!</p>\n', '2015-11-23 16:48:51', 17, 'http://www.gravatar.com/avatar/4f3d4782666e7c1508d838f15e2d936a?s=50&d=monsterid');

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `phpmvc_commentsview`
--
CREATE TABLE IF NOT EXISTS `phpmvc_commentsview` (
`question_id` int(11)
,`comments` text
,`author` varchar(80)
,`timestamp` timestamp
,`userid` int(11)
,`id` int(11)
);
-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_question`
--

CREATE TABLE IF NOT EXISTS `phpmvc_question` (
`id` int(11) NOT NULL,
  `content` text,
  `author` varchar(80) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `web` varchar(80) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `ip` text,
  `gravatar` varchar(80) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `pagekey` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_question`
--

INSERT INTO `phpmvc_question` (`id`, `content`, `author`, `name`, `email`, `web`, `timestamp`, `ip`, `gravatar`, `userid`, `pagekey`) VALUES
(1, '<p>Hur ska vi göra för att ta över världen?</p>\n', 'doe', NULL, NULL, NULL, '2015-11-23 17:46:07', '194.47.129.122', 'http://www.gravatar.com/avatar/c7b0ccceb173cf7967fc42bc0e029131?s=50&d=monsterid', 3, 'questions'),
(2, '<p>Är det någon som känner dracula här?</p>\n', 'monster', NULL, NULL, NULL, '2015-11-23 17:50:13', '194.47.129.126', 'http://www.gravatar.com/avatar/300f5bb219acdefa2842282611f41e03?s=50&d=monsterid', 15, 'questions'),
(3, '<p>Jag letar efter medhjälpare!</p>\n', 'doe', NULL, NULL, NULL, '2015-11-23 17:50:44', '194.47.129.122', 'http://www.gravatar.com/avatar/c7b0ccceb173cf7967fc42bc0e029131?s=50&d=monsterid', 3, 'questions');

-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_questiontags`
--

CREATE TABLE IF NOT EXISTS `phpmvc_questiontags` (
  `questionId` varchar(80) DEFAULT NULL,
  `tags_id` int(11) DEFAULT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_questiontags`
--

INSERT INTO `phpmvc_questiontags` (`questionId`, `tags_id`, `id`) VALUES
('1', 2, 1),
('1', 3, 2),
('2', 1, 3),
('3', 1, 4),
('3', 2, 5),
('3', 3, 6),
('3', 4, 7),
('3', 5, 8);

-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_tags`
--

CREATE TABLE IF NOT EXISTS `phpmvc_tags` (
`id` int(11) NOT NULL,
  `tags` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_tags`
--

INSERT INTO `phpmvc_tags` (`id`, `tags`) VALUES
(1, 'Vampyrer'),
(2, 'Zombies'),
(3, 'Utomjordingar'),
(4, 'Varulvar'),
(5, 'Mumier');

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `phpmvc_tagsview`
--
CREATE TABLE IF NOT EXISTS `phpmvc_tagsview` (
`tags` varchar(80)
,`questionId` varchar(80)
);
-- --------------------------------------------------------

--
-- Tabellstruktur `phpmvc_user`
--

CREATE TABLE IF NOT EXISTS `phpmvc_user` (
`id` int(11) NOT NULL,
  `acronym` varchar(20) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `gravatar` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `active` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `phpmvc_user`
--

INSERT INTO `phpmvc_user` (`id`, `acronym`, `email`, `name`, `gravatar`, `password`, `created`, `updated`, `deleted`, `active`) VALUES
(3, 'doe', 'doe@mail.com', 'doe', 'http://www.gravatar.com/avatar/c7b0ccceb173cf7967fc42bc0e029131?s=50&d=monsterid', '$2y$10$GNzMlmUAn9KFTSSV2Erc4uBbyRddWjGqdyGvarm14cX.HdB0n8Yma', '2015-11-14 15:56:37', NULL, NULL, '2015-11-14 15:56:37'),
(5, 'admin', 'admin@admin.com', 'admin', 'http://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028?s=50&d=monsterid', '$2y$10$ubD2eE1MVWWKUNoGRoGrHu6KijZu5e.wo4uo5nFL1/3Ir/MvG0b4m', '2015-11-14 15:58:00', NULL, NULL, '2015-11-14 15:58:00'),
(15, 'monster', 'monster@email.com', 'monster', 'http://www.gravatar.com/avatar/300f5bb219acdefa2842282611f41e03?s=50&d=monsterid', '$2y$10$.jfK8emJCvmAhLsLPQ5jYOibxbZDIvVzBKVBwWMNaf93NKgZTSaLS', '2015-11-16 14:22:56', NULL, NULL, '2015-11-16 14:22:56'),
(17, 'Test', 'test@test.coma', 'Hej', 'http://www.gravatar.com/avatar/4f3d4782666e7c1508d838f15e2d936a?s=50&d=monsterid', '$2y$10$9QadCEGykLk7m/UjGF0wseSF1kd.JqcQKi10zDksXAZl2vNsa.fFS', '2015-11-23 15:38:00', NULL, NULL, '2015-11-23 15:38:00');

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `tagsview`
--
CREATE TABLE IF NOT EXISTS `tagsview` (
);
-- --------------------------------------------------------

--
-- Struktur för vy `phpmvc_answersreplyview`
--
DROP TABLE IF EXISTS `phpmvc_answersreplyview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`tijo15`@`%` SQL SECURITY DEFINER VIEW `phpmvc_answersreplyview` AS select `a`.`answers_id` AS `answers_id`,`a`.`answers` AS `answers`,`a`.`gravatar` AS `gravatar`,`a`.`userid` AS `userid`,`a`.`author` AS `author`,`a`.`timestamp` AS `timestamp`,`q`.`id` AS `id` from (`phpmvc_answersreply` `a` left join `phpmvc_answers` `q` on((`a`.`answers_id` = `q`.`id`)));

-- --------------------------------------------------------

--
-- Struktur för vy `phpmvc_answersview`
--
DROP TABLE IF EXISTS `phpmvc_answersview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`tijo15`@`%` SQL SECURITY DEFINER VIEW `phpmvc_answersview` AS select `a`.`question_id` AS `question_id`,`a`.`answer` AS `answer`,`a`.`author` AS `author`,`a`.`timestamp` AS `timestamp`,`q`.`id` AS `id`,`q`.`content` AS `content`,`q`.`gravatar` AS `gravatar` from (`phpmvc_answers` `a` left join `phpmvc_question` `q` on((`a`.`question_id` = `q`.`id`)));

-- --------------------------------------------------------

--
-- Struktur för vy `phpmvc_commentsview`
--
DROP TABLE IF EXISTS `phpmvc_commentsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`tijo15`@`%` SQL SECURITY DEFINER VIEW `phpmvc_commentsview` AS select `c`.`question_id` AS `question_id`,`c`.`comments` AS `comments`,`c`.`author` AS `author`,`c`.`timestamp` AS `timestamp`,`q`.`userid` AS `userid`,`q`.`id` AS `id` from (`phpmvc_comments` `c` left join `phpmvc_question` `q` on((`c`.`question_id` = `q`.`id`)));

-- --------------------------------------------------------

--
-- Struktur för vy `phpmvc_tagsview`
--
DROP TABLE IF EXISTS `phpmvc_tagsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`tijo15`@`%` SQL SECURITY DEFINER VIEW `phpmvc_tagsview` AS select `T`.`tags` AS `tags`,`QT`.`questionId` AS `questionId` from ((`phpmvc_tags` `T` join `phpmvc_questiontags` `QT` on((`QT`.`tags_id` = `T`.`id`))) join `phpmvc_question` `Q` on((`Q`.`id` = `QT`.`questionId`)));

-- --------------------------------------------------------

--
-- Struktur för vy `tagsview`
--
DROP TABLE IF EXISTS `tagsview`;
-- används(#1356 - View 'tijo15.tagsview' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `phpmvc_answers`
--
ALTER TABLE `phpmvc_answers`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_answersreply`
--
ALTER TABLE `phpmvc_answersreply`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_comments`
--
ALTER TABLE `phpmvc_comments`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_question`
--
ALTER TABLE `phpmvc_question`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_questiontags`
--
ALTER TABLE `phpmvc_questiontags`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_tags`
--
ALTER TABLE `phpmvc_tags`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `phpmvc_user`
--
ALTER TABLE `phpmvc_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `acronym` (`acronym`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `phpmvc_answers`
--
ALTER TABLE `phpmvc_answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `phpmvc_answersreply`
--
ALTER TABLE `phpmvc_answersreply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `phpmvc_comments`
--
ALTER TABLE `phpmvc_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT för tabell `phpmvc_question`
--
ALTER TABLE `phpmvc_question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `phpmvc_questiontags`
--
ALTER TABLE `phpmvc_questiontags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `phpmvc_tags`
--
ALTER TABLE `phpmvc_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `phpmvc_user`
--
ALTER TABLE `phpmvc_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
