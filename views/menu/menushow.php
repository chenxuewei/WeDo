<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">获取菜单配置</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">自定义菜单展示</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active"><?=$user['aname']?>菜单展示</li>
        </ol>
        <div class="btn btn-blue reportrange hide"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;report&nbsp;<i class="fa fa-angle-down"></i>
            <input type="hidden" name="datestart" />
            <input type="hidden" name="endstart" />
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="jquery-2.1.4.min.js"></script>
    <body id="div1">
    <div >

        <h4 class="box-heading"></h4>
        <table class="table table-striped table-bordered table-advanced" width="100">
            <thead>
            <tr>
                <td align="center">菜单类型</td>
                <td align="center">菜单名字</td>
                <td align="center">菜单内容</td>
                <td width="20%" align="center">主菜单</td>
            </tr>
            <tbody>
            <?php foreach ($menu as $k => $v){?>
                <tr>

                    <td align="center"><span class="label label-sm label-success"><?php if($v['type']=='click'){echo "发送消息";}else{echo "链接跳转";}  ?></span></td>
                    <td align="center"><span class="label label-sm label-info"><?= $v['name'] ?></span></td>
                    <td align="center"><span class="label label-sm label-warning"><?php if(isset($v['url'])){echo $v['url'];}else{echo $v['key'];} ?>   </span></td>
                    <td align="center"><span class="label label-sm label-danger"><?php if($v['mine']=='' ){echo '主菜单';}else{echo $v['mine'];}?></span></td>
                </tr>
            <?php } ?>
            <?php if($count>1){?>
            <tr><th colspan="4" style="text-align: center"><a href="?r=menu/lastmenu">菜单回退到上个版本</a></th></tr>
            <?php } ?>
            </tbody>
            </thead>
        </table>

    </div>
</div>

<script type="text/javascript">
    function fun1(id){
        $.get('?r=administration/del',{aid:id},function(msg){
            $('#div1').html(msg);
        })
    }
</script>





