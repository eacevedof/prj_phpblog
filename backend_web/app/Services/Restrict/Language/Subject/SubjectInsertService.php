<?php
namespace App\Services\Restrict\Language\Subject;
use App\Models\Language\AppSubject;
use App\Services\BaseService;

class SubjectInsertService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function _check_data($data) {}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data);
        $this->logd($data,"subject.insert.create");
        $r = AppSubject::create($data);
        $this->_logquery("subject.insert.save");
        return $r;
    }
}
