<?php
class Namenew_model extends CI_Model
{

    public function showdata()
    {

        $this->db->select('list.student_id,list.student_name,checkname.checkname_id,list.major_id,major_code');
        $this->db->from('list');
        $this->db->join('checkname','list.list_id = checkname.list_id');
        $this->db->join("major", 'list.major_id = major.major_id');
        $this->db->where('checkname.activity_id',$_SESSION['namenewactivity_id']);

        $query = $this->db->get();
        return $query->result();
    }

    function getAllGroups()
    {
        $this->db->from('activity');
        $this->db->order_by("date", "asc");
        $where = "date <= NOW()";
        $this->db->where($where);
        $query = $this->db->get(); 
        return $query->result();
    }

    public function checkinsertNamenew()
    {
        $this->db->select('student_id');
        $this->db->from('list');
        $this->db->where('student_id', $_SESSION['namenewstudent_id']);
        $query = $this->db->get();
        return ($query->num_rows()) ? TRUE : FALSE;
    }

    public function checklistNamenew()
    {
        $this->db->select('list_id');
        $this->db->from('list');
        $this->db->where('student_id', $_SESSION['namenewstudent_id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function checkinsertNamenew1()
    {
        $this->db->select('checkname.list_id');
        $this->db->from('checkname');
        $this->db->where('list_id',$_SESSION['namenewlist_id']);
        $this->db->where('activity_id',$_SESSION['namenewactivity_id']);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }

    public function insertNamenew($data)
    {
        $query = $this->db->insert('checkname', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
 
    
    public function deleteNamenew()
    {
        $this->db->where_in('checkname_id', $this->input->post('delete_id'));
        $query = $this->db->delete('checkname');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

}
?>