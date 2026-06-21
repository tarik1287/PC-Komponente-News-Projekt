USE projekt0246122685;

ALTER DATABASE projekt0246122685
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

ALTER TABLE vijesti
CONVERT TO CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

ALTER TABLE korisnik
CONVERT TO CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

UPDATE vijesti SET kategorija = 'Grafičke kartice' WHERE kategorija = 'Graficke kartice';
UPDATE vijesti SET kategorija = 'Matične ploče' WHERE kategorija = 'Maticne ploce';

UPDATE vijesti SET
    naslov = 'Intel najavljuje promjene za idući socket',
    sazetak = 'Nova platforma mogla bi tražiti drugačije matične ploče i novije memorijske module.'
WHERE naslov = 'Intel najavljuje promjene za iduci socket';

UPDATE vijesti SET
    naslov = 'Zračni hladnjaci opet su popularan izbor',
    sazetak = 'Korisnici sve češće biraju jednostavna i tiha rješenja za svakodnevna računala.'
WHERE naslov = 'Zracni hladnjaci opet su popularan izbor';

UPDATE vijesti SET
    naslov = 'Cijene grafičkih kartica polako se stabiliziraju',
    sazetak = 'Trgovine imaju bolju dostupnost modela srednje klase, što je dobra vijest za kupce.'
WHERE naslov = 'Cijene grafickih kartica polako se stabiliziraju';

UPDATE vijesti SET
    naslov = 'Koliko jako napajanje treba za novu grafičku?',
    sazetak = 'Prije kupnje važno je provjeriti potrošnju kartice i dostupne konektore na napajanju.'
WHERE naslov = 'Koliko jako napajanje treba za novu graficku?';

UPDATE vijesti SET
    naslov = 'B650 ploče i dalje su dobar izbor za većinu korisnika',
    sazetak = 'Modeli srednje klase nude dovoljno priključaka i dobru podršku za moderne procesore.'
WHERE naslov = 'B650 ploce i dalje su dobar izbor za vecinu korisnika';

UPDATE vijesti SET
    naslov = 'Ažuriranje BIOS-a može popraviti stabilnost računala',
    sazetak = 'Prije nadogradnje procesora dobro je provjeriti podržava li matična ploča noviji BIOS.'
WHERE naslov = 'Azuriranje BIOS-a moze popraviti stabilnost racunala';

UPDATE vijesti SET
    naslov = 'Kvalitetno napajanje važnije je od velikog broja vata',
    sazetak = 'Dobro napajanje štiti komponente i pomaže da računalo radi stabilno pod opterećenjem.'
WHERE naslov = 'Kvalitetno napajanje vaznije je od velikog broja vata';

UPDATE vijesti SET
    naslov = 'Modularna napajanja olakšavaju slaganje urednog računala',
    sazetak = 'Korisnik spaja samo kablove koji mu trebaju, pa je unutrašnjost kućišta preglednija.'
WHERE naslov = 'Modularna napajanja olaksavaju slaganje urednog racunala';

UPDATE vijesti SET
    sazetak = 'Brzi SSD najviše se osjeti kod pokretanja Windowsa, igara i većih programa.'
WHERE naslov = 'NVMe SSD diskovi znatno ubrzavaju pokretanje sustava';

UPDATE vijesti SET
    tekst = 'HDD diskovi više nisu najbolji izbor za sustav, ali su korisni za spremanje velikih datoteka. Njihova prednost je cijena po gigabajtu.'
WHERE naslov = 'HDD diskovi su i dalje korisni za arhivu i sigurnosne kopije';
