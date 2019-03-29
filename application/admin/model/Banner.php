<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/6/5
 * Time: 16:19
 */

namespace app\admin\model;


use think\Model;

class Banner extends Model
{
	protected function initialize(){
		parent::initialize();
	}

	/* -----------------  数据库查询  -------------------- */

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


	/* -----------------  数据库插入  -------------------- */

	public function insert($data){
		$model = $this -> newInstance();
		return $model -> insert($data);
	}

	/* -----------------  数据库更新  -------------------- */

	public function update($id, $data){
		$model = $this -> newInstance();
		return $model -> where('id', $id) -> sava($data);
	}


	/* -----------------  数据库删除  -------------------- */

	public function delete($id){
		$model = $this -> newInstance();
		return $model -> where() -> delete();
	}

}