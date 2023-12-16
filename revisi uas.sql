CREATE DATABASE uas;


CREATE TABLE roles(
  id_role INT NOT NULL AUTO_INCREMENT,
  nama_role VARCHAR(100) NULL,
  STATUS TINYINT NULL,
  PRIMARY KEY (id_role)
);

CREATE TABLE users(
  id_user INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(45) NULL,
  PASSWORD VARCHAR(100) NULL,
  email VARCHAR(60),
  idrole INT NOT NULL,
  STATUS TINYINT NULL,
  PRIMARY KEY (id_user),
  INDEX fk_user_role_idx (idrole ASC),
  CONSTRAINT fk_user_role
    FOREIGN KEY (idrole)
    REFERENCES roles (id_role)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


CREATE TABLE satuan (
  id_satuan INT NOT NULL AUTO_INCREMENT,
  nama_satuan VARCHAR(45) NULL,
  STATUS TINYINT NULL,
  PRIMARY KEY (id_satuan)
);

CREATE TABLE barang (
  id_barang INT NOT NULL AUTO_INCREMENT,
  jenis CHAR(1) NULL,
  nama VARCHAR(45) NULL,
  id_satuan INT NOT NULL,
  STATUS TINYINT NULL,
  harga INT NULL,
  PRIMARY KEY (id_barang),
  INDEX fk_barang_satuan1_idx (id_satuan ASC),
  CONSTRAINT fk_barang_satuan1
    FOREIGN KEY (id_satuan)
    REFERENCES satuan (id_satuan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE vendor (
  id_vendor INT NOT NULL AUTO_INCREMENT,
  nama_vendor VARCHAR(100) NULL,
  badan_hukum CHAR(1) NULL,
  STATUS CHAR(1) NULL,
  PRIMARY KEY (id_vendor)
);

CREATE TABLE pengadaan (
  id_pengadaan BIGINT NOT NULL AUTO_INCREMENT,
  TIMESTAMP TIMESTAMP NULL,
  user_id_user INT NOT NULL,
  STATUS CHAR(1) NULL,
  vendor_idvendor INT NOT NULL,
  subtotal_nilai INT NULL,
  ppn INT NULL,
  total_nilai INT NULL,
  PRIMARY KEY (id_pengadaan),
  INDEX fk_pengadaan_user1_idx (user_id_user ASC),
  INDEX fk_pengadaan_vendor1_idx (vendor_idvendor ASC),
  CONSTRAINT fk_pengadaan_user1
    FOREIGN KEY (user_id_user)
    REFERENCES users (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_pengadaan_vendor1
    FOREIGN KEY (vendor_idvendor)
    REFERENCES vendor (id_vendor)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE detail_pengadaan (
  iddetail_pengadaan BIGINT NOT NULL AUTO_INCREMENT,
  harga_satuan INT NULL,
  jumlah INT NULL,
  sub_total INT NULL,
  idbarang INT NOT NULL,
  idpengadaan BIGINT NOT NULL,
  PRIMARY KEY (iddetail_pengadaan),
  INDEX fk_detail_pengadaan_barang1_idx (idbarang ASC),
  INDEX fk_detail_pengadaan_pengadaan1_idx (idpengadaan ASC),
  CONSTRAINT fk_detail_pengadaan_barang1
    FOREIGN KEY (idbarang)
    REFERENCES barang (id_barang)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_detail_pengadaan_pengadaan1
    FOREIGN KEY (idpengadaan)
    REFERENCES pengadaan (id_pengadaan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE penerimaan (
  idpenerimaan BIGINT NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NULL,
  STATUS CHAR(1) NULL,
  idpengadaan BIGINT NOT NULL,
  iduser INT NOT NULL,
  PRIMARY KEY (idpenerimaan),
  INDEX fk_penerimaan_pengadaan1_idx (idpengadaan ASC),
  INDEX fk_penerimaan_user1_idx (iduser ASC),
  CONSTRAINT fk_penerimaan_pengadaan1
    FOREIGN KEY (idpengadaan)
    REFERENCES pengadaan (id_pengadaan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_penerimaan_user1
    FOREIGN KEY (iduser)
    REFERENCES users (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);
CREATE TABLE detail_penerimaan (
  iddetail_penerimaan BIGINT NOT NULL AUTO_INCREMENT,
  idpenerimaan BIGINT NOT NULL,
  barang_idbarang INT NOT NULL,
  jumlah_terima INT NULL,
  harga_satuan_terima INT NULL,
  sub_total_terima INT NULL,
  PRIMARY KEY (iddetail_penerimaan),
  INDEX fk_detail_penerimaan_barang1_idx (barang_idbarang ASC),
  INDEX fk_detail_penerimaan_penerimaan1_idx (idpenerimaan ASC),
  CONSTRAINT fk_detail_penerimaan_penerimaan1
    FOREIGN KEY (idpenerimaan)
    REFERENCES penerimaan (idpenerimaan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_detail_penerimaan_barang1
    FOREIGN KEY (barang_idbarang)
    REFERENCES barang (id_barang)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);



CREATE TABLE retur (
  idretur BIGINT NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NULL,
  idpenerimaan BIGINT NOT NULL,
  iduser INT NOT NULL,
  PRIMARY KEY (idretur),
  INDEX fk_retur_penerimaan1_idx (idpenerimaan ASC),
  INDEX fk_retur_user1_idx (iduser ASC),
  CONSTRAINT fk_retur_penerimaan1
    FOREIGN KEY (idpenerimaan)
    REFERENCES penerimaan (idpenerimaan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_retur_user1
    FOREIGN KEY (iduser)
    REFERENCES users (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE detail_retur (
  iddetail_retur INT NOT NULL AUTO_INCREMENT,
  jumlah INT NULL,
  alasan VARCHAR(200) NULL,
  idretur BIGINT NOT NULL,
  iddetail_penerimaan BIGINT NOT NULL,
  PRIMARY KEY (iddetail_retur),
  INDEX fk_detail_retur_retur1_idx (idretur ASC),
  INDEX fk_detail_retur_detail_penerimaan1_idx (iddetail_penerimaan ASC),
  CONSTRAINT fk_detail_retur_retur1
    FOREIGN KEY (idretur)
    REFERENCES retur (idretur)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_detail_retur_detail_penerimaan1
    FOREIGN KEY (iddetail_penerimaan)
    REFERENCES detail_penerimaan (iddetail_penerimaan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


CREATE TABLE margin_penjualan (
  idmargin_penjualan INT NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NULL,
  persen DOUBLE NULL,
  STATUS TINYINT NULL,
  iduser INT NOT NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY (idmargin_penjualan),
  INDEX fk_margin_penjualan_user1_idx (iduser ASC),
  CONSTRAINT fk_margin_penjualan_user1
    FOREIGN KEY (iduser)
    REFERENCES users (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE penjualan (
  idpenjualan INT NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NULL,
  subtotal_nilai INT NULL,
  ppn INT NULL,
  total_nilai INT NULL,
  iduser INT NOT NULL,
  idmargin_penjualan INT NOT NULL,
  PRIMARY KEY (idpenjualan),
  INDEX fk_penjualan_user1_idx (iduser ASC),
  INDEX fk_penjualan_margin_penjualan1_idx (idmargin_penjualan ASC),
  CONSTRAINT fk_penjualan_user1
    FOREIGN KEY (iduser)
    REFERENCES users (id_user)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_penjualan_margin_penjualan1
    FOREIGN KEY (idmargin_penjualan)
    REFERENCES margin_penjualan (idmargin_penjualan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE detail_penjualan (
  iddetail_penjualan BIGINT NOT NULL AUTO_INCREMENT,
  harga_satuan INT NULL,
  jumlah INT NULL,
  subtotal INT NULL,
  penjualan_idpenjualan INT NOT NULL,
  idbarang INT NOT NULL,
  PRIMARY KEY (iddetail_penjualan),
  INDEX fk_detail_penjualan_penjualan1_idx (penjualan_idpenjualan ASC),
  INDEX fk_detail_penjualan_barang1_idx (idbarang ASC),
  CONSTRAINT fk_detail_penjualan_penjualan1
    FOREIGN KEY (penjualan_idpenjualan)
    REFERENCES penjualan (idpenjualan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_detail_penjualan_barang1
    FOREIGN KEY (idbarang)
    REFERENCES barang (id_barang)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE kartu_stok (
  id_kartu_stok BIGINT NOT NULL AUTO_INCREMENT,
  jenis_transaksi CHAR(1) NULL,
  masuk INT NULL,
  keluar INT NULL,
  stock INT NULL,
  created_at TIMESTAMP NULL,
  idtransaksi INT NULL,
  idbarang INT NOT NULL,
  PRIMARY KEY (id_kartu_stok),
  INDEX fk_kartu_stok_barang1_idx (idbarang ASC),
  CONSTRAINT fk_kartu_stok_barang1
    FOREIGN KEY (idbarang)
    REFERENCES barang (id_barang)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);



DELIMITER //
CREATE PROCEDURE GetProcurementSummary(IN procurementID INT)
BEGIN
  SELECT 
    p.id_pengadaan,
    p.TIMESTAMP,
    u.username AS user_name,
    v.nama_vendor,
    COUNT(dp.iddetail_pengadaan) AS total_items,
    p.subtotal_nilai,
    p.ppn,
    p.total_nilai
  FROM pengadaan p
  JOIN users u ON p.user_id_user = u.id_user
  JOIN vendor v ON p.vendor_idvendor = v.id_vendor
  JOIN detail_pengadaan dp ON p.id_pengadaan = dp.idpengadaan
  WHERE p.id_pengadaan = procurementID;
END //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE GetSalesSummary(IN salesID INT)
BEGIN
  SELECT 
    ps.idpenjualan,
    ps.created_at,
    u.username AS user_name,
    ps.subtotal_nilai,
    ps.ppn,
    ps.total_nilai
  FROM penjualan ps
  JOIN users u ON ps.iduser = u.id_user
  WHERE ps.idpenjualan = salesID;
END //
DELIMITER ;

DELIMITER //
CREATE FUNCTION CalculateTotalSales(in_salesID INT) RETURNS INT
BEGIN
  DECLARE totalSales INT;
  SELECT SUM(subtotal) INTO totalSales
  FROM detail_penjualan
  WHERE penjualan_idpenjualan = in_salesID;
  RETURN totalSales;
END //
DELIMITER ;

CREATE VIEW ViewProcurementDetails AS
SELECT 
  p.id_pengadaan,
  p.TIMESTAMP,
  u.username AS user_name,
  v.nama_vendor,
  dp.iddetail_pengadaan,
  b.nama AS barang_name,
  dp.harga_satuan,
  dp.jumlah,
  dp.sub_total
FROM pengadaan p
JOIN users u ON p.user_id_user = u.id_user
JOIN vendor v ON p.vendor_idvendor = v.id_vendor
JOIN detail_pengadaan dp ON p.id_pengadaan = dp.idpengadaan
JOIN barang b ON dp.idbarang = b.id_barang;


CREATE VIEW ViewSalesDetails AS
SELECT 
  ps.idpenjualan,
  ps.created_at,
  u.username AS user_name,
  dp.iddetail_penjualan,
  b.nama AS barang_name,
  dp.harga_satuan,
  dp.jumlah,
  dp.subtotal
FROM penjualan ps
JOIN users u ON ps.iduser = u.id_user
JOIN detail_penjualan dp ON ps.idpenjualan = dp.penjualan_idpenjualan
JOIN barang b ON dp.idbarang = b.id_barang;

DELIMITER //
CREATE TRIGGER AfterInsertDetailPenjualan
AFTER INSERT ON detail_penjualan
FOR EACH ROW
BEGIN
  DECLARE stock INT;
  SELECT stock INTO stock
  FROM kartu_stok
  WHERE idbarang = NEW.idbarang
  ORDER BY created_at DESC
  LIMIT 1;

  INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, idtransaksi, idbarang)
  VALUES ('S', 0, NEW.jumlah, stock - NEW.jumlah, NOW(), NEW.penjualan_idpenjualan, NEW.idbarang);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE AddPurchase(IN p_user_id INT, IN p_vendor_id INT, IN p_items JSON)
BEGIN
    DECLARE item_id INT;
    DECLARE item_quantity INT;
    DECLARE item_price INT;
    
    START TRANSACTION;

    INSERT INTO pengadaan (`user_id_user`, `vendor_idvendor`, `status`, `timestamp`) 
    VALUES (p_user_id, p_vendor_id, 'P', NOW());

    SET item_id = JSON_UNQUOTE(JSON_EXTRACT(p_items, '$.idbarang'));
    SET item_quantity = JSON_UNQUOTE(JSON_EXTRACT(p_items, '$.quantity'));
    SET item_price = JSON_UNQUOTE(JSON_EXTRACT(p_items, '$.price'));

    INSERT INTO detail_pengadaan (`idbarang`, `idpengadaan`, `harga_satuan`, `jumlah`, `sub_total`) 
    VALUES (item_id, LAST_INSERT_ID(), item_price, item_quantity, item_price * item_quantity);

    COMMIT;
END //
DELIMITER ;


-- Tambahkan Role dan User:
INSERT INTO roles (nama_role, STATUS) VALUES ('Admin', 1);
INSERT INTO users (username, PASSWORD, email, idrole, STATUS) VALUES ('admin', 'admin123', 'admin@example.com', 1, 1);

-- Tambahkan Data ke Tabel Barang:
INSERT INTO satuan (nama_satuan, STATUS) VALUES ('PCS', 1);
INSERT INTO barang (jenis, nama, id_satuan, STATUS, harga) VALUES ('A', 'Barang A', 1, 1, 100);
INSERT INTO barang (jenis, nama, id_satuan, STATUS, harga) VALUES ('B', 'Barang B', 1, 1, 150);

-- Tambahkan Data ke Tabel Vendor:
INSERT INTO vendor (nama_vendor, badan_hukum, STATUS) VALUES ('Vendor A', 'Y', 'A');
INSERT INTO vendor (nama_vendor, badan_hukum, STATUS) VALUES ('Vendor B', 'N', 'B');

-- Tambahkan Data ke Tabel Pengadaan:
INSERT INTO pengadaan (user_id_user, STATUS, vendor_idvendor, subtotal_nilai, ppn, total_nilai, TIMESTAMP) 
VALUES (1, 'P', 1, 1000, 100, 1100, NOW());


-- Tambahkan Data ke Tabel Detail Pengadaan:
INSERT INTO detail_pengadaan (idbarang, idpengadaan, harga_satuan, jumlah, sub_total) 
VALUES (1, 1, 100, 5, 500);
INSERT INTO detail_pengadaan (idbarang, idpengadaan, harga_satuan, jumlah, sub_total) 
VALUES (2, 1, 150, 3, 450);

-- tambahkan data ke tabel penerimaan
INSERT INTO penerimaan (created_at, STATUS, idpengadaan, iduser) 
VALUES (NOW(), 'A', 1, 1);

-- Tambahkan Data ke Tabel Detail Penerimaan:
INSERT INTO detail_penerimaan (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima, sub_total_terima) 
VALUES (1, 1, 5, 100, 500);
INSERT INTO detail_penerimaan (idpenerimaan, barang_idbarang, jumlah_terima, harga_satuan_terima, sub_total_terima) 
VALUES (1, 2, 3, 150, 450);

-- Tambahkan Data ke Tabel Retur:
INSERT INTO retur (created_at, idpenerimaan, iduser) 
VALUES (NOW(), 1, 1);

-- Tambahkan Data ke Tabel Detail Retur:
INSERT INTO detail_retur (idretur, jumlah, alasan, iddetail_penerimaan) 
VALUES (1, 2, 'Barang cacat', 1);

-- Tambahkan Data ke Tabel Margin Penjualan:
INSERT INTO margin_penjualan (created_at, persen, STATUS, iduser, updated_at) 
VALUES (NOW(), 10, 1, 1, NOW());

-- Tambahkan Data ke Tabel Penjualan:
INSERT INTO penjualan (created_at, subtotal_nilai, ppn, total_nilai, iduser, idmargin_penjualan) 
VALUES (NOW(), 1000, 100, 1100, 1, 1);

-- Tambahkan Data ke Tabel Detail Penjualan:
INSERT INTO detail_penjualan (harga_satuan, jumlah, subtotal, penjualan_idpenjualan, idbarang) 
VALUES (100, 5, 500, 1, 1);
INSERT INTO detail_penjualan (harga_satuan, jumlah, subtotal, penjualan_idpenjualan, idbarang) 
VALUES (150, 3, 450, 1, 2);

-- Tambahkan Data ke Tabel Kartu Stok:
INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, idtransaksi, idbarang) 
VALUES ('S', 0, 5, -5, NOW(), 1, 1);
INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, idtransaksi, idbarang) 
VALUES ('S', 0, 3, -3, NOW(), 1, 2);

-- Menguji Stored Procedure GetProcurementSummary:
CALL GetProcurementSummary(1);

-- Menguji Stored Procedure GetSalesSummary:
CALL GetSalesSummary(1);

-- Menguji Function CalculateTotalSales:
SELECT CalculateTotalSales(1) AS total_sales;

-- Menguji View ViewProcurementDetails:
SELECT * FROM ViewProcurementDetails;

-- Menguji View ViewSalesDetails:
SELECT * FROM ViewSalesDetails;

-- Menguji Stored Procedure AddPurchase:
CALL AddPurchase(1, 1, '{"idbarang": 1, "quantity": 5, "price": 100}');

-- Menambahkan data ke tabel detail_penjualan


SELECT * FROM kartu_stok;