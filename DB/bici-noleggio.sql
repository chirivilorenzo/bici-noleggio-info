-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 17, 2024 alle 09:51
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

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
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID`, `nome`, `cognome`, `email`, `password`) VALUES
(2, 'Admin', 'Admin', 'admin@example.com', 'password123');

-- --------------------------------------------------------

--
-- Struttura della tabella `bici`
--

CREATE TABLE `bici` (
  `ID` int(11) NOT NULL,
  `disponibile` tinyint(1) NOT NULL DEFAULT 1,
  `RFID` char(4) NOT NULL,
  `gps` char(4) NOT NULL,
  `km_percorsi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bici`
--

INSERT INTO `bici` (`ID`, `disponibile`, `RFID`, `gps`, `km_percorsi`) VALUES
(5, 0, '1234', 'GPS1', 0),
(6, 1, '5678', 'GPS2', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
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
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `nome`, `cognome`, `email`, `password`, `num_carta_credito`, `num_tessera`, `idIndirizzo`) VALUES
(2, 'Mario', 'Rossi', 'mario@example.com', 'mario123', NULL, '12345678', 1),
(3, 'Luigi', 'Verdi', 'luigi@example.com', 'luigi123', NULL, '87654321', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `via` varchar(32) NOT NULL,
  `citta` varchar(64) NOT NULL,
  `cap` char(5) NOT NULL,
  `num_civico` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `via`, `citta`, `cap`, `num_civico`) VALUES
(1, 'Via Roma', 'Roma', '00100', '123'),
(2, 'Via Milano', 'Milano', '20100', '456');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
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
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`ID`, `tipo`, `data_ora`, `distanza_percorsa`, `idCliente`, `idBici`, `idStazione`) VALUES
(2, '', '2024-05-17 09:20:03', NULL, 2, 5, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
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
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `nome`, `latitudine`, `longitudine`, `num_bici_disp`, `num_slot_tot`) VALUES
(1, 'roma', '41.9028', '12.4964', 29, 50),
(2, 'milano', '45.4642', '9.1900', 25, 50);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `bici`
--
ALTER TABLE `bici`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RFID` (`RFID`),
  ADD UNIQUE KEY `gps` (`gps`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `num_tessera` (`num_tessera`),
  ADD KEY `id_indirizzo` (`idIndirizzo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCliente` (`idCliente`,`idBici`,`idStazione`),
  ADD KEY `idBici` (`idBici`),
  ADD KEY `idStazione` (`idStazione`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `bici`
--
ALTER TABLE `bici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idIndirizzo`) REFERENCES `indirizzo` (`ID`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`idBici`) REFERENCES `bici` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`idStazione`) REFERENCES `stazione` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
