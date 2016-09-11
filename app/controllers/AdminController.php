<?php
class AdminController extends  Phalcon\Mvc\Controller{

	public function indexAction(){

	}
	public function menuAction(){
		
	}
	public function dragAction(){
		
	}
	public function mainAction(){
		$admin = new cz_admin();
		$admins=$admin->find();
		// var_dump($result);
		$this->view->setVar("admins", $admins);
		
	}
	public function topAction(){
		
	}

}