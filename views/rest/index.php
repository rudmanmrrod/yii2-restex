<?php
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
$this->title = 'Rest How To';
?>
<div class="container">

	<div class="text-center">
		<h1>How to Rest Services</h1>
	</div>
	
	<div>
		<h3><span class="text-info">Aplicación:</span> UserProfile </h3>
		<h3><span class="text-info">Content Type:</span> Json </h3>
		<h3><span class="text-info">URL:</span> <a data-toggle="tooltip" title="Dirección base de la aplicación">@app</a>/rest/v1/userprofiles </h3>
		<h3><span class="text-info">Campos:</span></h3>
	</div>
	
	<pre>
		<b>&lt;cedula&gt;</b> Es la cédula de la persona, es un campo <b>único</b>
		<b>&lt;nombre&gt;</b> Es el nombre de la persona
		<b>&lt;apellido&gt;</b> Es el apellido de la persona
	</pre>
	
	<h3><span class="text-info">Métodos Habilitados:</span></h3>
	
	<pre>
		<b>&lt;GET&gt;</b> Permite obtener los datos
		<b>&lt;POST&gt;</b> Permite insertar un dato
		<b>&lt;PATCH/PUT&gt;</b> Permite actualizar un dato
	</pre>
	
	<h3><span class="text-info">Uso de URLS de la Api:</span></h3>
	
	<pre>
		<b>GET</b> @app/rest/v1/userprofiles => Obtiene todos los datos de perfil registrados
		<b>GET</b> @app/rest/v1/userprofiles/<i>&lt;cedula&gt;</i> => Obtiene un dato filtrado por la cédula
		<b>POST</b> @app/rest/v1/userprofiles => Inserta un dato
		<b>PATCH/PUT</b> @app/rest/v1/userprofiles/<i>&lt;cedula&gt;</i> => Actualiza un dato por la pk, en este caso la cédula
	</pre>
	
	<h3><span class="text-info">Código Fuente:</span></h3>
	
	<pre>
		<span class="text-danger">&lt;?php</span>

		<span class="text-success">namespace</span> app\rest\modules\v1\controllers; 

		<span class="text-success">use</span> Yii;
		<span class="text-success">use</span> yii\rest\ActiveController;
		<span class="text-success">use</span> yii\filters\ContentNegotiator;
		<span class="text-success">use</span> yii\web\Response;

		<span class="text-success">class</span> UserProfileController <span class="text-success">extends</span> ActiveController
		{
			<span class="text-primary">//Esto le indica a yii el modelo base con el que va a interactuar</span>
			<span class="text-success">public</span>  $modelClass = 'app\models\UserProfile';

			<span class="text-primary">//Se definen los comportamientos, el más importante, es el formato(json)</span>
			<span class="text-success">public function</span> behaviors()
			{
				<span class="text-success">return</span> [
					<span class="text-warning">'contentNegotiator'</span> => [
						<span class="text-warning">'class'</span> => ContentNegotiator::className(),
						<span class="text-warning">'formats'</span> => [
							<span class="text-warning">'application/json'</span> => Response::FORMAT_JSON,
						],
					],
				];
			}
			
			<span class="text-primary">//Aquí se redefinen las acciones</span>
			<span class="text-success">public function</span> actions()
			{
				$actions = parent::actions();
				<span class="text-primary">//Se elimina el método delete</span>
				<span class="text-warning">unset</span>($actions['delete']);
				<span class="text-primary">return</span> $actions;
			}

		}
	</pre>
	
	<h3><span class="text-info">Pruébalo tu mismo:</span></h3>
	<div class="row text-center">
		<button class="btn btn-success" data-toggle="modal" data-target="#restgetmodal">GET</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#restpostmodal">POST</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#restputmodal">PUT/PATCH</button>
	</div>
	
</div>

<?php 
	Modal::begin([
	  'id' => 'restgetmodal',
	  'header' => '<h3>Prueba el método GET los Servicios Rest</h3>',
	  'size'=> 'modal-md',
	  ]); 
?>
<div class="container" ng-controller="restget">
	<div class="form-inline">
		<label>Buscar por cédula: </label>
		<input type="text" placeholder="@app/rest/v1/userprofiles/&lt;cedula&gt;" size="50" ng-model="cedula">
	</div>
	<button class="btn btn-success" ng-click="intentarGET()">Usar</button>
	<div class="row">
		<blockquote>
			<ol>
				<li ng-repeat="element in mensaje">{{element}}</li>
			</ol>
		</blockquote>
	</div>
</div>

<?php
	Modal::end();
?>

<?php 
	Modal::begin([
	  'id' => 'restpostmodal',
	  'header' => '<h3>Prueba el método POST los Servicios Rest</h3>',
	  'size'=> 'modal-md',
	  ]); 
?>
<div class="container" ng-controller="restpost">
	<div class="form-inline">
		<label>Cédula: </label>
		<input type="text" placeholder="Cédula Aquí" ng-model="cedula" required="required">
	</div>
	<div class="form-inline">
		<label>Nombre: </label>
		<input type="text" placeholder="Nombre Aquí" ng-model="nombre" required="required">
	</div>
	<div class="form-inline">
		<label>Apellido: </label>
		<input type="text" placeholder="Apellido Aquí" ng-model="apellido" required="required">
	</div>
	<button class="btn btn-success" ng-click="sendPost()">Usar</button>
	<p class="text-danger">{{error}}</p>
	<div class="row">
		<blockquote>
			{{mensaje}}
		</blockquote>
	</div>
</div>

<?php
	Modal::end();
?>

<?php 
	Modal::begin([
	  'id' => 'restputmodal',
	  'header' => '<h3>Prueba el método PUT/PATCH los Servicios Rest</h3>',
	  'size'=> 'modal-md',
	  ]); 
?>
<div class="container" ng-controller="restput">
	<div class="form-inline">
		<label>Cédula: </label>
		<input type="text" placeholder="Cédula Aquí" ng-model="cedula" required="required">
	</div>
	<div class="form-inline">
		<label>Nombre: </label>
		<input type="text" placeholder="Nombre Aquí" ng-model="nombre" required="required">
	</div>
	<div class="form-inline">
		<label>Apellido: </label>
		<input type="text" placeholder="Apellido Aquí" ng-model="apellido" required="required">
	</div>
	<button class="btn btn-success" ng-click="sendPut()">Usar</button>
	<p class="text-danger">{{error}}</p>
	<div class="row">
		<blockquote>
			{{mensaje}}
		</blockquote>
	</div>
</div>

<?php
	Modal::end();
?>
