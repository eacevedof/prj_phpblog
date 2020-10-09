<?php
namespace App\Services\Open\Language;
use App\Models\AppSubject;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class PracticeDetailService extends BaseService
{
    private $subjslug;
    private $data;

    public function __construct(string $subjslug)
    {
        $this->subjslug = $subjslug;
    }

    private function _get_subject()
    {
        $slug = $this->subjslug;

    }

    public function get()
    {
        $this->_check_data();
        return AppSubject::find($this->id);
    }

    public function get_by_slug($slug)
    {
        //dd($slug);
        $subject = $this->get_db("app_subject");
        $r = $subject->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->where("slug","=",$slug)
            ->limit(1)
            ->get();

        return $r;
    }

}
