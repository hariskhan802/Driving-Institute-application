	
	var driveApp = angular.module('driveApp', ['ui.router' ,'oc.lazyLoad']);
	var local =  '/';
	driveApp.constant('APIURL', local+'api/v1/');
	driveApp.controller('reportCtrl', function($http, APIURL, $stateParams, $state){
		var vm = this;

		// Complete Student
		vm.comStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/com-std"
		    }).then(function mySuccess(response) {
		        vm.comStds = response.data;
		    });
		}

		// In Complete Student
		vm.incomStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/incom-std"
		    }).then(function mySuccess(response) {
		        vm.incomStds = response.data;
		    });
		}

		// Gender Student
		vm.genderStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/gender-std",
		    }).then(function mySuccess(response) {
		        vm.genderPerc = response.data;
		    });
		}

		// Pass Student 
		vm.passStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/pass-std",
		    }).then(function mySuccess(response) {
		        vm.passStds = [];
		        let obj = {}
		        response.data.map((val, key, arr)=>{
		        	obj[val.student_id] = val
		        	if(val.practical_pass == 'fail')
		        		obj[val.student_id]['practical_no'] = val.practical_no -1;
		        	if(val.theory_pass == 'fail')
		        		obj[val.student_id]['theory_no'] = val.theory_no -1;

		        })
		        // console.log(Object.values(obj))
		        // console.log(obj)
		        vm.passStds = Object.values(obj);
		    });
		}
		// Examiner
		vm.exStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/exam-pass",
		    }).then(function mySuccess(response) {
		        let mArr = response.data.all
		       	// let count = 0;	
		       	// response.data.all.filter((val, key, arr) => {
		       	// 	mArr[key].pass = "0";
		       	// 	console.log(response.data.pass[key]);
		       	// 	if(response.data.pass[key] == undefined) return;
		       	// 	if(val.examiner_id == response.data.pass[key].examiner_id)
	       		// 	{
	       		// 		mArr[key].pass = response.data.pass[count].count
	       		// 		count++
	       		// 	}
		       	// });
		       	passID = response.data.pass.map(n => n.examiner_id);
				mArray = response.data.all;
				let count = 0;	
				for (var i = 0; i < response.data.all.length; i++) {
					 mArray[i].pass = "";
					 if(passID.indexOf(response.data.all[i].examiner_id) != -1)
					 {
					 	mArray[i].pass = response.data.pass[count]['count']
					 	count++
					 }
				}
		        vm.examStds = mArray;
		        console.log(vm.examStds);
		    });
		}
		// Occupation Student
		vm.occupStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/occup-std",
		    }).then(function mySuccess(response) {
		        vm.occupStds = response.data;
		    });
		}
		vm.accountStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/account-std",
		    }).then(function mySuccess(response) {
		        vm.accountStds = response.data;
		    });
		}

		vm.std = {};
		vm.std.s = {};
		vm.printStds = [];
		vm.printStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/print-std",
		    }).then(function mySuccess(response) {
		        vm.printStds = response.data;
		        angular.forEach(vm.printStds, function(val, key){
			    	vm.std.s[val.id] = false;
			    })
		    });		    
		}

		vm.printCheckAll = function(){
			angular.forEach(vm.std.s, function(val, key){
				vm.std.s[key] = vm.select_all;
		    })
		}
		vm.PrintElem = function(elem)
		{
		    var mywindow = window.open('', 'PRINT', 'height=700,width=1100');

		    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
		    mywindow.document.write('</head><body >');
		    mywindow.document.write('<h1>Student Report</h1>');
		    mywindow.document.write(elem);
		    mywindow.document.write('</body></html>');
		    mywindow.document.close(); // necessary for IE >= 10
		    mywindow.focus(); // necessary for IE >= 10*/
		    mywindow.print();
		    mywindow.close();
		    return true;
		}
		vm.printStdData = function(){
			var isAnyRecSelctedA = [];
	    	var stdIDs = [];

			for(sid  in vm.std.s) {
				if(vm.std.s[sid])
				{
					isAnyRecSelctedA.push(true); 
					stdIDs.push(sid);
				}
				else
				{
					isAnyRecSelctedA.push(false);
				}
		    }

		    if(isAnyRecSelctedA.indexOf(true) != -1){
		    	var sRC = 0;
		    	var recordS = [];
		    	var printHTML = '<table border="1" cellpadding="10">';
	    		printHTML += '<tr>  <td>Name</td>   <td>Social sec. No</td>   <td>Cell No.</td>   <td>Invoice amount</td> </tr>';
		    	angular.forEach(vm.printStds, function(val, key){
					if (stdIDs.indexOf(val.id.toString() )  != -1 )
					{
						recordS[sRC] = val;	
	    				printHTML += '<tr>  <td>'+val.first_name+'</td>   <td>'+val.social_sec_no +'</td>   <td>'+val.cell_no+'</td>   <td>'+val.invoice_amount+'</td> </tr>';
						sRC++;
					}
			    })
			    printHTML += '</table>';
			    vm.PrintElem(printHTML)
		    }
		    else
		    {
		    	swal('Select any record');
		    }
		}
		vm.inactiveStd = function(){
			$http({
		        method : "GET",
		        url : APIURL+"report/inactive-pass",
		    }).then(function mySuccess(response) {
		        vm.inActiveStds = response.data;
		    });
		}
	});