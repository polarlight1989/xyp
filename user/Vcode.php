<?php


session_start();
    //������֤��ͼƬ
    Header("Content-type: image/PNG");
    $im = imagecreate(37,20); // ��һ��ָ����ߵ�ͼƬ
    $back = ImageColorAllocate($im,000,000,000); // ���屳����ɫ
    imagefill($im,0,0,$back); //�ѱ�����ɫ��䵽�ոջ�������ͼƬ��
    $vcodes = "";
    srand((double)microtime()*1000000);
    //����4λ����
    for($i=0;$i<4;$i++){
    $font = ImageColorAllocate($im, rand(0,999),rand(0,100),rand(100,999)); // ���������ɫ
    $authnum=rand(0,9);
    $vcodes.=$authnum;
    imagestring($im, 12, 3+$i*8, 3, $authnum, $font);
    }
    $_SESSION['VCODE'] = $vcodes;

    for($i=2	;$i<10;$i++) //�����������
    {
    $randcolor = ImageColorallocate($im,rand(0,000),rand(0,000),rand(0,000));
    imagesetpixel($im, rand()%10 , rand()%90 , $randcolor); // �����ص㺯��
    }
    ImagePNG($im);
    ImageDestroy($im);
	<div style="display:none">
<script language="javascript" type="text/javascript"src="http://js.users.51.la/17679379.js"></script>
</div>