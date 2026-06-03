USE prolux;

CREATE TABLE IF NOT EXISTS rental_packages (
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

DELETE FROM rental_packages;

INSERT INTO rental_packages
(name, category, price, beam_count, wash_count, spot_count, hazer_count, truss_meters, crew_count, image_url, description) VALUES
('Arena Tour XL', 'Velky stage', 24500.00, 40, 30, 20, 2, 96, 8, 'https://commons.wikimedia.org/wiki/Special:FilePath/FlexiFlex%20Touring%20Truss.jpg?width=1200', 'Kompletny svetelny balik pre festival, halu alebo velky open-air koncert. Obsahuje svetelne rampy, moving heads, hazery, pripravu patchu a technicky dozor.'),
('Club Pro M', 'Stredny stage', 16800.00, 24, 18, 12, 2, 60, 5, 'https://commons.wikimedia.org/wiki/Special:FilePath/Hanging%20stage%20lights.jpg?width=1200', 'Balik pre klubove koncerty, firemne eventy a stredne velke podia. Rozumne mnozstvo beam, wash a spot svetiel pre plnohodnotnu show.'),
('Event Start S', 'Mensi stage', 10000.00, 16, 12, 8, 1, 36, 3, 'https://commons.wikimedia.org/wiki/Special:FilePath/Traverse%20%28Truss%29.JPG?width=1200', 'Zakladny profesionalny balik pre mensie koncerty, party a prezentacie. Minimalna cena je 10 000 EUR.');

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
