DROP TABLE IF EXISTS customers;


--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(128) UNSIGNED NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--
INSERT INTO `customers` (`id`, `name`, `address`) VALUES
(1, 'Chad Michaels', '2322 East Harvard Street, Glendale Ca, 91208'),
(2, 'Chris Evans', '122 West Street, Los Angeles Ca, 91002'),
(3, 'Mike Phelps', '234 Bel Aire, Beverly Hills CA, 91210');

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);



--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
