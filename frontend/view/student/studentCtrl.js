var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
	driveApp.controller('stdCtrl', function($http, APIURL, $stateParams, $location ){
	var vm = this;
	vm.f = {};
	vm.addStd = function(){
		var fd = new FormData();
		angular.forEach(vm.f, function(val, key){
			fd.append(key, val);
		});
		$http({
			url : APIURL+"student/add", 
			method: "POST", 
			data: fd,
			headers: {'Content-type': undefined},
			transformRequest: angular.identity,
		}).then(function(req){
			if(req.data) {
            	swal("Add Successfully!", "", "success");
            }
		});
	}
	vm.editStd = function(){
		var fd = new FormData();
		angular.forEach(vm.f, function(val, key){
			fd.append(key, val);
		});
		fd.append('id', $stateParams.id);
		$http({
			url : APIURL+"student/edited", 
			method: "POST", 
			data: fd,
			headers: {'Content-type': undefined},
			transformRequest: angular.identity,
		}).then(function(req){
			if(req.data) {
            	swal("Update Successfully!", "", "success");
            }
	});
	}
	vm.calculateAge = function(birthMonth, birthDay, birthYear) {
		var d = new Date(birthMonth+'/'+birthDay+'/'+birthYear);
		console.log(birthMonth+'/'+birthDay+'/'+birthYear);
		birthYear = d.getFullYear();
		birthMonth = d.getMonth()+1;
		birthDay = d.getDate();
	    var currentDate = new Date();
	    var currentYear = currentDate.getFullYear();
	    var currentMonth = currentDate.getMonth();
	    var currentDay = currentDate.getDate(); 
	    var calculatedAge = currentYear - birthYear;

	    if (currentMonth < birthMonth - 1) {
	        calculatedAge--;
	    }
	    if (birthMonth - 1 == currentMonth && currentDay < birthDay) {
	        calculatedAge--;
	    }
	    return calculatedAge;
	}
	vm.dayDifferenceByDate = function(startDate, finishDate) {
		if (!startDate || !finishDate) return false;
		var currentDate = new Date(finishDate[1], finishDate[0], finishDate[2]);
	    var birthMonth =  startDate[0],
	    birthDay = startDate[1],
	    birthYear = startDate[2];
	    var currentYear = currentDate.getFullYear();
	    var currentMonth = currentDate.getMonth();
	    var currentDay = currentDate.getDate(); 
	    var calculatedAge = currentYear - birthYear;

	    if (currentMonth < birthMonth - 1) {
	        calculatedAge--;
	    }
	    if (birthMonth - 1 == currentMonth && currentDay < birthDay) {
	        calculatedAge--;
	    }
	    return calculatedAge;
	}
	vm.days_between = function(date1, date2) {
		var ONE_DAY = 1000 * 60 * 60 * 24
		var date1_ms = date1.getTime()
	    var date2_ms = date2.getTime()
	    var difference_ms = Math.abs(date1_ms - date2_ms)
	    return Math.round(difference_ms/ONE_DAY)
	}
	vm.spendDay = function(){
		var sDate = vm.f.start_date,
		fDate = vm.f.finish_date;
		if (!sDate || !fDate) return false;

		fDate = fDate.split('/');
		sDate = sDate.split('/');
		
		sDate[2] = sDate[2].substr(2,2);
		fDate[2] = fDate[2].substr(2,2);
		var sDate = new Date(sDate[1]+"/"+sDate[0]+"/"+sDate[2]);
		var fDate = new Date(fDate[1]+"/"+fDate[0]+"/"+fDate[2]);
		
		vm.f.no_of_days_spent = vm.days_between(sDate, fDate)

	} 
	vm.makeSSN = function(opt = null){
		var age = vm.f.age;
		var uni = Math.floor(1000 + Math.random() * 9000);
		age = age.replace(/[/]/g, "");
		var month = age.substr(2,4);
		var day = age.substr(0,2);
		var year = age.substr(4,6);
		var sAge = vm.calculateAge(month, day, year)
		sAge = sAge + 1;
		if(sAge > 17){
			vm.f.age_status_ok = 'Eleven er over 17';
		}
		else{
			vm.f.age_status_ok = 'Eleven er under 17';
		}
		age1 = age.substr(0, 4);
		age2 = age.substr(6, 8);
		age = age1 + age2;
		if(!opt)
			vm.f.social_sec_no = age+"-"+uni;
	}
	vm.allStd = function(){
		
		$http({
			url : APIURL+"student/list", 
			method: "get", 
		}).then(function(res){
			vm.students = res.data;
		});
	}
	vm.getStd = function(){
		$http({
			url : APIURL+"student/edit", 
			method: "post",
			data: {id : $stateParams.id }, 
		}).then(function(res){
			vm.f = res.data.d1[0];
			vm.d2 = res.data.d2;
			for(let i = 1; i <= 7; i++){
				if(vm.d2[(i-1)])
				{
					if (vm.d2[(i-1)].theory_no == i) {
						vm.f['theory_test_date_no_'+i] = vm.d2[(i-1)].theory_date
						vm.f['theory_test_passorfail_no_'+i] = vm.d2[(i-1)].theory_pass

						vm.f['practical_test_date_no_'+i] = vm.d2[(i-1)].practical_date
						vm.f['practical_test_pf_'+i] = vm.d2[(i-1)].practical_pass
						vm.f['examiners_name_'+i] = vm.d2[(i-1)].examiner_id
						vm.f['district_'+i] = vm.d2[(i-1)].distinct
						vm.f['town_'+i] = vm.d2[(i-1)].town
					}
				}
			}	
			vm.theory_practical('t');
			vm.theory_practical('p');
		});

	}
	vm.examiner_list = function(){
		$http({
			url:  APIURL+'examiner/list',
			method: 'get',
		}).then(function(res){
			vm.examiners = res.data
			if($location.path() != '/student/add')
				vm.getStd()
		})
	}
	vm.deletStd = function(id){
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
                    url: APIURL+"student/delete",
                    method: "POST",
                    data: fd,
                    headers: {'Content-Type': undefined},
                    transformRequest: angular.identity,
                }).then(function(data){
                    if(data.data == 1){
                        swal("Delete student Successfully!", "", "success");
                        vm.allStd();
                        // vm.tA = {};
                    }
			    });
            } 
        });
		}
	$stateParams
	vm.tfg = [];
	
	vm.theory_practical = function($type){
		
		if($type == 't')
		{
			vm.tfg = [];

			if(vm.f.theory_test_date_no_1 && vm.f.theory_test_passorfail_no_1 == 'fail')
				vm.tfg.push(2)
			if(vm.f.theory_test_date_no_2   && vm.f.theory_test_passorfail_no_2  == 'fail')
				vm.tfg.push(3)
			if(vm.f.theory_test_date_no_3   && vm.f.theory_test_passorfail_no_3   == 'fail')
				vm.tfg.push(4)
			if(vm.f.theory_test_date_no_4   && vm.f.theory_test_passorfail_no_4   == 'fail')
				vm.tfg.push(5)
			if(vm.f.theory_test_date_no_5   && vm.f.theory_test_passorfail_no_5   == 'fail')
				vm.tfg.push(6)
			if(vm.f.theory_test_date_no_6   && vm.f.theory_test_passorfail_no_6   == 'fail')
				vm.tfg.push(7)
		}
		else if($type == 'p')
		{
			vm.pfg = [];
			if(vm.f.practical_test_date_no_1 && vm.f.practical_test_pf_1 == 'fail'
				&& vm.f.examiners_name_1 && vm.f.district_1 && vm.f.town_1)
				vm.pfg.push(2)
			if(vm.f.practical_test_date_no_2 && vm.f.practical_test_pf_2  == 'fail'
				&& vm.f.examiners_name_2 && vm.f.district_2 && vm.f.town_2)
				vm.pfg.push(3)
			if(vm.f.practical_test_date_no_3 && vm.f.practical_test_pf_3  == 'fail'
				&& vm.f.examiners_name_3 && vm.f.district_3 && vm.f.town_3 )
				vm.pfg.push(4)
			if(vm.f.practical_test_date_no_4 && vm.f.practical_test_pf_4  == 'fail'
				&& vm.f.examiners_name_4 && vm.f.district_4 && vm.f.town_4)
				vm.pfg.push(5)
			if(vm.f.practical_test_date_no_5 && vm.f.practical_test_pf_5  == 'fail'
				&& vm.f.examiners_name_5 && vm.f.district_5 && vm.f.town_5 )
				vm.pfg.push(6)
			if(vm.f.practical_test_date_no_6 && vm.f.practical_test_pf_6 == 'fail' 
				&& vm.f.examiners_name_6 && vm.f.district_6 && vm.f.town_6 )
				vm.pfg.push(7)
		}
	}
	vm.strToDate = function(){
		let day = vm.f.social_sec_no.substr(0,2);
		let month = vm.f.social_sec_no.substr(2,2);
		let year = vm.f.social_sec_no.substr(4,2);
		// let d = new Date(month+'/'+day+'/'+year);
		vm.f.age = vm.calculateAge(month, day, year);
	}
});