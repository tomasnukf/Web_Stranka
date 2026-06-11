-- Fo SQL subor: vytvori celu databazu ProLux od zaciatku.
CREATE DATABASE IF NOT EXISTS prolux
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE prolux;

-- Stare tabulky sa odstrania, aby import vytvoril cistu strukturu.
DROP TABLE IF EXISTS special_effects;
DROP TABLE IF EXISTS rental_packages;
DROP TABLE IF EXISTS inquiries;
DROP TABLE IF EXISTS lights;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS manufacturers;

-- Gyartok tabulka: Robe, Martin, Showtek, ADJ, DTS.
CREATE TABLE manufacturers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    country VARCHAR(100) NOT NULL,
    website VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Svetla tabulka: produkty pre prenajom a CRUD operacie.
CREATE TABLE lights (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    manufacturer_id INT UNSIGNED NOT NULL,
    name VARCHAR(160) NOT NULL,
    category VARCHAR(100) NOT NULL,
    power_w INT UNSIGNED NOT NULL DEFAULT 0,
    rental_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    image_url VARCHAR(500) NOT NULL,
    description TEXT NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_lights_manufacturer
        FOREIGN KEY (manufacturer_id) REFERENCES manufacturers(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Admin pouzivatelia s hashelt jelszoval.
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Dopyty zakaznikov z kontaktneho formulara.
CREATE TABLE inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(80) NULL,
    event_date DATE NULL,
    message TEXT NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Hotove stage balicky s poctami svetiel a technikov.
CREATE TABLE rental_packages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(140) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    beam_count INT UNSIGNED NOT NULL DEFAULT 0,
    wash_count INT UNSIGNED NOT NULL DEFAULT 0,
    spot_count INT UNSIGNED NOT NULL DEFAULT 0,
    hazer_count INT UNSIGNED NOT NULL DEFAULT 0,
    truss_meters INT UNSIGNED NOT NULL DEFAULT 0,
    crew_count INT UNSIGNED NOT NULL DEFAULT 0,
    image_url VARCHAR(500) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Specialne efekty ako CO2, confetti, laser, plamene.
CREATE TABLE special_effects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(140) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    unit VARCHAR(40) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    description TEXT NOT NULL,
    safety_note TEXT NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO manufacturers (id, name, country, website) VALUES
(1, 'Robe', 'Czech Republic', 'https://www.robe.cz'),
(2, 'Martin', 'Denmark', 'https://www.martin.com'),
(3, 'Showtek', 'Netherlands', 'https://www.showtec.info'),
(4, 'ADJ', 'United States', 'https://www.adj.com'),
(5, 'DTS', 'Italy', 'https://dts-lighting.it');

INSERT INTO users (name, email, password_hash) VALUES
('Administrator', 'admin@prolux.sk', '$2y$10$i0qEfpRlKq8.CV/WA3DeAOzxHtBdovGbCIgvOK0Z6zUuGFNGtlH26');

INSERT INTO lights
(manufacturer_id, name, category, power_w, rental_price, stock, image_url, description, active) VALUES
(1, 'Robe MegaPointe', 'Beam / Spot / Wash', 470, 95.00, 8, 'https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=900&q=80', 'Hybridne pohyblive svetlo vhodne na koncerty a velke stage show.', 1),
(1, 'Robe Spiider', 'LED Wash', 480, 78.00, 10, 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=900&q=80', 'Vyrazny LED wash s efektom flower pre velke aj mensie podia.', 1),
(1, 'Robe BMFL Spot', 'Moving Spot', 1700, 120.00, 4, 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&w=900&q=80', 'Silny spot pre stadiony, festivaly a broadcast produkcie.', 1),
(1, 'Robe LEDBeam 150', 'Beam / Wash', 150, 42.00, 16, 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=900&q=80', 'Kompaktne rychle svetlo pre kluby, DJ stage a efekty v priestore.', 1),
(1, 'Robe Tarrantula', 'LED Wash', 800, 110.00, 6, 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&w=900&q=80', 'Velky LED wash s vysokym vykonom pre masivne farebne plochy.', 1),

(2, 'Martin MAC Aura XB', 'LED Wash', 260, 58.00, 12, 'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?auto=format&fit=crop&w=900&q=80', 'Oblubeny wash s aura efektom pre koncertne a televizne produkcie.', 1),
(2, 'Martin MAC Quantum Profile', 'LED Profile', 750, 92.00, 6, 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=900&q=80', 'Profilove pohyblive svetlo s ostou optikou a presnym tvarovanim luca.', 1),
(2, 'Martin MAC Viper Profile', 'Moving Profile', 1000, 98.00, 5, 'https://images.unsplash.com/photo-1508973379184-7517410fb0bc?auto=format&fit=crop&w=900&q=80', 'Profesionalny profile moving head pre touring a festivalove stage.', 1),
(2, 'Martin Rush MH 7 Hybrid', 'Hybrid Beam', 350, 55.00, 9, 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=900&q=80', 'Hybridny beam a spot pre dynamicke show s rychlym pohybom.', 1),
(2, 'Martin ELP CL', 'LED Ellipsoidal', 260, 38.00, 10, 'https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?auto=format&fit=crop&w=900&q=80', 'Tiche profilove svetlo pre divadlo, konferencie a firemne eventy.', 1),

(3, 'Showtek Phantom 130 Spot', 'Moving Spot', 290, 45.00, 8, 'https://images.unsplash.com/photo-1468359601543-843bfaef291a?auto=format&fit=crop&w=900&q=80', 'Univerzalny spot pre mensie koncerty, kluby a mobilne produkcie.', 1),
(3, 'Showtek Shark Beam One', 'Beam', 100, 34.00, 12, 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=900&q=80', 'Kompaktny beam efekt pre rychle svetelne prechody a klubove show.', 1),
(3, 'Showtek Spectral M800 Q4', 'LED Wash', 180, 28.00, 18, 'https://images.unsplash.com/photo-1499364615650-ec38552f4f34?auto=format&fit=crop&w=900&q=80', 'LED wash panel vhodny na nasvietenie podia, stien a event priestoru.', 1),
(3, 'Showtek Helix S5000 Q4', 'Outdoor Wash', 420, 52.00, 6, 'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?auto=format&fit=crop&w=900&q=80', 'Odolne outdoor LED svetlo pre festivaly a exterierove instalacie.', 1),
(3, 'Showtek Sunstrip Active MKII', 'Blinder', 750, 30.00, 20, 'https://images.unsplash.com/photo-1504680177321-2e6a879aac86?auto=format&fit=crop&w=900&q=80', 'Klasicky efektovy blinder pre koncerty, live show a klubove podia.', 1),

(4, 'ADJ Vizi Beam RXONE', 'Beam', 100, 36.00, 10, 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?auto=format&fit=crop&w=900&q=80', 'Rychle beam svetlo s ostrym lucom pre DJ show a party eventy.', 1),
(4, 'ADJ Focus Spot 5Z', 'LED Spot', 200, 48.00, 7, 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=900&q=80', 'Spot s motorizovanym zoomom, gobo efektmi a kvalitnou optikou.', 1),
(4, 'ADJ Jolt 300', 'Strobe / Blinder', 300, 40.00, 12, 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80', 'Strobe a blinder efekt s vysokou intenzitou pre energicke momenty show.', 1),
(4, 'ADJ Encore Profile 1000', 'Profile', 120, 32.00, 8, 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=900&q=80', 'Profilove LED svetlo pre divadla, prezentacie a presne nasvietenie.', 1),
(4, 'ADJ Hydro Beam X2', 'Outdoor Beam', 370, 62.00, 6, 'https://images.unsplash.com/photo-1501612780327-45045538702b?auto=format&fit=crop&w=900&q=80', 'Outdoor beam svetlo s vysokou odolnostou pre festivalove nasadenie.', 1),

(5, 'DTS Synergy 5 Profile', 'LED Profile', 420, 82.00, 6, 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=900&q=80', 'Vykonne profilove svetlo s presnou optikou a bohatou efektovou vybavou.', 1),
(5, 'DTS Jack', 'Beam / Spot', 480, 72.00, 8, 'https://images.unsplash.com/photo-1522158637959-30385a09e0da?auto=format&fit=crop&w=900&q=80', 'Kompaktny hybrid pre touring, koncerty a univerzalne stage pouzitie.', 1),
(5, 'DTS Katana', 'LED Bar', 320, 50.00, 10, 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=900&q=80', 'LED bar s pohybom a pixel efektmi pre moderne vizualne show.', 1),
(5, 'DTS Scena LED 200', 'Theatre Fresnel', 200, 35.00, 14, 'https://images.unsplash.com/photo-1508973379184-7517410fb0bc?auto=format&fit=crop&w=900&q=80', 'Divadelne LED svetlo pre hladke a tiche nasvietenie sceny.', 1),
(5, 'DTS Nick NRG 1201', 'LED Wash', 430, 46.00, 9, 'https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?auto=format&fit=crop&w=900&q=80', 'RGBW wash pre eventy, kluby a farebne nasvietenie priestoru.', 1);

UPDATE lights SET image_url = CASE name
    WHEN 'Robe MegaPointe' THEN 'https://cdn.aws.robe.cz/v1/image/resize/025ed591ad67ff06e9dd82b461e0c345ba595d4a?width=900&height=900&fit=cover&withoutEnlargement=false'
    WHEN 'Robe Spiider' THEN 'https://cdn.aws.robe.cz/v1/image/resize/bacf4d213ec3c79f0b0fbc9128588eea91297efa?width=900&height=900&fit=cover&withoutEnlargement=false'
    WHEN 'Robe BMFL Spot' THEN 'https://cdn.aws.robe.cz/v1/image/resize/d017cced42e33d41104c891055714cc77a84a0be?width=900&height=900&fit=cover&withoutEnlargement=false'
    WHEN 'Robe LEDBeam 150' THEN 'https://cdn.aws.robe.cz/v1/image/resize/371252fca4e93281166480433c3fbbc5635c6c8e?width=900&height=900&fit=cover&withoutEnlargement=false'
    WHEN 'Robe Tarrantula' THEN 'https://cdn.aws.robe.cz/v1/image/resize/6c9de341cb1ae82efd1cbaa4693d7540565e81c6?width=900&height=900&fit=cover&withoutEnlargement=false'
    WHEN 'Martin MAC Aura XB' THEN 'https://adn.harmanpro.com/product_attachments/product_attachments/4821_1728940605/AuraXB_main_1_x_large.webp'
    WHEN 'Martin MAC Quantum Profile' THEN 'https://adn.harmanpro.com/product_attachments/product_attachments/4808_1728940618/MACQuantumProfile_x_large.webp'
    WHEN 'Martin MAC Viper Profile' THEN 'https://adn.harmanpro.com/product_attachments/product_attachments/4793_1728940678/macviperprofile_x_large.webp'
    WHEN 'Martin Rush MH 7 Hybrid' THEN 'https://adn.harmanpro.com/product_attachments/product_attachments/4802_1728124309/RUSH-MH-7_main_1000_x_large.webp'
    WHEN 'Martin ELP CL' THEN 'https://adn.harmanpro.com/product_attachments/product_attachments/7028_1728934714/ELP_WhiteBlack_x_large.webp'
    WHEN 'Showtek Phantom 130 Spot' THEN 'https://thumbs.static-thomann.de/thumb/padthumb600x600/pics/bdb/_41/419265/12454598_800.jpg'
    WHEN 'Showtek Shark Beam One' THEN 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/5/45040_41.png'
    WHEN 'Showtek Spectral M800 Q4' THEN 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/3/43570_38.png'
    WHEN 'Showtek Helix S5000 Q4' THEN 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/4/3/43724_27.png'
    WHEN 'Showtek Sunstrip Active MKII' THEN 'https://www.showtec-lights.com/media/catalog/product/cache/cf45802cd465083d13f645e2a66e0ee8/3/0/30714_16.png'
    WHEN 'ADJ Vizi Beam RXONE' THEN 'https://www.adj.com/cdn/shop/files/d2955ef038890dc62bd727161c26ce4b12769d4b_VIZ354__IMG__001__872f0672d46d.jpg?v=1776712400&width=2048'
    WHEN 'ADJ Focus Spot 5Z' THEN 'https://www.adj.com/cdn/shop/files/e127e0529de247aaac8275c88cfb3612c8863191_Focus_Spot_5Z_red_RT.jpg?v=1778225517&width=2048'
    WHEN 'ADJ Jolt 300' THEN 'https://www.adj.eu/media/catalog/product/j/o/jolt30002.jpg_5_1.jpg'
    WHEN 'ADJ Encore Profile 1000' THEN 'https://www.adj.com/cdn/shop/files/8f3a3fbe6c042973d9a6fa3ea614a0e3d4b4352a_ENC264__IMG__002__638b790e8afe.png?v=1776713507&width=2048'
    WHEN 'ADJ Hydro Beam X2' THEN 'https://www.adj.com/cdn/shop/files/794d4926b2e29b3c6ee3382b627784b59c64863e_HYD210__IMG__001__29b121373dd0.jpg?v=1776712428&width=2048'
    WHEN 'DTS Synergy 5 Profile' THEN 'https://www.imlight.ru/images/KATALOG/SVET/DTS/Povorotnue_Golovu/LED/SPOT_PROFILE_HYBRID/SYNERGY_5_PROFILE/SYNERGY_5_PROFILE.jpg'
    WHEN 'DTS Jack' THEN 'https://art-complex.ru/userfiles/DTS/dts-jack.jpg'
    WHEN 'DTS Katana' THEN 'https://portal.fullavl.nl/2230-large_default/dts-katana.jpg'
    WHEN 'DTS Scena LED 200' THEN 'https://www.pasolutions.gr/images/thumbs/0572345_550.jpeg'
    WHEN 'DTS Nick NRG 1201' THEN 'https://www.pasolutions.gr/images/thumbs/0572470_550.jpeg'
    ELSE image_url
END;

INSERT INTO rental_packages
(name, category, price, beam_count, wash_count, spot_count, hazer_count, truss_meters, crew_count, image_url, description) VALUES
('Arena Tour XL', 'Velky stage', 24500.00, 40, 30, 20, 2, 96, 8, 'https://commons.wikimedia.org/wiki/Special:FilePath/FlexiFlex%20Touring%20Truss.jpg?width=1200', 'Kompletny svetelny balik pre festival, halu alebo velky open-air koncert. Obsahuje svetelne rampy, moving heads, hazery, pripravu patchu a technicky dozor.'),
('Club Pro M', 'Stredny stage', 16800.00, 24, 18, 12, 2, 60, 5, 'https://commons.wikimedia.org/wiki/Special:FilePath/Hanging%20stage%20lights.jpg?width=1200', 'Balik pre klubove koncerty, firemne eventy a stredne velke podia. Rozumne mnozstvo beam, wash a spot svetiel pre plnohodnotnu show.'),
('Event Start S', 'Mensi stage', 10000.00, 16, 12, 8, 1, 36, 3, 'https://commons.wikimedia.org/wiki/Special:FilePath/Traverse%20%28Truss%29.JPG?width=1200', 'Zakladny profesionalny balik pre mensie koncerty, party a prezentacie. Minimalna cena je 10 000 EUR.');

INSERT INTO special_effects
(name, category, price, unit, image_url, description, safety_note, active) VALUES
('Plamene', 'Pyro FX', 2200.00, 'show', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80', 'Kontrolovane flame efekty pre velke stage show a festivalove podia.', 'Vyhradne s obsluhou, povolenim a presnym bezpecnostnym planom.', 1),
('CO2 dela', 'Stage FX', 1800.00, 'show', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=1000&q=80', 'Silne CO2 vystrely pre dropy, DJ sety a hlavne momenty koncertu.', 'Pouzitie len s technikom a bezpecnou vzdialenostou od publika.', 1),
('Studene iskry', 'Spark FX', 1500.00, 'show', 'https://images.unsplash.com/photo-1508973379184-7517410fb0bc?auto=format&fit=crop&w=1000&q=80', 'Fontany studenych iskier pre svadby, koncerty, nastupy a finalne momenty.', 'Potrebne je schvalenie miesta a kontrola vysky efektu.', 1),
('Laser show', 'Laser FX', 0.00, 'show', 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1000&q=80', 'Laserove efekty synchronizovane so svetlami, hudbou a dymom.', 'Nastavenie musi respektovat bezpecnost oci a smerovanie lucov.', 1),
('Confetti', 'Party FX', 950.00, 'show', 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1000&q=80', 'Confetti vystrely, streamery a farebne finale pre koncerty, party aj firemne eventy.', 'Vhodne do interieru aj exterieru podla typu naplne.', 1),
('Hmla a haze', 'Atmosphere FX', 650.00, 'den', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1000&q=80', 'Haze a hmla pre zvyraznenie svetelnych lucov, laserov a atmosfery v priestore.', 'Treba zohladnit poziarne cidla a ventilaciu priestoru.', 1);
