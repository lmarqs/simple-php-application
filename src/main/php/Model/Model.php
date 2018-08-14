<?php
namespace lmarqs\Spa\Model;

abstract class Model
{
    abstract public function getId();
    abstract public function setId($id);
    abstract public function toArray();
    abstract public function fromArray($array);
}
