<?php

namespace App\Traits;

use Exception;

trait PresentableTrait
{

    /* This is where we will save the presenterInstance so use later on the same model object */
    protected $presenterInstance;

    public function present()
    {

        // Check if the preserneter property has been declared on the model and
        // the class exists

        if (!$this->presenter or !class_exists($this->presenter)) {

            // We didn't find a presenter class, throw an exception
            // I am assuming we have a PresenterException defined already
            throw new Exception('Please set the Presenter path to your Presenter FQN');
        }

        // The good old Singleton pattern
        if (!$this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
