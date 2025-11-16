-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2025 at 01:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crowdsource`
--

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `contentid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reference_link` varchar(100) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`contentid`, `title`, `description`, `reference_link`, `tags`, `user_id`, `createdat`) VALUES
(1, 'http://localhost/Crowd-Based-Problem-Solving-Plateform/index.html', 'http://localhost/Crowd-Based-Problem-Solving-Plateform/index.html', 'http://localhost/Crowd-Based-Problem-Solving-Plateform/index.html', 'tech', 1, '2025-11-07 12:15:04'),
(2, 'which language do you use for coding', 'i wannted to know', 'http://localhost/Crowd-Based-Problem-Solving-Plateform/index.html#', 'tech', 1, '2025-11-07 12:33:41'),
(3, 'Hey, I am new to the Stage', 'hey, chat i am new to perform an presentation on stage , i never had such an confidential stage daring so can anyone please suggest me some tips to boost confidence and, make my day !!!', 'https://www.youtube.com/watch?v=l_NYrWqUR40', 'life-hacks', 4, '2025-11-07 16:45:33'),
(4, 'Laptop overheating while working on large projects', 'Many users working on heavy applications—such as Android Studio, VS Code with multiple extensions, Blender, Adobe software, or gaming engines—experience severe laptop overheating. The issue worsens when the device is used on soft surfaces such as beds and blankets where airflow is blocked. Overheating can cause the CPU to throttle, reducing performance dramatically, leading to lag, crashes, and slow project builds.\r\nIn most cases, the internal cooling system becomes inefficient because of dust accumulation in heat vents or dried-out thermal paste. Users who never clean their laptop for 1–2 years face up to a 30% drop in cooling efficiency.\r\nAnother big reason is background processes. Many laptops run auto-updaters, telemetry services, antivirus scans, and background indexing that consume CPU constantly.\r\nThis problem is widely seen among students working on final-year projects, developers with long build times, and gamers who rely heavily on GPU workloads. If not controlled in time, overheating can also damage the battery, cause sudden shutdowns, and reduce laptop lifespan.', 'https://www.techguide.com/laptop-cooling-tips', 'tech', 4, '2025-11-08 05:26:14'),
(5, 'Difficulty waking up early consistently', 'Waking up early is one of the most challenging habits to develop, especially for students and working professionals who sleep late due to assignments, social media, or phone addiction. Even when motivated, people often wake up tired, hit snooze repeatedly, or oversleep by 1–2 hours.\r\nThe root cause is misalignment of the circadian rhythm. If someone sleeps at irregular times every day (1 AM one day, 3 AM another day), the brain cannot establish a fixed wake pattern. Using mobile phones late at night creates blue-light exposure, which delays melatonin production and confuses the biological clock.\r\nAnother reason is sleep debt. When the body accumulates 10–12 hours of missed sleep over a week, it automatically forces deep sleep phases in the morning, making early wake-up nearly impossible. Many people also try to wake up early using loud alarms, but alarms trigger stress hormones and do not fix the actual sleep cycle.\r\nThe problem becomes more severe for college students during exam preparation and project submissions.', '', 'life-hacks', 4, '2025-11-08 05:27:10'),
(6, 'Why do countries have different time zones?', 'The Earth rotates 360 degrees in 24 hours, which means it rotates 15 degrees every hour. To measure time accurately based on the position of the Sun, the world is divided into 24 time zones, each representing 1 hour difference.\r\nBefore time zones were created, every city followed its own “local solar time.” This caused massive confusion when railways and telegraph systems expanded. To solve this, the world adopted Standard Time Zones in 1884.\r\nGeographical, political, and social factors influence these time zones. For example, India follows UTC+5:30 instead of a whole-hour zone.\r\nTime zones help coordinate global travel, international business, flight schedules, and digital communication. Without them, international systems would collapse due to mismatched timing.', 'https://www.timeanddate.com/time/time-zones-history.html', 'general knowledge', 1, '2025-11-08 05:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `solutionid` int(11) NOT NULL,
  `contentid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mediaurl` varchar(255) DEFAULT NULL,
  `solutionlink` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`solutionid`, `contentid`, `title`, `description`, `mediaurl`, `solutionlink`, `userid`, `createdat`) VALUES
(2, 2, 'WERF', 'EF', 'http://localhost/Crowd-Based-Problem-Solving-Plateform/problem.php?id=2', 'http://localhost/Crowd-Based-Problem-Solving-Plateform/problem.php?id=2', 1, NULL),
(3, 3, 'i am experienced one !', 'hey i do have some tips and tricks for you to boost you confidance at the stage stay calm and take your time no need to worries and no one is gonna judge you for your thijngs coz your first toooo follows are some links for you have a good day !!', 'https://www.bing.com/search?pglt=931&q=how+to+boost+confidance&cvid=3bdd1f139ae443ffb7f0d06ee99f58c7&gs_lcrp=EgRlZGdlKgYIABBFGDkyBggAEEUYOTIGCAEQABhAMgYIAhAAGEAyBggDEAAYQDIGCAQQABhAMgYIBRAAGEAyBggGEAAYQDIGCAcQABhAMgYICBAAGEDSAQg5NTk4ajBqMagCALACAA&FORM=AN', '', 4, NULL),
(4, 3, 'i am experienced one ! ', 'hey i do have some tips and tricks for you to boost you confidance at the stage stay calm and take your time no need to worries and no one is gonna judge you for your thijngs coz your first toooo follows are some links for you have a good day !!', 'https://www.finerminds.com/wp-content/uploads/2016/08/shutterstock_275140940.jpg', 'https://www.verywellmind.com/how-to-boost-your-self-confidence-4163098', 4, NULL),
(5, 6, 'Its about how earth rotates ', 'May this will help you to sort your things !', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/World_Time_Zones_Map.svg/500px-World_Time_Zones_Map.svg.png', 'https://en.wikipedia.org/wiki/Time_zone', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `solutionupvotes`
--

CREATE TABLE `solutionupvotes` (
  `id` int(11) NOT NULL,
  `solutionid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutionupvotes`
--

INSERT INTO `solutionupvotes` (`id`, `solutionid`, `userid`) VALUES
(1, 4, 5),
(2, 3, 5),
(3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `solution_upvotes`
--

CREATE TABLE `solution_upvotes` (
  `id` int(11) NOT NULL,
  `solutionid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mono` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profilepicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `mono`, `password`, `bio`, `profilepicture`) VALUES
(1, 'Jaykumar Subhashsingh Pardeshi', 'jaykumar@gmail.com', '02323232323', '1234', NULL, 'uploads/1762559971_guss5.jpg'),
(2, 'Jaykumar Subhashsingh Pardeshi', 'jay@gmail.com', '1234512345', '123', NULL, NULL),
(3, 'Jaykumar Subhashsingh Pardeshi', 'jay@gmail.com', '1234512345', '123', NULL, NULL),
(4, 'Yash Patange ', 'yash@gmail.com', '1234567890', '1234', NULL, 'uploads/1762559505_guss7.jpg'),
(5, 'saumitra', 'sm@gmail.com', '1234123412', '3254', NULL, 'uploads/1762559381_WIN_20250202_14_45_30_Pro.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`contentid`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`solutionid`),
  ADD KEY `contentid` (`contentid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `solutionupvotes`
--
ALTER TABLE `solutionupvotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solutionid` (`solutionid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `solution_upvotes`
--
ALTER TABLE `solution_upvotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vote` (`solutionid`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `contentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `solutionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `solutionupvotes`
--
ALTER TABLE `solutionupvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `solution_upvotes`
--
ALTER TABLE `solution_upvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `solutions_ibfk_1` FOREIGN KEY (`contentid`) REFERENCES `problems` (`contentid`),
  ADD CONSTRAINT `solutions_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `solutionupvotes`
--
ALTER TABLE `solutionupvotes`
  ADD CONSTRAINT `solutionupvotes_ibfk_1` FOREIGN KEY (`solutionid`) REFERENCES `solutions` (`solutionid`),
  ADD CONSTRAINT `solutionupvotes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `solution_upvotes`
--
ALTER TABLE `solution_upvotes`
  ADD CONSTRAINT `solution_upvotes_ibfk_1` FOREIGN KEY (`solutionid`) REFERENCES `solutions` (`solutionid`) ON DELETE CASCADE,
  ADD CONSTRAINT `solution_upvotes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
