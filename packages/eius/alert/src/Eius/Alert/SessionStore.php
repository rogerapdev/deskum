<?php

namespace Eius\Alert;

interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param array  $data
     */
    public function put($name, $data);
}
