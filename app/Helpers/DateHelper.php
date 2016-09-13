<?php 

namespace App\Helpers;

use DateTime;

Class DateHelper {

	public static function timeago($tm,$rcs = 0) {
		$tm=strtotime($tm);
		$cur_tm = time(); $dif = $cur_tm-$tm;
		$pds = array('second','min','hour','day','week','month','year','decade');
		$pds1 = array('seconds','mins','hours','days','weeks','months','years','decades');
		$lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
		
		$no = floor($no); if($no <> 1) {$pds=$pds1;} $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		return $x;
	}

 	public static function euroDateToMysql($date){
 		$array = explode(".", $date);
		return $array[2]."-".$array[1]."-".$array[0]." 00:00:00";
 	}

 	public static function mysqlDateToEuro($date){
 		$array = explode("-", substr($date,0,10));
 		$time = substr($date,11);
		return $array[2].".".$array[1].".".$array[0].' '.$time;
 	}

 	 public static function mysqlDateToEuroText($date){
 		$array = explode("-", substr($date,0,10));
 		$time = substr($date,11);
		return $array[2]." ".date("F",$array[1])." ".$array[0].' '.$time;
 	}

 	 public static function daysAgo($date){
 		 $now = time(); // or your date as well
	     $your_date = strtotime($date);
	     $datediff = $now - $your_date;
	     return floor($datediff/(60*60*24));
 	}

 	public static function calculateAge($date)
 	{	
 		$birth = new DateTime($date);
		$now = new DateTime('today');
		$age['years'] = $birth->diff($now)->y;
		$age['months'] = $birth->diff($now)->m;
		return $age;
 	}


}