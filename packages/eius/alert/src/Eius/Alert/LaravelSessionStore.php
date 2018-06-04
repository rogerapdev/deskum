<?php

namespace Eius\Alert;

use Illuminate\Session\Store;

class LaravelSessionStore implements SessionStore
{
    /**
     * @var Store
     */
    private $session;

    /**
     * Create a new session store instance.
     *
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param array  $data
     */
    public function put($name, $data)
    {
        $this->session->put($name, $data);
    }
}
