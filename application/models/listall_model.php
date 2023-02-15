<?php
class listall_model extends CI_Model {
    public function showdata()
    {
        $this->db->select('*');
        $this->db->from('list');
        $this->db->join("major", 'major.major_id = list.major_id');
        $this->db->order_by("student_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function insertListall($data)
    {
        $query=$this->db->insert('list',$data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function checkinsertListall(){
        $this->db->select('student_id,student_name');
        $this->db->from('list');
        $where = "student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id')))."' or student_name='".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('first_name')))." ".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('last_name')))."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function insertExcel($student_id,$student_name,$major_id)
    {
        $query= "INSERT INTO `list`(`student_id`, `student_name`, `major_id`) VALUES ('".$student_id."','".$student_name."','".$major_id."')";
        $this->db->query($query);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function checkinsertExcel($student_id,$student_name){
        $this->db->select('student_id,student_name');
        $this->db->from('list');
        $where = "student_id='".$student_id."' or student_name='".$student_name."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function editListall($data)
    {
       
        $this->db->where('list_id',$this->input->post('list_id1'));
        $query=$this->db->update('list',$data);
        return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
        
    }
    public function checkeditListall(){
        $this->db->select('student_id,student_name');
        $this->db->from('list');
        $where = "(student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1')))."' or student_name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('first_name1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('last_name1')))."') AND list_id!='".$this->input->post('list_id1')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    function getAllGroups()
    {
        $this->db->from('major');
        $query = $this->db->get(); 
        return $query->result();
    }
    function cvtmajor($major_code)
    {
        $this->db->select('major_id');
        $this->db->from('major');
        $this->db->where('major_code',$major_code);
        $query = $this->db->get(); 
        return $query->result();
    }
    public function deleteListall()
    {
        $this->db->where_in('list_id',$this->input->post('deletelist_id'));
        $query=$this->db->delete('list');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
?>
