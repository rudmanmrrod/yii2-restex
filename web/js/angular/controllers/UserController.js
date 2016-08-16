var app = angular.module("RestApp.Controllers");

app.controller("usercontroller",function($scope,$http){
	$scope.id = '';
	$scope.username = '';
	$scope.password = '';
	$scope.email = '';
	$scope.mensaje = '';
	//Método por GET
	$scope.sendGET = function(){
		$scope.url = 'http://localhost/yii2-restex/rest/v1/users';
		if($scope.id!='')
		{
			$scope.url+='/'+$scope.id;
		}
		$http.get($scope.url)
		.success(function(data,status,config,headers){
			console.log(data);
			$scope.mensaje = data;
		})
		.error(function(error,status,config,headers){
			console.log(error);
			$scope.mensaje = error;
		});
	};
	//Método por POST (para register)
	$scope.register = function(){
		if($scope.username == '' || $scope.password == '' || $scope.email == '') {
			$scope.error = "Faltan Campos por envíar";
		}
		else{
			$http.post('http://localhost/yii2-restex/rest/v1/users',{
				username:$scope.username,
				password:$scope.password,
				email:$scope.email
			})
			.success(function(data,status,config,headers){
				console.log(data);
				$scope.mensaje = data;
			})
			.error(function(error,status,config,headers){
				console.log(error);
				$scope.mensaje = error;
			});
		}
	};
	//Método por POST (para login)
	$scope.login = function(){
		if($scope.username == '' || $scope.password == '') {
			$scope.error = "Faltan Campos por envíar";
		}
		else{
			$http.post('http://localhost/yii2-restex/rest/v1/user/login',{
				username:$scope.username,
				password:$scope.password,
			})
			.success(function(data,status,config,headers){
				console.log(data);
				$scope.mensaje = data;
			})
			.error(function(error,status,config,headers){
				console.log(error);
				$scope.mensaje = error;
			});
		}
	};
});

