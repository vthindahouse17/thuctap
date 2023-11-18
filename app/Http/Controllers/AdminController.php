<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $product = Products::count();
        $invoice = Invoice::count();
        $invoice_1 = Invoice::where('status', 1)->count();
        return view('admin.home.index', compact('product','invoice','invoice_1'));
    }
}
