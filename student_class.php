<?php
	require_once("db_handler.php");
	class student_class extends db_handler
	{
	public function view_balance($username)
		{ 
		$user_status=$this->check_user($username);
		if($user_status == "no")  // cheking that value exists or not in database
			{ 
			echo "<h4>Username not found.</h4>";
			}
		else{ 
			$this->get_user_balance($username);			
			}
	
		}
		public function get_bal($username)
		{
			$var=$this->get_user_balance($username);
			return $var;
		}
		public function view_rank($username)
		{ 
		$user_status=$this->check_user($username);
		if($user_status == "no")  // cheking that value exists or not in database
			{ 
			echo "<h4>Username not found.</h4>";
			}
		else{ 
			$this->get_user_rank($username);			
			}
	
		}
	}
?>