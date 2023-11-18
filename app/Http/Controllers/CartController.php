<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
class CartController extends Controller
{
    public function index()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Giỏ hàng';
        $uid = Auth::user()->id;
        $data = Cart::whereRaw("uid = $uid")->get();
        if ($data->isNotEmpty()) {
            $sum = Cart::whereRaw("uid = $uid")->sum('total');
            return view('clients.cart.index', compact('data', 'title', 'sum'));
        } else {
            return redirect(route('home'))->withErrorMessage('Không tìm thấy sản phẩm trong giỏ hàng.');
        }
    }

    public function count()
    {
        // Get no.of items available in the cart table
        $wordlist = Cart::where('uid', Auth::user()->id)->get(); // check id người dùng
        if (!$wordlist) {
            return '0';
        } else {
            $rows = $wordlist->count();
            return $rows;
        }
    }

    public function add(Request $request)
    {
        \App\Helpers\Helper::showAlert();
        if (Auth::check()) {
            $uid = Auth::user()->id; // lấy id người dùng
            $pid = $request->input('pid'); // lấy dữ liệu input
            $pname = $request->input('pname');
            $pprice = $request->input('pprice');
            $pimage = $request->input('pimage');

            // Kiểm tra giá trị của pqty
            $pqty = ($request->has('pqty') && $request->input('pqty')) ? $request->input('pqty') : 1;

            $total_price = $pprice * $pqty; // tính tổng

            $code = Cart::whereRaw("pid = $pid AND uid = $uid")->first(); // kiểm tra sản phẩm có trong giỏ hàng hay chưa
            if (!$code) { // chưa có trong giỏ hàng
                Cart::create([
                    'pid' => $pid,
                    'name' => $pname,
                    'price' => $pprice,
                    'image' => $pimage,
                    'qty' => $pqty,
                    'total' => $total_price,
                    'uid' => $uid
                ]);
                \App\Helpers\Helper::alert_success2('<br>Đã thêm sản phẩm vào giỏ hàng<strong> thành công!</strong>');
            } else {
                \App\Helpers\Helper::alert_error2('<br>Sản phẩm đã có trong giỏ hàng!');
            }
        } else {
            \App\Helpers\Helper::alert_error2('<br>Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
        }
    }



    public function clearAllCart()
    {
        \App\Helpers\Helper::showAlert();
        $uid = Auth::user()->id;
        $check = Cart::whereRaw("uid = $uid")->first();
        if ($check) {
            Cart::whereRaw("uid = $uid")->delete();
            return redirect(route('home'))->withSuccessMessage('Xóa giỏ hàng thành công.');
        } else {
            return redirect(route('home'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
    }

    public function changeQty(Request $request)
    {
        \App\Helpers\Helper::showAlert();
        $uid = Auth::user()->id;
        $qty = $request->input('qty');
        $pid = $request->input('pid');
        $pprice = $request->input('pprice');
        $tprice = $qty * $pprice;
        $id = $request->input('procid');
        $data = Products::where([['id', $id], ['status', 1]])->first();
        if ($qty <= 0) {
            return redirect(route('cart'))->withErrorMessage('Vui lòng chọn số lượng.');
        }
        if ($qty > $data->amount) {
            return redirect(route('cart'))->withErrorMessage('Không đủ số lượng. Chỉ có ' . $data->amount . ' sản phẩm trong kho');
        }
        Cart::whereRaw("id = $pid AND uid = $uid")->update([
            'qty' => $qty,
            'total' => $tprice,
        ]);
    }


    public function change(Request $request)
    {
        \App\Helpers\Helper::showAlert();
        $uid = Auth::user()->id;
        $pid = $request->input('pid');
        $pprice = $request->input('pprice');
        $qty = $request->input('pqty');
        $tprice = $qty * $pprice;
        $data = Products::where([['id', $pid], ['status', 1]])->first();
        if ($qty <= 0) {
            // return redirect(route('home'))->withErrorMessage('Vui lòng chọn số lượng.');
        }
        if ($qty > $data->amount) {
            return redirect(route('cart'))->withErrorMessage('Không đủ số lượng. Chỉ có ' . $data->amount . ' sản phẩm trong kho');
        }
        Cart::whereRaw("pid = $pid AND uid = $uid")->update([
            'qty' => $qty,
            'total' => $tprice
        ]);
    }

    public function changecart()
    {
        \App\Helpers\Helper::showAlert();
        $uid = Auth::user()->id;
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $pprice = $_POST['pprice'];
        $tprice = $qty * $pprice;
        $data = Products::where([['id', $pid], ['status', 1]])->first();
        if ($qty <= 0) {
            return redirect(route('home'))->withErrorMessage('Vui lòng chọn số lượng.');
        }
        if ($qty > $data->amount) {
            return redirect(route('cart'))->withErrorMessage('Không đủ số lượng. Chỉ có ' . $data->amount . ' sản phẩm trong kho');
        }
        Cart::whereRaw("pid = $pid AND uid = $uid")->update([
            'qty' => $qty,
            'total' => $tprice
        ]);
        \App\Helpers\Helper::alert_success2('Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function deleteCart()
    {
        \App\Helpers\Helper::showAlert();
        $uid = Auth::user()->id; // id người dùng
        $id = request()->id; // lấy id sản phẩm
        $check = Cart::whereRaw("id = $id AND uid = $uid")->first();
        if ($check) {
            Cart::whereRaw("id = $id AND uid = $uid")->delete();
            return redirect(route('cart'))->withSuccessMessage('Xóa sản phẩm thành công.');
        } else {
            return redirect(route('home'))->withErrorMessage('Không tìm thấy sản phẩm.');
        }
    }

    public function checkout()
    {
        $uid = Auth::user()->id;
        $data = Cart::whereRaw("uid = $uid")->get();
        if ($data->isNotEmpty()) {
            $sum = Cart::whereRaw("uid = $uid")->sum('total');
        } else {
            return redirect(route('cart'))->withErrorMessage('Vui lòng chọn số lượng.');
        }
        return view('clients.cart.checkout', compact('data', 'sum'));
    }

    public function postCheckout(Request $request)
    {
        $date = now('Asia/Ho_Chi_Minh'); // lấy ngày giờ hiện tại của Ho_Chi_Minh
        $create = Invoice::create([
            'uid' => Auth::user()->id, //id người dùng
            'email' => $request->email, //email
            'phone' => $request->phone,
            'name' => $request->name,
            'status' => 0, // trạng thái mặc định 0 -> chưa thanh toán, 1-> đã thanh toán, 2 hủy
            'address' => $request->address,
            'note' => $request->note,
            'created_at' => $date
        ]);
        $order_id = $create->id;
        if ($create) {
            $data = Cart::where('uid', Auth::user()->id)->get(); // lấy thông tin trong giỏ hàng
            $count = $data->count();
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    InvoiceItem::create([
                        'order_id' => $order_id,
                        'pid' => $data[$i]['pid'],
                        'name' => $data[$i]['name'],
                        'qty' => $data[$i]['qty'],
                        'price' => $data[$i]['price'],
                        'status' => 0,
                        'total' => $data[$i]['total']
                    ]);
                    Products::where('id', $data[$i]['pid'])->decrement('amount', $data[$i]['qty']);
                }

                // gửi mail
                $subject = "Hóa đơn INV$order_id đã được tạo";
                $hoten = 'Khách hàng';
                $guitoi = $request->email;
                $name = $request->name;
                $total = 0;
                $uid = Auth::user()->id;
                $viewName = 'clients.emails.invoice';

                $item = InvoiceItem::where([['invoice_order_item.order_id', $order_id]])
                    ->join('invoice_order', 'invoice_order.id', '=', 'invoice_order_item.order_id')->get();
                foreach ($item as $row) {
                    $total += $row->total;
                }

                $content = [
                    'name' => $request->name,
                    'inv' => $order_id,
                    'date' => date("d-m-Y", strtotime($date)),
                    'total' => \App\Helpers\Helper::format_number($total),
                ];

                \App\Helpers\Helper::sendMail($guitoi, $hoten, $subject, $viewName, $content);

                 Cart::where('uid', Auth::user()->id)->delete(); // xóa giỏ hàng
            } else {
                return redirect(route('cart'))->withErrorMessage('Vui lòng chọn sản phẩm trước khi thanh toán.');
            }
            return redirect(route('invoice', ['id' => $order_id]))->withSuccessMessage('Tạo hóa đơn thành công.');
        }
    }

    public function invoice()
    {

        $uid = Auth::user()->id; // id người dùng
        $role = Auth::user()->role; // lấy role

        if (request()->id) {
            // người tạo hóa đơn, admin sẽ xem được hóa đơn
            // người không phải admin, không phải người tạo => không xem được
            $id = request()->id;
            $data = Invoice::whereRaw("invoice_order.id = $id")
                ->join('invoice_order_item', 'invoice_order_item.order_id', '=', 'invoice_order.id')
                ->select('invoice_order_item.*', 'invoice_order.*', 'invoice_order.id as ioid');

            // Kiểm tra nếu người dùng là admin, bỏ qua điều kiện uid
            if ($role == 1) { // admin
                $data = $data->first();
            } else {
                $data = $data->where('invoice_order.uid', $uid)->first();
            }

            $item = Invoice::whereRaw("invoice_order.id = $id")
                ->join('invoice_order_item', 'invoice_order_item.order_id', '=', 'invoice_order.id')
                ->select('invoice_order_item.*', 'invoice_order.*', 'invoice_order.id as ioid', 'invoice_order_item.name as pname')->get();

            $sum = InvoiceItem::whereRaw("invoice_order_item.order_id = $id")->sum('total');
            if ($data) {
                $title = "Hóa đơn #" . '' . $data->ioid . '';
                return view("clients.cart.invoice", compact('data', 'item', 'sum', 'title'));
            } else {
                return redirect(route('home'))->withErrorMessage('Không có quyền xem hóa đơn này!');
            }
        } else {
            return redirect(route('home'))->withErrorMessage('Không có quyền xem hóa đơn này!');
        }

    }
}
