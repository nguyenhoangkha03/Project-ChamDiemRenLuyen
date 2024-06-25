document.querySelector(".list-class").addEventListener("click", function(){
    window.location.href = "index.php?request=lopView";
});

document.querySelector(".addnew-class").addEventListener("click", function(){
    window.location.href = "index.php?request=lopAdd";
});

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