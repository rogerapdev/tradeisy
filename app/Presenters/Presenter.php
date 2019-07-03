<?php

namespace App\Presenters;

abstract class Presenter
{

    protected $entity; // This is to store the original model instance

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    // Call the function if that exsits, or return the property on the original model
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }
        if (method_exists($this, camel_case($property))) {
            return $this->{camel_case($property)}();
        }

        return $this->entity->{$property};
    }
}
