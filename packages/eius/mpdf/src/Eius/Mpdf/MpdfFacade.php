<?php
namespace Eius\Mpdf;

use Illuminate\Support\Facades\Facade;

class MpdfFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpdf';
    }
}
