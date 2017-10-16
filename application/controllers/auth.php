<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
	function login()
	{
			$this->view_data['error'] = "false";		
			$this->theme_view = 'login';

		
		if($_POST)
		{
			$_POST['username'] = $this->security->xss_clean($_POST['username']);
			$user = User::validate_login($_POST['username'], $_POST['password']);
			if($user){
				if($this->input->cookie('fc2_link') != ""){
					redirect($this->input->cookie('fc2_link'));
				}else{
					redirect('');
				}
			}
			else {
				$this->view_data['error'] = "true";
				$this->view_data['username'] = $this->security->xss_clean($_POST['username']);
				$this->view_data['message'] = 'error:'.$this->lang->line('messages_login_incorrect');
			}
		}
		
	}
	
	function logout()
	{
	    	if($this->user){ 
			$update = User::find($this->user->id); 
				$update->last_active = 0;
				$update->save();
			}elseif($this->client){
			$update = Client::find($this->client->id);
				$update->last_active = 0;
				$update->save();
			}
				
		User::logout();
		redirect('login');
	}
	function language($lang = false){
		$folder = 'application/language/';
		$languagefiles = scandir($folder);
		if(in_array($lang, $languagefiles)){
		$cookie = array(
                   'name'   => 'fc2language',
                   'value'  => $lang,
                   'expire' => '31536000',
               );
 
		$this->input->set_cookie($cookie);
		}
		redirect(''); 
	}
	
}
