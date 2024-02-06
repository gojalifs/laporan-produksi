<?php

namespace App\Http\Controllers;

use App\Models\ProductionModel;
use Auth;
use DateTimeImmutable;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use IntlDateFormatter;
use Validator;

class ProductionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $production = ProductionModel::where("bagian", $user->bagian)
            ->where("departemen", $user->departemen)
            ->where("lot_number", date("Y-m-d"))
            ->orderBy("created_at", "desc")->paginate(10);

        // Get current date in the specified format
        // set the default timezone to use.
        $date = new DateTimeImmutable();

        $fmt = datefmt_create(
            'id-ID',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Asia/Jakarta',
            IntlDateFormatter::GREGORIAN,
            'EEEE, dd MMMM yyyy'
        );
        $day = datefmt_format($fmt, $date);

        return view(
            "produksi.produksi",
            with(
                [
                    'user' => $user,
                    'production' => $production,
                    'date' => $day,
                ]
            )
        );
    }

    public function create(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'product_id.required' => 'Product ID wajib diisi',
            'status.required' => "Status Harus Diisi",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        try {
            $user = Auth::user();

            $data = new ProductionModel();
            $data->product_id = $request->product_id;
            $data->lot_number = date("Y-m-d");
            $data->departemen = $user->departemen;
            $data->bagian = $user->bagian;
            $data->user_id = $user->id;
            $data->status = $request->status;

            $data->save();
            return redirect()->back()->with(['success' => 'Data produksi #' . $data->id . ' tersimpan!', 'departemen' => $data->departemen]);
        } catch (QueryException $e) {
            // Handle the exception - Log, redirect, or show an error message
            if ($e->errorInfo[1] === 1062) {
                // Handle the duplicate entry error
                return redirect()->back()->with(['error' => 'Data sudah pernah scan']);
            } else {
                // Handle other database errors
                return redirect()->back()->with(['error' => 'Database error: ' . $e->getMessage()]);
            }
        }
    }


    public function report(Request $request)
    {
        $report = DB::table('productions')
            ->join('products', 'productions.product_id', '=', 'products.id')
            ->where('lot_number', '=', date('Y-m-d'))
            ->get();

        return view('produksi.laporan', with([
            'report' => $report,
            'bagians' => ['Semua Bagian', 'Press Welding', 'Line Coating', 'Line Molding'],
        ]));
    }

    public function reportByDate(Request $request)
    {
        $date = $request->date;
        $bagian = $request->bagian;

        if ($bagian == 'Semua Bagian') {
            $report = DB::table('productions')
                ->join('products', 'productions.product_id', '=', 'products.id')
                ->where('productions.lot_number', '=', $date)
                ->get();

        } else {
            $report = DB::select("SELECT * FROM productions INNER JOIN products ON productions.product_id = products.id WHERE productions.lot_number = ? AND productions.bagian = ?", [$date, $bagian]);
        }



        return view('produksi.laporan', with([
            'report' => $report,
            'bagians' => ['Semua Bagian', 'Press Welding', 'Line Coating', 'Line Molding'],
        ]));
    }
}
