<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pays-form">

    <?php $form = ActiveForm::begin()  ; ?>

    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

    <div class="form-group">
        <center>
             <?= Html::submitButton(' Enregistrer', [ 'class' => 'btn btn-primary btn-rounded fa fa-floppy-o fx-8']) ?>
        <form action="">
            <button type="reset" class="btn btn-dark btn-rounded fa fa fa-undo fx-8"> Annuler</button>    
        </form>
        <a href="all_pays" class="btn btn-danger btn-rounded "><i class="fa fa-arrow-left fx-8"></i> Retour</a>
        </center>
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
