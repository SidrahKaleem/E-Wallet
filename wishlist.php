<?php
require_once("menu.php");
$mnu = new menu();


   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "customer")
      {
	 header("Location: index.php");
	  }else
	  {
	   global $user_login;
	  $user_login=$_SESSION['username'];  
	  
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wishlist</title>
		<link rel="icon" href="logo.png" type="image/gif" sizes="16x16">
        <!-- CSS -->
		<link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet" >
		<link href="css/buttons.css" rel="stylesheet">
		
	
		
	
	
		
		
      

    </head>

    <body>
	<div id="fullscreen_bg" class="fullscreen_bg">
	
<div class="header_top"></div>

<div class="menu">
    <header class="container">
     <div class="navbar navbar-inner">
                <div class="container">
 <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                    
					   
					   <img src="logo.png" height="100" width="100" >

     </div>
                    
				
					<div class="collapse navbar-collapse pull-right" id="main-menu">
                        <ul class="nav">
                            

                             <a href="Customer.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-home"></span> Home</a>
                           <a href="logout.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-off"></span> logout</a>
						   
                        </ul>
                  <!--	  /.nav-collapse -->
                </div>
  
            </header>

</div><!--menu-->



<div class="container">

        <div class="row centered-form">
									
			<div class="col-md-5 col-xs-12 col-md-offset-3" >
	
        	<div class="panel-default">
			
        		<div class="panel-heading">
				
				<h3 class="panel-title">Menu</h3>
					</div>
			 			<div class="panel panel-default" align="center">
												
								<form action="#" method="post">
								<div class="panel-heading">
							
<b/>Item Name:  <select name="Color">
		  <?php 
	$d="mysql:dbname=e-wallet";
	$username="root";
	$password="";
	try{
	 $conn= new PDO ($d , $username,$password);
	 $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
	echo"connection failed".$e->getMessage(); }
	$sql="SELECT item_name FROM menu_tb ";
	$rowcount=0;
	try{
	$rows=$conn->query($sql);
	foreach($rows as $row){
	   $rowcount++;?>
	   			   <option value="<?php echo $row["item_name"]; ?>"> <?php echo $row["item_name"]?></option>			   
		   <?php
		   }
		   ?>
		   </select> <br> </br>
<input class="btn btn-success btn-sm " type="submit" name="submit" value="Add to Wishlist" />
</form>
</br> </br>
<?php
		   
		   }
		   catch(PDOException $e){
			   echo"connection failed".$e->getMessaage();
		   }
		   
		   if($rowcount==0)
			   echo"NO DATA";
		   $conn=null;
	 ?>
<?php
if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable


  $d="mysql:dbname=e-wallet";
  $username="root";
  $password="";
  try{
     $conn= new PDO ($d , $username,$password);
	 $conn-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
	   echo"connection failed".$e->getMessage();
	 }
//query
$sql="INSERT INTO wishlist(item,user) VALUES ('$selected_val','$user_login')";
try{
   $row=$conn->query($sql);
   
   }
   catch(PDOException $e){
	   echo"connection failed".$e->getMessaage();
   }
   
   $conn=null;


echo "You Added.. " .$selected_val;  // Displaying Selected Value
}
?>
</br> </br>
 <a href="view_menu_customer.php" class="btn btn-success btn-sm ">BUY</a>
						
					</div>
    		</div>						
    	</div>
    </div>
		
	</div>
	
	
	</div>
    </div>
	</div>
    


</body>
	

 
                
 

        <!-- Javascript -->
        
        <script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
		
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>

<?php 
}
?>