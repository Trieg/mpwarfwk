<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions\Validable;

class Validator
{
    private $ruleSet;
    private $violations;

    public function __construct(Logger $violations)
    {
        $this->ruleSet = [];
        $this->violations = $violations;
    }

    public function addRule(Validable $newRule)
    {
        $this->ruleSet[] = $newRule;
    }

    public function validate($value)
    {
        $check = true;
        foreach ($this->ruleSet as $rule) {
            $check &= $rule->validate($value);
        }

        return $check;
    }

    public function getViolations()
    {
        return $this->violations->getLog();
    }
}
