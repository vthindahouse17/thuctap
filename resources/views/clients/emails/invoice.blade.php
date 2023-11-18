<div
    style="background-color:#f4ecec; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
    <div style="padding: 1px 0px 25px 0px; margin:0px auto; max-width: 600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
            style="border-collapse:collapse;MARGIN-TOP: 27PX;background-color: #ffffff;border-radius: 24px;">
            <tbody>
                <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">
                        <div style="padding-top:20px;text-align:center; margin:0 60px 34px 60px">
                            <!--begin:Logo-->
                            <div style="margin-bottom: 10px">
                                <a href="{{ route('home') }}" rel="noopener" target="_blank">
                                    <img alt="Shop" src="https://i.imgur.com/vuIbKca.png" style="height:35px" />
                                </a>
                            </div>
                            <div style="margin-bottom: 15px">

                            </div>

                            <div
                                style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                <p style="margin-bottom:9px; color:#181C32; font-size: 18px; font-weight:700">Xin chào
                                    {{$name}},
                                    Đây là tin nhắn từ Shop !</p>
                                <p style="margin-bottom:2px; color:#7E8299">Chúng tôi đã chuẩn bị hóa đơn sau cho bạn:
                                    <b>#INV{{$inv}}</b>
                                </p>
                                <p style="margin-bottom:2px; color:#7E8299">Ngày tạo hóa đơn: {{$date}}</p>

                                <p style="margin-bottom:2px; color:#7E8299">Trạng thái hóa đơn: <b>Chưa thanh toán</b> .
                                </p>

                                <p style="margin-bottom:2px; color:#7E8299">Tổng tiền: <b>{{$total}}đ</b> .</p>

                                <p style="margin-bottom:2px; color:#7E8299">Bạn có thể xem chi tiết hóa đơn ở bên dưới:
                                </p>
                            </div>
                            <a href="{{ route('invoice', ['id' => $inv]) }}"
                                style="background-color:#ff4c3b; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:700; font-family:Arial,Helvetica,sans-serif;text-decoration:none;">Xem
                                hóa đơn</a>

                        </div>
                    </td>
                </tr>
                <tr style="display: flex; justify-content: center; margin:0 60px 35px 60px">
                    <td align="start" valign="start" style="padding-bottom: 10px;">
                        <p style="color:#181C32; font-size: 18px; font-weight: 600; margin-bottom:13px">Bạn đã thanh
                            toán, nhưng vẫn
                            thấy hóa đơn này?</p>
                        <div style="background: #F9F9F9; border-radius: 12px; padding:5px 30px">
                            <div style="display:flex">
                                <div>
                                    <div>
                                        <p
                                            style="color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif">
                                            Nếu bạn có bất kỳ thắc mắc nào, hãy cho chúng tôi biết.</p>
                                        <p
                                            style="color:#5E6278; font-size: 13px; font-weight: 500; margin:0;font-family:Arial,Helvetica,sans-serif">
                                            <a href="https://facebook.com/thanhson1711"
                                                style="text-decoration: none;">vthindahouse</a>
                                        </p>
                                    </div>
                                    <div class="separator separator-dashed" style="margin:17px 0 15px 0"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="center"
                        style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                        <p style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px">Chăm sóc khách
                            hàng</p>
                        <p style="margin-bottom:2px">Số điện thoại: +84349065773</p>
                        <p style="margin-bottom:4px">Mail:
                            <a href="https://google.com" rel="noopener" target="_blank"
                                style="font-weight: 600;text-decoration: none;">vuthehau01@gmail.com</a>.
                        </p>
                        <p>Thời gian làm việc 7:00 - 20:00</p>
                    </td>
                </tr>
                <tr style="line-height:35px;">
                    <td align="center" valign="center"
                        style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                        <p>&copy; Copyright by
                            <a href="https://facebook.com/thanhson1711" rel="noopener" target="_blank"
                                style="font-weight: 600;font-family:Arial,Helvetica,sans-serif;text-decoration: none;">Vũ Thế
                                Hậu</a>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
