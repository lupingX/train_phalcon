<?php
/**
* 
*/
class LoginController extends Phalcon\Mvc\Controller{

	
	public function LoginAction(){			
	}

	public function RegistAction(){
		$data=array(
		'admin_name'=>$this->request->getPost('admin_name'),
		'password'=>$this->request->getPost('password'),
		);
		$admin = new cz_admin();
		$result=$admin->check($data);
		
		if (count($result)){
			echo "2";
		}else{
			echo "3";
		}
	}	
	
}