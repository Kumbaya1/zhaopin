<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enterprise_model extends CI_Model
{
	public function check_en_by_name($e_name)
	{
		return $this->db->get_where('t_enterprise',array(
			'e_name'=>$e_name
		))->row_array();
	}    
	public function add_en($arr)
	{
		$this->db->insert('t_enterprise',$arr);
		return $this->db->affected_rows();
	}
	public function check_en_by_name_and_pwd($e_name,$e_pwd)
	{
		return $this->db->get_where('t_enterprise',array(
			'e_name'=>$e_name,
			'e_pwd'=>$e_pwd
		))->row_array();
	}
	public function publish_infor_by_e_id($e_id,$title,$content)
	{
		$this->db->insert('t_recruitment_infor',array(
			'title'=>$title,
			'content'=>$content,
			'e_id'=>$e_id
		));
		return $this->db->affected_rows();
	}
	public function get_infor_by_eid($e_id)
	{
		return $this->db->get_where('t_recruitment_infor',array(
			'e_id'=>$e_id
		))->result_array();
	}
	public function del_infor_by_reid($re_id)
	{
		$sql = "DELETE a.* ,b.*
                FROM t_recruitment_infor a
                LEFT JOIN t_message b
                ON a.re_id = b.re_id
                WHERE a.re_id = $re_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
		// $this->db->where('re_id',$re_id);
		// $this->db->delete('t_recruitment_infor');
		// return $this->db->affected_rows();
	}
	public function changepwd_by_id($e_id,$new_pwd)
	{
		$this->db->where('e_id',$e_id);
		$this->db->update('t_enterprise',array(
			'e_pwd'=>$new_pwd
		));
		return $this->db->affected_rows();
	}
	public function get_all_announce()
	{
		return $this->db->get('t_announce')->result_array();
	}
	public function get_all_message($e_id)
	{
		$sql = "SELECT *
				from t_recruitment_infor re,(SELECT *,COUNT(*) num
											from t_message msg
											where e_id=$e_id 
											GROUP BY msg.re_id) rows
				WHERE re.re_id=rows.re_id";
		return $this->db->query($sql)->result_array();
	}
	public function get_userlist_by_reid($re_id)
	{
		$sql = "SELECT * 
				from t_message msg,t_user us
				WHERE msg.re_id=$re_id and msg.u_id=us.u_id";
		return $this->db->query($sql)->result_array();
	}
	public function get_exp_by_uid($u_id)
	{
		return $this->db->get_where('t_exp',array(
			'u_id'=>$u_id
		))->result_array();
	}
}