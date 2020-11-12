-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2020 at 01:28 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Javascript'),
(2, 'C++'),
(3, 'Music'),
(4, 'sport'),
(5, 'I am not a python Ninja');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_name` varchar(255) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `post_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_name`, `datetime`, `comment_email`, `body`, `comment_status`, `post_id`) VALUES
(2, 'Bernard', '0', 'mattidungafa@gmail.com', 'dvvfd', 'Approved', '5'),
(3, 'LASIISI', '0', 'mattidungafa@gmail.com', 'This is a test run on the new file', 'Approved', '15'),
(4, 'Matthew Idungafa', '0', 'b@gmail.com', 'Guitar Boy', 'Approved', '16'),
(5, 'Matthew', '0', 'mattidungafa@gmail.com', 'cschvjhvcsc', 'unapproved', '5'),
(6, 'Matthew', '0', 'johnarchi061@gmail.com', 'evrvrvr', 'unapproved', '5'),
(7, 'Matthew', '0', 'johnarchi061@gmail.com', 'evrvrvr', 'unapproved', '5'),
(8, 'Francis', 'July-09-2020 13:16:55', 'b@gmail.com', 'First Comment with Date', 'unapproved', '5');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_category` varchar(255) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_image` text NOT NULL,
  `post_comment_count` int(255) NOT NULL,
  `post_views` int(255) NOT NULL,
  `post_tags` text NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_track` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_category`, `post_category_id`, `post_author`, `post_content`, `post_date`, `post_image`, `post_comment_count`, `post_views`, `post_tags`, `post_status`, `post_track`) VALUES
(1, 'First Entry', 'Music', 3, 'Matthew Idungafa', ' mn  k biu qdbqecbe ckeoicboibcb.e ccb sc', 'Thursday 11 June 2020', '', 0, 0, 'music. passion, lifestyle', 'draft', NULL),
(2, 'First Post', 'Javascript', 3, 'kemsguy7', ' efeckjbbecoeboiec', 'Thursday 11 June 2020', 'imagespastTimeReviews5efb21110642e0.56100594.jpg', 0, 0, 'music, lifestyle, jb d', 'published', NULL),
(3, 'bb', 'Javascript', 1, 'tb', ' b4', 'Friday 12 June 2020', '', 0, 0, 'b5b, 4', 'published', NULL),
(4, '', 'Javascript', 1, '', ' ', 'Friday 12 June 2020', '', 0, 0, '', 'published', NULL),
(5, '', 'Javascript', 3, 'd d ', ' ', 'Friday 12 June 2020', '', 0, 0, ' ds f', 'published', NULL),
(6, 'vrvrv r', 'C++', 3, 'r r ', ' vrv', 'Friday 12 June 2020', '', 0, 0, 'rvv', 'published', NULL),
(7, 'vdv', 'Javascript', 1, 'wv rv', ' v d vd', 'Friday 12 June 2020', '', 0, 0, 'dv d', 'published', NULL),
(8, 'cec', 'Music', 1, 'e e e', ' eeeeeeeeeeeeeeeeeeee', 'Friday 12 June 2020', '', 0, 0, ' d ', 'published', NULL),
(9, '', 'Javascript', 1, '', ' d cd', 'Saturday 13 June 2020', '', 0, 0, '', 'draft', NULL),
(10, 'dv rv r v', 'sport', 3, 'r vr v', ' rvrv r', 'Saturday 13 June 2020', '', 0, 0, 'rv rrrrr, rvrv', 'draft', NULL),
(11, '', 'Music', 1, 'ghd', ' tdtr', 'Saturday 13 June 2020', '', 0, 0, 'trare', 'draft', NULL),
(12, 'bb', 'Music Music Music Music', 1, 'Bestie Girl', ' Update to image 12 with an image', 'Saturday 13 June 2020', 'images/png', 0, 0, ' fm fk ', 'draft', NULL),
(13, 'rev', 'Music', 1, 'rvrv', ' rvrv', 'Saturday 13 June 2020', '', 0, 0, '', 'draft', NULL),
(14, 'fv fr ', 'Music', 3, ' gf ', '  g gf', 'Saturday 13 June 2020', '', 0, 0, 'g g ', 'draft', NULL),
(15, 'TEST', 'sport', 4, '', ' FN K   IE  EOCBEC', 'Wednesday 24 June 2020', '', 0, 0, 'EVRFR, FJNIUF, KFN', 'draft', NULL),
(17, 'Second pictured post', 'I am not a python Ninja I am not a python Ninja I am not a python Ninja I am not a python Ninja', 5, 'Bestie Girl', ' ', 'Friday 26 June 2020', 'png', 0, 0, 'php, mysql, python', 'published', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text NOT NULL,
  `is_active` varchar(3) NOT NULL DEFAULT 'yes',
  `role` varchar(255) NOT NULL DEFAULT 'Editor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_pic`, `is_active`, `role`) VALUES
(12, 'john doe', 'idungafabernard@gmail.com', 'f06d05041bc0e147609eabdb70a68e37', 'users/profile_pic/defaults/head_3.png', 'yes', 'Editor'),
(13, 'TONY', 'tony@gmail.com', '96e79218965eb72c92a549dd5a330112', 'users/profile_pic/defaults/head_1.png', 'yes', 'Editor'),
(14, 'cecil', 'c@gmail.com', '96e79218965eb72c92a549dd5a330112', 'users/profile_pic/defaults/head_1.png', 'yes', 'Editor'),
(15, 'Bestie Girl', 'b@gmail.com', '96e79218965eb72c92a549dd5a330112', 'users/profile_pic/defaults/head_3.png', 'yes', 'Admin'),
(16, 'Matthew', 'johnarchi061@gmail.com', '111111', 'users/profile_pic/defaults/head_2.png', 'yes', 'Admin'),
(17, 'matt', 'natt@gmail.com', '96e79218965eb72c92a549dd5a330112', 'users/profile_pics/defaults/head_3.png', 'yes', 'Admin'),
(18, 'reportfr', 'a@gmail.com', '96e79218965eb72c92a549dd5a330112', 'users/profile_pic/defaults/head_3.png', 'yes', 'Editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
