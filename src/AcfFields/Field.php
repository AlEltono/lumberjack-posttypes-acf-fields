<?php

namespace IceAgency\PostTypeFields\AcfFields;

use Exception;

use IceAgency\PostTypeFields\AcfFields\TextField;
use IceAgency\PostTypeFields\AcfFields\TextAreaField;
use IceAgency\PostTypeFields\AcfFields\NumberField;
use IceAgency\PostTypeFields\AcfFields\EmailField;
use IceAgency\PostTypeFields\AcfFields\UrlField;
use IceAgency\PostTypeFields\AcfFields\PasswordField;
use IceAgency\PostTypeFields\AcfFields\ImageField;
use IceAgency\PostTypeFields\AcfFields\WysiwygField;

class Field
{
    public $name;
    public $label;
    public $placeholder;
    public $instructions;
    public $default_value;
    public $max_length;
    public $readonly;
    public $disabled;
    public $required = 0;

    public static function create($name) {
        $field = new static;
        $field->name = $name;

        return $field;
    }

    public function withLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function isRequired() {
        $this->required = 1;
        return $this;
    }

    public function withPlaceholder($placeholder) {
        if (!in_array(get_class($this), [
            TextField::class,
            TextAreaField::class,
            NumberField::class,
            EmailField::class,
            UrlField::class,
            PasswordField::class
        ])) {
            throw new Exception('The field type "' . $this->type . '" does not support withPlaceholder()');
        }

        $this->placeholder = $placeholder;
        return $this;
    }

    public function withInstructions($instructions) {
        $this->instructions = $instructions;
        return $this;
    }

    public function withDefaultValue($default_value) {
        $this->default_value = $default_value;
        return $this;
    }

    public function withMaxLength($max_length) {
        if (!in_array(get_class($this), [
            TextField::$type,
            TextAreaField::$type
        ])) {
            throw new Exception('The field type "' . $this->type . '" does not support withMaxLength()');
        }

        $this->max_length = $max_length;
        return $this;
    }

    public function isReadOnly() {
        if (!in_array(get_class($this), [
            TextField::$type,
            TextAreaField::$type
        ])) {
            throw new Exception('The field type "' . $this->type . '" does not support isReadOnly()');
        }

        $this->readonly = 1;
        return $this;
    }

    public function isDisabled() {
        if (!in_array(get_class($this), [
            TextField::$type,
            TextAreaField::$type
        ])) {
            throw new Exception('The field type "' . $this->type . '" does not support isDisabled()');
        }

        $this->disabled = 1;
        return $this;
    }

    public function addKey($group_name) {
        $this->key = $group_name . "_field_" . $this->name;
        return $this;
    }

    public function toArray() : array {
        $data = [
            'key' => $this->key,
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type
        ];

        if ($this->placeholder) {
            $data['placeholder'] = $this->placeholder;
        }

        if ($this->instructions) {
            $data['instructions'] = $this->instructions;
        }

        if ($this->default_value) {
            $data['default_value'] = $this->default_value;
        }

        if ($this->max_length) {
            $data['max_length'] = $this->max_length;
        }

        if ($this->readonly) {
            $data['readonly'] = $this->readonly;
        }

        if ($this->disabled) {
            $data['disabled'] = 1;
        }

        if ($this->required) {
            $data['required'] = 1;
        }

        return $data;
    }
}