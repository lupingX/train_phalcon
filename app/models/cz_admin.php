<?php
class cz_admin extends Phalcon\Mvc\Model{

	function getAdmin_name(){
		return $this->admin_name;
	}
	function getPassword(){
		return $this->password;
	}
	public function check($data){
		$sql="admin_name='{$data['admin_name']}' and password='{$data['password']}'";
		
		return $this->find(array($sql
			
			));
	}
}