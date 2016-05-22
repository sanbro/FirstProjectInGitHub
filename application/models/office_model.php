<?php if (! defined('BASEPATH')) exit('no direct script is allowed');
/**
* 
*/
class Office_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function getAllOfficecontent($id){
		$query=$this->db->query('SELECT ofc_id as id,name,email,phone,dbname
			from office where ofc_id='.$id);
		if ($query->num_rows()>0) {
			return $query->row();
		}else{
			return null;
		}
	}
}

 ?>