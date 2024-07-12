<?php 
    $iddtcct = $_GET['iddtcct'];
    require '../../database/minhchungCls.php';
    $minhchung = new Minhchung();
    $getminhchung = $minhchung->MinhchungGetbyIDDTCCT($iddtcct);
    if(count($getminhchung) > 0){
        foreach($getminhchung as $mc){
?>
            <img onclick="openImage('<?php echo $mc->FILE; ?>')" style="cursor: pointer;" width="33%" height="49%" src="data:image/png;base64,<?php echo $mc->FILE; ?>" alt="">
<?php
        }
    }
    else{
?>
    <div style="font-size: 30px; font-weight: bold; color: blue; margin-top: 30px; text-align: center;">
        KHÔNG CÓ MINH CHỨNG ĐƯỢC TẢI LÊN
    </div>  
<?php
    }
?>