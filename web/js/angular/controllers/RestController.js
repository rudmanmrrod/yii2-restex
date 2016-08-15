var app = angular.module("RestApp",[]);

app.controller("restget",function($scope,$http){
	$scope.cedula = '';
	$scope.mensaje = '';
	$scope.intentarGET = function(){
		$scope.url = 'http://localhost/yii2-restex/rest/v1/userprofiles';
		if($scope.cedula!='')
		{
			$scope.url+='/'+$scope.cedula;
		}
		console.log($scope.url);
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
});

app.controller("restpost",function($scope,$http){
	$scope.cedula = '';
	$scope.nombre = '';
	$scope.apellido = '';
	$scope.mensaje = '';
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
});

app.controller("restput",function($scope,$http){
	$scope.cedula = '';
	$scope.nombre = '';
	$scope.apellido = '';
	$scope.mensaje = '';
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