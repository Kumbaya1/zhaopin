<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	//用户主页
	public function index()
	{	
		$user = $this->session->userdata('user');
		if($user){
			$this->load->view('User/my_home',array('user'=>$user));
		}else{
			redirect('Welcome/welcome_index');
		}
		
	}
	//简历页面
	public function edit_resume()
	{	
		$user = $this->session->userdata('user');
		if($user){
			$this->load->view('user/edit_resume',array('user'=>$user));
		}else{
			redirect('Welcome/welcome_index');
		}
	}
	//招聘信息页面
	public function re_infor()
	{
		$user = $this->session->userdata('user');
		if($user){
			$this->load->view('user/re_infor',array('user'=>$user));
		}else{
			redirect('Welcome/welcome_index');
		}
	}
	//更改密码页面
	public function change_pwd()
	{
		$user = $this->session->userdata('user');
		if($user){
			$this->load->view('user/change_pwd',array('user'=>$user));
		}else{
			redirect('Welcome/welcome_index');
		}
	}
	//ajax获取已登录用户信息session
	public function get_user()
	{
		$user = $this->session->userdata('user');
		echo json_encode($user);
	}
	//注册用户
	public function regist()
	{
		$username = $this->input->post('username');
		$pwd = $this->input->post('pwd');
		$result = $this->user_model->check_user($username);
		if($result){
			echo "exist";
		}else{
			$row = $this->user_model->add_user($username,$pwd);
			if($row > 0){
				$user = $this->user_model->check_user($username);
				$this->session->set_userdata(array('user'=>$user));
				echo "success";
			}else{
				echo "error";
			}
		}
	}
	//登录验证用户
	public function check_user()
	{
		$username = $this->input->post('username');
		$pwd = $this->input->post('pwd');
		$user = $this->user_model->check_user_by_name_pwd($username,$pwd);
		if($user){
			$this->session->set_userdata(array('user'=>$user));
			echo "success";
		}else{
			echo "fail";
		}
	}
	//更新用户信息
	public function update_user()
	{
		$arr = array();
		$arr['true_name'] = $this->input->post('trueName');
		$arr['tel'] = $this->input->post('tel');
		$arr['email'] = $this->input->post('email');
		$arr['prov'] = $this->input->post('prov');
		$arr['city'] = $this->input->post('city');
		$arr['introduction'] = $this->input->post('detail');
		$arr['sex'] = $this->input->post('sex');
		$arr['age'] = $this->input->post('age');
		$user_id = $this->session->userdata('user')['u_id'];
		$row = $this->user_model->update_user_by_id($user_id,$arr);
		if($row > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	//获取用户简历信息
	public function get_user_resume()
	{
		$user_id = $this->session->userdata('user')['u_id'];
		$result = $this->user_model->get_resume_by_id($user_id);
		echo json_encode($result);
	}
	//获取用户工作经验信息
	public function get_user_exp()
	{
		$user_id = $this->session->userdata('user')['u_id'];
		$exps = $this->user_model->get_user_exp_by_id($user_id);
		echo json_encode($exps);
	}
	public function del_exp()
	{
		$exp_id = $this->input->post('exp_id');
		$rows = $this->user_model->del_exp_by_id($exp_id);
		echo $rows;
	}
	public function add_exp()
	{
		$user_id = $this->session->userdata('user')['u_id'];
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$content = $this->input->post('content');
		$rows = $this->user_model->add_user_exp_by_uid($user_id,$start_date,$end_date,$content);
		echo $rows;
	}
	//上传头像
	public function updata_img()
	{
		$username = $this->session->userdata('user')['u_name'];
		$config['upload_path'] = './images/header';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] =  $username.'.png';
		$config['overwrite'] =  true;
		$config['max_size'] = '100';
		// $config['max_width'] = '1024';
		// $config['max_height'] = '768';
		$img_name = $username.'.png';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file1');
		$data = $this->upload->data();
		if($data['image_width'] && $data['image_height']){
			$this->user_model->updata_img($username,$img_name);
			$user = $this->user_model->check_user($username);
			$this->session->set_userdata('user',$user);
			redirect('User/edit_resume');
		}else{
			$this->load->view('user/file_error');
		}
	}
	public function change_pwd_by_id()
	{
		$user_pwd = $this->session->userdata('user')['u_pwd'];
		$user_id = $this->session->userdata('user')['u_id'];
		$pwd = $this->input->post('pwd');
		$newpwd = $this->input->post('newpwd');
		if($user_pwd == $pwd && $user_pwd !=$newpwd ){
			$rows = $this->user_model->change_pwd_by_id($user_id,$newpwd);
			if($rows > 0){
				$user = $this->user_model->get_resume_by_id($user_id);
				$this->session->set_userdata('user',$user);
				echo "success";
			}
		}else{
			echo "fail";
		}

	}
	public function user_logout()
	{
		$this->session->unset_userdata('user');
		redirect('Welcome/index');
	}
	public function recruitment_infor()
	{
		$result = $this->user_model->get_all_recruitment_infor();
		echo json_encode($result);
	}
	public function push_resume()
	{
		$u_id = $this->session->userdata('user')['u_id'];
		$re_id = $this->input->post('re_id');
		$e_id = $this->input->post('e_id');
		$rows = $this->user_model->add_resume($u_id,$re_id,$e_id);
		if($rows > 0){
			echo "success";
		}
	}
	public function check_resume()
	{
		$u_id = $this->session->userdata('user')['u_id'];
		$re_id = $this->input->post('re_id');
		$e_id = $this->input->post('e_id');
		$query = $this->user_model->check_resume_by_uid_reid_eid($u_id,$re_id,$e_id);
		if($query){
			echo "yes";
		}else{
			echo "no";
		}

	}
}
