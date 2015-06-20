<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions\Validable;

class Validator
{
    private $ruleSet;
    private $violations;
    private $valid;

    public function __construct(Logger $violations)
    {
        $this->ruleSet = [];
        $this->violations = $violations;
        $this->valid = true;
    }

    public function addRule($tag, Validable $newRule)
    {
        $this->ruleSet[$tag][] = $newRule;
    }

    public function validate($tag, $value)
    {
        foreach ($this->ruleSet[$tag] as $rule) {
            if (!$rule->validate($value)) {
                $this->valid = false;
            }
        }
    }

    public function getViolations()
    {
        return $this->violations->getLog();
    }

    public function isValid()
    {
        return $this->valid;
    }
}
