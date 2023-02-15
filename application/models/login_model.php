<?php
class login_model extends CI_Model
{

    public function checkLoginModel()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $this->input->post('username'));
        $query = $this->db->get();
        if ($query->num_rows()>0){
            $data=$query->row();
            return $data;
        }
        return FALSE;  
    }
}
