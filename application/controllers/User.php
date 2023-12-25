<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	
	public function getStateList($country_id = NULL) {
		
		if(!empty($country_id)) {
			
			$result = [];
			$result = $this->User_model->getStateList($country_id);			
			echo json_encode($result);				
		}			
	}
	
	public function addUser()
	{
		$post_user = json_decode(trim(file_get_contents('php://input')), true);
		if ($post_user) 
			{
				if($post_user['UserId']>0)
				{
					$result = $this->User_model->edit_user($post_user);
					if($result)
					{
						echo json_encode($post_user);	
					}	
				}
				else
				{
					
					$result = $this->User_model->add_user($post_user); 
			
					if($result)
					{
						echo json_encode($post_user); 
						
					}	
				}
					
			}
	}
	
	
	//Delete UserList
	
	public function deleteUser() {
		$post_user = json_decode(trim(file_get_contents('php://input')), true);		

		if ($post_user)
		 {
			if($post_user['id'] > 0){
				$result = $this->User_model->delete_user($post_user);
				if($result) {
					
					echo json_encode("Delete successfully");
					}
		 	}
		
			
		} 
			
	}
	//get userId edit
	public function getById($user_id=null)
	{	
		
		if(!empty($user_id))
		{
			$data=[];
			$data=$this->User_model->get_userdata($user_id);
			echo json_encode($data);
		}
	}
	
	
	
	// Add Status
	public function getAllUserList($role_id=null)
	{
		if(!empty($role_id))
		{
			$data=$this->User_model->getlist_user($role_id);
			echo json_encode($data);
		}
		
	}

	public function getAllUserList_tool()
	{
		$data=$this->User_model->getlist_user_tool();
		echo json_encode($data);

	}	

	public function getAllDefaultData()
	{
		//$data="";
		$data['company']=$this->User_model->getlist_company();
		$data['role']=$this->User_model->getlist_userrole();
		$data['sales']=$this->User_model->getlist_sales();
		$data['country']=$this->User_model->getlist_country();
		$data['state']=$this->User_model->getlist_state();
		echo json_encode($data);
	}
}
