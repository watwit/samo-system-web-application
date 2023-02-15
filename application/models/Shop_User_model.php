<?php
class Shop_User_model extends CI_Model
{

    public function showdata()
    {
            $this->db->select('shop_id,pic,name,price,detail,status');
            $this->db->from('shop');
            $this->db->order_by("status", "asc");
            $query = $this->db->get();
            return $query->result();
    }

    public function showstatus()
    {
            $this->db->select('shopstatus');
            $this->db->from('shop_status');
            $query = $this->db->get();
            return $query->result();
    }
}
?>