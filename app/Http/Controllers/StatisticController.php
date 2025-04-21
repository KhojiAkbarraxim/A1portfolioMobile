<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Commission;
use App\Models\Applicationn;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\CommissionScore;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function announcement(){
        $announcements = DB::table('announcement')
            ->leftJoin("criteria", "announcement.id", "criteria.announcement_id")
            ->leftJoin("commissions", "announcement.id", "commissions.announcement_id")
            ->leftJoin("applications", "announcement.id", ".announcement_id")
            ->selectRaw("announcement.*, COUNT(DISTINCT criteria.id) as criteriaCount, COUNT(DISTINCT commissions.id) as commissionsCount, COUNT(DISTINCT applications.id) as announcementCount")
            ->groupBy("announcement.id")
            ->orderBy('announcement.created_at', 'DESC') // Add this line to order by created_at in descending order
            ->get();
        return view('statistic.index', compact('announcements'));
    }

    public function criteria($id){
        $name = Announcement::find($id)->name;
        $criteria = Criteria::where('announcement_id', $id)->get();
        return view('statistic.criteria', compact('criteria','name'));
    }

    public function commissions($id){
        $name = Announcement::find($id)->name;
        $commissions = Commission::where('announcement_id', $id)->get();
        return view('statistic.commissions', compact('commissions','name'));
    }

    public function applications($id){
        $name = Announcement::find($id)->name;
        $criteria = Criteria::where('announcement_id', $id)->get();
        $applications = Applicationn::where('announcement_id', $id)->get();
        $commission_scores = CommissionScore::orderby('created_at', 'DESC')->where('announcement_id', $id)->get();
        if (count($commission_scores) == 0)
            $date = " ";
        else
            $date = date('Y-m-d H:i',strtotime($commission_scores[0]->created_at));
        $scores = [];
        $count = [];
        foreach ($applications as $item){
            $sum[$item->id] = 0;
        }
        foreach ($commission_scores as $item){
            $scores[$item->application_id][$item->criteria_id] = 0;
            $count[$item->application_id][$item->criteria_id] = 0;
        }
        foreach ($commission_scores as $item){
            $scores[$item->application_id][$item->criteria_id] += $item->score;
            $count[$item->application_id][$item->criteria_id] ++;
        }
        return view('statistic.applications', compact('criteria', 'applications', 'scores', 'count', 'date','name'));
    }
}
