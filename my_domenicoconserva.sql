-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Set 03, 2015 alle 08:05
-- Versione del server: 5.1.71-community-log
-- PHP Version: 5.3.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_domenicoconserva`
--
CREATE DATABASE IF NOT EXISTS `my_domenicoconserva` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_domenicoconserva`;

-- --------------------------------------------------------

--
-- Struttura della tabella `aziende`
--

DROP TABLE IF EXISTS `aziende`;
CREATE TABLE IF NOT EXISTS `aziende` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `piva` varchar(50) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `codice_fiscale` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `cellulare` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `pec` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `aziende`
--

INSERT INTO `aziende` (`id`, `nome`, `piva`, `cap`, `citta`, `codice_fiscale`, `telefono`, `cellulare`, `fax`, `email`, `descrizione`, `pec`, `website`, `provincia`, `indirizzo`) VALUES
(1, 'Domenico Conserva', '123', '74015', 'Martina Franca', '123', '123', '123', '123', '123', 'Studio di amministrazione condominiale Domenico Conserva', 'pec', 'www', 'pro', 'indirizzo');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `id_esercizio` int(32) unsigned NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_esercizio` (`id_esercizio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id`, `nome`, `id_esercizio`, `note`) VALUES
(7, '1 - Spese generali', 12, ''),
(8, '2 - Spese amministrazione', 12, ''),
(9, '3 - Scala', 12, ''),
(10, '4 - Garage', 12, ''),
(12, 'Scale-Ascensore', 13, ''),
(13, 'Spese Varie', 13, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `condomini`
--

DROP TABLE IF EXISTS `condomini`;
CREATE TABLE IF NOT EXISTS `condomini` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `indirizzo` varchar(250) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `codice_fiscale` varchar(50) NOT NULL,
  `iban` varchar(50) DEFAULT NULL,
  `banca` varchar(50) DEFAULT NULL,
  `codice_cc` varchar(50) DEFAULT NULL,
  `id_azienda` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_azienda` (`id_azienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `condomini`
--

INSERT INTO `condomini` (`id`, `nome`, `indirizzo`, `cap`, `citta`, `provincia`, `codice_fiscale`, `iban`, `banca`, `codice_cc`, `id_azienda`) VALUES
(12, 'Test', '', '', '', '', '', '', '', '', 1),
(13, 'Condominio Via Elio Vittorini n° 15', 'Via Elio Vittorini n° 15', '74015', 'Martina Franca', 'Taranto', '1234567890', '123456789', 'Banco di Napoli', '1234567', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_tabella`
--

DROP TABLE IF EXISTS `dati_tabella`;
CREATE TABLE IF NOT EXISTS `dati_tabella` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `quota` double unsigned NOT NULL,
  `id_tabella` int(32) unsigned NOT NULL,
  `id_relazione_unita` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tabella` (`id_tabella`),
  KEY `id_relazione_unita` (`id_relazione_unita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dump dei dati per la tabella `dati_tabella`
--

INSERT INTO `dati_tabella` (`id`, `quota`, `id_tabella`, `id_relazione_unita`) VALUES
(53, 100, 10, 25),
(54, 100, 10, 27),
(55, 0, 10, 28),
(56, 100, 10, 29),
(57, 50, 10, 31),
(58, 50, 10, 32),
(59, 0, 10, 33),
(60, 1, 11, 29),
(61, 1, 11, 25),
(62, 0, 11, 28),
(63, 1, 11, 27),
(64, 1, 11, 31),
(65, 0, 11, 33),
(66, 1, 11, 32),
(67, 0, 12, 29),
(68, 0, 12, 25),
(69, 100, 12, 28),
(70, 0, 12, 27),
(71, 100, 12, 31),
(72, 100, 12, 33),
(73, 0, 12, 32),
(74, 0, 13, 29),
(75, 0, 13, 25),
(76, 0, 13, 28),
(77, 0, 13, 27),
(78, 100, 13, 31),
(79, 100, 13, 33),
(80, 0, 13, 32),
(81, 77.7799987792969, 14, 34),
(82, 57.939998626709, 14, 35),
(83, 65, 14, 36),
(84, 54.3600006103516, 14, 37),
(85, 43.6399993896484, 14, 38),
(86, 72.9800033569336, 14, 39),
(87, 53.3800010681152, 14, 40),
(88, 54.439998626709, 14, 41),
(89, 43.7000007629395, 14, 42),
(90, 68.0999984741211, 14, 43),
(91, 61.5999984741211, 14, 44),
(92, 57.9599990844727, 14, 45),
(93, 46.1199989318848, 14, 46),
(94, 3, 14, 47),
(95, 68.0699996948242, 14, 48),
(96, 61.5800018310547, 14, 49),
(97, 5.32999992370605, 14, 50),
(98, 57.9199981689453, 14, 51),
(99, 43.7000007629395, 14, 52),
(100, 3.40000009536743, 14, 53),
(101, 50.6100006103516, 15, 34),
(102, 47.2599983215332, 15, 35),
(103, 53.0200004577637, 15, 36),
(104, 44.3400001525879, 15, 37),
(105, 35.5800018310547, 15, 38),
(106, 70.5, 15, 39),
(107, 51.5699996948242, 15, 40),
(108, 52.5999984741211, 15, 41),
(109, 42.2099990844727, 15, 42),
(110, 74.6900024414062, 15, 43),
(111, 67.5699996948242, 15, 44),
(112, 63.5699996948242, 15, 45),
(113, 50.5800018310547, 15, 46),
(114, 3.66000008583069, 15, 47),
(115, 82.9000015258789, 15, 48),
(116, 74.9899978637695, 15, 49),
(117, 6.48999977111816, 15, 50),
(118, 70.5199966430664, 15, 51),
(119, 53.2000007629395, 15, 52),
(120, 4.1399998664856, 15, 53),
(141, 1, 17, 34),
(142, 1, 17, 35),
(143, 1, 17, 36),
(144, 1, 17, 37),
(145, 1, 17, 38),
(146, 1, 17, 39),
(147, 1, 17, 40),
(148, 1, 17, 41),
(149, 1, 17, 42),
(150, 1, 17, 43),
(151, 1, 17, 44),
(152, 1, 17, 45),
(153, 1, 17, 46),
(154, 0, 17, 47),
(155, 1, 17, 48),
(156, 1, 17, 49),
(157, 0, 17, 50),
(158, 1, 17, 51),
(159, 1, 17, 52),
(160, 0, 17, 53);

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

DROP TABLE IF EXISTS `esercizi`;
CREATE TABLE IF NOT EXISTS `esercizi` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `descrizione` text NOT NULL,
  `id_condominio` int(32) unsigned NOT NULL,
  `saldo_iniziale` double NOT NULL,
  `scadenza_rata1` date DEFAULT NULL,
  `scadenza_rata2` date DEFAULT NULL,
  `scadenza_rata3` date DEFAULT NULL,
  `scadenza_rata4` date DEFAULT NULL,
  `scadenza_rata5` date DEFAULT NULL,
  `scadenza_rata6` date DEFAULT NULL,
  `scadenza_rata7` date DEFAULT NULL,
  `scadenza_rata8` date DEFAULT NULL,
  `scadenza_rata9` date DEFAULT NULL,
  `scadenza_rata10` date DEFAULT NULL,
  `scadenza_rata11` date DEFAULT NULL,
  `scadenza_rata12` date DEFAULT NULL,
  `id_tabella_straordinari` int(32) unsigned DEFAULT NULL,
  `id_tabella_acquedotto` int(32) unsigned DEFAULT NULL,
  `scadenza_straordinaria` date DEFAULT NULL,
  `scadenza_acquedotto1` date DEFAULT NULL,
  `scadenza_acquedotto2` date DEFAULT NULL,
  `scadenza_acquedotto3` date DEFAULT NULL,
  `scadenza_acquedotto4` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_condominio` (`id_condominio`),
  KEY `esercizi_ibfk_3` (`id_tabella_straordinari`),
  KEY `esercizi_ibfk_2` (`id_tabella_acquedotto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `data_inizio`, `data_fine`, `descrizione`, `id_condominio`, `saldo_iniziale`, `scadenza_rata1`, `scadenza_rata2`, `scadenza_rata3`, `scadenza_rata4`, `scadenza_rata5`, `scadenza_rata6`, `scadenza_rata7`, `scadenza_rata8`, `scadenza_rata9`, `scadenza_rata10`, `scadenza_rata11`, `scadenza_rata12`, `id_tabella_straordinari`, `id_tabella_acquedotto`, `scadenza_straordinaria`, `scadenza_acquedotto1`, `scadenza_acquedotto2`, `scadenza_acquedotto3`, `scadenza_acquedotto4`) VALUES
(12, '2015-01-01', '2015-12-31', '', 12, 0, '2015-01-01', '2015-02-01', '2015-03-01', '2015-04-01', '2015-05-01', '2015-06-01', '2015-07-01', '2015-08-01', '2015-09-01', '2015-10-01', '2015-11-01', '2015-12-01', 10, 10, '2015-08-02', '2015-08-17', '2015-08-18', '2015-09-20', NULL),
(13, '2015-01-01', '2015-12-31', '', 13, 800, NULL, '2015-02-05', NULL, '2015-04-05', NULL, '2015-06-05', NULL, '2015-08-05', NULL, '2015-10-05', NULL, '2015-12-05', 14, 14, '0000-00-00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

DROP TABLE IF EXISTS `fornitori`;
CREATE TABLE IF NOT EXISTS `fornitori` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `ragione_sociale` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `codice_fiscale` varchar(30) NOT NULL,
  `piva` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `cellulare` varchar(30) NOT NULL,
  `metodo_pagamento` varchar(30) NOT NULL,
  `banca` varchar(50) NOT NULL,
  `ritenuta_acconto` enum('NESSUNA','1040','1019','1020') NOT NULL,
  `nome_titolare` varchar(30) NOT NULL,
  `cognome_titolare` varchar(30) NOT NULL,
  `data_nascita_titolare` date DEFAULT NULL,
  `note_titolare` text NOT NULL,
  `note` text NOT NULL,
  `nazione` varchar(30) NOT NULL,
  `id_azienda` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_azienda` (`id_azienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`id`, `ragione_sociale`, `tipo`, `indirizzo`, `cap`, `citta`, `provincia`, `codice_fiscale`, `piva`, `email`, `telefono`, `cellulare`, `metodo_pagamento`, `banca`, `ritenuta_acconto`, `nome_titolare`, `cognome_titolare`, `data_nascita_titolare`, `note_titolare`, `note`, `nazione`, `id_azienda`) VALUES
(2, 'Ferramenta da Luigi', 'Ferramenta', 'a', '1', 'a', 'a', 'a', 'a', 'a', 'a', '1234567890', 'a', 'a', '1040', 'Luigi', 'Bertini', '2003-02-01', 'aa', 'aa', 'a', 1),
(3, 'Pulizie fast', 'Pulizie', '', '', '', '', '', '', '', '', '', '', '', 'NESSUNA', 'Antonietta', 'Caramia', '0000-00-00', '', '', '', 1),
(4, 'Tutto ufficio', 'Cancelleria', '', '', '', '', '', '', '', '', '', '', '', 'NESSUNA', '', '', '0000-00-00', '', '', '', 1),
(5, 'Unicredit', 'Banca', '', '', '', '', '', '', '', '', '', '', '', 'NESSUNA', '', '', '0000-00-00', '', '', '', 1),
(6, 'ENEL', '', '', '', '', '', '', '', '', '', '', '', '', 'NESSUNA', '', '', '0000-00-00', '', '', '', 1),
(7, 'Studio Condominiale Domenico Conserva', 'amministrazione', 'Via Italo Svevo 11', '74015', 'Martina Franca', 'Taranto', 'CNSDNC92C13E98J', '', '', '', '3343642659', 'Bonifico', 'Banco di Napoli', '1040', 'Domenico', 'Conserva', '1992-03-13', '', '', 'Italia', 1),
(8, 'Gt ascensori', 'manutenzione', '', '', '', '', '1234567890', '123456765435', '', '', '4123456', 'assegno', 'Unicredit', '1019', 'Ciccio', 'Cappuccio', '1965-12-12', '', '', '', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

DROP TABLE IF EXISTS `gruppi`;
CREATE TABLE IF NOT EXISTS `gruppi` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `descrizione` text NOT NULL,
  `id_palazzina` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_palazzina` (`id_palazzina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `gruppi`
--

INSERT INTO `gruppi` (`id`, `descrizione`, `id_palazzina`) VALUES
(11, 'Depandance', 17),
(12, 'Scala1', 17),
(13, '', 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `palazzine`
--

DROP TABLE IF EXISTS `palazzine`;
CREATE TABLE IF NOT EXISTS `palazzine` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `descrizione` text NOT NULL,
  `id_condominio` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_condominio` (`id_condominio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `palazzine`
--

INSERT INTO `palazzine` (`id`, `descrizione`, `id_condominio`) VALUES
(17, 'Palazzina1', 12),
(18, '1', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `persone`
--

DROP TABLE IF EXISTS `persone`;
CREATE TABLE IF NOT EXISTS `persone` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `id_condominio` int(32) unsigned NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `codice_fiscale` varchar(50) NOT NULL,
  `indirizzo_residenza` varchar(100) NOT NULL,
  `cap_residenza` varchar(10) NOT NULL,
  `citta_residenza` varchar(30) NOT NULL,
  `provincia_residenza` varchar(30) NOT NULL,
  `nazione_residenza` varchar(30) NOT NULL,
  `indirizzo_domicilio` varchar(100) NOT NULL,
  `cap_domicilio` varchar(10) NOT NULL,
  `citta_domicilio` varchar(30) NOT NULL,
  `provincia_domicilio` varchar(30) NOT NULL,
  `nazione_domicilio` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellulare` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `data_nascita` date DEFAULT NULL,
  `metodo_invio` enum('NESSUNO','PEC','RACCOMANDATA','FAX') NOT NULL DEFAULT 'NESSUNO',
  `metodo_pagamento` enum('NESSUNO','BONIFICO','BOLLETTINO') NOT NULL DEFAULT 'NESSUNO',
  PRIMARY KEY (`id`),
  KEY `id_condominio` (`id_condominio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dump dei dati per la tabella `persone`
--

INSERT INTO `persone` (`id`, `id_condominio`, `nome`, `cognome`, `codice_fiscale`, `indirizzo_residenza`, `cap_residenza`, `citta_residenza`, `provincia_residenza`, `nazione_residenza`, `indirizzo_domicilio`, `cap_domicilio`, `citta_domicilio`, `provincia_domicilio`, `nazione_domicilio`, `email`, `cellulare`, `telefono`, `data_nascita`, `metodo_invio`, `metodo_pagamento`) VALUES
(11, 12, 'Giovanna', 'Rossi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(12, 12, 'Luigino', 'Di pietro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(13, 12, 'Davide', 'Alfieri', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(14, 12, 'Tania', 'Bianchi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(15, 12, 'Francesco', 'Giardina', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(16, 12, 'Sebastiano', 'Laferra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1970-01-01', 'NESSUNO', 'NESSUNO'),
(17, 13, 'Giuseppe', 'Pulito', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(18, 13, 'Giovanni', 'Nardelli', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(19, 13, 'Vito', 'Filomena', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(20, 13, 'Donato', 'Fumarola', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(21, 13, 'Cosimo', 'Semeraro', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(22, 13, 'Domenico', 'Fumarola', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(23, 13, 'Pietro', 'Fumarola', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(24, 13, 'Martino', 'Gnisci', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(25, 13, 'Giuseppe', 'D''Arcangelo', '', 'Via Elio Vittorini n°15', '74015', 'm', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(26, 13, 'Mario', 'Conserva', 'CNSMRA55C14E986B', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'I', '', '', '', '', '', '', '', '', '1955-03-14', 'RACCOMANDATA', 'BONIFICO'),
(27, 13, 'Gilda', 'Ancona', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(28, 13, 'Donata', 'Ruggieri', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(29, 13, 'Michela', 'D''Aversa', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(30, 13, 'Gino', 'Martorelli', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(31, 13, 'Arturo', 'Ancona', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(32, 13, 'Angelo', 'Carriero', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO'),
(33, 13, 'Massimo', 'Nardelli', '', 'Via Elio Vittorini n°15', '74015', 'Martina Franca', 'Taranto', 'Italia', '', '', '', '', '', '', '', '', NULL, 'RACCOMANDATA', 'BONIFICO');

-- --------------------------------------------------------

--
-- Struttura della tabella `rate`
--

DROP TABLE IF EXISTS `rate`;
CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `id_esercizio` int(32) unsigned NOT NULL,
  `id_relazione_unita` int(32) unsigned NOT NULL,
  `rata1` double NOT NULL,
  `rata2` double NOT NULL,
  `rata3` double NOT NULL,
  `rata4` double NOT NULL,
  `rata5` double NOT NULL,
  `rata6` double NOT NULL,
  `rata7` double NOT NULL,
  `rata8` double NOT NULL,
  `rata9` double NOT NULL,
  `rata10` double NOT NULL,
  `rata11` double NOT NULL,
  `rata12` double NOT NULL,
  `totale_versato` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_esercizio` (`id_esercizio`),
  KEY `id_relazione_unita` (`id_relazione_unita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=484 ;

--
-- Dump dei dati per la tabella `rate`
--

INSERT INTO `rate` (`id`, `id_esercizio`, `id_relazione_unita`, `rata1`, `rata2`, `rata3`, `rata4`, `rata5`, `rata6`, `rata7`, `rata8`, `rata9`, `rata10`, `rata11`, `rata12`, `totale_versato`) VALUES
(415, 12, 29, 0, 0, 364, 0, 0, 362, 0, 0, 362, 0, 0, 362, 0),
(416, 12, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(417, 12, 26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(418, 12, 25, 0, 245, 0, 241, 0, 241, 0, 241, 0, 241, 0, 241, 800),
(419, 12, 28, 0, 281.67, 0, 277, 0, 277, 0, 277, 0, 277, 0, 277, 0),
(420, 12, 27, 0, 245, 0, 241, 0, 241, 0, 241, 0, 241, 0, 241, 0),
(421, 12, 31, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3141.67, 0),
(422, 12, 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2316.67, 0),
(423, 12, 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 825, 0),
(464, 13, 34, 0, 44.84, 0, 44, 0, 44, 0, 44, 0, 44, 0, 44, 45),
(465, 13, 35, 0, 44.54, 0, 42, 0, 42, 0, 42, 0, 42, 0, 42, 0),
(466, 13, 36, 0, 47.25, 0, 45, 0, 45, 0, 45, 0, 45, 0, 45, 0),
(467, 13, 37, 0, 45.57, 0, 40, 0, 40, 0, 40, 0, 40, 0, 40, 0),
(468, 13, 38, 0, 38.64, 0, 36, 0, 36, 0, 36, 0, 36, 0, 36, 0),
(469, 13, 39, 0, 55.97, 0, 54, 0, 54, 0, 54, 0, 54, 0, 54, 0),
(470, 13, 40, 0, 47.79, 0, 44, 0, 44, 0, 44, 0, 44, 0, 44, 0),
(471, 13, 41, 0, 45.96, 0, 45, 0, 45, 0, 45, 0, 45, 0, 45, 0),
(472, 13, 42, 0, 44.02, 0, 39, 0, 39, 0, 39, 0, 39, 0, 39, 0),
(473, 13, 43, 0, 58.85, 0, 56, 0, 56, 0, 56, 0, 56, 0, 56, 60),
(474, 13, 44, 0, 56.97, 0, 52, 0, 52, 0, 52, 0, 52, 0, 52, 0),
(475, 13, 45, 0, 54.67, 0, 50, 0, 50, 0, 50, 0, 50, 0, 50, 0),
(476, 13, 46, 0, 44.75, 0, 44, 0, 44, 0, 44, 0, 44, 0, 44, 0),
(477, 13, 47, 0, 6.25, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0),
(478, 13, 48, 0, 64.09, 0, 60, 0, 60, 0, 60, 0, 60, 0, 60, 0),
(479, 13, 49, 0, 59.77, 0, 56, 0, 56, 0, 56, 0, 56, 0, 56, 0),
(480, 13, 50, 0, 4.95, 0, 3, 0, 3, 0, 3, 0, 3, 0, 3, 0),
(481, 13, 51, 0, 56.03, 0, 54, 0, 54, 0, 54, 0, 54, 0, 54, 0),
(482, 13, 52, 0, 47.8, 0, 45, 0, 45, 0, 45, 0, 45, 0, 45, 0),
(483, 13, 53, 0, 2.73, 0, 2, 0, 2, 0, 2, 0, 2, 0, 2, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `rate_acquedotto`
--

DROP TABLE IF EXISTS `rate_acquedotto`;
CREATE TABLE IF NOT EXISTS `rate_acquedotto` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `id_relazione_unita` int(32) unsigned NOT NULL,
  `id_esercizio` int(32) unsigned NOT NULL,
  `rata1` double NOT NULL,
  `rata2` double NOT NULL,
  `rata3` double NOT NULL,
  `rata4` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_esercizio` (`id_esercizio`),
  KEY `id_relazione_unita` (`id_relazione_unita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dump dei dati per la tabella `rate_acquedotto`
--

INSERT INTO `rate_acquedotto` (`id`, `id_relazione_unita`, `id_esercizio`, `rata1`, `rata2`, `rata3`, `rata4`) VALUES
(1, 29, 12, 0, 44, 6, 5),
(2, 25, 12, 20, 100, 300, 0),
(3, 28, 12, 0, 67, 99, 99),
(4, 27, 12, 0, 44, 0, 0),
(5, 31, 12, 0, 0, 0, 0),
(6, 33, 12, 0, 0, 0, 0),
(7, 32, 12, 0, 0, 0, 0),
(8, 34, 13, 200, 0, 0, 0),
(9, 35, 13, 0, 0, 0, 0),
(10, 36, 13, 0, 0, 0, 0),
(11, 37, 13, 0, 0, 0, 0),
(12, 38, 13, 0, 0, 0, 0),
(13, 39, 13, 0, 0, 0, 0),
(14, 40, 13, 0, 0, 0, 0),
(15, 41, 13, 0, 0, 0, 0),
(16, 42, 13, 0, 0, 0, 0),
(17, 43, 13, 0, 0, 0, 0),
(18, 44, 13, 0, 0, 0, 0),
(19, 45, 13, 0, 0, 0, 0),
(20, 46, 13, 0, 0, 0, 0),
(21, 47, 13, 0, 0, 0, 0),
(22, 48, 13, 0, 0, 0, 0),
(23, 49, 13, 0, 0, 0, 0),
(24, 50, 13, 0, 0, 0, 0),
(25, 51, 13, 0, 0, 0, 0),
(26, 52, 13, 0, 0, 0, 0),
(27, 53, 13, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `relazioni_unita`
--

DROP TABLE IF EXISTS `relazioni_unita`;
CREATE TABLE IF NOT EXISTS `relazioni_unita` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `id_unita` int(32) unsigned NOT NULL,
  `id_persona` int(32) unsigned NOT NULL,
  `rapporto` enum('PROPRIETARIO','CONDUTTORE','USUFRUTTUARIO') NOT NULL,
  `data_inizio` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relazione_unica` (`id_unita`,`id_persona`,`rapporto`,`data_inizio`),
  KEY `id_persona` (`id_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dump dei dati per la tabella `relazioni_unita`
--

INSERT INTO `relazioni_unita` (`id`, `id_unita`, `id_persona`, `rapporto`, `data_inizio`) VALUES
(26, 12, 11, 'USUFRUTTUARIO', '1970-01-01'),
(25, 12, 14, 'PROPRIETARIO', '1970-01-01'),
(28, 13, 12, 'CONDUTTORE', '2015-01-01'),
(27, 13, 14, 'PROPRIETARIO', '1970-01-01'),
(29, 14, 15, 'PROPRIETARIO', '1970-01-01'),
(30, 14, 16, 'USUFRUTTUARIO', '1970-01-01'),
(31, 15, 14, 'PROPRIETARIO', '1970-01-01'),
(33, 16, 11, 'CONDUTTORE', '2015-01-01'),
(32, 16, 15, 'PROPRIETARIO', '1970-01-01'),
(34, 17, 17, 'PROPRIETARIO', NULL),
(35, 18, 18, 'PROPRIETARIO', NULL),
(36, 19, 19, 'PROPRIETARIO', NULL),
(37, 20, 20, 'PROPRIETARIO', NULL),
(38, 21, 21, 'PROPRIETARIO', NULL),
(39, 22, 22, 'PROPRIETARIO', NULL),
(40, 23, 23, 'PROPRIETARIO', NULL),
(41, 24, 24, 'PROPRIETARIO', NULL),
(42, 25, 25, 'PROPRIETARIO', NULL),
(43, 26, 26, 'PROPRIETARIO', NULL),
(44, 27, 27, 'PROPRIETARIO', NULL),
(45, 28, 28, 'PROPRIETARIO', NULL),
(46, 29, 29, 'PROPRIETARIO', NULL),
(47, 30, 29, 'PROPRIETARIO', NULL),
(48, 31, 30, 'PROPRIETARIO', NULL),
(49, 32, 31, 'PROPRIETARIO', NULL),
(50, 33, 31, 'PROPRIETARIO', NULL),
(51, 34, 32, 'PROPRIETARIO', NULL),
(52, 35, 33, 'PROPRIETARIO', NULL),
(53, 36, 33, 'PROPRIETARIO', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `sottocategorie`
--

DROP TABLE IF EXISTS `sottocategorie`;
CREATE TABLE IF NOT EXISTS `sottocategorie` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `id_categoria` int(32) unsigned NOT NULL,
  `id_tabella` int(32) unsigned DEFAULT NULL,
  `importo` double NOT NULL,
  `id_fornitore` int(32) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_fornitore` (`id_fornitore`),
  KEY `id_tabella` (`id_tabella`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dump dei dati per la tabella `sottocategorie`
--

INSERT INTO `sottocategorie` (`id`, `nome`, `note`, `id_categoria`, `id_tabella`, `importo`, `id_fornitore`) VALUES
(12, 'Illuminazione parti comuni', '', 7, 10, 1000, 6),
(13, 'Pulizia', '', 9, 10, 4000, 3),
(14, 'Manutenzione ascensore', '', 9, 12, 5000, 2),
(15, 'Spesa bonifici', '', 8, 11, 500, 5),
(17, 'Cancelleria', '', 8, 11, 500, 4),
(18, 'Ricarica estintori', '', 10, 13, 300, 2),
(19, 'Disinfestazione', '', 10, 13, 1000, 2),
(20, 'Pulizia scala', '', 12, 15, 1451.88000488281, 3),
(21, 'Enel', '', 12, 15, 871.830017089844, 6),
(22, 'Manutenzione ordinaria ascensore', '', 12, 15, 749.880004882812, 8),
(23, 'Modello 770', '', 13, 17, 157.300003051758, 7),
(24, 'Tasse postali', '', 13, 17, 6, NULL),
(25, 'Spese amministrative', '', 13, 17, 144, 7),
(26, 'Consulenza amministrativa', '', 13, 17, 1052.52001953125, 7),
(27, 'Consulenza amministrativa t', '', 13, 17, 90.5999984741211, 7),
(28, 'Raccomandate', '', 13, 17, 30, 7),
(29, 'Enel autoclave', '', 13, 17, 216.630004882812, 6),
(30, 'Spese extra', '', 13, 17, 100, NULL),
(31, 'Spese bancarie', '', 13, 17, 60.7000007629395, 5),
(32, 'Cancelleria', '', 13, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `tabelle`
--

DROP TABLE IF EXISTS `tabelle`;
CREATE TABLE IF NOT EXISTS `tabelle` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `id_esercizio` int(32) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_esercizio` (`id_esercizio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `tabelle`
--

INSERT INTO `tabelle` (`id`, `nome`, `descrizione`, `id_esercizio`) VALUES
(10, 'Prorpietà', 'Tabella generata automaticamente alla creazione dell''esercizio', 12),
(11, 'Parti uguali', '', 12),
(12, 'Ascensore', '', 12),
(13, 'Proprietà garage', '', 12),
(14, 'Prorpietà', 'Tabella generata automaticamente alla creazione dell''esercizio', 13),
(15, 'Scale-Ascensore', '', 13),
(17, 'Parti uguali 1', '', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `transazioni`
--

DROP TABLE IF EXISTS `transazioni`;
CREATE TABLE IF NOT EXISTS `transazioni` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `data_competenza` date DEFAULT NULL,
  `importo` double unsigned NOT NULL,
  `id_esercizio` int(32) unsigned NOT NULL,
  `id_sottocategoria` int(32) unsigned DEFAULT NULL,
  `id_fornitore` int(32) unsigned DEFAULT NULL,
  `data_fattura` date DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `pagato` tinyint(1) NOT NULL,
  `id_relazione_unita` int(32) unsigned DEFAULT NULL,
  `tipo` enum('SERVIZIO','RATA') NOT NULL,
  `tipo_rata` enum('ORDINARIA','STRAORDINARIA','ACQUEDOTTO') DEFAULT NULL,
  `segno` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sottocategoria` (`id_sottocategoria`),
  KEY `id_esercizio` (`id_esercizio`),
  KEY `id_fornitore` (`id_fornitore`),
  KEY `id_relazione_unita` (`id_relazione_unita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dump dei dati per la tabella `transazioni`
--

INSERT INTO `transazioni` (`id`, `nome`, `descrizione`, `data_competenza`, `importo`, `id_esercizio`, `id_sottocategoria`, `id_fornitore`, `data_fattura`, `data_pagamento`, `pagato`, `id_relazione_unita`, `tipo`, `tipo_rata`, `segno`) VALUES
(13, 'Penne', '', '2015-01-05', 5, 12, 17, 4, '2015-01-05', '2015-01-05', 1, 25, 'SERVIZIO', 'ORDINARIA', 1),
(14, 'Matite', '', '2015-01-18', 3, 12, 17, 4, '2015-01-18', '2015-01-18', 1, 25, 'SERVIZIO', 'ORDINARIA', 1),
(15, 'Pagamento rata tania', '', '2015-01-01', 600, 12, 12, 6, NULL, NULL, 1, 25, 'RATA', 'ORDINARIA', 0),
(16, 'Lucchetti', '', '2015-01-20', 25, 13, 30, 2, '2015-01-20', '2015-01-22', 1, 34, 'SERVIZIO', 'ORDINARIA', 1),
(17, 'Rata Pulito Giuseppe', '', '2015-02-05', 45, 13, 21, 6, NULL, NULL, 1, 34, 'RATA', 'ORDINARIA', 0),
(18, 'Enel scale', '', '2015-01-20', 58, 13, 21, 6, '2015-01-20', '2015-02-05', 1, 34, 'SERVIZIO', 'ORDINARIA', 1),
(19, 'Rata Conserva Mario', '', '2015-02-05', 60, 13, 21, 6, NULL, NULL, 1, 43, 'RATA', 'ORDINARIA', 0),
(20, 'Modello 770', '', '2015-07-31', 158, 13, 23, 7, '2015-02-05', '2015-02-05', 1, 34, 'SERVIZIO', 'ORDINARIA', 1),
(21, 'Tasse postali', '', '2015-01-20', 1.3, 13, 24, 4, '2015-01-20', '2015-02-02', 1, 34, 'SERVIZIO', 'ORDINARIA', 1),
(22, 'Cancelleria', '', '2015-02-03', 10, 13, 32, 4, '2015-02-03', '2015-02-03', 1, 34, 'SERVIZIO', 'ORDINARIA', 0),
(23, 'Mine per la matita', '', NULL, 120, 12, 12, 6, NULL, NULL, 1, 25, 'SERVIZIO', 'STRAORDINARIA', 1),
(24, 'acqua', '', NULL, 200, 12, 12, 6, NULL, NULL, 1, 25, 'RATA', 'ACQUEDOTTO', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `unita`
--

DROP TABLE IF EXISTS `unita`;
CREATE TABLE IF NOT EXISTS `unita` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `id_gruppo` int(32) unsigned NOT NULL,
  `interno` int(32) NOT NULL,
  `subalterno` int(32) NOT NULL,
  `piano` varchar(30) NOT NULL,
  `note` text NOT NULL,
  `foglio` varchar(30) NOT NULL,
  `particella` int(32) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `rendita` double NOT NULL,
  `frequenza_rate` enum('MENSILE','BIMESTRALE','TRIMESTRALE','ANNUALE') NOT NULL,
  `categoria_acquedotto` enum('DOMESTICO','PUBBLICO','COMMERCIALE','INDUSTRIALE','ALTRO') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_gruppo` (`id_gruppo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dump dei dati per la tabella `unita`
--

INSERT INTO `unita` (`id`, `tipo`, `id_gruppo`, `interno`, `subalterno`, `piano`, `note`, `foglio`, `particella`, `categoria`, `rendita`, `frequenza_rate`, `categoria_acquedotto`) VALUES
(12, 'Abitazione', 12, 1, 0, '1', '', '', 0, '', 0, 'BIMESTRALE', 'PUBBLICO'),
(13, 'Mansarda', 12, 2, 0, '2', '', '', 0, '', 0, 'BIMESTRALE', 'INDUSTRIALE'),
(14, 'Depandance', 11, 3, 0, '0', '', '', 0, '', 0, 'TRIMESTRALE', 'DOMESTICO'),
(15, 'Garage', 12, 4, 0, '-1', '', '', 0, '', 0, 'ANNUALE', 'DOMESTICO'),
(16, 'Garage', 12, 5, 0, '-1', '', '', 0, '', 0, 'ANNUALE', 'DOMESTICO'),
(17, 'Abitazione', 13, 1, 1, 'T', '', '90', 123, 'A/3', 123, 'BIMESTRALE', 'DOMESTICO'),
(18, 'Abitazione', 13, 2, 2, '1', '', '90', 123, 'A/3', 231, 'BIMESTRALE', 'DOMESTICO'),
(19, 'Abitazione', 13, 3, 3, '1', '', '90', 123, 'A/3', 124, 'BIMESTRALE', 'DOMESTICO'),
(20, 'Abitazione', 13, 4, 4, '1', '', '90', 123, 'A/3', 342, 'BIMESTRALE', 'DOMESTICO'),
(21, 'Abitazione', 13, 5, 5, '1', '', '90', 123, 'A/3', 245, 'BIMESTRALE', 'DOMESTICO'),
(22, 'Abitazione', 13, 6, 6, '2', '', '90', 123, 'A/3', 266, 'BIMESTRALE', 'DOMESTICO'),
(23, 'Abitazione', 13, 7, 7, '2', '', '90', 123, 'A/3', 277, 'BIMESTRALE', 'DOMESTICO'),
(24, 'Abitazione', 13, 8, 8, '2', '', '90', 123, 'A/3', 264, 'BIMESTRALE', 'DOMESTICO'),
(25, 'Abitazione', 13, 9, 9, '2', '', '90', 123, 'A/3', 321, 'BIMESTRALE', 'DOMESTICO'),
(26, 'Abitazione', 13, 10, 10, '3', '', '90', 123, 'A/3', 678, 'BIMESTRALE', 'DOMESTICO'),
(27, 'Abitazione', 13, 11, 11, '3', '', '90', 123, 'A/3', 432, 'BIMESTRALE', 'DOMESTICO'),
(28, 'Abitazione', 13, 12, 12, '3', '', '90', 123, 'A/3', 343, 'BIMESTRALE', 'DOMESTICO'),
(29, 'Abitazione', 13, 13, 13, '3', '', '90', 123, 'A/3', 290, 'BIMESTRALE', 'DOMESTICO'),
(30, 'Bucataio', 13, 0, 34, '', '', '90', 123, 'C/6', 21, 'BIMESTRALE', 'DOMESTICO'),
(31, 'Abitazione', 13, 14, 14, '4', '', '90', 123, 'A/3', 442, 'BIMESTRALE', 'DOMESTICO'),
(32, 'Abitazione', 13, 15, 15, '4', '', '90', 123, 'A/3', 451, 'BIMESTRALE', 'DOMESTICO'),
(33, 'Bucataio', 13, 0, 35, '', '', '90', 123, 'C/6', 11, 'BIMESTRALE', 'DOMESTICO'),
(34, 'Abitazione', 13, 16, 16, '4', '', '90', 123, 'A/3', 352, 'BIMESTRALE', 'DOMESTICO'),
(35, 'Abitazione', 13, 17, 17, '4', '', '90', 123, 'A/3', 765, 'BIMESTRALE', 'DOMESTICO'),
(36, 'Bucataio', 13, 0, 36, '', '', '90', 123, 'C/6', 23, 'BIMESTRALE', 'DOMESTICO');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_azienda` int(32) unsigned NOT NULL,
  `amministratore` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_azienda` (`id_azienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `id_azienda`, `amministratore`) VALUES
(1, 'admin', 'adminpassword', 1, 1),
(2, 'domenico', 'domenico', 1, 0);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `condomini`
--
ALTER TABLE `condomini`
  ADD CONSTRAINT `condomini_ibfk_1` FOREIGN KEY (`id_azienda`) REFERENCES `aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `dati_tabella`
--
ALTER TABLE `dati_tabella`
  ADD CONSTRAINT `dati_tabella_ibfk_1` FOREIGN KEY (`id_tabella`) REFERENCES `tabelle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dati_tabella_ibfk_2` FOREIGN KEY (`id_relazione_unita`) REFERENCES `relazioni_unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  ADD CONSTRAINT `esercizi_ibfk_1` FOREIGN KEY (`id_condominio`) REFERENCES `condomini` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `esercizi_ibfk_2` FOREIGN KEY (`id_tabella_acquedotto`) REFERENCES `tabelle` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `esercizi_ibfk_3` FOREIGN KEY (`id_tabella_straordinari`) REFERENCES `tabelle` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `fornitori`
--
ALTER TABLE `fornitori`
  ADD CONSTRAINT `fornitori_ibfk_1` FOREIGN KEY (`id_azienda`) REFERENCES `aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  ADD CONSTRAINT `gruppi_ibfk_1` FOREIGN KEY (`id_palazzina`) REFERENCES `palazzine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `palazzine`
--
ALTER TABLE `palazzine`
  ADD CONSTRAINT `palazzine_ibfk_1` FOREIGN KEY (`id_condominio`) REFERENCES `condomini` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `persone`
--
ALTER TABLE `persone`
  ADD CONSTRAINT `persone_ibfk_1` FOREIGN KEY (`id_condominio`) REFERENCES `condomini` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`id_relazione_unita`) REFERENCES `relazioni_unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `rate_acquedotto`
--
ALTER TABLE `rate_acquedotto`
  ADD CONSTRAINT `rate_acquedotto_ibfk_1` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_acquedotto_ibfk_2` FOREIGN KEY (`id_relazione_unita`) REFERENCES `relazioni_unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `relazioni_unita`
--
ALTER TABLE `relazioni_unita`
  ADD CONSTRAINT `relazioni_unita_ibfk_1` FOREIGN KEY (`id_unita`) REFERENCES `unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relazioni_unita_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sottocategorie`
--
ALTER TABLE `sottocategorie`
  ADD CONSTRAINT `sottocategorie_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sottocategorie_ibfk_2` FOREIGN KEY (`id_fornitore`) REFERENCES `fornitori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sottocategorie_ibfk_3` FOREIGN KEY (`id_tabella`) REFERENCES `tabelle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `tabelle`
--
ALTER TABLE `tabelle`
  ADD CONSTRAINT `tabelle_ibfk_1` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `transazioni`
--
ALTER TABLE `transazioni`
  ADD CONSTRAINT `transazioni_ibfk_1` FOREIGN KEY (`id_sottocategoria`) REFERENCES `sottocategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transazioni_ibfk_2` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transazioni_ibfk_3` FOREIGN KEY (`id_fornitore`) REFERENCES `fornitori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transazioni_ibfk_4` FOREIGN KEY (`id_relazione_unita`) REFERENCES `relazioni_unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `unita`
--
ALTER TABLE `unita`
  ADD CONSTRAINT `unita_ibfk_1` FOREIGN KEY (`id_gruppo`) REFERENCES `gruppi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`id_azienda`) REFERENCES `aziende` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
