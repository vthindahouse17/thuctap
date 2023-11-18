<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        \App\Helpers\Helper::showAlert();
        $title = 'Trang chủ';
        $category = Category::get()->take(2); // lấy 3 dữ liệu
        $data = Products::whereRaw('products.amount > 0 AND products.status = 1')->take(9)->get();
        $new = Products::orderByDesc('created_at')->whereRaw('products.amount > 0 AND products.status = 1')->take(9)->get();
        //orderByDesc lấy dữ liệu
        $banner = Banners::where('status',1)->get();
        return view('clients.home.index', compact('title', 'category', 'data','new', 'banner'));
    }
}
