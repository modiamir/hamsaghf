<?php
namespace AppBundle\DBAL;

class GenderEnumType extends EnumType
{
    protected $name = 'gender';
    protected $values = array('male', 'female');
}