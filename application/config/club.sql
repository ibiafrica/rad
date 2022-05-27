-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 22 avr. 2021 à 08:22
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ibiafric_pos_club`
--

-- --------------------------------------------------------

--
-- Structure de la table `aauth_groups`
--

CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_group_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_login_attempts`
--

CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(39) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perms`
--

CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perm_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_perm_to_user`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_pms`
--

CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(225) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user`
--

CREATE TABLE IF NOT EXISTS `aauth_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_users`
--

CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `oauth_uid` text DEFAULT NULL,
  `oauth_provider` varchar(100) DEFAULT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `avatar` text NOT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `top_secret` varchar(16) DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `boutique` varchar(50) NOT NULL,
  `STORE_ALLOWED` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  `statut` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aauth_user_variables`
--

CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

CREATE TABLE IF NOT EXISTS `autorisation` (
  `ID_AUTORISATION` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL COMMENT '0Active, 1Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
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

-- --------------------------------------------------------

--
-- Structure de la table `blog_category`
--

CREATE TABLE IF NOT EXISTS `blog_category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` int(11) UNSIGNED NOT NULL,
  `captcha_time` int(10) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cashier_shifts`
--

CREATE TABLE IF NOT EXISTS `cashier_shifts` (
  `ID_SHIFT` bigint(20) UNSIGNED NOT NULL,
  `SHIFT_START` datetime NOT NULL DEFAULT current_timestamp(),
  `SHIFT_END` datetime DEFAULT NULL,
  `SHIFT_STATUS` int(11) DEFAULT 0,
  `CREATED_BY_SHIFT` varchar(255) DEFAULT NULL,
  `INSERTED_AT_SHIFT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT_SHIFT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cc_options`
--

CREATE TABLE IF NOT EXISTS `cc_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cc_session`
--

CREATE TABLE IF NOT EXISTS `cc_session` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) NOT NULL,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client_file`
--

CREATE TABLE IF NOT EXISTS `client_file` (
  `CLIENT_FILE_ID` int(20) NOT NULL,
  `CLIENT_FILE_CODE` varchar(300) NOT NULL,
  `CLIENT_ID` int(20) NOT NULL,
  `CLIENT_FILE_STATUS` int(20) NOT NULL COMMENT '0=ouverte, 1=deja ferme',
  `DISCOUNT_BOISSON` int(11) DEFAULT 0,
  `DISCOUNT_FOOD` int(11) NOT NULL DEFAULT 0,
  `DATE_CREATION_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_CLIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `MODIFIED_BY_CLIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `DELETED_DATE_CLIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_CLIENT_FILE` int(2) NOT NULL DEFAULT 0,
  `DELETED_USER_CLIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `DELETED_COMMENT_CLIENT_FILE` varchar(300) DEFAULT NULL,
  `PAYER_FACTURE` int(11) DEFAULT NULL,
  `NUMERO_FACTURE` varchar(300) NOT NULL,
  `DECLOTURE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `crud`
--

CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `crud_custom_option`
--

CREATE TABLE IF NOT EXISTS `crud_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `crud_field`
--

CREATE TABLE IF NOT EXISTS `crud_field` (
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

-- --------------------------------------------------------

--
-- Structure de la table `crud_field_validation`
--

CREATE TABLE IF NOT EXISTS `crud_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `crud_input_type`
--

CREATE TABLE IF NOT EXISTS `crud_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `crud_input_validation`
--

CREATE TABLE IF NOT EXISTS `crud_input_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat_ingredients`
--

CREATE TABLE IF NOT EXISTS `etat_ingredients` (
  `ID_ETAT` int(11) NOT NULL,
  `NOM_ETAT` varchar(222) NOT NULL,
  `DATE_CREATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facturer_reserver`
--

CREATE TABLE IF NOT EXISTS `facturer_reserver` (
  `ID_FACT_RESERVER` int(11) NOT NULL,
  `ID_FACTURE` int(11) NOT NULL,
  `CODE_FACT_RESERVER` varchar(200) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `MONTANT_FACT_RESERVER` float DEFAULT NULL,
  `DATE_FACT_RESERVER` datetime NOT NULL DEFAULT current_timestamp(),
  `CREATE_BY_FACT_RESERVER` int(11) DEFAULT NULL,
  `DELETE_STATUS` int(11) NOT NULL DEFAULT 0,
  `DELETE_BY` int(11) DEFAULT NULL,
  `DATE_DELETE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `form_custom_attribute`
--

CREATE TABLE IF NOT EXISTS `form_custom_attribute` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `form_custom_option`
--

CREATE TABLE IF NOT EXISTS `form_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `form_field`
--

CREATE TABLE IF NOT EXISTS `form_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `input_type` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `placeholder` text DEFAULT NULL,
  `auto_generate_help_block` varchar(10) DEFAULT NULL,
  `help_block` text DEFAULT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `form_field_validation`
--

CREATE TABLE IF NOT EXISTS `form_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `marge_prix`
--

CREATE TABLE IF NOT EXISTS `marge_prix` (
  `ID_MARGE` int(11) NOT NULL,
  `DESIGNATION` varchar(50) NOT NULL,
  `MARGE` int(11) NOT NULL,
  `TYPE_MARGE` int(11) NOT NULL DEFAULT 0,
  `CREATED_BY` int(11) NOT NULL,
  `DATE_CREATION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
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

-- --------------------------------------------------------

--
-- Structure de la table `menu_type`
--

CREATE TABLE IF NOT EXISTS `menu_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `definition` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mode_paiement`
--

CREATE TABLE IF NOT EXISTS `mode_paiement` (
  `ID_MODE_PAIEMENT` int(11) NOT NULL,
  `DESIGNATION_PAIEMENT_MODE` varchar(50) NOT NULL,
  `DESCRIPTION_PAIEMENT_MODE` varchar(100) NOT NULL,
  `CREATED_BY_PAIEMENT_MODE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `fresh_content` text NOT NULL,
  `keyword` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `template` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page_block_element`
--

CREATE TABLE IF NOT EXISTS `page_block_element` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `image_preview` varchar(200) NOT NULL,
  `block_name` varchar(200) NOT NULL,
  `content_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `ID_PATIENT` int(20) NOT NULL,
  `REFERENCE_PATIENT` varchar(500) NOT NULL,
  `NOM_PATIENT` varchar(200) NOT NULL,
  `PRENOM_PATIENT` varchar(200) NOT NULL,
  `POIDS_PATIENT` int(11) DEFAULT NULL,
  `TEL_PATIENT` varchar(200) NOT NULL,
  `EMAIL_PATIENT` varchar(200) DEFAULT NULL,
  `DESCRIPTION_PATIENT` text DEFAULT NULL,
  `DATE_NAISSANCE_PATIENT` datetime NOT NULL,
  `SEX_PATIENT` varchar(300) DEFAULT NULL,
  `BLOOD_GROUP_PATIENT` varchar(300) DEFAULT NULL,
  `ADRESSE_PATIENT` text DEFAULT NULL,
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
  `PARENT_PATIENT` int(30) DEFAULT 0,
  `DELETE_STATUS_PATIENT` int(2) NOT NULL DEFAULT 0,
  `DELETE_DATE_PATIENT` datetime DEFAULT NULL,
  `DELETE_BY_PATIENT` datetime DEFAULT NULL,
  `DELETE_DESCRIPTION_PATIENT` text DEFAULT NULL,
  `DATE_CREATED_PATIENT` datetime NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY_PATIENT` int(20) NOT NULL,
  `DATE_MOD_PATIENT` datetime DEFAULT NULL,
  `MODIFIED_BY_PATIENT` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `patient_file`
--

CREATE TABLE IF NOT EXISTS `patient_file` (
  `PATIENT_FILE_ID` int(20) NOT NULL,
  `PATIENT_FILE_CODE` varchar(300) NOT NULL,
  `LETTER` varchar(10) NOT NULL,
  `PATIENT_ID` int(20) NOT NULL,
  `BON_DE_COMMANDE` varchar(250) DEFAULT NULL,
  `PATIENT_FILE_STATUS` int(20) NOT NULL COMMENT '0=ouverte, 1=deja ferme',
  `TYPE_DE_PAYEMET` int(2) NOT NULL DEFAULT 0 COMMENT '0=pour cash 1=bon de commande',
  `REF_SOCIETE` int(11) NOT NULL DEFAULT 1,
  `DOCTOR_ID` int(20) NOT NULL DEFAULT 0,
  `PRIVATE_DOCTOR` varchar(150) DEFAULT NULL,
  `DEPARTEMENT_ID` int(20) NOT NULL DEFAULT 0,
  `CONSULTATION` int(10) DEFAULT 1,
  `ACTES` int(10) DEFAULT 1,
  `MEDICAMENTS` int(10) DEFAULT 1,
  `LABORATOIRE` int(10) DEFAULT 1,
  `SEJOUR` int(10) DEFAULT 1,
  `MEDICAMENT_MATER` int(8) DEFAULT 1,
  `TRANSFERED_TO_ACCOUNTING` int(11) DEFAULT 1 COMMENT 'yes=1 no=0',
  `DATE_CREATION_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_PATIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `MODIFIED_BY_PATIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `DELETED_DATE_PATIENT_FILE` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_PATIENT_FILE` int(2) NOT NULL DEFAULT 0,
  `DELETED_USER_PATIENT_FILE` int(20) NOT NULL DEFAULT 0,
  `DELETED_COMMENT_PATIENT_FILE` varchar(300) DEFAULT NULL,
  `PAYER_FACTURE` int(11) DEFAULT NULL,
  `NUMERO_FACTURE` varchar(300) NOT NULL,
  `DECLOTURE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rest`
--

CREATE TABLE IF NOT EXISTS `rest` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `x_api_key` varchar(20) DEFAULT NULL,
  `x_token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pos_categorie_depense`
--

CREATE TABLE IF NOT EXISTS `pos_categorie_depense` (
  `ID_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `NOM_CATEGORIE_DEPENSE` varchar(230) NOT NULL,
  `CREATE_BY_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `DATE_CREATE_CATEGORIE_DEPENSE` datetime NOT NULL,
  `DELETE_STATUS_CATEGORIE_DEPENSE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_CATEGORIE_DEPENSE` datetime DEFAULT NULL,
  `DELETE_BY_CATEGORIE_DEPENSE` int(11) DEFAULT NULL,
  `COMMENT_DELETE_CATEGORIE_DEPENSE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_clients`
--

CREATE TABLE IF NOT EXISTS `pos_clients` (
  `ID_CLIENT` int(11) NOT NULL,
  `TYPE_CLIENT_ID` int(11) NOT NULL,
  `NOM_CLIENT` varchar(255) NOT NULL,
  `FULL_NAME` varchar(250) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `TEL_CLIENTS` varchar(50) DEFAULT NULL,
  `AVEC_TVA` int(11) NOT NULL DEFAULT 0,
  `DATE_CREATION_CLIENT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CREATED_BY_CLIENT` int(11) DEFAULT NULL,
  `DELETE_STATUS_CLIENT` int(11) NOT NULL DEFAULT 0,
  `DELETE_COMMENT_CLIENT` int(11) DEFAULT NULL,
  `DATE_MOD_CLIENT` varchar(50) DEFAULT NULL,
  `DELETE_BY_CLIENT` int(11) DEFAULT NULL,
  `MODIFIED_BY_CLIENT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_depenses`
--

CREATE TABLE IF NOT EXISTS `pos_depenses` (
  `ID_DEPENSE` int(11) NOT NULL,
  `NOM_DEPENSE` varchar(230) NOT NULL,
  `MONTANT_DEPENSE` float NOT NULL,
  `DESCRIPTION_DEPENSE` varchar(250) DEFAULT NULL,
  `ID_CATEGORIE_DEPENSE` int(11) NOT NULL,
  `ID_SHIFT` int(11) NOT NULL,
  `MONTANT_REQUISITION` float DEFAULT NULL,
  `MONTANT_APPROVIONNEMENT` float DEFAULT NULL,
  `ID_REQUISITION` int(11) DEFAULT NULL,
  `ID_APPROVISIONNEMENT` int(11) DEFAULT NULL,
  `RESTE_SOMMES` float DEFAULT NULL,
  `CREATE_BY_DEPENSE` int(11) NOT NULL,
  `DATE_CREATE_DEPENSE` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_DELETE_DEPENSE` datetime DEFAULT NULL,
  `DELETE_STATUS_DEPENSE` int(11) DEFAULT 0,
  `DELETE_COMMENT_DEPENSE` varchar(240) DEFAULT NULL,
  `DELETE_BY_DEPENSE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) NOT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `CODEBAR_ARTICLE` varchar(50) NOT NULL,
  `REF_RAYON_ARTICLE` int(11) NOT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) NOT NULL,
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
-- Structure de la table `pos_ibi_articles_categories`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_articles_categories` (
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

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_articles_details`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_articles_details` (
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
-- Structure de la table `pos_ibi_article_requisition`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_article_requisition` (
  `ID_INGREDIENT_REQ` int(11) NOT NULL,
  `NOM_INGREDIENT_REQ` varchar(255) NOT NULL,
  `QT_INGREDIENT_REQ` varchar(200) NOT NULL,
  `QT_RETOUR_INGREDIENT_REQ` int(11) NOT NULL,
  `QT_INGREDIENT_APPROVISIONNER` float DEFAULT NULL,
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
  `STATUS_PROD_REQ` int(11) NOT NULL COMMENT '0-attente, 1-enCours, 2-approuver, 3-rejeter',
  `DELETE_STATUS_PROD_REQ` int(11) NOT NULL,
  `TYPES` int(11) NOT NULL,
  `DELETE_STATUS_REQ` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_article_requisition_trans`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_article_requisition_trans` (
  `ID_ARTICLE_REQ` int(11) NOT NULL,
  `NOM_ARTICLE_REQ` varchar(255) NOT NULL,
  `QT_ARTICLE_REQ` int(11) NOT NULL,
  `QT_RETOUR_ARTICLE_REQ` int(11) NOT NULL,
  `PRIX_ARTICLE_REQ` double NOT NULL,
  `TOTAL_ARTICLE_REQ` double NOT NULL,
  `CODEBAR_ARTICLE_REQ` varchar(100) NOT NULL,
  `ID_CATEGORIE_TRANS` int(11) NOT NULL,
  `APROUVED_BY_PROD_REQ` int(11) NOT NULL,
  `APROUVED_BY_STORE` int(11) NOT NULL,
  `APROUVED_RETOUR_ARTICLE_BY` int(11) NOT NULL,
  `ID_REQ` int(11) NOT NULL,
  `STATUS_NOTIFY_ARTICLE` int(2) NOT NULL,
  `STATUS_PROD_REQ` int(11) NOT NULL COMMENT '0-attente, 1-aprver, 2-rejeter',
  `DELETE_STATUS_PROD_REQ` int(11) NOT NULL,
  `TYPES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_commandes`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_commandes` (
  `ID_pos_IBI_COMMANDES` int(25) NOT NULL,
  `STORE_ID_COMMADES` int(11) DEFAULT NULL,
  `ID_CASHIER_SHIFT` int(11) DEFAULT NULL,
  `COMMANDE_STATUS` int(11) NOT NULL DEFAULT 0 COMMENT '0-attente, 2-Payer,1-Avance,11-Complementaire,10-credit ',
  `TO_WHOM` smallint(2) NOT NULL DEFAULT 1,
  `IS_FACTURE` int(11) NOT NULL DEFAULT 0,
  `COMMANDE_VOID_REQUEST` smallint(6) NOT NULL DEFAULT 0,
  `COMMANDE_SPLIT_REQUEST` smallint(6) NOT NULL DEFAULT 0,
  `CODE` varchar(250) NOT NULL,
  `PRINT_COUNT` tinyint(4) NOT NULL DEFAULT 0,
  `TRANSFER_TO` int(11) DEFAULT NULL,
  `TRANSFER_STATUS` smallint(4) NOT NULL DEFAULT 0,
  `TRANSFER_ACCEPTED_AT` varchar(100) DEFAULT NULL,
  `CLIENT_ID_COMMANDE` int(11) DEFAULT NULL,
  `TABLE_ID` int(11) NOT NULL DEFAULT 0,
  `CLIENT_FILE_ID_pos_IBI_COMMANDES` int(20) DEFAULT NULL,
  `TVA` float DEFAULT NULL,
  `DATE_CREATION_pos_IBI_COMMANDES` datetime DEFAULT current_timestamp(),
  `DATE_MOD_pos_IBI_COMMANDES` datetime DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_pos_IBI_COMMANDES` int(20) NOT NULL,
  `MODIFIED_BY_pos_IBI_COMMANDES` int(20) DEFAULT NULL,
  `DELETED_DATE_pos_IBI_COMMANDES` datetime DEFAULT NULL,
  `DELETED_STATUS_pos_IBI_COMMANDES` int(2) DEFAULT 0,
  `DELETED_USER_pos_IBI_COMMANDES` int(20) DEFAULT NULL,
  `DELETED_COMMENT_pos_IBI_COMMANDES` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_commandes_produits`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_commandes_produits` (
  `ID_pos_IBI_COMMANDES_PRODUITS` int(35) NOT NULL,
  `pos_IBI_COMMANDES_ID` int(11) NOT NULL,
  `REF_PRODUCT_CODEBAR` varchar(250) NOT NULL,
  `REF_COMMAND_CODE` varchar(250) NOT NULL,
  `SHIFT_ID` int(11) NOT NULL DEFAULT 0,
  `QUANTITE` float NOT NULL,
  `PRIX` float NOT NULL,
  `PRIX_TOTAL` float NOT NULL,
  `DISCOUNT_PERCENT` float NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `DATE_COMMANDE_PRODUITS` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_CREATION_pos_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_MOD_pos_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_pos_IBI_COMMANDES_PRODUITS` int(20) NOT NULL,
  `MODIFIED_BY_pos_IBI_COMMANDES_PRODUITS` int(20) DEFAULT NULL,
  `DELETED_DATE_pos_IBI_COMMANDES_PRODUITS` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS` int(2) NOT NULL DEFAULT 0 COMMENT '0 ou 1',
  `DELETED_USER_pos_IBI_COMMANDES_PRODUITS` int(20) DEFAULT NULL,
  `DELETED_COMMENT_pos_IBI_COMMANDES_PRODUITS` varchar(300) DEFAULT NULL,
  `STORE_ID_pos_IBI_COMMANDES_PRODUITS` int(3) NOT NULL DEFAULT 0,
  `CLIENT_FILE_ID_COMMANDES_PRODUITS` int(12) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_cpondere_settings`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_cpondere_settings` (
  `ID_COUT_POND` int(11) NOT NULL,
  `NAME_COUT_POND` varchar(50) NOT NULL,
  `VALUE_COUT_POND` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_fournisseurs`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_fournisseurs` (
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `NOM_FOURNISSEUR` varchar(50) NOT NULL,
  `BP_FOURNISSEUR` varchar(50) NOT NULL,
  `TEL_FOURNISSEUR` varchar(50) NOT NULL,
  `EMAIL_FOURNISSEUR` varchar(50) NOT NULL,
  `DESCRIPTION_FOURNISSEUR` text NOT NULL,
  `DATE_CREATION_FOURNISSEUR` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_MOD_FOURNISSEUR` datetime NOT NULL,
  `CREATED_BY_FOURNISSEUR` int(11) NOT NULL,
  `MODIFIED_BY_FOURNISSEUR` int(11) NOT NULL,
  `DELETE_STATUS_FOURNISSEUR` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_FOURNISSEUR` datetime NOT NULL,
  `DELETE_BY_FOURNISSEUR` int(11) NOT NULL,
  `DELETE_COMMENT_FOURNISSEUR` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_ingredients`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_ingredients` (
  `ID_INGREDIENT` int(11) NOT NULL,
  `DESIGN_INGREDIENT` varchar(200) NOT NULL,
  `CODEBAR_INGREDIENT` varchar(50) NOT NULL,
  `QUANTITY_INGREDIENT` float DEFAULT NULL,
  `PRIX_DACHAT_INGREDIENT` float DEFAULT NULL,
  `UNITE_INGREDIENT` varchar(50) NOT NULL,
  `ETAT_INGREDIENT` varchar(200) NOT NULL,
  `DESCRIPTION_INGREDIENT` text DEFAULT NULL,
  `STORES` int(11) NOT NULL,
  `MINIMUM_QUANTITY_INGREDIENT` float NOT NULL,
  `DATE_CREATION_INGREDIENT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
-- Structure de la table `pos_ibi_marge`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_marge` (
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
-- Structure de la table `pos_ibi_payement_fournisseur`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_payement_fournisseur` (
  `ID_PF` int(11) NOT NULL,
  `ID_DEPENSE_REF` int(11) NOT NULL,
  `MONTANT_PF` double NOT NULL,
  `PAYER_PF` double NOT NULL,
  `RESTE_PF` double NOT NULL,
  `FOURNISSEUR_ID` int(11) NOT NULL,
  `DATE_CREATION_PF` date NOT NULL,
  `TYPE_PAYEMENT_PF` int(11) NOT NULL COMMENT '1credit, 2cash',
  `DELETE_STATUS_PF` int(11) NOT NULL,
  `CREATED_BY_PF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_requisition`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_requisition` (
  `ID_REQ` int(11) NOT NULL,
  `CODE_REQ` varchar(250) NOT NULL,
  `DESTINATION_STORE_REQ` int(11) NOT NULL,
  `FROM_STORE` int(11) NOT NULL,
  `PATIENT` varchar(11) NOT NULL,
  `TITLE_REQ` varchar(255) NOT NULL,
  `DESCRIPTION_REQ` varchar(255) NOT NULL,
  `TOTAL_REQISITIONNER` float DEFAULT NULL,
  `STATUS_REQ` int(11) NOT NULL COMMENT '0-attente, 1-enCours, 2-approuver, 3-rejeter',
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
  `DELETED_COMMENTS_REQ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_requisition_trans`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_requisition_trans` (
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

-- --------------------------------------------------------

--
-- Structure de la table `pos_ibi_stores`
--

CREATE TABLE IF NOT EXISTS `pos_ibi_stores` (
  `ID_STORE` int(11) NOT NULL,
  `STATUS_STORE` varchar(50) NOT NULL,
  `IS_POS` smallint(6) NOT NULL DEFAULT 1,
  `NAME_STORE` varchar(50) NOT NULL,
  `IMAGE_STORE` varchar(200) NOT NULL,
  `DESCRIPTION_STORE` text NOT NULL,
  `DATE_CREATION_STORE` datetime NOT NULL,
  `DATE_MOD_STORE` datetime NOT NULL,
  `CREATED_BY_STORE` int(11) NOT NULL,
  `MODIFIED_BY_STORE` int(11) NOT NULL,
  `DELETE_STATUS_STORE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_STORE` datetime NOT NULL,
  `DELETE_BY_STORE` int(11) NOT NULL,
  `DELETE_COMMENT_STORE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pos_paiements`
--

CREATE TABLE IF NOT EXISTS `pos_paiements` (
  `ID_PAIEMENT` int(11) NOT NULL,
  `COMMANDE_ID` int(11) NOT NULL,
  `MONTANT_PAIEMENT` float NOT NULL,
  `MODE_PAIEMENT` int(11) DEFAULT 0,
  `TYPE_FACTURE` int(11) NOT NULL,
  `SHIFT_ID` int(11) NOT NULL DEFAULT 0,
  `CLIENT_ID_PAIEMENT` int(11) DEFAULT NULL,
  `DATE_CREATION_PAIEMENT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CREATED_BY_PAIEMENT` int(11) NOT NULL,
  `DELETED_STATUS_PAIEMENT` int(11) NOT NULL DEFAULT 0,
  `DELETED_COMMENT_PAIEMENT` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_arrivages`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `CODE_ARRIVAGE` varchar(200) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text DEFAULT NULL,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `TYPE_ARRIVAGE` varchar(20) DEFAULT NULL,
  `TYPE_APPROVISIONNEMENT` varchar(100) NOT NULL,
  `ID_REQUISITION` int(11) DEFAULT NULL,
  `REF_PROVIDERS_ARRIVAGE` int(11) DEFAULT NULL,
  `DATE_CREATION_ARRIVAGE` datetime DEFAULT NULL,
  `DATE_MOD_ARRIVAGE` datetime DEFAULT NULL,
  `CREATED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARRIVAGE` int(11) DEFAULT 0,
  `DELETE_DATE_ARRIVAGE` datetime DEFAULT NULL,
  `DELETE_BY_ARRIVAGE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARRIVAGE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` decimal(11,3) DEFAULT 0.000,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_VIP_ARTICLE` decimal(11,0) DEFAULT 0,
  `PRIX_DE_VENTE_SPECIAL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text DEFAULT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) NOT NULL,
  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(200) DEFAULT NULL,
  `TRANSFORMER_BY` int(11) DEFAULT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` int(11) DEFAULT NULL,
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) DEFAULT 0,
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text DEFAULT NULL,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `SEUIL_ARTICLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_articles_stock_flow`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT 0,
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text DEFAULT NULL,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text DEFAULT NULL,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_categories` (
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
-- Structure de la table `pos_store_1_ibi_commandes`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_commandes` (
  `ID_HOSPITAL_IBI_COMMANDES` int(11) NOT NULL,
  `PAYER_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT 0,
  `VERIFICATION_SERVICE_FINANCIERE` int(11) DEFAULT 0,
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
  `DELETED_STATUS_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT 0,
  `DELETED_USER_HOSPITAL_IBI_COMMANDES` int(11) DEFAULT NULL,
  `DELETED_COMMENT_HOSPITAL_IBI_COMMANDES` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_commandes_produits`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_commandes_produits` (
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
  `DOCTOR_ID` int(11) DEFAULT 0,
  `DEPARTMENT` varchar(300) DEFAULT '1000008',
  `VERIFICATION` int(11) DEFAULT 0,
  `VERIFIED_BY` int(11) DEFAULT NULL,
  `DATE_COMMANDE_PRODUITS` datetime DEFAULT NULL,
  `DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `DATE_MOD_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `CREATED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `MODIFIED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS` datetime DEFAULT '2000-01-01 00:00:00',
  `DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT 0,
  `DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT NULL,
  `DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS` varchar(300) DEFAULT NULL,
  `STORE_ID_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_inventaires`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_inventaires` (
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

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_inventaires_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
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
  `DELETE_COMMENT_IVI` text DEFAULT NULL,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_1_ibi_sortie`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_sortie` (
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
-- Structure de la table `pos_store_1_ibi_sortie_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_1_ibi_sortie_items` (
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
-- Structure de la table `pos_store_2_categorie_ingredient`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_categorie_ingredient` (
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
-- Structure de la table `pos_store_2_famille`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_famille` (
  `ID_FAMILLE` int(11) NOT NULL,
  `NAME_FAMILLE` varchar(255) NOT NULL,
  `DESCRIPTION_FAMILLE` varchar(255) NOT NULL,
  `DATE_CREATION_FAMILLE` datetime NOT NULL,
  `DATE_MOD_FAMILLE` datetime NOT NULL,
  `CREATED_BY_FAMILLE` int(11) NOT NULL,
  `MODIFIED_BY_FAMILLE` int(11) NOT NULL,
  `DELETED_BY_FAMILLE` int(11) NOT NULL,
  `DELETE_STATUS_FAMILLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_arrivages`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text DEFAULT NULL,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
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
  `DELETE_COMMENT_ARRIVAGE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `REF_ID_FAMILLE_ARTICLE` int(11) NOT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT NULL,
  `SEUIL_ARTICLE` int(11) NOT NULL,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_VIP_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_DE_VENTE_SPECIAL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text DEFAULT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) NOT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(100) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `TRANSFORMER_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` int(11) DEFAULT NULL,
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text DEFAULT NULL,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_articles_stock_flow`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT 0,
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text DEFAULT NULL,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text DEFAULT NULL,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_categories` (
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
-- Structure de la table `pos_store_2_ibi_inventaires`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_inventaires_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
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
  `DELETE_COMMENT_IVI` text DEFAULT NULL,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_2_ibi_sortie`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_sortie` (
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
-- Structure de la table `pos_store_2_ibi_sortie_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_2_ibi_sortie_items` (
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
-- Structure de la table `pos_store_4_ibi_arrivages`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text DEFAULT NULL,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
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
  `DELETE_COMMENT_ARRIVAGE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_4_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_SPECIAL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text DEFAULT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) NOT NULL,
  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(200) DEFAULT NULL,
  `TRANSFORMER_BY` int(11) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` int(11) DEFAULT NULL,
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text DEFAULT NULL,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `SEUIL_ARTICLE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_4_ibi_articles_stock_flow`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT 0,
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text DEFAULT NULL,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text DEFAULT NULL,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_4_ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_categories` (
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
-- Structure de la table `pos_store_4_ibi_inventaires`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_4_ibi_inventaires_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
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
  `DELETE_COMMENT_IVI` text DEFAULT NULL,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_4_ibi_sortie`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_sortie` (
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
-- Structure de la table `pos_store_4_ibi_sortie_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_4_ibi_sortie_items` (
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
-- Structure de la table `pos_store_5_ibi_arrivages`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text DEFAULT NULL,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
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
  `DELETE_COMMENT_ARRIVAGE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_5_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_SPECIAL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL DEFAULT 0,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text DEFAULT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) DEFAULT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
  `ETAT_TVA` int(11) DEFAULT NULL,
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text DEFAULT NULL,
  `STORE_ID_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT 0,
  `SEUIL_ARTICLE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_5_ibi_articles_stock_flow`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL DEFAULT 0,
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text DEFAULT NULL,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text DEFAULT NULL,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_5_ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_categories` (
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
-- Structure de la table `pos_store_5_ibi_inventaires`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_5_ibi_inventaires_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
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
  `DELETE_COMMENT_IVI` text DEFAULT NULL,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_5_ibi_sortie`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_sortie` (
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
-- Structure de la table `pos_store_5_ibi_sortie_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_5_ibi_sortie_items` (
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
-- Structure de la table `pos_store_8_ibi_arrivages`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_arrivages` (
  `ID_ARRIVAGE` int(11) NOT NULL,
  `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
  `DESCRIPTION_ARRIVAGE` text DEFAULT NULL,
  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
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
  `DELETE_COMMENT_ARRIVAGE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_8_ibi_articles`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_articles` (
  `ID_ARTICLE` int(11) NOT NULL,
  `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
  `QUANTITY_ARTICLE` int(11) DEFAULT NULL,
  `PRIX_DACHAT_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
  `PRIX_DE_VENTE_SPECIAL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
  `MARGE_ARTICLE` decimal(10,0) NOT NULL,
  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
  `DESCRIPTION_ARTICLE` text DEFAULT NULL,
  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
  `ETAT_INGREDIENT_ARTICLE` varchar(50) NOT NULL,
  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
  `ETAT_TVA` int(11) DEFAULT NULL,
  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_STATUS_ARTICLE` int(11) NOT NULL DEFAULT 0,
  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
  `DELETE_COMMENT_ARTICLE` text DEFAULT NULL,
  `STORE_ID_ARTICLE` int(11) NOT NULL,
  `IS_INGREDIENT` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_8_ibi_articles_stock_flow`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_articles_stock_flow` (
  `ID_SF` int(11) NOT NULL,
  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
  `TYPE_SF` varchar(200) DEFAULT NULL,
  `UNIT_PRICE_SF` float DEFAULT NULL,
  `SHIFT_ID_S` int(11) NOT NULL,
  `TOTAL_PRICE_SF` float DEFAULT NULL,
  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
  `DESCRIPTION_SF` text DEFAULT NULL,
  `DATE_CREATION_SF` datetime DEFAULT NULL,
  `DATE_MOD_SF` datetime DEFAULT NULL,
  `CREATED_BY_SF` int(11) DEFAULT NULL,
  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
  `DELETE_DATE_SF` datetime DEFAULT NULL,
  `DELETE_BY_SF` int(11) DEFAULT NULL,
  `DELETE_COMMENT_SF` text DEFAULT NULL,
  `ID_ARRIVAGE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_8_ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_categories` (
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
-- Structure de la table `pos_store_8_ibi_inventaires`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_inventaires` (
  `ID_INVENTAIRE` int(11) NOT NULL,
  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
  `DESCRIPTION_INVENTAIRE` text NOT NULL,
  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
  `DELETE_COMMENT_INVENTAIRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_8_ibi_inventaires_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_inventaires_items` (
  `ID_IVI` int(11) NOT NULL,
  `DESIGN_IVI` varchar(200) NOT NULL,
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
  `DELETE_COMMENT_IVI` text DEFAULT NULL,
  `DATE_PEREMPTION` varchar(11) NOT NULL,
  `STATUS_VALIDATION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store_8_ibi_sortie`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_sortie` (
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
-- Structure de la table `pos_store_8_ibi_sortie_items`
--

CREATE TABLE IF NOT EXISTS `pos_store_8_ibi_sortie_items` (
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
-- Structure de la table `pos_store_detail_arrivage`
--

CREATE TABLE IF NOT EXISTS `pos_store_detail_arrivage` (
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
  `QUANTITE_REQUISITIONNER` float NOT NULL,
  `QUANTITE_APPROVISIONNER` float NOT NULL,
  `STATUS_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT 0 COMMENT '0-attente, 1-Confirmer ,2-Rejeter',
  `FROM_STORE` int(11) DEFAULT NULL,
  `DATE_CREATION_ARRIVAGE_DETAIL` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_MOD_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT 0,
  `CREATE_BY_ARRIVAGE_DETAIL` int(11) NOT NULL,
  `MODIFY_BY_ARRIVAGE_DETAIL` int(11) DEFAULT NULL,
  `DELETE_BY_ARRIVAGE_DETAIL` datetime DEFAULT NULL,
  `DELETE_STATUS_ARRIVAGE_DETAIL` int(11) NOT NULL DEFAULT 0 COMMENT '0:->exist, 1:->supprmer',
  `DELETE_DATE_ARRIVAGE_DETAIL` datetime NOT NULL,
  `DELETE_COMMENT_ARRIVAGE_DETAIL` varchar(201) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pos_store__ibi_categories`
--

CREATE TABLE IF NOT EXISTS `pos_store__ibi_categories` (
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
-- Structure de la table `pos_type_clients`
--

CREATE TABLE IF NOT EXISTS `pos_type_clients` (
  `ID_TYPE_CLIENT` int(11) NOT NULL,
  `DESIGN_TYPE_CLIENT` varchar(50) NOT NULL,
  `DATE_CREATION_TYPE_CLIENT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CREATED_BY_TYPE_CLIENT` int(11) NOT NULL,
  `DATE_MOD_TYPE_CLIENT` int(11) DEFAULT NULL,
  `DELETE_STATUS_TYPE_CLIENT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rest_field`
--

CREATE TABLE IF NOT EXISTS `rest_field` (
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
-- Structure de la table `rest_field_validation`
--

CREATE TABLE IF NOT EXISTS `rest_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `rest_field_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rest_input_type`
--

CREATE TABLE IF NOT EXISTS `rest_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `schema_migrations`
--

CREATE TABLE IF NOT EXISTS `schema_migrations` (
  `version` bigint(20) NOT NULL,
  `inserted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `settings_app`
--

CREATE TABLE IF NOT EXISTS `settings_app` (
  `ID_SETTING` int(11) NOT NULL,
  `NOM_ENTREPRISE` varchar(255) NOT NULL,
  `NIF_ENTREPRISE` varchar(255) NOT NULL,
  `RC_ENTREPRISE` varchar(255) NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `type_facture`
--

CREATE TABLE IF NOT EXISTS `type_facture` (
  `ID_TYPE_FACTURE` int(11) NOT NULL,
  `DESIGNATION_TYPE_FACTURE` varchar(255) NOT NULL,
  `IS_POS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `unite_ingredients`
--

CREATE TABLE IF NOT EXISTS `unite_ingredients` (
  `ID_UNITE` int(11) NOT NULL,
  `NOM_UNITE` varchar(230) NOT NULL,
  `DELETED_STATUS_UNITY` int(11) DEFAULT NULL,
  `DELETED_DATE_UNITY` datetime NOT NULL DEFAULT current_timestamp(),
  `DELETED_USER_UNITY` datetime NOT NULL DEFAULT current_timestamp(),
  `DELETED_COMMENT_UNITY` varchar(100) NOT NULL,
  `DATE_CREATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Index pour la table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`user_id`,`perm_id`);

--
-- Index pour la table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_user`
--
ALTER TABLE `aauth_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Index pour la table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autorisation`
--
ALTER TABLE `autorisation`
  ADD PRIMARY KEY (`ID_AUTORISATION`);

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Index pour la table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  ADD PRIMARY KEY (`ID_SHIFT`);

--
-- Index pour la table `cc_options`
--
ALTER TABLE `cc_options`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client_file`
--
ALTER TABLE `client_file`
  ADD PRIMARY KEY (`CLIENT_FILE_ID`);

--
-- Index pour la table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `crud_field`
--
ALTER TABLE `crud_field`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat_ingredients`
--
ALTER TABLE `etat_ingredients`
  ADD PRIMARY KEY (`ID_ETAT`);

--
-- Index pour la table `facturer_reserver`
--
ALTER TABLE `facturer_reserver`
  ADD PRIMARY KEY (`ID_FACT_RESERVER`);

--
-- Index pour la table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_field`
--
ALTER TABLE `form_field`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marge_prix`
--
ALTER TABLE `marge_prix`
  ADD PRIMARY KEY (`ID_MARGE`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD PRIMARY KEY (`ID_MODE_PAIEMENT`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page_block_element`
--
ALTER TABLE `page_block_element`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID_PATIENT`);

--
-- Index pour la table `patient_file`
--
ALTER TABLE `patient_file`
  ADD PRIMARY KEY (`PATIENT_FILE_ID`);

--
-- Index pour la table `rest`
--
ALTER TABLE `rest`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pos_categorie_depense`
--
ALTER TABLE `pos_categorie_depense`
  ADD PRIMARY KEY (`ID_CATEGORIE_DEPENSE`);

--
-- Index pour la table `pos_clients`
--
ALTER TABLE `pos_clients`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Index pour la table `pos_depenses`
--
ALTER TABLE `pos_depenses`
  ADD PRIMARY KEY (`ID_DEPENSE`);

--
-- Index pour la table `pos_ibi_articles_categories`
--
ALTER TABLE `pos_ibi_articles_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_ibi_articles_details`
--
ALTER TABLE `pos_ibi_articles_details`
  ADD PRIMARY KEY (`ID_ARTICLE_DETAIL`);

--
-- Index pour la table `pos_ibi_article_requisition`
--
ALTER TABLE `pos_ibi_article_requisition`
  ADD PRIMARY KEY (`ID_INGREDIENT_REQ`);

--
-- Index pour la table `pos_ibi_article_requisition_trans`
--
ALTER TABLE `pos_ibi_article_requisition_trans`
  ADD PRIMARY KEY (`ID_ARTICLE_REQ`);

--
-- Index pour la table `pos_ibi_commandes`
--
ALTER TABLE `pos_ibi_commandes`
  ADD PRIMARY KEY (`ID_pos_IBI_COMMANDES`);

--
-- Index pour la table `pos_ibi_commandes_produits`
--
ALTER TABLE `pos_ibi_commandes_produits`
  ADD PRIMARY KEY (`ID_pos_IBI_COMMANDES_PRODUITS`),
  ADD KEY `cprod_creation_date` (`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`,`REF_PRODUCT_CODEBAR`);

--
-- Index pour la table `pos_ibi_cpondere_settings`
--
ALTER TABLE `pos_ibi_cpondere_settings`
  ADD PRIMARY KEY (`ID_COUT_POND`);

--
-- Index pour la table `pos_ibi_fournisseurs`
--
ALTER TABLE `pos_ibi_fournisseurs`
  ADD PRIMARY KEY (`ID_FOURNISSEUR`);

--
-- Index pour la table `pos_ibi_ingredients`
--
ALTER TABLE `pos_ibi_ingredients`
  ADD PRIMARY KEY (`ID_INGREDIENT`);

--
-- Index pour la table `pos_ibi_marge`
--
ALTER TABLE `pos_ibi_marge`
  ADD PRIMARY KEY (`ID_MARGE`);

--
-- Index pour la table `pos_ibi_payement_fournisseur`
--
ALTER TABLE `pos_ibi_payement_fournisseur`
  ADD PRIMARY KEY (`ID_PF`);

--
-- Index pour la table `pos_ibi_requisition`
--
ALTER TABLE `pos_ibi_requisition`
  ADD PRIMARY KEY (`ID_REQ`);

--
-- Index pour la table `pos_ibi_requisition_trans`
--
ALTER TABLE `pos_ibi_requisition_trans`
  ADD PRIMARY KEY (`ID_REQ`);

--
-- Index pour la table `pos_ibi_stores`
--
ALTER TABLE `pos_ibi_stores`
  ADD PRIMARY KEY (`ID_STORE`),
  ADD UNIQUE KEY `ID_STORE` (`ID_STORE`);

--
-- Index pour la table `pos_paiements`
--
ALTER TABLE `pos_paiements`
  ADD PRIMARY KEY (`ID_PAIEMENT`);

--
-- Index pour la table `pos_store_1_ibi_arrivages`
--
ALTER TABLE `pos_store_1_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Index pour la table `pos_store_1_ibi_articles`
--
ALTER TABLE `pos_store_1_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Index pour la table `pos_store_1_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_1_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Index pour la table `pos_store_1_ibi_categories`
--
ALTER TABLE `pos_store_1_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_1_ibi_commandes`
--
ALTER TABLE `pos_store_1_ibi_commandes`
  ADD PRIMARY KEY (`ID_HOSPITAL_IBI_COMMANDES`);

--
-- Index pour la table `pos_store_1_ibi_commandes_produits`
--
ALTER TABLE `pos_store_1_ibi_commandes_produits`
  ADD PRIMARY KEY (`ID_HOSPITAL_IBI_COMMANDES_PRODUITS`);

--
-- Index pour la table `pos_store_1_ibi_inventaires`
--
ALTER TABLE `pos_store_1_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Index pour la table `pos_store_1_ibi_inventaires_items`
--
ALTER TABLE `pos_store_1_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Index pour la table `pos_store_1_ibi_sortie`
--
ALTER TABLE `pos_store_1_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Index pour la table `pos_store_1_ibi_sortie_items`
--
ALTER TABLE `pos_store_1_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Index pour la table `pos_store_2_categorie_ingredient`
--
ALTER TABLE `pos_store_2_categorie_ingredient`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_2_famille`
--
ALTER TABLE `pos_store_2_famille`
  ADD PRIMARY KEY (`ID_FAMILLE`);

--
-- Index pour la table `pos_store_2_ibi_arrivages`
--
ALTER TABLE `pos_store_2_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Index pour la table `pos_store_2_ibi_articles`
--
ALTER TABLE `pos_store_2_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Index pour la table `pos_store_2_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_2_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Index pour la table `pos_store_2_ibi_categories`
--
ALTER TABLE `pos_store_2_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_2_ibi_inventaires`
--
ALTER TABLE `pos_store_2_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Index pour la table `pos_store_2_ibi_inventaires_items`
--
ALTER TABLE `pos_store_2_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Index pour la table `pos_store_2_ibi_sortie`
--
ALTER TABLE `pos_store_2_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Index pour la table `pos_store_2_ibi_sortie_items`
--
ALTER TABLE `pos_store_2_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Index pour la table `pos_store_4_ibi_arrivages`
--
ALTER TABLE `pos_store_4_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Index pour la table `pos_store_4_ibi_articles`
--
ALTER TABLE `pos_store_4_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Index pour la table `pos_store_4_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_4_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Index pour la table `pos_store_4_ibi_categories`
--
ALTER TABLE `pos_store_4_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_4_ibi_inventaires`
--
ALTER TABLE `pos_store_4_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Index pour la table `pos_store_4_ibi_inventaires_items`
--
ALTER TABLE `pos_store_4_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Index pour la table `pos_store_4_ibi_sortie`
--
ALTER TABLE `pos_store_4_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Index pour la table `pos_store_4_ibi_sortie_items`
--
ALTER TABLE `pos_store_4_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Index pour la table `pos_store_5_ibi_arrivages`
--
ALTER TABLE `pos_store_5_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Index pour la table `pos_store_5_ibi_articles`
--
ALTER TABLE `pos_store_5_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Index pour la table `pos_store_5_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_5_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Index pour la table `pos_store_5_ibi_categories`
--
ALTER TABLE `pos_store_5_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_5_ibi_inventaires`
--
ALTER TABLE `pos_store_5_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Index pour la table `pos_store_5_ibi_inventaires_items`
--
ALTER TABLE `pos_store_5_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Index pour la table `pos_store_5_ibi_sortie`
--
ALTER TABLE `pos_store_5_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Index pour la table `pos_store_5_ibi_sortie_items`
--
ALTER TABLE `pos_store_5_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Index pour la table `pos_store_8_ibi_arrivages`
--
ALTER TABLE `pos_store_8_ibi_arrivages`
  ADD PRIMARY KEY (`ID_ARRIVAGE`);

--
-- Index pour la table `pos_store_8_ibi_articles`
--
ALTER TABLE `pos_store_8_ibi_articles`
  ADD PRIMARY KEY (`ID_ARTICLE`);

--
-- Index pour la table `pos_store_8_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_8_ibi_articles_stock_flow`
  ADD PRIMARY KEY (`ID_SF`);

--
-- Index pour la table `pos_store_8_ibi_categories`
--
ALTER TABLE `pos_store_8_ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_store_8_ibi_inventaires`
--
ALTER TABLE `pos_store_8_ibi_inventaires`
  ADD PRIMARY KEY (`ID_INVENTAIRE`);

--
-- Index pour la table `pos_store_8_ibi_inventaires_items`
--
ALTER TABLE `pos_store_8_ibi_inventaires_items`
  ADD PRIMARY KEY (`ID_IVI`);

--
-- Index pour la table `pos_store_8_ibi_sortie`
--
ALTER TABLE `pos_store_8_ibi_sortie`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Index pour la table `pos_store_8_ibi_sortie_items`
--
ALTER TABLE `pos_store_8_ibi_sortie_items`
  ADD PRIMARY KEY (`ID_SORTIE_ITM`);

--
-- Index pour la table `pos_store_detail_arrivage`
--
ALTER TABLE `pos_store_detail_arrivage`
  ADD PRIMARY KEY (`ID_ARRIVAGE_DETAIL`);

--
-- Index pour la table `pos_store__ibi_categories`
--
ALTER TABLE `pos_store__ibi_categories`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `pos_type_clients`
--
ALTER TABLE `pos_type_clients`
  ADD PRIMARY KEY (`ID_TYPE_CLIENT`);

--
-- Index pour la table `rest_field`
--
ALTER TABLE `rest_field`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `schema_migrations`
--
ALTER TABLE `schema_migrations`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `settings_app`
--
ALTER TABLE `settings_app`
  ADD PRIMARY KEY (`ID_SETTING`);

--
-- Index pour la table `type_facture`
--
ALTER TABLE `type_facture`
  ADD PRIMARY KEY (`ID_TYPE_FACTURE`);

--
-- Index pour la table `unite_ingredients`
--
ALTER TABLE `unite_ingredients`
  ADD PRIMARY KEY (`ID_UNITE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_user`
--
ALTER TABLE `aauth_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `autorisation`
--
ALTER TABLE `autorisation`
  MODIFY `ID_AUTORISATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cashier_shifts`
--
ALTER TABLE `cashier_shifts`
  MODIFY `ID_SHIFT` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cc_options`
--
ALTER TABLE `cc_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_file`
--
ALTER TABLE `client_file`
  MODIFY `CLIENT_FILE_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud_field`
--
ALTER TABLE `crud_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat_ingredients`
--
ALTER TABLE `etat_ingredients`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facturer_reserver`
--
ALTER TABLE `facturer_reserver`
  MODIFY `ID_FACT_RESERVER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `form_custom_attribute`
--
ALTER TABLE `form_custom_attribute`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `form_custom_option`
--
ALTER TABLE `form_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `form_field`
--
ALTER TABLE `form_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `form_field_validation`
--
ALTER TABLE `form_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marge_prix`
--
ALTER TABLE `marge_prix`
  MODIFY `ID_MARGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  MODIFY `ID_MODE_PAIEMENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page_block_element`
--
ALTER TABLE `page_block_element`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID_PATIENT` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patient_file`
--
ALTER TABLE `patient_file`
  MODIFY `PATIENT_FILE_ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rest`
--
ALTER TABLE `rest`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_categorie_depense`
--
ALTER TABLE `pos_categorie_depense`
  MODIFY `ID_CATEGORIE_DEPENSE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_clients`
--
ALTER TABLE `pos_clients`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_depenses`
--
ALTER TABLE `pos_depenses`
  MODIFY `ID_DEPENSE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_articles_categories`
--
ALTER TABLE `pos_ibi_articles_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_articles_details`
--
ALTER TABLE `pos_ibi_articles_details`
  MODIFY `ID_ARTICLE_DETAIL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_article_requisition`
--
ALTER TABLE `pos_ibi_article_requisition`
  MODIFY `ID_INGREDIENT_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_article_requisition_trans`
--
ALTER TABLE `pos_ibi_article_requisition_trans`
  MODIFY `ID_ARTICLE_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_commandes`
--
ALTER TABLE `pos_ibi_commandes`
  MODIFY `ID_pos_IBI_COMMANDES` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_commandes_produits`
--
ALTER TABLE `pos_ibi_commandes_produits`
  MODIFY `ID_pos_IBI_COMMANDES_PRODUITS` int(35) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_cpondere_settings`
--
ALTER TABLE `pos_ibi_cpondere_settings`
  MODIFY `ID_COUT_POND` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_fournisseurs`
--
ALTER TABLE `pos_ibi_fournisseurs`
  MODIFY `ID_FOURNISSEUR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_ingredients`
--
ALTER TABLE `pos_ibi_ingredients`
  MODIFY `ID_INGREDIENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_marge`
--
ALTER TABLE `pos_ibi_marge`
  MODIFY `ID_MARGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_payement_fournisseur`
--
ALTER TABLE `pos_ibi_payement_fournisseur`
  MODIFY `ID_PF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_requisition`
--
ALTER TABLE `pos_ibi_requisition`
  MODIFY `ID_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_requisition_trans`
--
ALTER TABLE `pos_ibi_requisition_trans`
  MODIFY `ID_REQ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_ibi_stores`
--
ALTER TABLE `pos_ibi_stores`
  MODIFY `ID_STORE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_paiements`
--
ALTER TABLE `pos_paiements`
  MODIFY `ID_PAIEMENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_arrivages`
--
ALTER TABLE `pos_store_1_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_articles`
--
ALTER TABLE `pos_store_1_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_1_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_categories`
--
ALTER TABLE `pos_store_1_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_commandes`
--
ALTER TABLE `pos_store_1_ibi_commandes`
  MODIFY `ID_HOSPITAL_IBI_COMMANDES` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_commandes_produits`
--
ALTER TABLE `pos_store_1_ibi_commandes_produits`
  MODIFY `ID_HOSPITAL_IBI_COMMANDES_PRODUITS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_inventaires`
--
ALTER TABLE `pos_store_1_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_inventaires_items`
--
ALTER TABLE `pos_store_1_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_sortie`
--
ALTER TABLE `pos_store_1_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_1_ibi_sortie_items`
--
ALTER TABLE `pos_store_1_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_categorie_ingredient`
--
ALTER TABLE `pos_store_2_categorie_ingredient`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_famille`
--
ALTER TABLE `pos_store_2_famille`
  MODIFY `ID_FAMILLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_arrivages`
--
ALTER TABLE `pos_store_2_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_articles`
--
ALTER TABLE `pos_store_2_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_2_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_categories`
--
ALTER TABLE `pos_store_2_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_inventaires`
--
ALTER TABLE `pos_store_2_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_inventaires_items`
--
ALTER TABLE `pos_store_2_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_sortie`
--
ALTER TABLE `pos_store_2_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_2_ibi_sortie_items`
--
ALTER TABLE `pos_store_2_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_arrivages`
--
ALTER TABLE `pos_store_4_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_articles`
--
ALTER TABLE `pos_store_4_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_4_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_categories`
--
ALTER TABLE `pos_store_4_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_inventaires`
--
ALTER TABLE `pos_store_4_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_inventaires_items`
--
ALTER TABLE `pos_store_4_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_sortie`
--
ALTER TABLE `pos_store_4_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_4_ibi_sortie_items`
--
ALTER TABLE `pos_store_4_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_arrivages`
--
ALTER TABLE `pos_store_5_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_articles`
--
ALTER TABLE `pos_store_5_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_5_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_categories`
--
ALTER TABLE `pos_store_5_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_inventaires`
--
ALTER TABLE `pos_store_5_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_inventaires_items`
--
ALTER TABLE `pos_store_5_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_sortie`
--
ALTER TABLE `pos_store_5_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_5_ibi_sortie_items`
--
ALTER TABLE `pos_store_5_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_arrivages`
--
ALTER TABLE `pos_store_8_ibi_arrivages`
  MODIFY `ID_ARRIVAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_articles`
--
ALTER TABLE `pos_store_8_ibi_articles`
  MODIFY `ID_ARTICLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_articles_stock_flow`
--
ALTER TABLE `pos_store_8_ibi_articles_stock_flow`
  MODIFY `ID_SF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_categories`
--
ALTER TABLE `pos_store_8_ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_inventaires`
--
ALTER TABLE `pos_store_8_ibi_inventaires`
  MODIFY `ID_INVENTAIRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_inventaires_items`
--
ALTER TABLE `pos_store_8_ibi_inventaires_items`
  MODIFY `ID_IVI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_sortie`
--
ALTER TABLE `pos_store_8_ibi_sortie`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_8_ibi_sortie_items`
--
ALTER TABLE `pos_store_8_ibi_sortie_items`
  MODIFY `ID_SORTIE_ITM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store_detail_arrivage`
--
ALTER TABLE `pos_store_detail_arrivage`
  MODIFY `ID_ARRIVAGE_DETAIL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_store__ibi_categories`
--
ALTER TABLE `pos_store__ibi_categories`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pos_type_clients`
--
ALTER TABLE `pos_type_clients`
  MODIFY `ID_TYPE_CLIENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rest_field`
--
ALTER TABLE `rest_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rest_field_validation`
--
ALTER TABLE `rest_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rest_input_type`
--
ALTER TABLE `rest_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings_app`
--
ALTER TABLE `settings_app`
  MODIFY `ID_SETTING` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_facture`
--
ALTER TABLE `type_facture`
  MODIFY `ID_TYPE_FACTURE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `unite_ingredients`
--
ALTER TABLE `unite_ingredients`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;