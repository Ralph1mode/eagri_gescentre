<?php

use backend\controllers\Utils;
use backend\models\Inscription;
use backend\models\Note;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

// include_once('phpqrcode/qrlib.php');
$this->title = 'Rendu final des apprenants';
$this->params['breadcrumbs'][] = $this->title;
$inscription = Inscription::find()->where(['statut' => 1, 'idApprenant' => $model->id])->one();






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
                <li class="breadcrumb-item active"><a href="all_inscription">Rendu final des apprenants</a></li>
                <li class="breadcrumb-item active">Génération de la carte</li>
            </ol>
        </div>
    </div>
    <?= Alert::widget() ?>
    <div class="row">
        <div class="col-lg-12" id="printableArea">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <p>
                                <button style="margin-bottom:10px ;" class="btn btn-primary float-right text-white " onclick="printDiv('printableArea')">&nbsp; Imprimer</button>
                            </p>
                        </div>

                    </div>

                    <div>

                        <div class="lehtml" id="">
                            <div class="lebody">
                                <div class="lecard-container" style="margin-right: 50%;">
                                    <div class="lecard">
                                        <p class="lebank-name">QR CODE</p>
                                        <img class="lelechip2" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $model->code_carte ?>&choe=UTF-8" title="Code QR" />

                                        <div class="learrow"></div>
                                        <p class="lecard-name"><?= $model->idApprenant0->nom . ' ' . $model->idApprenant0->prenom ?></p>
                                        <p class="lecard-expire">CERTIFIE LE <?= date('d-m-Y') ?></p>
                                        <img class="levisa" src="uploads/img/e-agribusiness.png" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="">
                            <div class="card-body">
                                <div class="lehtml">
                                    <div class="lebody">
                                        <div class="row">
                                            <div class="lecard-container">
                                                <div class="">
                                                    <table>
                                                        <tr>

                                                            <img class="levisa2" src="uploads/img/e-agribusiness.png" />
                                                            <td border="1">
                                                                <center>
                                                                    <p style="margin-bottom:3px;">PROTECTION DES VEGETAUX</p>
                                                                    <h3 class="text-green"><span style="font-size:large; font-weight: bolder;">CARTE D'OPERATEUR DE
                                                                            DRONE</span> </h3>
                                                                </center>
                                                                <hr style="height: 2px; color: solid rgba(35, 146, 7, 0.76); background-color: rgba(35, 146, 7, 0.76); width: 100%; border: none;">

                                                            </td>


                                                        </tr>
                                                        <tr>

                                                            <td>
                                                                <img width="20%" height="10%" src="uploads/photos/<?= $model->idApprenant0->chem_photo ?>" style="margin-bottom: -30%;margin-left: 5%;">
                                                                <div class="" style="margin-left: 30%; margin-top: -5%;">

                                                                    <p>Nom : <span style="text-align: right; font-weight:bolder"><?= $model->idApprenant0->nom ?></span></p>

                                                                    <p>Prénom : <span style="text-align: right; font-weight:bolder"><?= $model->idApprenant0->prenom ?></span></p>
                                                                    <p>Genre : <span style="text-align: right; font-weight:bolder"><?php if ($model->idApprenant0->sexe == "M") {
                                                                                                                                        echo 'Masculin';
                                                                                                                                    } else if ($model->idApprenant0->sexe == "F") {
                                                                                                                                        echo 'Féminin';
                                                                                                                                    }
                                                                                                                                    ?></span></p>

                                                                    <p>Date de naissance : <span style="text-align: right; font-weight:bolder"><?= $model->idApprenant0->datenaisse ?></span></p>

                                                                    <p>Pays : <span style="text-align: right; font-weight:bolder"> <?= $model->idApprenant0->idPays0->libelle ?></span></p>

                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </table>


                                                    <div class="text-white" style="background-color:rgba(35, 146, 7, 0.76); border-bottom-left-radius: 15px; border-bottom-right-radius: 14px;">
                                                        <table>

                                                            <tr>

                                                                <td>&nbsp; &nbsp;<u>Catégorie</u> : <span style="text-align: right; font-weight:bolder"> <?= $inscription->idFormation0->idSpectForm0->idSpecialite0->libelle ?> </span></td>
                                                                <td>
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                </td>
                                                                <td><u>Date de délivrence </u> :<span style="text-align: right; font-weight:bolder"> <?= date('d-m-Y') ?></span></td>
                                                            </tr>

                                                            <tr>

                                                                <td>&nbsp; &nbsp;<u>Mention</u> :
                                                                    <!-- <span style="text-align: right; font-weight:bolder">Bien</span>  -->
                                                                    <?php

                                                                    $query = Note::find()->where(['statut' => 1, 'idInscription' => $model->id]);
                                                                    $sommeNote = $query->sum('libelle');
                                                                    $nbreNote = $query->count();
                                                                    if ($nbreNote != 0) {
                                                                        $moyenne = $sommeNote / $nbreNote;



                                                                        if ($moyenne >= 50 && $moyenne < 60) {
                                                                            echo 'Passable</span>';
                                                                        } else if ($moyenne >= 60 && $moyenne < 70) {
                                                                            echo 'Assez-bien';
                                                                        } else if ($moyenne >= 70 && $moyenne < 80) {
                                                                            echo 'Bien';
                                                                        } else if ($moyenne >= 80 && $moyenne < 90) {
                                                                            echo 'Très bien';
                                                                        } else if ($moyenne >= 90) {
                                                                            echo 'Excéllent';
                                                                        } else if ($moyenne < 50) {
                                                                            echo 'Ajourner';
                                                                        }
                                                                    }

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                    &nbsp;
                                                                </td>
                                                                <td><u>Expire</u> : <span style="text-align: right; font-weight:bolder"><?= date('d-m-Y', strtotime('+2 year')) ?></span></td>

                                                            </tr>

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
            </div>
        </div>
    </div>
</div>

<script>
    function imprimer(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>