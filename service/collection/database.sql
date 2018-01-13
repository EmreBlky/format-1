-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2011 at 11:39 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ajax_search`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajax_search`
--

CREATE TABLE `ajax_search` (
  `id` int(11) NOT NULL auto_increment,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Hometown` varchar(50) NOT NULL,
  `Job` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ajax_search`
--

INSERT INTO `ajax_search` (`id`, `FirstName`, `LastName`, `Age`, `Hometown`, `Job`) VALUES
(1, 'Ajay', 'Patel', 21, 'Ahmedabad', 'Web Dev'),
(2, 'Anand', 'Patel', 19, 'Ahmedabad', 'Designer'),
(3, 'Tilak', 'Shah', 22, 'Ahmedabad', 'Java'),
(4, 'Anki', 'Patel', 20, 'Ahmedabad', 'Mobile Dev');
