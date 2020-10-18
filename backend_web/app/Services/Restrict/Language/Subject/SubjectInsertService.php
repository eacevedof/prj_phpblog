<?php
namespace App\Services\Restrict\Language\Subject;
use App\Models\AppSubject;
use App\Services\BaseService;

class SubjectInsertService extends BaseService
{
    private $iduser;
    private $data;

    public function __construct($data, $iduser=null)
    {
        $this->iduser = $iduser;
        $this->data = $data;
    }

    private function _check_data($data) {}

    public function save()
    {
        $data = $this->data;
        $this->logd($data,"subject.insert");
        $this->_check_data($data);
        $this->_handle_sysfields($data);
        $this->logd($data,"subject.insert.create");
        return AppSubject::create($data);
    }
}
