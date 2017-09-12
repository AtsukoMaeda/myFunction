<?php
/**
 * 神奇数，类似422和314，422可以拆分成[4]和[2,2]两个数组内所有数相加相等的数组，写一个函数，输入范围，找出这个范围内所有的神奇数
 */
header('Content-Type:text/html;charset=utf-8');
echo '<pre/>';
function shenqishu($range){
	$int=explode(',',$range);
	$return=[];
	for($i=$int[0];$i<=$int[1];$i++){
		$i=(string)($i);
		$max=[];
		$len=strlen($i);
		for($j=0;$j<$len;$j++){
			$max[]=$i[$j];
		}
		sort($max);
		$big=$max[$len-1];
		unset($max[$len-1]);
		$len--;
		$other=array_sum($max);
		if($big>$other){
			continue;
		}elseif($big==$other){
			$return[]=$i;
		}else{
			$min=[];
			$min[]=$big;
			while(array_sum($max)!=array_sum($min)){
				if(array_sum($max)==array_sum($min)){
					$return[]=$i;
					break;
				}
				if(array_sum($max)<array_sum($min)){
					break;
				}
				@$min[]=$max[$len];
				unset($max[$len]);
				$len--;
			}
		}
	}
	return $return;
}
var_dump(shenqishu('1,500'));die;