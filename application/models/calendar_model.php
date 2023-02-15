<?php
class calendar_model extends CI_Model
{

    public function showdata()
    {
            $this->db->select('*');
            $this->db->from('activity');
            $query = $this->db->get();
            return $query->result();
    }
}
?>