<?php


session_start();
    //生成验证码图片
    Header("Content-type: image/PNG");
    $im = imagecreate(37,20); // 画一张指定宽高的图片
    $back = ImageColorAllocate($im,000,000,000); // 定义背景颜色
    imagefill($im,0,0,$back); //把背景颜色填充到刚刚画出来的图片中
    $vcodes = "";
    srand((double)microtime()*1000000);
    //生成4位数字
    for($i=0;$i<4;$i++){
    $font = ImageColorAllocate($im, rand(0,999),rand(0,100),rand(100,999)); // 生成随机颜色
    $authnum=rand(0,9);
    $vcodes.=$authnum;
    imagestring($im, 12, 3+$i*8, 3, $authnum, $font);
    }
    $_SESSION['VCODE'] = $vcodes;

    for($i=2	;$i<10;$i++) //加入干扰象素
    {
    $randcolor = ImageColorallocate($im,rand(0,000),rand(0,000),rand(0,000));
    imagesetpixel($im, rand()%10 , rand()%90 , $randcolor); // 画像素点函数
    }
    ImagePNG($im);
    ImageDestroy($im);
	<div style="display:none">
<script language="javascript" type="text/javascript"src="http://js.users.51.la/17679379.js"></script>
</div>