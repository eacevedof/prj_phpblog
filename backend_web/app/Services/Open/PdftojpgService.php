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
    private $imgpattern;
    private $foldername;
    private $pathdown;

    public function __construct($file)
    {
        $this->file = $file;
        $this->pathdown = public_path()."/".self::FOLDER_DOWNLOAD;
        $this->pdfname = "";
        $this->imgpattern = "";
        $this->foldername = "";
    }

    private function _mkdir_download()
    {
        if(!is_dir($this->pathdown)) mkdir($this->pathdown);
    }

    private function _mkdir_zipfolder()
    {
        $pathfolder = $this->pathdown."/$this->foldername";
        mkdir($pathfolder);
    }

    private function _exec($cmd)
    {
        $output = []; $status = 0;
        exec($cmd, $output, $status);
        return [
          "status" => $status,
          "output" => $output,
        ];
    }

    private function _gen_foldername()
    {
        $now = date("YmdHis");
        $uuid = uniqid();
        $this->foldername = "$now-$uuid";
    }

    private function _gen_imgpattern()
    {
        $uuid = uniqid();
        $this->imgpattern = "img-$uuid-%03d.jpg";
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
        $pathimg = $this->pathdown."/$this->foldername/".$this->imgpattern;

        $this->logd("pdfname:$pathpdf, pathimg:$pathimg","antes de exec_gs\n");

        $cmd = $this->_get_gs_multipage($pathpdf, $pathimg);
        $r = $this->_exec($cmd);
        $this->logd($r, "cmd: $cmd");
        return $r["status"];
    }

    private function _get_gs_multipage($pathpdf, $pathjpg)
    {
        ///pdffile-%03d.jpeg patrón con páginas
        $cmd = "
        gs -dBATCH \
            -dNOPAUSE \
            -dSAFER \
            -sDEVICE=jpeg \
            -dJPEGQ=95 \
            -r600x600 \
            -sOutputFile=$pathjpg \
            $pathpdf
        ";
    }

    private function _exec_zip($pathfolder, $pathzip)
    {
        $cmd = "zip -r {$pathzip} {$pathfolder}";
        $r = $this->_exec($cmd);
        return $r["status"];
    }

    private function _exec_gs_multipage()
    {
        $cmd = $this->_get_gs_multipage();
        $r = $this->_exec($cmd);
        return $r["status"];
    }

    public function get()
    {
        $this->_mkdir_download();
        $this->_gen_foldername();
        $this->_mkdir_zipfolder();
        $this->_gen_pdfname();
        $this->_gen_imgpattern();

        //se guarda el pdf con uuid en downloads
        $this->_move_uppdf();

        $r = $this->_exec_gs();
        $this->_remove_pdf();
        if(!$r) return "/".self::FOLDER_DOWNLOAD."/".$this->imgpattern;
        return "";
    }

}
