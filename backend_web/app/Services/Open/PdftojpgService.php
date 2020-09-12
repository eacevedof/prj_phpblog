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

use App\Services\BaseService;

class PdftojpgService extends BaseService
{

    private const FOLDER_DOWNLOAD = "download";
    private $file;
    private $pdfname;
    private $downloadfile;
    private $pathdown;

    public function __construct($file)
    {
        $this->file = $file;
        $this->pathdown = public_path()."/".self::FOLDER_DOWNLOAD;
        $this->pdfname = "";
        $this->downloadfile = "";
    }

    private function _mkdir_download()
    {
        if(!is_dir($this->pathdown)) mkdir($this->pathdown);
    }

    private function _gen_downloadname()
    {
        $now = date("YmdHis");
        $uuid = uniqid();
        $imgname = "$now-img-$uuid.jpg";
        $this->downloadfile = $imgname;
    }

    private function _gen_pdfname()
    {
        $now = date("YmdHis");
        $uuid = uniqid();
        $pdfname = "$now-upload-$uuid.pdf";
        $this->pdfname = $pdfname;
    }

    private function _move_uppdf()
    {
        $pathpdf = $this->pathdown."/".$this->pdfname;
        $r = move_uploaded_file($this->file["tmp_name"],$pathpdf);
        //sleep(2);
        return $r;
    }

    private function _remove_pdf()
    {
        $pathpdf = $this->pathdown."/".$this->pdfname;
        unlink($pathpdf);
    }

    private function _exec_gs()
    {
        $pathpdf = $this->pathdown."/".$this->pdfname;
        $pathimg = $this->pathdown."/".$this->downloadfile;

        $this->logd("pdfname:$pathpdf, pathimg:$pathimg","antes de exec_gs\n");

        //convierte de pdf a imagen
        $cmd = "gs -sDEVICE=png16m -dTextAlphaBits=4 -r300 -o $pathimg $pathpdf";

        $output = []; $status = 0;
        exec($cmd, $output, $status);
        $this->logd($output, "pdfjpg exec status $status:");
        return $status;
    }

    public function get()
    {
        $this->_mkdir_download();
        $this->_gen_pdfname();
        $this->_move_uppdf();
        $this->_gen_downloadname();
        $r = $this->_exec_gs();
        //$this->_move_uppdf();
        if(!$r) return "/".self::FOLDER_DOWNLOAD."/".$this->downloadfile;
        return "";
    }

}
