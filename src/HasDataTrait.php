<?php

namespace Studiow\PHPTemplate;

trait HasDataTrait
{

    /**
     * Array to hold all bound parameters and values
     * @var array
     */
    protected $data = [];

    /**
     * Bind one or more parameters and values
     * @param string|array $key
     * @param mixed $value
     * @return $this
     */
    public function bind($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->bind($k, $v);
            }
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * Check if a key is set 
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Remove one or more parameters
     * @param string|array $key
     * @return $this
     */
    public function unbind($key)
    {
        if (is_array($key)) {
            foreach ($key as $k) {
                $this->unbind($k);
            }
        } else {
            if ($this->has($key)) {
                unset($this->data[$key]);
            }
        }
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

}
