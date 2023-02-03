<?php

use backend\controllers\Utils;
use backend\models\Inscription;
use backend\models\Note;
use yii\bootstrap4\ActiveForm;
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
                <h4>HISTORIQUE DES INSCRIPTIONS SUR UNE PERIODE</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Historique des inscriptions</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <a href="#" type="button" class="btn btn-danger text-white fa fa-print fa-8x" onclick="printData()"> Imprimer</a>
                                </p>
                            </div>
                            <div class="col-12">
                                <!--  <p>
                                <table>
                                    <tr>
                                        <td><span style="color:blue">Date début :</span><input type="date" class="form-control" name="" id=""> </td>
                                        <td><span style="color:blue">Date fin :</span><input type="date" name="" class="form-control" id=""></td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" class="btn btn-success text-white" value="Valider"></td>
                                    </tr>
                                </table>
                                </p> -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="min-width: 845px">
                                            <thead>
                                                <!--  <form action="<php echo Yii::$app->homeUrl ?>historique" method="post">
                                                    <td><span style=" color:blue">Date début :</span><input type="date" class="form-control" name="datedebut" id=""> </td>
                                                    <td><span style="color:blue">Date fin :</span><input type="date" name="datefin" class="form-control" id=""></td>
                                                    <td><button type="submit" name="submit" class="btn btn-success text-white">Valider</button></td>
                                                </form> -->

                                                <tr>
                                                    <th>#</th>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Age</th>
                                                    <th>Date d'inscription</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($all_inscrit as $all_studs) { ?>

                                                    <tr>
                                                        <td><?= $all_studs->id ?></td>
                                                        <td><?= $all_studs->nom ?></td>
                                                        <td><?= $all_studs->prenom ?></td>
                                                        <td>
                                                            <center> <?php $age = date('Y') - date('Y', strtotime($all_studs->datenaisse));
                                                                        echo $age ?> ans</center>
                                                        </td>

                                                        <td>
                                                            <center> <?= date('d-m-Y', strtotime($all_studs->created_at)) ?></center>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    /*    function printData() {
        var divToPrint = document.getElementById("example");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    } */

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