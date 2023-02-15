<?php
class Checkaward_model extends CI_Model {
    
    public function showdata()
    {
        $this->db->select('checkaward.checkaward_id,activity.activity_name,activity.amont_of_time,activity.date');
        $this->db->from('activity');
        $this->db->where('award_id',$_SESSION['award_id']);
        $this->db->join('checkaward','activity.activity_id = checkaward.activity_id');
        $this->db->order_by("activity.date", "asc");
        $query = $this->db->get();
        return $query->result();
        // return $query->result();
    }
    public function showdata_name()
    {
        $this->db->select('award_name');
        $this->db->from('award');
        $this->db->where('award_id',$_SESSION['award_id']);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getAllGroups()
    {
       
        $query1 = $this->db->query("select activity_id from checkaward where award_id = '".$_SESSION['award_id']."'");
        $query1_result = $query1->result();
        $arr_id=array();
        foreach($query1_result as $row){
            $arr_id[] = $row->activity_id;
        }
        $arr = implode(",",$arr_id);
        $ids = explode(",",$arr);
        $this->db->select("*");
        $this->db->from('activity');
        $this->db->where_not_in('activity_id',$ids);
        $query= $this->db->get();

        
        return $query->result();


        //echo 'Total Results: ' . $query->num_rows();
    }

    public function deleteCheckaward()
    {
        $this->db->where_in('checkaward_id', $this->input->post('delete_id'));
        $query = $this->db->delete('checkaward');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

 
    function multisave($data)
    {   
        $query = $this->db->insert('checkaward', $data);
    }
    function checkmultisave($data)
    {   
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}
?>