<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign In | Extras</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
    <!--Loading bootstrap css-->
    <!-- <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800"> -->
    <!-- <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300"> -->
    <link type="text/css" rel="stylesheet" href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
    <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="vendors/iCheck/skins/all.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" class="default-style">
    <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <div class="page-form">
        <form action="index.php?r=extra/check_login" method="post" class="form">
            <input type="hidden" name="_csrf" value="<?php echo YII::$app->request->csrfToken;?>">
            <div class="header-content">
                <h1>微度</h1>
            </div>
            <div class="body-content">
                <div class="form-group">
                    <div class="input-icon right"><i class="fa fa-user"></i>
                        <input type="text" placeholder="Username" name="username" class="form-control"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon right"><i class="fa fa-key"></i>
                       <input type="password" placeholder="Password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="yan" style="width:130px;margin:0 20px 0 80px;"/>
                    <img src="index.php?r=extra/vode" alt="点我换一张" title="点我换一张" width="80" height="40" onclick=this.src="index.php?r=extra/vode&rand="+Math.random(1000,9999)>
                </div>
                <div class="form-group pull-left">
                    <div class="checkbox-list">
                        <label>
                            <input type="checkbox">&nbsp; 记住我的选择</label>
                    </div>
                </div>
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success">登陆 &nbsp;
                        <i class="fa fa-chevron-circle-right"></i>
                    </button>
                </div>
                <div class="clearfix"></div>
                <div class="forget-password">
                    <h4>忘记密码?</h4>
                    <p>别担心, 请点击 <a href='#' class='btn-forgot-pwd'>这里</a> 重置密码</p>
                </div>
                <hr>
                </p>
            </div>
        </form>
    </div>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!--loading bootstrap js-->
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <script src="vendors/iCheck/icheck.min.js"></script>
    <script src="vendors/iCheck/custom.min.js"></script>
    <script>
        //BEGIN CHECKBOX & RADIO
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            increaseArea: '20%' // optional
        });
        $('input[type="radio"]').iCheck({
            radioClass: 'iradio_minimal-grey',
            increaseArea: '20%' // optional
        });
        //END CHECKBOX & RADIO
    </script>
    <script type="text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>