<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Matiere */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matiere-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'libelle')->textInput(['maxlength' => true, 'required'=>true,])->label('<h5>Libellé<span class="text-danger">**</span></h5>') ?>

    <?= $form->field($model, 'descriptions')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <center>
            <?= Html::submitButton(' Enregistrer', ['class' => 'btn btn-primary fa fa-floppy-o fx-8']) ?>
        <form action="">
            <button type="reset" class="btn btn-dark fa fa fa-undo fx-8"> Annuler</button>    
        </form>
        </center>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
