<?php

namespace App\Http\Controllers\ITB;

use App\Models\Work;
use App\Models\Student;
use App\Models\WorkScale;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class PortController extends Controller
{
    public function workAll()
    {
        $works = Work::join('work_type', 'work.type_id', 'work_type.id')
                ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
                ->select(['work.*', 'work_type.name as type', 'work_scale.name as scale'])
                ->get();
        return view('itb.portfolio', compact('works'));
    }
}
