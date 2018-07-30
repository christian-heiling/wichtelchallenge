<?php
/**
 * Created by PhpStorm.
 * User: heili
 * Date: 19.07.2018
 * Time: 18:10
 */

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class OpenStreetMapHandler extends AbstractHandler
{
    protected $codename = 'open_street_map';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.open_street_map', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
