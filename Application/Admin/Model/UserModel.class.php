<?php

	class UserModel extends Model{
		protected $table ="user";

		public function addUser($data){
			return $this->insert($data);
		}
	}