<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function admin()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Danh sách hóa đơn';
        $data = Invoice::orderBy('id', 'DESC')->get();
        return view('admin.invoice.index', compact('title', 'data'));
    }

    public function post(Request $request){
        // dd($request);
        if(isset($request->cancel) || isset($request->wait) || isset($request->done)){
            $id = $request->id;
            if(isset($request->cancel)){
                Invoice::where('id', $id)->update([
                    'status' => 2
                ]);
            }
            if(isset($request->wait)){ // isset kiểm tra có dữ liệu hay không
                Invoice::where('id', $id)->update([
                    'status' => 0
                ]);
            }
            if(isset($request->done)){
                Invoice::where('id', $id)->update([
                    'status' => 1
                ]);
            }
            return redirect(route('admin.invoice'))->withSuccessMessage('Thay đổi trạng thái hóa đơn thành công!');
        }

    }
}
