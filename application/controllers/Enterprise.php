<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enterprise extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('enterprise_model');
	}
	public function regist()
	{
		$this->load->view('enterprise/enterprise_regist');
		
	}
	public function index()
	{
		$en = $this->session->userdata('en');
		if($en){
			$this->load->view('enterprise/en_index',array('en'=>$en));
		}else{
			redirect('Welcome/index');
		}
	}
	public function publishinfor()
	{
		$en = $this->session->userdata('en');
		if($en){
			$this->load->view('enterprise/en_publishinfor',array('en'=>$en));
		}else{
			redirect('Welcome/index');
		}
	}	
	public function alerts()
	{
		$en = $this->session->userdata('en');
		if($en){
			$this->load->view('enterprise/en_alerts',array('en'=>$en));
		}else{
			redirect('Welcome/index');
		}
	}	
	public function changepwd()
	{
		$en = $this->session->userdata('en');
		if($en){
			$this->load->view('enterprise/en_changepwd',array('en'=>$en));
		}else{
			redirect('Welcome/index');
		}
	}	
	public function websitesign()
	{
		$en = $this->session->userdata('en');
		if($en){
			$this->load->view('enterprise/en_websitesign',array('en'=>$en));
		}else{
			redirect('Welcome/index');
		}
	}	
	public function en_logout()
	{
		$this->session->unset_userdata('en');
		redirect('Welcome/index');
	}
	public function en_regist()
	{
		$arr = array();
		$arr['en_name'] = $this->input->post('en_name');
		$arr['prov'] = $this->input->post('prov');
		$arr['city'] = $this->input->post('city');
		$arr['contacter'] = $this->input->post('contact');
		$arr['sex'] = $this->input->post('sex');
		$arr['tel'] = $this->input->post('tel');
		$arr['e_name'] = $this->input->post('e_name');
		$arr['email'] = $this->input->post('email');
		$arr['e_pwd'] = $this->input->post('passwprd');
		$arr['nature'] = $this->input->post('nature');
		$arr['industry'] = $this->input->post('industry');
		$arr['introduction'] = $this->input->post('introduction');
		$en = $this->enterprise_model->check_en_by_name($arr['e_name']);
		if($en){
			echo "fail";
		}else{
			$rows = $this->enterprise_model->add_en($arr);
			if($rows > 0){
				$query = $this->enterprise_model->check_en_by_name($arr['e_name']);
				$this->session->set_userdata('en',$query);
				echo "success";
			}
		}

	}
	public function check_en()
	{
		$e_name = $this->input->post('e_name');
		$e_pwd = $this->input->post('e_pwd');
		$query = $this->enterprise_model->check_en_by_name_and_pwd($e_name,$e_pwd);
		if($query){
			$this->session->set_userdata('en',$query);
			echo "success";
		}else{
			echo "fail";
		}
	}
	public 	function publish_infor()
	{
		$e_id = $this->session->userdata('en')['e_id'];
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$rows = $this->enterprise_model->publish_infor_by_e_id($e_id,$title,$content);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function get_infor()
	{
		$e_id = $this->session->userdata('en')['e_id'];
		$result = $this->enterprise_model->get_infor_by_eid($e_id);
		echo json_encode($result);
	}
	public function del_infor()
	{
		$re_id = $this->input->post('id');
		$rows = $this->enterprise_model->del_infor_by_reid($re_id);
		if($rows > 0){
			echo "success";
		}else{
			echo "fail";
		}
	}
	public function changepwd_en()
	{
		$e_name = $this->session->userdata('en')['e_name'];
		$e_id = $this->session->userdata('en')['e_id'];
		$e_pwd = $this->session->userdata('en')['e_pwd'];
		$pwd = $this->input->post('pwd');
		$new_pwd = $this->input->post('newpwd');
		if($e_pwd != $pwd){
			echo "fail";
		}else{
			$rows = $this->enterprise_model->changepwd_by_id($e_id,$new_pwd);
			if($rows > 0){
				$query = $this->enterprise_model->check_en_by_name($e_name);
				$this->session->set_userdata('en',$query);
				echo "success";
			}else{
				echo "none";
			}
		}
	}
	public function get_announce()
	{
		$result = $this->enterprise_model->get_all_announce();
		echo json_encode($result);
	}
	public function get_message()
	{
		$e_id = $this->session->userdata('en')['e_id'];
		$result = $this->enterprise_model->get_all_message($e_id);
		echo json_encode($result);
	}
	public function get_userlist()
	{
		$re_id = $this->input->get('re_id');
		$result = $this->enterprise_model->get_userlist_by_reid($re_id);
		echo json_encode($result);
	}
	public function get_exp()
	{
		$u_id = $this->input->get('u_id');
		$result = $this->enterprise_model->get_exp_by_uid($u_id);
		echo json_encode($result);
	}
}
