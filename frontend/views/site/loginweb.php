<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	<title>Login Page</title>
</head>
<body>
	<!-- Main Content -->
	<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<img src="../images/logopollomusculoso.png" />
				<h5 class="company_title">Asadero Pollo Musculoso</h5>
				<h5 class="" style="font-size:12px;" >Sistema de pedidos</h5>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
					<div class="row">
                        <div class="col-12 text-center">
                            <h2>Iniciar sesión</h2>
                        </div>
					</div>
					<div class="col-12 text-center">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
						<form control="" class="form-group">
							<div class="col-12 text-center">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form__input'  , 'placeholder'=>"Usuario" ]) ?>
								<!--<input type="text" name="username" id="username" class="form__input" placeholder="Username">-->
							</div>
							<div class="col-12 text-center">
								<!-- <span class="fa fa-lock"></span> -->
                                <?= $form->field($model, 'password')->textInput([  'class' => 'form__input'  , 'placeholder'=>"dd" ])->passwordInput() ?>

							</div>
							<div class="col-12 text-center">
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
								<!--<input type="checkbox" name="remember_me" id="remember_me" class="">
								<label for="remember_me">Recuerdame!</label>-->
							</div>
							<div class="col-12 text-center">
                            <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btniniciar', 'name' => 'login-button']) ?>
							</div>
                        <?php ActiveForm::end(); ?>
					</div>
					<div class="row">
						<p>No tienes cuenta? <a href="<?= URL::base() ?>/site/registroweb">Regístrate aquí</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="container-fluid text-center footer">
		Design by <a href="#">Acep Sistemas.</a></p>
	</div>
    <style>

    </style>
</body>