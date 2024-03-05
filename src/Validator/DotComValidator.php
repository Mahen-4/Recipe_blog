<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DotComValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var DotCom $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        if(!(str_contains($value, '.com'))){
            $this->context->buildViolation($constraint->message)
            ->addViolation();
        }


        
        
    }
}
