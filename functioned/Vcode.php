<?php


session_start();
    //������֤��ͼƬ
    Header("Content-type: image/png");
    $im = imagecreate(37,20); // ��һ��ָ����ߵ�ͼƬ
    $back = ImageColorAllocate($im,100,0,000); // ���屳����ɫ
    imagefill($im,0x9999,0xFFFFFF,0xFF); //�ѱ�����ɫ��䵽�ոջ�������ͼƬ��
    $vcodes = "";
    srand((double)microtime()*1000000);
    //����4λ����
    for($i=0;$i<4;$i++){
    $font = ImageColorAllocate($im, rand(00,22222222222),rand(00,22222222222),rand(333,44333333333334)); // ���������ɫ
    $authnum=rand(0,9);
    $vcodes.=$authnum;
    imagestring($im, 11, 3+$i*8, 3, $authnum, $font);
    }
    $_SESSION['VCODE'] = $vcodes;

    for($i=40	;$i<60;$i++) //�����������
    {
    $randcolor = ImageColorallocate($im,rand(0,000),rand(0,313),rand(0,000));
    imagesetpixel($im, rand()%20 , rand()%80 , $randcolor); // �����ص㺯��
    }
    ImagePNG($im);
    ImageDestroy($im);