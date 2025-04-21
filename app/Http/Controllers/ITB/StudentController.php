<?php

namespace App\Http\Controllers\ITB;

use App\Models\User;
use App\Models\Work;
use App\Models\Score;
use App\Models\Group;
use App\Models\Faculte;
use App\Models\Student;
use App\Models\WorkScale;
use App\Models\Direction;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //  Bu constanta student roli uchun
    private const STUDENT = 3;
    private const SUCCESS = 1;
    private const CANCEL = 2;
    public function index()
    {

        DB::statement("SET SQL_MODE=''");
        $students = Student::leftJoin('work', 'student.id', 'work.student_id')
            ->select('student.*', DB::raw('SUM(work.score) AS totalScore'))
            ->groupBy('student.id')
            ->orderBy('totalScore', 'desc')
            ->get();

        $groups = Group::all()->sortBy('name');
        // dd($groups);
        $facultes = Faculte::all();
        $directions = Direction::all()->sortBy('name');

        return view('itb.student.index', compact('students', 'groups', 'facultes', 'directions'));
    }
    // Facultet ajax filter
    public function AJAXRequest(Request $request){
        $facultyID = $request->facultyID;
        DB::statement("SET SQL_MODE=''");
        $faculty = Faculte::findOrFail($facultyID);

        $studentsByFaculty = Group::where('faculte_id', '=', $faculty->id)
                             ->join('student', 'group.id', 'student.group_id')
                             ->leftjoin('work', 'student.id', 'work.student_id')
                             ->groupBy('student.id')
                             ->select('student.name','student.status', 'student.phone', 'student.id AS studentID', 'group.name AS groupName', DB::raw('SUM(work.score) AS totalScore'))
                             ->orderBy('totalScore', 'desc')
                             ->get();

                            //  dd($studentsByFaculty);


        if (!empty($studentsByFaculty)) {
            return response()->json([
                'status' => 1,
                'students' => $studentsByFaculty
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'error' => "Bu fakultet bo'yicha studentlar topilmadi!"
            ]);
        }
    }
    // Yo'nalish ajax filter
    public function ajaxDirection(Request $request){
        $DirectionID = $request->DirectionID;
        DB::statement("SET SQL_MODE=''");
        $direction = Direction::findOrFail($DirectionID);

        $studentsByDirection= Group::where('direction_id', '=', $direction->id)
                             ->join('student', 'group.id', 'student.group_id')
                             ->leftjoin('work', 'student.id', 'work.student_id')
                             ->groupBy('student.id')
                             ->select('student.name','student.status', 'student.phone', 'student.id AS studentID', 'group.name AS groupName', DB::raw('SUM(work.score) AS totalScore'))
                             ->orderBy('totalScore', 'desc')
                             ->get();
        if (!empty($studentsByDirection)) {
            return response()->json([
                'status' => 1,
                'students' => $studentsByDirection
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'error' => "Bu yo'nalish bo'yicha studentlar topilmadi!"
            ]);
        }
    }
    // Group ajax filter
    public function ajaxGroup(Request $request){
        $GroupID = $request->GroupID;
        DB::statement("SET SQL_MODE=''");

        $studentsByGroup= Student::where('group_id', '=', $GroupID)
                             ->join('group', 'student.group_id', 'group.id')
                             ->leftjoin('work', 'student.id', 'work.student_id')
                             ->groupBy('student.id')
                             ->select('student.name','student.status', 'student.phone', 'student.id AS studentID', 'group.name AS groupName', DB::raw('SUM(work.score) AS totalScore'))
                             ->orderBy('totalScore', 'desc')
                             ->get();


        if (!empty($studentsByGroup)) {
            return response()->json([
                'status' => 1,
                'students' => $studentsByGroup
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'error' => "Bu group bo'yicha studentlar topilmadi!"
            ]);
        }
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3',
                'group_id' => 'required',
                'phone' => 'required|min:9|max:9'
            ],
            [
                'name.required' => 'Ism familyasi yozilishi majburiy!',
                'name.min' => 'Ism familyasi kamida 3ta harf bo\'lishi kerak!',
                'email.email' => 'Loginda "@" belgisi qatnashishi majburiy!',
                'email.required' => 'Login kiritilishi majburiy!',
                'parol.required' => 'Parol yozilishi majburiy!',
                'parol.min' => 'Parol kamida 3ta belgi bo\'lishi kerak!',
                'email.unique' => 'Bu email orqali oldin ro\'yhatdan o\'tilgan',
                'phone.required' => 'Telefon raqam kiritilishi majburiy!',
                'phone.min' => 'Telefon raqam kamida 9ta raqam bo\'lishi kerak!',
                'phone.max' => 'Telefon raqam 9ta raqamdan oshmasligi kerak'
            ]
        );
        // Users jadvalga yozish
        User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request['password']),
            'role_id' => self::STUDENT
        ]);
        // User jadvaldagi emailni id sini olish
        $users = User::where('email', '=', $request->email)->get();
        $users_array = json_decode($users);
        $user_id = $users_array[0]->id;

        // Student jadvalga yozish
        Student::create([
            'name' => $request->post('name'),
            'group_id' => $request->post('group_id'),
            'phone' => '+998' . $request->post('phone'),
            'login' => $request->post('email'),
            'parol' => $request->post('password'),
            'user_id' => $user_id
        ]);

        return redirect()->route('student.index')->with('success', 'Talaba muvaffaqiyatli qo\'shildi!');
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        Department::all();
        Group::all();
        WorkScale::all();

        $works = Work::where('student_id', '=', $student->id)->get();
        $score = 0;
        foreach ($works as $work) {
            $score += $work->score;
        }

        return view('itb.student.show', compact('student', 'works', 'score'));
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $groups = Group::all();
        $phone_str = Str::substr($student->phone, 4, 9);

        return view('itb.student.edit', compact('student', 'groups', 'phone_str'));
    }
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:3',
                'group_id' => 'required',
                'phone' => 'required|min:9|max:9'
            ],
            [
                'name.required' => 'Ism familyasi yozilishi majburiy!',
                'name.min' => 'Ism familyasi kamida 3ta harf bo\'lishi kerak!',
                'email.email' => 'Loginda "@" belgisi qatnashishi majburiy!',
                'email.required' => 'Login kiritilishi majburiy!',
                'parol.required' => 'Parol yozilishi majburiy!',
                'parol.min' => 'Parol kamida 3ta belgi bo\'lishi kerak!',
                'email.unique' => 'Bu email orqali oldin ro\'yhatdan o\'tilgan',
                'phone.required' => 'Telefon raqam kiritilishi majburiy!',
                'phone.min' => 'Telefon raqam kamida 9ta raqam bo\'lishi kerak!',
                'phone.max' => 'Telefon raqam 9ta raqamdan oshmasligi kerak'
            ]

        );

        // studentni users jadvaldagi idsini olish
        $users = User::where('email', '=', $request->email)->get();
        $user_id = $users[0]->id;


        $users[0]->update([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request['password']),
            'role_id' => self::STUDENT
        ]);

        $student->update([
            'name' => $request->post('name'),
            'group_id' => $request->post('group_id'),
            'phone' => '+998' . $request->post('phone'),
            'login' => $request->post('email'),
            'parol' => $request->post('password'),
            'user_id' => $user_id
        ]);

        return redirect()->route('student.index')->with('success', 'Talaba ma\'lumotlari o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $user = User::where('id', '=', $student->user_id)->get();

        if ($student->status == 1) {

            $student->update([
                'status' => false
            ]);
            $user[0]->update([
                'status' => false
            ]);

            return redirect()->route('student.index')->with('delete', 'Talaba bloklandi');
        } else {
            $student->update([
                'status' => true
            ]);
            $user[0]->update([
                'status' => true
            ]);
        }

        return redirect()->route('student.index')->with('success', 'Talaba faollashdi');
    }

    // talabaning portfoliosini tasdiqlash
    public function successWork($id)
    {
        $work = Work::findOrFail($id);

        if ($work->desc == 0) {
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
}
