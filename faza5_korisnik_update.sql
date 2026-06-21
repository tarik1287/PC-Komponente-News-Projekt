USE projekt0246122685;

ALTER DATABASE projekt0246122685
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS korisnik (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    korisnicko_ime VARCHAR(50) NOT NULL UNIQUE,
    lozinka VARCHAR(255) NOT NULL,
    razina INT NOT NULL DEFAULT 0
);

ALTER TABLE korisnik
CONVERT TO CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina)
SELECT 'Admin', 'Korisnik', 'admin', '$2y$10$EyiSTtrQdT2CV/zi55qFzOqgrQYHPRkhKNvQfHRFEH3SsWXRs3GvG', 1
WHERE NOT EXISTS (
    SELECT 1 FROM korisnik WHERE korisnicko_ime = 'admin'
);
