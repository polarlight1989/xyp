<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  Author QQ: 1234567
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'classed/DeBe.php';

//ǰ�_����
$Home[0] = 'oa.minyuetai.com';//�ɼ���ַ
$Home[1] = '127.0.0.1';//��Ա����
$Home[2] = '';
$Home[3] = '';
$Home[4] = '';
$Home[5] = '';
$Home[6] = '';
$Home[7] = '';
$Home[8] = '';
$Home[9] = '';

//ǰ�_�˿�
$Port[0] = '80';//�ɼ��˿�
$Port[1] = '80';//��Ա�˿�
$Port[2] = '';
$Port[3] = '';
$Port[4] = '';
$Port[5] = '';
$Port[6] = '';
$Port[7] = '';
$Port[8] = '';
$Port[9] = '';

//���_����
$sHome[0] = 'ht.minyuetai.com';
$sHome[1] = '127.0.0.2';//��������
$sHome[2] = '';
$sHome[3] = '';
$sHome[4] = '';
$sHome[5] = '';
$sHome[6] = '';
$sHome[7] = '';
$sHome[8] = '';
$sHome[9] = '';

//���_�˿�
$sPort[0] = '80';
$sPort[1] = '80';//����˿�
$sPort[2] = '';
$sPort[3] = '';
$sPort[4] = '';
$sPort[5] = '';
$sPort[6] = '';
$sPort[7] = '';
$sPort[8] = '';
$sPort[9] = '';

//��������
$hHome[0] = '';
$hHome[1] = '';
$hHome[2] = '';
$hHome[3] = '';
$hHome[4] = '';
$hHome[5] = '';
$hHome[6] = '';
$hHome[7] = '';
$hHome[8] = '';
$hHome[9] = '';

//�����˿�
$hPort[0] = '';
$hPort[1] = '';
$hPort[2] = '';
$hPort[3] = '';
$hPort[4] = '';
$hPort[5] = '';
$hPort[6] = '';
$hPort[7] = '';
$hPort[8] = '';
$hPort[9] = '';


//�ֻ�����
$mHome[0] = 'oaxyp.levy.com';//�ɼ���ַ
$mHome[1] = '';//��Ա����
$mHome[2] = '';
$mHome[3] = '';
$mHome[4] = '';
$mHome[5] = '';
$mHome[6] = '';
$mHome[7] = '';
$mHome[8] = '';
$mHome[9] = '';

//ǰ�_�˿�
$mPort[0] = '82';//�ɼ��˿�
$mPort[1] = '80';//��Ա�˿�
$mPort[2] = '';
$mPort[3] = '';
$mPort[4] = '';
$mPort[5] = '';
$mPort[6] = '';
$mPort[7] = '';
$mPort[8] = '';
$mPort[9] = '';


$db=new DB();
$resultTime = $db->query('select * from g_config limit 1',1);


//ÿ��P���_���r�g
$stratGame = date('Y-m-d').' '.$resultTime[0]['g_open_time_gd'];

//ÿ��P���P�]�r�g
$endGame = date('Y-m-d').' 23:00:00';

//ÿ��P���_���r�g
$stratGamecq = date('Y-m-d').' '.$resultTime[0]['g_open_time_cq'];

//ÿ��P���P�]�r�g
$endGamecq = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 01:55';

//ÿ��P���_���r�g
$stratGamejxssc = date('Y-m-d').' '.'00:00:02';

//ÿ��P���P�]�r�g
$endGamejxssc = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).'00:00:01';

//ÿ��P���_���r�g
$stratGamexjssc = date('Y-m-d').' '.$resultTime[0]['g_open_time_xjssc'];

//ÿ��P���P�]�r�g
$endGamexjssc = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 02:00:00';

//ÿ��P���_���r�g
$stratGametjssc = date('Y-m-d').' '.$resultTime[0]['g_open_time_tjssc'];

//ÿ��P���P�]�r�g
$endGametjssc = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d'), date('Y'))).' 23:30:00';

//ÿ��P���_���r�g
$stratGamexyft = date('Y-m-d').' '.'00:00:02';

//ÿ��P���P�]�r�g
$endGamexyft = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).'00:00:01';

//ÿ��P���_���r�g
$stratGamenc = date('Y-m-d').' '.$resultTime[0]['g_open_time_nc'];

//ÿ��P���P�]�r�g
$endGamenc = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 02:03';
//$endGamenc = date('Y-m-d').' 16:57:00';



//ÿ��P���_���r�g
$stratGamepk = date('Y-m-d').' '.$resultTime[0]['g_open_time_pk'];

//ÿ��P���P�]�r�g
$endGamepk = date('Y-m-d').' 23:57:00';

//ÿ��P���_���r�g
$stratGamesz = date('Y-m-d').' '.$resultTime[0]['g_open_time_sz'];

//ÿ��P���P�]�r�g
$endGamesz = date('Y-m-d').' 22:10:00';
//$endGamesz = date('Y-m-d').' 23:59:00';
//$endGamesz =  date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 05:54';
//ÿ��P���_���r�g
$stratGamekl8 = date('Y-m-d').' '.$resultTime[0]['g_open_time_kl8'];

//ÿ��P���P�]�r�g
$endGamekl8 = date('Y-m-d').' 23:55:00';
//$endGamekl8 = date('Y-m-d').' 16:57:00';

$oncontextmenu = ''; //oncontextmenu="return false"


?>