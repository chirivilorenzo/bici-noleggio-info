-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2024 at 09:55 PM
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
-- Database: `bici-noleggio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `nome`, `cognome`, `email`, `password`) VALUES
(1, 'Alessandro', 'Rossi', 'alessandro.rossi@example.com', 'adminpass1'),
(2, 'Giulia', 'Bianchi', 'giulia.bianchi@example.com', 'adminpass2'),
(3, 'Marco', 'Verdi', 'marco.verdi@example.com', 'adminpass3'),
(4, 'Elena', 'Neri', 'elena.neri@example.com', 'adminpass4'),
(5, 'Francesco', 'Gialli', 'francesco.gialli@example.com', 'adminpass5'),
(6, 'Laura', 'Blu', 'laura.blu@example.com', 'adminpass6'),
(7, 'Davide', 'Arancioni', 'davide.arancioni@example.com', 'adminpass7'),
(8, 'Sara', 'Rosa', 'sara.rosa@example.com', 'adminpass8'),
(9, 'Giorgio', 'Marroni', 'giorgio.marroni@example.com', 'adminpass9'),
(10, 'Paola', 'Viola', 'paola.viola@example.com', 'adminpass10');

-- --------------------------------------------------------

--
-- Table structure for table `bici`
--

CREATE TABLE `bici` (
  `ID` int(11) NOT NULL,
  `disponibile` tinyint(1) NOT NULL DEFAULT 1,
  `RFID` char(4) NOT NULL,
  `gps` char(4) NOT NULL,
  `km_percorsi` int(11) NOT NULL DEFAULT 0,
  `km_manutenzione` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bici`
--

INSERT INTO `bici` (`ID`, `disponibile`, `RFID`, `gps`, `km_percorsi`, `km_manutenzione`) VALUES
(1, 1, '0001', 'G001', 100, 30),
(2, 0, '0002', 'G002', 200, 120),
(3, 1, '0003', 'G003', 300, 50),
(4, 0, '0004', 'G004', 400, 350),
(5, 1, '0005', 'G005', 500, 450),
(6, 1, '0006', 'G006', 600, 320),
(7, 0, '0007', 'G007', 700, 600),
(8, 1, '0008', 'G008', 800, 150),
(9, 0, '0009', 'G009', 900, 870),
(10, 1, '0010', 'G010', 1000, 500),
(11, 1, '0011', 'G011', 1100, 900),
(12, 0, '0012', 'G012', 1200, 1100),
(13, 1, '0013', 'G013', 1300, 1200),
(14, 0, '0014', 'G014', 1400, 400),
(15, 1, '0015', 'G015', 1500, 1450),
(16, 1, '0016', 'G016', 1600, 300),
(17, 0, '0017', 'G017', 1700, 1500),
(18, 1, '0018', 'G018', 1800, 1600),
(19, 0, '0019', 'G019', 1900, 1700),
(20, 1, '0020', 'G020', 2000, 600),
(21, 1, '0021', 'G021', 2100, 2050),
(22, 0, '0022', 'G022', 2200, 1500),
(23, 1, '0023', 'G023', 2300, 1000),
(24, 0, '0024', 'G024', 2400, 2250),
(25, 1, '0025', 'G025', 2500, 2450),
(26, 1, '0026', 'G026', 2600, 2000),
(27, 0, '0027', 'G027', 2700, 2100),
(28, 1, '0028', 'G028', 2800, 2700),
(29, 0, '0029', 'G029', 2900, 1000),
(30, 1, '0030', 'G030', 3000, 1500),
(31, 1, '0031', 'G031', 3100, 3000),
(32, 0, '0032', 'G032', 3200, 1800),
(33, 1, '0033', 'G033', 3300, 3200),
(34, 0, '0034', 'G034', 3400, 3300),
(35, 1, '0035', 'G035', 3500, 2000),
(36, 1, '0036', 'G036', 3600, 3400),
(37, 0, '0037', 'G037', 3700, 3500),
(38, 1, '0038', 'G038', 3800, 3600),
(39, 0, '0039', 'G039', 3900, 3000),
(40, 1, '0040', 'G040', 4000, 3700);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `num_carta_credito` char(16) DEFAULT NULL,
  `num_tessera` char(8) NOT NULL,
  `idIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`ID`, `nome`, `cognome`, `email`, `password`, `num_carta_credito`, `num_tessera`, `idIndirizzo`) VALUES
(1, 'Alessandro', 'Bianchi', 'alessandro.bianchi@example.com', 'password1', '1234567812345678', 'T1234561', 1),
(2, 'Francesca', 'Rossi', 'francesca.rossi@example.com', 'password2', '2345678923456789', 'T1234562', 2),
(3, 'Giovanni', 'Verdi', 'giovanni.verdi@example.com', 'password3', '3456789034567890', 'T1234563', 3),
(4, 'Maria', 'Neri', 'maria.neri@example.com', 'password4', '4567890145678901', 'T1234564', 4),
(5, 'Luigi', 'Gialli', 'luigi.gialli@example.com', 'password5', '5678901256789012', 'T1234565', 5),
(6, 'Paola', 'Blu', 'paola.blu@example.com', 'password6', '6789012367890123', 'T1234566', 6),
(7, 'Marco', 'Arancioni', 'marco.arancioni@example.com', 'password7', '7890123478901234', 'T1234567', 7),
(8, 'Elena', 'Rosa', 'elena.rosa@example.com', 'password8', '8901234589012345', 'T1234568', 8),
(9, 'Giorgio', 'Marroni', 'giorgio.marroni@example.com', 'password9', '9012345690123456', 'T1234569', 9),
(10, 'Laura', 'Viola', 'laura.viola@example.com', 'password10', '0123456701234567', 'T1234570', 10);

-- --------------------------------------------------------

--
-- Table structure for table `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `via` varchar(32) NOT NULL,
  `citta` varchar(64) NOT NULL,
  `cap` char(5) NOT NULL,
  `num_civico` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `via`, `citta`, `cap`, `num_civico`) VALUES
(1, 'Via Roma', 'Roma', '00100', '10'),
(2, 'Via Milano', 'Milano', '20100', '20'),
(3, 'Via Firenze', 'Firenze', '50100', '30'),
(4, 'Via Napoli', 'Napoli', '80100', '40'),
(5, 'Via Torino', 'Torino', '10100', '50'),
(6, 'Via Venezia', 'Venezia', '30100', '60'),
(7, 'Via Palermo', 'Palermo', '90100', '70'),
(8, 'Via Genova', 'Genova', '16100', '80'),
(9, 'Via Bologna', 'Bologna', '40100', '90'),
(10, 'Via Bari', 'Bari', '70100', '100');

-- --------------------------------------------------------

--
-- Table structure for table `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `tipo` enum('noleggio','deposito') NOT NULL,
  `data_ora` datetime NOT NULL,
  `distanza_percorsa` int(11) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `idBici` int(11) NOT NULL,
  `idStazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operazione`
--

INSERT INTO `operazione` (`ID`, `tipo`, `data_ora`, `distanza_percorsa`, `idCliente`, `idBici`, `idStazione`) VALUES
(1, 'noleggio', '2024-05-01 08:00:00', NULL, 2, 1, 1),
(2, 'deposito', '2024-05-01 12:00:00', 15, 2, 1, 2),
(3, 'noleggio', '2024-05-02 09:30:00', NULL, 3, 2, 2),
(4, 'deposito', '2024-05-02 13:45:00', 10, 3, 2, 3),
(5, 'noleggio', '2024-05-03 10:00:00', NULL, 5, 3, 4),
(6, 'deposito', '2024-05-03 11:00:00', 5, 5, 3, 5),
(7, 'noleggio', '2024-05-04 14:00:00', NULL, 2, 4, 6),
(8, 'deposito', '2024-05-04 16:00:00', 20, 2, 4, 7),
(9, 'noleggio', '2024-05-05 08:15:00', NULL, 3, 5, 8),
(10, 'deposito', '2024-05-05 09:30:00', 8, 3, 5, 9),
(11, 'noleggio', '2024-05-06 12:00:00', NULL, 5, 6, 10),
(12, 'deposito', '2024-05-06 13:00:00', 6, 5, 6, 1),
(13, 'noleggio', '2024-05-07 07:30:00', NULL, 2, 7, 2),
(14, 'deposito', '2024-05-07 08:45:00', 9, 2, 7, 3),
(15, 'noleggio', '2024-05-08 15:30:00', NULL, 3, 8, 4),
(16, 'deposito', '2024-05-08 17:00:00', 12, 3, 8, 5),
(17, 'noleggio', '2024-05-09 09:00:00', NULL, 5, 9, 6),
(18, 'deposito', '2024-05-09 10:30:00', 7, 5, 9, 7),
(19, 'noleggio', '2024-05-10 11:15:00', NULL, 2, 10, 8),
(20, 'deposito', '2024-05-10 12:45:00', 14, 2, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `latitudine` varchar(10) NOT NULL,
  `longitudine` varchar(11) NOT NULL,
  `num_bici_disp` int(11) NOT NULL DEFAULT 50,
  `num_slot_tot` int(11) NOT NULL DEFAULT 50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stazione`
--

INSERT INTO `stazione` (`ID`, `nome`, `latitudine`, `longitudine`, `num_bici_disp`, `num_slot_tot`) VALUES
(1, 'Stazione Centrale', '45.4654', '9.1885', 10, 50),
(2, 'Stazione Nord', '45.4870', '9.2036', 15, 50),
(3, 'Stazione Sud', '45.4507', '9.1673', 20, 50),
(4, 'Stazione Est', '45.4734', '9.2240', 25, 50),
(5, 'Stazione Ovest', '45.4847', '9.1542', 5, 50),
(6, 'Piazza Duomo', '45.4642', '9.1916', 12, 50),
(7, 'Porta Garibaldi', '45.4848', '9.1812', 8, 50),
(8, 'Cadorna', '45.4668', '9.1817', 18, 50),
(9, 'Porta Romana', '45.4523', '9.1911', 7, 50),
(10, 'Lambrate', '45.4844', '9.2271', 22, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bici`
--
ALTER TABLE `bici`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RFID` (`RFID`),
  ADD UNIQUE KEY `gps` (`gps`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `num_tessera` (`num_tessera`),
  ADD KEY `id_indirizzo` (`idIndirizzo`);

--
-- Indexes for table `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCliente` (`idCliente`,`idBici`,`idStazione`),
  ADD KEY `idBici` (`idBici`),
  ADD KEY `idStazione` (`idStazione`);

--
-- Indexes for table `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bici`
--
ALTER TABLE `bici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idIndirizzo`) REFERENCES `indirizzo` (`ID`);

--
-- Constraints for table `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`idBici`) REFERENCES `bici` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`idStazione`) REFERENCES `stazione` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
