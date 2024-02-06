<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductModel::get();
        return view('product.product', with(['products' => $products]));
    }

    public function create(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required',
        ];

        $messages = [
            'code.required' => 'Kode Produk Wajib Diisi',
            'name.required' => "Nama Produk Harus Diisi",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        try {
            $data = new ProductModel();
            $data->name = $request->name;
            $data->code = $request->code;

            $data->save();
            return redirect()->back()->with(['success' => 'Data Produk #' . $data->id . ' berhasil tersimpan!']);
        } catch (QueryException $e) {
            // Handle the exception - Log, redirect, or show an error message
            if ($e->errorInfo[1] == 1062) {
                // Handle the duplicate entry error
                return redirect()->back()->with(['error' => 'Data Ada']);
            } else {
                // Handle other database errors
                return redirect()->back()->with(['error' => 'Database error: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi error, hubungi administrator']);
        }
    }

    public function updateIndex($id)
    {
        $product = ProductModel::find($id);
        return view('product.edit', with(['product' => $product]));
    }

    public function update(Request $request)
    {
        $product = ProductModel::find($request->id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->save();

        $products = ProductModel::get();

        return redirect('products')->with(['success' => 'Data Berhasil Diperbarui', 'products' => $products]);

    }

    public function delete($id)
    {
        $product = ProductModel::find($id);
        try {
            $product->delete();

            $products = ProductModel::get();
            return redirect('products')->with(['success' => 'Data Berhasil Dihapus', 'products' => $products]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                // Handle the duplicate entry error
                return redirect('products')->with([
                    'error_delete' => 'Tidak dapat menghapus. Ada data produksi dengan kode produk ' . $product->code . ' (' . $product->name . ')',
                ]);
            } else {
                // Handle other database errors
                return redirect()->back()->with(['error' => 'Database error: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            abort(500);
        }
    }
}
