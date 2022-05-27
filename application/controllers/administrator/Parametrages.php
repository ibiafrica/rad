<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Auth Controller
*| --------------------------------------------------------------------------
*| For authentication
*|
*/
class Parametrages extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}

	public function index(){
        $this->data['info']=$this->model_rm->getOne('parametrage', array('ID_PARAMS'=>1));
		$this->render('backend/standart/parametrages_view',$this->data);
	}


	public function imageUploader($file){

		    $target_dir = "uploads/";
			$target_file = $target_dir . basename($file["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($file["tmp_name"]);
			  if($check !== false) {
			    echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    echo "File is not an image.";
			    $uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  echo "Sorry, file already exists.";
			  $uploadOk = 0;
			}

			

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($file["tmp_name"], $target_file)) {
			    echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
			}
	}


	public function set_status()
	{
		
		$status = $this->input->post('status');
		

		$update_status = $this->model_rm->update('autorisation', array('ID_AUTORISATION'=>1),
		 [
			'STATUS' => $status == 'inactive' ? 1 : 0
		]);
		
		if ($update_status) {
			$this->response = [
				'success' => true,
				'message' => 'autorisation status updated',
			];
		} else {
			$this->response = [
				'success' => false,
				'message' => cclang('data_not_change')
			];
		}

		return $this->response($this->response);
	}
   

	public function upload_image($file, $image_name)	{
		  
		  
		  $extension = explode('.', $file['fileToUpload']['name']);
		  $new_name = 'logo' . '.' . $extension[1];
		  // $name= basename($_FILES["fileToUpload"]["name"]);
		  $destination = FCPATH .'uploads/logo/'; 
		  

	       if (!is_dir($destination)) {
	            mkdir($destination, 0777, true);
	        }

	        // if($image_name != ''){
         //     unlink($destination.$image_name);
         //   }
	        
		  move_uploaded_file($file['fileToUpload']['tmp_name'], $destination.$new_name);
		  return $new_name;

		   
		
	}

	public function add_save()
	{       
		    
           
            $save_data = [
				'NOM_PARAMS' => $this->input->post('NOM'),
				'EMAIL_PARAMS' => $this->input->post('EMAIL'),
				'NIF_PARAMS' => $this->input->post('NIF'),
				'RC_PARAMS' => $this->input->post('RC'),
				'PHONE_PARAMS' => $this->input->post('PHONE'),
				'ADRESSE_PARAMS' => $this->input->post('ADRESSE'),
			
			];

		    if ($_FILES['fileToUpload']['name']!='') {


		    	$img=$this->input->post('logo_name');
		    	$image=$this->upload_image($_FILES, $img);

		    	$save_data['LOGO_PARAMS']=$image;
				
		    }



			

			 
		     $ins=$this->model_rm->update('parametrage', array('ID_PARAMS'=>1), $save_data);


			if ($ins) {
				
					$this->data['success'] = true;
					$this->data['id'] 	   = 1;
					$this->data['message'] = "mise ajour faite avec success";
				 
			} else {
				
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
			
			}

		

		echo json_encode($this->data);
	}

}