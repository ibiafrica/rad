<?php


//-- Toutes les routings du menu crud de la boutique //
//Bed managements//
$route['bed_management/(:any)'] = 'administrator/bed_management/index';
$route['bed_management/(:any)'] = 'administrator/bed_management/index';
$route['bed_management/(:any)/add'] = 'administrator/bed_management/add';
$route['point_de_vente'] = 'administrator/pos_ibi_commandes/Point_de_vente';




$route['ingredients/(:any)/index'] = 'administrator/pos_ibi_ingredients/index';
$route['ingredients/(:any)/index/:num'] = 'administrator/pos_ibi_ingredients/index';

$route['ingredients/(:any)/add'] = 'administrator/pos_ibi_ingredients/add';
$route['ingredients/:any/edit/(:any)'] = 'administrator/pos_ibi_ingredients/edit';
$route['ingredients/:any/view/(:any)'] = 'administrator/pos_ibi_ingredients/view';
$route['ingredients/(:any)/delete/(:any)'] = 'administrator/pos_ibi_ingredients/delete';
$route['ingredients/:any/transformation/(:any)'] = 'administrator/pos_ibi_ingredients/transformation';



$route['requisition/:any/modifyQuantinty/(:any)'] = 'administrator/requisition/modifyQuantinty';
$route['approvisionnements/(:num)/get_data_for_requisition'] = 'administrator/approvisionnements/get_data_for_requisition';



//-----------------------depense-------------//

$route['categorieDepense/index'] = 'administrator/pos_categorie_depense/index';
$route['categorieDepense/add'] = 'administrator/pos_categorie_depense/add';
$route['categorieDepense/list'] = 'administrator/pos_categorie_depense/list';
$route['categorieDepense/view/:num'] = 'administrator/pos_categorie_depense/view';
$route['categorieDepense/edit/:num'] = 'administrator/pos_categorie_depense/edit';

//--------------------------------//


//-----------------------depense-------------//

//--------------------------------//

//----------------------------------------------------//
//Pour le stores //
$route['stores'] = 'administrator/stores';
$route['store/:num/(:any)'] = 'administrator/stores';
$route['stores/:num/dashboard'] = "administrator/dashboard";
//--------------------------------------------------//
//Pour les articles //
$route['articles/:num/add'] = "administrator/articles/add";
$route['articles/:num/edit/(:any)'] = "administrator/articles/edit";
$route['articles/:num/edit_save/(:any)'] = "administrator/articles/edit_save";


//Pour les articles //
$route['articles/:num/add_plat'] = "administrator/articles/add_plat";
$route['articles/:num/edit_plat/(:any)'] = "administrator/articles/edit_plat";
$route['articles/:num/edit_save_plat/(:any)'] = "administrator/articles/edit_save_plat";
$route['articles/:num/liste_plats'] = "administrator/articles/liste_plats";
$route['articles/:num/liste_plats/(:any)'] = "administrator/articles/liste_plats";

$route['articles/:num/plat_view'] = "administrator/articles/plat_view";

//control 

$route['control_stock/:num/add'] = "administrator/control_stock/add";
$route['control_stock/:num/index'] = "administrator/control_stock/index";
$route['control_stock/:num/controlStock_edit'] = "administrator/control_stock/controlStock_edit";
$route['control_stock/:num/view/:num'] = "administrator/control_stock/view";
$route['control_stock/:num/print_controle'] = "administrator/control_stock/print_controle";



// $route['articles/:num/index']="administrator/articles/index";
$route['articles/:num/index'] = "administrator/articles/index";
$route['articles/:num/index/(:any)'] = "administrator/articles/index";

$route['articles/:num/depot_principal'] = "administrator/articles/depot_principal";
// $route['articles/:num/depot_principal/:num'] = "administrator/articles/depot_principal";



$route['articles/:num/pre_historique/(:any)'] = "administrator/articles/pre_historique";
$route['articles/:num/historique/(:any)'] = "administrator/articles/historique";
$route['articles/:num/approvisionnement/:num'] = "administrator/articles/approvisionnement";
//-----------------------------------------------------//


// Menu du jours ";
$route['menu_du_jours/:num/index'] = "administrator/pos_ibi_menu_du_jous/index";
$route['menu_du_jours/:num/add'] = "administrator/pos_ibi_menu_du_jous/add";
$route['menu_du_jours/:num/view/(:any)'] = "administrator/pos_ibi_menu_du_jous/view";
$route['articles/:num/historique/(:any)'] = "administrator/articles/historique";
$route['articles/:num/approvisionnement/(:any)'] = "administrator/articles/approvisionnement";
//-----------------------------------------------------//

$route['inventaires/:num/index'] = "administrator/inventaires/index";
$route['inventaires/:num/index/(:any)'] = "administrator/inventaires/index";
$route['inventaires/:num/add'] = "administrator/inventaires/add";
$route['inventaires/:num/view/(:any)'] = "administrator/inventaires/view";
$route['inventaires/:num/printing/(:any)'] = "administrator/inventaires/printing";
$route['inventaires/:num/add_articles/(:any)'] = "administrator/inventaires/add_articles";
$route['inventaires/:num/validation/(:any)'] = "administrator/inventaires/validation";


//Pour les categorie
$route['categories/:num/index'] = "administrator/pos_articles_categories/index";
$route['categories/:num/index/(:any)'] = "administrator/pos_articles_categories/index";
$route['categories/:num/add'] = "administrator/pos_articles_categories/add";
$route['categories/:num/view/:num'] = "administrator/pos_articles_categories/view";
$route['categories/:num/edit/:num'] = "administrator/pos_articles_categories/edit";
$route['categories/:num/edit_save/:num'] = "administrator/pos_articles_categories/edit_save";



//Pour les categorie ingredient
$route['famille/:num/index'] = "administrator/pos_famille/index";
$route['famille/:num/index/(:any)'] = "administrator/pos_famille/index";
$route['famille/:num/add'] = "administrator/pos_famille/add";
$route['famille/:num/view/:num'] = "administrator/pos_famille/view";
$route['famille/:num/edit/:num'] = "administrator/pos_famille/edit";
$route['famille/:num/edit_save/:num'] = "administrator/pos_famille/edit_save";



//Pour les categorie ingredient
$route['categorie_ingredient/:num/index'] = "administrator/pos_categorie_ingredient/index";
$route['categorie_ingredient/:num/index/(:any)'] = "administrator/pos_categorie_ingredient/index";
$route['categorie_ingredient/:num/add'] = "administrator/pos_categorie_ingredient/add";
$route['categorie_ingredient/:num/view/:num'] = "administrator/pos_categorie_ingredient/view";
$route['categorie_ingredient/:num/edit/:num'] = "administrator/pos_categorie_ingredient/edit";
$route['categorie_ingredient/:num/edit_save/:num'] = "administrator/pos_categorie_ingredient/edit_save";
$route['categorie_ingredient/:num/delete/:num'] = "administrator/pos_categorie_ingredient/delete";


//Pour le point de vente
$route['pointdesventes/:num/index'] = "administrator/pointdesventes/index";
$route['pointdesventes/:num/ventes/(:any)'] = "administrator/pointdesventes/ventes";
$route['pointdesventes/:num/commandes'] = "administrator/pointdesventes/commandes";
$route['pointdesventes/:num/commandes/(:any)'] = "administrator/pointdesventes/commandes";
$route['pointdesventes/:num/index/(:any)'] = "administrator/pointdesventes/index";
$route['pointdesventes/:num/commande_details/(:any)'] = "administrator/pointdesventes/commande_details";
$route['pointdesventes/:num/modif_ventes/(:any)'] = "administrator/pointdesventes/modif_ventes";




//Pour la requisition transfer
$route['pos_ibi_requisition_trans/:num/index'] = "administrator/pos_ibi_requisition_trans/index";
$route['pos_ibi_requisition_trans/:num/index/:num'] = "administrator/pos_ibi_requisition_trans/index";
$route['requisition_recu_trans/:num/index'] = "administrator/requisition_recu_trans/index";
$route['requisition_recu_trans/:num/index/:num'] = "administrator/requisition_recu_trans/index";

$route['pos_ibi_requisition_trans/:num/add'] = "administrator/pos_ibi_requisition_trans/add";
$route['pos_ibi_requisition_trans/:num/view/(:any)'] = "administrator/pos_ibi_requisition_trans/view";
$route['pos_ibi_requisition_trans/:num/edit/(:any)'] = "administrator/pos_ibi_requisition_trans/edit";

$route['requisition_recu_trans/:num/approbation/(:any)'] = "administrator/requisition_recu_trans/approbation";


//Rapport requisition transfert
$route['rapport_transfert/:num/index/(:any)'] = "administrator/rapport_transfert/index";
$route['rapport_transfert/:num/index'] = "administrator/rapport_transfert/index";

$route['rapport_transfert_famille/:num/index/(:any)'] = "administrator/rapport_transfert_famille/index";
$route['rapport_transfert_famille/:num/index'] = "administrator/rapport_transfert_famille/index";

//Pour la requisition
$route['requisition/:num/deleterArticle'] = "administrator/requisition/deleterArticle";
$route['requisition/:num/index'] = "administrator/requisition/index";
$route['requisition/:num/index/:num'] = "administrator/requisition/index";

$route['requisition_recu/:num/index'] = "administrator/requisition_recu/index";
$route['requisition/:num/add'] = "administrator/requisition/add";
$route['requisition/:num/view/(:any)'] = "administrator/requisition/view";
$route['requisition/:num/edit/(:any)'] = "administrator/requisition/edit";

$route['requisition_recu/:num/approbation/(:any)'] = "administrator/requisition_recu/approbation";


//Pour bon livraison
// $route['bon_livraison/:num/deleterArticle'] = "administrator/requisition/deleterArticle";
// $route['bon_livraison/:num/index'] = "administrator/requisition/index";
// $route['bon_livraison/:num/index/:num'] = "administrator/requisition/index";

// $route['requisition_recu/:num/index'] = "administrator/requisition_recu/index";
// $route['requisition/:num/add'] = "administrator/requisition/add";
// $route['requisition/:num/view/(:any)'] = "administrator/requisition/view";
// $route['requisition/:num/edit/(:any)'] = "administrator/requisition/edit";

// $route['requisition_recu/:num/approbation/(:any)'] = "administrator/requisition_recu/approbation";

//Pour les approvisionements

$route['approvisionnements/:num/index'] = "administrator/approvisionnements/index";
$route['approvisionnements/:num/index/(:any)'] = "administrator/approvisionnements/index";
$route['approvisionnements/:num/add'] = "administrator/approvisionnements/add";
$route['approvisionnements/:num/ajustement'] = "administrator/approvisionnements/ajustement";
$route['approvisionnements/:num/ajust'] = "administrator/approvisionnements/ajust";
$route['approvisionnements/:num/view/(:any)'] = "administrator/approvisionnements/view";
$route['approvisionnements/:num/prints/(:any)'] = "administrator/approvisionnements/prints";
$route['approvisionnements/:num/editer/(:any)'] = "administrator/approvisionnements/editer";




$route['approvisionnements/:num/getterOneOff/:num'] = "administrator/approvisionnements/getterOneOff";


//Pour la sortie

$route['sortie/:num/index'] = "administrator/sortie/index";

// $route['requisition_recu/:num/index']="administrator/requisition_recu/index";
$route['sortie/:num/add'] = "administrator/sortie/add";
$route['sortie/:num/view/(:any)'] = "administrator/sortie/view";
// $route['requisition/:num/edit/(:any)']="administrator/requisition/edit";


//Rayon ou location
$route['rayons/:num/index'] = "administrator/rayons/index";
$route['rayons/:num/index/(:any)'] = "administrator/rayons/index";

$route['rayons/:num/add'] = "administrator/rayons/add";
$route['rayons/:num/view/:num'] = "administrator/rayons/view";
$route['rayons/:num/edit/:num'] = "administrator/rayons/edit";
$route['rayons/:num/edit_save/:num'] = "administrator/rayons/edit_save";

//Transfert
$route['transfert_recu/:num/index'] = "administrator/transfert_recu/index";
$route['transfert_recu/:num/index/(:any)'] = "administrator/transfert_recu/index";
$route['transfert_recu/:num/view/(:any)'] = "administrator/transfert_recu/view";

$route['transfert/:num/index'] = "administrator/transfert/index";
$route['transfert/:num/index/(:any)'] = "administrator/transfert/index";
$route['transfert/:num/add'] = "administrator/transfert/add";
$route['transfert/:num/view/(:any)'] = "administrator/transfert/view";
$route['transfert/:num/edit/(:any)'] = "administrator/transfert/edit";

$route['rapport_vente_famille/:num/index'] = "administrator/rapport_vente_famille/index";

//Fournisseur
// $route['fournisseurs/(:any)/index']="administrator/fournisseurs/index";
// $route['fournisseurs/:num/add']="administrator/fournisseurs/add";
$route['pos_ibi_fournisseurs/:num/index'] = "administrator/pos_ibi_fournisseurs/index";
$route['pos_ibi_fournisseurs/rapports/:num'] = "administrator/pos_ibi_fournisseurs/rapports";
$route['fournisseurs/:num/add'] = "administrator/fournisseurs/add";


//Pour unite ingredient
$route['unite_mesure/:num/index'] = "administrator/unite_articles/index";
$route['unite_mesure/:num/index/(:any)'] = "administrator/unite_articles/index";
$route['unite_mesure/:num/add'] = "administrator/unite_articles/add";
$route['unite_mesure/:num/view/:num'] = "administrator/unite_articles/view";
$route['unite_mesure/:num/edit/:num'] = "administrator/unite_articles/edit";
$route['unite_mesure/:num/edit_save/:num'] = "administrator/unite_articles/edit_save";
$route['unite_mesure/:num/delete/:num'] = "administrator/unite_articles/delete";


//Rapports _ bs _rest
$route['rapports/rapports_montant_detail/:num'] = "administrator/rapports/rapports_montant_detail";
$route['rapports/rapports_paiements'] = "administrator/rapports/rapports_paiements";
$route['rapports/rapports_clients'] = "administrator/rapports/rapports_clients";
$route['rapports/rapport_sorties'] = "administrator/rapports/rapport_sorties";
$route['rapports/rapport_tva'] = "administrator/rapports/rapport_tva";
$route['rapports/rapport_sorties/:num'] = "administrator/rapports/rapport_sorties";
$route['rapports/serveurs'] = "administrator/rapports/serveurs";
$route['rapports/serveurs/:num'] = "administrator/rapports/serveurs";
$route['rapports/rapport_condenser'] = "administrator/rapports/rapport_condenser";



$route['rapports/commande_serveurs/(:any)/(:any)'] = "administrator/rapports/commande_serveurs";
$route['rapports/commande_serveurs/(:any)'] = "administrator/rapports/commande_serveurs";
$route['rapports/commande_serveurs'] = "administrator/rapports/commande_serveurs";
$route['facturation/fact_resever'] = "administrator/pos_ibi_commandes/facturer_reserver_bs";


$route['rapports/(:any)/detail_rapport_cmd/:num'] = "administrator/rapports/detail_rapport_cmd";
$route['rapports/(:any)/view_detail_cmd/:num'] = "administrator/rapports/view_detail_cmd";

$route['rapports/rapport_ventes'] = "administrator/rapports/rapport_ventes";
$route['rapports/(:any)/getcommandData'] = "administrator/rapports/getcommandData";
$route['rapports/rapports_approvisionnements'] = "administrator/rapports/rapports_approvisionnements";
$route['rapports/view_detail_commande'] = "administrator/rapports/view_detail_commande";
$route['rapports/view_detail_commande/:num'] = "administrator/rapports/view_detail_commande";
$route['rapports/mouvement_de_stock'] = "administrator/rapports/mouvement_de_stock";
$route['rapports/(:any)/mouvement_de_stock_store'] = "administrator/rapports/mouvement_de_stock_store";

$route['pos_ibi_commandes/void_to_request/(:any)/(:any)'] = "administrator/pos_ibi_commandes/void_to_request";
//$route['rapports/commande_serveurs/(:any)'] = "administrator/rapports/commande_serveurs";




/*$route['pos_ibi_commandes/void_to_request'] = "administrator/pos_ibi_commandes/void_to_request";
$route['rapports/commande_serveurs'] = "administrator/rapports/commande_serveurs";*/

$route['rapports/depenseRapports'] = "administrator/rapports/depenseRapports";



$route['vinotheque/(:any)/mouvement_de_stock'] = 'administrator/vinotheque/mouvement_de_stock';
$route['vinotheque/(:any)/rapport_detail'] = 'administrator/vinotheque/rapport_detail';
$route['vinotheque/(:any)/recette_journaliere'] = 'administrator/vinotheque/recette_journaliere';
$route['vinotheque/(:any)/condenser_by_date/(:any)'] = 'administrator/vinotheque/condenser_by_date';
