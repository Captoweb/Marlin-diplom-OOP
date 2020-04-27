<?php

class Validate {
    private $passed = false, $erorrs = [], $db = null;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function check($sourse, $items = []) {
        foreach($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {

                $value = $sourse[$item];

                if($rule == 'required' && empty($value)) {
                    $this->addError("<div class='alert alert-danger' role='alert'>{$item} is required </div>");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                // $this->addError("<b>{$item} must be a minimum of {$rule_value} characters. </b>");
                                $this->addError("<div class='alert alert-danger' role='alert'>{$item} must be a minimum of {$rule_value} characters. </div>");
                            }
                            break;

                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("<div class='alert alert-danger' role='alert'>{$item} must be a maximum of {$rule_value} characters. </div>");
                            }
                            break;

                        case 'matches':
                            if($value != $sourse[$rule_value]) {
                                $this->addError("<div class='alert alert-danger' role='alert'>{$rule_value} must match {$item}</div>");
                            }
                            break;

                        case 'unique':
                            $check = $this->db->get($rule_value, [$item, '=', $value]);
                            if($check->count() ) {
                                $this->addError("<div class='alert alert-danger' role='alert'>{$item} already exists. </div>");
                            }
                            break;

                        case 'email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("<div class='alert alert-danger' role='alert'>{$item} is not email. </div>");
                            }
                            break;
                    }
                }
            }
        }

        if (empty($this->errors)) {
            $this->passed = true;
        }
        return $this;
    }


    public function addError($error) {
        $this->errors[] = $error;
    }

    public function errors() {
        return $this->errors;
    }

    public function passed() {
        return $this->passed;
    }
}
