<?php 
    require '../../database/fileCls.php';
    $fileClass = new File();
    $idfile = $_GET['id'];
    $file = $fileClass->FileGetbyId($idfile);

    // $decodedContent = base64_decode($file->FILEFILE);
    // header("Content-Type: application/pdf");
    // header("Content-Length: " . strlen($decodedContent));
    // echo $decodedContent;

    $decodedContent = base64_decode($file->FILEFILE);
    if (str_contains($file->FILENAME, '.pdf')) {
        header("Content-Type: application/pdf");
    }
    else{
        if (str_contains($file->FILENAME, '.docx')){
            header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        }
        else{
            header("Content-Type: application/msword");
        }
    }

    // switch ($fileType) {
    //     case 'PDF':
    //         header("Content-Type: application/pdf");
    //         break;
    //     case 'DOC':
    //         header("Content-Type: application/msword");
    //         break;
    //     case 'DOCX':
    //         header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    //         break;
    //     default:
    //         header("Content-Type: application/octet-stream");
    //         break;
    // }

    header("Content-Length: " . strlen($decodedContent));
    echo $decodedContent;
?>