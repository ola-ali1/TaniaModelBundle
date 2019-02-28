<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniquePhone extends Constraint
{
    public $message_exists    = 'phone_exist';

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