<?php
/*
* This file is a part of graphql-youshido project.
*
* @author Alexandr Viniychuk <a@viniychuk.com>
* created: 12/1/15 11:07 PM
*/

namespace Youshido\GraphQL\Type\Config\Traits;


use Youshido\GraphQL\Field;
use Youshido\GraphQL\Type\TypeMap;
use Youshido\GraphQL\Validator\Exception\ConfigurationException;

trait ArgumentsAwareTrait
{
    protected $arguments = [];

    public function addArgument($name, $type, $config = [])
    {
        if (!is_string($type) || !TypeMap::isInputType($type)) {
            throw new ConfigurationException('Argument input type ' . $type . ' is not supported');
        }

        $config['name'] = $name;
        $config['type'] = TypeMap::getScalarTypeObject($type);

        $this->arguments[$name] = new Field($config);

        return $this;
    }

    public function getArgument($name)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : null;
    }

    public function hasArgument($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    public function getArguments()
    {
        return $this->arguments;
    }


}