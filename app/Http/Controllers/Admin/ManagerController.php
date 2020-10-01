<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Manager;
use Excel;


class ManagerController extends Controller
{
    /**
    * admin manager page
    * @param null
    * @return view /admin/manager/index
    */
    public function index(){
    	$data = Manager::get();

    	return view('admin.manager.index',compact('data'));
    }

    /**
    * export the excel in manage page
    * @param null
    * @return excel
    */
    public function export(){
    	$cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }


}
