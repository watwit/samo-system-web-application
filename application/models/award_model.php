<?php
class Award_model extends CI_Model {
    
    public function showdata()
    {
        $this->db->from('award');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function checkinsertAward()
    {
        $this->db->select('award_name');
        $this->db->from('award');
        $this->db->where('award_name', mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name'))));
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }

    public function checkeditAward()
    {
        $this->db->select('award_name');
        $this->db->from('award');
        $where = "award_name='" . mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name1'))). "' AND award_id !='" . $this->input->post('award_id1') . "' ";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;

    }

    public function checkIDAward()
    {
        $this->db->select('award_id');
        $this->db->from('award');
        $this->db->where('award_name', mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name1'))));
        $query = $this->db->get();
        return $query->result();
    }

    public function insertAward($data)
    {
        $query = $this->db->insert('award', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function editAwardImg($data)
    { 
            $this->db->where('award_id',$this->input->post('award_id1'));
            $query=$this->db->update('award',$data);
            return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
    }
        
    public function deleteAward()
    {
         $this->db->where_in('award_id', $this->input->post('delete_id'));
         $query = $this->db->delete('award');
         return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    
    
}
?>
