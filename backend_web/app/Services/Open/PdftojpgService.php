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

    private function _exec($cmd)
    {
        $output = []; $status = 0;
        exec($cmd, $output, $status);
        return [
          "status" => $status,
          "output" => $output,
        ];
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
        $this->_gen_pdfname();
        $this->_move_uppdf();
        $this->_gen_downloadname();
        $r = $this->_exec_gs();
        $this->_remove_pdf();
        if(!$r) return "/".self::FOLDER_DOWNLOAD."/".$this->downloadfile;
        return "";
    }

}
