<?php

class AdminController extends  ControllerBase{

	public function indexAction(){
		$this->initialize();
	}
	public function menuAction(){
		$this->initialize();
	}
	public function dragAction(){
		$this->initialize();
	}
	
	public function mainAction(){
		$this->initialize();
		$admin = new cz_admin();
		$admins=$admin->find();
		// var_dump($result);
		$this->view->setVar("admins", $admins);
		
	}
	public function topAction(){
		$this->initialize();
		
	}
	public function session_clearAction(){
		$this->session->destroy();
		$this->dispatcher->forward(array(
			"controller" => "login",
			"action" => "login",			
			)
		);

	}

		
}
