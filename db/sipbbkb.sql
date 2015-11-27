/*
Navicat MySQL Data Transfer

Source Server         : MysqlLocal
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : sipbbkb

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2015-11-28 00:40:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cl_bank`
-- ----------------------------
DROP TABLE IF EXISTS `cl_bank`;
CREATE TABLE `cl_bank` (
  `KdBank` int(11) NOT NULL AUTO_INCREMENT,
  `KdKabKot` int(11) DEFAULT NULL,
  `NmBank` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdBank`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_bank
-- ----------------------------
INSERT INTO `cl_bank` VALUES ('1', '6', 'Bank Mandiri');

-- ----------------------------
-- Table structure for `cl_jabatan_user`
-- ----------------------------
DROP TABLE IF EXISTS `cl_jabatan_user`;
CREATE TABLE `cl_jabatan_user` (
  `KdJabatan` int(11) NOT NULL AUTO_INCREMENT,
  `Jabatan` varchar(30) DEFAULT NULL,
  `KetJabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`KdJabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_jabatan_user
-- ----------------------------
INSERT INTO `cl_jabatan_user` VALUES ('1', 'Kepala Dinas', 'Kepala Dinas Pendapatan');
INSERT INTO `cl_jabatan_user` VALUES ('2', 'Kepala Bidang', 'Kepala Bidang Pajak');
INSERT INTO `cl_jabatan_user` VALUES ('3', 'Kepala Bidang', 'Kepala Bidang Pendapatan');

-- ----------------------------
-- Table structure for `cl_jenis_bahan_bakar`
-- ----------------------------
DROP TABLE IF EXISTS `cl_jenis_bahan_bakar`;
CREATE TABLE `cl_jenis_bahan_bakar` (
  `KdBB` int(11) NOT NULL AUTO_INCREMENT,
  `NmBB` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdBB`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_jenis_bahan_bakar
-- ----------------------------
INSERT INTO `cl_jenis_bahan_bakar` VALUES ('1', 'Premium');
INSERT INTO `cl_jenis_bahan_bakar` VALUES ('2', 'Pertamax Plus');
INSERT INTO `cl_jenis_bahan_bakar` VALUES ('3', 'Solar');
INSERT INTO `cl_jenis_bahan_bakar` VALUES ('4', 'Bio Solar');

-- ----------------------------
-- Table structure for `cl_jenis_perusahaan`
-- ----------------------------
DROP TABLE IF EXISTS `cl_jenis_perusahaan`;
CREATE TABLE `cl_jenis_perusahaan` (
  `KdJenCP` int(11) NOT NULL AUTO_INCREMENT,
  `NmJenCP` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdJenCP`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_jenis_perusahaan
-- ----------------------------
INSERT INTO `cl_jenis_perusahaan` VALUES ('1', 'PERTAMINA');
INSERT INTO `cl_jenis_perusahaan` VALUES ('2', 'NON-PERTAMINA');

-- ----------------------------
-- Table structure for `cl_jenis_pungutan`
-- ----------------------------
DROP TABLE IF EXISTS `cl_jenis_pungutan`;
CREATE TABLE `cl_jenis_pungutan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pungutan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_jenis_pungutan
-- ----------------------------
INSERT INTO `cl_jenis_pungutan` VALUES ('1', 'Subsidi');
INSERT INTO `cl_jenis_pungutan` VALUES ('2', 'JBU');
INSERT INTO `cl_jenis_pungutan` VALUES ('3', 'Sektor Industri');

-- ----------------------------
-- Table structure for `cl_kabupaten_kota`
-- ----------------------------
DROP TABLE IF EXISTS `cl_kabupaten_kota`;
CREATE TABLE `cl_kabupaten_kota` (
  `KdKabKot` int(11) NOT NULL AUTO_INCREMENT,
  `KdProv` int(11) DEFAULT NULL,
  `NmKabKot` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdKabKot`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_kabupaten_kota
-- ----------------------------
INSERT INTO `cl_kabupaten_kota` VALUES ('1', '1', 'Bintan');
INSERT INTO `cl_kabupaten_kota` VALUES ('2', '1', 'Karimun');
INSERT INTO `cl_kabupaten_kota` VALUES ('3', '1', 'Kepulauan Anambas');
INSERT INTO `cl_kabupaten_kota` VALUES ('4', '1', 'Lingga');
INSERT INTO `cl_kabupaten_kota` VALUES ('5', '1', 'Natuna');
INSERT INTO `cl_kabupaten_kota` VALUES ('6', '1', 'Batam');
INSERT INTO `cl_kabupaten_kota` VALUES ('7', '1', 'Tanjung Pinang');
INSERT INTO `cl_kabupaten_kota` VALUES ('8', '1', 'Kepulauan Riau');

-- ----------------------------
-- Table structure for `cl_klasifikasi_pbbkb`
-- ----------------------------
DROP TABLE IF EXISTS `cl_klasifikasi_pbbkb`;
CREATE TABLE `cl_klasifikasi_pbbkb` (
  `KdKlas` int(11) NOT NULL AUTO_INCREMENT,
  `NmKlas` varchar(30) DEFAULT NULL,
  `Persentasi` float DEFAULT NULL,
  `FieldAktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`KdKlas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_klasifikasi_pbbkb
-- ----------------------------
INSERT INTO `cl_klasifikasi_pbbkb` VALUES ('1', 'Pajak Minyak', '10', 'T');
INSERT INTO `cl_klasifikasi_pbbkb` VALUES ('2', 'Pajak Gas Bumi', '20', 'T');

-- ----------------------------
-- Table structure for `cl_klasifikasi_pbbkb_pertamina`
-- ----------------------------
DROP TABLE IF EXISTS `cl_klasifikasi_pbbkb_pertamina`;
CREATE TABLE `cl_klasifikasi_pbbkb_pertamina` (
  `KdKlasSec` int(11) NOT NULL AUTO_INCREMENT,
  `KdBB` int(11) DEFAULT NULL,
  `NmKlass` varchar(255) DEFAULT NULL,
  `Persentasi` float DEFAULT NULL,
  `FieldAktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`KdKlasSec`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_klasifikasi_pbbkb_pertamina
-- ----------------------------
INSERT INTO `cl_klasifikasi_pbbkb_pertamina` VALUES ('1', '1', 'Subsidi', '22', 'T');
INSERT INTO `cl_klasifikasi_pbbkb_pertamina` VALUES ('2', '2', 'JBU', '20', 'T');
INSERT INTO `cl_klasifikasi_pbbkb_pertamina` VALUES ('3', '3', 'Sektor Industri', '50', 'T');

-- ----------------------------
-- Table structure for `cl_level_user`
-- ----------------------------
DROP TABLE IF EXISTS `cl_level_user`;
CREATE TABLE `cl_level_user` (
  `KdLevel` int(11) NOT NULL AUTO_INCREMENT,
  `UserLevel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`KdLevel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_level_user
-- ----------------------------
INSERT INTO `cl_level_user` VALUES ('1', 'Super Admin');
INSERT INTO `cl_level_user` VALUES ('2', 'Admin');
INSERT INTO `cl_level_user` VALUES ('3', 'User');
INSERT INTO `cl_level_user` VALUES ('4', 'Guest');

-- ----------------------------
-- Table structure for `cl_provinsi`
-- ----------------------------
DROP TABLE IF EXISTS `cl_provinsi`;
CREATE TABLE `cl_provinsi` (
  `KdProv` int(11) NOT NULL AUTO_INCREMENT,
  `NmProvinsi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdProv`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_provinsi
-- ----------------------------
INSERT INTO `cl_provinsi` VALUES ('1', 'Kepulauan Riau');

-- ----------------------------
-- Table structure for `cl_tahun_pajak`
-- ----------------------------
DROP TABLE IF EXISTS `cl_tahun_pajak`;
CREATE TABLE `cl_tahun_pajak` (
  `ThnPajak` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ThnPajak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_tahun_pajak
-- ----------------------------
INSERT INTO `cl_tahun_pajak` VALUES ('2014');
INSERT INTO `cl_tahun_pajak` VALUES ('2015');
INSERT INTO `cl_tahun_pajak` VALUES ('2016');

-- ----------------------------
-- Table structure for `cl_tingkat_daerah_pengguna`
-- ----------------------------
DROP TABLE IF EXISTS `cl_tingkat_daerah_pengguna`;
CREATE TABLE `cl_tingkat_daerah_pengguna` (
  `KdTk` int(11) NOT NULL AUTO_INCREMENT,
  `KetTk` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdTk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cl_tingkat_daerah_pengguna
-- ----------------------------
INSERT INTO `cl_tingkat_daerah_pengguna` VALUES ('1', 'Provinsi');
INSERT INTO `cl_tingkat_daerah_pengguna` VALUES ('2', 'Kabupaten / Kota');

-- ----------------------------
-- Table structure for `target_pajak`
-- ----------------------------
DROP TABLE IF EXISTS `target_pajak`;
CREATE TABLE `target_pajak` (
  `ThnPajak` int(11) NOT NULL DEFAULT '0',
  `TargetTaxAPBD` float DEFAULT NULL,
  `TargetTaxAPBDP` float DEFAULT NULL,
  PRIMARY KEY (`ThnPajak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of target_pajak
-- ----------------------------
INSERT INTO `target_pajak` VALUES ('2015', '2222320000000', '323232000000');

-- ----------------------------
-- Table structure for `tbl_denda`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_denda`;
CREATE TABLE `tbl_denda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `JenisDenda` varchar(200) DEFAULT NULL,
  `Persen` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_denda
-- ----------------------------
INSERT INTO `tbl_denda` VALUES ('1', 'Keterlambatan', '2');

-- ----------------------------
-- Table structure for `tbl_lembaga_pengguna_owner`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lembaga_pengguna_owner`;
CREATE TABLE `tbl_lembaga_pengguna_owner` (
  `KdDinas` int(11) NOT NULL AUTO_INCREMENT,
  `NmDinas` varchar(50) DEFAULT NULL,
  `AdssDinas` text,
  `KdKabKot` int(11) DEFAULT NULL,
  `KdTk` varchar(4) DEFAULT NULL,
  `KdUser` int(11) DEFAULT NULL,
  `KdUser2` int(11) DEFAULT NULL,
  `nama_kepala_dinas` varchar(255) DEFAULT NULL,
  `nama_kepala_seksi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`KdDinas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_lembaga_pengguna_owner
-- ----------------------------
INSERT INTO `tbl_lembaga_pengguna_owner` VALUES ('1', 'Dinas Perhubungan', 'Jl. Sam Ratulangi 8', '6', '2', null, null, 'Sahrul Anwar', 'Awang');

-- ----------------------------
-- Table structure for `tbl_pembayaran_pungutan_bank`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pembayaran_pungutan_bank`;
CREATE TABLE `tbl_pembayaran_pungutan_bank` (
  `RecNo3` int(11) NOT NULL AUTO_INCREMENT,
  `KdCP3` int(11) DEFAULT NULL,
  `TglInput3` date DEFAULT NULL,
  `TglBankPaid` date DEFAULT NULL,
  `TaxBulan3` smallint(6) DEFAULT NULL,
  `TaxThn3` smallint(6) DEFAULT NULL,
  `KdBank` int(11) DEFAULT NULL,
  `QtyBB3` int(11) DEFAULT NULL,
  `Pay3` float DEFAULT NULL,
  `Tax3` float DEFAULT NULL,
  `BankPaid` float DEFAULT NULL,
  `denda` float DEFAULT NULL,
  `jml_bln_denda` int(11) DEFAULT NULL,
  PRIMARY KEY (`RecNo3`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_pembayaran_pungutan_bank
-- ----------------------------
INSERT INTO `tbl_pembayaran_pungutan_bank` VALUES ('8', '1', '2015-11-28', '2015-12-26', '11', '2015', '1', '1500', '50000000', '6000000', '6120000', '120000', '1');

-- ----------------------------
-- Table structure for `tbl_punggut_pbbkb_pertamina`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_punggut_pbbkb_pertamina`;
CREATE TABLE `tbl_punggut_pbbkb_pertamina` (
  `RecNo2` int(11) NOT NULL AUTO_INCREMENT,
  `TglInput2` date DEFAULT NULL,
  `TglLaporan2` date DEFAULT NULL,
  `TaxBulan2` smallint(6) DEFAULT NULL,
  `TaxThn2` smallint(6) DEFAULT NULL,
  `KdCP2` int(11) DEFAULT NULL,
  `KdWP2` int(11) DEFAULT NULL,
  `KdBB2` int(11) DEFAULT NULL,
  `QtyBB2` int(11) DEFAULT NULL,
  `Pay2` float DEFAULT NULL,
  `KdKlas2` int(11) DEFAULT NULL,
  `Tax2` float DEFAULT NULL,
  `flag_data` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`RecNo2`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_punggut_pbbkb_pertamina
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi`;
CREATE TABLE `tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi` (
  `RecNo4` int(11) NOT NULL AUTO_INCREMENT,
  `TglInput4` date DEFAULT NULL,
  `TglLaporan4` date DEFAULT NULL,
  `TaxBulan4` smallint(6) DEFAULT NULL,
  `TaxThn4` smallint(6) DEFAULT NULL,
  `KdCP4` int(11) DEFAULT NULL,
  `KdBB4` int(11) DEFAULT NULL,
  `QtyBB4` int(11) DEFAULT NULL,
  `Pay4` float DEFAULT NULL,
  `KdKlasSec4` int(11) DEFAULT NULL,
  `Tax4` float DEFAULT NULL,
  `jenis_pungutan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`RecNo4`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi
-- ----------------------------
INSERT INTO `tbl_punggut_pbbkb_pertamina_subsidi_nonsubsidi` VALUES ('14', '2015-11-27', '2015-11-27', '11', '2015', '1', '2', '600', '560000', '3', '280000', null);

-- ----------------------------
-- Table structure for `tbl_punggut_pbbkb_pertamina_wil_klas_sektor`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_punggut_pbbkb_pertamina_wil_klas_sektor`;
CREATE TABLE `tbl_punggut_pbbkb_pertamina_wil_klas_sektor` (
  `RecNo2` int(11) NOT NULL AUTO_INCREMENT,
  `TglInput2` date DEFAULT NULL,
  `TglLaporan2` date DEFAULT NULL,
  `TaxBulan2` smallint(6) DEFAULT NULL,
  `TaxThn2` smallint(6) DEFAULT NULL,
  `KdCP2` int(11) DEFAULT NULL,
  `KdWP2` int(11) DEFAULT NULL,
  `KdBB2` int(11) DEFAULT NULL,
  `QtyBB2` int(11) DEFAULT NULL,
  `Pay2` float DEFAULT NULL,
  `KdKlas2` int(11) DEFAULT NULL,
  `Tax2` float DEFAULT NULL,
  `flag_data` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`RecNo2`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_punggut_pbbkb_pertamina_wil_klas_sektor
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_pungutan_pbbkb`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pungutan_pbbkb`;
CREATE TABLE `tbl_pungutan_pbbkb` (
  `RecNo` int(11) NOT NULL AUTO_INCREMENT,
  `TglInput` date DEFAULT NULL,
  `TglLaporan` date DEFAULT NULL,
  `TaxBulan` smallint(6) DEFAULT NULL,
  `TaxThn` smallint(6) DEFAULT NULL,
  `KdCP` int(11) DEFAULT NULL,
  `KdWP` int(11) DEFAULT NULL,
  `KdBB` int(11) DEFAULT NULL,
  `QtyBB` int(11) DEFAULT NULL,
  `Pay` float DEFAULT NULL,
  `KdKlas` int(11) DEFAULT NULL,
  `Tax` float DEFAULT NULL,
  PRIMARY KEY (`RecNo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_pungutan_pbbkb
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `KdUser` int(11) NOT NULL AUTO_INCREMENT,
  `KdLevel` int(11) DEFAULT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserNm` varchar(30) DEFAULT NULL,
  `KdJabatan` int(11) DEFAULT NULL,
  `TglAwal` date DEFAULT NULL,
  `TglAkhir` date DEFAULT NULL,
  `RecAktif` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`KdUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', '1', 'admin', 'w8nRgzJ8q9W6/04js1nnJwKOHTideqmajzAcg7qmotOyPsh99akca9HqPPuK9U0A8po69U8txljPE/dGpyPTNg==', 'Administrator', '2', '2015-03-13', '2015-03-13', 'T');
INSERT INTO `tbl_user` VALUES ('2', '2', 'staff_admin', 'AcvBvgThENXhiuen7sd07xGgXgM/710phssFlsQkfyo79f58G9UikJtCXbfMREmxX/MKGFEN1IRWy2J8tjQlVw==', 'Staff Admin Dinas Pendapatan', '1', '2015-03-13', '2015-03-13', 'T');

-- ----------------------------
-- Table structure for `tbl_wajib_pajak_non_pertamina`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wajib_pajak_non_pertamina`;
CREATE TABLE `tbl_wajib_pajak_non_pertamina` (
  `KdWP` int(11) NOT NULL AUTO_INCREMENT,
  `NmWP` varchar(50) DEFAULT NULL,
  `AdssWP` text,
  `KdKabKot` int(11) DEFAULT NULL,
  `NoSIUP` varchar(30) DEFAULT NULL,
  `LastDateSIUP` date DEFAULT NULL,
  `NoNPWP` varchar(30) DEFAULT NULL,
  `NmOwner` varchar(30) DEFAULT NULL,
  `OwnerAdss` text,
  `OwnerIdentity` varchar(30) DEFAULT NULL,
  `KdPW` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`KdWP`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_wajib_pajak_non_pertamina
-- ----------------------------
INSERT INTO `tbl_wajib_pajak_non_pertamina` VALUES ('1', 'PT. Pertamina EP', 'Jl. Sudirman Said 7', '1', '787987987987', '2015-03-25', '432545234534', 'PT. MAS', 'Jl. Perdatam 41C', '413241324324', 'T');

-- ----------------------------
-- Table structure for `tbl_wajib_pajak_pertamina_daerah`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wajib_pajak_pertamina_daerah`;
CREATE TABLE `tbl_wajib_pajak_pertamina_daerah` (
  `KdWP` int(11) NOT NULL AUTO_INCREMENT,
  `NmWP` varchar(50) DEFAULT NULL,
  `AdssWP` text,
  `KdKabKot` int(11) DEFAULT NULL,
  `WPNoSIUP` varchar(30) DEFAULT NULL,
  `WPLastDateSIUP` date DEFAULT NULL,
  `WPNoNPWP` varchar(30) DEFAULT NULL,
  `NmOwner` varchar(30) DEFAULT NULL,
  `OwnerAdss` text,
  `KdKlasifikas` varchar(10) DEFAULT NULL,
  `KdJenCP` int(11) DEFAULT NULL,
  `OwnerIdentity` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdWP`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_wajib_pajak_pertamina_daerah
-- ----------------------------
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('1', 'PT. Pertamina Tanjungpinang ', 'Jl. Test', '6', '989898989898', '2015-03-23', '123982398239', 'Pemerintah', 'Jl. Batam', '1', '1', '55454545454');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('2', 'PT Pertamina Batam', 'Jl. Tanjung Pinang', '6', '21321331232321323', '2015-03-23', '123434123434234324', 'Pemerintah', 'Jl. Satu Kota', '1', '2', '3672673627362763');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('3', 'PT Pertamina Bintan', 'Jl. Niaga Hoster', '6', '989377377373737', '2015-03-23', '2134324234344343', 'Pemerintah', 'Jl. Pemerintah Satu', '2', '2', '1324254354325435');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('4', 'PT Pertamina Karimun', 'Jl. Persadaisme', '6', '568576878678768768', '2015-03-23', '75654645646456456', 'Pemerintah', 'Jl. Soekarno Hatta', '1', '2', '7365436456534656');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('5', 'PT Pertamina Lingga', 'Jl. Moch. Kahfi II', '6', '6564536645634564', '2015-03-17', '123131423434244', 'Pemerintah', 'Jl. Sungai Raya', '1', '2', '99999999999999');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('6', 'PT Pertamina Natuna', 'Jl. Niago Hosting', '6', '62463463465436456', '2015-03-23', '63413243243432143', 'Pemerintah', 'Jl. Pemerintah Satu', '2', '2', '9789989789789');
INSERT INTO `tbl_wajib_pajak_pertamina_daerah` VALUES ('7', 'PT Pertamina Anambas', 'Jl. Database 7', '6', '898768766576', '2015-03-23', '235243453454', 'Pemerintah', 'Jl. Soekarno Hatta', '1', '2', '12345234546567');

-- ----------------------------
-- Table structure for `tbl_wajib_pungut_non_pertamina`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wajib_pungut_non_pertamina`;
CREATE TABLE `tbl_wajib_pungut_non_pertamina` (
  `KdCP` int(11) NOT NULL AUTO_INCREMENT,
  `NmCP` varchar(50) DEFAULT NULL,
  `AdssCP` text,
  `KdKabKot` int(11) DEFAULT NULL,
  `WPNoSIUP` varchar(30) DEFAULT NULL,
  `WPLastDateSIUP` date DEFAULT NULL,
  `WPNoNPWP` varchar(30) DEFAULT NULL,
  `NmOwner` varchar(30) DEFAULT NULL,
  `OwnerAdss` text,
  `KdKlasifikas` varchar(10) DEFAULT NULL,
  `KdJenCP` int(11) DEFAULT NULL,
  `OwnerIdentity` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`KdCP`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_wajib_pungut_non_pertamina
-- ----------------------------
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('1', 'PT Pertamina', 'Jl. Test', '6', '989898989898', '2015-03-23', '123982398239', 'Pemerintah', 'Jl. Batam', '1', '1', '55454545454');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('2', 'PT Cosmic', 'Jl. Tanjung Pinang', '6', '21321331232321323', '2015-03-23', '123434123434234324', 'Hang Tuah', 'Jl. Satu Kota', '1', '2', '3672673627362763');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('3', 'PT Patra Niaga', 'Jl. Niaga Hoster', '6', '989377377373737', '2015-03-23', '2134324234344343', 'Pemerintah', 'Jl. Pemerintah Satu', '2', '2', '1324254354325435');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('4', 'PT Yafindo Sumber Persada', 'Jl. Persadaisme', '6', '568576878678768768', '2015-03-23', '75654645646456456', 'Bp. Soekarno', 'Jl. Soekarno Hatta', '1', '2', '7365436456534656');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('5', 'PT Jagad Energy', 'Jl. Moch. Kahfi II', '6', '6564536645634564', '2015-03-17', '123131423434244', 'Tyo Sungeb', 'Jl. Sungai Raya', '1', '2', '99999999999999');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('6', 'PT Prayasa Indo Mitra Sarana', 'Jl. Niago Hosting', '6', '62463463465436456', '2015-03-23', '63413243243432143', 'Bp. Soekarno', 'Jl. Pemerintah Satu', '2', '2', '9789989789789');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('7', 'PT SUNRISE SUNSET', 'Jl. Database 7', '6', '898768766576', '2015-03-23', '235243453454', 'Bp. Soekarno', 'Jl. Soekarno Hatta', '1', '2', '12345234546567');
INSERT INTO `tbl_wajib_pungut_non_pertamina` VALUES ('8', 'PT. Bahari Berkah', 'Jl. Berkah 7', '6', '66667767676767', '2015-03-23', '32423532455545', 'Hang Tuah', 'Jl. Soekarno Hatta', '1', '2', '98769697976987');

-- ----------------------------
-- Table structure for `tbl_wajib_pungut_pertamina_wil`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wajib_pungut_pertamina_wil`;
CREATE TABLE `tbl_wajib_pungut_pertamina_wil` (
  `KdCP` int(11) NOT NULL AUTO_INCREMENT,
  `NmCP` varchar(50) DEFAULT NULL,
  `AdssCP` text,
  `KdKabKot` int(11) DEFAULT NULL,
  `NoSIUP` varchar(30) DEFAULT NULL,
  `LastDateSIUP` date DEFAULT NULL,
  `NoNPWP` varchar(30) DEFAULT NULL,
  `NmOwner` varchar(30) DEFAULT NULL,
  `OwnerAdss` text,
  `OwnerIdentity` varchar(30) DEFAULT NULL,
  `KdPW` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`KdCP`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_wajib_pungut_pertamina_wil
-- ----------------------------
INSERT INTO `tbl_wajib_pungut_pertamina_wil` VALUES ('1', 'Pertamina Wilayah I Medan', 'Jl. Sudirman Said 7', '1', '787987987987', '2015-03-25', '432545234534', 'PT. MAS', 'Jl. Perdatam 41C', '413241324324', 'T');
