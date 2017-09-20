<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CustomEmailValidator extends EmailValidator
{

    public function validate($value, Constraint $constraint)
    {
        parent::validate($value, $constraint);

        if (null === $value || '' === $value) {
            return;
        }

        // more validation for email
        if (!filter_var($value, FILTER_VALIDATE_EMAIL) || preg_match('/[\'^£$%&*()}{#~?><>,|=¬]/', $value)) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode(CustomEmail::INVALID_FORMAT_ERROR)
                    ->addViolation();

            return;
        }
    }
}
