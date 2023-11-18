<?php

namespace App\Helpers;

use App\Models\Setting;
use DateTime;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Helper
{
    // Hàm kiểm tra xem có thông báo lỗi được lưu trong phiên hay không. Nếu có, hàm sẽ lấy ra giá trị của biến $errors từ phiên và kiểm tra xem nó có phải là một đối tượng Illuminate\Support\MessageBag hay không. Nếu đúng, hàm sẽ gọi phương thức all() của đối tượng $errors để lấy ra tất cả các thông báo lỗi dưới dạng một mảng và sau đó nối chúng lại thành một chuỗi HTML với các phần tử được ngăn cách nhau bởi thẻ <br>. Nếu biến $errors không phải là một đối tượng MessageBag, hàm sẽ chuyển đổi nó thành chuỗi bằng cách sử dụng hàm var_export(). Cuối cùng, hàm hiển thị thông báo lỗi bằng cách gọi phương thức html() của đối tượng alert() và truyền vào tiêu đề, nội dung và loại thông báo.
    public static function showAlert()
    {
        $error_count = 0;
        if (session('success_message')) {
            alert()->success('Thành công!', session('success_message'));
        }
        if (session('error_message')) {
            $errors = session('error_message');
            if ($errors instanceof \Illuminate\Support\MessageBag) {
                foreach ($errors->all() as $error) {
                    alert()->html('Lỗi', $error, 'error');
                }
            } elseif (is_string($errors)) {
                alert()->html('Lỗi', $errors, 'error');
            } else {
                alert()->html('Lỗi', var_export($errors, true), 'error');
            }
        }
    }

    public static function sendMail($to,$name, $subject,$viewName, $data = [])
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Debugoutput = "html";
            $mail->Host = env('MAIL_HOST'); // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = env('MAIL_USERNAME'); // SMTP username
            $mail->Password = env('MAIL_PASSWORD'); // SMTP password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls'); // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = env('MAIL_PORT'); // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to, $name); // Name is optional
            $mail->addReplyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $view = view($viewName, $data);
            $mail->Subject = $subject;
            $mail->Body = $view->render();
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function uploadImage($file, $folderName)
    {
        $extension = $file->getClientOriginalExtension(); // lấy đuôi ảnh ex: .png
        if (in_array($extension, ['png', 'jpg', 'gif', 'jpeg', 'webp'])) {
            //random tên ex: 28367333.png
            $filename = Str::random(10) . '.' . $extension;
            // đường dẫn upload
            $path = base_path('public/assets/clients/uploads/' . $folderName);
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
            //upload
            $file->move($path, $filename);
            return $filename;
        }
        return null;
    }

    public static function uploadMultipleImages($files, $folderName)
    {
        $uploadedFiles = array();

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension(); // lấy đuôi ảnh ex: .png
            if (in_array($extension, ['png', 'jpg', 'gif', 'jpeg', 'webp'])) {
                //random tên ex: 28367333.png
                $filename = Str::random(10) . '.' . $extension;
                // đường dẫn upload
                $path = base_path('public/assets/clients/uploads/' . $folderName);
                if (!File::exists($path)) {
                    File::makeDirectory($path);
                }
                //upload
                $file->move($path, $filename);
                $uploadedFiles[] = $filename;
            }
        }
        return $uploadedFiles;
    }



    public static function category()
    {
        //lấy hết dữ liệu category
        $data = Category::get();
        $html = '';
        foreach ($data as $key => $menu) {
            $html .= '<li><a class="nav-link nav_item" href="' . route('category/{slug}', ['slug' => $menu->slug]) . '">' . $menu->name . '</a></li>';
        }
        return $html;
    }

    public static function site($data)
    {
        $row = Setting::where('key', $data)->first();
        return $row['value'];
    }

    public static function format_number($price)
    {
        return str_replace(",", ".", number_format($price));
    }

    static function format_date($date_string)
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_string);
        return $date->format('d-m-Y H:i:s');
    }

    static function alert_success2($text)
    {
        return '<script type="text/javascript">$.notify({
        title: "<strong>Giỏ hàng</strong>",
        message: "' . $text . '",
        icon: "glyphicon glyphicon-ok"
    }, {
        element: "body",
        type: "success",
        showProgressbar: true,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 1300,
        timer: 1000,
        url_target: "_blank",
        mouse_over: null,
        animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutRight"
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: "class",
    });</script>';
    }

    static function alert_error2($text)
    {
        return '<script type="text/javascript">$.notify({
        title: "<strong>Giỏ hàng</strong>",
        message: "' . $text . '",
        icon: "glyphicon glyphicon-remove-sign"
    }, {
        element: "body",
        type: "danger",
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 1300,
        timer: 1000,
        url_target: "_blank",
        mouse_over: null,
        animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutRight"
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: "class",
    });</script>';
    }




}
