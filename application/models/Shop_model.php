<?php
class Shop_model extends CI_Model {
    
    public function showdata()
    {
        $this->db->select('shop_id,pic,name,price,detail,status');
        $this->db->from('shop');
        $query = $this->db->get();
        return $query->result();
    }

    public function showStatus()
    {
        $this->db->select('shopstatus');
        $this->db->from('shop_status');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertShop($data)
    {
        $query = $this->db->insert('shop', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function editShopImg($data)
    { 
            $this->db->where('shop_id',$this->input->post('shop_id1'));
            $query=$this->db->update('shop',$data);
            return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
    }

    public function editStatusShop($data)
        {
            $this->db->where('shopstatus_id','0');
            $query=$this->db->update('shop_status',$data);
            return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
        }
        
        public function deleteShop()
        {
            $this->db->where_in('shop_id', $this->input->post('delete_id'));
            $query = $this->db->delete('shop');
            return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }
}
