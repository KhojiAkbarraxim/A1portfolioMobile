<?php

namespace App\Http\Controllers\Student;

use App\Models\Work;
use App\Models\Student;
use App\Models\Work_type;
use App\Models\WorkScale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_type = Work_type::all();
        $scale = WorkScale::all();
        $student = $this->getStudent();
        $works = Work::where('student_id', '=', $student[0]->id)
                        ->join('work_type', 'work.type_id', 'work_type.id')
                        ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
                        ->select(['work.*', 'work_type.name as type', 'work_scale.name as scale'])
                        ->get();

        $totalScore = Work::where('student_id', '=', $student[0]->id)->sum('score');

        return view('student.ilmiy ishlar.index', compact('work_type', 'totalScore', 'works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = $this->getStudent();
        $student_id = $student[0]->id;
        $request->validate(
            [
                'type_id' => 'required',
                'subject' => 'required|min:3',
                'link' => 'required',
                'date' => 'required|date'
            ],
            [
                'type_id.required' => 'Portfolio turini tanlash majburiy!',
                'subject.required' => 'Mavzu kiritilishi majburiy!',
                'subject.min' => 'Mavzu kamida 3ta harfdan iborat bo\'lishi kerak!',
                'link.required' => 'link kiritilishi majburiy!',
                'date.required' => 'Sana kiritilishi majburiy!'
            ]
        );
        Work::create([
            'student_id' => $student_id,
            'type_id' => $request->post('type_id'),
            'subject' => $request->post('subject'),
            'link' => $request->post('link'),
            'date' => $request->post('date')
        ]);
        return back()->with('success', 'Portfolio yuklandi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Work::findOrFail($id);
        $request->validate(
            [
                'type_id' => 'required',
                'subject' => 'required|min:3',
                'link' => 'required',
                'date' => 'required|date'
            ],
            [
                'type_id.required' => 'Portfolio turini tanlash majburiy!',
                'subject.required' => 'Mavzu kiritilishi majburiy!',
                'subject.min' => 'Mavzu kamida 3ta harfdan iborat bo\'lishi kerak!',
                'link.required' => 'link kiritilishi majburiy!',
                'date.required' => 'Sana kiritilishi majburiy!'
            ]
        );
        $id->update([
            'type_id' => $request->post('type_id'),
            'subject' => $request->post('subject'),
            'link' => $request->post('link'),
            'date' => $request->post('date')
        ]);
        return back()->with('success', 'Portfolio o\'zgartirildi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Work::findOrFail($id);
        $id->delete();
        return back()->with('delete', 'Portfolio o\'chirildi!');
    }
    // Tasdiqlangan portfoliolar
    public function checkedWork()
    {
        $work_type = Work_type::all();
        $scale = WorkScale::all();
        $student = $this->getStudent();
        $works = Work::where('student_id', '=', $student[0]->id)
            ->where('status', '=', 1)
            ->paginate(6);
        $totalScore = Work::where('student_id', '=', $student[0]->id)->sum('score');
        return view('student.ilmiy ishlar.index', compact('work_type', 'totalScore', 'works'));
    }
    // Bekor qilingan portfolio
    public function cancelWork()
    {
        $work_type = Work_type::all();
        $scale = WorkScale::all();
        $student = $this->getStudent();
        $works = Work::where('student_id', '=', $student[0]->id)
            ->where('status', '=', 2)
            ->paginate(6);
        $totalScore = Work::where('student_id', '=', $student[0]->id)->sum('score');
        return view('student.ilmiy ishlar.index', compact('work_type', 'totalScore', 'works'));
    }
    // Tekshirilmagan portfolio
    public function unverifiedWork()
    {
        $work_type = Work_type::all();
        $scale = WorkScale::all();
        $student = $this->getStudent();
        $works = Work::where('student_id', '=', $student[0]->id)
            ->where('status', '=', 0)
            ->paginate(6);
        $totalScore = Work::where('student_id', '=', $student[0]->id)->sum('score');
        return view('student.ilmiy ishlar.index', compact('work_type', 'totalScore', 'works'));
    }

    // authdan o'tgan studentni olish
    public function getStudent()
    {
        $id = auth()->user()->id;
        $student = Student::where('user_id', '=', $id)->get();
        return $student;
    }
}
