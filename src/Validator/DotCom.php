<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class DotCom extends Constraint
{
    public function __construct(
        public $message = '".com" email allowed only',
        public $dotCom = '.com',  ?array $groups = null,mixed $payload = null)
    {
        parent::__construct(null, $groups, $payload );
    }
   
}
