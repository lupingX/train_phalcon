<?php
/**
* login controller 
*/
class LoginController extends Phalcon\Mvc\Controller{

	
	public function LoginAction(){			
	}

	/*
	validate the admin_name and password and set session 
	 */ 
	public function RegistAction(){
		$data=array(
		'admin_name'=>$this->request->getPost('admin_name'),
		'password'=>$this->request->getPost('password'),
		);
		$admin = new cz_admin();
		$result=$admin->check($data);
		// var_dump($result);
		if (count($result)){

			$this->session->set("admin_name", $data['admin_name']);
			// var_dump($this->session->get("admin_name"));
			$this->dispatcher->forward(array(
			"controller" => "admin",
			"action" => "index")
		);

		}else{
			$this->dispatcher->forward(array(
			"controller" => "error",
			"action" => "index",			
			)
		);

		}
	}	
	
}