$(document).ready(function(){
    $(document).on("click", ".cancel-save", function (e) { 
        e.preventDefault();
        window.location.href = "index.php?request=lopView";
    });
    $('.delete-class').click(function(){
        var value = $(this).attr('value');
        window.location.href = "./process/lop/lopAct.php?reqact=delete&id=" + value;
    });
    $('.delete-student').click(function(){
        var value = $(this).attr('value');
        window.location.href = "./process/sinhvien/sinhvienAct.php?reqact=delete&idsv=" + value;
    });
    // $('.update-class').click(function(){
    //     var value = $(this).attr('value');
    //     window.location.href = "index.php?request=lopUpdate&id=" + value;
    // });
    $(document).on("click", ".update-class", function(e){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=lopUpdate&id=" + value;
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
    $('.search-student').on('input', function(){
        var value = $(this).val();
        $.ajax({
            url: './process/sinhvien/search.php',
            method: 'POST',
            data: { searchQuery: value },
            success: function(data) {
                $('.table-student tbody').html(data);
            }
        });
    });
    $('.list-student').click(function(){
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
    $('.bch-add').click(function(){
        window.location.href = "index.php?request=bchAddNew";
    });
    $('.control-bch > button:first-child').click(function(){
        var value = $(this).attr('value');
        window.location.href = "index.php?request=bchUpdate&idsv=" + value;
    });
    $('.control-bch > button:nth-child(2)').click(function(){
        var value = $(this).attr('value');
        window.location.href = "./process/sinhvien/sinhvienAct.php?reqact=deleteBCH&idsv=" + value;
    });
    $('.vbhd-view').click(function(){
        window.location.href = "index.php?request=vbhdView";
    });
    var checkLike = 0;
    $('.like-icon div').click(function(){
        if(checkLike == 0){
            $(this).css('color', '#2577ae');
            $('.img-like').attr('src', './images/like.png')
            checkLike = 1;
        }
        else{
            $(this).css('color', 'gray');
            $('.img-like').attr('src', './images/un-like.png')
            checkLike = 0;
        }
    });

    $('.mySelect').select2();
});