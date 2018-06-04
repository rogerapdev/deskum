<?php
namespace Eius\Mpdf;

include_once base_path('vendor/mpdf/mpdf/src/mpdf.php');
/**
 * A Laravel wrapper for mPDF
 *
 * @package mpdf
 * @author qa4it
 */
class MpdfWrapper
{
    protected $mpdf;
    protected $rendered = false;
    protected $options;

    public function __construct($mpdf)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'pt_BR']);
        $this->mpdf = $mpdf;
        $this->mpdf->setAutoTopMargin = 'stretch';
        $this->mpdf->allow_charset_conversion = true;
        $this->mpdf->charset_in = 'UTF-8';
        $this->mpdf->mirroMargins = true;

        // $this->options = array();
    }

    public function getInstance()
    {
        return $this->mpdf;
    }

    public function setInstance($mpdf)
    {
        $this->mpdf = $mpdf;

        return $this;
    }

    public function setFormatOrientation($format, $orientation)
    {
        $orientation2 = $orientation;
        $this->mpdf->_setPageSize('A4', $orientation2);

        return $this;

    }

    /**
     * Load a HTML string
     *
     * @param string $string
     * @return static
     */
    public function loadHTML($string, $mode = 0)
    {

        $this->mpdf->WriteHTML((string) $string, $mode);
        $this->html = null;
        $this->file = null;
        return $this;
    }

    public function setHTMLHeader($html)
    {
        $this->mpdf->SetHTMLHeader($html);

        return $this;
    }

    public function setHTMLFooter($html)
    {
        $this->mpdf->SetHTMLFooter($html);

        return $this;
    }

    /**
     * Load a HTML file
     *
     * @param string $file
     * @return static
     */
    public function loadFile($file)
    {
        $this->html = null;
        $this->file = $file;
        return $this;
    }

    /**
     * Load a View and convert to HTML
     *
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return static
     */
    public function loadView($view, $data = array(), $mergeData = array())
    {
        $this->html = \View::make($view, $data, $mergeData)->render();
        $this->file = null;
        return $this;
    }

    /**
     * Output the PDF as a string.
     *
     * @return string The rendered PDF as string
     */
    public function output()
    {

        if ($this->html) {
            $this->mpdf->WriteHTML($this->html);
        } elseif ($this->file) {
            $this->mpdf->WriteHTML($this->file);
        }

        return $this->mpdf->Output('', 'S');
    }

    /**
     * Save the PDF to a file
     *
     * @param $filename
     * @return static
     */
    public function save($filename)
    {

        if ($this->html) {
            $this->mpdf->WriteHTML($this->html);
        } elseif ($this->file) {
            $this->mpdf->WriteHTML($this->file);
        }

        return $this->mpdf->Output($filename, 'F');
    }

    /**
     * Make the PDF downloadable by the user
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function download($filename = 'document.pdf')
    {

        if ($this->html) {
            $this->mpdf->WriteHTML($this->html);
        } elseif ($this->file) {
            $this->mpdf->WriteHTML($this->file);
        }

        return $this->mpdf->Output($filename, 'D');
    }

    /**
     * Return a response with the PDF to show in the browser
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stream($filename = 'document.pdf')
    {
        if ($this->html) {
            $this->mpdf->WriteHTML($this->html);
        } elseif ($this->file) {
            $this->mpdf->WriteHTML($this->file);
        }

        return $this->mpdf->Output($filename, 'I');
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->mpdf, $name), $arguments);
    }
}
