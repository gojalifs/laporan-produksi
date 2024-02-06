<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Validator;

class BarcodeController extends Controller
{
    public function index()
    {
        $products = ProductModel::all();
        return view('barcode.barcode', with([
            'products' => $products,
        ]));
    }

    public function generate(Request $request)
    {
        $rules = [
            'id' => 'required',
            'quantity' => 'required',
        ];

        $messages = [
            'id.required' => 'Product ID wajib diisi',
            'quantity.required' => "Jumlah Harus Diisi",
            'quantity.integer' => "Harus berupa angka"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()]);
        }
        try {
            $products = ProductModel::find($request->id);

            $productBarcodes = array();

            for ($i = 0; $i < $request->quantity; $i++) {
                $productBarcodes[] = $request->id;
            }

            $fileName = 'data barcode' . '_' . $products->name . '_' . $products->id . '.pdf';


            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            $dompdf = new Dompdf($options);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'potrait');

            // Render the HTML as PDF
            $html = view('barcode.download')->with(['barcodes' => $productBarcodes])->render();
            $dompdf->loadHtml($html);
            $dompdf->render();

            return $dompdf->stream($fileName, ['Attachment' => 0]);

        } catch (\Exception $e) {
            // Handle exceptions if any
            dd($e->getMessage());
        }
    }

    public function generated()
    {
    }
}
