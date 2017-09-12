<?php
/**
 * bcd码解析数组，解析字符串，数字，一维数组和二维数组
 */
function bcdout($arr,$int,$field){
	for($i=0;$i<$int;$i++){
		$test[]=pow(2,$i);
	}
	if(is_string($arr)||is_int($arr)){
		$return=[];
		foreach($test as $k1=>$v1){
			$return[]=(bool)($arr&$v1);
		}
		return $return[$field-1];
	}
	if(count($arr)==count($arr,1)){
		$value=$arr[$field];
		$arr[$field]=[];
		foreach($test as $v1){
			$arr[$field][]=(bool)($value&$v1);
		}
	}else{
		foreach($arr as $k=>$v){
			$value=$v[$field];
			$arr[$k][$field]=[];
			foreach($test as $v1){
				$arr[$k][$field][]=(bool)($value&$v1);
			}
		}
	}
	return $arr;
}
$arr=[
	['id'=>1,'name'=>'a','option'=>7],
	['id'=>2,'name'=>'b','option'=>5],
	['id'=>3,'name'=>'c','option'=>9],
];
// $arr=['id'=>1,'name'=>'a','option'=>7];
$arr=bcdout($arr,4,'options');
// $arr=bcdout(7,4,3);
var_dump($arr);
$arr=[
	['id'=>1,'name'=>'a','is_on'=>1,'is_share'=>1,'is_vip'=>1,'is_cash'=>1],
	['id'=>2,'name'=>'b','is_on'=>1,'is_share'=>0,'is_vip'=>1,'is_cash'=>0],
	['id'=>3,'name'=>'c','is_on'=>0,'is_share'=>1,'is_vip'=>0,'is_cash'=>1],
];
// $arr=['id'=>1,'name'=>'a','is_on'=>1,'is_share'=>1,'is_vip'=>1,'is_cash'=>1];
/**
 * bcd码接收函数，可接收一维数组或者二维数组
 */
function bcdin($arr,$optionsArr,$optionsName){
	for($i=0;$i<count($optionsArr);$i++){
		$test[]=pow(2,$i);
	}
	$bin='';
	if(count($arr)==count($arr,1)){
		foreach ($optionsArr as $k=>$v) {
			$bin=$arr[$v]?$bin|$test[$k]:$bin|!$test[$k];
			unset($arr[$v]);
		}
		$arr[$optionsName]=$bin;
	}else{
		foreach ($arr as $k => $v) {
			foreach ($optionsArr as $k1=>$v1) {
				$bin=$v[$v1]?$bin|$test[$k1]:$bin|!$test[$k1];
				unset($arr[$k][$v1]);
			}
			$arr[$k][$optionsName]=$bin;
			$bin='';
		}
	}
	return $arr;
}
var_dump(bcdin($arr,['is_on','is_share','is_vip','is_cash'],'options'));