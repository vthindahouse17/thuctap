<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FormProductRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail()
    {
        \App\Helpers\Helper::showAlert();
        // $data = Products::where('slug', request()->slug)->first();
        $data = Products::select('products.id as pid', 'products.name as pname', 'products.slug as pslug', 'products.image as pimage', 'products.*', 'category.*')
            ->join('category', 'category.id', '=', 'products.category')
            ->where('products.slug', request()->slug)
            ->whereRaw('products.amount > 0 AND products.status = 1')
            ->first();
        if ($data == NULL) {
            return redirect(route('home'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
        $product = Products::where('products.category', $data->id)
        ->take(3)->get();

        $title = $data->name;
        return view('clients.product.detail', compact('title', 'data', 'product'));
    }
    public function admin()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Danh sách sản phẩm';
        $data = Products::select('products.id as pid', 'products.name as pname', 'products.slug as pslug', 'products.image as pimage', 'products.*', 'category.*')
            ->join('category', 'category.id', '=', 'products.category')
            ->orderByDesc('products.id')
            ->get();
        return view('admin.product.index', compact('title', 'data'));
    }

    public function add()
    {
        $cate = Category::all();
        \App\Helpers\Helper::showAlert(); //Hiện thông báo lỗi
        $title = 'Thêm sản phẩm';
        return view('admin.product.add', compact('title', 'cate'));
    }

    public function postadd(FormProductRequest $request)
    {
        //upload 1 ảnh
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // lấy thông tin ảnh
        }
        //upload nhiều ảnh
        $uploadedImages = array();
        if ($request->hasFile('listimg')) {
            $files = $request->file('listimg');
            $uploadedImages = \App\Helpers\Helper::uploadMultipleImages($files, 'product');
        }
        Products::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'image' => \App\Helpers\Helper::uploadImage($file, 'product'),
            'listimg' => json_encode($uploadedImages),
            'description' => $request->description,
            'amount' => $request->amount,
            'status' => $request->status,
            'category' => $request->category,
            'price' => $request->price,
        ]);

        return redirect(route('admin.product'))->withSuccessMessage('Thêm sản phẩm thành công!');

    }

    public function edit()
    {
        \App\Helpers\Helper::showAlert();
        $id = request()->id;
        if (Products::find($id) == NULL) {
            return redirect(route('admin.product'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
        $title = 'Sửa sản phẩm';
        $cate = Category::all();
        $data = Products::where('id', $id)->first();

        //dùng sesssion lưu
        request()->session()->put('product', [
            'id' => encrypt($id),
            'image' => encrypt($data->image),
            'listimg' => encrypt($data->listimg),
        ]);
        return view('admin.product.edit', compact('title', 'data', 'cate'));
    }

    public function postedit(FormProductRequest $request)
    {
        $id = decrypt(session('product.id'));
        $image = decrypt(session('product.image'));
        $listimg = decrypt(session('product.listimg'));
        if (Products::find($id) == NULL) {
            return redirect(route('admin.product'))->withErrorMessage('Không tìm thấy sản phẩm.');
        } else {
            $imageName = $image;
            $listImage = $listimg;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = \App\Helpers\Helper::uploadImage($file, 'product');
                $checkimage = public_path($image);
                if (file_exists($checkimage)) {
                    unlink($checkimage); // xóa ảnh
                }
            }
            if ($request->hasFile('listimg')) {
                $files = $request->file('listimg');
                $uploadedImages = \App\Helpers\Helper::uploadMultipleImages($files, 'product');
                $listImage = json_encode($uploadedImages);
                $checkimage = public_path($listimg);
                if (file_exists($checkimage)) {
                    unlink($checkimage); // xóa ảnh
                }
            }

            Products::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $imageName,
                'listimg' => $listImage,
                'description' => $request->description,
                'amount' => $request->amount,
                'status' => $request->status,
                'category' => $request->category,
                'price' => $request->price,
            ]);

            $request->session()->forget('product'); // xóa session
            return redirect(route('admin.product'))->withSuccessMessage('Sửa sản phẩm thành công!');
        }
    }


    public function delete()
    {
        // lấy id
        $id = request()->id;
        if (Products::find($id) == NULL) {
            return redirect(route('admin.product'))->withErrorMessage('Không tìm thấy sản phẩm.');
            ;
        } else {
            Products::where('id', $id)->delete();
            alert()->success('Thành công', 'Đã xóa sản phẩm thành công');
            return redirect(route('admin.product'));
        }
    }
}
