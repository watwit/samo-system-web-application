<?php
class Schedule_model extends CI_Model {
    public function showdata()
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->where('activity_id',$_SESSION['activity_id']);
        $this->db->order_by("time", "asc");
        $query = $this->db->get();
        return $query->result();
    } 
    public function showdata_name() 
    {
        $this->db->select('date,activity_name');
        $this->db->from('activity');
        $this->db->where('activity_id',$_SESSION['activity_id']);
        $query = $this->db->get();
        return $query->result();
    } 
    public function checkInsertSchedule(){
        $this->db->select('time');
        $this->db->from('schedule');
        $where = "time='".$this->input->post('time')."' AND activity_id ='".$_SESSION['activity_id']."' ";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE:FALSE;
    }
    public function insertSchedule($data)
    {
        $query=$this->db->insert('schedule',$data);
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;
    }
    public function checkEditSchedule(){
        $this->db->select('time');
        $this->db->from('schedule');
        $where = "time='".$this->input->post('time')."' AND activity_id ='".$_SESSION['activity_id']."'AND schedule_id !='".$this->input->post('schedule_id')."' ";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function editSchedule($data)
    {
        $this->db->where('schedule_id',$this->input->post('schedule_id'));
        $query=$this->db->update('schedule',$data);
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;
    }

    public function deleteSchedule()
    {
        $this->db->where_in('schedule_id',$this->input->post('delete_id'));
        $query=$this->db->delete('schedule');
        return ($this->db->affected_rows()>0) ? TRUE:FALSE;            
    }
}
?>
