<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\FormCategoryRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        \App\Helpers\Helper::showAlert();
        $data = Category::where('slug', request()->slug)->first();
        $product = Products::select('products.id as pid', 'products.name as pname', 'products.slug as pslug', 'products.image as pimage', 'products.*', 'category.*')
        ->join('category', 'category.id', '=', 'products.category')
        ->where('products.category', $data->id)
        ->whereRaw('products.amount > 0 AND products.status = 1')
        ->get();
        // dd($product);
        if ($data == NULL) {
            return redirect(route('home'))->withErrorMessage('Không tìm thấy chuyên mục.');
        }
        $title = $data->name;
        return view('clients.category.index', compact('title', 'data', 'product'));
    }
    public function admin()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Danh sách Category';
        $data = Category::orderbyDesc('id')->get();
        return view('admin.category.index', compact('title', 'data'));
    }

    public function add()
    {
        \App\Helpers\Helper::showAlert(); //Hiện thông báo lỗi
        $title = 'Thêm Category';
        return view('admin.category.add', compact('title'));
    }

    public function postadd(FormCategoryRequest $request)
    {
        //upload ảnh
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // lấy thông tin ảnh
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => \App\Helpers\Helper::uploadImage($file, 'category'),
        ]);

        return redirect(route('admin.category'))->withSuccessMessage('Thêm chuyên mục thành công!');

    }

    public function edit()
    {
        \App\Helpers\Helper::showAlert();
        $id = request()->id;
        if (Category::find($id) == NULL) {
            return redirect(route('admin.category'))->withErrorMessage('Không tìm thấy chuyên mục.');
        }
        $title = 'Sửa chuyên mục';
        //lấy dữ liệu so sánh id =
        $data = Category::where('id', $id)->first();

        //dùng sesssion lưu
        request()->session()->put('category', [
            'id' => encrypt($id),
            'image' => encrypt($data->image)
        ]);
        return view('admin.category.edit', compact('title', 'data'));
    }

    public function postedit(FormCategoryRequest $request)
    {
        $id = decrypt(session('category.id'));
        $image = decrypt(session('category.image'));
        if (Category::find($id) == NULL) {
            return redirect(route('admin.category'))->withErrorMessage('Không tìm thấy chuyên mục.');
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = \App\Helpers\Helper::uploadImage($file, 'category');
                $checkimage = public_path($image);
                if (file_exists($checkimage)) {
                    unlink($checkimage); // xóa ảnh
                }
            } else {
                // chưa upload ảnh ->
                $imageName = $image;
            }
            Category::where('id', $id)->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $imageName,
            ]);
            $request->session()->forget('category'); // xóa session
            return redirect(route('admin.category'))->withSuccessMessage('Sửa chuyên mục thành công!');
        
        }
    }

    public function delete()
    {
        // lấy id
        $id = request()->id;
        if (Category::find($id) == NULL) {
            return redirect(route('admin.category'))->withErrorMessage('Không tìm thấy danh mục.');;
        } else {
            //xóa Category với id =lấy id
            Category::where('id', $id)->delete();
            //xóa sản phẩm
            Products::where('products.category', $id)->delete();
            alert()->success('Thành công', 'Đã xóa danh mục thành công');
            return redirect(route('admin.category'));
        }
    }
}
