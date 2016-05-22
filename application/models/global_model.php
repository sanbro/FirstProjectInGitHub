<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Global_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function dhx_conn(){
        $database = $this->load->database('default',TRUE);        
        $connection = mysql_connect($database->hostname, $database->username, $database->password) 
    or die("Unable to connect to MySQL");
        mysql_select_db($database->database) or die(mysql_error());
        return $connection;
    }

     function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        // $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result($array) : $query->row() ;
        return $result;
    }
public function getall($table,$field,$where,$order,$group,$limit,$one=false)
    {
        $query ='SELECT '.$field.' FROM '.$table;
        if($where !=null)
        {
            $query .=' WHERE '.$where;
        }
        if($order!=null)
        {
            $query .= ' ORDER BY '.$order;
        }
        if($group!=null)
        {
            $query .= ' GROUP BY '.$group;
        }
        if($limit!=null)
        {
            $query .= ' LIMIT '.$limit;
        }
        //var_dump($query);
        $query=$this->db->query($query);
        if($one!=false)
        {
            return $query->result();
        } else{ return $query->row();
        //var_dump($query->row());
         }
    }

    function add($table,$data){
        $this->db->insert($table,$data);
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }return FALSE;
    }

    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }
        
        return FALSE;        
    }   

    function update($table,$field,$fieldid,$data){
        $this->db->where($field,$fieldid);
        $this->db->update($table,$data);
        if ($this->db->affected_rows() == '1'){
            return TRUE;
        }      
        return FALSE; 
    }

    function getCount($size = NULL,$field,$table){
        if($size != NULL){
        $query = $this->db->query('
            SELECT count('.$field.') as count from '.$table.' where '.$field.'='.$size.' group by '.$field.'
            ');
    }else{ 
        $query = $this->db->query('
            SELECT count('.$field.') as count from '.$table);
    }
        if($query->num_rows()>0){
            $rows = $query->row();
            return $rows->count;
        }return NULL;
    }
}