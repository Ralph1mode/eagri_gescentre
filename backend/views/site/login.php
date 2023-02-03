<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */
use common\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>


    <div class="authincation h-100 mt-5">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                <?= Alert::widget() ?>
                                    <!-- <h1>=// Html::encode($this->title) ?></h1> -->
                                    <h4 class="text-center mb-4">Connecter vous à votre compte</h4>
                                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control  amount','required'=>true,])->label('Nom d\' utilisateur') ?>

                                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control  amount','required'=>true,])->label('Mot de passe') ?>

                                    <!-- <= $form->field($model, 'rememberMe')->checkbox()->label('Se souvenir de moi') ?> -->

                                    <div class="form-group">
                                        <?= Html::submitButton('Se connecter', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>
                                    <!--  <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
