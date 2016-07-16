
<!DOCTYPE html>
<html lang="zh-cn" id="html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>安装系统 - 微度 - 公众平台自助开源引度</title>
    <!--    <link rel="stylesheet" href="install/bootstrap.min.css">-->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <style>
        html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体"; background: #060e1b;}
        .pager li.previous a{margin-right:10px;}
        .header a{color:#FFF;}
        .header a:hover{color:#428bca;}
        .footer{padding:10px;}
        .footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
        canvas {
        //opacity: 0.5;
        }

        /* Demo Buttons Style */
        .codrops-demos {
            position:absolute;
            z-index:99;
            width:100%;
            height: 100%;
        }
        .codrops-demos a {

        }
        .codrops-demos a:hover,
        .codrops-demos a.current-demo {
            border-color: #383a3c;
        }

    </style>
    <!--[if lt IE 9]>

    <![endif]-->
</head>
<body>
<span class="codrops-demos">

<div class="container" style="opacity: 0.6;"  >
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
    </span>
<canvas id="canvas"></canvas>
<script>
    "use strict";

    var canvas = document.getElementById('canvas'),
        ctx = canvas.getContext('2d'),
        w = canvas.width = window.innerWidth,
        h = canvas.height = window.innerHeight*1.8,

        hue = 217,
        stars = [],
        count = 0,
        maxStars = 1200;

    var canvas2 = document.createElement('canvas'),
        ctx2 = canvas2.getContext('2d');
    canvas2.width = 100;
    canvas2.height = 100;
    var half = canvas2.width / 2,
        gradient2 = ctx2.createRadialGradient(half, half, 0, half, half, half);
    gradient2.addColorStop(0.025, '#fff');
    gradient2.addColorStop(0.1, 'hsl(' + hue + ', 61%, 33%)');
    gradient2.addColorStop(0.25, 'hsl(' + hue + ', 64%, 6%)');
    gradient2.addColorStop(1, 'transparent');

    ctx2.fillStyle = gradient2;
    ctx2.beginPath();
    ctx2.arc(half, half, half, 0, Math.PI * 2);
    ctx2.fill();

    // End cache

    function random(min, max) {
        if (arguments.length < 2) {
            max = min;
            min = 0;
        }

        if (min > max) {
            var hold = max;
            max = min;
            min = hold;
        }

        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function maxOrbit(x, y) {
        var max = Math.max(x, y),
            diameter = Math.round(Math.sqrt(max * max + max * max));
        return diameter / 2;
    }

    var Star = function() {

        this.orbitRadius = random(maxOrbit(w, h));
        this.radius = random(60, this.orbitRadius) / 12;
        this.orbitX = w / 2;
        this.orbitY = h / 2;
        this.timePassed = random(0, maxStars);
        this.speed = random(this.orbitRadius) / 900000;
        this.alpha = random(2, 10) / 10;

        count++;
        stars[count] = this;
    }

    Star.prototype.draw = function() {
        var x = Math.sin(this.timePassed) * this.orbitRadius + this.orbitX,
            y = Math.cos(this.timePassed) * this.orbitRadius + this.orbitY,
            twinkle = random(10);

        if (twinkle === 1 && this.alpha > 0) {
            this.alpha -= 0.09;
        } else if (twinkle === 2 && this.alpha < 1) {
            this.alpha += 0.6;
        }

        ctx.globalAlpha = this.alpha;
        ctx.drawImage(canvas2, x - this.radius / 2, y - this.radius / 2, this.radius, this.radius);
        this.timePassed += this.speed;
    }

    for (var i = 0; i < maxStars; i++) {
        new Star();
    }

    function animation() {
        ctx.globalCompositeOperation = 'source-over';
        ctx.globalAlpha = 0.8;
        ctx.fillStyle = 'hsla(' + hue + ', 64%, 5%, 1)';
        ctx.fillRect(0, 0, w, h)

        ctx.globalCompositeOperation = 'lighter';
        for (var i = 1, l = stars.length; i < l; i++) {
            stars[i].draw();
        };

        window.requestAnimationFrame(animation);
    }

    animation();
</script>
<!--<script src="install/jquery.min.js"></script>-->
<!--<script src="install/bootstrap.min.js"></script>-->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
