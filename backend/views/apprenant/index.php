<?php

use backend\controllers\Utils;
use backend\models\Apprenant;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApprenantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apprenants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>APPRENANTS</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Apprenants</li>
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
                            <div class="apprenant-index">
                                <!-- <input type="hidden" id="type_action" value="CREATE"> -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <?= Html::a(' Inscription', ['create'], ['class' => 'btn btn-primary text-white fa fa-plus-square fa-8x']) ?>
                                            <button class="btn btn-danger text-white fa fa-print fa-8x" id="" onclick="printData()"> Imprimer</button>

                                        </p>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">
                                        <!-- <php echo $this->render('_search', ['model' => $searchModel]); ?> -->
                                    </div>

                                </div>




                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout' => '{items}{pager}',
                                    'pager' => array(
                                        'prevPageLabel'     => 'Previous',
                                        'nextPageLabel'     => 'Next',
                                        'firstPageCssClass' => 'btn btn-info btn-sm',
                                        'nextPageCssClass'  => 'btn btn-info btn-sm',
                                    ),
                                    'showOnEmpty' => false,
                                    'emptyText' => Utils::emptyContent(),
                                    'tableOptions' => [
                                        'class' => 'table table-hover',
                                        'id' => 'example'
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        [
                                            'label' => 'nom',
                                            'value' => 'nom'
                                        ],
                                        [
                                            'label' => 'Prenom',
                                            'value' => 'prenom'
                                        ],
                                        [
                                            'label' => 'Sexe',
                                            'value' => 'sexe'
                                        ],
                                        [
                                            'label' => 'Date de naissance',
                                            'format' => ['date', 'php:d-m-Y'],
                                            'attribute' => 'datenaisse',

                                        ],
                                        [
                                            'label' => 'Email',
                                            'value' => 'email'
                                        ],
                                        [
                                            'label' => 'Contact',
                                            'value' => 'tel'
                                        ],
                                        [
                                            'label' => 'Niveau d\'étude',
                                            'value' => 'niveau'
                                        ],
                                        [
                                            'label' => 'Profession',
                                            'value' => 'profession'
                                        ],

                                        //'id',
                                        //'idPays',
                                        //'nom',
                                        //'prenom',
                                        //'sexe',
                                        //'datenaisse',
                                        //'email:email',
                                        //'tel',
                                        //'niveau',
                                        //'profession',
                                        //'chem_photo:ntext',
                                        //'chem_piece:ntext',
                                        //'chem_diplome:ntext',
                                        //'key_apprenant',
                                        //'created_by',
                                        //'updated_by',
                                        //'created_at',
                                        //'updated_at',
                                        //'statut',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{view}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'view' => function ($url, $data) {
                                                    $url = 'view_apprenant?key=' . $data->key_apprenant;
                                                    return '<a title="' . Yii::t('app', 'view') . '" class="btn btn-primary btn-sm" href="' . $url . '">
                                <i class="fa fa-eye fa-8x"></i>
                                </a>';
                                                },
                                            ],
                                        ],


                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{update}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'update' => function ($url, $data) {
                                                    $url = 'update_apprenant?key=' . $data->key_apprenant;
                                                    return '<a title="' . Yii::t('app', 'update') . '" class="text-white btn btn-success btn-sm" href="' . $url . '">
                                <i class="fa fa-pencil-square fa-8x"></i>
                                </a>';
                                                },
                                            ],
                                        ],


                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{delete}',
                                            'headerOptions' => ['width' => '15'],
                                            'buttons' => [
                                                'class' => ActionColumn::className(),
                                                'delete' => function ($url, $data) {
                                                    $url = 'delete_apprenant?key=' . $data->key_apprenant;
                                                    // return Html::a('<i class="fa fa-trash-o fa-8x"></i>', $url, ['onClick' => 'return confirm("Voulez-vous suprimer?")', 'class' => 'btn btn-danger btn-sm', 'data-pjax' => '0']);
                                                    return Html::a('<i class="fa fa-trash-o fa-8x"></i>', '#', ['onClick' => 'delete_element(\'' . $data->key_apprenant . '\')', 'class' => 'btn btn-danger btn-sm', "data-toggle" => "modal", "data-target" => "#exampleModalCenter"]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Delete Memo matiere -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterDel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDeleteContent">
                ...
            </div>
            <input type="hidden" value="" id="keyappr">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="vdelete_element()">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    function delete_element(key_element) {
        document.getElementById('keyappr').value = key_element;
        document.getElementById('exampleModalLongTitle').innerHTML = 'Confirmation de suppression';
        document.getElementById('modalDeleteContent').innerHTML = 'Vous êtes sur le point de supprimer cet apprenant, cette action est irréverssible';
    }

    function vdelete_element() {
        var url = "<?= Yii::$app->homeUrl ?>delete_apprenant";
        var key_element = document.getElementById('keyappr').value;
        $.ajax({
            url: url,
            method: "get",
            data: {
                key: key_element,
            },
            success: function(result) {
                document.location.reload();
            }
        });
    }


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