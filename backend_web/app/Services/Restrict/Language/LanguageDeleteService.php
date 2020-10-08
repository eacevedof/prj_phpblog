<?php
namespace App\Services\Restrict\Language;
use App\Models\AppLanguage;
use App\Services\BaseService;
use Illuminate\Http\Request;

class LanguageDeleteService extends BaseService
{
    private $id;

    public function __construct($id, $iduser=-1)
    {
        $this->id = $id;
        $this->sysuser = $iduser;
    }

    private function _check_data()
    {

    }

    private function _soft_delete()
    {
        $post = AppLanguage::find($this->id);
        $update = ["update_date"=>$post->update_date];
        $this->_handle_sysfields($update,"d");
        return AppLanguage::where("id", "=", $this->id)->update($update);
    }

    private function _hard_delete()
    {
        return AppLanguage::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
