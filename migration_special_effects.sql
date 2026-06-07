USE prolux;

CREATE TABLE IF NOT EXISTS special_effects (
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

DELETE FROM special_effects;

INSERT INTO special_effects
(name, category, price, unit, image_url, description, safety_note, active) VALUES
('Plamene', 'Pyro FX', 2200.00, 'show', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80', 'Kontrolovane flame efekty pre velke stage show a festivalove podia.', 'Vyhradne s obsluhou, povolenim a presnym bezpecnostnym planom.', 1),
('CO2 dela', 'Stage FX', 1800.00, 'show', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd8195?auto=format&fit=crop&w=1000&q=80', 'Silne CO2 vystrely pre dropy, DJ sety a hlavne momenty koncertu.', 'Pouzitie len s technikom a bezpecnou vzdialenostou od publika.', 1),
('Studene iskry', 'Spark FX', 1500.00, 'show', 'https://images.unsplash.com/photo-1508973379184-7517410fb0bc?auto=format&fit=crop&w=1000&q=80', 'Fontany studenych iskier pre svadby, koncerty, nastupy a finalne momenty.', 'Potrebne je schvalenie miesta a kontrola vysky efektu.', 1),
('Laser show', 'Laser FX', 0.00, 'show', 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1000&q=80', 'Laserove efekty synchronizovane so svetlami, hudbou a dymom.', 'Nastavenie musi respektovat bezpecnost oci a smerovanie lucov.', 1),
('Confetti', 'Party FX', 950.00, 'show', 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=1000&q=80', 'Confetti vystrely, streamery a farebne finale pre koncerty, party aj firemne eventy.', 'Vhodne do interieru aj exterieru podla typu naplne.', 1),
('Hmla a haze', 'Atmosphere FX', 650.00, 'den', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1000&q=80', 'Haze a hmla pre zvyraznenie svetelnych lucov, laserov a atmosfery v priestore.', 'Treba zohladnit poziarne cidla a ventilaciu priestoru.', 1);
