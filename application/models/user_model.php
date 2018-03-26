<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
	//查询用户是否存在
    public function check_user($username)
    {
    	return $this->db->get_where('t_user',array(
    			'u_name'=>$username
    		))->row_array();
    }
    //添加用户
    public function add_user($username,$pwd)
    {
    	$this->db->insert('t_user',array(
    			'u_name'=>$username,
    			'u_pwd'=>$pwd
    		));
    	return $this->db->affected_rows();
    }
    //根据帐号密码查询用户
    public function check_user_by_name_pwd($username,$pwd)
    {
        return $this->db->get_where('t_user',array(
                'u_name'=>$username,
                'u_pwd'=>$pwd
            ))->row_array();
    }
    //根据id更新信息
    public function update_user_by_id($user_id,$arr)
    {
        $this->db->where('u_id',$user_id);
        $this->db->update('t_user',$arr);
        return $this->db->affected_rows();
    }
    //根据id获取用户简历信息
    public function get_resume_by_id($user_id)
    {
        return $this->db->get_where('t_user',array(
                'u_id'=>$user_id
        ))->row_array();
    }
    //根据id获取用户工作经验信息
    public function get_user_exp_by_id($user_id)
    {
        return $this->db->get_where('t_exp',array(
                'u_id'=>$user_id
        ))->result_array();
    }
    public function del_exp_by_id($exp_id)
    {
        $this->db->delete('t_exp',array(
                'exp_id'=>$exp_id
        ));
        return $this->db->affected_rows();
    }
    public function add_user_exp_by_uid($user_id,$start_date,$end_date,$content)
    {
        $this->db->insert('t_exp',array(
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'content'=>$content,
            'u_id'=>$user_id
        ));
        return $this->db->affected_rows();
    }
    public function updata_img($username,$img_name)
    {
        $this->db->where('u_name',$username);
        $this->db->update('t_user',array(
            'photo'=>$img_name
        ));
    }
    public function change_pwd_by_id($user_id,$newpwd)
    {
        $this->db->where('u_id',$user_id);
        $this->db->update('t_user',array(
            'u_pwd'=>$newpwd
        ));
        return $this->db->affected_rows();
    }
    public function get_all_recruitment_infor()
    {
        $sql = "select * from t_recruitment_infor re,t_enterprise en where re.e_id=en.e_id";
        return $this->db->query($sql)->result_array();
    }
    public function add_resume($u_id,$re_id,$e_id)
    {
        $this->db->insert('t_message',array(
            'u_id'=>$u_id,
            're_id'=>$re_id,
            'e_id'=>$e_id
        ));
        return $this->db->affected_rows();
    }
    public function check_resume_by_uid_reid_eid($u_id,$re_id,$e_id)
    {
        return $this->db->get_where('t_message',array(
            'u_id'=>$u_id,
            're_id'=>$re_id,
            'e_id'=>$e_id
        ))->row_array();
    }
}