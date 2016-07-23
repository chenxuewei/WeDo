<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<div id="page-wrapper">
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">文字回复</div>
    </div>
    <ol class="breadcrumb page-breadcrumb">
        <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li><a href="#">自定义回复</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active">文字回复</li>
    </ol>
    <div class="btn btn-blue reportrange hide"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;report&nbsp;<i class="fa fa-angle-down"></i>
        <input type="hidden" name="datestart" />
        <input type="hidden" name="endstart" />
    </div>
    <div class="clearfix"></div>
</div>


<script src="jquery-2.1.4.min.js"></script>
<body id="div1">
<div align="center" style="margin-top: 30px;padding-bottom: 30px;">
    <input type="text" id="ser"  class="form-control" style="width: 20%;float: left;margin-left: 35%"/>
    <button onclick="fun2()" class="btn btn-info pull-left" style="float: left">查询</button>
</div>
<div>
            <h4 class="box-heading"></h4>
            <table class="table table-striped table-bordered table-advanced" width="100">
                <thead>
                    <tr>                      
                        <td align="center">ID</td>
                        <td align="center">标题</td>
                        <td align="center">回复标题</td>
                        <td align="center">回复内容</td>
                        <td width="20%" align="center">操作</td>
                    </tr>
                    <tbody>
                    <?php foreach ($countries as $k => $v){ ?>
                        <tr>
                            
                            <td align="center"><span class="label label-sm label-success"><?= $v['reid'] ?></span></td>
                            <td align="center"><span class="label label-sm label-info"><?= $v['rename'] ?></span></td>
                            <td align="center"><span class="label label-sm label-info"><?= $v['rekeyword'] ?></span></td>
                            <td align="center"><span class="label label-sm label-warning" style="color: black"><?= $v['trcontent'] ?></span></td>
                            
                            <td align="center">
                                <a href="javascript:void(0)" onclick="fun1(<?php echo $v['reid'] ?>)" class="btn btn-danger btn-xs mbs">
                                        <i class="fa fa-trash-o"></i>
                                        Delete
                                    </a>
                            </td>
                            
                        </tr>

                        <?php } ?>
                    <tr ><th colspan="5" style="text-align: center"><?= LinkPager::widget(['pagination' => $pagination]) ?></th></tr>
                        </tbody>
                        </thead>
                        </table>

                               
</div>
</body>
</div>

<script type="text/javascript">
    function fun1(id){
        $.get('?r=reply/del',{reid:id},function(msg){
            $('#div1').html(msg);
        })
    }

    function fun2(){
        var ser=$('#ser').val();
         $.get('?r=reply/sou',{ser:ser},function(obj){
            //alert(obj);
            $('#div1').html(obj);
        })
    }
</script>





