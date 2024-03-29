<?php

use common\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeFormation */

$this->title = 'Modification: ' . $model->libelle;
$this->params['breadcrumbs'][] = ['label' => 'Type Formations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->key_typeformation, 'url' => ['view', 'key' => $model->key_typeformation]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>TYPES DE FORMATION</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active"><a href="all_typeformation">Types de formation</a></li>
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
                            <div class="type-formation-view">

                                <div class="row">
                                    <div class="col-lg-2">

                                    </div>
                                    <div class="col-lg-8">

                                        <h1 style="text-align: center; color:blue"><?= Html::encode($this->title) ?></h1>


                                        <?= $this->render('_form', [
                                            'model' => $model,
                                        ]) ?>
                                    </div>
                                    <div class="col-lg-2">

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
</div>
<!--**********************************
            Content body end
***********************************-->