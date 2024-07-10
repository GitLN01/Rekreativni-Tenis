-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 11:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekreativnitenisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `pol` varchar(50) DEFAULT NULL,
  `visina` int(11) DEFAULT NULL,
  `godine` int(11) DEFAULT NULL,
  `pobeda` int(11) DEFAULT NULL,
  `porazi` int(11) DEFAULT NULL,
  `naziv_kluba` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `profilna_slika` longblob DEFAULT NULL,
  `id_opreme` int(11) DEFAULT NULL,
  `id_uloge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `pol`, `visina`, `godine`, `pobeda`, `porazi`, `naziv_kluba`, `email`, `lozinka`, `profilna_slika`, `id_opreme`, `id_uloge`) VALUES
(4, 'Aleksa', 'Markovic', 'muški', 188, 23, 6, 0, 'Borac', 'aleksa@gmail.com', 'f3071ec919ba79ea9d6fbe49c2c53a3d', NULL, NULL, 4),
(5, 'Stefan', 'Marinkovic', 'muški', 188, 23, 5, 1, 'Borac', 'stefan@gmail.com', 'e42337a246c9864183d92125eb51d86c', NULL, NULL, 4),
(6, 'Lazar', 'Nikitovic', 'muški', 188, 23, 10, 1, 'Partizan', 'lazar@gmail.com', '4f1d3842baae2c304d3b41de3eecd82a', NULL, NULL, 2),
(7, 'Milos', 'Cirovic', 'muški', 190, 23, 9, 8, 'Zvezda', 'milos@gmail.com', 'b82753180960205a4a62feff9c0f93f5', NULL, NULL, 1),
(9, 'Ana', 'Vukajlovic', 'zenski', 170, 23, 1, 1, 'Partizan', 'ana@gmail.com', '5390489da3971cbbcd22c159d54d24da', NULL, NULL, 2),
(17, 'Marija', 'Maric', 'zenski', 176, 24, 5, 6, 'Partizan', 'marija@gmail.com', 'marija123', NULL, NULL, 1),
(18, 'Milija', 'Milic', 'muski', 177, 25, 6, 7, 'Partizan', 'milija@gmail.com', 'milija123', NULL, NULL, 1),
(19, 'Marko', 'Markovic', 'muski', 188, 24, 2, 4, 'Borac', 'marko@gmail.com', 'marko123', NULL, NULL, 1),
(20, 'Milan', 'Milanovic', 'muski', 166, 27, 5, 5, 'Borac', 'milan@gmail.com', 'milan123', NULL, NULL, 3),
(21, 'Arsenije', 'Stosic', 'muski', 185, 23, 5, 6, 'Zvezda', 'arsenije@gmail.com', 'arsenije123', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mecevi`
--

CREATE TABLE `mecevi` (
  `id` int(11) NOT NULL,
  `tip_meca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mecevi`
--

INSERT INTO `mecevi` (`id`, `tip_meca`) VALUES
(5, 'trening'),
(6, 'meč'),
(7, 'turnir');

-- --------------------------------------------------------

--
-- Table structure for table `opreme`
--

CREATE TABLE `opreme` (
  `id` int(11) NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `naziv` varchar(255) NOT NULL,
  `id_tip_opreme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opreme`
--

INSERT INTO `opreme` (`id`, `opis`, `naziv`, `id_tip_opreme`) VALUES
(3, NULL, 'Nike', 2),
(4, NULL, 'Adidas', 2),
(5, NULL, 'Head', 1),
(6, NULL, 'Willson', 1),
(7, NULL, 'Willson', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pregled_rezultata`
--

CREATE TABLE `pregled_rezultata` (
  `id` int(11) NOT NULL,
  `rezultat` varchar(255) NOT NULL,
  `potvrda_rezultata` bit(1) NOT NULL,
  `id_rezervacije` int(11) NOT NULL,
  `status_meca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregled_rezultata`
--

INSERT INTO `pregled_rezultata` (`id`, `rezultat`, `potvrda_rezultata`, `id_rezervacije`, `status_meca`) VALUES
(11, '3-2', b'1', 50, 'odigran'),
(12, '2-3', b'1', 51, 'odigran'),
(13, '3-1', b'1', 52, 'odigran'),
(16, '2-5', b'1', 1, 'odigran');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id` int(11) NOT NULL,
  `id_igraca1` int(11) NOT NULL,
  `id_igraca2` int(11) NOT NULL,
  `id_igraca3` int(11) DEFAULT NULL,
  `id_igraca4` int(11) DEFAULT NULL,
  `id_terena` int(11) NOT NULL,
  `id_meca` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vreme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id`, `id_igraca1`, `id_igraca2`, `id_igraca3`, `id_igraca4`, `id_terena`, `id_meca`, `datum`, `vreme`) VALUES
(1, 9, 7, NULL, NULL, 10, 7, '2024-06-23', '16:10:00'),
(54, 6, 8, NULL, NULL, 59, 7, '2024-06-23', '16:10:00'),
(55, 6, 7, 8, 9, 59, 7, '2024-06-27', '12:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `sportski_klubovi`
--

CREATE TABLE `sportski_klubovi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sportski_klubovi`
--

INSERT INTO `sportski_klubovi` (`id`, `naziv`, `adresa`) VALUES
(1, 'Borac', 'Cacak'),
(2, 'Zvezda', 'Beograd'),
(3, 'Partizan', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `tereni`
--

CREATE TABLE `tereni` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `lokacija` varchar(255) NOT NULL,
  `vrsta_podloge` varchar(255) NOT NULL,
  `kapacitet` int(11) NOT NULL,
  `id_kluba` int(11) NOT NULL,
  `zauzet` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tereni`
--

INSERT INTO `tereni` (`id`, `naziv`, `lokacija`, `vrsta_podloge`, `kapacitet`, `id_kluba`, `zauzet`) VALUES
(10, 'Borac', 'Čačak', 'Šljaka', 50, 1, b'0'),
(12, 'Sloboda', 'Čačak', 'Beton', 10, 1, b'1'),
(59, 'Polet', 'Ljubić', 'Beton', 10, 1, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tip_opreme`
--

CREATE TABLE `tip_opreme` (
  `id` int(11) NOT NULL,
  `tipovi_opreme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tip_opreme`
--

INSERT INTO `tip_opreme` (`id`, `tipovi_opreme`) VALUES
(1, 'reket'),
(2, 'patike'),
(3, 'žice'),
(4, 'lopte'),
(5, 'čarape'),
(6, 'odeća'),
(7, 'znojnice');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(11) NOT NULL,
  `naziv_uloge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `naziv_uloge`) VALUES
(1, 'igrac'),
(2, 'admin'),
(3, 'klub');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mecevi`
--
ALTER TABLE `mecevi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opreme`
--
ALTER TABLE `opreme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tip_opreme` (`id_tip_opreme`);

--
-- Indexes for table `pregled_rezultata`
--
ALTER TABLE `pregled_rezultata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rezervacije` (`id_rezervacije`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_igraca1` (`id_igraca1`),
  ADD KEY `id_igraca2` (`id_igraca2`),
  ADD KEY `id_terena` (`id_terena`),
  ADD KEY `id_meca` (`id_meca`),
  ADD KEY `id_igraca3` (`id_igraca3`),
  ADD KEY `id_igraca4` (`id_igraca4`);

--
-- Indexes for table `sportski_klubovi`
--
ALTER TABLE `sportski_klubovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tereni`
--
ALTER TABLE `tereni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kluba` (`id_kluba`);

--
-- Indexes for table `tip_opreme`
--
ALTER TABLE `tip_opreme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mecevi`
--
ALTER TABLE `mecevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `opreme`
--
ALTER TABLE `opreme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pregled_rezultata`
--
ALTER TABLE `pregled_rezultata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sportski_klubovi`
--
ALTER TABLE `sportski_klubovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tereni`
--
ALTER TABLE `tereni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tip_opreme`
--
ALTER TABLE `tip_opreme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
