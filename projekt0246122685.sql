-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 11:20 PM
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
-- Database: `projekt0246122685`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'korisnik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$EyiSTtrQdT2CV/zi55qFzOqgrQYHPRkhKNvQfHRFEH3SsWXRs3GvG', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Admin', 'Korisnik', 'admin', '$2y$10$EyiSTtrQdT2CV/zi55qFzOqgrQYHPRkhKNvQfHRFEH3SsWXRs3GvG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(20) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` mediumtext NOT NULL,
  `tekst` mediumtext NOT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `kategorija` varchar(100) NOT NULL,
  `arhiva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '21.06.2026.', 'AMD priprema novu generaciju Ryzen procesora', 'Novi procesori trebali bi donijeti bolju potrosnju energije i vise performansi u igrama.', 'Prema dostupnim najavama, naglasak je na boljoj efikasnosti i stabilnijim temperaturama. To je posebno vazno korisnicima koji slazu tiha racunala za rad, ucenje i igranje.', 'Media/Ryzen99950X3D.png', 'Procesori', 0),
(2, '21.06.2026.', 'Intel najavljuje promjene za idući socket', 'Nova platforma mogla bi tražiti drugačije matične ploče i novije memorijske module.', 'Kod slaganja racunala vazno je provjeriti podrzava li procesor odabranu plocu. Promjena socketa znaci da starije ploce najcesce nece biti kompatibilne s novim procesorima.', 'Media/LGA-1851-Socket.jpg', 'Procesori', 0),
(3, '21.06.2026.', 'Zračni hladnjaci opet su popularan izbor', 'Korisnici sve češće biraju jednostavna i tiha rješenja za svakodnevna računala.', 'Iako vodena hladenja izgledaju atraktivno, mnogim korisnicima je vaznija pouzdanost i tisina. Kvalitetan zracni hladnjak moze godinama raditi bez posebnih problema.', 'Media/Air-Coolers.jpg', 'Procesori', 0),
(4, '21.06.2026.', 'Nova RTX kartica cilja igranje u 1440p rezoluciji', 'Prvi testovi najavljuju dobar omjer potrosnje, temperature i performansi.', 'Nova graficka kartica namijenjena je igracima koji zele dobar prikaz u 1440p rezoluciji. U ovoj klasi najvazniji su stabilan broj slicica u sekundi, temperature i buka ventilatora.', 'Media/RTX5070.png', 'Grafičke kartice', 0),
(5, '21.06.2026.', 'Cijene grafičkih kartica polako se stabiliziraju', 'Trgovine imaju bolju dostupnost modela srednje klase, što je dobra vijest za kupce.', 'Nakon duzeg razdoblja visokih cijena, modeli srednje klase postaju dostupniji. Kupci gledaju omjer cijene, memorije i potrosnje.', 'Media/Monitori-stastistike-grafickih.jpeg', 'Grafičke kartice', 0),
(6, '21.06.2026.', 'Koliko jako napajanje treba za novu grafičku?', 'Prije kupnje važno je provjeriti potrošnju kartice i dostupne konektore na napajanju.', 'Slabije ili starije napajanje moze stvarati probleme ako nema dovoljno snage ili odgovarajuce konektore. Zato je preporucljivo provjeriti preporuku proizvodaca graficke kartice.', 'Media/Napajanje-snaga.png', 'Grafičke kartice', 0),
(7, '21.06.2026.', 'B650 ploče i dalje su dobar izbor za većinu korisnika', 'Modeli srednje klase nude dovoljno priključaka i dobru podršku za moderne procesore.', 'Maticne ploce srednje klase nude dobar omjer cijene i mogucnosti za prosjecno racunalo. Prije kupnje treba provjeriti velicinu ploce, podrzanu memoriju i broj utora.', 'Media/B650.jpg', 'Matične ploče', 0),
(8, '21.06.2026.', 'Ažuriranje BIOS-a može popraviti stabilnost računala', 'Prije nadogradnje procesora dobro je provjeriti podržava li matična ploča noviji BIOS.', 'BIOS je vazan dio maticne ploce jer utjece na podrsku za procesore, memoriju i stabilnost sustava. Azuriranje moze rijesiti probleme s kompatibilnoscu.', 'Media/BIOS.png', 'Matične ploče', 0),
(9, '21.06.2026.', 'Kvalitetno napajanje važnije je od velikog broja vata', 'Dobro napajanje štiti komponente i pomaže da računalo radi stabilno pod opterećenjem.', 'Napajanje je komponenta koja utjece na stabilnost cijelog racunala, posebno kod jacih konfiguracija. Osim snage, vazno je gledati kvalitetu modela.', 'Media/PSU.jpg', 'Napajanja', 0),
(10, '21.06.2026.', 'Modularna napajanja olakšavaju slaganje urednog računala', 'Korisnik spaja samo kablove koji mu trebaju, pa je unutrašnjost kućišta preglednija.', 'Kod modularnih napajanja korisnik spaja samo kablove koji su mu potrebni. Takav pristup olaksava slaganje racunala i poboljsava protok zraka.', 'Media/ModularPSU.jpg', 'Napajanja', 0),
(11, '21.06.2026.', 'NVMe SSD diskovi znatno ubrzavaju pokretanje sustava', 'Brzi SSD najviše se osjeti kod pokretanja Windowsa, igara i većih programa.', 'SSD disk je jedna od nadogradnji koja se najvise osjeti u svakodnevnom radu racunala. NVMe modeli koriste brze sucelje i korisni su za sustav.', 'Media/SSD.jpg', 'Pohrana podataka', 0),
(12, '21.06.2026.', 'HDD diskovi su i dalje korisni za arhivu i sigurnosne kopije', 'Iako su sporiji od SSD-a, nude puno prostora za spremanje slika, videa i dokumenata.', 'HDD diskovi više nisu najbolji izbor za sustav, ali su korisni za spremanje velikih datoteka. Njihova prednost je cijena po gigabajtu.', 'Media/HDD.png', 'Pohrana podataka', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
