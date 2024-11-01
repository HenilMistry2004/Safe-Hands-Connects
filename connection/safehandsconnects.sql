-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 07:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safehandsconnects`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(16) NOT NULL,
  `admin_email_id` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `admin_password`, `admin_email_id`) VALUES
('Ankit Khunt', 'Ankit@123', 'AAnkit@gmail.com'),
('Henil Mistry', 'Henil@123', 'AHenil@gmail.com'),
('Samarth Sorathia', 'Samarth@123', 'ASamrath@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_Id` int(11) NOT NULL,
  `customer_Id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `sub_service_id` int(11) NOT NULL,
  `customerName` varchar(30) DEFAULT NULL,
  `booked_date` datetime NOT NULL DEFAULT current_timestamp(),
  `arrival_date` datetime NOT NULL,
  `departure_date` datetime NOT NULL,
  `order_email` varchar(30) DEFAULT NULL,
  `order_phone` bigint(10) DEFAULT NULL,
  `order_adderss` varchar(40) DEFAULT NULL,
  `order_price` double NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_Id`, `customer_Id`, `service_id`, `sub_service_id`, `customerName`, `booked_date`, `arrival_date`, `departure_date`, `order_email`, `order_phone`, `order_adderss`, `order_price`, `order_status`) VALUES
(1, 1, 1, 1, 'Samarth Sorathia', '2024-04-07 09:57:00', '2024-04-11 09:56:00', '2024-04-13 09:56:00', 'samsorathia3184@gmail.com', 8153080621, 'AB App MG Roade Bilimora', 1000, 'Pending'),
(2, 2, 2, 2, 'Ravi Patel', '2024-04-08 10:00:00', '2024-04-12 10:00:00', '2024-04-14 10:00:00', 'ravipatel123@gmail.com', 9176543210, 'CD Street, Delhi', 1000, 'Completed'),
(3, 3, 3, 1, 'Priya Shah', '2024-04-09 10:05:00', '2024-04-13 10:05:00', '2024-04-15 10:05:00', 'priyashah456@gmail.com', 9187654321, 'EF Area, Mumbai', 1000, 'Cancelled'),
(4, 4, 4, 2, 'Neha Kumar', '2024-04-10 10:10:00', '2024-04-14 10:10:00', '2024-04-16 10:10:00', 'nehakumar789@gmail.com', 9198765432, 'GH Road, Bangalore', 1000, 'Pending'),
(5, 5, 1, 1, 'Rajesh Patel', '2024-04-11 10:15:00', '2024-04-15 10:15:00', '2024-04-17 10:15:00', 'rajeshpatel101@gmail.com', 9209876543, 'IJ Lane, Chennai', 1000, 'Completed'),
(6, 6, 2, 2, 'Sneha Joshi', '2024-04-12 10:20:00', '2024-04-16 10:20:00', '2024-04-18 10:20:00', 'sneha.joshi2024@gmail.com', 9210987654, 'KL Avenue, Hyderabad', 1000, 'Pending'),
(7, 7, 3, 1, 'Rohan Mehta', '2024-04-13 10:25:00', '2024-04-17 10:25:00', '2024-04-19 10:25:00', 'rohanmehta303@gmail.com', 9221098765, 'MN Street, Pune', 1000, 'Completed'),
(8, 8, 4, 2, 'Pooja Verma', '2024-04-14 10:30:00', '2024-04-18 10:30:00', '2024-04-20 10:30:00', 'pooja.verma404@gmail.com', 9232109876, 'OP Road, Kolkata', 1000, 'Cancelled'),
(9, 9, 1, 1, 'Vikram Singh', '2024-04-15 10:35:00', '2024-04-19 10:35:00', '2024-04-21 10:35:00', 'vikram.singh505@gmail.com', 9243210987, 'QR Lane, Ahmedabad', 1000, 'Pending'),
(10, 10, 2, 2, 'Meera Gupta', '2024-04-16 10:40:00', '2024-04-20 10:40:00', '2024-04-22 10:40:00', 'meera.gupta606@gmail.com', 9254321098, 'ST Avenue, Surat', 1000, 'Completed'),
(11, 11, 3, 2, 'Kiran Desai', '2024-04-17 10:45:00', '2024-04-21 10:45:00', '2024-04-23 10:45:00', 'kiran.desai707@gmail.com', 9265432109, 'UV Road, Jaipur', 1000, 'Cancelled'),
(12, 12, 4, 1, 'Amit Shah', '2024-04-18 10:50:00', '2024-04-22 10:50:00', '2024-04-24 10:50:00', 'amit.shah808@gmail.com', 9276543210, 'WX Lane, Lucknow', 1000, 'Pending'),
(13, 13, 1, 1, 'Rita Rani', '2024-04-19 10:55:00', '2024-04-23 10:55:00', '2024-04-25 10:55:00', 'rita.rani909@gmail.com', 9287654321, 'YZ Street, Patna', 1000, 'Completed'),
(14, 14, 2, 1, 'Deepak Sharma', '2024-04-20 11:00:00', '2024-04-24 11:00:00', '2024-04-26 11:00:00', 'deepak.sharma010@gmail.com', 9298765432, 'AB Avenue, Bhopal', 1000, 'Cancelled'),
(15, 15, 3, 1, 'Simran Kaur', '2024-04-21 11:05:00', '2024-04-25 11:05:00', '2024-04-27 11:05:00', 'simran.kaur121@gmail.com', 9309876543, 'CD Road, Kanpur', 1000, 'Pending'),
(16, 16, 4, 2, 'Suresh Kumar', '2024-04-22 11:10:00', '2024-04-26 11:10:00', '2024-04-28 11:10:00', 'suresh.kumar232@gmail.com', 9310987654, 'EF Street, Indore', 1000, 'Completed'),
(17, 17, 1, 2, 'Isha Jain', '2024-04-23 11:15:00', '2024-04-27 11:15:00', '2024-04-29 11:15:00', 'isha.jain343@gmail.com', 9321098765, 'GH Lane, Vadodara', 1000, 'Cancelled'),
(18, 18, 2, 2, 'Arjun Rao', '2024-04-24 11:20:00', '2024-04-28 11:20:00', '2024-04-30 11:20:00', 'arjun.rao454@gmail.com', 9332109876, 'IJ Avenue, Nashik', 1000, 'Pending'),
(19, 19, 3, 1, 'Anjali Mehta', '2024-04-25 11:25:00', '2024-04-29 11:25:00', '2024-05-01 11:25:00', 'anjali.mehta565@gmail.com', 9343210987, 'KL Road, Coimbatore', 1000, 'Completed'),
(20, 20, 4, 1, 'Akash Patel', '2024-04-26 11:30:00', '2024-05-01 11:30:00', '2024-05-02 11:30:00', 'akash.patel676@gmail.com', 9354321098, 'MN Street, Noida', 1000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_password` varchar(40) NOT NULL,
  `customer_email_id` varchar(25) NOT NULL,
  `customer_contact_no` varchar(12) NOT NULL,
  `customer_address` varchar(30) NOT NULL,
  `customer_gender` varchar(6) NOT NULL,
  `customer_dob` date NOT NULL,
  `customer_registeredDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(9) NOT NULL DEFAULT 'active',
  `isTwoFactorEnable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_password`, `customer_email_id`, `customer_contact_no`, `customer_address`, `customer_gender`, `customer_dob`, `customer_registeredDateTime`, `status`, `isTwoFactorEnable`) VALUES
(1, 'Samarth Sorathia', '81ff64f3a2003b719f8789b096ca069b', 'csamarth@gmail.com', '9513456789', '6 Koteshwar Nagar, Opp. Fire S', 'Male', '2002-10-15', '2024-04-07 09:54:44', 'Active', 0),
(2, 'Ravi Patel', '81ff64f3a2003b719f8789b096ca069b', 'ravi@gmail.com', '9712345678', 'CD Street, Delhi', 'Male', '1989-12-05', '2024-04-08 10:00:00', 'Active', 1),
(3, 'Priya Shah', '7d3b1e7cf4c3ae14f40e2a3dc569c009', 'priyashah456@gmail.com', '9812345678', 'EF Area, Mumbai', 'Female', '1990-07-10', '2024-04-09 10:05:00', 'Active', 0),
(4, 'Neha Kumar', 'd4f1c3e4dbcf4fc006b37b60e042e1f0', 'nehakumar789@gmail.com', '9912345678', 'GH Road, Bangalore', 'Female', '1991-03-15', '2024-04-10 10:10:00', 'Active', 1),
(5, 'Rajesh Patel', '3e6e1f3d2b4d272e7126f40d09107e12', 'rajeshpatel101@gmail.com', '9813456789', 'IJ Lane, Chennai', 'Male', '1985-09-20', '2024-04-11 10:15:00', 'Active', 0),
(6, 'Sneha Joshi', 'c2d6e7b8d3d4f1f4121c5e3b072109f2', 'sneha.joshi2024@gmail.com', '9723456789', 'KL Avenue, Hyderabad', 'Female', '1994-11-25', '2024-04-12 10:20:00', 'Active', 0),
(7, 'Rohan Mehta', 'f5a4c8e1e3f3c6d2e181d7a09a1e2b3c', 'rohanmehta303@gmail.com', '9734567890', 'MN Street, Pune', 'Male', '1992-01-05', '2024-04-13 10:25:00', 'Active', 1),
(8, 'Pooja Verma', 'a1d3f2e4e5b6c7d8e9f1e2c4b3d6a7e8', 'pooja.verma404@gmail.com', '9645781234', 'OP Road, Kolkata', 'Female', '1987-06-30', '2024-04-14 10:30:00', 'Active', 0),
(9, 'Vikram Singh', 'c6d3f1e2a8b9c7d4e5e1f6c3d2a4b5e8', 'vikram.singh505@gmail.com', '9516781234', 'QR Lane, Ahmedabad', 'Male', '1988-02-12', '2024-04-15 10:35:00', 'Active', 1),
(10, 'Meera Gupta', 'b7c8d9e0f1a2b3c4d5e6f7a8b9c0d1e2', 'meera.gupta606@gmail.com', '9638527410', 'ST Avenue, Surat', 'Female', '1993-05-20', '2024-04-16 10:40:00', 'Active', 0),
(11, 'Kiran Desai', 'd6f7c1a2b8e9d4c5e1b2c3a4d5f6e7c8', 'kiran.desai707@gmail.com', '9786543210', 'UV Road, Jaipur', 'Female', '1995-08-25', '2024-04-17 10:45:00', 'Active', 1),
(12, 'Amit Shah', 'c9b8d6e1f2a3b4c5e6d7f8a9b0c1d2e3', 'amit.shah808@gmail.com', '9898765432', 'WX Lane, Lucknow', 'Male', '1989-12-10', '2024-04-18 10:50:00', 'Active', 0),
(13, 'Rita Rani', 'b1a2c3d4e5f6d7e8a9b0c1d2e3f4g5h6', 'rita.rani909@gmail.com', '9709876543', 'YZ Street, Patna', 'Female', '1990-11-05', '2024-04-19 10:55:00', 'Inactive', 1),
(14, 'Deepak Sharma', 'a2b3c4d5e6f7g8h9i0j1k2l3m4n5o6p7', 'deepak.sharma010@gmail.co', '9298765432', 'AB Avenue, Bhopal', 'Male', '1988-01-15', '2024-04-20 11:00:00', 'Active', 0),
(15, 'Simran Kaur', 'b3c4d5e6f7g8h9i0j1k2l3m4n5o6p7q8', 'simran.kaur121@gmail.com', '9309876543', 'CD Road, Kanpur', 'Female', '1992-04-22', '2024-04-21 11:05:00', 'Inactive', 1),
(16, 'Suresh Kumar', 'c4d5e6f7g8h9i0j1k2l3m4n5o6p7q8r9', 'suresh.kumar232@gmail.com', '9310987654', 'EF Street, Indore', 'Male', '1985-03-18', '2024-04-22 11:10:00', 'Active', 0),
(17, 'Isha Jain', 'd5e6f7g8h9i0j1k2l3m4n5o6p7q8r9s0', 'isha.jain343@gmail.com', '9321098765', 'GH Lane, Vadodara', 'Female', '1991-09-15', '2024-04-23 11:15:00', 'Active', 1),
(18, 'Arjun Rao', 'e6f7g8h9i0j1k2l3m4n5o6p7q8r9s0t1', 'arjun.rao454@gmail.com', '9332109876', 'IJ Avenue, Nashik', 'Male', '1994-02-20', '2024-04-24 11:20:00', 'Active', 0),
(19, 'Anjali Mehta', 'f7g8h9i0j1k2l3m4n5o6p7q8r9s0t1u2', 'anjali.mehta565@gmail.com', '9343210987', 'KL Road, Coimbatore', 'Female', '1988-07-12', '2024-04-25 11:25:00', 'Active', 1),
(20, 'Akash Patel', 'g8h9i0j1k2l3m4n5o6p7q8r9s0t1u2v3', 'akash.patel676@gmail.com', '9354321098', 'MN Street, Noida', 'Male', '1986-11-30', '2024-04-26 11:30:00', 'Inactive', 0),
(21, 'Ankit khunt', '5de52ea9d787966e8b598720255a37a7', 'cankit@gmail.com', '9313516451', '118, radhe park soc, yogi chow', 'Male', '2004-11-26', '2024-08-27 10:56:33', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_Id` int(11) NOT NULL,
  `booking_Id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_Id`, `booking_Id`, `customer_id`, `date_time`, `comment`) VALUES
(1, 1, 1, '2024-04-07 09:56:00', 'Great service!'),
(2, 2, 2, '2024-04-08 10:01:00', 'Very satisfied with the service.'),
(3, 3, 3, '2024-04-09 10:06:00', 'Good experience.'),
(4, 4, 4, '2024-04-10 10:11:00', 'Highly recommend.'),
(5, 5, 5, '2024-04-11 10:16:00', 'Will use again.'),
(6, 6, 6, '2024-04-12 10:21:00', 'Not bad.'),
(7, 7, 7, '2024-04-13 10:26:00', 'Service was okay.'),
(8, 8, 8, '2024-04-14 10:31:00', 'Could be improved.'),
(9, 9, 9, '2024-04-15 10:36:00', 'Excellent service.'),
(10, 10, 10, '2024-04-16 10:41:00', 'Very pleased.'),
(11, 11, 11, '2024-04-17 10:46:00', 'Service was great.'),
(12, 12, 12, '2024-04-18 10:51:00', 'Happy with the service.'),
(13, 13, 13, '2024-04-19 10:56:00', 'Good service overall.'),
(14, 14, 14, '2024-04-20 11:01:00', 'Service met expectations.'),
(15, 15, 15, '2024-04-21 11:06:00', 'Satisfied with the result.'),
(16, 16, 16, '2024-04-22 11:11:00', 'Service was as expected.'),
(17, 17, 17, '2024-04-23 11:16:00', 'Service could be improved.'),
(18, 18, 18, '2024-04-24 11:21:00', 'Overall experience was good.'),
(19, 19, 19, '2024-04-25 11:26:00', 'Very happy with the service.'),
(20, 20, 20, '2024-04-26 11:31:00', 'Service was excellent.');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `booking_Id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`booking_Id`, `customer_id`, `payment_id`, `total_price`, `date_time`) VALUES
(1, 1, 1, 40.00, '2024-04-07 09:57:00'),
(2, 2, 2, 30.00, '2024-04-08 10:02:00'),
(3, 3, 3, 25.00, '2024-04-09 10:07:00'),
(4, 4, 4, 25.00, '2024-04-10 10:12:00'),
(5, 5, 5, 40.00, '2024-04-11 10:17:00'),
(6, 6, 6, 30.00, '2024-04-12 10:22:00'),
(7, 7, 7, 25.00, '2024-04-13 10:27:00'),
(8, 8, 8, 25.00, '2024-04-14 10:32:00'),
(9, 9, 9, 40.00, '2024-04-15 10:37:00'),
(10, 10, 10, 30.00, '2024-04-16 10:42:00'),
(11, 11, 11, 25.00, '2024-04-17 10:47:00'),
(12, 12, 12, 25.00, '2024-04-18 10:52:00'),
(13, 13, 13, 40.00, '2024-04-19 10:57:00'),
(14, 14, 14, 30.00, '2024-04-20 11:02:00'),
(15, 15, 15, 25.00, '2024-04-21 11:07:00'),
(16, 16, 16, 25.00, '2024-04-22 11:12:00'),
(17, 17, 17, 40.00, '2024-04-23 11:17:00'),
(18, 18, 18, 30.00, '2024-04-24 11:22:00'),
(19, 19, 19, 25.00, '2024-04-25 11:27:00'),
(20, 20, 20, 25.00, '2024-04-26 11:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_added_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `services_image` varchar(40) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `description`, `service_price`, `service_added_date_time`, `services_image`, `status`) VALUES
(1, 'Maid', 'This service includes thorough cleaning of all living spaces.', 40, '2024-03-08 19:49:05', 'maid.png', 'active'),
(2, 'Security Guard', 'This service provides security personnel for safeguarding your property.', 30, '2024-03-08 19:49:05', 'security.png', 'active'),
(3, 'Cook', 'This service involves preparing meals according to your preferences.', 25, '2024-03-08 19:49:05', 'chef4.png', 'active'),
(4, 'Babysitter', 'This service provides childcare assistance, including supervision and care for children.', 25, '2024-03-08 19:49:05', 'babysitter.png', 'active'),
(5, 'Gardener', 'This service provides gardening and landscaping services.', 35, '2024-03-08 19:49:05', 'gardener.png', 'active'),
(7, 'Driver', 'Provides personal driving services for any transportation needs.', 45, '2024-03-08 19:49:05', 'driver.png', 'inactive'),
(21, '', '', 0, '2024-08-25 13:23:25', '', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `sub_service`
--

CREATE TABLE `sub_service` (
  `sub_service_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `sub_service_name` varchar(255) NOT NULL,
  `sub_service_price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_service`
--

INSERT INTO `sub_service` (`sub_service_id`, `service_id`, `sub_service_name`, `sub_service_price`, `description`) VALUES
(1, 1, 'Deep Clean', 50.00, 'Comprehensive cleaning including carpets and upholstery.'),
(2, 1, 'Weekly Clean', 30.00, 'Weekly house cleaning service.'),
(3, 2, 'Event Security', 250.00, 'Security services for events, ensuring the safety and smooth operation of events.'),
(4, 2, 'Home Security', 350.00, 'Provides security solutions and personnel for residential areas.'),
(5, 2, 'Escort Security', 300.00, 'Personal security services for escorting individuals or groups.'),
(6, 3, 'Event Catering', 1200.00, 'Provides catering services for various events, including setup and serving.'),
(7, 3, 'Cuisine Specialization Chef', 3000.00, 'Specialized chefs for different cuisines such as Punjabi, Gujarati, Chinese, Italian, etc.'),
(8, 4, 'Nanny Service', 200.00, 'Full-time or part-time nanny services for child care.'),
(9, 4, 'New Born Care Specialist', 300.00, 'Specialists in caring for newborn babies, including feeding, changing, and sleep routines.'),
(10, 4, 'Educational Babysitting', 350.00, 'Babysitting services with an emphasis on educational activities and learning.'),
(11, 5, 'Garden Maintenance', 40.00, 'Regular maintenance and care of garden spaces.'),
(12, 5, 'Landscape Design', 100.00, 'Design and layout services for garden and outdoor spaces.'),
(13, 7, 'Daily Driver', 50.00, 'Daily driving service for transportation needs.'),
(14, 7, 'Occasional Driver', 30.00, 'Occasional driving service for special events or trips.');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL,
  `worker_name` varchar(20) NOT NULL,
  `service_id` int(11) NOT NULL,
  `worker_password` varchar(40) NOT NULL,
  `worker_email_id` varchar(35) NOT NULL,
  `worker_contact` varchar(12) NOT NULL,
  `worker_address` varchar(30) NOT NULL,
  `worker_gender` varchar(6) NOT NULL,
  `worker_dob` date DEFAULT NULL,
  `status` varchar(9) NOT NULL DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `worker_name`, `service_id`, `worker_password`, `worker_email_id`, `worker_contact`, `worker_address`, `worker_gender`, `worker_dob`, `status`) VALUES
(1, 'Ankit Khunt', 1, '7a93c72bd34581071685fa715a9841b5', 'akhunt77@gmail.com', '9313516451', 'A-62 Balaji Bunglows, Yogi Cho', 'Male', '2004-08-17', 'active'),
(2, 'Sophie Davis', 2, 'd9e0b8a0f4538b09e9a0932d12f10a6d', 'sophie.davis@example.com', '8314567890', '123 Main Street, City', 'Female', '1990-05-15', 'active'),
(3, 'Raj Patel', 3, 'baf10e348a93a4309f6d3ae29a5360b9', 'raj.patel@example.com', '8512345678', '456 Elm Street, City', 'Male', '1985-12-20', 'inactive'),
(4, 'Aisha Khan', 4, 'a2d1e6a81e835e1bb08b39e0b50ff5b8', 'aisha.khan@example.com', '9213456789', '789 Oak Street, City', 'Female', '1992-08-22', 'active'),
(5, 'John Smith', 5, '62f1c7d4a3738f93e8a061f730ef4f8c', 'john.smith@example.com', '9723456789', '321 Pine Street, City', 'Male', '1988-03-10', 'active'),
(6, 'Emily Davis', 6, 'bd8f1d24a20cfedb34f158d890f9f8e2', 'emily.davis@example.com', '9534567890', '654 Maple Street, City', 'Female', '1995-11-11', 'inactive'),
(7, 'Carlos Lopez', 7, '39e0d2587f61b9079b37e8f9e00c1c48', 'carlos.lopez@example.com', '9783456789', '987 Cedar Street, City', 'Male', '1982-07-05', 'active'),
(8, 'Mia Wong', 8, '12e4f6e1a22c6b30bc0f1f4b8c86b08f', 'mia.wong@example.com', '9682345678', '876 Birch Street, City', 'Female', '1989-10-10', 'active'),
(9, 'Ahmed Ali', 9, '2a4c5e0d3d873e2b3d43d28a10bc1c7b', 'ahmed.ali@example.com', '9345678901', '432 Fir Street, City', 'Male', '1991-06-12', 'inactive'),
(10, 'Natalie Green', 10, 'b2a8c0e2f755ec987d01b2e4a2d5f0cb', 'natalie.green@example.com', '9543216789', '678 Walnut Street, City', 'Female', '1993-09-25', 'active'),
(11, 'Liam Brown', 11, 'f1b6c0d78c9e6b68f20c60c3b1f5b83c', 'liam.brown@example.com', '9894567890', '543 Spruce Street, City', 'Male', '1984-02-14', 'active'),
(12, 'Olivia Martinez', 12, 'd2a8e3f1b5c6d7e8f0b1a2d3c4e5f6a7', 'olivia.martinez@example.com', '9712345678', '321 Birch Street, City', 'Female', '1990-12-30', 'inactive'),
(13, 'Ethan Wilson', 13, 'c2e1d3a4f5b6e7d8a9b0c1e2f3d4c5a6', 'ethan.wilson@example.com', '9513456789', '876 Oak Street, City', 'Male', '1987-04-01', 'active'),
(14, 'Sophia Johnson', 14, 'a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6', 'sophia.johnson@example.com', '9323456789', '654 Cedar Street, City', 'Female', '1992-11-15', 'active'),
(15, 'Jack Miller', 15, 'e1f2d3a4b5c6d7e8f9b0c1e2a3d4f5a6', 'jack.miller@example.com', '9734567890', '789 Pine Street, City', 'Male', '1989-03-25', 'inactive'),
(16, 'Chloe Taylor', 16, 'b2e1d3a4f5c6d7e8f9a0b1c2e3f4d5a6', 'chloe.taylor@example.com', '9672345678', '987 Maple Street, City', 'Female', '1991-05-22', 'active'),
(17, 'Noah Anderson', 17, 'c3d4e5f6a7b8c9d0e1f2a3b4c5e6d7f8', 'noah.anderson@example.com', '9892345678', '543 Walnut Street, City', 'Male', '1988-08-14', 'active'),
(18, 'Isabella White', 18, 'd4e5f6a7b8c9d0e1f2a3b4c5e6d7f8a', 'isabella.white@example.com', '9543216789', '876 Pine Street, City', 'Female', '1993-07-07', 'inactive'),
(19, 'Lucas Harris', 19, 'e5f6a7b8c9d0e1f2a3b4c5e6d7f8a9b', 'lucas.harris@example.com', '9712345678', '432 Maple Street, City', 'Male', '1986-09-12', 'active'),
(20, 'Mia Clark', 20, 'f6a7b8c9d0e1f2a3b4c5e6d7f8a9b0c', 'mia.clark@example.com', '9683456789', '321 Elm Street, City', 'Female', '1995-01-25', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `worker_availability`
--

CREATE TABLE `worker_availability` (
  `worker_Availability` varchar(10) NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_availability`
--

INSERT INTO `worker_availability` (`worker_Availability`, `worker_id`, `start_time`, `end_time`) VALUES
('Available', 1, '2024-08-25 09:00:00', '2024-08-25 17:00:00'),
('Available', 2, '2024-08-25 10:00:00', '2024-08-25 18:00:00'),
('Available', 3, '2024-08-25 11:00:00', '2024-08-25 19:00:00'),
('Available', 4, '2024-08-25 09:00:00', '2024-08-25 15:00:00'),
('Available', 5, '2024-08-25 12:00:00', '2024-08-25 20:00:00'),
('Available', 6, '2024-08-25 08:00:00', '2024-08-25 16:00:00'),
('Available', 7, '2024-08-25 13:00:00', '2024-08-25 21:00:00'),
('Available', 8, '2024-08-25 10:00:00', '2024-08-25 18:00:00'),
('Available', 9, '2024-08-25 09:00:00', '2024-08-25 17:00:00'),
('Available', 10, '2024-08-25 14:00:00', '2024-08-25 22:00:00'),
('Available', 11, '2024-08-25 11:00:00', '2024-08-25 19:00:00'),
('Available', 12, '2024-08-25 09:00:00', '2024-08-25 17:00:00'),
('Available', 13, '2024-08-25 12:00:00', '2024-08-25 20:00:00'),
('Available', 14, '2024-08-25 13:00:00', '2024-08-25 21:00:00'),
('Available', 15, '2024-08-25 09:00:00', '2024-08-25 17:00:00'),
('Available', 16, '2024-08-25 10:00:00', '2024-08-25 18:00:00'),
('Available', 17, '2024-08-25 11:00:00', '2024-08-25 19:00:00'),
('Available', 18, '2024-08-25 09:00:00', '2024-08-25 15:00:00'),
('Available', 19, '2024-08-25 12:00:00', '2024-08-25 20:00:00'),
('Available', 20, '2024-08-25 13:00:00', '2024-08-25 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `worker_booking`
--

CREATE TABLE `worker_booking` (
  `worker_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_booking`
--

INSERT INTO `worker_booking` (`worker_id`, `booking_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `worker_specialization`
--

CREATE TABLE `worker_specialization` (
  `worker_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_specialization`
--

INSERT INTO `worker_specialization` (`worker_id`, `service_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_email_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_Id`),
  ADD KEY `customer_Id` (`customer_Id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `sub_service_id` (`sub_service_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email_id` (`customer_email_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_Id`),
  ADD KEY `booking_Id` (`booking_Id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_Id` (`booking_Id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `sub_service`
--
ALTER TABLE `sub_service`
  ADD PRIMARY KEY (`sub_service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`),
  ADD UNIQUE KEY `worker_email_id` (`worker_email_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `worker_availability`
--
ALTER TABLE `worker_availability`
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `worker_booking`
--
ALTER TABLE `worker_booking`
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Indexes for table `worker_specialization`
--
ALTER TABLE `worker_specialization`
  ADD KEY `service_id` (`service_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sub_service`
--
ALTER TABLE `sub_service`
  MODIFY `sub_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `sub_service_id` FOREIGN KEY (`sub_service_id`) REFERENCES `sub_service` (`sub_service_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`booking_Id`) REFERENCES `booking` (`booking_Id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_Id`) REFERENCES `booking` (`booking_Id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sub_service`
--
ALTER TABLE `sub_service`
  ADD CONSTRAINT `sub_service_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Constraints for table `worker_availability`
--
ALTER TABLE `worker_availability`
  ADD CONSTRAINT `worker_availability_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
