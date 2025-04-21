<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Group;
use App\Models\Attach;
use App\Models\Student;
use App\Models\Faculte;
use App\Models\Professor;
use App\Models\Direction;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return redirect()->route('login');
        // $facultes = Faculte::all();
        // return view('home', compact('facultes'));
    }
    public function itbHome()
    {
        $professors = Professor::count('id');
        $facultes = Faculte::count('id');
        $directions = Direction::count('id');
        $departments = Department::count('id');
        $groups = Group::count('id');
        $students = Student::count('id');
        $work = Work::count('id');
        return view('itb.home', compact('facultes', 'directions', 'departments', 'groups', 'professors', 'students', 'work'));
    }
    // Ilmiy rahbar asosiy oynasi uchun method
    public function ilmiyHome()
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

        if (!empty($studentsArray)) {
            $works = [];
            foreach ($studentsArray as $item) {
                $is_work = Work::where('student_id', '=', $item->id)->get();
                foreach ($is_work as $work) {
                    array_push($works, $work);
                }
            }
            $cnt_work = count($works);


            // tasdiqlangan portfoliolar soni
            $success = 0;
            foreach ($works as $work) {
                if ($work->status == 1)
                    $success++;
            }
            // bekor qilingan portfoliolar soni
            $cancel = 0;
            foreach ($works as $work) {
                if ($work->status == 2)
                    $cancel++;
            }
            // Ko'rilmagan portfoliolar soni
            $eye = 0;
            foreach ($works as $work) {
                if ($work->status == 0)
                    $eye++;
            }
            // Talabalar soni
            $student = count($studentsArray);

        }
        else{
            $cnt_work = 0;
            $cancel = 0;
            $eye = 0;
            $success = 0;
            $student = 0;
        }
        // Umumiy ballni olish
        $totalScore = DB::table('attach')
        ->where('teacher_id', $professor[0]->id)
        ->join('student', 'attach.student_id', 'student.id')
        ->join('work', 'student.id', 'work.student_id')
        ->select('work.score')->sum('work.score');



        return view('ilmiy.index', compact('cnt_work', 'success', 'cancel', 'eye', 'student', 'totalScore'));
    }
    //  Talaba asosiy oynasi uchun method
    public function studentHome()
    {
        $student = $this->getStudent();
        $works = Work::where('student_id', '=', $student[0]->id)->get();
        if (!empty($works)) {
            $workCount = count($works);
            // tasdiqlangan ishlar
            $success = 0;
            foreach($works as $work){
                if($work->status == 1){
                    $success++;
                }
            }
            // bekor qilingan ishlar
            $cancel = 0;
            foreach($works as $work){
                if($work->status == 2){
                    $cancel++;
                }
            }
            // tekshirilmagan ishlar soni
            $unread = 0;
            foreach($works as $work){
                if($work->status == 0){
                    $unread++;
                }
            }
            // umumiy to'plagan ball
            $score = 0;
            foreach($works as $work){
                $score += $work->score;
            }
        }
        else{
            $workCount = 0;
            $success = 0;
            $cancel = 0;
            $unread = 0;
            $score = 0;
        }

        return view('student.index', compact('workCount', 'success', 'cancel', 'unread', 'score'));
    }

    public function getStudent()
    {
        $id = auth()->user()->id;
        $student = Student::where('user_id', '=', $id)->get();
        return $student;
    }
    public function getProfessor()
    {
        $id = auth()->user()->id;
        $professor = Professor::where('user_id', '=', $id)->get();
        return $professor;
    }
}
