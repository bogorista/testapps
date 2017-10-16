<?php

class User extends ActiveRecord\Model
{
	static $has_many = array(
	     array('company_has_admins'),
	     array('tickets'),
	     array('project_has_workers'),
	     array('companies', 'through' => 'company_has_admins'),
	     array('projects', 'through' => 'project_has_workers'),
	     array('project_has_tasks'),
	     array('project_has_timesheets'),
	     array('quotes'),
	     array('quoterequests'),

    );
    static $belongs_to = array(
     array('queue', 'primary_key' => 'queue'),
  	);

	var $password = FALSE;
	function before_save()
	{
		if($this->password)
			$this->hashed_password = $this->hash_password($this->password);
	}
	
	function set_password($plaintext)
	{

		$this->hashed_password = $this->hash_password($plaintext);
	}
	private function hash_password($password)
	{
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$hash = hash('sha256', $salt . $password);
		
		return $salt . $hash;
	}
	
	private function validate_password($password)
	{
		$salt = substr($this->hashed_password, 0, 64);
		$hash = substr($this->hashed_password, 64, 64);
		
		$password_hash = hash('sha256', $salt . $password);
		
		return $password_hash == $hash;
	}
	
	public static function validate_login($username, $password)
	{
		$user = User::find_by_username_and_status($username, "active");
		$client = Client::find_by_email_and_inactive($username, 0);

		if($user && $user->validate_password($password) && $user->status == 'active')
		{
				User::login($user->id, 'user_id');
				$update = User::find($user->id);
				$update->last_login = time();
				$update->save();
				return $user;
		}	
		elseif($client && $client->validate_password($password) && $client->inactive == '0')
		{
				User::login($client->id, 'client_id');
				$update = Client::find($client->id);
				$update->last_login = time();
				$update->save();
				return $client;
		} else{
			return FALSE;
		}
	}
	
	public static function login($user_id, $type)
	{
		$CI =& get_instance();
		$CI->session->set_userdata($type, $user_id);
	}
	
	public static function logout()
	{
		$CI =& get_instance();
		$CI->session->sess_destroy();
		
	}
}
