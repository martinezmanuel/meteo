angular.module("myApp").factory("Address", function($http) {
	var Address = {};
	var URL_ADDRESS = "http://maps.googleapis.com/maps/api/geocode/json";
	Address.get = function(location, callback) {
		$http({
			method: "GET",
			url: URL_ADDRESS,
			params: {
			  address: location,
			  sensor: "true",
			  mode: "json"
			}
		}).success(function(data) {
				callback(data);
		});
	};
	return Address;
});