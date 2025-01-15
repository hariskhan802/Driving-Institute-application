  
  var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
  var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
  driveApp.controller('loginCtrl', function($http, APIURL, $state){
    var vm = this;
    vm.l = {};
    vm.login = function(){
      var fd = new FormData();
      (vm.l);
      angular.forEach(vm.l, function(val, key){
        fd.append(key, val)
      });
      $http({
        url: APIURL+"loginAttempt",
        method : "POST",
        data: fd,
        headers: {'Content-type': undefined},
        transformRequest: angular.identity,
      }).then(function(data){
        if(data.data == 0)
        {
          swal('Incorrect Password');
        }
        else
        {
          $state.go('index');
                    
        }
      });
    }
  }) 