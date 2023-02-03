<?php

use backend\models\Matiere;
use backend\models\Profil;
use common\widgets\Alert;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Formation */

$this->title = 'Modification d\'une fonctionnalité:';
$this->params['breadcrumbs'][] = ['label' => 'Memomatieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>FORMATIONS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_profil">Liste des profils</a></li>
                <li class="breadcrumb-item active">Modification</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="memomatiere-update">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1 style="text-align: center; color:blue"><?= Html::encode($this->title) ?></h1>

                                        <input type="hidden" id="type_action" value="UPDATE">
                                        <div class="memomatiere-form">

                                            <?php $form = ActiveForm::begin(); ?>

                                            <div class="form-group">
                                                <h5>Profil :</h5>
                                                <?= Html::dropDownList(
                                                    'idProfil',
                                                    null,
                                                    ArrayHelper::map(
                                                        Profil::find()->where(['id' => $model->idProfil])->andWhere(['<>', 'statut', 3])->all(),
                                                        'id',
                                                        'libelle'
                                                    ),
                                                    ['disabled' => true, 'class' => 'form-control',]
                                                );
                                                ?>
                                            </div>

                                            <div class="form-group">
                                                <?= $form->field($model, 'idFonctionnalite')->dropDownList(
                                                    ArrayHelper::map($fonctionnalite, 'id', 'libelle'),
                                                    ['prompt' => 'Choisir une fonctionnalité', 'required' => true,]
                                                )->error(false)->label('<h5>Fonctionnalité:<span class="text-danger">**</span></h5>');
                                                ?>
                                            </div>

                                            <div class="card-footer">
                                                <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-primary']) ?>
                                                <?= Html::resetButton('Annuler', ['class' => 'btn badge-warning']) ?>
                                            </div>

                                            <?php ActiveForm::end(); ?>

                                        </div>
                                    </div>
                                </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>