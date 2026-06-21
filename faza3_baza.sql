CREATE DATABASE IF NOT EXISTS projekt0246122685
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE projekt0246122685;

DROP TABLE IF EXISTS vijesti;
DROP TABLE IF EXISTS korisnik;

CREATE TABLE korisnik (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    korisnicko_ime VARCHAR(50) NOT NULL UNIQUE,
    lozinka VARCHAR(255) NOT NULL,
    razina INT NOT NULL DEFAULT 0
);

INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES
('Admin', 'Korisnik', 'admin', '$2y$10$EyiSTtrQdT2CV/zi55qFzOqgrQYHPRkhKNvQfHRFEH3SsWXRs3GvG', 1);

CREATE TABLE vijesti (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    datum VARCHAR(20) NOT NULL,
    naslov VARCHAR(255) NOT NULL,
    sazetak TEXT NOT NULL,
    tekst TEXT NOT NULL,
    slika VARCHAR(255),
    kategorija VARCHAR(100) NOT NULL,
    arhiva TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES
('21.06.2026.', 'AMD priprema novu generaciju Ryzen procesora', 'Novi procesori trebali bi donijeti bolju potrošnju energije i više performansi u igrama.', 'Prema dostupnim najavama, naglasak je na boljoj efikasnosti i stabilnijim temperaturama. To je posebno važno korisnicima koji slažu tiha računala za rad, učenje i igranje.', 'Media/Ryzen99950X3D.png', 'Procesori', 0),
('21.06.2026.', 'Intel najavljuje promjene za idući socket', 'Nova platforma mogla bi tražiti drugačije matične ploče i novije memorijske module.', 'Kod slaganja računala važno je provjeriti podržava li procesor odabranu ploču. Promjena socketa znači da starije ploče najčešće neće biti kompatibilne s novim procesorima.', 'Media/LGA-1851-Socket.jpg', 'Procesori', 0),
('21.06.2026.', 'Zračni hladnjaci opet su popularan izbor', 'Korisnici sve češće biraju jednostavna i tiha rješenja za svakodnevna računala.', 'Iako vodena hlađenja izgledaju atraktivno, mnogim korisnicima je važnija pouzdanost i tišina. Kvalitetan zračni hladnjak može godinama raditi bez posebnih problema.', 'Media/Air-Coolers.jpg', 'Procesori', 0),
('21.06.2026.', 'Nova RTX kartica cilja igranje u 1440p rezoluciji', 'Prvi testovi najavljuju dobar omjer potrošnje, temperature i performansi.', 'Nova grafička kartica namijenjena je igračima koji žele dobar prikaz u 1440p rezoluciji. U ovoj klasi najvažniji su stabilan broj sličica u sekundi, temperature i buka ventilatora.', 'Media/RTX5070.png', 'Grafičke kartice', 0),
('21.06.2026.', 'Cijene grafičkih kartica polako se stabiliziraju', 'Trgovine imaju bolju dostupnost modela srednje klase, što je dobra vijest za kupce.', 'Nakon dužeg razdoblja visokih cijena, modeli srednje klase postaju dostupniji. Kupci gledaju omjer cijene, memorije i potrošnje.', 'Media/Monitori-stastistike-grafickih.jpeg', 'Grafičke kartice', 0),
('21.06.2026.', 'Koliko jako napajanje treba za novu grafičku?', 'Prije kupnje važno je provjeriti potrošnju kartice i dostupne konektore na napajanju.', 'Slabije ili starije napajanje može stvarati probleme ako nema dovoljno snage ili odgovarajuće konektore. Zato je preporučljivo provjeriti preporuku proizvođača grafičke kartice.', 'Media/Napajanje-snaga.png', 'Grafičke kartice', 0),
('21.06.2026.', 'B650 ploče i dalje su dobar izbor za većinu korisnika', 'Modeli srednje klase nude dovoljno priključaka i dobru podršku za moderne procesore.', 'Matične ploče srednje klase nude dobar omjer cijene i mogućnosti za prosječno računalo. Prije kupnje treba provjeriti veličinu ploče, podržanu memoriju i broj utora.', 'Media/B650.jpg', 'Matične ploče', 0),
('21.06.2026.', 'Ažuriranje BIOS-a može popraviti stabilnost računala', 'Prije nadogradnje procesora dobro je provjeriti podržava li matična ploča noviji BIOS.', 'BIOS je važan dio matične ploče jer utječe na podršku za procesore, memoriju i stabilnost sustava. Ažuriranje može riješiti probleme s kompatibilnošću.', 'Media/BIOS.png', 'Matične ploče', 0),
('21.06.2026.', 'Kvalitetno napajanje važnije je od velikog broja vata', 'Dobro napajanje štiti komponente i pomaže da računalo radi stabilno pod opterećenjem.', 'Napajanje je komponenta koja utječe na stabilnost cijelog računala, posebno kod jačih konfiguracija. Osim snage, važno je gledati kvalitetu modela.', 'Media/PSU.jpg', 'Napajanja', 0),
('21.06.2026.', 'Modularna napajanja olakšavaju slaganje urednog računala', 'Korisnik spaja samo kablove koji mu trebaju, pa je unutrašnjost kućišta preglednija.', 'Kod modularnih napajanja korisnik spaja samo kablove koji su mu potrebni. Takav pristup olakšava slaganje računala i poboljšava protok zraka.', 'Media/ModularPSU.jpg', 'Napajanja', 0),
('21.06.2026.', 'NVMe SSD diskovi znatno ubrzavaju pokretanje sustava', 'Brzi SSD najviše se osjeti kod pokretanja Windowsa, igara i većih programa.', 'SSD disk je jedna od nadogradnji koja se najviše osjeti u svakodnevnom radu računala. NVMe modeli koriste brže sučelje i korisni su za sustav.', 'Media/SSD.jpg', 'Pohrana podataka', 0),
('21.06.2026.', 'HDD diskovi su i dalje korisni za arhivu i sigurnosne kopije', 'Iako su sporiji od SSD-a, nude puno prostora za spremanje slika, videa i dokumenata.', 'HDD diskovi više nisu najbolji izbor za sustav, ali su korisni za spremanje velikih datoteka. Njihova prednost je cijena po gigabajtu.', 'Media/HDD.png', 'Pohrana podataka', 0);
