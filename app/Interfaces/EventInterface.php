<?php

namespace App\Interfaces;

interface EventInterface {

 public function all($request);

 public function getById($id);

 public function create($request);

 public function update($request,$id);

 public function delete($id);
}