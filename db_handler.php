<?php
	require_once("db_connection.php");
	class db_handler extends db_connection  // extends db connection class to use create_connection method
	{
	public function get_menu()
	{ 
		$day=date("l");
		$conn=$this->create_connection();
		$sql = "SELECT * FROM menu_tb";    // getting user recharge record from recharge table
		$result=mysqli_query($conn,$sql);
		return $result;
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_old_password($username,$role)
	{ 
		$conn=$this->create_connection();
		$sql_password="";
		if($role == "shopkeeper")
		{
		$sql_password = "SELECT password from shopkeeper_tb where sk_username = '{$username}' ";  // accessing user password if shopkeeper
		}else
		{
		$sql_password = "SELECT password from user_tb where username = '{$username}' ";  // accessing user old password if customer
		}
		$password_result = mysqli_query($conn,$sql_password);
		$subject=mysqli_fetch_assoc($password_result);
		$password_database=$subject["password"];
		return $password_database;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function set_new_password($new_password,$username,$role)
	{ 
		$conn=$this->create_connection();
		if($role == "shopkeeper")
		{
		$sql = "UPDATE shopkeeper_tb SET password='{$new_password}' where sk_username = '{$username}' ";   // updating password
		}else{
		$sql = "UPDATE user_tb SET password='{$new_password}' where username = '{$username}' ";   // updating password
		}
		mysqli_query($conn,$sql);  // performing mysql query
		mysqli_close($conn);	//closing connection	
		echo "<h4>Password has been updated successfully.</h4>";

	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function set_new_pin($new_pin,$username)
	{ 
		$conn=$this->create_connection();
		$sql = "UPDATE user_tb SET pin='{$new_pin}' where username = '{$username}' ";   // updating password
		mysqli_query($conn,$sql);  // performing mysql query
		mysqli_close($conn);	//closing connection	
		echo "<h4>Pin has been updated successfully.</h4>";
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_user_balance($username)
	{ 
		$conn=$this->create_connection();
		$sql_balance= "SELECT balance from user_tb where username = '{$username}' ";  // accessing account balance
		
		$balance = mysqli_query($conn,$sql_balance);
		$subject=mysqli_fetch_assoc($balance);
		$blnc=$subject["balance"];
		$_SESSION["balance"]=$blnc;
		echo $blnc; //shows balance
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function check_user($username)
	{			
				$conn=$this->create_connection();
				$result = mysqli_query($conn,"SELECT username from user_tb where username='{$username}' ");
		
				$subject= mysqli_fetch_assoc($result);
				$name_user= $subject["username"];			//checks for id to decide about user existence
				if( $name_user === NULL)
					{
						return "no";       // if username exists in database
					}
					else
					{
						return "yes";
					}			// if username doesn't exist
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_purchase_record($username) // to get purchase record of a user....
		{	
			$sql=null;
			$conn=$this->create_connection();
			if($username != null)
			{
			$sql = "SELECT * FROM user_record WHERE username = '{$username}' ORDER BY date DESC";  // requesting for record of shopkeeper transactions between date1 and date2
			}
			else
			{
			$sql = "SELECT * FROM user_record ORDER BY date DESC";    // getting user recharge record from recharge table
			}
			$result=mysqli_query($conn,$sql);
			return $result;
		}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_recharge_record($username) // to get recharge record of a user....
		{
			$sql=null;
			$conn=$this->create_connection();
			if($username != null)
			{
			$sql = "SELECT * FROM recharge_record WHERE username='{$username}' ORDER BY date DESC";    // getting user recharge record from recharge table
			}
			else
			{
			$sql = "SELECT * FROM recharge_record ORDER BY date DESC";    // getting user recharge record from recharge table
			}
			$result=mysqli_query($conn,$sql);
			return $result;
		}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_activation_record($username) // to get activation record of a user....
		{
		$conn=$this->create_connection();
		$sql="";
		if($username == null)
			{
			$sql = "SELECT * FROM activation_record ORDER BY date DESC";  // requesting for record of shopkeeper transactions 
			}
		else
			{				
			$sql = "SELECT * FROM activation_record WHERE username = '{$username}' ORDER BY date DESC";  // requesting for record of shopkeeper transactions 
			}
		$result=mysqli_query($conn,$sql);	
		return $result;
		}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function generate_table($table_for) // generated table headings according to given input....
		{
		$headings=null;
		if($table_for == "purchase record")
		{
		$headings=array("item_name","Price","Shopkeeper","Location","Date","Time");
		}
		else if($table_for == "admin cafe record")
		{
		$headings=array("Username","item_name","Price","Shopkeeper","Location","Date","Time");
		}else if($table_for == "recharge record")
		{
		$headings=array("Date","Time","Balance Added","Added by");
		}else if($table_for == "menu")
		{
		$headings=array("Item Name","Quantity","Price","Category","Location");
		}else if($table_for == "acc recharge record")
		{
		$headings=array("Username","Date","Time","Balance Added","Added by");
		}else if($table_for == "acc activation record")
		{
		$headings=array("Username","Date","Time","Activated By");
		}
		
		$length = sizeof($headings);
		echo "<table id=\"example\" class=\"table table-bordered\" cellspacing=\"0\" width=\"100%\">";
            echo "<tr>";
			for ($x = 0; $x <$length ; $x++) 
			{
			echo  "<th>{$headings[$x]}</th>";
			}
			echo "</tr>";
		}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function populate_table($table_for,$result) // generated table headings according to given input....
		{
		$data_names=null;
		if($table_for == "purchase record")
		{
		$data_names=array("item_name","price","shopkeeper","location","date","time");
		}
		else if($table_for == "admin cafe record")
		{
		$data_names=array("username","item_name","price","shopkeeper","location","date","time");
		}else if($table_for == "recharge record")
		{
		$data_names=array("date","time","amount_added","accountant");
		}else if($table_for == "menu")
		{
		$data_names=array("item_name","quantity","price","category","location");
		}else if($table_for == "acc recharge record")
		{
		$data_names=array("username","date","time","amount_added","accountant");
		}else if($table_for == "acc activation record")
		{
		$data_names=array("username","date","time","activated_by");
		}
		
		$length = sizeof($data_names);
		while( $subject = mysqli_fetch_assoc($result))
				{
				echo "<tr> ";
				for ($x = 0; $x <$length ; $x++) 
					{
	
					echo  "<td>  {$subject[$data_names[$x]]}</td>";
					}
				echo "<tr>";
				}
			echo "</table>";
           
		} 
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function get_user_rank($username)
	{ 
		$conn=$this->create_connection();
		$sql_rank= "SELECT rank from user_tb where username = '{$username}' ";  // accessing account balance
		
		$rank = mysqli_query($conn,$sql_rank);
		$subject=mysqli_fetch_assoc($rank);
		$blnc=$subject["rank"];
		$_SESSION["rank"]=$blnc;
		echo " ".$blnc; //shows balance
	}
		
	
	
	
	
	
	}
?>