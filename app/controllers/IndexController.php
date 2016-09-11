<?php
class IndexController extends Phalcon\Mvc\Controller{

	public function IndexAction(){
		$this->dispatcher->forward(array(
			"controller" => "login",
			"action" => "login")
		);

	}
}