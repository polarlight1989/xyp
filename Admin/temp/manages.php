<?php 
define('Copyright', 'Author QQ: 1234567');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Admin/ExistUser.php';
include_once ROOT_PATH.'Admin/config/AdminConfig.php';
include_once ROOT_PATH.'functioned/peizhi.php';
global $ConfigModel,$Users;

$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;
$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
if ($LoginId== 89){
$resulth = $db->query("SELECT g_zhud,g_cj,g_gg FROM j_manage where g_name='{$name}'  ORDER BY g_id DESC LIMIT 1 ", 0);
} 
if (isset($Users[0]['g_lock_1_1'])){
	if ($Users[0]['g_lock_1_1'] !=1) 
		exit(back('您的權限不足！'));
}
markPos("后台-系统设置");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!Matchs::isNumber($_POST['mix_money'])) exit(back('最低金額輸入錯誤！'));
	if (!Matchs::isNumber($_POST['max_money'], 1, 8)) exit(back('最高派彩輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix'])) exit(back('連續值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix_pk'])) exit(back('北京赛车連續值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num'], 1, 8)) exit(back('1-8球總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num_pk'], 1, 8)) exit(back('北京赛车1-10名總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str'], 1, 8)) exit(back('雙面總值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['up_odds_mix_cq'])) exit(back('連續值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_num_cq'], 1, 8)) exit(back('1-5球總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str_cq'], 1, 8)) exit(back('雙面總值輸入錯誤！'));
	if (!Matchs::isFloating($_POST['odds_str_pk'], 1, 8)) exit(back('北京赛车雙面總值輸入錯誤！'));
	if (!Matchs::isNumber($_POST['insert_number_day'])) exit(back('加載期數輸入錯誤！'));
	if (!Matchs::isFloating($_POST['close_time'])) exit(back('封盤時間輸入錯誤！'));
	if (!Matchs::isNumber($_POST['login_log_lock'])) exit(back('保存日誌格式錯誤！'));
	if (!Matchs::isNumber($_POST['out_time'])) exit(back('過期時間格式錯誤！'));
	if (!Matchs::isFloating($_POST['odds_ratio_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b1']));
	if (!Matchs::isFloating($_POST['odds_ratio_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b2']));
	if (!Matchs::isFloating($_POST['odds_ratio_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b3']));
	if (!Matchs::isFloating($_POST['odds_ratio_b4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b4']));
	if (!Matchs::isFloating($_POST['odds_ratio_b5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_b5']));
	if (!Matchs::isFloating($_POST['odds_ratio_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c1']));
	if (!Matchs::isFloating($_POST['odds_ratio_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c2']));
	if (!Matchs::isFloating($_POST['odds_ratio_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c3']));
	if (!Matchs::isFloating($_POST['odds_ratio_c4'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c4']));
	if (!Matchs::isFloating($_POST['odds_ratio_c5'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_c5']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b1']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b2']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_b3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_b3']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c1'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c1']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c2'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c2']));
	if (!Matchs::isFloating($_POST['odds_ratio_cq_c3'])) exit(back('參數設置錯誤！'.$_POST['odds_ratio_cq_c3']));

	
	$List = array();
	for ($i=1; $i<=10; $i++){
		$List['g_game_'.$i.''] = empty($_POST['game_'.$i.'']) ? 0 : $_POST['game_'.$i.''];
		if ($i<=7)
			$List['g_game_cq_'.$i.''] = empty($_POST['game_cq_'.$i.'']) ? 0 : $_POST['game_cq_'.$i.''];
		if ($i<=5||$i>=9){
			$List['g_game_gx_'.$i.''] = empty($_POST['game_gx_'.$i.'']) ? 0 : $_POST['game_gx_'.$i.''];
			}
		if ($i<=3)
			$List['g_game_pk_'.$i.''] = empty($_POST['game_pk_'.$i.'']) ? 0 : $_POST['game_pk_'.$i.''];
	}
	$List['g_web_lock'] = $_POST['web_lock'];
	$List['g_web_text'] = strip_tags($_POST['web_text']);
	$List['g_kg_game_lock'] = empty($_POST['kg_game_lock']) ? 0 : $_POST['kg_game_lock'];
	$List['g_cq_game_lock'] = empty($_POST['cq_game_lock']) ? 0 : $_POST['cq_game_lock'];
	$List['g_sz_game_lock'] = empty($_POST['sz_game_lock']) ? 0 : $_POST['sz_game_lock'];
	$List['g_pk_game_lock'] = empty($_POST['pk_game_lock']) ? 0 : $_POST['pk_game_lock'];
	$List['g_kl8_game_lock'] = empty($_POST['kl8_game_lock']) ? 0 : $_POST['kl8_game_lock'];
	$List['g_jxssc_game_lock'] = empty($_POST['jxssc_game_lock']) ? 0 : $_POST['jxssc_game_lock'];
	$List['g_xjssc_game_lock'] = empty($_POST['xjssc_game_lock']) ? 0 : $_POST['xjssc_game_lock'];
	$List['g_tjssc_game_lock'] = empty($_POST['tjssc_game_lock']) ? 0 : $_POST['tjssc_game_lock'];
	$List['g_xyft_game_lock'] = empty($_POST['xyft_game_lock']) ? 0 : $_POST['xyft_game_lock'];
	$List['g_gd115_game_lock'] = empty($_POST['gd115_game_lock']) ? 0 : $_POST['gd115_game_lock'];
	$List['g_nc_game_lock'] = empty($_POST['nc_game_lock']) ? 0 : $_POST['nc_game_lock'];
	$List['g_restore_money_lock'] = $_POST['restore_money_lock'];
	$List['g_mix_money'] = $_POST['mix_money'];
	$List['g_max_money'] = $_POST['max_money'];
	$List['g_odds_ratio_b1'] = $_POST['odds_ratio_b1'];
	$List['g_odds_ratio_b2'] = $_POST['odds_ratio_b2'];
	$List['g_odds_ratio_b3'] = $_POST['odds_ratio_b3'];
	$List['g_odds_ratio_b4'] = $_POST['odds_ratio_b4'];
	$List['g_odds_ratio_b5'] = $_POST['odds_ratio_b5'];
	$List['g_odds_ratio_c1'] = $_POST['odds_ratio_c1'];
	$List['g_odds_ratio_c2'] = $_POST['odds_ratio_c2'];
	$List['g_odds_ratio_c3'] = $_POST['odds_ratio_c3'];
	$List['g_odds_ratio_c4'] = $_POST['odds_ratio_c4'];
	$List['g_odds_ratio_c5'] = $_POST['odds_ratio_c5'];
	$List['g_odds_ratio_cq_b1'] = $_POST['odds_ratio_cq_b1'];
	$List['g_odds_ratio_cq_b2'] = $_POST['odds_ratio_cq_b2'];
	$List['g_odds_ratio_cq_b3'] = $_POST['odds_ratio_cq_b3'];
	$List['g_odds_ratio_cq_c1'] = $_POST['odds_ratio_cq_c1'];
	$List['g_odds_ratio_cq_c2'] = $_POST['odds_ratio_cq_c2'];
	$List['g_odds_ratio_cq_c3'] = $_POST['odds_ratio_cq_c3'];
	$List['g_odds_ratio_gx_b1'] = $_POST['odds_ratio_gx_b1'];
	$List['g_odds_ratio_gx_b2'] = $_POST['odds_ratio_gx_b2'];
	$List['g_odds_ratio_gx_b3'] = $_POST['odds_ratio_gx_b3'];
	$List['g_odds_ratio_gx_b4'] = $_POST['odds_ratio_gx_b4'];
	$List['g_odds_ratio_gx_b5'] = $_POST['odds_ratio_gx_b5'];
	$List['g_odds_ratio_gx_c1'] = $_POST['odds_ratio_gx_c1'];
	$List['g_odds_ratio_gx_c2'] = $_POST['odds_ratio_gx_c2'];
	$List['g_odds_ratio_gx_c3'] = $_POST['odds_ratio_gx_c3'];
	$List['g_odds_ratio_gx_c4'] = $_POST['odds_ratio_gx_c4'];
	$List['g_odds_ratio_gx_c5'] = $_POST['odds_ratio_gx_c5'];
	$List['g_login_log_lock'] = $_POST['login_log_lock'];
	$List['g_out_time'] = $_POST['out_time'];
	$List['g_son_member_lock'] = $_POST['son_member_lock'];
	$List['g_cry_select_lock'] = $_POST['cry_select_lock'];
	$List['g_nowrecord_lock'] = $_POST['nowrecord_lock'];
	$List['g_automatic_bu_huo_lock'] = $_POST['automatic_bu_huo_lock'];
	$List['g_odds_execution_lock'] = $_POST['odds_execution_lock'];
	$List['g_up_odds_mix'] = $_POST['up_odds_mix'];
	$List['g_up_odds_mix_pk'] = $_POST['up_odds_mix_pk'];
	$List['g_odds_num_pk'] = $_POST['odds_num_pk'];
	$List['g_odds_str_pk'] = $_POST['odds_str_pk'];
	$List['g_odds_num'] = $_POST['odds_num'];
	$List['g_odds_str'] = $_POST['odds_str'];
	$List['g_up_odds_mix_cq'] = $_POST['up_odds_mix_cq'];
	$List['g_odds_num_cq'] = $_POST['odds_num_cq'];
	$List['g_odds_str_cq'] = $_POST['odds_str_cq'];
	$List['g_odds_num_nc'] = $_POST['odds_num_nc'];
	$List['g_odds_str_nc'] = $_POST['odds_str_nc'];
	$List['g_up_odds_mix_gx'] = $_POST['up_odds_mix_gx'];
	$List['g_odds_num_gx'] = $_POST['odds_num_gx'];
	$List['g_odds_str_gx'] = $_POST['odds_str_gx'];
	$List['g_automatic_money_lock'] = $_POST['automatic_money_lock'];
	$List['g_automatic_open_number_lock'] = $_POST['automatic_open_number_lock'];
	$List['g_automatic_open_result_lock'] = $_POST['automatic_open_result_lock'];
	$List['g_gd_op'] = $_POST['g_gd_ope'];
	$List['g_cp_op'] = $_POST['g_cp_ope'];
	$List['g_pk_op'] = $_POST['g_pk_ope'];
	$List['g_js_op'] = $_POST['g_js_ope'];
	$List['g_kl8_op'] = $_POST['g_kl8_ope'];
	$List['g_jxssc_op'] = $_POST['g_jxssc_op'];
	$List['g_xjssc_op'] = $_POST['g_xjssc_op'];
	$List['g_tjssc_op'] = $_POST['g_tjssc_op'];
	$List['g_xyft_op'] = $_POST['g_xyft_op'];
	$List['g_gd115_op'] = $_POST['g_gd115_op'];
	$List['g_nc_op'] = $_POST['g_nc_op'];
	$List['g_insert_number_day'] = $_POST['insert_number_day'];
	$List['g_close_time'] = $_POST['close_time'];
	$List['g_open_time_gd'] = $_POST['open_time_gd'];
	$List['g_open_time_cq'] = $_POST['open_time_cq'];
	$List['g_open_time_sz'] = $_POST['open_time_sz'];
	$List['g_open_time_pk'] = $_POST['open_time_pk'];
	$List['g_open_time_kl8'] = $_POST['open_time_kl8'];
	$List['g_open_time_jxssc'] = $_POST['open_time_jxssc'];
	$List['g_open_time_xjssc'] = $_POST['open_time_xjssc'];
	$List['g_open_time_tjssc'] = $_POST['open_time_tjssc'];
	$List['g_open_time_xyft'] = $_POST['open_time_xyft'];
	$List['g_open_time_gd115'] = $_POST['open_time_gd115'];
	$List['g_open_time_nc'] = $_POST['open_time_nc'];
	$List['g_gxdh'] = $_POST['g_gxdh'];
	
	$sql = "UPDATE g_config SET 
	g_web_lock='{$List['g_web_lock']}',
	g_web_text='{$List['g_web_text']}',
	g_kg_game_lock='{$List['g_kg_game_lock']}',
	g_cq_game_lock='{$List['g_cq_game_lock']}',
	g_sz_game_lock='{$List['g_sz_game_lock']}',
	g_pk_game_lock='{$List['g_pk_game_lock']}',
	g_kl8_game_lock='{$List['g_kl8_game_lock']}',
	g_jxssc_game_lock='{$List['g_jxssc_game_lock']}',
	g_xjssc_game_lock='{$List['g_xjssc_game_lock']}',
	g_tjssc_game_lock='{$List['g_tjssc_game_lock']}',
	g_xyft_game_lock='{$List['g_xyft_game_lock']}',
	g_gd115_game_lock='{$List['g_gd115_game_lock']}',
	g_nc_game_lock='{$List['g_nc_game_lock']}',
	g_restore_money_lock='{$List['g_restore_money_lock']}',
	g_restore_money_lock='{$List['g_restore_money_lock']}',
	g_mix_money='{$List['g_mix_money']}',
	g_max_money='{$List['g_max_money']}',
	g_odds_ratio_b1='{$List['g_odds_ratio_b1']}',
	g_odds_ratio_b2='{$List['g_odds_ratio_b2']}',
	g_odds_ratio_b3='{$List['g_odds_ratio_b3']}',
	g_odds_ratio_b4='{$List['g_odds_ratio_b4']}',
	g_odds_ratio_b5='{$List['g_odds_ratio_b5']}',
	g_odds_ratio_c1='{$List['g_odds_ratio_c1']}',
	g_odds_ratio_c2='{$List['g_odds_ratio_c2']}',
	g_odds_ratio_c3='{$List['g_odds_ratio_c3']}',
	g_odds_ratio_c4='{$List['g_odds_ratio_c4']}',
	g_odds_ratio_c5='{$List['g_odds_ratio_c5']}',
	g_odds_ratio_cq_b1='{$List['g_odds_ratio_cq_b1']}',
	g_odds_ratio_cq_b2='{$List['g_odds_ratio_cq_b2']}',
	g_odds_ratio_cq_b3='{$List['g_odds_ratio_cq_b3']}',
	g_odds_ratio_cq_c1='{$List['g_odds_ratio_cq_c1']}',
	g_odds_ratio_cq_c2='{$List['g_odds_ratio_cq_c2']}',
	g_odds_ratio_cq_c3='{$List['g_odds_ratio_cq_c3']}',
	g_login_log_lock = '{$List['g_login_log_lock']}',
	g_son_member_lock = '{$List['g_son_member_lock']}',
	g_cry_select_lock='{$List['g_cry_select_lock']}',
	g_nowrecord_lock='{$List['g_nowrecord_lock']}',
	g_automatic_bu_huo_lock='{$List['g_automatic_bu_huo_lock']}',
	g_odds_execution_lock='{$List['g_odds_execution_lock']}',
	g_up_odds_mix='{$List['g_up_odds_mix']}',
	g_odds_num='{$List['g_odds_num']}',
	g_odds_str='{$List['g_odds_str']}',
	g_up_odds_mix_pk='{$List['g_up_odds_mix_pk']}',
	g_odds_num_pk='{$List['g_odds_num_pk']}',
	g_odds_str_pk='{$List['g_odds_str_pk']}',
	g_up_odds_mix_cq='{$List['g_up_odds_mix_cq']}',
	g_odds_num_cq='{$List['g_odds_num_cq']}',
	g_odds_str_cq='{$List['g_odds_str_cq']}',
	g_up_odds_mix_gx='{$List['g_up_odds_mix_gx']}',
	g_odds_num_gx='{$List['g_odds_num_gx']}',
	g_odds_str_gx='{$List['g_odds_str_gx']}',
	g_automatic_money_lock='{$List['g_automatic_money_lock']}',
	g_gd_op='{$List['g_gd_op']}',
	g_cp_op='{$List['g_cp_op']}',
	g_pk_op='{$List['g_pk_op']}',
	g_js_op='{$List['g_js_op']}',
	g_kl8_op='{$List['g_kl8_op']}',
	g_jxssc_op='{$List['g_jxssc_op']}',
	g_xjssc_op='{$List['g_xjssc_op']}',
	g_tjssc_op='{$List['g_tjssc_op']}',
	g_xyft_op='{$List['g_xyft_op']}',
	g_gd115_op='{$List['g_gd115_op']}',
	g_nc_op='{$List['g_nc_op']}',
	g_automatic_open_number_lock='{$List['g_automatic_open_number_lock']}',
	g_automatic_open_result_lock='{$List['g_automatic_open_result_lock']}',
	g_insert_number_day='{$List['g_insert_number_day']}',
	g_close_time='{$List['g_close_time']}',
	g_out_time='{$List['g_out_time']}',
	g_open_time_gd='{$List['g_open_time_gd']}',
	g_open_time_cq='{$List['g_open_time_cq']}',
	g_open_time_sz='{$List['g_open_time_sz']}',
	g_open_time_pk='{$List['g_open_time_pk']}',
	g_open_time_kl8='{$List['g_open_time_kl8']}',
	g_open_time_jxssc='{$List['g_open_time_jxssc']}',
	g_open_time_xjssc='{$List['g_open_time_xjssc']}',
	g_open_time_tjssc='{$List['g_open_time_tjssc']}',
	g_open_time_xyft='{$List['g_open_time_xyft']}',
	g_open_time_gd115='{$List['g_open_time_gd115']}',
	g_open_time_nc='{$List['g_open_time_nc']}',
	g_game_cq_1='{$List['g_game_cq_1']}',
	g_game_cq_2='{$List['g_game_cq_2']}',
	g_game_cq_3='{$List['g_game_cq_3']}',
	g_game_cq_4='{$List['g_game_cq_4']}',
	g_game_cq_5='{$List['g_game_cq_5']}',
	g_game_cq_6='{$List['g_game_cq_6']}',
	g_game_cq_7='{$List['g_game_cq_7']}',
	g_gxdh='{$List['g_gxdh']}',
	g_game_1='{$List['g_game_1']}',
	g_game_2='{$List['g_game_2']}',
	g_game_3='{$List['g_game_3']}',
	g_game_4='{$List['g_game_4']}',
	g_game_5='{$List['g_game_5']}',
	g_game_6='{$List['g_game_6']}',
	g_game_7='{$List['g_game_7']}',
	g_game_8='{$List['g_game_8']}',
	g_game_9='{$List['g_game_9']}',
	g_game_10='{$List['g_game_10']}',
	
	g_game_jxssc_1='{$_POST['game_jxssc_1']}',
	g_game_jxssc_2='{$_POST['game_jxssc_2']}',
	g_game_jxssc_3='{$_POST['game_jxssc_3']}',
	g_game_jxssc_4='{$_POST['game_jxssc_4']}',
	g_game_jxssc_5='{$_POST['game_jxssc_5']}',
	g_game_jxssc_6='{$_POST['game_jxssc_6']}',
	g_game_jxssc_7='{$_POST['game_jxssc_7']}',
	g_up_odds_mix_jxssc='{$_POST['up_odds_mix_jxssc']}',
	g_odds_num_jxssc='{$_POST['odds_num_jxssc']}',
	g_odds_str_jxssc='{$_POST['odds_str_jxssc']}',
	
	g_game_xjssc_1='{$_POST['game_xjssc_1']}',
	g_game_xjssc_2='{$_POST['game_xjssc_2']}',
	g_game_xjssc_3='{$_POST['game_xjssc_3']}',
	g_game_xjssc_4='{$_POST['game_xjssc_4']}',
	g_game_xjssc_5='{$_POST['game_xjssc_5']}',
	g_game_xjssc_6='{$_POST['game_xjssc_6']}',
	g_game_xjssc_7='{$_POST['game_xjssc_7']}',
	g_up_odds_mix_xjssc='{$_POST['up_odds_mix_xjssc']}',
	g_odds_num_xjssc='{$_POST['odds_num_xjssc']}',
	g_odds_str_xjssc='{$_POST['odds_str_xjssc']}',
	
	g_game_tjssc_1='{$_POST['game_tjssc_1']}',
	g_game_tjssc_2='{$_POST['game_tjssc_2']}',
	g_game_tjssc_3='{$_POST['game_tjssc_3']}',
	g_game_tjssc_4='{$_POST['game_tjssc_4']}',
	g_game_tjssc_5='{$_POST['game_tjssc_5']}',
	g_game_tjssc_6='{$_POST['game_tjssc_6']}',
	g_game_tjssc_7='{$_POST['game_tjssc_7']}',
	g_up_odds_mix_tjssc='{$_POST['up_odds_mix_tjssc']}',
	g_odds_num_tjssc='{$_POST['odds_num_tjssc']}',
	g_odds_str_tjssc='{$_POST['odds_str_tjssc']}',
	
	g_game_xyft_1='{$_POST['game_xyft_1']}',
	g_game_xyft_2='{$_POST['game_xyft_2']}',
	g_game_xyft_3='{$_POST['game_xyft_3']}',
	g_up_odds_mix_xyft='{$_POST['up_odds_mix_xyft']}',
	g_odds_num_xyft='{$_POST['odds_num_xyft']}',
	g_odds_str_xyft='{$_POST['odds_str_xyft']}',
	
	g_game_nc_1='{$_POST['game_nc_1']}',
	g_game_nc_2='{$_POST['game_nc_2']}',
	g_game_nc_3='{$_POST['game_nc_3']}',
	g_game_nc_4='{$_POST['game_nc_4']}',
	g_game_nc_5='{$_POST['game_nc_5']}',
	g_game_nc_6='{$_POST['game_nc_6']}',
	g_game_nc_7='{$_POST['game_nc_7']}',
	g_game_nc_8='{$_POST['game_nc_8']}',
	g_game_nc_9='{$_POST['game_nc_9']}',
	g_game_nc_10='{$_POST['game_nc_10']}',
	g_up_odds_mix_nc='{$_POST['up_odds_mix_nc']}',
	g_odds_num_nc='{$_POST['odds_num_nc']}',
	g_odds_str_nc='{$_POST['odds_str_nc']}',
	
	g_game_gd115_1='{$_POST['game_gd115_1']}',
	g_game_gd115_2='{$_POST['game_gd115_2']}',
	g_game_gd115_3='{$_POST['game_gd115_3']}',
	g_up_odds_mix_gd115='{$_POST['up_odds_mix_gd115']}',
	g_odds_num_gd115='{$_POST['odds_num_gd115']}',
	g_odds_str_gd115='{$_POST['odds_str_gd115']}',
	
	g_game_pk_1='{$List['g_game_pk_1']}',
	g_game_pk_2='{$List['g_game_pk_2']}',
	g_game_pk_3='{$List['g_game_pk_3']}'
	WHERE g_id = '{$ConfigModel['g_id']}' LIMIT 1";
	$db->query($sql, 2);
	exit(alert_href('更變成功', 'manages.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("確認更變嗎？"))
				return true;
		return false;
	}
	
	
		function hybyh(){
		$.ajax({
			type : "POST",
			url : "hybyh.php",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						hybyh();
						return false;
					}
				}
			},
			success:function(data){
				if(data==1){
				alert("金额还原成功!");
				}else{
				alert("金额还原失败!");
				}
			}
		});
	}
	
	function hybyhxy(){
		$.ajax({
			type : "POST",
			url : "hybyhxy.php",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						hybyhxy();
						return false;
					}
				}
			},
			success:function(data){
				if(data==1){
				alert("金額校驗成功!");
				}else{
				alert("金額校驗失敗!");
				}
			}
		});
	}
-->
</script>
<script language="javascript">
    function check(){
    var data=document.getElementById("open_time_gd").value;
	var data2=document.getElementById("open_time_cq").value;
	var data3=document.getElementById("open_time_gx").value;
	var data5=document.getElementById("open_time_pk").value;
	var data6=document.getElementById("open_time_kl8").value;
    if(data.substr(2,1)!=":" || data.substr(5,1)!=":"){
       alert("广东快乐十分输入的时间不合法!!");
        return false;
	}
	 if(data2.substr(2,1)!=":" || data2.substr(5,1)!=":"){
       alert("重庆时时彩输入的时间不合法!!");
        return false;
	}
	 if(data3.substr(2,1)!=":" || data3.substr(5,1)!=":"){
       alert("广西快乐十分输入的时间不合法!!");
        return false;
	}
	if(data5.substr(2,1)!=":" || data5.substr(5,1)!=":"){
       alert("北京赛车输入的时间不合法!!");
        return false;
	}
	if(data6.substr(2,1)!=":" || data6.substr(5,1)!=":"){
       alert("快樂8输入的时间不合法!!");
        return false;
	}
  var checkdata=data.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  var checkdata2=data2.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  var checkdata3=data3.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
	var checkdata5=data5.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
	var checkdata6=data6.match(/^(\d{2})(:)?(\d{2})\2(\d{2})$/);
  if(checkdata==null)
    {
       alert("广东快乐十分请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata2==null)
    {
       alert("重庆时时彩请输入正确的时间,谢谢!!");
       return false;
    }
  if(checkdata[1]>24||checkdata[3]>60||checkdata[4]>60)
    {
       alert("广东快乐十分输入的时间不合法!!");
       return false;
    }
	if(checkdata2[1]>24||checkdata2[3]>60||checkdata2[4]>60)
    {
       alert("重庆时时彩输入的时间不合法!!");
       return false;
    }
	if(checkdata3==null)
    {
       alert("广西快乐十分请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata3[1]>24||checkdata3[3]>60||checkdata3[4]>60)
    {
       alert("广西快乐十分输入的时间不合法!!");
       return false;
    }
	if(checkdata5==null)
    {
       alert("北京赛车请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata5[1]>24||checkdata5[3]>60||checkdata5[4]>60)
    {
       alert("北京赛车输入的时间不合法!!");
       return false;
    }
	if(checkdata6==null)
    {
       alert("快樂8请输入正确的时间,谢谢!!");
       return false;
    }
	if(checkdata6[1]>24||checkdata6[3]>60||checkdata6[4]>60)
    {
       alert("快樂8输入的时间不合法!!");
       return false;
    }
   return isForm();
}
</script>
</head>
<body>
<form action="" method="post" onsubmit="return isForm()">
  <table width="100%" height="99.3%" border="0" cellspacing="0" class="a">
    <tr>
      <td width="5" height="100%" bgcolor="#4F4F4F"></td>
        <td class="c">
      <table border="0" cellspacing="0" class="main">
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_03.gif" alt="" /></td>
          <td background="/Admin/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="17"><img src="/Admin/temp/images/tb.gif" width="16" height="16" /></td>
                <td width="99%"><font style="font-weight:bold" color="#344B50">&nbsp;系統管理</font></td>
              </tr>
            </table></td>
          <td width="16"><img src="/Admin/temp/images/tab_07.gif" alt="" /></td>
        </tr>
          <tr>
        
        <td class="t"></td>
          <td class="c">
        
        <!-- strat -->
        <table border="0" cellspacing="0" class="conter">
          <tr class="tr_top">
            <th colspan="2">基本設置</th>
          </tr>
          <tr style="height:38px">
            <td class="bj">網站開啟:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_web_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio"  name="web_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_web_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="web_lock" value="0" /></td>
          </tr>
          <!--<tr>
            <td height="80" class="bj">代理Logo</td>
            <td class="left_p6"><iframe scrolling="no" frameborder="0" width="750" height="50" src="/m/UploadFile.htm"></iframe>
              &nbsp;&nbsp; <img src="/m/WebLogo.jpg" id="ProxyLogo" style="position:relative;top:0px" width="100" height="34" /></td>
          </tr>
          <tr>
            <td height="80" class="bj">會員Logo</td>
            <td class="left_p6"><iframe scrolling="no" frameborder="0" width="750" height="50" src="/m/UploadFile2.htm"></iframe>
              &nbsp;&nbsp; <img src="/m/TopLogo_132.jpg" id="ProxyLogo" style="position:relative;top:0px" width="100" height="34" /></td>
          </tr>-->
          <tr style="height:36px">
            <td class="bj">網站关闭提示:</td>
            <td class="left_p6"><textarea style="height:20px;color:red" name="web_text"><?php echo $ConfigModel['g_web_text']?></textarea>
              &nbsp;&nbsp;
              現在关闭提示：[<?php echo $ConfigModel['g_web_text']?>]</td>
          </tr>
          <tr style="height:38px">
            <td class="bj">直屬會員註冊:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_son_member_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="son_member_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_son_member_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="son_member_lock" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">自動補貨限制:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_automatic_bu_huo_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_bu_huo_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_automatic_bu_huo_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_bu_huo_lock" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">占成自由調整:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_gxdh']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_gxdh" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_gxdh']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_gxdh" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">日誌保存:</td>
            <td class="left_p6"><input class="textc" type="text" name="login_log_lock" value="<?php echo $ConfigModel['g_login_log_lock']?>" />
              &nbsp;&nbsp; <span class="odds">(系統將會自動刪除超出天數的日誌;需要修改請聯系技術員.)</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">過期時間:</td>
            <td class="left_p6"><input class="textc" type="text" name="out_time" value="<?php echo $ConfigModel['g_out_time']?>" />
              &nbsp;&nbsp; <span class="odds">分鐘(用戶連續幾分鍾不動系統自動Ｔ出。)</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">報表查詢:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_cry_select_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="cry_select_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_cry_select_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="cry_select_lock" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">即時注單:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_nowrecord_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="nowrecord_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_nowrecord_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="nowrecord_lock" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_odds_execution_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="odds_execution_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_odds_execution_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="odds_execution_lock" value="0" /></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">单注最高派彩:</td>
            <td class="left_p6"><input class="textc" type="text" name="max_money" value="<?php echo $ConfigModel['g_max_money']?>" />
              &nbsp;&nbsp; <span class="odds">(僅統計未結算注單)</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">單注最低金額:</td>
            <td class="left_p6"><input class="textc" type="text" name="mix_money" value="<?php echo $ConfigModel['g_mix_money']?>" />
              &nbsp;&nbsp; <span class="odds">元(包括自動補貨、手工補貨;至少設置1元，建議設置2元。)</span></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" class="conter">
          <tr class="tr_top">
            <th colspan="2">特殊設置</th>
          </tr>
          <tr style="height:38px">
            <td class="bj">自動結算:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_automatic_money_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_money_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_automatic_money_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_money_lock" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，不会结算注单！）</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">自動開盤:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_automatic_open_number_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_number_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_automatic_open_number_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_number_lock" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，自動結算、動態賠率、自動加載期數、封盤時間、功能將失效）</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_automatic_open_result_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_result_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_automatic_open_result_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="automatic_open_result_lock" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
            <td class="bj">广东自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_gd_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_gd_ope" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_gd_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_gd_ope" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
            <td class="bj">重庆自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_cp_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_cp_ope" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_cp_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_cp_ope" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
            <tr style="height:38px;<?php  if($peizhijxssc!="1"){ echo "display:none;";}?>">
            <td class="bj">极速时时彩自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_jxssc_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_jxssc_op" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_jxssc_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_jxssc_op" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
		    
			
			<tr style="height:38px;<?php  if($peizhixjssc!="1"){ echo "display:none;";}?>">
            <td class="bj">新疆自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_xjssc_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_xjssc_op" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_xjssc_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_xjssc_op" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
			
			<tr style="height:38px;<?php  if($peizhitjssc!="1"){ echo "display:none;";}?>">
            <td class="bj">天津自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_tjssc_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_tjssc_op" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_tjssc_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_tjssc_op" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
		  
          <tr style="height:38px;<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
            <td class="bj">北京PK10自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_pk_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_pk_ope" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_pk_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_pk_ope" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
            <td class="bj">极速赛车自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_xyft_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_xyft_op" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_xyft_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_xyft_op" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhijssz!="1"){ echo "display:none;";}?>">
            <td class="bj">吉林快3自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_js_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_js_ope" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_js_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_js_ope" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhikl8!="1"){ echo "display:none;";}?>">
            <td class="bj">快樂8自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_kl8_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_kl8_ope" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_kl8_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_kl8_ope" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
            <td class="bj">幸运农场自動開獎:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_nc_op']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_nc_op" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_nc_op']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="g_nc_op" value="0" />
              &nbsp;&nbsp; <span class="red">（此項關閉后，只自動開盤，不会采集开奖数据）</span></td>
          </tr>
          
          <tr style="height:38px">
            <td class="bj">自動加載期數:</td>
            <td class="left_p6"><input class="textc" type="text" name="insert_number_day" style="width:30px" value="<?php echo $ConfigModel['g_insert_number_day']?>" />
              &nbsp;&nbsp; <span class="odds">（以相隔天數計算）</span></td>
          </tr>
          <tr style="height:38px">
            <td class="bj">每天开盤時間:</td>
            <td class="left_p6">
			<?php if($peizhigdklsf=="1"){
			echo "<span class=\"odds\">廣東快樂十分:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_gd\" id=\"open_time_gd\" style=\"width:90px\" value=\"". $ConfigModel['g_open_time_gd']."\" />&nbsp;&nbsp; ";
			  }
			  if($peizhicqssc=="1"){
			echo " <span class=\"odds\">重慶時時彩:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_cq\"  id=\"open_time_cq\"  style=\"width:90px\" value=\"".$ConfigModel['g_open_time_cq']."\" />
              &nbsp;&nbsp; ";
			  }
			   if($peizhipk10=="1"){
			echo "  <span class=\"odds\">北京赛车PK10:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_pk\"  id=\"open_time_pk\"  style=\"width:90px\" value=\"".$ConfigModel['g_open_time_pk']."\" />
			  &nbsp;&nbsp; ";
			  }
			   if($peizhijxssc=="1"){
			 echo " <span class=\"odds\">极速时时彩:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_jxssc\"  id=\"open_time_jxssc\"  style=\"width:90px\" value=\"".$ConfigModel['g_open_time_jxssc']."\" />
			  &nbsp;&nbsp; ";
			  }
			   if($peizhixjssc=="1"){
			echo "  <span class=\"odds\">新疆時時彩:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_xjssc\"  id=\"open_time_xjssc\"  style=\"width:90px\" value=\"".$ConfigModel['g_open_time_xjssc']."\" />
			  &nbsp;&nbsp; ";
			  }
			   if($peizhitjssc=="1"){
			echo "  <span class=\"odds\">天津時時彩:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_tjssc\"  id=\"open_time_tjssc\"  style=\"width:90px\" value=\"".$ConfigModel['g_open_time_tjssc']."\" />
			   &nbsp;&nbsp; ";
			   }
			    if($peizhijssz=="1"){
			echo "   <span class=\"odds\" >吉林快3:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_sz\" id=\"open_time_sz\" style=\"width:90px;\" value=\"".$ConfigModel['g_open_time_sz']."\"  />
              &nbsp;&nbsp; ";
			  }
			   if($peizhikl8=="1"){
			echo "  <span class=\"odds\" >快樂8:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_kl8\" id=\"open_time_kl8\" style=\"width:90px;\" value=\"".$ConfigModel['g_open_time_kl8']."\"  />
              &nbsp;&nbsp; ";
			  }
			   if($peizhinc=="1"){
			echo "  <span class=\"odds\" >幸运农场:</span>&nbsp;
              <input class=\"textc\" type=\"text\" name=\"open_time_nc\" id=\"open_time_nc\" style=\"width:90px;\" value=\"".$ConfigModel['g_open_time_nc']."\"  />
			  &nbsp;&nbsp; ";
			  }
			   if($peizhixyft=="1"){
			echo "  <span class=\"odds\" >极速赛车:</span>
              <input class=\"textc\" type=\"text\" name=\"open_time_xyft\" id=\"open_time_xyft\" style=\"width:90px;\" value=\"".$ConfigModel['g_open_time_xyft']."\"  />";
			  }
              ?>
			 <br>
             
			
              </td>
          </tr>
          <tr style="height:38px">
            <td class="bj">封盤時間:</td>
            <td class="left_p6"><input class="textc" type="text" name="close_time" style="width:30px" value="<?php echo $ConfigModel['g_close_time']?>" />
              &nbsp;&nbsp; <span class="odds">（以開獎時間分鐘計算）</span>&nbsp; <span class="red">（封盤時間更變當天不會生效）</span></td>
          </tr>
         <tr style="height:38px; <?php    if($resulth[0][0]!=1){echo "display:none";}?> ">
            <td class="bj">會員設置:</td>
            <td class="left_p6">&nbsp;<a href="WainAll.php"><font color="red">【<b>會員註單必中設置</b>】</font></a></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" class="conter">
          <tr class="tr_top">
            <th colspan="2">彩種管理</th>
          </tr>
          <tr style="height:38px">
            <td class="bj">彩種開啟:</td>
			 <td class="left_p6"> 
			<?php  if($peizhigdklsf!="1"){
			echo "<!--"; }?>
			廣東快樂十分&nbsp;
              <input <?php if($ConfigModel['g_kg_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="kg_game_lock" value="1" />
              &nbsp;&nbsp;
			  <?php  if($peizhigdklsf!="1"){
		   echo "-->"; }?>
		   
		   <?php  if($peizhicqssc!="1"){
			echo "<!--"; }?>
              重慶時時彩&nbsp;
              <input style="position:relative;top:2px" type="checkbox" name="cq_game_lock" <?php if($ConfigModel['g_cq_game_lock']==1){echo 'checked="checked"';}?> value="1" />
			  &nbsp;&nbsp;
			   <?php  if($peizhicqssc!="1"){
		   echo "-->"; }?>
		   
		    <?php  if($peizhijxssc!="1"){
			echo "<!--"; }?>
              极速时时彩&nbsp;
              <input style="position:relative;top:2px" type="checkbox" name="jxssc_game_lock" <?php if($ConfigModel['g_jxssc_game_lock']==1){echo 'checked="checked"';}?> value="1" />
			  &nbsp;&nbsp;
			    <?php  if($peizhijxssc!="1"){
		   echo "-->"; }?>
		   
			 <?php  if($peizhixjssc!="1"){
			echo "<!--"; }?>
              新疆時時彩&nbsp;
              <input style="position:relative;top:2px" type="checkbox" name="xjssc_game_lock" <?php if($ConfigModel['g_xjssc_game_lock']==1){echo 'checked="checked"';}?> value="1" />
			  &nbsp;&nbsp;
			   <?php  if($peizhixjssc!="1"){
		   echo "-->"; }?>
		    <?php  if($peizhitjssc!="1"){
			echo "<!--"; }?>
              天津時時彩&nbsp;
              <input style="position:relative;top:2px" type="checkbox" name="tjssc_game_lock" <?php if($ConfigModel['g_tjssc_game_lock']==1){echo 'checked="checked"';}?> value="1" />
			  &nbsp;&nbsp;
			   <?php  if($peizhitjssc!="1"){
		   echo "-->"; }?>
			   <?php  if($peizhipk10!="1"){
			echo "<!--"; }?>
              北京赛车PK10&nbsp;
              <input style="position:relative;top:2px" type="checkbox" name="pk_game_lock" <?php if($ConfigModel['g_pk_game_lock']==1){echo 'checked="checked"';}?> value="1" />
			  &nbsp;&nbsp;
			  <?php  if($peizhipk10!="1"){
		   echo "-->"; }?>
			 <?php  if($peizhijssz!="1"){
			echo "<!--"; }?>
              <span >吉林快3&nbsp;
              <input <?php if($ConfigModel['g_sz_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="sz_game_lock" value="1" />
              </span> &nbsp;&nbsp;
			  <?php  if($peizhijssz!="1"){
		   echo "-->"; }?>
			   <?php  if($peizhikl8!="1"){
			echo "<!--"; }?>
              <span >快樂8&nbsp;
              <input <?php if($ConfigModel['g_kl8_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="kl8_game_lock" value="1" />
              </span> &nbsp;&nbsp;
			  <?php  if($peizhikl8!="1"){
		   echo "-->"; }?>
              <?php  if($peizhinc!="1"){
			echo "<!--"; }?>
               <span >幸运农场&nbsp;
              <input <?php if($ConfigModel['g_nc_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="nc_game_lock" value="1" /></span> 
			  &nbsp;&nbsp;
             <?php  if($peizhinc!="1"){
		   echo "-->"; }?>
		    <?php  if($peizhixyft!="1"){
			echo "<!--"; }?>
			 <span >极速赛车&nbsp;
              <input <?php if($ConfigModel['g_xyft_game_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="xyft_game_lock" value="1" /></span> 
			  &nbsp;
			  <?php  if($peizhixyft!="1"){
		   echo "-->"; }?>
               </td>
          </tr>
          <tr style="height:38px;<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
            <td class="bj"><b>廣東快樂十分:</b></td>
            <td class="left_p6"> 第一球&nbsp;
              <input <?php if($ConfigModel['g_game_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_1" value="1" />
              &nbsp;&nbsp;
              第二球&nbsp;
              <input <?php if($ConfigModel['g_game_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_2" value="1" />
              &nbsp;&nbsp;
              第三球&nbsp;
              <input <?php if($ConfigModel['g_game_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_3" value="1" />
              &nbsp;&nbsp;
              第四球&nbsp;
              <input <?php if($ConfigModel['g_game_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_4" value="1" />
              &nbsp;&nbsp;
              第五球&nbsp;
              <input <?php if($ConfigModel['g_game_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_5" value="1" />
              &nbsp;&nbsp;
              第六球&nbsp;
              <input <?php if($ConfigModel['g_game_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_6" value="1" />
              &nbsp;&nbsp;
              第七球&nbsp;
              <input <?php if($ConfigModel['g_game_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_7" value="1" />
              &nbsp;&nbsp;
              第八球&nbsp;
              <input <?php if($ConfigModel['g_game_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_8" value="1" />
              &nbsp;&nbsp;
              總分龍虎&nbsp;
              <input <?php if($ConfigModel['g_game_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_9" value="1" />
              &nbsp;&nbsp;
              連碼&nbsp;
              <input <?php if($ConfigModel['g_game_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_10" value="1" />
              &nbsp;&nbsp; </td>
          </tr>
          <tr style="height:38px; display:none">
            <td class="bj">B盤:</td>
            <td class="left_p6"> 1-8號碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_b1" value="<?php echo $ConfigModel['g_odds_ratio_b1']?>" />
              &nbsp;
              1-8方位:&nbsp;
              <input type="text" class="textc" name="odds_ratio_b2" value="<?php echo $ConfigModel['g_odds_ratio_b2']?>" />
              &nbsp;
              1-8中發白:&nbsp;
              <input type="text" class="textc" name="odds_ratio_b3" value="<?php echo $ConfigModel['g_odds_ratio_b3']?>" />
              &nbsp;&nbsp;
              兩面:&nbsp;
              <input type="text" class="textc" name="odds_ratio_b4" value="<?php echo $ConfigModel['g_odds_ratio_b4']?>" />
              &nbsp;&nbsp;
              連碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_b5" value="<?php echo $ConfigModel['g_odds_ratio_b5']?>" /></td>
          </tr>
          <tr style="height:38px; display:none">
            <td class="bj">C盤:</td>
            <td class="left_p6"> 1-8號碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_c1" value="<?php echo $ConfigModel['g_odds_ratio_c1']?>" />
              &nbsp;
              1-8方位:&nbsp;
              <input type="text" class="textc" name="odds_ratio_c2" value="<?php echo $ConfigModel['g_odds_ratio_c2']?>" />
              &nbsp;
              1-8中發白:&nbsp;
              <input type="text" class="textc" name="odds_ratio_c3" value="<?php echo $ConfigModel['g_odds_ratio_c3']?>" />
              &nbsp;&nbsp;
              兩面:&nbsp;
              <input type="text" class="textc" name="odds_ratio_c4" value="<?php echo $ConfigModel['g_odds_ratio_c4']?>" />
              &nbsp;&nbsp;
              連碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_c5" value="<?php echo $ConfigModel['g_odds_ratio_c5']?>" /></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhigdklsf!="1"){ echo "display:none;";}?>">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix" value="<?php echo $ConfigModel['g_up_odds_mix']?>" />
              &nbsp;&nbsp;
              1-8球總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num" value="<?php echo $ConfigModel['g_odds_num']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str" value="<?php echo $ConfigModel['g_odds_str']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
            <td class="bj"><b>重慶時時彩:</b></td>
            <td class="left_p6"> 第一球&nbsp;
              <input <?php if($ConfigModel['g_game_cq_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_1" value="1" />
              &nbsp;&nbsp;
              第二球&nbsp;
              <input <?php if($ConfigModel['g_game_cq_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_2" value="1" />
              &nbsp;&nbsp;
              第三球&nbsp;
              <input <?php if($ConfigModel['g_game_cq_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_3" value="1" />
              &nbsp;&nbsp;
              第四球&nbsp;
              <input <?php if($ConfigModel['g_game_cq_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_4" value="1" />
              &nbsp;&nbsp;
              第五球&nbsp;
              <input <?php if($ConfigModel['g_game_cq_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_5" value="1" />
              &nbsp;&nbsp;
              總分龍虎&nbsp;
              <input <?php if($ConfigModel['g_game_cq_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_6" value="1" />
              &nbsp;&nbsp;
              前三、中三、后三&nbsp;
              <input <?php if($ConfigModel['g_game_cq_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_cq_7" value="1" />
              &nbsp;&nbsp; </td>
          </tr>
          <tr style="height:38px; display:none">
            <td class="bj">B盤:</td>
            <td class="left_p6"> 1-5號碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_b1" value="<?php echo $ConfigModel['g_odds_ratio_cq_b1']?>" />
              &nbsp;
              兩面:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_b2" value="<?php echo $ConfigModel['g_odds_ratio_cq_b2']?>" />
              &nbsp;&nbsp;
              前三、中三、后三:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_b3" value="<?php echo $ConfigModel['g_odds_ratio_cq_b3']?>" /></td>
          </tr>
          <tr style="height:38px; display:none">
            <td class="bj">C盤:</td>
            <td class="left_p6"> 1-5號碼:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_c1" value="<?php echo $ConfigModel['g_odds_ratio_cq_c1']?>" />
              &nbsp;
              兩面:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_c2" value="<?php echo $ConfigModel['g_odds_ratio_cq_c2']?>" />
              &nbsp;&nbsp;
              前三、中三、后三:&nbsp;
              <input type="text" class="textc" name="odds_ratio_cq_c3" value="<?php echo $ConfigModel['g_odds_ratio_cq_c3']?>" /></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhicqssc!="1"){ echo "display:none;";}?>">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix_cq" value="<?php echo $ConfigModel['g_up_odds_mix_cq']?>" />
              &nbsp;&nbsp;
              1-5球總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num_cq" value="<?php echo $ConfigModel['g_odds_num_cq']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str_cq" value="<?php echo $ConfigModel['g_odds_str_cq']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>
          
          <tr style="height:38px;<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
            <td class="bj"><b>北京赛车PK10:</b></td>
            <td class="left_p6"> 冠、亞軍 組合&nbsp;
              <input <?php if($ConfigModel['g_game_pk_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_1" value="1" />
              &nbsp;&nbsp;
              三、四、伍、六名&nbsp;
              <input <?php if($ConfigModel['g_game_pk_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_2" value="1" />
              &nbsp;&nbsp;
              七、八、九、十名&nbsp;
              <input <?php if($ConfigModel['g_game_pk_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_pk_3" value="1" />
              &nbsp;&nbsp; </td>
          </tr>
          <tr style="height:38px;<?php  if($peizhipk10!="1"){ echo "display:none;";}?>">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix_pk" value="<?php echo $ConfigModel['g_up_odds_mix_pk']?>" />
              &nbsp;&nbsp;
              1-10名總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num_pk" value="<?php echo $ConfigModel['g_odds_num_pk']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str_pk" value="<?php echo $ConfigModel['g_odds_str_pk']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>
		 <tr style="height:38px;<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
            <td class="bj"><b>极速赛车:</b></td>
            <td class="left_p6"> 冠、亞軍 組合&nbsp;
              <input <?php if($ConfigModel['g_game_xyft_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xyft_1" value="1" />
              &nbsp;&nbsp;
              三、四、伍、六名&nbsp;
              <input <?php if($ConfigModel['g_game_xyft_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xyft_2" value="1" />
              &nbsp;&nbsp;
              七、八、九、十名&nbsp;
              <input <?php if($ConfigModel['g_game_xyft_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_xyft_3" value="1" />
              &nbsp;&nbsp; </td>
          </tr>
          <tr style="height:38px;<?php  if($peizhixyft!="1"){ echo "display:none;";}?>">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix_xyft" value="<?php echo $ConfigModel['g_up_odds_mix_xyft']?>" />
              &nbsp;&nbsp;
              1-10名總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num_xyft" value="<?php echo $ConfigModel['g_odds_num_xyft']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str_xyft" value="<?php echo $ConfigModel['g_odds_str_xyft']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>
          <tr style="height:38px;<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
            <td class="bj"><b>重庆幸运农场:</b></td>
            <td class="left_p6"> 第一球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_1" value="1" />
              &nbsp;&nbsp;
              第二球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_2" value="1" />
              &nbsp;&nbsp;
              第三球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_3']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_3" value="1" />
              &nbsp;&nbsp;
              第四球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_4']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_4" value="1" />
              &nbsp;&nbsp;
              第五球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_5']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_5" value="1" />
              &nbsp;&nbsp;
              第六球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_6']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_6" value="1" />
              &nbsp;&nbsp;
              第七球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_7']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_7" value="1" />
              &nbsp;&nbsp;
              第八球&nbsp;
              <input <?php if($ConfigModel['g_game_nc_8']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_8" value="1" />
              &nbsp;&nbsp;
              總分龍虎&nbsp;
              <input <?php if($ConfigModel['g_game_nc_9']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_9" value="1" />
              &nbsp;&nbsp;
              連碼&nbsp;
              <input <?php if($ConfigModel['g_game_nc_10']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_nc_10" value="1" />
              &nbsp;&nbsp; </td>
          </tr>
          <tr style="height:38px;<?php  if($peizhinc!="1"){ echo "display:none;";}?>">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix_nc" value="<?php echo $ConfigModel['g_up_odds_mix_nc']?>" />
              &nbsp;&nbsp;
              1-8球總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num_nc" value="<?php echo $ConfigModel['g_odds_num_nc']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str_nc" value="<?php echo $ConfigModel['g_odds_str_nc']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>
          <!--<tr style="height:38px">
            <td class="bj"><b>广东11选5:</b></td>
            <td class="left_p6">连码 &nbsp;
              <input <?php if($ConfigModel['g_game_gd115_1']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gd115_1" value="1" />
              &nbsp;&nbsp;
              直选&nbsp;
              <input <?php if($ConfigModel['g_game_gd115_2']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="checkbox" name="game_gd115_2" value="1" />
              &nbsp;&nbsp;
              </td>
          </tr>
          <tr style="height:38px">
            <td class="bj">動態賠率:</td>
            <td class="left_p6"> 連續值&nbsp;
              <input class="textc" style="width:50px" type="text" name="up_odds_mix_gd115" value="<?php echo $ConfigModel['g_up_odds_mix_gd115']?>" />
              &nbsp;&nbsp;
              1-5球總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_num_gd115" value="<?php echo $ConfigModel['g_odds_num_gd115']?>" />
              &nbsp;&nbsp;
              雙面總值&nbsp;
              <input class="textc" style="width:50px" type="text" name="odds_str_gd115" value="<?php echo $ConfigModel['g_odds_str_gd115']?>" />
              &nbsp;&nbsp; <span class="odds">(超出連續值以設置的總值累加，執行賠率變動。)</span></td>
          </tr>-->
        </table>
        <table border="0" cellspacing="0" class="conter">
          <tr class="tr_top">
            <th colspan="2">其它設置</th>
          </tr>
          <tr style="height:38px">
            <td class="bj">金額還原:</td>
            <td class="left_p6"> 開啟&nbsp;
              <input <?php if($ConfigModel['g_restore_money_lock']==1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="restore_money_lock" value="1" />
              &nbsp;&nbsp;
              關閉&nbsp;
              <input <?php if($ConfigModel['g_restore_money_lock']!=1){echo 'checked="checked"';}?> style="position:relative;top:2px" type="radio" name="restore_money_lock" value="0" />
              <input type="button" onclick="hybyh();" value="手動還原" /></td>
          </tr>

          <tr style="height:38px">
            <td class="bj">額度校驗:</td>
            <td class="left_p6"><input type="button" onclick="hybyhxy();" value="額度校驗" />
              &nbsp;&nbsp; <span class="odds">(如信用余額對不上, 請手動校驗即可.)</span>&nbsp; </td>
          </tr>
        </table>
        <!-- end -->
        
          </td>
        
        
          <td class="r"></td>
        </tr>
        <tr>
          <td width="12"><img src="/Admin/temp/images/tab_18.gif" alt="" /></td>
          <td class="f" align="center"><input type="submit" class="inputs" value="確   定" /></td>
          <td width="16"><img src="/Admin/temp/images/tab_20.gif" alt="" /></td>
        </tr>
      </table>
      <td width="5" bgcolor="#4F4F4F"></td>
        </td>
    </tr>
    <tr>
      <td height="5" bgcolor="#4F4F4F"></td>
      <td bgcolor="#4F4F4F"></td>
      <td height="5" bgcolor="#4F4F4F"></td>
    </tr>
  </table>
</form>
</body>
</html>