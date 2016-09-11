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
		// var_dump($result);
		if (count($result)){
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