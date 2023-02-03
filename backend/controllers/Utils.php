<?php

namespace backend\controllers;

use backend\models\Fonctionnalite;
use backend\models\Profil;
use Yii;
use backend\models\ProfilFonctionnalite;
use yii\web\Controller;


/**
 * Site controller
 */
class Utils extends Controller
{
    public static function have_access($name_function)
    {

        /* $name_function = 'manager_dashboard'; */

        // $idUser = Yii::$app->user->identity->id;
        $UserProfil = Yii::$app->user->identity->idProfil;

        $find_profil = Profil::find()
            ->where([
                'id' => $UserProfil,
                'statut' => 1
            ])->one();
        if ($find_profil != null) {
            $idProfil = $find_profil->id;
            $find_fonctionnalite = Fonctionnalite::find()
                ->where([
                    'code' => $name_function,
                    'statut' => 1
                ])->one();
            if ($find_fonctionnalite != null) {
                $idFonctionnalite = $find_fonctionnalite->id;
                if (($idFonctionnalite != null) && ($idProfil != null)) {
                    $find_profilFonction = ProfilFonctionnalite::find()
                        ->where([
                            'idProfil' => $idProfil,
                            'idFonctionnalite' => $idFonctionnalite,
                            'statut' => 1
                        ])->one();
                    if ($find_profilFonction != null) {
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public static function emptyContent(): string
    {
        return '<div class="alert alert-danger" role="alert">
        Désolé! La liste est vide
      </div>';
    }


    public static function show_modedon($default = 0)
    {

        $tab_modedon["BEPC"] =  'BEPC';
        $tab_modedon["BACCALAUREAT I"] =  'BACCALAUREAT I';
        $tab_modedon["BACCALAUREAT II"] =  'BACCALAUREAT II';
        $tab_modedon["BAC + I"] =  'BAC + I';
        $tab_modedon["BAC + II"] =  'BAC + II';
        $tab_modedon["LICENSE"] =  'LICENSE';
        $tab_modedon["MAITRISE"] =  'MAITRISE';
        $tab_modedon["DOCTORAT"] =  'DOCTORAT';
        if (isset($tab_modedon[$default])) return $tab_modedon[$default];

        return $tab_modedon;
    }

    public static function show_modepay($default = 0)
    {

        $tab_modepay["CHEQUE"] =  'CHEQUE';
        $tab_modepay["VIREMENT BANCAIRE"] =  'VIREMENT BANCAIRE';
        $tab_modepay["ESPECE"] =  'ESPECE';
       
        if (isset($tab_modepay[$default])) return $tab_modepay[$default];

        return $tab_modepay;
    }
}
