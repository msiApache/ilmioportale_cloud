-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'gianluca', '$2y$10$mkbK9EpEj4ygly6R0BSlSe/mDGRuHD72RBsOQ5F17suZiSz/ML6jS', '2020-03-15 20:06:58'),
(2, 'antonio', '$2y$10$fSjvlTBSmvDxTDfauuusluDuH4OAJiTSwRDGOeMCk8kbhE5NS5avO', '2020-03-15 21:25:12'),
(3, 'gianlucatuono', '$2y$10$jiawJt8tkIRle.Okotj.zek8mVBhENd7wxr9rAVLLFH1ymjhxDWoy', '2020-03-22 17:07:44');

-- --------------------------------------------------------