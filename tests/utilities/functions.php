<?php

function create($class, $attr = [], $times = null)
{
    if ($times != null) {
        return $class::factory()->count($times)->create($attr);

    } else {
        return $class::factory()->create($attr);

    }
}

function make($class, $attr = [], $times = null)
{
    if ($times != null) {
        return $class::factory()->count($times)->make($attr);

    } else {
        return $class::factory()->make($attr);
    }
}

