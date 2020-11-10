-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Nov 01, 2020 alle 17:55
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flyweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Carrello`
--

CREATE TABLE `Carrello` (
  `ID_Carrello` int(11) NOT NULL,
  `ID_Utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `CarrelloIntegrazione`
--

CREATE TABLE `CarrelloIntegrazione` (
  `ID_Carrello` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `CarrelloViaggio`
--

CREATE TABLE `CarrelloViaggio` (
  `ID_Carrello` int(11) NOT NULL,
  `ID_Viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Integrazione`
--

CREATE TABLE `Integrazione` (
  `ID_Integrazione` int(11) NOT NULL,
  `Nome` varchar(128) DEFAULT NULL,
  `Descrizione` text DEFAULT NULL,
  `Durata` int(11) DEFAULT NULL,
  `Prezzo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `IscrittiNewsLetter`
--

CREATE TABLE `IscrittiNewsLetter` (
  `ID_IscrittiNewsLetter` int(11) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `DataIscrizione` date  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Ordine`
--

CREATE TABLE `Ordine` (
  `ID_Ordine` int(11) NOT NULL,
  `ID_Utente` int(11) NOT NULL,
  `Via` varchar(128) DEFAULT NULL,
  `Cap` varchar(5) DEFAULT NULL,
  `Provincia` varchar(2) DEFAULT NULL,
  `Note` varchar(128) DEFAULT NULL,
  `Comune` text DEFAULT NULL,
  `MetodoPagamento` varchar(128) NOT NULL,
  `Totale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `OrdineIntegrazione`
--

CREATE TABLE `OrdineIntegrazione` (
  `ID_Ordine` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `OrdineViaggio`
--

CREATE TABLE `OrdineViaggio` (
  `ID_Ordine` int(11) NOT NULL,
  `ID_Viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Preferiti`
--

CREATE TABLE `Preferiti` (
  `ID_Preferiti` int(11) NOT NULL,
  `ID_Utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `PreferitiIntegrazione`
--

CREATE TABLE `PreferitiIntegrazione` (
  `ID_Preferiti` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `PreferitiViaggio`
--

CREATE TABLE `PreferitiViaggio` (
  `ID_Preferiti` int(11) NOT NULL,
  `ID_Viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensione`
--

CREATE TABLE `Recensione` (
  `ID_Recensione` int(11) NOT NULL,
  `Titolo` varchar(128) NOT NULL,
  `Valutazione` int(11) DEFAULT 0,
  `Descrizione` text DEFAULT NULL,
  `ID_Utente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `RecensioneIntegrazione`
--

CREATE TABLE `RecensioneIntegrazione` (
  `ID_Recensione` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `RecensioneViaggio`
--

CREATE TABLE `RecensioneViaggio` (
  `ID_Recensione` int(11) NOT NULL,
  `ID_Viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Tag`
--

CREATE TABLE `Tag` (
  `ID_Tag` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `TagIntegrazioni`
--

CREATE TABLE `TagIntegrazioni` (
  `ID_Tag` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `TagViaggio`
--

CREATE TABLE `TagViaggio` (
  `ID_Tag` int(11) NOT NULL,
  `ID_Viaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE `Utente` (
  `ID_Utente` int(11) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Nome` varchar(64) NOT NULL,
  `Cognome` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `DataNascita` date NOT NULL,
  `DataRegistrazione` date NOT NULL,
  `Admin` bit(1) DEFAULT b'0',
  `EvilBit` int(11) DEFAULT 0,
  `ID_Carrello` int(11) DEFAULT NULL,
  `ID_Preferiti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Viaggio`
--

CREATE TABLE `Viaggio` (
  `ID_Viaggio` int(11) NOT NULL,
  `Nome` varchar(64) NOT NULL,
  `DataInizio` date DEFAULT NULL,
  `DataFine` date DEFAULT NULL,
  `Prezzo` int(11) DEFAULT 0,
  `Descrizione` text DEFAULT NULL,
  `Stato` varchar(128) NOT NULL,
  `Citta` varchar(264),
  `Localita` varchar(264),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ViaggioIntegrazione`
--

CREATE TABLE `ViaggioIntegrazione` (
  `ID_Viaggio` int(11) NOT NULL,
  `ID_Integrazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Carrello`
--
ALTER TABLE `Carrello`
  ADD PRIMARY KEY (`ID_Carrello`,`ID_Utente`),
  ADD UNIQUE KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `CarrelloIntegrazione`
--
ALTER TABLE `CarrelloIntegrazione`
  ADD PRIMARY KEY (`ID_Carrello`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- Indici per le tabelle `CarrelloViaggio`
--
ALTER TABLE `CarrelloViaggio`
  ADD PRIMARY KEY (`ID_Carrello`,`ID_Viaggio`),
  ADD KEY `ID_Viaggio` (`ID_Viaggio`);

--
-- Indici per le tabelle `Integrazione`
--
ALTER TABLE `Integrazione`
  ADD PRIMARY KEY (`ID_Integrazione`);

--
-- Indici per le tabelle `Ordine`
--
ALTER TABLE `Ordine`
  ADD PRIMARY KEY (`ID_Ordine`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `OrdineIntegrazione`
--
ALTER TABLE `OrdineIntegrazione`
  ADD PRIMARY KEY (`ID_Ordine`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- Indici per le tabelle `OrdineViaggio`
--
ALTER TABLE `OrdineViaggio`
  ADD PRIMARY KEY (`ID_Ordine`,`ID_Viaggio`),
  ADD KEY `ID_Viaggio` (`ID_Viaggio`);

--
-- Indici per le tabelle `Preferiti`
--
ALTER TABLE `Preferiti`
  ADD PRIMARY KEY (`ID_Preferiti`,`ID_Utente`),
  ADD UNIQUE KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `PreferitiIntegrazione`
--
ALTER TABLE `PreferitiIntegrazione`
  ADD PRIMARY KEY (`ID_Preferiti`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- Indici per le tabelle `PreferitiViaggio`
--
ALTER TABLE `PreferitiViaggio`
  ADD PRIMARY KEY (`ID_Preferiti`,`ID_Viaggio`),
  ADD KEY `ID_Viaggio` (`ID_Viaggio`);

--
-- Indici per le tabelle `Recensione`
--
ALTER TABLE `Recensione`
  ADD PRIMARY KEY (`ID_Recensione`),
  ADD KEY `ID_Utente` (`ID_Utente`);

--
-- Indici per le tabelle `RecensioneIntegrazione`
--
ALTER TABLE `RecensioneIntegrazione`
  ADD PRIMARY KEY (`ID_Recensione`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- Indici per le tabelle `RecensioneViaggio`
--
ALTER TABLE `RecensioneViaggio`
  ADD PRIMARY KEY (`ID_Recensione`,`ID_Viaggio`),
  ADD KEY `ID_Viaggio` (`ID_Viaggio`);

--
-- Indici per le tabelle `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`ID_Tag`);

--
-- Indici per le tabelle `TagIntegrazioni`
--
ALTER TABLE `TagIntegrazioni`
  ADD PRIMARY KEY (`ID_Tag`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- Indici per le tabelle `TagViaggio`
--
ALTER TABLE `TagViaggio`
  ADD PRIMARY KEY (`ID_Tag`,`ID_Viaggio`),
  ADD KEY `ID_Viaggio` (`ID_Viaggio`);

--
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`ID_Utente`),
  ADD UNIQUE KEY `Utente_Username_uindex` (`Username`),
  ADD UNIQUE KEY `Utente_ID_Carrello_uindex` (`ID_Carrello`),
  ADD UNIQUE KEY `Utente_ID_Preferiti_uindex` (`ID_Preferiti`);

--
-- Indici per le tabelle `Viaggio`
--
ALTER TABLE `Viaggio`
  ADD PRIMARY KEY (`ID_Viaggio`);

--
-- Indici per le tabelle `ViaggioIntegrazione`
--
ALTER TABLE `ViaggioIntegrazione`
  ADD PRIMARY KEY (`ID_Viaggio`,`ID_Integrazione`),
  ADD KEY `ID_Integrazione` (`ID_Integrazione`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Integrazione`
--
ALTER TABLE `Integrazione`
  MODIFY `ID_Integrazione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `IscrittiNewsLetter`
--
ALTER TABLE `IscrittiNewsLetter`
  MODIFY `ID_IscrittiNewsLetter` int(11) NOT NULL AUTO_INCREMENT;


-- AUTO_INCREMENT per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  MODIFY `ID_Ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Recensione`
--
ALTER TABLE `Recensione`
  MODIFY `ID_Recensione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Tag`
--
ALTER TABLE `Tag`
  MODIFY `ID_Tag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Utente`
--
ALTER TABLE `Utente`
  MODIFY `ID_Utente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Viaggio`
--
ALTER TABLE `Viaggio`
  MODIFY `ID_Viaggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Carrello`
--
ALTER TABLE `Carrello`
  ADD CONSTRAINT `Carrello_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `Utente` (`ID_Utente`);

--
-- Limiti per la tabella `CarrelloIntegrazione`
--
ALTER TABLE `CarrelloIntegrazione`
  ADD CONSTRAINT `CarrelloIntegrazione_ibfk_1` FOREIGN KEY (`ID_Carrello`) REFERENCES `Carrello` (`ID_Carrello`),
  ADD CONSTRAINT `CarrelloIntegrazione_ibfk_2` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`);

--
-- Limiti per la tabella `CarrelloViaggio`
--
ALTER TABLE `CarrelloViaggio`
  ADD CONSTRAINT `CarrelloViaggio_ibfk_1` FOREIGN KEY (`ID_Carrello`) REFERENCES `Carrello` (`ID_Carrello`),
  ADD CONSTRAINT `CarrelloViaggio_ibfk_2` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`);

--
-- Limiti per la tabella `Ordine`
--
ALTER TABLE `Ordine`
  ADD CONSTRAINT `Ordine_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `Ordine` (`ID_Ordine`);

--
-- Limiti per la tabella `OrdineIntegrazione`
--
ALTER TABLE `OrdineIntegrazione`
  ADD CONSTRAINT `OrdineIntegrazione_ibfk_1` FOREIGN KEY (`ID_Ordine`) REFERENCES `Ordine` (`ID_Ordine`),
  ADD CONSTRAINT `OrdineIntegrazione_ibfk_2` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`);

--
-- Limiti per la tabella `OrdineViaggio`
--
ALTER TABLE `OrdineViaggio`
  ADD CONSTRAINT `OrdineViaggio_ibfk_1` FOREIGN KEY (`ID_Ordine`) REFERENCES `Ordine` (`ID_Ordine`),
  ADD CONSTRAINT `OrdineViaggio_ibfk_2` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`);

--
-- Limiti per la tabella `Preferiti`
--
ALTER TABLE `Preferiti`
  ADD CONSTRAINT `Preferiti_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `Utente` (`ID_Utente`);

--
-- Limiti per la tabella `PreferitiIntegrazione`
--
ALTER TABLE `PreferitiIntegrazione`
  ADD CONSTRAINT `PreferitiIntegrazione_ibfk_1` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`),
  ADD CONSTRAINT `PreferitiIntegrazione_ibfk_2` FOREIGN KEY (`ID_Preferiti`) REFERENCES `Preferiti` (`ID_Preferiti`);

--
-- Limiti per la tabella `PreferitiViaggio`
--
ALTER TABLE `PreferitiViaggio`
  ADD CONSTRAINT `PreferitiViaggio_ibfk_1` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`),
  ADD CONSTRAINT `PreferitiViaggio_ibfk_2` FOREIGN KEY (`ID_Preferiti`) REFERENCES `Preferiti` (`ID_Preferiti`);

--
-- Limiti per la tabella `Recensione`
--
ALTER TABLE `Recensione`
  ADD CONSTRAINT `Recensione_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `Utente` (`ID_Utente`);

--
-- Limiti per la tabella `RecensioneIntegrazione`
--
ALTER TABLE `RecensioneIntegrazione`
  ADD CONSTRAINT `RecensioneIntegrazione_ibfk_1` FOREIGN KEY (`ID_Recensione`) REFERENCES `Recensione` (`ID_Recensione`),
  ADD CONSTRAINT `RecensioneIntegrazione_ibfk_2` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`);

--
-- Limiti per la tabella `RecensioneViaggio`
--
ALTER TABLE `RecensioneViaggio`
  ADD CONSTRAINT `RecensioneViaggio_ibfk_1` FOREIGN KEY (`ID_Recensione`) REFERENCES `Recensione` (`ID_Recensione`),
  ADD CONSTRAINT `RecensioneViaggio_ibfk_2` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`);

--
-- Limiti per la tabella `TagIntegrazioni`
--
ALTER TABLE `TagIntegrazioni`
  ADD CONSTRAINT `TagIntegrazioni_ibfk_1` FOREIGN KEY (`ID_Tag`) REFERENCES `Tag` (`ID_Tag`),
  ADD CONSTRAINT `TagIntegrazioni_ibfk_2` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`);

--
-- Limiti per la tabella `TagViaggio`
--
ALTER TABLE `TagViaggio`
  ADD CONSTRAINT `TagViaggio_ibfk_1` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`),
  ADD CONSTRAINT `TagViaggio_ibfk_2` FOREIGN KEY (`ID_Tag`) REFERENCES `Tag` (`ID_Tag`);

--
-- Limiti per la tabella `Utente`
--
ALTER TABLE `Utente`
  ADD CONSTRAINT `Utente_ibfk_1` FOREIGN KEY (`ID_Carrello`) REFERENCES `Carrello` (`ID_Carrello`),
  ADD CONSTRAINT `Utente_ibfk_2` FOREIGN KEY (`ID_Preferiti`) REFERENCES `Preferiti` (`ID_Preferiti`);

--
-- Limiti per la tabella `ViaggioIntegrazione`
--
ALTER TABLE `ViaggioIntegrazione`
  ADD CONSTRAINT `ViaggioIntegrazione_ibfk_1` FOREIGN KEY (`ID_Viaggio`) REFERENCES `Viaggio` (`ID_Viaggio`),
  ADD CONSTRAINT `ViaggioIntegrazione_ibfk_2` FOREIGN KEY (`ID_Integrazione`) REFERENCES `Integrazione` (`ID_Integrazione`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

