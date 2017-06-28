app.controller("myCtrl", function($scope, $http, Address, Weather, Forecast) {
	$scope.zipcode = "";
	$scope.hasWeather = false;
	$scope.currentBG = "default_bg";
	
	//Get the weather information
	$scope.getWeather = function() {
		//Get the geolocation information
		Address.get($scope.zipcode, function(data) {
			if (data.status != "ZERO_RESULTS") {
				$scope.formattedAddress = data.results[0].formatted_address;
				$scope.areaLocation = data.results[0].geometry.location;
				//Get the weather data
				Weather.get($scope.areaLocation.lat, $scope.areaLocation.lng, function(data) {
					$scope.weather = data;
					$scope.hasWeather = true; //Set to true to show weather in view
					$scope.changeBackground($scope.weather.weather[0].icon); //Change the background of app base on weather
					//Get the forecast data
					Forecast.get($scope.areaLocation.lat, $scope.areaLocation.lng, function(data) {
						$scope.forecast = data;
					});			
				});				
			}
			else {		
				$("#zipcode_input").popover({
					content: "Entrer une localisation valide",
					placement: "bottom",
					html: true,
					trigger: "manual"
				});
				$scope.popoverHelper.showPopover();
				
			}
		});
		//Reset text for input box
		$scope.zipcode = "";
	};
	
	//Change the background of the app base on the current weather
	$scope.changeBackground = function(code) {
		$('#background').removeClass($scope.currentBG);
		switch(code) {
			case "01d":
				$scope.currentBG = "clearDay_bg";			
				break;
			case "01n":
				$scope.currentBG = "clearNight_bg";
				break;
			case "02d":
				$scope.currentBG = "fewCloudsDay_bg";
				break;
			case "02n":
				$scope.currentBG = "fewCloudsNight_bg";
				break;
			case "03d":
			case "04d":
				$scope.currentBG = "cloudyDay_bg";
				break;
			case "03n":
			case "04n":
				$scope.currentBG = "cloudyNight_bg";
				break;
			case "09d":
			case "10d":
				$scope.currentBG = "rainyDay_bg";
				break;
			case "09n":
			case "10n":
				$scope.currentBG = "rainyNight_bg";
				break;
			case "11d":
			case "11n":
				$scope.currentBG = "thunderstorm_bg";
				break;
			case "13d":
				$scope.currentBG = "snowDay_bg";
				break;
			case "13n":
				$scope.currentBG = "snowNight_bg";
				break;
			case "50d":
			case "50n":
				$scope.currentBG = "mist_bg";
				break;			
			default:
				$scope.currentBG = "default_bg";
				break;	
		}
		$('#background').addClass($scope.currentBG);
	};
	
	//Get the icon for the current weather
	$scope.getIcon = function(code) {
		switch(code) {
			case "01d":
				return "images/weather_icons/01d.png";
				break;
			case "01n":
				return "images/weather_icons/01n.png";
				break;
			case "02d":
				return "images/weather_icons/02d.png";
				break;
			case "02n":
				return "images/weather_icons/02n.png";
				break;
			case "03d":
				return "images/weather_icons/03d.png";
				break;
			case "03n":
				return "images/weather_icons/03n.png";
				break;
			case "04d":
				return "images/weather_icons/04d.png";
				break;
			case "04n":
				return "images/weather_icons/04n.png";
				break;
			case "09d":
				return "images/weather_icons/09d.png";
				break;
			case "09n":
				return "images/weather_icons/09n.png";
				break;
			case "10d":
				return "images/weather_icons/10d.png";
				break;
			case "10n":
				return "images/weather_icons/10n.png";
				break;
			case "11d":
				return "images/weather_icons/11d.png";
				break;
			case "11n":
				return "images/weather_icons/11n.png";
				break;
			case "13d":
				return "images/weather_icons/13d.png";
				break;
			case "13n":
				return "images/weather_icons/13n.png";
				break;
			case "50d":
				return "images/weather_icons/50d.png";
				break;
			case "50n":
				return "images/weather_icons/50n.png";
				break;
		}
	};
	
	$scope.showWeather = function() {
		return $scope.hasWeather;
	};
	
	//Show or hide popover message
	$scope.popoverHelper = {
		showPopover: function() {
			$("#zipcode_input").popover("show");
		},
		hidePopover: function() {
			$("#zipcode_input").popover("hide");
		}
	};
});