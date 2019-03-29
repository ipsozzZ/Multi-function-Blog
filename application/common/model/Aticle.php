<?php
namespace app\common\model;
use think\Model;

/**
 * 前后台模块公用数据库操作类
 * @author ipso
 */
class Article extends Model{
	protected function initialize(){
		parent::initialize();
	}

	/* ----------------  数据库查询  ----------------- */

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

	/* ----------------  数据库查询  ----------------- */

	public function insert($data){
		$model = $this -> newInstance();
		return $model -> insert($data);
	}


	/* ----------------  数据库查询  ----------------- */

	public function update($id, $data){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> update($data);
	}

	/* ----------------  数据库查询  ----------------- */

	public function delete($id){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> delete();
	}
}