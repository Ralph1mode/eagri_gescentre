<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApprenantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apprenant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="header-left">
        <div class="search_bar dropdown">
            <?= $form->field($model, 'nom')->textInput(['placeholder' => "Recherche", 'class' => "mdi mdi-magnify search_icon"])->label(false) ?>
            <button type="submit" class="btn btn-rounded pull-right btn-outline-primary"><i class="fa fa-search"></i></button>

        </div>
    </div>

  

    <!-- <div class="form-group">
        <= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>