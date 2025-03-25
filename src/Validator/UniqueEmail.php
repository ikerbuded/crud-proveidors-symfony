<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'L\'email "{{ value }}" ja està en ús.';

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
