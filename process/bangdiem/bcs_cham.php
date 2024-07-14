<?php 
    if(!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH']) && !isset($_SESSION['BCS']) && !isset($_SESSION['STUDENT'])){
        echo '<script>window.location.href = "./login/index.php";</script>';
    }
    $idsv = $_GET['idsv'];
    $getsv = $sinhvien->SinhVienGetById($idsv);
    
    require './database/bangdiemCls.php';
    require './database/diemtcCls.php';
    require './database/diemtcctCls.php';
    $bangdiem = new Bangdiem();
    $diemtc = new DiemTC();
    $diemtcct = new DiemTCCT();

    $getcheck =  $bangdiem->BangdiemGetbyCheckBoth(1,1);
    $getdiemofsv = null;
    if($getcheck != null){
        $getdiemofsv = $bangdiem->BangdiemGetbyIdSVAndNHAndHK($getsv->ID_SV, $getcheck->NAMHOC, $getcheck->HOCKY);
    }
    if($getdiemofsv != null){
        $getdiemtc = $diemtc->DiemTCGetbyIdBD($getdiemofsv->ID_BD);
        $getdiemtcct = $diemtcct->DiemTCCTGetbyIdBD($getdiemofsv->ID_BD);
    }
?>
<div class="get-sv" value="<?php echo $getsinhvien != null ? $getsinhvien->ID_SV : ""; ?>"></div>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>BCS CHẤM ĐIỂM RÈN LUYỆN CHO SINH VIÊN : <?php echo $getsv->MASOSV . " - " . $getsv->HOTEN; ?></div>
</div>
<form class="form-score" action="./process/bangdiem/bangdiemAct.php?reqact=updateByBCS&idbd=<?php echo $getdiemofsv->ID_BD; ?>" method="POST" enctype="multipart/form-data">
    <div class="score">
        <?php 
            if($getdiemofsv != null && $getdiemofsv->TONGDIEMSV != null && $getdiemofsv->TONGDIEMLOP == null && $getdiemofsv->TONGDIEMKHOA == null){
        ?>
            <div class="raise-tb">Sinh viên đã hoàn thành</div>
        <?php
            }
            if($getdiemofsv != null && $getdiemofsv->TONGDIEMLOP != null  && $getdiemofsv->TONGDIEMKHOA == null){
        ?>
            <div class="raise-tb">Lớp đã hoàn thành</div>
        <?php
            }
            if($getdiemofsv != null && $getdiemofsv->TONGDIEMLOP != null && $getdiemofsv->TONGDIEMKHOA != null){
        ?>
            <div class="raise-tb">Khoa đã hoàn thành</div>
        <?php
            }
        ?>
        <div class="score-top" style="text-align: center; margin-right: 10px;">
        <?php 
            if($getcheck == null){
        ?>
                CHƯA MỞ BẢNG ĐIỂM MỚI
                <div style="margin-top: 10px;"><button class="watch-old">Xem Bảng Điểm Cũ</button></div>
        <?php
            }
            else{
                $tn = new DateTime($getcheck->TUNGAY);
                $tungay = $tn->format('d-m-Y');
                $dn = new DateTime($getcheck->DENNGAY);
                $denngay = $dn->format('d-m-Y');
        ?>
                SINH VIÊN TỰ CHẤM ĐIỂM RÈN LUYỆN
                <div>HỌC KỲ <?php echo $getcheck->HOCKY; ?></div>
                <div>NĂM HỌC <?php echo $getcheck->NAMHOC; ?></div>
                <div>Thời gian thực hiện từ ngày <span><?php echo $tungay; ?></span> đến hết ngày <span><?php echo $denngay; ?></span></div>
        <?php
            }
        ?> 
        </div>
        <hr style="width: 100%;">
        <div class="score-body">
            <table class="table-score">
                <thead style="font-size: 18px;">
                    <th>Nội Dung Đánh Giá</th>
                    <th style="padding-left: 40px;">Thang Điểm</th>
                    <th>
                        Minh Chứng 
                        <p>(Nếu Có)</p>
                    </th>
                    <th>Sinh Viên Đánh Giá</th>
                    <th>Lớp Đánh Giá</th>
                    <th>Khoa Đánh Giá</th>
                </thead>
                <tbody>
                    <tr style="font-weight: bold;">
                        <td>1. Đánh giá về ý thức tham gia học tập</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>1.1 Điểm cộng </td>
                        <td>+20 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>
                            1.1.1 Đi học chuyên cần, đúng giờ, nghiêm túc trong giờ học; chuẩn bị bài tốt, đóng góp ý kiên xây dựng bài, thảo luận nhóm; đánh giá của lớp về tinh thần vượt khó, phấn đấu vươn lên trong học tập; 
                        </td>
                        <td>
                            <p>5 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td>

                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[0]->TONGDIEMSV : ""; ?>" class="sv-111" name="sv-111" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[0]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-111" name="lop-111" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[0]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-111" name="khoa-111" type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.1.2 Thành viên các câu lạc bộ, đội nhóm về học thuật, nghiên cứu khoa học… 
                            <p>- Thành viên</p>       
                            <p>- Thành viên tích cực </p>           
                        </td>
                        <td>
                            <p>2 điểm</p>
                            <p>4 điểm</p>
                        </td>
                        <td>

                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[1]->TONGDIEMSV : ""; ?>"  class="sv-112" name="sv-112" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[1]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-112" name="lop-112" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[1]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-112" name="khoa-112" type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.1.3 Tham dự các buổi hội thảo, tọa đàm, báo cáo chuyên đề, huấn luyện kỹ năng, khảo sát đánh giá, sinh hoạt, giao lưu, trao đổi… về học tập, nghiên cứu khoa học; các cuộc thi về học thuật 
                            (có danh sách đăng kí, danh sách triệu tập tham gia,…và được BTC đề xuất cộng điểm)
                        </td>
                        <td>
                            2 điểm/lần
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi test">
                                    <input type="file" name="files113[]" accept="image/*" multiple id="file113">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-113"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[2]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[2]->TONGDIEMSV : ""; ?>"  name="sv-113" class="sv-113" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[2]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  name="lop-113" class="lop-113" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[2]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> name="khoa-113" class="khoa-113" type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.1.4 Tham gia các cuộc thi học thuật trong và ngoài trường (dự thi, được BTC xác nhận). 
                            <p>- Cấp trường</p>
                            <p>- Cấp khoa/ngoài trường</p>
                            <p>- Cấp chi/lớp</p>
                        </td>
                        <td>
                            <p>4 điểm</p>
                            <p>3 điểm</p>
                            <p>2 điểm</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files114[]" accept="image/*" multiple id="file114">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-114"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[3]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>               
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[3]->TONGDIEMSV : ""; ?>"  class="sv-114" type="number" name="sv-114" id="">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[3]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-114" type="number" name="lop-114" id="">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[3]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-114" type="number" name="khoa-114" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.1.5 Thành viên đội tuyển học thuật, thanh viên BTC các cuộc thi học thuật trong trường.
                        </td>
                        <td>
                            5 điểm/lần
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files115[]" accept="image/*" multiple id="file115">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-115"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[4]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>  
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[4]->TONGDIEMSV : ""; ?>"  class="sv-115" name="sv-115" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[4]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-115" name="lop-115" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[4]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-115" name="khoa-115" type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.1.6 Đạt giải cuộc thi học thuật:
                            <p>
                                - Cấp thành và tương đương
                            </p>
                            <p>
                                - Cấp trường
                            </p>
                            <p>
                                - Cấp khoa/ngoài trường
                            </p>
                        </td>
                        <td>
                            <p>
                                8 điểm/giải
                            </p>
                            <p>
                                6 điểm/giải
                            </p>
                            <p>
                                4 điểm/giải
                            </p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files116[]" accept="image/*" multiple id="file116">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-116"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[5]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>  
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[5]->TONGDIEMSV : ""; ?>"  class="sv-116" name="sv-116" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[5]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-116" name="lop-116" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[5]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-116" name="khoa-116" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            1.1.7 Thực hiện nghiên cứu khoa học:
                            <p>- Hoàn thành đề cương đề tài</p>
                            <p>- Bảo vệ đề tài đề cấp khoa</p>
                            <p>- Bảo vệ đề tài cấp trường</p>
                        </td>
                        <td>
                            <p>3 điểm</p>
                            <p>5 điểm</p>
                            <p>8 điểm</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files117[]" accept="image/*" multiple id="file117">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-117"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[6]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[6]->TONGDIEMSV : ""; ?>"  class="sv-117" name="sv-117" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[6]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-117" name="lop-117" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[6]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-117" name="khoa-117" type="number"></td>
                    </tr>
                    <tr>
                        <td>1.1.8 Có bài viết được đăng báo, tạp chí KHPL, kỷ yếu  hội nghị, hội thảo, tham luận, báo cáo chuyên đề liên quan đến hoạt động học thuật</td>
                        <td>5 điểm/bài</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files118[]" accept="image/*" multiple id="file118">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-118"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[7]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[7]->TONGDIEMSV : ""; ?>"  class="sv-118" name="sv-118" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[7]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  name="lop-118" class="lop-118" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[7]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> name="khoa-118" class="khoa-118" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            1.1.9 Kết quả học tập: (Thang điểm 4)
                            <p>- Khá</p>
                            <p>- Giỏi</p>
                            <p>- Xuất sắc</p>
                        </td>
                        <td>
                            <p>3 điểm</p>
                            <p>5 điểm</p>
                            <p>8 điểm</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[8]->TONGDIEMSV : ""; ?>"  class="sv-119" name="sv-119" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[8]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  name="lop-119" class="lop-119" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[8]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> name="khoa-119" class="khoa-119" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>1.2 Điểm trừ</td>
                        <td>
                            - 20 điểm 
                            <p>(tối đa)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1.2.1 Bị xử lý kỷ luật trong các kỳ thi kết thúc học phần: 
                            <p>- Khiển trách</p>
                            <p>- Cảnh cáo</p>
                            <p>- Đình chỉ thi</p>
                        </td>
                        <td>
                            <p>-10 điểm</p>
                            <p>-15 điểm</p>
                            <p>-20 điểm</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[9]->TONGDIEMSV : ""; ?>"  class="sv-121" name="sv-121" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[9]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  name="lop-121" class="lop-121" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[9]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> name="khoa-121" class="khoa-121" type="number"></td>
                    </tr>
                    <tr>
                        <td>1.2.2 Có hành vi gây ảnh hưởng xấu đến công tác tổ chức các hoạt động học thuật, học tập. (Tùy vào mức độ gây ảnh hưởng, BTC các hoạt động đề xuất điểm trừ) </td>
                        <td>
                            -10điểm
                            <p>(tối đa)
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[10]->TONGDIEMSV : ""; ?>"  class="sv-122" name="sv-122" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[10]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> name="lop-122" class="lop-122" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[10]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> name="khoa-122" class="khoa-122" type="number"></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 1 </td>
                        <td>
                            <p>20 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[0]->TONGDIEMSV : ""; ?>"  readonly class="sv-1" name="sv-1"  type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[0]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  readonly class="lop-1" name="lop-1" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[0]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-1" name="khoa-1" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>2. Đánh giá về ý thức chấp hành nội quy, quy chế, quy định</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>2.1 Điểm cộng </td>
                        <td>+25 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>
                            2.1.1 Ý thức chấp hành các văn bản chỉ đạo của ngành, của cơ quan chỉ đạo cấp trên được thực hiện trong cơ sở giáo dục đại học, các quy định, nội quy, quy chế trong nhà trường.
                        </td>
                        <td>
                            <p>5 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td>

                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[11]->TONGDIEMSV : ""; ?>"  class="sv-211" name="sv-211" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[11]->TONGDIEMLOP : ""; ?>"  <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-211" name="lop-211" type="number">
                        </td>
                        <td>
                            <input value="<?php echo $getdiemtcct != null ? $getdiemtcct[11]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-211" name="khoa-211" type="number">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2.1.2 Tham gia các buổi sinh hoạt lớp, chi đoàn, chi hội, các hoạt động được triệu tập: 
                            <p>- Buổi sinh hoạt lớp: <span>3điểm/lần,</span></p>
                            <p>- Sinh hoạt Chi đoàn, Chi hội: <span>3điểm/lần.</span></p>
                            <p>- Sinh hoạt chính trị, Sinh hoạt Chi đoàn chủ điểm: <span>3điểm/lần.</span></p>
                        </td>
                        <td>
                            <p>20 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td>

                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[12]->TONGDIEMSV : ""; ?>"  class="sv-212" name="sv-212" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[12]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-212" name="lop-212" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[12]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-212" name="khoa-212" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>2.2 Điểm trừ</td>
                        <td>
                            - 25 điểm 
                            <p>(tối đa)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2.2.1 Không khai thông tin ngoại trú theo quy định.
                        </td>
                        <td>
                            <p>-10 điểm</p>
                        </td>
                        <td>

                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[13]->TONGDIEMSV : ""; ?>"  class="sv-221" name="sv-221" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[13]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-221" name="lop-221" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[13]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-221" name="khoa-221" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            2.2.2 Vi phạm các quy định về an toàn giao thông.
                        </td>
                        <td>
                            <p>-10 điểm/lần</p>
                        </td>
                        <td>

                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[14]->TONGDIEMSV : ""; ?>"  class="sv-222" name="sv-222" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[14]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-222" name="lop-222" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[14]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-222" name="khoa-222" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            <p>2.2.3 Vi phạm nội quy trường học:(Những hành vi chưa đến mức bị xử lý kỷ luật)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>2.2.3 Vi phạm nội quy trường học:(Những hành vi chưa đến mức bị xử lý kỷ luật)</p>
                            <p>- Không đeo bảng tên khi đên trường</p>
                            <p>- Trang phục không phù hợp khi đến trường</p>
                            <p>- Gây ôn ào, mất trật tự làm ảnh hưởng đến giờ học</p>
                            <p>- Uống rượu, Hút thuốc lá trong khuôn viên trường</p>
                            <p>- Làm bẩn, mất vệ sinh dưới mọi hình thức, lên các trang thiết bị như: bàn, ghế, bảng viết, màn chiếu, trường, sàn, cửa…;</p>
                            <p>- Tự ý di chuyển trang thiết bị, tài sản ra khỏi vị trí đã sắp xếp, lắp đặt trong phòng. Đứng lên bàn ghế, leo trèo hoặc ngồi trên lan can, khung cửa sổ;</p>
                            <p>- Sao in và phát hành các loại giáo trình, tài liệu học tập trái với các quy định của Nhà trường.(chưa đến mức bị xử lý kỷ luật)</p>
                        </td>
                        <td>
                            <p>-3 điểm/lần</p>
                            <p>-5 điểm/lần</p>
                            <p>-5 điểm/lần</p>
                            <p>-5 điểm/lần</p>
                            <p>-5 điểm/lần</p>
                            <p>-10 điểm/lần</p>
                            <p>-20 điểm/lần</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[15]->TONGDIEMSV : ""; ?>"  class="sv-223" name="sv-223" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[15]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-223" name="lop-223" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[15]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-223" name="khoa-223" type="number"></td>
                    </tr>
                    <tr>
                        <td>2.2.4 Vi phạm nội quy thư viện ở mức độ: Nhắc nhở, phê bình, khóa thẻ thư viện...</td>
                        <td>-5 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[16]->TONGDIEMSV : ""; ?>"  class="sv-224" name="sv-224" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[16]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-224" name="lop-224" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[16]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-224" name="khoa-224" type="number"></td>
                    </tr>
                    <tr>
                        <td>2.2.5 Không tham gia các buổi sinh hoạt lớp, chi đoàn, chi hội; các buổi phân công trực do Khoa, lớp phân công…</td>
                        <td>-3 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[17]->TONGDIEMSV : ""; ?>"  class="sv-225" name="sv-225" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[17]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-225" name="lop-225" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[17]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-225" name="khoa-225" type="number"></td>
                    </tr>
                    <tr>
                        <td>2.2.6 Không tham gia các buổi sinh hoạt được Nhà trường, Đoàn trường, Hội sinh viên triệu tập.</td>
                        <td>-5 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[18]->TONGDIEMSV : ""; ?>"  class="sv-226" name="sv-226" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[18]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-226" name="lop-226" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[18]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-226" name="khoa-226" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            2.2.7
                            <p>- Trong thời gian sinh viên bị kỷ luật mức khiển trách, khi đánh giá kết quả rèn luyện không được vượt quá loại khá.</p>
                            <p>- Trong thời gian sinh viên bị kỷ luật mức cảnh cáo, khi đánh giá kết quả rèn luyện không được vượt quá loại trung bình.</p>
                        </td>
                        <td></td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[19]->TONGDIEMSV : ""; ?>"  class="sv-227" name="sv-227" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[19]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-227" name="lop-227" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[19]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-227" name="khoa-227" type="number"></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 2 </td>
                        <td>
                            <p>25 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[1]->TONGDIEMSV : ""; ?>"  readonly class="sv-2" name="sv-2" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[1]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  readonly class="lop-2" name="lop-2" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[1]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-2" name="khoa-2" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>3. Đánh giá về ý thức tham gia các hoạt động chính trị, xã hội, văn hóa, văn nghệ, thể thao, phòng chống tội phạm và các tệ nạn xã hội</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>3.1 Điểm cộng </td>
                        <td>+20 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>
                            3.1.1 Thành viên các câu lạc bộ, đội nhóm văn hóa, văn nghệ, thể thao, tình nguyện, công tác xã hội.
                            <p>- Thành viên.</p>
                            <p>- Thành viên tích cực</p>
                        </td>
                        <td>
                            <p>2 điểm</p>
                            <p>4 điểm</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files311[]" accept="image/*" multiple id="file311">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-311"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[20]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[20]->TONGDIEMSV : ""; ?>"  class="sv-311" name="sv-311" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[20]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-311" name="lop-311" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[20]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-311" name="khoa-311" type="number"></td>
                    </tr>
                    <tr>
                        <td>3.1.2 Tham dự (cỗ vũ, cổ động…) các hoạt động rèn luyện về chính trị, xã hội, văn hóa, văn nghệ, thể thao. (Theo chương trình được duyệt và BTC đề xuất cộng điểm)</td>
                        <td>2 điểm/lần</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files312[]" accept="image/*" multiple id="file312">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-312"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[21]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[21]->TONGDIEMSV : ""; ?>"  class="sv-312" name="sv-312" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[21]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-312" name="lop-312" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[21]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-312" name="khoa-312" type="number"></td>
                    </tr>
                    <tr>
                        <td>3.1.3 Tham gia (thí sinh, vận động viên,…) các hoạt động rèn luyện về chính trị, xã hội, văn hóa, văn nghệ, thể thao…</td>
                        <td>3 điểm/lần</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files313[]" accept="image/*" multiple id="file313">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-313"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[22]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                       
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[22]->TONGDIEMSV : ""; ?>"  class="sv-313" name="sv-313" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[22]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?>  class="lop-313" name="lop-313" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[22]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-313" name="khoa-313" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            3.1.4 Thành viên đội tuyển, thanh viên BTC các cuộc thi, các giải phong trào hoạt động văn hóa, văn nghệ, thể thao, phòng chống tội phạm và các tệ nạn xã hội:
                            <p>- Thành viên đội tuyển các cuộc thi</p>
                            <p>- Thành viên BTC các hoạt động cấp lớp</p>
                            <p>- Thành viên BTC các hoạt động cấp khoa, cấp trường trở lên diễn ra trong ngày/ngắn ngày</p>
                            <p>- Thành viên BTC các hoạt động cấp khoa, cấp trường trở lên, diễn ra nhiều ngày</p>
                        </td>
                        <td>
                            <p>4 điểm/lần</p>
                            <p>3 điểm/lần</p>
                            <p>4 điểm/lần</p>
                            <p>5 điểm/lần</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files314[]" accept="image/*" multiple id="file314">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-314"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[23]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                    
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[23]->TONGDIEMSV : ""; ?>" class="sv-314" name="sv-314" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[23]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-314" name="lop-314" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[23]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-314" name="khoa-314" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            3.1.5 Đạt giải các cuộc thi, các giải hoạt động văn hóa, văn nghệ, thể thao:
                            <p>- Cấp thành và tương đương</p>
                            <p>- Cấp Trường</p>
                            <p>- Cấp khoa/ngoài trường</p>
                        </td>
                        <td>
                            <p>8 điểm/giải</p>
                            <p>6 điểm/giải</p>
                            <p>4 điểm/giải</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files315[]" accept="image/*" multiple id="file315">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-315"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[24]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                              
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[24]->TONGDIEMSV : ""; ?>" class="sv-315" name="sv-315" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[24]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-315" name="lop-315" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[24]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-315" name="khoa-315" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            3.1.6 Tham gia tuyên truyền, phòng chống tội phạm và các tệ nạn xã hội. (Thành viên các đội, nhóm tuyên truyền có kế hoạch hoạt động cụ thể được đơn vị quản lý xét duyệt) 
                        </td>
                        <td>5 điểm/lần</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files316[]" accept="image/*" multiple id="file316">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-316"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[25]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                          
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[25]->TONGDIEMSV : ""; ?>" class="sv-316" name="sv-316" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[25]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-316" name="lop-316" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[25]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-316" name="khoa-316" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>3.2 Điểm trừ</td>
                        <td>
                            - 20 điểm 
                            <p>(tối đa)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>3.2.1 Đăng ký tham gia, dự thi các hoạt động rèn luyện về chính trị, xã hội, văn hóa, văn nghệ, thể thao, nhưng tự ý bỏ cuộc (không có lý do)</td>
                        <td>-4 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[26]->TONGDIEMSV : ""; ?>" class="sv-321" name="sv-321" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[26]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-321" name="lop-321" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[26]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-321" name="khoa-321" type="number"></td>
                    </tr>
                    <tr>
                        <td>3.2.2 Có hành vi gây ảnh hưởng xấu đến công tác tổ chức các hoạt động (tùy vào mức độ gây ảnh hưởng, BTC các hoạt động đề xuất điểm trừ)</td>
                        <td>-6 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[27]->TONGDIEMSV : ""; ?>" class="sv-322" name="sv-322" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[27]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-322" name="lop-322" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[27]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-322" name="khoa-322" type="number"></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 3 </td>
                        <td>
                            <p>20 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[2]->TONGDIEMSV : ""; ?>" readonly class="sv-3" name="sv-3" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[2]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> readonly class="lop-3" name="lop-3" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[2]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-3" name="khoa-3" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>4. Đánh giá về ý thức công dân trong quan hệ cộng đồng</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>4.1 Điểm cộng </td>
                        <td>+25 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>4.1.1 Chấp hành và tham gia tuyên truyền các chủ trương của Đảng, chính sách, pháp luật của Nhà nước trong cộng đồng.</td>
                        <td>
                            <p>5 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[28]->TONGDIEMSV : ""; ?>" class="sv-411" name="sv-411" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[28]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-411" name="lop-411" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[28]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-411" name="khoa-411" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            4.1.2 Nhận thức về các chủ trương của Đảng, chính sách, pháp luật của Nhà nước:
                            <p>- Kết quả bài thu hoạch tuần công dân sinh viên: điểm bài viết</p>
                            <p>- Học tập Nghị quyết của Đảng, Đoàn:  2điểm /lần</p>
                            <p>- 6 bài lý luận chính trị, 6 bài LLCT online:  2điểm/lần</p>
                            <p>- Đăng ký thực hiện Phong cách Sinh viên Luật: 2điểm</p>
                        </td>
                        <td>
                            <p>10 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[29]->TONGDIEMSV : ""; ?>" class="sv-412" name="sv-412" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[29]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-412" name="lop-412" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[29]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-412" name="khoa-412" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            4.1.3 Tham gia các hoạt động tình nguyện, công tác xã hội cấp lớp, Khoa, Câu lạc bộ đội nhóm, cấp trường:
                            <p>- Cấp trường: 10điểm/lần</p>
                            <p>- Cấp khoa: 5điểm/lần</p>
                            <p>- Cấp lớp: 3điểm/lần</p>
                            <p>- Ngoài trường: 2điểm/lần</p>
                            <p>- Quyên góp, hội thu cho các hoạt động tình nguyện, công tác xã hội (có kế hoạch hoạt động cụ thể được đơn vị quản lý xét duyệt): 2điểm/lần</p>
                        </td>
                        <td>
                            <p>10 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[30]->TONGDIEMSV : ""; ?>" class="sv-413" name="sv-413" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[30]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-413" name="lop-413" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[30]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-413" name="khoa-413" type="number"></td>
                    </tr>
                    <tr>
                        <td>4.1.4 Hoạt động giúp người, cứu người: Hiến máu nhân đạo; các hoạt động giúp người cứu người được tập thể lớp, các tổ chức đoàn thể trong và ngoài trường công nhận…</td>
                        <td>5 điểm/lần</td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[31]->TONGDIEMSV : ""; ?>" class="sv-414" name="sv-414" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[31]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-414" name="lop-414" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[31]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-414" name="khoa-414" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            4.1.5 Các hoạt động sinh viên tham gia hỗ trợ công tác của nhà trường:
                            <p>- Công tác đảm bảo trật tự và an toàn giao thông sinh viên: 3điểm/lần</p>
                            <p>- Hoạt động tư vấn tuyển sinh, hỗ trợ thí sinh nhập học: 3điểm/lần</p>
                            <p>- Hoạt động hỗ trợ tổ chức các ngày lễ của trường: 3điểm/lần</p>
                            <p>- Các hoạt động khác do Nhà trường cử: từ 3 – 5điểm/lần (tùy vào mức độ tham gia của sinh viên, BTC đề xuất mức điểm)</p>    
                        </td>
                        <td>
                            10 điểm
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[32]->TONGDIEMSV : ""; ?>" class="sv-415" name="sv-415" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[32]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-415" name="lop-415" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[32]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-415" name="khoa-415" type="number"></td>
                    </tr>
                    <tr>
                        <td>
                            4.1.6 Tham gia các hoạt động xã hội, giúp người, cứu người  được biểu dương, khen thưởng:
                            <p>- Cấp Thành</p>
                            <p>- Cấp trường và tương đương</p>
                            <p>- Cấp xã, phường, thị trấn</p>
                        </td>
                        <td>
                            <p>12điểm/gK</p>
                            <p>8điểm/gK</p>
                            <p>4điểm/gK</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files416[]" accept="image/*" multiple id="file416">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-416"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[33]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                           
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[33]->TONGDIEMSV : ""; ?>" class="sv-416" name="sv-416" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[33]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> class="lop-416" name="lop-416" type="number"></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[33]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> class="khoa-416" name="khoa-416" type="number"></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 4 </td>
                        <td>
                            <p>25 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[3]->TONGDIEMSV : ""; ?>" readonly class="sv-4" name="sv-4" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[3]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> readonly class="lop-4" name="lop-4" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[3]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-4" name="khoa-4" type="number"></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>5. Đánh giá về ý thức và kết quả khi tham gia công tác cán bộ lớp, các đoàn thể, tổ chức trong trường hoặc sinh viên đạt được thành tích đặc biệt trong học tập, rèn luyện</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>5.1 Điểm cộng </td>
                        <td>+10 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>
                            5.1.1 Thực hiện nhiệm vụ được phân công quản lý lớp, các tổ chức Đảng, Đoàn thanh niên, Hội sinh viên và các tổ chức khác trong trường.
                            <p>- Hoàn thành xuất sắc </p>
                            <p>- Hoàn thành tốt </p>
                            <p>- Hoàn thành </p>
                            <p>- Không hoàn thành </p>
                            <p style="font-style: italic;">(CVHT, Khoa: đáng giá BCS lớp;  Các tổ chức Đảng, Đoàn thanh niên, Hội sinh viên: đánh giá cán bộ đoàn thể)</p>
                        </td>
                        <td>
                            <p>10 điểm</p>
                            <p>7 điểm</p>
                            <p>5 điểm</p>
                            <p>0 điểm</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[34]->TONGDIEMSV : ""; ?>" type="number" class="sv-511" name="sv-511" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[34]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-511" name="lop-511" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[34]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-511" name="khoa-511" id=""></td>
                    </tr>
                    <tr>
                        <td>5.1.2 Sinh viên là cộng tác viên (thường xuyên) của các đơn vị trong trường, tổ chức đoàn thể có nhiều đóng góp trong công tác. Được các đơn vị, tổ chức đoàn thể xác nhận đánh giá công nhận.</td>
                        <td>
                            5 điểm
                            <p>(tối đa)</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files512[]" accept="image/*" multiple id="file512">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-512"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[35]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>    
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[35]->TONGDIEMSV : ""; ?>" type="number" class="sv-512" name="sv-512" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[35]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-512" name="lop-512" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[35]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-512" name="khoa-512" id=""></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>5.2 Điểm thưởng </td>
                        <td>+10 điểm <p>(tối đa)</p></td>
                    </tr>
                    <tr>
                        <td>5.2.1 Sinh viên đạt giải thưởng hoặc có giấy khen trong học tập, nghiên cứu khoa học cấp trường và trên cấp trường</td>
                        <td>10 điểm</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files513[]" accept="image/*" multiple id="file513">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-513"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[36]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                  
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[36]->TONGDIEMSV : ""; ?>" type="number" class="sv-513" name="sv-513" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[36]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-513" name="lop-513" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[36]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-513" name="khoa-513" id=""></td>
                    </tr>
                    <tr>
                        <td>5.2.2 Thành viên đội tuyển trường tham gia các cuộc thi, hội thi từ cấp tỉnh, thành phố trực thuộc trung ương trở lên đạt thành tích cao (Giải A, B, C, hoặc I, II, III, khuyến khích).</td>
                        <td>10 điểm</td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files514[]" accept="image/*" multiple id="file514">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-514"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[37]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?> 
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[37]->TONGDIEMSV : ""; ?>" type="number" class="sv-514" name="sv-514" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[37]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-514" name="lop-514" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[37]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-514" name="khoa-514" id=""></td>
                    </tr>
                    <tr>
                        <td>
                            5.2.3 Sinh viên đạt danh hiệu “Sinh viên 5 tốt”; “Thanh niên tiên tiến làm theo lời Bác” 
                            <p>- Cấp trường </p>
                            <p>- Cấp Thành, cấp Trung ương </p>
                        </td>
                        <td>
                            <p>5 điểm</p>
                            <p>10 điểm</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files515[]" accept="image/*" multiple id="file515">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-515"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[38]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                       
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[38]->TONGDIEMSV : ""; ?>" type="number" class="sv-515" name="sv-515" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[38]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-515" name="lop-515" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[38]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-515" name="khoa-515" id=""></td>
                    </tr>
                    <tr>
                        <td>
                            5.2.4 Sinh viên nhận giấy khen, bằng khen về công tác Đoàn Thanh niên, Hội Sinh viên, Hội Liên hiệp thanh niên. 
                            <p>- Cấp trường </p>
                            <p>- Cấp Thành, cấp Trung ương </p>
                        </td>
                        <td>
                            <p>5 điểm</p>
                            <p>10 điểm</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files516[]" accept="image/*" multiple id="file516">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-516"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[39]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                      
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[39]->TONGDIEMSV : ""; ?>" type="number" class="sv-516" name="sv-516" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[39]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-516" name="lop-516" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[39]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-516" name="khoa-516" id=""></td>
                    </tr>
                    <tr>
                        <td>
                            5.2.5 Tập thể lớp đạt danh hiệu trong công tác thi đua; Tập thể Chi đoàn, Chi hội, các CLB đội nhóm…nhận giấy khen, bằng khen về công tác Đoàn Thanh niên, Hội Sinh viên, Hội Liên hiệp thanh niên..
                            <p>- Cấp trường</p>
                            <p>- Cấp Thành và Trung ương</p>
                        </td>
                        <td>
                            <p>2 điểm/gK</p>
                            <p>4 điểm/gK</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi">
                                    <input type="file" name="files517[]" accept="image/*" multiple id="file517">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-517"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[40]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                          
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[40]->TONGDIEMSV : ""; ?>" type="number" class="sv-517" name="sv-517" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[40]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-517" name="lop-517" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[40]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-517" name="khoa-517" id=""></td>
                    </tr>
                    <tr>
                        <td>5.2.6 Thành tích đặc biệt trong học tập, rèn luyện khác do Hội đồng đánh giá điểm rèn luyện cấp trường xem xét công nhận.</td>
                        <td>
                            10 điểm
                            <p>(tối đa)</p>
                        </td>
                        <td>
                        <?php 
                            if($getdiemofsv == null || $getdiemofsv->TONGDIEMSV == null){
                        ?>
                                <div class="custom-file-input-multi"> 
                                    <input type="file" name="files518[]" accept="image/*" multiple id="file518">
                                    <label style="cursor: pointer;" for="file">Tải ảnh lên</label>
                                </div>
                                <div class="file-name-multi-518"></div>
                        <?php
                            }
                            else{
                        ?>
                                <div value = "<?php echo $getdiemtcct[41]->ID_DTCCT; ?>" class="score-image">
                                    Ảnh đã tải lên
                                </divv>
                        <?php
                            }
                        ?>                       
                        </td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[41]->TONGDIEMSV : ""; ?>" type="number" class="sv-518" name="sv-518" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[41]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> type="number" class="lop-518" name="lop-518" id=""></td>
                        <td><input value="<?php echo $getdiemtcct != null ? $getdiemtcct[41]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> type="number" class="khoa-518" name="khoa-518" id=""></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 5 </td>
                        <td>
                            <p>10 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[4]->TONGDIEMSV : ""; ?>" readonly class="sv-5" name="sv-5" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[4]->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> readonly class="lop-5" name="lop-5" type="number"></td>
                        <td><input value="<?php echo $getdiemtc != null ? $getdiemtc[4]->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-5" name="khoa-5" type="number"></td>
                    </tr>
                    <tr class="total-score-part" style="font-weight: bold;">
                        <td>TỔNG ĐIỂM PHẦN 1 + 2 + 3 + 4 + 5 </td>
                        <td>
                            <p>100 điểm</p>
                            <p>(tối đa)</p>
                        </td>
                        <td></td>
                        <td><input value="<?php echo $getdiemofsv != null ? $getdiemofsv->TONGDIEMSV : ""; ?>" readonly class="sv-tong" name="sv-tong" type="number"></td>
                        <td><input value="<?php echo $getdiemofsv != null ? $getdiemofsv->TONGDIEMLOP : ""; ?>" <?php echo (isset($_SESSION['STUDENT'])) ? "disabled" : ""; ?> readonly class="lop-tong" name="lop-tong" type="number"></td>
                        <td><input value="<?php echo $getdiemofsv != null ? $getdiemofsv->TONGDIEMKHOA : ""; ?>" <?php echo (!isset($_SESSION['ADMIN']) && !isset($_SESSION['BCH'])) ? "disabled" : ""; ?> readonly class="khoa-tong" name="khoa-tong" type="number"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="score-bottom">
            <button class="send-score">GỬI</button>
            <button class="cancel-score">HỦY</button>
        </div>
    </div>
</form>

<div class="score-image-show">
    <div>
        <div class="title-show">Ảnh Đã Tải Lên</div>
        <div class="exit-show">X</div>
        <div class="body-show">
            
        </div>
    </div>
</div>

<div class="overlay" onclick="closeImage()">
    <img id="expandedImg">
</div>