<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PendingUser;
use PDF;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userCount = User::where('is_admin', false)->count();
        $pendingUserCount = PendingUser::count();

        $filter = $request->get('filter', 'day'); // Default filter is 'day'

        switch ($filter) {
            case 'month':
                $loginData = User::selectRaw('DATE_FORMAT(last_login_at, "%Y-%m") as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
            case 'year':
                $loginData = User::selectRaw('YEAR(last_login_at) as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
            case 'day':
            default:
                $loginData = User::selectRaw('DATE(last_login_at) as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
        }

        return view('admin.dashboard', compact('userCount', 'pendingUserCount', 'loginData', 'filter'));
    }

    public function generateReport(Request $request)
    {
        $filter = $request->get('filter', 'day'); // Default filter is 'day'

        switch ($filter) {
            case 'month':
                $loginData = User::selectRaw('DATE_FORMAT(last_login_at, "%Y-%m") as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
            case 'year':
                $loginData = User::selectRaw('YEAR(last_login_at) as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
            case 'day':
            default:
                $loginData = User::selectRaw('DATE(last_login_at) as period, COUNT(*) as count')
                                 ->whereNotNull('last_login_at')
                                 ->groupBy('period')
                                 ->orderBy('period', 'asc')
                                 ->get();
                break;
        }

        $pdf = PDF::loadView('admin.report', compact('loginData', 'filter'));

        return $pdf->download('login_report.pdf');
    }
}
