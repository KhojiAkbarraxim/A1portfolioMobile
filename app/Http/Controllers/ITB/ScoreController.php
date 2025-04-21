<?php

namespace App\Http\Controllers\ITB;

use App\Models\Score;
use App\Models\Work_type;
use App\Models\WorkScale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    public function index()
    {
        // $scores = Score::all();
        $scale = WorkScale::all();
        $scores = DB::table('score')
                        ->join('work_type', 'score.type_id', '=', 'work_type.id')
                        ->join('work_scale', 'work_type.scale_id', '=', 'work_scale.id')
                        ->select(['score.*','work_type.name as worktype', 'work_scale.name as scale'])
                        ->get();
        // dd($scores);
        // Ball qo'yilmagan work_typeni olish
        $workType = Work_type::select('work_type.*')
                            ->leftJoin('score', 'work_type.id', '=', 'score.type_id')
                            ->whereNull('score.type_id')->get() ;
        return view('itb.score.index', compact('scores', 'workType'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'type_id' => 'required',
                'ball' => 'required|numeric'
            ],
            [
                'type_id.required' => 'Portfolio turi tanlanishi majburiy!',
                'ball.required' => 'Ball kiritilishi majburiy!',
                'ball.numeric' => 'Ball faqat raqam bo\'lishi kerak!'
            ]
        );
        Score::create([
            'type_id' => $request->post('type_id'),
            'ball' => $request->post('ball')
        ]);
        return redirect()->route('score.index')->with('success','Portfolio balli qo\'shildi');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $score = Score::findOrFail($id);
        $request->validate(
            [
                'type_id' => 'required',
                'ball' => 'required|numeric'
            ],
            [
                'type_id.required' => 'Portfolio turi tanlanishi majburiy!',
                'ball.required' => 'Ball kiritilishi majburiy!',
                'ball.numeric' => 'Ball faqat raqam bo\'lishi kerak!'
            ]
        );
        $score->update([
            'type_id' => $request->post('type_id'),
            'ball' => $request->post('ball')
        ]);
        return redirect()->route('score.index')->with('success','Portfolio balli o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $id = Score::findOrFail($id);
        $id->delete();
        return redirect()->route('score.index')->with('delete', 'Ball o\'chirildi!');
    }
}