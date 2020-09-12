<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name PdftojpgService
 * @file PdftojpgService.php
 * @version 1.0.0
 * @date 12-09-2020 09:51
 * @observations
 */
namespace App\Services\Open;

use \Imagick;

class PdftojpgService
{
    private $pdf;
    private $jpgs;

    public function __construct($file)
    {
        if(!extension_loaded("imagick")) throw new \Exception("imagick extension not found!");
    }

    public function get()
    {
        $pathpdf = $this->pdf;
        $pathimg = $this->jpgs;
        $imagick = new Imagick();

        //esta linea lanza la excepción: Fatal error: Uncaught ImagickException: PDFDelegateFailed `[ghostscript library 9.52]
        // Read image from PDF
        $imagick->readImage($pathpdf);
        // Writes an image
        $imagick->writeImages($pathimg,false);
    }

}
