<?php
namespace icwkb\GitToolbar\Filter;

use Zend\Filter\PregReplace;

class GitVersionFilter extends PregReplace
{
    protected $options = [
        'pattern'     => [
            '/^git version /',
            '/\n/',
        ],
        'replacement' => '',
    ];
}