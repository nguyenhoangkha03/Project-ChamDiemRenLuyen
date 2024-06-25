<div class="vbhd">
    <div class="add-item">
        <div>Tạo bài viết</div>
        <hr>
        <div>
            <img src="./images/logotruong.png" alt="">
            <div>Nguyen Hoang Kha</div>
        </div>
        <div>
            <textarea placeholder="Nhập nội dung" name="" id=""></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
        <div class="file-preview" id="filePreview"></div>
        <div>
            <div>Thêm vào bài viết</div>
            <div>
                <div class="upload-icon" onclick="document.getElementById('fileInput').click()">
                    <img class="add-image" src="./images/picture.png" alt="">
                </div>
                <input type="file" id="fileInput" accept="image/*" onchange="previewImages(event)" multiple>
            </div>
            <div>
                <div class="upload-icon" onclick="document.getElementById('fileInputFile').click()">
                    <img src="./images/documents.png" alt="Upload Icon" width="30" height="30">
                </div>
                <input type="file" id="fileInputFile" accept=".pdf,.doc,.docx" onchange="handleFileUpload(event)" multiple>
            </div>
        </div>
        <button>Đăng</button>
    </div>
    <div class="vbhd-item">
        <div class="item-title">
            <img src="./images/logotruong.png" alt="">
            <div>
                <div class="author-item">Nguyen Hoang Kha</div>
                <div class="time-item">19 phút</div>
            </div>
        </div>
        <div class="item-content">
            <div class="text-content">
                Bầu trời đêm hôm qua🐧
            </div>
            <div class="file-content">
                
            </div>
            <div class="image-content">
                <img src="./images/1.jpg" alt="">
                <img src="./images/2.jpg" alt="">
                <img src="./images/3.jpg" alt="">
                <img src="./images/4.jpg" alt="">
                <img src="./images/5.jpg" alt="">
            </div>
        </div>
        <div class="item-interact">
            <div class="number-like">
                <img src="./images/icon-like.png" alt="">
                <div>334</div>
            </div>
            <div class="number-view">
                <span>123</span> lượt xem
            </div>
        </div>
        <hr class="hr-item">
        <div class="like-icon">
            <div>
                <img class="img-like" src="./images/un-like.png" alt="">
                Thích
            </div>
        </div>
    </div>
</div>