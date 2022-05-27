<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 1 Ibi Commandes Paiements Controller
*| --------------------------------------------------------------------------
*| Pos Store 1 Ibi Commandes Paiements site
*|
*/
class Paiements extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_paiements');
		$this->load->model('model_registers');
	}

	/**
	* show all Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $offset String
	*/
	public function index($store = 0, $offset = 0)
	{
		$this->is_allowed('commandes_paiements_list');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['paiementss'] = $this->model_paiements->get($filter, $field, $this->limit_page, $offset);
		$this->data['paiements_counts'] = $this->model_paiements->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/paiements/index/'.$store.'/',
			'total_rows'   => $this->model_paiements->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste des recus');
		$this->render('backend/standart/administrator/paiements/paiements_list', $this->data);
	}
	
	/**
	* Add new paiementss
	*
	*/
	public function add()
	{
		$this->is_allowed('commandes_paiements_add');

		$this->template->title('Nouveau recu');
		$this->render('backend/standart/administrator/paiements/paiements_add', $this->data);
	}

	/**
	* Add New Pos Store 1 Ibi Commandes Paiementss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('commandes_paiements_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('REF_COMMAND_CODE_PAIEMENT', 'REF COMMAND CODE PAIEMENT', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('MONTANT_PAIEMENT', 'MONTANT PAIEMENT', 'trim|required');
		$this->form_validation->set_rules('PAYMENT_TYPE_PAIEMENT', 'PAYMENT TYPE PAIEMENT', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('NUMERO_CHEQUE_PAIEMENT', 'NUMERO CHEQUE PAIEMENT', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('NAME_BANQUE_PAIEMENT', 'NAME BANQUE PAIEMENT', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('NUMERO_BORDEREAU_PAIEMENT', 'NUMERO BORDEREAU PAIEMENT', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('NUMERO_RECU_PAIEMENT', 'NUMERO RECU PAIEMENT', 'trim|required|max_length[50]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'REF_COMMAND_CODE_PAIEMENT' => $this->input->post('REF_COMMAND_CODE_PAIEMENT'),
				'MONTANT_PAIEMENT' => $this->input->post('MONTANT_PAIEMENT'),
				'AUTHOR_PAIEMENT' => get_user_data('id'),				'DATE_CREATION_PAIEMENT' => date('Y-m-d H:i:s'),
				'PAYMENT_TYPE_PAIEMENT' => $this->input->post('PAYMENT_TYPE_PAIEMENT'),
				'NUMERO_CHEQUE_PAIEMENT' => $this->input->post('NUMERO_CHEQUE_PAIEMENT'),
				'NAME_BANQUE_PAIEMENT' => $this->input->post('NAME_BANQUE_PAIEMENT'),
				'NUMERO_BORDEREAU_PAIEMENT' => $this->input->post('NUMERO_BORDEREAU_PAIEMENT'),
				'NUMERO_RECU_PAIEMENT' => $this->input->post('NUMERO_RECU_PAIEMENT'),
			];

			
			$save_paiements = $this->model_paiements->store($save_data);

			if ($save_paiements) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_paiements;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/paiements/edit/' . $save_paiements, 'Edit Pos Store 1 Ibi Commandes Paiements'),
						anchor('administrator/paiements', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/paiements/edit/' . $save_paiements, 'Edit Pos Store 1 Ibi Commandes Paiements')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/paiements');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/paiements');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $id String
	*/
	public function edit($store = 0, $id)
	{
		$this->is_allowed('commandes_paiements_update');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $paiement = $this->model_registers->getOne('pos_ibi_commandes_paiements', array('ID_PAIEMENT'=>$id,'STORE_BY_PAIEMENT'=>$store));
	    if($paiement['STATUT_PAIEMENT'] == 1){

        set_message("Vous avez déjà procéder le processus d\'annulation sur ce recu", "error");

		redirect_back();

        }
        $montant_sum = $this->db->query('SELECT SUM(`MONTANT_PAIEMENT`) AS MONTANT_PAIEMENT FROM `pos_ibi_commandes_paiements` WHERE REF_COMMAND_CODE_PAIEMENT = "'.$paiement['REF_COMMAND_CODE_PAIEMENT'].'" AND STORE_BY_PAIEMENT='.$store.' AND ID_PAIEMENT NOT IN (SELECT ID_PAIEMENT FROM pos_ibi_commandes_paiements WHERE ID_PAIEMENT= '.$id.' AND STORE_BY_PAIEMENT='.$store.')')->row_array();
		if($paiement['TYPE_PAIEMENT'] == 'is_proforma'){
			$proforma = $this->model_registers->getOne('pos_store_'.$store.'_ibi_proforma',array('CODE_PROFORMA'=>$paiement['REF_COMMAND_CODE_PAIEMENT']));
			$total_paid = $proforma['TOTAL_PROFORMA']+$proforma['TVA_PROFORMA'];
		}else{
			$commande = $this->model_registers->getOne('pos_store_'.$store.'_ibi_commandes',array('CODE_COMMAND'=>$paiement['REF_COMMAND_CODE_PAIEMENT']));
			$total_paid = $commande['TOTAL_COMMAND']+$commande['TVA_COMMAND'];
		}
		$this->data['paiements'] = $this->model_paiements->find($id);
		$this->data['total_paid'] = $total_paid;
		$this->data['montant_paid'] = $montant_sum['MONTANT_PAIEMENT'];
		$this->template->title('Modifier le recu');
		$this->render('backend/standart/administrator/paiements/paiements_update', $this->data);
	}

	/**
	* Update Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('commandes_paiements_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('PAYMENT_TYPE_PAIEMENT', 'Type de paiement', 'trim|required');
		if($this->input->post('PAYMENT_TYPE_PAIEMENT') == 'cheque'){
			$this->form_validation->set_rules('MONTANT_PAIEMENT', 'Montant paid', 'trim|required');
			$this->form_validation->set_rules('NUMERO_CHEQUE_PAIEMENT', 'Number cheque', 'trim|required');
			$this->form_validation->set_rules('NAME_BANQUE_PAIEMENT', 'Banque name', 'trim|required');
		}elseif($this->input->post('PAYMENT_TYPE_PAIEMENT') == 'bank'){
			$this->form_validation->set_rules('MONTANT_PAIEMENT', 'Montant paid', 'trim|required');
			$this->form_validation->set_rules('NUMERO_BORDEREAU_PAIEMENT', 'Number bordereau', 'trim|required');
		}else{
			$this->form_validation->set_rules('MONTANT_PAIEMENT', 'Montant paid', 'trim|required');
		}
		
		if ($this->form_validation->run()) {

			$total_paid = $this->input->post('total');
			$somme_paid = $this->input->post('MONTANT_PAIEMENT')+$this->input->post('somme_paid');
			if($total_paid > $somme_paid){
                 $role_paiement = 'advance';
			}else{
				 $role_paiement = 'totalite';
			}
		   
			$save_data = [
				'MONTANT_PAIEMENT' => $this->input->post('MONTANT_PAIEMENT'),
				'PAYMENT_TYPE_PAIEMENT' => $this->input->post('PAYMENT_TYPE_PAIEMENT'),
				'NUMERO_CHEQUE_PAIEMENT' => $this->input->post('NUMERO_CHEQUE_PAIEMENT'),
				'NAME_BANQUE_PAIEMENT' => $this->input->post('NAME_BANQUE_PAIEMENT'),
				'NUMERO_BORDEREAU_PAIEMENT' => $this->input->post('NUMERO_BORDEREAU_PAIEMENT'),
				'AUTHOR_PAIEMENT' => get_user_data('id'),			
				'DATE_MOD_PAIEMENT' => date('Y-m-d H:i:s'),
				'ROLE_PAIEMENT' => $role_paiement,
			];

			
			$save_paiements = $this->model_paiements->change($id, $save_data);

			if ($save_paiements) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/paiements/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/paiements/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/paiements/index/'.$store.'');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('commandes_paiements_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		$paiement = $this->model_registers->getOne('pos_ibi_commandes_paiements',array('ID_PAIEMENT'=>$id,'STORE_BY_PAIEMENT'=>$store));

		if($paiement['STATUT_PAIEMENT'] == 1){

			 set_message("Vous avez déjà procéder le processus d\'annulation sur ce recu", 'error');
		}else{

			if (!empty($id)) {
			// $remove = $this->_remove($id);
				$table = 'pos_ibi_commandes_paiements';
		        $remove = $this->model_registers->update($table,array('ID_PAIEMENT'=>$id,'STORE_BY_PAIEMENT'=>$store),array('STATUT_PAIEMENT' => 1));
			} elseif (count($arr_id) >0) {
				foreach ($arr_id as $id) {
					// $remove = $this->_remove($id);
					$table = 'pos_ibi_commandes_paiements';
		            $remove = $this->model_registers->update($table,array('ID_PAIEMENT'=>$id,'STORE_BY_PAIEMENT'=>$store),array('STATUT_PAIEMENT' => 1));
				}
			}

			if ($remove) {
            set_message(cclang('has_been_deleted', 'paiements'), 'success');
	        } else {
	            set_message(cclang('error_delete', 'paiements'), 'error');
	        }
		}

		redirect_back();
	}

		/**
	* View view Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $id String
	*/
	public function paid_receipt($store = 0 ,$id)
	{
		$this->is_allowed('commandes_paiements_view');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        
        $store_prefix='store_'.$store;
		$this->data['paiements'] = $this->model_registers->getOne('pos_ibi_commandes_paiements',array('ID_PAIEMENT'=>$id,'STORE_BY_PAIEMENT'=>$store));
		if($this->data['paiements']['STATUT_PAIEMENT'] == 1){

        set_message("Vous avez déjà procéder le processus d\'annulation sur ce recu", "error");

		redirect_back();

        }
        if($this->data['paiements']['PAYMENT_TYPE_PAIEMENT'] == "cheque"){

			$this->data['paiement_type'] = "No : ".$this->data['paiements']['NUMERO_CHEQUE_PAIEMENT']." / ".$this->data['paiements']['NAME_BANQUE_PAIEMENT'];

		}elseif($this->data['paiements']['PAYMENT_TYPE_PAIEMENT'] == "bank"){
			$this->data['paiement_type'] = "No : ".$this->data['paiements']['NUMERO_BORDEREAU_PAIEMENT'];
		}else{
			$this->data['paiement_type'] = "";
		}
        if($this->data['paiements']['TYPE_PAIEMENT'] == 'is_proforma'){

        	$proforma = $this->model_registers->getOneJoin('pos_'.$store_prefix.'_ibi_proforma','aauth_users','auth.id = comd.AUTHOR_PROFORMA','pos_ibi_clients','client.ID_CLIENT = comd.REF_CLIENT_PROFORMA',array('CODE_PROFORMA'=>$this->data['paiements']['REF_COMMAND_CODE_PAIEMENT']));
        	$nom_client = $proforma['NOM_CLIENT'];
        	$tel_client = $proforma['TEL_CLIENT'];
        }else{

        	$commandes = $this->model_registers->getOneJoin('pos_'.$store_prefix.'_ibi_commandes','aauth_users','auth.id = comd.AUTHOR_COMMAND','pos_ibi_clients','client.ID_CLIENT = comd.REF_CLIENT_COMMAND',array('CODE_COMMAND'=>$this->data['paiements']['REF_COMMAND_CODE_PAIEMENT']));
        	$nom_client = $commandes['NOM_CLIENT'];
        	$tel_client = $commandes['TEL_CLIENT'];

        }
		$this->data['nom_client'] = $nom_client;
		$this->data['tel_client'] = $tel_client;
		$this->data['facture'] = $this->model_registers->getOne('pos_ibi_facture',array('REF_CODE_COMMAND_FACTURE'=>$this->data['paiements']['REF_COMMAND_CODE_PAIEMENT'],'STORE_BY_FACTURE'=>$store));

		$this->template->title('Paid Receipt');
		$this->render('backend/standart/administrator/paiements/paiements_view', $this->data);
	}
	
	/**
	* delete Pos Store 1 Ibi Commandes Paiementss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$paiements = $this->model_paiements->find($id);

		
		
		return $this->model_paiements->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('commandes_paiements_export');

		$this->model_paiements->export('pos_ibi_commandes_paiements', 'pos_ibi_commandes_paiements');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('commandes_paiements_export');

		$this->model_paiements->pdf('pos_ibi_commandes_paiements', 'pos_ibi_commandes_paiements');
	}
}


/* End of file paiements.php */
/* Location: ./application/controllers/administrator/Pos Store 1 Ibi Commandes Paiements.php */