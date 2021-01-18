<?php
	class shopkeeper_class 
	{
		public $username;
		private $password;
		
		
	public function reset_password_shopkeeper($username, $old_pwd, $new_pwd, $new_pwd_confirm, db_connection $connect)
		{
			$count = 0;
			$rank = 'abc';
		if(isset($_POST['reset_password']))
			{
			$conn=$connect->create_connection(); //calling create connection function to establish connection
			$old_password = trim($_POST['old_password']);		//getting values posted to from
			$new_password = trim($_POST['new_password']);
			$confirm_password = trim($_POST['confirm_password']);
			$sql_password = "SELECT password from shopkeeper_tb where sk_username = '{$username}' ";  // accessing user record 
			$password_result = mysqli_query($conn,$sql_password);
			
			$subject=mysqli_fetch_assoc($password_result);
			$password_database=$subject["password"];
			
			if($password_database === $old_password && $new_password === $confirm_password)    // checking for validation
				{
				$sql = "UPDATE shopkeeper_tb SET password='{$new_password}' where sk_username = '{$username}' ";   // updating password
				mysqli_query($conn,$sql);  // performing mysql query
				mysqli_close($conn);	//closing connection	
				echo "<h4>Password has been updated successfully.</h4>";
				}
			else
				{
				echo "<h4>Unable to change your password. Type again carefully.</h4>";
				}
			}
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function make_transaction(db_connection $connect)   // to insert form details into databases
		{
		if(isset($_POST['make_transaction']))
			{
			$conn =$connect->create_connection();
			$username = trim($_POST['username']);      //getting username from Form
			$amount =trim($_POST['bill']);			//getting amount posted to from
			$items = trim($_POST['items']);			//getting items posted to from
			$pin = trim($_POST['pin']);					// getting pin posted to form
			$date =date("m-d-y");                      // getting system date 
			$time=date("H:i:s");      // getting system time
			$skname=$_SESSION['username'];				// getting shopkeeper name from SESSION
			$user_row = "SELECT * from user_tb WHERE username='{$username}'"; //query to get whole row with username
			$result = mysqli_query($conn,$user_row);
		
			while($subject=mysqli_fetch_assoc($result))
				{
						//adding amount to retrieved balance 
				$count=$subject["count"];
				$rank=$subject["rank"];
				$account_status=$subject["status"];
				$account_pin=$subject["pin"];
				$blnc=$subject["balance"];   // User Account balance
				if($account_status ==='notactive')
					{
					echo "<h4>Your account is inactive.Shopping feature is available for active accounts only</h4>";
					//echo "<script>window.location=\"shopkeeper.php\"</script>";
					}
					else if ($blnc < $amount)
					{
					echo "<h4>Balance not enough. Kindly recharge your account.</h4>";
					}
				else
					{
					if($account_pin===$pin)
						{
						$count +=$amount;
						if($rank === 'Platinum')
						{
							$val= (5 * $amount)/100;
							$blnc -=$val;
						}
						else if($rank === 'Silver')
						{
							$val= (10 * $amount)/100;
							$blnc -=$val;
						}
						else if($rank === 'Gold')
						{
							$val= (20 * $amount)/100;
							$blnc -=$val;
						}
						else
						{
							$blnc -=$amount;            // updating balance 
						}
						$sql_main = "UPDATE user_tb SET balance = '{$blnc}' WHERE username = '{$username}' ";  // will subtract amount from existing balance 
						$sql_count = "UPDATE user_tb SET count = '{$count}' WHERE username = '{$username}' ";
						$sql_usertb= "INSERT INTO user_record (username,item_name,price,shopkeeper,location,date,time) 
						VALUES ('{$username}','{$items}','{$amount}','{$_SESSION['username']}','college cafe','{$date}','{$time}')";  // update transaction details in recharge table
						mysqli_query($conn,$sql_usertb);  //  updated recharge table
						mysqli_query($conn,$sql_main);  //update balance in maintb
						mysqli_query($conn,$sql_count); //update count
						if ($count >  20000 && $count <  30000)
						{
							$sql_rank = "UPDATE user_tb SET rank = 'Platinum' WHERE username = '{$username}' ";
							mysqli_query($conn,$sql_rank);
							echo "<h4>Transaction Completed Successfully & customer now Platinum User</h4>";
						}
						else if ($count >  30000 && $count <  50000)
						{
							$sql_rank = "UPDATE user_tb SET rank = 'Silver' WHERE username = '{$username}' ";
							echo "<h4>Transaction Completed Successfully & customer now Silver User</h4>";
							mysqli_query($conn,$sql_rank);
						}
						else if ($count > 50000)
						{
							$sql_rank = "UPDATE user_tb SET rank = 'Gold' WHERE username = '{$username}' ";
							echo "<h4>Transaction Completed Successfully & customer now Gold User</h4>";
							mysqli_query($conn,$sql_rank);
						}
						else
						{
							echo "<h4>Transaction Completed Successfully.</h4>";
						}
						
						//echo "<script>window.location=\"shopkeeper.php\"</script>";
						}
					else
						{
						echo "<h4>Invalid Credentials.</h4>";
						}
					}		
		
				}
	
			mysqli_close($conn);	//closing connection
	
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function get_pending_orders(db_connection $connect)   // to insert form details into databases
		{
				$conn=$connect->create_connection();
				$sql = "SELECT * FROM order_tb WHERE order_status = 'notserved' ORDER BY time DESC";  // requesting for record of shopkeeper transactions between date1 and date2
				$result=mysqli_query($conn,$sql);
				
	
			echo "<table id=\"example\" class=\"table table-bordered\" cellspacing=\"0\" width=\"100%\">";
            echo "<tr>";
			echo  "<th>"."Order Id"."</th>";
			echo    "<th>"."Items"."</th>";
            echo    "<th>"."ordered by"."</th>";
			echo    "<th>"."Day"."</th>";
			echo    "<th>"."Date"."</th>";
			echo  "<th>"."Time"."</th>";	
			echo "</tr>";
		   
			while( $subject = mysqli_fetch_assoc($result))
				{
				echo "  <tr>";
				echo "      <td>".$subject["order_id"]."</td>";
				echo "      <td>".$subject["items"]."</td>";
				echo "      <td>".$subject["ordered_by"]."</td>";	
				echo "      <td>".$subject["day"]."</td>";        // showing results in form of table
				echo "      <td>".$subject["date"]."</td>";
				echo "      <td>".$subject["time"]."</td>";
				echo "  </tr>";
				}
			echo "</table>";
			
			mysqli_close($conn); //closing connection
		}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function add_to_served(db_connection $connect)   // to insert form details into databases
		{
		if(isset($_POST['add_to_served']))
			{
			$conn =$connect->create_connection();
			$id = trim($_POST['order_id']);      //getting order_id from Form
			$sql_main = "DELETE from order_tb WHERE order_id = '{$id}' ";  // delete order bcz served
			mysqli_query($conn,$sql_main);  // executes query above			
			}
			mysqli_close($conn); //closing connection
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function view_menu(db_connection $connect)     // get recharge record of a accountant
		{
		$conn=$connect->create_connection();
		if(isset($_POST['day_to_view']))
		{
			$day = trim($_POST['day_to_view']);
			$sql = "SELECT * FROM menu_tb WHERE day='{$day}'";    // getting user recharge record from recharge table
		}else
		{
			$sql = "SELECT * FROM menu_tb ORDER by day";    // getting user recharge record from recharge table
		}
		$result=mysqli_query($conn,$sql);
  
		echo "<table id=\"example\" class=\"table table-bordered\" cellspacing=\"0\" width=\"100%\">";
            echo "<tr>";
            echo  "<th>"."Item Name"."</th>";
            echo    "<th>"."Quantity"."</th>";
			echo    "<th>"."Price"."</th>";
			echo    "<th>"."Category"."</th>";
			echo    "<th>"."Day"."</th>";
			echo  "<th>"."Location"."</th>";
			echo "</tr>";
		while( $subject = mysqli_fetch_assoc($result))
			{
			echo "  <tr>";
			echo "      <td>".$subject["item_name"]."</td>";
			echo "      <td>".$subject["quantity"]."</td>";	
			echo "      <td>".$subject["price"]."</td>";
			echo "      <td>".$subject["category"]."</td>";			
			echo "      <td>".$subject["day"]."</td>";
			echo "      <td>".$subject["location"]."</td>";
			echo "  </tr>";
			}
		echo "</table>";
		mysqli_close($conn); //closing connection
		}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function update_menu(db_connection $connect)   // to insert form details into databases
		{
		if(isset($_POST['add_item']))
			{
			$conn =$connect->create_connection();
			$item_name = trim($_POST['item_name']);      //getting item_name from Form
			$quantity = trim($_POST['quantity']);      //getting quantity from Form
			$price = trim($_POST['price']);      //getting price from Form
			$category = trim($_POST['category']);      //getting category from Form
			$day = trim($_POST['day']);      //getting day from Form
			$location = trim($_POST['location']);      //getting location from Form
			
			$sql_main = "INSERT INTO `menu_tb`(`item_name`, `quantity`, `price`, `category`, `day`, `location`) 
						VALUES ('{$item_name}','{$quantity}','{$price}','{$category}','{$day}','{$location}')";  // delete order bcz served
			mysqli_query($conn,$sql_main);  // executes query above	
				echo "<script>alert('Item has been added to the Menu.')</script>";
			}
			mysqli_close($conn); //closing connection
		}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function remove_item(db_connection $connect)   // to insert form details into databases
		{
			$conn =$connect->create_connection();
			$item_remove = trim($_POST['item_remove']);      //getting order_id from Form
			$sql_main = "DELETE from menu_tb WHERE item_name = '{$item_remove}' ";  // delete order bcz served
			mysqli_query($conn,$sql_main);  // executes query above	
			echo "<script>alert('Item has been removed from the Menu.')</script>";			
			mysqli_close($conn); //closing connection
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
	}
	
	

?>
