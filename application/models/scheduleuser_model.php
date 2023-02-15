<?php
class scheduleuser_model extends CI_Model {
    
    public function showdata()
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->where('activity_id',$_SESSION['activity_id_user']);
        $this->db->order_by("time", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function showdata1()
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->where('activity_id',$_SESSION['activity_id_user']);
        $head = $this->db->get();
        return $head->result();
    }
}
?>
