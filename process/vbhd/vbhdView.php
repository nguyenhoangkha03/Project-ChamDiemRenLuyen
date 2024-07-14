<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require './database/vbhdCls.php';
    require './database/fileCls.php';
    require './database/hinhanhCls.php';
    require './database/likesCls.php';
    require './database/luotxemCls.php';
    $vbhd = new VBHD();
    $file = new File();
    $hinhanh = new Hinhanh();
    $like = new LIKES();
    $luotxem = new Luotxem();
    $getAllByDatetime = $vbhd->VBHDGetAllByDatetime();
?>
<div class="address-profile" style="margin-bottom: 40px;">
    <div>BẢNG TIN</div>
</div>
<div class="vbhd">
    <?php 
        if(isset($_SESSION['ADMIN']) || isset($_SESSION['BCH'])){
    ?>
            <div class="create-story">Đăng Bài</div>
    <?php
        }
    ?>
    <div class="add-back">
    <form action="./process/vbhd/vbhdAct.php?reqact=addNew&idsv=<?php echo $getsinhvien->ID_SV; ?>" method="POST" enctype="multipart/form-data">
        <div class="add-item">
            <div style="position: relative;">
                <div>Tạo bài viết</div>
                <div class="exit-create">X</div>
            </div>
            <hr>
            <div>
                <img src="data:image/png;base64,<?php echo $getsinhvien->HINHANH; ?>" alt="">
                <div><?php echo $getsinhvien->HOTEN; ?></div>
            </div>
            <div>
                <textarea placeholder="Nhập nội dung" name="noidung" id=""></textarea>
            </div>
            <div class="image-preview" id="imagePreview"></div>
            <div class="file-preview" id="filePreview"></div>
            <div>
                <div>Thêm vào bài viết</div>
                <div>
                    <div class="upload-icon" onclick="document.getElementById('fileInput').click()">
                        <img class="add-image" src="./images/picture.png" alt="">
                    </div>
                    <input type="file" name="fileanh[]" id="fileInput" accept="image/*" onchange="previewImages(event)" multiple>
                </div>
                <div>
                    <div class="upload-icon" onclick="document.getElementById('fileInputFile').click()">
                        <img src="./images/documents.png" alt="Upload Icon" width="30" height="30">
                    </div>
                    <input type="file" name="files[]" id="fileInputFile" accept=".pdf,.doc,.docx" onchange="handleFileUpload(event)" multiple>
                </div>
            </div>
            <button>Đăng</button>
        </div>
    </form>
    </div>
    <?php 
        if(count($getAllByDatetime) > 0){
            foreach($getAllByDatetime as $item){
                $getsv = $sinhvien->SinhVienGetById($item->ID_SV);
                $getdatetime = $item->NGAYDANG;
                $getdatetime = new DateTime($getdatetime);
                $datenow = date('Y-m-d H:i:s');
                $datenow = new DateTime($datenow);
                $interval = $datenow->diff($getdatetime);
                if ($interval->y > 0) {
                    $time = $interval->y . ' năm';
                } elseif ($interval->m > 0) {
                    $time = $interval->m . ' tháng';
                } elseif ($interval->d > 0) {
                    $time = $interval->d . ' ngày';
                } elseif ($interval->h > 0) {
                    $time = $interval->h . ' giờ';
                } elseif ($interval->i > 0) {
                    $time = $interval->i . ' phút';
                } else {
                    $time = 'Vừa xong';
                }
                $getAllhinhanh = $hinhanh->HinhanhGetbyIdVBHD($item->ID_VBHD);
                $getAllfile = $file->FileGetbyIdVBHD($item->ID_VBHD);
                $getlike = $like->LikesGetAllByIDVBHD($item->ID_VBHD);
                $getlikecheck = null;
                if($getsinhvien != null){
                    $getlikecheck = $like->LikesGetAllByIDSVANDIDVBHD($getsinhvien->ID_SV, $item->ID_VBHD);
                }
                $getluotxem = $luotxem->LuotxemGetAllByIDVBHD($item->ID_VBHD);
                
    ?>
                <div class="vbhd-item" value="<?php echo $getsinhvien != null ? ($getsinhvien->ID_SV . " " . $item->ID_VBHD) : ""; ?>">
                    <div class="item-title">
                        <img src="data:image/png;base64,<?php echo $getsv->HINHANH; ?>" alt="">
                        <div>
                            <div class="author-item"><?php echo $getsv->HOTEN; ?></div>
                            <div class="time-item"><?php echo $time; ?></div>
                        </div>
                    </div>
                    <div class="menu-item">●●●</div>
                    <div class="delete-item" value="<?php echo $item->ID_VBHD; ?>">Xóa</div>
                    <div class="item-content">
                        <div class="text-content">
                            <?php echo $item->NOIDUNG; ?>
                        </div>
                        <div class="file-content">
                        <?php 
                            foreach($getAllfile as $ha){
                        ?>
                                <div value="<?php echo $ha->ID_FILE; ?>" class="file-item">
                                <?php 
                                    if (str_contains($ha->FILENAME, '.pdf')) {
                                ?>
                                        <img src="./images/pdf.png" alt="Icon" width="30" height="30">
                                <?php
                                    }
                                    else{
                                ?>
                                        <img src="./images/doc.png" alt="Icon" width="30" height="30">
                                <?php
                                    }
                                ?>
                                    <span><?php echo $ha->FILENAME; ?></span>
                                </div>
                        <?php
                            }
                        ?>
                        </div>
                        <div class="image-content">                          
                            <?php 
                                foreach($getAllhinhanh as $ha){
                            ?>
                                    <img onclick="openImage('<?php echo $ha->FILEHINH; ?>')" src="data:image/png;base64,<?php echo $ha->FILEHINH; ?>" alt="">
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="item-interact">
                        <div class="number-like">
                            <img src="./images/icon-like.png" alt="">
                            <div><?php echo count($getlike); ?></div>
                        </div>
                        <div class="number-view">
                            <span><?php echo count($getluotxem); ?></span> lượt xem
                        </div>
                    </div>
                    <hr class="hr-item">
                    <div class="like-icon">
                        <div value="<?php echo $getsinhvien != null ? ($getsinhvien->ID_SV . " " . $item->ID_VBHD) : ""; ?>">
                        <?php 
                            if($getlikecheck != null){
                        ?>
                                <img class="img-like" src="./images/like.png" alt="">
                                <span style="color: #2577ae;">Thích</span>
                        <?php
                            }
                            else{
                        ?>
                                <img class="img-like" src="./images/un-like.png" alt="">
                                <span>Thích</span>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>
    <div class="overlay" onclick="closeImage()">
        <img id="expandedImg">
    </div>
</div>