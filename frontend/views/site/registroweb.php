<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">


                            <img src="<?= URL::base() ?>/images/logopollomusculosotr.png" />
                            <h5 class="company_title">Asadero Pollo Musculoso</h5>
                            <h5 class="" style="font-size:12px;" >Sistema de pedidos</h5>

                        <input type="submit" name="" value="Iniciar Sesión"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <!--<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hirer</a>
                            </li>
                        </ul>-->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Registro de cuenta</h3>
                                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'nombres')->textInput(['autofocus' => true, 'placeholder' => 'Nombres *']) ?>
                                        <?= $form->field($model, 'apellidos')->textInput([ 'placeholder' => 'Apellidos *']) ?>
                                        <?= $form->field($model, 'password')->passwordInput([ 'placeholder' => 'Contraseña *']) ?>
                                        <?= $form->field($model, 'confirmpassword')->passwordInput([ 'placeholder' => 'Confirmar Contraseña *']) ?>
                                        <?= $form->field($model, 'genero')->radioList([1 => 'Hombre', 2 => 'Mujer']) ?>
                                         
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Correo electrónico *']) ?>
                                        <?= $form->field($model, 'telefono')->textInput([ 'placeholder' => 'Teléfono *']) ?>
                                        <?= $form->field($model, 'pregunta')->dropDownList(['1' => 'Nombre abuelo paterno', 
                                        '2' => 'Nombre abuela materna',
                                        '3' => 'Primer Auto',
                                        '4' => 'Color favorito',
                                        '4' => 'Nombre de mascota'

                                        ],['prompt'=>'Selecciones una pregunta']); ?>
                                        
                                        <?= $form->field($model, 'respuesta')->textInput([ 'placeholder' => 'Respuesta *']) ?>

                                        <?= Html::submitButton('Registrar', ['class' => 'btnRegister', 'name' => 'signup-button']) ?>

                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Apply as a Hirer</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                                <option>What is your Birthdate?</option>
                                                <option>What is Your old Phone Number</option>
                                                <option>What is your Pet Name?</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="`Answer *" value="" />
                                        </div>
                                        <input type="submit" class="btnRegister"  value="Register"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
