<?php
class Login_user_model extends CI_Model
{

    public function checkLoginModel()
    {
        $this->db->select('*');
        $this->db->from('list');
        $this->db->join("major", 'major.major_id = list.major_id');
        $this->db->where('student_id', $this->input->post('list_id'));
        $query = $this->db->get();
        if ($query->num_rows()>0){
            $data=$query->row();
            return $data;
        }
        return FALSE;  
    }
}
