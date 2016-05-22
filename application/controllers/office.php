<?php defined('BASEPATH') OR exit('no direct script is allowed');
/**
* 
*/
class Office extends CI_Controller
{
	
	function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper(array('url','form','language','script_helper','html'));
	$this->load->library('ion_auth');
	$this->load->library(array('form_validation','session','pagination'));
	$this->load->model('global_model','',TRUE);
    $this->load->model('office_model','',TRUE);
	
    }
function index(){
	if (!$this->ion_auth->logged_in())redirect('auth/login','refresh');
	$date['user']=$this->session->userdata('email'); 

		/*grid description*/
   
    $data['gridheader']= 'Id,Office Name,Email,Contact Number,Database Name';
    $data['attachheader']="#text_filter,#text_filter,#text_filter,#text_filter,#text_filter";
    $data['width']='50,200,200,250,150';
    $data['colalign']="center,center,center,center,center";
    $data['coltypes']="ro,ro,ro,ro,ro";
    $data['sorting']="str,str,str,str,str";
    $data['hiddenarray']=array(0);
    $data['hiddencount']=count($data['hiddenarray']);
    $data['loadxml']='office/conn_userlist';
    $data['paginglimit']=10;
    $data['showpageno']=20;
    $data['toolbarxml']='office/toolbar_userlist';
    $data['title']='Office List';
   
    $data['editwidth']='750';
    $data['editheight']='300';

    //function calling 5
        $data['loadxml'] =  'office/conn_userlist';
        $data['toolbarxml'] = 'office/toolbar_userlist';
        $data['attachURLForEdit'] = 'office/editoffice';
        $data['attachURLForDelete'] = 'office/deleteoffice';
        $data['attachURLForAdd'] = 'office/add_office'; 
        $data['attachURlForPermssion']='office/add_perm';
        $data['attachURlForList']='office/listall';
       // $data['header']='header';
        $data['sidebar']='sidebar';
        $data['page'] = "setup/office/officeadd";
		$this->load->view('main',$data);
}

public function conn_userlist()
    {
        if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		include_once ("dhtmlx/connector/codebase/grid_connector.php");  		
        $conn = $this->global_model->dhx_conn();
        $grid = new GridConnector($conn);      
        $sql ="SELECT `ofc_id`,`name`,`email`,`phone`,`dbname` FROM `office` ORDER BY `ofc_id` DESC";
		$grid->event->attach("beforeRender","getAction");
		function getAction($item){
        	global $CI;       	

		}
       $grid->render_sql($sql, "ofc_id","ofc_id,name,email,phone,dbname");
    }

    public function toolbar_userlist(){
        if(!$this->ion_auth->logged_in()) redirect('auth', 'refresh');
        header("Content-Type:text/xml");
        echo '<?xml version="1.0" encoding="utf-8"?>
       <toolbar>
        <item id="add" type="button" text="ADD"  img="add.png" class="btn" data-dismiss="modal"/>       
        <item id="edit" type="button" text="EDIT"  img="edit-icon.png" class="btn" data-dismiss="modal"/>
        <item id="delete" type="button" text="DELETE" img="file_delete.png"/>           
        </toolbar>';
    }
     function add_office(){
        if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');  
       /* common part*/
        $data['user']=$this->session->userdata('email');
        /*end of common part*/
        $data['formTitle'] = 'Add Office Information';
        $data['formUrl']='office/create_office';
        $data['page'] = "setup/office/addoffice";        
        $this->load->view('main',$data);     
        
    }
    function create_office(){

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())  redirect('auth/login', 'refresh');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('office_name','Office_name','required');
        $this->form_validation->set_rules('email','Email','valid_email|required');
        $this->form_validation->set_rules('phone','Phone','required');
        $this->form_validation->set_rules('dbname','Dbname','xss_clean|required');
        if ($this->form_validation->run() == true) {
       
        	$all_data = array('name' =>$_POST['office_name'] ,
        	                   'email'=>$_POST['email'],
        	                   'phone'=>$_POST['phone'],
        	                   'dbname'=>$_POST['dbname'] 
        	                   );
        	if($this->global_model->add('office',$all_data) == TRUE){
				$this->session->flashdata("success","Successfully added Office Data");
				$result['status'] = 1;
				$result['message'] = "Successfully added Office Data";
		}
		header("content-type : application/json", true);
		print_r(json_encode($result));
		exit;
        }
        else{
        /*  $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));*/
         $data['status']=0;
         $data['error']=validation_errors();
         header("content-type : application/json", true);
         print_r(json_encode($data));
         exit;
        }

    }
function editoffice($id){
    if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');  
       /* common part*/
        $data['user']=$this->session->userdata('email');
        /*end of common part*/
        $data['formTitle'] = 'Add Office Information';
        $data['formUrl']='office/updateoffice/'.$id;
        $data['content']=$this->office_model->getAllOfficecontent($id);
        $data['page'] = "setup/office/addoffice";        
        $this->load->view('main',$data);  
}

function updateoffice($id){
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())  redirect('auth/login', 'refresh');
       
        $this->form_validation->set_rules('office_name','Office_name','required');
        $this->form_validation->set_rules('email','Email','valid_email|required');
        $this->form_validation->set_rules('phone','Phone','required');
        $this->form_validation->set_rules('dbname','Dbname','xss_clean|required');
        if ($this->form_validation->run() == true) {
       
            $all_data = array('name' =>$_POST['office_name'] ,
                               'email'=>$_POST['email'],
                               'phone'=>$_POST['phone'],
                               'dbname'=>$_POST['dbname'] 
                               );
            if($this->global_model->update('office','ofc_id',$id,$all_data) == TRUE){
                $this->session->flashdata("success","Successfully added Office Data");
                $result['status'] = 1;
                $result['message'] = "Successfully added Office Data";
        }
        header("content-type : application/json", true);
        print_r(json_encode($result));
        exit;
        }
        else{
        /*  $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));*/
         $data['status']=0;
         $data['error']=validation_errors();
         header("content-type : application/json", true);
         print_r(json_encode($data));
         exit;
        }

}
function deleteoffice($id){       
        if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');      
        echo $this->global_model->delete('office','ofc_id',$id);
    }
}
?>