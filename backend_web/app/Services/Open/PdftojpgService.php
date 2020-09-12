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
        //convierte pdf a jpg
        //~/www/dom_theframework.es/resources.theframework.es/public/theframework.es/20200912$ gs -sDEVICE=png16m -dTextAlphaBits=4 -r300 -o x.jpg x.pdf

        //instalación en ionos: https://www.ionos.es/ayuda/servidores-cloud/servidores-dedicados-gestionados/instalar-imagemagick-mediante-ssh/
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
