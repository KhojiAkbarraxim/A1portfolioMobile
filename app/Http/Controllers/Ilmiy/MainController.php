<?php

namespace App\Http\Controllers\Ilmiy;

use App\Models\Work;
use App\Models\Score;
use App\Models\Attach
;
use App\Models\Student;
use App\Models\Work_type;
use App\Models\WorkScale;
use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    private const CANCEL = 2;
    private const SUCCESS = 1;

    // professorga biriktirilgan talabalarni olish
    public function attachStudent()
    {
        $professor = $this->getProfessor();
        $students = Attach::where('teacher_id', '=', $professor[0]->id)->get();
        if (!empty($students)) {
            $studentsArray = [];
            foreach ($students as $student) {
                $is_students = Student::where('id', '=', $student->student_id)->get();
                foreach ($is_students as $st) {
                    array_push($studentsArray, $st);
                }
            }
        }

        return view('ilmiy.students.index', compact('studentsArray'));
    }
    // talabani portfoliosini ko'rish
    public function studentShow($id)
    {
        $work_type = Work_type::all();
        $scale = WorkScale::all();
        $student = Student::findOrFail($id);

        if (!empty($id)) {
            $works = Work::where('student_id', '=', $id)->get();
        }
        return view('ilmiy.students.work', compact('works', 'student'));
    }

    // talabaning portfoliosini tasdiqlash
    public function successWork($id)
    {
        $work = Work::findOrFail($id);

        if ($work->status == 0) {
            $score = Score::where('type_id', '=', $work->type_id)->get();
            $ball = $score[0]->ball;
            $work->update([
                'score' => $ball,
                'status' => self::SUCCESS
            ]);
            return back()->with('success', 'Portfolio tasdiqlandi!');
        } else {
            return back()->with('delete', 'Afsus, portfolio bekor qilingan!');
        }
    }

    // Portfolioni bekor qilish
    public function cancelWork(Request $request, $id)
    {
        $work = Work::find($id);
        $request->validate([
            'desc' => 'required|min:3'
        ]);
        if ($work->status == 1) {
            return back()->with('delete', 'Portfolio tasdiqlangan, siz buni bekor qila olmaysiz!');
        }
        if ($work->status == 2) {
            return back()->with('delete', 'Portfolio oldin bekor qilingan!');
        } else {
            $work->update([
                'status' => self::CANCEL,
                'desc' => $request->post('desc')
            ]);
            return back()->with('delete', 'Portfolio bekor qilindi!');
        }
    }
    // auth dan o'tgan professorni olish
    public function getProfessor()
    {
        $id = auth()->user()->id;
        $professor = Professor::where('user_id', '=', $id)->get();
        return $professor;
    }
}
