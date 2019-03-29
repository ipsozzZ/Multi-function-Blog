<?php
namespace App\admin\model;

use think\Model;

class Manager extends Model{

	protected function initialize(){
		parent::initialize();
	}


	/* --------------  数据库查询  --------------- */

	public function getById($mid){
		$model = $this -> newInstance();
		return $model -> where('id', $mid) -> find();
	}

	public function getAll(){
		$model = $this -> newInstance();
		return $model -> select();
	}

	public function getCount(){
		$model = $this -> newInstance();
		return $model -> count('id');
	}


	/* --------------  数据库插入  --------------- */

	public function insert($data){
		$model = $this -> newInstance();
		return $model -> insert($data);
	}

	/* --------------  数据库更新  --------------- */

	public function updateById($id, $data){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> update($data);
	}

	/* --------------  数据库删除  --------------- */

	public function delete($id){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> delete();
	}
}