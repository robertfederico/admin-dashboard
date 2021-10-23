<?php

namespace App\Services;


class ProductService
{

   public function __construct($model)
   {
      $this->model = $model;
   }

   public function paginate(array $filter, array $conditions)
   {
      return $this->model
         ->where(function ($query) use ($conditions) {
            foreach ($conditions as $key => $value) {
               if ($value != null) {
                  $column = explode(',', $key);
                  foreach ($column as $col) {
                     $query->orWhere($col, 'like', '%' . $value . '%');
                  }
               }
            }
         })
         ->orderBy(explode('|', $filter['sort'])[0], explode('|', $filter['sort'])[1])
         ->paginate($filter['per_page']);
   }
}
