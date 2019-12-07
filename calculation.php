<?php
require_once('./excelOneData.php');
require_once('./excelTwoData.php');
$N = $_POST['N'];//产品数量
$M = $_POST['M'];//每组数量
$onePercentage = $_POST['onePercentage'];
$twoPercentage = $_POST['twoPercentage'];
$N1 = round($N/$M);//组数
$groupNum = $N1;
$x1 = floor($N1*(1-$onePercentage));
$x2 = floor($N1*(1-$twoPercentage));
if($x1<=$x2){
    $result_X = $x1;
    $result = 1;
}else{
    $result_X = $x2;
    $result = 2;
}

$nArray= array_keys($oneData);
if(!in_array($N1,$nArray)){
    $nArray[] = $N1;
    sort($nArray);
    $key = array_search($N1,$nArray);
    $N1 = $nArray[$key+1];
}
$data =null;
$message ='success';
$code =1;
if($result_X < 2){
    $result_X =2;
}
if($result==1){
    if(isset($oneData[$N1][$result_X])){
        $data = $oneData[$N1][$result_X];
    }else{
        $message = '1方案不存在该n值';
        $code =0;
    }

}else{
    if(isset($twoData[$N1][$result_X])){
        $data = $twoData[$N1][$result_X];
    }else{
        $message = '2方案不存在该n值';
        $code =0;
    }
}

$zuobiao = '('.$N1.','.$result_X.')';
$finalResult = array('zuobiao'=>$zuobiao,'groupnum'=>$groupNum,'fangan1'=>$x1,'fangan2'=>$x2,'data'=>$data,'result'=>$result);
$array = array('code'=>$code,'data'=>$finalResult,'msg'=>$message);
echo json_encode($array);die();