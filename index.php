<?php include_once("header.php"); ?>
	<body ng-app="myApp">
		<div ng-controller="myCtrl" class="container" id="main_container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col_centered default_bg" id="background">
				<!-- Title -->
				<div class="container-fluid" id="title">
					<h1>Météo</h1>
				
				<?php
				include "geoloc.php";
				 ?>
				 </div>
				<!-- Adresse -->
				<div class="container-fluid" id="zipcode">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col_centered">
						<form class="form-inline">
							<input ng-model="zipcode" ng-focus="popoverHelper.hidePopover()" placeholder="Entrer votre localité pour être plus precis prendre les coordonnées GPS" type="text" class="form-control" id="zipcode_input" >
							<button ng-click="getWeather()" id="find_button">Trouver</button>
						</form>
					</div>
				</div>
				<div class="container-fluid custom_scrollbar" id="weather_info">
					<!-- Météo du jour -->
					<div class="row" id="weather_row">
						<div ng-show="showWeather()" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col_centered" >
							<div class="col-xs-12 col-sm-6 col-md6 col-lg-6" id="weather_col">
								<h2>{{formattedAddress}}</h2>
										<p>{{(weather.dt * 1000) | date: 'EEE,d MMM'}}</p>
											<img ng-src="{{getIcon(weather.weather[0].icon)}}"/>
										<p>{{weather.weather[0].main}}</p>
									<h3>{{weather.main.temp | number: 0}}°C</h3>								
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="forecast_col">
										<p>Levé du soleil: {{(weather.sys.sunrise * 1000) | date: 'HH:mm '}} </p>
										<p>Couché du soleil: {{(weather.sys.sunset * 1000) | date: 'HH:mm '}} </p>
										<p>Humidité: {{weather.main.humidity | number: 0}}%</p>
										<p>Pression: {{weather.main.pressure | number: 0}}hPa</p>
							</div>
						</div>
					</div>
					<!-- Météo de la semaine -->
					<div class="row" id="forecast">
						<div ng-repeat="day in forecast.list" class="col-xs-4 col-sm-3 col-md-1 col-lg-1 forecast_col col_centered">
										<p>{{(day.dt * 1000) | date: 'EEE,d MMM'}}</p>
											<img ng-src="{{getIcon(day.weather[0].icon)}}"/>
										<p>{{day.weather[0].main}}</p>
										<p>Max: {{day.temp.max | number: 0}}°C</p>
										<p>Min: {{day.temp.min | number: 0}}°C</p>
						</div>
					</div>
					<!-- Bouton pour le formulaire d'inscription -->
						<a href="inscription.php" class="btn btn-default " role="button">Inscription</a>
				</div>
			</div>
		</div>
	<?php include_once("footer.php"); ?>