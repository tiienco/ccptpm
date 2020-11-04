<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {
    // private $db;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        // $error = $this->db->error();
        // if(!empty($error['code'])){
        //     print_r($error);
        //     echo '<br>DB Eror<br>';
        //     echo 'connect DB mới<br>';
        //     $this->db2 =  $this->load->database('dev', TRUE);
        //     print($this->db2);
        //     $error = $this->db2->error();
        //     print_r($error);
        //     if(!empty($error['code'])) echo 'DM Mới error<br>';
        //     else echo 'DB Mới succes<br>';
        // }else echo 'DB OK<br>';
        // print_r($connected);
        // $this->db =  $this->load->database('default_old', TRUE);
        
        // $a = $this->show_by_id('menu',array('id' => 1));
        
    }
 

    //------- INSERT
    function insert($table,$insert){
        $query = $this->db->INSERT($table,$insert);
        return $this->db->insert_id();  
    }  
    //------- INSERT
    function insert_batch($table,$insert){
        $query = $this->db->insert_batch($table,$insert);
    }
    //------- SHOW BY ID
    function show_by_id($table,$id,$select=''){  
        // $a = $this->db->where($id)->get($table);
        // echo $this->db->last_query($a); 
        if($select) return $this->db->select($select)->where($id)->limit(1)->get($table)->row_array(); 
        else return $this->db->where($id)->limit(1)->get($table)->row_array();
    }

    function customQuery($sql,$arr=''){
        if($arr!='')
            return $this->db->query($sql)->result_array();
        else return $this->db->query($sql)->row_array();
    }

    function deleteQuery($sql){
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    function show_where($table,$where,$select=''){
        if($select) return $this->db->select($select)->where($where)->get($table)->result_array();
        else return $this->db->where($where)->get($table)->result_array();
    }
    //-------SHOW  ORDER LIMIT WHERE
    function show_pagination($table,$limit, $start,$order_by,$where,$select='') {  
        if($select) return $this->db->select($select)
                                    ->where($where)
                                    ->order_by($order_by)
                                    ->LIMIT($limit, $start)
                                    ->get($table)->result_array();
        else return $this->db->where($where)
                            ->order_by($order_by)
                            ->LIMIT($limit, $start)
                            ->get($table)->result_array(); 
    }
    function show_order($table,$order_by,$select=''){
        if($select) return $this->db->select($select)                                   
                                    ->order_by($order_by)                                  
                                    ->get($table)->result_array();
        else return $this->db->order_by($order_by)
                            ->get($table)
                            ->result_array();

    }
    function show_order_where($table,$order_by,$where,$select=''){
        if($select) return $this->db->select($select) 
                                    ->where($where)                                  
                                    ->order_by($order_by)                                  
                                    ->get($table)->result_array();
        else return $this->db->where($where)
                            ->order_by($order_by)
                            ->get($table)
                            ->result_array();
    }
    //------- SHOW ALL
    function show_all($table,$select=''){
        if($select='') return $this->db->select($select)->get($table)->result_array(); 
        else return $this->db->select()->get($table)->result_array(); 
    } 
    //------- COUNT NUMROW
    function count_where($table,$where){        
        return $this->db->where($where)
                        ->get($table)
                        ->num_rows();       
    }

    function count_all($table){
        return $this->db->count_all($table); 
    }

    function count_all_result($table,$where){
        return $this->db->where($where)->count_all_results($table); 
    }

    //------- DELETE
    function delete($table,$where){
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    //------- UPDATE
    function update($table,$where,$update){
        $this->db->update($table, $update, $where);
        return $this->db->affected_rows();
    }
    function update_custom($sql){
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    function find_in($table,$search,$list,$where='',$arr=''){
        if($where !='') $where = " AND ".$where;
        $sql = "SELECT * FROM ".$table."
                WHERE FIND_IN_SET('".$search."',".$list.") ".$where;
                // echo $sql;exit;
        if($arr!='')
            return $this->db->query($sql)->result_array();
        else return $this->db->query($sql)->row_array();  
    }

    function getProvince($select=''){
        if($select) $sql = "SELECT ".$select." FROM location where parent = 0 ORDER BY FIELD (name,'hà nội','hồ chí minh') DESC,name";
        else $sql = "SELECT * FROM location where parent = 0 ORDER BY FIELD (name,'hà nội','hồ chí minh') DESC,name";
        return $this->db->query($sql)->result_array();  
    }
    function getDistrict($name,$select=''){
        if($select) $sql = "SELECT ".$select."
                            FROM location
                            WHERE parent = ( SELECT id FROM location WHERE NAME = '".$name."') 
                            ORDER BY name ASC";
        else $sql = "SELECT *
                FROM location
                WHERE parent = ( SELECT id FROM location WHERE NAME = '".$name."') 
                ORDER BY name ASC";              
        return $this->db->query($sql)->result_array();        

    }


}

