<?php
require_once("db_handler.php");
class records extends db_handler
{	
	public function view_purchase_record($username)     // get transaction record(for Customer and faculty)
		{
		
			$result = $this->get_purchase_record($username);   // to get purchase record object
			$this->generate_table("purchase record");          // to generate table for purchase record
			$this->populate_table("purchase record",$result);
		}
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function view_recharge_record($username)     // get recharge record of a customer 
		{
		$result = $this->get_recharge_record($username);   // to get recharge record object
		$this->generate_table("recharge record");          // generates table for recharge reord
		$this->populate_table("recharge record",$result);
		}
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function accountant_recharge_record()     // get recharge record of a accountant
		{
		
		$result=$this->get_recharge_record(null);       // getting recharge record of all users
		$this->generate_table("acc recharge record");   // generating table for recharge record 
		$this->populate_table("acc recharge record",$result);
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function accountant_activation_record()     // get recharge record of a accountant
		{
		
		$result=$this->get_activation_record(null);    // calling db_handler method to get activation record
		$this->generate_table("acc activation record");  // generates table for activation record
		$this->populate_table("acc activation record",$result);
		}
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function view_cafe_sales($username)     // get cafe sales record (for admin)
		{	
			$result=$this->get_purchase_record($username);   // calling db_handler method to get cafe purchase record 
			$this->generate_table("admin cafe record");      // generates table for purchase record 
			$this->populate_table("admin cafe record",$result);
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function activation_record_admin($username)     // get recharge record (for admin)
		{	
			$result = $this->get_activation_record($username);	 // call db_handler class methods to get activation records of the input user
			$this->generate_table("acc activation record");     // generates table for activation record
			$this->populate_table("acc activation record",$result);
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function recharge_record_admin($username)     // get recharge record (for admin)
		{	
			$result=$this->get_recharge_record($username);   // getting recharge record of the argument user
			$this->generate_table("acc recharge record");    // generates table for recharge record
			$this->populate_table("acc recharge record",$result);
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
}
?>