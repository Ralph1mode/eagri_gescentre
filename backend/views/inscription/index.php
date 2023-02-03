<?php

use backend\controllers\Utils;
use backend\models\Inscription;
use backend\models\Note;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rendu final des apprenants';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>RENDU FINAL DES APPRENANTS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Rendu final des apprenants</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example5" class="display" style="min-width: 845px">
                            <div class="inscription-index">

                                <!-- <h1><?= Html::encode($this->title) ?></h1> -->

                                <p>
                                    <button class="btn btn-danger text-white fa fa-print fa-8x" id="" onclick="printData()"> Imprimer</button>
                                </p>

                                <?php // echo $this->render('_search', ['model' => $searchModel]); 
                                ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{pager}',
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'tableOptions' => [

                                        'class' => 'table table-hover',
                                        'id' => 'example'
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],



                                        [
                                            'label' => 'Apprenant',
                                            'value' => function ($data) {
                                                return $data->idApprenant0->nom . ' ' . $data->idApprenant0->prenom;
                                            }

                                        ],
                                        [
                                            'label' => 'Formation',
                                            'value' => function ($data) {
                                                return $data->idFormation0->libelle;
                                            }

                                        ],
                                        [
                                            'label' => 'Spécialité',
                                            'value' => function ($data) {
                                                return $data->idFormation0->idSpectForm0->idSpecialite0->libelle;
                                            }

                                        ],
                                        [


                                            'format' => 'html',
                                            'label' => 'Carte',
                                            'value' => function ($data, $url) {
                                                $state = 'danger';
                                                $state = 'success';
                                                $stateTxt = 'Clôturée';

                                                if ($data->idFormation0->cloture == 0) {

                                                    $query = Note::find()->where(['statut' => 1, 'idInscription' => $data->id]);
                                                    $sommeNote = $query->sum('libelle');
                                                    $nbreNote = $query->count();
                                                    if ($nbreNote != 0) {
                                                        $moyenne = $sommeNote / $nbreNote;

                                                        //return $moyenne;
                                                    } else {
                                                        $state = 'dark';
                                                        $stateTxt = 'Carte indisponible';
                                                        return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                                    }
                                                }
                                                if ($data->idFormation0->cloture == 1) {

                                                    $state = 'dark';
                                                    $stateTxt = 'Carte indisponible';
                                                    return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                                } else if ($data->idFormation0->cloture == 0 && $moyenne >= 50) {

                                                    $url = 'all_code?key=' . $data->key_inscription;
                                                    $state = 'info';
                                                    $stateTxt = 'Télécharger';
                                                    return '<a title="Télecharger' . Yii::t('app', 'Télécharger') . '"class="badge badge-info" href="' . $url . '">
                                                    <i class="fa-solid fa-down-to-dotted-line">Télécharger</i>
                                                    </a>';
                                                } else if ($data->idFormation0->cloture == 0  && $moyenne < 50) {


                                                    $state = 'warning';
                                                    $stateTxt = 'Indisponible';
                                                    return '<a title="Télécharger' . Yii::t('app', 'Télécharger') . '" target = "_blank" class="badge badge-warning">
                                                    <i class="fa-solid fa-down-to-dotted-line">Carte Indisponible</i>
                                                    </a>';
                                                } else if ($data->idFormation0->cloture == 0  && $nbreNote == 0) {


                                                    $state = 'warning';
                                                    $stateTxt = 'Indisponible';
                                                    return '<a title="Télécharger' . Yii::t('app', 'Télécharger') . '" target = "_blank" class="badge badge-warning">
                                                    <i class="fa-solid fa-down-to-dotted-line">Carte Indisponible</i>
                                                    </a>';
                                                }
                                            }


                                        ],
                                        [


                                            'format' => 'html',
                                            'label' => 'Mention',
                                            'value' => function ($data) {

                                                $state = 'danger';
                                                $state = 'success';
                                                $stateTxt = 'Clôturée';
                                                if ($data->idFormation0->cloture == 1) {
                                                    $state = 'dark';
                                                    $stateTxt = 'Formation en cours ...';
                                                    return '<span class="badge badge-' . $state . '">' . $stateTxt . '</span>';
                                                } else if ($data->idFormation0->cloture == 0) {

                                                    $query = Note::find()->where(['statut' => 1, 'idInscription' => $data->id]);
                                                    $sommeNote = $query->sum('libelle');
                                                    $nbreNote = $query->count();
                                                    if ($nbreNote != 0) {
                                                        $moyenne = $sommeNote / $nbreNote;

                                                        // $existant = Inscription::find()->where(['statut' => 1, 'idInscription' => $data->id])->one();
                                                        // if($existant == null){

                                                        // }


                                                        if ($moyenne >= 50 && $moyenne < 60) {
                                                            $state = 'success';
                                                            $stateTxt = 'Disponible';
                                                            return '<span class=" text-white badge badge-' . $state . '">' . $moyenne . '% | Passable</span>';
                                                        } else if ($moyenne >= 60 && $moyenne < 70) {
                                                            $state = 'success';
                                                            return '<span class="text-white badge badge-' . $state . '">' . $moyenne . '% | Assez-bien</span>';
                                                        } else if ($moyenne >= 70 && $moyenne < 80) {
                                                            $state = 'success';
                                                            return '<span class="text-white badge badge-' . $state . '">' . $moyenne . '% | Bien</span>';
                                                        } else if ($moyenne >= 80 && $moyenne < 90) {
                                                            $state = 'success';
                                                            return '<span class=" text-white badge badge-' . $state . '">' . $moyenne . '% | Très bien</span>';
                                                        } else if ($moyenne >= 90) {
                                                            $state = 'success';
                                                            return '<span class="text-white badge badge-' . $state . '">' . $moyenne . '% | Excéllent</span>';
                                                        } else if ($moyenne < 50) {
                                                            $state = 'danger';
                                                            return '<span class="badge badge-' . $state . '">' . $moyenne . '% | Ajourner</span>';
                                                        }
                                                    } else {
                                                        $state = 'dark';
                                                        return '<span class="badge badge-' . $state . '"> Pas évaluer </span>';
                                                    }
                                                }
                                            }

                                        ],
                                        //'idFormation',
                                        //'idApprenant',
                                        //'code_carte',
                                        //'moyenne',
                                        //'key_inscription',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                        /* [
                                            'class' => ActionColumn::className(),
                                            'urlCreator' => function ($action, Inscription $model, $key, $index, $column) {
                                                return Url::toRoute([$action, 'id' => $model->id]);
                                            }
                                        ], */
                                    ],
                                ]); ?>



                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<script>
    function printData() {
        var divToPrint = document.getElementById('example');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'table, table, td{' +
            'border:1px solid #000;' +
            'border-collapse: collapse;' +
            'padding;0.5em;' +
            '}' +
            '</style>';
        '<style type="text/css">' +
        ' th {' +
        ' font - family: monospace;' +
        ' border: thin solid #6495ed;' +
        'width: 50%;' +
        'padding: 5px;' +
        'background-color: # D0E3FA;' +
        'background - image: url(template/images/eagri2.jpeg);' +
        '}' +
        '</style>';
        '<style type="text/css">' +
        'td {' +
        'font-family: sans-serif;' +
        'border: thin solid #6495ed;' +
        'width: 50%;' +
        'padding: 5px;' +
        'text-align: center;' +
        'background-color: #ffffff;' +
        '}' +
        '</style>';

        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
</script>