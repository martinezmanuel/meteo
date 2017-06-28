angular.module("myApp").factory("Weather", function($http) {
	var Weather = {};
	var URL_WEATHER = "http://api.openweathermap.org/data/2.5/weather";
	var APPID = "3bd93f338d84f5fe911d8e61a412115c";
	Weather.get = function(latitude, longitude, callback) {
		$http({
			method: "GET",
			url: URL_WEATHER,
			params: {
				lat: latitude,
				lon: longitude,
				mode: "json",
				units: "metric",
				appid: APPID,
				mode: "json"
			}			
		}).success(function(data) {
			callback(data);
		});
	};
	return Weather;
});