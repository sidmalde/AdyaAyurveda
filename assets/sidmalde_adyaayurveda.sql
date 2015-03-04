/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : sidmalde_adyaayurveda

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-01-22 01:13:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for acos
-- ----------------------------
DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`),
  KEY `idx_acos_model_foreign_key` (`model`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acos
-- ----------------------------

-- ----------------------------
-- Table structure for appointments
-- ----------------------------
DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `label` varchar(30) DEFAULT NULL,
  `details` text,
  `start` varchar(255) DEFAULT NULL,
  `end` varchar(255) DEFAULT NULL,
  `send_email_reminder` tinyint(1) DEFAULT NULL,
  `send_sms_reminder` tinyint(1) DEFAULT NULL,
  `email_reminder_sent` tinyint(1) DEFAULT NULL,
  `sms_reminder_sent` tinyint(1) DEFAULT NULL,
  `colour` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appointments
-- ----------------------------

-- ----------------------------
-- Table structure for aros
-- ----------------------------
DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` char(36) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` char(36) DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`),
  KEY `idx_aros_model_foreign_key` (`model`,`foreign_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aros
-- ----------------------------
INSERT INTO `aros` VALUES ('1', null, 'Group', '52346d30-68f8-4e91-b19b-1368d96041f1', '', '1', '2');
INSERT INTO `aros` VALUES ('2', null, 'Group', '5234723b-bdbc-4e50-930c-1368d96041f1', '', '3', '4');

-- ----------------------------
-- Table structure for aros_acos
-- ----------------------------
DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_aros_acos_aro_id_aco_id` (`aro_id`,`aco_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aros_acos
-- ----------------------------

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `iso` char(2) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `eu_member` char(1) DEFAULT 'N',
  `position` int(3) DEFAULT '999',
  `phone_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('94', 'Monaco', 'MC', 'MCO', 'Y', '999', '+377');
INSERT INTO `countries` VALUES ('93', 'Pakistan', 'PK', 'PAK', 'N', '999', '+92');
INSERT INTO `countries` VALUES ('92', 'Nigeria', 'NG', 'NGA', 'N', '999', '+234');
INSERT INTO `countries` VALUES ('91', 'Japan', 'JP', 'JPN', 'N', '999', '+81');
INSERT INTO `countries` VALUES ('90', 'Indonesia', 'ID', 'IDN', 'N', '999', '+62');
INSERT INTO `countries` VALUES ('89', 'Egypt', 'EG', 'EGY', 'N', '999', '+20');
INSERT INTO `countries` VALUES ('88', 'Algeria', 'DZ', 'DZA', 'N', '999', '+213');
INSERT INTO `countries` VALUES ('87', 'Zimbabwe', 'ZW', 'ZWE', 'N', '999', '+263');
INSERT INTO `countries` VALUES ('86', 'Uzbekistan', 'UZ', 'UZB', 'N', '999', '+998');
INSERT INTO `countries` VALUES ('85', 'United Arab Emirates', 'AE', 'ARE', 'N', '999', '+971');
INSERT INTO `countries` VALUES ('84', 'Uganda', 'UG', 'UGA', 'N', '999', '+256');
INSERT INTO `countries` VALUES ('83', 'Turkey', 'TR', 'TUR', 'N', '999', '+90');
INSERT INTO `countries` VALUES ('82', 'Tunisia', 'TN', 'TUN', 'N', '999', '+216');
INSERT INTO `countries` VALUES ('81', 'Togo', 'TG', 'TGO', 'N', '999', '+228');
INSERT INTO `countries` VALUES ('80', 'Thailand', 'TH', 'THA', 'N', '999', '+66');
INSERT INTO `countries` VALUES ('79', 'Tanzania, United Republic of', 'TZ', 'TZA', 'N', '999', '+255');
INSERT INTO `countries` VALUES ('78', 'Taiwan, Province of China', 'TW', 'TWN', 'N', '999', '+886');
INSERT INTO `countries` VALUES ('77', 'Syrian Arab Republic', 'SY', 'SYR', 'N', '999', '+963');
INSERT INTO `countries` VALUES ('76', 'Switzerland', 'CH', 'CHE', 'N', '999', '+41');
INSERT INTO `countries` VALUES ('75', 'Sweden', 'SE', 'SWE', 'Y', '999', '+46');
INSERT INTO `countries` VALUES ('74', 'Sudan', 'SD', 'SDN', 'N', '999', '+249');
INSERT INTO `countries` VALUES ('73', 'Sri Lanka', 'LK', 'LKA', 'N', '999', '+94');
INSERT INTO `countries` VALUES ('72', 'Spain', 'ES', 'ESP', 'Y', '5', '+34');
INSERT INTO `countries` VALUES ('71', 'South Africa', 'ZA', 'ZAF', 'N', '999', '+27');
INSERT INTO `countries` VALUES ('70', 'Singapore', 'SG', 'SGP', 'N', '999', '+65');
INSERT INTO `countries` VALUES ('69', 'Seychelles', 'SC', 'SYC', 'N', '999', '+248');
INSERT INTO `countries` VALUES ('68', 'Senegal', 'SN', 'SEN', 'N', '999', '+221');
INSERT INTO `countries` VALUES ('67', 'Saudi Arabia', 'SA', 'SAU', 'N', '999', '+966');
INSERT INTO `countries` VALUES ('66', 'Rwanda', 'RW', 'RWA', 'N', '999', '+250');
INSERT INTO `countries` VALUES ('65', 'Réunion', 'RE', 'REU', 'N', '999', '+262');
INSERT INTO `countries` VALUES ('64', 'Qatar', 'QA', 'QAT', 'N', '999', '+974');
INSERT INTO `countries` VALUES ('63', 'Portugal', 'PT', 'PRT', 'Y', '999', '+357');
INSERT INTO `countries` VALUES ('62', 'Poland', 'PL', 'POL', 'Y', '999', '+48');
INSERT INTO `countries` VALUES ('61', 'Philippines', 'PH', 'PHL', 'N', '999', '+63');
INSERT INTO `countries` VALUES ('60', 'Papua New Guinea', 'PG', 'PNG', 'N', '999', '+675');
INSERT INTO `countries` VALUES ('59', 'Oman', 'OM', 'OMN', 'N', '999', '+968');
INSERT INTO `countries` VALUES ('58', 'Norway', 'NO', 'NOR', 'N', '999', '+47');
INSERT INTO `countries` VALUES ('57', 'New Zealand', 'NZ', 'NZL', 'N', '999', '+64');
INSERT INTO `countries` VALUES ('56', 'New Caledonia', 'NC', 'NCL', 'N', '999', '+687');
INSERT INTO `countries` VALUES ('55', 'Netherlands', 'NL', 'NLD', 'Y', '7', '+31');
INSERT INTO `countries` VALUES ('54', 'Namibia', 'NA', 'NAM', 'N', '999', '+264');
INSERT INTO `countries` VALUES ('53', 'Mozambique', 'MZ', 'MOZ', 'N', '999', '+258');
INSERT INTO `countries` VALUES ('52', 'Moldova, Republic of', 'MD', 'MDA', 'N', '999', '+373');
INSERT INTO `countries` VALUES ('51', 'Mauritius', 'MU', 'MUS', 'N', '999', '+230');
INSERT INTO `countries` VALUES ('50', 'Malta', 'MT', 'MLT', 'Y', '999', '+356');
INSERT INTO `countries` VALUES ('49', 'Malaysia', 'MY', 'MYS', 'N', '999', '+60');
INSERT INTO `countries` VALUES ('48', 'Malawi', 'MW', 'MWI', 'N', '999', '+265');
INSERT INTO `countries` VALUES ('47', 'Madagascar', 'MG', 'MDG', 'N', '999', '+261');
INSERT INTO `countries` VALUES ('46', 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 'N', '999', '+389');
INSERT INTO `countries` VALUES ('45', 'Macao', 'MO', 'MAC', 'N', '999', '+853');
INSERT INTO `countries` VALUES ('44', 'Luxembourg', 'LU', 'LUX', 'Y', '999', '+352');
INSERT INTO `countries` VALUES ('43', 'Liberia', 'LR', 'LBR', 'N', '999', '+231');
INSERT INTO `countries` VALUES ('42', 'Lesotho', 'LS', 'LSO', 'N', '999', '+266');
INSERT INTO `countries` VALUES ('41', 'Lebanon', 'LB', 'LBN', 'N', '999', '+961');
INSERT INTO `countries` VALUES ('40', 'Lao People\'s Democratic Republic', 'LA', 'LAO', 'N', '999', '+856');
INSERT INTO `countries` VALUES ('39', 'Kuwait', 'KW', 'KWT', 'N', '999', '+965');
INSERT INTO `countries` VALUES ('38', 'Jordan', 'JO', 'JOR', 'N', '999', '+962');
INSERT INTO `countries` VALUES ('37', 'Italy', 'IT', 'ITA', 'Y', '4', '+39');
INSERT INTO `countries` VALUES ('36', 'Ireland', 'IE', 'IRL', 'Y', '999', '+353');
INSERT INTO `countries` VALUES ('35', 'Iraq', 'IQ', 'IRQ', 'N', '999', '+964');
INSERT INTO `countries` VALUES ('34', 'Iran', 'IR', 'IRN', 'N', '999', '+98');
INSERT INTO `countries` VALUES ('33', 'India', 'IN', 'IND', 'N', '999', '+91');
INSERT INTO `countries` VALUES ('32', 'Iceland', 'IS', 'ISL', 'N', '999', '+354');
INSERT INTO `countries` VALUES ('31', 'Hong Kong', 'HK', 'HKG', 'N', '999', '+852');
INSERT INTO `countries` VALUES ('30', 'Greenland', 'GL', 'GRL', 'N', '999', '+299');
INSERT INTO `countries` VALUES ('29', 'Greece', 'GR', 'GRC', 'Y', '999', '+30');
INSERT INTO `countries` VALUES ('28', 'Gibraltar', 'GI', 'GIB', 'N', '999', '+350');
INSERT INTO `countries` VALUES ('27', 'Ghana', 'GH', 'GHA', 'N', '999', '+233');
INSERT INTO `countries` VALUES ('26', 'Germany', 'DE', 'DEU', 'Y', '6', '+49');
INSERT INTO `countries` VALUES ('25', 'French Polynesia', 'PF', 'PYF', 'N', '999', '+689');
INSERT INTO `countries` VALUES ('24', 'France', 'FR', 'FRA', 'Y', '2', '+33');
INSERT INTO `countries` VALUES ('23', 'Finland', 'FI', 'FIN', 'Y', '999', '+358');
INSERT INTO `countries` VALUES ('22', 'Fiji', 'FJ', 'FJI', 'N', '999', '+679');
INSERT INTO `countries` VALUES ('21', 'Ethiopia', 'ET', 'ETH', 'N', '999', '+251');
INSERT INTO `countries` VALUES ('20', 'Denmark', 'DK', 'DNK', 'Y', '999', '+45');
INSERT INTO `countries` VALUES ('19', 'Cyprus', 'CY', 'CYP', 'Y', '999', '+357');
INSERT INTO `countries` VALUES ('18', 'Cote D\'Ivoire', 'CI', 'CIV', 'N', '999', '+225');
INSERT INTO `countries` VALUES ('17', 'China', 'CN', 'CHN', 'N', '999', '+86');
INSERT INTO `countries` VALUES ('16', 'Chile', 'CL', 'CHL', 'N', '999', '+56');
INSERT INTO `countries` VALUES ('15', 'Cape Verde', 'CV', 'CPV', 'N', '999', '+238');
INSERT INTO `countries` VALUES ('14', 'Canada', 'CA', 'CAN', 'N', '999', '+1');
INSERT INTO `countries` VALUES ('13', 'Cameroon', 'CM', 'CMR', 'N', '999', '+237');
INSERT INTO `countries` VALUES ('12', 'Cambodia', 'KH', 'KHM', 'N', '999', '+855');
INSERT INTO `countries` VALUES ('11', 'Brunei Darussalam', 'BN', 'BRN', 'N', '999', '+673');
INSERT INTO `countries` VALUES ('10', 'Botswana', 'BW', 'BWA', 'N', '999', '+267');
INSERT INTO `countries` VALUES ('9', 'Belgium', 'BE', 'BEL', 'Y', '3', '+32');
INSERT INTO `countries` VALUES ('8', 'Bahrain', 'BH', 'BHR', 'N', '999', '+973');
INSERT INTO `countries` VALUES ('7', 'Azerbaijan', 'AZ', 'AZE', 'N', '999', '+994');
INSERT INTO `countries` VALUES ('6', 'Austria', 'AT', 'AUT', 'Y', '999', '+43');
INSERT INTO `countries` VALUES ('5', 'Australia', 'AU', 'AUS', 'N', '999', '+61');
INSERT INTO `countries` VALUES ('4', 'Armenia', 'AM', 'ARM', 'N', '999', '+374');
INSERT INTO `countries` VALUES ('3', 'Andorra', 'AD', 'AND', 'N', '8', '+376');
INSERT INTO `countries` VALUES ('2', 'United States', 'US', 'USA', 'N', '999', '+1');
INSERT INTO `countries` VALUES ('1', 'United Kingdom', 'GB', 'GBR', 'Y', '1', '+44');
INSERT INTO `countries` VALUES ('95', 'Antigua and Barbuda', 'AG', 'ATG', 'N', '999', '+1268');
INSERT INTO `countries` VALUES ('96', 'Belarus', 'BY', 'BLR', 'N', '999', '+375');
INSERT INTO `countries` VALUES ('97', 'Bosnia and Herzegovina', 'BA', 'BIH', 'N', '999', '+387');
INSERT INTO `countries` VALUES ('98', 'Cocos (Keeling) Islands', 'CC', 'CCK', 'N', '999', '+672');
INSERT INTO `countries` VALUES ('99', 'Congo, the Democratic Republic of the', 'CD', 'COD', 'N', '999', '+242');
INSERT INTO `countries` VALUES ('100', 'Korea, Democratic People\'s Republic of (North Korea)', 'KP', 'PRK', 'N', '999', '+850');
INSERT INTO `countries` VALUES ('101', 'Korea, Republic of (South Korea)', 'KR', 'KOR', 'N', '999', '+82');
INSERT INTO `countries` VALUES ('102', 'Wallis and Futuna', 'WF', 'WLF', 'N', '999', '+681');
INSERT INTO `countries` VALUES ('103', 'Virgin Islands, British', 'VG', 'VGB', 'N', '999', '+1284');
INSERT INTO `countries` VALUES ('104', 'Virgin Islands, U.s.', 'VI', 'VIR', 'N', '999', '+1340');
INSERT INTO `countries` VALUES ('105', 'Mexico', 'MX', 'MEX', 'N', '999', '+52');
INSERT INTO `countries` VALUES ('106', 'Micronesia, Federated States of', 'FM', 'FSM', 'N', '999', '+691');
INSERT INTO `countries` VALUES ('107', 'Myanmar', 'MM', 'MMR', 'N', '999', '+95');
INSERT INTO `countries` VALUES ('108', 'Palestinian Territory, Occupied', 'PS', 'PSE', 'N', '999', '+970');
INSERT INTO `countries` VALUES ('109', 'Pitcairn Islands', 'PN', 'PCN', 'N', '999', '+0');
INSERT INTO `countries` VALUES ('110', 'Saint Helena', 'SH', 'SHN', 'N', '999', '+290');
INSERT INTO `countries` VALUES ('111', 'Saint Kitts and Nevis', 'KN', 'KNA', 'N', '999', '+1869');
INSERT INTO `countries` VALUES ('112', 'Saint Pierre and Miquelon', 'PM', 'SPM', 'N', '999', '+508');
INSERT INTO `countries` VALUES ('113', 'São Tomé and Príncipe', 'ST', 'STP', 'N', '999', '+239');
INSERT INTO `countries` VALUES ('114', 'Serbia', 'RS', 'SRB', 'N', '999', '+381');
INSERT INTO `countries` VALUES ('115', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 'N', '999', '+0');
INSERT INTO `countries` VALUES ('116', 'Timor-Leste', 'TL', 'TLS', 'N', '999', '+670');
INSERT INTO `countries` VALUES ('117', 'Trinidad and Tobago', 'TT', 'TTO', 'N', '999', '+1868');
INSERT INTO `countries` VALUES ('118', 'American Samoa', 'AS', 'ASM', 'N', '999', '+1684');
INSERT INTO `countries` VALUES ('119', 'Vanuatu', 'VU', 'VUT', 'N', '999', '+678');
INSERT INTO `countries` VALUES ('120', 'Albania', 'AL', 'ALB', 'N', '999', '+355');
INSERT INTO `countries` VALUES ('121', 'Yemen', 'YE', 'YEM', 'N', '999', '+967');
INSERT INTO `countries` VALUES ('122', 'Angola', 'AO', 'AGO', 'N', '999', '+244');
INSERT INTO `countries` VALUES ('123', 'Anguilla', 'AI', 'AIA', 'N', '999', '+1264');
INSERT INTO `countries` VALUES ('124', 'Aruba', 'AW', 'ABW', 'N', '999', '+297');
INSERT INTO `countries` VALUES ('125', 'Bahamas', 'BS', 'BHS', 'N', '999', '+1242');
INSERT INTO `countries` VALUES ('126', 'Barbados', 'BB', 'BRB', 'N', '999', '+1246');
INSERT INTO `countries` VALUES ('127', 'Bermuda', 'BM', 'BMU', 'N', '999', '+1441');
INSERT INTO `countries` VALUES ('128', 'Bolivia', 'BO', 'BOL', 'N', '999', '+591');
INSERT INTO `countries` VALUES ('129', 'Brazil', 'BR', 'BRA', 'N', '999', '+55');
INSERT INTO `countries` VALUES ('130', 'British Indian Ocean Territory', 'IO', 'IOT', 'N', '999', '+246');
INSERT INTO `countries` VALUES ('131', 'Burkina Faso', 'BF', 'BFA', 'N', '999', '+226');
INSERT INTO `countries` VALUES ('132', 'Argentina', 'AR', 'ARG', 'N', '999', '+54');
INSERT INTO `countries` VALUES ('133', 'Bangladesh', 'BD', 'BGD', 'N', '999', '+880');
INSERT INTO `countries` VALUES ('134', 'Benin', 'BJ', 'BEN', 'N', '999', '+229');
INSERT INTO `countries` VALUES ('135', 'Bhutan', 'BT', 'BTN', 'N', '999', '+975');
INSERT INTO `countries` VALUES ('136', 'Bulgaria', 'BG', 'BGR', 'Y', '999', '+359');
INSERT INTO `countries` VALUES ('137', 'Burundi', 'BI', 'BDI', 'N', '999', '+257');
INSERT INTO `countries` VALUES ('138', 'French Guiana', 'GF', 'GUF', 'N', '999', '+567');
INSERT INTO `countries` VALUES ('139', 'Cayman Islands', 'KY', 'CYM', 'N', '999', '+1345');
INSERT INTO `countries` VALUES ('140', 'Chad', 'TD', 'TCD', 'N', '999', '+235');
INSERT INTO `countries` VALUES ('141', 'Christmas Island', 'CX', 'CXR', 'N', '999', '+61');
INSERT INTO `countries` VALUES ('142', 'Colombia', 'CO', 'COL', 'N', '999', '+57');
INSERT INTO `countries` VALUES ('143', 'Cook Islands', 'CK', 'COK', 'N', '999', '+682');
INSERT INTO `countries` VALUES ('144', 'Dominica', 'DM', 'DMA', 'N', '999', '+1767');
INSERT INTO `countries` VALUES ('145', 'Dominican Republic', 'DO', 'DOM', 'N', '999', '+1809');
INSERT INTO `countries` VALUES ('146', 'Ecuador', 'EC', 'ECU', 'N', '999', '+593');
INSERT INTO `countries` VALUES ('147', 'Faroe Islands', 'FO', 'FRO', 'N', '999', '+298');
INSERT INTO `countries` VALUES ('148', 'Gabon', 'GA', 'GAB', 'N', '999', '+241');
INSERT INTO `countries` VALUES ('149', 'Guadeloupe', 'GP', 'GLP', 'N', '999', '+590');
INSERT INTO `countries` VALUES ('150', 'Grenada', 'GD', 'GRD', 'N', '999', '+1473');
INSERT INTO `countries` VALUES ('151', 'Comoros', 'KM', 'COM', 'N', '999', '+269');
INSERT INTO `countries` VALUES ('152', 'Costa Rica', 'CR', 'CRI', 'N', '999', '+506');
INSERT INTO `countries` VALUES ('153', 'Croatia', 'HR', 'HRV', 'N', '999', '+385');
INSERT INTO `countries` VALUES ('154', 'Cuba', 'CU', 'CUB', 'N', '999', '+53');
INSERT INTO `countries` VALUES ('155', 'Czech Republic', 'CZ', 'CZE', 'Y', '999', '+420');
INSERT INTO `countries` VALUES ('156', 'Djibouti', 'DJ', 'DJI', 'N', '999', '+253');
INSERT INTO `countries` VALUES ('157', 'Equatorial Guinea', 'GQ', 'GNQ', 'N', '999', '+240');
INSERT INTO `countries` VALUES ('158', 'Eritrea', 'ER', 'ERI', 'N', '999', '+291');
INSERT INTO `countries` VALUES ('159', 'Estonia', 'EE', 'EST', 'Y', '999', '+372');
INSERT INTO `countries` VALUES ('160', 'Gambia', 'GM', 'GMB', 'N', '999', '+220');
INSERT INTO `countries` VALUES ('161', 'Georgia', 'GE', 'GEO', 'N', '999', '+995');
INSERT INTO `countries` VALUES ('162', 'Guatemala', 'GT', 'GTM', 'N', '999', '+502');
INSERT INTO `countries` VALUES ('163', 'Guam', 'GU', 'GUM', 'N', '999', '+1671');
INSERT INTO `countries` VALUES ('164', 'Guinea-Bissau', 'GW', 'GNB', 'N', '999', '+245');
INSERT INTO `countries` VALUES ('165', 'Haiti', 'HT', 'HTI', 'N', '999', '+509');
INSERT INTO `countries` VALUES ('166', 'Hungary', 'HU', 'HUN', 'Y', '999', '+36');
INSERT INTO `countries` VALUES ('167', 'Israel', 'IL', 'ISR', 'N', '999', '+972');
INSERT INTO `countries` VALUES ('168', 'Jamaica', 'JM', 'JAM', 'N', '999', '+1876');
INSERT INTO `countries` VALUES ('169', 'Kiribati', 'KI', 'KIR', 'N', '999', '+686');
INSERT INTO `countries` VALUES ('170', 'Kyrgyzstan', 'KG', 'KGZ', 'N', '999', '+996');
INSERT INTO `countries` VALUES ('171', 'Latvia', 'LV', 'LVA', 'Y', '999', '+371');
INSERT INTO `countries` VALUES ('172', 'Libyan Arab Jamahiriya', 'LY', 'LBY', 'N', '999', '+218');
INSERT INTO `countries` VALUES ('173', 'Lithuania', 'LT', 'LTU', 'Y', '999', '+370');
INSERT INTO `countries` VALUES ('174', 'Guinea', 'GN', 'GIN', 'N', '999', '+224');
INSERT INTO `countries` VALUES ('175', 'Guyana', 'GY', 'GUY', 'N', '999', '+592');
INSERT INTO `countries` VALUES ('176', 'Honduras', 'HN', 'HND', 'N', '999', '+504');
INSERT INTO `countries` VALUES ('177', 'Kazakhstan', 'KZ', 'KAZ', 'N', '999', '+7');
INSERT INTO `countries` VALUES ('178', 'Kenya', 'KE', 'KEN', 'N', '999', '+254');
INSERT INTO `countries` VALUES ('179', 'Mali', 'ML', 'MLI', 'N', '999', '+223');
INSERT INTO `countries` VALUES ('180', 'Martinique', 'MQ', 'MTQ', 'N', '999', '+596');
INSERT INTO `countries` VALUES ('181', 'Mayotte', 'YT', 'MYT', 'N', '999', '+269');
INSERT INTO `countries` VALUES ('182', 'Mongolia', 'MN', 'MNG', 'N', '999', '+976');
INSERT INTO `countries` VALUES ('183', 'Montserrat', 'MS', 'MSR', 'N', '999', '+1664');
INSERT INTO `countries` VALUES ('184', 'Nepal', 'NP', 'NPL', 'N', '999', '+977');
INSERT INTO `countries` VALUES ('185', 'Niger', 'NE', 'NER', 'N', '999', '+227');
INSERT INTO `countries` VALUES ('186', 'Niue', 'NU', 'NIU', 'N', '999', '+683');
INSERT INTO `countries` VALUES ('187', 'Norfolk Island', 'NF', 'NFK', 'N', '999', '+672');
INSERT INTO `countries` VALUES ('188', 'Maldives', 'MV', 'MDV', 'N', '999', '+960');
INSERT INTO `countries` VALUES ('189', 'Marshall Islands', 'MH', 'MHL', 'N', '999', '+692');
INSERT INTO `countries` VALUES ('190', 'Morocco', 'MA', 'MAR', 'N', '999', '+212');
INSERT INTO `countries` VALUES ('191', 'Nauru', 'NR', 'NRU', 'N', '999', '+674');
INSERT INTO `countries` VALUES ('192', 'Nicaragua', 'NI', 'NIC', 'N', '999', '+505');
INSERT INTO `countries` VALUES ('193', 'Turks and Caicos Islands', 'TC', 'TCA', 'N', '999', '+1649');
INSERT INTO `countries` VALUES ('194', 'Palau', 'PW', 'PLW', 'N', '999', '+680');
INSERT INTO `countries` VALUES ('195', 'Panama', 'PA', 'PAN', 'N', '999', '+507');
INSERT INTO `countries` VALUES ('196', 'Paraguay', 'PY', 'PRY', 'N', '999', '+595');
INSERT INTO `countries` VALUES ('197', 'Peru', 'PE', 'PER', 'N', '999', '+51');
INSERT INTO `countries` VALUES ('198', 'Romania', 'RO', 'ROM', 'Y', '999', '+40');
INSERT INTO `countries` VALUES ('199', 'Northern Mariana Islands', 'MP', 'MNP', 'N', '999', '+1670');
INSERT INTO `countries` VALUES ('200', 'Puerto Rico', 'PR', 'PRI', 'N', '999', '+1787');
INSERT INTO `countries` VALUES ('201', 'Russian Federation', 'RU', 'RUS', 'N', '999', '+70');
INSERT INTO `countries` VALUES ('202', 'Saint Lucia', 'LC', 'LCA', 'N', '999', '+1758');
INSERT INTO `countries` VALUES ('203', 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'N', '999', '+1784');
INSERT INTO `countries` VALUES ('204', 'Slovakia', 'SK', 'SVK', 'Y', '999', '+421');
INSERT INTO `countries` VALUES ('205', 'Slovenia', 'SI', 'SVN', 'Y', '999', '+386');
INSERT INTO `countries` VALUES ('206', 'Somalia', 'SO', 'SOM', 'N', '999', '+252');
INSERT INTO `countries` VALUES ('207', 'Suriname', 'SR', 'SUR', 'N', '999', '+597');
INSERT INTO `countries` VALUES ('208', 'Tokelau', 'TK', 'TKL', 'N', '999', '+690');
INSERT INTO `countries` VALUES ('209', 'Tonga', 'TO', 'TON', 'N', '999', '+676');
INSERT INTO `countries` VALUES ('210', 'Turkmenistan', 'TM', 'TKM', 'N', '999', '+7370');
INSERT INTO `countries` VALUES ('211', 'Samoa', 'WS', 'WSM', 'N', '999', '+684');
INSERT INTO `countries` VALUES ('212', 'San Marino', 'SM', 'SMR', 'N', '999', '+378');
INSERT INTO `countries` VALUES ('213', 'Sierra Leone', 'SL', 'SLE', 'N', '999', '+232');
INSERT INTO `countries` VALUES ('214', 'Solomon Islands', 'SB', 'SLB', 'N', '999', '+677');
INSERT INTO `countries` VALUES ('215', 'Swaziland', 'SZ', 'SWZ', 'N', '999', '+268');
INSERT INTO `countries` VALUES ('216', 'Tuvalu', 'TV', 'TUV', 'N', '999', '+688');
INSERT INTO `countries` VALUES ('217', 'Ukraine', 'UA', 'UKR', 'N', '999', '+380');
INSERT INTO `countries` VALUES ('218', 'Uruguay', 'UY', 'URY', 'N', '999', '+598');
INSERT INTO `countries` VALUES ('219', 'Venezuela', 'VE', 'VEN', 'N', '999', '+58');
INSERT INTO `countries` VALUES ('220', 'Vietnam', 'VN', 'VNM', 'N', '999', '+84');
INSERT INTO `countries` VALUES ('221', 'Zambia', 'ZM', 'ZMB', 'N', '999', '+260');
INSERT INTO `countries` VALUES ('222', 'Western Sahara', 'EH', 'ESH', 'N', '999', '+212');
INSERT INTO `countries` VALUES ('223', 'Afghanistan', 'AF', 'AFG', 'N', '999', '+93');
INSERT INTO `countries` VALUES ('224', 'El Salvador', 'SV', 'SLV', 'N', '999', '+503');
INSERT INTO `countries` VALUES ('225', 'Falkland Islands (Malvinas)', 'FK', 'FLK', 'N', '999', '+500');
INSERT INTO `countries` VALUES ('226', 'Belize', 'BZ', 'BLZ', 'N', '999', '+501');
INSERT INTO `countries` VALUES ('227', 'Central African Republic', 'CF', 'CAF', 'N', '999', '+236');
INSERT INTO `countries` VALUES ('228', 'Liechtenstein', 'LI', 'LIE', 'N', '999', '+423');
INSERT INTO `countries` VALUES ('229', 'Mauritania', 'MR', 'MRT', 'N', '999', '+222');
INSERT INTO `countries` VALUES ('230', 'Tajikistan', 'TJ', 'TJK', 'N', '999', '+992');
INSERT INTO `countries` VALUES ('231', 'Netherlands Antilles', 'AN', 'ANT', 'N', '999', '+599');
INSERT INTO `countries` VALUES ('232', 'Congo', 'CG', 'COG', 'N', '999', '+242');
INSERT INTO `countries` VALUES ('233', 'Guernsey ', 'GG', 'GGY', 'N', '999', '+44');
INSERT INTO `countries` VALUES ('234', 'Jersey', 'JE', 'JEY', 'N', '999', '+44');
INSERT INTO `countries` VALUES ('235', 'Isle of Man', 'IM', 'IMN', 'N', '999', '+44');

-- ----------------------------
-- Table structure for diseases
-- ----------------------------
DROP TABLE IF EXISTS `diseases`;
CREATE TABLE `diseases` (
  `id` char(36) NOT NULL DEFAULT '',
  `disease` varchar(200) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of diseases
-- ----------------------------
INSERT INTO `diseases` VALUES ('529e7deb-61d0-4cae-8454-14d4d96041f1', 'Lung Cancer', 'Lung Cancer - alivioli', '2013-12-04 00:57:15', '2013-12-04 01:01:04');

-- ----------------------------
-- Table structure for forum_categories
-- ----------------------------
DROP TABLE IF EXISTS `forum_categories`;
CREATE TABLE `forum_categories` (
  `id` char(36) NOT NULL DEFAULT '',
  `parent_forum_category_id` char(36) DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `description` text,
  `publish` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of forum_categories
-- ----------------------------

-- ----------------------------
-- Table structure for forum_posts
-- ----------------------------
DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE `forum_posts` (
  `id` char(36) NOT NULL DEFAULT '',
  `ref` int(11) DEFAULT NULL,
  `forum_topic_id` char(36) DEFAULT NULL,
  `parent_forum_post_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `system_status_id` char(36) DEFAULT NULL,
  `post` text,
  `ip` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of forum_posts
-- ----------------------------

-- ----------------------------
-- Table structure for forum_topics
-- ----------------------------
DROP TABLE IF EXISTS `forum_topics`;
CREATE TABLE `forum_topics` (
  `id` char(36) NOT NULL DEFAULT '',
  `forum_category_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `sticky` tinyint(1) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of forum_topics
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` char(36) CHARACTER SET ascii NOT NULL,
  `name` varchar(140) CHARACTER SET ascii DEFAULT NULL,
  `description` text CHARACTER SET ascii,
  `deleted` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('52346d30-68f8-4e91-b19b-1368d96041f1', 'Administrators', 'System Administrators with full access to system functions.', '0', '2013-09-14 14:05:36', '2013-09-14 14:05:36');
INSERT INTO `groups` VALUES ('5234723b-bdbc-4e50-930c-1368d96041f1', 'Patients', 'Patients', '0', '2013-09-14 14:27:07', '2013-09-14 14:27:07');

-- ----------------------------
-- Table structure for knowledge_base_articles
-- ----------------------------
DROP TABLE IF EXISTS `knowledge_base_articles`;
CREATE TABLE `knowledge_base_articles` (
  `id` char(36) NOT NULL DEFAULT '',
  `modality_id` char(36) DEFAULT NULL,
  `disease_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `dpr` varchar(30) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text,
  `admin` tinyint(1) DEFAULT '1',
  `readonly` tinyint(1) DEFAULT '1',
  `featured` tinyint(1) DEFAULT '0',
  `views` int(9) DEFAULT '0',
  `display_order` int(6) DEFAULT NULL,
  `feedback` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of knowledge_base_articles
-- ----------------------------
INSERT INTO `knowledge_base_articles` VALUES ('52c06a09-70dc-4161-9912-1874d96041f1', '529e34ec-f26c-47ca-b098-14d4d96041f1', '529e7deb-61d0-4cae-8454-14d4d96041f1', null, null, 'Lung Cancer Yoga', null, 'Lung Cancer Yoga', '1', '1', '0', '0', null, '0', '2013-12-29 18:29:29', '2013-12-29 18:30:22');
INSERT INTO `knowledge_base_articles` VALUES ('52c06a14-34ec-46c0-9f6d-1874d96041f1', '529e7855-9dd8-4eb9-a537-14d4d96041f1', '529e7deb-61d0-4cae-8454-14d4d96041f1', null, null, 'Lung Cancer Diet', null, 'Lung Cancer Diet', '1', '1', '0', '0', null, '0', '2013-12-29 18:29:40', '2013-12-29 18:29:40');
INSERT INTO `knowledge_base_articles` VALUES ('52c06a22-0680-40d6-8bb5-1874d96041f1', '52c069ad-12b8-4d77-9679-1874d96041f1', '529e7deb-61d0-4cae-8454-14d4d96041f1', null, null, 'Lung Cancer Test', null, 'Lung Cancer Test', '1', '1', '0', '0', null, '0', '2013-12-29 18:29:54', '2013-12-29 18:29:54');
INSERT INTO `knowledge_base_articles` VALUES ('52c06a2c-be64-42c6-ae69-1874d96041f1', '52c069ea-3cd8-4dce-a904-1874d96041f1', '529e7deb-61d0-4cae-8454-14d4d96041f1', null, null, 'Lung Cancer Test 2', null, 'Lung Cancer Test 2', '1', '1', '0', '0', null, '0', '2013-12-29 18:30:04', '2013-12-29 18:37:44');

-- ----------------------------
-- Table structure for knowledge_base_article_tags
-- ----------------------------
DROP TABLE IF EXISTS `knowledge_base_article_tags`;
CREATE TABLE `knowledge_base_article_tags` (
  `id` char(36) NOT NULL,
  `knowledge_base_article_id` char(36) DEFAULT NULL,
  `knowledge_base_tag_id` char(36) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of knowledge_base_article_tags
-- ----------------------------

-- ----------------------------
-- Table structure for knowledge_base_tags
-- ----------------------------
DROP TABLE IF EXISTS `knowledge_base_tags`;
CREATE TABLE `knowledge_base_tags` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of knowledge_base_tags
-- ----------------------------

-- ----------------------------
-- Table structure for modalities
-- ----------------------------
DROP TABLE IF EXISTS `modalities`;
CREATE TABLE `modalities` (
  `id` char(36) NOT NULL DEFAULT '',
  `modality` varchar(200) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modalities
-- ----------------------------
INSERT INTO `modalities` VALUES ('529e34ec-f26c-47ca-b098-14d4d96041f1', 'Yoga', 'Yoga', '2013-12-03 19:45:48', '2013-12-03 19:45:48');
INSERT INTO `modalities` VALUES ('529e7855-9dd8-4eb9-a537-14d4d96041f1', 'Diet', '', '2013-12-04 00:33:25', '2013-12-04 00:33:25');
INSERT INTO `modalities` VALUES ('52c069ad-12b8-4d77-9679-1874d96041f1', 'Test', 'Test 1', '2013-12-29 18:27:57', '2013-12-29 18:27:57');
INSERT INTO `modalities` VALUES ('52c069ea-3cd8-4dce-a904-1874d96041f1', 'Test 2', 'Test 2', '2013-12-29 18:28:58', '2013-12-29 18:28:58');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `patient_id` char(36) DEFAULT NULL,
  `status_id` char(36) DEFAULT NULL,
  `ref` int(10) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `test` (`ref`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `label` varchar(200) DEFAULT NULL,
  `notes` text,
  `sub_total` decimal(9,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_items
-- ----------------------------
INSERT INTO `order_items` VALUES ('52a98669-3e34-46ac-b1bc-0050d96041f1', '52a98669-fb90-465b-bfb0-0050d96041f1', '52a8bb72-1294-435d-b8ad-0050d96041f1', null, '1 times a day', '79.99', '2013-12-12 09:48:25', '2013-12-12 10:01:17');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` char(36) NOT NULL DEFAULT '',
  `parent_page_id` char(36) DEFAULT NULL,
  `meta_keywords` varchar(100) DEFAULT NULL,
  `meta_description` varchar(156) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `content` text,
  `tags` varchar(255) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '0',
  `position` int(2) DEFAULT NULL,
  `seo_priority` decimal(3,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('52bf00e3-9900-4ef8-841b-1874d96041f1', null, 'Homepage, Welcome, Adya-Ayurveda', 'Homepage of Adya-Ayurveda', '', 'Welcome to Adya-Ayurveda', '/', '<h3 class=\"panel-title\">About Vaidya Sarita and Adya Ayurveda</h3>\r\n\r\n<p>Vaidya (Physician) Sarita Nahar holds the successful Adya\r\nAyurveda pulse reading clinics in Stanmore and Southall, \r\nNorthwest London.</p>\r\n			\r\n<p>Sarita has been practicing the ancient science of pulse \r\ndiagnosis and ayurvedic treatment since the year 2000, \r\nlearning it with world-renowned pulse masters Drâ€™s Pankaj \r\nand Smita Naram. Sarita holds a BA in Ayurvedic Studies, \r\nthe first degree of its kind issued by a UK university.</p>\r\n			\r\n<p>Adya Ayurveda works on correcting the root cause of disease,\r\nand therefore can help to alleviate or eliminate a wide \r\nrange of conditions. It fosters natural healing, vibrant \r\nhealth and energy.</p>', null, '0', '1', '0.80', '2013-12-28 16:48:35', '2013-12-30 00:40:41');
INSERT INTO `pages` VALUES ('52bf057c-059c-4595-8aee-1874d96041f1', null, '', '', 'Consultations', 'Pulse Reading Consultations', '/pulse-reading-consultations', '<p>In the consultation, Vaidya Sarita reads the pulse of the patient. \r\nIn this way she obtains a detailed picture of the patient\'s physical, \r\nmental and emotional state. She will also prescribe natural herbal \r\nsupplements as well as adjustments and refinements to diet, and \r\nexplain the treatment in detail, in dialogue with the patient.</p>\r\n\r\n<p>First time consultations last for up to one hour; follow up \r\nconsultations for up to 40 minutes.</p>\r\n\r\n<p><strong>Consultation Fees are charged per person</strong>\r\n<ul>\r\n	<li>First time consultation: Â£50</li>\r\n	<li>Follow up consultation: Â£30</li>\r\n	<li>For children under 10 years: Â£25 (charged for first time as well as follow up consultation)</li>\r\n	<li>Telephone follow up consultation: Â£15</li>\r\n</ul></p>\r\n<p>All Consultations are by prior appointment only.</p>', null, '0', '2', '0.64', '2013-12-28 17:08:12', '2013-12-28 17:08:12');
INSERT INTO `pages` VALUES ('52bf64d0-b9dc-4867-9434-1874d96041f1', null, '', '', 'Venues', 'Adya-Ayurveda Venues', '/venues', '<div id=\"map-canvas\"></div>\r\n<div class=\"col-sm-6 box-border-sm\">\r\n   <h3 class=\"panel-title\">Stanmore Clinic</h3>\r\n   <p><ul>\r\n				<li>Consultations are held in a private room at the \"Natural Health Options\" Food Store in Stanmore.</li>\r\n				<li>Address: Natural Health Options, 4 Buckingham Parade, The Broadway, Stanmore, HA7 4EB.</li>\r\n				<li>Car parking is available at the Sainsburys or Lidl car parks, 100 yards away.</li>\r\n				<li>Stanmore Underground Station, which is the terminus for the Jubilee Underground Line, is 600 yards away.</li>\r\n				<li>The Broadway Bus stop is 150 yards away and is served by bus lines 142, 324, 340, H12.</li>\r\n				<li>Clinic days are usually Tuesdays and Saturdays.</li>\r\n			</ul>\r\n<a class=\"viewMap\" data-latlng=\"51.618047, -0.311307\">&nbsp;</a>\r\n</p>\r\n</div>\r\n\r\n<div class=\"col-sm-6  box-border-sm\">\r\n   <h3 class=\"panel-title\">Southall Clinic</h3>\r\n   <p><ul>\r\n				<li>Consultations are held in a dedicated clinic space.</li>\r\n				<li>Address: Number 192 A, Park Avenue, Southall, UB1 3AN. Number 192 A is located at the back of no 192 (the main property), entrance is on the alleyway running on the right side of the main property.</li>\r\n				<li>Car Parking is available closely, on Green Drive, which is the road leading up to the clinic location. ( Park Avenue is resident\'s parking only.)</li>\r\n				<li>Southall Rail Station is half a mile walk away, served by trains on the London Paddington/ Slough line.</li>\r\n				<li>Dormer\'s Well Lane or Southall Park Bus Stops are both located on the Uxbridge Road about 500 yards walk away, served by bus lines 195, 207, 427.</li>\r\n				<li>Clinic days are usually Wednesdays, Thursdays and Fridays.</li>\r\n			</ul>\r\n<a class=\"viewMap\" data-latlng=\"24.778260, 46.802809\">&nbsp;</a></p>\r\n</div>\r\n<div class=\"clear\"></div>', null, '0', '3', '0.80', '2013-12-28 23:54:56', '2013-12-29 00:35:37');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` char(36) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL,
  `description` text,
  `code` varchar(10) DEFAULT NULL,
  `barcode` varchar(30) DEFAULT NULL,
  `quantity` int(6) DEFAULT '3',
  `measurement` varchar(20) DEFAULT '0',
  `price` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('52a8baed-639c-41ba-ba56-0050d96041f1', 'Triphala', 'Triphala\r\nl', 'TRI001', '0123456789', '30', 'Capsules', '29.99', '2013-12-11 19:20:13', '2013-12-11 19:32:38');
INSERT INTO `products` VALUES ('52a8bb72-1294-435d-b8ad-0050d96041f1', 'Amla', 'Amla', 'AML001', '0123456789', '60', 'Capsules', '39.99', '2013-12-11 19:22:26', '2013-12-11 19:22:26');
INSERT INTO `products` VALUES ('52a8bba0-18e0-47e2-b791-0050d96041f1', 'Hemp Seed Oil', 'Hemp Seed Oil', 'HEM001', '0123456789', '50', 'Millilitres', '14.49', '2013-12-11 19:23:12', '2013-12-11 19:23:12');

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int(2) NOT NULL DEFAULT '0',
  `status_type_id` char(36) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `level` enum('Major','Minor') DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of statuses
-- ----------------------------

-- ----------------------------
-- Table structure for system_models
-- ----------------------------
DROP TABLE IF EXISTS `system_models`;
CREATE TABLE `system_models` (
  `id` char(36) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_models
-- ----------------------------

-- ----------------------------
-- Table structure for system_statuses
-- ----------------------------
DROP TABLE IF EXISTS `system_statuses`;
CREATE TABLE `system_statuses` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `system_model_id` char(36) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_statuses
-- ----------------------------

-- ----------------------------
-- Table structure for uploads
-- ----------------------------
DROP TABLE IF EXISTS `uploads`;
CREATE TABLE `uploads` (
  `id` char(36) NOT NULL DEFAULT '',
  `user_id` char(36) DEFAULT NULL,
  `model_id` char(36) DEFAULT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `description` text,
  `filename` varchar(255) DEFAULT NULL,
  `content_type` varchar(30) DEFAULT NULL,
  `filesize` int(10) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `downloads` int(10) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uploads
-- ----------------------------
INSERT INTO `uploads` VALUES ('52aef41e-a570-414b-955e-14d4d96041f1', '5234bf86-77b8-4c0a-a26b-1368d96041f1', '5263f49e-0cc4-4350-a098-1600d96041f1', 'User', 'header.JPG', null, 'header.JPG', 'image/jpeg', '23492', '/files/users/5263f49e-0cc4-4350-a098-1600d96041f1/header.JPG', '0', '0', '2013-12-16 12:37:50', '2013-12-16 12:37:50');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` char(36) CHARACTER SET ascii NOT NULL,
  `group_id` char(36) CHARACTER SET ascii DEFAULT NULL,
  `email` varchar(200) CHARACTER SET ascii DEFAULT NULL,
  `password` varchar(120) CHARACTER SET ascii DEFAULT NULL,
  `title` varchar(8) CHARACTER SET ascii DEFAULT NULL,
  `firstname` varchar(120) CHARACTER SET ascii DEFAULT NULL,
  `lastname` varchar(120) CHARACTER SET ascii DEFAULT NULL,
  `address_1` varchar(40) DEFAULT NULL,
  `address_2` varchar(40) DEFAULT NULL,
  `address_3` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `region` varchar(40) DEFAULT NULL,
  `postcode` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `patient_type` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(13) CHARACTER SET ascii DEFAULT NULL,
  `mobile` varchar(13) CHARACTER SET ascii DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5234bf86-77b8-4c0a-a26b-1368d96041f1', '52346d30-68f8-4e91-b19b-1368d96041f1', 'sidmalde@gmail.com', '8f0b478e52c3525b307509026afa7f0a170a25f1', 'Mr', 'Sid', 'Malde', '', '', '', '', '', '', '', '0000-00-00', 'Adult', 'Mal', '447545976559', '447545976559', '1', '0', '2013-09-14 19:56:54', '2013-10-20 14:47:23');
INSERT INTO `users` VALUES ('5263f49e-0cc4-4350-a098-1600d96041f1', '5234723b-bdbc-4e50-930c-1368d96041f1', 'test@test.com', '8f0b478e52c3525b307509026afa7f0a170a25f1', 'Mr', 'Test', 'Testee', '', '', '', '', '', '', '', '0000-00-00', 'Adult', 'Fem', '000', '000', '1', '0', '2013-10-20 15:19:58', '2013-12-16 12:37:50');
INSERT INTO `users` VALUES ('52c05dd0-aaac-44c5-9171-07e258d0f9c0', '52346d30-68f8-4e91-b19b-1368d96041f1', 'sarita_nahar@hotmail.com', '505da1a0b294902aa6158ea4dddebda90098bf27', 'Ms', 'Sarita', 'Nahar', '', '', '', '', '', '', '', null, '', 'Fem', '000', '000', '1', '0', '2013-12-29 17:37:20', '2013-12-29 17:37:20');

-- ----------------------------
-- Table structure for user_data_fields
-- ----------------------------
DROP TABLE IF EXISTS `user_data_fields`;
CREATE TABLE `user_data_fields` (
  `id` char(36) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `field_name` varchar(200) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `values` text,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_data_fields
-- ----------------------------
INSERT INTO `user_data_fields` VALUES ('5234b5cf-7f78-487e-aff9-1368d96041f1', 'Both', 'marital_status', 'list', 'Single, Married, Partnership, Divorced, Widowed', 'Patient\'s Marital status', '2013-09-14 19:15:27', '2013-09-14 19:15:27');
INSERT INTO `user_data_fields` VALUES ('5263ef5d-eb90-40c9-9935-1600d96041f1', 'Female', 'gynaec_fmc', 'text', '', 'Gynaec FMC', '2013-10-20 14:57:33', '2013-10-20 14:57:33');
INSERT INTO `user_data_fields` VALUES ('5263ef74-1de4-4935-a7fd-1600d96041f1', 'Female', 'gynaec_cycle', 'text', '', 'Gynaec Cycle', '2013-10-20 14:57:56', '2013-10-20 14:57:56');
INSERT INTO `user_data_fields` VALUES ('5263ef9b-bf68-4d63-8151-1600d96041f1', 'Female', 'gynaec_flow', 'text', '', 'Gynaec Flow', '2013-10-20 14:58:35', '2013-10-20 14:58:35');
INSERT INTO `user_data_fields` VALUES ('5263f03a-09b0-4547-a71b-1600d96041f1', 'Both', 'urination', 'text', '', 'Urination', '2013-10-20 15:01:14', '2013-10-20 15:01:14');
INSERT INTO `user_data_fields` VALUES ('5263f04e-6e28-47e2-9725-1600d96041f1', 'Both', 'sleep', 'text', '', 'Sleep', '2013-10-20 15:01:34', '2013-10-20 15:01:34');
INSERT INTO `user_data_fields` VALUES ('5263f0bc-bb14-4475-8e2f-1600d96041f1', 'Male', 'prostate', 'text', '', 'Prostate', '2013-10-20 15:03:24', '2013-10-20 15:03:24');
INSERT INTO `user_data_fields` VALUES ('5263f0ee-8ac0-4cff-9614-1600d96041f1', 'Both', 'pulse_reading', 'textarea', '', 'Pulse Reading', '2013-10-20 15:04:14', '2013-10-20 15:04:14');

-- ----------------------------
-- Table structure for user_data_values
-- ----------------------------
DROP TABLE IF EXISTS `user_data_values`;
CREATE TABLE `user_data_values` (
  `id` char(36) NOT NULL DEFAULT '',
  `user_data_field_id` char(36) DEFAULT NULL,
  `user_data_field_value` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_data_values
-- ----------------------------

-- ----------------------------
-- Table structure for user_notes
-- ----------------------------
DROP TABLE IF EXISTS `user_notes`;
CREATE TABLE `user_notes` (
  `id` char(36) NOT NULL DEFAULT '',
  `creator_id` char(36) DEFAULT NULL,
  `user_id` char(36) DEFAULT NULL,
  `summary` varchar(120) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_notes
-- ----------------------------
INSERT INTO `user_notes` VALUES ('5263e6c3-3b5c-466c-9685-1600d96041f1', '5234bf86-77b8-4c0a-a26b-1368d96041f1', '5234bf86-77b8-4c0a-a26b-1368d96041f1', 'Test Note', 'CHeck this out !', '2013-10-20 14:20:51', '2013-10-20 14:47:22');

-- ----------------------------
-- Table structure for websites
-- ----------------------------
DROP TABLE IF EXISTS `websites`;
CREATE TABLE `websites` (
  `id` char(36) NOT NULL DEFAULT '',
  `country_iso2` varchar(2) DEFAULT NULL,
  `country_iso3` varchar(3) DEFAULT NULL,
  `currency_iso` varchar(3) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `url` varchar(50) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `facebook` varchar(45) DEFAULT NULL,
  `google_plus` varchar(45) DEFAULT NULL,
  `google_analytics_code` varchar(20) DEFAULT NULL,
  `adwords` varchar(45) DEFAULT '0',
  `adwords_id` varchar(10) DEFAULT NULL,
  `adwords_language` varchar(5) DEFAULT NULL,
  `adwords_label` varchar(20) DEFAULT NULL,
  `adwords_value` decimal(10,2) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `tagline` varchar(60) DEFAULT NULL,
  `invoice_tagline` varchar(200) DEFAULT NULL,
  `address_1` varchar(40) DEFAULT NULL,
  `address_2` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `info_email` varchar(50) DEFAULT NULL,
  `keywords` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of websites
-- ----------------------------
INSERT INTO `websites` VALUES ('a5b4321b-dae4-45fa-959e-700f9cebb2dd', 'GB', 'GBR', null, null, null, 'adya-ayurveda.com', null, null, null, null, '0', null, null, null, null, '1', null, null, null, null, null, null, null, null, '020 000 0000', 'info@adya-ayurveda.com', null, '2013-12-28 15:25:37', '2013-12-28 15:25:37');
