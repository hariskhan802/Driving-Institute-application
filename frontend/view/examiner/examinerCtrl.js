	
	var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
	var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
	driveApp.controller('examinerCtrl', function($http, APIURL, $stateParams){
		var vm = this;

		vm.allEx = function(){
			$http({
		        method : "GET",
		        url : APIURL+"examiner/list"
		    }).then(function mySuccess(response) {
		        vm.exs = response.data;

		    });
		}
		vm.f = {};

		vm.addEx = function(){
			var fd = new FormData();
			angular.forEach(vm.f,function(val, key){
				fd.append(key, val);
			})
			$http({
		        method : "POST",
		        url : APIURL+"examiner/add",
		        data: fd,
		        headers: {"Content-type": undefined},
		        transformRequest: angular.identity,
		    }).then(function mySuccess(response) {
		        if(response.data){
		        	swal('Add Successfully');
		        }


		    });
		}
		vm.getEx = function(){
			var fd = new FormData();
			fd.append('id', $stateParams.id);
			$http({
		        method : "POST",
		        url : APIURL+"examiner/edit",
		        data: fd,
		        headers: {"Content-type": undefined},
		        transformRequest: angular.identity,
		    }).then(function mySuccess(response) {
		        vm.f.name = response.data[0].name;

		    });
		}

		vm.updateEx = function(){
			var fd = new FormData();
			vm.f.id = $stateParams.id;
			angular.forEach(vm.f,function(val, key){
				fd.append(key, val);
			})
			$http({
		        method : "POST",
		        url : APIURL+"examiner/edited",
		        data: fd,
		        headers: {"Content-type": undefined},
		        transformRequest: angular.identity,
		    }).then(function mySuccess(response) {
		        if(response.data) {
		        	swal('Successfully Update');
		        }


		    });
		}
		vm.deletEx = function(id){
			var fd = new FormData();
			fd.append('id', id);
			swal({
              title: "Are you sure?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Delete",
              closeOnConfirm: false,
            },function(isConfirm){
                if (isConfirm) {
                    $http({
                        url: APIURL+"examiner/delete",
                        method: "POST",
                        data: fd,
                        headers: {'Content-Type': undefined},
                        transformRequest: angular.identity,
                    }).then(function(data){
                        if(data.data == 1){
                            swal("Delete Train Successfully!", "", "success");
                            vm.allEx();
                            // vm.tA = {};
                        }
				    });
                } 
            });
		}
	});