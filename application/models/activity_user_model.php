<?php
class Activity_user_model extends CI_Model {
    public function showdata2()
    {
        $this->db->select('*');
        $this->db->from('list');
        $this->db->join("major", 'major.major_id = list.major_id');
        $this->db->where('student_id', $_SESSION['student_id']);
        $query = $this->db->get();
        return $query->result();
    }
    public function showdataTable(){
        $this->db->select('a.activity_id,a.date,a.activity_name,a.amont_of_time,IF(ISNULL(b.activity_id), "NO", "YES") AS checkactivity');
        $this->db->from('activity a');
        $this->db->join("(select activity_id FROM checkname where list_id='". $_SESSION['list_id']."') b", 'a.activity_id=b.activity_id','left');
        $this->db->order_by("a.date", "asc");
        $query = $this->db->get();
       return $query->result();
    }
    public function showdataCard1(){
        $this->db->select('award.award_id, award.award_name, award.picture,award.amont_of_time as award_time,SUM(activity.amont_of_time) as time_all_activity ');
        $this->db->from('award ');
        $this->db->join("checkaward", 'checkaward.award_id = award.award_id');
        $this->db->join("activity", 'activity.activity_id = checkaward.activity_id');
        $this->db->group_by("checkaward.award_id");
        $this->db->order_by("checkaward.award_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function showdataCard3(){
        $this->db->select('award.award_id, award.award_name, award.picture,award.amont_of_time as award_time,SUM(activity.amont_of_time) as time_all_activity ');
        $this->db->from('award ');
        $this->db->join("checkaward", 'checkaward.award_id = award.award_id');
        $this->db->join("activity", 'activity.activity_id = checkaward.activity_id');
        $this->db->group_by("checkaward.award_id");
        $this->db->order_by("checkaward.award_id", "asc");
        $query = $this->db->get();
        
        $arr_id=array();
        foreach($query->result() as $row){
            $arr_id[] = $row->award_id;
        }
        $arr = implode(",",$arr_id);
        $arr1 = explode(",",$arr);
        $this->db->select("*");
        $this->db->from('award');
        $this->db->where_not_in('award_id',$arr1);
        $query= $this->db->get();
        return $query->result();
    }
    public function showdataCard2(){
        $this->db->select('award.award_id,SUM(activity.amont_of_time) as time_in');
        $this->db->from('award ');
        $this->db->join("checkaward", 'checkaward.award_id = award.award_id');
        $this->db->join("activity", 'activity.activity_id = checkaward.activity_id');
        $this->db->join("checkname", 'checkname.activity_id=checkaward.activity_id');
        $this->db->where("checkname.list_id", $_SESSION['list_id']);
        $this->db->group_by("checkaward.award_id");
        $this->db->order_by("checkaward.award_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function showTableModalModel(){
        $query1 = $this->db->query("select activity_id from checkaward where award_id = '".$this->input->post('award_id')."'");
        $query1_result = $query1->result();
        $arr_id=array();
        foreach($query1_result as $row){
            $arr_id[] = $row->activity_id;
        }
        $arr = implode(",",$arr_id);
        $ids = explode(",",$arr);
        $this->db->select('a.activity_id,a.date,a.activity_name,a.amont_of_time,IF(ISNULL(b.activity_id), "X", "/") AS checkactivity');
        $this->db->from('activity a');
        $this->db->join("(select activity_id FROM checkname where list_id='". $_SESSION['list_id']."') b", 'a.activity_id=b.activity_id','left');
        $this->db->where_in('a.activity_id', $ids);
        $this->db->order_by("a.date", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function showTableAward_timeModel(){
        $this->db->select('amont_of_time');
        $this->db->from('award');
        $this->db->where("award_id",$this->input->post('award_id'));
        $query = $this->db->get();
        return $query->result();
    }
    public function showTableAward_time_inModel(){
        $this->db->select('award.award_id,SUM(activity.amont_of_time) as time_in');
        $this->db->from('award ');
        $this->db->join("checkaward", 'checkaward.award_id = award.award_id');
        $this->db->join("activity", 'activity.activity_id = checkaward.activity_id');
        $this->db->join("checkname", 'checkname.activity_id=checkaward.activity_id');
        $this->db->where("checkname.list_id", $_SESSION['list_id']);
        $this->db->where("award.award_id", $this->input->post('award_id'));
        $this->db->group_by("checkaward.award_id");
        $this->db->order_by("checkaward.award_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function showTableAward_time_allModel(){
        $this->db->select('SUM(activity.amont_of_time) as time_all_activity ');
        $this->db->from('award ');
        $this->db->join("checkaward", 'checkaward.award_id = award.award_id');
        $this->db->join("activity", 'activity.activity_id = checkaward.activity_id');
        $this->db->where("award.award_id", $this->input->post('award_id'));
        $this->db->group_by("checkaward.award_id");
        $this->db->order_by("checkaward.award_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
}
?>
