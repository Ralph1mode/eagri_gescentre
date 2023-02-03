<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FormationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="header-left">

        <div class="search_bar dropdown">
            <!-- <button type="submit">Chercher</button> -->
            <?= $form->field($model, 'libelle')->textInput(['type' => "search", 'placeholder' => "Recherche", 'aria-label' => "Search", 'class' => "mdi mdi-magnify search_icon"])->label(false) ?>
            <button type="submit" class="btn btn-rounded pull-right btn-outline-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>



    <?php // echo $form->field($model, 'date_debut') 
    ?>

    <?php // echo $form->field($model, 'date_fin') 
    ?>

    <?php // echo $form->field($model, 'cloture') 
    ?>

    <?php // echo $form->field($model, 'key_formation') 
    ?>

    <?php // echo $form->field($model, 'created_by') 
    ?>

    <?php // echo $form->field($model, 'updated_by') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <?php // echo $form->field($model, 'statut') 
    ?>



    <?php ActiveForm::end(); ?>

</div>