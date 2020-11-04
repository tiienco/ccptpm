<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        // $this->db =  $this->load->database('default_old', TRUE);
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
                            // echo $this->db->last_query();
    }
    function show_pagination_nowhere($table,$limit, $start,$order_by,$select='') {  
        if($select) return $this->db->select($select)
                                    ->order_by($order_by)
                                    ->LIMIT($limit, $start)
                                    ->get($table)->result_array();
        else return $this->db->order_by($order_by)
                            ->LIMIT($limit, $start)
                            ->get($table)->result_array(); 
                            // echo $this->db->last_query();
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

    function show_detail_cart($id){

        $sql = 'SELECT c.* , p.image

                FROM cart_detail c

                LEFT JOIN product p ON c.prod_id = p.id

                where c.cart_id ='.$id;

        return $this->db->query($sql)->result_array();        

    }


}

