<?php

header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

// $_SESSION['db_year'] = 'ibiafric_gts2021';


class App_api extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_registers');
    }

    public function getAllCommandes()
    {
        $code=$this->input->get('code');
        $data= $this->db->query("SELECT C.*,CONCAT(S.NOM_CLIENT,' ',S.PRENOM_CLIENT) AS CLIENT 
        FROM `pos_store_2_ibi_commandes` C 
        JOIN pos_ibi_clients S ON S.ID_CLIENT = C.REF_CLIENT_COMMAND
        WHERE CODE_COMMAND LIKE '%$code%' ORDER BY ID_COMMAND DESC LIMIT 50");
        $result=$data->result();
        echo json_encode($result);
        exit;
    }

    public function getAllProformas()
    {
        $code=$this->input->get('code');
        $data= $this->db->query("SELECT C.*,CONCAT(S.NOM_CLIENT,' ',S.PRENOM_CLIENT) AS CLIENT 
        FROM `pos_store_2_ibi_proforma` C 
        JOIN pos_ibi_clients S ON S.ID_CLIENT = C.REF_CLIENT_PROFORMA
        WHERE CODE_PROFORMA LIKE '%$code%' ORDER BY ID_PROFORMA DESC LIMIT 50");
        $result=$data->result();
        echo json_encode($result);
        exit;
    }


    public function getAllArticles()
    {
        $data= $this->db->query('SELECT * FROM pos_store_2_ibi_articles');
        $result=$data->result();
        echo json_encode($result);
        exit;
    }

    public function getUser($pin)
    {
        $data= $this->db->query('SELECT id,email,username,full_name FROM aauth_users WHERE pin="'.$pin.'"');
        $result=$data->row();
        echo json_encode($result);
        exit;
    }

    public function insertCommande(){
      

        $data = json_decode(file_get_contents("php://input"));


        $code = $this->model_registers->random_code(2);

        $total= 0 ;


        for ($i=0; $i < count($data->product); $i++) { 

            $save_data_prod = [
                'REF_PRODUCT_CODEBAR_COMMAND_PROD' => $data->product[$i]->codebar,
                'REF_COMMAND_CODE_PROD' => $code,
                'QUANTITE_COMMAND_PROD' => $data->product[$i]->amount,
                'PRIX_COMMAND_PROD' => $data->product[$i]->price,
                'PRIX_TOTAL_COMMAND_PROD' => $data->product[$i]->price*$data->product[$i]->amount,
                'DISCOUNT_TYPE_COMMAND_PROD' => 'percentage',
                'DISCOUNT_AMOUNT_COMMAND_PROD' => 0,
                'DISCOUNT_PERCENT_COMMAND_PROD' => 0,
                //'DISCOUNT_PROMOTION_COMMAND_PROD' => 0,
                'NAME_COMMAND_PROD' =>  $data->product[$i]->design,
                            
            ];
            
            $sql = $this->db->insert('pos_store_2_ibi_commandes_produits', $save_data_prod);

            $total += $data->product[$i]->price*$data->product[$i]->amount;

        }
       // }
    
            if($sql){

                $save_data = [
                    'TITRE_COMMAND' => $data->title,
                    'CODE_COMMAND' => $code,
                    'REF_CLIENT_COMMAND' => $data->refClient,
                    'TYPE_COMMAND' => 'ibi_order_attente',
                    'DATE_CREATION_COMMAND' => date('Y-m-d H:i:s'),
                    'AUTHOR_COMMAND' => get_user_data('id'),
                    'TOTAL_COMMAND' => $total,
                    'TVA_COMMAND' => $total*0.18,
                                
                ];
                
                $save = $this->db->insert('pos_store_2_ibi_commandes',$save_data);

                if($save){
                    $this->data['success'] = true;                        
                    echo json_encode($this->data);
                }

                else{
                    $this->data['success'] = false;
                    echo json_encode($this->data);                     
                }
                            
            }
        
        exit;
        
    }

    public function insertProforma(){
      

        $data = json_decode(file_get_contents("php://input"));

        $code = $this->model_registers->shuffle_code(2);

        $total= 0 ;


        for ($i=0; $i < count($data->product); $i++) { 

            $save_data_prod = [
                'REF_PRODUCT_CODEBAR_PROFORMA_PROD' => $data->product[$i]->codebar,
                'REF_PROFORMA_CODE_PROD' => $code,
                'QUANTITE_PROFORMA_PROD' => $data->product[$i]->amount,
                'PRIX_PROFORMA_PROD' => $data->product[$i]->price,
                'PRIX_TOTAL_PROFORMA_PROD' => $data->product[$i]->price*$data->product[$i]->amount,
                'DISCOUNT_TYPE_PROFORMA_PROD' => 'percentage',
                'DISCOUNT_AMOUNT_PROFORMA_PROD' => 0,
                'DISCOUNT_PERCENT_PROFORMA_PROD' => 0,
                //'DISCOUNT_PROMOTION_COMMAND_PROD' => 0,
                'NAME_PROFORMA_PROD' =>  $data->product[$i]->design,
                            
            ];
            
            $sql = $this->db->insert('pos_store_2_ibi_proforma_produits', $save_data_prod);

            $total += $data->product[$i]->price*$data->product[$i]->amount;

        }
       // }
    
            if($sql){

                $save_data = [
                    'TITRE_PROFORMA' => $data->title,
                    'CODE_PROFORMA' => $code,
                    'REF_CLIENT_PROFORMA' => $data->refClient,
                    'TYPE_PROFORMA' => 'ibi_proforma_pv',
                    'DATE_CREATION_PROFORMA' => date('Y-m-d H:i:s'),
                    'AUTHOR_PROFORMA' => get_user_data('id'),
                    'TOTAL_PROFORMA' => $total,
                    'TVA_PROFORMA' => $total*0.18,
                                
                ];
                
                $save = $this->db->insert('pos_store_2_ibi_proforma',$save_data);

                if($save){
                    $this->data['success'] = true;                        
                    echo json_encode($this->data);
                }

                else{
                    $this->data['success'] = false;
                    echo json_encode($this->data);                     
                }
                            
            }
        
        exit;
        
    }

    public function getAllCommandesDetails()
    {
        $code=$this->input->get('code');
        $data = $this->db->query('SELECT * FROM pos_store_2_ibi_commandes_produits WHERE REF_COMMAND_CODE_PROD="'.$code.'"');
        if ($data->result()) {
            $result=$data->result();
        } else {
            $result='';
        }
        echo json_encode($result);
        exit;
    }
    
    public function deleteCommandeDetail()
    {
        $id=$this->input->get('id');
        $data= $this->db->query('DELETE FROM pos_store_2_ibi_commandes_produits WHERE ID_COMMAND_PROD="'.$id.'"');
       
        exit;
    }

    public function getAllProformasDetails()
    {
        $code=$this->input->get('code');
        $data = $this->db->query('SELECT * FROM pos_store_2_ibi_proforma_produits WHERE REF_PROFORMA_CODE_PROD="'.$code.'"');
        if ($data->result()) {
            $result=$data->result();
        } else {
            $result='';
        }
        echo json_encode($result);
        exit;
    }
    
    public function deleteProformaDetail()
    {
        $id=$this->input->get('id');
        $data= $this->db->query('DELETE FROM pos_store_2_ibi_proforma_produits WHERE ID_PROFORMA_PROD="'.$id.'"');
       
        exit;
    }

    public function getClients()
    {
        $data= $this->db->query('SELECT * FROM pos_ibi_clients LIMIT 100');
        $result=$data->result();
        echo json_encode($result);
        exit;
    }

    public function getArticles()
    {
        $i=$this->input->get('i');
        $data= $this->db->query("SELECT ID_ARTICLE as idArticle,CODEBAR_ARTICLE AS codebar,DESIGN_ARTICLE as design,PRIX_DE_VENTE_ARTICLE as price,1 as amount 
        FROM pos_store_2_ibi_articles 
        WHERE DESIGN_ARTICLE LIKE '%$i%' OR CODEBAR_ARTICLE LIKE '%$i%' LIMIT 10");
        $result=$data->result();
        echo json_encode($result);
        exit;
    }

    public function login(){

         $datas = json_decode(file_get_contents("php://input"));

        // if ($this->aauth->login($data->username, $data->password,FALSE,'2021')) {

           
            $user = $this->getUser($datas->pin);


            if($user){

                 
                $data = array(
                    'username' => $user->username,
                    'email' => $user->email,
                    'full_name' => $user->full_name
                );

                $this->data['success'] = true;
          
                return json_encode($this->data);

                exit;

            }
            else{

                return false;

                exit;
            }        

        
  
    }
}
