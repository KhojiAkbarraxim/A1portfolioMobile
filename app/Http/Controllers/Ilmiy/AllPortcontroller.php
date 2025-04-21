<?php

namespace App\Http\Controllers\Ilmiy;

use App\Models\Work;
use App\Models\Attach;
use App\Models\Student;
use App\Models\WorkScale;
use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;

use Illuminate\Support\Facades\DB;

class AllPortcontroller extends Controller
{
    public function mineWork()
    {
        $professor = $this->getProfessor();

        // Biriktirilgan talabalarning portfoliosini olish
        $allWorks = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->join('work_type', 'work.type_id', 'work_type.id')
            ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
            ->select(['student.*', 'work.*', 'work.id AS work_id', 'work_type.id', 'work_type.scale_id', 'work_type.name as smthName', 'work_scale.*'])
            ->get();
        // dd($allWorks);
        // Umumiy ballni olish
        $totalScore = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->select('work.score')->sum('work.score');

        return view('ilmiy.portfolio.mine', compact('allWorks', 'totalScore'));
    }
    // Tasdiqlangan ishlar
    public function successWork()
    {
        $professor = $this->getProfessor();

        // Biriktirilgan talabalarning tasdiqlangan portfoliosini olish
        $allWorks = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->join('work_type', 'work.type_id', 'work_type.id')
            ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
            ->select(['student.*', 'work.*', 'work.id AS work_id', 'work_type.id', 'work_type.scale_id', 'work_type.name as smthName', 'work_scale.*'])
            ->where('work.status', '=', 1)
            ->get();


        // Umumiy ballni olish
        $totalScore = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->select('work.score')->sum('work.score');

        return view('ilmiy.portfolio.mine', compact('allWorks', 'totalScore'));
    }

    // Bekor qilingan ishlarni olish
    public function cancelWork()
    {
        $professor = $this->getProfessor();

        // Biriktirilgan talabalarning bekor qilingan portfoliosini olish
        $allWorks = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->join('work_type', 'work.type_id', 'work_type.id')
            ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
            ->select(['student.*', 'work.*', 'work.id AS work_id', 'work_type.id', 'work_type.scale_id', 'work_type.name as smthName', 'work_scale.*'])
            ->where('work.status', '=', 2)
            ->get();


        // Umumiy ballni olish
        $totalScore = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->select('work.score')->sum('work.score');

        return view('ilmiy.portfolio.mine', compact('allWorks', 'totalScore'));
    }

    public function unverifiedWork()
    {
        $professor = $this->getProfessor();

        // Biriktirilgan talabalarning tasdiqlngan portfoliosini olish
        $allWorks = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->join('work_type', 'work.type_id', 'work_type.id')
            ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
            ->select(['student.*', 'work.*', 'work.id AS work_id', 'work_type.id', 'work_type.scale_id', 'work_type.name as smthName', 'work_scale.*'])
            ->where('work.status', '=', 0)
            ->get();

        // Umumiy ballni olish
        $totalScore = DB::table('attach')
            ->where('teacher_id', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('work', 'student.id', 'work.student_id')
            ->select('work.score')->sum('work.score');

        return view('ilmiy.portfolio.mine', compact('allWorks', 'totalScore'));
    }


    // Boshqa talabalarning portfoliolarini olish
    public function allWork()
    {
        $professor = $this->getProfessor();
        $allWorks = DB::table('attach')
            ->where('teacher_id', '!=', $professor[0]->id)
            ->join('student', 'attach.student_id', 'student.id')
            ->join('professor', 'attach.teacher_id', 'professor.id')
            ->join('work', 'student.id', 'work.student_id')
            ->join('work_type', 'work.type_id', 'work_type.id')
            ->join('work_scale', 'work_type.scale_id', 'work_scale.id')
            ->select(['student.name as student', 'work.*', 'work_type.name as worktype', 'work_scale.name as scale', 'professor.name as professor'])
            ->get();

        return view('ilmiy.portfolio.all', compact('allWorks'));
    }
    // auth dan o'tgan professorni olish
    public function getProfessor()
    {
        $id = auth()->user()->id;
        $professor = Professor::where('user_id', '=', $id)->get();
        return $professor;
    }
}
