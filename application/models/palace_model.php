<?php
class Palace_model extends CI_Model
{

    public function showdata()
    {
        $this->db->select('*');
        $this->db->from('palace');
        $this->db->join("major", 'major.major_id = palace.major_id');
        $this->db->order_by("rank", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function insertPalace($data){
        $query=$this->db->insert('palace',$data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function checkinsert(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname')))."' 
                or rank='".$this->input->post('rank')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function checkinsertname(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname')))."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows())?TRUE:FALSE;
    }


    public function checkinsert11(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "rank='".$this->input->post('rank')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return ($query->num_rows()<2)?TRUE:FALSE;
    }
    public function checkinsertother(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname')))."' 
                or rank='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function editPalace($data)
    {  
        $this->db->where('palace_id',$this->input->post('palace_id1'));
        $query=$this->db->update('palace',$data);
        return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
    }
    public function checkedit(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "(student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1')))."' or rank='".$this->input->post('rank1')."') AND palace_id!='".$this->input->post('palace_id1')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function checkedit11(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "(student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1')))."' or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1')))."' or rank='".$this->input->post('rank1')."') AND palace_id!='".$this->input->post('palace_id1')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return ($query->num_rows()<2)?TRUE:FALSE;
    }
    public function checkedittname(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "(student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1')))."') AND palace_id!='".$this->input->post('palace_id1')."'";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows())?TRUE:FALSE;
    }
    public function checkeditother(){
        $this->db->select('student_id,name');
        $this->db->from('palace');
        $where = "(student_id='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1')))."' 
                or name='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1')))."' 
                or rank='".mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))."') AND palace_id!='".$this->input->post('palace_id1')."'";
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
    public function deletePalace()
    {
        $this->db->where_in('palace_id',$this->input->post('deletepalace_id'));
        $query=$this->db->delete('palace');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    } 
}
?>