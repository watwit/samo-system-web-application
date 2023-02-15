<?php
class Activity_model extends CI_Model
{
    public function showdata()
    {
        $this->db->from('activity');
        $this->db->order_by("date", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function checkinsertActivity()
    {
        $this->db->select('date');
        $this->db->from('activity');
        $this->db->where('date', $this->input->post('date'));
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function insertActivity($data)
    {
        $query = $this->db->insert('activity', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function checkeditActivity()
    {
        $this->db->select('date');
        $this->db->from('activity');
        $where = "date='" . $this->input->post('date1') . "'  AND activity_id !='".$this->input->post('activity_id1')."' ";
        $this->db->where($where);
        $query = $this->db->get();
        return (!$query->num_rows()) ? TRUE : FALSE;
    }
    public function editActivity($data)
    {
        $this->db->where('activity_id', $this->input->post('activity_id1'));
        $query = $this->db->update('activity', $data);
        return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
    }
    public function editEmptyActivity($data)
    {
        $this->db->where('activity_id', $this->input->post('activity_id1'));
        $query = $this->db->update('activity', $data);
        return ($this->db->affected_rows() > 0)  ? TRUE : FALSE;
    }
    public function deleteActivity()
    {
        $this->db->where_in('activity_id', $this->input->post('delete_id'));
        $query = $this->db->delete('activity');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
