<?php
namespace App\Model;

class AbstractModel
{
    public function getArrayCopy() {
        $data = [];
        $props = get_object_vars($this);
        foreach ($props as $property){
            $method = $this->getAccessorMethodName('get', $property);
            $data[$property] = $this->{$method}();
        }
        return $data;
    }
    public function exchange($data) {
        foreach ($data as $property => $value){
            if (property_exists($this, $property)) {
                $method = $this->getAccessorMethodName('set', $property);
                $this->{$method}($value);
            }
        }
        return $this;
    }
    protected function getAccessorMethodName($operation, $property)
    {
        return sprintf('%s%s', $operation, ucfirst($property));
    }
}
