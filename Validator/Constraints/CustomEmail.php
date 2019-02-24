<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\EmailValidator;

/**
 * @Annotation
 */
class CustomEmail extends \Symfony\Component\Validator\Constraints\Email
{
    public function validatedBy()
    {
       return 'Ibtikar\TaniaModelBundle\Validator\Constraints\CustomEmailValidator';
    }
}