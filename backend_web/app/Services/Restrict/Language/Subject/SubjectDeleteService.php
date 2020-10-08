<?php
namespace App\Services\Restrict\Language\Subject;
use App\Models\AppSubject;
use App\Services\BaseService;
use Illuminate\Http\Request;

class SubjectDeleteService extends BaseService
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
        $post = AppSubject::find($this->id);
        $update = ["update_date"=>$post->update_date];
        $this->_handle_sysfields($update,"d");
        return AppSubject::where("id", "=", $this->id)->update($update);
    }

    private function _hard_delete()
    {
        return AppSubject::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
