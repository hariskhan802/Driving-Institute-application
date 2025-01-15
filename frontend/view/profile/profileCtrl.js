
	var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
	var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
	driveApp.controller('profileCtrl', function($http, APIURL, $rootScope, $interval){
		var vm = this;
		vm.f = {};
		vm.userData = {};

		$interval(function(){
			vm.userData = $rootScope.userData;
			vm.f.name = vm.userData.name;
			vm.f.email = vm.userData.email;
		
		}, 1 , 30);

		vm.updatePro = function(){
			var fd = new FormData();
			angular.forEach(vm.f, function(val, key){
				fd.append(key, val);
			});
			$http({
				url: APIURL+"profile",
				method: "post",
				data: fd,
				headers: {'Content-type': undefined},
				transformRequest: angular.identity,
			}).then(function(request){
				$rootScope.checkLogin();
				if(request.data) {
					swal('Update Successfully');
				}
			});
		}
	});	