<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-12
*/

define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'functioned/cheCookie.php';
global $user;
   
	$db = new DB();
	//最新開獎記錄
	$sql = "SELECT  g_qishu,g_ball_1,g_ball_2,g_ball_3,g_ball_4,g_ball_5,g_ball_6,g_ball_7,g_ball_8,g_ball_9,g_ball_10,g_ball_11,g_ball_12,g_ball_13,g_ball_14,g_ball_15,g_ball_16,g_ball_17,g_ball_18,g_ball_19,g_ball_20 FROM g_history8 WHERE g_ball_1 is not null ORDER BY g_date DESC LIMIT 1";
	$result = $db->query($sql, 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	$winMoney = json_encode(getWin ($user));
	//雙面
	$startDate = date('Y-m-d').' 00:00';
	//$startDate =date('Y-m-d H:i:s',strtotime("$startDate -1 day"));
	$endDate = date('Y-m-d').' 24:00';
	$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
	$sql = "SELECT g_qishu,g_ball_1, g_ball_2, g_ball_3, g_ball_4, g_ball_5, g_ball_6, g_ball_7, g_ball_8, g_ball_9, g_ball_10,g_ball_11, g_ball_12, g_ball_13, g_ball_14, g_ball_15, g_ball_16, g_ball_17, g_ball_18, g_ball_19, g_ball_20 FROM `g_history8` WHERE {$date} and g_ball_1 is not null ORDER BY g_qishu desc ";
	$result=$db->query($sql, 1);
	$sm=sum_ball_count_kl8($result);
	$sm = json_encode($sm);
	//路途
	$numArray1=array();
	$len=count($result);
	$result=array_reverse($result);
	if($len>=1)
	{
		for($i=0;$i<$len;$i++)
		{
			$rs=$result[$i];
			
			$zh=$rs['g_ball_1']+$rs['g_ball_2']+$rs['g_ball_3']+$rs['g_ball_4']+$rs['g_ball_5']+$rs['g_ball_6']+$rs['g_ball_7']+$rs['g_ball_8']+$rs['g_ball_9']+$rs['g_ball_10']+$rs['g_ball_11']+$rs['g_ball_12']+$rs['g_ball_13']+$rs['g_ball_14']+$rs['g_ball_15']+$rs['g_ball_16']+$rs['g_ball_17']+$rs['g_ball_18']+$rs['g_ball_19']+$rs['g_ball_20'];
			$arr=array($rs['g_ball_1'],$rs['g_ball_2'],$rs['g_ball_3'],$rs['g_ball_4'],$rs['g_ball_5'],$rs['g_ball_6'],$rs['g_ball_7'],$rs['g_ball_8'],$rs['g_ball_9'],$rs['g_ball_10'],$rs['g_ball_11'],$rs['g_ball_12'],$rs['g_ball_13'],$rs['g_ball_14'],$rs['g_ball_15'],$rs['g_ball_16'],$rs['g_ball_17'],$rs['g_ball_18'],$rs['g_ball_19'],$rs['g_ball_20']);
			$zhdx=($zh==810?'和':($zh>810?'大':'小'));
			$zhds=($zh==810?'和':($zh%2==0?'雙':'單'));
			$r=GetKl8ZhDs($arr);
			if($r[0]>$r[1])
				$dsh='單';
			elseif($r[0]<$r[1])
				$dsh='雙';	
			else
				$dsh='和';
			$r=GetKl8Qs($arr);
			if($r[0]>$r[1])
				$qhh='前';
			elseif($r[0]<$r[1])
				$qhh='後';	
			else
				$qhh='和';	
			if($zh>=210 &&  $zh<=695)
				$wx="金";
			elseif($zh>=696 &&  $zh<=763)
				$wx="木";
			elseif($zh>=764 &&  $zh<=855)
				$wx="水";
			elseif($zh>=856 &&  $zh<=923)
				$wx="火";
			elseif($zh>=924 &&  $zh<=1410)
				$wx="土";
			$numArray1[]=array($zh,$zhdx,$zhds,$wx,$qhh,$dsh);	
		}
		$row1="<td valign=top class='z_cl'>".$numArray1[0][0];
		$row2="<td valign=top class='z_cl'>".$numArray1[0][1];
		$row3="<td valign=top class='z_cl'>".$numArray1[0][2];
		$row4="<td valign=top class='z_cl'>".$numArray1[0][3];
		$row5="<td valign=top class='z_cl'>".$numArray1[0][4];
		$row6="<td valign=top class='z_cl'>".$numArray1[0][5];
		for($k=1;$k<$len;$k++)
		{
			if($numArray1[$k][0]==$numArray1[$k-1][0])
				$row1.='<br>'.$numArray1[$k][0];
			else
				$row1.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][0];	

            $ball=$numArray1[$k][1];				
			if($numArray1[$k][1]==$numArray1[$k-1][1])
			{
			if($ball=="龍" || $ball=="雙" || $ball=="大" )
			{
			$row2.='<br>'.$numArray1[$k][1];
			  }else if($ball=="虎" || $ball=="單" || $ball=="小")
				{
				$row2.='<br>'.$numArray1[$k][1];
				 }else{
				$row2.='<br>'.$numArray1[$k][1];
				} 
			}
			else
			{
			if($ball=="龍" || $ball=="雙" || $ball=="大")
			{
			$row2.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][1];
			 
			  }else if($ball=="虎" || $ball=="單" || $ball=="小")
				{
				$row2.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][1];
				 }else{
				$row2.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][1];	
				}  
			}
			
			$ball2=$numArray1[$k][2];				
			if($numArray1[$k][2]==$numArray1[$k-1][2])
			{
			if($ball2=="龍" || $ball2=="雙" || $ball2=="大" )
			{
			$row3.='<br>'.$numArray1[$k][2];
			  }else if($ball2=="虎" || $ball2=="單" || $ball2=="小")
				{
				$row3.='<br>'.$numArray1[$k][2];
				 }else{
				$row3.='<br>'.$numArray1[$k][2];
				} 
			}
			else
			{
			if($ball2=="龍" || $ball2=="雙" || $ball2=="大")
			{
			$row3.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][2];
			 
			  }else if($ball2=="虎" || $ball2=="單" || $ball2=="小")
				{
				$row3.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][2];
				 }else{
				$row3.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][2];	
				}  
			}
			  
			if($numArray1[$k][3]==$numArray1[$k-1][3])
			{
				$row4.='<br>'.$numArray1[$k][3];
				}
			else{
				$row4.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][3];	
				}
				
				
			$ball4=$numArray1[$k][4];				
			if($numArray1[$k][4]==$numArray1[$k-1][4])
			{
			if($ball4=="龍" || $ball4=="雙" || $ball4=="大" || $ball4=="前")
			{
			$row5.='<br>'.$numArray1[$k][4];
			  }else if($ball4=="虎" || $ball4=="單" || $ball4=="小" || $ball4=="後")
				{
				$row5.='<br>'.$numArray1[$k][4];
				 }else{
				$row5.='<br>'.$numArray1[$k][4];
				} 
			}
			else
			{
			if($ball4=="龍" || $ball4=="雙" || $ball4=="大" || $ball4=="前")
			{
			$row5.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][4];
			 
			  }else if($ball4=="虎" || $ball4=="單" || $ball4=="小" || $ball4=="後")
				{
				$row5.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][4];
				 }else{
				$row5.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][4];	
				}  
			}
			
			
			$ball5=$numArray1[$k][5];				
			if($numArray1[$k][5]==$numArray1[$k-1][5])
			{
			if($ball5=="龍" || $ball5=="雙" || $ball5=="大" )
			{
			$row6.='<br>'.$numArray1[$k][5];
			  }else if($ball5=="虎" || $ball5=="單" || $ball5=="小")
				{
				$row6.='<br>'.$numArray1[$k][5];
				 }else{
				$row6.='<br>'.$numArray1[$k][5];
				} 
			}
			else
			{
			if($ball5=="龍" || $ball5=="雙" || $ball5=="大")
			{
			$row6.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][5];
			 
			  }else if($ball5=="虎" || $ball5=="單" || $ball5=="小")
				{
				$row6.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][5];
				 }else{
				$row6.="</td>,<td valign=top class='z_cl'>".$numArray1[$k][5];	
				}  
			}
			
		}
	}
	
	$row1.="</td>";
	$row2.="</td>";
	$row3.="</td>";
	$row4.="</td>";
	$row5.="</td>";
	$row6.="</td>";
	 
	
	$row1 = json_encode($row1);
	$row2 = json_encode($row2);
	$row3 = json_encode($row3);
	$row4 = json_encode($row4);
	$row5 = json_encode($row5);
	$row6 = json_encode($row6);
	 
 
	
	//0
	$resulth2=str_replace("\"","",$sm);
	
	$resulth2=str_replace(":",",",$resulth2);
	$resulth2=str_replace("[","",$resulth2);
	$resulth2=str_replace("]","",$resulth2);
	$resulth22=str_replace("|","|",$resulth2);
	
	
	//1
	$row1=$row1;
	$row1=str_replace(" ","",$row1);
	$row1=str_replace("<tdvalign=topclass='z_cl'>","",$row1);
	  
	 $row1=str_replace("<\/td>","",$row1);
	 $row1=str_replace(",","|",$row1);
	$row1=str_replace(",","|",$row1);
	$row1=str_replace("\"","",$row1);
	$row1=str_replace("[","",$row1);
	$row1=str_replace("]","",$row1);
	$row1=str_replace("<br\/>",",",$row1);
	
	
	 
	/*
	格式化内容
	2
	*/
	 $row2=str_replace(" ","",$row2);
	$row2=str_replace("<tdvalign=topclass='z_cl'>","",$row2);
	 $row2=str_replace("<spanstyle=\\color:red;\\>","",$row2);
	   
	 $row2=str_replace("<\/span>","",$row2);
	  
	 $row2=str_replace("<spanstyle=\\color:#009100;\\>","",$row2);
	 $row2=str_replace("<\/td>","",$row2);
 
	$row2=str_replace(",","|",$row2);
	$row2=str_replace("\"","",$row2);
	$row2=str_replace("[","",$row2);
	$row2=str_replace("]","",$row2);
	$row2=str_replace("<br>",",",$row2);
	 
	 
	 //3
	 $row3=str_replace(" ","",$row3);
	$row3=str_replace("<tdvalign=topclass='z_cl'>","",$row3);
	 $row3=str_replace("<spanstyle=\\color:red;\\>","",$row3);
	   
	 $row3=str_replace("<\/span>","",$row3);
	  
	 $row3=str_replace("<spanstyle=\\color:#009100;\\>","",$row3);
	 $row3=str_replace("<\/td>","",$row3);
 
	$row3=str_replace(",","|",$row3);
	$row3=str_replace("\"","",$row3);
	$row3=str_replace("[","",$row3);
	$row3=str_replace("]","",$row3);
	$row3=str_replace("<br>",",",$row3);
	 
	//4
	 $row4=str_replace(" ","",$row4);
	$row4=str_replace("<tdvalign=topclass='z_cl'>","",$row4);
	 $row4=str_replace("<spanstyle=\\color:red;\\>","",$row4);
	   
	 $row4=str_replace("<\/span>","",$row4);
	  
	 $row4=str_replace("<spanstyle=\\color:#009100;\\>","",$row4);
	 $row4=str_replace("<\/td>","",$row4);
 
	$row4=str_replace(",","|",$row4);
	$row4=str_replace("\"","",$row4);
	$row4=str_replace("[","",$row4);
	$row4=str_replace("]","",$row4);
	$row4=str_replace("<br>",",",$row4);
	//5
	 $row5=str_replace(" ","",$row5);
	$row5=str_replace("<tdvalign=topclass='z_cl'>","",$row5);
	 $row5=str_replace("<spanstyle=\\color:red;\\>","",$row5);
	   
	 $row5=str_replace("<\/span>","",$row5);
	  
	 $row5=str_replace("<spanstyle=\\color:#009100;\\>","",$row5);
	 $row5=str_replace("<\/td>","",$row5);
 
	$row5=str_replace(",","|",$row5);
	$row5=str_replace("\"","",$row5);
	$row5=str_replace("[","",$row5);
	$row5=str_replace("]","",$row5);
	$row5=str_replace("<br>",",",$row5);
	
	//6
	 $row6=str_replace(" ","",$row6);
	$row6=str_replace("<tdvalign=topclass='z_cl'>","",$row6);
	 $row6=str_replace("<spanstyle=\\color:red;\\>","",$row6);
	   
	 $row6=str_replace("<\/span>","",$row6);
	  
	 $row6=str_replace("<spanstyle=\\color:#009100;\\>","",$row6);
	 $row6=str_replace("<\/td>","",$row6);
 
	$row6=str_replace(",","|",$row6);
	$row6=str_replace("\"","",$row6);
	$row6=str_replace("[","",$row6);
	$row6=str_replace("]","",$row6);
	$row6=str_replace("<br>",",",$row6);
	
	
	//echo $resultd1;
	//echo '{"status":"1","long":"'.$resulth22 .'","ph_content":["10,1|15,1|12,1|11,1|12,1|11,1|19,1|13,3|9,1|11,2","大,4|小,1|大,1|小,2|大,2|小,1|大,1|小,1|大,4|小,3","雙,1|單,3|雙,2|單,4|雙,1|單,1|雙,1|單,1|雙,1|單,8"],"ph_title":"冠亞軍和|冠亞軍和大小|冠亞軍和單雙"}';
 echo '{"status":"1","long":"'.$resulth22.'","ph_content":["'.$row1.'","'.$row2.'","'.$row3.'","'.$row4.'","'.$row5.'","'.$row6.'"],"ph_title":"\u7e3d\u548c\u6578\u007c\u7e3d\u548c\u5927\u5c0f\u007c\u7e3d\u548c\u55ae\u96d9\u007c\u4e94\u884c\u007c\u524d\u5f8c\u548c\u007c\u55ae\u96d9\u548c"}';

?>