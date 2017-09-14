<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class CustomPhoneValidator extends ConstraintValidator
{
    public $message = 'invalid_phone_number';

    private $googleValidator;
    private $translator;

    public function __construct($googleValidator, $translator)
    {
        $this->googleValidator = $googleValidator;
        $this->translator = $translator;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$this->googleValidator->validatePhoneNumber($value)) {
            $this->context->buildViolation($this->translator->trans($constraint->message, array(), 'validators'))
                ->addViolation();
        }
    }
}