<?php

class Validation{

	private $error = false;

	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "address": return $this->address($value); break;
			case "email": return $this->email($value); break;
			case "date": return $this->date($value); break;
			case "password": return $this->password($value); break;
			case "nonBlank": return $this->nonBlank($value); break;
			
			
		}
	}



	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}

	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		return $this->setError($match);
	}

	private function address($value){
		
		$match = preg_match('/^(\d{2,})(\s\w.\s)?(\b\w*(-?\w*?)\b\s){1,4}(\w*.$)/im', $value);
		return $this->setError($match);
	}

	private function email($value){
		$match = preg_match('/^\S+@\S+\.\S+$/i', $value);
		return $this->setError($match);
	}

	private function date($value){
		$match = preg_match('/([1-9]|0[1-9]|1[012]).([1-9]|0[1-9]|1[0-9]|2[0-9]|3[01]).([12][0-99])?([0-9]{2})$/m' , $value);
		return $this->setError($match);
	}
	private function password($value){
		$match = preg_match('/[[:alnum:]]{8,50}[*.!@#$%^&():;<>,.?~_+-=|]{0,10}/i', $value);
		return $this->setError($match);
	}
	private function nonBlank($value){
		$match = preg_match('/[[:alnum:]]{1,50}[*.!@#$%^&():;<>,.?~_+-=|]{0,10}/i', $value);
		return $this->setError($match);
	}

	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}


	
	public function checkErrors(){
		return $this->error;
	}
	
	public function login($post){
		require_once 'classes/Pdo_methods.php';
		$pdo = new PdoMethods();
		$sql = "SELECT admin_email, admin_name, admin_password, admin_status FROM admins WHERE admin_email = :email";
		$bindings = [[':email',$post['email'],'str']];

		$records = $pdo->selectBinded($sql, $bindings);

		if(count($records) != 0){
			if(password_verify($post['password'], $records[0]['admin_password'])){
				session_start();
				$_SESSION['access'] = "accessGranted";
				$_SESSION['name'] = $records[0]['admin_name'];
				$_SESSION['status'] = $records[0]['admin_status'];
				return "success";
			}else{
				return "<p class='errorMsg'>Invalid credentials.</p>"; 
			}
		}else{
			return "<p class='errorMsg'>Invalid credentials</p>"; 
		}
		
	}

	public function security(){
		session_start();
		if($_SESSION['access'] !== "accessGranted"){header('location: index.php?page=login');}
	}
}