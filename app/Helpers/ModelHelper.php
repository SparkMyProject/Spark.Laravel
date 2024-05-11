<?php

namespace App\Helpers;

class ModelHelper
{
  public static function updateModel($fields, $model, $data)
  {
    foreach ($fields as $field) {
      if (isset($data[$field])) {
        $model->$field = $data[$field];
      }
    }
    return $model;
  }
}
