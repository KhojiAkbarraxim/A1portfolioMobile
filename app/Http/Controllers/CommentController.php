<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\Comment;
use App\Models\Student;
use App\Models\Professor;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    private const SUCCESS = 1;
    private const CANCEL = 0;

    public function teacherComment(Request $request, $id)
    {
        $user = $this->getUser();
        $work = Work::findOrFail($id);

        $student = Student::where('id', '=', $work->student_id)->get();
        $teacher = Professor::where('user_id', '=', $user->id)->get();


        if ($user->role_id == 2) {
            $request->validate(
                [
                    'comment' => 'required|min:5'
                ],
                [
                    'comment.required' => 'Izoh yozish majburiy!',
                    'comment.min' => 'Izoh kamida 5ta harfdan iborat bo\'lishi kerak!'
                ]
            );
            Comment::create([
                'student_id' => $student[0]->id,
                'teacher_id' => $teacher[0]->id,
                'work_id' => $work->id,
                'message' => $request->post('comment')
            ]);
            return back()->with('success', 'Portfolioga izoh yozildi!');
        } else {
            return back()->with('delete', 'Siz bunga izoh yoza olmaysiz!');
        }
    }
    // Itb uchun hamma kommentlarni ko'rish
    public function allComments()
    {
        $comments = DB::table('comment')
            ->join('student', 'comment.student_id', '=', 'student.id')
            ->join('professor', 'comment.teacher_id', '=', 'professor.id')
            ->join('work', 'comment.work_id', '=', 'work.id')
            ->select(['comment.*', 'student.name as student', 'professor.name as teacher', 'work.link as work', 'work.score as ball'])
            ->latest()
            ->paginate(6);
        return view('itb.comments.index', compact('comments'));
    }

    // Itb  commentga javob yozish uchun
    public function replyComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $request->validate(
            [
                'reply' => 'required|min:5'
            ],
            [
                'reply.required' => 'Izoh yozish majburiy!',
                'reply.min' => 'Izoh kamida 5ta harfdan iborat bo\'lishi kerak!'
            ]
        );
        $comment->update([
            'status' => self::SUCCESS,
            'answer' => $request->post('reply')
        ]);
        return back()->with('success', 'Izohga javob berildi!');
    }
    // Itb  commentga javob yozish uchun
    public function cancelComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $request->validate(
            [
                'reply' => 'required|min:5'
            ],
            [
                'reply.required' => 'Izoh yozish majburiy!',
                'reply.min' => 'Izoh kamida 5ta harfdan iborat bo\'lishi kerak!'
            ]
        );
        $comment->update([
            'status' => self::CANCEL,
            'answer' => $request->post('reply')
        ]);
        return back()->with('success', 'Izohga javob berildi va bekor qilindi!');
    }
    private function getUser()
    {
        $id = auth()->user()->id;
        return User::findOrFail($id);
    }
}
