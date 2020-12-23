-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 22, 2020 at 04:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webprog1project`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicrank`
--

CREATE TABLE `academicrank` (
  `id` int(11) NOT NULL,
  `academicRank` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academicrank`
--

INSERT INTO `academicrank` (`id`, `academicRank`) VALUES
(1, 'Assistant Professor'),
(2, 'Associate Professor'),
(3, 'Professor'),
(4, 'Part-Time Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `isCorrect` tinyint(1) DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `idQuestion`, `isCorrect`, `description`) VALUES
(3, 2, 1, 'false'),
(4, 2, 0, 'true'),
(5, 3, 0, 'answer 1'),
(6, 3, 1, 'answer 2'),
(7, 3, 0, 'answer 3'),
(8, 6, 0, '1'),
(9, 6, 0, '2'),
(10, 6, 0, '3'),
(11, 6, 1, '4'),
(12, 7, 1, 'true'),
(13, 7, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `idTeacher` int(11) DEFAULT NULL,
  `idSemester` int(11) NOT NULL,
  `idFaculty` int(11) NOT NULL,
  `className` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `classNumber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enrollmentTotal` int(11) NOT NULL,
  `maxCapacity` int(11) NOT NULL,
  `classDay` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `idTeacher`, `idSemester`, `idFaculty`, `className`, `classNumber`, `enrollmentTotal`, `maxCapacity`, `classDay`, `session`) VALUES
(2, 5, 1, 1, 'Web Programming 1', '3607_1', 0, 10, 'Tuesday', 'S1-S2'),
(3, 6, 1, 1, 'Web Programming 1', '3607_2', 0, 10, 'Thursday', 'S6-S7'),
(4, 7, 1, 1, 'Web Programming 1', '3607_3', 0, 10, 'Wednesday', 'S5-S6');

-- --------------------------------------------------------

--
-- Table structure for table `classmaterial`
--

CREATE TABLE `classmaterial` (
  `id` int(11) NOT NULL,
  `idClass` int(11) NOT NULL,
  `materialUrl` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classmaterial`
--

INSERT INTO `classmaterial` (`id`, `idClass`, `materialUrl`, `description`) VALUES
(4, 2, '4380-01-WebProgramming1-Intro.pdf', 'Introduction'),
(5, 2, '4146-02-WebProgramming1-ClientSide.pdf', 'Client Side'),
(6, 2, '3863-03-WebProgramming1-ServerSide.pdf', 'Server Side');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `idClass` int(11) NOT NULL,
  `quizTitle` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `totalGrade` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `idClass`, `quizTitle`, `totalGrade`, `startDate`, `endDate`) VALUES
(2, 2, 'Quiz 1', 24, '2020-12-22 17:07:00', '2020-12-22 17:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `facultyName` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `facultyName`) VALUES
(1, 'Engineering'),
(2, 'Public Health'),
(3, 'Sports Science'),
(4, 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `idExam` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `grade` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `idExam`, `idType`, `description`, `grade`) VALUES
(2, 2, 2, 'HTML is a programming language.', '2'),
(3, 2, 1, 'Test MCQ', '2'),
(4, 2, 4, 'test upload', '5'),
(5, 2, 3, 'test text', '4'),
(6, 2, 1, 'test 2 mcq ', '3'),
(7, 2, 2, 'test 2 true/false', '3'),
(8, 2, 4, 'Test 2 upload', '5');

-- --------------------------------------------------------

--
-- Table structure for table `questiontype`
--

CREATE TABLE `questiontype` (
  `id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questiontype`
--

INSERT INTO `questiontype` (`id`, `type`) VALUES
(1, 'MCQ'),
(2, 'True/False'),
(3, 'Text'),
(4, 'Upload');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`, `startDate`, `endDate`) VALUES
(1, 'Fall', '2020-09-16', '2020-12-15'),
(2, 'Spring', '2021-01-20', '2021-05-28'),
(3, 'Summer', '2021-07-20', '2021-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `studentanswer`
--

CREATE TABLE `studentanswer` (
  `id` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idClassEnrolled` int(11) NOT NULL,
  `idExam` int(11) NOT NULL,
  `idStudentEnrolled` int(11) NOT NULL,
  `answer` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentanswer`
--

INSERT INTO `studentanswer` (`id`, `idQuestion`, `idClassEnrolled`, `idExam`, `idStudentEnrolled`, `answer`, `grade`) VALUES
(2, 2, 2, 2, 2, 'true', 0),
(3, 3, 2, 2, 2, 'answer 2', 2),
(4, 4, 2, 2, 2, 'No Upload', 1),
(5, 5, 2, 2, 2, 'TEST TEST TEXT TEST TEST TEXT', 1),
(6, 6, 2, 2, 2, '3', 0),
(7, 7, 2, 2, 2, 'true', 3),
(8, 8, 2, 2, 2, 'No Upload', 1),
(9, 2, 2, 2, 4, 'false', 2),
(10, 3, 2, 2, 4, 'answer 2', 2),
(11, 4, 2, 2, 4, '5339-Web programming 1 - TP.pdf', 5),
(12, 5, 2, 2, 4, 'CVBN', 4),
(13, 6, 2, 2, 4, '2', 0),
(14, 7, 2, 2, 4, 'false', 0),
(15, 8, 2, 2, 4, '8616-Microsoft devops.pdf', 5),
(16, 2, 2, 2, 3, '', 0),
(17, 3, 2, 2, 3, '', 0),
(18, 4, 2, 2, 3, '6023-ex1.html', 1),
(19, 5, 2, 2, 3, '', 1),
(20, 6, 2, 2, 3, '2', 0),
(21, 7, 2, 2, 3, 'false', 0),
(22, 8, 2, 2, 3, 'No Upload', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentenrolledexam`
--

CREATE TABLE `studentenrolledexam` (
  `id` int(11) NOT NULL,
  `idStudentEnrolled` int(11) NOT NULL,
  `idClassEnrolled` int(11) NOT NULL,
  `idExam` int(11) NOT NULL,
  `isCorrected` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentenrolledexam`
--

INSERT INTO `studentenrolledexam` (`id`, `idStudentEnrolled`, `idClassEnrolled`, `idExam`, `isCorrected`, `grade`) VALUES
(2, 2, 2, 2, 1, 8),
(3, 4, 2, 2, 1, 18),
(4, 3, 2, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `studentenrollment`
--

CREATE TABLE `studentenrollment` (
  `id` int(11) NOT NULL,
  `idClass` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentenrollment`
--

INSERT INTO `studentenrollment` (`id`, `idClass`, `idStudent`) VALUES
(2, 2, 2),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `studentfile`
--

CREATE TABLE `studentfile` (
  `id` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `fileUrl` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentfile`
--

INSERT INTO `studentfile` (`id`, `idStudent`, `fileUrl`, `description`) VALUES
(2, 2, '7299-ex1.html', 'Lab');

-- --------------------------------------------------------

--
-- Table structure for table `studentstatus`
--

CREATE TABLE `studentstatus` (
  `id` int(11) NOT NULL,
  `studentStatus` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentstatus`
--

INSERT INTO `studentstatus` (`id`, `studentStatus`) VALUES
(1, 'Undergraduate'),
(2, 'Graduate');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `idRole` int(11) DEFAULT NULL,
  `idFaculty` int(11) DEFAULT NULL,
  `idStudentStatus` int(11) DEFAULT NULL,
  `idTeacherAcademicRank` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profileImageURL` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `salt` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `idRole`, `idFaculty`, `idStudentStatus`, `idTeacherAcademicRank`, `email`, `password`, `firstname`, `lastname`, `profileImageURL`, `salt`, `isDeleted`, `userID`) VALUES
(1, 1, NULL, NULL, NULL, 'admin@ua.edu.lb', '$2y$10$NWVu4LzIjJNt8Jn76jvSOepXOe5UT3AgrhLXYwz.ZvpSL6lLURgPK', 'Admin', '', 'default.jpg', 'KEwZ6Y', 0, 1),
(2, 3, 1, 1, NULL, '201720145@ua.edu.lb', '$2y$10$NWVu4LzIjJNt8Jn76jvSOepXOe5UT3AgrhLXYwz.ZvpSL6lLURgPK', 'Anthony', 'Assaf', '5186-1639-me.jpg', 'KEwZ6Y', 0, 201720145),
(3, 3, 1, 1, NULL, '202057336@ua.edu.lb', '$2y$10$0YKRTxQKKbxOxnXhfSTakOU.qDMMTvTT7lvlFCDf/NYmoBI6Obn82', 'Lea', 'Koussayfi', '1978-7.jpg', 'wNVrq(', 0, 202057336),
(4, 3, 1, 1, NULL, '202082923@ua.edu.lb', '$2y$10$NS6KxCbhHHIEye0pI9udi.L/5hJnrZBUR2LzoTH0Fr7lpHa9j7jwS', 'David', 'El Ghoul', 'default.jpg', 'FYJ6*W', 0, 202082923),
(5, 2, NULL, NULL, 4, '202092299@ua.edu.lb', '$2y$10$8t5ztjQjOEGieC8Y4qOYSu29xoUaSbe4ZSha3ZT7O6zjE73/DovVG', 'Nabil', 'Chdid', 'default.jpg', 'n70J(+', 0, 202092299),
(6, 2, NULL, NULL, 4, '202035169@ua.edu.lb', '$2y$10$boOlyOfmOsXm4dv8/iGLaeef2lAr0SMoqbGdhUKTjTt3EKPfaax.u', 'Roger', 'Abi Nader', 'default.jpg', 'TmVf@S', 0, 202035169),
(7, 2, NULL, NULL, 4, '202077581@ua.edu.lb', '$2y$10$mfmahJa7KDHaebtXWPrr6.eoS.tsxhlRQVxW89CftIUmM/vxETJXW', 'Elie', 'Abou Zeid', 'default.jpg', 'ZAXMPd', 0, 202077581);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicrank`
--
ALTER TABLE `academicrank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkQuestion` (`idQuestion`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkClassTeacher` (`idTeacher`),
  ADD KEY `fkClassSemester` (`idSemester`),
  ADD KEY `fkClassFaculty` (`idFaculty`);

--
-- Indexes for table `classmaterial`
--
ALTER TABLE `classmaterial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkClassMaterialClass` (`idClass`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkExamClass` (`idClass`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkQuestionType` (`idType`),
  ADD KEY `fkExamQuestion` (`idExam`);

--
-- Indexes for table `questiontype`
--
ALTER TABLE `questiontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkStudentAnsQuestion` (`idQuestion`),
  ADD KEY `fkStudentAnsExam` (`idExam`),
  ADD KEY `fkStudentAnsClass` (`idClassEnrolled`),
  ADD KEY `fkStudentAnsStudent` (`idStudentEnrolled`);

--
-- Indexes for table `studentenrolledexam`
--
ALTER TABLE `studentenrolledexam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkStudentExamExam` (`idExam`),
  ADD KEY `fkStudentExamStudent` (`idStudentEnrolled`),
  ADD KEY `fkStudentExamClass` (`idClassEnrolled`);

--
-- Indexes for table `studentenrollment`
--
ALTER TABLE `studentenrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkStudentEnrollmentClass` (`idClass`),
  ADD KEY `fkStudentEnrollmentStudent` (`idStudent`);

--
-- Indexes for table `studentfile`
--
ALTER TABLE `studentfile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkStudentFilestudent` (`idStudent`);

--
-- Indexes for table `studentstatus`
--
ALTER TABLE `studentstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `studentID` (`userID`),
  ADD KEY `fkUserRole` (`idRole`),
  ADD KEY `fkStudentFaculty` (`idFaculty`),
  ADD KEY `fkStudentStatus` (`idStudentStatus`),
  ADD KEY `fkTeacherAcademicRank` (`idTeacherAcademicRank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classmaterial`
--
ALTER TABLE `classmaterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questiontype`
--
ALTER TABLE `questiontype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentanswer`
--
ALTER TABLE `studentanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `studentenrolledexam`
--
ALTER TABLE `studentenrolledexam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studentenrollment`
--
ALTER TABLE `studentenrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `studentfile`
--
ALTER TABLE `studentfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentstatus`
--
ALTER TABLE `studentstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fkClassFaculty` FOREIGN KEY (`idFaculty`) REFERENCES `faculty` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkClassSemester` FOREIGN KEY (`idSemester`) REFERENCES `semester` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkClassTeacher` FOREIGN KEY (`idTeacher`) REFERENCES `user` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `classmaterial`
--
ALTER TABLE `classmaterial`
  ADD CONSTRAINT `fkClassMaterialClass` FOREIGN KEY (`idClass`) REFERENCES `class` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `fkExamClass` FOREIGN KEY (`idClass`) REFERENCES `class` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fkExamQuestion` FOREIGN KEY (`idExam`) REFERENCES `exam` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkQuestionType` FOREIGN KEY (`idType`) REFERENCES `questiontype` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD CONSTRAINT `fkStudentAnsClass` FOREIGN KEY (`idClassEnrolled`) REFERENCES `studentenrollment` (`idClass`),
  ADD CONSTRAINT `fkStudentAnsExam` FOREIGN KEY (`idExam`) REFERENCES `studentenrolledexam` (`idExam`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkStudentAnsQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkStudentAnsStudent` FOREIGN KEY (`idStudentEnrolled`) REFERENCES `studentenrolledexam` (`idStudentEnrolled`);

--
-- Constraints for table `studentenrolledexam`
--
ALTER TABLE `studentenrolledexam`
  ADD CONSTRAINT `fkStudentExamClass` FOREIGN KEY (`idClassEnrolled`) REFERENCES `studentenrollment` (`idClass`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkStudentExamExam` FOREIGN KEY (`idExam`) REFERENCES `exam` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkStudentExamStudent` FOREIGN KEY (`idStudentEnrolled`) REFERENCES `studentenrollment` (`idStudent`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
