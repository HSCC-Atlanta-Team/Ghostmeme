<?php
namespace App\Model;

class ApiModel {
    
    public function __construct($props = [])
    {
        $this->hydrate($props);
    }

    public function hydrate($props)
    {
        foreach ($props as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function toArray() {
        $arr = [];
        foreach ($obj as $key => $value) {
            $arr[$key] = $value;
        }

        return $ret;
    }
}