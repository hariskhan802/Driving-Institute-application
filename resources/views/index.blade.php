<!DOCTYPE html>
<html lang="en" ng-app="driveApp"  >
  <head>
    @include ('inc/header')
    <base href="{{ url('') }}/" />  
  </head>

  <body class="nav-md" ng-controller="MainCtrl as MC" ng-class="{'body-login': (MC.isLoginPage)}" >
   
  <div id="loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <div class="object" id="object_one"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_four"></div>
        <div class="object" id="object_five"></div>
        <div class="object" id="object_six"></div>
        <div class="object" id="object_seven"></div>
        <div class="object" id="object_eight"></div>
        <div class="object" id="object_big"></div>
      </div>
    </div>
   
  </div>
     
   </div> 

   <div class="container body dash-m" >
      <div class="main_container">

        <div ng-if="!MC.isLoginPage " ng-include="'frontend/inc/sidebar.html'"></div> 

    		<div  ng-if="!MC.isLoginPage" ng-include="'frontend/inc/topbar.html'"></div>
        <!--  -->
    		<div ui-view="mainView" class="main-view" ng-class="{'login-u': (MC.isLoginPage) }" ></div>	
        
        <div ng-if="!MC.isLoginPage" ng-include="'frontend/inc/footer.html'"></div>

        
      </div>
    </div>

     @include ('inc/f-attachment')	 
  </body>


</html>
