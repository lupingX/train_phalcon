<?php
class ControllerBase extends Phalcon\Mvc\Controller{

// in order to do session validation	
	protected function initialize(){
		if (!$this->session->has("admin_name")){
			$this->dispatcher->forward(array(
			"controller" => "login",
			"action" => "login",			
			)
		);
		}
	}
}