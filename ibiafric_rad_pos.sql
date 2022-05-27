-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2022 at 05:52 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibiafric_rad_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Superadmin Group'),
(29, 'supervisor', ''),
(28, 'cashier', ''),
(26, 'Reception', 'recp'),
(31, 'Assistant de direction', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(39) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(13, '::1', '2020-09-03 21:51:26', 1),
(92, '192.168.1.21', '2020-10-20 13:44:52', 1),
(102, '154.117.216.77', '2020-11-17 19:10:51', 1),
(103, '154.117.217.67', '2020-11-18 13:02:58', 4),
(104, '197.157.195.16', '2020-11-18 13:49:29', 1),
(124, '197.157.194.1', '2021-04-30 12:21:02', 1),
(127, '197.157.194.1', '2021-05-02 18:07:44', 1),
(167, '197.157.194.1', '2021-05-19 17:55:36', 1),
(199, '173.244.217.91', '2021-06-03 13:43:25', 1),
(211, '154.70.199.230', '2021-07-05 22:47:14', 3),
(216, '154.70.198.60', '2021-07-31 11:16:17', 1),
(265, '197.157.192.71', '2021-08-05 12:57:49', 3),
(276, '41.79.46.246', '2021-08-07 17:34:44', 1),
(361, '197.157.192.71', '2021-08-13 17:25:01', 5),
(377, '197.157.192.71', '2021-08-15 18:12:36', 4),
(392, '197.157.192.71', '2021-08-17 18:05:40', 4),
(382, '197.157.192.71', '2021-08-15 18:44:29', 2),
(397, '197.157.192.71', '2021-08-17 19:33:41', 6),
(430, '197.157.192.71', '2021-08-20 10:26:39', 3),
(431, '41.79.45.5', '2021-08-20 10:28:01', 1),
(432, '197.157.192.71', '2021-08-21 11:14:14', 2),
(437, '197.157.192.71', '2021-08-21 19:43:36', 1),
(480, '197.157.192.71', '2021-09-01 21:14:12', 2),
(613, '154.117.216.45', '2021-09-27 15:41:56', 3),
(650, '154.117.217.233', '2021-10-03 10:51:18', 2),
(824, '197.157.192.71', '2021-11-15 20:51:58', 1),
(1047, '197.157.192.71', '2021-12-14 10:07:51', 4),
(1048, '197.157.192.71', '2021-12-14 10:14:49', 1),
(1061, '197.157.192.71', '2021-12-15 18:05:44', 2),
(1113, '197.157.192.71', '2021-12-23 19:55:26', 3),
(1330, '197.157.192.71', '2022-02-24 18:42:47', 1),
(1332, '41.79.45.4', '2022-02-25 09:49:28', 2),
(1335, '197.157.192.71', '2022-02-26 19:36:46', 5),
(1421, '41.79.47.147', '2022-04-06 18:53:48', 5);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(1474, 'menu_depot_articles', ''),
(1473, 'pos_clients_situation', ''),
(1472, 'pos_type_clients_export', ''),
(1471, 'pos_clients_export', ''),
(1470, 'pos_ibi_commandes_trans', ''),
(1469, 'pos_ibi_commandes_bon', ''),
(1468, 'pos_ibi_commandes_addModify', ''),
(1467, 'pos_ibi_commandes_facture', ''),
(1466, 'pos_ibi_commandes_export', ''),
(1465, 'marge_prix_export', ''),
(1464, 'pos_ibi_fournisseurs_rapports', ''),
(1463, 'pos_ibi_fournisseurs_delete', ''),
(1462, 'pos_ibi_fournisseurs_update', ''),
(1461, 'pos_ibi_fournisseurs_view', ''),
(1460, 'pos_ibi_fournisseurs_export', ''),
(1459, 'pos_ibi_fournisseurs_add', ''),
(1458, 'pos_depenses_export', ''),
(1457, 'cashier_shifts_delete', ''),
(1456, 'cashier_shifts_update', ''),
(1455, 'cashier_shifts_view', ''),
(1454, 'pos_shift_add', ''),
(1453, 'pos_ibi_stores_delete', ''),
(1452, 'pos_ibi_stores_update', ''),
(1451, 'pos_ibi_stores_view', ''),
(1450, 'pos_ibi_stores_export', ''),
(1449, 'pos_ibi_stores_add', ''),
(1448, 'pos_ibi_ingredients_update', ''),
(1447, 'pos_ibi_ingredients_delete', ''),
(1446, 'pos_ibi_ingredients_view', ''),
(1445, 'pos_ibi_ingredients_export', ''),
(1444, 'pos_ibi_ingredients_add', ''),
(1443, 'pos_ibi_requisition_trans_export', ''),
(1442, 'pos_ibi_add_article', ''),
(1441, 'pos_ibi_cloture_article', ''),
(1440, 'pos_ibi_inventaires_print', ''),
(1439, 'pos_ibi_inventaires_view', ''),
(1438, 'pos_ibi_inventaires_add', ''),
(1437, 'hospital_ibi_categories_delete', ''),
(1436, 'hospital_ibi_categories_view', ''),
(1435, 'hospital_ibi_categories_export', ''),
(1433, 'sortie_modify', ''),
(1434, 'hospital_ibi_categories_add', ''),
(1432, 'sortie_sprint', ''),
(1431, 'sortie_approuver', ''),
(1430, 'sortie_delete', ''),
(1429, 'sortie_view', ''),
(1428, 'sortie_add', ''),
(1427, 'hospital_ibi_articles_historique', ''),
(1426, 'hospital_ibi_articles_preHistorique', ''),
(1425, 'hospital_ibi_articles_export', ''),
(1515, 'articles_add', ''),
(1423, 'menu_dashboard', ''),
(1301, 'menu_fournisseurs', ''),
(1302, 'menu_ventes', ''),
(1303, 'menu_mouvement_de_stock', ''),
(1304, 'menu_mouvement_stock_par_boutique', ''),
(1305, 'menu_rapport_facture', ''),
(1306, 'menu_mouvement_par_boutique', ''),
(1307, 'menu_sortie', ''),
(1308, 'menu_inventaires', ''),
(1309, 'menu_item_location', ''),
(1310, 'menu_liste_des_categories', ''),
(1311, 'menu_liste_des_articles', ''),
(1312, 'menu_approvisionnements', ''),
(1313, 'menu_ajustement_des_quantites', ''),
(1314, 'menu_rapports', ''),
(1315, 'menu_tests_laboratoire', ''),
(1316, 'menu_réquisitions_envoyées', ''),
(1317, 'menu_ingredient', ''),
(1383, 'marge_prix_list', ''),
(1382, 'marge_prix_delete', ''),
(1381, 'marge_prix_view', ''),
(1380, 'marge_prix_update', ''),
(1379, 'marge_prix_add', ''),
(1323, 'menu_marge_prix', ''),
(1324, 'pos_clients_add', ''),
(1325, 'pos_clients_update', ''),
(1326, 'pos_clients_view', ''),
(1327, 'pos_clients_delete', ''),
(1328, 'pos_clients_list', ''),
(1329, 'menu_clients', ''),
(1330, 'pos_type_clients_add', ''),
(1331, 'pos_type_clients_update', ''),
(1332, 'pos_type_clients_view', ''),
(1333, 'pos_type_clients_delete', ''),
(1334, 'pos_type_clients_list', ''),
(1335, 'client_file_add', ''),
(1336, 'client_file_update', ''),
(1337, 'client_file_view', ''),
(1338, 'client_file_delete', ''),
(1339, 'client_file_list', ''),
(1340, 'menu_type_de_client', ''),
(1341, 'menu_req_transfert', ''),
(1342, 'menu_envoyés', ''),
(1343, 'menu_reçues', ''),
(1344, 'pos_ibi_requisition_trans_add', ''),
(1345, 'pos_ibi_requisition_trans_update', ''),
(1346, 'pos_ibi_requisition_trans_view', ''),
(1347, 'pos_ibi_requisition_trans_delete', ''),
(1348, 'pos_ibi_requisition_trans_list', ''),
(1349, 'menu_rapport_commande_par_date', ''),
(1350, 'menu_rapports_approvisionnement', ''),
(1351, 'menu_rapports_paiement', ''),
(1352, 'menu_rapports_serveurs', ''),
(1353, 'menu_rapport_des_ventes', ''),
(1354, 'pos_ibi_commandes_add', ''),
(1355, 'pos_ibi_commandes_update', ''),
(1356, 'pos_ibi_commandes_view', ''),
(1357, 'pos_ibi_commandes_delete', ''),
(1358, 'pos_ibi_commandes_list', ''),
(1359, 'pos_depenses_add', ''),
(1360, 'pos_depenses_update', ''),
(1361, 'pos_depenses_view', ''),
(1362, 'pos_depenses_delete', ''),
(1363, 'pos_depenses_list', ''),
(1364, 'menu_point_de_vente', ''),
(1365, 'menu_depenses_restaurant', ''),
(1366, 'pos_categorie_depense_add', ''),
(1367, 'pos_categorie_depense_update', ''),
(1368, 'pos_categorie_depense_view', ''),
(1369, 'pos_categorie_depense_delete', ''),
(1370, 'pos_categorie_depense_list', ''),
(1371, 'menu_categorie_depense', ''),
(1372, 'menu_rapport_depense', ''),
(1373, 'menu_client', ''),
(1374, 'menu_clientss', ''),
(1375, 'menu_situation_clients', ''),
(1376, 'menu_rapport_ingredient', ''),
(1377, 'menu_vente_ingredient', ''),
(1378, 'menu_sortie_caisse', ''),
(1384, 'menu_depense_direct', ''),
(1385, 'menu_paiement_au_comptant', ''),
(1386, 'menu_dette_envers_la_caise', ''),
(1387, 'menu_depense_caisse', ''),
(1388, 'menu_dette_envers_tiers', ''),
(1389, 'menu_achats_au_comptant', ''),
(1390, 'menu_commandes', ''),
(1391, 'menu_proforma', ''),
(1392, 'menu_factures_reservers', ''),
(1393, 'menu_shift', ''),
(1394, 'menu_guest', ''),
(1395, 'menu_rapport_jounaliers', ''),
(1396, 'menu_recettes_jounaliers', ''),
(1397, 'menu_rapports_par_shifts', ''),
(1398, 'menu_réquisition_d\'achat', ''),
(1399, 'menu_liste_plats', ''),
(1400, 'menu_boutiques', ''),
(1401, 'menu_stocks', ''),
(1402, 'menu_chambres', ''),
(1403, 'settings_app_add', ''),
(1404, 'settings_app_update', ''),
(1405, 'settings_app_view', ''),
(1406, 'settings_app_delete', ''),
(1407, 'settings_app_list', ''),
(1408, 'menu_setting_app', ''),
(1409, 'waiter_perm', ''),
(1410, 'approvisionnements_add', ''),
(1411, 'approvisionnements_delete', ''),
(1412, 'approvisionnements_confirmation', ''),
(1413, 'approvisionnement_print', ''),
(1414, 'requisition_demande', ''),
(1415, 'requisition_autorisation', ''),
(1416, 'pos_ibi_ingredients_transformation', ''),
(1417, 'requisition_userModify', ''),
(1418, 'requisition_suppressionUser', ''),
(1419, 'requisition_ajouter', ''),
(1420, 'approvisionnements_update', ''),
(1421, 'approvisionnements_autoriser', ''),
(1422, 'approvisionnements_viewSoumission', ''),
(1475, 'menu_demandes', ''),
(1476, 'menu_demandes_envoyés', ''),
(1477, 'menu_demandes_reçues', ''),
(1478, 'dashboard', ''),
(1479, 'menu_demandes_de_demandes', ''),
(1480, 'menu_user', ''),
(1481, 'menu_factures', ''),
(1482, 'menu_facture', ''),
(1483, 'menu_sortie_caisses', ''),
(1484, 'menu_paramètre', ''),
(1485, 'menu_groups', ''),
(1486, 'menu_groupes', ''),
(1487, 'menu_réquisitions_d\'achat', ''),
(1488, 'menu_fournisseur', ''),
(1489, 'menu_approvisionnement', ''),
(1490, 'menu_famille_article', ''),
(1491, 'menu_demande', ''),
(1492, 'menu_rapport_transfert-stock', ''),
(1493, 'menu_categorie_ingredients', ''),
(1494, 'menu_type_ajustement', ''),
(1495, 'menu_sortie/ajustement', ''),
(1496, 'menu_rapport_ventes_par_famille', ''),
(1497, 'menu_raison_de_transfer', ''),
(1498, 'menu_rapports_de_shift', ''),
(1499, 'menu_rapports_ventes_par_shift', ''),
(1500, 'menu_recettes_ventes_par_date', ''),
(1501, 'menu_rapports_condensé_par_shift', ''),
(1502, 'menu_sorties', ''),
(1503, 'menu_unite_de_mesure', ''),
(1504, 'menu_parametres', ''),
(1505, 'menu_rapport_de_vente_par_famille', ''),
(1506, 'unite_articles_update', ''),
(1507, 'unite_articles_view', ''),
(1508, 'unite_articles_delete', ''),
(1509, 'unite_articles_add', ''),
(1510, 'unite_articles_list', ''),
(1511, 'dashboard_rapport_recette_depense', ''),
(1512, 'dashboard_rapport_chiffre_journalier', ''),
(1513, 'menu_tables', ''),
(1514, 'menu_recettes_journaliere', ''),
(1516, 'soumettre_requisition', ''),
(1517, 'confirmation_requisition', ''),
(1518, 'autorisation_requisition', ''),
(1519, 'menu_factures_à_supprimer', ''),
(1520, 'menu_obr', ''),
(1521, 'menu_flux_caisse', ''),
(1522, 'menu_categorie__flux_caisse', ''),
(1523, 'pos_flux_caisse_add', ''),
(1524, 'pos_flux_caisse_update', ''),
(1525, 'pos_flux_caisse_view', ''),
(1526, 'pos_flux_caisse_delete', ''),
(1527, 'pos_flux_caisse_list', ''),
(1528, 'pos_session_add', ''),
(1529, 'pos_session_update', ''),
(1530, 'pos_session_view', ''),
(1531, 'pos_session_delete', ''),
(1532, 'pos_session_list', ''),
(1533, 'pos_categorie_flux_caisse_add', ''),
(1534, 'pos_categorie_flux_caisse_update', ''),
(1535, 'pos_categorie_flux_caisse_view', ''),
(1536, 'pos_categorie_flux_caisse_delete', ''),
(1537, 'pos_categorie_flux_caisse_list', ''),
(1538, 'pos_activite_flux_caisse_add', ''),
(1539, 'pos_activite_flux_caisse_update', ''),
(1540, 'pos_activite_flux_caisse_view', ''),
(1541, 'pos_activite_flux_caisse_delete', ''),
(1542, 'pos_activite_flux_caisse_list', ''),
(1543, 'menu_type_flux_caisse', ''),
(1544, 'menu_caisse', ''),
(1545, 'menu_session_caisse', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perm_to_group`
--

INSERT INTO `aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(1468, 27),
(1482, 27),
(1423, 26),
(1478, 26),
(1423, 28),
(1478, 28),
(1423, 29),
(1478, 29),
(1486, 1),
(1484, 1),
(1483, 1),
(1482, 1),
(1414, 30),
(1413, 30),
(1422, 30),
(1421, 30),
(1420, 30),
(1412, 30),
(1411, 30),
(1410, 30),
(1409, 30),
(1339, 30),
(1338, 30),
(1337, 30),
(1336, 30),
(1335, 30),
(1428, 30),
(1429, 30),
(1430, 30),
(1431, 30),
(1432, 30),
(1433, 30),
(1424, 30),
(1425, 30),
(1426, 30),
(1427, 30),
(1434, 30),
(1435, 30),
(1436, 30),
(1437, 30),
(1455, 30),
(1456, 30),
(1457, 30),
(1379, 30),
(1380, 30),
(1381, 30),
(1382, 30),
(1383, 30),
(1465, 30),
(1416, 30),
(1370, 30),
(1369, 30),
(1368, 30),
(1367, 30),
(1366, 30),
(1363, 30),
(1362, 30),
(1361, 30),
(1360, 30),
(1359, 30),
(1357, 30),
(1356, 30),
(1355, 30),
(1354, 30),
(1348, 30),
(1347, 30),
(1346, 30),
(1345, 30),
(1344, 30),
(1334, 30),
(1333, 30),
(1332, 30),
(1331, 30),
(1330, 30),
(1328, 30),
(1327, 30),
(1326, 30),
(1325, 30),
(1324, 30),
(1438, 30),
(1439, 30),
(1440, 30),
(1441, 30),
(1442, 30),
(1443, 30),
(1444, 30),
(1445, 30),
(1446, 30),
(1447, 30),
(1448, 30),
(1449, 30),
(1450, 30),
(1451, 30),
(1452, 30),
(1453, 30),
(1454, 30),
(1458, 30),
(1459, 30),
(1460, 30),
(1461, 30),
(1462, 30),
(1463, 30),
(1464, 30),
(1466, 30),
(1467, 30),
(1468, 30),
(1469, 30),
(1470, 30),
(1471, 30),
(1472, 30),
(1473, 30),
(1514, 30),
(1513, 30),
(1505, 30),
(1504, 30),
(1503, 30),
(1502, 30),
(1497, 30),
(1496, 30),
(1495, 30),
(1494, 30),
(1493, 30),
(1492, 30),
(1491, 30),
(1490, 30),
(1489, 30),
(1488, 30),
(1487, 30),
(1480, 30),
(1479, 30),
(1477, 30),
(1476, 30),
(1402, 30),
(1401, 30),
(1400, 30),
(1399, 30),
(1398, 30),
(1394, 30),
(1393, 30),
(1494, 1),
(1389, 30),
(1388, 30),
(1387, 30),
(1386, 30),
(1385, 30),
(1384, 30),
(1398, 1),
(1378, 30),
(1487, 1),
(1377, 30),
(1488, 1),
(1376, 30),
(1375, 30),
(1313, 1),
(1364, 30),
(1352, 30),
(1414, 31),
(1413, 31),
(1422, 31),
(1421, 31),
(1420, 31),
(1412, 31),
(1411, 31),
(1410, 31),
(1515, 31),
(1428, 31),
(1429, 31),
(1430, 31),
(1431, 31),
(1432, 31),
(1433, 31),
(1416, 31),
(1370, 31),
(1369, 31),
(1368, 31),
(1367, 31),
(1366, 31),
(1363, 31),
(1362, 31),
(1361, 31),
(1360, 31),
(1359, 31),
(1358, 31),
(1357, 31),
(1356, 31),
(1355, 31),
(1354, 31),
(1348, 31),
(1347, 31),
(1346, 31),
(1345, 31),
(1344, 31),
(1489, 1),
(1334, 31),
(1333, 31),
(1332, 31),
(1331, 31),
(1330, 31),
(1328, 31),
(1327, 31),
(1326, 31),
(1325, 31),
(1489, 1),
(1351, 30),
(1324, 31),
(1438, 31),
(1350, 30),
(1495, 1),
(1490, 1),
(1349, 30),
(1439, 31),
(1487, 1),
(1343, 30),
(1440, 31),
(1476, 1),
(1342, 30),
(1341, 30),
(1492, 1),
(1323, 30),
(1441, 31),
(1493, 1),
(1317, 30),
(1442, 31),
(1494, 1),
(1316, 30),
(1443, 31),
(1315, 30),
(1449, 31),
(1494, 1),
(1314, 30),
(1450, 31),
(1496, 1),
(1313, 30),
(1451, 31),
(1497, 1),
(1311, 30),
(1452, 31),
(1453, 31),
(1458, 31),
(1476, 29),
(1477, 1),
(1477, 29),
(1459, 31),
(1460, 31),
(1461, 31),
(1462, 31),
(1463, 31),
(1464, 31),
(1466, 31),
(1468, 31),
(1469, 31),
(1470, 31),
(1471, 31),
(1472, 31),
(1514, 31),
(1481, 27),
(1503, 31),
(1502, 31),
(1500, 31),
(1497, 31),
(1495, 31),
(1494, 31),
(1493, 31),
(1491, 31),
(1490, 31),
(1489, 31),
(1488, 31),
(1487, 31),
(1486, 31),
(1485, 31),
(1479, 31),
(1476, 31),
(1475, 31),
(1408, 31),
(1402, 31),
(1401, 31),
(1400, 31),
(1399, 31),
(1398, 31),
(1396, 31),
(1395, 31),
(1394, 31),
(1392, 31),
(1391, 31),
(1390, 31),
(1389, 31),
(1388, 31),
(1387, 31),
(1386, 31),
(1385, 31),
(1384, 31),
(1377, 31),
(1376, 31),
(1375, 31),
(1374, 31),
(1371, 31),
(1343, 31),
(1342, 31),
(1341, 31),
(1316, 31),
(1313, 31),
(1312, 1),
(1311, 31),
(1310, 31),
(1309, 31),
(1308, 30),
(1308, 31),
(1398, 1),
(1398, 29),
(1310, 30),
(1398, 1),
(1398, 29),
(1309, 30),
(1398, 1),
(1398, 29),
(1308, 1),
(1398, 1),
(1398, 29),
(1307, 30),
(1398, 1),
(1398, 29),
(1306, 30),
(1398, 1),
(1398, 29),
(1305, 30),
(1307, 31),
(1398, 1),
(1398, 29),
(1304, 30),
(1305, 31),
(1503, 1),
(1503, 29),
(1303, 30),
(1302, 31),
(1503, 1),
(1503, 29),
(1423, 30),
(1301, 31),
(1364, 27),
(1423, 31),
(1514, 1),
(1474, 30),
(1474, 31),
(1423, 27),
(1467, 27),
(1354, 27),
(1355, 27),
(1356, 27),
(1358, 27),
(1478, 27),
(1415, 30),
(1417, 30),
(1418, 30),
(1419, 30),
(1478, 30),
(1478, 31),
(1520, 1),
(1520, 29);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(225) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user`
--

CREATE TABLE `aauth_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `oauth_uid` text,
  `oauth_provider` varchar(100) DEFAULT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `avatar` text NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `top_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `boutique` varchar(50) NOT NULL,
  `STORE_ALLOWED` varchar(10) NOT NULL DEFAULT '0',
  `delete_status_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `oauth_uid`, `oauth_provider`, `pass`, `username`, `full_name`, `pin_code`, `avatar`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `top_secret`, `ip_address`, `boutique`, `STORE_ALLOWED`, `delete_status_user`) VALUES
(1, 'admin@admin.com', NULL, NULL, '5711aa2253ac62088bf34f79f8ccd82e41bdbcf32e7670772d2a1e1746a9be9b', 'admin', 'admin', '1234', '20180810195951-imagess.jpg', 0, '2022-05-25 10:12:57', '2022-05-25 10:12:57', '2018-07-31 14:04:14', NULL, '2019-07-18 00:00:00', '2SioacOqWhyf8vPr', NULL, NULL, '154.117.219.96', '1,2,3,4,5,8,9,10', '', 0),
(748, 'amandakigoma@gmail.com', NULL, NULL, '9687850e555d1b6eef93a9ad8bc52af4873dc4b0553ab9214147bdf779556f7a', 'Amanda', 'Uwase  amanda', '1101', 'default.png', 0, '2022-04-07 08:04:47', '2022-04-07 08:04:47', '2021-05-06 11:13:05', NULL, NULL, NULL, NULL, NULL, '154.70.198.41', '1,2,4,5,8,9,10,11', '0', 1),
(746, 'ndikuriyochanice45@gmail.com', NULL, NULL, '6fda760ca2c7337dfae4270a02b8547bbac27d22b10adf7479662d2362486aea', 'Chanice', 'Ndikuriyo ( Ndikuriyo )', '1103', 'default.png', 0, '2021-09-23 10:50:02', '2021-09-23 10:50:02', '2021-05-04 08:42:13', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '1,2,4,5,8,9', '0', 1),
(747, 'padou9@yahoo.fr', NULL, NULL, '55479c4100d6a4b9317817a6682bf506959c7f4c5659dee69911c24683911ada', 'Padou', 'Harerimana', '1004', 'default.png', 0, '2022-02-24 18:12:13', '2022-02-24 18:12:13', '2021-05-04 08:59:34', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '1,2,4,5,8,9,10,11', '0', 1),
(749, 'orpheen@hotmail.com', NULL, NULL, '4a4d64c2effe1eb4ed3230af54f515e1546fdbfc8b20ded14952a657d1b76ca2', 'Negro', 'Orphee', '5604', 'default.png', 0, '2022-04-08 08:02:42', '2022-04-08 08:02:42', '2021-05-06 11:41:45', NULL, NULL, NULL, NULL, NULL, '41.79.45.4', '1,2,4,5,8,9,10,11', '0', 1),
(750, 'daniekeza84@gmail.com', NULL, NULL, '82777fc9c9e7cfb79b03d2c906216087514ec50fcd447f5be29e2012dbcfe6ae', 'Daniella', 'keza', '1106', 'default.png', 1, '2021-09-19 14:02:31', '2021-09-19 14:02:31', '2021-05-06 12:48:07', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '', '0', 1),
(751, 'mugishaleilla@gmail.com', NULL, NULL, 'c30b0755cfd4b89953b931f83fb3bc0644743b3af42212accb53e24c578127d7', 'MUGISHA', 'leilla', '1007', 'default.png', 0, '2021-09-21 16:50:05', '2021-09-21 16:50:05', '2021-05-06 17:41:10', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '', '0', 1),
(754, 'Jimgat1@yahoo.fr', NULL, NULL, '183b9878d340d4d532da8b84ab0b09ac2a71c290139a35cddbad033fdabc485b', 'Gatoto', 'Jimmy', '1011', 'default.png', 0, '2021-12-18 13:26:48', '2021-12-18 13:26:48', '2021-05-28 19:28:11', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '', '0', 1),
(755, 'Maisoncremerie@gmail.com', NULL, NULL, '0399a38cc4818a18fe36bd945ab42531a9fc1346bb6f2af95ed7520ce2a9ea1b', 'ORPHEE', 'MC  Orphee', '1114', 'default.png', 0, '2022-02-25 13:20:18', '2022-02-25 13:20:18', '2021-12-25 11:30:24', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '1,4,5,8,9,10,11', '0', 1),
(756, 'kingmillor23@gmail.com', NULL, NULL, '8863beca6a407503dd99e1ec72285e1bc5f5aaa71aadb6849ab3579bda292cd5', 'DUSHIME', 'Billy King', '1016', 'default.png', 0, '2022-04-07 18:43:58', '2022-04-07 18:43:58', '2022-02-26 12:06:53', NULL, NULL, NULL, NULL, NULL, '154.70.198.41', '1,2,4,5,8,9,10,11', '0', 1),
(757, 'GADi@gmail.com', NULL, NULL, '4c006cfcf2da7ba5910b3240516b8ec1d258482782126f982cb7120ef65da981', 'IRAKOZE', 'GADI', '1017', 'default.png', 0, '2022-03-10 16:29:27', '2022-03-10 16:29:27', '2022-02-26 12:12:08', NULL, NULL, NULL, NULL, NULL, '197.157.192.71', '1,2,4,5,8,9,10,11', '0', 1),
(758, 'test@test.com', NULL, NULL, '6bb40036aa10b663bab2f1780fec47cfeab8dc7ae4ead679fa324c3d62d979a8', 'test', 'Test', '123456', 'default.png', 0, NULL, NULL, '2022-04-21 15:07:46', NULL, NULL, NULL, NULL, NULL, NULL, '', '0', 1),
(759, 'test2@test.com', NULL, NULL, '410cac622e86a2ee9af997beecc2c319444a835b933ebb0fc8960a2be236dd97', 'test2', 'test', '123453', 'default.png', 0, '2022-04-21 15:23:43', '2022-04-21 15:23:43', '2022-04-21 15:11:01', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  `statut` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`, `statut`) VALUES
(1, 1, 0),
(744, 1, 0),
(745, 29, 0),
(746, 27, 0),
(747, 27, 0),
(749, 1, 0),
(750, 27, 0),
(751, 27, 0),
(752, 27, 0),
(753, 27, 0),
(748, 1, 0),
(754, 31, 0),
(754, 27, 0),
(755, 1, 0),
(756, 31, 0),
(747, 31, 0),
(755, 28, 0),
(756, 27, 0),
(757, 29, 0),
(759, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `autorisation`
--

CREATE TABLE `autorisation` (
  `ID_AUTORISATION` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autorisation`
--

INSERT INTO `autorisation` (`ID_AUTORISATION`, `STATUS`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `tags` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `author` varchar(100) NOT NULL,
  `viewers` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `content`, `image`, `tags`, `category`, `status`, `author`, `viewers`, `created_at`, `updated_at`) VALUES
(1, 'Hello Wellcome To Ibi Builder', 'Hello-Wellcome-To-IBI-Builder', 'greetings from our team I hope to be happy! ', 'wellcome.jpg', 'greetings', '1', 'publish', 'admin', 0, '2020-09-02 08:35:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Technology', ''),
(2, 'Lifestyle', '');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` int(11) UNSIGNED NOT NULL,
  `captcha_time` int(10) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cashier_shifts`
--

CREATE TABLE `cashier_shifts` (
  `ID_SHIFT` bigint(20) UNSIGNED NOT NULL,
  `SHIFT_START` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SHIFT_END` datetime DEFAULT NULL,
  `SHIFT_STATUS` int(11) DEFAULT '0',
  `CREATED_BY_SHIFT` varchar(255) DEFAULT NULL,
  `INSERTED_AT_SHIFT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT_SHIFT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FROM_CLOUD` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) DEFAULT NULL,
  `STORE_ID` int(11) DEFAULT '1',
  `DESCRIPTION_CATEGORIE` text,
  `DATE_CREATION_CATEGORIE` datetime DEFAULT NULL,
  `DATE_MOD_CATEGORIE` datetime DEFAULT NULL,
  `AUTHOR_CATEGORIE` int(11) DEFAULT NULL,
  `AUTHOR_MOD_CATEGORIE` int(11) DEFAULT NULL,
  `DELETE_STATUS_CATEGORIE` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID_CATEGORIE`, `NOM_CATEGORIE`, `STORE_ID`, `DESCRIPTION_CATEGORIE`, `DATE_CREATION_CATEGORIE`, `DATE_MOD_CATEGORIE`, `AUTHOR_CATEGORIE`, `AUTHOR_MOD_CATEGORIE`, `DELETE_STATUS_CATEGORIE`) VALUES
(1, 'TUBE', 1, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'PROFILE', 1, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'FER', 1, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'TOLE', 1, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'TUYAUX', 1, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'FER A BETON', 1, NULL, NULL, NULL, NULL, NULL, 0),
(7, 'ETRIER', 1, NULL, NULL, NULL, NULL, NULL, 0),
(8, 'SAC', 1, NULL, NULL, NULL, NULL, NULL, 0),
(9, 'FIL A LIGATURER', 1, NULL, NULL, NULL, NULL, NULL, 0),
(10, 'FIL', 1, NULL, NULL, NULL, NULL, NULL, 0),
(11, 'CLOUS', 1, NULL, NULL, NULL, NULL, NULL, 0),
(12, 'TREILLIS', 1, NULL, NULL, NULL, NULL, NULL, 0),
(13, 'ACCESSOIRE', 1, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'TUBE 2', 2, NULL, NULL, NULL, NULL, NULL, 0),
(19, 'PROFILE', 2, NULL, NULL, NULL, NULL, NULL, 0),
(20, 'FER', 2, NULL, NULL, NULL, NULL, NULL, 0),
(21, 'TOLE', 2, NULL, NULL, NULL, NULL, NULL, 0),
(22, 'TUYAUX', 2, NULL, NULL, NULL, NULL, NULL, 0),
(23, 'FER A BETON', 2, NULL, NULL, NULL, NULL, NULL, 0),
(24, 'ETRIER', 2, NULL, NULL, NULL, NULL, NULL, 0),
(25, 'SAC', 2, NULL, NULL, NULL, NULL, NULL, 0),
(26, 'FIL A LIGATURER', 2, NULL, NULL, NULL, NULL, NULL, 0),
(27, 'FIL', 2, NULL, NULL, NULL, NULL, NULL, 0),
(28, 'CLOUS', 2, NULL, NULL, NULL, NULL, NULL, 0),
(29, 'TREILLIS', 2, NULL, NULL, NULL, NULL, NULL, 0),
(30, 'ACCESSOIRE', 2, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cc_options`
--

CREATE TABLE `cc_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cc_options`
--

INSERT INTO `cc_options` (`id`, `option_name`, `option_value`) VALUES
(1, 'active_theme', 'ibi'),
(2, 'favicon', 'default.png'),
(3, 'site_name', 'RAD METALS'),
(4, 'email', 'georgeskatiera@gmail.com'),
(5, 'author', 'IBI'),
(6, 'site_description', ''),
(7, 'keywords', ''),
(8, 'landing_page_id', 'default'),
(9, 'timezone', 'Africa/Bujumbura'),
(10, 'google_id', ''),
(11, 'google_secret', '');

-- --------------------------------------------------------

--
-- Table structure for table `cc_session`
--

CREATE TABLE `cc_session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ID_CLIENT` int(11) NOT NULL,
  `NOM_CLIENT` varchar(100) DEFAULT NULL,
  `PRENOM_CLIENT` varchar(100) DEFAULT NULL,
  `TEL_CLIENT` varchar(20) DEFAULT NULL,
  `EMAIL_CLIENT` varchar(200) DEFAULT NULL,
  `ASSUGETI_TVA_CLIENT` tinyint(4) DEFAULT NULL,
  `COUNTRY_CLIENT` int(11) DEFAULT NULL,
  `CITY_CLIENT` text,
  `QUARTIER_CLIENT` text,
  `ADRESSE_CLIENT` text,
  `BP_CLIENT` varchar(20) DEFAULT NULL,
  `NIF_CLIENT` varchar(20) DEFAULT NULL,
  `COMPANY_NAME_CLIENT` varchar(200) DEFAULT NULL,
  `DATE_CREATION_CLIENT` datetime DEFAULT CURRENT_TIMESTAMP,
  `REF_GROUP_CLIENT` int(11) DEFAULT NULL,
  `FILES_CLIENT` int(11) DEFAULT NULL,
  `AUTHOR_CLIENT` int(11) DEFAULT NULL,
  `DESCRIPTION_CLIENT` text,
  `DISCOUNT_ACTIVE_CLIENT` int(11) DEFAULT NULL,
  `DELETED_STATUS_CLIENT` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `EMAIL_CLIENT`, `ASSUGETI_TVA_CLIENT`, `COUNTRY_CLIENT`, `CITY_CLIENT`, `QUARTIER_CLIENT`, `ADRESSE_CLIENT`, `BP_CLIENT`, `NIF_CLIENT`, `COMPANY_NAME_CLIENT`, `DATE_CREATION_CLIENT`, `REF_GROUP_CLIENT`, `FILES_CLIENT`, `AUTHOR_CLIENT`, `DESCRIPTION_CLIENT`, `DISCOUNT_ACTIVE_CLIENT`, `DELETED_STATUS_CLIENT`) VALUES
(12, 'CLIENT CASH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(18, 'AMIDU  CLEON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(19, 'ANITHA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(20, 'ALLY SALUM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(21, 'ALAIN  MUBADA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(22, 'ABU DUBAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(23, 'ATELAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(24, 'ABRAHAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(25, 'AMINATHA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(26, 'AGATHE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(28, 'AIME ASIATIQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(29, 'AUTOTECH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(30, 'AMIGO CONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(31, 'ALY KATELEKO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(32, 'BIG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(33, 'BONEY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(34, 'BAYOUSSUF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(35, 'PAPA STECY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(36, 'CAMEROUNAIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(37, 'CHRISTINE MUTAMBUKA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(38, 'CHANTAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(39, 'DYLAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(40, 'MANA CONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(41, 'MWALIMU ABDOUL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(42, 'MWALIMU JUMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(43, 'MAMAN MUSTAFA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(44, 'MAMERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(45, 'MAMAN BUGARASHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(46, 'MAMAN RANIA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(47, 'MARCEL LONDRES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(48, 'MASOEUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(49, 'MOSQUE BWIZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(50, 'MAMAN JABIRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(51, 'MAMAN ROBERT v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(52, 'MAMAN ROBERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(53, 'MADJIDI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(54, 'MAMAN NUNU LINA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(55, 'MAMAN NUNU MAGASIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(56, 'MAMAN NUNU SEIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(57, 'NTIRWONZA HASSAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(58, 'ODILE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(59, 'NYENGELA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(60, 'ERGC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(61, 'EDOUARD REVELIEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(62, 'EMAN NESRU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(63, 'EVRINE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(64, 'EVRARD JANVIER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(65, 'FAUSTIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(66, 'FURAHA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(67, 'GTC GASANA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(68, 'GUY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(69, 'GOSHEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(70, 'HENRI DUBAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(71, 'HERI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(72, 'HUSSEIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(73, 'INTERPETROLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(74, 'ISAAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(75, 'JOEL NKURUNZIZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(76, 'JAMAL DISQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(77, 'JAMAL MUTOKA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(78, 'JEANNE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(79, 'JIMY REGIDESO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(80, 'KIDOGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(81, 'KIDE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(82, 'LEONCE ELECTRICIEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(83, 'MAMAN NUNU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(84, 'PACIFIQUE MECANICIEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(85, 'PAPA SHAMIM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(86, 'MAMAN SHAMIM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(87, 'PAPA JENNIFER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(88, 'PASTEUR NOUVEAU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(89, 'PASTA VOISIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(90, 'PAPA BEBE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(91, 'PIERRE MACON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(92, 'PAUL INGENIER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(93, 'RADJAB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(94, 'SOSO TRANSPORTEUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(95, 'SELEMANI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(96, 'SARAN NTEZE ANTI ROUILLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(97, 'SHABANI BELGIQUE + KARIM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(98, 'SARAH NTEZE DANGOTE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(99, 'SARAH NTEZE MABATI FEMER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(100, 'SOGEA SATOM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(101, 'SHIME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(102, 'SIBOMANA MUY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(103, 'SEVITEB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(104, 'SMART SECURITY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(105, 'THARCISSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(106, 'VICTOR SARAH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(107, 'ZION TEMPLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(108, 'EXODE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(110, 'SANA SHOP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(111, 'FEMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(114, 'PAPA NUNU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(115, 'NDAYIZIGIYE MANU OBR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(117, 'BOSS MASTIC ISAAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(118, 'FARIS MALIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(119, 'BAKARI VOISIN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(120, 'NIMBONA EMMANUEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(122, 'SUPER SERVICE GENERAL TRADING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(123, 'MARIE NOELLE NDAYIZEYE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(124, 'MAMAN NUNU KIBENGA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(133, 'Hadji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(135, 'HADJI MATESO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(136, 'LINA (SADA)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(137, 'SHADIA BXL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(138, 'KAPOSHO MAMAN NUNU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(148, 'GTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(149, 'ECAME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(151, 'SYTECORE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(152, 'NIRAGIRA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(153, 'ECO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(154, 'HUNAUL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(155, 'SEBER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(156, 'COTRAC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(158, 'ETS KASAVUBU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(160, 'QUINCAILLERIE PRINCE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(161, 'HORISON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(162, 'LEONIDAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(164, 'ETACOCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(166, 'ETRET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(167, 'GPSB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(169, 'RAD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(170, 'ECAF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(171, 'EXTRACO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(172, 'MALEX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(173, 'AFRICAN MINING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(174, 'FAFCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(176, 'PHILOMENE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(178, 'NOUVELLE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(180, 'ECOTRAVE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(182, 'BAMACO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(183, 'ALPHA  CD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(185, 'ECBROH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(187, 'AMAZI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(188, 'AMAZI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(189, 'INNOVA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(190, 'KCT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(192, 'MADIDI DESIRE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(193, 'ALUBUKO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(196, 'TRUST COMPANY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(198, 'WOOD ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(201, 'ETRAVE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(202, 'EMAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(203, 'REMEBUCOM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(204, 'MUTAMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(205, 'SETC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(207, 'SOBUPROVA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(208, 'BUJA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(209, 'EMASTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(211, 'SECOM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(212, 'ANTOINNE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(213, 'ANTOINNE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(214, 'IBRAHIM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(215, 'DIDIER INTERPETROL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(216, 'REMY NKUZIMANA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(217, 'NIBITANGA PHILBERT COBEREC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(218, 'BENIKA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(219, 'FLAVIEN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(220, 'BEST OUT LOOK H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(221, 'BERCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(222, 'MPAWENIMANA SIMON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(225, 'EGLISE MARANATHA KAMENGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(226, 'MADRASA GATABO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(227, 'NTAKARUTIMANA CONSOLATE Jean marie soudeur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(228, 'ABDALLAH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(229, 'ELIE ( JANVIER )', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(230, 'MASTID RUMONGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(231, 'MOSQUE KAMENGE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(232, 'NZOTUNGA EZECHIEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(233, 'ENG SELEMANI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(234, 'CASCADE APPART HOTEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(235, 'DESIRE DUBAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(237, 'ROSIMINA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(238, 'KIRA Hospital', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(239, 'COMMISSAIRE CONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(240, 'CHRISTOPHE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(241, 'DR CONGO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(243, 'HALIFA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(244, 'JUVENT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(245, 'JUVENAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(246, 'KURSUM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(247, 'Maolin Congo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(248, 'MELEUSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(249, 'MANU NESTOR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(250, 'MAMAN BASY(HALIMA)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(251, 'MARIAMU BUGARASHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(252, 'KARIRE PRODUCTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(253, 'MAMAN NUNU-JOLIE KAJAGA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(254, 'MINISTRE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(255, 'MOSQUE GAHWEZA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(256, 'PAPA BEBE/CHANTIER ASIATIQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(257, 'PASTEUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(259, 'PASTEUR KAYOGORO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(260, 'PASCAL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(261, 'POLO INGENIEUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 09:08:21', NULL, NULL, NULL, NULL, NULL, 0),
(262, 'VINCENT', 'prenom', '099838', 'dan@gmail.com', 1, 1, 'kaboul', 'quartier test', 'adresse test', 'postal test', '2334', NULL, '2022-03-14 10:39:59', 5, NULL, 1, 'description test', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_file`
--

CREATE TABLE `client_file` (
  `CLIENT_FILE_ID` int(20) NOT NULL,
  `CLIENT_FILE_CODE` varchar(300) NOT NULL,
  `CLIENT_ID` int(20) NOT NULL,
  `CLIENT_FILE_STATUS` int(20) NOT NULL COMMENT '0=ouverte, 1=deja ferme',
  `DISCOUNT_BOISSON` int(11) DEFAULT '0',
  `DISCOUNT_FOOD` int(11) NOT NULL DEFAULT '0',
  `DISCOUNT_FACTURE` double DEFAULT '0',
  `DATE_CREATION_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_CLIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `MODIFIED_BY_CLIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `DELETED_DATE_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_CLIENT_FILE` int(2) NOT NULL DEFAULT '0',
  `DELETED_USER_CLIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `DELETED_COMMENT_CLIENT_FILE` varchar(300) DEFAULT NULL,
  `PAYER_FACTURE` int(11) DEFAULT NULL,
  `NUMERO_FACTURE` varchar(300) NOT NULL,
  `DECLOTURE` int(11) NOT NULL DEFAULT '0',
  `ACCESS_CODE` varchar(250) DEFAULT '1111',
  `STATUS_CODE` int(11) NOT NULL DEFAULT '0',
  `ID_RESERVATION_CHECKIN` int(11) DEFAULT NULL,
  `REF_ID_ROOM` int(11) DEFAULT NULL,
  `STATUS_CHECKIN` int(11) DEFAULT NULL,
  `NOTE_CHECKOUT` varchar(250) DEFAULT NULL,
  `START_DATE_CHECKIN` datetime DEFAULT NULL,
  `END_DATE_CHECKIN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contribuable`
--

CREATE TABLE `contribuable` (
  `id_contribuable` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tp_type` varchar(5) NOT NULL,
  `tp_name` varchar(100) NOT NULL,
  `tp_TIN` varchar(30) NOT NULL,
  `tp_trade_number` varchar(20) NOT NULL,
  `tp_postal_number` varchar(20) NOT NULL,
  `tp_phone_number` varchar(20) NOT NULL,
  `tp_address_province` varchar(50) NOT NULL,
  `tp_address_commune` varchar(50) NOT NULL,
  `tp_address_quartier` varchar(50) NOT NULL,
  `tp_address_avenue` varchar(50) NOT NULL,
  `tp_address_rue` varchar(50) NOT NULL,
  `tp_address_number` varchar(10) NOT NULL,
  `vat_taxpayer` varchar(3) NOT NULL,
  `ct_taxpayer` varchar(3) NOT NULL,
  `tl_taxpayer` varchar(3) NOT NULL,
  `tp_fiscal_center` varchar(20) NOT NULL,
  `tp_activity_sector` varchar(250) NOT NULL,
  `tp_legal_form` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribuable`
--

INSERT INTO `contribuable` (`id_contribuable`, `username`, `password`, `tp_type`, `tp_name`, `tp_TIN`, `tp_trade_number`, `tp_postal_number`, `tp_phone_number`, `tp_address_province`, `tp_address_commune`, `tp_address_quartier`, `tp_address_avenue`, `tp_address_rue`, `tp_address_number`, `vat_taxpayer`, `ct_taxpayer`, `tl_taxpayer`, `tp_fiscal_center`, `tp_activity_sector`, `tp_legal_form`) VALUES
(1, '', '', '1', 'Orphee', '4000601775', '31763', '5383 Bujumbura', '22259626/79305278', 'Bujumbura mairie', 'Mukaza', 'Rohero 1', 'Rukonwe', 'Muko', '23', '1', '1', '1', '-', 'Commerce', 'S.A');

-- --------------------------------------------------------

--
-- Table structure for table `control_ibi`
--

CREATE TABLE `control_ibi` (
  `ID_CONT` int(11) NOT NULL,
  `CODE_CONT` varchar(200) NOT NULL,
  `TITRE_CONT` varchar(200) NOT NULL,
  `DESCRIPTION_CONT` text,
  `ID_STORES` int(11) DEFAULT NULL,
  `DATE_CREER_CONT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CONT_CREER_PAR` int(11) NOT NULL,
  `OPENING_START_CONT` datetime NOT NULL,
  `OPENING_CLOSE_CONT` datetime NOT NULL,
  `STATUT_CONT` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `control_ibi`
--

INSERT INTO `control_ibi` (`ID_CONT`, `CODE_CONT`, `TITRE_CONT`, `DESCRIPTION_CONT`, `ID_STORES`, `DATE_CREER_CONT`, `CONT_CREER_PAR`, `OPENING_START_CONT`, `OPENING_CLOSE_CONT`, `STATUT_CONT`) VALUES
(1, 'CTRL_IB_00001/04/22', 'Control stock', NULL, 4, '2022-04-12 14:00:49', 1, '2022-03-01 13:58:43', '2022-04-12 13:47:21', 0),
(2, 'CTRL_IB_00002/04/22', 'Control stock', NULL, 1, '2022-04-16 09:59:52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'CTRL_IB_00003/04/22', 'Control stock', NULL, 1, '2022-04-16 10:00:29', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'CTRL_IB_00004/04/22', 'Control stock', '', 4, '2022-04-16 10:10:57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 'CTRL_IB_00005/04/22', 'Control stock', '', 4, '2022-04-16 10:52:31', 1, '2022-04-16 10:52:08', '2022-04-16 10:52:08', 0),
(6, 'CTRL_IB_00006/04/22', 'Control stock', '', 4, '2022-04-16 10:54:08', 1, '2022-04-16 10:53:24', '2022-04-16 10:53:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `title`, `subject`, `table_name`, `primary_key`, `page_read`, `page_create`, `page_update`) VALUES
(43, 'Restaurant Type Clients', 'Restaurant Type Clients', 'pos_type_clients', 'ID_TYPE_CLIENT', 'yes', 'yes', 'yes'),
(44, 'Client File', 'Client File', 'client_file', 'CLIENT_FILE_ID', 'yes', 'yes', 'yes'),
(45, 'Requisiton transfert', 'Requisiton transfert', 'pos_ibi_requisition_trans', 'ID_REQ', 'yes', 'yes', 'yes'),
(24, 'Patients', 'Patients', 'patients', 'ID_PATIENT', 'yes', 'yes', 'yes'),
(37, 'Patient File', 'Patient File', 'patient_file', 'PATIENT_FILE_ID', 'yes', 'yes', 'yes'),
(49, 'Marge Prix', 'Marge Prix', 'marge_prix', 'ID_MARGE', 'yes', 'yes', 'yes'),
(42, 'Restaurant Clients', 'Restaurant Clients', 'pos_clients', 'ID_CLIENT', 'yes', 'yes', 'yes'),
(46, 'Restaurant Ibi Commandes', 'Restaurant Ibi Commandes', 'pos_ibi_commandes', 'ID_pos_IBI_COMMANDES', 'yes', 'yes', 'yes'),
(47, 'Restaurant Depenses', 'Restaurant Depenses', 'pos_depenses', 'ID_DEPENSE', 'yes', 'yes', 'yes'),
(48, 'Restaurant Categorie Depense', 'Restaurant Categorie Depense', 'pos_categorie_depense', 'ID_CATEGORIE_DEPENSE', 'yes', 'yes', 'yes'),
(51, 'Settings App', 'Settings App', 'settings_app', 'ID_SETTING', 'yes', 'yes', 'yes'),
(52, 'Flux Caisse', 'Flux Caisse', 'pos_flux_caisse', 'ID_FLUX_CAISSE', 'yes', 'yes', 'yes'),
(53, 'Session', 'Session', 'pos_session', 'ID_SESSION', 'yes', 'yes', 'yes'),
(54, 'Categorie Flux Caisse', 'Categorie Flux Caisse', 'pos_categorie_flux_caisse', 'ID_CATEGORIE', 'yes', 'yes', 'yes'),
(55, 'Type Flux Caisse', 'Type Flux Caisse', 'pos_activite_flux_caisse', 'ID_ACTIVITE', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `crud_custom_option`
--

CREATE TABLE `crud_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_custom_option`
--

INSERT INTO `crud_custom_option` (`id`, `crud_field_id`, `crud_id`, `option_value`, `option_label`) VALUES
(4, 429, 8, '2', 'Medicament'),
(3, 429, 8, '1', 'Materiel'),
(10, 581, 24, 'M', 'M'),
(9, 581, 24, 'F', 'F'),
(12, 646, 26, 'pourcent', 'pourcent'),
(14, 688, 28, 'pourcent', 'pourcent'),
(16, 820, 30, '1', 'Oui'),
(17, 834, 31, 'Vaccant', 'Vaccant'),
(18, 834, 31, 'Ambulant', 'Ambulant'),
(22, 953, 35, '1', 'cash'),
(26, 1005, 37, '1', 'cash'),
(25, 1004, 37, '1', 'Ok'),
(30, 1122, 41, '1', 'Sans ingredient'),
(29, 1122, 41, '0', 'Avec ingredient'),
(34, 1174, 42, '1', 'personnel'),
(33, 1174, 42, '0', 'ordinaire');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field`
--

CREATE TABLE `crud_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_form` varchar(10) DEFAULT NULL,
  `show_update_form` varchar(10) DEFAULT NULL,
  `show_detail_page` varchar(10) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field`
--

INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
(23, 1, 'DELETED_DATE_ACTES', 'DELETED_DATE_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(22, 1, 'MODIFIED_BY_ACTES', 'MODIFIED_BY_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(21, 1, 'CREATED_BY_ACTES', 'CREATED_BY_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(20, 1, 'DATE_MOD_ACTES', 'DATE_MOD_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(19, 1, 'DATE_CREATION_ACTES', 'DATE_CREATION_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(18, 1, 'CATEGORIE_ALLOWED', 'CATEGORIE_ALLOWED', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(17, 1, 'CODE_BAR', 'CODE_BAR', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(16, 1, 'PRIX_UNITAIRE', 'PRIX_UNITAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(15, 1, 'NAME_ACTES', 'NAME_ACTES', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(14, 1, 'ID_ACTES', 'ID_ACTES', 'number', '', '', '', 'yes', 1, '', '', ''),
(24, 1, 'DELETED_STATUS_ACTES', 'DELETED_STATUS_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(25, 1, 'DELETED_USER_ACTES', 'DELETED_USER_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(26, 1, 'CONSULTATION', 'CONSULTATION', 'number', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(163, 2, 'DELETE_STATUS_RAYON', 'DELETE_STATUS_RAYON', 'number', '', '', '', '', 8, '', '', ''),
(162, 2, 'MODIFIED_BY_RAYON', 'MODIFIED_BY_RAYON', 'current_user_id', 'yes', '', 'yes', 'yes', 7, '', '', ''),
(161, 2, 'CREATED_BY_RAYON', 'CREATED_BY_RAYON', 'current_user_id', 'yes', 'yes', '', 'yes', 6, '', '', ''),
(160, 2, 'DATE_MOD_RAYON', 'DATE_MOD_RAYON', 'timestamp', 'yes', '', 'yes', 'yes', 5, '', '', ''),
(159, 2, 'DATE_CREATION_RAYON', 'DATE_CREATION_RAYON', 'timestamp', 'yes', 'yes', '', 'yes', 4, '', '', ''),
(158, 2, 'DESCRIPTION_RAYON', 'DESCRIPTION_RAYON', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(157, 2, 'TITRE_RAYON', 'TITRE_RAYON', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(156, 2, 'ID_RAYON', 'ID_RAYON', 'number', '', '', '', '', 1, '', '', ''),
(38, 3, 'ID_STORE', 'ID_STORE', 'number', '', '', '', 'yes', 1, '', '', ''),
(39, 3, 'STATUS_STORE', 'STATUS_STORE', 'current_user_username', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(40, 3, 'NAME_STORE', 'NAME_STORE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(41, 3, 'IMAGE_STORE', 'IMAGE_STORE', 'file', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(42, 3, 'DESCRIPTION_STORE', 'DESCRIPTION_STORE', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(43, 3, 'DATE_CREATION_STORE', 'DATE_CREATION_STORE', 'datetime', 'yes', 'yes', '', 'yes', 6, '', '', ''),
(44, 3, 'DATE_MOD_STORE', 'DATE_MOD_STORE', 'datetime', 'yes', '', 'yes', 'yes', 7, '', '', ''),
(45, 3, 'CREATED_BY_STORE', 'CREATED_BY_STORE', 'current_user_id', 'yes', 'yes', '', 'yes', 8, '', '', ''),
(46, 3, 'MODIFIED_BY_STORE', 'MODIFIED_BY_STORE', 'current_user_id', 'yes', '', 'yes', 'yes', 9, '', '', ''),
(47, 3, 'DELETE_STATUS_STORE', 'DELETE_STATUS_STORE', 'number', '', '', '', '', 10, '', '', ''),
(48, 3, 'DELETE_DATE_STORE', 'DELETE_DATE_STORE', 'datetime', '', '', '', '', 11, '', '', ''),
(49, 3, 'DELETE_BY_STORE', 'DELETE_BY_STORE', 'number', '', '', '', '', 12, '', '', ''),
(50, 3, 'DELETE_COMMENT_STORE', 'DELETE_COMMENT_STORE', 'editor_wysiwyg', '', '', '', '', 13, '', '', ''),
(51, 4, 'ID_ACTES', 'ID_ACTES', 'number', '', '', '', 'yes', 1, '', '', ''),
(52, 4, 'NAME_ACTES', 'NAME_ACTES', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(53, 4, 'PRIX_UNITAIRE', 'PRIX_UNITAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(54, 4, 'CODE_BAR', 'CODE_BAR', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(55, 4, 'CATEGORIE_ALLOWED', 'CATEGORIE_ALLOWED', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(56, 4, 'DATE_CREATION_ACTES', 'DATE_CREATION_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(57, 4, 'DATE_MOD_ACTES', 'DATE_MOD_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(58, 4, 'CREATED_BY_ACTES', 'CREATED_BY_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(59, 4, 'MODIFIED_BY_ACTES', 'MODIFIED_BY_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(60, 4, 'DELETED_DATE_ACTES', 'DELETED_DATE_ACTES', 'datetime', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(61, 4, 'DELETED_STATUS_ACTES', 'DELETED_STATUS_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(62, 4, 'DELETED_USER_ACTES', 'DELETED_USER_ACTES', 'number', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(63, 4, 'CONSULTATION', 'CONSULTATION', 'number', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(1112, 5, 'DELETED_USER_ACTES_CATEGORIE', 'DELETED_USER_ACTES_CATEGORIE', 'number', '', '', '', '', 12, '', '', ''),
(1111, 5, 'DELETED_STATUS_ACTES_CATEGORIE', 'DELETED_STATUS_ACTES_CATEGORIE', 'number', '', '', '', '', 11, '', '', ''),
(1110, 5, 'DELETED_DATE_ACTES_CATEGORIE', 'DELETED_DATE_ACTES_CATEGORIE', 'datetime', '', '', '', '', 10, '', '', ''),
(1109, 5, 'MODIFIED_BY_ACTES_CATEGORIE', 'Modifiee par', 'current_user_id', '', '', 'yes', 'yes', 9, '', '', ''),
(1107, 5, 'DATE_MOD_ACTES_CATEGORIE', 'Modifier Le', 'timestamp', '', '', 'yes', 'yes', 7, '', '', ''),
(1108, 5, 'CREATED_BY_ACTES_CATEGORIE', 'Auteur', 'current_user_id', 'yes', 'yes', '', 'yes', 8, '', '', ''),
(1106, 5, 'DATE_CREATION_ACTES_CATEGORIE', 'Cree Le', 'timestamp', 'yes', 'yes', '', 'yes', 6, '', '', ''),
(1104, 5, 'ACCESS_CATEGORIE', 'Access Groupe', 'select_multiple', 'yes', 'yes', 'yes', 'yes', 4, 'aauth_groups', 'id', 'name'),
(1105, 5, 'REF_COMPTABLE', 'REF_COMPTABLE', 'number', '', '', '', '', 5, '', '', ''),
(75, 6, 'ID_DEPARTEMENT', 'ID_DEPARTEMENT', 'number', '', '', '', 'yes', 1, '', '', ''),
(76, 6, 'DESIGNATION_DEPARTEMENT', 'DESIGNATION_DEPARTEMENT', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(77, 6, 'DATE_CREATION_DEPARTEMENTS', 'DATE_CREATION_DEPARTEMENTS', 'datetime', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(78, 6, 'DATE_MOD_DEPARTEMENTS', 'DATE_MOD_DEPARTEMENTS', 'datetime', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(79, 6, 'CREATED_BY_DEPARTEMENTS', 'CREATED_BY_DEPARTEMENTS', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(80, 6, 'MODIFIED_BY_DEPARTEMENTS', 'MODIFIED_BY_DEPARTEMENTS', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(81, 6, 'DELETED_DATE_DEPARTEMENTS', 'DELETED_DATE_DEPARTEMENTS', 'datetime', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(82, 6, 'DELETED_STATUS_DEPARTEMENTS', 'DELETED_STATUS_DEPARTEMENTS', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(83, 6, 'DELETED_USER_DEPARTEMENTS', 'DELETED_USER_DEPARTEMENTS', 'number', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(154, 7, 'DATE_MOD_FLOOR', 'Date modification', 'datetime', '', '', '', '', 9, '', '', ''),
(153, 7, 'CREATED_BY_FLOOR', 'Créer par ', 'current_user_id', 'yes', '', '', 'yes', 8, '', '', ''),
(150, 7, 'DELETE_BY_FLOOR', 'Supprimer par', 'number', '', '', '', '', 5, '', '', ''),
(151, 7, 'DELETE_COMMENT_FLOOR', 'Suppression comment', 'editor_wysiwyg', '', '', '', '', 6, '', '', ''),
(152, 7, 'DATE_CREATED_FLOOR', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(149, 7, 'DELETE_DATE_FLOOR', 'Date suppression', 'datetime', '', '', '', '', 4, '', '', ''),
(148, 7, 'DESCRIPTION_FLOOR', 'Description', 'textarea', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(146, 7, 'ID_FLOOR', 'ID_FLOOR', 'number', '', '', '', '', 1, '', '', ''),
(147, 7, 'NAME_FLOOR', 'Nom etage', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(433, 8, 'MODIFIED_BY_CATEGORIE', 'MODIFIED_BY_CATEGORIE', 'current_user_id', 'yes', '', 'yes', 'yes', 8, '', '', ''),
(434, 8, 'DELETE_STATUS_CATEGORIE', 'DELETE_STATUS_CATEGORIE', 'number', '', '', '', '', 9, '', '', ''),
(435, 8, 'DELETE_DATE_CATEGORIE', 'DELETE_DATE_CATEGORIE', 'datetime', '', '', '', '', 10, '', '', ''),
(432, 8, 'CREATED_BY_CATEGORIE', 'CREATED_BY_CATEGORIE', 'current_user_id', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(431, 8, 'DATE_MOD_CATEGORIE', 'DATE_MOD_CATEGORIE', 'timestamp', 'yes', '', 'yes', 'yes', 6, '', '', ''),
(430, 8, 'DATE_CREATION_CATEGORIE', 'DATE_CREATION_CATEGORIE', 'timestamp', 'yes', 'yes', '', 'yes', 5, '', '', ''),
(429, 8, 'PARENT_REF_ID_CATEGORIE', 'PARENT_REF_ID_CATEGORIE', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'hospital_store_1_ibi_categories', 'ID_CATEGORIE', 'NOM_CATEGORIE'),
(428, 8, 'DESCRIPTION_CATEGORIE', 'DESCRIPTION_CATEGORIE', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(427, 8, 'NOM_CATEGORIE', 'NOM_CATEGORIE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(155, 7, 'MODIFIED_BY_FLOOR', 'Modifier par', 'number', '', '', '', 'yes', 10, '', '', ''),
(164, 2, 'DELETE_DATE_RAYON', 'DELETE_DATE_RAYON', 'datetime', '', '', '', '', 9, '', '', ''),
(165, 2, 'DELETE_BY_RAYON', 'DELETE_BY_RAYON', 'number', '', '', '', '', 10, '', '', ''),
(166, 2, 'DELETE_COMMENT_RAYON', 'DELETE_COMMENT_RAYON', 'editor_wysiwyg', '', '', '', '', 11, '', '', ''),
(167, 9, 'ID_FLOOR', 'ID_FLOOR', 'number', '', '', '', '', 1, '', '', ''),
(168, 9, 'NAME_FLOOR', 'Nom etage', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(169, 9, 'DESCRIPTION_FLOOR', 'Description', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(170, 9, 'DELETE_DATE_FLOOR', 'Date suppression', 'datetime', '', '', '', '', 4, '', '', ''),
(171, 9, 'DELETE_BY_FLOOR', 'Supprimer par', 'number', '', '', '', '', 5, '', '', ''),
(172, 9, 'DELETE_COMMENT_FLOOR', 'Suppression comment', 'textarea', '', '', '', '', 6, '', '', ''),
(173, 9, 'DATE_CREATED_FLOOR', 'Date création', 'timestamp', 'yes', '', '', 'yes', 7, '', '', ''),
(174, 9, 'CREATED_BY_FLOOR', 'Créer par ', 'current_user_id', 'yes', '', '', 'yes', 8, '', '', ''),
(175, 9, 'DATE_MOD_FLOOR', 'Date modification', 'datetime', '', '', '', '', 9, '', '', ''),
(176, 9, 'MODIFIED_BY_FLOOR', 'Modifier par', 'input', '', '', '', 'yes', 10, '', '', ''),
(177, 10, 'ID_REQ', 'ID_REQ', 'number', '', '', '', '', 1, '', '', ''),
(178, 10, 'TITLE_REQ', 'TITLE_REQ', 'input', '', '', '', '', 2, '', '', ''),
(179, 10, 'DESCRIPTION_REQ', 'DESCRIPTION_REQ', 'input', '', '', '', '', 3, '', '', ''),
(180, 10, 'APROUVED_REQ', 'APROUVED_REQ', 'number', '', '', '', '', 4, '', '', ''),
(181, 10, 'REF_ARTICLE_REQ', 'REF_ARTICLE_REQ', 'input', '', '', '', '', 5, '', '', ''),
(182, 10, 'QUANTITE_REQ', 'QUANTITE_REQ', 'number', '', '', '', '', 6, '', '', ''),
(183, 10, 'APROUVED_BY_REQ', 'APROUVED_BY_REQ', 'number', '', '', '', '', 7, '', '', ''),
(184, 10, 'TYPE_REQ', 'TYPE_REQ', 'input', '', '', '', '', 8, '', '', ''),
(185, 10, 'AUTHOR_REQ', 'AUTHOR_REQ', 'input', '', '', '', '', 9, '', '', ''),
(186, 10, 'DATE_CREATION_REQ', 'DATE_CREATION_REQ', 'datetime', 'yes', '', '', '', 10, '', '', ''),
(187, 10, 'DATE_MOD_REQ', 'DATE_MOD_REQ', 'datetime', '', '', '', '', 11, '', '', ''),
(188, 10, 'CREATED_BY_REQ', 'CREATED_BY_REQ', 'current_user_id', 'yes', '', '', '', 12, '', '', ''),
(189, 10, 'MODIFIED_BY_REQ', 'MODIFIED_BY_REQ', 'current_user_id', '', '', '', 'yes', 13, '', '', ''),
(190, 10, 'DELETE_STATUS_REQ', 'DELETE_STATUS_REQ', 'number', '', '', '', '', 14, '', '', ''),
(191, 10, 'DELETE_DATE_REQ', 'DELETE_DATE_REQ', 'datetime', '', '', '', '', 15, '', '', ''),
(192, 10, 'DELETED_BY_REQ', 'DELETED_BY_REQ', 'current_user_id', '', '', '', 'yes', 16, '', '', ''),
(193, 10, 'DELETED_COMMENTS_REQ', 'DELETED_COMMENTS_REQ', 'input', '', '', '', '', 17, '', '', ''),
(225, 11, 'CREATED_BY_FLOOR', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(224, 11, 'DATE_CREATED_FLOOR', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(223, 11, 'DELETE_STATUS_FLOOR', 'DELETE_STATUS_FLOOR', 'number', '', '', '', 'yes', 7, '', '', ''),
(222, 11, 'DELETE_COMMENT_FLOOR', 'DELETE_COMMENT_FLOOR', 'editor_wysiwyg', '', '', '', '', 6, '', '', ''),
(221, 11, 'DELETE_BY_FLOOR', 'DELETE_BY_FLOOR', 'number', '', '', '', '', 5, '', '', ''),
(220, 11, 'DELETE_DATE_FLOOR', 'DELETE_DATE_FLOOR', 'datetime', '', '', '', '', 4, '', '', ''),
(219, 11, 'DESCRIPTION_FLOOR', 'Description', 'textarea', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(218, 11, 'NAME_FLOOR', 'Nom etage', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(217, 11, 'ID_FLOOR', 'ID_FLOOR', 'number', '', '', '', '', 1, '', '', ''),
(436, 8, 'DELETE_BY_CATEGORIE', 'DELETE_BY_CATEGORIE', 'number', '', '', '', '', 11, '', '', ''),
(426, 8, 'ID_CATEGORIE', 'ID_CATEGORIE', 'number', '', '', '', '', 1, '', '', ''),
(226, 11, 'DATE_MOD_FLOOR', 'Date modication', 'datetime', '', '', '', '', 10, '', '', ''),
(227, 11, 'MODIFIED_BY_FLOOR', 'Modifier par', 'number', '', '', '', '', 11, '', '', ''),
(228, 12, 'ID_ARTICLE', 'ID_ARTICLE', 'number', '', '', '', '', 1, '', '', ''),
(229, 12, 'DESIGN_ARTICLE', 'DESIGN_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(230, 12, 'CODEBAR_ARTICLE', 'CODEBAR_ARTICLE', 'input', 'yes', '', '', 'yes', 3, '', '', ''),
(231, 12, 'REF_RAYON_ARTICLE', 'REF_RAYON_ARTICLE', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'hospital_store_1_ibi_rayons', 'ID_RAYON', 'TITRE_RAYON'),
(232, 12, 'REF_CATEGORIE_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'hospital_store_1_ibi_categories', 'ID_CATEGORIE', 'NOM_CATEGORIE'),
(233, 12, 'QUANTITY_ARTICLE', 'QUANTITY_ARTICLE', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(234, 12, 'PRIX_DACHAT_ARTICLE', 'PRIX_DACHAT_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(235, 12, 'PRIX_DE_VENTE_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(236, 12, 'PRIX_DE_VENTE_SPECIAL_ARTICLE', 'PRIX_DE_VENTE_SPECIAL_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(237, 12, 'UNITE_ARTICLE', 'UNITE_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(238, 12, 'PRIX_PROMOTIONEL_ARTICLE', 'PRIX_PROMOTIONEL_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(239, 12, 'SPECIAL_PRICE_START_DATE_ARTICLE', 'SPECIAL_PRICE_START_DATE_ARTICLE', 'datetime', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(240, 12, 'SPECIAL_PRICE_END_DATE_ARTICLE', 'SPECIAL_PRICE_END_DATE_ARTICLE', 'datetime', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(241, 12, 'DESCRIPTION_ARTICLE', 'DESCRIPTION_ARTICLE', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(242, 12, 'MINIMUM_QUANTITY_ARTICLE', 'MINIMUM_QUANTITY_ARTICLE', 'input', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(243, 12, 'DATE_CREATION_ARTICLE', 'DATE_CREATION_ARTICLE', 'timestamp', 'yes', 'yes', '', 'yes', 16, '', '', ''),
(244, 12, 'DATE_MOD_ARTICLE', 'DATE_MOD_ARTICLE', 'timestamp', 'yes', '', 'yes', 'yes', 17, '', '', ''),
(245, 12, 'CREATED_BY_ARTICLE', 'CREATED_BY_ARTICLE', 'current_user_id', 'yes', 'yes', '', 'yes', 18, '', '', ''),
(246, 12, 'MODIFIED_BY_ARTICLE', 'MODIFIED_BY_ARTICLE', 'current_user_id', 'yes', '', 'yes', 'yes', 19, '', '', ''),
(247, 12, 'DELETE_STATUS_ARTICLE', 'DELETE_STATUS_ARTICLE', 'number', '', '', '', '', 20, '', '', ''),
(248, 12, 'DELETE_DATE_ARTICLE', 'DELETE_DATE_ARTICLE', 'datetime', '', '', '', '', 21, '', '', ''),
(249, 12, 'DELETE_BY_ARTICLE', 'DELETE_BY_ARTICLE', 'number', '', '', '', '', 22, '', '', ''),
(250, 12, 'DELETE_COMMENT_ARTICLE', 'DELETE_COMMENT_ARTICLE', 'editor_wysiwyg', '', '', '', '', 23, '', '', ''),
(389, 15, 'EXAMEN_DELETE_BY', 'EXAMEN_DELETE_BY', 'number', '', '', '', '', 14, '', '', ''),
(299, 13, 'DELETED_DATE_NURSE_ACTIVITY', 'DELETED_DATE_NURSE_ACTIVITY', 'input', '', '', '', '', 19, '', '', ''),
(300, 13, 'DELETED_STATUS_NURSE_ACTIVITY', 'DELETED_STATUS_NURSE_ACTIVITY', 'input', '', '', '', '', 20, '', '', ''),
(301, 13, 'DELETED_USER_NURSE_ACTIVITY', 'DELETED_USER_NURSE_ACTIVITY', 'input', '', '', '', '', 21, '', '', ''),
(298, 13, 'MODIFIED_BY_NURSE_ACTIVITY', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 18, '', '', ''),
(297, 13, 'CREATED_BY_NURSE_ACTIVITY', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 17, '', '', ''),
(296, 13, 'DATE_MOD_NURSE_ACTIVITY', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 16, '', '', ''),
(295, 13, 'DATE_CREATION_NURSE_ACTIVITY', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 15, '', '', ''),
(294, 13, 'DOCTOR_ID', 'Docteur', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'aauth_users', 'id', 'username'),
(293, 13, 'TIME_OF_OPERATION', 'Jour Operation', 'datetime', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(292, 13, 'DATE', 'DATE', 'datetime', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(291, 13, 'ACTE_ANESTESIQUES', 'Acte Anestesique', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'acte_anestesique', 'ID_ACTE_ANESTESIQUE', 'DESIGNATION_ACTE_ANESTESIQUE'),
(290, 13, 'ACTE_ID', 'Acte', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(289, 13, 'PATIENT_FILE_ID_NURSE_ACTIVITY', 'Patient File', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'patient_file', 'PATIENT_FILE_ID', 'PATIENT_FILE_CODE'),
(288, 13, 'ID_NURSE_ACTIVITY', 'ID_NURSE_ACTIVITY', 'number', '', '', '', 'yes', 1, '', '', ''),
(372, 14, 'CATEGORY_DELETE_STATUS', 'CATEGORY_DELETE_STATUS', 'number', '', '', '', '', 7, '', '', ''),
(371, 14, 'CATEGORY_MODIFIED_BY', 'Modifier par', 'input', 'yes', '', '', 'yes', 6, '', '', ''),
(370, 14, 'CATEGORY_CREATED_BY', 'Cree par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(369, 14, 'CATEGORY_DATE_MOD', 'Date modification', 'datetime', 'yes', '', 'yes', 'yes', 4, '', '', ''),
(368, 14, 'CATEGORY_DATE_CREATION', 'Date creation', 'timestamp', 'yes', 'yes', '', 'yes', 3, '', '', ''),
(367, 14, 'CATEGORY_NAME', 'Categorie', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(366, 14, 'CATEGORY_ID', 'CATEGORY_ID', 'number', '', '', '', '', 1, '', '', ''),
(390, 15, 'EXAMEN_DELETE_COMMENT', 'EXAMEN_DELETE_COMMENT', 'input', '', '', '', '', 15, '', '', ''),
(386, 15, 'EXAMEN_PERMISSION', 'EXAMEN_PERMISSION', 'number', '', '', '', '', 11, '', '', ''),
(387, 15, 'EXAMEN_DELETE_STATUS', 'EXAMEN_DELETE_STATUS', 'number', '', '', '', '', 12, '', '', ''),
(388, 15, 'EXAMEN_DELETE_DATE', 'EXAMEN_DELETE_DATE', 'datetime', '', '', '', '', 13, '', '', ''),
(385, 15, 'EXAMEN_MODIFIED_BY', 'Modifie par', 'input', 'yes', '', 'yes', 'yes', 10, '', '', ''),
(384, 15, 'EXAMEN_CREATED_BY', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(382, 15, 'EXAMEN_DATE_CREATION', 'Date creation', 'datetime', 'yes', '', '', 'yes', 7, '', '', ''),
(383, 15, 'EXAMEN_DATE_MOD', 'Date modification', 'datetime', 'yes', '', 'yes', 'yes', 8, '', '', ''),
(381, 15, 'EXAMEN_PRICE', 'Prix', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(380, 15, 'EXAMEN_CODEBAR', 'Code bar', 'input', '', '', 'yes', 'yes', 5, '', '', ''),
(379, 15, 'EXAMEN_NAME', 'Nom examen', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(349, 16, 'DELETED_STATUS_ACTE_ANESTESIQUE', 'DELETED_STATUS_ACTE_ANESTESIQUE', 'number', '', '', '', '', 9, '', '', ''),
(348, 16, 'DELETED_DATE_ACTE_ANESTESIQUE', 'DELETED_DATE_ACTE_ANESTESIQUE', 'datetime', '', '', '', '', 8, '', '', ''),
(347, 16, 'MODIFIED_BY_ACTE_ANESTESIQUE', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 7, '', '', ''),
(346, 16, 'CREATED_BY_ACTE_ANESTESIQUE', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 6, '', '', ''),
(345, 16, 'DATE_MOD_ACTE_ANESTESIQUE', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 5, '', '', ''),
(344, 16, 'DATE_CREATION_ACTE_ANESTESIQUE', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 4, '', '', ''),
(343, 16, 'POURCENTAGE_ACTE_ANESTESIQUE', 'Pourcentage', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(342, 16, 'DESIGNATION_ACTE_ANESTESIQUE', 'Designation', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(341, 16, 'ID_ACTE_ANESTESIQUE', 'ID_ACTE_ANESTESIQUE', 'number', '', '', '', 'yes', 1, '', '', ''),
(378, 15, 'EXAMEN_SKU', 'Id examen', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(377, 15, 'EXAMEN_CATEGORY_ID', 'Categorie', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'labo_categorie_examen', 'CATEGORY_ID', 'CATEGORY_NAME'),
(376, 15, 'EXAMEN_ID', 'EXAMEN_ID', 'number', '', '', '', '', 1, '', '', ''),
(350, 16, 'DELETED_USER_ACTE_ANESTESIQUE', 'DELETED_USER_ACTE_ANESTESIQUE', 'number', '', '', '', '', 10, '', '', ''),
(373, 14, 'CATEGORY_DELETE_DATE', 'CATEGORY_DELETE_DATE', 'datetime', '', '', '', '', 8, '', '', ''),
(374, 14, 'CATEGORY_DELETE_BY', 'CATEGORY_DELETE_BY', 'number', '', '', '', '', 9, '', '', ''),
(375, 14, 'CATEGORY_DELETE_COMMENT', 'CATEGORY_DELETE_COMMENT', 'input', '', '', '', '', 10, '', '', ''),
(391, 17, 'PARAMETRE_ID', 'PARAMETRE_ID', 'number', '', '', '', '', 1, '', '', ''),
(392, 17, 'PARAMETRE_SORT_NUMBER', 'PARAMETRE_SORT_NUMBER', 'number', '', '', '', '', 2, '', '', ''),
(393, 17, 'PARAMETRE_EXAMEN_ID', 'Examen', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'labo_examens', 'EXAMEN_ID', 'EXAMEN_NAME'),
(394, 17, 'PARAMETRE_NAME', 'Parametre', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(395, 17, 'PARAMETRE_UNIT', 'Unite', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(396, 17, 'PARAMETRE_USUAL_VALUES', 'Valeurs usuelles', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(397, 17, 'PARAMETRE_DATE_CREATION', 'Date creation', 'timestamp', 'yes', '', '', 'yes', 7, '', '', ''),
(398, 17, 'PARAMETRE_DATE_MOD', 'PARAMETRE_DATE_MOD', 'datetime', 'yes', '', 'yes', 'yes', 8, '', '', ''),
(399, 17, 'PARAMETRE_PERMISSION', 'PARAMETRE_PERMISSION', 'number', '', '', '', '', 9, '', '', ''),
(400, 17, 'PARAMETRE_CREATED_BY', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(401, 17, 'PARAMETRE_MODIFIED_BY', 'PARAMETRE_MODIFIED_BY', 'number', '', '', '', '', 11, '', '', ''),
(402, 17, 'PARAMETRE_STATUS', 'PARAMETRE_STATUS', 'number', '', '', '', '', 12, '', '', ''),
(403, 17, 'PARAMETRE_DELETE_DATE', 'PARAMETRE_DELETE_DATE', 'datetime', '', '', '', '', 13, '', '', ''),
(404, 17, 'PARAMETRE_DELETE_BY', 'PARAMETRE_DELETE_BY', 'number', '', '', '', '', 14, '', '', ''),
(405, 17, 'PARAMETRE_DELETE_COMMENT', 'PARAMETRE_DELETE_COMMENT', 'input', '', '', '', '', 15, '', '', ''),
(1072, 18, 'DATE_MOD_ROOM_TYPE', 'Date modification', 'datetime', '', '', '', '', 9, '', '', ''),
(1071, 18, 'CREATED_BY_ROOM_TYPE', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1070, 18, 'DATE_CREATED_ROOM_TYPE', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(1069, 18, 'DELETE_STATUS_ROOM_TYPE', 'DELETE_STATUS_ROOM_TYPE', 'number', '', '', '', '', 6, '', '', ''),
(1068, 18, 'DELETE_COMMENT_ROOM_TYPE', 'DELETE_COMMENT_ROOM_TYPE', 'input', '', '', '', '', 5, '', '', ''),
(1067, 18, 'DELETE_BY_ROOM_TYPE', 'DELETE_BY_ROOM_TYPE', 'number', '', '', '', '', 4, '', '', ''),
(1066, 18, 'DELETE_DATE_ROOM_TYPE', 'DELETE_DATE_ROOM_TYPE', 'datetime', '', '', '', '', 3, '', '', ''),
(1065, 18, 'NAME_ROOM_TYPE', 'Nom du type de chambre', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1064, 18, 'ID_ROOM_TYPE', 'ID_ROOM_TYPE', 'number', '', '', '', '', 1, '', '', ''),
(437, 8, 'DELETE_COMMENT_CATEGORIE', 'DELETE_COMMENT_CATEGORIE', 'editor_wysiwyg', '', '', '', '', 12, '', '', ''),
(438, 19, 'category_id', 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(439, 19, 'category_name', 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(440, 19, 'category_desc', 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(441, 20, 'category_id', 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(442, 20, 'category_name', 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(443, 20, 'category_desc', 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(444, 21, 'ID_ROOM', 'ID_ROOM', 'number', '', '', '', '', 1, '', '', ''),
(445, 21, 'NO_ROOM', 'Numéro', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(446, 21, 'PRICE_ROOM', 'Prix', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(447, 21, 'TYPE_ID_ROOM', 'Type chambre', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'room_type', 'ID_ROOM_TYPE', 'NAME_ROOM_TYPE'),
(448, 21, 'FLOOR_ID_ROOM', 'Étage ', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'floor', 'ID_FLOOR', 'NAME_FLOOR'),
(449, 21, 'CODE_BAR_ROOM', 'Code bar', 'input', 'yes', '', '', 'yes', 6, '', '', ''),
(450, 21, 'DELETE_STATUS_ROOM', 'DELETE_STATUS_ROOM', 'number', '', '', '', '', 7, '', '', ''),
(451, 21, 'DELETE_DATE_ROOM', 'DELETE_DATE_ROOM', 'datetime', '', '', '', '', 8, '', '', ''),
(452, 21, 'DELETE_BY_ROOM', 'DELETE_BY_ROOM', 'datetime', '', '', '', '', 9, '', '', ''),
(453, 21, 'DELETE_DESCRIPTION_ROOM', 'DELETE_DESCRIPTION_ROOM', 'datetime', '', '', '', '', 10, '', '', ''),
(454, 21, 'DATE_CREATED_ROOM', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(455, 21, 'CREATED_BY_ROOM', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(456, 21, 'DATE_MOD_ROOM', 'DATE_MOD_ROOM', 'datetime', '', '', '', '', 13, '', '', ''),
(457, 21, 'MODIFIED_BY_ROOM', 'MODIFIED_BY_ROOM', 'number', '', '', '', '', 14, '', '', ''),
(480, 22, 'DATE_CREATED_SOCIETE', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(479, 22, 'DELETE_DESCRIPTION_SOCIETE', 'DELETE_DESCRIPTION_SOCIETE', 'textarea', '', '', '', '', 9, '', '', ''),
(478, 22, 'DELETE_BY_SOCIETE', 'DELETE_BY_SOCIETE', 'number', '', '', '', '', 8, '', '', ''),
(477, 22, 'DELETE_DATE_SOCIETE', 'DELETE_DATE_SOCIETE', 'datetime', '', '', '', '', 7, '', '', ''),
(476, 22, 'DELETE_STATUS_SOCIETE', 'DELETE_STATUS_SOCIETE', 'number', '', '', '', '', 6, '', '', ''),
(475, 22, 'EMAIL_SOCIETE', 'Email de la société', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(474, 22, 'TEL_SOCIETE', 'Téléphone de la société ', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(473, 22, 'BP_SOCIETE', 'Boite postal', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(472, 22, 'NOM_SOCIETE', 'Nom de la société', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(471, 22, 'ID_SOCIETE', 'ID_SOCIETE', 'number', '', '', '', 'yes', 1, '', '', ''),
(481, 22, 'CREATED_BY_SOCIETE', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(482, 22, 'DATE_MOD_SOCIETE', 'DATE_MOD_SOCIETE', 'datetime', '', '', '', '', 12, '', '', ''),
(483, 22, 'MODIFIED_BY_SOCIETE', 'MODIFIED_BY_SOCIETE', 'number', '', '', '', '', 13, '', '', ''),
(503, 23, 'CREATED_BY_CONSULTATION', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(502, 23, 'DATE_CREATED_CONSULTATION', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(501, 23, 'DELETE_DESCRIPTION__CONSULTATION', 'DELETE_DESCRIPTION__CONSULTATION', 'editor_wysiwyg', '', '', '', '', 7, '', '', ''),
(500, 23, 'DELETE_BY_CONSULTATION', 'DELETE_BY_CONSULTATION', 'number', '', '', '', '', 6, '', '', ''),
(499, 23, 'DELETE_DATE_CONSULTATION', 'DELETE_DATE_CONSULTATION', 'datetime', '', '', '', '', 5, '', '', ''),
(498, 23, 'DELETE_STATUS_CONSULTATION', 'DELETE_STATUS_CONSULTATION', 'number', '', '', '', '', 4, '', '', ''),
(497, 23, 'PRIX_CONSULTATION', 'Prix consulation', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(496, 23, 'DESIGNATION_CONSULTATION', 'Désignation', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(495, 23, 'ID_CONSULTATION', 'ID_CONSULTATION', 'number', '', '', '', '', 1, '', '', ''),
(504, 23, 'DATE_MOD_CONSULTATION', 'DATE_MOD_CONSULTATION', 'datetime', '', '', '', '', 10, '', '', ''),
(505, 23, 'MODIFIED_BY_CONSULTATION', 'MODIFIED_BY_CONSULTATION', 'number', '', '', '', '', 11, '', '', ''),
(604, 24, 'MODIFIED_BY_PATIENT', 'MODIFIED_BY_PATIENT', 'number', '', '', '', '', 33, '', '', ''),
(602, 24, 'CREATED_BY_PATIENT', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 31, '', '', ''),
(603, 24, 'DATE_MOD_PATIENT', 'DATE_MOD_PATIENT', 'datetime', '', '', '', '', 32, '', '', ''),
(601, 24, 'DATE_CREATED_PATIENT', 'Date création', 'timestamp', 'yes', 'yes', 'yes', 'yes', 30, '', '', ''),
(600, 24, 'DELETE_DESCRIPTION_PATIENT', 'DELETE_DESCRIPTION_PATIENT', 'editor_wysiwyg', '', '', '', '', 29, '', '', ''),
(597, 24, 'DELETE_STATUS_PATIENT', 'DELETE_STATUS_PATIENT', 'number', '', '', '', '', 26, '', '', ''),
(598, 24, 'DELETE_DATE_PATIENT', 'DELETE_DATE_PATIENT', 'datetime', '', '', '', '', 27, '', '', ''),
(599, 24, 'DELETE_BY_PATIENT', 'DELETE_BY_PATIENT', 'datetime', '', '', '', '', 28, '', '', ''),
(596, 24, 'PARENT_PATIENT', 'PARENT_PATIENT', 'number', '', '', '', '', 25, '', '', ''),
(594, 24, 'EMEERGENCY_CONTACT_RELATIONSHIP_PATIENT', 'Téléphone de Contact en Cas d\'Urgence', 'input', '', 'yes', 'yes', 'yes', 23, '', '', ''),
(595, 24, 'EMEERGENCY_CONTACT_PHONE_PATIENT', 'Téléphone de Contact en Cas d\'Urgence', 'input', '', 'yes', 'yes', 'yes', 24, '', '', ''),
(593, 24, 'EMEERGENCY_CONTACT_NAME_PATIENT', 'Nom à Contacter en Cas d\'Urgence', 'input', '', 'yes', 'yes', 'yes', 22, '', '', ''),
(592, 24, 'OCCUPATION_PATIENT', 'Occupation', 'input', '', 'yes', 'yes', 'yes', 21, '', '', ''),
(591, 24, 'REF_SOCIETE_PATIENT', 'Société', 'select', 'yes', 'yes', 'yes', 'yes', 20, 'hospital_ibi_societes', 'ID_SOCIETE', 'NOM_SOCIETE'),
(589, 24, 'COUNTRY_PATIENT', 'COUNTRY_PATIENT', 'input', '', '', '', '', 18, '', '', ''),
(590, 24, 'REF_GROUP_PATIENT', 'REF_GROUP_PATIENT', 'number', '', '', '', '', 19, '', '', ''),
(588, 24, 'ZONE_PATIENT', 'ZONE_PATIENT', 'input', '', '', '', '', 17, '', '', ''),
(586, 24, 'CITY_PATIENT', 'Pays', 'input', '', 'yes', 'yes', 'yes', 15, '', '', ''),
(587, 24, 'PROVINCE_PATIENT', 'Province', 'select', 'yes', 'yes', 'yes', 'yes', 16, 'province', 'PROVINCE_ID', 'PROVINCE_NAME'),
(585, 24, 'AVATAR_PATIENT', 'AVATAR_PATIENT', 'file', '', 'yes', 'yes', 'yes', 14, '', '', ''),
(584, 24, 'LAST_ORDER_PATIENT', 'LAST_ORDER_PATIENT', 'input', '', 'yes', 'yes', 'yes', 13, '', '', ''),
(583, 24, 'ADRESSE_PATIENT', 'ADRESSE_PATIENT', 'input', '', 'yes', 'yes', 'yes', 12, '', '', ''),
(582, 24, 'BLOOD_GROUP_PATIENT', 'Groupe sanguin', 'select', '', 'yes', 'yes', 'yes', 11, 'blood_group', 'ID_BLOOD_GROUP', 'NAME_BLOOD_GROUP'),
(581, 24, 'SEX_PATIENT', 'Genre', 'custom_option', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(580, 24, 'DATE_NAISSANCE_PATIENT', 'Date de naissance', 'date', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(579, 24, 'DESCRIPTION_PATIENT', 'Description', 'textarea', '', 'yes', 'yes', 'yes', 8, '', '', ''),
(578, 24, 'EMAIL_PATIENT', 'Email ', 'input', '', 'yes', 'yes', 'yes', 7, '', '', ''),
(577, 24, 'TEL_PATIENT', 'Téléphone', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(576, 24, 'POIDS_PATIENT', 'Poid', 'number', '', 'yes', 'yes', 'yes', 5, '', '', ''),
(575, 24, 'PRENOM_PATIENT', 'Prenom', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(574, 24, 'NOM_PATIENT', 'Nom', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(573, 24, 'REFERENCE_PATIENT', 'Patient référence', 'input', 'yes', '', '', 'yes', 2, '', '', ''),
(572, 24, 'ID_PATIENT', 'ID_PATIENT', 'number', '', '', '', '', 1, '', '', ''),
(625, 25, 'RESULTAT_DELETE_STATUS', 'RESULTAT_DELETE_STATUS', 'number', '', '', '', '', 9, '', '', ''),
(624, 25, 'RESULTAT_MODIFIED_BY', 'RESULTAT_MODIFIED_BY', 'number', '', '', '', '', 8, '', '', ''),
(623, 25, 'RESULTAT_CREATED_BY', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(622, 25, 'RESULTAT_DATE_MOD', 'Date modification', 'datetime', '', '', 'yes', 'yes', 6, '', '', ''),
(621, 25, 'RESULTAT_DATE_CREATION', 'Date creation', 'timestamp', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(620, 25, 'RESULTAT_CONTENT', 'Resultats', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(619, 25, 'RESULTAT_STATUS', 'Status', 'number', '', '', '', '', 3, '', '', ''),
(618, 25, 'RESULTAT_COMMANDE_PRODUIT_ID', 'Examens', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'hospital_ibi_commandes_produits', 'REF_PRODUCT_CODEBAR', 'REF_PRODUCT_CODEBAR'),
(617, 25, 'RESULTAT_ID', 'RESULTAT_ID', 'number', '', '', '', '', 1, '', '', ''),
(626, 25, 'RESULTAT_DELETE_DATE', 'RESULTAT_DELETE_DATE', 'datetime', '', '', '', '', 10, '', '', ''),
(627, 25, 'RESULTAT_DELETE_BY', 'RESULTAT_DELETE_BY', 'number', '', '', '', '', 11, '', '', ''),
(628, 25, 'RESULTAT_DELETE_COMMENT', 'RESULTAT_DELETE_COMMENT', 'input', '', '', '', '', 12, '', '', ''),
(653, 26, 'DELETED_DATE_CLIENT_GROUPS', 'DELETED_DATE_CLIENT_GROUPS', 'datetime', '', '', '', '', 11, '', '', ''),
(652, 26, 'MODIFIED_BY_CLIENT_GROUPS', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 10, '', '', ''),
(651, 26, 'CREATED_BY_CLIENT_GROUPS', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 9, '', '', ''),
(650, 26, 'DATE_MOD_CLIENT_GROUPS', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 8, '', '', ''),
(649, 26, 'DATE_CREATION_CLIENT_GROUPS', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(648, 26, 'DISCOUNT_AMOUNT', 'Montant', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(647, 26, 'DISCOUNT_PERCENT', 'Pourcentage', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(646, 26, 'DISCOUNT_TYPE', 'Type', 'custom_select', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(645, 26, 'DESCRIPTION', 'Description', 'textarea', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(643, 26, 'ID', 'ID', 'number', '', '', '', 'yes', 1, '', '', ''),
(644, 26, 'NAME', 'NAME', 'input', '', '', '', '', 2, '', '', ''),
(654, 26, 'DELETED_STATUS_CLIENT_GROUPS', 'DELETED_STATUS_CLIENT_GROUPS', 'number', '', '', '', '', 12, '', '', ''),
(655, 26, 'DELETED_USER_CLIENT_GROUPS', 'DELETED_USER_CLIENT_GROUPS', 'number', '', '', '', '', 13, '', '', ''),
(656, 26, 'DELETED_COMMENT_CLIENT_GROUPS', 'DELETED_COMMENT_CLIENT_GROUPS', 'input', '', '', '', '', 14, '', '', ''),
(657, 27, 'ID_FOURNISSEUR', 'ID_FOURNISSEUR', 'number', '', '', '', '', 1, '', '', ''),
(658, 27, 'NOM_FOURNISSEUR', 'NOM_FOURNISSEUR', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(659, 27, 'BP_FOURNISSEUR', 'BP_FOURNISSEUR', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(660, 27, 'TEL_FOURNISSEUR', 'TEL_FOURNISSEUR', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(661, 27, 'EMAIL_FOURNISSEUR', 'EMAIL_FOURNISSEUR', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(662, 27, 'DESCRIPTION_FOURNISSEUR', 'DESCRIPTION_FOURNISSEUR', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(663, 27, 'DATE_CREATION_FOURNISSEUR', 'DATE_CREATION_FOURNISSEUR', 'timestamp', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(664, 27, 'DATE_MOD_FOURNISSEUR', 'DATE_MOD_FOURNISSEUR', 'timestamp', 'yes', '', 'yes', 'yes', 8, '', '', ''),
(665, 27, 'CREATED_BY_FOURNISSEUR', 'CREATED_BY_FOURNISSEUR', 'current_user_id', 'yes', 'yes', '', 'yes', 9, '', '', ''),
(666, 27, 'MODIFIED_BY_FOURNISSEUR', 'MODIFIED_BY_FOURNISSEUR', 'current_user_id', 'yes', '', 'yes', 'yes', 10, '', '', ''),
(667, 27, 'DELETE_STATUS_FOURNISSEUR', 'DELETE_STATUS_FOURNISSEUR', 'number', '', '', '', '', 11, '', '', ''),
(668, 27, 'DELETE_DATE_FOURNISSEUR', 'DELETE_DATE_FOURNISSEUR', 'datetime', '', '', '', '', 12, '', '', ''),
(669, 27, 'DELETE_BY_FOURNISSEUR', 'DELETE_BY_FOURNISSEUR', 'number', '', '', '', '', 13, '', '', ''),
(670, 27, 'DELETE_COMMENT_FOURNISSEUR', 'DELETE_COMMENT_FOURNISSEUR', 'editor_wysiwyg', '', '', '', '', 14, '', '', ''),
(695, 28, 'DELETED_DATE_CLIENT_GROUPS', 'DELETED_DATE_CLIENT_GROUPS', 'datetime', '', '', '', '', 11, '', '', ''),
(694, 28, 'MODIFIED_BY_CLIENT_GROUPS', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 10, '', '', ''),
(693, 28, 'CREATED_BY_CLIENT_GROUPS', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 9, '', '', ''),
(692, 28, 'DATE_MOD_CLIENT_GROUPS', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 8, '', '', ''),
(691, 28, 'DATE_CREATION_CLIENT_GROUPS', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(690, 28, 'DISCOUNT_AMOUNT', 'Montant', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(689, 28, 'DISCOUNT_PERCENT', 'Pourcent', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(688, 28, 'DISCOUNT_TYPE', 'Type', 'custom_select', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(687, 28, 'DESCRIPTION', 'Description', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(685, 28, 'ID', 'ID', 'number', '', '', '', 'yes', 1, '', '', ''),
(686, 28, 'NAME', 'NAME', 'input', '', '', '', '', 2, '', '', ''),
(696, 28, 'DELETED_STATUS_CLIENT_GROUPS', 'DELETED_STATUS_CLIENT_GROUPS', 'number', '', '', '', '', 12, '', '', ''),
(697, 28, 'DELETED_USER_CLIENT_GROUPS', 'DELETED_USER_CLIENT_GROUPS', 'number', '', '', '', '', 13, '', '', ''),
(698, 28, 'DELETED_COMMENT_CLIENT_GROUPS', 'DELETED_COMMENT_CLIENT_GROUPS', 'input', '', '', '', '', 14, '', '', ''),
(699, 29, 'ID_HOSPITAL_IBI_COMMANDES', 'ID_HOSPITAL_IBI_COMMANDES', 'number', '', '', '', 'yes', 1, '', '', ''),
(700, 29, 'PAYER_HOSPITAL_IBI_COMMANDES', 'PAYER_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(701, 29, 'TITRE', 'TITRE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(702, 29, 'DESCRIPTION', 'DESCRIPTION', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(703, 29, 'CODE', 'CODE', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(704, 29, 'PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES', 'PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(705, 29, 'REF_REGISTER', 'REF_REGISTER', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(706, 29, 'TYPE', 'TYPE', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(707, 29, 'DATE_CREATION', 'DATE_CREATION', 'datetime', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(708, 29, 'DATE_MOD', 'DATE_MOD', 'datetime', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(709, 29, 'PAYMENT_TYPE', 'PAYMENT_TYPE', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(710, 29, 'AUTHOR', 'AUTHOR', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(711, 29, 'SOMME_PERCU', 'SOMME_PERCU', 'input', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(712, 29, 'REMISE', 'REMISE', 'input', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(713, 29, 'RABAIS', 'RABAIS', 'input', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(714, 29, 'RISTOURNE', 'RISTOURNE', 'input', 'yes', 'yes', 'yes', 'yes', 16, '', '', ''),
(715, 29, 'REMISE_TYPE', 'REMISE_TYPE', 'input', 'yes', 'yes', 'yes', 'yes', 17, '', '', ''),
(716, 29, 'REMISE_PERCENT', 'REMISE_PERCENT', 'input', 'yes', 'yes', 'yes', 'yes', 18, '', '', ''),
(717, 29, 'RABAIS_PERCENT', 'RABAIS_PERCENT', 'input', 'yes', 'yes', 'yes', 'yes', 19, '', '', ''),
(718, 29, 'RISTOURNE_PERCENT', 'RISTOURNE_PERCENT', 'input', 'yes', 'yes', 'yes', 'yes', 20, '', '', ''),
(719, 29, 'TOTAL', 'TOTAL', 'input', 'yes', 'yes', 'yes', 'yes', 21, '', '', ''),
(720, 29, 'DISCOUNT_TYPE', 'DISCOUNT_TYPE', 'input', 'yes', 'yes', 'yes', 'yes', 22, '', '', ''),
(721, 29, 'TVA', 'TVA', 'input', 'yes', 'yes', 'yes', 'yes', 23, '', '', ''),
(722, 29, 'GROUP_DISCOUNT', 'GROUP_DISCOUNT', 'input', 'yes', 'yes', 'yes', 'yes', 24, '', '', ''),
(723, 29, 'REF_SHIPPING_ADDRESS', 'REF_SHIPPING_ADDRESS', 'number', 'yes', 'yes', 'yes', 'yes', 25, '', '', ''),
(724, 29, 'SHIPPING_AMOUNT', 'SHIPPING_AMOUNT', 'input', 'yes', 'yes', 'yes', 'yes', 26, '', '', ''),
(725, 29, 'CASHIER', 'CASHIER', 'number', 'yes', 'yes', 'yes', 'yes', 27, '', '', ''),
(726, 29, 'FORMER_SOMME_PERCU', 'FORMER_SOMME_PERCU', 'number', 'yes', 'yes', 'yes', 'yes', 28, '', '', ''),
(727, 29, 'CAUTION', 'CAUTION', 'number', 'yes', 'yes', 'yes', 'yes', 29, '', '', ''),
(728, 29, 'DATE_CREATION_HOSPITAL_IBI_COMMANDES', 'DATE_CREATION_HOSPITAL_IBI_COMMANDES', 'datetime', 'yes', 'yes', 'yes', 'yes', 30, '', '', ''),
(729, 29, 'DATE_MOD_HOSPITAL_IBI_COMMANDES', 'DATE_MOD_HOSPITAL_IBI_COMMANDES', 'datetime', 'yes', 'yes', 'yes', 'yes', 31, '', '', ''),
(730, 29, 'CREATED_BY_HOSPITAL_IBI_COMMANDES', 'CREATED_BY_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 32, '', '', ''),
(731, 29, 'MODIFIED_BY_HOSPITAL_IBI_COMMANDES', 'MODIFIED_BY_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 33, '', '', ''),
(732, 29, 'DELETED_DATE_HOSPITAL_IBI_COMMANDES', 'DELETED_DATE_HOSPITAL_IBI_COMMANDES', 'datetime', 'yes', 'yes', 'yes', 'yes', 34, '', '', ''),
(733, 29, 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES', 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 35, '', '', ''),
(734, 29, 'DELETED_USER_HOSPITAL_IBI_COMMANDES', 'DELETED_USER_HOSPITAL_IBI_COMMANDES', 'number', 'yes', 'yes', 'yes', 'yes', 36, '', '', ''),
(831, 31, 'ID_BED', 'ID_BED', 'number', '', '', '', '', 1, '', '', ''),
(830, 30, 'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS', 'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS', 'input', '', '', '', '', 24, '', '', ''),
(829, 30, 'DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS', 'DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS', 'number', '', '', '', '', 23, '', '', ''),
(828, 30, 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS', 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS', 'number', '', '', '', '', 22, '', '', ''),
(827, 30, 'DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS', 'DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS', 'datetime', '', '', '', '', 21, '', '', ''),
(826, 30, 'MODIFIED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 20, '', '', ''),
(825, 30, 'CREATED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 19, '', '', ''),
(824, 30, 'DATE_MOD_HOSPITAL_IBI_COMMANDES_PRODUITS', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 18, '', '', ''),
(823, 30, 'DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 17, '', '', ''),
(822, 30, 'DATE_COMMANDE_PRODUITS', 'Date Insertion', 'datetime', '', 'yes', '', 'yes', 16, '', '', ''),
(819, 30, 'DEPARTMENT', 'Service', 'select', 'yes', 'yes', 'yes', 'yes', 13, 'actes_categorie', 'ID_ACTES_CATEGORIE', 'DESIGNATION'),
(821, 30, 'VERIFIED_BY', 'Verifie par', 'number', '', '', '', 'yes', 15, '', '', ''),
(820, 30, 'VERIFICATION', 'Verification', 'custom_checkbox', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(818, 30, 'DOCTOR_ID', 'Docteur', 'number', '', '', '', 'yes', 12, '', '', ''),
(817, 30, 'NAME', 'Designation', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(816, 30, 'DISCOUNT_PERCENT', 'DISCOUNT_PERCENT', 'input', '', '', '', '', 10, '', '', ''),
(814, 30, 'DISCOUNT_TYPE', 'DISCOUNT_TYPE', 'input', '', '', '', '', 8, '', '', ''),
(815, 30, 'DISCOUNT_AMOUNT', 'DISCOUNT_AMOUNT', 'input', '', '', '', '', 9, '', '', ''),
(813, 30, 'PRIX_TOTAL', 'PRIX_TOTAL', 'input', '', '', '', '', 7, '', '', ''),
(810, 30, 'QUANTITE', 'Quantite', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(811, 30, 'PRIX', 'PRIX', 'input', '', '', '', '', 5, '', '', ''),
(812, 30, 'PRIX_CLIENT', 'PRIX_CLIENT', 'input', '', '', '', '', 6, '', '', ''),
(808, 30, 'REF_PRODUCT_CODEBAR', 'Code bar', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(809, 30, 'REF_COMMAND_CODE', 'Numéro Facture', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(807, 30, 'ID_HOSPITAL_IBI_COMMANDES_PRODUITS', 'ID_HOSPITAL_IBI_COMMANDES_PRODUITS', 'number', '', '', '', 'yes', 1, '', '', ''),
(832, 31, 'NAME_BED', 'Nom ', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(833, 31, 'ROOM_ID_BED', 'Chambre', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'room', 'ID_ROOM', 'NO_ROOM'),
(834, 31, 'STATUS_BED', 'Statut du lit', 'custom_option', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(835, 31, 'DELETE_DATE_BED', 'DELETE_DATE_BED', 'datetime', '', '', '', '', 5, '', '', ''),
(836, 31, 'DELETE_BY_BED', 'DELETE_BY_BED', 'number', '', '', '', '', 6, '', '', ''),
(837, 31, 'DELETE_DESCRIPTION_BED', 'DELETE_DESCRIPTION_BED', 'datetime', '', '', '', '', 7, '', '', ''),
(838, 31, 'DATE_CREATED_BED', 'Date creation', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(839, 31, 'CREATED_BY_BED', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(840, 31, 'DATE_MOD_BED', 'DATE_MOD_BED', 'datetime', '', '', '', '', 10, '', '', ''),
(841, 31, 'MODIFIED_BY_BED', 'MODIFIED_BY_BED', 'number', '', '', '', '', 11, '', '', ''),
(872, 32, 'DATE_CREATED_BED_MANAGEMENT', 'Date Creation', 'timestamp', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(871, 32, 'DELETE_STATUS_BED_MANAGEMENT', 'DELETE_STATUS_BED_MANAGEMENT', 'number', '', '', '', '', 13, '', '', ''),
(870, 32, 'DELETE_DESCRIPTION_BED_MANAGEMENT', 'DELETE_DESCRIPTION_BED_MANAGEMENT', 'editor_wysiwyg', '', '', '', '', 12, '', '', ''),
(869, 32, 'DELETE_BY_BED_MANAGEMENT', 'DELETE_BY_BED_MANAGEMENT', 'number', '', '', '', '', 11, '', '', ''),
(868, 32, 'DELETE_DATE_BED_MANAGEMENT', 'DELETE_DATE_BED_MANAGEMENT', 'datetime', '', '', '', '', 10, '', '', ''),
(867, 32, 'DELETE_USER_BED_MANAGEMENT', 'DELETE_USER_BED_MANAGEMENT', 'number', '', '', '', '', 9, '', '', ''),
(866, 32, 'DISCHARGE_TIMESTAMP_BED_MANAGEMENT', 'DISCHARGE_TIMESTAMP_BED_MANAGEMENT', 'datetime', '', '', '', '', 8, '', '', ''),
(865, 32, 'PATIENT_FILE_ID_LIT_BED_MANAGEMENT', 'PATIENT_FILE_ID_LIT_BED_MANAGEMENT', 'number', '', '', '', '', 7, '', '', ''),
(864, 32, 'STATUS_BED_MANAGEMENT', 'STATUS_BED_MANAGEMENT', 'number', '', '', '', '', 6, '', '', ''),
(863, 32, 'ALLOTMENT_TIMESTAMP_BED_MANAGEMENT', 'Temps', 'datetime', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(862, 32, 'BED_ID_BED_MANAGEMENT', 'Lit', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'bed', 'ID_BED', 'NAME_BED'),
(861, 32, 'PATIENT_ID_BED_MANAGEMENT', 'PATIENT_ID_BED_MANAGEMENT', 'number', '', '', '', '', 3, '', '', ''),
(860, 32, 'PATIENT_FILE_ID_BED_MANAGEMENT', 'Patient', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'patient_file', 'PATIENT_FILE_ID', 'PATIENT_FILE_CODE'),
(859, 32, 'ID_BED_MANAGEMENT', 'ID_BED_MANAGEMENT', 'number', '', '', '', '', 1, '', '', ''),
(873, 32, 'CREATED_BY_BED_MANAGEMENT', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(874, 32, 'DATE_MOD_BED_MANAGEMENT', 'DATE_MOD_BED_MANAGEMENT', 'datetime', '', '', '', '', 16, '', '', ''),
(875, 32, 'MODIFIED_BY_BED_MANAGEMENT', 'MODIFIED_BY_BED_MANAGEMENT', 'number', '', '', '', '', 17, '', '', ''),
(876, 33, 'ID_HOSPITAL_IBI_COMMANDES', 'ID_HOSPITAL_IBI_COMMANDES', 'number', '', '', '', 'yes', 1, '', '', ''),
(877, 33, 'PAYER_HOSPITAL_IBI_COMMANDES', 'PAYER_HOSPITAL_IBI_COMMANDES', 'number', '', '', '', '', 2, '', '', ''),
(878, 33, 'TITRE', 'TITRE', 'input', '', '', '', '', 3, '', '', ''),
(879, 33, 'DESCRIPTION', 'DESCRIPTION', 'input', '', '', '', '', 4, '', '', ''),
(880, 33, 'CODE', 'Numéro Facture', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(881, 33, 'PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES', 'Fiche  du patient', 'select', 'yes', 'yes', 'yes', 'yes', 6, 'patient_file', 'PATIENT_FILE_ID', 'PATIENT_FILE_CODE'),
(882, 33, 'SOMME_PERCU', 'SOMME_PERCU', 'input', '', '', '', '', 7, '', '', ''),
(883, 33, 'TOTAL', 'TOTAL', 'input', '', '', '', '', 8, '', '', ''),
(884, 33, 'DISCOUNT_TYPE', 'DISCOUNT_TYPE', 'input', '', '', '', '', 9, '', '', ''),
(885, 33, 'TVA', 'TVA', 'input', '', '', '', '', 10, '', '', ''),
(886, 33, 'DATE_CREATION_HOSPITAL_IBI_COMMANDES', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 11, '', '', ''),
(887, 33, 'DATE_MOD_HOSPITAL_IBI_COMMANDES', 'Modifiér le', 'timestamp', '', '', 'yes', 'yes', 12, '', '', ''),
(888, 33, 'CREATED_BY_HOSPITAL_IBI_COMMANDES', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 13, '', '', ''),
(889, 33, 'MODIFIED_BY_HOSPITAL_IBI_COMMANDES', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 14, '', '', ''),
(890, 33, 'DELETED_DATE_HOSPITAL_IBI_COMMANDES', 'DELETED_DATE_HOSPITAL_IBI_COMMANDES', 'datetime', '', '', '', '', 15, '', '', ''),
(891, 33, 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES', 'DELETED_STATUS_HOSPITAL_IBI_COMMANDES', 'number', '', '', '', '', 16, '', '', ''),
(892, 33, 'DELETED_USER_HOSPITAL_IBI_COMMANDES', 'DELETED_USER_HOSPITAL_IBI_COMMANDES', 'number', '', '', '', '', 17, '', '', ''),
(893, 33, 'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES', 'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES', 'input', '', '', '', '', 18, '', '', ''),
(894, 34, 'ID_ST', 'ID_ST', 'number', '', '', '', 'yes', 1, '', '', ''),
(895, 34, 'TITLE_ST', 'TITLE_ST', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(896, 34, 'DESCRIPTION_ST', 'DESCRIPTION_ST', 'editor_wysiwyg', '', '', '', '', 3, '', '', ''),
(897, 34, 'APPROUVED_ST', 'APPROUVED_ST', 'number', 'yes', '', '', 'yes', 4, '', '', ''),
(898, 34, 'APPROUVED_BY_ST', 'APPROUVED_BY_ST', 'current_user_id', 'yes', '', '', 'yes', 5, '', '', ''),
(899, 34, 'TYPE_ST', 'TYPE_ST', 'input', '', '', '', '', 6, '', '', ''),
(900, 34, 'DESTINATION_STORE_ST', 'DESTINATION_STORE_ST', 'number', 'yes', '', '', 'yes', 7, '', '', ''),
(901, 34, 'FROM_STORE_ST', 'FROM_STORE_ST', 'number', 'yes', '', '', 'yes', 8, '', '', ''),
(902, 34, 'DATE_CREATION_ST', 'DATE_CREATION_ST', 'timestamp', 'yes', '', '', 'yes', 9, '', '', ''),
(903, 34, 'DATE_MOD_ST', 'DATE_MOD_ST', 'timestamp', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(904, 34, 'CREATED_BY_ST', 'CREATED_BY_ST', 'current_user_id', 'yes', '', '', 'yes', 11, '', '', ''),
(905, 34, 'MODIFIED_BY_ST', 'MODIFIED_BY_ST', 'current_user_id', 'yes', '', '', 'yes', 12, '', '', ''),
(906, 34, 'DELETE_STATUS_ST', 'DELETE_STATUS_ST', 'number', '', '', '', '', 13, '', '', ''),
(907, 34, 'DELETE_DATE_ST', 'DELETE_DATE_ST', 'datetime', '', '', '', '', 14, '', '', ''),
(908, 34, 'DELETE_BY_ST', 'DELETE_BY_ST', 'number', '', '', '', '', 15, '', '', ''),
(909, 34, 'DELETE_COMMENT_ST', 'DELETE_COMMENT_ST', 'editor_wysiwyg', '', '', '', '', 16, '', '', ''),
(960, 35, 'DELETED_USER_PAIEMENT', 'DELETED_USER_PAIEMENT', 'number', '', '', '', '', 13, '', '', ''),
(961, 35, 'DELETED_COMMENT_PAIEMENT', 'DELETED_COMMENT_PAIEMENT', 'number', '', '', '', '', 14, '', '', ''),
(959, 35, 'DELETED_STATUS_PAIEMENT', 'DELETED_STATUS_PAIEMENT', 'number', '', '', '', '', 12, '', '', ''),
(957, 35, 'MODIFIED_BY_PAIEMENT', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 10, '', '', ''),
(958, 35, 'DELETED_DATE_PAIEMENT', 'DELETED_DATE_PAIEMENT', 'datetime', '', '', '', '', 11, '', '', ''),
(956, 35, 'CREATED_BY_PAIEMENT', 'Crée  par', 'current_user_id', 'yes', 'yes', '', 'yes', 9, '', '', ''),
(955, 35, 'DATE_MOD_PAIEMENT', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 8, '', '', ''),
(954, 35, 'DATE_CREATION_PAIEMENT', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(951, 35, 'NUMERO_RECU_PAIEMENT', 'Numéro recu', 'input', 'yes', 'yes', '', 'yes', 4, '', '', ''),
(952, 35, 'MONTANT_PAIEMENT', 'Montant', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(953, 35, 'PAYMENT_TYPE_PAIEMENT', 'Type', 'custom_select', 'yes', 'yes', 'yes', 'yes', 6, '', '', '');
INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
(950, 35, 'REF_COMMAND_CODE_PAIEMENT', 'Numéro Facture', 'select', '', '', '', '', 3, 'hospital_ibi_commandes', 'ID_HOSPITAL_IBI_COMMANDES', 'CODE'),
(949, 35, 'REF_COMMAND_ID_PAIEMENT', 'Numéro Facture ', 'select', 'yes', 'yes', 'yes', '', 2, 'hospital_ibi_commandes', 'ID_HOSPITAL_IBI_COMMANDES', 'CODE'),
(948, 35, 'ID_PAIEMENT', 'ID_PAIEMENT', 'number', '', '', '', 'yes', 1, '', '', ''),
(962, 36, 'ID_A_C', 'ID_A_C', 'number', '', '', '', 'yes', 1, '', '', ''),
(963, 36, 'CATEGORIE_ID_A_C', 'Services', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'actes_categorie', 'ID_ACTES_CATEGORIE', 'DESIGNATION'),
(964, 36, 'GROUP_ID_A_C', 'Groupe', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'aauth_groups', 'id', 'name'),
(965, 36, 'DATE_CREATION_A_C', 'Crée', 'timestamp', 'yes', 'yes', '', 'yes', 4, '', '', ''),
(966, 36, 'DATE_MOD_A_C', 'Modifié ', 'timestamp', '', '', 'yes', 'yes', 5, '', '', ''),
(967, 36, 'CREATED_BY_A_C', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 6, '', '', ''),
(968, 36, 'MODIFIED_BY_A_C', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 7, '', '', ''),
(969, 36, 'DELETED_DATE_A_C', 'DELETED_DATE_A_C', 'datetime', '', '', '', '', 8, '', '', ''),
(970, 36, 'DELETED_STATUS_A_C', 'DELETED_STATUS_A_C', 'number', '', '', '', '', 9, '', '', ''),
(971, 36, 'DELETED_USER_A_C', 'DELETED_USER_A_C', 'number', '', '', '', '', 10, '', '', ''),
(972, 36, 'DELETED_COMMENT_A_C', 'DELETED_COMMENT_A_C', 'input', '', '', '', '', 11, '', '', ''),
(1019, 37, 'CREATED_BY_PATIENT_FILE', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 21, '', '', ''),
(1018, 37, 'DATE_MOD_PATIENT_FILE', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 20, '', '', ''),
(1017, 37, 'DATE_CREATION_PATIENT_FILE', 'Créer le', 'timestamp', 'yes', 'yes', '', 'yes', 19, '', '', ''),
(1016, 37, 'NUMERO_FACTURE', 'NUMERO_FACTURE', 'input', '', '', '', '', 18, '', '', ''),
(1015, 37, 'TRANSFERED_TO_ACCOUNTING', 'TRANSFERED_TO_ACCOUNTING', 'number', '', '', '', '', 17, '', '', ''),
(1014, 37, 'MEDICAMENT_MATER', 'Pourcentage Materiel', 'select', '', 'yes', 'yes', 'yes', 16, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1013, 37, 'SEJOUR', 'Pourcentage Sejour', 'select', '', 'yes', 'yes', 'yes', 15, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1012, 37, 'LABORATOIRE', 'Pourcentage Laboratoire', 'select', '', 'yes', 'yes', 'yes', 14, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1011, 37, 'MEDICAMENTS', 'Pourcentage Medicaments', 'select', '', 'yes', 'yes', 'yes', 13, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1010, 37, 'ACTES', 'Pourcentage Actes', 'select', '', 'yes', 'yes', 'yes', 12, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1009, 37, 'CONSULTATION', 'Pourcentage Consultation', 'select', '', 'yes', 'yes', 'yes', 11, 'hospital_patient_groups', 'ID', 'DISCOUNT_PERCENT'),
(1008, 37, 'DEPARTEMENT_ID', 'Departement', 'select', 'yes', 'yes', 'yes', 'yes', 10, 'actes_categorie', 'ID_ACTES_CATEGORIE', 'DESIGNATION'),
(1007, 37, 'DOCTOR_ID', 'Docteur', 'select', 'yes', 'yes', 'yes', 'yes', 9, 'aauth_users', 'id', 'username'),
(1006, 37, 'REF_SOCIETE', 'Société', 'select', 'yes', 'yes', 'yes', 'yes', 8, 'hospital_ibi_societes', 'ID_SOCIETE', 'NOM_SOCIETE'),
(1005, 37, 'TYPE_DE_PAYEMET', 'Type de paiment', 'custom_option', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(1004, 37, 'PATIENT_FILE_STATUS', 'Status', 'custom_option', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1003, 37, 'BON_DE_COMMANDE', 'Bon de Commande', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1002, 37, 'PATIENT_ID', 'Patient', 'number', '', '', '', '', 4, '', '', ''),
(1001, 37, 'LETTER', 'LETTER', 'input', '', '', '', '', 3, '', '', ''),
(1000, 37, 'PATIENT_FILE_CODE', 'Numéro fiche', 'input', 'yes', '', 'yes', 'yes', 2, '', '', ''),
(999, 37, 'PATIENT_FILE_ID', 'PATIENT_FILE_ID', 'number', '', '', '', 'yes', 1, '', '', ''),
(1020, 37, 'MODIFIED_BY_PATIENT_FILE', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 22, '', '', ''),
(1021, 37, 'DELETED_DATE_PATIENT_FILE', 'DELETED_DATE_PATIENT_FILE', 'datetime', '', '', '', '', 23, '', '', ''),
(1022, 37, 'DELETED_STATUS_PATIENT_FILE', 'DELETED_STATUS_PATIENT_FILE', 'number', '', '', '', '', 24, '', '', ''),
(1023, 37, 'DELETED_USER_PATIENT_FILE', 'DELETED_USER_PATIENT_FILE', 'number', '', '', '', '', 25, '', '', ''),
(1024, 37, 'DELETED_COMMENT_PATIENT_FILE', 'DELETED_COMMENT_PATIENT_FILE', 'input', '', '', '', '', 26, '', '', ''),
(1025, 38, 'ID_INVENTAIRE', 'ID_INVENTAIRE', 'number', '', '', '', '', 1, '', '', ''),
(1026, 38, 'TITRE_INVENTAIRE', 'TITRE_INVENTAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1027, 38, 'DESCRIPTION_INVENTAIRE', 'DESCRIPTION_INVENTAIRE', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1028, 38, 'VALUE_INVENTAIRE', 'VALUE_INVENTAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1029, 38, 'ITEMS_INVENTAIRE', 'ITEMS_INVENTAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1030, 38, 'TYPE_INVENTAIRE', 'TYPE_INVENTAIRE', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1031, 38, 'REF_PROVIDERS_INVENTAIRE', 'REF_PROVIDERS_INVENTAIRE', 'select', 'yes', 'yes', 'yes', 'yes', 7, 'hospital_ibi_fournisseurs', 'ID_FOURNISSEUR', 'NOM_FOURNISSEUR'),
(1032, 38, 'DATE_CREATION_INVENTAIRE', 'DATE_CREATION_INVENTAIRE', 'timestamp', 'yes', 'yes', '', 'yes', 8, '', '', ''),
(1033, 38, 'DATE_MOD_INVENTAIRE', 'DATE_MOD_INVENTAIRE', 'timestamp', '', '', 'yes', 'yes', 9, '', '', ''),
(1034, 38, 'CREATED_BY_INVENTAIRE', 'CREATED_BY_INVENTAIRE', 'current_user_id', 'yes', 'yes', '', 'yes', 10, '', '', ''),
(1035, 38, 'MODIFIED_BY_INVENTAIRE', 'MODIFIED_BY_INVENTAIRE', 'current_user_id', '', '', 'yes', 'yes', 11, '', '', ''),
(1036, 38, 'DELETE_STATUS_INVENTAIRE', 'DELETE_STATUS_INVENTAIRE', 'number', '', '', '', '', 12, '', '', ''),
(1037, 38, 'DELETE_DATE_INVENTAIRE', 'DELETE_DATE_INVENTAIRE', 'datetime', '', '', '', '', 13, '', '', ''),
(1038, 38, 'DELETE_BY_INVENTAIRE', 'DELETE_BY_INVENTAIRE', 'number', '', '', '', '', 14, '', '', ''),
(1039, 38, 'DELETE_COMMENT_INVENTAIRE', 'DELETE_COMMENT_INVENTAIRE', 'editor_wysiwyg', '', '', '', '', 15, '', '', ''),
(1060, 39, 'DELETED_DATE_FACTURE', 'DELETED_DATE_FACTURE', 'datetime', '', '', '', '', 9, '', '', ''),
(1059, 39, 'MODIFIED_BY_FACTURE', 'Modifié par', 'current_user_id', '', '', 'yes', 'yes', 8, '', '', ''),
(1058, 39, 'CREATED_BY_FACTURE', 'Crée par', 'current_user_id', 'yes', 'yes', '', 'yes', 7, '', '', ''),
(1057, 39, 'DATE_MOD_FACTURE', 'Modifié le', 'timestamp', '', '', 'yes', 'yes', 6, '', '', ''),
(1056, 39, 'DATE_CREATION_FACTURE', 'Crée le', 'timestamp', 'yes', 'yes', '', 'yes', 5, '', '', ''),
(1055, 39, 'STORE_ID_FACTURE', 'Boutique', 'number', 'yes', '', 'yes', 'yes', 4, '', '', ''),
(1054, 39, 'NUMERO_FACTURE', 'Numéro Facture', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1053, 39, 'PATIENT_FILE_ID_FACTURE', 'Fiche du patient', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'patient_file', 'PATIENT_FILE_ID', 'PATIENT_FILE_CODE'),
(1052, 39, 'ID_FACTURE', 'ID_FACTURE', 'number', '', '', '', 'yes', 1, '', '', ''),
(1061, 39, 'DELETED_STATUS_FACTURE', 'DELETED_STATUS_FACTURE', 'number', '', '', '', '', 10, '', '', ''),
(1062, 39, 'DELETED_USER_FACTURE', 'DELETED_USER_FACTURE', 'number', '', '', '', '', 11, '', '', ''),
(1063, 39, 'DELETED_COMMENT_FACTURE', 'DELETED_COMMENT_FACTURE', 'input', '', '', '', '', 12, '', '', ''),
(1073, 18, 'MODIFIED_BY_ROOM_TYPE', 'MODIFIED_BY_ROOM_TYPE', 'number', '', '', '', '', 10, '', '', ''),
(1074, 40, 'ID_SORTIE', 'ID_SORTIE', 'number', '', '', '', 'yes', 1, '', '', ''),
(1075, 40, 'CODE_SORTIE', 'CODE_SORTIE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1076, 40, 'TITRE_SORTIE', 'TITRE_SORTIE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1077, 40, 'DESCRIPTION_SORTIE', 'DESCRIPTION_SORTIE', 'input', '', '', '', '', 4, '', '', ''),
(1078, 40, 'MONTANT_SORTIE', 'MONTANT_SORTIE', 'input', '', '', '', '', 5, '', '', ''),
(1079, 40, 'QTE_ASORTIE', 'QTE_ASORTIE', 'input', '', '', '', '', 6, '', '', ''),
(1080, 40, 'DATE_CREATION_SORTIE', 'DATE_CREATION_SORTIE', 'datetime', '', '', '', '', 7, '', '', ''),
(1081, 40, 'DATE_MOD_SORTIE', 'DATE_MOD_SORTIE', 'datetime', '', '', '', '', 8, '', '', ''),
(1082, 40, 'CREATED_BY_SORTIE', 'CREATED_BY_SORTIE', 'number', '', '', '', '', 9, '', '', ''),
(1083, 40, 'MODIFY_BY_SORTIE', 'MODIFY_BY_SORTIE', 'number', '', '', '', '', 10, '', '', ''),
(1084, 40, 'DELETE_STATUS_SORTIE', 'DELETE_STATUS_SORTIE', 'number', '', '', '', '', 11, '', '', ''),
(1085, 40, 'DELETED_BY_SORTIE', 'DELETED_BY_SORTIE', 'number', '', '', '', '', 12, '', '', ''),
(1086, 40, 'DETEDE_DATE_SORTIE', 'DETEDE_DATE_SORTIE', 'datetime', '', '', '', '', 13, '', '', ''),
(1087, 40, 'DELETE_COMMENT_SORTIE', 'DELETE_COMMENT_SORTIE', 'input', '', '', '', '', 14, '', '', ''),
(1103, 5, 'DEPARTEMENTS', 'Departement', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'departements', 'ID_DEPARTEMENT', 'DESIGNATION_DEPARTEMENT'),
(1102, 5, 'DESIGNATION', 'Designation', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1101, 5, 'ID_ACTES_CATEGORIE', 'Id', 'number', '', '', '', 'yes', 1, '', '', ''),
(1113, 5, 'DELETED_COMMENT_ACTES_CATEGORIE', 'DELETED_COMMENT_ACTES_CATEGORIE', 'input', '', '', '', '', 13, '', '', ''),
(1122, 41, 'TYPE_MARGE', 'Type de marge', 'custom_option', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1121, 41, 'MARGE', 'Marge pourcentage', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1120, 41, 'DESIGNATION', 'Designation', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1119, 41, 'ID_MARGE', 'Id', 'number', '', '', '', '', 1, '', '', ''),
(1123, 41, 'CREATED_BY', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1124, 41, 'DATE_CREATION', 'Date creation', 'timestamp', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1180, 42, 'DATE_MOD_CLIENT', 'DATE_MOD_CLIENT', 'input', '', '', '', '', 12, '', '', ''),
(1178, 42, 'DELETE_STATUS_CLIENT', 'DELETE_STATUS_CLIENT', 'number', '', '', '', '', 10, '', '', ''),
(1179, 42, 'DELETE_COMMENT_CLIENT', 'DELETE_COMMENT_CLIENT', 'number', '', '', '', '', 11, '', '', ''),
(1177, 42, 'CREATED_BY_CLIENT', 'Créer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(1176, 42, 'DATE_CREATION_CLIENT', 'Date creation', 'timestamp', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1175, 42, 'DISCOUNT', 'Discount', 'number', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(1174, 42, 'TYPE_DISCOUNT', 'Type discount', 'custom_option', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1173, 42, 'TEL_CLIENTS', 'Téléphone', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1171, 42, 'NOM_CLIENT', 'Nom', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1172, 42, 'PRENOM', 'Prenom', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1149, 43, 'ID_TYPE_CLIENT', 'ID_TYPE_CLIENT', 'number', '', '', '', '', 1, '', '', ''),
(1150, 43, 'DESIGN_TYPE_CLIENT', 'Designation', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1151, 43, 'DATE_CREATION_TYPE_CLIENT', 'Date création', 'timestamp', 'yes', '', '', 'yes', 3, '', '', ''),
(1152, 43, 'CREATED_BY_TYPE_CLIENT', 'Créer par', 'current_user_id', 'yes', '', '', 'yes', 4, '', '', ''),
(1153, 43, 'DATE_MOD_TYPE_CLIENT', 'DATE_MOD_TYPE_CLIENT', 'number', '', '', '', '', 5, '', '', ''),
(1154, 43, 'DELETE_STATUS_TYPE_CLIENT', 'DELETE_STATUS_TYPE_CLIENT', 'number', '', '', '', '', 6, '', '', ''),
(1181, 42, 'DELETE_BY_CLIENT', 'DELETE_BY_CLIENT', 'number', '', '', '', '', 13, '', '', ''),
(1170, 42, 'TYPE_CLIENT_ID', 'Type client', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'pos_type_clients', 'ID_TYPE_CLIENT', 'DESIGN_TYPE_CLIENT'),
(1169, 42, 'ID_CLIENT', 'ID_CLIENT', 'number', '', '', '', 'yes', 1, '', '', ''),
(1182, 42, 'MODIFIED_BY_CLIENT', 'MODIFIED_BY_CLIENT', 'number', '', '', '', '', 14, '', '', ''),
(1183, 44, 'CLIENT_FILE_ID', 'CLIENT_FILE_ID', 'number', '', '', '', '', 1, '', '', ''),
(1184, 44, 'CLIENT_FILE_CODE', 'Code', 'input', 'yes', '', 'yes', 'yes', 2, '', '', ''),
(1185, 44, 'LETTER', 'LETTER', 'input', '', '', '', '', 3, '', '', ''),
(1186, 44, 'CLIENT_ID', 'Client', 'select', 'yes', '', 'yes', 'yes', 4, 'pos_clients', 'ID_CLIENT', 'NOM_CLIENT'),
(1187, 44, 'BON_DE_COMMANDE', 'BON_DE_COMMANDE', 'input', '', '', '', '', 5, '', '', ''),
(1188, 44, 'CLIENT_FILE_STATUS', 'Status', 'number', 'yes', '', '', 'yes', 6, '', '', ''),
(1189, 44, 'TYPE_DE_PAYEMENT', 'TYPE_DE_PAYEMENT', 'number', '', '', '', '', 7, '', '', ''),
(1190, 44, 'REF_SOCIETE', 'REF_SOCIETE', 'number', '', '', '', '', 8, '', '', ''),
(1191, 44, 'DEPARTEMENT_ID', 'DEPARTEMENT_ID', 'number', '', '', '', '', 9, '', '', ''),
(1192, 44, 'CONSULTATION', 'CONSULTATION', 'number', '', '', '', '', 10, '', '', ''),
(1193, 44, 'ACTES', 'ACTES', 'number', '', '', '', '', 11, '', '', ''),
(1194, 44, 'MEDICAMENTS', 'MEDICAMENTS', 'number', '', '', '', '', 12, '', '', ''),
(1195, 44, 'SEJOUR', 'SEJOUR', 'number', '', '', '', 'yes', 13, '', '', ''),
(1196, 44, 'DATE_CREATION_CLIENT_FILE', 'Date creation', 'datetime', 'yes', '', 'yes', 'yes', 14, '', '', ''),
(1197, 44, 'DATE_MOD_CLIENT_FILE', 'DATE_MOD_CLIENT_FILE', 'datetime', '', '', '', '', 15, '', '', ''),
(1198, 44, 'CREATED_BY_CLIENT_FILE', 'CREATED_BY_CLIENT_FILE', 'number', 'yes', '', 'yes', 'yes', 16, '', '', ''),
(1199, 44, 'MODIFIED_BY_CLIENT_FILE', 'MODIFIED_BY_CLIENT_FILE', 'number', '', '', '', '', 17, '', '', ''),
(1200, 44, 'DELETED_DATE_CLIENT_FILE', 'DELETED_DATE_CLIENT_FILE', 'datetime', '', '', '', '', 18, '', '', ''),
(1201, 44, 'DELETED_STATUS_CLIENT_FILE', 'DELETED_STATUS_CLIENT_FILE', 'number', '', '', '', '', 19, '', '', ''),
(1202, 44, 'DELETED_USER_CLIENT_FILE', 'DELETED_USER_CLIENT_FILE', 'number', '', '', '', '', 20, '', '', ''),
(1203, 44, 'DELETED_COMMENT_CLIENT_FILE', 'DELETED_COMMENT_CLIENT_FILE', 'input', '', '', '', '', 21, '', '', ''),
(1204, 44, 'PAYER_FACTURE', 'PAYER_FACTURE', 'number', '', '', '', '', 22, '', '', ''),
(1205, 44, 'NUMERO_FACTURE', 'NUMERO_FACTURE', 'input', '', '', '', '', 23, '', '', ''),
(1206, 44, 'DECLOTURE', 'DECLOTURE', 'number', '', '', '', '', 24, '', '', ''),
(1207, 45, 'ID_REQ', 'ID_REQ', 'number', '', '', '', '', 1, '', '', ''),
(1208, 45, 'CODE_REQ', 'CODE_REQ', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1209, 45, 'DESTINATION_STORE_REQ', 'DESTINATION_STORE_REQ', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1210, 45, 'FROM_STORE', 'FROM_STORE', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1211, 45, 'PATIENT', 'PATIENT', 'input', '', '', '', '', 5, '', '', ''),
(1212, 45, 'TITLE_REQ', 'TITLE_REQ', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1213, 45, 'DESCRIPTION_REQ', 'DESCRIPTION_REQ', 'input', '', '', '', '', 7, '', '', ''),
(1214, 45, 'STATUS_REQ', 'STATUS_REQ', 'number', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1215, 45, 'APROUVED_BY_REQ', 'APROUVED_BY_REQ', 'number', 'yes', '', '', '', 9, '', '', ''),
(1216, 45, 'TYPE_REQ', 'TYPE_REQ', 'input', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(1217, 45, 'STATUS_NOTIFY_REQ', 'STATUS_NOTIFY_REQ', 'number', '', '', '', '', 11, '', '', ''),
(1218, 45, 'AUTHOR_REQ', 'AUTHOR_REQ', 'input', '', '', '', '', 12, '', '', ''),
(1219, 45, 'DATE_CREATION_REQ', 'DATE_CREATION_REQ', 'datetime', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(1220, 45, 'DATE_MOD_REQ', 'DATE_MOD_REQ', 'datetime', '', '', '', '', 14, '', '', ''),
(1221, 45, 'CREATED_BY_REQ', 'CREATED_BY_REQ', 'number', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(1222, 45, 'MODIFIED_BY_REQ', 'MODIFIED_BY_REQ', 'number', '', '', '', '', 16, '', '', ''),
(1223, 45, 'DELETE_STATUS_REQ', 'DELETE_STATUS_REQ', 'number', 'yes', 'yes', 'yes', 'yes', 17, '', '', ''),
(1224, 45, 'DELETE_DATE_REQ', 'DELETE_DATE_REQ', 'datetime', 'yes', 'yes', 'yes', 'yes', 18, '', '', ''),
(1225, 45, 'DELETED_BY_REQ', 'DELETED_BY_REQ', 'number', 'yes', 'yes', 'yes', 'yes', 19, '', '', ''),
(1226, 45, 'DELETED_COMMENTS_REQ', 'DELETED_COMMENTS_REQ', 'input', 'yes', 'yes', 'yes', 'yes', 20, '', '', ''),
(1227, 46, 'ID_pos_IBI_COMMANDES', 'ID_pos_IBI_COMMANDES', 'number', '', '', '', '', 1, '', '', ''),
(1228, 46, 'STORE_ID_COMMADES', 'STORE_ID_COMMADES', 'number', '', '', '', '', 2, '', '', ''),
(1229, 46, 'ID_CASHIER_SHIFT', 'ID_CASHIER_SHIFT', 'number', '', '', '', '', 3, '', '', ''),
(1230, 46, 'COMMANDE_STATUS', 'COMMANDE_STATUS', 'number', 'yes', '', '', 'yes', 4, '', '', ''),
(1231, 46, 'COMMANDE_VOID_REQUEST', 'COMMANDE_VOID_REQUEST', 'input', '', '', '', '', 5, '', '', ''),
(1232, 46, 'COMMANDE_SPLIT_REQUEST', 'COMMANDE_SPLIT_REQUEST', 'input', '', '', '', '', 6, '', '', ''),
(1233, 46, 'CODE', 'Code', 'input', 'yes', '', '', 'yes', 7, '', '', ''),
(1234, 46, 'TRANSFER_TO', 'TRANSFER_TO', 'number', '', '', '', '', 8, '', '', ''),
(1235, 46, 'TRANSFER_STATUS', 'TRANSFER_STATUS', 'input', '', '', '', '', 9, '', '', ''),
(1236, 46, 'TRANSFER_ACCEPTED_AT', 'TRANSFER_ACCEPTED_AT', 'input', '', '', '', '', 10, '', '', ''),
(1237, 46, 'CLIENT_ID_COMMANDE', 'Client', 'select', 'yes', '', 'yes', 'yes', 11, 'pos_clients', 'ID_CLIENT', 'NOM_CLIENT'),
(1238, 46, 'CLIENT_FILE_ID_pos_IBI_COMMANDES', 'CLIENT_FILE_ID_pos_IBI_COMMANDES', 'select', '', '', '', '', 12, 'pos_clients', 'ID_CLIENT', 'NOM_CLIENT'),
(1239, 46, 'TVA', 'TVA', 'input', '', '', '', '', 13, '', '', ''),
(1240, 46, 'DATE_CREATION_pos_IBI_COMMANDES', 'DATE_CREATION_pos_IBI_COMMANDES', 'date', 'yes', '', 'yes', 'yes', 14, '', '', ''),
(1241, 46, 'DATE_MOD_pos_IBI_COMMANDES', 'DATE_MOD_pos_IBI_COMMANDES', 'datetime', '', '', '', '', 15, '', '', ''),
(1242, 46, 'CREATED_BY_pos_IBI_COMMANDES', 'CREATED_BY_pos_IBI_COMMANDES', 'number', 'yes', '', 'yes', 'yes', 16, '', '', ''),
(1243, 46, 'MODIFIED_BY_pos_IBI_COMMANDES', 'MODIFIED_BY_pos_IBI_COMMANDES', 'number', '', '', '', '', 17, '', '', ''),
(1244, 46, 'DELETED_DATE_pos_IBI_COMMANDES', 'DELETED_DATE_pos_IBI_COMMANDES', 'datetime', '', '', '', '', 18, '', '', ''),
(1245, 46, 'DELETED_STATUS_pos_IBI_COMMANDES', 'DELETED_STATUS_pos_IBI_COMMANDES', 'number', 'yes', '', '', 'yes', 19, '', '', ''),
(1246, 46, 'DELETED_USER_pos_IBI_COMMANDES', 'DELETED_USER_pos_IBI_COMMANDES', 'number', '', '', '', '', 20, '', '', ''),
(1247, 46, 'DELETED_COMMENT_pos_IBI_COMMANDES', 'DELETED_COMMENT_pos_IBI_COMMANDES', 'input', '', '', '', '', 21, '', '', ''),
(1306, 47, 'DELETE_STATUS_DEPENSE', 'DELETE_STATUS_DEPENSE', 'number', '', '', '', '', 8, '', '', ''),
(1305, 47, 'DATE_DELETE_DEPENSE', 'DATE_DELETE_DEPENSE', 'datetime', '', '', '', '', 7, '', '', ''),
(1304, 47, 'DATE_CREATE_DEPENSE', 'Date Creation', 'datetime', 'yes', '', '', 'yes', 6, '', '', ''),
(1303, 47, 'CREATE_BY_DEPENSE', 'Depense Creer Par', 'number', 'yes', '', '', 'yes', 5, '', '', ''),
(1302, 47, 'DESCRIPTION_DEPENSE', 'Description Depense', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1301, 47, 'MONTANT_DEPENSE', 'Montant Depense', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1300, 47, 'NOM_DEPENSE', 'Nom Depense', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1299, 47, 'ID_DEPENSE', 'ID_DEPENSE', 'number', '', '', '', '', 1, '', '', ''),
(1258, 48, 'ID_CATEGORIE_DEPENSE', 'ID_CATEGORIE_DEPENSE', 'number', '', '', '', '', 1, '', '', ''),
(1259, 48, 'NOM_CATEGORIE_DEPENSE', 'NOM_CATEGORIE_DEPENSE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1260, 48, 'CREATE_BY_CATEGORIE_DEPENSE', 'CREATE_BY_CATEGORIE_DEPENSE', 'number', 'yes', '', '', 'yes', 3, '', '', ''),
(1261, 48, 'DATE_CREATE_CATEGORIE_DEPENSE', 'DATE_CREATE_CATEGORIE_DEPENSE', 'datetime', 'yes', '', '', 'yes', 4, '', '', ''),
(1262, 48, 'DELETE_STATUS_CATEGORIE_DEPENSE', 'DELETE_STATUS_CATEGORIE_DEPENSE', 'number', '', '', '', '', 5, '', '', ''),
(1263, 48, 'DELETE_DATE_CATEGORIE_DEPENSE', 'DELETE_DATE_CATEGORIE_DEPENSE', 'datetime', '', '', '', '', 6, '', '', ''),
(1264, 48, 'COMMENT_DELETE_CATEGORIE_DEPENSE', 'COMMENT_DELETE_CATEGORIE_DEPENSE', 'input', '', '', '', '', 7, '', '', ''),
(1265, 49, 'ID_MARGE', 'ID_MARGE', 'number', '', '', '', 'yes', 1, '', '', ''),
(1266, 49, 'DESIGNATION', 'DESIGNATION', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1267, 49, 'MARGE', 'MARGE', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1268, 49, 'TYPE_MARGE', 'TYPE_MARGE', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1269, 49, 'CREATED_BY', 'CREATED_BY', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1270, 49, 'DATE_CREATION', 'DATE_CREATION', 'datetime', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1271, 50, 'ID_SETTING', 'ID_SETTING', 'number', '', '', '', 'yes', 1, '', '', ''),
(1272, 50, 'NOM_ENTREPRISE', 'Nom de l\'entreprise', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1273, 50, 'NIF_ENTREPRISE', 'NIF', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1274, 50, 'RC_ENTREPRISE', 'RC', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1275, 50, 'COMMUNE_ENTREPRISE', 'Commune', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1276, 50, 'QUARTIER_ENTREPRISE', 'Quartier', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1277, 50, 'AVENUE_ENTREPRISE', 'AVENUE', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(1278, 50, 'RUE_ENTREPRISE', 'Rue', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1279, 50, 'TELEPHONE_ENTREPRISE', 'Telephone', 'input', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(1280, 50, 'EMAIL_ENTREPRISE', 'Email', 'input', '', 'yes', 'yes', 'yes', 10, '', '', ''),
(1281, 50, 'BP_ENTREPRISE', 'Bp', 'input', '', 'yes', 'yes', 'yes', 11, '', '', ''),
(1282, 50, 'LOGO_ENTREPRISE', 'LOGO_ENTREPRISE', 'file', '', 'yes', 'yes', 'yes', 12, '', '', ''),
(1283, 50, 'CREATED_BY', 'CREATED_BY', 'current_user_id', '', 'yes', 'yes', 'yes', 13, '', '', ''),
(1284, 50, 'DATE_CREATION', 'DATE_CREATION', 'timestamp', '', 'yes', 'yes', 'yes', 14, '', '', ''),
(1285, 51, 'ID_SETTING', 'ID_SETTING', 'number', '', '', '', 'yes', 1, '', '', ''),
(1286, 51, 'NOM_ENTREPRISE', 'NOM_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1287, 51, 'NIF_ENTREPRISE', 'NIF_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1288, 51, 'RC_ENTREPRISE', 'RC_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1289, 51, 'COMMUNE_ENTREPRISE', 'COMMUNE_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1290, 51, 'QUARTIER_ENTREPRISE', 'QUARTIER_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1291, 51, 'AVENUE_ENTREPRISE', 'AVENUE_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(1292, 51, 'RUE_ENTREPRISE', 'RUE_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1293, 51, 'TELEPHONE_ENTREPRISE', 'TELEPHONE_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(1294, 51, 'EMAIL_ENTREPRISE', 'EMAIL_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(1295, 51, 'BP_ENTREPRISE', 'BP_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(1296, 51, 'LOGO_ENTREPRISE', 'LOGO_ENTREPRISE', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(1297, 51, 'CREATED_BY', 'CREATED_BY', 'number', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(1298, 51, 'DATE_CREATION', 'DATE_CREATION', 'datetime', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(1307, 47, 'DELETE_COMMENT_DEPENSE', 'DELETE_COMMENT_DEPENSE', 'input', '', '', '', '', 9, '', '', ''),
(1308, 47, 'DELETE_BY_DEPENSE', 'DELETE_BY_DEPENSE', 'number', '', '', '', '', 10, '', '', ''),
(1309, 47, 'ID_CATEGORIE_DEPENSE', 'ID_CATEGORIE_DEPENSE', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(1310, 47, 'ID_SHIFT', 'ID_SHIFT', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(1311, 47, 'STATUT_FLUX', 'STATUT_FLUX', 'input', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(1312, 47, 'MONTANT_REQUISITION', 'MONTANT_REQUISITION', 'input', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(1313, 47, 'MONTANT_APPROVIONNEMENT', 'MONTANT_APPROVIONNEMENT', 'input', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(1314, 47, 'ID_REQUISITION', 'ID_REQUISITION', 'input', 'yes', 'yes', 'yes', 'yes', 16, '', '', ''),
(1315, 47, 'ID_APPROVISIONNEMENT', 'ID_APPROVISIONNEMENT', 'select', 'yes', 'yes', 'yes', 'yes', 17, 'pos_store_1_ibi_arrivages', 'ID_ARRIVAGE', 'TITRE_ARRIVAGE'),
(1316, 47, 'TYPE_ACTIVITE_CAISSE', 'TYPE_ACTIVITE_CAISSE', 'input', 'yes', 'yes', 'yes', 'yes', 18, '', '', ''),
(1317, 47, 'RESTE_SOMMES', 'RESTE_SOMMES', 'input', 'yes', 'yes', 'yes', 'yes', 19, '', '', ''),
(1318, 52, 'ID_FLUX_CAISSE', 'ID_FLUX_CAISSE', 'number', '', '', '', '', 1, '', '', ''),
(1319, 52, 'NOM_FLUX_CAISSE', 'Nom flux caisse', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1320, 52, 'MONTANT_FLUX_CAISSE', 'Montant', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1321, 52, 'TYPE_FLUX_CAISSE', 'Type flux', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'pos_activite_flux_caisse', 'ID_ACTIVITE', 'DESIGN_ACTIVITE'),
(1322, 52, 'CATEGORIE_FLUX', 'Categorie flux', 'select', 'yes', 'yes', 'yes', 'yes', 5, 'pos_categorie_flux_caisse', 'ID_CATEGORIE_DEPENSE', 'NOM_CATEGORIE_DEPENSE'),
(1323, 52, 'DESCRIPTION_FLUX', 'Description', 'textarea', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(1324, 52, 'FLUX_SESSION_ID', 'FLUX_SESSION_ID', 'number', '', '', '', '', 7, '', '', ''),
(1325, 52, 'USER_CREATE_FLUX', 'Auteur', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(1326, 52, 'DATE_CREATION_FLUX', 'Date creation', 'timestamp', 'yes', 'yes', '', 'yes', 9, '', '', ''),
(1327, 52, 'FLUX_DELETE_STATUS', 'FLUX_DELETE_STATUS', 'number', '', '', '', '', 10, '', '', ''),
(1328, 52, 'FLUX_DELETE_BY', 'FLUX_DELETE_BY', 'number', '', '', '', '', 11, '', '', ''),
(1329, 52, 'FLUX_DATE_DELETE', 'FLUX_DATE_DELETE', 'datetime', '', '', '', '', 12, '', '', ''),
(1330, 53, 'ID_SESSION', 'ID_SESSION', 'input', '', '', '', 'yes', 1, '', '', ''),
(1331, 53, 'SESSION_START', 'Debut du session', 'timestamp', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1332, 53, 'SESSION_END', 'Fin du session', 'datetime', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1333, 53, 'SESSION_STATUS', 'Status', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1334, 53, 'SESSION_CREATED_BY', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(1335, 53, 'FROM_CLOUD', 'FROM_CLOUD', 'number', '', '', '', '', 6, '', '', ''),
(1349, 54, 'DELETE_DATE_CATEGORIE', 'DELETE_DATE_CATEGORIE', 'datetime', '', '', '', '', 6, '', '', ''),
(1348, 54, 'DELETE_STATUS_CATEGORIE', 'DELETE_STATUS_CATEGORIE', 'number', '', '', '', '', 5, '', '', ''),
(1347, 54, 'DATE_CREATE_CATEGORIE', 'Date creation', 'timestamp', 'yes', 'yes', '', 'yes', 4, '', '', ''),
(1346, 54, 'CREATE_BY_CATEGORIE', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1345, 54, 'NOM_CATEGORIE', 'Categorie', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1344, 54, 'ID_CATEGORIE', 'ID_CATEGORIE', 'number', '', '', '', '', 1, '', '', ''),
(1350, 54, 'DELETE_BY_CATEGORIE', 'DELETE_BY_CATEGORIE', 'number', '', '', '', '', 7, '', '', ''),
(1351, 54, 'COMMENT_DELETE_CATEGORIE', 'COMMENT_DELETE_CATEGORIE', 'input', '', '', '', '', 8, '', '', ''),
(1352, 55, 'ID_ACTIVITE', 'ID_ACTIVITE', 'number', '', '', '', '', 1, '', '', ''),
(1353, 55, 'DESIGN_ACTIVITE', 'Type flux caisse', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(1354, 55, 'DESCRIPTION_ACTIVITE', 'Description', 'textarea', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(1355, 55, 'CREATE_BY', 'Creer par', 'current_user_id', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(1356, 55, 'DATE_CREATE', 'Date creation', 'timestamp', 'yes', 'yes', '', 'yes', 5, '', '', ''),
(1357, 55, 'DELETE_DATE', 'DELETE_DATE', 'datetime', '', '', '', '', 6, '', '', ''),
(1358, 55, 'DELETE_STATUS', 'DELETE_STATUS', 'number', '', '', '', '', 7, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field_validation`
--

CREATE TABLE `crud_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field_validation`
--

INSERT INTO `crud_field_validation` (`id`, `crud_field_id`, `crud_id`, `validation_name`, `validation_value`) VALUES
(39, 25, 1, 'required', ''),
(38, 24, 1, 'max_length', '2'),
(37, 24, 1, 'required', ''),
(36, 23, 1, 'required', ''),
(35, 22, 1, 'max_length', '20'),
(34, 22, 1, 'required', ''),
(33, 21, 1, 'max_length', '20'),
(32, 21, 1, 'required', ''),
(31, 20, 1, 'required', ''),
(30, 19, 1, 'required', ''),
(29, 18, 1, 'max_length', '50'),
(28, 18, 1, 'required', ''),
(27, 17, 1, 'max_length', '20'),
(26, 17, 1, 'required', ''),
(25, 16, 1, 'max_length', '100'),
(24, 16, 1, 'required', ''),
(23, 15, 1, 'max_length', '255'),
(22, 15, 1, 'required', ''),
(40, 25, 1, 'max_length', '20'),
(41, 26, 1, 'required', ''),
(42, 26, 1, 'max_length', '2'),
(116, 157, 2, 'required', ''),
(44, 40, 3, 'required', ''),
(45, 40, 3, 'max_length', '50'),
(46, 47, 3, 'required', ''),
(47, 47, 3, 'max_length', '11'),
(48, 48, 3, 'required', ''),
(49, 49, 3, 'required', ''),
(50, 49, 3, 'max_length', '11'),
(51, 50, 3, 'required', ''),
(52, 52, 4, 'required', ''),
(53, 52, 4, 'max_length', '255'),
(54, 53, 4, 'required', ''),
(55, 53, 4, 'max_length', '100'),
(56, 54, 4, 'required', ''),
(57, 54, 4, 'max_length', '20'),
(58, 55, 4, 'required', ''),
(59, 55, 4, 'max_length', '50'),
(60, 56, 4, 'required', ''),
(61, 57, 4, 'required', ''),
(62, 58, 4, 'required', ''),
(63, 58, 4, 'max_length', '20'),
(64, 59, 4, 'required', ''),
(65, 59, 4, 'max_length', '20'),
(66, 60, 4, 'required', ''),
(67, 61, 4, 'required', ''),
(68, 61, 4, 'max_length', '2'),
(69, 62, 4, 'required', ''),
(70, 62, 4, 'max_length', '20'),
(71, 63, 4, 'required', ''),
(72, 63, 4, 'max_length', '2'),
(674, 1112, 5, 'max_length', '20'),
(673, 1112, 5, 'required', ''),
(672, 1111, 5, 'max_length', '2'),
(671, 1111, 5, 'required', ''),
(670, 1110, 5, 'required', ''),
(669, 1105, 5, 'max_length', '20'),
(668, 1105, 5, 'required', ''),
(667, 1104, 5, 'required', ''),
(90, 76, 6, 'required', ''),
(91, 76, 6, 'max_length', '45'),
(92, 77, 6, 'required', ''),
(93, 78, 6, 'required', ''),
(94, 79, 6, 'required', ''),
(95, 79, 6, 'max_length', '20'),
(96, 80, 6, 'required', ''),
(97, 80, 6, 'max_length', '20'),
(98, 81, 6, 'required', ''),
(99, 82, 6, 'required', ''),
(100, 82, 6, 'max_length', '2'),
(101, 83, 6, 'required', ''),
(102, 83, 6, 'max_length', '20'),
(210, 427, 8, 'required', ''),
(115, 148, 7, 'max_length', '250'),
(114, 147, 7, 'required', ''),
(117, 168, 9, 'required', ''),
(118, 169, 9, 'max_length', '250'),
(119, 188, 10, 'required', ''),
(126, 219, 11, 'max_length', '250'),
(125, 219, 11, 'required', ''),
(124, 218, 11, 'required', ''),
(127, 229, 12, 'required', ''),
(128, 232, 12, 'required', ''),
(129, 234, 12, 'required', ''),
(130, 237, 12, 'required', ''),
(212, 439, 19, 'max_length', '200'),
(211, 439, 19, 'required', ''),
(201, 367, 14, 'required', ''),
(206, 393, 17, 'required', ''),
(205, 381, 15, 'required', ''),
(204, 379, 15, 'required', ''),
(203, 377, 15, 'max_length', '20'),
(202, 377, 15, 'required', ''),
(168, 294, 13, 'required', ''),
(167, 293, 13, 'required', ''),
(166, 292, 13, 'required', ''),
(165, 291, 13, 'required', ''),
(164, 290, 13, 'required', ''),
(163, 289, 13, 'max_length', '20'),
(162, 289, 13, 'required', ''),
(627, 1065, 18, 'required', ''),
(207, 394, 17, 'required', ''),
(196, 350, 16, 'max_length', '20'),
(195, 350, 16, 'required', ''),
(194, 349, 16, 'max_length', '2'),
(193, 349, 16, 'required', ''),
(192, 348, 16, 'required', ''),
(191, 343, 16, 'max_length', '4'),
(190, 343, 16, 'required', ''),
(189, 342, 16, 'required', ''),
(213, 440, 19, 'required', ''),
(214, 442, 20, 'required', ''),
(215, 442, 20, 'max_length', '200'),
(216, 443, 20, 'required', ''),
(217, 445, 21, 'required', ''),
(218, 446, 21, 'required', ''),
(219, 447, 21, 'required', ''),
(220, 448, 21, 'required', ''),
(226, 475, 22, 'valid_email', ''),
(225, 474, 22, 'required', ''),
(224, 472, 22, 'required', ''),
(228, 496, 23, 'required', ''),
(252, 587, 24, 'required', ''),
(251, 581, 24, 'required', ''),
(250, 580, 24, 'required', ''),
(249, 579, 24, 'max_length', '250'),
(248, 578, 24, 'valid_email', ''),
(247, 577, 24, 'required', ''),
(246, 575, 24, 'required', ''),
(245, 574, 24, 'required', ''),
(277, 658, 27, 'required', ''),
(276, 656, 26, 'max_length', '220'),
(275, 656, 26, 'required', ''),
(274, 655, 26, 'max_length', '20'),
(273, 655, 26, 'required', ''),
(272, 654, 26, 'max_length', '2'),
(271, 654, 26, 'required', ''),
(270, 653, 26, 'required', ''),
(269, 646, 26, 'required', ''),
(268, 644, 26, 'required', ''),
(305, 698, 28, 'max_length', '220'),
(304, 698, 28, 'required', ''),
(303, 697, 28, 'max_length', '20'),
(302, 697, 28, 'required', ''),
(301, 696, 28, 'max_length', '2'),
(300, 696, 28, 'required', ''),
(299, 695, 28, 'required', ''),
(298, 688, 28, 'required', ''),
(297, 687, 28, 'max_length', '200'),
(296, 687, 28, 'required', ''),
(295, 686, 28, 'required', ''),
(306, 700, 29, 'required', ''),
(307, 700, 29, 'max_length', '2'),
(308, 701, 29, 'required', ''),
(309, 701, 29, 'max_length', '200'),
(310, 702, 29, 'required', ''),
(311, 702, 29, 'max_length', '200'),
(312, 703, 29, 'required', ''),
(313, 703, 29, 'max_length', '250'),
(314, 704, 29, 'required', ''),
(315, 704, 29, 'max_length', '20'),
(316, 705, 29, 'required', ''),
(317, 705, 29, 'max_length', '11'),
(318, 706, 29, 'required', ''),
(319, 706, 29, 'max_length', '200'),
(320, 707, 29, 'required', ''),
(321, 708, 29, 'required', ''),
(322, 709, 29, 'required', ''),
(323, 709, 29, 'max_length', '220'),
(324, 710, 29, 'required', ''),
(325, 710, 29, 'max_length', '200'),
(326, 711, 29, 'required', ''),
(327, 712, 29, 'required', ''),
(328, 713, 29, 'required', ''),
(329, 714, 29, 'required', ''),
(330, 715, 29, 'required', ''),
(331, 715, 29, 'max_length', '200'),
(332, 716, 29, 'required', ''),
(333, 717, 29, 'required', ''),
(334, 718, 29, 'required', ''),
(335, 719, 29, 'required', ''),
(336, 720, 29, 'required', ''),
(337, 720, 29, 'max_length', '200'),
(338, 721, 29, 'required', ''),
(339, 722, 29, 'required', ''),
(340, 723, 29, 'required', ''),
(341, 723, 29, 'max_length', '11'),
(342, 724, 29, 'required', ''),
(343, 725, 29, 'required', ''),
(344, 725, 29, 'max_length', '20'),
(345, 726, 29, 'required', ''),
(346, 726, 29, 'max_length', '20'),
(347, 727, 29, 'required', ''),
(348, 727, 29, 'max_length', '20'),
(349, 728, 29, 'required', ''),
(350, 729, 29, 'required', ''),
(351, 730, 29, 'required', ''),
(352, 730, 29, 'max_length', '20'),
(353, 731, 29, 'required', ''),
(354, 731, 29, 'max_length', '20'),
(355, 732, 29, 'required', ''),
(356, 733, 29, 'required', ''),
(357, 733, 29, 'max_length', '2'),
(358, 734, 29, 'required', ''),
(359, 734, 29, 'max_length', '20'),
(471, 832, 31, 'required', ''),
(470, 830, 30, 'max_length', '300'),
(469, 830, 30, 'required', ''),
(468, 829, 30, 'max_length', '20'),
(467, 829, 30, 'required', ''),
(466, 828, 30, 'max_length', '2'),
(465, 828, 30, 'required', ''),
(464, 827, 30, 'required', ''),
(463, 822, 30, 'required', ''),
(462, 821, 30, 'max_length', '20'),
(461, 821, 30, 'required', ''),
(460, 820, 30, 'required', ''),
(459, 819, 30, 'required', ''),
(458, 818, 30, 'max_length', '11'),
(457, 818, 30, 'required', ''),
(456, 817, 30, 'max_length', '200'),
(455, 817, 30, 'required', ''),
(454, 816, 30, 'required', ''),
(453, 815, 30, 'required', ''),
(452, 814, 30, 'required', ''),
(451, 813, 30, 'required', ''),
(450, 812, 30, 'required', ''),
(449, 811, 30, 'required', ''),
(448, 810, 30, 'required', ''),
(447, 809, 30, 'required', ''),
(446, 808, 30, 'required', ''),
(472, 833, 31, 'required', ''),
(484, 884, 33, 'required', ''),
(483, 883, 33, 'required', ''),
(482, 882, 33, 'required', ''),
(481, 863, 32, 'required', ''),
(480, 862, 32, 'required', ''),
(479, 860, 32, 'required', ''),
(485, 884, 33, 'max_length', '200'),
(486, 885, 33, 'required', ''),
(487, 886, 33, 'required', ''),
(488, 887, 33, 'required', ''),
(489, 888, 33, 'required', ''),
(490, 888, 33, 'max_length', '20'),
(491, 895, 34, 'required', ''),
(540, 966, 36, 'required', ''),
(539, 964, 36, 'required', ''),
(538, 963, 36, 'required', ''),
(537, 961, 35, 'max_length', '20'),
(536, 961, 35, 'required', ''),
(535, 960, 35, 'max_length', '20'),
(534, 960, 35, 'required', ''),
(533, 959, 35, 'max_length', '2'),
(532, 959, 35, 'required', ''),
(531, 958, 35, 'required', ''),
(530, 953, 35, 'required', ''),
(529, 952, 35, 'required', ''),
(528, 950, 35, 'required', ''),
(541, 967, 36, 'required', ''),
(542, 968, 36, 'required', ''),
(543, 969, 36, 'required', ''),
(544, 970, 36, 'required', ''),
(545, 970, 36, 'max_length', '2'),
(546, 971, 36, 'required', ''),
(547, 971, 36, 'max_length', '20'),
(548, 972, 36, 'required', ''),
(549, 972, 36, 'max_length', '200'),
(595, 1024, 37, 'max_length', '300'),
(594, 1024, 37, 'required', ''),
(593, 1023, 37, 'max_length', '20'),
(592, 1023, 37, 'required', ''),
(591, 1022, 37, 'max_length', '2'),
(590, 1022, 37, 'required', ''),
(589, 1021, 37, 'required', ''),
(588, 1016, 37, 'max_length', '110'),
(587, 1016, 37, 'required', ''),
(586, 1015, 37, 'max_length', '11'),
(585, 1015, 37, 'required', ''),
(584, 1008, 37, 'required', ''),
(583, 1005, 37, 'required', ''),
(582, 1004, 37, 'required', ''),
(581, 1002, 37, 'max_length', '20'),
(580, 1002, 37, 'required', ''),
(579, 1001, 37, 'max_length', '10'),
(578, 1001, 37, 'required', ''),
(577, 1000, 37, 'max_length', '300'),
(576, 1000, 37, 'required', ''),
(596, 1026, 38, 'required', ''),
(597, 1030, 38, 'required', ''),
(598, 1031, 38, 'required', ''),
(626, 1063, 39, 'max_length', '200'),
(625, 1063, 39, 'required', ''),
(624, 1062, 39, 'max_length', '20'),
(623, 1062, 39, 'required', ''),
(622, 1061, 39, 'max_length', '2'),
(621, 1061, 39, 'required', ''),
(620, 1060, 39, 'required', ''),
(619, 1055, 39, 'max_length', '3'),
(618, 1055, 39, 'required', ''),
(617, 1054, 39, 'required', ''),
(616, 1053, 39, 'required', ''),
(628, 1075, 40, 'required', ''),
(629, 1075, 40, 'max_length', '50'),
(630, 1076, 40, 'required', ''),
(631, 1076, 40, 'max_length', '255'),
(632, 1077, 40, 'required', ''),
(633, 1077, 40, 'max_length', '255'),
(634, 1078, 40, 'required', ''),
(635, 1079, 40, 'required', ''),
(636, 1080, 40, 'required', ''),
(637, 1081, 40, 'required', ''),
(638, 1082, 40, 'required', ''),
(639, 1082, 40, 'max_length', '11'),
(640, 1083, 40, 'required', ''),
(641, 1083, 40, 'max_length', '11'),
(642, 1084, 40, 'required', ''),
(643, 1084, 40, 'max_length', '11'),
(644, 1085, 40, 'required', ''),
(645, 1085, 40, 'max_length', '11'),
(646, 1086, 40, 'required', ''),
(647, 1087, 40, 'required', ''),
(648, 1087, 40, 'max_length', '255'),
(666, 1103, 5, 'required', ''),
(665, 1102, 5, 'required', ''),
(678, 1121, 41, 'required', ''),
(677, 1120, 41, 'required', ''),
(679, 1122, 41, 'required', ''),
(696, 1172, 42, 'required', ''),
(695, 1171, 42, 'required', ''),
(694, 1170, 42, 'required', ''),
(686, 1150, 43, 'required', ''),
(687, 1153, 43, 'required', ''),
(688, 1153, 43, 'max_length', '11'),
(689, 1154, 43, 'required', ''),
(690, 1154, 43, 'max_length', '11'),
(697, 1184, 44, 'required', ''),
(698, 1186, 44, 'required', ''),
(699, 1197, 44, 'required', ''),
(700, 1199, 44, 'required', ''),
(701, 1199, 44, 'max_length', '20'),
(702, 1200, 44, 'required', ''),
(703, 1201, 44, 'required', ''),
(704, 1201, 44, 'max_length', '2'),
(705, 1202, 44, 'required', ''),
(706, 1202, 44, 'max_length', '20'),
(707, 1203, 44, 'required', ''),
(708, 1203, 44, 'max_length', '300'),
(709, 1204, 44, 'required', ''),
(710, 1204, 44, 'max_length', '11'),
(711, 1205, 44, 'required', ''),
(712, 1205, 44, 'max_length', '300'),
(713, 1206, 44, 'required', ''),
(714, 1206, 44, 'max_length', '11'),
(715, 1208, 45, 'required', ''),
(716, 1208, 45, 'max_length', '250'),
(717, 1210, 45, 'required', ''),
(718, 1210, 45, 'max_length', '11'),
(719, 1212, 45, 'required', ''),
(720, 1212, 45, 'max_length', '255'),
(721, 1216, 45, 'required', ''),
(722, 1221, 45, 'required', ''),
(723, 1221, 45, 'max_length', '11'),
(724, 1223, 45, 'required', ''),
(725, 1223, 45, 'max_length', '11'),
(726, 1224, 45, 'required', ''),
(727, 1225, 45, 'required', ''),
(728, 1225, 45, 'max_length', '11'),
(729, 1226, 45, 'required', ''),
(730, 1226, 45, 'max_length', '255'),
(731, 1228, 46, 'required', ''),
(732, 1228, 46, 'max_length', '11'),
(733, 1229, 46, 'required', ''),
(734, 1229, 46, 'max_length', '11'),
(735, 1231, 46, 'required', ''),
(736, 1231, 46, 'max_length', '6'),
(737, 1232, 46, 'required', ''),
(738, 1232, 46, 'max_length', '6'),
(739, 1233, 46, 'required', ''),
(740, 1233, 46, 'max_length', '250'),
(741, 1234, 46, 'required', ''),
(742, 1234, 46, 'max_length', '11'),
(743, 1235, 46, 'required', ''),
(744, 1235, 46, 'max_length', '4'),
(745, 1236, 46, 'required', ''),
(746, 1239, 46, 'required', ''),
(747, 1243, 46, 'required', ''),
(748, 1243, 46, 'max_length', '20'),
(749, 1259, 48, 'required', ''),
(750, 1266, 49, 'required', ''),
(751, 1267, 49, 'required', ''),
(752, 1272, 50, 'required', ''),
(753, 1273, 50, 'required', ''),
(754, 1286, 51, 'required', ''),
(755, 1286, 51, 'max_length', '255'),
(756, 1287, 51, 'required', ''),
(757, 1287, 51, 'max_length', '255'),
(758, 1288, 51, 'required', ''),
(759, 1288, 51, 'max_length', '255'),
(760, 1289, 51, 'required', ''),
(761, 1289, 51, 'max_length', '250'),
(762, 1290, 51, 'required', ''),
(763, 1290, 51, 'max_length', '250'),
(764, 1291, 51, 'required', ''),
(765, 1291, 51, 'max_length', '250'),
(766, 1292, 51, 'required', ''),
(767, 1292, 51, 'max_length', '250'),
(768, 1293, 51, 'required', ''),
(769, 1293, 51, 'max_length', '150'),
(770, 1294, 51, 'required', ''),
(771, 1294, 51, 'max_length', '150'),
(772, 1295, 51, 'required', ''),
(773, 1295, 51, 'max_length', '10'),
(774, 1296, 51, 'required', ''),
(775, 1319, 52, 'required', ''),
(776, 1320, 52, 'required', ''),
(777, 1321, 52, 'required', ''),
(778, 1322, 52, 'required', ''),
(780, 1345, 54, 'required', ''),
(781, 1353, 55, 'required', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_type`
--

CREATE TABLE `crud_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_type`
--

INSERT INTO `crud_input_type` (`id`, `type`, `relation`, `custom_value`, `validation_group`) VALUES
(1, 'input', '0', 0, 'input'),
(2, 'textarea', '0', 0, 'text'),
(3, 'select', '1', 0, 'select'),
(4, 'editor_wysiwyg', '0', 0, 'editor'),
(5, 'password', '0', 0, 'password'),
(6, 'email', '0', 0, 'email'),
(7, 'address_map', '0', 0, 'address_map'),
(8, 'file', '0', 0, 'file'),
(9, 'file_multiple', '0', 0, 'file_multiple'),
(10, 'datetime', '0', 0, 'datetime'),
(11, 'date', '0', 0, 'date'),
(12, 'timestamp', '0', 0, 'timestamp'),
(13, 'number', '0', 0, 'number'),
(14, 'yes_no', '0', 0, 'yes_no'),
(15, 'time', '0', 0, 'time'),
(16, 'year', '0', 0, 'year'),
(17, 'select_multiple', '1', 0, 'select_multiple'),
(18, 'checkboxes', '1', 0, 'checkboxes'),
(19, 'options', '1', 0, 'options'),
(20, 'true_false', '0', 0, 'true_false'),
(21, 'current_user_username', '0', 0, 'user_username'),
(22, 'current_user_id', '0', 0, 'current_user_id'),
(23, 'custom_option', '0', 1, 'custom_option'),
(24, 'custom_checkbox', '0', 1, 'custom_checkbox'),
(25, 'custom_select_multiple', '0', 1, 'custom_select_multiple'),
(26, 'custom_select', '0', 1, 'custom_select');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_validation`
--

CREATE TABLE `crud_input_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_validation`
--

INSERT INTO `crud_input_validation` (`id`, `validation`, `input_able`, `group_input`, `input_placeholder`, `call_back`, `input_validation`) VALUES
(1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple', '', '', ''),
(2, 'max_length', 'yes', 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map', '', '', 'numeric'),
(3, 'min_length', 'yes', 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map', '', '', 'numeric'),
(4, 'valid_email', 'no', 'input, email', '', '', ''),
(5, 'valid_emails', 'no', 'input, email', '', '', ''),
(6, 'regex', 'yes', 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes', '', 'yes', 'callback_valid_regex'),
(7, 'decimal', 'no', 'input, number, text, select', '', '', ''),
(8, 'allowed_extension', 'yes', 'file, file_multiple', 'ex : jpg,png,..', '', 'callback_valid_extension_list'),
(9, 'max_width', 'yes', 'file, file_multiple', '', '', 'numeric'),
(10, 'max_height', 'yes', 'file, file_multiple', '', '', 'numeric'),
(11, 'max_size', 'yes', 'file, file_multiple', '... kb', '', 'numeric'),
(12, 'max_item', 'yes', 'file_multiple', '', '', 'numeric'),
(13, 'valid_url', 'no', 'input, text', '', '', ''),
(14, 'alpha', 'no', 'input, text, select, password, editor, yes_no', '', '', ''),
(15, 'alpha_numeric', 'no', 'input, number, text, select, password, editor', '', '', ''),
(16, 'alpha_numeric_spaces', 'no', 'input, number, text,select, password, editor', '', '', ''),
(17, 'valid_number', 'no', 'input, number, text, password, editor, true_false', '', 'yes', ''),
(18, 'valid_datetime', 'no', 'input, datetime, text', '', 'yes', ''),
(19, 'valid_date', 'no', 'input, datetime, date, text', '', 'yes', ''),
(20, 'valid_max_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(21, 'valid_min_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(22, 'valid_alpha_numeric_spaces_underscores', 'no', 'input, text,select, password, editor', '', 'yes', ''),
(23, 'matches', 'yes', 'input, number, text, password, email', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(24, 'valid_json', 'no', 'input, text, editor', '', 'yes', ' '),
(25, 'valid_url', 'no', 'input, text, editor', '', 'no', ' '),
(26, 'exact_length', 'yes', 'input, text, number', '0 - 99999*', 'no', 'numeric'),
(27, 'alpha_dash', 'no', 'input, text', '', 'no', ''),
(28, 'integer', 'no', 'input, text, number', '', 'no', ''),
(29, 'differs', 'yes', 'input, text, number, email, password, editor, options, select', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(30, 'is_natural', 'no', 'input, text, number', '', 'no', ''),
(31, 'is_natural_no_zero', 'no', 'input, text, number', '', 'no', ''),
(32, 'less_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(33, 'less_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(34, 'greater_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(35, 'greater_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(36, 'in_list', 'yes', 'input, text, number, select, options', '', 'no', 'callback_valid_multiple_value'),
(37, 'valid_ip', 'no', 'input, text', '', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `etat_ingredients`
--

CREATE TABLE `etat_ingredients` (
  `ID_ETAT` int(11) NOT NULL,
  `NOM_ETAT` varchar(222) NOT NULL,
  `DATE_CREATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etat_ingredients`
--

INSERT INTO `etat_ingredients` (`ID_ETAT`, `NOM_ETAT`, `DATE_CREATE`) VALUES
(1, 'liquide', '0000-00-00'),
(2, 'solide', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `facturer_reserver`
--

CREATE TABLE `facturer_reserver` (
  `ID_FACT_RESERVER` int(11) NOT NULL,
  `ID_FACTURE` int(11) NOT NULL,
  `CODE_FACT_RESERVER` varchar(200) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `MONTANT_FACT_RESERVER` float DEFAULT NULL,
  `DATE_FACT_RESERVER` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATE_BY_FACT_RESERVER` int(11) DEFAULT NULL,
  `DELETE_STATUS` int(11) NOT NULL DEFAULT '0',
  `DELETE_BY` int(11) DEFAULT NULL,
  `DATE_DELETE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturer_reserver`
--

INSERT INTO `facturer_reserver` (`ID_FACT_RESERVER`, `ID_FACTURE`, `CODE_FACT_RESERVER`, `ID_CLIENT`, `MONTANT_FACT_RESERVER`, `DATE_FACT_RESERVER`, `CREATE_BY_FACT_RESERVER`, `DELETE_STATUS`, `DELETE_BY`, `DATE_DELETE`) VALUES
(1, 725, 'FACT00001/05/21', 1, 251000, '2021-05-01 09:29:53', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_attribute`
--

CREATE TABLE `form_custom_attribute` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_custom_option`
--

CREATE TABLE `form_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_field`
--

CREATE TABLE `form_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `placeholder` text,
  `auto_generate_help_block` varchar(10) DEFAULT NULL,
  `help_block` text,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `form_field_validation`
--

CREATE TABLE `form_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_cancelled`
--

CREATE TABLE `invoice_cancelled` (
  `id_invoice_cancelled` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `invoice_signature` varchar(250) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_saved`
--

CREATE TABLE `invoice_saved` (
  `id_invoice` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `invoice_signature` varchar(250) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '70C49587127FDB9FDE1C68CCE3BFDE7C', 0, 0, 0, NULL, '2021-01-12 13:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `marge_prix`
--

CREATE TABLE `marge_prix` (
  `ID_MARGE` int(11) NOT NULL,
  `DESIGNATION` varchar(50) NOT NULL,
  `MARGE` int(11) NOT NULL,
  `TYPE_MARGE` int(11) NOT NULL DEFAULT '0',
  `CREATED_BY` int(11) NOT NULL,
  `DATE_CREATION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marge_prix`
--

INSERT INTO `marge_prix` (`ID_MARGE`, `DESIGNATION`, `MARGE`, `TYPE_MARGE`, `CREATED_BY`, `DATE_CREATION`) VALUES
(2, 'marge', 45, 0, 1, '2021-01-20 08:36:09'),
(3, 'avec', 75, 1, 1, '2021-01-20 09:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `icon_color` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `store` varchar(10) NOT NULL,
  `boutique` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `type`, `icon_color`, `link`, `sort`, `parent`, `icon`, `menu_type_id`, `active`, `store`, `boutique`) VALUES
(2, 'Dashboard', 'menu', 'default', 'administrator/dashboard', 1, 0, 'fa-dashboard', 1, 1, 'Non', ''),
(8, 'Menu', 'menu', 'default', 'administrator/menu', 65, 23, 'fa-bars', 1, 0, 'Non', ''),
(9, 'Utilisateurs', 'menu', 'default', '#', 69, 23, 'fa-shield', 1, 1, 'Non', '1,2,4,5,8'),
(10, 'User', 'menu', 'default', 'administrator/user', 70, 9, '', 1, 1, 'Non', ''),
(11, 'Groups', 'menu', 'default', 'administrator/group', 71, 9, '', 1, 1, 'Non', ''),
(12, 'Access', 'menu', 'default', 'administrator/access', 73, 9, '', 1, 0, 'Non', ''),
(13, 'Permission', 'menu', 'default', 'administrator/permission', 74, 9, '', 1, 0, 'Non', ''),
(82, 'Dashboard', 'menu', 'default', 'stores/dashboard', 2, 0, 'fa-dashboard', 1, 1, 'Oui', '1,2,3,4,5,8,9'),
(20, 'Home', 'menu', '', '/', 1, 0, '', 2, 1, '', ''),
(21, 'Blog', 'menu', '', 'blog', 4, 0, '', 2, 1, '', ''),
(22, 'Dashboard', 'menu', '', 'dashboard', 5, 0, '', 2, 1, '', ''),
(23, 'Parametres', 'menu', 'default', 'administrator/#', 64, 0, 'fa-cogs', 1, 1, 'Non', ''),
(25, 'Categories des Actes', 'menu', 'default', 'administrator/actes_categorie', 21, 32, 'fa-contao', 1, 1, 'Non', ''),
(27, 'Boutiques', 'menu', 'default', '#', 4, 0, 'fa-cubes', 1, 1, 'Non', ''),
(84, 'Marge prix', 'menu', 'default', 'administrator/marge_prix', 67, 23, 'fa-money', 1, 1, 'Non', ''),
(34, 'Inventaires', 'menu', 'default', '#', 7, 0, 'fa-archive', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(35, 'Approvisionnements', 'menu', 'default', 'approvisionnements/index', 14, 34, '', 1, 1, 'Oui', '1,2,4,5,8,9'),
(38, 'Item Location', 'menu', 'default', 'rayons/index', 15, 34, '', 1, 1, 'Oui', '1,2,3,4,5,8,9'),
(40, 'Sociétes', 'menu', 'default', 'administrator/hospital_ibi_societes', 18, 29, '', 1, 1, 'Non', ''),
(75, 'Annexes des assurances', 'menu', 'default', 'administrator/hospital_ibi_commandes/annex_assurance', 49, 64, '', 1, 1, 'Non', ''),
(47, 'liste des categories', 'menu', 'default', 'categories/index', 12, 34, '', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(48, 'Liste des articles', 'menu', 'default', 'articles/index', 8, 34, '', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(110, 'Flux Caisse', 'menu', 'default', 'administrator/pos_flux_caisse/index', 35, 106, '', 1, 1, 'Non', ''),
(120, 'Stocks', 'menu', 'default', 'administrator/stores', 5, 27, '', 1, 1, 'Non', ''),
(83, 'Ingredient', 'menu', 'default', 'ingredients/index', 31, 0, 'fa-object-group', 1, 0, 'Oui', '1'),
(53, 'Lits', 'menu', 'default', 'administrator/bed', 16, 29, '', 1, 1, 'Non', ''),
(58, 'Mouvement de Stock', 'menu', 'default', 'administrator/rapports/mouvement_de_stock', 46, 64, 'fa-sort-amount-asc', 1, 1, 'Non', ''),
(59, 'Ajustement des quantites', 'menu', 'default', 'approvisionnements/ajustement', 13, 34, '', 1, 1, 'Oui', '1,2,3,4,5,8,9'),
(141, 'Unite de mesure', 'menu', 'default', 'unite_mesure/index', 21, 34, '', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(63, 'Paiements de Reçus', 'menu', 'default', 'administrator/hospital_ibi_paiements', 26, 55, 'fa-amazon', 1, 1, 'Non', ''),
(65, 'Chiffres d\'affaire', 'menu', 'default', 'administrator/rapport_chiffre', 45, 64, 'fa-industry', 1, 1, 'Non', ''),
(71, 'Inventaires', 'menu', 'default', 'inventaires/index', 16, 34, '', 1, 1, 'Oui', '1,2,3,4,5,8,9,10'),
(73, 'Ventes', 'label', 'default', 'pointdesventes/commandes/liste/index', 72, 9, '', 1, 1, 'Oui', '1,2,3,18'),
(76, 'Sortie', 'menu', 'default', 'sortie/index', 10, 34, 'fa-folder-open', 1, 1, 'Oui', '1'),
(79, 'Rapport Bumerec', 'menu', 'default', 'administrator/hospital_ibi_commandes/rapport_facture_bumerec', 52, 64, 'fa-genderless', 1, 1, 'Non', ''),
(80, 'Mouvement par boutique', 'menu', 'default', 'rapports/mouvement_de_stock_store', 60, 0, 'fa-sort-amount-desc', 1, 1, 'Oui', '1,2,3,4,5,8,9'),
(81, 'Factures Assurances', 'menu', 'default', 'administrator/facture_assurance/index', 28, 55, '', 1, 1, 'Non', ''),
(85, 'Client', 'menu', 'default', 'administrator/pos_clients', 57, 102, 'fa-group', 1, 1, 'Non', ''),
(86, 'Facture', 'menu', 'default', 'administrator/pos_ibi_commandes', 53, 0, 'fa-newspaper-o', 1, 1, 'Non', ''),
(87, 'Type de client', 'menu', 'default', 'administrator/pos_type_clients', 58, 102, '', 1, 1, 'Non', ''),
(88, 'Demandes', 'menu', 'default', '#', 23, 0, 'fa-exchange', 1, 0, 'Oui', '1,2,4,5,8,9,11'),
(89, 'Demandes envoyés', 'menu', 'default', 'pos_ibi_requisition_trans/index', 24, 88, '', 1, 0, 'Oui', '1,2,4,5,8'),
(90, 'Demandes reçues', 'menu', 'default', 'requisition_recu_trans/index', 25, 88, '', 1, 0, 'Oui', '1,2,4,5,8'),
(91, 'Rapports', 'menu', 'default', 'rapports/index', 40, 0, 'fa-balance-scale', 1, 1, 'Non', ''),
(119, 'Liste plats', 'menu', 'default', 'articles/liste_plats', 17, 34, '', 1, 0, 'Oui', '1,2,4,5'),
(93, 'Fournisseurs', 'menu', 'default', 'administrator/pos_ibi_fournisseurs/index', 39, 0, 'fa-get-pocket', 1, 1, 'Non', ''),
(109, 'Dette envers tiers', 'menu', 'default', 'depense/dette_envers_tiers', 34, 106, '', 1, 0, 'Non', ''),
(96, 'Rapports Serveurs', 'menu', 'default', 'rapports/serveurs', 41, 91, '', 1, 0, 'Non', '1,2,4,5'),
(106, 'Caisse', 'menu', 'default', 'administrator/#', 32, 0, 'fa-diamond', 1, 1, 'Non', ''),
(98, 'Point de vente', 'menu', 'default', 'administrator/pointdesventes', 3, 0, 'fa-shopping-cart', 1, 1, 'Non', ''),
(108, 'Achats au comptant', 'menu', 'default', 'depense/paiement_comptant', 33, 106, '', 1, 0, 'Non', ''),
(100, 'Categorie  flux caisse', 'menu', 'default', 'administrator/pos_categorie_flux_caisse', 36, 106, 'fa-map-signs', 1, 1, 'Non', ''),
(101, 'Recettes journaliere', 'menu', 'default', 'administrator/rapports/recette_journaliere', 43, 91, '', 1, 1, 'Non', ''),
(102, 'Clients', 'menu', 'default', '#', 56, 0, 'fa-users', 1, 1, 'Non', ''),
(103, 'Situation clients', 'menu', 'default', 'administrator/situation_clients', 59, 102, '', 1, 1, 'Non', ''),
(104, 'Rapport Ingredient', 'menu', 'default', '#', 61, 0, 'fa-pie-chart', 1, 0, 'Non', ''),
(105, 'Vente Ingredient', 'menu', 'default', 'administrator/Rapport_vente_ingredient', 62, 104, '', 1, 0, 'Non', ''),
(111, 'Commandes', 'menu', 'default', 'administrator#', 50, 0, 'fa-cart-arrow-down', 1, 0, 'Non', ''),
(112, 'Factures', 'menu', 'default', 'administrator/pos_ibi_commandes/index', 52, 111, '', 1, 1, 'Non', ''),
(113, 'Proforma', NULL, 'default', 'administrator/pos_ibi_commandes/proformatindex', 51, 111, '', 1, 1, 'Non', ''),
(114, 'Factures à supprimer', 'menu', 'default', 'administrator/pos_ibi_commandes/void_to_request', 55, 86, '', 1, 1, 'Non', ''),
(115, 'Factures', 'menu', 'default', 'administrator/pos_ibi_commandes/index', 54, 86, '', 1, 1, 'Non', ''),
(116, 'Shift', 'menu', 'default', 'administrator/cashier_shifts', 29, 0, 'fa-desktop', 1, 0, 'Non', ''),
(118, 'Rapports par shifts', 'menu', 'default', 'administrator/rapports/get_list_shift', 44, 91, '', 1, 0, 'Non', ''),
(121, 'Chambres', 'menu', 'default', 'administrator/chambres', 6, 27, '', 1, 0, 'Non', ''),
(122, 'Setting app', 'menu', 'default', 'administrator/settings_app', 68, 23, '', 1, 1, 'Non', ''),
(123, 'Raison de transfert', 'menu', 'default', 'categorie_ingredient/index', 19, 34, 'fa-chrome', 1, 1, 'Oui', '2'),
(124, 'Rapport de sorties', 'menu', 'default', 'rapports/rapport_sorties', 45, 91, '', 1, 1, 'Non', ''),
(126, 'Type ajustement', 'menu', 'default', 'administrator/pos_ibi_type_ajustement', 66, 23, '', 1, 1, 'Non', ''),
(130, 'Rapports condenser', 'menu', 'default', 'administrator/rapports/rapport_condenser', 47, 91, '', 1, 1, 'Non', ''),
(127, 'Rapport transfert stock', 'menu', 'default', 'administrator/rapport_transfert_stock', 46, 91, '', 1, 1, 'Non', ''),
(128, 'Famille article', 'menu', 'default', 'famille/index', 18, 34, '', 1, 1, 'Oui', '1,2'),
(129, 'Rapport de vente par famille', 'menu', 'default', 'rapport_vente_famille/index', 63, 0, 'fa-th', 1, 1, 'Oui', '2'),
(131, 'Rapports caisse', 'menu', 'default', 'administrator/rapports/rapport_caisse', 48, 91, '', 1, 1, 'Non', ''),
(132, 'Controle stock', 'menu', 'default', 'control_stock/index', 20, 34, '', 1, 1, 'Oui', '1,2,4,5,8'),
(133, 'Rapports Condensé par Shift', 'menu', 'default', 'administrator/rapports/get_shift_close', 49, 91, '', 1, 0, 'Non', ''),
(134, 'Rapports Ventes par shift', 'menu', 'default', 'administrator/rapports/shift_rapports', 42, 91, '', 1, 0, 'Non', ''),
(135, 'Demandes', 'menu', 'default', '#', 26, 0, 'fa-exchange', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(136, 'Demandes envoyés', 'menu', 'default', 'pos_ibi_requisition_trans/index', 27, 135, '', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(137, 'Demandes reçues', 'menu', 'default', 'requisition_recu_trans/index', 28, 135, '', 1, 1, 'Oui', '1,2,4,5,8,9,10,11'),
(138, 'Approvisionnements', 'menu', 'default', 'approvisionnements/index', 9, 34, '', 1, 1, 'Oui', '1,2'),
(139, 'Sorties', 'menu', 'default', 'sortie/add', 11, 34, '', 1, 1, 'Oui', '1'),
(140, 'Réquisition d\'achat', 'menu', 'default', 'requisition/index', 22, 0, 'fa-ship', 1, 1, 'Oui', '1'),
(142, 'Tables', 'menu', 'default', 'administrator/pos_ibi_commande_location', 30, 0, 'fa-map', 1, 0, 'Non', ''),
(143, 'OBR', 'menu', 'default', '#', 75, 0, 'fa-fax', 1, 1, '', ''),
(144, 'Type flux caisse', 'menu', 'default', 'administrator/pos_activite_flux_caisse', 37, 106, '', 1, 1, 'Non', ''),
(145, 'Session caisse', 'menu', 'default', 'administrator/pos_session/index', 38, 106, '', 1, 1, 'Non', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `definition` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `name`, `definition`) VALUES
(1, 'side menu', NULL),
(2, 'top menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `mode_paiement`
--

CREATE TABLE `mode_paiement` (
  `ID_MODE_PAIEMENT` int(11) NOT NULL,
  `DESIGNATION_PAIEMENT_MODE` varchar(50) NOT NULL,
  `DESCRIPTION_PAIEMENT_MODE` varchar(100) NOT NULL,
  `CREATED_BY_PAIEMENT_MODE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mode_paiement`
--

INSERT INTO `mode_paiement` (`ID_MODE_PAIEMENT`, `DESIGNATION_PAIEMENT_MODE`, `DESCRIPTION_PAIEMENT_MODE`, `CREATED_BY_PAIEMENT_MODE`) VALUES
(1, 'cash', 'paiement cash\n', 0),
(2, 'Chèque de bancaire', 'Pour le client qui veut payer mobile money', 0),
(3, 'Lumicash', 'Pour le client qui veut payer mobile money', 1),
(5, 'Ecocash', '', 0),
(6, 'Enoti', '', 0),
(7, 'Autres', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `fresh_content` text NOT NULL,
  `keyword` text,
  `description` text,
  `link` varchar(200) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page_block_element`
--

CREATE TABLE `page_block_element` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image_preview` varchar(200) NOT NULL,
  `block_name` varchar(200) NOT NULL,
  `content_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parametrage`
--

CREATE TABLE `parametrage` (
  `ID_PARAMS` int(11) NOT NULL,
  `NOM_PARAMS` varchar(255) NOT NULL,
  `LOGIN_PARAMS` varchar(30) DEFAULT NULL,
  `PWD_PARAMS` varchar(30) DEFAULT NULL,
  `TYPE_PARAMS` int(5) DEFAULT NULL,
  `LOGO_PARAMS` text NOT NULL,
  `EMAIL_PARAMS` varchar(255) NOT NULL,
  `NIF_PARAMS` varchar(200) NOT NULL,
  `TVA_PARAMS` float DEFAULT NULL,
  `PHONE_PARAMS` varchar(255) NOT NULL,
  `RC_PARAMS` varchar(255) NOT NULL,
  `ADRESSE_PARAMS` varchar(255) NOT NULL,
  `PROVINCE_PARAMS` varchar(50) DEFAULT NULL,
  `COMMUNE_PARAMS` varchar(200) DEFAULT NULL,
  `ZONE_PARAMS` varchar(200) DEFAULT NULL,
  `QUARTIER_PARAMS` varchar(200) DEFAULT NULL,
  `AVENUE_PARAMS` varchar(200) DEFAULT NULL,
  `RUE_PARAMS` varchar(200) DEFAULT NULL,
  `NUMERO_PARAMS` varchar(20) DEFAULT NULL,
  `BP_PARAMS` varchar(200) DEFAULT NULL,
  `ASSUJETI_TVA_PARAMS` varchar(50) DEFAULT NULL,
  `ASSUJETI_TC_PARAMS` varchar(50) DEFAULT NULL,
  `ASSUJETI_PF_PARAMS` varchar(50) DEFAULT NULL,
  `CENTRE_FISCAL_PARAMS` varchar(200) DEFAULT NULL,
  `SECTEUR_ACTIVITE_PARAMS` varchar(200) DEFAULT NULL,
  `FORME_JURDIQUE_PARAMS` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID_PATIENT` int(20) NOT NULL,
  `REFERENCE_PATIENT` varchar(500) NOT NULL,
  `NOM_PATIENT` varchar(200) NOT NULL,
  `PRENOM_PATIENT` varchar(200) NOT NULL,
  `POIDS_PATIENT` int(11) DEFAULT NULL,
  `TEL_PATIENT` varchar(200) NOT NULL,
  `EMAIL_PATIENT` varchar(200) DEFAULT NULL,
  `DESCRIPTION_PATIENT` text,
  `DATE_NAISSANCE_PATIENT` datetime NOT NULL,
  `SEX_PATIENT` varchar(300) DEFAULT NULL,
  `BLOOD_GROUP_PATIENT` varchar(300) DEFAULT NULL,
  `ADRESSE_PATIENT` text,
  `LAST_ORDER_PATIENT` varchar(200) DEFAULT NULL,
  `AVATAR_PATIENT` varchar(200) DEFAULT NULL,
  `CITY_PATIENT` varchar(200) DEFAULT NULL,
  `PROVINCE_PATIENT` varchar(300) DEFAULT NULL,
  `ZONE_PATIENT` varchar(300) DEFAULT NULL,
  `COUNTRY_PATIENT` varchar(200) NOT NULL,
  `REF_GROUP_PATIENT` int(11) DEFAULT NULL,
  `REF_SOCIETE_PATIENT` int(11) DEFAULT NULL,
  `OCCUPATION_PATIENT` varchar(300) DEFAULT NULL,
  `EMEERGENCY_CONTACT_NAME_PATIENT` varchar(300) DEFAULT NULL,
  `EMEERGENCY_CONTACT_RELATIONSHIP_PATIENT` varchar(300) DEFAULT NULL,
  `EMEERGENCY_CONTACT_PHONE_PATIENT` varchar(300) DEFAULT NULL,
  `PARENT_PATIENT` int(30) DEFAULT '0',
  `DELETE_STATUS_PATIENT` int(2) NOT NULL DEFAULT '0',
  `DELETE_DATE_PATIENT` datetime DEFAULT NULL,
  `DELETE_BY_PATIENT` datetime DEFAULT NULL,
  `DELETE_DESCRIPTION_PATIENT` text,
  `DATE_CREATED_PATIENT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY_PATIENT` int(20) NOT NULL,
  `DATE_MOD_PATIENT` datetime DEFAULT NULL,
  `MODIFIED_BY_PATIENT` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_file`
--

CREATE TABLE `patient_file` (
  `PATIENT_FILE_ID` int(20) NOT NULL,
  `PATIENT_FILE_CODE` varchar(300) NOT NULL,
  `LETTER` varchar(10) NOT NULL,
  `PATIENT_ID` int(20) NOT NULL,
  `BON_DE_COMMANDE` varchar(250) DEFAULT NULL,
  `PATIENT_FILE_STATUS` int(20) NOT NULL COMMENT '0=ouverte, 1=deja ferme',
  `TYPE_DE_PAYEMET` int(2) NOT NULL DEFAULT '0' COMMENT '0=pour cash 1=bon de commande',
  `REF_SOCIETE` int(11) NOT NULL DEFAULT '1',
  `DOCTOR_ID` int(20) NOT NULL DEFAULT '0',
  `PRIVATE_DOCTOR` varchar(150) DEFAULT NULL,
  `DEPARTEMENT_ID` int(20) NOT NULL DEFAULT '0',
  `CONSULTATION` int(10) DEFAULT '1',
  `ACTES` int(10) DEFAULT '1',
  `MEDICAMENTS` int(10) DEFAULT '1',
  `LABORATOIRE` int(10) DEFAULT '1',
  `SEJOUR` int(10) DEFAULT '1',
  `MEDICAMENT_MATER` int(8) DEFAULT '1',
  `TRANSFERED_TO_ACCOUNTING` int(11) DEFAULT '1' COMMENT 'yes=1 no=0',
  `DATE_CREATION_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_PATIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `MODIFIED_BY_PATIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `DELETED_DATE_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_PATIENT_FILE` int(2) NOT NULL DEFAULT '0',
  `DELETED_USER_PATIENT_FILE` int(20) NOT NULL DEFAULT '0',
  `DELETED_COMMENT_PATIENT_FILE` varchar(300) DEFAULT NULL,
  `PAYER_FACTURE` int(11) DEFAULT NULL,
  `NUMERO_FACTURE` varchar(300) NOT NULL,
  `DECLOTURE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_activite_flux_caisse`
--

CREATE TABLE `pos_activite_flux_caisse` (
  `ID_ACTIVITE` int(11) NOT NULL,
  `DESIGN_ACTIVITE` varchar(222) NOT NULL,
  `DESCRIPTION_ACTIVITE` varchar(200) NOT NULL,
  `CREATE_BY` int(11) NOT NULL,
  `DATE_CREATE` datetime NOT NULL,
  `DELETE_DATE` datetime DEFAULT NULL,
  `DELETE_STATUS` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_article_famille`
--

CREATE TABLE `pos_article_famille` (
  `ID_FAMILLE` int(11) NOT NULL,
  `ID_STORES` int(11) DEFAULT NULL,
  `NAME_FAMILLE` varchar(255) NOT NULL,
  `DESCRIPTION_FAMILLE` varchar(255) NOT NULL,
  `DATE_CREATION_FAMILLE` datetime NOT NULL,
  `DATE_MOD_FAMILLE` datetime NOT NULL,
  `CREATED_BY_FAMILLE` int(11) NOT NULL,
  `MODIFIED_BY_FAMILLE` int(11) NOT NULL,
  `DELETED_BY_FAMILLE` int(11) NOT NULL,
  `DELETE_STATUS_FAMILLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_article_famille`
--

INSERT INTO `pos_article_famille` (`ID_FAMILLE`, `ID_STORES`, `NAME_FAMILLE`, `DESCRIPTION_FAMILLE`, `DATE_CREATION_FAMILLE`, `DATE_MOD_FAMILLE`, `CREATED_BY_FAMILLE`, `MODIFIED_BY_FAMILLE`, `DELETED_BY_FAMILLE`, `DELETE_STATUS_FAMILLE`) VALUES
(1, NULL, 'Toles', '', '2022-05-17 15:52:58', '0000-00-00 00:00:00', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_categorie_depense`
--

CREATE TABLE `pos_categorie_depense` (
  `ID_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `NOM_CATEGORIE_DEPENSE` varchar(230) NOT NULL,
  `CREATE_BY_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `DATE_CREATE_CATEGORIE_DEPENSE` datetime NOT NULL,
  `DELETE_STATUS_CATEGORIE_DEPENSE` int(11) NOT NULL DEFAULT '0',
  `DELETE_DATE_CATEGORIE_DEPENSE` datetime DEFAULT NULL,
  `DELETE_BY_CATEGORIE_DEPENSE` int(11) DEFAULT NULL,
  `COMMENT_DELETE_CATEGORIE_DEPENSE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_categorie_flux_caisse`
--

CREATE TABLE `pos_categorie_flux_caisse` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) NOT NULL,
  `CREATE_BY_CATEGORIE` int(11) NOT NULL,
  `DATE_CREATE_CATEGORIE` datetime NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL DEFAULT '0',
  `DELETE_DATE_CATEGORIE` datetime DEFAULT NULL,
  `DELETE_BY_CATEGORIE` int(11) DEFAULT NULL,
  `COMMENT_DELETE_CATEGORIE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_clients`
--

CREATE TABLE `pos_clients` (
  `ID_CLIENT` int(11) NOT NULL,
  `TYPE_CLIENT_ID` int(11) NOT NULL,
  `NOM_CLIENT` varchar(255) NOT NULL,
  `FULL_NAME` varchar(250) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `TEL_CLIENTS` varchar(50) DEFAULT NULL,
  `AVEC_TVA` int(11) NOT NULL DEFAULT '0',
  `DATE_CREATION_CLIENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CREATED_BY_CLIENT` int(11) DEFAULT NULL,
  `DELETE_STATUS_CLIENT` int(11) NOT NULL DEFAULT '0',
  `DELETE_COMMENT_CLIENT` int(11) DEFAULT NULL,
  `DATE_MOD_CLIENT` varchar(50) DEFAULT NULL,
  `DELETE_BY_CLIENT` int(11) DEFAULT NULL,
  `MODIFIED_BY_CLIENT` int(11) DEFAULT NULL,
  `NUM_IDENTITE` varchar(230) DEFAULT NULL,
  `SEXE` varchar(30) DEFAULT NULL,
  `ADRESSE_CLIENT` varchar(200) DEFAULT NULL,
  `DOCUMENT_FILE_IDENTITE` varchar(230) DEFAULT NULL,
  `SOCIETE_CLIENT` int(20) DEFAULT NULL,
  `NIF_CLIENT` varchar(200) DEFAULT NULL,
  `DESCRIPTION_CLIENT` text,
  `TYPE_IDENTITE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_clients`
--

INSERT INTO `pos_clients` (`ID_CLIENT`, `TYPE_CLIENT_ID`, `NOM_CLIENT`, `FULL_NAME`, `PRENOM`, `TEL_CLIENTS`, `AVEC_TVA`, `DATE_CREATION_CLIENT`, `CREATED_BY_CLIENT`, `DELETE_STATUS_CLIENT`, `DELETE_COMMENT_CLIENT`, `DATE_MOD_CLIENT`, `DELETE_BY_CLIENT`, `MODIFIED_BY_CLIENT`, `NUM_IDENTITE`, `SEXE`, `ADRESSE_CLIENT`, `DOCUMENT_FILE_IDENTITE`, `SOCIETE_CLIENT`, `NIF_CLIENT`, `DESCRIPTION_CLIENT`, `TYPE_IDENTITE`) VALUES
(12, 0, 'CLIENT CASH', 'CLIENT CASH', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 0, 'AMIDU  CLEON', 'AMIDU  CLEON', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 0, 'ANITHA', 'ANITHA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 0, 'ALLY SALUM', 'ALLY SALUM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 0, 'ALAIN  MUBADA', 'ALAIN  MUBADA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 0, 'ABU DUBAI', 'ABU DUBAI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 0, 'ATELAC', 'ATELAC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 0, 'ABRAHAM', 'ABRAHAM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 0, 'AMINATHA', 'AMINATHA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 0, 'AGATHE', 'AGATHE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 0, 'AIME ASIATIQUE', 'AIME ASIATIQUE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 0, 'AUTOTECH', 'AUTOTECH', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 0, 'AMIGO CONGO', 'AMIGO CONGO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 0, 'ALY KATELEKO', 'ALY KATELEKO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 0, 'BIG', 'BIG', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 0, 'BONEY', 'BONEY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 0, 'BAYOUSSUF', 'BAYOUSSUF', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 0, 'PAPA STECY', 'PAPA STECY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 0, 'CAMEROUNAIS', 'CAMEROUNAIS', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 0, 'CHRISTINE MUTAMBUKA', 'CHRISTINE MUTAMBUKA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 0, 'CHANTAL', 'CHANTAL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 0, 'DYLAN', 'DYLAN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 0, 'MANA CONGO', 'MANA CONGO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 0, 'MWALIMU ABDOUL', 'MWALIMU ABDOUL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 0, 'MWALIMU JUMA', 'MWALIMU JUMA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 0, 'MAMAN MUSTAFA', 'MAMAN MUSTAFA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 0, 'MAMERT', 'MAMERT', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 0, 'MAMAN BUGARASHI', 'MAMAN BUGARASHI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 0, 'MAMAN RANIA', 'MAMAN RANIA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 0, 'MARCEL LONDRES', 'MARCEL LONDRES', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 0, 'MASOEUR', 'MASOEUR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 0, 'MOSQUE BWIZA', 'MOSQUE BWIZA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 0, 'MAMAN JABIRI', 'MAMAN JABIRI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 0, 'MAMAN ROBERT v', 'MAMAN ROBERT v', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 0, 'MAMAN ROBERT', 'MAMAN ROBERT', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 0, 'MADJIDI', 'MADJIDI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 0, 'MAMAN NUNU LINA', 'MAMAN NUNU LINA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 0, 'MAMAN NUNU MAGASIN', 'MAMAN NUNU MAGASIN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 0, 'MAMAN NUNU SEIF', 'MAMAN NUNU SEIF', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 0, 'NTIRWONZA HASSAN', 'NTIRWONZA HASSAN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 0, 'ODILE', 'ODILE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 0, 'NYENGELA', 'NYENGELA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 0, 'ERGC', 'ERGC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 0, 'EDOUARD REVELIEN', 'EDOUARD REVELIEN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 0, 'EMAN NESRU', 'EMAN NESRU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 0, 'EVRINE', 'EVRINE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 0, 'EVRARD JANVIER', 'EVRARD JANVIER', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 0, 'FAUSTIN', 'FAUSTIN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 0, 'FURAHA', 'FURAHA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 0, 'GTC GASANA', 'GTC GASANA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 0, 'GUY', 'GUY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 0, 'GOSHEN', 'GOSHEN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 0, 'HENRI DUBAI', 'HENRI DUBAI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 0, 'HERI', 'HERI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 0, 'HUSSEIN', 'HUSSEIN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 0, 'INTERPETROLE', 'INTERPETROLE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 0, 'ISAAC', 'ISAAC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 0, 'JOEL NKURUNZIZA', 'JOEL NKURUNZIZA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 0, 'JAMAL DISQUE', 'JAMAL DISQUE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 0, 'JAMAL MUTOKA', 'JAMAL MUTOKA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 0, 'JEANNE', 'JEANNE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 0, 'JIMY REGIDESO', 'JIMY REGIDESO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 0, 'KIDOGE', 'KIDOGE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 0, 'KIDE', 'KIDE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 0, 'LEONCE ELECTRICIEN', 'LEONCE ELECTRICIEN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 0, 'MAMAN NUNU', 'MAMAN NUNU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 0, 'PACIFIQUE MECANICIEN', 'PACIFIQUE MECANICIEN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 0, 'PAPA SHAMIM', 'PAPA SHAMIM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 0, 'MAMAN SHAMIM', 'MAMAN SHAMIM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 0, 'PAPA JENNIFER', 'PAPA JENNIFER', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 0, 'PASTEUR NOUVEAU', 'PASTEUR NOUVEAU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 0, 'PASTA VOISIN', 'PASTA VOISIN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 0, 'PAPA BEBE', 'PAPA BEBE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 0, 'PIERRE MACON', 'PIERRE MACON', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 0, 'PAUL INGENIER', 'PAUL INGENIER', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 0, 'RADJAB', 'RADJAB', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 0, 'SOSO TRANSPORTEUR', 'SOSO TRANSPORTEUR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 0, 'SELEMANI', 'SELEMANI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 0, 'SARAN NTEZE ANTI ROUILLE', 'SARAN NTEZE ANTI ROUILLE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 0, 'SHABANI BELGIQUE + KARIM', 'SHABANI BELGIQUE + KARIM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 0, 'SARAH NTEZE DANGOTE', 'SARAH NTEZE DANGOTE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 0, 'SARAH NTEZE MABATI FEMER', 'SARAH NTEZE MABATI FEMER', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 0, 'SOGEA SATOM', 'SOGEA SATOM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 0, 'SHIME', 'SHIME', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 0, 'SIBOMANA MUY', 'SIBOMANA MUY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 0, 'SEVITEB', 'SEVITEB', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 0, 'SMART SECURITY', 'SMART SECURITY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 0, 'THARCISSE', 'THARCISSE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 0, 'VICTOR SARAH', 'VICTOR SARAH', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 0, 'ZION TEMPLE', 'ZION TEMPLE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 0, 'EXODE', 'EXODE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 0, 'SANA SHOP', 'SANA SHOP', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 0, 'FEMA', 'FEMA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 0, 'PAPA NUNU', 'PAPA NUNU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 0, 'NDAYIZIGIYE MANU OBR', 'NDAYIZIGIYE MANU OBR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 0, 'BOSS MASTIC ISAAC', 'BOSS MASTIC ISAAC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 0, 'FARIS MALIK', 'FARIS MALIK', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 0, 'BAKARI VOISIN', 'BAKARI VOISIN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 0, 'NIMBONA EMMANUEL', 'NIMBONA EMMANUEL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 0, 'SUPER SERVICE GENERAL TRADING', 'SUPER SERVICE GENERAL TRADING', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 0, 'MARIE NOELLE NDAYIZEYE', 'MARIE NOELLE NDAYIZEYE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 0, 'MAMAN NUNU KIBENGA', 'MAMAN NUNU KIBENGA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 0, 'Hadji', 'Hadji', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 0, 'HADJI MATESO', 'HADJI MATESO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 0, 'LINA (SADA)', 'LINA (SADA)', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 0, 'SHADIA BXL', 'SHADIA BXL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 0, 'KAPOSHO MAMAN NUNU', 'KAPOSHO MAMAN NUNU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 0, 'GTS', 'GTS', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 0, 'ECAME', 'ECAME', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 0, 'SYTECORE', 'SYTECORE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 0, 'NIRAGIRA', 'NIRAGIRA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 0, 'ECO', 'ECO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 0, 'HUNAUL', 'HUNAUL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 0, 'SEBER', 'SEBER', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 0, 'COTRAC', 'COTRAC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 0, 'ETS KASAVUBU', 'ETS KASAVUBU', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 0, 'QUINCAILLERIE PRINCE', 'QUINCAILLERIE PRINCE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 0, 'HORISON', 'HORISON', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 0, 'LEONIDAS', 'LEONIDAS', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 0, 'ETACOCO', 'ETACOCO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 0, 'ETRET', 'ETRET', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 0, 'GPSB', 'GPSB', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 0, 'RAD', 'RAD', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 0, 'ECAF', 'ECAF', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 0, 'EXTRACO', 'EXTRACO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 0, 'MALEX', 'MALEX', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 0, 'AFRICAN MINING', 'AFRICAN MINING', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 0, 'FAFCO', 'FAFCO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 0, 'PHILOMENE', 'PHILOMENE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 0, 'NOUVELLE', 'NOUVELLE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 0, 'ECOTRAVE', 'ECOTRAVE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 0, 'BAMACO', 'BAMACO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 0, 'ALPHA  CD', 'ALPHA  CD', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 0, 'ECBROH', 'ECBROH', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 0, 'AMAZI', 'AMAZI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 0, 'AMAZI', 'AMAZI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 0, 'INNOVA', 'INNOVA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 0, 'KCT', 'KCT', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 0, 'MADIDI DESIRE', 'MADIDI DESIRE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 0, 'ALUBUKO', 'ALUBUKO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 0, 'TRUST COMPANY', 'TRUST COMPANY', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 0, 'WOOD ', 'WOOD ', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 0, 'ETRAVE', 'ETRAVE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 0, 'EMAS', 'EMAS', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 0, 'REMEBUCOM', 'REMEBUCOM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 0, 'MUTAMA', 'MUTAMA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 0, 'SETC', 'SETC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 0, 'SOBUPROVA', 'SOBUPROVA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 0, 'BUJA', 'BUJA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 0, 'EMASTC', 'EMASTC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 0, 'SECOM', 'SECOM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 0, 'ANTOINNE', 'ANTOINNE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 0, 'ANTOINNE', 'ANTOINNE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 0, 'IBRAHIM', 'IBRAHIM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 0, 'DIDIER INTERPETROL', 'DIDIER INTERPETROL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 0, 'REMY NKUZIMANA', 'REMY NKUZIMANA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 0, 'NIBITANGA PHILBERT COBEREC', 'NIBITANGA PHILBERT COBEREC', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 0, 'BENIKA', 'BENIKA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 0, 'FLAVIEN', 'FLAVIEN', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 0, 'BEST OUT LOOK H', 'BEST OUT LOOK H', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 0, 'BERCO', 'BERCO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 0, 'MPAWENIMANA SIMON', 'MPAWENIMANA SIMON', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 0, 'EGLISE MARANATHA KAMENGE', 'EGLISE MARANATHA KAMENGE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 0, 'MADRASA GATABO', 'MADRASA GATABO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 0, 'NTAKARUTIMANA CONSOLATE Jean marie soudeur', 'NTAKARUTIMANA CONSOLATE Jean marie soudeur', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 0, 'ABDALLAH', 'ABDALLAH', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 0, 'ELIE ( JANVIER )', 'ELIE ( JANVIER )', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 0, 'MASTID RUMONGE', 'MASTID RUMONGE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 0, 'MOSQUE KAMENGE', 'MOSQUE KAMENGE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 0, 'NZOTUNGA EZECHIEL', 'NZOTUNGA EZECHIEL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 0, 'ENG SELEMANI', 'ENG SELEMANI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 0, 'CASCADE APPART HOTEL', 'CASCADE APPART HOTEL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 0, 'DESIRE DUBAI', 'DESIRE DUBAI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 0, 'ROSIMINA', 'ROSIMINA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 0, 'KIRA Hospital', 'KIRA Hospital', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 0, 'COMMISSAIRE CONGO', 'COMMISSAIRE CONGO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 0, 'CHRISTOPHE', 'CHRISTOPHE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 0, 'DR CONGO', 'DR CONGO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 0, 'HALIFA', 'HALIFA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 0, 'JUVENT', 'JUVENT', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 0, 'JUVENAL', 'JUVENAL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 0, 'KURSUM', 'KURSUM', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 0, 'Maolin Congo', 'Maolin Congo', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 0, 'MELEUSE', 'MELEUSE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 0, 'MANU NESTOR', 'MANU NESTOR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 0, 'MAMAN BASY(HALIMA)', 'MAMAN BASY(HALIMA)', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 0, 'MARIAMU BUGARASHI', 'MARIAMU BUGARASHI', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 0, 'KARIRE PRODUCTS', 'KARIRE PRODUCTS', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 0, 'MAMAN NUNU-JOLIE KAJAGA', 'MAMAN NUNU-JOLIE KAJAGA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 0, 'MINISTRE', 'MINISTRE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 0, 'MOSQUE GAHWEZA', 'MOSQUE GAHWEZA', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 0, 'PAPA BEBE/CHANTIER ASIATIQUE', 'PAPA BEBE/CHANTIER ASIATIQUE', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 0, 'PASTEUR', 'PASTEUR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 0, 'PASTEUR KAYOGORO', 'PASTEUR KAYOGORO', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 0, 'PASCAL', 'PASCAL', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 0, 'POLO INGENIEUR', 'POLO INGENIEUR', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 0, 'VINCENT', 'VINCENT', '', NULL, 0, '2022-05-21 09:45:00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_control_stock_det`
--

CREATE TABLE `pos_control_stock_det` (
  `ID_CONTROL_DET` int(11) NOT NULL,
  `DESIGNATION_CONTROL` varchar(200) NOT NULL,
  `CODEBAR_CONTROL` varchar(200) DEFAULT NULL,
  `CODE_CONT` varchar(200) NOT NULL,
  `ID_CONT` int(11) NOT NULL,
  `QTE_OPENING_CONTROL` float NOT NULL,
  `QTE_TRANSFERT_CONTROL` float NOT NULL,
  `OPEN_TRANS_TOTAL` float NOT NULL,
  `PRIX_ACHAT_CONTROL` float NOT NULL,
  `TOTAL_PRIX_OPENING` float NOT NULL,
  `OPENING_START_CONTROL` date DEFAULT NULL,
  `OPENING_CLOSE_CONTROL` date NOT NULL,
  `SALES_CONTROL` float NOT NULL,
  `TOTAL_SALES_CONTROL` float NOT NULL,
  `RESTE_STOCK_AUTOMATIQUE_CONTROL` float NOT NULL,
  `RESTE_MANUEL_CONTROL` float NOT NULL,
  `TOTAL_VENTE_VENTE_CONTROL` float NOT NULL,
  `CONTROL_CREATE_AT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CONTROL_CREEATE_BY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_depenses`
--

CREATE TABLE `pos_depenses` (
  `ID_DEPENSE` int(11) NOT NULL,
  `NOM_DEPENSE` varchar(230) NOT NULL,
  `MONTANT_DEPENSE` float NOT NULL,
  `DESCRIPTION_DEPENSE` varchar(250) DEFAULT NULL,
  `ID_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `ID_SHIFT` int(11) NOT NULL,
  `STATUT_FLUX` int(11) DEFAULT NULL,
  `MONTANT_REQUISITION` float DEFAULT NULL,
  `MONTANT_APPROVIONNEMENT` float DEFAULT NULL,
  `ID_REQUISITION` int(11) DEFAULT NULL,
  `ID_APPROVISIONNEMENT` int(11) DEFAULT NULL,
  `TYPE_ACTIVITE_CAISSE` int(11) NOT NULL DEFAULT '1',
  `RESTE_SOMMES` float DEFAULT NULL,
  `CREATE_BY_DEPENSE` int(11) NOT NULL,
  `DATE_CREATE_DEPENSE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_DELETE_DEPENSE` datetime DEFAULT NULL,
  `DELETE_STATUS_DEPENSE` int(11) DEFAULT '0',
  `DELETE_COMMENT_DEPENSE` varchar(240) DEFAULT NULL,
  `DELETE_BY_DEPENSE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_flux_caisse`
--

CREATE TABLE `pos_flux_caisse` (
  `ID_FLUX_CAISSE` int(20) NOT NULL,
  `NOM_FLUX_CAISSE` varchar(200) DEFAULT NULL,
  `MONTANT_FLUX_CAISSE` double NOT NULL DEFAULT '0',
  `DESCRIPTION_FLUX` varchar(200) DEFAULT NULL,
  `FLUX_SESSION_ID` int(20) DEFAULT NULL,
  `FLUX_SESSION_CODE` varchar(200) DEFAULT NULL,
  `CATEGORIE_FLUX` int(20) DEFAULT NULL,
  `TYPE_FLUX_CAISSE` int(20) DEFAULT NULL,
  `USER_CREATE_FLUX` int(20) DEFAULT NULL,
  `DATE_CREATION_FLUX` datetime DEFAULT NULL,
  `FLUX_DELETE_STATUS` int(5) NOT NULL DEFAULT '0',
  `FLUX_DELETE_BY` int(20) DEFAULT NULL,
  `FLUX_DATE_DELETE` datetime DEFAULT NULL,
  `DELETED_COMMENT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_articles`
--

CREATE TABLE `pos_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) NOT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `CODEBAR_ARTICLE` varchar(50) NOT NULL,
  `REF_RAYON_ARTICLE` int(11) NOT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) NOT NULL,
  `REF_ID_FAMILLE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) NOT NULL,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) NOT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL,
  `DESCRIPTION_ARTICLE` text NOT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float NOT NULL,
  `DATE_CREATION_ARTICLE` datetime NOT NULL,
  `DATE_MOD_ARTICLE` datetime NOT NULL,
  `CREATED_BY_ARTICLE` int(11) NOT NULL,
  `MODIFIED_BY_ARTICLE` int(11) NOT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL,
  `DELETE_DATE_ARTICLE` datetime NOT NULL,
  `DELETE_BY_ARTICLE` int(11) NOT NULL,
  `DELETE_COMMENT_ARTICLE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_articles_categories`
--

CREATE TABLE `pos_ibi_articles_categories` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) NOT NULL,
  `STORE_ID` int(11) NOT NULL,
  `DESCRIPTION_CATEGORIE` text NOT NULL,
  `PARENT_REF_ID_CATEGORIE` int(11) NOT NULL,
  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
  `DATE_MOD_CATEGORIE` datetime NOT NULL,
  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
  `MODIFIED_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
  `DELETE_DATE_CATEGORIE` datetime NOT NULL,
  `DELETE_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_COMMENT_CATEGORIE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_articles_categories`
--

INSERT INTO `pos_ibi_articles_categories` (`ID_CATEGORIE`, `NOM_CATEGORIE`, `STORE_ID`, `DESCRIPTION_CATEGORIE`, `PARENT_REF_ID_CATEGORIE`, `DATE_CREATION_CATEGORIE`, `DATE_MOD_CATEGORIE`, `CREATED_BY_CATEGORIE`, `MODIFIED_BY_CATEGORIE`, `DELETE_STATUS_CATEGORIE`, `DELETE_DATE_CATEGORIE`, `DELETE_BY_CATEGORIE`, `DELETE_COMMENT_CATEGORIE`) VALUES
(1, 'TUBE', 1, '', 0, '2022-05-18 15:44:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(2, 'PROFILE', 1, '', 0, '2022-05-18 15:45:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(3, 'FER', 1, '', 0, '2022-05-18 15:45:21', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(4, 'TOLE', 1, '', 0, '2022-05-18 15:45:32', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(5, 'TUYAUX', 1, '', 0, '2022-05-18 15:45:43', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(6, 'FER A BETON', 1, '', 0, '2022-05-18 15:45:53', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(7, 'ETRIER', 1, '', 0, '2022-05-18 15:46:02', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(8, 'SAC', 1, '', 0, '2022-05-18 15:46:11', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(9, 'FIL A LIGATURER', 1, '', 0, '2022-05-18 15:46:19', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(10, 'FIL', 1, '', 0, '2022-05-18 15:46:27', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(11, 'CLOUS', 1, '', 0, '2022-05-18 15:46:37', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(12, 'TREILLIS', 1, '', 0, '2022-05-18 15:46:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(13, 'ACCESSOIRE', 1, '', 0, '2022-05-18 15:46:58', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(14, 'BOUFFER', 1, '', 0, '2022-05-18 15:47:18', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(15, 'BOUFFER 1', 1, '', 0, '2022-05-18 15:47:26', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(16, 'BOUFFER 2', 1, '', 0, '2022-05-18 15:47:36', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(17, 'BOUFFER 3', 1, '', 0, '2022-05-18 15:47:45', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(18, 'TUBE', 2, '', 0, '2022-05-19 12:40:23', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(19, 'TUBE', 2, '', 0, '2022-05-19 12:41:08', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_articles_details`
--

CREATE TABLE `pos_ibi_articles_details` (
  `ID_ARTICLE_DETAIL` int(11) NOT NULL,
  `ARTICLE_ID` mediumint(9) NOT NULL,
  `INGREDIENT_ID` int(11) NOT NULL,
  `CODEBAR_ARTICLE_INGREDIENT` varchar(50) DEFAULT NULL,
  `INGREDIENT_QUANTITY` varchar(255) NOT NULL,
  `PRIX_DACHAT_ARTICLE_DETAIL` varchar(50) NOT NULL,
  `PRIX_DE_VENTE_ARTICLE` varchar(50) NOT NULL,
  `DATE_CREATION_ARTICLE` datetime NOT NULL,
  `DATE_MOD_ARTICLE` datetime NOT NULL,
  `CREATED_BY_ARTICLE` int(11) NOT NULL,
  `MODIFIED_BY_ARTICLE` int(11) NOT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL,
  `DELETE_DATE_ARTICLE` datetime NOT NULL,
  `DELETE_BY_ARTICLE` int(11) NOT NULL,
  `DELETE_COMMENT_ARTICLE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_article_requisition`
--

CREATE TABLE `pos_ibi_article_requisition` (
  `ID_INGREDIENT_REQ` int(11) NOT NULL,
  `NOM_INGREDIENT_REQ` varchar(255) NOT NULL,
  `QT_INGREDIENT_REQ` varchar(200) NOT NULL,
  `QT_RETOUR_INGREDIENT_REQ` int(11) NOT NULL,
  `QT_INGREDIENT_APPROVISIONNER` float DEFAULT NULL,
  `UNIT_INGREDIENT` varchar(200) DEFAULT NULL,
  `PRIX_INGREDIENT_REQ` float DEFAULT NULL,
  `TOTAL_INGREDIENT_REQ` varchar(240) NOT NULL,
  `CODEBAR_INGREDIENT_REQ` varchar(100) NOT NULL,
  `APROUVED_BY_PROD_REQ` int(11) NOT NULL,
  `APROUVED_BY_STORE` int(11) NOT NULL,
  `APROUVED_RETOUR_INGREDIENT_BY` int(11) NOT NULL,
  `ID_REQ` int(11) NOT NULL,
  `FROM_STORES` int(11) DEFAULT NULL,
  `DELETED_COMMENT_REQ` varchar(240) DEFAULT NULL,
  `DELETE_DATE_REQ` datetime DEFAULT NULL,
  `DELETED_BY_REQ` int(11) DEFAULT NULL,
  `STATUS_NOTIFY_INGREDIENT` int(2) NOT NULL,
  `STATUS_PROD_REQ` int(11) NOT NULL COMMENT '0-attente, 1-enCours,2-confirmer, 3-autoriser, 4-rejeter,5-supprimer',
  `DELETE_STATUS_PROD_REQ` int(11) NOT NULL,
  `TYPES` int(11) NOT NULL,
  `DELETE_STATUS_REQ` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_article_requisition_trans`
--

CREATE TABLE `pos_ibi_article_requisition_trans` (
  `ID_ARTICLE_REQ` int(11) NOT NULL,
  `NOM_ARTICLE_REQ` varchar(255) NOT NULL,
  `QT_ARTICLE_REQ` int(11) NOT NULL,
  `QT_RETOUR_ARTICLE_REQ` int(11) NOT NULL,
  `PRIX_ARTICLE_REQ` double NOT NULL,
  `TOTAL_ARTICLE_REQ` double NOT NULL,
  `CODEBAR_ARTICLE_REQ` varchar(100) NOT NULL,
  `APROUVED_BY_PROD_REQ` int(11) NOT NULL,
  `APROUVED_BY_STORE` int(11) NOT NULL,
  `APROUVED_RETOUR_ARTICLE_BY` int(11) NOT NULL,
  `ID_REQ` int(11) NOT NULL,
  `STATUS_NOTIFY_ARTICLE` int(2) NOT NULL,
  `STATUS_PROD_REQ` int(11) NOT NULL COMMENT '0-attente, 1-aprver, 2-rejeter',
  `DELETE_STATUS_PROD_REQ` int(11) NOT NULL,
  `TYPES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_article_requisition_trans`
--

INSERT INTO `pos_ibi_article_requisition_trans` (`ID_ARTICLE_REQ`, `NOM_ARTICLE_REQ`, `QT_ARTICLE_REQ`, `QT_RETOUR_ARTICLE_REQ`, `PRIX_ARTICLE_REQ`, `TOTAL_ARTICLE_REQ`, `CODEBAR_ARTICLE_REQ`, `APROUVED_BY_PROD_REQ`, `APROUVED_BY_STORE`, `APROUVED_RETOUR_ARTICLE_BY`, `ID_REQ`, `STATUS_NOTIFY_ARTICLE`, `STATUS_PROD_REQ`, `DELETE_STATUS_PROD_REQ`, `TYPES`) VALUES
(1, 'FAB 4 LISSE', 53, 2, 5000, 265000, '0002-000306', 1, 0, 1, 2, 0, 1, 0, 0),
(2, 'FAB 4 LISSE', 2, 0, 5000, 5000, '0002-000306', 1, 0, 0, 3, 0, 1, 0, 0),
(3, 'CIMENT DANGOTE', 125, 0, 0, 0, '01RD00230', 1, 0, 0, 4, 0, 1, 0, 0),
(4, 'BOITE ENCASTREMENT', 265, 0, 500, 132500, '0002-000309', 1, 0, 0, 5, 0, 1, 0, 0),
(6, 'CHEVILLE  NO 8', 4059, 0, 0, 0, '01RD00129', 0, 0, 0, 1, 0, 0, 0, 0),
(8, 'CHEVILLE  NO 8', 4059, 0, 0, 0, '01RD00129', 0, 0, 0, 1, 0, 0, 0, 0),
(9, 'CHEVILLE  NO 8', 4059, 0, 0, 0, '01RD00129', 0, 0, 0, 1, 0, 0, 0, 0),
(10, 'CHEVILLE  NO 8', 4059, 0, 0, 0, '01RD00129', 1, 0, 0, 8, 0, 1, 0, 0),
(11, 'CHEVILLE N0 10', 38, 0, 0, 0, '01RD00237', 1, 0, 0, 9, 0, 1, 0, 0),
(12, 'DISQUE A COUPER', 637, 0, 0, 0, '01RD00136', 1, 0, 0, 10, 0, 1, 0, 0),
(13, 'DISQUE A MELLER ORGINAL', 4248, 0, 0, 0, '01RD00212', 1, 0, 0, 11, 0, 1, 0, 0),
(14, 'PIGMANT', 130, 0, 0, 0, '01RD00228', 1, 0, 0, 12, 0, 1, 0, 0),
(16, 'PIOCHE 2.5', 152, 0, 0, 0, '01RD00162', 1, 0, 0, 14, 0, 1, 0, 0),
(17, 'ROBINET DU COEUR', 24, 0, 0, 0, '0002-000311', 0, 0, 0, 1, 0, 0, 0, 0),
(18, 'TUY D\'ARROSAGE', 4, 0, 0, 0, '0002-000313', 1, 0, 0, 15, 0, 1, 0, 0),
(19, 'BROSSE ISHWAGARA', 30, 0, 0, 0, '0002-000312', 1, 0, 0, 15, 0, 1, 0, 0),
(20, 'ROULETTE PETIT MODEL', 1339, 0, 0, 0, '01RD00181', 1, 0, 0, 16, 0, 1, 0, 0),
(21, 'ROULETTE GRAND MODEL', 531, 0, 0, 0, '01RD00180', 1, 0, 0, 17, 0, 1, 0, 0),
(22, 'FAB 4 LISSE', 53, 0, 4000, 212000, '0002-000314', 1, 0, 0, 18, 0, 1, 0, 0),
(23, 'PAPIER MELER EN METRE NO 60', 12, 0, 0, 0, '01RD00159', 1, 0, 0, 19, 0, 1, 0, 0),
(24, 'TOLE STD 6mm', 2, 0, 0, 0, '01RD00063', 1, 0, 0, 20, 0, 1, 0, 0),
(25, 'TOLE  2mm', 8, 0, 0, 0, '01RD00056', 1, 0, 0, 20, 0, 1, 0, 0),
(26, 'TOLE STD  4mm', 12, 0, 0, 0, '01RD00061', 1, 0, 0, 20, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_commandes`
--

CREATE TABLE `pos_ibi_commandes` (
  `ID_POS_IBI_COMMANDES` int(11) NOT NULL,
  `STORE_ID_COMMADES` int(11) DEFAULT NULL,
  `TABLE_ID` int(11) NOT NULL DEFAULT '1',
  `COMMANDE_STATUS` int(11) DEFAULT '0' COMMENT '0-attente, 2-Payer,1-Avance,11-Complementaire,10-credit ',
  `CODE` varchar(250) DEFAULT NULL,
  `CODE_FACTURE` text,
  `STATUS_OBR` text,
  `COMMISSION_STATUS` int(11) DEFAULT '0' COMMENT '0:Normale;1:Commissionner',
  `REDUCTION_COMMANDE` float NOT NULL DEFAULT '0',
  `PRINT_COUNT` tinyint(4) DEFAULT '0',
  `CLIENT_ID_COMMANDE` int(11) DEFAULT NULL,
  `TYPE_COMMANDE` int(11) DEFAULT '0' COMMENT '0:Normale;1:Client',
  `SYNC_OBR` int(11) DEFAULT '0' COMMENT '0:Oui;1:Non',
  `MONTANT_PAYE` double DEFAULT NULL,
  `MONTANT_DU` double DEFAULT NULL,
  `DATE_CREATION_POS_IBI_COMMANDES` datetime DEFAULT CURRENT_TIMESTAMP,
  `DATE_PAIEMENT_COMMANDE` datetime DEFAULT NULL,
  `DATE_MOD_POS_IBI_COMMANDES` datetime DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_POS_IBI_COMMANDES` int(20) DEFAULT NULL,
  `MODIFIED_BY_POS_IBI_COMMANDES` int(20) DEFAULT NULL,
  `DELETED_DATE_POS_IBI_COMMANDES` datetime DEFAULT NULL,
  `DELETED_STATUS_POS_IBI_COMMANDES` int(2) DEFAULT '0',
  `DELETED_USER_POS_IBI_COMMANDES` int(20) DEFAULT NULL,
  `DELETED_COMMENT_POS_IBI_COMMANDES` varchar(300) DEFAULT NULL,
  `FROM_CLOUD` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_commandes`
--

INSERT INTO `pos_ibi_commandes` (`ID_POS_IBI_COMMANDES`, `STORE_ID_COMMADES`, `TABLE_ID`, `COMMANDE_STATUS`, `CODE`, `CODE_FACTURE`, `STATUS_OBR`, `COMMISSION_STATUS`, `REDUCTION_COMMANDE`, `PRINT_COUNT`, `CLIENT_ID_COMMANDE`, `TYPE_COMMANDE`, `SYNC_OBR`, `MONTANT_PAYE`, `MONTANT_DU`, `DATE_CREATION_POS_IBI_COMMANDES`, `DATE_PAIEMENT_COMMANDE`, `DATE_MOD_POS_IBI_COMMANDES`, `CREATED_BY_POS_IBI_COMMANDES`, `MODIFIED_BY_POS_IBI_COMMANDES`, `DELETED_DATE_POS_IBI_COMMANDES`, `DELETED_STATUS_POS_IBI_COMMANDES`, `DELETED_USER_POS_IBI_COMMANDES`, `DELETED_COMMENT_POS_IBI_COMMANDES`, `FROM_CLOUD`) VALUES
(8, NULL, 1, 0, 'V0099', '2', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-21 10:57:49', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(9, NULL, 1, 0, 'V00100', '3', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-21 11:13:37', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(10, NULL, 1, 0, 'V00101', '4', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-21 11:16:08', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(14, NULL, 1, 0, 'V002', '2', NULL, 0, 0, 0, 29, 1, 0, NULL, NULL, '2022-05-21 12:25:27', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(18, NULL, 1, 2, 'V001', '1', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 10:19:15', '2022-05-23 10:19:43', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(19, NULL, 1, 0, 'V0019', '2', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 12:14:11', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 1, NULL, NULL, 0),
(20, NULL, 1, 0, 'V0020', '3', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 13:21:30', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(21, NULL, 1, 0, 'V0021', '4', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 14:01:04', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(22, NULL, 1, 0, 'V0022', '5', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 14:05:27', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(23, NULL, 1, 0, 'V0023', '6', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:09:09', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(24, NULL, 1, 0, 'V0024', '7', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:12:45', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(25, NULL, 1, 0, 'V0025', '8', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:18:31', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(26, NULL, 1, 0, 'V0026', '9', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:29:59', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(27, NULL, 1, 0, 'V0027', '10', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:35:42', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(28, NULL, 1, 0, 'V0028', '11', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 15:41:18', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(29, NULL, 1, 0, 'V0029', '12', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-23 16:08:58', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(30, NULL, 1, 0, 'V0030', '13', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 08:35:20', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(31, NULL, 1, 0, 'V0031', '14', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 08:37:54', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(32, NULL, 1, 0, 'V0032', '15', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:16:16', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(33, NULL, 1, 0, 'V0033', '16', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:21:53', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(34, NULL, 1, 0, 'V0034', '17', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:34:31', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(35, NULL, 1, 0, 'V0035', '18', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:37:20', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(36, NULL, 1, 0, 'V0036', '19', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:42:31', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(37, NULL, 1, 0, 'V0037', '20', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:56:02', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(38, NULL, 1, 0, 'V0038', '21', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 09:57:20', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(39, NULL, 1, 0, 'V0039', '22', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 10:02:08', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(40, NULL, 1, 0, 'V0040', '23', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 10:04:18', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(41, NULL, 1, 0, 'V0041', '24', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 10:14:41', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(42, NULL, 1, 0, 'V0042', '25', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 11:53:58', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(43, NULL, 1, 0, 'V0043', '26', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 12:10:55', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(44, NULL, 1, 0, 'V0044', '27', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 12:35:49', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(45, NULL, 1, 0, 'V0045', '28', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 12:45:22', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(46, NULL, 1, 0, 'V0046', '29', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 13:38:51', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(47, NULL, 1, 0, 'V0047', '30', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 14:17:12', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(48, NULL, 1, 0, 'V0048', '31', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 15:40:10', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(49, NULL, 1, 0, 'V0049', '32', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 15:49:10', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(50, NULL, 1, 0, 'V0050', '33', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 15:51:22', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(51, NULL, 1, 0, 'V0051', '34', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 15:52:05', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(52, NULL, 1, 0, 'V0052', '35', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-24 16:12:13', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(53, NULL, 1, 0, 'V0053', '36', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 07:54:51', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(54, NULL, 1, 0, 'V0054', '37', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 07:57:29', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(55, NULL, 1, 0, 'V0055', '38', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 07:58:15', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(56, NULL, 1, 0, 'V0056', '39', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 07:58:44', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(57, NULL, 1, 0, 'V0057', '40', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 08:31:06', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(58, NULL, 1, 0, 'V0058', '41', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 08:39:27', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(59, NULL, 1, 0, 'V0059', '42', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 08:44:25', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0),
(60, NULL, 1, 0, 'V0060', '43', NULL, 0, 0, 0, 12, 0, 0, NULL, NULL, '2022-05-25 11:27:29', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 1, NULL, NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_commandes_produits`
--

CREATE TABLE `pos_ibi_commandes_produits` (
  `ID_POS_IBI_COMMANDES_PRODUITS` int(35) NOT NULL,
  `POS_IBI_COMMANDES_ID` int(11) NOT NULL,
  `REF_PRODUCT_CODEBAR` varchar(250) NOT NULL,
  `REF_COMMAND_CODE` varchar(250) NOT NULL,
  `QUANTITE` float NOT NULL DEFAULT '0',
  `PRIX_NORMAL` float NOT NULL DEFAULT '0',
  `PRIX_CLIENT` float NOT NULL DEFAULT '0',
  `PRIX_VENDU` float NOT NULL DEFAULT '0',
  `DISCOUNT_PERCENT` float NOT NULL DEFAULT '0',
  `TVA` float NOT NULL DEFAULT '0',
  `NAME_PRODUIT` varchar(200) NOT NULL,
  `DATE_COMMANDE_PRODUITS` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_CREATION_POS_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_MOD_POS_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_POS_IBI_COMMANDES_PRODUITS` int(20) NOT NULL,
  `MODIFIED_BY_POS_IBI_COMMANDES_PRODUITS` int(20) DEFAULT NULL,
  `DELETED_DATE_POS_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_POS_IBI_COMMANDES_PRODUITS` int(2) NOT NULL DEFAULT '0' COMMENT '0 ou 1',
  `DELETED_USER_POS_IBI_COMMANDES_PRODUITS` int(20) DEFAULT NULL,
  `DELETED_COMMENT_POS_IBI_COMMANDES_PRODUITS` varchar(300) DEFAULT NULL,
  `STORE_ID_POS_IBI_COMMANDES_PRODUITS` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_commandes_produits`
--

INSERT INTO `pos_ibi_commandes_produits` (`ID_POS_IBI_COMMANDES_PRODUITS`, `POS_IBI_COMMANDES_ID`, `REF_PRODUCT_CODEBAR`, `REF_COMMAND_CODE`, `QUANTITE`, `PRIX_NORMAL`, `PRIX_CLIENT`, `PRIX_VENDU`, `DISCOUNT_PERCENT`, `TVA`, `NAME_PRODUIT`, `DATE_COMMANDE_PRODUITS`, `DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`, `DATE_MOD_POS_IBI_COMMANDES_PRODUITS`, `CREATED_BY_POS_IBI_COMMANDES_PRODUITS`, `MODIFIED_BY_POS_IBI_COMMANDES_PRODUITS`, `DELETED_DATE_POS_IBI_COMMANDES_PRODUITS`, `DELETED_STATUS_POS_IBI_COMMANDES_PRODUITS`, `DELETED_USER_POS_IBI_COMMANDES_PRODUITS`, `DELETED_COMMENT_POS_IBI_COMMANDES_PRODUITS`, `STORE_ID_POS_IBI_COMMANDES_PRODUITS`) VALUES
(8, 99, '01RD00095', 'V0099', 1, 1800, 0, 1800, 0, 0, 'ETRIERS  X 15 X 35', '2022-05-21 04:17:51', '2022-05-21 10:57:49', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(9, 100, '01RD00095', 'V00100', 1, 1800, 0, 1800, 0, 0, 'ETRIERS  X 15 X 35', '2022-05-21 04:17:51', '2022-05-21 11:13:37', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(10, 101, '01RD00095', 'V00101', 6, 1800, 0, 1800, 0, 0, 'ETRIERS  X 15 X 35', '2022-05-21 04:17:51', '2022-05-21 11:17:35', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(14, 2, '01RD00193', 'V002', 1, 105000, 0, 105000, 0, 0, 'CORNIERE 50 x 6mm', '2022-05-21 05:25:53', '2022-05-21 12:25:27', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(19, 1, '01RD00093', 'V001', 10, 37000, 0, 37000, 0, 0, 'FAB 10 LISSE', '2022-05-23 04:52:24', '2022-05-23 10:19:15', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(20, 1, '01RD00086', 'V001', 4, 21000, 0, 20000, 0, 0, 'FAB 8', '2022-05-23 04:52:24', '2022-05-23 10:19:15', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(21, 19, '01RD00117', 'V0019', 1, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-23 05:16:32', '2022-05-23 12:14:11', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(22, 19, '01RD00121', 'V0019', 2, 0, 0, 0, 0, 0, 'BOITE DE DERRIVATION', '2022-05-23 05:16:32', '2022-05-23 12:14:11', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 1, NULL, NULL, 1),
(23, 20, '01RD00230', 'V0020', 7, 38000, 0, 36000, 0, 0, 'CIMENT DANGOTE', '2022-05-24 03:25:19', '2022-05-23 13:21:30', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(24, 20, '01RD00120', 'V0020', 1, 18000, 0, 18000, 0, 0, 'BACHE  HEMA', '2022-05-24 03:25:19', '2022-05-23 13:21:30', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(25, 20, '01RD00117', 'V0020', 4, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 03:25:19', '2022-05-23 13:21:30', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(26, 21, '01RD00230', 'V0021', 10, 38000, 0, 36000, 0, 0, 'CIMENT DANGOTE', '2022-05-24 03:25:19', '2022-05-23 14:01:04', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(27, 22, '01RD00087', 'V0022', 10, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 03:25:19', '2022-05-23 14:05:27', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(28, 22, '01RD00086', 'V0022', 4, 21000, 0, 20000, 0, 0, 'FAB 8', '2022-05-24 03:25:19', '2022-05-23 14:05:27', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(29, 23, '01RD00290', 'V0023', 19, 66000, 0, 68000, 0, 0, 'TUBE 60x40x1mm 1er Q', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(30, 23, '01RD00002', 'V0023', 14, 16000, 0, 27000, 0, 0, 'TUBE 20x20 X 1mm 2eme Q', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(31, 23, '01RD00081', 'V0023', 16, 30000, 0, 45000, 0, 0, 'TUYAUX MOBILIER 40 X 1mm', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(32, 23, '01RD00079', 'V0023', 60, 17000, 0, 28000, 0, 0, 'TUYAUX MOBILIER 25 X 1 mm', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(33, 23, '0002-000295', 'V0023', 5, 14000, 0, 17000, 0, 0, 'TUBE 16X16  2e Q', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 2),
(34, 23, '01RD00014', 'V0023', 4, 35000, 0, 45000, 0, 0, 'TUBE 40X20 X 1 mm', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(35, 23, '01RD00028', 'V0023', 6, 40000, 0, 50000, 0, 0, 'TUBE CORNIERE', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(36, 23, '01RD00146', 'V0023', 5, 65000, 0, 68000, 0, 0, 'MASTIC  DU FERT', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(37, 23, '01RD00136', 'V0023', 14, 6000, 0, 7000, 0, 0, 'DISQUE A COUPER', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(38, 23, '01RD00117', 'V0023', 4, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 03:25:19', '2022-05-23 15:09:09', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(39, 24, '01RD00087', 'V0024', 7, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 03:25:19', '2022-05-23 15:12:45', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(40, 25, '01RD00093', 'V0025', 10, 37000, 0, 37000, 0, 0, 'FAB 10 LISSE', '2022-05-24 03:25:19', '2022-05-23 15:18:31', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(41, 25, '01RD00092', 'V0025', 5, 22000, 0, 21000, 0, 0, 'FAB 8 LISSE', '2022-05-24 03:25:19', '2022-05-23 15:18:31', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(42, 25, '01RD00091', 'V0025', 4, 12000, 0, 12000, 0, 0, 'FAB 6 LISSE', '2022-05-24 03:25:19', '2022-05-23 15:18:31', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(43, 26, '01RD00088', 'V0026', 50, 62000, 0, 47000, 0, 0, 'FAB 12', '2022-05-24 03:25:19', '2022-05-23 15:29:59', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(44, 26, '01RD00087', 'V0026', 100, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 03:25:19', '2022-05-23 15:29:59', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(45, 27, '01RD00229', 'V0027', 5, 9000, 0, 9000, 0, 0, 'ROOFING', '2022-05-24 03:25:19', '2022-05-23 15:35:42', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(46, 28, '01RD00088', 'V0028', 50, 62000, 0, 47000, 0, 0, 'FAB 12', '2022-05-24 03:25:19', '2022-05-23 15:41:18', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(47, 28, '01RD00087', 'V0028', 80, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 03:25:19', '2022-05-23 15:41:18', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(48, 29, '01RD00290', 'V0029', 10, 66000, 0, 66000, 0, 0, 'TUBE 60x40x1mm 1er Q', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(49, 29, '01RD00005', 'V0029', 10, 26000, 0, 35000, 0, 0, 'TUBE 30X30 X 1mm 2eme Q', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(50, 29, '01RD00002', 'V0029', 10, 16000, 0, 17000, 0, 0, 'TUBE 20x20 X 1mm 2eme Q', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(51, 29, '01RD00044', 'V0029', 2, 135000, 0, 150000, 0, 0, 'CORNIERE 50 X 4mm', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(52, 29, '01RD00055', 'V0029', 5, 150000, 0, 150000, 0, 0, 'TOLE 1.5mm', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(53, 29, '01RD00180', 'V0029', 3, 2500, 0, 3000, 0, 0, 'ROULETTE GRAND MODEL', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(54, 29, '01RD00181', 'V0029', 2, 1000, 0, 2500, 0, 0, 'ROULETTE PETIT MODEL', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(55, 29, '01RD00146', 'V0029', 1, 65000, 0, 65000, 0, 0, 'MASTIC  DU FERT', '2022-05-24 03:25:19', '2022-05-23 16:08:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(56, 30, '01RD00120', 'V0030', 2, 18000, 0, 180000, 0, 0, 'BACHE  HEMA', '2022-05-24 03:25:19', '2022-05-24 08:35:20', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(57, 31, '01RD00271', 'V0031', 6, 2500, 0, 2700, 0, 0, 'BALAI', '2022-05-24 03:25:19', '2022-05-24 08:37:54', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(58, 32, '01RD00034', 'V0032', 1, 62000, 0, 62000, 0, 0, 'PROFILE C 150X 1mm', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(59, 32, '01RD00030', 'V0032', 4, 62000, 0, 70000, 0, 0, 'PROFILE HS14 X 1mm', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(60, 32, '01RD00040', 'V0032', 4, 36000, 0, 55000, 0, 0, 'CORNIERE 30 X 3mm', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(61, 32, '01RD00048', 'V0032', 1, 8000, 0, 8000, 0, 0, 'FER  PLAT 16 X 3mm', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(62, 32, '01RD00036', 'V0032', 2, 25000, 0, 33000, 0, 0, 'FER   TEE 20 X 3mm', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(63, 32, '01RD00136', 'V0032', 2, 6000, 0, 6000, 0, 0, 'DISQUE A COUPER', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(64, 32, '01RD00094', 'V0032', 1, 58000, 0, 48000, 0, 0, 'FAB 12 LISSE', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(65, 32, '01RD00230', 'V0032', 20, 38000, 0, 36000, 0, 0, 'CIMENT DANGOTE', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(66, 32, '01RD00109', 'V0032', 1, 5000, 0, 5000, 0, 0, 'CLOUS de 10', '2022-05-24 03:25:19', '2022-05-24 09:16:16', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(67, 33, '01RD00086', 'V0033', 2, 21000, 0, 20000, 0, 0, 'FAB 8', '2022-05-24 03:25:19', '2022-05-24 09:21:53', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(68, 34, '01RD00042', 'V0034', 4, 65000, 0, 85000, 0, 0, 'CORNIERE 40 X 4mm', '2022-05-24 03:25:19', '2022-05-24 09:34:31', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(69, 35, '01RD00082', 'V0035', 2, 40000, 0, 55000, 0, 0, 'TUYAUX MOBILIER 50 X 1mm', '2022-05-24 03:25:19', '2022-05-24 09:37:20', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(70, 35, '01RD00117', 'V0035', 1, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 03:25:19', '2022-05-24 09:37:20', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(71, 35, '01RD00136', 'V0035', 1, 6000, 0, 6000, 0, 0, 'DISQUE A COUPER', '2022-05-24 03:25:19', '2022-05-24 09:37:20', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(72, 36, '01RD00089', 'V0036', 300, 51000, 0, 75000, 0, 0, 'FAB 14', '2022-05-24 03:25:19', '2022-05-24 09:42:31', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(73, 37, '01RD00086', 'V0037', 35, 21000, 0, 20000, 0, 0, 'FAB 8', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(74, 37, '01RD00098', 'V0037', 500, 800, 0, 800, 0, 0, 'ETRIERS  15 x 15', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(75, 37, '01RD00087', 'V0037', 6, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(76, 37, '01RD00097', 'V0037', 40, 1200, 0, 1200, 0, 0, 'ETRIERS 15 x 25', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(77, 37, '01RD00109', 'V0037', 6, 5000, 0, 5000, 0, 0, 'CLOUS de 10', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(78, 37, '01RD00107', 'V0037', 5, 4500, 0, 5000, 0, 0, 'CLOUS de 6', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(79, 37, '01RD00141', 'V0037', 1, 5000, 0, 10000, 0, 0, 'HOUE', '2022-05-24 03:25:19', '2022-05-24 09:56:02', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(80, 38, '01RD00066', 'V0038', 5, 50000, 0, 50000, 0, 0, 'TUYAUX Galvanise 1/2', '2022-05-24 03:25:19', '2022-05-24 09:57:20', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(81, 39, '01RD00120', 'V0039', 20, 18000, 0, 18000, 0, 0, 'BACHE  HEMA', '2022-05-24 03:25:19', '2022-05-24 10:02:08', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(82, 40, '01RD00230', 'V0040', 80, 38000, 0, 36000, 0, 0, 'CIMENT DANGOTE', '2022-05-24 03:25:19', '2022-05-24 10:04:18', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(83, 41, '01RD00028', 'V0041', 2, 40000, 0, 46000, 0, 0, 'TUBE CORNIERE', '2022-05-24 03:25:19', '2022-05-24 10:14:41', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(84, 41, '01RD00027', 'V0041', 1, 37000, 0, 56000, 0, 0, 'TUBE T', '2022-05-24 03:25:19', '2022-05-24 10:14:41', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(85, 42, '01RD00087', 'V0042', 4, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(86, 42, '01RD00109', 'V0042', 3, 5000, 0, 5000, 0, 0, 'CLOUS de 10', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(87, 42, '01RD00107', 'V0042', 2, 4500, 0, 5000, 0, 0, 'CLOUS de 6', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(88, 42, '01RD00136', 'V0042', 2, 6000, 0, 6000, 0, 0, 'DISQUE A COUPER', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(89, 42, '01RD00117', 'V0042', 1, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(90, 42, '01RD00120', 'V0042', 1, 18000, 0, 25000, 0, 0, 'BACHE  HEMA', '2022-05-24 04:55:44', '2022-05-24 11:53:58', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(91, 43, '01RD00005', 'V0043', 15, 26000, 0, 27000, 0, 0, 'TUBE 30X30 X 1mm 2eme Q', '2022-05-24 07:20:21', '2022-05-24 12:10:55', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(92, 44, '01RD00117', 'V0044', 1, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 07:20:21', '2022-05-24 12:35:49', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(93, 44, '01RD00136', 'V0044', 1, 6000, 0, 6000, 0, 0, 'DISQUE A COUPER', '2022-05-24 07:20:21', '2022-05-24 12:35:49', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(94, 45, '01RD00117', 'V0045', 3, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-24 07:20:21', '2022-05-24 12:45:22', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(95, 45, '01RD00049', 'V0045', 2, 9000, 0, 9000, 0, 0, 'FER   PLAT 20 X 3mm', '2022-05-24 07:20:21', '2022-05-24 12:45:22', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(96, 46, '01RD00086', 'V0046', 28, 21000, 0, 19500, 0, 0, 'FAB 8', '2022-05-24 07:20:21', '2022-05-24 13:38:51', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(97, 47, '01RD00028', 'V0047', 20, 40000, 0, 46000, 0, 0, 'TUBE CORNIERE', '2022-05-24 07:20:21', '2022-05-24 14:17:12', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(98, 48, '01RD00087', 'V0048', 10, 41000, 0, 37000, 0, 0, 'FAB 10', '2022-05-24 09:03:10', '2022-05-24 15:40:10', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(99, 48, '01RD00086', 'V0048', 4, 21000, 0, 20000, 0, 0, 'FAB 8', '2022-05-24 09:03:10', '2022-05-24 15:40:10', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(100, 49, '01RD00198', 'V0049', 1, 30000, 0, 30000, 0, 0, 'ANTIROUILLE 4 LITRES', '2022-05-24 09:03:10', '2022-05-24 15:49:10', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(101, 50, '01RD00198', 'V0050', 4, 30000, 0, 30000, 0, 0, 'ANTIROUILLE 4 LITRES', '2022-05-24 09:03:10', '2022-05-24 15:51:22', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(102, 51, '01RD00136', 'V0051', 50, 6000, 0, 7080, 0, 0, 'DISQUE A COUPER', '2022-05-24 09:03:10', '2022-05-24 15:52:05', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(103, 52, '01RD00061', 'V0052', 12, 550000, 0, 600000, 0, 0, 'TOLE STD  4mm', '2022-05-25 04:35:07', '2022-05-24 16:12:13', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(104, 52, '01RD00056', 'V0052', 8, 170000, 0, 205000, 0, 0, 'TOLE  2mm', '2022-05-25 04:35:07', '2022-05-24 16:12:13', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(105, 52, '01RD00063', 'V0052', 2, 850000, 0, 850000, 0, 0, 'TOLE STD 6mm', '2022-05-25 04:35:07', '2022-05-24 16:12:13', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(106, 53, '01RD00057', 'V0053', 6, 125000, 0, 200000, 0, 0, 'TOLE STD 1.2mm', '2022-05-25 04:35:07', '2022-05-25 07:54:51', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(107, 54, '01RD00275', 'V0054', 1, 250, 0, 2500, 0, 0, 'RACLETTE', '2022-05-25 04:35:07', '2022-05-25 07:57:29', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(108, 55, '01RD00271', 'V0055', 2, 2500, 0, 2700, 0, 0, 'BALAI', '2022-05-25 04:35:07', '2022-05-25 07:58:15', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(109, 56, '01RD00275', 'V0056', 1, 250, 0, 2500, 0, 0, 'RACLETTE', '2022-05-25 04:35:07', '2022-05-25 07:58:44', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(110, 57, '01RD00079', 'V0057', 20, 17000, 0, 25000, 0, 0, 'TUYAUX MOBILIER 25 X 1 mm', '2022-05-25 04:35:07', '2022-05-25 08:31:06', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(111, 57, '01RD00117', 'V0057', 1, 12000, 0, 14000, 0, 0, 'BAGUETTE  2.5', '2022-05-25 04:35:07', '2022-05-25 08:31:06', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(112, 57, '01RD00136', 'V0057', 1, 6000, 0, 6000, 0, 0, 'DISQUE A COUPER', '2022-05-25 04:35:07', '2022-05-25 08:31:07', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(113, 58, '01RD00230', 'V0058', 50, 38000, 0, 36000, 0, 0, 'CIMENT DANGOTE', '2022-05-25 04:35:07', '2022-05-25 08:39:27', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(114, 59, '01RD00182', 'V0059', 4, 120000, 0, 120000, 0, 0, 'SERRURE COMPLET', '2022-05-25 04:35:07', '2022-05-25 08:44:25', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(115, 59, '01RD00178', 'V0059', 4, 4000, 0, 3500, 0, 0, 'ROULEAU A PEINTRE  GRAND MODEL', '2022-05-25 04:35:07', '2022-05-25 08:44:25', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(116, 59, '01RD00179', 'V0059', 2, 2500, 0, 2500, 0, 0, 'ROULEAU A PEINTRE PETIT MODEL', '2022-05-25 04:35:07', '2022-05-25 08:44:25', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(117, 59, '01RD00127', 'V0059', 3, 2000, 0, 3500, 0, 0, 'BROSS  SIMPLE N0 3', '2022-05-25 04:35:07', '2022-05-25 08:44:25', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1),
(118, 60, '01RD00042', 'V0060', 4, 65000, 0, 85000, 0, 0, 'CORNIERE 40 X 4mm', '2022-05-25 04:35:07', '2022-05-25 11:27:29', '2000-01-01 00:00:00', 1, NULL, '2000-01-01 00:00:00', 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_commande_location`
--

CREATE TABLE `pos_ibi_commande_location` (
  `ID_COMMANDE_LOCATION` int(11) NOT NULL,
  `DESIGNATION` varchar(100) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DELETE_STATUS` int(11) NOT NULL DEFAULT '0',
  `DELETE_USER` int(11) DEFAULT NULL,
  `DELETE_DATE` datetime DEFAULT NULL,
  `DELETE_COMMENT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_cpondere_settings`
--

CREATE TABLE `pos_ibi_cpondere_settings` (
  `ID_COUT_POND` int(11) NOT NULL,
  `NAME_COUT_POND` varchar(50) NOT NULL,
  `VALUE_COUT_POND` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_fournisseurs`
--

CREATE TABLE `pos_ibi_fournisseurs` (
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `NOM_FOURNISSEUR` varchar(50) NOT NULL,
  `BP_FOURNISSEUR` varchar(50) NOT NULL,
  `TEL_FOURNISSEUR` varchar(50) NOT NULL,
  `EMAIL_FOURNISSEUR` varchar(50) NOT NULL,
  `DESCRIPTION_FOURNISSEUR` text NOT NULL,
  `TVA_FOURNISSEUR` int(11) DEFAULT '0',
  `DATE_CREATION_FOURNISSEUR` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_MOD_FOURNISSEUR` datetime NOT NULL,
  `CREATED_BY_FOURNISSEUR` int(11) NOT NULL,
  `MODIFIED_BY_FOURNISSEUR` int(11) NOT NULL,
  `DELETE_STATUS_FOURNISSEUR` int(11) NOT NULL DEFAULT '0',
  `DELETE_DATE_FOURNISSEUR` datetime NOT NULL,
  `DELETE_BY_FOURNISSEUR` int(11) NOT NULL,
  `DELETE_COMMENT_FOURNISSEUR` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_fournisseurs`
--

INSERT INTO `pos_ibi_fournisseurs` (`ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `BP_FOURNISSEUR`, `TEL_FOURNISSEUR`, `EMAIL_FOURNISSEUR`, `DESCRIPTION_FOURNISSEUR`, `TVA_FOURNISSEUR`, `DATE_CREATION_FOURNISSEUR`, `DATE_MOD_FOURNISSEUR`, `CREATED_BY_FOURNISSEUR`, `MODIFIED_BY_FOURNISSEUR`, `DELETE_STATUS_FOURNISSEUR`, `DELETE_DATE_FOURNISSEUR`, `DELETE_BY_FOURNISSEUR`, `DELETE_COMMENT_FOURNISSEUR`) VALUES
(1, 'DOSHI', '-', '-', '-', '', 0, '2022-05-19 07:08:22', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(2, 'DANGOTE TANZANIE', '-', '-', '-', '', 0, '2022-05-19 07:12:36', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(3, 'DANGOTE TANZANIE', '-', '-', '-', '', 0, '2022-05-19 07:12:45', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 15:13:36', 1, 'OUI'),
(4, 'KUBACH AND SAMBROOK  METALS', '-', '+442089516500', 'info@kubach.co.uk', '', 0, '2022-05-20 02:10:56', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(5, 'KUBACH AND SAMBROOK  METALS', '-', '+442089516500', 'info@kubach.co.uk', '', 0, '2022-05-20 02:11:02', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-20 10:12:15', 1, 'oui');

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_ingredients`
--

CREATE TABLE `pos_ibi_ingredients` (
  `ID_INGREDIENT` int(11) NOT NULL,
  `DESIGN_INGREDIENT` varchar(200) NOT NULL,
  `CODEBAR_INGREDIENT` varchar(50) NOT NULL,
  `QUANTITY_INGREDIENT` float DEFAULT NULL,
  `PRIX_DACHAT_INGREDIENT` float DEFAULT NULL,
  `UNITE_INGREDIENT` varchar(50) NOT NULL,
  `ETAT_INGREDIENT` varchar(200) NOT NULL,
  `DESCRIPTION_INGREDIENT` text,
  `STORES` int(11) NOT NULL,
  `MINIMUM_QUANTITY_INGREDIENT` float NOT NULL,
  `DATE_CREATION_INGREDIENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DATE_MOD_INGREDIENT` datetime NOT NULL,
  `CREATED_BY_INGREDIENT` int(11) NOT NULL,
  `MODIFIED_BY_INGREDIENT` int(11) NOT NULL,
  `APPROVISIONNER_INGREDIENT_BY` varchar(222) DEFAULT NULL,
  `DELETE_STATUS_INGREDIENT` int(11) NOT NULL,
  `DELETE_DATE_INGREDIENT` datetime NOT NULL,
  `DELETE_BY_INGREDIENT` int(11) NOT NULL,
  `DELETE_COMMENT_INGREDIENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_marge`
--

CREATE TABLE `pos_ibi_marge` (
  `ID_MARGE` int(11) NOT NULL,
  `INTER_X_MARGE` decimal(10,0) NOT NULL,
  `INTER_Y_MARGE` decimal(10,0) NOT NULL,
  `POURCENTAGE_MARGE` decimal(10,0) NOT NULL,
  `DATE_CREATION_MARGE` datetime NOT NULL,
  `DATE_MOD_MARGE` datetime NOT NULL,
  `CREATED_BY_MARGE` int(11) NOT NULL,
  `MODIFIED_BY_MARGE` int(11) NOT NULL,
  `DELETE_STATUS_MARGE` int(11) NOT NULL,
  `DELETE_DATE_MARGE` datetime NOT NULL,
  `DELETE_BY_MARGE` int(11) NOT NULL,
  `DELETE_COMMENT_MARGE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_payement_fournisseur`
--

CREATE TABLE `pos_ibi_payement_fournisseur` (
  `ID_PF` int(11) NOT NULL,
  `APPROVISIONNEMENT_REF` int(11) NOT NULL,
  `MONTANT_PF` double NOT NULL,
  `PAYER_PF` double NOT NULL,
  `RESTE_PF` double NOT NULL,
  `FOURNISSEUR_ID` int(11) NOT NULL,
  `DATE_CREATION_PF` date NOT NULL,
  `TYPE_PAYEMENT_PF` int(11) NOT NULL COMMENT '1credit, 2cash',
  `REFERENCE_PF` varchar(200) DEFAULT NULL,
  `DELETE_STATUS_PF` int(11) NOT NULL,
  `CREATED_BY_PF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_requisition`
--

CREATE TABLE `pos_ibi_requisition` (
  `ID_REQ` int(11) NOT NULL,
  `CODE_REQ` varchar(250) NOT NULL,
  `DESTINATION_STORE_REQ` int(11) NOT NULL,
  `FROM_STORE` int(11) NOT NULL,
  `PATIENT` varchar(11) NOT NULL,
  `TITLE_REQ` varchar(255) NOT NULL,
  `DESCRIPTION_REQ` varchar(255) NOT NULL,
  `TOTAL_REQISITIONNER` float DEFAULT NULL,
  `STATUS_REQ` int(11) NOT NULL COMMENT '0-attente, 1-enCours, 2-confirmer,3-autoriser, 4-rejeter,5-supprimer',
  `APROUVED_BY_REQ` int(11) NOT NULL,
  `TYPE_REQ` varchar(255) NOT NULL,
  `STATUS_NOTIFY_REQ` int(2) NOT NULL,
  `AUTHOR_REQ` varchar(255) NOT NULL,
  `DATE_CREATION_REQ` datetime NOT NULL,
  `DATE_MOD_REQ` datetime NOT NULL,
  `CREATED_BY_REQ` int(11) NOT NULL,
  `MODIFIED_BY_REQ` int(11) NOT NULL,
  `DELETE_STATUS_REQ` int(11) NOT NULL,
  `DELETE_DATE_REQ` datetime NOT NULL,
  `DELETED_BY_REQ` int(11) NOT NULL,
  `DELETED_COMMENTS_REQ` varchar(255) NOT NULL,
  `DATE_APROUVED_REQ` datetime NOT NULL,
  `AUTORIZED_BY_PROD_REQ` int(20) NOT NULL,
  `DATE_AUTORISED_PROD_REQ` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_requisition_trans`
--

CREATE TABLE `pos_ibi_requisition_trans` (
  `ID_REQ` int(11) NOT NULL,
  `CODE_REQ` varchar(250) NOT NULL,
  `DESTINATION_STORE_REQ` int(11) NOT NULL,
  `FROM_STORE` int(11) NOT NULL,
  `PATIENT` varchar(11) NOT NULL,
  `TITLE_REQ` varchar(255) DEFAULT NULL,
  `DESCRIPTION_REQ` varchar(255) NOT NULL,
  `STATUS_REQ` int(11) NOT NULL,
  `APROUVED_BY_REQ` int(11) NOT NULL,
  `TYPE_REQ` varchar(255) DEFAULT NULL,
  `STATUS_NOTIFY_REQ` int(2) NOT NULL,
  `AUTHOR_REQ` varchar(255) NOT NULL,
  `DATE_CREATION_REQ` datetime NOT NULL,
  `DATE_MOD_REQ` datetime NOT NULL,
  `CREATED_BY_REQ` int(11) NOT NULL,
  `MODIFIED_BY_REQ` int(11) NOT NULL,
  `DELETE_STATUS_REQ` int(11) NOT NULL,
  `DELETE_DATE_REQ` datetime NOT NULL,
  `DELETED_BY_REQ` int(11) NOT NULL,
  `DELETED_COMMENTS_REQ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_requisition_trans`
--

INSERT INTO `pos_ibi_requisition_trans` (`ID_REQ`, `CODE_REQ`, `DESTINATION_STORE_REQ`, `FROM_STORE`, `PATIENT`, `TITLE_REQ`, `DESCRIPTION_REQ`, `STATUS_REQ`, `APROUVED_BY_REQ`, `TYPE_REQ`, `STATUS_NOTIFY_REQ`, `AUTHOR_REQ`, `DATE_CREATION_REQ`, `DATE_MOD_REQ`, `CREATED_BY_REQ`, `MODIFIED_BY_REQ`, `DELETE_STATUS_REQ`, `DELETE_DATE_REQ`, `DELETED_BY_REQ`, `DELETED_COMMENTS_REQ`) VALUES
(1, 'REQ00001/05/2022', 2, 1, '', '', '', 0, 0, '4', 1, '1', '2022-05-20 16:00:29', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-21 14:24:51', 1, 'OUI'),
(2, 'REQ00002/05/2022', 2, 1, '', '21/05/2022', '', 1, 1, '4', 1, '1', '2022-05-21 13:07:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(3, 'REQ00003/05/2022', 2, 1, '', '21/05/2022', '', 1, 1, '4', 1, '1', '2022-05-21 15:11:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(4, 'REQ00004/05/2022', 2, 1, '', '23/05/2022', '', 1, 1, '4', 1, '1', '2022-05-23 13:23:23', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(5, 'REQ00005/05/2022', 2, 1, '', '23/05/2022', '', 1, 1, '4', 1, '1', '2022-05-23 13:58:11', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(6, 'REQ00006/05/2022', 2, 1, '', 'AJOUTE', '', 0, 0, '4', 0, '1', '2022-05-23 14:05:55', '2022-05-23 14:06:34', 1, 1, 1, '2022-05-23 14:08:46', 1, 'U'),
(7, 'REQ00007/05/2022', 2, 1, '', 'AJOUTE', '', 0, 0, '4', 1, '1', '2022-05-23 14:09:45', '2022-05-23 14:11:19', 1, 1, 1, '2022-05-23 14:15:53', 1, 'O'),
(8, 'REQ00008/05/2022', 2, 1, '', 'AJOUT', '', 1, 1, '4', 1, '1', '2022-05-23 14:16:39', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(9, 'REQ00009/05/2022', 2, 1, '', 'AJOUT', '', 1, 1, '4', 1, '1', '2022-05-23 14:24:30', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(10, 'REQ00010/05/2022', 2, 1, '', 'AJOUT', '', 1, 1, '4', 1, '1', '2022-05-23 14:33:45', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(11, 'REQ00011/05/2022', 2, 1, '', 'TRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 14:40:33', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(12, 'REQ00012/05/2022', 2, 1, '', 'FRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 14:47:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(13, 'REQ00013/05/2022', 2, 1, '', '', '', 1, 1, '4', 1, '1', '2022-05-23 14:54:26', '2022-05-23 15:47:42', 1, 1, 0, '0000-00-00 00:00:00', 0, ''),
(14, 'REQ00014/05/2022', 2, 1, '', 'TRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 14:55:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(15, 'REQ00015/05/2022', 2, 1, '', '', '', 1, 1, '4', 1, '1', '2022-05-23 16:34:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(16, 'REQ00016/05/2022', 2, 1, '', 'TRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 16:35:34', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(17, 'REQ00017/05/2022', 2, 1, '', 'FRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 16:36:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(18, 'REQ00018/05/2022', 2, 1, '', 'TRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 16:45:18', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(19, 'REQ00019/05/2022', 2, 1, '', 'TRANSFERT', '', 1, 1, '4', 1, '1', '2022-05-23 17:14:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(20, 'REQ00020/05/2022', 2, 1, '', '', '', 1, 1, '4', 1, '1', '2022-05-24 16:55:24', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_societe`
--

CREATE TABLE `pos_ibi_societe` (
  `ID_SOCIETE` int(11) NOT NULL,
  `NOM_SOCIETE` varchar(120) NOT NULL,
  `ADRESSE_SOCIETE` varchar(200) DEFAULT NULL,
  `DATE_CREATE_SOCIETE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATE_BY_SOCIETE` int(11) NOT NULL,
  `DELETE_STATUS_SOCIETE` int(11) NOT NULL DEFAULT '0',
  `DELETE_DATE_SOCIETE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_ibi_societe`
--

INSERT INTO `pos_ibi_societe` (`ID_SOCIETE`, `NOM_SOCIETE`, `ADRESSE_SOCIETE`, `DATE_CREATE_SOCIETE`, `CREATE_BY_SOCIETE`, `DELETE_STATUS_SOCIETE`, `DELETE_DATE_SOCIETE`) VALUES
(1, 'Ds _ ds', 'Kinindo', '2021-05-25 08:06:48', 1, 0, NULL),
(2, 'H_S.A.E', 'Kibenga', '2021-05-25 08:07:49', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_stores`
--

CREATE TABLE `pos_ibi_stores` (
  `ID_STORE` int(11) NOT NULL,
  `STATUS_STORE` varchar(50) NOT NULL,
  `IS_POS` smallint(6) NOT NULL DEFAULT '1',
  `NAME_STORE` varchar(50) NOT NULL,
  `IMAGE_STORE` varchar(200) NOT NULL,
  `DESCRIPTION_STORE` text NOT NULL,
  `DATE_CREATION_STORE` datetime NOT NULL,
  `DATE_MOD_STORE` datetime NOT NULL,
  `CREATED_BY_STORE` int(11) NOT NULL,
  `MODIFIED_BY_STORE` int(11) NOT NULL,
  `DELETE_STATUS_STORE` int(11) NOT NULL DEFAULT '0',
  `DELETE_DATE_STORE` datetime NOT NULL,
  `DELETE_BY_STORE` int(11) NOT NULL,
  `DELETE_COMMENT_STORE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_stores`
--

INSERT INTO `pos_ibi_stores` (`ID_STORE`, `STATUS_STORE`, `IS_POS`, `NAME_STORE`, `IMAGE_STORE`, `DESCRIPTION_STORE`, `DATE_CREATION_STORE`, `DATE_MOD_STORE`, `CREATED_BY_STORE`, `MODIFIED_BY_STORE`, `DELETE_STATUS_STORE`, `DELETE_DATE_STORE`, `DELETE_BY_STORE`, `DELETE_COMMENT_STORE`) VALUES
(1, 'opened', 1, 'ASIATIQUE MAGASIN ', '', '', '2021-03-09 11:06:55', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(2, 'opened', 0, 'INDUSTRIEL STOCK', '', '', '2021-03-19 16:59:03', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_ibi_type_ajustement`
--

CREATE TABLE `pos_ibi_type_ajustement` (
  `AJUSTEMENT_ID` int(20) NOT NULL,
  `AJUSTEMENT_NAME` varchar(200) NOT NULL,
  `DESCRIPTION_AJUSTEMENT` varchar(250) NOT NULL,
  `DATE_CREATION_AJUSTEMENT` datetime NOT NULL,
  `CREATE_BY_AJUSTEMENT` int(20) NOT NULL,
  `DELETED_STATUS` int(5) NOT NULL DEFAULT '0',
  `DELETED_DATE` datetime NOT NULL,
  `DELETED_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_ibi_type_ajustement`
--

INSERT INTO `pos_ibi_type_ajustement` (`AJUSTEMENT_ID`, `AJUSTEMENT_NAME`, `DESCRIPTION_AJUSTEMENT`, `DATE_CREATION_AJUSTEMENT`, `CREATE_BY_AJUSTEMENT`, `DELETED_STATUS`, `DELETED_DATE`, `DELETED_USER`) VALUES
(1, 'Perte', '', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Suppression', '', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Sortie', '', '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0),
(4, 'Defectueux', '', '2021-06-04 09:53:43', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_paiements`
--

CREATE TABLE `pos_paiements` (
  `ID_PAIEMENT` int(11) NOT NULL,
  `PAIEMENT_SESSION_CODE` varchar(200) DEFAULT NULL,
  `COMMANDE_ID` int(11) NOT NULL,
  `MONTANT_PAIEMENT` float NOT NULL,
  `MODE_PAIEMENT` int(11) DEFAULT '0',
  `AVANCE` int(11) NOT NULL DEFAULT '0',
  `RABAIS` float NOT NULL DEFAULT '0',
  `TYPE_FACTURE` int(11) NOT NULL,
  `SHIFT_ID` int(11) NOT NULL DEFAULT '0',
  `ID_SESSION` int(10) NOT NULL,
  `CLIENT_ID_PAIEMENT` int(11) DEFAULT NULL,
  `DATE_CREATION_PAIEMENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CREATED_BY_PAIEMENT` int(11) NOT NULL,
  `DELETED_STATUS_PAIEMENT` int(11) NOT NULL DEFAULT '0',
  `DELETED_COMMENT_PAIEMENT` varchar(200) DEFAULT NULL,
  `STATUT_ANNULATION` double NOT NULL DEFAULT '0',
  `DATE_CREATION_COMMANDE` datetime DEFAULT NULL,
  `COMMANDE_CODE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_paiements`
--

INSERT INTO `pos_paiements` (`ID_PAIEMENT`, `PAIEMENT_SESSION_CODE`, `COMMANDE_ID`, `MONTANT_PAIEMENT`, `MODE_PAIEMENT`, `AVANCE`, `RABAIS`, `TYPE_FACTURE`, `SHIFT_ID`, `ID_SESSION`, `CLIENT_ID_PAIEMENT`, `DATE_CREATION_PAIEMENT`, `CREATED_BY_PAIEMENT`, `DELETED_STATUS_PAIEMENT`, `DELETED_COMMENT_PAIEMENT`, `STATUT_ANNULATION`, `DATE_CREATION_COMMANDE`, `COMMANDE_CODE`) VALUES
(10259, NULL, 52, 1, 1, 0, 0, 3, 0, 2, 1, '2022-05-12 12:15:11', 2, 0, NULL, 0, '2022-05-06 16:10:30', 'V007'),
(10260, NULL, 51, 2500, 1, 0, 0, 3, 0, 2, 1, '2022-05-12 12:15:24', 2, 0, NULL, 0, '2022-05-06 16:07:53', 'V006'),
(10261, NULL, 50, 18000, 1, 0, 0, 3, 0, 2, 1, '2022-05-12 12:15:29', 2, 0, NULL, 0, '2022-05-06 16:06:57', 'V005'),
(10262, '2022-05-23 09:35:56038407', 1, 450000, 1, 0, 0, 3, 0, 0, 1, '2022-05-23 16:19:43', 1, 0, NULL, 0, '2022-05-23 10:19:15', 'V001');

-- --------------------------------------------------------

--
-- Table structure for table `pos_session`
--

CREATE TABLE `pos_session` (
  `ID_SESSION` bigint(20) UNSIGNED NOT NULL,
  `FLUX_SESSION_CODE` varchar(200) DEFAULT NULL,
  `SESSION_START` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SESSION_END` datetime DEFAULT NULL,
  `SESSION_STATUS` int(11) DEFAULT '0',
  `SESSION_CREATED_BY` int(11) NOT NULL,
  `FROM_CLOUD` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_session`
--

INSERT INTO `pos_session` (`ID_SESSION`, `FLUX_SESSION_CODE`, `SESSION_START`, `SESSION_END`, `SESSION_STATUS`, `SESSION_CREATED_BY`, `FROM_CLOUD`) VALUES
(1, '2022-05-23 09:35:56038407', '2022-05-23 09:35:56', NULL, 0, 1, 1),
(2, '2022-05-23 08:30:13511323', '2022-05-23 08:30:13', NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_arrivages`
--

CREATE TABLE `pos_store_1_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `CODE_ARRIVAGE` varchar(200) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `MONTANT_PAYER_FOURNISSEUR` double DEFAULT NULL,
  `STATUS_ARRIVAGE` int(5) NOT NULL DEFAULT '0',
  `TYPE_ARRIVAGE` varchar(20) DEFAULT NULL,
  `TYPE_APPROVISIONNEMENT` varchar(100) NOT NULL,
  `ID_REQUISITION` int(11) DEFAULT NULL,
  `REF_PROVIDERS_ARRIVAGE` int(11) DEFAULT NULL,
  `DATE_CREATION_ARRIVAGE` datetime DEFAULT NULL,
  `DATE_MOD_ARRIVAGE` datetime DEFAULT NULL,
  `CREATED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARRIVAGE` int(11) DEFAULT '0',
  `DELETE_DATE_ARRIVAGE` datetime DEFAULT NULL,
  `DELETE_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARRIVAGE` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_articles`
--

CREATE TABLE `pos_store_1_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `REF_ID_FAMILLE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT '0',
  `PRIX_DACHAT_ARTICLE` float DEFAULT NULL,
  `PRIX_DE_REVIENS_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `RIX_VENTE_CLIENT_ARTICLE` int(10) DEFAULT '0',
  `PRIX_DE_VENTE_VIP_ARTICLE` decimal(10,0) NOT NULL DEFAULT '0',
  `TAILLE_ARTICLE` varchar(200) DEFAULT NULL,
  `POIDS_ARTICLE` varchar(200) DEFAULT NULL,
  `COULEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `HAUTEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `LARGEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `APERCU_ARTICLE` varchar(200) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) DEFAULT NULL,
  `NOMBRE_UNITAIRE` int(11) NOT NULL DEFAULT '0',
  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT '0',
  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(200) DEFAULT NULL,
  `TRANSFORMER_BY` int(11) DEFAULT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` float DEFAULT '0',
  `STATUT_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) DEFAULT '0',
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT '0',
  `SEUIL_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `MARQUE` varchar(250) DEFAULT NULL,
  `REF_SOUS_CATEGORIE_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `TAUX_DE_MARGE_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_VENTE_CLIENT_ARTICLE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_1_ibi_articles`
--

INSERT INTO `pos_store_1_ibi_articles` (`ID_ARTICLE`, `DESIGN_ARTICLE`, `TYPE_ARTICLE`, `NATURE_ARTICLE`, `CODEBAR_ARTICLE`, `REF_RAYON_ARTICLE`, `REF_CATEGORIE_ARTICLE`, `REF_ID_FAMILLE_ARTICLE`, `QUANTITY_ARTICLE`, `PRIX_DACHAT_ARTICLE`, `PRIX_DE_REVIENS_ARTICLE`, `PRIX_DE_VENTE_ARTICLE`, `RIX_VENTE_CLIENT_ARTICLE`, `PRIX_DE_VENTE_VIP_ARTICLE`, `TAILLE_ARTICLE`, `POIDS_ARTICLE`, `COULEUR_ARTICLE`, `HAUTEUR_ARTICLE`, `LARGEUR_ARTICLE`, `APERCU_ARTICLE`, `UNITE_ARTICLE`, `PRIX_PROMOTIONEL_ARTICLE`, `QTE_DECOUPAGE_ARTICLE`, `MARGE_ARTICLE`, `SPECIAL_PRICE_START_DATE_ARTICLE`, `SPECIAL_PRICE_END_DATE_ARTICLE`, `DESCRIPTION_ARTICLE`, `MINIMUM_QUANTITY_ARTICLE`, `ETAT_INGREDIENT_ARTICLE`, `NOMBRE_UNITAIRE`, `TYPE_INGREDIENT`, `NOMBRE_INGREDIENT_TRANSFORMER`, `TRANSFORMER_BY`, `APPROVISIONNER_ARTICLE_BY`, `ETAT_TVA`, `STATUT_ARTICLE`, `DATE_CREATION_ARTICLE`, `DATE_MOD_ARTICLE`, `CREATED_BY_ARTICLE`, `MODIFIED_BY_ARTICLE`, `DELETE_STATUS_ARTICLE`, `DELETE_DATE_ARTICLE`, `DELETE_BY_ARTICLE`, `DELETE_COMMENT_ARTICLE`, `STORE_ID_ARTICLE`, `IS_INGREDIENT`, `SEUIL_ARTICLE`, `MARQUE`, `REF_SOUS_CATEGORIE_ARTICLE`, `TAUX_DE_MARGE_ARTICLE`, `PRIX_VENTE_CLIENT_ARTICLE`) VALUES
(1, 'TUBE 16 x16  1er Q', 0, 0, '01RD00001', NULL, 18, 0, 313, 15000, NULL, 17000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(2, 'TUBE 20x20 X 1mm 2eme Q', 0, 0, '01RD00002', NULL, 6, NULL, 235, 0, NULL, 16000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(3, 'Tubes 25x25', 0, NULL, '01RD00003', NULL, 1, NULL, 159, NULL, NULL, 35000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(5, 'TUBE 30X30 X 1mm 2eme Q', 0, 0, '01RD00005', NULL, 1, NULL, 455, 0, NULL, 26000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(6, 'TUBE 40x40 x1mm 2eme Q', 0, 0, '01RD00006', NULL, 1, NULL, 319, 0, NULL, 34000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(7, 'TUBE 40X40 X 1.2mm', 0, NULL, '01RD00007', NULL, 1, NULL, 135, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(8, 'TUBE 40x40 X 1.5mm', 0, NULL, '01RD00008', NULL, 1, NULL, 141, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(9, 'TUBE 40x40 X 2MM', 0, NULL, '01RD00009', NULL, 1, NULL, 18, NULL, NULL, 110000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(10, 'TUBE 60 x 40 X 1mm 2eme Q', 0, NULL, '01RD00010', NULL, 1, NULL, 65, NULL, NULL, 43000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(11, 'TUBE 60X40 X 1.2mm', 0, 0, '01RD00011', NULL, 1, NULL, 186, 0, NULL, 75000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(12, 'TUBE 60x40 X 1.5MM', 0, NULL, '01RD00012', NULL, 1, NULL, 128, NULL, NULL, 107000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(13, 'TUBE 60x40 X 2mm', 0, 0, '01RD00013', NULL, 1, NULL, 65, 0, NULL, 120000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(14, 'TUBE 40X20 X 1 mm', 0, 0, '01RD00014', NULL, 1, NULL, 246, 0, NULL, 40000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(15, 'TUBE 40X25 X 1mm', 0, 0, '01RD00015', NULL, 1, NULL, 62, 30000, NULL, 35000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(16, 'TUBE 50X25 X 1mm', 0, 0, '01RD00016', NULL, 1, NULL, 107, 0, NULL, 40000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(17, 'TUBE 50X50 X 1.5mm', 0, NULL, '01RD00017', NULL, 1, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(18, 'TUBE 50X50 X 2mm', 0, NULL, '01RD00018', NULL, 1, NULL, 44, NULL, NULL, 136000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(19, 'TUBE 80X40 X 1.5mm', 0, NULL, '01RD00019', NULL, 1, NULL, 0, NULL, NULL, 100000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(20, 'TUBE 80 x 40 X 2mm', 0, NULL, '01RD00020', NULL, 1, NULL, 30, NULL, NULL, 120000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(21, 'TUBE 60x60 X 1.5', 0, NULL, '01RD00021', NULL, 1, NULL, 0, NULL, NULL, 90000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(22, 'TUBE 60x60 X 2mm', 0, NULL, '01RD00022', NULL, 1, NULL, 57, NULL, NULL, 115000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(23, 'TUBE 75X50 X 2mm', 0, 0, '01RD00023', NULL, 1, NULL, 38, 0, NULL, 150000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(24, 'TUBE 75X75 X 2mm', 0, NULL, '01RD00024', NULL, 1, NULL, 36, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(25, 'TUBE 100X50 X 2mm', 0, NULL, '01RD00025', NULL, 1, NULL, 0, NULL, NULL, 200000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(26, 'TUBE 100X100 X 3mm', 0, NULL, '01RD00026', NULL, 1, NULL, 42, NULL, NULL, 325000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(27, 'TUBE T', 0, 0, '01RD00027', NULL, 1, NULL, 268, 0, NULL, 37000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(28, 'TUBE CORNIERE', 0, 0, '01RD00028', NULL, 1, NULL, 162, 0, NULL, 40000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(29, 'PROFILE HS15 X 1mm', 0, NULL, '01RD00029', NULL, 2, NULL, 0, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(30, 'PROFILE HS14 X 1mm', 0, 0, '01RD00030', NULL, 2, NULL, 114, 0, NULL, 62000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(31, 'PROFILE OMEGA HS 15 X 1mm', 0, 0, '01RD00031', NULL, 2, NULL, 27, 0, NULL, 50000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(32, 'PROFILE OMEGA HS 14 X 1mm', 0, NULL, '01RD00032', NULL, 2, NULL, 112, NULL, NULL, 47000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(33, 'PROFILE DEMI HS X 1mm', 0, NULL, '01RD00033', NULL, 2, NULL, 0, NULL, NULL, 47000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(34, 'PROFILE C 150X 1mm', 0, 0, '01RD00034', NULL, 2, NULL, 81, 0, NULL, 62000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(35, 'PROFILE BOUTEILLE X 1mm', 0, NULL, '01RD00035', NULL, 2, NULL, 102, NULL, NULL, 52000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(36, 'FER   TEE 20 X 3mm', 0, NULL, '01RD00036', NULL, 3, NULL, 82, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(37, 'FER   TEE 25 X 3mm', 0, NULL, '01RD00037', NULL, 3, NULL, 0, NULL, NULL, 35000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(38, 'CORNIERE 20 X 3mm', 0, NULL, '01RD00038', NULL, 3, NULL, 186, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(39, 'CORNIERE 25 X 3mm', 0, NULL, '01RD00039', NULL, 3, NULL, 302, NULL, NULL, 31000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(40, 'CORNIERE 30 X 3mm', 0, 0, '01RD00040', NULL, 3, NULL, 90, 0, NULL, 36000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(41, 'CORNIERE 40 X 3mm', 0, NULL, '01RD00041', NULL, 3, NULL, 149, NULL, NULL, 50000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(42, 'CORNIERE 40 X 4mm', 0, NULL, '01RD00042', NULL, 3, NULL, 193, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(43, 'FER   CORNIERE 50 X 3mm', 0, NULL, '01RD00043', NULL, 3, NULL, 64, NULL, NULL, 90000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(44, 'CORNIERE 50 X 4mm', 0, NULL, '01RD00044', NULL, 3, NULL, 21, NULL, NULL, 135000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(45, 'CORNIERE 65 X 6mm', 0, NULL, '01RD00045', NULL, 3, NULL, 0, NULL, NULL, 186000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(46, 'CORNIERE 75 X 6mm', 0, NULL, '01RD00046', NULL, 3, NULL, 43, NULL, NULL, 250000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(47, 'CORNIERE 100 X100 X 6mm', 0, NULL, '01RD00047', NULL, 3, NULL, 0, NULL, NULL, 280000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(48, 'FER  PLAT 16 X 3mm', 0, 0, '01RD00048', NULL, 3, NULL, 162, 0, NULL, 8000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(49, 'FER   PLAT 20 X 3mm', 0, 0, '01RD00049', NULL, 3, NULL, 33, 0, NULL, 9000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(50, 'FER   PLAT 25 X 3mm', 0, 0, '01RD00050', NULL, 3, NULL, 412, 0, NULL, 13000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(51, 'FER   PLAT 30 X 3mm', 0, 0, '01RD00051', NULL, 3, NULL, 145, 0, NULL, 22000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(52, 'FER   PLAT 40 X 3mm', 0, NULL, '01RD00052', NULL, 3, NULL, 178, NULL, NULL, 24000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(53, 'TOLE  1mm', 0, NULL, '01RD00053', NULL, 4, NULL, 0, NULL, NULL, 70000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(54, 'TOLE 1.2mm', 0, NULL, '01RD00054', NULL, 4, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(55, 'TOLE 1.5mm', 0, NULL, '01RD00055', NULL, 4, NULL, 30, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(56, 'TOLE  2mm', 0, NULL, '01RD00056', NULL, 4, NULL, 34, NULL, NULL, 170000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(57, 'TOLE STD 1.2mm', 0, NULL, '01RD00057', NULL, 4, NULL, 29, NULL, NULL, 125000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(58, 'TOLE STD 1.5mm', 0, NULL, '01RD00058', NULL, 4, NULL, 40, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(59, 'TOLE STD 2mm', 0, NULL, '01RD00059', NULL, 4, NULL, 29, NULL, NULL, 400000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(60, 'TOLE STD 3mm', 0, NULL, '01RD00060', NULL, 4, NULL, 0, NULL, NULL, 450000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(61, 'TOLE STD  4mm', 0, NULL, '01RD00061', NULL, 4, NULL, 0, NULL, NULL, 550000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(62, 'TOLE STD 5mm', 0, NULL, '01RD00062', NULL, 4, NULL, 0, NULL, NULL, 750000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(63, 'TOLE STD 6mm', 0, NULL, '01RD00063', NULL, 4, NULL, 0, NULL, NULL, 850000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(64, 'TOLE BG 28 NOIR', 0, NULL, '01RD00064', NULL, 4, NULL, 0, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(65, 'TOLE BG 32', 0, NULL, '01RD00065', NULL, 8, NULL, 0, NULL, NULL, 27000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(66, 'TUYAUX Galvanise 1/2', 0, NULL, '01RD00066', NULL, 5, NULL, 17, NULL, NULL, 50000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(67, 'TUYAUX Galvanise 1', 0, 0, '01RD00067', NULL, 5, NULL, 187, 0, NULL, 90000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(68, 'TUYAUX Galvanise 1   1/4', 0, 0, '01RD00068', NULL, 5, NULL, 34, 0, NULL, 120000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(69, 'TUYAUX Galvanise 1   1/2', 0, 0, '01RD00069', NULL, 5, NULL, 27, 0, NULL, 240000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(70, 'TUYAUX Galvanise 2', 0, NULL, '01RD00070', NULL, 5, NULL, 8, NULL, NULL, 260000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(71, 'TUYAUX Galvanise 2  1/2', 0, NULL, '01RD00071', NULL, 5, NULL, 1, NULL, NULL, 205000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(72, 'TUYAUX Galvanise 3', 0, NULL, '01RD00072', NULL, 5, NULL, 3, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(73, 'TUYAUX Galvanise 3/4', 0, 0, '01RD00073', NULL, 5, NULL, 64, 0, NULL, 60000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(74, 'TUYAUX Galvanise 4', 0, NULL, '01RD00074', NULL, 5, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(75, 'TUYAUX MOBILIER 16 X 1.2mm', 0, NULL, '01RD00075', NULL, 5, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(76, 'TUYAUX Mobilier 20 X 1mm 2eme Q', 0, NULL, '01RD00076', NULL, 5, NULL, 0, NULL, NULL, 13500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(78, 'TUYAUX MOBILIER 22 X 1mm', 0, 0, '01RD00078', NULL, 5, NULL, 61, 0, NULL, 22000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(79, 'TUYAUX MOBILIER 25 X 1 mm', 0, NULL, '01RD00079', NULL, 5, NULL, 55, NULL, NULL, 17000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(80, 'TUYAUX MOBILIER 32 X 1mm', 0, 0, '01RD00080', NULL, 5, NULL, 191, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(81, 'TUYAUX MOBILIER 40 X 1mm', 0, NULL, '01RD00081', NULL, 5, NULL, 99, NULL, NULL, 30000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(82, 'TUYAUX MOBILIER 50 X 1mm', 0, 0, '01RD00082', NULL, 5, NULL, 151, 0, NULL, 40000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(83, 'TUYAUX MOBILIER 63 X 1.2mm', 0, NULL, '01RD00083', NULL, 5, NULL, 0, NULL, NULL, 80000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(84, 'TUYAUX MOBILIER 75 X 1.2mm', 0, NULL, '01RD00084', NULL, 5, NULL, 0, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(85, 'FAB 6', 0, NULL, '01RD00085', NULL, 6, NULL, 0, NULL, NULL, 14000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(86, 'FAB 8', 0, 0, '01RD00086', NULL, 6, NULL, 1370, 0, NULL, 21000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(87, 'FAB 10', 0, 0, '01RD00087', NULL, 6, NULL, 798, 0, NULL, 41000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(88, 'FAB 12', 0, 0, '01RD00088', NULL, 6, NULL, 570, 0, NULL, 62000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(89, 'FAB 14', 0, 0, '01RD00089', NULL, 6, NULL, 132, 0, NULL, 51000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(90, 'FAB 16', 0, NULL, '01RD00090', NULL, 6, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(91, 'FAB 6 LISSE', 0, 0, '01RD00091', NULL, 6, NULL, 507, 0, NULL, 12000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(92, 'FAB 8 LISSE', 0, 0, '01RD00092', NULL, 6, NULL, 468, 0, NULL, 22000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(93, 'FAB 10 LISSE', 0, 0, '01RD00093', NULL, 6, NULL, 169, 0, NULL, 37000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(94, 'FAB 12 LISSE', 0, 0, '01RD00094', NULL, 6, NULL, 120, 0, NULL, 58000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(95, 'ETRIERS  X 15 X 35', 0, 0, '01RD00095', NULL, 7, NULL, 1000, 0, NULL, 1800, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(96, 'ETRIERS  X 15 x 30', 0, NULL, '01RD00096', NULL, 7, NULL, 2300, NULL, NULL, 1700, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(97, 'ETRIERS 15 x 25', 0, NULL, '01RD00097', NULL, 7, NULL, 1185, NULL, NULL, 1200, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(98, 'ETRIERS  15 x 15', 0, NULL, '01RD00098', NULL, 7, NULL, 4170, NULL, NULL, 800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(99, 'ETRIERS  X TRIANGLE', 0, 0, '01RD00099', NULL, 7, NULL, 2291, 0, NULL, 500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(100, 'CLOUS  X Clous de 12 X Sac', 0, NULL, '01RD00100', NULL, 11, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(101, 'TREILLIS  MOYEN YEUX', 0, NULL, '01RD00101', NULL, 12, NULL, 6, NULL, NULL, 130000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(102, 'TREILLIS PETIT YEUX', 0, NULL, '01RD00102', NULL, 12, NULL, 1, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(103, 'FIL A LIGATURER  X  KG', 0, 0, '01RD00103', NULL, 9, NULL, 120, 0, NULL, 135000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(104, 'CLOUS de 3', 0, 0, '01RD00104', NULL, 11, NULL, 625, 0, NULL, 5000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(105, 'CLOUS de 4', 0, 0, '01RD00105', NULL, 11, NULL, 625, 0, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(106, 'CLOUS de 5', 0, 0, '01RD00106', NULL, 11, NULL, 150, 0, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(107, 'CLOUS de 6', 0, 0, '01RD00107', NULL, 11, NULL, 18, 0, NULL, 4500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(108, 'CLOUS de 8', 0, 0, '01RD00108', NULL, 11, NULL, 625, 0, NULL, 4500, 0, 0, NULL, '1', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(109, 'CLOUS de 10', 0, 0, '01RD00109', NULL, 11, NULL, 15, 0, NULL, 5000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(110, 'CLOUS de 12', 0, 0, '01RD00110', NULL, 11, NULL, 625, 0, NULL, 4000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(111, 'CLOUS de 16', 0, 0, '01RD00111', NULL, 11, NULL, 625, 0, NULL, 4000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(112, 'CLOUS DE TOLE', 0, 0, '01RD00112', NULL, 11, NULL, 3500, 0, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(113, 'GAINE FLEXIBLE RLX', 0, NULL, '01RD00113', NULL, 13, NULL, 16, NULL, NULL, 17000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(114, 'PLAFOND PVC', 0, NULL, '01RD00114', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(115, 'CORNIERE PLAFOND', 0, NULL, '01RD00115', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(117, 'BAGUETTE  2.5', 0, NULL, '01RD00117', NULL, 13, NULL, 17, NULL, NULL, 12000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(118, 'BAGUETTE  3.5', 0, NULL, '01RD00118', NULL, 13, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(119, 'BALANCE  30 Kg', 0, NULL, '01RD00119', NULL, 13, NULL, 4, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(120, 'BACHE  HEMA', 0, 0, '01RD00120', NULL, 13, NULL, 299, 0, NULL, 18000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(121, 'BOITE DE DERRIVATION', 0, NULL, '01RD00121', NULL, 13, NULL, 227, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(123, 'BOUCHON W.C SIEGE', 0, 0, '01RD00123', NULL, 13, NULL, 100, 0, NULL, 15000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(124, 'BROSS A SHAUX', 0, NULL, '01RD00124', NULL, 13, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(125, 'BROSS SIMPLE No 1', 0, NULL, '01RD00125', NULL, 13, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(126, 'BROSS SIMPLE No 2', 0, NULL, '01RD00126', NULL, 13, NULL, 47, NULL, NULL, 1500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(127, 'BROSS  SIMPLE N0 3', 0, NULL, '01RD00127', NULL, 13, NULL, 38, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(128, 'BROUETTE', 0, NULL, '01RD00128', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(129, 'CHEVILLE  NO 8', 0, NULL, '01RD00129', NULL, 13, NULL, 4059, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(130, 'CHEVILLE NO 6', 0, 0, '01RD00130', NULL, 13, NULL, 50, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(131, 'COLLE PATEX', 0, 0, '01RD00131', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(132, 'COLLE TANGIT', 0, 0, '01RD00132', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(133, 'COUTEAUX MASTIC', 0, 0, '01RD00133', NULL, 13, NULL, 100, 0, NULL, 1500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(134, 'DISQUE A MELLE PETIT MODEL', 0, 0, '01RD00134', NULL, 13, NULL, 1000, 0, NULL, 10000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(135, 'DISQUE A MELER GRAND MODEL', 0, 0, '01RD00135', NULL, 13, NULL, 1000, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(136, 'DISQUE A COUPER', 0, NULL, '01RD00136', NULL, 13, NULL, 566, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(137, 'DOUILLE', 0, NULL, '01RD00137', NULL, 13, NULL, 37, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(138, 'EVIER DOUBLE', 0, NULL, '01RD00138', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(139, 'FICELLE MACON GRAND MODEL', 0, 0, '01RD00139', NULL, 13, NULL, 300, 0, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(140, 'FILACE', 0, NULL, '01RD00140', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(141, 'HOUE', 0, NULL, '01RD00141', NULL, 13, NULL, 10, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(142, 'INDUIT MAKITA', 0, NULL, '01RD00142', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(143, 'LAME DE SCIE', 0, NULL, '01RD00143', NULL, 13, NULL, 0, NULL, NULL, 4000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(144, 'MACHETTE', 0, NULL, '01RD00144', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(145, 'MARTEAU CHARPENTIER ', 0, NULL, '01RD00145', NULL, 13, NULL, 24, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(146, 'MASTIC  DU FERT', 0, NULL, '01RD00146', NULL, 13, NULL, 150, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(147, 'MECHE BETON 5', 0, 0, '01RD00147', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(148, 'MECHE BETON 6', 0, NULL, '01RD00148', NULL, 13, NULL, 90, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(149, 'MECHE BETON 8', 0, 0, '01RD00149', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(150, 'MECHE BETON 10', 0, NULL, '01RD00150', NULL, 13, NULL, 110, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(151, 'MECHE METALIC 3', 0, 0, '01RD00151', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(152, 'MECHE METALIC  5', 0, 0, '01RD00152', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(153, 'MECHE METALIC 4', 0, 0, '01RD00153', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(154, 'MEULEUSE', 0, 0, '01RD00154', NULL, 13, NULL, 16, 0, NULL, 450000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(155, 'NESSANCE GOUTIER', 0, NULL, '01RD00155', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(156, 'PAPIER DISQUE NO 60', 0, 0, '01RD00156', NULL, 13, NULL, 1000, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(157, 'PAPIER DISQUE NO 80', 0, NULL, '01RD00157', NULL, 13, NULL, 170, NULL, NULL, 1500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(158, 'PAPIER DISQUE NO 100', 0, NULL, '01RD00158', NULL, 13, NULL, 300, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(159, 'PAPIER MELER EN METRE NO 60', 0, 0, '01RD00159', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(160, 'PAPIER MELER EN METRE NO 80', 0, 0, '01RD00160', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(161, 'PAPIER MELER EN METRE NO 100', 0, 0, '01RD00161', NULL, 13, NULL, 300, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(162, 'PIOCHE 2.5', 0, NULL, '01RD00162', NULL, 13, NULL, 152, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(163, 'PELLE (beches)', 0, NULL, '01RD00163', NULL, 13, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(164, 'POIGNET  A SOUDEUR', 0, 0, '01RD00164', NULL, 13, NULL, 100, 0, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(165, 'POMELLE DE 8', 0, 0, '01RD00165', NULL, 13, NULL, 5000, 0, NULL, 2000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(166, 'POMELLE DE 10', 0, 0, '01RD00166', NULL, 13, NULL, 5000, 0, NULL, 2000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(167, 'POMELLE DE 12', 0, 0, '01RD00167', NULL, 13, NULL, 5000, 0, NULL, 3000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(168, 'PORTE NAKO 5', 0, 0, '01RD00168', NULL, 13, NULL, 500, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(169, 'PORTE NAKO 6', 0, 0, '01RD00169', NULL, 13, NULL, 500, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(170, 'PORTE NAKO 4', 0, 0, '01RD00170', NULL, 13, NULL, 500, 0, NULL, 2, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(171, 'PORTE SCIE', 0, 0, '01RD00171', NULL, 13, NULL, 20, 0, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(172, 'PPR DE 20', 0, 0, '01RD00172', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(173, 'PPR DE 25', 0, 0, '01RD00173', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL);
INSERT INTO `pos_store_1_ibi_articles` (`ID_ARTICLE`, `DESIGN_ARTICLE`, `TYPE_ARTICLE`, `NATURE_ARTICLE`, `CODEBAR_ARTICLE`, `REF_RAYON_ARTICLE`, `REF_CATEGORIE_ARTICLE`, `REF_ID_FAMILLE_ARTICLE`, `QUANTITY_ARTICLE`, `PRIX_DACHAT_ARTICLE`, `PRIX_DE_REVIENS_ARTICLE`, `PRIX_DE_VENTE_ARTICLE`, `RIX_VENTE_CLIENT_ARTICLE`, `PRIX_DE_VENTE_VIP_ARTICLE`, `TAILLE_ARTICLE`, `POIDS_ARTICLE`, `COULEUR_ARTICLE`, `HAUTEUR_ARTICLE`, `LARGEUR_ARTICLE`, `APERCU_ARTICLE`, `UNITE_ARTICLE`, `PRIX_PROMOTIONEL_ARTICLE`, `QTE_DECOUPAGE_ARTICLE`, `MARGE_ARTICLE`, `SPECIAL_PRICE_START_DATE_ARTICLE`, `SPECIAL_PRICE_END_DATE_ARTICLE`, `DESCRIPTION_ARTICLE`, `MINIMUM_QUANTITY_ARTICLE`, `ETAT_INGREDIENT_ARTICLE`, `NOMBRE_UNITAIRE`, `TYPE_INGREDIENT`, `NOMBRE_INGREDIENT_TRANSFORMER`, `TRANSFORMER_BY`, `APPROVISIONNER_ARTICLE_BY`, `ETAT_TVA`, `STATUT_ARTICLE`, `DATE_CREATION_ARTICLE`, `DATE_MOD_ARTICLE`, `CREATED_BY_ARTICLE`, `MODIFIED_BY_ARTICLE`, `DELETE_STATUS_ARTICLE`, `DELETE_DATE_ARTICLE`, `DELETE_BY_ARTICLE`, `DELETE_COMMENT_ARTICLE`, `STORE_ID_ARTICLE`, `IS_INGREDIENT`, `SEUIL_ARTICLE`, `MARQUE`, `REF_SOUS_CATEGORIE_ARTICLE`, `TAUX_DE_MARGE_ARTICLE`, `PRIX_VENTE_CLIENT_ARTICLE`) VALUES
(174, 'ROBINET  3/4', 0, NULL, '01RD00174', NULL, 13, NULL, 261, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(176, 'ROBINET LAVABEAUX', 0, 0, '01RD00176', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(177, 'ROBINET MELANGEUR', 0, 0, '01RD00177', NULL, 13, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(178, 'ROULEAU A PEINTRE  GRAND MODEL', 0, 0, '01RD00178', NULL, 13, NULL, 1196, 0, NULL, 4000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(179, 'ROULEAU A PEINTRE PETIT MODEL', 0, NULL, '01RD00179', NULL, 13, NULL, 4198, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(180, 'ROULETTE GRAND MODEL', 0, NULL, '01RD00180', NULL, 13, NULL, 1728, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(181, 'ROULETTE PETIT MODEL', 0, NULL, '01RD00181', NULL, 13, NULL, 1337, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(182, 'SERRURE COMPLET', 0, 0, '01RD00182', NULL, 13, NULL, 46, 0, NULL, 120000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(183, 'SIPHON GRAND MODEL', 0, 0, '01RD00183', NULL, 13, NULL, 20, 0, NULL, 2000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(184, 'TEFLON Petit model', 0, NULL, '01RD00184', NULL, 13, NULL, 156, NULL, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(185, 'TEFLON Grand model', 0, NULL, '01RD00185', NULL, 13, NULL, 224, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(188, 'V.O.B 1.5', 0, 0, '01RD00188', NULL, 13, NULL, 100, 0, NULL, 80000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(189, 'V.O.B 2.5', 0, 0, '01RD00189', NULL, 13, NULL, 100, 0, NULL, 115000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(190, 'VEROUX PETIT MODEL', 0, 0, '01RD00190', NULL, 13, NULL, 0, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(191, 'VICE A BOIS', 0, 0, '01RD00191', NULL, 13, NULL, 5000, 0, NULL, 100, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(192, 'VICE TOLES 1/4', 0, 0, '01RD00192', NULL, 13, NULL, 72000, 0, NULL, 350, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(193, 'CORNIERE 50 x 6mm', 0, 0, '01RD00193', NULL, 3, NULL, 64, 0, NULL, 105000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(194, 'TUYAUX MOBILIER 60', 0, NULL, '01RD00194', NULL, 5, NULL, 0, NULL, NULL, 75000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(195, 'TOLE 0.8 STD', 0, NULL, '01RD00195', NULL, 4, NULL, 0, NULL, NULL, 115000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(196, 'GAINE FLEXIBLE BURUNDI', 0, 0, '01RD00196', NULL, 13, NULL, 0, 0, NULL, 28000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(197, 'FICELLE MACON PETIT MODEL', 0, 0, '01RD00197', NULL, 13, NULL, 0, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(198, 'ANTIROUILLE 4 LITRES', 0, 0, '01RD00198', NULL, 13, NULL, 153, 0, NULL, 30000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(199, 'VANNE 1     1/4', 0, 0, '01RD00199', NULL, 13, NULL, 25, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(200, 'VANNE 3/4', 0, 0, '01RD00200', NULL, 13, NULL, 604, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(201, 'VANNE 1/2', 0, 0, '01RD00201', NULL, 13, NULL, 50, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(202, 'BROSSE DE RUE', 0, 0, '01RD00202', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(205, 'SCIE A BOIS', 0, 0, '01RD00205', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(206, 'CHEVILLE GRAND MODEL', 0, 0, '01RD00206', NULL, 13, NULL, 100, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(207, 'MECHE 3.5', 0, 0, '01RD00207', NULL, 13, NULL, 100, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(208, 'CHEVILLE PETIT MODEL', 0, 0, '01RD00208', NULL, 13, NULL, 100, 0, NULL, 3000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(209, 'HACHE', 0, 0, '01RD00209', NULL, 13, NULL, 5, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(210, 'MARTEAU DE MASSE 1KG', 0, 0, '01RD00210', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(211, 'MACHON 1  1/2', 0, 0, '01RD00211', NULL, 13, NULL, 100, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(212, 'DISQUE A MELLER ORGINAL', 0, 0, '01RD00212', NULL, 13, NULL, 4248, 0, NULL, 12000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(213, 'DISQUE A MELLER SIMPLE', 0, 0, '01RD00213', NULL, 13, NULL, 1000, 0, NULL, 10000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(214, 'CHARNIERE', 0, 0, '01RD00214', NULL, 13, NULL, 100, 0, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(215, 'TE GALVANISE 1', 0, 0, '01RD00215', NULL, 13, NULL, 20, 0, NULL, 500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(216, 'COUDE 1/2', 0, 0, '01RD00216', NULL, 13, NULL, 200, 0, NULL, 500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(217, 'TE 1/2', 0, 0, '01RD00217', NULL, 3, NULL, 100, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(218, 'BOUCHON 1/2', 0, 0, '01RD00218', NULL, 13, NULL, 100, 0, NULL, 15000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(219, 'MANCHON 1    1/2', 0, 0, '01RD00219', NULL, 13, NULL, 0, 0, NULL, 800, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(220, 'REDUCTEUR GALVANISE 1/2', 0, 0, '01RD00220', NULL, 13, NULL, 200, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(221, 'COUDE 1', 0, 0, '01RD00221', NULL, 13, NULL, 300, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(222, 'NIPLE 1/2', 0, 0, '01RD00222', NULL, 13, NULL, 300, 0, NULL, 1200, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(223, 'MACHON REDUCTEUR', 0, 0, '01RD00223', NULL, 13, NULL, 300, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(224, 'MACHON 1', 0, 0, '01RD00224', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(225, 'MACHON REDUCTEUR 1/2', 0, 0, '01RD00225', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(226, 'SCALITE', 0, 0, '01RD00226', NULL, 13, NULL, 130, 0, NULL, 4000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(228, 'PIGMANT', 0, NULL, '01RD00228', NULL, 13, NULL, 130, NULL, NULL, 9000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(229, 'ROOFING', 0, NULL, '01RD00229', NULL, 13, NULL, 50, NULL, NULL, 9000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(230, 'CIMENT DANGOTE', 0, NULL, '01RD00230', NULL, 13, NULL, 70, NULL, NULL, 38000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(231, 'FER U 120', 0, NULL, '01RD00231', NULL, 3, NULL, 0, NULL, NULL, 440000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(232, 'FER U 100', 0, NULL, '01RD00232', NULL, 3, NULL, 16, NULL, NULL, 490000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(233, 'CONCERTINANT', 0, 0, '01RD00233', NULL, 13, NULL, 2, 0, NULL, 25000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(234, 'PAPIER MELER EN METRE NO 120', 0, 0, '01RD00234', NULL, 13, NULL, 100, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(235, 'CADENAS PETIT', 0, 0, '01RD00235', NULL, 13, NULL, 21, 1, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(236, 'VICE PARCOEUR', 0, 0, '01RD00236', NULL, 13, NULL, 2000, 1, NULL, 50, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(237, 'CHEVILLE N0 10', 0, NULL, '01RD00237', NULL, 13, NULL, 38, NULL, NULL, 3000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(238, 'CYLCONE', 0, NULL, '01RD00238', NULL, 13, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(239, 'FIL GALVANISER', 0, 0, '01RD00239', NULL, 10, NULL, 25, 0, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(240, 'TOLE 5 mm', 0, 0, '01RD00240', NULL, 4, NULL, 0, 700000, NULL, 750000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(242, 'TOLE BG 28 ROUGE', 0, 0, '01RD00241', NULL, 4, NULL, 0, 50000, NULL, 58000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(243, 'FETIERE (mireko)', 0, 0, '01RD00242', NULL, 13, NULL, 0, 0, NULL, 19000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(244, 'COUDE 3/4', 0, 0, '01RD00243', NULL, 13, NULL, 50, 3000, NULL, 3500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(245, 'SIPHON DU SOL', 0, 0, '01RD00244', NULL, 13, NULL, 5, 0, NULL, 3500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(246, 'RACCORD UNION', 0, NULL, '01RD00245', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-24 14:38:28', 1, 'O', 1, 0, 0, NULL, 0, NULL, NULL),
(247, 'RACCORD UNION', 0, 0, '01RD00246', NULL, 13, NULL, 50, 0, NULL, 500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(248, 'TOLE STD 8mm', 0, 0, '01RD00247', NULL, 4, NULL, 0, 0, NULL, 1500000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(249, 'BAC DE DOUCHE', 0, 0, '01RD00248', NULL, 13, NULL, 0, 0, NULL, 5000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(251, 'PAPIER MELER EN METRE NO 150', 0, 0, '01RD00250', NULL, 13, NULL, 40, 900, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(252, 'PAPIER MELER EN METRE NO 150', 0, NULL, '01RD00251', NULL, 13, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-23 17:22:48', 1, 'OUI', 1, 0, 0, NULL, 0, NULL, NULL),
(253, 'PAPIER MELER EN METRE NO 240', 0, 0, '01RD00252', NULL, 13, NULL, 20, 900, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(254, 'PAPIER MELER EN METRE NO 600', 0, 0, '01RD00253', NULL, 13, NULL, 20, 900, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(255, 'TOLE TRANSPARENT', 0, 0, '01RD00254', NULL, 4, NULL, 0, 0, NULL, 25000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(256, 'BROSS METALIC', 0, 0, '01RD00255', NULL, 13, NULL, 5, 0, NULL, 2000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(257, 'BROSS SIMPLE No 4', 0, 0, '01RD00256', NULL, 13, NULL, 5, 900, NULL, 3500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(258, 'TOLE BG 28 BLANC', 0, 0, '01RD00257', NULL, 4, NULL, 0, 0, NULL, 58000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(259, 'TOLE STD X 10 MM', 0, 0, '01RD00258', NULL, 4, NULL, 0, 0, NULL, 1500000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(260, 'TOLE GALVANISE', 0, 0, '01RD00259', NULL, 4, NULL, 0, 20000, NULL, 25000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(261, 'CLOU A BETON', 0, 0, '01RD00260', NULL, 11, NULL, 3200, 0, NULL, 500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(262, 'KUKU NETTE', 0, 0, '01RD00261', NULL, 13, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(263, 'CROCHET', 0, 0, '01RD00262', NULL, 13, NULL, 990, 0, NULL, 300, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(264, 'TOLE CRENELE 3mm', 0, 0, '01RD00263', NULL, 4, NULL, 0, 0, NULL, 350000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(265, 'ETRIER 15 X 45', 0, 0, '01RD00264', NULL, 7, NULL, 0, 1000, NULL, 1500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(266, 'TOLE CRENEIE DE 8 MM', 0, 0, '01RD00265', NULL, 4, NULL, 0, 0, NULL, 500000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(267, 'TOLE 3 MM', 0, 0, '01RD00266', NULL, 4, NULL, 0, 0, NULL, 350000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(268, 'ANTIROUILLE 1 LITRE', 0, 0, '01RD00267', NULL, 13, NULL, 0, 7000, NULL, 8000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Littre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(269, 'EVIER SIMPLE', 0, 0, '01RD00268', NULL, 13, NULL, 22, 80000, NULL, 85000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(270, 'PAPIER MELER EN METRE NO 220', 0, 0, '01RD00269', NULL, 13, NULL, 0, 800, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(271, 'PAPIER MELER EN METRE NO 320', 0, 0, '01RD00270', NULL, 13, NULL, 0, 0, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(272, 'BALAIE', 0, 0, '01RD00271', NULL, 13, NULL, 267, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(274, 'TENTE', 0, NULL, '01RD00273', NULL, 13, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-25 12:20:56', 1, 'k', 1, 0, 0, NULL, 0, NULL, NULL),
(275, 'GOUTTIERE', 0, 0, '01RD00274', NULL, 13, NULL, 5, 0, NULL, 11000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(276, 'RACLETTE', 0, 0, '01RD00275', NULL, 13, NULL, 248, 2000, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(277, 'ETRIERS 20 x 25', 0, 0, '01RD00276', NULL, 7, NULL, 0, 0, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(278, 'ETRIERS 20 x 20', 0, 0, '01RD00277', NULL, 7, NULL, 0, 0, NULL, 900, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(279, 'ETRIERS 15 x 45', 0, 0, '01RD00278', NULL, 7, NULL, 0, 0, NULL, 1200, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(280, 'ETRIERS 15 x 20', 0, 0, '01RD00279', NULL, 7, NULL, 0, 0, NULL, 800, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(281, 'CLOUS 15', 0, 0, '01RD00280', NULL, 11, NULL, 0, 0, NULL, 5000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(282, 'TREILLIS GRQND YEUX 1.5', 0, NULL, '01RD00281', NULL, 13, NULL, 0, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-24 13:07:06', 1, 'OUI', 1, 0, 0, NULL, 0, NULL, NULL),
(283, 'ETRIERS 25 X 25', 0, 0, '01RD00282', NULL, 7, NULL, 0, 0, NULL, 1300, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(284, 'Test', 0, NULL, '01RD00283', NULL, 1, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-18 11:19:04', 1, 'ujju', 1, 0, 0, NULL, 0, NULL, NULL),
(285, 'TOLE BG 28 CHOCOLAT', 0, 0, '01RD00284', NULL, 4, NULL, 0, 0, NULL, 60000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(286, 'PAPIER MELER N0 400', 0, 0, '01RD00285', NULL, 13, NULL, 0, 0, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(287, 'MACHINE CARREAUX', 0, 0, '01RD00286', NULL, 13, NULL, 10, 0, NULL, 85000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(288, 'TUBE 30 X 30 X 1mm 1er Q', 0, 0, '01RD00287', NULL, 1, NULL, 0, 0, NULL, 30000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(289, 'TUBE 20x20  x 1mm 1ere Q', 0, 0, '01RD00288', NULL, 1, NULL, 278, 0, NULL, 23000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(290, 'TUBE 40x40 x 1mm 1er Q', 0, 0, '01RD00289', NULL, 1, NULL, 157, 0, NULL, 53000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(291, 'TUBE 60x40x1mm 1er Q', 0, 0, '01RD00290', NULL, 1, NULL, 140, 0, NULL, 66000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(292, 'TUYAUX MOBILIER 20 x 1mm 1er Q', 0, 0, '01RD00291', NULL, 5, NULL, 7, 0, NULL, 16000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(293, 'TUBE 50X25 1.2 MM', 0, 0, '01RD00292', NULL, 1, NULL, 107, 0, NULL, 40000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(294, 'TUYAUX MOBILIER 20 X 1.2 MM', 0, 0, '01RD00293', NULL, 5, 0, 25, 0, NULL, 25000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL),
(296, 'Huile d_Emananael', 0, NULL, NULL, NULL, 5, NULL, 0, 1300, NULL, 1300, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-18 11:54:29', 1, 'ont itilise plus ', 1, 0, 0, NULL, 0, NULL, NULL),
(300, 'TUBE 16X16  2e Q', 0, 0, '0002-000295', NULL, 1, NULL, 587, 12000, NULL, 14000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 12:05:51', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(301, 'TUBE 25 X 25', 0, 0, '0002-000301', NULL, 1, NULL, 159, 12000, NULL, 35000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:53', '2022-05-25 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(302, 'TREILLIS GRAND YEUX 1.5', 0, 0, '0002-000302', NULL, 12, NULL, 0, 50000, NULL, 60000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:51', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(303, 'FIL GALVANISE MOYEN ', 0, 0, '0002-000303', NULL, 10, NULL, 0, 4000, NULL, 6000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:41', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(304, 'FIL GALVANISE PETIT', 0, 0, '0002-000304', NULL, 19, NULL, 0, 4000, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:19', NULL, 1, NULL, 1, '2022-05-24 14:30:07', 1, 'O', 2, 0, 0, NULL, 0, NULL, NULL),
(305, 'TREILLIS GRAND YEUX 1,2', 0, 0, '0002-000305', NULL, 12, NULL, 0, 42000, NULL, 58000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:23', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(306, 'FAB 4 LISSE', 0, 0, '0002-000306', NULL, 18, NULL, 53, 5000, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:24', '2022-05-23 00:00:00', 1, 1, 1, '2022-05-23 16:39:24', 1, 'G', 2, 0, 0, NULL, 0, NULL, NULL),
(307, 'TREILLIS GRAND YEUX 1,2', 0, 0, '0002-000307', NULL, 18, NULL, 0, 42000, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:58', NULL, 1, NULL, 1, '2022-05-19 14:48:32', 1, 'OUI', 2, 0, 0, NULL, 0, NULL, NULL),
(308, 'FAB 4 LISSE', 0, 0, '0002-000306', NULL, 18, NULL, 53, 5000, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-20 03:05:35', '2022-05-23 00:00:00', 1, 1, 1, '2022-05-23 16:39:24', 1, 'G', 2, 0, 0, NULL, 0, NULL, NULL),
(309, 'FAB 4 LISSE', 0, 0, '0001-000309', NULL, 6, NULL, 0, 5000, NULL, 7000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-21 03:05:41', NULL, 1, NULL, 1, '2022-05-23 10:44:37', 1, 'OUI', 1, 0, 0, NULL, 0, NULL, NULL),
(310, 'BOITE ENCASTREMENT', 0, 0, '0001-000310', NULL, 13, NULL, 265, 400, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-21 03:05:22', NULL, 1, NULL, 1, '2022-05-23 10:43:31', 1, 'OUI', 1, 0, 0, NULL, 0, NULL, NULL),
(311, 'clous Beton', 0, 0, '0001-000311', NULL, 11, NULL, 3200, 1, NULL, 100, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 0, 0, '2022-05-23 09:05:41', NULL, 1, NULL, 1, '2022-05-23 10:25:41', 1, 'F', 1, 0, 0, NULL, 0, NULL, NULL),
(312, 'BOITE ENCASTREMENT', 0, 0, '0002-000309', NULL, 13, NULL, 265, 500, NULL, 1000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-23 11:05:11', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(313, 'ROBINET DU COEUR', 0, 0, '0002-000310', NULL, 18, NULL, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-23 02:05:38', NULL, 1, NULL, 1, '2022-05-23 14:03:56', 1, 'H', 2, 0, 0, NULL, 0, NULL, NULL),
(314, 'ROBINET D\'ECAIRE', 0, 0, '0002-000311', NULL, 13, NULL, 24, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-23 02:05:38', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(315, 'BROSSE ISHWAGARA', 0, 0, '0002-000312', NULL, 13, NULL, 30, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, '2022-05-23 03:05:30', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(316, 'TUY D\'ARROSAGE', 0, 0, '0002-000313', NULL, 13, NULL, 4, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, '2022-05-23 03:05:08', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(317, 'FAB 4 LISSE', 0, 0, '0002-000314', NULL, 6, NULL, 53, 4000, NULL, 8500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-23 04:05:12', '2022-05-25 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(318, 'CHARBON', 0, 0, '0001-000318', NULL, 13, NULL, 300, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-24 12:05:26', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_articles_stock_flow`
--

CREATE TABLE `pos_store_1_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT '0',
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_1_ibi_articles_stock_flow`
--

INSERT INTO `pos_store_1_ibi_articles_stock_flow` (`ID_SF`, `REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`, `REF_SHIPPING_SF`, `SHIFT_ID_S`, `TYPE_SF`, `UNIT_PRICE_SF`, `TOTAL_PRICE_SF`, `REF_PROVIDER_SF`, `DESCRIPTION_SF`, `DATE_CREATION_SF`, `DATE_MOD_SF`, `CREATED_BY_SF`, `MODIFIED_BY_SF`, `DELETE_STATUS_SF`, `DELETE_DATE_SF`, `DELETE_BY_SF`, `DELETE_COMMENT_SF`, `ID_ARRIVAGE`) VALUES
(1, '01RD00290', 30.000, 'REQ00001/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-18 11:49:14', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '01RD00291', 2.000, 'REQ00001/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-18 11:49:14', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '0002-000306', 53.000, '6', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:24:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '0002-000306', 53.000, '6', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:24:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '01RD00015', 62.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '01RD00015', 62.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '01RD00001', 355.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '01RD00001', 355.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '01RD00079', 165.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '01RD00079', 165.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '01RD00291', 7.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '01RD00291', 7.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '01RD00052', 178.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '01RD00052', 178.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '01RD00027', 272.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '01RD00027', 272.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '01RD00095', 1000.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '01RD00095', 1000.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '01RD00096', 2300.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '01RD00096', 2300.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '01RD00036', 84.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '01RD00036', 84.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '01RD00072', 3.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '01RD00072', 3.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '01RD00071', 1.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '01RD00071', 1.000, '5', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:25:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '01RD00009', 18.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '01RD00009', 18.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '01RD00287', 0.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '01RD00003', 159.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '01RD00003', 159.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '01RD00024', 36.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '01RD00024', 36.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '01RD00002', 368.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '01RD00002', 368.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '01RD00288', 278.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '01RD00288', 278.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, '0002-000295', 645.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, '0002-000295', 645.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '01RD00026', 42.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(41, '01RD00026', 42.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(42, '01RD00290', 143.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(43, '01RD00290', 143.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(44, '01RD00289', 157.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, '01RD00289', 157.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, '01RD00012', 128.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(47, '01RD00012', 128.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(48, '01RD00018', 44.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(49, '01RD00018', 44.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(50, '01RD00008', 141.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(51, '01RD00008', 141.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(52, '01RD00007', 135.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(53, '01RD00007', 135.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(54, '01RD00014', 299.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '01RD00014', 299.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(56, '01RD00088', 658.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(57, '01RD00088', 658.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(58, '01RD00087', 687.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '01RD00087', 687.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(60, '01RD00085', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(61, '01RD00091', 560.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(62, '01RD00091', 560.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(63, '01RD00093', 201.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(64, '01RD00093', 201.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(65, '01RD00092', 490.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(66, '01RD00092', 490.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(67, '01RD00086', 1481.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(68, '01RD00086', 1481.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '01RD00094', 121.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '01RD00094', 121.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '01RD00006', 373.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(72, '01RD00006', 373.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(73, '01RD00010', 65.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '01RD00010', 65.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(75, '01RD00005', 515.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '01RD00005', 515.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:57:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(77, '01RD00033', 0.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(78, '01RD00044', 24.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(79, '01RD00044', 24.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(80, '01RD00232', 16.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(81, '01RD00232', 16.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(82, '01RD00032', 112.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(83, '01RD00032', 112.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(84, '01RD00046', 43.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(85, '01RD00046', 43.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(86, '01RD00098', 4670.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(87, '01RD00098', 4670.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(88, '01RD00097', 1225.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(89, '01RD00097', 1225.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(90, '01RD00193', 66.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '01RD00193', 66.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(92, '01RD00035', 102.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(93, '01RD00035', 102.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(94, '01RD00066', 22.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(95, '01RD00066', 22.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(96, '01RD00070', 8.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(97, '01RD00070', 8.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(98, '01RD00020', 30.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(99, '01RD00020', 30.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(100, '01RD00022', 57.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(101, '01RD00022', 57.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(102, '01RD00292', 107.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(103, '01RD00292', 107.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 11:58:17', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(109, '01RD00095', 1.000, 'V0099', NULL, 0, 'sale', 1800, 1800, 0, NULL, '2022-05-21 10:57:49', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(110, '01RD00095', 1.000, 'V00100', NULL, 0, 'sale', 1800, 1800, 0, NULL, '2022-05-21 11:13:37', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(111, '01RD00095', 6.000, 'V00101', NULL, 0, 'sale', 1800, 10800, 0, NULL, '2022-05-21 11:17:35', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(115, '01RD00193', 1.000, 'V002', NULL, 0, 'sale', 105000, 105000, 0, NULL, '2022-05-21 12:25:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(116, '0002-000306', 53.000, 'REQ00002/05/2022', NULL, 0, 'transfert_in', 5000, 265000, NULL, NULL, '2022-05-21 14:05:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(117, '0002-000306', 2.000, 'REQ00002/05/2022', NULL, 0, 'transfert_out', 5000, 10000, NULL, NULL, '2022-05-21 14:56:43', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(118, '0002-000306', 2.000, 'REQ00003/05/2022', NULL, 0, 'transfert_in', 5000, 10000, NULL, NULL, '2022-05-21 15:15:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(123, '0001-000310', 265.000, '7', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(124, '0001-000310', 265.000, '7', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(125, '01RD00198', 158.000, '7', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(126, '01RD00198', 158.000, '7', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(127, '01RD00117', 33.000, '7', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(128, '01RD00117', 33.000, '7', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:36:52', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(129, '01RD00058', 40.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(130, '01RD00058', 40.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(131, '01RD00055', 35.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(132, '01RD00055', 35.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(133, '01RD00057', 35.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(134, '01RD00057', 35.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(135, '01RD00059', 29.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(136, '01RD00059', 29.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(137, '01RD00056', 34.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(138, '01RD00056', 34.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(139, '01RD00120', 321.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(140, '01RD00120', 321.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(141, '01RD00150', 110.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(142, '01RD00150', 110.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(143, '01RD00148', 90.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(144, '01RD00148', 90.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:37:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(145, '0001-000311', 3200.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 09:44:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(146, '0001-000311', 3200.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 09:44:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(147, '01RD00137', 37.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(148, '01RD00137', 37.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(149, '01RD00113', 16.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(150, '01RD00113', 16.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(151, '01RD00141', 11.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(152, '01RD00141', 11.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(153, '01RD00286', 10.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(154, '01RD00286', 10.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(155, '01RD00146', 156.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(156, '01RD00146', 156.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(157, '01RD00145', 24.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(158, '01RD00145', 24.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(159, '01RD00271', 275.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(160, '01RD00271', 275.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(161, '01RD00119', 4.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(162, '01RD00119', 4.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(163, '01RD00126', 47.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(164, '01RD00126', 47.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(165, '01RD00127', 41.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(166, '01RD00127', 41.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(167, '01RD00235', 21.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(168, '01RD00235', 21.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(169, '01RD00106', 150.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(170, '01RD00106', 150.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:40:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(171, '01RD00121', 229.000, '9', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:41:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(172, '01RD00121', 229.000, '9', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:41:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(173, '01RD00093', 10.000, 'V001', NULL, 0, 'sale', 37000, 370000, 0, NULL, '2022-05-23 10:19:15', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(174, '01RD00086', 4.000, 'V001', NULL, 0, 'sale', 20000, 80000, 0, NULL, '2022-05-23 10:19:15', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(175, '01RD00081', 115.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(176, '01RD00081', 115.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(177, '01RD00082', 150.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(178, '01RD00082', 150.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(179, '01RD00080', 192.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(180, '01RD00080', 192.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(181, '01RD00079', 135.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(182, '01RD00079', 30.000, '10', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(183, '01RD00078', 64.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(184, '01RD00078', 64.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(185, '01RD00043', 64.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(186, '01RD00043', 64.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(187, '01RD00044', 23.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(188, '01RD00044', 1.000, '10', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(189, '01RD00041', 149.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(190, '01RD00041', 149.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(191, '01RD00042', 201.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(192, '01RD00042', 201.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(193, '01RD00040', 95.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(194, '01RD00040', 95.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(195, '01RD00039', 302.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(196, '01RD00039', 302.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(197, '01RD00038', 186.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(198, '01RD00038', 186.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(199, '01RD00106', 150.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(200, '01RD00106', 150.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(201, '01RD00107', 25.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(202, '01RD00107', 25.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(203, '01RD00109', 25.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(204, '01RD00109', 25.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(205, '01RD00233', 1.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(206, '01RD00233', 1.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(207, '01RD00262', 990.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(208, '01RD00262', 990.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(209, '01RD00275', 250.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(210, '01RD00275', 250.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(211, '01RD00174', 261.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(212, '01RD00174', 261.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(213, '01RD00179', 4200.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(214, '01RD00179', 4200.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(215, '01RD00180', 1200.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(216, '01RD00180', 1200.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(217, '01RD00185', 224.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(218, '01RD00185', 224.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(219, '01RD00184', 156.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(220, '01RD00184', 156.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(221, '01RD00101', 6.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(222, '01RD00101', 6.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(223, '01RD00102', 1.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(224, '01RD00102', 1.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 12:55:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(225, '01RD00117', 1.000, 'V0019', NULL, 0, 'sale', 14000, 14000, 0, NULL, '2022-05-23 12:14:11', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(226, '01RD00121', 2.000, 'V0019', NULL, 0, 'sale', 0, 0, 0, NULL, '2022-05-23 12:14:11', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(227, '01RD00230', 125.000, 'REQ00004/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 13:24:26', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(228, '01RD00158', 300.000, '11', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 13:33:08', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(229, '01RD00158', 300.000, '11', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 13:33:08', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(230, '01RD00157', 170.000, '11', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 13:33:08', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(231, '01RD00157', 170.000, '11', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 13:33:08', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(232, '0002-000309', 265.000, 'REQ00005/05/2022', NULL, 0, 'transfert_in', 500, 132500, NULL, NULL, '2022-05-23 13:59:01', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(233, '01RD00129', 4059.000, 'REQ00008/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:17:49', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(234, '01RD00237', 38.000, 'REQ00009/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:25:22', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(235, '01RD00136', 637.000, 'REQ00010/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:34:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(236, '01RD00212', 4248.000, 'REQ00011/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:42:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(237, '01RD00228', 130.000, 'REQ00012/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:48:55', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(238, '0002-000311', 24.000, 'REQ00013/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 14:56:42', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(239, '01RD00162', 152.000, 'REQ00014/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 16:36:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(240, '0002-000312', 30.000, 'REQ00015/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 16:36:38', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(241, '0002-000313', 4.000, 'REQ00015/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 16:36:38', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(242, '01RD00181', 1339.000, 'REQ00016/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 16:37:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(243, '01RD00180', 531.000, 'REQ00017/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 16:38:14', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(244, '0002-000314', 53.000, 'REQ00018/05/2022', NULL, 0, 'transfert_in', 4000, 212000, NULL, NULL, '2022-05-23 16:45:53', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(245, '01RD00159', 12.000, 'REQ00019/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-23 17:15:32', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(246, '01RD00230', 7.000, 'V0020', NULL, 0, 'sale', 36000, 252000, 0, NULL, '2022-05-23 13:21:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(247, '01RD00120', 1.000, 'V0020', NULL, 0, 'sale', 18000, 18000, 0, NULL, '2022-05-23 13:21:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(248, '01RD00117', 4.000, 'V0020', NULL, 0, 'sale', 14000, 56000, 0, NULL, '2022-05-23 13:21:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(249, '01RD00230', 10.000, 'V0021', NULL, 0, 'sale', 36000, 360000, 0, NULL, '2022-05-23 14:01:04', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(250, '01RD00087', 10.000, 'V0022', NULL, 0, 'sale', 37000, 370000, 0, NULL, '2022-05-23 14:05:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(251, '01RD00086', 4.000, 'V0022', NULL, 0, 'sale', 20000, 80000, 0, NULL, '2022-05-23 14:05:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(252, '01RD00290', 19.000, 'V0023', NULL, 0, 'sale', 68000, 1292000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(253, '01RD00002', 14.000, 'V0023', NULL, 0, 'sale', 27000, 378000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(254, '01RD00081', 16.000, 'V0023', NULL, 0, 'sale', 45000, 720000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(255, '01RD00079', 60.000, 'V0023', NULL, 0, 'sale', 28000, 1680000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(256, '01RD00014', 4.000, 'V0023', NULL, 0, 'sale', 45000, 180000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(257, '01RD00028', 6.000, 'V0023', NULL, 0, 'sale', 50000, 300000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(258, '01RD00146', 5.000, 'V0023', NULL, 0, 'sale', 68000, 340000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(259, '01RD00136', 14.000, 'V0023', NULL, 0, 'sale', 7000, 98000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(260, '01RD00117', 4.000, 'V0023', NULL, 0, 'sale', 14000, 56000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(261, '01RD00087', 7.000, 'V0024', NULL, 0, 'sale', 37000, 259000, 0, NULL, '2022-05-23 15:12:45', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(262, '01RD00093', 10.000, 'V0025', NULL, 0, 'sale', 37000, 370000, 0, NULL, '2022-05-23 15:18:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(263, '01RD00092', 5.000, 'V0025', NULL, 0, 'sale', 21000, 105000, 0, NULL, '2022-05-23 15:18:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(264, '01RD00091', 4.000, 'V0025', NULL, 0, 'sale', 12000, 48000, 0, NULL, '2022-05-23 15:18:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(265, '01RD00088', 50.000, 'V0026', NULL, 0, 'sale', 47000, 2350000, 0, NULL, '2022-05-23 15:29:59', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(266, '01RD00087', 100.000, 'V0026', NULL, 0, 'sale', 37000, 3700000, 0, NULL, '2022-05-23 15:29:59', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(267, '01RD00229', 5.000, 'V0027', NULL, 0, 'sale', 9000, 45000, 0, NULL, '2022-05-23 15:35:42', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(268, '01RD00088', 50.000, 'V0028', NULL, 0, 'sale', 47000, 2350000, 0, NULL, '2022-05-23 15:41:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(269, '01RD00087', 80.000, 'V0028', NULL, 0, 'sale', 37000, 2960000, 0, NULL, '2022-05-23 15:41:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(270, '01RD00290', 10.000, 'V0029', NULL, 0, 'sale', 66000, 660000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(271, '01RD00005', 10.000, 'V0029', NULL, 0, 'sale', 35000, 350000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(272, '01RD00002', 10.000, 'V0029', NULL, 0, 'sale', 17000, 170000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(273, '01RD00044', 2.000, 'V0029', NULL, 0, 'sale', 150000, 300000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(274, '01RD00055', 5.000, 'V0029', NULL, 0, 'sale', 150000, 750000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(275, '01RD00180', 3.000, 'V0029', NULL, 0, 'sale', 3000, 9000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(276, '01RD00181', 2.000, 'V0029', NULL, 0, 'sale', 2500, 5000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(277, '01RD00146', 1.000, 'V0029', NULL, 0, 'sale', 65000, 65000, 0, NULL, '2022-05-23 16:08:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(278, '01RD00120', 2.000, 'V0030', NULL, 0, 'sale', 180000, 360000, 0, NULL, '2022-05-24 08:35:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(279, '01RD00271', 6.000, 'V0031', NULL, 0, 'sale', 2700, 16200, 0, NULL, '2022-05-24 08:37:54', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(280, '01RD00034', 1.000, 'V0032', NULL, 0, 'sale', 62000, 62000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(281, '01RD00030', 4.000, 'V0032', NULL, 0, 'sale', 70000, 280000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(282, '01RD00040', 4.000, 'V0032', NULL, 0, 'sale', 55000, 220000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(283, '01RD00048', 1.000, 'V0032', NULL, 0, 'sale', 8000, 8000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(284, '01RD00036', 2.000, 'V0032', NULL, 0, 'sale', 33000, 66000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(285, '01RD00136', 2.000, 'V0032', NULL, 0, 'sale', 6000, 12000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(286, '01RD00094', 1.000, 'V0032', NULL, 0, 'sale', 48000, 48000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(287, '01RD00230', 20.000, 'V0032', NULL, 0, 'sale', 36000, 720000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(288, '01RD00109', 1.000, 'V0032', NULL, 0, 'sale', 5000, 5000, 0, NULL, '2022-05-24 09:16:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(289, '01RD00086', 2.000, 'V0033', NULL, 0, 'sale', 20000, 40000, 0, NULL, '2022-05-24 09:21:53', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(290, '01RD00042', 4.000, 'V0034', NULL, 0, 'sale', 85000, 340000, 0, NULL, '2022-05-24 09:34:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(291, '01RD00082', 2.000, 'V0035', NULL, 0, 'sale', 55000, 110000, 0, NULL, '2022-05-24 09:37:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(292, '01RD00117', 1.000, 'V0035', NULL, 0, 'sale', 14000, 14000, 0, NULL, '2022-05-24 09:37:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(293, '01RD00136', 1.000, 'V0035', NULL, 0, 'sale', 6000, 6000, 0, NULL, '2022-05-24 09:37:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(294, '01RD00089', 300.000, 'V0036', NULL, 0, 'sale', 75000, 22500000, 0, NULL, '2022-05-24 09:42:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(295, '01RD00086', 35.000, 'V0037', NULL, 0, 'sale', 20000, 700000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(296, '01RD00098', 500.000, 'V0037', NULL, 0, 'sale', 800, 400000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(297, '01RD00087', 6.000, 'V0037', NULL, 0, 'sale', 37000, 222000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(298, '01RD00097', 40.000, 'V0037', NULL, 0, 'sale', 1200, 48000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(299, '01RD00109', 6.000, 'V0037', NULL, 0, 'sale', 5000, 30000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(300, '01RD00107', 5.000, 'V0037', NULL, 0, 'sale', 5000, 25000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(301, '01RD00141', 1.000, 'V0037', NULL, 0, 'sale', 10000, 10000, 0, NULL, '2022-05-24 09:56:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(302, '01RD00066', 5.000, 'V0038', NULL, 0, 'sale', 50000, 250000, 0, NULL, '2022-05-24 09:57:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(303, '01RD00120', 20.000, 'V0039', NULL, 0, 'sale', 18000, 360000, 0, NULL, '2022-05-24 10:02:08', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(304, '01RD00230', 80.000, 'V0040', NULL, 0, 'sale', 36000, 2880000, 0, NULL, '2022-05-24 10:04:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(305, '01RD00028', 2.000, 'V0041', NULL, 0, 'sale', 46000, 92000, 0, NULL, '2022-05-24 10:14:41', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(306, '01RD00027', 1.000, 'V0041', NULL, 0, 'sale', 56000, 56000, 0, NULL, '2022-05-24 10:14:41', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(307, '01RD00087', 4.000, 'V0042', NULL, 0, 'sale', 37000, 148000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(308, '01RD00109', 3.000, 'V0042', NULL, 0, 'sale', 5000, 15000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(309, '01RD00107', 2.000, 'V0042', NULL, 0, 'sale', 5000, 10000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(310, '01RD00136', 2.000, 'V0042', NULL, 0, 'sale', 6000, 12000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(311, '01RD00117', 1.000, 'V0042', NULL, 0, 'sale', 14000, 14000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(312, '01RD00120', 1.000, 'V0042', NULL, 0, 'sale', 25000, 25000, 0, NULL, '2022-05-24 11:53:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(313, '01RD00250', 40.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(314, '01RD00250', 40.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(315, '01RD00252', 20.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(316, '01RD00252', 20.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(317, '01RD00253', 20.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(318, '01RD00253', 20.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(319, '01RD00255', 5.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(320, '01RD00255', 5.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(321, '01RD00256', 5.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(322, '01RD00256', 5.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:51:47', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(323, '01RD00221', 300.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(324, '01RD00221', 300.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(325, '01RD00222', 300.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(326, '01RD00222', 300.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(327, '01RD00226', 130.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(328, '01RD00226', 130.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(329, '01RD00229', 50.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(330, '01RD00229', 55.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(331, '01RD00230', 120.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(332, '01RD00230', 112.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-24 14:56:46', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(333, '01RD00005', 15.000, 'V0043', NULL, 0, 'sale', 27000, 405000, 0, NULL, '2022-05-24 12:10:55', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(334, '01RD00117', 1.000, 'V0044', NULL, 0, 'sale', 14000, 14000, 0, NULL, '2022-05-24 12:35:49', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(335, '01RD00136', 1.000, 'V0044', NULL, 0, 'sale', 6000, 6000, 0, NULL, '2022-05-24 12:35:49', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(336, '01RD00117', 3.000, 'V0045', NULL, 0, 'sale', 14000, 42000, 0, NULL, '2022-05-24 12:45:22', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(337, '01RD00049', 2.000, 'V0045', NULL, 0, 'sale', 9000, 18000, 0, NULL, '2022-05-24 12:45:22', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(338, '01RD00086', 28.000, 'V0046', NULL, 0, 'sale', 19500, 546000, 0, NULL, '2022-05-24 13:38:51', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(339, '01RD00028', 20.000, 'V0047', NULL, 0, 'sale', 46000, 920000, 0, NULL, '2022-05-24 14:17:12', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(340, '01RD00056', 8.000, 'REQ00020/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(341, '01RD00061', 12.000, 'REQ00020/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(342, '01RD00063', 2.000, 'REQ00020/05/2022', NULL, 0, 'transfert_in', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(343, '01RD00087', 10.000, 'V0048', NULL, 0, 'sale', 37000, 370000, 0, NULL, '2022-05-24 15:40:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(344, '01RD00086', 4.000, 'V0048', NULL, 0, 'sale', 20000, 80000, 0, NULL, '2022-05-24 15:40:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(345, '01RD00198', 1.000, 'V0049', NULL, 0, 'sale', 30000, 30000, 0, NULL, '2022-05-24 15:49:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pos_store_1_ibi_articles_stock_flow` (`ID_SF`, `REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`, `REF_SHIPPING_SF`, `SHIFT_ID_S`, `TYPE_SF`, `UNIT_PRICE_SF`, `TOTAL_PRICE_SF`, `REF_PROVIDER_SF`, `DESCRIPTION_SF`, `DATE_CREATION_SF`, `DATE_MOD_SF`, `CREATED_BY_SF`, `MODIFIED_BY_SF`, `DELETE_STATUS_SF`, `DELETE_DATE_SF`, `DELETE_BY_SF`, `DELETE_COMMENT_SF`, `ID_ARRIVAGE`) VALUES
(346, '01RD00198', 4.000, 'V0050', NULL, 0, 'sale', 30000, 120000, 0, NULL, '2022-05-24 15:51:22', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(347, '01RD00136', 50.000, 'V0051', NULL, 0, 'sale', 7080, 354000, 0, NULL, '2022-05-24 15:52:05', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(348, '01RD00061', 12.000, 'V0052', NULL, 0, 'sale', 600000, 7200000, 0, NULL, '2022-05-24 16:12:13', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(349, '01RD00056', 8.000, 'V0052', NULL, 0, 'sale', 205000, 1640000, 0, NULL, '2022-05-24 16:12:13', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(350, '01RD00063', 2.000, 'V0052', NULL, 0, 'sale', 850000, 1700000, 0, NULL, '2022-05-24 16:12:13', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(351, '01RD00057', 6.000, 'V0053', NULL, 0, 'sale', 200000, 1200000, 0, NULL, '2022-05-25 07:54:51', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(352, '01RD00275', 1.000, 'V0054', NULL, 0, 'sale', 2500, 2500, 0, NULL, '2022-05-25 07:57:29', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(353, '01RD00271', 2.000, 'V0055', NULL, 0, 'sale', 2700, 5400, 0, NULL, '2022-05-25 07:58:15', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(354, '01RD00275', 1.000, 'V0056', NULL, 0, 'sale', 2500, 2500, 0, NULL, '2022-05-25 07:58:44', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(355, '01RD00079', 20.000, 'V0057', NULL, 0, 'sale', 25000, 500000, 0, NULL, '2022-05-25 08:31:06', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(356, '01RD00117', 1.000, 'V0057', NULL, 0, 'sale', 14000, 14000, 0, NULL, '2022-05-25 08:31:06', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(357, '01RD00136', 1.000, 'V0057', NULL, 0, 'sale', 6000, 6000, 0, NULL, '2022-05-25 08:31:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(358, '01RD00230', 50.000, 'V0058', NULL, 0, 'sale', 36000, 1800000, 0, NULL, '2022-05-25 08:39:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(359, '01RD00182', 4.000, 'V0059', NULL, 0, 'sale', 120000, 480000, 0, NULL, '2022-05-25 08:44:25', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(360, '01RD00178', 4.000, 'V0059', NULL, 0, 'sale', 3500, 14000, 0, NULL, '2022-05-25 08:44:25', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(361, '01RD00179', 2.000, 'V0059', NULL, 0, 'sale', 2500, 5000, 0, NULL, '2022-05-25 08:44:25', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(362, '01RD00127', 3.000, 'V0059', NULL, 0, 'sale', 3500, 10500, 0, NULL, '2022-05-25 08:44:25', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(363, '01RD00042', 4.000, 'V0060', NULL, 0, 'sale', 85000, 340000, 0, NULL, '2022-05-25 11:27:29', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_categories`
--

CREATE TABLE `pos_store_1_ibi_categories` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) NOT NULL,
  `DESCRIPTION_CATEGORIE` text NOT NULL,
  `PARENT_REF_ID_CATEGORIE` int(11) NOT NULL,
  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
  `DATE_MOD_CATEGORIE` datetime NOT NULL,
  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
  `MODIFIED_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
  `DELETE_DATE_CATEGORIE` datetime NOT NULL,
  `DELETE_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_COMMENT_CATEGORIE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_commandes`
--

CREATE TABLE `pos_store_1_ibi_commandes` (
  `ID_HOSPITAL_IBI_COMMANDES` int(11) NOT NULL,
  `PAYER_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT '0',
  `VERIFICATION_SERVICE_FINANCIERE` int(11) DEFAULT '0',
  `TITRE` varchar(200) DEFAULT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `CODE` varchar(250) DEFAULT NULL,
  `PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT NULL,
  `SOMME_PERCU` float DEFAULT NULL,
  `TOTAL` float DEFAULT NULL,
  `DISCOUNT_TYPE` varchar(200) DEFAULT NULL,
  `TVA` float DEFAULT NULL,
  `DATE_CREATION_HOSPITAL_IBI_COMMANDES` datetime DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_HOSPITAL_IBI_COMMANDES` datetime DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT NULL,
  `MODIFIED_BY_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT NULL,
  `DELETED_DATE_HOSPITAL_IBI_COMMANDES` datetime DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT '0',
  `DELETED_USER_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT NULL,
  `DELETED_COMMENT_HOSPITAL_IBI_COMMANDES` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_commandes_produits`
--

CREATE TABLE `pos_store_1_ibi_commandes_produits` (
  `ID_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) NOT NULL,
  `HOSPITAL_IBI_COMMANDES_ID` int(11) DEFAULT NULL,
  `REF_PRODUCT_CODEBAR` varchar(250) DEFAULT NULL,
  `REF_COMMAND_CODE` varchar(250) DEFAULT NULL,
  `QUANTITE` float DEFAULT NULL,
  `PRIX` float DEFAULT NULL,
  `PRIX_CLIENT` float DEFAULT NULL,
  `PRIX_TOTAL` float DEFAULT NULL,
  `DISCOUNT_TYPE` varchar(200) DEFAULT NULL,
  `DISCOUNT_AMOUNT` float DEFAULT NULL,
  `DISCOUNT_PERCENT` float DEFAULT NULL,
  `NAME` varchar(200) DEFAULT NULL,
  `DOCTOR_ID` int(11) DEFAULT '0',
  `DEPARTMENT` varchar(300) DEFAULT '1000008',
  `VERIFICATION` int(11) DEFAULT '0',
  `VERIFIED_BY` int(11) DEFAULT NULL,
  `DATE_COMMANDE_PRODUITS` datetime DEFAULT NULL,
  `DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `MODIFIED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT '0',
  `DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS` varchar(300) DEFAULT NULL,
  `STORE_ID_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_inventaires`
--

CREATE TABLE `pos_store_1_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `STATUS_APPROV` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_1_ibi_inventaires`
--

INSERT INTO `pos_store_1_ibi_inventaires` (`ID_INVENTAIRE`, `TITRE_INVENTAIRE`, `DESCRIPTION_INVENTAIRE`, `VALUE_INVENTAIRE`, `ITEMS_INVENTAIRE`, `TYPE_INVENTAIRE`, `REF_PROVIDERS_INVENTAIRE`, `STATUS_APPROV`, `DATE_CREATION_INVENTAIRE`, `DATE_MOD_INVENTAIRE`, `CREATED_BY_INVENTAIRE`, `MODIFIED_BY_INVENTAIRE`, `DELETE_STATUS_INVENTAIRE`, `DELETE_DATE_INVENTAIRE`, `DELETE_BY_INVENTAIRE`, `DELETE_COMMENT_INVENTAIRE`) VALUES
(1, '19/05/2022', '', 0, 5151, '', 0, 1, '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(2, '19/05/2022', '', 0, 2593, '', 0, 1, '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(3, '19/05/2022', '', 0, -2975, '', 0, 1, '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(4, '19/05/2022', '', 0, 6482, '', 0, 1, '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(5, '19/05/2022', '', 0, 4427, '', 0, 1, '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(6, '20/05/2022', '', 0, 53, '', 0, 1, '2022-05-20 16:03:57', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(7, '21/05/2022', '', 0, 456, '', 0, 1, '2022-05-21 15:26:52', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(8, '23/05/2022', '', 0, 4686, '', 0, 1, '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(9, '23/05/2022', '', 0, 229, '', 0, 1, '2022-05-23 10:59:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(10, '23/05/2022', '', 189, 9565, '', 0, 1, '2022-05-23 11:42:48', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(11, '23/05/2022', '', 0, 470, '', 0, 1, '2022-05-23 13:32:52', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(12, '23/05/2022', '', 0, 90, '', 0, 1, '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(13, '23/05/2022', '', 3, 900, '', 0, 1, '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_inventaires_items`
--

CREATE TABLE `pos_store_1_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
  `PRIX_ACHAT_IVI` double DEFAULT NULL,
  `QUANTITY_THEORIQUE_IVI` float NOT NULL,
  `QUANTITY_PHYSIQUE_IVI` float NOT NULL,
  `DIFF` float NOT NULL,
  `REF_PROVIDER_IVI` int(11) NOT NULL,
  `REF_IVI` int(11) NOT NULL,
  `BARCODE_IVI` varchar(200) NOT NULL,
  `DATE_CREATION_IVI` datetime NOT NULL,
  `DATE_MOD_IVI` datetime NOT NULL,
  `CREATED_BY_IVI` int(11) NOT NULL,
  `MODIFIED_BY_IVI` int(11) NOT NULL,
  `DELETE_STATUS_IVI` int(11) NOT NULL,
  `DELETE_DATE_IVI` datetime NOT NULL,
  `DELETE_BY_IVI` int(11) NOT NULL,
  `DELETE_COMMENT_IVI` text,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_1_ibi_inventaires_items`
--

INSERT INTO `pos_store_1_ibi_inventaires_items` (`ID_IVI`, `DESIGN_IVI`, `PRIX_ACHAT_IVI`, `QUANTITY_THEORIQUE_IVI`, `QUANTITY_PHYSIQUE_IVI`, `DIFF`, `REF_PROVIDER_IVI`, `REF_IVI`, `BARCODE_IVI`, `DATE_CREATION_IVI`, `DATE_MOD_IVI`, `CREATED_BY_IVI`, `MODIFIED_BY_IVI`, `DELETE_STATUS_IVI`, `DELETE_DATE_IVI`, `DELETE_BY_IVI`, `DELETE_COMMENT_IVI`, `DATE_PEREMPTION`, `STATUS_VALIDATION`) VALUES
(1, '', 0, 0, 658, -658, 0, 1, '01RD00088', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(2, '', 0, 0, 687, -687, 0, 1, '01RD00087', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(3, '', 0, 0, 0, 0, 0, 1, '01RD00085', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(4, '', 0, 0, 560, -560, 0, 1, '01RD00091', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(5, '', 0, 0, 201, -201, 0, 1, '01RD00093', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(6, '', 0, 0, 490, -490, 0, 1, '01RD00092', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(7, '', 0, 0, 1481, -1481, 0, 1, '01RD00086', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(8, '', 0, 0, 121, -121, 0, 1, '01RD00094', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(9, '', 0, 0, 373, -373, 0, 1, '01RD00006', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(10, '', 0, 0, 65, -65, 0, 1, '01RD00010', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(11, '', 0, 0, 515, -515, 0, 1, '01RD00005', '2022-05-19 15:46:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(12, '', 0, 0, 18, -18, 0, 2, '01RD00009', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(13, '', 0, 0, 0, 0, 0, 2, '01RD00287', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(14, '', 0, 0, 159, -159, 0, 2, '01RD00003', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(15, '', 0, 0, 36, -36, 0, 2, '01RD00024', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(16, '', 0, 0, 368, -368, 0, 2, '01RD00002', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(17, '', 0, 0, 278, -278, 0, 2, '01RD00288', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(18, '', 12000, 0, 645, -645, 0, 2, '0002-000295', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(19, '', 0, 0, 42, -42, 0, 2, '01RD00026', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(20, '', 0, 0, 143, -143, 0, 2, '01RD00290', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(21, '', 0, 0, 157, -157, 0, 2, '01RD00289', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(22, '', 0, 0, 128, -128, 0, 2, '01RD00012', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(23, '', 0, 0, 44, -44, 0, 2, '01RD00018', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(24, '', 0, 0, 141, -141, 0, 2, '01RD00008', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(25, '', 0, 0, 135, -135, 0, 2, '01RD00007', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(26, '', 0, 0, 299, -299, 0, 2, '01RD00014', '2022-05-19 16:01:50', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(27, '', 0, 0, 18, -18, 0, 3, '01RD00009', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:05:13', 1, 'K', '', 0),
(28, '', 0, 0, 0, 0, 0, 3, '01RD00287', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:06:15', 1, 'H', '', 0),
(29, '', 0, 0, 159, -159, 0, 3, '01RD00003', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:06:23', 1, 'K', '', 0),
(30, '', 0, 0, 36, -36, 0, 3, '01RD00024', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:06:30', 1, 'L', '', 0),
(31, '', 0, 0, 368, -368, 0, 3, '01RD00002', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:06:45', 1, 'J', '', 0),
(32, '', 0, 0, 278, -278, 0, 3, '01RD00288', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:06:55', 1, 'K', '', 0),
(33, '', 12000, 0, 645, -645, 0, 3, '0002-000295', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:07:24', 1, 'L', '', 0),
(34, '', 0, 0, 42, -42, 0, 3, '01RD00026', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:07:34', 1, 'F', '', 0),
(35, '', 0, 0, 143, -143, 0, 3, '01RD00290', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:07:55', 1, 'K', '', 0),
(36, '', 0, 0, 157, -157, 0, 3, '01RD00289', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:08:01', 1, 'H', '', 0),
(37, '', 0, 0, 128, -128, 0, 3, '01RD00012', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:09:30', 1, 'K', '', 0),
(38, '', 0, 0, 44, -44, 0, 3, '01RD00018', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:08:13', 1, 'K', '', 0),
(39, '', 0, 0, 141, -141, 0, 3, '01RD00008', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:08:19', 1, 'K', '', 0),
(40, '', 0, 0, 135, -135, 0, 3, '01RD00007', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:08:23', 1, 'K', '', 0),
(41, '', 0, 0, 299, -299, 0, 3, '01RD00014', '2022-05-19 16:02:57', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-19 16:08:31', 1, 'K', '', 0),
(42, '', 0, 0, 0, 0, 0, 4, '01RD00033', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(43, '', 0, 0, 24, -24, 0, 4, '01RD00044', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(44, '', 0, 0, 16, -16, 0, 4, '01RD00232', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(45, '', 0, 0, 112, -112, 0, 4, '01RD00032', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(46, '', 0, 0, 43, -43, 0, 4, '01RD00046', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(47, '', 0, 0, 4670, -4670, 0, 4, '01RD00098', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(48, '', 0, 0, 1225, -1225, 0, 4, '01RD00097', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(49, '', 0, 0, 66, -66, 0, 4, '01RD00193', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(50, '', 0, 0, 102, -102, 0, 4, '01RD00035', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(51, '', 0, 0, 22, -22, 0, 4, '01RD00066', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(52, '', 0, 0, 8, -8, 0, 4, '01RD00070', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(53, '', 0, 0, 30, -30, 0, 4, '01RD00020', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(54, '', 0, 0, 57, -57, 0, 4, '01RD00022', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(55, '', 0, 0, 107, -107, 0, 4, '01RD00292', '2022-05-19 16:33:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(56, '', 0, 0, 62, -62, 0, 5, '01RD00015', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(57, '', 15000, 0, 355, -355, 0, 5, '01RD00001', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(58, '', 0, 0, 165, -165, 0, 5, '01RD00079', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(59, '', 0, 0, 7, -7, 0, 5, '01RD00291', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(60, '', 0, 0, 178, -178, 0, 5, '01RD00052', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(61, '', 0, 0, 272, -272, 0, 5, '01RD00027', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(62, '', 0, 0, 1000, -1000, 0, 5, '01RD00095', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(63, '', 0, 0, 2300, -2300, 0, 5, '01RD00096', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(64, '', 0, 0, 84, -84, 0, 5, '01RD00036', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(65, '', 0, 0, 3, -3, 0, 5, '01RD00072', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(66, '', 0, 0, 1, -1, 0, 5, '01RD00071', '2022-05-20 15:06:14', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(67, '', 5000, 0, 53, -53, 0, 6, '0002-000306', '2022-05-20 16:03:57', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(68, '', 400, 0, 265, -265, 0, 7, '0001-000310', '2022-05-21 15:26:52', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(69, '', 0, 0, 158, -158, 0, 7, '01RD00198', '2022-05-21 15:28:19', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(70, '', 0, 0, 33, -33, 0, 7, '01RD00117', '2022-05-21 15:28:19', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(71, '', 0, 0, 40, -40, 0, 8, '01RD00058', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(72, '', 0, 0, 35, -35, 0, 8, '01RD00055', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(73, '', 0, 0, 35, -35, 0, 8, '01RD00057', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(74, '', 0, 0, 29, -29, 0, 8, '01RD00059', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(75, '', 0, 0, 34, -34, 0, 8, '01RD00056', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(76, '', 0, 0, 321, -321, 0, 8, '01RD00120', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(77, '', 0, 0, 110, -110, 0, 8, '01RD00150', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(78, '', 0, 0, 90, -90, 0, 8, '01RD00148', '2022-05-23 09:36:13', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(79, '', 1, 0, 3200, -3200, 0, 8, '0001-000311', '2022-05-23 09:43:45', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(80, '', 0, 0, 229, -229, 0, 9, '01RD00121', '2022-05-23 10:59:05', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(81, '', 0, 0, 37, -37, 0, 8, '01RD00137', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(82, '', 0, 0, 16, -16, 0, 8, '01RD00113', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(83, '', 0, 0, 11, -11, 0, 8, '01RD00141', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(84, '', 0, 0, 10, -10, 0, 8, '01RD00286', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(85, '', 0, 0, 156, -156, 0, 8, '01RD00146', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(86, '', 0, 0, 24, -24, 0, 8, '01RD00145', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(87, '', 0, 0, 275, -275, 0, 8, '01RD00271', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(88, '', 0, 0, 4, -4, 0, 8, '01RD00119', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(89, '', 0, 0, 47, -47, 0, 8, '01RD00126', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(90, '', 0, 0, 41, -41, 0, 8, '01RD00127', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(91, '', 0, 0, 21, -21, 0, 8, '01RD00235', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(92, '', 0, 0, 150, -150, 0, 8, '01RD00106', '2022-05-23 11:26:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(93, '', 0, 0, 115, -115, 0, 10, '01RD00081', '2022-05-23 11:42:48', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(94, '', 0, 0, 150, -150, 0, 10, '01RD00082', '2022-05-23 11:42:48', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(95, '', 0, 0, 192, -192, 0, 10, '01RD00080', '2022-05-23 11:45:59', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(96, '', 0, 165, 135, 30, 0, 10, '01RD00079', '2022-05-23 11:45:59', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(97, '', 0, 0, 64, -64, 0, 10, '01RD00078', '2022-05-23 11:45:59', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(98, '', 0, 0, 64, -64, 0, 10, '01RD00043', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(99, '', 0, 24, 23, 1, 0, 10, '01RD00044', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(100, '', 0, 0, 149, -149, 0, 10, '01RD00041', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(101, '', 0, 0, 201, -201, 0, 10, '01RD00042', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(102, '', 0, 0, 95, -95, 0, 10, '01RD00040', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(103, '', 0, 0, 302, -302, 0, 10, '01RD00039', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(104, '', 0, 0, 186, -186, 0, 10, '01RD00038', '2022-05-23 11:56:44', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(105, '', 0, 0, 150, -150, 0, 10, '01RD00106', '2022-05-23 12:07:32', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(106, '', 0, 0, 25, -25, 0, 10, '01RD00107', '2022-05-23 12:07:32', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(107, '', 0, 0, 25, -25, 0, 10, '01RD00109', '2022-05-23 12:07:32', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(108, '', 0, 0, 1, -1, 0, 10, '01RD00233', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(109, '', 0, 0, 990, -990, 0, 10, '01RD00262', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(110, '', 0, 0, 250, -250, 0, 10, '01RD00275', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(111, '', 0, 0, 261, -261, 0, 10, '01RD00174', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(112, '', 0, 0, 4200, -4200, 0, 10, '01RD00179', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(113, '', 0, 0, 1200, -1200, 0, 10, '01RD00180', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(114, '', 0, 0, 224, -224, 0, 10, '01RD00185', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(115, '', 0, 0, 156, -156, 0, 10, '01RD00184', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(116, '', 0, 0, 6, -6, 0, 10, '01RD00101', '2022-05-23 12:38:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(117, '', 0, 0, 1, -1, 0, 10, '01RD00102', '2022-05-23 12:39:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(118, '', 0, 0, 300, -300, 0, 11, '01RD00158', '2022-05-23 13:32:52', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(119, '', 0, 0, 170, -170, 0, 11, '01RD00157', '2022-05-23 13:32:52', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(120, '', 0, 0, 40, -40, 0, 12, '01RD00250', '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(121, '', 0, 0, 20, -20, 0, 12, '01RD00252', '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(122, '', 0, 0, 20, -20, 0, 12, '01RD00253', '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(123, '', 0, 0, 5, -5, 0, 12, '01RD00255', '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(124, '', 900, 0, 5, -5, 0, 12, '01RD00256', '2022-05-24 14:51:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(125, '', 0, 0, 300, -300, 0, 13, '01RD00221', '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(126, '', 0, 0, 300, -300, 0, 13, '01RD00222', '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(127, '', 0, 0, 130, -130, 0, 13, '01RD00226', '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(128, '', 0, -5, 50, -55, 0, 13, '01RD00229', '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(129, '', 0, 8, 120, -112, 0, 13, '01RD00230', '2022-05-24 14:56:17', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_sortie`
--

CREATE TABLE `pos_store_1_ibi_sortie` (
  `ID_SORTIE` int(11) NOT NULL,
  `CODE_SORTIE` varchar(50) NOT NULL,
  `TITRE_SORTIE` varchar(255) NOT NULL,
  `DESCRIPTION_SORTIE` varchar(255) NOT NULL,
  `MONTANT_SORTIE` double NOT NULL,
  `QTE_ASORTIE` double NOT NULL,
  `STATUS_SORTIE` int(11) NOT NULL,
  `DESTINATION_SORTIE` int(11) NOT NULL,
  `DATE_CREATION_SORTIE` datetime NOT NULL,
  `DATE_MOD_SORTIE` datetime NOT NULL,
  `CREATED_BY_SORTIE` int(11) NOT NULL,
  `MODIFY_BY_SORTIE` int(11) NOT NULL,
  `DELETE_STATUS_SORTIE` int(11) NOT NULL,
  `DELETED_BY_SORTIE` int(11) NOT NULL,
  `DETEDE_DATE_SORTIE` datetime NOT NULL,
  `DELETE_COMMENT_SORTIE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_1_ibi_sortie`
--

INSERT INTO `pos_store_1_ibi_sortie` (`ID_SORTIE`, `CODE_SORTIE`, `TITRE_SORTIE`, `DESCRIPTION_SORTIE`, `MONTANT_SORTIE`, `QTE_ASORTIE`, `STATUS_SORTIE`, `DESTINATION_SORTIE`, `DATE_CREATION_SORTIE`, `DATE_MOD_SORTIE`, `CREATED_BY_SORTIE`, `MODIFY_BY_SORTIE`, `DELETE_STATUS_SORTIE`, `DELETED_BY_SORTIE`, `DETEDE_DATE_SORTIE`, `DELETE_COMMENT_SORTIE`) VALUES
(1, 'SORTIE00001/05/2022', '3', '', 500, 1, 0, 2, '2022-05-06 16:52:36', '0000-00-00 00:00:00', 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(2, 'SORTIE00002/05/2022', '3', '', 20998, 3, 0, 2, '2022-05-06 16:53:25', '0000-00-00 00:00:00', 1, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_1_ibi_sortie_items`
--

CREATE TABLE `pos_store_1_ibi_sortie_items` (
  `ID_SORTIE_ITM` int(11) NOT NULL,
  `REF_CODE_SORTIE` varchar(100) NOT NULL,
  `PRODUCT_NAME_SORTIE_ITM` varchar(255) NOT NULL,
  `QTE_SORTIE_ITM` int(11) NOT NULL,
  `PRIX_SORTIE_ITM` double NOT NULL,
  `PRIX_TOTAL_SORTIE_ITM` double NOT NULL,
  `REF_CODE_BAR_SORTIE_ITM` varchar(100) NOT NULL,
  `CREATED_BY_SORTIE_ITM` int(11) NOT NULL,
  `MODIFY_BY_SORTIE_ITM` int(11) NOT NULL,
  `DATE_CREATION_SORTIE_ITM` datetime NOT NULL,
  `DATE_MOD_SORTIE_ITM` datetime NOT NULL,
  `DELETED_BY_SORTIE_ITM` int(11) NOT NULL,
  `DELETED_COMMENT_SORTIE_ITM` varchar(255) NOT NULL,
  `DELETED_STATUS_SORTIE_ITM` int(11) NOT NULL,
  `DELETED_DATE_SORTIE_ITM` datetime NOT NULL,
  `TYPES` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_categorie_ingredient`
--

CREATE TABLE `pos_store_2_categorie_ingredient` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NAME_CATEGORIE` varchar(255) NOT NULL,
  `DESCRIPTION_CATEGORIE` varchar(255) NOT NULL,
  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
  `DATE_MOD_CATEGORIE` datetime NOT NULL,
  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
  `MODIFY_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
  `DELETED_BY_CATEGORIE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_arrivages`
--

CREATE TABLE `pos_store_2_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `MONTANT_PAYER_FOURNISSEUR` double DEFAULT NULL,
  `STATUS_ARRIVAGE` int(5) NOT NULL DEFAULT '0',
  `TYPE_ARRIVAGE` varchar(20) DEFAULT NULL,
  `TYPE_APPROVISIONNEMENT` varchar(100) NOT NULL,
  `ID_REQUISITION` int(11) DEFAULT NULL,
  `REF_PROVIDERS_ARRIVAGE` int(11) DEFAULT NULL,
  `DATE_CREATION_ARRIVAGE` datetime DEFAULT NULL,
  `DATE_MOD_ARRIVAGE` datetime DEFAULT NULL,
  `CREATED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARRIVAGE` int(11) NOT NULL,
  `DELETE_DATE_ARRIVAGE` datetime DEFAULT NULL,
  `DELETE_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARRIVAGE` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_articles`
--

CREATE TABLE `pos_store_2_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `REF_ID_FAMILLE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT '0',
  `PRIX_DACHAT_ARTICLE` float DEFAULT NULL,
  `PRIX_DE_REVIENS_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `RIX_VENTE_CLIENT_ARTICLE` int(10) DEFAULT '0',
  `PRIX_DE_VENTE_VIP_ARTICLE` decimal(10,0) NOT NULL DEFAULT '0',
  `TAILLE_ARTICLE` varchar(200) DEFAULT NULL,
  `POIDS_ARTICLE` varchar(200) DEFAULT NULL,
  `COULEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `HAUTEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `LARGEUR_ARTICLE` varchar(200) DEFAULT NULL,
  `APERCU_ARTICLE` varchar(200) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) DEFAULT NULL,
  `NOMBRE_UNITAIRE` int(11) NOT NULL DEFAULT '0',
  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT '0',
  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(200) DEFAULT NULL,
  `TRANSFORMER_BY` int(11) DEFAULT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` float DEFAULT '0',
  `STATUT_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) DEFAULT '0',
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT '0',
  `SEUIL_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `MARQUE` varchar(250) DEFAULT NULL,
  `REF_SOUS_CATEGORIE_ARTICLE` int(11) NOT NULL DEFAULT '0',
  `TAUX_DE_MARGE_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_VENTE_CLIENT_ARTICLE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_2_ibi_articles`
--

INSERT INTO `pos_store_2_ibi_articles` (`ID_ARTICLE`, `DESIGN_ARTICLE`, `TYPE_ARTICLE`, `NATURE_ARTICLE`, `CODEBAR_ARTICLE`, `REF_RAYON_ARTICLE`, `REF_CATEGORIE_ARTICLE`, `REF_ID_FAMILLE_ARTICLE`, `QUANTITY_ARTICLE`, `PRIX_DACHAT_ARTICLE`, `PRIX_DE_REVIENS_ARTICLE`, `PRIX_DE_VENTE_ARTICLE`, `RIX_VENTE_CLIENT_ARTICLE`, `PRIX_DE_VENTE_VIP_ARTICLE`, `TAILLE_ARTICLE`, `POIDS_ARTICLE`, `COULEUR_ARTICLE`, `HAUTEUR_ARTICLE`, `LARGEUR_ARTICLE`, `APERCU_ARTICLE`, `UNITE_ARTICLE`, `PRIX_PROMOTIONEL_ARTICLE`, `QTE_DECOUPAGE_ARTICLE`, `MARGE_ARTICLE`, `SPECIAL_PRICE_START_DATE_ARTICLE`, `SPECIAL_PRICE_END_DATE_ARTICLE`, `DESCRIPTION_ARTICLE`, `MINIMUM_QUANTITY_ARTICLE`, `ETAT_INGREDIENT_ARTICLE`, `NOMBRE_UNITAIRE`, `TYPE_INGREDIENT`, `NOMBRE_INGREDIENT_TRANSFORMER`, `TRANSFORMER_BY`, `APPROVISIONNER_ARTICLE_BY`, `ETAT_TVA`, `STATUT_ARTICLE`, `DATE_CREATION_ARTICLE`, `DATE_MOD_ARTICLE`, `CREATED_BY_ARTICLE`, `MODIFIED_BY_ARTICLE`, `DELETE_STATUS_ARTICLE`, `DELETE_DATE_ARTICLE`, `DELETE_BY_ARTICLE`, `DELETE_COMMENT_ARTICLE`, `STORE_ID_ARTICLE`, `IS_INGREDIENT`, `SEUIL_ARTICLE`, `MARQUE`, `REF_SOUS_CATEGORIE_ARTICLE`, `TAUX_DE_MARGE_ARTICLE`, `PRIX_VENTE_CLIENT_ARTICLE`) VALUES
(1, 'TUBE 16 x16  1er Q', 0, 0, '01RD00001', NULL, 18, 0, 8956, 15000, NULL, 17000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(2, 'TUBE 20x20 X 1mm 2eme Q', 0, NULL, '01RD00002', NULL, 18, NULL, 1525, NULL, NULL, 16000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(3, 'Tubes 25x25', 0, NULL, '01RD00003', NULL, 18, NULL, 0, NULL, NULL, 35000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(5, 'TUBE 30X30 X 1mm 2eme Q', 0, NULL, '01RD00005', NULL, 18, NULL, 371, NULL, NULL, 26000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(6, 'TUBE 40x40 x1mm 2eme Q', 0, NULL, '01RD00006', NULL, 18, NULL, 1495, NULL, NULL, 34000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(7, 'TUBE 40X40 X 1.2mm', 0, NULL, '01RD00007', NULL, 18, NULL, 2764, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(8, 'TUBE 40x40 X 1.5mm', 0, NULL, '01RD00008', NULL, 18, NULL, 983, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(9, 'TUBE 40x40 X 2MM', 0, NULL, '01RD00009', NULL, 18, NULL, 0, NULL, NULL, 110000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(10, 'TUBE 60 x 40 X 1mm 2eme Q', 0, NULL, '01RD00010', NULL, 18, NULL, 0, NULL, NULL, 43000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(11, 'TUBE 60X40 X 1.2mm', 0, NULL, '01RD00011', NULL, 18, NULL, 4488, NULL, NULL, 75000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(12, 'TUBE 60x40 X 1.5MM', 0, NULL, '01RD00012', NULL, 18, NULL, 2684, NULL, NULL, 107000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(13, 'TUBE 60x40 X 2mm', 0, NULL, '01RD00013', NULL, 18, NULL, 93, NULL, NULL, 120000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(14, 'TUBE 40X20 X 1 mm', 0, NULL, '01RD00014', NULL, 18, NULL, 432, NULL, NULL, 35000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(15, 'TUBE 40X25 X 1mm', 0, NULL, '01RD00015', NULL, 18, NULL, 0, NULL, NULL, 24000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(16, 'TUBE 50X25 X 1mm', 0, NULL, '01RD00016', NULL, 18, NULL, 0, NULL, NULL, 40000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(17, 'TUBE 50X50 X 1.5mm', 0, NULL, '01RD00017', NULL, 18, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(18, 'TUBE 50X50 X 2mm', 0, NULL, '01RD00018', NULL, 18, NULL, 57, NULL, NULL, 136000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(19, 'TUBE 80X40 X 1.5mm', 0, NULL, '01RD00019', NULL, 18, NULL, 0, NULL, NULL, 100000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(20, 'TUBE 80 x 40 X 2mm', 0, NULL, '01RD00020', NULL, 18, NULL, 595, NULL, NULL, 120000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(21, 'TUBE 60x60 X 1.5', 0, NULL, '01RD00021', NULL, 18, NULL, 0, NULL, NULL, 90000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(22, 'TUBE 60x60 X 2mm', 0, NULL, '01RD00022', NULL, 18, NULL, 641, NULL, NULL, 115000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(23, 'TUBE 75X50 X 2mm', 0, NULL, '01RD00023', NULL, 18, NULL, 108, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(24, 'TUBE 75X75 X 2mm', 0, NULL, '01RD00024', NULL, 18, NULL, 302, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(25, 'TUBE 100X50 X 2mm', 0, NULL, '01RD00025', NULL, 18, NULL, 0, NULL, NULL, 200000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(26, 'TUBE 100X100 X 3mm', 0, NULL, '01RD00026', NULL, 18, NULL, 72, NULL, NULL, 325000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(27, 'TUBE T', 0, NULL, '01RD00027', NULL, 18, NULL, 2523, NULL, NULL, 37000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(28, 'TUBE CORNIERE', 0, NULL, '01RD00028', NULL, 18, NULL, 2531, NULL, NULL, 40000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(29, 'PROFILE HS15 X 1mm', 0, NULL, '01RD00029', NULL, 19, NULL, 0, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(30, 'PROFILE HS14 X 1mm', 0, NULL, '01RD00030', NULL, 19, NULL, 1445, NULL, NULL, 62000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(31, 'PROFILE OMEGA HS 15 X 1mm', 0, NULL, '01RD00031', NULL, 19, NULL, 215, NULL, NULL, 50000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(32, 'PROFILE OMEGA HS 14 X 1mm', 0, NULL, '01RD00032', NULL, 19, NULL, 789, NULL, NULL, 47000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(33, 'PROFILE DEMI HS X 1mm', 0, NULL, '01RD00033', NULL, 19, NULL, 0, NULL, NULL, 47000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(34, 'PROFILE C 150X 1mm', 0, NULL, '01RD00034', NULL, 19, NULL, 899, NULL, NULL, 62000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(35, 'PROFILE BOUTEILLE X 1mm', 0, NULL, '01RD00035', NULL, 19, NULL, 549, NULL, NULL, 52000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(36, 'FER   TEE 20 X 3mm', 0, NULL, '01RD00036', NULL, 20, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(37, 'FER   TEE 25 X 3mm', 0, NULL, '01RD00037', NULL, 20, NULL, 0, NULL, NULL, 35000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(38, 'CORNIERE 20 X 3mm', 0, NULL, '01RD00038', NULL, 20, NULL, 49, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(39, 'CORNIERE 25 X 3mm', 0, NULL, '01RD00039', NULL, 20, NULL, 3637, NULL, NULL, 31000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(40, 'CORNIERE 30 X 3mm', 0, NULL, '01RD00040', NULL, 20, NULL, 126, NULL, NULL, 36000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(41, 'CORNIERE 40 X 3mm', 0, NULL, '01RD00041', NULL, 20, NULL, 68, NULL, NULL, 50000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(42, 'CORNIERE 40 X 4mm', 0, NULL, '01RD00042', NULL, 20, NULL, 186, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(43, 'FER   CORNIERE 50 X 3mm', 0, NULL, '01RD00043', NULL, 20, NULL, 0, NULL, NULL, 90000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(44, 'CORNIERE 50 X 4mm', 0, NULL, '01RD00044', NULL, 20, NULL, 0, NULL, NULL, 135000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(45, 'CORNIERE 65 X 6mm', 0, NULL, '01RD00045', NULL, 20, NULL, 0, NULL, NULL, 186000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(46, 'CORNIERE 75 X 6mm', 0, NULL, '01RD00046', NULL, 20, NULL, 130, NULL, NULL, 250000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(47, 'CORNIERE 100 X100 X 6mm', 0, NULL, '01RD00047', NULL, 20, NULL, 0, NULL, NULL, 280000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(48, 'FER  PLAT 16 X 3mm', 0, NULL, '01RD00048', NULL, 20, NULL, 9998, NULL, NULL, 8000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(49, 'FER   PLAT 20 X 3mm', 0, NULL, '01RD00049', NULL, 20, NULL, 16661, NULL, NULL, 9000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(50, 'FER   PLAT 25 X 3mm', 0, NULL, '01RD00050', NULL, 20, NULL, 4271, NULL, NULL, 13000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(51, 'FER   PLAT 30 X 3mm', 0, NULL, '01RD00051', NULL, 20, NULL, 99, NULL, NULL, 22000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(52, 'FER   PLAT 40 X 3mm', 0, NULL, '01RD00052', NULL, 20, NULL, 79, NULL, NULL, 24000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(53, 'TOLE  1mm', 0, NULL, '01RD00053', NULL, 21, NULL, 0, NULL, NULL, 70000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(54, 'TOLE 1.2mm', 0, NULL, '01RD00054', NULL, 21, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(55, 'TOLE 1.5mm', 0, NULL, '01RD00055', NULL, 21, NULL, 395, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(56, 'TOLE  2mm', 0, NULL, '01RD00056', NULL, 21, NULL, 56, NULL, NULL, 170000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(57, 'TOLE STD 1.2mm', 0, NULL, '01RD00057', NULL, 21, NULL, 1215, NULL, NULL, 125000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(58, 'TOLE STD 1.5mm', 0, NULL, '01RD00058', NULL, 21, NULL, 509, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(59, 'TOLE STD 2mm', 0, NULL, '01RD00059', NULL, 21, NULL, 119, NULL, NULL, 400000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(60, 'TOLE STD 3mm', 0, NULL, '01RD00060', NULL, 21, NULL, 165, NULL, NULL, 450000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(61, 'TOLE STD  4mm', 0, NULL, '01RD00061', NULL, 21, NULL, 92, NULL, NULL, 550000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(62, 'TOLE STD 5mm', 0, NULL, '01RD00062', NULL, 21, NULL, 170, NULL, NULL, 750000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(63, 'TOLE STD 6mm', 0, NULL, '01RD00063', NULL, 21, NULL, 88, NULL, NULL, 850000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(64, 'TOLE BG 28 NOIR', 0, NULL, '01RD00064', NULL, 21, NULL, 0, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(65, 'TOLE BG 32', 0, NULL, '01RD00065', NULL, 25, NULL, 0, NULL, NULL, 27000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(66, 'TUYAUX Galvanise 1/2', 0, NULL, '01RD00066', NULL, 22, NULL, 0, NULL, NULL, 50000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(67, 'TUYAUX Galvanise 1', 0, NULL, '01RD00067', NULL, 22, NULL, 250, NULL, NULL, 90000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(68, 'TUYAUX Galvanise 1   1/4', 0, NULL, '01RD00068', NULL, 22, NULL, 119, NULL, NULL, 120000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(69, 'TUYAUX Galvanise 1   1/2', 0, NULL, '01RD00069', NULL, 22, NULL, 69, NULL, NULL, 240000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(70, 'TUYAUX Galvanise 2', 0, NULL, '01RD00070', NULL, 22, NULL, 29, NULL, NULL, 260000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(71, 'TUYAUX Galvanise 2  1/2', 0, NULL, '01RD00071', NULL, 22, NULL, 0, NULL, NULL, 205000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(72, 'TUYAUX Galvanise 3', 0, NULL, '01RD00072', NULL, 22, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(73, 'TUYAUX Galvanise 3/4', 0, NULL, '01RD00073', NULL, 22, NULL, 49, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(74, 'TUYAUX Galvanise 4', 0, NULL, '01RD00074', NULL, 22, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(75, 'TUYAUX MOBILIER 16 X 1.2mm', 0, NULL, '01RD00075', NULL, 22, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(76, 'TUYAUX Mobilier 20 X 1mm 2eme Q', 0, NULL, '01RD00076', NULL, 22, NULL, 0, NULL, NULL, 13500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(78, 'TUYAUX MOBILIER 22 X 1mm', 0, NULL, '01RD00078', NULL, 22, NULL, 0, NULL, NULL, 22000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(79, 'TUYAUX MOBILIER 25 X 1 mm', 0, NULL, '01RD00079', NULL, 22, NULL, 0, NULL, NULL, 17000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(80, 'TUYAUX MOBILIER 32 X 1mm', 0, NULL, '01RD00080', NULL, 22, NULL, 314, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(81, 'TUYAUX MOBILIER 40 X 1mm', 0, NULL, '01RD00081', NULL, 22, NULL, 4458, NULL, NULL, 30000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(82, 'TUYAUX MOBILIER 50 X 1mm', 0, NULL, '01RD00082', NULL, 22, NULL, 3201, NULL, NULL, 40000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(83, 'TUYAUX MOBILIER 63 X 1.2mm', 0, NULL, '01RD00083', NULL, 22, NULL, 0, NULL, NULL, 80000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(84, 'TUYAUX MOBILIER 75 X 1.2mm', 0, NULL, '01RD00084', NULL, 22, NULL, 0, NULL, NULL, 150000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(85, 'FAB 6', 0, NULL, '01RD00085', NULL, 23, NULL, 0, NULL, NULL, 14000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(86, 'FAB 8', 0, 0, '01RD00086', NULL, 23, NULL, 13336, 0, NULL, 21000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(87, 'FAB 10', 0, 0, '01RD00087', NULL, 23, NULL, 6827, 0, NULL, 41000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(88, 'FAB 12', 0, 0, '01RD00088', NULL, 23, NULL, 1533, 0, NULL, 62000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(89, 'FAB 14', 0, NULL, '01RD00089', NULL, 23, NULL, 254, NULL, NULL, 51000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(90, 'FAB 16', 0, NULL, '01RD00090', NULL, 23, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(91, 'FAB 6 LISSE', 0, NULL, '01RD00091', NULL, 23, NULL, 0, NULL, NULL, 12000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(92, 'FAB 8 LISSE', 0, NULL, '01RD00092', NULL, 23, NULL, 0, NULL, NULL, 22000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(93, 'FAB 10 LISSE', 0, NULL, '01RD00093', NULL, 23, NULL, 2006, NULL, NULL, 37000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(94, 'FAB 12 LISSE', 0, NULL, '01RD00094', NULL, 23, NULL, 109, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(95, 'ETRIERS  X 15 X 35', 0, NULL, '01RD00095', NULL, 24, NULL, 1703, NULL, NULL, 1800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(96, 'ETRIERS  X 15 x 30', 0, NULL, '01RD00096', NULL, 24, NULL, 699, NULL, NULL, 1700, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(97, 'ETRIERS 15 x 25', 0, NULL, '01RD00097', NULL, 24, NULL, 42763, NULL, NULL, 1200, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(98, 'ETRIERS  15 x 15', 0, NULL, '01RD00098', NULL, 24, NULL, 25988, NULL, NULL, 800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(99, 'ETRIERS  X TRIANGLE', 0, NULL, '01RD00099', NULL, 24, NULL, 649, NULL, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(100, 'CLOUS  X Clous de 12 X Sac', 0, NULL, '01RD00100', NULL, 28, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(101, 'TREILLIS  MOYEN YEUX', 0, NULL, '01RD00101', NULL, 29, NULL, 0, NULL, NULL, 130000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(102, 'TREILLIS PETIT YEUX', 0, NULL, '01RD00102', NULL, 29, NULL, 0, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(103, 'FIL A LIGATURER  X  KG', 0, NULL, '01RD00103', NULL, 27, NULL, 0, NULL, NULL, 135000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(104, 'CLOUS de 3', 0, NULL, '01RD00104', NULL, 30, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(105, 'CLOUS de 4', 0, NULL, '01RD00105', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(106, 'CLOUS de 5', 0, NULL, '01RD00106', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(107, 'CLOUS de 6', 0, NULL, '01RD00107', NULL, 30, NULL, 0, NULL, NULL, 4500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(108, 'CLOUS de 8', 0, NULL, '01RD00108', NULL, 30, NULL, 0, NULL, NULL, 4500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(109, 'CLOUS de 10', 0, NULL, '01RD00109', NULL, 30, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(110, 'CLOUS de 12', 0, NULL, '01RD00110', NULL, 30, NULL, 0, NULL, NULL, 4000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(111, 'CLOUS de 16', 0, NULL, '01RD00111', NULL, 30, NULL, 0, NULL, NULL, 4000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(112, 'CLOUS DE TOLE', 0, NULL, '01RD00112', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(113, 'GAINE FLEXIBLE RLX', 0, NULL, '01RD00113', NULL, 30, NULL, 1018, NULL, NULL, 17000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(114, 'PLAFOND PVC', 0, NULL, '01RD00114', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(115, 'CORNIERE PLAFOND', 0, NULL, '01RD00115', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(117, 'BAGUETTE  2.5', 0, NULL, '01RD00117', NULL, 30, NULL, 0, NULL, NULL, 12000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(118, 'BAGUETTE  3.5', 0, NULL, '01RD00118', NULL, 30, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(119, 'BALANCE  30 Kg', 0, NULL, '01RD00119', NULL, 30, NULL, 0, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(120, 'BACHE  HEMA', 0, NULL, '01RD00120', NULL, 30, NULL, 142, NULL, NULL, 18000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(121, 'BOITE DE DERRIVATION', 0, NULL, '01RD00121', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(123, 'BOUCHON W.C SIEGE', 0, NULL, '01RD00123', NULL, 30, NULL, 0, NULL, NULL, 15000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(124, 'BROSS A SHAUX', 0, NULL, '01RD00124', NULL, 30, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(125, 'BROSS SIMPLE No 1', 0, NULL, '01RD00125', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(126, 'BROSS SIMPLE No 2', 0, NULL, '01RD00126', NULL, 30, NULL, 0, NULL, NULL, 1500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(127, 'BROSS  SIMPLE N0 3', 0, NULL, '01RD00127', NULL, 30, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(128, 'BROUETTE', 0, NULL, '01RD00128', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(129, 'CHEVILLE  NO 8', 0, NULL, '01RD00129', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(130, 'CHEVILLE NO 6', 0, NULL, '01RD00130', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(131, 'COLLE PATEX', 0, NULL, '01RD00131', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(132, 'COLLE TANGIT', 0, NULL, '01RD00132', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(133, 'COUTEAUX MASTIC', 0, NULL, '01RD00133', NULL, 30, NULL, 0, NULL, NULL, 1500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(134, 'DISQUE A MELLE PETIT MODEL', 0, NULL, '01RD00134', NULL, 30, NULL, 0, NULL, NULL, 10000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(135, 'DISQUE A MELER GRAND MODEL', 0, NULL, '01RD00135', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(136, 'DISQUE A COUPER', 0, NULL, '01RD00136', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(137, 'DOUILLE', 0, NULL, '01RD00137', NULL, 30, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(138, 'EVIER DOUBLE', 0, NULL, '01RD00138', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(139, 'FICELLE MACON GRAND MODEL', 0, NULL, '01RD00139', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(140, 'FILACE', 0, NULL, '01RD00140', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(141, 'HOUE', 0, NULL, '01RD00141', NULL, 30, NULL, 0, NULL, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(142, 'INDUIT MAKITA', 0, NULL, '01RD00142', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(143, 'LAME DE SCIE', 0, NULL, '01RD00143', NULL, 30, NULL, 0, NULL, NULL, 4000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(144, 'MACHETTE', 0, NULL, '01RD00144', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(145, 'MARTEAU CHARPENTIER ', 0, NULL, '01RD00145', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(146, 'MASTIC  DU FERT', 0, NULL, '01RD00146', NULL, 30, NULL, 0, NULL, NULL, 65000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(147, 'MECHE BETON 5', 0, NULL, '01RD00147', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(148, 'MECHE BETON 6', 0, NULL, '01RD00148', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(149, 'MECHE BETON 8', 0, NULL, '01RD00149', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(150, 'MECHE BETON 10', 0, NULL, '01RD00150', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(151, 'MECHE METALIC 3', 0, NULL, '01RD00151', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(152, 'MECHE METALIC  5', 0, NULL, '01RD00152', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(153, 'MECHE METALIC 4', 0, NULL, '01RD00153', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(154, 'MEULEUSE', 0, NULL, '01RD00154', NULL, 30, NULL, 0, NULL, NULL, 450000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(155, 'NESSANCE GOUTIER', 0, NULL, '01RD00155', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(156, 'PAPIER DISQUE NO 60', 0, 0, '01RD00156', NULL, 30, NULL, 11, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(157, 'PAPIER DISQUE NO 80', 0, 0, '01RD00157', NULL, 30, NULL, 41, 0, NULL, 1500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(158, 'PAPIER DISQUE NO 100', 0, 0, '01RD00158', NULL, 30, NULL, 100, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(159, 'PAPIER MELER EN METRE NO 60', 0, NULL, '01RD00159', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(160, 'PAPIER MELER EN METRE NO 80', 0, 0, '01RD00160', NULL, 30, NULL, 254, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(161, 'PAPIER MELER EN METRE NO 100', 0, 0, '01RD00161', NULL, 30, NULL, 300, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(162, 'PIOCHE 2.5', 0, NULL, '01RD00162', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(163, 'PELLE (beches)', 0, NULL, '01RD00163', NULL, 30, NULL, 0, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(164, 'POIGNET  A SOUDEUR', 0, NULL, '01RD00164', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(165, 'POMELLE DE 8', 0, NULL, '01RD00165', NULL, 30, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(166, 'POMELLE DE 10', 0, NULL, '01RD00166', NULL, 30, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(167, 'POMELLE DE 12', 0, NULL, '01RD00167', NULL, 30, NULL, 0, NULL, NULL, 3000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(168, 'PORTE NAKO 5', 0, NULL, '01RD00168', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(169, 'PORTE NAKO 6', 0, NULL, '01RD00169', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(170, 'PORTE NAKO 4', 0, NULL, '01RD00170', NULL, 30, NULL, 0, NULL, NULL, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(171, 'PORTE SCIE', 0, NULL, '01RD00171', NULL, 30, NULL, 0, NULL, NULL, 7000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(172, 'PPR DE 20', 0, NULL, '01RD00172', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(173, 'PPR DE 25', 0, NULL, '01RD00173', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(174, 'ROBINET  3/4', 0, NULL, '01RD00174', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL);
INSERT INTO `pos_store_2_ibi_articles` (`ID_ARTICLE`, `DESIGN_ARTICLE`, `TYPE_ARTICLE`, `NATURE_ARTICLE`, `CODEBAR_ARTICLE`, `REF_RAYON_ARTICLE`, `REF_CATEGORIE_ARTICLE`, `REF_ID_FAMILLE_ARTICLE`, `QUANTITY_ARTICLE`, `PRIX_DACHAT_ARTICLE`, `PRIX_DE_REVIENS_ARTICLE`, `PRIX_DE_VENTE_ARTICLE`, `RIX_VENTE_CLIENT_ARTICLE`, `PRIX_DE_VENTE_VIP_ARTICLE`, `TAILLE_ARTICLE`, `POIDS_ARTICLE`, `COULEUR_ARTICLE`, `HAUTEUR_ARTICLE`, `LARGEUR_ARTICLE`, `APERCU_ARTICLE`, `UNITE_ARTICLE`, `PRIX_PROMOTIONEL_ARTICLE`, `QTE_DECOUPAGE_ARTICLE`, `MARGE_ARTICLE`, `SPECIAL_PRICE_START_DATE_ARTICLE`, `SPECIAL_PRICE_END_DATE_ARTICLE`, `DESCRIPTION_ARTICLE`, `MINIMUM_QUANTITY_ARTICLE`, `ETAT_INGREDIENT_ARTICLE`, `NOMBRE_UNITAIRE`, `TYPE_INGREDIENT`, `NOMBRE_INGREDIENT_TRANSFORMER`, `TRANSFORMER_BY`, `APPROVISIONNER_ARTICLE_BY`, `ETAT_TVA`, `STATUT_ARTICLE`, `DATE_CREATION_ARTICLE`, `DATE_MOD_ARTICLE`, `CREATED_BY_ARTICLE`, `MODIFIED_BY_ARTICLE`, `DELETE_STATUS_ARTICLE`, `DELETE_DATE_ARTICLE`, `DELETE_BY_ARTICLE`, `DELETE_COMMENT_ARTICLE`, `STORE_ID_ARTICLE`, `IS_INGREDIENT`, `SEUIL_ARTICLE`, `MARQUE`, `REF_SOUS_CATEGORIE_ARTICLE`, `TAUX_DE_MARGE_ARTICLE`, `PRIX_VENTE_CLIENT_ARTICLE`) VALUES
(176, 'ROBINET LAVABEAUX', 0, NULL, '01RD00176', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(177, 'ROBINET MELANGEUR', 0, NULL, '01RD00177', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(178, 'ROULEAU A PEINTRE  GRAND MODEL', 0, NULL, '01RD00178', NULL, 30, NULL, 0, NULL, NULL, 4000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(179, 'ROULEAU A PEINTRE PETIT MODEL', 0, NULL, '01RD00179', NULL, 30, NULL, 60, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(180, 'ROULETTE GRAND MODEL', 0, NULL, '01RD00180', NULL, 30, NULL, 0, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(181, 'ROULETTE PETIT MODEL', 0, NULL, '01RD00181', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(182, 'SERRURE COMPLET', 0, NULL, '01RD00182', NULL, 30, NULL, 0, NULL, NULL, 120000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(183, 'SIPHON GRAND MODEL', 0, NULL, '01RD00183', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(184, 'TEFLON Petit model', 0, NULL, '01RD00184', NULL, 30, NULL, 0, NULL, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(185, 'TEFLON Grand model', 0, NULL, '01RD00185', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(188, 'V.O.B 1.5', 0, NULL, '01RD00188', NULL, 30, NULL, 0, NULL, NULL, 80000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(189, 'V.O.B 2.5', 0, NULL, '01RD00189', NULL, 30, NULL, 0, NULL, NULL, 115000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(190, 'VEROUX PETIT MODEL', 0, NULL, '01RD00190', NULL, 30, NULL, 0, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(191, 'VICE A BOIS', 0, NULL, '01RD00191', NULL, 30, NULL, 0, NULL, NULL, 100, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(192, 'VICE TOLES 1/4', 0, NULL, '01RD00192', NULL, 30, NULL, 0, NULL, NULL, 350, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(193, 'CORNIERE 50 x 6mm', 0, NULL, '01RD00193', NULL, 30, NULL, 616, NULL, NULL, 105000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(194, 'TUYAUX MOBILIER 60', 0, NULL, '01RD00194', NULL, 22, NULL, 0, NULL, NULL, 75000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(195, 'TOLE 0.8 STD', 0, NULL, '01RD00195', NULL, 21, NULL, 0, NULL, NULL, 115000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(196, 'GAINE FLEXIBLE BURUNDI', 0, NULL, '01RD00196', NULL, 22, NULL, 0, NULL, NULL, 28000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(197, 'FICELLE MACON PETIT MODEL', 0, 0, '01RD00197', NULL, 30, NULL, 100, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(198, 'ANTIROUILLE 4 LITRES', 0, NULL, '01RD00198', NULL, 0, NULL, 0, NULL, NULL, 30000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(199, 'VANNE 1     1/4', 0, NULL, '01RD00199', NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(200, 'VANNE 3/4', 0, NULL, '01RD00200', NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(201, 'VANNE 1/2', 0, NULL, '01RD00201', NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(202, 'BROSSE DE RUE', 0, NULL, '01RD00202', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(205, 'SCIE A BOIS', 0, NULL, '01RD00205', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(206, 'CHEVILLE GRAND MODEL', 0, NULL, '01RD00206', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(207, 'MECHE 3.5', 0, NULL, '01RD00207', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(208, 'CHEVILLE PETIT MODEL', 0, NULL, '01RD00208', NULL, 0, NULL, 0, NULL, NULL, 3000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(209, 'HACHE', 0, NULL, '01RD00209', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(210, 'MARTEAU DE MASSE 1KG', 0, NULL, '01RD00210', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(211, 'MACHON 1  1/2', 0, NULL, '01RD00211', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(212, 'DISQUE A MELLER ORGINAL', 0, NULL, '01RD00212', NULL, 0, NULL, 0, NULL, NULL, 12000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(213, 'DISQUE A MELLER SIMPLE', 0, NULL, '01RD00213', NULL, 0, NULL, 0, NULL, NULL, 10000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(214, 'CHARNIERE', 0, NULL, '01RD00214', NULL, 0, NULL, 0, NULL, NULL, 7000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(215, 'TE GALVANISE 1', 0, NULL, '01RD00215', NULL, 0, NULL, 0, NULL, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(216, 'COUDE 1/2', 0, NULL, '01RD00216', NULL, 0, NULL, 0, NULL, NULL, 500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(217, 'TE 1/2', 0, NULL, '01RD00217', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(218, 'BOUCHON 1/2', 0, NULL, '01RD00218', NULL, 0, NULL, 0, NULL, NULL, 15000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(219, 'MANCHON 1    1/2', 0, NULL, '01RD00219', NULL, 0, NULL, 0, NULL, NULL, 800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(220, 'REDUCTEUR GALVANISE 1/2', 0, NULL, '01RD00220', NULL, 0, NULL, 0, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(221, 'COUDE 1', 0, NULL, '01RD00221', NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(222, 'NIPLE 1/2', 0, NULL, '01RD00222', NULL, 0, NULL, 0, NULL, NULL, 1200, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(223, 'MACHON REDUCTEUR', 0, 0, '01RD00223', NULL, 30, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(224, 'MACHON 1', 0, 0, '01RD00224', NULL, 30, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(225, 'MACHON REDUCTEUR 1/2', 0, 0, '01RD00225', NULL, 30, NULL, 0, 0, NULL, 1, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(226, 'SCALITE', 0, 0, '01RD00226', NULL, 30, NULL, 0, 0, NULL, 4000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-24 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(228, 'PIGMANT', 0, NULL, '01RD00228', NULL, 30, NULL, 0, NULL, NULL, 9000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(229, 'ROOFING', 0, NULL, '01RD00229', NULL, 30, NULL, 73, NULL, NULL, 9000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(230, 'CIMENT DANGOTE', 0, NULL, '01RD00230', NULL, 30, NULL, 0, NULL, NULL, 38000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(231, 'FER U 120', 0, NULL, '01RD00231', NULL, 20, NULL, 0, NULL, NULL, 440000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(232, 'FER U 100', 0, NULL, '01RD00232', NULL, 20, NULL, 59, NULL, NULL, 490000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(233, 'CONCERTINANT', 0, NULL, '01RD00233', NULL, 30, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(234, 'PAPIER MELER EN METRE NO 120', 0, 0, '01RD00234', NULL, 30, NULL, 100, 0, NULL, 2500, 0, 0, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-23 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(235, 'CADENA PETIT', 0, NULL, '01RD00235', NULL, 30, NULL, 0, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(236, 'VICE PARCOEUR', 0, NULL, '01RD00236', NULL, 30, NULL, 0, NULL, NULL, 50, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(237, 'CHEVILLE N0 10', 0, NULL, '01RD00237', NULL, 30, NULL, 0, NULL, NULL, 3000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(238, 'CYLCONE', 0, NULL, '01RD00238', NULL, 30, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(239, 'FIL GALVANISER', 0, NULL, '01RD00239', NULL, 30, NULL, 14, NULL, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(240, 'TOLE 5 mm', 0, NULL, '01RD00240', NULL, 21, NULL, 0, NULL, NULL, 750000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(242, 'TOLE BG 28 ROUGE', 0, NULL, '01RD00241', NULL, 21, NULL, 0, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(243, 'FETIERE (mireko)', 0, NULL, '01RD00242', NULL, 21, NULL, 0, NULL, NULL, 19000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(244, 'COUDE 3/4', 0, NULL, '01RD00243', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(245, 'SIPHON DU SOL', 0, NULL, '01RD00244', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(246, 'RACCORD UNION', 0, NULL, '01RD00245', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(247, 'RACCORD UNION', 0, NULL, '01RD00246', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(248, 'TOLE STD 8mm', 0, NULL, '01RD00247', NULL, 21, NULL, 19, NULL, NULL, 1350000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(249, 'BAC DE DOUCHE', 0, NULL, '01RD00248', NULL, 30, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(251, 'PAPIER MELER EN METRE NO 150', 0, NULL, '01RD00250', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(252, 'PAPIER MELER EN METRE NO 150', 0, NULL, '01RD00251', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(253, 'PAPIER MELER EN METRE NO 240', 0, NULL, '01RD00252', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(254, 'PAPIER MELER EN METRE NO 600', 0, NULL, '01RD00253', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(255, 'TOLE TRANSPARENT', 0, NULL, '01RD00254', NULL, 21, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(256, 'BROSS METALIC', 0, NULL, '01RD00255', NULL, 0, NULL, 0, NULL, NULL, 2000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(257, 'BROSS SIMPLE No 4', 0, NULL, '01RD00256', NULL, 23, NULL, 0, 900, NULL, 3500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(258, 'TOLE BG 28 BLANC', 0, NULL, '01RD00257', NULL, 24, NULL, 0, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(259, 'TOLE STD X 10 MM', 0, NULL, '01RD00258', NULL, 21, NULL, 1, NULL, NULL, 1500000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(260, 'TOLE GALVANISE', 0, NULL, '01RD00259', NULL, 21, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(261, 'CLOU A BETON', 0, NULL, '01RD00260', NULL, 28, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(262, 'KUKU NETTE', 0, NULL, '01RD00261', NULL, 30, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(263, 'CROCHET', 0, NULL, '01RD00262', NULL, 30, NULL, 0, NULL, NULL, 300, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(264, 'TOLE CRENELE 3mm', 0, NULL, '01RD00263', NULL, 21, NULL, 0, NULL, NULL, 350000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(265, 'ETRIER 15 X 45', 0, NULL, '01RD00264', NULL, 24, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(266, 'TOLE CRENEIE DE 8 MM', 0, NULL, '01RD00265', NULL, 21, NULL, 0, NULL, NULL, 440000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(267, 'TOLE 3 MM', 0, NULL, '01RD00266', NULL, 21, NULL, 0, NULL, NULL, 140000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(268, 'ANTIROUILLE 1 LITRE', 0, NULL, '01RD00267', NULL, 30, NULL, 0, NULL, NULL, 8000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(269, 'EVIER SIMPLE', 0, NULL, '01RD00268', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(270, 'PAPIER MELER EN METRE NO 220', 0, NULL, '01RD00269', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(271, 'PAPIER MELER EN METRE NO 320', 0, NULL, '01RD00270', NULL, 30, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(272, 'BALAI', 0, NULL, '01RD00271', NULL, 30, NULL, 0, NULL, NULL, 2500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(274, 'TENTE', 0, NULL, '01RD00273', NULL, 30, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(275, 'GOUTTIERE', 0, NULL, '01RD00274', NULL, 21, NULL, 0, NULL, NULL, 11000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(276, 'RACLETTE', 0, NULL, '01RD00275', NULL, 30, NULL, 799, NULL, NULL, 250, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(277, 'ETRIERS 20 x 25', 0, NULL, '01RD00276', NULL, 30, NULL, 599, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(278, 'ETRIERS 20 x 20', 0, NULL, '01RD00277', NULL, 30, NULL, 0, NULL, NULL, 900, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(279, 'ETRIERS 15 x 45', 0, NULL, '01RD00278', NULL, 30, NULL, 242, NULL, NULL, 1200, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(280, 'ETRIERS 15 x 20', 0, NULL, '01RD00279', NULL, 30, NULL, 14, NULL, NULL, 800, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(281, 'CLOUS 15', 0, NULL, '01RD00280', NULL, 28, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(282, 'TREILLIS GRQND YEUX 1.5', 0, NULL, '01RD00281', NULL, 30, NULL, 54, NULL, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(283, 'ETRIERS 25 X 25', 0, NULL, '01RD00282', NULL, 30, NULL, 214, NULL, NULL, 1300, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(284, 'Test', 0, NULL, '01RD00283', NULL, 18, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-18 11:19:04', 1, 'ujju', 2, 0, 0, NULL, 0, NULL, NULL),
(285, 'TOLE BG 28 CHOCOLAT', 0, NULL, '01RD00284', NULL, 21, NULL, 0, NULL, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(286, 'PAPIER MELER N0 400', 0, NULL, '01RD00285', NULL, 30, NULL, 0, NULL, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(287, 'MACHINE CARREAUX', 0, NULL, '01RD00286', NULL, 30, NULL, 0, NULL, NULL, 85000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(288, 'TUBE 30 X 30 X 1mm 1er Q', 0, NULL, '01RD00287', NULL, 18, NULL, 0, NULL, NULL, 30000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(289, 'TUBE 20x20  x 1mm 1ere Q', 0, NULL, '01RD00288', NULL, 18, NULL, 6695, NULL, NULL, 23000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(290, 'TUBE 40x40 x 1mm 1er Q', 0, NULL, '01RD00289', NULL, 18, NULL, 1380, NULL, NULL, 53000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(291, 'TUBE 60x40x1mm 1er Q', 0, 0, '01RD00290', NULL, 18, NULL, 199, 0, NULL, 66000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, '2022-05-25 00:00:00', NULL, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(292, 'TUYAUX MOBILIER 20 x 1mm 1er Q', 0, NULL, '01RD00291', NULL, 22, NULL, 0, NULL, NULL, 16000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(293, 'TUBE 50X25 1.2 MM', 0, NULL, '01RD00292', NULL, 18, NULL, 0, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(294, 'TUYAUX MOBILIER 20 X 1.2 MM', 0, NULL, '01RD00293', NULL, 22, NULL, 0, NULL, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(296, 'Huile d_Emananael', 0, NULL, NULL, NULL, 22, NULL, 0, 1300, NULL, 1300, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1, '2022-05-18 11:54:29', 1, 'ont itilise plus ', 2, 0, 0, NULL, 0, NULL, NULL),
(300, 'TUBE 16X16  2e Q', 0, 0, '0002-000295', 18, 18, NULL, 1156, 12000, NULL, 14000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 12:05:51', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(301, 'TUBE 25 X 25', 0, 0, '0002-000301', NULL, 18, NULL, 0, 12000, NULL, 25000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:53', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(302, 'TREILLIS GRAND YEUX 1.5', 0, 0, '0002-000302', NULL, 18, NULL, 0, 50000, NULL, 60000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:51', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(303, 'FIL GALVANISE MOYEN ', 0, 0, '0002-000303', NULL, 27, NULL, 0, 4000, NULL, 6000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:41', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(304, 'FIL GALVANISE PETIT', 0, 0, '0002-000304', NULL, 27, NULL, 0, 4000, NULL, 5000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Kg', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:19', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(305, 'TREILLIS GRAND YEUX 1,2', 0, 0, '0002-000305', NULL, 18, NULL, 399, 42000, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:23', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(306, 'FAB 4 LISSE', 0, 0, '0002-000306', NULL, 23, NULL, 53, 5000, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-19 02:05:24', '2022-05-23 00:00:00', 1, 1, 1, '2022-05-23 16:39:24', 1, 'G', 2, 0, 0, NULL, 0, NULL, NULL),
(307, 'TREILLIS GRAND YEUX 1,2', 0, 0, '0002-000307', NULL, 18, NULL, 0, 42000, NULL, 58000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-19 02:05:58', NULL, 1, NULL, 1, '2022-05-19 14:48:32', 1, 'OUI', 2, 0, 0, NULL, 0, NULL, NULL),
(308, 'FAB 4 LISSE', 0, 0, '0002-000306', NULL, 23, NULL, 53, 5000, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, 0, '2022-05-20 03:05:35', '2022-05-23 00:00:00', 1, 1, 1, '2022-05-23 16:39:24', 1, 'G', 2, 0, 0, NULL, 0, NULL, NULL),
(309, 'BOITE ENCASTREMENT', 0, 0, '0002-000309', NULL, 18, NULL, 0, 500, NULL, 1000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-23 11:05:11', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(310, 'ROBINET DU COEUR', 0, 0, '0002-000310', NULL, 18, NULL, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-23 02:05:38', NULL, 1, NULL, 1, '2022-05-23 14:03:56', 1, 'H', 2, 0, 0, NULL, 0, NULL, NULL),
(311, 'ROBINET DU COEUR', 0, 0, '0002-000311', NULL, 18, NULL, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-23 02:05:38', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(312, 'BROSSE ISHWAGARA', 0, 0, '0002-000312', NULL, 30, NULL, 0, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, '2022-05-23 03:05:30', '2022-05-24 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(313, 'TUY D\'ARROSAGE', 0, 0, '0002-000313', NULL, 22, NULL, 0, 0, NULL, 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, '2022-05-23 03:05:08', '2022-05-23 00:00:00', 1, 1, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL),
(314, 'FAB 4 LISSE', 0, 0, '0002-000314', NULL, 23, NULL, 0, 4000, NULL, 7000, 0, 0, NULL, '', NULL, NULL, NULL, NULL, 'Pieces', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, '/', NULL, NULL, 1, 0, '2022-05-23 04:05:12', NULL, 1, NULL, 0, NULL, NULL, NULL, 2, 0, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_articles_stock_flow`
--

CREATE TABLE `pos_store_2_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT '0',
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_2_ibi_articles_stock_flow`
--

INSERT INTO `pos_store_2_ibi_articles_stock_flow` (`ID_SF`, `REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`, `REF_SHIPPING_SF`, `SHIFT_ID_S`, `TYPE_SF`, `UNIT_PRICE_SF`, `TOTAL_PRICE_SF`, `REF_PROVIDER_SF`, `DESCRIPTION_SF`, `DATE_CREATION_SF`, `DATE_MOD_SF`, `CREATED_BY_SF`, `MODIFIED_BY_SF`, `DELETE_STATUS_SF`, `DELETE_DATE_SF`, `DELETE_BY_SF`, `DELETE_COMMENT_SF`, `ID_ARRIVAGE`) VALUES
(1, '0002-000295', 1161.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '0002-000295', 1161.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '01RD00001', 9256.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '01RD00001', 8256.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '01RD00002', 1525.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '01RD00002', 525.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '01RD00288', 6695.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '01RD00288', 5695.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '01RD00005', 371.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '01RD00005', 629.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '01RD00014', 432.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '01RD00014', 568.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '01RD00015', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '01RD00015', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '01RD00006', 1495.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '01RD00006', 495.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '01RD00289', 1380.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '01RD00289', 380.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '01RD00007', 2764.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '01RD00007', 1764.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '01RD00008', 983.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '01RD00008', 17.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '01RD00009', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '01RD00009', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '01RD00016', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '01RD00016', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '01RD00017', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '01RD00017', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '01RD00018', 57.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '01RD00018', 943.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '01RD00010', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '01RD00010', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(33, '01RD00290', 399.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(34, '01RD00290', 571.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '01RD00011', 4488.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(36, '01RD00011', 3488.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '01RD00012', 2684.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, '01RD00012', 1684.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, '01RD00013', 93.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '01RD00013', 907.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(41, '01RD00021', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(42, '01RD00021', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(43, '01RD00022', 641.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(44, '01RD00022', 359.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, '01RD00023', 108.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, '01RD00023', 892.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(47, '01RD00024', 302.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(48, '01RD00024', 698.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(49, '01RD00020', 595.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(50, '01RD00020', 405.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(51, '01RD00026', 72.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(52, '01RD00026', 928.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(53, '01RD00028', 2531.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(54, '01RD00028', 1531.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '01RD00027', 2523.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(56, '01RD00027', 1523.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(57, '01RD00033', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(58, '01RD00033', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '01RD00030', 1445.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(60, '01RD00030', 445.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(61, '01RD00029', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(62, '01RD00029', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(63, '01RD00032', 789.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(64, '01RD00032', 211.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(65, '01RD00031', 215.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(66, '01RD00031', 785.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(67, '01RD00034', 899.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(68, '01RD00034', 101.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '01RD00035', 549.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '01RD00035', 451.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '01RD00038', 49.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(72, '01RD00038', 951.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(73, '01RD00039', 3637.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '01RD00039', 2637.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(75, '01RD00040', 126.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '01RD00040', 874.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(77, '01RD00041', 68.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(78, '01RD00041', 932.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(79, '01RD00042', 186.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(80, '01RD00042', 814.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(81, '01RD00044', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(82, '01RD00044', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(83, '01RD00193', 616.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(84, '01RD00193', 384.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(85, '01RD00045', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(86, '01RD00045', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(87, '01RD00046', 130.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(88, '01RD00046', 870.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(89, '01RD00036', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(90, '01RD00036', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '01RD00037', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(92, '01RD00037', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(93, '01RD00232', 59.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(94, '01RD00232', 941.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(95, '01RD00231', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(96, '01RD00231', 1000.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(97, '01RD00048', 9998.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(98, '01RD00048', 8998.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(99, '01RD00049', 16661.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(100, '01RD00049', 15661.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(101, '01RD00050', 4271.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(102, '01RD00050', 3271.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(103, '01RD00051', 99.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(104, '01RD00051', 901.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(105, '01RD00052', 79.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(106, '01RD00052', 921.000, '1', NULL, 0, 'inventory_perte', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(107, '01RD00293', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(108, '01RD00078', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(109, '01RD00079', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(110, '01RD00080', 314.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(111, '01RD00080', 314.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(112, '01RD00081', 4458.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(113, '01RD00081', 4458.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(114, '01RD00082', 3201.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(115, '01RD00082', 3201.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(116, '01RD00194', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(117, '01RD00066', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(118, '01RD00073', 49.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(119, '01RD00073', 49.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(120, '01RD00067', 250.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(121, '01RD00067', 250.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(122, '01RD00069', 69.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(123, '01RD00069', 69.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(124, '01RD00068', 119.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(125, '01RD00068', 119.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(126, '01RD00070', 29.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(127, '01RD00070', 29.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(128, '01RD00071', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(129, '01RD00053', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(130, '01RD00054', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(131, '01RD00055', 395.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(132, '01RD00055', 395.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(133, '01RD00056', 64.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(134, '01RD00056', 64.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(135, '01RD00057', 1215.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(136, '01RD00057', 1215.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(137, '01RD00058', 509.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(138, '01RD00058', 509.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(139, '01RD00059', 119.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(140, '01RD00059', 119.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(141, '01RD00060', 165.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(142, '01RD00060', 165.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(143, '01RD00061', 104.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(144, '01RD00061', 104.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(145, '01RD00062', 170.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(146, '01RD00062', 170.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(147, '01RD00063', 90.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(148, '01RD00063', 90.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(149, '01RD00247', 19.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(150, '01RD00247', 19.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(151, '01RD00258', 1.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(152, '01RD00258', 1.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(153, '01RD00263', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(154, '01RD00102', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(155, '01RD00281', 54.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(156, '01RD00281', 54.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(157, '01RD00086', 13476.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(158, '01RD00086', 13476.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(159, '01RD00093', 2006.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(160, '01RD00093', 2006.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(161, '01RD00087', 7367.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(162, '01RD00087', 7367.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(163, '01RD00094', 109.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(164, '01RD00094', 109.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(165, '01RD00088', 1721.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(166, '01RD00088', 1721.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(167, '01RD00089', 254.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(168, '01RD00089', 254.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(169, '01RD00090', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(170, '01RD00098', 25988.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(171, '01RD00098', 25988.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(172, '01RD00279', 14.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(173, '01RD00279', 14.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(174, '01RD00097', 42763.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(175, '01RD00097', 42763.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(176, '01RD00096', 699.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(177, '01RD00096', 699.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(178, '01RD00095', 1703.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(179, '01RD00095', 1703.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(180, '01RD00278', 242.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(181, '01RD00278', 242.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(182, '01RD00277', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(183, '01RD00276', 599.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(184, '01RD00276', 599.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(185, '01RD00282', 214.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(186, '01RD00282', 214.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(187, '01RD00099', 649.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(188, '01RD00099', 649.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(189, '01RD00109', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(190, '01RD00110', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(191, '01RD00103', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(192, '01RD00120', 142.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(193, '01RD00120', 142.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(194, '01RD00229', 73.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(195, '01RD00229', 73.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(196, '01RD00239', 14.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(197, '01RD00239', 14.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(198, '01RD00113', 1018.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(199, '01RD00113', 1018.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(200, '01RD00233', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(201, '01RD00271', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(202, '01RD00230', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(203, '01RD00275', 799.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(204, '01RD00275', 799.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(205, '01RD00179', 60.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(206, '01RD00179', 60.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(207, '01RD00178', 0.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(208, '0002-000305', 399.000, '1', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(209, '0002-000305', 399.000, '1', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-20 17:20:56', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(210, '0002-000306', 53.000, '2', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-21 12:46:13', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(211, '0002-000306', 53.000, '2', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-21 12:46:13', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(212, '0002-000306', 53.000, 'REQ00002/05/2022', NULL, 0, 'transfert_out', 5000, 265000, NULL, NULL, '2022-05-21 14:05:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(213, '0002-000306', 2.000, 'REQ00002/05/2022', NULL, 0, 'transfert_in', 5000, 10000, NULL, NULL, '2022-05-21 14:56:43', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(214, '0002-000306', 2.000, 'REQ00003/05/2022', NULL, 0, 'transfert_out', 5000, 10000, NULL, NULL, '2022-05-21 15:15:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(215, '0002-000309', 265.000, '3', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 13:04:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(216, '0002-000309', 265.000, '3', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 13:04:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(217, '01RD00230', 125.000, '4', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 13:18:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(218, '01RD00230', 125.000, '4', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 13:18:27', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(219, '01RD00230', 125.000, 'REQ00004/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 13:24:26', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(220, '0002-000309', 265.000, '5', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 13:56:43', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(221, '0002-000309', 265.000, 'REQ00005/05/2022', NULL, 0, 'transfert_out', 500, 132500, NULL, NULL, '2022-05-23 13:59:01', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(222, '01RD00129', 4059.000, '6', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:01:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(223, '01RD00129', 4059.000, '6', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:01:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(224, '01RD00129', 4059.000, 'REQ00008/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:17:49', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(225, '0002-000311', 24.000, '7', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:21:42', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(226, '0002-000311', 24.000, '7', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:21:42', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(227, '01RD00237', 38.000, '8', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:22:23', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(228, '01RD00237', 38.000, '8', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:22:23', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(229, '01RD00237', 38.000, 'REQ00009/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:25:22', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(230, '01RD00136', 637.000, '9', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:27:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(231, '01RD00136', 637.000, '9', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:27:58', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(232, '01RD00136', 637.000, 'REQ00010/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:34:20', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(233, '01RD00212', 4248.000, '10', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:38:32', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(234, '01RD00212', 4248.000, '10', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:38:32', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(235, '01RD00212', 4248.000, 'REQ00011/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:42:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(236, '01RD00228', 130.000, '11', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:44:57', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(237, '01RD00228', 130.000, '11', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:44:57', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(238, '01RD00228', 130.000, 'REQ00012/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:48:55', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(239, '01RD00162', 152.000, '12', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 14:52:43', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(240, '01RD00162', 152.000, '12', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 14:52:43', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(241, '0002-000311', 24.000, 'REQ00013/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 14:56:42', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(242, '01RD00180', 531.000, '14', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 16:22:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(243, '01RD00180', 531.000, '14', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 16:22:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(244, '01RD00181', 1339.000, '14', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 16:22:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(245, '01RD00181', 1339.000, '14', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 16:22:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(246, '0002-000312', 30.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 16:22:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(247, '0002-000312', 30.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 16:22:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(248, '0002-000313', 4.000, '13', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 16:22:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(249, '0002-000313', 4.000, '13', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 16:22:50', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(250, '01RD00162', 152.000, 'REQ00014/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 16:36:02', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(251, '0002-000312', 30.000, 'REQ00015/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 16:36:38', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(252, '0002-000313', 4.000, 'REQ00015/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 16:36:38', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(253, '01RD00181', 1339.000, 'REQ00016/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 16:37:31', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(254, '01RD00180', 531.000, 'REQ00017/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 16:38:14', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(255, '0002-000314', 53.000, 'REQ00018/05/2022', NULL, 0, 'transfert_out', 4000, 212000, NULL, NULL, '2022-05-23 16:45:53', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(256, '01RD00159', 12.000, '15', NULL, 0, 'inventory', NULL, NULL, NULL, NULL, '2022-05-23 17:11:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(257, '01RD00159', 12.000, '15', NULL, 0, 'inventory_excedent', NULL, NULL, NULL, NULL, '2022-05-23 17:11:24', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(258, '01RD00159', 12.000, 'REQ00019/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-23 17:15:32', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(259, '0002-000295', 5.000, 'V0023', NULL, 0, 'sale', 17000, 85000, 0, NULL, '2022-05-23 15:09:09', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(260, '01RD00056', 8.000, 'REQ00020/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(261, '01RD00061', 12.000, 'REQ00020/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(262, '01RD00063', 2.000, 'REQ00020/05/2022', NULL, 0, 'transfert_out', 0, 0, NULL, NULL, '2022-05-24 16:59:16', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_categories`
--

CREATE TABLE `pos_store_2_ibi_categories` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) NOT NULL,
  `DESCRIPTION_CATEGORIE` text NOT NULL,
  `PARENT_REF_ID_CATEGORIE` int(11) NOT NULL,
  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
  `DATE_MOD_CATEGORIE` datetime NOT NULL,
  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
  `MODIFIED_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
  `DELETE_DATE_CATEGORIE` datetime NOT NULL,
  `DELETE_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_COMMENT_CATEGORIE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_inventaires`
--

CREATE TABLE `pos_store_2_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `STATUS_APPROV` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_2_ibi_inventaires`
--

INSERT INTO `pos_store_2_ibi_inventaires` (`ID_INVENTAIRE`, `TITRE_INVENTAIRE`, `DESCRIPTION_INVENTAIRE`, `VALUE_INVENTAIRE`, `ITEMS_INVENTAIRE`, `TYPE_INVENTAIRE`, `REF_PROVIDERS_INVENTAIRE`, `STATUS_APPROV`, `DATE_CREATION_INVENTAIRE`, `DATE_MOD_INVENTAIRE`, `CREATED_BY_INVENTAIRE`, `MODIFIED_BY_INVENTAIRE`, `DELETE_STATUS_INVENTAIRE`, `DELETE_DATE_INVENTAIRE`, `DELETE_BY_INVENTAIRE`, `DELETE_COMMENT_INVENTAIRE`) VALUES
(1, '19/05/2022', '', 51970, 192134, '', 0, 1, '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(2, '20/05/2022', '', 0, 53, '', 0, 1, '2022-05-20 15:57:00', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(3, '23/05/2022', '', 0, 265, '', 0, 1, '2022-05-23 11:06:02', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(4, '23/05/2022', '', 0, 125, '', 0, 1, '2022-05-23 13:18:01', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(5, '23/05/2022', '', 265, 265, '', 0, 1, '2022-05-23 13:56:08', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(6, '23/05/2022', '', 0, 4059, '', 0, 1, '2022-05-23 14:01:39', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(7, '23/05/2022', '', 0, 24, '', 0, 1, '2022-05-23 14:06:36', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(8, '23/05/2022', '', 0, 38, '', 0, 1, '2022-05-23 14:20:48', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(9, '23/05/2022', '', 0, 637, '', 0, 1, '2022-05-23 14:27:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(10, '23/05/2022', '', 0, 4248, '', 0, 1, '2022-05-23 14:38:15', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(11, '23/05/2022', '', 0, 130, '', 0, 1, '2022-05-23 14:44:10', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(12, '23/05/2022', '', 0, 152, '', 0, 1, '2022-05-23 14:52:18', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(13, '23/05/2022', '', 0, 34, '', 0, 1, '2022-05-23 16:03:23', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(14, '23/05/2022', '', 0, 1870, '', 0, 1, '2022-05-23 16:21:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, ''),
(15, '23/05/2022', '', 0, 12, '', 0, 1, '2022-05-23 17:11:09', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_inventaires_items`
--

CREATE TABLE `pos_store_2_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
  `PRIX_ACHAT_IVI` double DEFAULT NULL,
  `QUANTITY_THEORIQUE_IVI` float NOT NULL,
  `QUANTITY_PHYSIQUE_IVI` float NOT NULL,
  `DIFF` float NOT NULL,
  `REF_PROVIDER_IVI` int(11) NOT NULL,
  `REF_IVI` int(11) NOT NULL,
  `BARCODE_IVI` varchar(200) NOT NULL,
  `DATE_CREATION_IVI` datetime NOT NULL,
  `DATE_MOD_IVI` datetime NOT NULL,
  `CREATED_BY_IVI` int(11) NOT NULL,
  `MODIFIED_BY_IVI` int(11) NOT NULL,
  `DELETE_STATUS_IVI` int(11) NOT NULL,
  `DELETE_DATE_IVI` datetime NOT NULL,
  `DELETE_BY_IVI` int(11) NOT NULL,
  `DELETE_COMMENT_IVI` text,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_store_2_ibi_inventaires_items`
--

INSERT INTO `pos_store_2_ibi_inventaires_items` (`ID_IVI`, `DESIGN_IVI`, `PRIX_ACHAT_IVI`, `QUANTITY_THEORIQUE_IVI`, `QUANTITY_PHYSIQUE_IVI`, `DIFF`, `REF_PROVIDER_IVI`, `REF_IVI`, `BARCODE_IVI`, `DATE_CREATION_IVI`, `DATE_MOD_IVI`, `CREATED_BY_IVI`, `MODIFIED_BY_IVI`, `DELETE_STATUS_IVI`, `DELETE_DATE_IVI`, `DELETE_BY_IVI`, `DELETE_COMMENT_IVI`, `DATE_PEREMPTION`, `STATUS_VALIDATION`) VALUES
(1, '', 12000, 0, 1161, -1161, 0, 1, '0002-000295', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(2, '', 15000, 1000, 9256, -8256, 0, 1, '01RD00001', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(3, '', 0, 1000, 1525, -525, 0, 1, '01RD00002', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(4, '', 0, 1000, 6695, -5695, 0, 1, '01RD00288', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(5, '', 0, 1000, 371, 629, 0, 1, '01RD00005', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(6, '', 0, 1000, 432, 568, 0, 1, '01RD00014', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(7, '', 0, 1000, 0, 1000, 0, 1, '01RD00015', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(8, '', 0, 1000, 1495, -495, 0, 1, '01RD00006', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(9, '', 0, 1000, 1380, -380, 0, 1, '01RD00289', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(10, '', 0, 1000, 2764, -1764, 0, 1, '01RD00007', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(11, '', 0, 1000, 983, 17, 0, 1, '01RD00008', '2022-05-19 12:57:07', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(12, '', 0, 1000, 0, 1000, 0, 1, '01RD00009', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(13, '', 0, 1000, 0, 1000, 0, 1, '01RD00016', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(14, '', 0, 1000, 0, 1000, 0, 1, '01RD00017', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(15, '', 0, 1000, 57, 943, 0, 1, '01RD00018', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(16, '', 0, 1000, 0, 1000, 0, 1, '01RD00010', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(17, '', 0, 970, 399, 571, 0, 1, '01RD00290', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(18, '', 0, 1000, 4488, -3488, 0, 1, '01RD00011', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(19, '', 0, 1000, 2684, -1684, 0, 1, '01RD00012', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(20, '', 0, 1000, 93, 907, 0, 1, '01RD00013', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(21, '', 0, 1000, 0, 1000, 0, 1, '01RD00021', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(22, '', 0, 1000, 641, 359, 0, 1, '01RD00022', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(23, '', 0, 1000, 108, 892, 0, 1, '01RD00023', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(24, '', 0, 1000, 302, 698, 0, 1, '01RD00024', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(25, '', 0, 1000, 595, 405, 0, 1, '01RD00020', '2022-05-19 13:09:35', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(26, '', 0, 1000, 72, 928, 0, 1, '01RD00026', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(27, '', 0, 1000, 2531, -1531, 0, 1, '01RD00028', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(28, '', 0, 1000, 2523, -1523, 0, 1, '01RD00027', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(29, '', 0, 1000, 0, 1000, 0, 1, '01RD00033', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(30, '', 0, 1000, 1445, -445, 0, 1, '01RD00030', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(31, '', 0, 1000, 0, 1000, 0, 1, '01RD00029', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(32, '', 0, 1000, 789, 211, 0, 1, '01RD00032', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(33, '', 0, 1000, 215, 785, 0, 1, '01RD00031', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(34, '', 0, 1000, 899, 101, 0, 1, '01RD00034', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(35, '', 0, 1000, 549, 451, 0, 1, '01RD00035', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(36, '', 0, 1000, 49, 951, 0, 1, '01RD00038', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(37, '', 0, 1000, 3637, -2637, 0, 1, '01RD00039', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(38, '', 0, 1000, 126, 874, 0, 1, '01RD00040', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(39, '', 0, 1000, 68, 932, 0, 1, '01RD00041', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(40, '', 0, 1000, 186, 814, 0, 1, '01RD00042', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(41, '', 0, 1000, 0, 1000, 0, 1, '01RD00044', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(42, '', 0, 1000, 616, 384, 0, 1, '01RD00193', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(43, '', 0, 1000, 0, 1000, 0, 1, '01RD00045', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(44, '', 0, 1000, 130, 870, 0, 1, '01RD00046', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(45, '', 0, 1000, 0, 1000, 0, 1, '01RD00036', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(46, '', 0, 1000, 0, 1000, 0, 1, '01RD00037', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(47, '', 0, 1000, 59, 941, 0, 1, '01RD00232', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(48, '', 0, 1000, 0, 1000, 0, 1, '01RD00231', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(49, '', 0, 1000, 9998, -8998, 0, 1, '01RD00048', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(50, '', 0, 1000, 16661, -15661, 0, 1, '01RD00049', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(51, '', 0, 1000, 4271, -3271, 0, 1, '01RD00050', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(52, '', 0, 1000, 99, 901, 0, 1, '01RD00051', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(53, '', 0, 1000, 79, 921, 0, 1, '01RD00052', '2022-05-19 13:22:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(54, '', 0, 0, 0, 0, 0, 1, '01RD00293', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(55, '', 0, 0, 0, 0, 0, 1, '01RD00078', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(56, '', 0, 0, 0, 0, 0, 1, '01RD00079', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(57, '', 0, 0, 314, -314, 0, 1, '01RD00080', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(58, '', 0, 0, 4458, -4458, 0, 1, '01RD00081', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(59, '', 0, 0, 3201, -3201, 0, 1, '01RD00082', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(60, '', 0, 0, 0, 0, 0, 1, '01RD00194', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(61, '', 0, 0, 0, 0, 0, 1, '01RD00066', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(62, '', 0, 0, 49, -49, 0, 1, '01RD00073', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(63, '', 0, 0, 250, -250, 0, 1, '01RD00067', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(64, '', 0, 0, 69, -69, 0, 1, '01RD00069', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(65, '', 0, 0, 119, -119, 0, 1, '01RD00068', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(66, '', 0, 0, 29, -29, 0, 1, '01RD00070', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(67, '', 0, 0, 0, 0, 0, 1, '01RD00071', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(68, '', 0, 0, 0, 0, 0, 1, '01RD00053', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(69, '', 0, 0, 0, 0, 0, 1, '01RD00054', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(70, '', 0, 0, 395, -395, 0, 1, '01RD00055', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(71, '', 0, 0, 64, -64, 0, 1, '01RD00056', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(72, '', 0, 0, 1215, -1215, 0, 1, '01RD00057', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(73, '', 0, 0, 509, -509, 0, 1, '01RD00058', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(74, '', 0, 0, 119, -119, 0, 1, '01RD00059', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(75, '', 0, 0, 165, -165, 0, 1, '01RD00060', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(76, '', 0, 0, 104, -104, 0, 1, '01RD00061', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(77, '', 0, 0, 170, -170, 0, 1, '01RD00062', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(78, '', 0, 0, 90, -90, 0, 1, '01RD00063', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(79, '', 0, 0, 19, -19, 0, 1, '01RD00247', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(80, '', 0, 0, 1, -1, 0, 1, '01RD00258', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(81, '', 0, 0, 0, 0, 0, 1, '01RD00263', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(82, '', 0, 0, 0, 0, 0, 1, '01RD00102', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(83, '', 0, 0, 54, -54, 0, 1, '01RD00281', '2022-05-19 13:36:25', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(84, '', 0, 0, 13476, -13476, 0, 1, '01RD00086', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(85, '', 0, 0, 2006, -2006, 0, 1, '01RD00093', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(86, '', 0, 0, 7367, -7367, 0, 1, '01RD00087', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(87, '', 0, 0, 109, -109, 0, 1, '01RD00094', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(88, '', 0, 0, 1721, -1721, 0, 1, '01RD00088', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(89, '', 0, 0, 254, -254, 0, 1, '01RD00089', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(90, '', 0, 0, 0, 0, 0, 1, '01RD00090', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(91, '', 0, 0, 25988, -25988, 0, 1, '01RD00098', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(92, '', 0, 0, 14, -14, 0, 1, '01RD00279', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(93, '', 0, 0, 42763, -42763, 0, 1, '01RD00097', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(94, '', 0, 0, 699, -699, 0, 1, '01RD00096', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(95, '', 0, 0, 1703, -1703, 0, 1, '01RD00095', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(96, '', 0, 0, 242, -242, 0, 1, '01RD00278', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(97, '', 0, 0, 0, 0, 0, 1, '01RD00277', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(98, '', 0, 0, 599, -599, 0, 1, '01RD00276', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(99, '', 0, 0, 214, -214, 0, 1, '01RD00282', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(100, '', 0, 0, 649, -649, 0, 1, '01RD00099', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(101, '', 0, 0, 0, 0, 0, 1, '01RD00109', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(102, '', 0, 0, 0, 0, 0, 1, '01RD00110', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(103, '', 0, 0, 0, 0, 0, 1, '01RD00103', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(104, '', 0, 0, 142, -142, 0, 1, '01RD00120', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(105, '', 0, 0, 73, -73, 0, 1, '01RD00229', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(106, '', 0, 0, 14, -14, 0, 1, '01RD00239', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(107, '', 0, 0, 1018, -1018, 0, 1, '01RD00113', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(108, '', 0, 0, 0, 0, 0, 1, '01RD00233', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(109, '', 0, 0, 0, 0, 0, 1, '01RD00271', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(110, '', 0, 0, 0, 0, 0, 1, '01RD00230', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(111, '', 0, 0, 799, -799, 0, 1, '01RD00275', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(112, '', 0, 0, 60, -60, 0, 1, '01RD00179', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(113, '', 0, 0, 0, 0, 0, 1, '01RD00178', '2022-05-19 14:18:41', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(114, '', 42000, 0, 399, -399, 0, 1, '0002-000305', '2022-05-19 15:00:16', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(115, '', 5000, 0, 100, -100, 0, 2, '0002-000306', '2022-05-20 15:57:00', '0000-00-00 00:00:00', 1, 0, 1, '2022-05-21 11:59:54', 1, 'e', '', 0),
(116, '', 5000, 0, 53, -53, 0, 2, '0002-000306', '2022-05-21 12:43:33', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(117, '', 500, 0, 265, -265, 0, 3, '0002-000309', '2022-05-23 11:06:02', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(118, '', 0, 0, 125, -125, 0, 4, '01RD00230', '2022-05-23 13:18:01', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(119, '', 500, 265, 265, 0, 0, 5, '0002-000309', '2022-05-23 13:56:08', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(120, '', 0, 0, 4059, -4059, 0, 6, '01RD00129', '2022-05-23 14:01:39', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(121, '', 0, 0, 24, -24, 0, 7, '0002-000311', '2022-05-23 14:06:36', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(122, '', 0, 0, 38, -38, 0, 8, '01RD00237', '2022-05-23 14:20:48', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(123, '', 0, 0, 637, -637, 0, 9, '01RD00136', '2022-05-23 14:27:28', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(124, '', 0, 0, 4248, -4248, 0, 10, '01RD00212', '2022-05-23 14:38:15', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(125, '', 0, 0, 130, -130, 0, 11, '01RD00228', '2022-05-23 14:44:10', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(126, '', 0, 0, 152, -152, 0, 12, '01RD00162', '2022-05-23 14:52:18', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(127, '', 0, 0, 30, -30, 0, 13, '0002-000312', '2022-05-23 16:03:23', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(128, '', 0, 0, 4, -4, 0, 13, '0002-000313', '2022-05-23 16:03:23', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(129, '', 0, 0, 531, -531, 0, 14, '01RD00180', '2022-05-23 16:21:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(130, '', 0, 0, 1339, -1339, 0, 14, '01RD00181', '2022-05-23 16:21:46', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1),
(131, '', 0, 0, 12, -12, 0, 15, '01RD00159', '2022-05-23 17:11:09', '0000-00-00 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 0, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_sortie`
--

CREATE TABLE `pos_store_2_ibi_sortie` (
  `ID_SORTIE` int(11) NOT NULL,
  `CODE_SORTIE` varchar(50) NOT NULL,
  `TITRE_SORTIE` varchar(255) NOT NULL,
  `DESCRIPTION_SORTIE` varchar(255) NOT NULL,
  `MONTANT_SORTIE` double NOT NULL,
  `QTE_ASORTIE` double NOT NULL,
  `STATUS_SORTIE` int(11) NOT NULL,
  `DESTINATION_SORTIE` int(11) NOT NULL,
  `DATE_CREATION_SORTIE` datetime NOT NULL,
  `DATE_MOD_SORTIE` datetime NOT NULL,
  `CREATED_BY_SORTIE` int(11) NOT NULL,
  `MODIFY_BY_SORTIE` int(11) NOT NULL,
  `DELETE_STATUS_SORTIE` int(11) NOT NULL,
  `DELETED_BY_SORTIE` int(11) NOT NULL,
  `DETEDE_DATE_SORTIE` datetime NOT NULL,
  `DELETE_COMMENT_SORTIE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_2_ibi_sortie_items`
--

CREATE TABLE `pos_store_2_ibi_sortie_items` (
  `ID_SORTIE_ITM` int(11) NOT NULL,
  `REF_CODE_SORTIE` varchar(100) NOT NULL,
  `PRODUCT_NAME_SORTIE_ITM` varchar(255) NOT NULL,
  `QTE_SORTIE_ITM` int(11) NOT NULL,
  `PRIX_SORTIE_ITM` double NOT NULL,
  `PRIX_TOTAL_SORTIE_ITM` double NOT NULL,
  `REF_CODE_BAR_SORTIE_ITM` varchar(100) NOT NULL,
  `CREATED_BY_SORTIE_ITM` int(11) NOT NULL,
  `MODIFY_BY_SORTIE_ITM` int(11) NOT NULL,
  `DATE_CREATION_SORTIE_ITM` datetime NOT NULL,
  `DATE_MOD_SORTIE_ITM` datetime NOT NULL,
  `DELETED_BY_SORTIE_ITM` int(11) NOT NULL,
  `DELETED_COMMENT_SORTIE_ITM` varchar(255) NOT NULL,
  `DELETED_STATUS_SORTIE_ITM` int(11) NOT NULL,
  `DELETED_DATE_SORTIE_ITM` datetime NOT NULL,
  `TYPES` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store_detail_arrivage`
--

CREATE TABLE `pos_store_detail_arrivage` (
  `ID_ARRIVAGE_DETAIL` int(11) NOT NULL,
  `MONTANT_PAYER` double NOT NULL,
  `TYPE_PAYEMENT` int(11) NOT NULL COMMENT '1credit, 2cash',
  `CODE_BAR` varchar(211) NOT NULL,
  `ID_APPOVISIONNEMENT` int(11) NOT NULL,
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `QUANTITE_ARRIVAGE_DETAIL` varchar(120) NOT NULL,
  `PRIX_UNITAIRE` float NOT NULL,
  `PRIX_REQUISITIONNER` float DEFAULT NULL,
  `PRIX_APPROVISIONNER` float DEFAULT NULL,
  `QUANTITE_REQUISITIONNER` float DEFAULT NULL,
  `QUANTITE_APPROVISIONNER` float DEFAULT NULL,
  `TOTAL_REQUISITIONNER` float DEFAULT NULL,
  `STATUS_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT '0' COMMENT '0-attente, 1-Confirmer ,2-Rejeter',
  `FROM_STORE` int(11) DEFAULT NULL,
  `DATE_CREATION_ARRIVAGE_DETAIL` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_MOD_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT '0',
  `CREATE_BY_ARRIVAGE_DETAIL` int(11) NOT NULL,
  `MODIFY_BY_ARRIVAGE_DETAIL` int(11) DEFAULT NULL,
  `DELETE_BY_ARRIVAGE_DETAIL` datetime DEFAULT NULL,
  `DELETE_STATUS_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT '0' COMMENT '0:->exist, 1:->supprmer',
  `DELETE_DATE_ARRIVAGE_DETAIL` datetime NOT NULL,
  `DELETE_COMMENT_ARRIVAGE_DETAIL` varchar(201) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_store__ibi_categories`
--

CREATE TABLE `pos_store__ibi_categories` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `NOM_CATEGORIE` varchar(200) NOT NULL,
  `DESCRIPTION_CATEGORIE` text NOT NULL,
  `PARENT_REF_ID_CATEGORIE` int(11) NOT NULL,
  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
  `DATE_MOD_CATEGORIE` datetime NOT NULL,
  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
  `MODIFIED_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
  `DELETE_DATE_CATEGORIE` datetime NOT NULL,
  `DELETE_BY_CATEGORIE` int(11) NOT NULL,
  `DELETE_COMMENT_CATEGORIE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_type_clients`
--

CREATE TABLE `pos_type_clients` (
  `ID_TYPE_CLIENT` int(11) NOT NULL,
  `DESIGN_TYPE_CLIENT` varchar(50) NOT NULL,
  `DATE_CREATION_TYPE_CLIENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CREATED_BY_TYPE_CLIENT` int(11) NOT NULL,
  `DATE_MOD_TYPE_CLIENT` int(11) DEFAULT '0',
  `DELETE_STATUS_TYPE_CLIENT` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_type_clients`
--

INSERT INTO `pos_type_clients` (`ID_TYPE_CLIENT`, `DESIGN_TYPE_CLIENT`, `DATE_CREATION_TYPE_CLIENT`, `CREATED_BY_TYPE_CLIENT`, `DATE_MOD_TYPE_CLIENT`, `DELETE_STATUS_TYPE_CLIENT`) VALUES
(1, 'Comptoir', '2021-05-03 16:46:48', 0, NULL, NULL),
(2, 'CLIENT COMPTOIRE', '2021-05-08 09:08:41', 0, NULL, NULL),
(3, 'Amis', '2021-05-11 18:03:21', 0, 0, 0),
(4, 'Resto', '2021-05-14 14:53:03', 0, 0, 0),
(5, 'Petit Dejeune', '2021-05-14 14:54:54', 0, 0, 0),
(6, 'Famille', '2021-05-14 19:43:48', 0, 0, 0),
(7, 'Entreprises', '2021-05-14 23:06:08', 0, 0, 0),
(8, 'Comptoir', '2021-08-08 11:02:57', 749, 0, 0),
(9, 'BanK', '2021-11-07 11:03:58', 749, 0, 0),
(10, 'Village KIGUTU', '2021-11-07 12:41:19', 749, 0, 0),
(11, 'CHAMBRE 1', '2021-11-16 14:08:45', 749, 0, 0),
(12, 'CHAMBRE 2', '2021-11-16 14:08:32', 749, 0, 0),
(13, 'CHAMBRE 3', '2021-11-16 14:09:16', 749, 0, 0),
(14, 'CHAMBRE 4', '2021-11-16 14:09:39', 749, 0, 0),
(15, 'CHAMBRE 5', '2021-11-16 14:10:22', 749, 0, 0),
(16, 'CHAMBRE 6', '2021-11-16 14:11:27', 749, 0, 0),
(17, 'CHAMBRE 7', '2021-11-16 14:11:48', 749, 0, 0),
(18, 'CHAMBRE', '2022-03-27 09:50:39', 749, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rest`
--

CREATE TABLE `rest` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `x_api_key` varchar(20) DEFAULT NULL,
  `x_token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rest_field`
--

CREATE TABLE `rest_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `rest_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_api` varchar(10) DEFAULT NULL,
  `show_update_api` varchar(10) DEFAULT NULL,
  `show_detail_api` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rest_field_validation`
--

CREATE TABLE `rest_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `rest_field_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rest_input_type`
--

CREATE TABLE `rest_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE `schema_migrations` (
  `version` bigint(20) NOT NULL,
  `inserted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings_app`
--

CREATE TABLE `settings_app` (
  `ID_SETTING` int(11) NOT NULL,
  `NOM_ENTREPRISE` varchar(255) NOT NULL,
  `NIF_ENTREPRISE` varchar(255) NOT NULL,
  `RC_ENTREPRISE` varchar(255) NOT NULL,
  `TVA_ENTREPRISE` double NOT NULL,
  `COMMUNE_ENTREPRISE` varchar(250) DEFAULT NULL,
  `QUARTIER_ENTREPRISE` varchar(250) DEFAULT NULL,
  `AVENUE_ENTREPRISE` varchar(250) DEFAULT NULL,
  `RUE_ENTREPRISE` varchar(250) DEFAULT NULL,
  `TELEPHONE_ENTREPRISE` varchar(150) DEFAULT NULL,
  `EMAIL_ENTREPRISE` varchar(150) DEFAULT NULL,
  `BP_ENTREPRISE` varchar(10) DEFAULT NULL,
  `LOGO_ENTREPRISE` varchar(250) DEFAULT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `DATE_CREATION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings_app`
--

INSERT INTO `settings_app` (`ID_SETTING`, `NOM_ENTREPRISE`, `NIF_ENTREPRISE`, `RC_ENTREPRISE`, `TVA_ENTREPRISE`, `COMMUNE_ENTREPRISE`, `QUARTIER_ENTREPRISE`, `AVENUE_ENTREPRISE`, `RUE_ENTREPRISE`, `TELEPHONE_ENTREPRISE`, `EMAIL_ENTREPRISE`, `BP_ENTREPRISE`, `LOGO_ENTREPRISE`, `CREATED_BY`, `DATE_CREATION`) VALUES
(1, 'RAD METALS', '4000345670', '02101', 0, 'MTAHANGWA', 'INDUSTRIEL ', 'SIPHAR', '30', '68161818', 'redmetals1@gmailcom', '1516', NULL, 1, '2022-05-19 15:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings_apps`
--

CREATE TABLE `settings_apps` (
  `ID_SETTING` int(11) NOT NULL,
  `NOM_ENTREPRISE` varchar(255) NOT NULL,
  `LOGIN_ENTREPRISE` varchar(30) DEFAULT NULL,
  `PWD_ENTREPRISE` varchar(30) DEFAULT NULL,
  `TYPE_ENTREPRISE` int(5) DEFAULT NULL,
  `LOGO_ENTREPRISE` text NOT NULL,
  `EMAIL_ENTREPRISE` varchar(255) NOT NULL,
  `NIF_ENTREPRISE` varchar(200) NOT NULL,
  `TVA_ENTREPRISE` float DEFAULT NULL,
  `TELEPHONE_ENTREPRISE` varchar(255) NOT NULL,
  `RC_ENTREPRISE` varchar(255) NOT NULL,
  `ADRESSE_ENTREPRISE` varchar(255) NOT NULL,
  `PROVINCE_ENTREPRISE` varchar(50) DEFAULT NULL,
  `COMMUNE_ENTREPRISE` varchar(200) DEFAULT NULL,
  `ZONE_ENTREPRISE` varchar(200) DEFAULT NULL,
  `QUARTIER_ENTREPRISE` varchar(200) DEFAULT NULL,
  `AVENUE_ENTREPRISE` varchar(200) DEFAULT NULL,
  `RUE_ENTREPRISE` varchar(200) DEFAULT NULL,
  `NUMERO_ENTREPRISE` varchar(20) DEFAULT NULL,
  `BP_ENTREPRISE` varchar(200) DEFAULT NULL,
  `ASSUJETI_TVA_ENTREPRISE` varchar(50) DEFAULT NULL,
  `ASSUJETI_TC_ENTREPRISE` varchar(50) DEFAULT NULL,
  `ASSUJETI_PF_ENTREPRISE` varchar(50) DEFAULT NULL,
  `CENTRE_FISCAL_ENTREPRISE` varchar(200) DEFAULT NULL,
  `SECTEUR_ACTIVITE_ENTREPRISE` varchar(200) DEFAULT NULL,
  `FORME_JURDIQUE_ENTREPRISE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_tva`
--

CREATE TABLE `status_tva` (
  `ID_TVA` int(11) NOT NULL,
  `TVA_PERCENT` double NOT NULL,
  `TYPE_TVA` int(10) NOT NULL,
  `TVA_DESCRIPTION` varchar(200) NOT NULL,
  `TVA_STATUS` int(5) NOT NULL DEFAULT '0',
  `TVA_CEREATE_BY` int(11) NOT NULL,
  `TVA_DATE_CREATION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_tva`
--

INSERT INTO `status_tva` (`ID_TVA`, `TVA_PERCENT`, `TYPE_TVA`, `TVA_DESCRIPTION`, `TVA_STATUS`, `TVA_CEREATE_BY`, `TVA_DATE_CREATION`) VALUES
(1, 1, 0, '', 0, 1, '2022-04-04 03:00:00'),
(2, 1.1, 0, '', 0, 1, '2022-04-04 07:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_activite_depense`
--

CREATE TABLE `type_activite_depense` (
  `ID_ACTIVITE` int(11) NOT NULL,
  `DESIGN_ACTIVITE` varchar(222) NOT NULL,
  `CREATE_BY` int(11) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `DELETE_DATE` date DEFAULT NULL,
  `DELETE_STATUS` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_facture`
--

CREATE TABLE `type_facture` (
  `ID_TYPE_FACTURE` int(11) NOT NULL,
  `DESIGNATION_TYPE_FACTURE` varchar(255) NOT NULL,
  `IS_POS` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_facture`
--

INSERT INTO `type_facture` (`ID_TYPE_FACTURE`, `DESIGNATION_TYPE_FACTURE`, `IS_POS`) VALUES
(1, 'Crédit', 0),
(2, 'Avance', 0),
(3, 'Paiement Complet', 0),
(4, 'Complementaire', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unite_articles`
--

CREATE TABLE `unite_articles` (
  `ID_UNITE` int(11) NOT NULL,
  `DESIGNATION_UNITE` varchar(200) NOT NULL,
  `DATE_CREATION_UNITE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATE_BY_UNITE` int(11) NOT NULL,
  `DELETE_STATUS_UNITE` int(11) NOT NULL DEFAULT '0',
  `DELETED_BY_UNITE` int(11) DEFAULT NULL,
  `DATE_DELETED_UNITE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unite_articles`
--

INSERT INTO `unite_articles` (`ID_UNITE`, `DESIGNATION_UNITE`, `DATE_CREATION_UNITE`, `CREATE_BY_UNITE`, `DELETE_STATUS_UNITE`, `DELETED_BY_UNITE`, `DATE_DELETED_UNITE`) VALUES
(1, 'Kg', '2021-06-03 08:37:01', 1, 0, NULL, NULL),
(2, 'Littre', '2021-06-03 09:00:17', 1, 0, NULL, NULL),
(3, 'Grammes', '2021-06-03 09:00:25', 1, 0, NULL, NULL),
(4, 'Pieces', '2021-07-05 05:32:53', 1, 0, NULL, NULL),
(5, 'Bouteille', '2021-07-15 09:50:15', 0, 0, NULL, NULL),
(6, 'Botte', '2021-07-15 09:50:33', 0, 0, NULL, NULL),
(7, 'Godet verre', '2021-07-15 09:51:54', 0, 0, NULL, NULL),
(8, 'Verre', '2021-07-17 04:52:41', 0, 0, NULL, NULL),
(9, 'Paquet', '2021-07-20 02:44:08', 0, 0, NULL, NULL),
(10, 'Caisse', '2021-07-20 03:02:41', 0, 0, NULL, NULL),
(11, 'Carton', '2021-07-20 03:03:01', 0, 0, NULL, NULL),
(12, 'Tasse', '2021-07-20 05:58:44', 0, 0, NULL, NULL),
(13, 'Pichet', '2021-07-23 11:48:12', 0, 0, NULL, NULL),
(14, 'Godé', '2021-07-24 09:47:00', 0, 0, NULL, NULL),
(15, 'Assiette', '2021-07-24 10:17:04', 0, 0, NULL, NULL),
(16, 'Boite', '2021-09-10 11:50:42', 0, 0, NULL, NULL),
(17, 'Bidon', '2022-03-05 08:29:45', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unite_ingredients`
--

CREATE TABLE `unite_ingredients` (
  `ID_UNITE` int(11) NOT NULL,
  `NOM_UNITE` varchar(230) NOT NULL,
  `DELETED_STATUS_UNITY` int(11) DEFAULT NULL,
  `DELETED_DATE_UNITY` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DELETED_USER_UNITY` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DELETED_COMMENT_UNITY` varchar(100) NOT NULL,
  `DATE_CREATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`user_id`,`perm_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user`
--
ALTER TABLE `aauth_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autorisation`
--
ALTER TABLE `autorisation`
  ADD PRIMARY KEY (`ID_AUTORISATION`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  ADD PRIMARY KEY (`ID_SHIFT`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `cc_options`
--
ALTER TABLE `cc_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `client_file`
--
ALTER TABLE `client_file`
  ADD PRIMARY KEY (`CLIENT_FILE_ID`);

--
-- Indexes for table `contribuable`
--
ALTER TABLE `contribuable`
  ADD PRIMARY KEY (`id_contribuable`);

--
-- Indexes for table `control_ibi`
--
ALTER TABLE `control_ibi`
  ADD PRIMARY KEY (`ID_CONT`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field`
--
ALTER TABLE `crud_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etat_ingredients`
--
ALTER TABLE `etat_ingredients`
  ADD PRIMARY KEY (`ID_ETAT`);

--
-- Indexes for table `facturer_reserver`
--
ALTER TABLE `facturer_reserver`
  ADD PRIMARY KEY (`ID_FACT_RESERVER`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_field`
--
ALTER TABLE `form_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_cancelled`
--
ALTER TABLE `invoice_cancelled`
  ADD PRIMARY KEY (`id_invoice_cancelled`);

--
-- Indexes for table `invoice_saved`
--
ALTER TABLE `invoice_saved`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marge_prix`
--
ALTER TABLE `marge_prix`
  ADD PRIMARY KEY (`ID_MARGE`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD PRIMARY KEY (`ID_MODE_PAIEMENT`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_block_element`
--
ALTER TABLE `page_block_element`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parametrage`
--
ALTER TABLE `parametrage`
  ADD PRIMARY KEY (`ID_PARAMS`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID_PATIENT`);

--
-- Indexes for table `patient_file`
--
ALTER TABLE `patient_file`
  ADD PRIMARY KEY (`PATIENT_FILE_ID`);

--
-- Indexes for table `pos_activite_flux_caisse`
--
ALTER TABLE `pos_activite_flux_caisse`
  ADD PRIMARY KEY (`ID_ACTIVITE`);

--
-- Indexes for table `pos_article_famille`
--
ALTER TABLE `pos_article_famille`
  ADD PRIMARY KEY (`ID_FAMILLE`);

--
-- Indexes for table `pos_categorie_depense`
--
ALTER TABLE `pos_categorie_depense`
  ADD PRIMARY KEY (`ID_CATEGORIE_DEPENSE`);

--
-- Indexes for table `pos_categorie_flux_caisse`
--
ALTER TABLE `pos_categorie_flux_caisse`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_clients`
--
ALTER TABLE `pos_clients`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `pos_control_stock_det`
--
ALTER TABLE `pos_control_stock_det`
  ADD PRIMARY KEY (`ID_CONTROL_DET`);

--
-- Indexes for table `pos_depenses`
--
ALTER TABLE `pos_depenses`
  ADD PRIMARY KEY (`ID_DEPENSE`);

--
-- Indexes for table `pos_flux_caisse`
--
ALTER TABLE `pos_flux_caisse`
  ADD PRIMARY KEY (`ID_FLUX_CAISSE`);

--
-- Indexes for table `pos_ibi_articles_categories`
--
ALTER TABLE `pos_ibi_articles_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_ibi_articles_details`
--
ALTER TABLE `pos_ibi_articles_details`
  ADD PRIMARY KEY (`ID_ARTICLE_DETAIL`);

--
-- Indexes for table `pos_ibi_article_requisition`
--
ALTER TABLE `pos_ibi_article_requisition`
  ADD PRIMARY KEY (`ID_INGREDIENT_REQ`);

--
-- Indexes for table `pos_ibi_article_requisition_trans`
--
ALTER TABLE `pos_ibi_article_requisition_trans`
  ADD PRIMARY KEY (`ID_ARTICLE_REQ`);

--
-- Indexes for table `pos_ibi_commandes`
--
ALTER TABLE `pos_ibi_commandes`
  ADD PRIMARY KEY (`ID_POS_IBI_COMMANDES`);

--
-- Indexes for table `pos_ibi_commandes_produits`
--
ALTER TABLE `pos_ibi_commandes_produits`
  ADD PRIMARY KEY (`ID_POS_IBI_COMMANDES_PRODUITS`),
  ADD KEY `cprod_creation_date` (`DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`,`REF_PRODUCT_CODEBAR`);

--
-- Indexes for table `pos_ibi_commande_location`
--
ALTER TABLE `pos_ibi_commande_location`
  ADD PRIMARY KEY (`ID_COMMANDE_LOCATION`);

--
-- Indexes for table `pos_ibi_cpondere_settings`
--
ALTER TABLE `pos_ibi_cpondere_settings`
  ADD PRIMARY KEY (`ID_COUT_POND`);

--
-- Indexes for table `pos_ibi_fournisseurs`
--
ALTER TABLE `pos_ibi_fournisseurs`
  ADD PRIMARY KEY (`ID_FOURNISSEUR`);

--
-- Indexes for table `pos_ibi_ingredients`
--
ALTER TABLE `pos_ibi_ingredients`
  ADD PRIMARY KEY (`ID_INGREDIENT`);

--
-- Indexes for table `pos_ibi_marge`
--
ALTER TABLE `pos_ibi_marge`
  ADD PRIMARY KEY (`ID_MARGE`);

--
-- Indexes for table `pos_ibi_payement_fournisseur`
--
ALTER TABLE `pos_ibi_payement_fournisseur`
  ADD PRIMARY KEY (`ID_PF`);

--
-- Indexes for table `pos_ibi_requisition`
--
ALTER TABLE `pos_ibi_requisition`
  ADD PRIMARY KEY (`ID_REQ`);

--
-- Indexes for table `pos_ibi_requisition_trans`
--
ALTER TABLE `pos_ibi_requisition_trans`
  ADD PRIMARY KEY (`ID_REQ`);

--
-- Indexes for table `pos_ibi_societe`
--
ALTER TABLE `pos_ibi_societe`
  ADD PRIMARY KEY (`ID_SOCIETE`);

--
-- Indexes for table `pos_ibi_stores`
--
ALTER TABLE `pos_ibi_stores`
  ADD PRIMARY KEY (`ID_STORE`),
  ADD UNIQUE KEY `ID_STORE` (`ID_STORE`);

--
-- Indexes for table `pos_ibi_type_ajustement`
--
ALTER TABLE `pos_ibi_type_ajustement`
  ADD PRIMARY KEY (`AJUSTEMENT_ID`);

--
-- Indexes for table `pos_paiements`
--
ALTER TABLE `pos_paiements`
  ADD PRIMARY KEY (`ID_PAIEMENT`);

--
-- Indexes for table `pos_session`
--
ALTER TABLE `pos_session`
  ADD PRIMARY KEY (`ID_SESSION`);

--
-- Indexes for table `pos_store_1_ibi_arrivages`
--
ALTER TABLE `pos_store_1_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Indexes for table `pos_store_1_ibi_articles`
--
ALTER TABLE `pos_store_1_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Indexes for table `pos_store_1_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_1_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Indexes for table `pos_store_1_ibi_categories`
--
ALTER TABLE `pos_store_1_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_store_1_ibi_commandes`
--
ALTER TABLE `pos_store_1_ibi_commandes`
  ADD PRIMARY KEY (`ID_HOSPITAL_IBI_COMMANDES`);

--
-- Indexes for table `pos_store_1_ibi_commandes_produits`
--
ALTER TABLE `pos_store_1_ibi_commandes_produits`
  ADD PRIMARY KEY (`ID_HOSPITAL_IBI_COMMANDES_PRODUITS`);

--
-- Indexes for table `pos_store_1_ibi_inventaires`
--
ALTER TABLE `pos_store_1_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Indexes for table `pos_store_1_ibi_inventaires_items`
--
ALTER TABLE `pos_store_1_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Indexes for table `pos_store_1_ibi_sortie`
--
ALTER TABLE `pos_store_1_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Indexes for table `pos_store_1_ibi_sortie_items`
--
ALTER TABLE `pos_store_1_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Indexes for table `pos_store_2_categorie_ingredient`
--
ALTER TABLE `pos_store_2_categorie_ingredient`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_store_2_ibi_arrivages`
--
ALTER TABLE `pos_store_2_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Indexes for table `pos_store_2_ibi_articles`
--
ALTER TABLE `pos_store_2_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Indexes for table `pos_store_2_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_2_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Indexes for table `pos_store_2_ibi_categories`
--
ALTER TABLE `pos_store_2_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_store_2_ibi_inventaires`
--
ALTER TABLE `pos_store_2_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Indexes for table `pos_store_2_ibi_inventaires_items`
--
ALTER TABLE `pos_store_2_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Indexes for table `pos_store_2_ibi_sortie`
--
ALTER TABLE `pos_store_2_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Indexes for table `pos_store_2_ibi_sortie_items`
--
ALTER TABLE `pos_store_2_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Indexes for table `pos_store_detail_arrivage`
--
ALTER TABLE `pos_store_detail_arrivage`
  ADD PRIMARY KEY (`ID_ARRIVAGE_DETAIL`);

--
-- Indexes for table `pos_store__ibi_categories`
--
ALTER TABLE `pos_store__ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `pos_type_clients`
--
ALTER TABLE `pos_type_clients`
  ADD PRIMARY KEY (`ID_TYPE_CLIENT`);

--
-- Indexes for table `rest`
--
ALTER TABLE `rest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_field`
--
ALTER TABLE `rest_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schema_migrations`
--
ALTER TABLE `schema_migrations`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `settings_app`
--
ALTER TABLE `settings_app`
  ADD PRIMARY KEY (`ID_SETTING`);

--
-- Indexes for table `settings_apps`
--
ALTER TABLE `settings_apps`
  ADD PRIMARY KEY (`ID_SETTING`);

--
-- Indexes for table `status_tva`
--
ALTER TABLE `status_tva`
  ADD PRIMARY KEY (`ID_TVA`);

--
-- Indexes for table `type_activite_depense`
--
ALTER TABLE `type_activite_depense`
  ADD PRIMARY KEY (`ID_ACTIVITE`);

--
-- Indexes for table `type_facture`
--
ALTER TABLE `type_facture`
  ADD PRIMARY KEY (`ID_TYPE_FACTURE`);

--
-- Indexes for table `unite_articles`
--
ALTER TABLE `unite_articles`
  ADD PRIMARY KEY (`ID_UNITE`);

--
-- Indexes for table `unite_ingredients`
--
ALTER TABLE `unite_ingredients`
  ADD PRIMARY KEY (`ID_UNITE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1435;

--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1546;

--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_user`
--
ALTER TABLE `aauth_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=760;

--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autorisation`
--
ALTER TABLE `autorisation`
  MODIFY `ID_AUTORISATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  MODIFY `ID_SHIFT` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cc_options`
--
ALTER TABLE `cc_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `client_file`
--
ALTER TABLE `client_file`
  MODIFY `CLIENT_FILE_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribuable`
--
ALTER TABLE `contribuable`
  MODIFY `id_contribuable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `control_ibi`
--
ALTER TABLE `control_ibi`
  MODIFY `ID_CONT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `crud_field`
--
ALTER TABLE `crud_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1359;

--
-- AUTO_INCREMENT for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=782;

--
-- AUTO_INCREMENT for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `etat_ingredients`
--
ALTER TABLE `etat_ingredients`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facturer_reserver`
--
ALTER TABLE `facturer_reserver`
  MODIFY `ID_FACT_RESERVER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_field`
--
ALTER TABLE `form_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_cancelled`
--
ALTER TABLE `invoice_cancelled`
  MODIFY `id_invoice_cancelled` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_saved`
--
ALTER TABLE `invoice_saved`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marge_prix`
--
ALTER TABLE `marge_prix`
  MODIFY `ID_MARGE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  MODIFY `ID_MODE_PAIEMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_block_element`
--
ALTER TABLE `page_block_element`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parametrage`
--
ALTER TABLE `parametrage`
  MODIFY `ID_PARAMS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID_PATIENT` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_file`
--
ALTER TABLE `patient_file`
  MODIFY `PATIENT_FILE_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_activite_flux_caisse`
--
ALTER TABLE `pos_activite_flux_caisse`
  MODIFY `ID_ACTIVITE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_article_famille`
--
ALTER TABLE `pos_article_famille`
  MODIFY `ID_FAMILLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pos_categorie_depense`
--
ALTER TABLE `pos_categorie_depense`
  MODIFY `ID_CATEGORIE_DEPENSE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_categorie_flux_caisse`
--
ALTER TABLE `pos_categorie_flux_caisse`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_clients`
--
ALTER TABLE `pos_clients`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `pos_control_stock_det`
--
ALTER TABLE `pos_control_stock_det`
  MODIFY `ID_CONTROL_DET` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_depenses`
--
ALTER TABLE `pos_depenses`
  MODIFY `ID_DEPENSE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_flux_caisse`
--
ALTER TABLE `pos_flux_caisse`
  MODIFY `ID_FLUX_CAISSE` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_articles_categories`
--
ALTER TABLE `pos_ibi_articles_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pos_ibi_articles_details`
--
ALTER TABLE `pos_ibi_articles_details`
  MODIFY `ID_ARTICLE_DETAIL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_article_requisition`
--
ALTER TABLE `pos_ibi_article_requisition`
  MODIFY `ID_INGREDIENT_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_article_requisition_trans`
--
ALTER TABLE `pos_ibi_article_requisition_trans`
  MODIFY `ID_ARTICLE_REQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pos_ibi_commandes`
--
ALTER TABLE `pos_ibi_commandes`
  MODIFY `ID_POS_IBI_COMMANDES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pos_ibi_commandes_produits`
--
ALTER TABLE `pos_ibi_commandes_produits`
  MODIFY `ID_POS_IBI_COMMANDES_PRODUITS` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `pos_ibi_commande_location`
--
ALTER TABLE `pos_ibi_commande_location`
  MODIFY `ID_COMMANDE_LOCATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_cpondere_settings`
--
ALTER TABLE `pos_ibi_cpondere_settings`
  MODIFY `ID_COUT_POND` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_fournisseurs`
--
ALTER TABLE `pos_ibi_fournisseurs`
  MODIFY `ID_FOURNISSEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pos_ibi_ingredients`
--
ALTER TABLE `pos_ibi_ingredients`
  MODIFY `ID_INGREDIENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_marge`
--
ALTER TABLE `pos_ibi_marge`
  MODIFY `ID_MARGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_payement_fournisseur`
--
ALTER TABLE `pos_ibi_payement_fournisseur`
  MODIFY `ID_PF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_requisition`
--
ALTER TABLE `pos_ibi_requisition`
  MODIFY `ID_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_ibi_requisition_trans`
--
ALTER TABLE `pos_ibi_requisition_trans`
  MODIFY `ID_REQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pos_ibi_societe`
--
ALTER TABLE `pos_ibi_societe`
  MODIFY `ID_SOCIETE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_ibi_stores`
--
ALTER TABLE `pos_ibi_stores`
  MODIFY `ID_STORE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_ibi_type_ajustement`
--
ALTER TABLE `pos_ibi_type_ajustement`
  MODIFY `AJUSTEMENT_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pos_paiements`
--
ALTER TABLE `pos_paiements`
  MODIFY `ID_PAIEMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10263;

--
-- AUTO_INCREMENT for table `pos_session`
--
ALTER TABLE `pos_session`
  MODIFY `ID_SESSION` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_arrivages`
--
ALTER TABLE `pos_store_1_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_articles`
--
ALTER TABLE `pos_store_1_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_1_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_categories`
--
ALTER TABLE `pos_store_1_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_commandes`
--
ALTER TABLE `pos_store_1_ibi_commandes`
  MODIFY `ID_HOSPITAL_IBI_COMMANDES` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_commandes_produits`
--
ALTER TABLE `pos_store_1_ibi_commandes_produits`
  MODIFY `ID_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_inventaires`
--
ALTER TABLE `pos_store_1_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_inventaires_items`
--
ALTER TABLE `pos_store_1_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_sortie`
--
ALTER TABLE `pos_store_1_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_store_1_ibi_sortie_items`
--
ALTER TABLE `pos_store_1_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_2_categorie_ingredient`
--
ALTER TABLE `pos_store_2_categorie_ingredient`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_arrivages`
--
ALTER TABLE `pos_store_2_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_articles`
--
ALTER TABLE `pos_store_2_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_2_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_categories`
--
ALTER TABLE `pos_store_2_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_inventaires`
--
ALTER TABLE `pos_store_2_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_inventaires_items`
--
ALTER TABLE `pos_store_2_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_sortie`
--
ALTER TABLE `pos_store_2_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_2_ibi_sortie_items`
--
ALTER TABLE `pos_store_2_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store_detail_arrivage`
--
ALTER TABLE `pos_store_detail_arrivage`
  MODIFY `ID_ARRIVAGE_DETAIL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_store__ibi_categories`
--
ALTER TABLE `pos_store__ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_type_clients`
--
ALTER TABLE `pos_type_clients`
  MODIFY `ID_TYPE_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rest`
--
ALTER TABLE `rest`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_field`
--
ALTER TABLE `rest_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings_app`
--
ALTER TABLE `settings_app`
  MODIFY `ID_SETTING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings_apps`
--
ALTER TABLE `settings_apps`
  MODIFY `ID_SETTING` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_tva`
--
ALTER TABLE `status_tva`
  MODIFY `ID_TVA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_activite_depense`
--
ALTER TABLE `type_activite_depense`
  MODIFY `ID_ACTIVITE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_facture`
--
ALTER TABLE `type_facture`
  MODIFY `ID_TYPE_FACTURE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unite_articles`
--
ALTER TABLE `unite_articles`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `unite_ingredients`
--
ALTER TABLE `unite_ingredients`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
