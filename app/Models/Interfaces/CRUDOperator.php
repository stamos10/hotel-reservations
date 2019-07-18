<?php

namespace App\Models\Interfaces;

interface CRUDOperator{
    
public function add();
public function update($id);
public function fetchAll();
public function fetchOne($id);
public function delete($id);
}
?>