<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Stock Transfert Controller
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Stock Transfert site
*|
*/
class Transfert extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_transfert');
		$this->load->model('model_rm');
	}

	/**
	* show all Hospital Store 1 Ibi Stock Transferts
	*
	* @var $offset String
	*/
	public function index()
	{
        $store=$this->uri->segment(2);
        $offset=$this->uri->segment(4);

		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

       

		$this->is_allowed('pos_store_1_ibi_stock_transfert_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['transfert'] = $this->model_transfert->get($filter, $field, $this->limit_page, $offset);

		$this->data['transfert_counts'] = $this->model_transfert->count_all($filter, $field);

		$config = [
			'base_url'     => 'transfert/'.$store.'/index/',
			'total_rows'   => $this->model_transfert->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Transfer List');
		$this->render('backend/standart/administrator/stock_transfert/transfert_list', $this->data);
	}
	
	/**
	* Add new pos_store_1_ibi_stock_transferts
	*
	*/
	public function add()
	{

		 $store=$this->uri->segment(2);

		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_1_ibi_stock_transfert_add');
         $this->data['stores']=$this->model_rm->getRequete('SELECT *FROM pos_ibi_stores WHERE STATUS_STORE="opened"  AND ID_STORE!='.$store.'');
		$this->template->title('Transfer New');
		$this->render('backend/standart/administrator/stock_transfert/transfert_add', $this->data);
	}

	/**
	* Add New Hospital Store 1 Ibi Stock Transferts
	*
	* @return JSON
	*/

	public function getCode(){
		
         $lastid = $this->model_rm->getRequeteOne("SELECT lpad(max(ID_ST)+1,5,0) as Maxcount , max(CODE_TRANSFERT) as CODE_TRANSFERT FROM  pos_store_1_ibi_stock_transfert");

          $code=$lastid['CODE_TRANSFERT'];

          if (date('m')==substr($code,10,2)) {
          	$i=1;
             return "TRNS${substr($code,4,5)+$i}/${date('m/Y')}";
         }else{
            return "TRNS00001/".date('m/Y');
         } 

    }

    public function insData(){
        exit();
    	$get=$this->model_rm->getList('pos_store_1_ibi_stock_transfert');
    	$i=1;
    	$idcode=0;
    	foreach ($get as $key => $value) {
            $getdate='';
    		$mydate= date("m/Y", strtotime($value['DATE_CREATION_ST']));
    	    
            if ($idcode>0) {
            	$getdate=$this->model_rm->getOne('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$idcode));

            	// if ($mydate==date("m/Y", strtotime($getdate['DATE_CREATION_ST']))) {
            	// $mycode='TRNS'.str_pad(substr($getdate['CODE_TRANSFERT'],4,5)+1, 5, "0", STR_PAD_LEFT).'/'.$mydate;
	            // }else{
	            //   $mycode='TRNS00001/'.$mydate;	
	            // }

            }elseif ($idcode==0) {
             $mycode='TRNS'.str_pad($value['ID_ST'], 5, "0", STR_PAD_LEFT).'/'.$mydate;	
            }
            
            
            


            $up1=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$value['ID_ST']), array('CODE_TRANSFERT'=>$mycode));

            $idcode=$value['ID_ST'];
            	
            	
            
  
           
    		// if (substr($getcode,10,2)==substr($next['DATE_CREATION_ST'],5,2)) {
    	       
    		

    		
    	
    		
    	}
    }


	public function add_save($store)
	{

		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		if (!$this->is_allowed('pos_store_1_ibi_stock_transfert_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		$this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
		$this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');

		if ($this->form_validation->run()) {

			if (!isset($_POST['NOM_ARTICLE'])) {
			echo json_encode([
				'success' => false,
				'message' => "le transfer doit contenir au moins un article"
				]);
			exit;
		}
		
			$save_data = [
				'TITLE_ST'=>$this->input->post('TITRE'),
				'DESTINATION_STORE_ST'=>$this->input->post('BOUTIQUE'),
				'FROM_STORE_ST'=>$store,
				'DATE_CREATION_ST'=>date('Y-m-d H:i:s'),
				'CREATED_BY_ST'=>get_user_data('id'),
				'CODE_TRANSFERT'=>$this->getCode()

			];

			
			$save_id = $this->model_transfert->store($save_data);
			
				for ($i=0; $i < count($_POST['NOM_ARTICLE']) ; $i++) { 
					$data=[
					'DESIGN_STI'=>$_POST['NOM_ARTICLE'][$i],
					'QUANTITY_STI'=>$_POST['Q_ARTICLE'][$i],
					'UNIT_PRICE_STI'=>$_POST['PRIX_ARTICLE'][$i],
					'TOTAL_PRICE_STI'=>$_POST['TOTAL_ARTICLE'][$i],
					'BARCODE_STI'=>$_POST['CODE'][$i],
					'DATE_CREATION_STI'=>date('Y-m-d H:i:s'),
					'REF_TRANSFER_STI'=>$save_id
				];

				$ins=$this->model_rm->insert('pos_store_1_ibi_stock_transfert_items',$data);

				}
			
			if ($save_id) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_id;
					$this->data['message'] = 'transfert envoyé avec success';
				} else {
					set_message('transfert envoyé ', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('transfert/'.$store.'/index/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('transfert/'.$store.'/index/');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	public function edit()
	{
       $store= $this->uri->segment(2);
       $id= $this->uri->segment(4);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_1_ibi_stock_transfert_update');

		$this->data['transfert'] = $this->model_transfert->find($id);
		$this->data['articles']=$this->model_rm->getList('pos_store_1_ibi_stock_transfert_items', array('REF_TRANSFER_STI'=>$id));

		$this->data['stores']=$this->model_rm->getRequete('SELECT *FROM pos_ibi_stores WHERE  ID_STORE!='.$store.'');

		$this->template->title('Transfer Update');
		$this->render('backend/standart/administrator/stock_transfert/transfert_update', $this->data);
	}

	/**
	* Update Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	public function edit_save($store=0,$id)
	{

		 if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		if (!$this->is_allowed('pos_store_1_ibi_stock_transfert_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		$this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
		$this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');
        // print_r($_POST['CODE']) ; exit();
		if ($this->form_validation->run()) {
		
			$save_data = [
				'TITLE_ST'=>$this->input->post('TITRE'),
				'DESTINATION_STORE_ST'=>$this->input->post('BOUTIQUE'),
				'FROM_STORE_ST'=>$store,
				'DATE_MOD_ST'=>date('Y-m-d H:i:s'),
				'MODIFIED_BY_ST'=>get_user_data('id')

			];
 
			
			$save_id = $this->model_transfert->change($id, $save_data);
			$del=$this->model_rm->delete('pos_store_1_ibi_stock_transfert_items',array('REF_TRANSFER_STI'=>$id));


			
				for ($i=0; $i < count($_POST['NOM_ARTICLE']) ; $i++) { 
					$data=[
					'DESIGN_STI'=>$_POST['NOM_ARTICLE'][$i],
					'QUANTITY_STI'=>$_POST['Q_ARTICLE'][$i],
					'UNIT_PRICE_STI'=>$_POST['PRIX_ARTICLE'][$i],
					'TOTAL_PRICE_STI'=>$_POST['TOTAL_ARTICLE'][$i],
					'BARCODE_STI'=>$_POST['CODE'][$i],
					'DATE_CREATION_STI'=>date('Y-m-d H:i:s'),
					'REF_TRANSFER_STI'=>$id
				];

				$ins=$this->model_rm->insert('pos_store_1_ibi_stock_transfert_items',$data);

				}
			if ($save_id) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/transfert/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('transfert/'.$store.'/index/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('transfert/'.$store.'/index/');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('pos_store_1_ibi_stock_transfert_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;
        
		if (!empty($id)) {

         $check=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$id))['APPROUVED_ST'];

         if ($check>0) {
         	set_message('ce transfert est deja encours', 'error');
         	redirect();
         	exit();
         }
 


		 $remove=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$id), array(
		 	'DELETE_STATUS_ST'=>1,
		 	'DELETE_DATE_ST'=>date('Y-m-d H:i:s'),
		 	'DELETE_BY_ST'=>get_user_data('id'),
		 	'DELETE_COMMENT_ST'=>$commentValue

		 ));	
		}

		if ($remove) {
            set_message('transfert annulé', 'success');
        } else {
            set_message('l\'annulation a échoué', 'error');
        }

		redirect_back();
	}

		/**
	* View view Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	public function view()
	{
        $store=$this->uri->segment(2);
        $id=$this->uri->segment(4);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_1_ibi_stock_transfert_view');

		$this->data['transfert'] = $this->model_transfert->join_avaiable()->filter_avaiable()->find($id);
		$this->data['produits']=$this->model_rm->getList('pos_store_1_ibi_stock_transfert_items', array('REF_TRANSFER_STI'=>$id));

		$this->template->title('Transfer Detail');
		$this->render('backend/standart/administrator/stock_transfert/transfert_view', $this->data);
	}
	
	/**
	* delete Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_store_1_ibi_stock_transfert = $this->model_transfert->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_store_1_ibi_stock_transfert",$delete_save,array("ID_ST"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_store_1_ibi_stock_transfert_export');

		$this->model_transfert->export('pos_store_1_ibi_stock_transfert', 'pos_store_1_ibi_stock_transfert');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_store_1_ibi_stock_transfert_export');

		$this->model_transfert->pdf('pos_store_1_ibi_stock_transfert', 'pos_store_1_ibi_stock_transfert');
	}


	public function getArticles(){
		$id=$this->input->post('id');
		$data=$this->model_rm->getList('pos_store_'.$id.'_ibi_articles', array('DELETE_STATUS_ARTICLE'=>0));
		echo json_encode($data);
	}
}


/* End of file pos_store_1_ibi_stock_transfert.php */
/* Location: ./application/controllers/administrator/Hospital Store 1 Ibi Stock Transfert.php */