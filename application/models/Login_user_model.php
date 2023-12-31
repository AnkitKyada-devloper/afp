<?php

class Login_user_model extends CI_Model {

	public function check_login($data) {

		if (isset($data['EmailAddress']) && isset($data['Password'])) {
			$this->db->select('UserId,RoleId,FirstName,LastName,EmailAddress');
			$this->db->from('tbluser');
			$this->db->where('EmailAddress', trim($data['EmailAddress']));
			$this->db->where('Password', md5(trim($data['Password'])));
			$this->db->where('IsActive', 1);
			$this->db->limit(1);
			$query = $this->db->get();
			$res = $query->result();
			if ($query->num_rows() == 1) {
				$login_data = array(
					'UserId ' => trim($res[0]->UserId),
					'LoginType' => 1,
					'PanelType' => 0
					//'NoOfLogin' =>1
				);
	
				$res = $this->db->insert('tblloginlog', $login_data);
	
				return $query->result();
			} else {
				trigger_error("Login Error", E_USER_ERROR);
				return false;
			}
		} else {
			return false;
		}
	}
}
