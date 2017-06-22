<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueCityItemPrice extends Constraint
{
    public $message_exists    = 'The city is dublicated';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        # This is the important bit.
        return self::CLASS_CONSTRAINT;
    }
}