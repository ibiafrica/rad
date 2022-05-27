<?php 
 
 /**
  * 
  */
 class Model_dashboard extends MY_Model
 {
  
    public function highchart()
    {
    	
    	$this->db->select('f.LETTER,COUNT(f.PATIENT_FILE_ID)');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H" AND f.PATIENT_FILE_STATUS=0 AND MONTH(f.DATE_CREATION_PATIENT_FILE)=10');
    	$donnee = $this->db->get()->row();
    	return $donnee;
        
    }

    public function Janvier()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from("patients p,patient_file f");
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','01')");
    	$donnee = $this->db->get();
    	 if ($donnee->num_rows() >0) {
    	 	return $donnee->row()->nombre;
    	 }else{
    	 	return 0;
    	 }
    }

    public function Fevrier()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','02')");
	    	
	    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }
    

    public function Mars()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','03')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Avril()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H'  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','04')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mai()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','05')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
	  }

     public function Juin()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','06')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


        public function Juillet()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','07')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Aout()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','08')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Septembre()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H'  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','09')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Octobre()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','10')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows()>0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Novembre()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H'  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','11')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

     public function Decembre()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H'  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','12')");
    		    	$donnee = $this->db->get();
	    	 if ($donnee->num_rows() >0) {
	    	 	return $donnee->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    // Patients Hospitaliser avec bon de commande 

        public function Janvier_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from("patients p,patient_file f");
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='H' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','01') AND f.BON_DE_COMMANDE<>'' ");
    	$donnee_h_b = $this->db->get();
        	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    	
    }

    public function Fevrier_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","02") AND f.BON_DE_COMMANDE<>""');
	    	
	    	$donnee_h_b = $this->db->get();
	        	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mars_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","03") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	       	 if ($donnee_h_b->num_rows()>0) {

    		    	return $donnee_h_b->row()->nombre;
	    		
	    	 	 
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Avril_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H" AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","04") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	        	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 	 
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mai_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","05") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	        	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;

	    	 }else{
	    	 	return 0;
	    	 }
	  }

     public function Juin_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","06") AND f.BON_DE_COMMANDE<>"" ');
    		    	$donnee_h_b = $this->db->get();
	    	    	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


        public function Juillet_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","07") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	        	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Aout_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","08") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	    	    	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 	 
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Septembre_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","09") AND f.BON_DE_COMMANDE<>"" ');
    		    	$donnee_h_b = $this->db->get();
  	              if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;

	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Octobre_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","10") AND f.BON_DE_COMMANDE<>"" ');
    		    $donnee_h_b = $this->db->get();
	    	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Novembre_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","11") AND f.BON_DE_COMMANDE<>""');
    		    	$donnee_h_b = $this->db->get();
	    	 if ($donnee_h_b->num_rows()>0) {
    		    	return $donnee_h_b->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

     public function Decembre_h_b()
    {
    	$this->db->select('f.BON_DE_COMMANDE,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="H"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","12") AND f.BON_DE_COMMANDE<>"" ');
    		    	$donnee_h_b = $this->db->get();
	        	 if ($donnee_h_b->num_rows()>0) {

    		    	return $donnee_h_b->row()->nombre;
	    	 	 
	    	 }else{
	    	 	return 0;
	    	 }
    }

    
    //Patients Ambulant

    public function Janvier_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from("patients p,patient_file f");
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='P'  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','01')");
    	$donnee_p = $this->db->get();
    	 if ($donnee_p->num_rows() >0) {
    	 	return $donnee_p->row()->nombre;
    	 }else{
    	 	return 0;
    	 }
    	
    }

    public function Fevrier_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P" AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","02")');
	    	
	    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mars_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","03")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Avril_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="p"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","04")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mai_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","05")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
	  }

     public function Juin_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","06")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


        public function Juillet_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","07")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Aout_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","08")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Septembre_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","09")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Octobre_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","10")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows()>0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Novembre_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(p.ID_PATIENT)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="P"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","11")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

     public function Decembre_P()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where("p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER='P' AND DATE_FORMAT(p.DATE_CREATED_PATIENT,'%Y-%m')=CONCAT(DATE_FORMAT(now(),'%Y'),'-','12')");
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


        //Patients Ambulant

    public function Janvier_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from("patients p,patient_file f");
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","01")');
    	$donnee_p = $this->db->get();
    	 if ($donnee_p->num_rows() >0) {
    	 	return $donnee_p->row()->nombre;
    	 }else{
    	 	return 0;
    	 }
    	
    }

    public function Fevrier_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","02")');
	    	
	    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mars_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    $this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","03")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Avril_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","04")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Mai_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","05")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
	  }

     public function Juin_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","06")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


        public function Juillet_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","07")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Aout_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","08")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Septembre_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","09")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

        public function Octobre_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","10")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows()>0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

    public function Novembre_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"  AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","11")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }

     public function Decembre_p_b()
    {
    	$this->db->select('f.LETTER,COUNT(DISTINCT(f.PATIENT_ID)) AS nombre');
    	$this->db->from('patients p,patient_file f');
    	$this->db->where('p.ID_PATIENT=f.PATIENT_ID AND p.DELETE_STATUS_PATIENT=0 AND f.DELETED_STATUS_PATIENT_FILE=0 AND f.LETTER="B"   AND DATE_FORMAT(p.DATE_CREATED_PATIENT,"%Y-%m")=CONCAT(DATE_FORMAT(now(),"%Y"),"-","12")');
    		    	$donnee_p = $this->db->get();
	    	 if ($donnee_p->num_rows() >0) {
	    	 	return $donnee_p->row()->nombre;
	    	 }else{
	    	 	return 0;
	    	 }
    }


    public function getList($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->result_array();
    }

        function getRequete($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->result_array();
      }
    }


      function getRequeteOne($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->row_array();
      }
    }

    function getListLimit($table,$limit,$cond=array())
    {
     $this->db->limit($limit);
     $this->db->where($cond);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

 }

?>