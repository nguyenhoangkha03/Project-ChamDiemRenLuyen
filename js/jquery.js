$(document).ready(function(){
    $(document).on("click", ".cancel-save", function (e) { 
        e.preventDefault();
        window.location.href = "index.php?request=lopView";
    });
    $(document).on("click", ".cancel-save-taikhoan", function (e) { 
        e.preventDefault();
        window.location.href = "index.php?request=taikhoanView";
    });
    $(document).on("click", ".delete-class", function(e){
        var value = $(this).attr('value');
        window.location.href = "./process/lop/lopAct.php?reqact=delete&id=" + value;
    });
    $(document).on("click", ".delete-taikhoan", function (e) { 
        var value = $(this).attr('value');
        window.location.href = "./process/taikhoan/taikhoanAct.php?reqact=delete&id=" + value;
    });
    $('.delete-student').click(function(){
        var value = $(this).attr('value');
        if(confirm("Nếu xóa sinh viên thì tất cả thông tin liên quan của sinh viên đều bị xóa. Bạn chắc chắn ?")){
            window.location.href = "./process/sinhvien/sinhvienAct.php?reqact=delete&idsv=" + value;
        }
    });
    // $('.update-class').click(function(){
    //     var value = $(this).attr('value');
    //     window.location.href = "index.php?request=lopUpdate&id=" + value;
    // });
    $(document).on("click", ".update-class", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=lopUpdate&id=" + value;
    });
    $(document).on("click", ".update-taikhoan", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=taikhoanUpdate&id=" + value;
    });
    $(document).on("click", ".update-student", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=sinhvienUpdate&idsv=" + value;
    });
    $('.search-class').on('input', function(){
        var value = $(this).val();
        $.ajax({
            url: './process/lop/search.php',
            method: 'POST',
            data: { searchQuery: value },
            success: function(data) {
                $('.table-class tbody').html(data);
            }
        });
    });
    $('.search-taikhoan').on('change', function(){
        var value = $(this).val();
        $.ajax({
            url: './process/taikhoan/search.php',
            method: 'POST',
            data: { searchQuery: value },
            success: function(data) {
                $('.table-class tbody').html(data);
            }
        });
    });
    $('.search-student').on('input', function(){
        var value = $(this).val();
        var idlop = $('.data-sv').attr('value');
        $.ajax({
            url: './process/sinhvien/search.php',
            method: 'POST',
            data: { searchQuery: value, idlop: idlop },
            success: function(data) {
                $('.table-student tbody').html(data);
            }
        });
    });
    $('.search-student-manager').on('input', function(){
        var value = $(this).val();
        var [lop, hocky, namhoc] = ($('.data').attr('value')).split(" ");
        $.ajax({
            url: './process/diemmanager/svmanagerLoad.php',
            method: 'POST',
            data: { searchQuery: value, lop: lop, hocky: hocky, namhoc: namhoc},
            success: function(data) {
                $('.table-student tbody').html(data);
            }
        });
    });
    $(document).on('click', ".list-student", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=sinhvienView&idlop=" + value;
    });
    $(document).on('click', ".addnew-student", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=sinhvienAdd&idlop=" + value;
    });
    $(document).on('click', ".addnew-bch", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=bchAddNew";
    });
    $(document).on('change', '#file-upload', function(e){
        var fileName = this.files[0].name;
        document.getElementById('file-name-display').textContent = 'Ảnh đã chọn: ' + fileName;
    });
    $(document).on("click", ".cancel-save-student", function (e) { 
        e.preventDefault();
        var value = $(this).attr('value');
        window.location.href = "index.php?request=sinhvienView&idlop=" + value;
    });
    $(document).on("click", ".cancel-save-bch", function (e) { 
        e.preventDefault();
        window.location.href = "index.php?request=bchAdd";
    });
    $(document).on('change', '#file113', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-113').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file114', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-114').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file115', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-115').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file116', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-116').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file117', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-117').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file118', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-118').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file311', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-311').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file312', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-312').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file313', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-313').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file314', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-314').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file315', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-315').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file316', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-316').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file416', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-416').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file512', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-512').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file513', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-513').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file514', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-514').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file515', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-515').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file516', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-516').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file517', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-517').textContent =  fileNames.join(', ');
        }    
    });
    $(document).on('change', '#file518', function(e){
        var files = this.files;
        var fileNames = [];
        if(files.length > 3){
            alert('Chỉ được chọn tối đa 3 file');
            $(this).val('');
        }
        else{
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            document.querySelector('.file-name-multi-518').textContent =  fileNames.join(', ');
        }    
    });
    $('.score-view').click(function(){
        window.location.href = "index.php?request=scoreView"
    });
    $('.bch-view').click(function(){
        window.location.href = "index.php?request=bchView";
    });
    $('.profile').click(function(){
        var value = $(this).attr('value');
        if(value == ""){
            window.location.href = "./login/index.php";
        }
        else{
            window.location.href = "index.php?request=profile";
        }
    });
    $('.bch-add').click(function(){
        window.location.href = "index.php?request=bchAddNew";
    });
    $('.control-bch > button:first-child').click(function(){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=bchUpdate&idsv=" + value;
    });
    $('.control-bch > button:nth-child(2)').click(function(){
        var value = $(this).attr('value');
        if(confirm("Nếu xóa sinh viên thì tất cả thông tin liên quan của ban chấp hành đều bị xóa. Bạn chắc chắn ?")){
            window.location.href = "./process/sinhvien/sinhvienAct.php?reqact=deleteBCH&idsv=" + value;
        }
    });
    $('.vbhd-view').click(function(){
        window.location.href = "index.php?request=vbhdView";
    });
    $('.taikhoan-view').click(function(){
        window.location.href = "index.php?request=taikhoanView";
    });
    $('.like-icon div').click(function(){
        var value = $(this).attr('value');
        var [idsv, idvbhd] = value.split(" ");
        var number = $('.number-like div').html();
        if(value != ""){
            $.ajax({
                url: './process/like/likeAct.php?reqact=addNew',
                type: 'POST',
                data: {idsv: idsv, idvbhd: idvbhd},
                success: function(data){
                    if(parseInt(data) < parseInt(number)){
                        $(this).css('color', 'gray');
                        $('.img-like').attr('src', './images/un-like.png');
                        $('.number-like div').html(data);
                    }
                    else{
                        $(this).css('color', '#2577ae');
                        $('.img-like').attr('src', './images/like.png');
                        $('.number-like div').html(data);
                    }
                }
            });
        }
        else{
            window.location.href = "./login/index.php";
        }
    });
    $('.logout').click(function(){
        window.location.href = "./process/taikhoan/taikhoanAct.php?reqact=logout";
    });
    $('.changePassword').click(function(){
        $('.modal').css('display', 'block');
    });
    $('.change-title > div:nth-child(2)').click(function(){
        $('.modal').css('display', 'none');
    });
    $('.form-changePass').submit(function(e){
        e.preventDefault();
        var pass = $('.passNew').val();
        var passConfim = $('.passConfirm').val();
        if(pass === passConfim){
            this.submit();
        }
        else{
            alert("Xác nhận mật khẩu không khớp");
        }
    });
    $('.form-changePass .passConfirm').on('keypress', function(e) {
        if (e.which == 13) { 
            e.preventDefault(); 
            $('.form-changePass input[type="submit"]').click(); 
        }
    });

    $(document).on('click', '.addnew-class', function(){
        window.location.href = "index.php?request=lopAdd";
    });

    $(document).on('change', '.selectNam', function(e){
        var value = $(this).val();
        var idsv = $('.get-sv').attr('value');
        $.ajax({
            url: './process/bangdiem/Load.php',
            type: 'POST',
            data: {value: value, idsv: idsv},
            success: function(data){
                $('.selectHK').html(data);
                $('.selectHK').prop('disabled', false);
            }
        });
    });

    $('.create-score').click(function(){
        $('.modal').css('display', 'block');
    });
    $('.close-score').click(function(){
        var idsv = $('.get-sv').attr('value');
        document.location.href = "./process/bangdiem/bangdiemAct.php?reqact=lockBD&idsv=" + idsv;
    });

    $('.open-score').click(function(){
        var idsv = $('.get-sv').attr('value');
        document.location.href = "./process/bangdiem/bangdiemAct.php?reqact=openBD&idsv=" + idsv;
    });

    $('.file-item').click(function(){
        var value = $(this).attr('value');
        window.location.href = "./process/vbhd/viewPDF.php?id=" + value;
    });
    
    $('.vbhd-item').hover(function(){
        var value = $(this).attr('value');
        var [idsv, idvbhd] = value.split(" ");
        $.ajax({
            url: './process/vbhd/vbhdAct.php?reqact=view',
            type: 'POST',
            data: {idsv: idsv, idvbhd: idvbhd},
            success: function(data){
            }
        });
    });

    $('.create-story').click(function(){
        $('.add-back').css('display', 'block');
    });
    $('.exit-create').click(function(){
        $('.add-back').css('display', 'none');
    });
    $(document).on('click', '.watch-old', function(e){
        e.preventDefault();
    });

    // Load image score
    $(document).on('click', '.score-image', function(){
        var value = $(this).attr('value');
        $('.score-image-show').css('display', 'block');
        $('.body-show').load('./process/minhchung/minhchungLoad.php?iddtcct='+value, function(){

        });
    });
    $(document).on('click', '.exit-show', function(){
        $('.score-image-show').css('display', 'none');
    });
    $('.menu-item').click(function(){
        $('.delete-item').css('display', 'block');
    });
    $('.delete-item').mouseleave(function(){
        $('.delete-item').css('display', 'none');
    });
    $('.delete-item').click(function(){
        var value = $(this).attr('value');
        window.location.href = "./process/vbhd/vbhdAct.php?reqact=delete&id=" + value;
    });


    $('.mySelect').select2();
});