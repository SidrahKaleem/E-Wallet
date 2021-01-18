<?php
class accountant_class {


	public function inactive_accounts(db_connection $connect)
		{
		$conn = $connect->create_connection();
		$sql = "SELECT * FROM user_tb WHERE status = 'notactive' ";      // getting record of all inactive accounts
		$result=mysqli_query($conn,$sql);
		echo "<table id=\"example\" class=\"table table-bordered\" cellspacing=\"0\" width=\"100%\">";
            echo "<tr>";
        echo  "<th>"."Name"."</th>";
        echo    "<th>"."Username"."</th>";
		echo  "<th>"."Accoutn Status"."</th>";
        echo    "<th>"."Balance"."</th>";
        echo "</tr>";
		   
		while( $subject = mysqli_fetch_assoc($result))
			{
			echo "  <tr>";
			echo "      <td>".$subject["full_name"]."</td>";
			echo "      <td>".$subject["username"]."</td>";	    //showing record in form of a table
			echo "      <td>".$subject["status"]."</td>";
			echo "      <td>".$subject["balance"]."</td>";
			echo "  </tr>";
			}
		echo "</table>";
		mysqli_close($conn); //closing connection
	
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function activate_user(db_connection $connect,$accountant)
		{	
			$username = trim($_POST['username']);	//getting values posted to from
			$uname_status = "";
				$conn=$connect->create_connection();
				$result = mysqli_query($conn,"SELECT username from user_tb where username='{$username}' ");
				while($subject=mysqli_fetch_assoc($result))
				{
				$name_user= $subject["username"];			//checks for id to decide about user existence
				if( $name_user === NULL)                // if username does not exist in database
					{
						$uname_status = "navailable";       
					}
					else			// if username exists
					{
						$uname_status = "available";
					}			
				}
			if($uname_status === 'available')  //it means username exists in database
				{
				$time=date("H:i:s");
				$blnc = trim($_POST['amount']);
				$category = trim($_POST['category']);
				$conn=$connect->create_connection();
				$date =date("m-d-y");          //getting current date from system
				$sql = "UPDATE user_tb SET status = 'active',balance = '{$blnc}',join_date='{$date}',category='{$category}' WHERE username = '{$username}' "; 
				$sql_activate= "INSERT INTO activation_record (username,date,time,activated_by) 
				VALUES ('{$username}','{$date}','{$time}','{$accountant}')";  // update transaction details in recharge table
				mysqli_query($conn,$sql_activate);  //  updated recharge table				
				$result=mysqli_query($conn,$sql);
				if($result==true)
					{	
					echo "<h4> Account activated. </h4>";
					echo "<script> window.location=\"http://localhost/E-Wallet1/accountant_activate_account.php\" </script>";
					}
	
				mysqli_close($conn);	//closing connection
				} 
				echo "<h4> Username doesn't exist. Type again correctly. </h4>";
				
			
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function accountant_recharge_account(db_connection $connect,$accountant)   // to insert form details into databases
		{
		if(isset($_POST['recharge_account']))
			{
			$amount = trim($_POST['amount']);	//getting values posted to from
			$cnfr_amount = trim($_POST['confirm_amount']);
			if($amount < 0)
			{
			echo "<h4>Amount can not be entered in negative. Type again correctly.</h4>";
			}
			else if($amount != $cnfr_amount)      // matching amount entries
				{
				echo "<h4>Amount entries didn't match. Type again correctly.</h4>";
				}
			else
				{
				$username = trim($_POST['username']);
				$uname_status = "";
				$conn=$connect->create_connection();
				$result = mysqli_query($conn,"SELECT username from user_tb where username='{$username}' ");
				while($subject=mysqli_fetch_assoc($result))
				{
				$name_user= $subject["username"];			//checks for id to decide about user existence
				if( $name_user === NULL)                // if username does not exist in database
					{
						$uname_status = "navailable";       
					}
					else			// if username exists
					{
						$uname_status = "available";
					}			
				}     
				if($uname_status == "navailable") 
					{
					echo "<h4>Username doesn't exist. Type again correctly.</h4>";
					return 0;
					}
				else
					{
					$date =date("m-d-y");
					$time= date("H:i:s");
					$conn=$connect->create_connection();  //calling create connection function to establish connection
					$sql_balance = "SELECT balance,status from user_tb WHERE username = '{$username}' "; //query to get balance already in 
					$result = mysqli_query($conn,$sql_balance);
		
					while($subject=mysqli_fetch_assoc($result))
						{
						$account_status=$subject["status"];  //checking for user account status
						if($account_status ==='notactive')
							{
							echo "<h4>Your account is inactive. Recharge feature is available for active accounts only.</h4>";
							}
						else
							{
							$inaccount = $subject["balance"]+$amount;
							$sql_main = "UPDATE user_tb SET balance = '{$inaccount}' WHERE username = '{$username}' ";  // will add amount to existing balance 
							$sql_recharge= "INSERT INTO recharge_record (username,date,time,accountant,amount_added) 
							VALUES ('{$username}','{$date}','{$time}','{$accountant}','{$amount}')";  // update transaction details in recharge table
							mysqli_query($conn,$sql_recharge);  //  updated recharge table
							mysqli_query($conn,$sql_main);  //update balance in maintb
							echo "<h4> Account balance updated.</h4>";
							}
						}
	
					mysqli_close($conn);	//closing connection
	
					}
				}
			}
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function accountant_create_shopkeeper(db_connection $connect)   // to insert form details into databases			
		{
		if(isset($_POST['create_shopkeeper']))
			{
			$name = trim($_POST['sk_name']);
			$email = trim($_POST['sk_email']);				//getting values posted to from
			$username = trim($_POST['sk_username']);
			$password = trim($_POST['password']);
			$cnfr_password = trim($_POST['confirm_password']);
			$area = trim($_POST['duty_area']);
			
			if($password != $cnfr_password)           // matching new password fields
				{
				echo "<h4>Password fields didn't match.</h4>";
				}
			else{
				$conn=$connect->create_connection();  //calling create connection function to establish connection
				$uname_status = "";
				$result = mysqli_query($conn,"SELECT sk_username from shopkeeper_tb where sk_username='{$username}' ");
				while($subject = mysqli_fetch_assoc($result))
				{
				$name_user = $subject["sk_username"];			//checks for id to decide about user existence
				if( $name_user === NULL)                // if username does not exist in database
					{
						$uname_status = "available";       
					}
					else			// if username exists
					{
						$uname_status = "navailable";
					}			
				}     
				if($uname_status != "navailable")
					{
					$sql = "INSERT INTO shopkeeper_tb (sk_name,sk_username,sk_email,password,duty_area)
					VALUES ('{$name}', '{$username}','{$email}', '{$password}','{$area}')";
				
					$res=mysqli_query($conn,$sql); // performing mysql query
					echo "<h4>Shopkeeper created successfully.</h4>";	
					return 0;
					}else
						{echo "<h4>Username already exists. Try different.</h4>";
						mysqli_close($conn);}	//closing connection
	
				}
			}
		}








}





?>