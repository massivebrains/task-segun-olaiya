<?php

namespace App\DTO;

class BaseDTO
{
    public function __construct($properties = null)
    {
        if ($properties) {
            $properties = is_array($properties) ? $properties : json_decode($properties, true) ?? [];
            foreach ($properties as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    /**
     * @param  array|?string  $properties
     */
    public static function make($properties): self
    {
        return new static($properties);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
