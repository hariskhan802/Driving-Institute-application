	
	var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
	driveApp.constant('baseurl', 'frontend/view/');
	var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
	
		driveApp.directive('datepicker', function() {
			return {
			    restrict: 'A',
			    require : 'ngModel',
			    link : function (scope, element, attrs, ngModelCtrl) {
			       
				        $(function(){
				         try{
				            element.datepicker({
				                dateFormat: 'dd/mm/yy',
					            changeMonth: true,
					            changeYear: true,
					            showOtherMonths: true,
					            selectOtherMonths: true,
					            maxDate: "16Y",
							    minDate: "-100Y",
							    yearRange: "-100:-0"
				            });
				   			 }catch(e){}
				        });
			       
			    }
			};
		});
	
	driveApp.filter('decimal', function(){
		return function(arg1, arg2) {
			if (arg1 != undefined && arg1 != "") {
				arg1 = parseFloat(arg1).toFixed(2);
			}
			return arg1;
		}
	});
	driveApp.controller('MainCtrl', function($state, $interval, APIURL, $http, $rootScope) {
		var vm = this;
		vm.loginViewFunc = function(){
			vm.isLoginPage = false;
			$interval(function(){
				if( $state.current) {
					if($state.current.name == 'login') {
						vm.isLoginPage = true;
					}
				}
			}, 1)	
		}
		
		$rootScope.checkLogin = function(){
			vm.loginViewFunc();
			$http({
				url: APIURL+ "loginCheck",
				method: "get",
			}).then(function(request){
				vm.userData = request.data.uData;
				$rootScope.userData = request.data.uData;
				if(request.data.isLogin != 1){
					$state.go('login');
				}
				else
				{
					if ($state.current.name == 'login') {
						$state.go('index');	
					}
				}
			});

		}
		vm.logout = function(){
			$http({
				url: APIURL+ "logout",
				method: "post",
				data: {logout: 1},
			}).then(function(request){
				$state.go('login');
			});
		}

	});
	
	driveApp.config(function($stateProvider, $urlRouterProvider, $locationProvider, baseurl) {
		$locationProvider.html5Mode(true);
		
		// Main Route
		$stateProvider.state('index', {
			url: "/", 
			views: {
				"mainView": {
					template: '',
				}
			},
		   resolve: { 
		  		"check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
            }    
		});

		// Profile Route
		$stateProvider.state('profile', {
			url: "/profile", 
			views: {
				"mainView": {
					templateUrl: baseurl+'profile/index.html',
					controller: "profileCtrl",
					controllerAs: "pCtrl",
				}
			},
		   resolve: { 
		  		"check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
                loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'profile/profileCtrl.js');
		 	    }]
            }    
		});
		
		// Login
		$stateProvider.state('login', {
		  url: "/login", 
		  views: {
		    "mainView": {
		      controller: 'loginCtrl', 
		      controllerAs: 'lCtrl', 
		      templateUrl: baseurl+'login/login.html'
		    }
		  },
		  resolve: { 
		  		"check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'login/loginCtrl.js');
		 	    }]
		  }
		})

		// Examiner Routes 
		$stateProvider.state('examiner/add', {
		  url: "/examiner/add", 
		  views: {
		    "mainView": {
		      controller: 'examinerCtrl', 
		      controllerAs: 'eCtrl', 
		      templateUrl: baseurl+'examiner/add.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'examiner/examinerCtrl.js');
		    }]
		  }
		}).state('examiner', {
		  url: "/examiner", 
		  views: {
		    "mainView": {
		      controller: 'examinerCtrl', 
		      controllerAs: 'eCtrl',
		      templateUrl: baseurl+'examiner/index.html'
		    }
		  },
		  resolve: {
		  		"check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                }, 
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'examiner/examinerCtrl.js');
		    }]
		  }
		}).state('examiner/edit', {
		  url: "/examiner/:id", 
		  views: {
		    "mainView": {
		      controller: 'examinerCtrl', 
		      controllerAs: 'eCtrl',
		      templateUrl: baseurl+'examiner/edit.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'examiner/examinerCtrl.js');
		    }]
		  }
		});

		// Student Routes
		$stateProvider.state('student/add', {
		  url: "/student/add", 
		  views: {
		    "mainView": {
		      controller: 'stdCtrl', 
		      controllerAs: 'sCtrl', 
		      templateUrl: baseurl+'student/add.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'student/studentCtrl.js');
		    }]
		  }
		}).state('student', {
		  url: "/student", 
		  views: {
		    "mainView": {
		      controller: 'stdCtrl', 
		      controllerAs: 'sCtrl',
		      templateUrl: baseurl+'student/index.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'student/studentCtrl.js');
		    }]
		  }
		}).state('student/edit', {
		  url: "/student/:id", 
		  views: {
		    "mainView": {
		      controller: 'stdCtrl', 
		      controllerAs: 'sCtrl',
		      templateUrl: baseurl+'student/edit.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'student/studentCtrl.js');
		    }]
		  }
		});

		//  Reports Routes
		$stateProvider.state('report/complete-student', {
		  url: "/report/complete-student", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-complete.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/incomplete-student', {
		  url: "/report/incomplete-student", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-incomplete.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/inactive-student', {
		  url: "/report/inactive-student", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-inactive.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/gender-student', {
		  url: "/report/gender-student", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-gender.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/student-pass', {
		  url: "/report/student-pass", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-pass.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/examiner-pass', {
		  url: "/report/examiner-pass", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/examiner-pass.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/student-occupation', {
		  url: "/report/student-occupation", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-occupation.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/student-accounts', {
		  url: "/report/student-accounts", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-accounts.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		}).state('report/student-print', {
		  url: "/report/student-print", 
		  views: {
		    "mainView": {
		      controller: 'reportCtrl', 
		      controllerAs: 'rCtrl',
		      templateUrl: baseurl+'report/std-print.html'
		    }
		  },
		  resolve: { 
		  	    "check": function($location, $rootScope ){
                    $rootScope.checkLogin();
                    
                },
		  	    loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
	  		       return $ocLazyLoad.load(baseurl+'report/reportCtrl.js');
		    }]
		  }
		});

		$urlRouterProvider.otherwise('/');

	});
	