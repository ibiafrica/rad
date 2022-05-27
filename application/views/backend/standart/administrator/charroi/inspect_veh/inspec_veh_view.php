
<style>
    .premier_page {
        display: flex;
    }
    .premier_page tr {
        padding: 0;
    }
    .vide {
        height: 1.5rem;
    }
    @media print {
        @page{ size: a4 portrait; margin: 5mm 5mm 5mm 5mm; padding: 0;}
        .premier_page {
            page-break-after: always;
        }
        .first_title, .second_title, .third_title {
            background-color: #634E45 !important;
        }
        .premier_page td{
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        .premier_page th{
            padding-top: 0.2 !important;
            padding-bottom: 0.5 !important;
        }
        footer, .print {
            display: none;
        }
    }
</style>
<section class="content paper_all">
   <div class="premier_page">
       <div class="tab_gauche col-md-6 col-lg-6">
           <div class="table-responsive"> 
                <table class="table table-bordered table-striped" id="fpc_table">
                    <tbody>
                        <tr>
                            <td><strong>Accessoires</strong></td>
                            <td>C</td><td>NC</td>
                        </tr>
                        <tr>
                            <td>Pare-brise</td><td><?= $inspection['PARE_BRISE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PARE_BRISE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Pare-soleil</td><td><?= $inspection['PARE_SOL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PARE_SOL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Vitres latérales, lunette arrière</td><td><?= $inspection['VITRE_LAT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['VITRE_LAT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Rétroviseurs</td><td><?= $inspection['RETROINT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['RETROINT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Sièges et banquettes</td><td><?= $inspection['SIEG_BANQ_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['SIEG_BANQ_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Ceinture de sécurité</td><td><?= $inspection['CEINTURE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CEINTURE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Lampes témoins (fonctionnement)</td><td><?= $inspection['LAMPE_T_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['LAMPE_T_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td><strong>Moteur en marche</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Volant (jeu)</td><td><?= $inspection['VOLANT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['VOLANT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Démarrage au neutre</td><td><?= $inspection['DEMARR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['DEMARR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Commande d'accélerateur</td><td><?= $inspection['COMM_ACC_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COMM_ACC_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Commande d'embrayage</td><td><?= $inspection['COMM_EMBR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COMM_EMBR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Commande de freins</td><td><?= $inspection['COMM_FREIN_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COMM_FREIN_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Frein de service</td><td><?= $inspection['FREIN_SERV_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FREIN_SERV_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Freins de stationnement</td><td><?= $inspection['FREIN_STAT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FREIN_STAT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Course de la pédale de frein</td><td><?= $inspection['COURS_P_F_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COURS_P_F_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Essuie-glaces (fonctionnement)</td><td><?= $inspection['ESSUIE_GL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ESSUIE_GL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Lave-glace (fonctionnement)</td><td><?= $inspection['LAVE_GL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['LAVE_GL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Indicateur de vitesse et totalisateur</td><td><?= $inspection['INDIC_VITESSE_TOT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['INDIC_VITESSE_TOT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Eclairage du tableau de bord</td><td><?= $inspection['ECLAIR_TB_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ECLAIR_TB_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Avertisseur sonore (sonore)</td><td><?= $inspection['AVERT_SON_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['AVERT_SON_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux de clignotant</td><td><?= $inspection['FEUX_CLIG_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_CLIG_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux d'arrêt</td><td><?= $inspection['FEUX_ARRET_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_ARRET_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux de plaque</td><td><?= $inspection['FEUX_PLAQ_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_PLAQ_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux de détresse</td><td><?= $inspection['FEUX_DETRESS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_DETRESS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux de recul</td><td><?= $inspection['FEUX_RECUL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_RECUL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Feux de position</td><td><?= $inspection['FEUX_POS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FEUX_POS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Phares de route</td><td><?= $inspection['PHARE_ROUTE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PHARE_ROUTE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Phares de croisement</td><td><?= $inspection['PHARE_CROIS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PHARE_CROIS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Tous les réflecteurs</td><td><?= $inspection['TOUS_REFLECT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['TOUS_REFLECT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td><strong>Moteur arrêté</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>(Système de freins hydrauliques assité)</td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Fonctionnement du système d'assistance</td><td><?= $inspection['FONCT_SYST_ASS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FONCT_SYST_ASS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td><strong>2. Autour du véhicule</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Cabine - Carrosserie</td><td><?= $inspection['CABINE_CARR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CABINE_CARR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Portière</td><td><?= $inspection['PORTIERE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PORTIERE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Rétroviseurs extérieurs</td><td><?= $inspection['RETROEXT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['RETROEXT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Essuie-glaces (balais)</td><td><?= $inspection['ESSUIE_GL_BAL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ESSUIE_GL_BAL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Ailes</td><td><?= $inspection['AILES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['AILES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Capot, crochet de sécurité</td><td><?= $inspection['CAPOT_CR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CAPOT_CR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Pneus</td><td><?= $inspection['PNEUS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PNEUS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Bouchon</td><td><?= $inspection['BOUCHON_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BOUCHON_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Pare-chocs</td><td><?= $inspection['PARE_CHOCS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PARE_CHOCS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Carrosserie</td><td><?= $inspection['CARROSSERIE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CARROSSERIE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Portes carrosserie</td><td><?= $inspection['PORTES_CARR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PORTES_CARR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Serrage boulons</td><td><?= $inspection['SERRAGE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['SERRAGE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p style="margin-top: -1.5rem;">Date: <?= $inspection['DATE_CREATION_INSP_VEH'] ?></p>
            <p style="margin-top: -1.5rem;">Nom et signature: <?php $id = $inspection['AUTHOR_CREAT_INSP_VEH'];
            $auth_user = $this->db->get_where('aauth_users', array('id' => $id))->row();
            echo isset($auth_user->full_name) ? $auth_user->full_name: '';
             ?></p>
       </div>
       <div class="tab_droite col-md-6 col-lg-6">
           <div class="table-responsive"> 
                <table class="table table-bordered table-striped" id="fpc_table">
                    <tbody>
                        <tr>
                            <td><strong>Espace de chargement</strong></td>
                            <td >C</td><td>NC</td>
                        </tr>
                        <tr>
                            <td>Plateforme</td><td><?= $inspection['PLATEFORME_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PLATEFORME_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Ridelles</td><td><?= $inspection['RIDELLES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['RIDELLES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td><strong>Suspension et frein</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Amortisseurs</td><td><?= $inspection['AMORT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['AMORT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Lames maitresse</td><td><?= $inspection['LAMES_MAITR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['LAMES_MAITR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Brides centrales</td><td><?= $inspection['BRIDES_CENT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BRIDES_CENT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Jumelles</td><td><?= $inspection['JUMELLES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['JUMELLES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Plaquettes et bande freins</td><td><?= $inspection['PLAQ_BF_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['PLAQ_BF_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td><strong>3. Sous le capot</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Courroies</td><td><?= $inspection['COURROIES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COURROIES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Supports de moteur</td><td><?= $inspection['SUPP_MOT_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['SUPP_MOT_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Batteries</td><td><?= $inspection['BATTERIES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BATTERIES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Système d'alimentation</td><td><?= $inspection['SYST_ALIM_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['SYST_ALIM_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Maitre-cylindre</td><td><?= $inspection['MAITR_CYL_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['MAITR_CYL_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Boîtiers de direction</td><td><?= $inspection['BOITIERS_DIR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BOITIERS_DIR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Lave-glace (niveau)</td><td><?= $inspection['LAVE_GL_NIV_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['LAVE_GL_NIV_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Collecteur d'échappement</td><td><?= $inspection['COLL_ECH_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['COLL_ECH_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Crémaillère</td><td><?= $inspection['CREMALLIERE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CREMALLIERE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Divers huiles</td><td><?= $inspection['DIVERS_HUILES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['DIVERS_HUILES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td><strong>4. Sous le véhicule</strong></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Rotule</td><td><?= $inspection['ROTULE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ROTULE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Fusée</td><td><?= $inspection['FUSEE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['FUSEE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Barre de torsion</td><td><?= $inspection['BARRE_TORSION_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BARRE_TORSION_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Barre stabilisatrice</td><td><?= $inspection['BARRE_STABILIS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BARRE_STABILIS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Bras de suspension</td><td><?= $inspection['BRAS_SUSP_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BRAS_SUSP_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Ressorts</td><td><?= $inspection['RESSORTS_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['RESSORTS_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Boulon central</td><td><?= $inspection['BOULON_CENTR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BOULON_CENTR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Essieux</td><td><?= $inspection['ESSIEUX_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ESSIEUX_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Longerons et traverse</td><td><?= $inspection['LONG_TRAV_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['LONG_TRAV_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Attaches de pare-chocs</td><td><?= $inspection['ATT_PARE_CH_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ATT_PARE_CH_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Tuyau d'échappement</td><td><?= $inspection['TUYAU_ECH_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['TUYAU_ECH_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Brides</td><td><?= $inspection['BRIDES_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['BRIDES_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Réservoir de carburant</td><td><?= $inspection['RESERV_CARB_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['RESERV_CARB_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Roue de secours</td><td><?= $inspection['ROUE_SEC_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ROUE_SEC_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr class="vide">
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <th><strong>5. Autres</strong></th><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Crick</td><td><?= $inspection['CRICK_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CRICK_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Clé de route</td><td><?= $inspection['CLE_ROUE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CLE_ROUE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Triangle</td><td><?= $inspection['TRIANGLE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['TRIANGLE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Contrôle technique</td><td><?= $inspection['CONTROLE_TECH_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CONTROLE_TECH_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Assurance</td><td><?= $inspection['ASSURANCE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['ASSURANCE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Carte rose</td><td><?= $inspection['CARTE_ROSE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['CARTE_ROSE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Mairie</td><td><?= $inspection['MAIRIE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['MAIRIE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Extincteur</td><td><?= $inspection['EXTINCTEUR_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['EXTINCTEUR_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                        <tr>
                            <td>Habitacle</td><td><?= $inspection['HABITACLE_INSP_VEH'] == 1 ? '<i class="fa fa-check"></i>' : '';?></td><td><?= $inspection['HABITACLE_INSP_VEH'] == 2 ? '<i class="fa fa-check"></i>' : '';?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
   </div>
   <div class="deuxieme_page">
       <div class="table-responsive"> 
            <table class="table table-bordered table-striped" id="fpc_table">
                <tbody>
                    <tr>
                        <td>Après inspection, j'ai décelé des défectuosités sur le véhicule</td><td width="150"></td>
                    </tr>
                    <tr>
                        <td>Après inspection, je n'ai décelé aucune défectuosité sur le véhicule</td><td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive"> 
            <h5><strong>Remarques relatives aux éléments non conformes</strong></h5>
            <table class="table table-bordered table-striped" id="fpc_table">
                <tbody>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                    <tr>
                        <td height="50" width="150"></td><td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive"> 
            <table class="table table-bordered table-striped" id="fpc_table">
                <tbody>
                    <tr>
                        <td height="250" width="150">Conclusions</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p>Date: <?= $inspection['DATE_CREATION_INSP_VEH'] ?></p>
        <p>Nom et signature: <?php $id = $inspection['AUTHOR_CREAT_INSP_VEH'];
        $auth_user = $this->db->get_where('aauth_users', array('id' => $id))->row();
        echo isset($auth_user->full_name) ? $auth_user->full_name: '';
         ?></p>

   </div>
</section>
    <!-- <button class="btn btn-primary print">Impression</button> -->
<script type="text/javascript">
    const print = document.querySelector('.print');
    print.addEventListener('click', function() {
        window.print();
    })
</script>