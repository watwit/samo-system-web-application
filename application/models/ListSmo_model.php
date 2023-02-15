<?php
class ListSmo_model extends CI_Model
{

    public function showdata()
    {
            $this->db->select('palace.palace_id,palace.student_id,palace.name,palace.rank,palace.picture,major.major_name');
            $this->db->from('palace');
            $this->db->join("major", 'palace.major_id = major.major_id');
            $this->db->order_by("rank", "asc");
            $query = $this->db->get();
            return $query->result();
    }
}
?>