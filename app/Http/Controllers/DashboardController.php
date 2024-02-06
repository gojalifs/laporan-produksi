<?php

namespace App\Http\Controllers;

use App\Models\ProductionModel;
use App\Models\User;
use Auth;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use IntlDateFormatter;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $date = DB::select("SELECT MAX(DATE(created_at)) as date from productions");

        $params = [
            $user->bagian,
            $user->departemen,
            $date[0]->date
        ];

        $coating = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Line Coating'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;
        $molding = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Line Molding'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;
        $press = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Press Welding'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;

        $coatingToday = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Line Coating'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;
        $moldingToday = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Line Molding'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;
        $pressToday = DB::select("SELECT COUNT(lot_number) as total FROM productions
        WHERE lot_number >= ? AND bagian = 'Press Welding'", [date("Y-m-d", strtotime("-1 days"))]) ?? 0;

        if ($user->bagian != 'Admin Produksi') {
            $results = DB::select("SELECT COUNT(lot_number) as total FROM productions
                WHERE bagian = ? AND departemen= ? AND lot_number >= str_to_date(?, '%Y-%m-%d')", $params);
        } else {
            $results = $coating[0]->total + $molding[0]->total + $press[0]->total;
        }

        $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

        // Format the date
        $formattedDate = $formatter->format(new DateTime(date('Y-m-d')));

        if (Auth::user()->role == 'admin') {
            return view("dashboard.dashboard", [
                "user" => $user,
                'date' => $formattedDate,
                "produksi" => [
                    'total' => $results,
                    'coating' => $coating[0]->total,
                    'molding' => $molding[0]->total,
                    'press' => $press[0]->total,
                ],
            ]);
        } else {
            if ($user->bagian == 'Line Coating') {
                return view('dashboard.user', [
                    "user" => $user,
                    'date' => $formattedDate,
                    "produksi" => [
                        'total' => $coating[0]->total,
                        'today' => $coatingToday[0]->total,
                    ],
                ]);
            } else if ($user->bagian == 'Line Molding') {
                return view('dashboard.user', [
                    "user" => $user,
                    'date' => $formattedDate,
                    "produksi" => [
                        'total' => $molding[0]->total,
                        'today' => $moldingToday[0]->total,
                    ],
                ]);
            } else {
                return view('dashboard.user', [
                    "user" => $user,
                    'date' => $formattedDate,
                    "produksi" => [
                        'total' => $press[0]->total,
                        'today' => $pressToday[0]->total,
                    ],
                ]);
            }
        }
    }
}
