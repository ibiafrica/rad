<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Unite Ingredients Controller
*| --------------------------------------------------------------------------
*| Unite Ingredients site
*|
*/
class Unite_articles extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_unite_articles');
	}

	/**
	* show all Unite Ingredientss
	*
	* @var $offset String
	*/
	public function index($store=0,$offset = 0)
	{
		$this->is_allowed('unite_articles_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['unite_articless'] = $this->model_unite_articles->get($filter, $field, $this->limit_page, $offset);
		$this->data['unite_articles_counts'] = $this->model_unite_articles->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/unite_articles/index/',
			'total_rows'   => $this->model_unite_articles->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Unite Ingredients List');
		$this->render('backend/standart/administrator/unite_articles/unite_articles_list', $this->data);
	}
	
	/**
	* Add new unite_articless
	*
	*/
	public function add()
	{
		$this->is_allowed('unite_articles_add');

		$this->template->title('Unite Ingredients New');
		$this->render('backend/standart/administrator/unite_articles/unite_articles_add', $this->data);
	}

	/**
	* Add New Unite Ingredientss
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		if (!$this->is_allowed('unite_articles_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGNATION_UNITE', 'NOM UNITE', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION_UNITE' => $this->input->post('DESIGNATION_UNITE'),
			];

			
			$save_unite_articles = $this->model_unite_articles->store($save_data);

			if ($save_unite_articles) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_unite_articles;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/unite_articles/edit/' . $save_unite_articles, 'Edit Unite'),
						anchor('administrator/unite_articles', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/unite_articles/edit/' . $save_unite_articles, 'Edit Unite Ingredients')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('unite_mesure/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('unite_mesure/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Unite Ingredientss
	*
	* @var $id String
	*/
	public function edit()
	{

		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		$this->is_allowed('unite_articles_update');

		$this->data['unite_articles'] = $this->model_unite_articles->find($id);

		$this->template->title('Unite Ingredients Update');
		$this->render('backend/standart/administrator/unite_articles/unite_articles_update', $this->data);
	}

	/**
	* Update Unite Ingredientss
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('unite_articles_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGNATION_UNITE', 'NOM UNITE', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION_UNITE' => $this->input->post('DESIGNATION_UNITE'),
			];

			
			$save_unite_articles = $this->model_unite_articles->change($id, $save_data);

			if ($save_unite_articles) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/unite_articles', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('unite_mesure/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('unite_mesure/'.$store.'/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Unite Ingredientss
	*
	* @var $id String
	*/
	public function delete()
	{
		$this->is_allowed('unite_articles_delete');

		$id = $this->uri->segment(4);

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->db->query('DELETE FROM unite_articles WHERE ID_UNITE='.$id);
		} 

		if ($remove) {
            set_message(cclang('has_been_deleted', 'unite_articles'), 'success');
        } else {
            set_message(cclang('error_delete', 'unite_articles'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Unite Ingredientss
	*
	* @var $id String
	*/
	public function view()
	{
		$this->is_allowed('unite_articles_view');

		$id = $this->uri->segment(4);

		$this->data['unite_articles'] = $this->model_unite_articles->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Unite Ingredients Detail');
		$this->render('backend/standart/administrator/unite_articles/unite_articles_view', $this->data);
	}
	
	/**
	* delete Unite Ingredientss
	*
	* @var $id String
	*/
	private function _remove($store,$id)
	{
		$unite_articles = $this->model_unite_articles->find($id);

		return $this->model_unite_articles->remove($store,$id);
		         
		 // $delete_save = array(
			// 					'DELETED_STATUS_UNITY' => 1,
			// 					'DELETED_DATE_UNITY' => date('Y-m-d H:i:s'),
			// 					'DELETED_USER_UNITY' => get_user_data('id'),
								
			// 				);

		 //        $remove = $this->db->update("unite_articles",$delete_save,array("ID_UNITE"=>$id));
		//return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('unite_articles_export');

		$this->model_unite_articles->export('unite_articles', 'unite_articles');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('unite_articles_export');

		$this->model_unite_articles->pdf('unite_articles', 'unite_articles');
	}
}


/* End of file unite_articles.php */
/* Location: ./application/controllers/administrator/Unite Ingredients.php */