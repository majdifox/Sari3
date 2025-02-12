<?php
namespace Core;
interface Model {
   public function create();
   public function delete();
   public function update();
   public function read();
}