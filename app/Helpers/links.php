<?php

function in_url($slug)
{
    if (is_array($slug)) {
        foreach ($slug as $key => $value) {
            if (!str_contains(request()->url(), '/' . $value)) {
                return false;
            }
        }
        return true;
    }

    return str_contains(request()->url(), '/' . $slug);
}

function active_url($slug)
{

    return in_url($slug) ? 'active' : '';
}

function prefix()
{
    return str_replace("/", "", \Route::getCurrentRoute()->getPrefix());
}
