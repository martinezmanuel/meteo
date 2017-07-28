<?php include_once("header.php"); ?>		
	<body ng-app="myApp" >
		<div ng-controller="myCtrl" class="container" id="main_container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col_centered default_bg" id="background">
				<!-- Title -->
				<div class="container-fluid" id="title">
					<h1>Désinscription</h1>
				</div>
				<div class="container-fluid" id="annulation">
					<form class="form-horizontal" method="POST" action="annulation.php">
  						<div class="row">
			    			<div class="col-xs-offset-3 col-xs-6">
			    				<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
			    				<div class="form-group"> 
			    					<!-- Nom -->
									<label for="full_name_id" class="control-label">Nom</label>
										<input type="text" class="form-control" id="full_name_id" name="full_name" placeholder="Votre nom">
								</div>	
								<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
			    				<div class="form-group">
			    					<!-- Email-->
			    					<label for="email_id" class="control-label">Email</label>
			    						<input type="email" name="email" id="email_id" class="form-control" placeholder="Adresse email">
			    				</div>
			    				<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
								<div class="form-group"> 										
								</div>
  								<div class="form-group">
  									<!-- Bouton d'envois et de retour -->
    								<div class="col-sm-offset-4 col-sm-6">
      									<button name="submit" type="submit" class="btn btn-default">Envoyer</button>
    								</div>
  								</div>
  							</div>	
  						</div>		
					</form>
				</div>	
			</div>	
		</div>		
<?php include_once("footer.php"); ?>