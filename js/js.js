document.addEventListener("DOMContentLoaded", function(){
    var urlParams = new URLSearchParams(window.location.search);
    var requestValue = urlParams.get('request');
    if(requestValue == 'scoreView' || requestValue == 'scoreWatch' || requestValue == 'managerScoreLop' || requestValue == 'managerScoreSV' || requestValue == 'bchMark' || requestValue == 'scoreOfSV' || requestValue == 'bcs-sinhvien' || requestValue == 'bcsMark'){
        const View = document.querySelector('.score-view');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
    else if(requestValue == 'bchView' || requestValue == 'bchAddNew' || requestValue == 'bchUpdate'){
        const View = document.querySelector('.bch-view');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
    else if(requestValue == 'vbhdView'){
        const View = document.querySelector('.vbhd-view');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
    else if(requestValue == 'profile'){
        const View = document.querySelector('.profile');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
    else if(requestValue == 'taikhoanView' || requestValue == 'taikhoanAdd' || requestValue == 'taikhoanUpdate'){
        const View = document.querySelector('.taikhoan-view');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
    else if(requestValue == 'lopView' || requestValue == 'lopAdd' || requestValue == 'lopUpdate' || requestValue == 'sinhvienView' || requestValue == 'sinhvienUpdate' || requestValue == 'sinhvienAdd'){
        const View = document.querySelector('.list-class');
        View.style.color = 'white';
        View.style.backgroundColor = 'lightblue';
    }
});

document.querySelector(".list-class").addEventListener("click", function(){
    window.location.href = "index.php?request=lopView";
});

document.querySelector(".addnew-taikhoan").addEventListener("click", function(){
    window.location.href = "index.php?request=taikhoanAdd";
});



// document.querySelector(".addnew-class").addEventListener("click", function(){
//     window.location.href = "index.php?request=lopAdd";
// });

function previewImages(event) {
    var previewContainer = document.getElementById('imagePreview');
    previewContainer.style.visibility = "visible";
    previewContainer.innerHTML = ''; 

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function(e) {
            var image = document.createElement('img');
            image.src = e.target.result;
            image.classList.add('preview-image');
            image.onclick = function() {
                console.log('Clicked on image:', image.src);
            };
            previewContainer.appendChild(image);
        };

        reader.readAsDataURL(file);
    }
}

function handleFileUpload(event) {
    var previewContainer = document.getElementById('filePreview');
    previewContainer.innerHTML = ''; 

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileType = file.name.split('.').pop().toLowerCase(); 

        var fileItem = document.createElement('div');
        fileItem.classList.add('file-item');

        var iconSrc = '';
        if (fileType === 'pdf') {
            iconSrc = 'images/pdf.png';
        } else if (fileType === 'doc' || fileType === 'docx') {
            iconSrc = 'images/doc.png';
        } else {
            iconSrc = 'file-icon.png'; 
        }

        fileItem.innerHTML = `
            <img src="${iconSrc}" alt="${fileType.toUpperCase()} Icon" width="30" height="30">
            <span>${file.name}</span>
        `;
        
        previewContainer.appendChild(fileItem);
    }
}

function openImage(base64Img) {
    var expandedImg = document.getElementById("expandedImg");
    expandedImg.src = 'data:image/png;base64,' + base64Img;
    document.querySelector('.overlay').style.display = 'block';
}

function closeImage() {
    document.querySelector('.overlay').style.display = 'none';
}


