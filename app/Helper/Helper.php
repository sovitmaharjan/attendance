<?php

namespace App\Helper;

class Helper
{

    public function  getObject($model, $request){
        $data = $request->only($model->getFillable());
        $model->fill($data);
        return $model;
    }
}