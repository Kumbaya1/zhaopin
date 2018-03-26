<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function check_admin_by_name_pwd($name,$pwd)
    {
    	return $this->db->get_where('t_admin',array(
    			'a_name'=>$name,
    			'a_pwd'=>$pwd
    	))->row_array();
    }
    public function get_users()
    {
    	return $this->db->get('t_user')->result_array();
    }
    public function del_user_by_uid($u_id)
    {
    	$sql = "DELETE a.* ,b.* ,c.*
				FROM t_user a
				LEFT JOIN t_message b
				ON a.u_id = b.u_id
				LEFT JOIN t_exp c
				ON a.u_id = c.u_id
				WHERE a.u_id = $u_id";
		$this->db->query($sql);
		return $this->db->affected_rows();
    }
    public function get_all_en()
    {
    	return $this->db->get('t_enterprise')->result_array();
    }
    public function del_en_by_e_id($e_id)
    {
    	$sql = "DELETE a.* ,b.* ,c.*
				FROM t_enterprise a
				LEFT JOIN t_message b
				ON a.e_id = b.e_id
				LEFT JOIN t_recruitment_infor c
				ON a.e_id = c.e_id
				WHERE a.e_id = $e_id";
		$this->db->query($sql);
		return $this->db->affected_rows();
    }
    public function changepwd_by_id($a_id,$newpwd)
    {
    	$this->db->where('a_id',$a_id);
    	$this->db->update('t_admin',array(
    		'a_pwd'=>$newpwd
    	));
    	return $this->db->affected_rows();
    }
    public function get_all_sign()
    {
    	return $this->db->get('t_announce')->result_array();
    }
    public function edit_an_by_anid($an_id,$title,$content)
    {
    	$this->db->where('an_id',$an_id);
    	$this->db->update('t_announce',array(
    		'title'=>$title,
    		'content'=>$content
    	));
    	return $this->db->affected_rows();
    }
    public function del_sign_by_anid($an_id)
    {
    	$this->db->delete('t_announce',array(
    		'an_id'=>$an_id
    	));
    	return $this->db->affected_rows();
    }
    public function add_an_by_title_and_content($title,$content)
    {
    	$this->db->insert('t_announce',array(
    		'title'=>$title,
    		'content'=>$content
    	));
    	return $this->db->affected_rows();
    }
    public function get_all_msg()
    {
        $sql = "SELECT * 
                from t_enterprise en,t_recruitment_infor re
                WHERE en.e_id=re.e_id";
        return $this->db->query($sql)->result_array();
    }
    public function del_re_by_reid($re_id)
    {
        $sql = "DELETE a.* ,b.*
                FROM t_recruitment_infor a
                LEFT JOIN t_message b
                ON a.re_id = b.re_id
                WHERE a.re_id = $re_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
}