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
    private $pdfname = "";
    private $imgpattern = "";
    private $foldername = "";
    private $pathdown = "";
    private $url = "";

    public function __construct($file)
    {
        $this->file = $file;
        $this->pathdown = public_path()."/".self::FOLDER_DOWNLOAD;
    }

    private function _mkdir_download()
    {
        if(!is_dir($this->pathdown)) mkdir($this->pathdown);
    }

    private function _mkdir_zipfolder()
    {
        $pathfolder = "$this->pathdown/$this->foldername";
        mkdir($pathfolder);
    }

    private function _remove_zipfolder()
    {
        $pathfolder = "$this->pathdown/$this->foldername";
        if(is_dir($pathfolder)) {
            $cmd = "rm -fr $pathfolder";
            $r = $this->_exec($cmd);
            $this->logd($r,"_remove_zipfolder");
        }
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
        $this->imgpattern = "img-%03d.jpg";
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
        $pathpdf = "$this->pathdown/$this->pdfname";
        $r = move_uploaded_file($this->file["tmp_name"],$pathpdf);
        return $r;
    }

    private function _remove_pdf()
    {
        $pathpdf = "$this->pathdown/$this->pdfname";
        if(is_file($pathpdf)) unlink($pathpdf);
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
        return $cmd;
    }

    private function _exec_zip()
    {
        //$cmd = "zip -r {$pathzip} {$pathfolder}/*";
        $cmd = "cd $this->pathdown; zip -r {$this->foldername}.zip {$this->foldername}";
        $r = $this->_exec($cmd);
        return $r["status"];
    }

    private function _get_files()
    {
        $pathdir = "$this->pathdown/$this->foldername";
        $files = scandir($pathdir);
        return array_diff($files, [".", ".."]);
    }

    private function _exec_gs()
    {
        $pathpdf = $this->pathdown."/".$this->pdfname;
        $pathimg = $this->pathdown."/$this->foldername/".$this->imgpattern;

        $this->logd("pdfname:$pathpdf, pathimg:$pathimg","antes de exec_gs\n");

        $cmd = $this->_get_gs_multipage($pathpdf, $pathimg);
        $r = $this->_exec($cmd);
        if(!$r["status"]) {
            $pathfolder = "$this->pathdown/$this->foldername";
            $rz = $this->_exec_zip();
            $this->logd($rz, "exec_zip: $pathfolder to $pathfolder.zip");
        }

        $this->logd($r, "cmd: $cmd");
        return $r["status"];
    }

    private function _get_url()
    {
        $this->_mkdir_download();
        $this->_gen_foldername();
        $this->_mkdir_zipfolder();
        $this->_gen_pdfname();
        $this->_gen_imgpattern();

        //se guarda el pdf con uuid en downloads
        $this->_move_uppdf();

        //genera las imagenes y el zip
        $this->_exec_gs();
        $files = $this->_get_files();
        $this->logd($files,"files in folder");
        if($files) return "";

        sleep(2);
        $this->_remove_pdf();
        //esto puede borrar antes de que el zip este totalmente formado
        $this->_remove_zipfolder();

        return "/".self::FOLDER_DOWNLOAD."/".$this->foldername.".zip";
    }// _get_url

    public function get()
    {
        $url = $this->_get_url();
        return $url;
    }

}
