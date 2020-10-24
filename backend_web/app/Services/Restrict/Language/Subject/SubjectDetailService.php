<?php
namespace App\Services\Restrict\Language\Subject;
use App\Models\Language\AppSubject;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SubjectDetailService extends BaseService
{
    private $id;
    private $db;

    public function __construct($id=null)
    {
        $this->id = $id;
        $this->db = DB::table("app_subject");
    }

    private function _check_data()
    {

    }

    public function get()
    {
        $this->_check_data();
        return AppSubject::find($this->id);
    }

    public function get_by_slug($slug)
    {
        //dd($slug);
        $r = $this->db->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->where("slug","=",$slug)
            ->limit(1)
            ->get();

        return $r;
    }

    public function get_by_id($id)
    {
        $r = $this->db
            ->whereNull("delete_date")
            ->where("id","=",$id)
            ->get();
        //dd($r);
        return $r;
    }
}
