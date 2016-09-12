<?php

class CategoryController extends ControllerBase{
	

/*
list all the category and resort it.
 */
	public function cat_listAction(){
		$this->initialize();
		$cat = new cz_category();
		$cats_unsorted=$cat->find()->toArray();
		var_dump($cats_unsorted);
		$cats=$this->resort($cats_unsorted);
		 // var_dump($cats);
		$this->view->setVar("cats", $cats);
		 // $this->view->disable();

	}
/*
accept id and find the corresponding category. then put it into view
 */
	public function cat_editAction(){
		$this->initialize();
		$cat_id = $this->dispatcher->getParam("id");

		$cat = new cz_category();
		$cats_unsorted=$cat->find()->toArray();
		$cats=$this->resort($cats_unsorted);
		

	    foreach ($cats_unsorted as $ca){
	    	if($ca['cat_id']==$cat_id)
	    		$ca_need = $ca;
	    }
	    // var_dump($ca_need);
	    $this->view->setVar("cats", $cats);
	    $this->view->setVar("cat", $ca_need);
	    // $this->view->disable();
	 	    
		
	}
/*
go into the add page, in order to know the level, we need all the data 
 */

	public function cat_addAction(){
		$this->initialize();
		$cat = new cz_category();
		$cats_unsorted=$cat->find()->toArray();
		$cats=$this->resort($cats_unsorted);
		// var_dump($cats);
		$this->view->setVar("cats", $cats);
		
	}
	public function cat_updateAction(){

		$this->initialize();
		$cat = new cz_category();
		$cat->cat_id=$this->request->getPost('cat_id');
		$cat->cat_name=$this->request->getPost('cat_name');
		$cat->parent_id=$this->request->getPost('parent_id');
		$cat->unit=$this->request->getPost('unit');
		$cat->sort_order=$this->request->getPost('sort_order');
		$cat->is_show=$this->request->getPost('is_show');
		$cat->cat_desc=$this->request->getPost('cat_desc');		
		$cat->save();
		$this->dispatcher->forward(array(
			"controller" => "Category",
			"action" => "cat_list",			
			)
		);


	}


/*
delete category by id
 */

	public function cat_deleteAction(){
		$this->initialize();

		$cat = new cz_category();
	    $cat->cat_id= $this->dispatcher->getParam("id");
		$cat->delete();
		$this->dispatcher->forward(array(
			"controller" => "Category",
			"action" => "cat_list",			
			)
		);
	}


/*
insert a new category
 */	
	public function cat_insertAction(){
		$this->initialize();

		$cat = new cz_category();
		$cat->cat_name=$this->request->getPost('cat_name');
		$cat->parent_id=$this->request->getPost('parent_id');
		$cat->unit=$this->request->getPost('unit');
		$cat->sort_order=$this->request->getPost('sort_order');
		$cat->is_show=$this->request->getPost('is_show');
		$cat->cat_desc=$this->request->getPost('cat_desc');	
		$cat->insert();
		$this->dispatcher->forward(array(
			"controller" => "Category",
			"action" => "cat_list",			
			)
		);
	}
/*
resort method, use recursion
 */
	public function resort($arr,$pid =0,$level=0){
		static $res = array();
		// var_dump($res);
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
