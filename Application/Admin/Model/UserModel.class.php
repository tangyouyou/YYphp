<?php

	class UserModel extends Model{
		public $table ="user";

		public function addUser($data){
			return $this->insert($data);
		}
	}