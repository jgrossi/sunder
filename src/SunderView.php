<?php

class SunderView
{
    protected $variables;

    public function __construct(array $variables = null)
    {
        $this->variables = $variables ?: array();
    }

    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }
    }

    public function filter($variable)
    {
        return htmlspecialchars($this->$variable);
    }

    public function strip($variable)
    {
        return strip_tags($this->$variable);
    }

    /**
     * @return mixed
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param mixed $variables
     */
    public function setVariables(array $variables)
    {
        $this->variables = $variables;
    }


}

