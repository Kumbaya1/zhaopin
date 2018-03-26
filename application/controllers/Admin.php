<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}
	public function index()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_index');
		}else{
			redirect('Welcome/index');
		}	
	}
	public function changepwd()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_changepwd',array('admin'=>$admin));
		}else{
			redirect('Welcome/index');
		}	
	}
	public function manage_en()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_manage_enterprise');
		}else{
			redirect('Welcome/index');
		}	
	}
	public function manage_sign()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_manage_sign');
		}else{
			redirect('Welcome/index');
		}	
	}
	public function manage_msg()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_manage_msg');
		}else{
			redirect('Welcome/index');
		}	
	}
	public function manage_user()
	{
		$admin = $this->session->userdata('admin');
		if($admin){
			$this->load->view('admin/admin_manage_users');
		}else{
			redirect('Welcome/index');
		}	
	}
	public function check_admin()
	{
		$name = $this->input->post('name');
		$pwd = $this->input->post('pwd');
		$admin = $this->admin_model->check_admin_by_name_pwd($name,$pwd);
		if($admin){
			$this->session->set_userdata('admin',$admin);
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect('Welcome/index');
	}
	public function get_user()
	{
		$users = $this->admin_model->get_users();
		echo json_encode($users);
	}
	public function del_user()
	{
		$u_id = $this->input->post('u_id');
		$rows = $this->admin_model->del_user_by_uid($u_id);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function get_en()
	{
		$result = $this->admin_model->get_all_en();
		echo json_encode($result);
	}
	public function del_en()
	{
		$e_id = $this->input->post('e_id');
		$rows = $this->admin_model->del_en_by_e_id($e_id);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function changepwd_admin()
	{
		$a_name = $this->session->userdata('admin')['a_name'];
		$a_id = $this->session->userdata('admin')['a_id'];
		$a_pwd = $this->session->userdata('admin')['a_pwd'];
		$pwd = $this->input->post('pwd');
		$newpwd = $this->input->post('newpwd');
		if($a_pwd != $pwd){
			echo "fail";
		}else{
			$rows = $this->admin_model->changepwd_by_id($a_id,$newpwd);
			if($rows > 0){
				$admin = $this->admin_model->check_admin_by_name_pwd($a_name,$newpwd);
				$this->session->set_userdata('admin',$admin);
				echo "success";
			}else{
				echo "none";
			}
		}

	}
	public function get_sign()
	{
		$result = $this->admin_model->get_all_sign();
		echo json_encode($result);
	}
	public function edit_an()
	{
		$an_id = $this->input->post('an_id');
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$rows = $this->admin_model->edit_an_by_anid($an_id,$title,$content);
		if($rows){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function del_sign()
	{
		$an_id = $this->input->post('an_id');
		$rows = $this->admin_model->del_sign_by_anid($an_id);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function add_an()
	{
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$rows = $this->admin_model->add_an_by_title_and_content($title,$content);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function get_msg()
	{
		$result = $this->admin_model->get_all_msg();
		echo json_encode($result);
	}
	public function del_re()
	{
		$re_id = $this->input->post('re_id');
		$rows = $this->admin_model->del_re_by_reid($re_id);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
}
