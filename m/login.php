<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=0.5,minimum-scale=0.5,maximum-scale=0.5,user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>用戶登錄</title>
    <link href="m/css/style.css" rel="stylesheet" type="text/css" />
    <script src="m/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $("input[id]").bind("focus", function () {
                if ($(this).attr("id") == 'loginName' || $(this).attr("id") == 'loginPwd') {
                    $(this).attr("placeholder", "");
                    $("#ValidateImage").hide();
                }
                if ($(this).attr("id") == 'ValidateCode') {
                    $(this).attr("placeholder", "");
                }
            });
            $('#loginName').blur(function () {
                if ($(this).val() == "") {
                    $(this).attr("placeholder", "請輸入您的用戶名");
                }
            });
            $('#loginPwd').blur(function () {
                if ($(this).val() == "") {
                    $(this).attr("placeholder", "請輸入您的密碼");
                }
            });
            $('#ValidateCode').blur(function () {
                if ($(this).val() == "") {
                    $(this).attr("placeholder", "請輸入驗證碼");
                }
            });
            $("#ValidateCode").keyup(function () {
                $(this).val($(this).val().replace(/[^0-9.]/g, ''))
            }).bind("paste",
        function () {
            $(this).val($(this).val().replace(/[^0-9.]/g, ''))
        }).css("ime-mode", "disabled");

            $("#ValidateImage").click(function () {
                $("#ValidateImage").attr("src", "yzm.php?time=" + Math.random());
                $("#ValidateImage").show();
            });
            $("#ValidateCode").focus(function () {
                $("#ValidateCode").val('');
                $("#ValidateImage").trigger("click");
            });
			
			 $("#loginName").focus(function () {
          $("#ValidateImage").hide();
        $("#ValidateImage").attr("src", "images/loaddata2.gif");

    });
	$("#loginPwd").focus(function () {
          $("#ValidateImage").hide();
        $("#ValidateImage").attr("src", "images/loaddata2.gif");

    });

            $("#btnSubmit").click(function () {
                confirmLogin();
            });

            $("#form_login input").keydown(function (e) {
                var curKey = e.which;
                if (curKey == 13) {
                    $("#btnSubmit").click();
                    return false;
                }
            });

        });

        //输入信息验证


        function confirmLogin() {
            
            if (($("#loginName").val() == '' || $("#loginName").val() == '請輸入您的用戶名') || ($("#loginPwd").val() == '' || $("#loginPwd").val() == '請輸入您的密碼') || ($("#ValidateCode").val() == '' || $("#ValidateCode").val() == '請輸入驗證碼')) {
                alert("請輸入完整的登錄信息！");
                return false;
            }
            else {
                var isSuccess = false;
                var message = "";
                try {
                    $("#btnSubmit").attr('disabled', true);
                    $.ajax({
                        async: true,
                        type: 'POST',
                        url: 'm/LoginAjax.php',
                        dataType: 'json',
                        data: $('#form_login').serialize(),
                        cache: false,
                        timeout: 5000,
                        error: function (XMLHttpRequest, textStatus, errorThrown) { isSuccess = false; message = "登錄異常"; },
                        success: function (msg) {
                            var status = msg.status;
                            var m = msg.msg;
                            if (status == "0") {
                                location.href = "m/Main.php";
                                return true;
                            }
                            else if (status == "1") {
                                alert(msg.msg);
                                location.href = "m/UpPwd.php?r=07180340565021";
                                return true;
                            }
                            else {
                                alert(msg.msg);
                                return false;
                            }
                        }
                    })
                }
                catch (e) { isSuccess = false; message = "登錄異常"; }
                $("#btnSubmit").attr('disabled', false);

            }
        }



      

    </script>
</head>
<body class="Loginbg">
<div>
    <form id="form_login" name="form_login">
    <div class="TopPic"><img src="m/images/TopPic.jpg" width="100%"></div>
    <div class="LoginBox">
        <div class="box">
            <ul>
                <li><span class="username"></span><label><input type="text" id="loginName" name="loginName" class="text" placeholder="請輸入您的用戶名" autocomplete="off" /></label></li>
                <li><span class="passwork"></span><label><input  type="password" id="loginPwd" name="loginPwd" class="text" placeholder="請輸入您的密碼" autocomplete="off" /></label></li>
                <li><span class="number"></span><label><div><img id="ValidateImage" style="height: 66px; width: 168px; right: -16px; position: absolute;top: 8px; cursor: pointer;display: none;" /></div><input type="tel" id="ValidateCode" maxlength="4" name="ValidateCode" class="text" placeholder="請輸入驗證碼" /></label></li>
            </ul>
            <div class="clear">
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div style="margin: 0 auto 5% auto; width: 90%;">
        <input type="button" id="btnSubmit" name="btnSubmit" class="btn" value="登 錄" /></div>
    </form>
</div>

</body>
</html>

