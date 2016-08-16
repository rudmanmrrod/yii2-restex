var app = angular.module("RestApp.Controllers");

app.controller("profilecontroller",function($scope,$http){
	$scope.cedula = '';
	$scope.nombre = '';
	$scope.apellido = '';
	$scope.mensaje = '';
	//Método por GET
	$scope.sendGET = function(){
		$scope.url = 'http://localhost/yii2-restex/rest/v1/userprofiles';
		if($scope.cedula!='')
		{
			$scope.url+='/'+$scope.cedula;
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
	//Método por POST
	$scope.sendPost = function(){
		if($scope.cedula == '' || $scope.nombre == '' || $scope.apellido == '') {
			$scope.error = "Faltan Campos por envíar";
		}
		else{
			$http.post('http://localhost/yii2-restex/rest/v1/userprofiles',{
				cedula:$scope.cedula,
				nombre:$scope.nombre,
				apellido:$scope.apellido
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
	//Método por PUT
	$scope.sendPut = function(){
		if($scope.cedula == '' || $scope.nombre == '' || $scope.apellido == '') {
			$scope.error = "Faltan Campos por envíar";
		}
		else{
			$http.put('http://localhost/yii2-restex/rest/v1/userprofiles/'+$scope.cedula,{
				cedula:$scope.cedula,
				nombre:$scope.nombre,
				apellido:$scope.apellido
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
