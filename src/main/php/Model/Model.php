<?php
namespace lmarqs\Spa\Model;

abstract class Model
{
    abstract public function toArray();
    abstract public function fromArray($array);
}
