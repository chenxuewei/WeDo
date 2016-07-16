<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">查看公众号</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Frontend</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">查看公众号</li>
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
                        <td align="center">公众号名称</td>
                        <td align="center">Appid</td>
                        <td align="center">Appsecret</td>
                        <td align="center">内容</td>
                        <td width="20%" align="center">操作</td>
                    </tr>
                    <tbody>
                    <?php foreach ($arr as $k => $v): ?>
                        <tr>
                            
                            <td align="center"><span class="label label-sm label-success"><?= $v['aname'] ?></span></td>
                            <td align="center"><span class="label label-sm label-info"><?= $v['appid'] ?></span></td>
                            <td align="center"><span class="label label-sm label-warning"><?= $v['appsecret'] ?>   </span></td>
                            <td align="center"><span class="label label-sm label-danger"><?= $v['account'] ?></span></td>
                            <td align="center">
                                <a href="?r=administration/attribute&aid=<?php echo $v['aid'] ?>" >查看属性</a>
                                <a href="javascript:void(0)" onclick="fun1(<?php echo $v['aid'] ?>)">删除</a>
                                <a href="?r=administration/save&aid=<?php echo $v['aid'] ?>"></a>
                            </td>
                            
                        </tr>
                        <?php endforeach; ?>
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





