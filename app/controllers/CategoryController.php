<?php
class CategoryController extends Phalcon\Mvc\Controller{
	public function cat_listAction(){
		$cat = new cz_category();
		$cats_unsorted=$cat->find()->toArray();
		$cats=$this->resort($cats_unsorted);
		// var_dump($cats);
		$this->view->setVar("cats", $cats);
		// $this->view->disable();

	}
	public function cat_editAction(){
		
		$cat_id = $this->dispatcher->getParam("");
		// var_dump($cat_id);
		// $this->view->disable();
		
	}
	public function cat_addAction(){
		$cat = new cz_category();
		$cats_unsorted=$cat->find()->toArray();
		$cats=$this->resort($cats_unsorted);
		// var_dump($cats);
		$this->view->setVar("cats", $cats);
		
	}
	public function cat_updateAction(){
		$data=array(
		'cat_name'=>$this->request->getPost('cat_name'),
		'parent_id'=>$this->request->getPost('parent_id'),
		'unit'=>$this->request->getPost('unit'),
		'sort_order'=>$this->request->getPost('sort_order'),
		'is_show'=>$this->request->getPost('is_show'),
		'cat_desc'=>$this->request->getPost('cat_desc'),
		);
		$cat = new cz_category();
		$cat->update($data);
		$this->dispatcher->forward(array(
			"controller" => "Category",
			"action" => "cat_list",			
			)
		);


	}
	public function cat_deleteAction(){

		$cat = new cz_category();
		$cat->update($data);
		$this->dispatcher->forward(array(
			"controller" => "Category",
			"action" => "cat_list",			
			)
		);
	}


	public function resort($arr,$pid =0,$level=0){
		static $res = array();
		foreach ($arr as $as){
			if ($as['parent_id']==$pid) {
				$as['level']=$level;
				$res[]=$as;
				$this->resort($arr,$as['cat_id'],$level+1);
			}
		}
		return $res;
	}



}
