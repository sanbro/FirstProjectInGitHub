<?php defined('BASEPATH') or exit('no direct script allowed');
/**
* 
*/
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		parent::__construct();
	$this->load->database();
	$this->load->helper(array('url','form','language','script_helper','html'));
	$this->load->library('ion_auth');
    $this->load->library('encrypt');
	$this->load->library(array('form_validation','session','pagination'));
	$this->load->model('global_model','',TRUE);
    $this->load->model('office_model','',TRUE);
	}
function index(){
	if (!$this->ion_auth->logged_in())redirect('auth/login','refresh');
	$date['user']=$this->session->userdata('email'); 

		/*grid description*/
   
    $data['gridheader']= 'Id,Office Name,First Name, Last Name,Username,Email,Contact Number,Password';
    $data['attachheader']="#text_filter,#select_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter";
    $data['width']='50,150,150,100,100,150,100,100';
    $data['colalign']="center,center,center,center,center,center,center,center";
    $data['coltypes']="ro,ro,ro,ro,ro,ro,ro,ro";
    $data['sorting']="str,str,str,str,str,str,str,str";
    $data['hiddenarray']=array(0);
    $data['hiddencount']=count($data['hiddenarray']);
    $data['loadxml']='user/conn_userlist';
    $data['paginglimit']=10;
    $data['showpageno']=20;
    $data['toolbarxml']='user/toolbar_userlist';
    $data['title']='User List';
   
    $data['editwidth']='750';
    $data['editheight']='300';

    //function calling 5
        $data['loadxml'] =  'user/conn_userlist';
        $data['toolbarxml'] = 'user/toolbar_userlist';
        $data['attachURLForEdit'] = 'user/edituser';
        $data['attachURLForDelete'] = 'user/deleteuser';
        $data['attachURLForAdd'] = 'user/add_user'; 
       $data['attachURlForList']='user/listall';
       // $data['header']='header';
        $data['sidebar']='sidebar';
        $data['page'] = "setup/user/useradd";
		$this->load->view('main',$data);
}

public function conn_userlist()
    {
        if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');
		include_once ("dhtmlx/connector/codebase/grid_connector.php");  		
        $conn = $this->global_model->dhx_conn();
        $grid = new GridConnector($conn);      
        $sql ="SELECT `usr_id`,`first_name`,`last_name`,`username`,`password`,`email`,`phone`,`ofc_id` FROM `userlist` ORDER BY `usr_id` DESC";
		$grid->event->attach("beforeRender","getAction");
		function getAction($item){
        	global $CI;   
         $ofid=$item->get_value('ofc_id');    	
         $officename =$CI->global_model->getall('office','name','ofc_id='.$ofid,null,null,null,false);
         $item->set_value('name',$officename->name);
         
         $pass=$item->get_value('password');
         $newpass=$CI->encrypt->decode($pass);
         $item->set_value('password',$newpass);
		}
       $grid->render_sql($sql, "usr_id","usr_id,name,first_name,last_name,username,email,phone,password");
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
     function add_user(){
        if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');  
       /* common part*/
        $data['user']=$this->session->userdata('email');
        /*end of common part*/
        $data['office']=$this->global_model->getall('office','ofc_id,name',null,null,null,null,true);
        $data['formTitle'] = 'Add User Information';
        $data['formUrl']='user/create_user';
        $data['page'] = "setup/user/userform";        
        $this->load->view('main',$data);     
        
    }
    function create_user(){

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())  redirect('auth/login', 'refresh');
       
        
        $this->form_validation->set_rules('office','Office','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm','Password_confirm','required');
        $this->form_validation->set_rules('first_name','First_name','xss_clean|required');
        $this->form_validation->set_rules('last_name','Last_name','xss_clean|required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('phone','Phone','required');
        
        if ($this->form_validation->run() == true) {

           $pass=$_POST['password'];
           $epass=$this->encrypt->encode($pass);
        	$all_data = array('first_name' =>$_POST['first_name'] ,
                               'last_name' =>$_POST['last_name'] ,
                               'username' =>$_POST['username'] ,
                               'password' =>$epass,
        	                   'email'=>$_POST['email'],
        	                   'phone'=>$_POST['phone'],
        	                   'ofc_id'=>$_POST['office'] 
        	                   );
        	if($this->global_model->add('userlist',$all_data) == TRUE){
				$this->session->flashdata("success","Successfully added user Data");
				$result['status'] = 1;
				$result['message'] = "Successfully added user Data";
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
function edituser($id){
    if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');  
       /* common part*/
        $data['user']=$this->session->userdata('email');
        /*end of common part*/
        $data['formTitle'] = 'Add User Information';
        $data['formUrl']='user/updateuser/'.$id;
        $data['content']=$this->global_model->getall('userlist','*','usr_id='.$id,null,null,null,false);
        $data['office']=$this->global_model->getall('office','ofc_id,name',null,null,null,null,true);
        $data['page'] = "setup/user/userform";        
        $this->load->view('main',$data);  
}

function updateuser($id){
     if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())  redirect('auth/login', 'refresh');
       
        $this->form_validation->set_rules('office','Office','required');
        $this->form_validation->set_rules('username','Username','required');
        
        $this->form_validation->set_rules('first_name','First_name','xss_clean|required');
        $this->form_validation->set_rules('last_name','Last_name','xss_clean|required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('phone','Phone','required');
        if ($this->input->post('password')) {
        $this->form_validation->set_rules('password','Password','required|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm','Password_confirm','required');
        }
        if ($this->form_validation->run() == true) {
       
            $all_data = array('first_name' =>$_POST['first_name'] ,
                               'last_name' =>$_POST['last_name'] ,
                               'username' =>$_POST['username'] ,
                               'email'=>$_POST['email'],
                               'phone'=>$_POST['phone'],
                               'ofc_id'=>$_POST['office'] 
                               );
            if ($this->input->post('password')) {
               
               $pass=$_POST['password'];
               $epass=$this->encrypt->encode($pass);
               $all_data= array('password' =>$epass );
           }
            if($this->global_model->update('userlist','usr_id',$id,$all_data) == TRUE){
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
function deleteuser($id){       
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())  redirect('auth/login', 'refresh');
        echo $this->global_model->delete('userlist','usr_id',$id);
    }
}
?>