<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class pointInformationController extends Controller
{
    public function index()
    {
        $point_info = DB::table('point_management as p')
            ->select('p.created_at')
            ->distinct()
            ->get();
        return view('point_information.index', compact('point_info'));
    }

    public function filter_point_management(Request $request)
    {
        try {

            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $filter_point_info = DB::table('point_management as p')
                ->select('p.created_at')
                ->whereBetween('p.created_at', [$start_date, $end_date])
                ->distinct()
                ->get();
           return view('point_information.filter_point_management',compact('filter_point_info'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
