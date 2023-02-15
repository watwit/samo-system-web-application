<?php
class Admin_model extends CI_Model {
    
    public function showdata()
    {
        $query = $this->db->get('user');
        return $query->result();
    }
    public function checkUserName(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', mb_ereg_replace('[[:space:]]+','',trim($this->input->post('username'))));
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE:FALSE;
    }
    public function checkName(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('firstname', mb_ereg_replace('[[:space:]]+','',trim($this->input->post('firstname'))));
        $this->db->where('lastname', mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lastname'))));
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE:FALSE;
    }
    public function insertAdmin($data)
    {
        $query=$this->db->insert('user',$data);
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;
    }

    public function checkNameEdit()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('firstname',  mb_ereg_replace('[[:space:]]+','',trim($this->input->post('firstname1'))));
        $this->db->where('lastname', mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lastname1'))));
        $array = array('user_id !=' => $this->input->post('user_id1'));
        $this->db->where($array);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE:FALSE;
    }
    public function editAdmin($data)
    {  
        $this->db->where('user_id',$this->input->post('user_id1'));
        $query=$this->db->update('user',$data);
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;
    }

    public function deleteAdmin()
    {
        $this->db->where_in('user_id',$this->input->post('delete_id'));
        $query=$this->db->delete('user');
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;
    }
}
?>
