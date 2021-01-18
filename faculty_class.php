<?php
require_once("db_handler.php");
	class faculty_class extends db_handler
	{
	
	public function get_menu_faculty()
	{ 
		
		$result = $this->get_menu();   // calling get_menu method declared in db_handler class
		$count=1;				
		while( $subject = mysqli_fetch_assoc($result))
			{
			$item=$subject["item_name"];
			$deal=$subject["quantity"];
			$price=$subject["price"];
			$_SESSION[$count]=$item;
			$_SESSION[$count."p"]=$price;
			
			
			echo "<tr>";
			echo "      <td>".$item."</td>";
			echo "      <td>".$deal."</td>";	
			echo "      <td>".$price."</td>";
			echo "     <td> <input type=\"number\" min=\"0\" name=\"quantity[]\"  class=\"form-control\"/> ";
			echo "</tr>";
			$count=$count+1;
			}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function place_order()
	{ 
		$conn=$this->create_connection();
		$day = date("l");
		$date =date("m-d-y");                      // getting system date 
		$time=date("H:i:s");      // getting system time
		$count1=1;
		$qsum=0;
		$bill=0;
		$items="";
		foreach ($_POST['quantity'] as $qty) {        
			if($qty >0)
				{
				$bill=$bill+($_SESSION[$count1."p"]*$qty);    // updating bill amount against each item according to quantity
				$items=$items."".$_SESSION[$count1]."(".$qty."),";
				$qsum +=$qty;
				}      // adding items ordered to a string
			$count1++;                                    // increments in $count1
			}
		$balance=$_SESSION["balance"];                    // getting balance from session
		$username=$_SESSION["username"];                  // getting username from session
		if($balance< $bill)
		{
		echo "<h4> Balance not enough. Kindly recharge your account.</h4>";
		}
		else if ($qsum > 0) 
		{
		$balance -=$bill;     // updating balance 
						$sql_main = "UPDATE user_tb SET balance = '{$balance}' WHERE username = '{$username}' ";  // will subtract amount from existing balance 
						$sql_usertb= "INSERT INTO user_record (username,item_name,price,shopkeeper,location,date,time) 
						VALUES ('{$username}','{$items}','{$bill}','online order','college cafe','{$date}','{$time}')";  // update transaction details in recharge table
						$sql_ordertb= "INSERT INTO order_tb (items,ordered_by,day,date,time) 
						VALUES ('{$items}','{$username}','{$day}','{$date}','{$time}')";  // place order in order table
						mysqli_query($conn,$sql_usertb);   //  updated recharge table
						mysqli_query($conn,$sql_main);     //update balance in maintb
						mysqli_query($conn,$sql_ordertb);  // placing order in order_tb
						
						echo "<h4>Order has been placed Successfully.</h4>";
		}else{
		echo "<h4> No item selected.Order can not be placed.</h4>";
		}
		
	}
	
	
	
	
	}
?>