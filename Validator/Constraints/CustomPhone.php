<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CustomPhone extends Constraint
{
    public $message = 'invalid_phone_number';
    
    public function validatedBy()
    {
       return 'Ibtikar\TaniaModelBundle\Validator\Constraints\CustomPhoneValidator';
    }
}