<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\FormBannerRequest;
use App\Models\Banners;
use App\Models\Setting;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Danh sách banner';
        $data = Banners::get();
        return view('admin.banner.index', compact('title', 'data'));
    }
    public function add()
    {
        $title = 'Thêm banner';
        \App\Helpers\Helper::showAlert();
        return view('admin.banner.add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // lấy thông tin ảnh
        }
        Banners::create([
            'title' => $request->title,
            'button_text' => $request->button_text,
            'status' => $request->status,
            'button_link' => $request->button_link,
            'description' => $request->description,
            'image' => \App\Helpers\Helper::uploadImage($file, 'banner'),
        ]);
        return redirect(route('admin.banner'))->withSuccessMessage('Thêm banner thành công!');
    }
    public function edit()
    {
        \App\Helpers\Helper::showAlert();
        $id = request()->id;
        if (Banners::find($id) == NULL) {
            return redirect(route('admin.banner'))->withErrorMessage('Không tìm thấy banner.');
        }
        $title = 'Sửa banner';
        $data = Banners::where('id', $id)->first();
        //dùng sesssion lưu
        request()->session()->put('banner', [
            'id' => encrypt($id),
            'image' => encrypt($data->image)
        ]);
        return view('admin.banner.edit', compact('title', 'data'));
    }
    public function postedit(FormBannerRequest $request)
    {
        $id = decrypt(session('banner.id'));
        $image = decrypt(session('banner.image'));
        if (Banners::find($id) == NULL) {
            return redirect(route('admin.banner'))->withErrorMessage('Không tìm thấy banner.');
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = \App\Helpers\Helper::uploadImage($file, 'banner');
                $checkimage = public_path($image);
                if (file_exists($checkimage)) {
                    unlink($checkimage); // xóa ảnh
                }
            } else {
                $imageName = $image;
            }
            Banners::where('id', $id)->update([
                'title' => $request->title,
                'button_text' => $request->button_text,
                'status' => $request->status,
                'button_link' => $request->button_link,
                'description' => $request->description,
                'image' => $imageName,
            ]);
            $request->session()->forget('banner'); // xóa session
            return redirect(route('admin.banner'))->withSuccessMessage('Sửa banner thành công!');

        }
    }

    public function delete()
    {
        // lấy id
        $id = request()->id;
        if (Banners::find($id) == NULL) {
            return redirect(route('admin.banner'))->withErrorMessage('Không tìm thấy banner.');;
        } else {
            //xóa banner với id =lấy id
            Banners::where('id', $id)->delete();

            alert()->success('Thành công', 'Đã xóa banner thành công');
            return redirect(route('admin.banner'));
        }
    }

}
