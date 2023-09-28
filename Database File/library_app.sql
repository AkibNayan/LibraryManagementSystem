-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 08:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `shelf_no` int(11) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `sub_title`, `description`, `cat_id`, `shelf_no`, `author_name`, `quantity`, `image`, `status`) VALUES
(1, 'Artificial Intelligence', 'An advance way to enrich your knowledge.', '<p>Artificial intelligence is an important subject in B.Tech in Computer Science and Information Technology. This book is specially written for those student who are eager to build their career as Artificial Intelligence expert.</p>\r\n', 25, 2, 'Naresh & Sunil Kumar', 51, '2220720605_artificial-intelligence.png', 1),
(2, 'Artificial Intelligence: An Illustrated History', 'From Medieval Robots to Neural Networks', '<p><strong>&ldquo;An</strong>&nbsp;<strong>enjoyable diversion to read cover to cover, follow along common strands, or dip into for random bits.</strong>&rdquo;&nbsp;<strong>&mdash;<em>Booklist</em></strong></p>\r\n\r\n<p>From medieval robots and Boolean algebra to facial recognition, artificial neural networks, and adversarial patches, this fascinating history takes readers on a vast tour through the world of artificial intelligence. Award-winning author Clifford A. Pickover (<em>The Math Book, The Physics Book, Death &amp; the Afterlife</em>) explores the historic and current applications of AI in such diverse fields as computing, medicine, popular culture, mythology, and philosophy, and considers the enduring threat to humanity should AI grow out of control. Across 100 illustrated entries, Pickover provides an entertaining and informative look into when artificial intelligence began, how it developed, where it&rsquo;s going, and what it means for the future of human-machine interaction.</p>\r\n', 25, 2, 'Cliff Pickover', 100, '4146041172_artificial-intelligence-an-illustrated-history.jpg', 1),
(3, 'Web Designing', 'This book is just awesome', '<p>Web Designing Book is Recommended for Reading and Reference By &quot;National Institute of Electronics &amp; Information Technology&quot; (NIELIT) -Ministry of Electronics &amp; IT -Government of India. The Book includes Fundamental and Advanced tutorial on HTML, CSS, Whats new in HTML5 and CSS3, JavaScript, JQuery, Angular JS and SEO.</p>\r\n', 17, 3, 'Hirdesh Bhardwaj', 43, '8355880379_Web Design.png', 1),
(4, 'PHP: The Complete Reference', 'Mind blowing book, I have ever seen.', '<p>PHP is a server-side programming language mainly used for web development and is also used as a general purpose programming language. It has become a rage in the Internet world. PHP: The Complete Reference, as the name suggests is a complete reference guide to the widely popular PHP.</p>\n', 24, 2, 'Steven Holznerd', 1, '1011200721_PHP_book.jpg', 1),
(7, 'The Hundred-Page Machine Learning Book', 'Machine learning in trending now.', '<p>The breadth of topics the book covers is amazing for just 100 pages (plus few bonus pages!). Burkov doesn&#39;t hesitate to go into the math equations: that&#39;s one thing that short books usually drop. I really liked how the author explains the core concepts in just a few words.</p>\r\n', 20, 10, 'Andriy Burkov', 133, '7423524673_machine.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_list`
--

CREATE TABLE `booking_list` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rcv_date` date NOT NULL,
  `rtn_date` date NOT NULL,
  `booking_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 4 COMMENT '1=Activated, 2=Returned, 3=Canceled, 4=Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_list`
--

INSERT INTO `booking_list` (`id`, `book_id`, `user_id`, `rcv_date`, `rtn_date`, `booking_date`, `status`) VALUES
(1, 1, 5, '2021-11-12', '2021-11-20', '2021-11-12', 2),
(2, 3, 5, '2021-11-15', '2021-11-22', '2021-11-12', 3),
(3, 7, 5, '2021-11-17', '2021-11-25', '2021-11-12', 1),
(4, 2, 5, '2021-11-24', '2021-11-30', '2021-11-13', 3),
(7, 7, 1, '2021-11-15', '2021-11-30', '2021-11-13', 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text DEFAULT NULL,
  `is_parent` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Parent Category',
  `cat_status` int(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 2 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `is_parent`, `cat_status`) VALUES
(17, 'Web Design', 'This is the web design category.', 0, 1),
(18, 'Web Development', 'This is the web development category.', 0, 1),
(19, 'Graphic Design', 'This is the graphic design category.', 0, 1),
(20, 'Machine learning', 'This is the machine learning category.', 0, 1),
(21, 'Data Science ', 'This is the data science category.', 0, 1),
(22, 'HTML5', 'This is the HTML5 sub-category.', 17, 2),
(23, 'CSS3', 'This is the CSS3 sub category.', 17, 1),
(24, 'PHP', 'This is the PHP sub-category.', 18, 1),
(25, 'Artificial Intelligence ', 'This is the Artificial Intelligence sub-category.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=User',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active',
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `phone`, `address`, `image`, `role`, `status`, `join_date`) VALUES
(1, 'Akib Uddin Nayan', 'akibnayan182@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '+8801723195116', '<p>Satkania, Chattogram.</p>\r\n', '1967643385_akib.png', 1, 1, '2021-10-29'),
(2, 'Sakib', 'sakib@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '01323432423', '<p>Court road, Cox&#39;s Bazar.</p>\r\n', '1738288895_abdullah.jpg', 2, 1, '2021-10-29'),
(5, 'Hasnain', 'hasnain@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '01323432423', 'Court Road, Cox\'s Bazar, Chattogram', '1649942604_hasnain.jpg', 2, 1, '2021-11-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `booking_list`
--
ALTER TABLE `booking_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
