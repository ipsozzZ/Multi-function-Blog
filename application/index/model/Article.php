<?php 
namespace app\index\model;

use think\Model;

class Article extends Model{
	public function initialize(){
		parent::initialize();
	}

	/* --------------  数据库查询  ----------------- */

	public function getById($id){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> find();
	}

	public function getList($begin, $num){
		$model = $this -> newInstance();
		return $model -> limit($begin, $num) -> select();
	}

	public function getCount(){
		$model = $this -> newInstance();
		return $model -> count('id');
	}


	/* --------------  数据库插入  ----------------- */


	/* --------------  数据库更新  ----------------- */


	/* --------------  数据库删除  ----------------- */
}