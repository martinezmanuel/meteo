angular.module("myApp").factory("Forecast", function($http) {
	var Forecast = {};
	var URL_FORECAST = "http://api.openweathermap.org/data/2.5/forecast/daily";
	var APPID = "3bd93f338d84f5fe911d8e61a412115c";
	Forecast.get = function(latitude, longitude, callback) {
		$http({
			method: "GET",
			url: URL_FORECAST,
			params: {
				lat: latitude,
				lon: longitude,
				mode: "json",
				units: "metric",
				cnt: "7",
				appid: APPID,
				mode: "json"
			}	
		}).success(function(data) {
			callback(data);
		});
	};
	return Forecast;
});