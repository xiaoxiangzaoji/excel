<?php
require_once('./excelOneData.php');
require_once('./excelTwoData.php');
$N = $_POST['N'];//产品数量
$M = $_POST['M'];//每组数量
$onePercentage = $_POST['onePercentage']?$_POST['onePercentage']:0.95;
$twoPercentage = $_POST['twoPercentage']?$_POST['twoPercentage']:0.85;
$N1 = ceil($N/$M);//组数
$groupNum = $N1;
$x1 = floor($N1*(1-$onePercentage));
$x2 = floor($N1*(1-$twoPercentage));

$nArray= array_keys($oneData);
if(!in_array($N1,$nArray)){
    $nArray[] = $N1;
    sort($nArray);
    $key = array_search($N1,$nArray);
    $N1 = $nArray[$key+1];
}
$data =[];
$message ='success';
$code =1;
if($x1 < 2){
    $x1 =2;
}
if($x2 < 2){
    $x2 =2;
}
if(isset($oneData[$N1][$x1])){
    $n1 = '方案一n为:'.$oneData[$N1][$x1];
}else{
    $n1 = '1方案不存在该n值';
}

if(isset($twoData[$N1][$x2])){
    $n2 = '方案二n为:'.$twoData[$N1][$x2];
}else{
    $n2 = '2方案不存在该n值';
}
$zuobiao1 = '方案一坐标为('.$N1.','.$x1.')';
$zuobiao2 = '方案二坐标为('.$N1.','.$x2.')';
$finalResult = array('zuobiao1'=>$zuobiao1,'zuobiao2'=>$zuobiao2,'groupnum'=>$groupNum,'fangan1'=>$x1,'fangan2'=>$x2,'n1'=>$n1,'n2'=>$n2);
$array = array('code'=>$code,'data'=>$finalResult,'msg'=>$message);
echo json_encode($array);die();