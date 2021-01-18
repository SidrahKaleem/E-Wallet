<?php
	require_once("db_connection.php");
	require_once("shopkeeper_class.php");

	$conn = new db_connection();
	$conn->create_connection();
	$shopkeeper = new shopkeeper_class();
	
   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "shopkeeper")
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
        <title>Update Menu</title>
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
                            

                            <a href="Shopkeeper.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-off"
></span>Home</a>
                       
                           <a href="logout.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-off"></span> logout</a>
                       
					   </ul>
                  <!--	  /.nav-collapse -->
                </div>
  
            </header>

</div><!--menu-->


<div class="container">



        <div class="row centered-form">
		
				
			
			<div class="col-md-5 col-xs-12 col-md-offset-3" >
			<div class="panel panel-default">
        		<div class="panel-heading">
				
				<h3 class="panel-title">Add Item to Menu</h3>
			    		
			 			</div>
			<form action="update_menu.php" method ="post" enctype="multipart/form-data">
						</br>
			    			<div class="form-group">
			    			<input type="text" name="item_name" class="form-control input-sm" placeholder="Item name">	
							</div>
							<div class="form-group">
			    				<input type="text" name="quantity" class="form-control input-sm" placeholder="Quantity (full/half)">
			    			</div>

			    			<div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
										<input type="number" min="0" name="price"  class="form-control" placeholder="Price"/>
									</div>
			    			</div>
							</div>
							<div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
									<input type="text" name="category" class="form-control input-sm" placeholder="Category">	
									</div>
			    			</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
									<input type="text" name="day" class="form-control input-sm" placeholder="Day         (e.g. Monday)">	
									</div>
			    			</div>
							</div>
							<div class="form-group">
			    			<input type="text" name="location" class="form-control input-sm" placeholder="Location">	
							</div>
							
						<button href="" name="add_item" type="submit" class="btn btn-success gradient pull-right"><span class=
"glyphicon glyphicon-log-in"></span> Add item</button>
						</br></br>
			    		</form>
						</br></br>
						<div class="default">		
			    			<?php	
								if(isset($_POST['add_item'])){
								$shopkeeper->update_menu($conn);                  // calling make transaction function
								}
							?>
				</div>
				</div>
				<div class="panel panel-default">
        		<div class="panel-heading">
				
				<h3 class="panel-title">Remove item</h3>
			    		
			 			</div>
				<form action="update_menu.php" method ="post" enctype="multipart/form-data">
						</br>
			    			<div class="form-group">
			    			<input type="text" name="item_remove" class="form-control input-sm" placeholder="Item name">	
							</div>
							
						<button href="" name="remove_item" type="submit" class="btn btn-success gradient pull-right"><span class=
"glyphicon glyphicon-log-in"></span> Remove item</button>
						</br></br>
			    		</form>
						</br></br>
						<div class="default">		
			    			<?php	
								if(isset($_POST['remove_item'])){
								$shopkeeper->remove_item($conn);                  // calling make transaction function
								}
							?>
				</div></div>
    		</div>
			</br></br>
			<div class="col-md-7 col-xs-6 col-md-offset-2" >
				<form action="update_menu.php" method ="post" enctype="multipart/form-data">
						<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
									<input type="text" name="day_to_view" class="form-control input-sm" placeholder="Enter day 
e.g.Friday,Sunday.">
									</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<button href="" name="view_by_day" type="submit" class="btn btn-success gradient pull-right"><span class=
									"glyphicon glyphicon-log-in"></span> View by Day</button>
			    				</div>
			    			</div>
			    		</form>
        	<div class="panel panel-default">
        		<div class="panel-heading">
				
				<h3 class="panel-title">Menu</h3>
			    		
			 			</div>
		                
						<?php 
							echo $shopkeeper->view_menu($conn);
						?>
						</br></br>
						
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