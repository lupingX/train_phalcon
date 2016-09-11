<?php
class ErrorController extends Phalcon\Mvc\Controller{

	public function indexAction(){

		$this->view->setVar("message", "error");
		$this->view->setVar("wait", 3);
		$this->view->setVar("url", "/login/login");

	}
	public function successAction(){
		$this->view->setVar("message", "success");
		$this->view->setVar("wait", 3);
		$this->view->setVar("url", "/login/login");
		$this->view->pick("error/index");
}
}