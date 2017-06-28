<?php include_once("header.php"); ?>
	<body ng-app="myApp">
		<div ng-controller="myCtrl" class="container" id="main_container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col_centered default_bg" id="background">
				<!-- Title -->
				<div class="container-fluid" id="title">
					<h1>Inscription</h1>
				</div>
				<div class="container-fluid" id="formulaire">
					<form class="form-horizontal" method="POST" action="formulaire.php">
  						<div class="row">
			    			<div class="col-xs-offset-3 col-xs-6 col-sd-offset-3 col-sm-6 col-md-offset-3 col-md-6">
			    				<div class="form-group"> 
			    					<!-- Nom -->
									<label for="full_name_id" class="control-label">Nom</label>
										<input type="text" class="form-control" id="full_name_id" name="full_name" placeholder="Votre nom">
								</div>	
								<div class="form-group"> 
									<!-- Adresse -->
									<label for="street1_id" class="control-label">Adresse</label>
										<input type="text" class="form-control" id="street1_id" name="street1" placeholder="Adresse">
								</div>									
								<div class="form-group"> 
									<!-- Complement d'adresse -->
									<label for="street2_id" class="control-label">Complement d'adresse</label>
										<input type="text" class="form-control" id="street2_id" name="street2" placeholder="Complement d'adresse">
								</div>	
								<div class="form-group"> 
									<!-- Ville-->
									<label for="city_id" class="control-label">Ville</label>
										<input type="text" class="form-control" id="city_id" name="city" placeholder="Ville">
								</div>
								<div class="form-group"> 
									<!-- Code postal-->
									<label for="code_id" class="control-label">Code Postal</label>
										<input type="text" class="form-control" id="code_id" name="code" placeholder="Code Postal">
								</div>
								<div class="form-group"> 
									<!-- GPS-->
									<label for="gps_id" class="control-label">Coordonnées GPS</label>
										<input type="text" class="form-control" id="gps_id" name="gps" placeholder="Coordonnées GPS">
								</div>	
			    				<div class="form-group">
			    					<!-- Email-->
			    					<label for="email_id" class="control-label">Email</label>
			    						<input type="email" name="email" id="email_id" class="form-control" placeholder="Adresse email">
			    				</div>
  								<div class="form-group">
  									<!-- Bouton d'envois et de retour -->
    								<div class="col-sm-offset-4 col-sm-6">
      									<button name="submit" type="submit" class="btn btn-default">Envoyer</button>
      									<a href="index.php" class="btn btn-default" role="button">Accueil</a>
    								</div>
  								</div>
  							</div>	
  						</div>		
					</form>
				</div>	
			</div>	
		</div>		
	</body>
</html>	