<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>安装系统 - 微度 - 公众平台自助开源引度</title>
<!--    <link rel="stylesheet" href="install/bootstrap.min.css">-->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <style>
        html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
        .pager li.previous a{margin-right:10px;}
        .header a{color:#FFF;}
        .header a:hover{color:#428bca;}
        .footer{padding:10px;}
        .footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
    </style>
    <!--[if lt IE 9]>
    <script src="install/html5shiv.min.js"></script>
    <script src="install/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color:#2F4355;">
<div class="container">
    <div class="header" style="margin:15px auto;">
        <ul class="nav nav-pills pull-right" role="tablist">
            <li role="presentation" class="active"><a href="javascript:;">安装微度系统</a></li>
            <li role="presentation"><a href="http://www.we7.cc">微度官网</a></li>
            <li role="presentation"><a href="http://bbs.we7.cc">访问论坛</a></li>
        </ul>
        <img src="install/img/loge.png" />
    </div>

    <div class="row well" style="margin:auto 0;">
        <div class="col-xs-3">
            <div class="progress" title="安装进度">
                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $this->params['progress']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $this->params['progress']?>%;">
                    <?php echo $this->params['progress']?>%
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    安装步骤
                </div>
                <ul class="list-group">
                    <a href="javascript:;" class="list-group-item<?php echo $this->params['steps0']?>"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
                    <a href="javascript:;" class="list-group-item<?php echo $this->params['steps1']?>"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
                    <a href="javascript:;" class="list-group-item<?php echo $this->params['steps2']?>"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
                    <a href="javascript:;" class="list-group-item<?php echo $this->params['steps3']?>"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
                </ul>
            </div>
        </div>
        <div class="col-xs-9">
            <?= $content?>
        </div>
    </div>
    <div class="footer" style="margin:15px auto;">
        <div class="text-center">
            <a href="http://www.we7.cc">关于微度</a> &nbsp; &nbsp; <a href="http://bbs.we7.cc">微度帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc">购买授权</a>
        </div>
        <div class="text-center">
            Powered by <a href="http://www.we7.cc"><b>微度</b></a> v0.7 &copy; 2014 <a href="http://www.we7.cc">www.we7.cc</a>
        </div>
    </div>
</div>
<!--<script src="install/jquery.min.js"></script>-->
<!--<script src="install/bootstrap.min.js"></script>-->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>