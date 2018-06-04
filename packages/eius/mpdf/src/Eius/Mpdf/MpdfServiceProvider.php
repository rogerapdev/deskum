<?php
namespace Eius\Mpdf;

use Config;
use Eius\Mpdf\MpdfWrapper;
use Illuminate\Support\ServiceProvider;

include base_path('vendor/mpdf/mpdf/src/Mpdf.php');

class MpdfServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('mpdf', function ($app, $cfg) {

            if (!empty($cfg)) {
                foreach ($cfg as $key => $value) {
                    Config::set('mpdf.' . $key, $value);
                }
            }

            // $mpdf = new \Mpdf\Mpdf(
            //     Config::get('mpdf.mode'), // mode - default ''
            //     Config::get('mpdf.format'), // format - A4, for example, default ''
            //     Config::get('mpdf.default_font_size'), // font size - default 0
            //     Config::get('mpdf.default_font'), // default font family
            //     Config::get('mpdf.margin_left'), // margin_left
            //     Config::get('mpdf.margin_right'), // margin right
            //     Config::get('mpdf.margin_top'), // margin top
            //     Config::get('mpdf.margin_bottom'), // margin bottom
            //     Config::get('mpdf.margin_header'), // margin header
            //     Config::get('mpdf.margin_footer'), // margin footer
            //     Config::get('mpdf.orientation') // L - landscape, P - portrait
            // );

            $mpdf = new \Mpdf\Mpdf(
                Config::get('mpdf')
            );

            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle(Config::get('mpdf.title'));
            $mpdf->SetAuthor(Config::get('mpdf.author'));
            $mpdf->SetWatermarkText(Config::get('mpdf.watermark'));
            $mpdf->SetDisplayMode(Config::get('mpdf.display_mode'));
            $mpdf->showWatermarkText = Config::get('mpdf.show_watermark');
            $mpdf->watermark_font = Config::get('mpdf.watermark_font');
            $mpdf->watermarkTextAlpha = Config::get('mpdf.watermark_text_alpha');

            return new MpdfWrapper($mpdf);
        });
    }

    // *
    //  * Get the services provided by the provider.
    //  *
    //  * @return array

    // public function provides()
    // {
    //         return array('mpdf');
    // }

}
