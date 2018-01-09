<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\models\StallOrder;
use DB;
use Excel;
class MaatwebsiteDemoController extends Controller
{
	

		public function downloadExcel(Request $type)
	{
		// dd($type);
		$stall_number=$type->stall_id_print;
		

		$data = StallOrder::select('id', 'composite_order_id as Order Id', 'code as Scan Code', 'stall_order_amt as Order Amount', 'orderdate as Order Date')->where('stall_id', $stall_number)->get()->toArray();
		return Excel::create('Scapikgo', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type->data);
	}
	
}