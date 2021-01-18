<?php
 require_once("db_handler.php");
 class menu extends db_handler
 {
 public function view_menu()     // get recharge record of a accountant
		{
		$result=$this->get_menu();  // calling db_handler method get_menu to get menu 
		$this->generate_table("menu");   // generates table for menu
		$this->populate_table("menu",$result);  // calling db_handler class method to fetch data from database object
		}

 }



?>