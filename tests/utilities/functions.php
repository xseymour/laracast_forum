<?php

/**
 * @param String $class_name Path to class name from app perspective. I.E User::class
 * @param array|null $override (optional) attributes to override
 * @param int $times
 * @return \Illuminate\Database\Eloquent\Model A persisted model of type $class_name
 */
function create($class_name, $override = null, $times = null)
{
    $override = $override ?: []; //has a value? leave it alone, otherwise, an empty array
    return factory($class_name, $times)->create($override);
}

/**
 * @param String $class_name Path to class name from app perspective. I.E User::class
 * @param array|null $override (optional) attributes to override
 * @param int $times
 * @return \Illuminate\Database\Eloquent\Model A new model (not yet persisted) of type $class_name
 */
function make($class_name, $override = [], $times = null)
{
    $override = $override ?: []; //has a value? leave it alone, otherwise, an empty array
    return factory($class_name, $times)->make($override);
}