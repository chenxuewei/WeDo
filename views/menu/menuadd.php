<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">自定义菜单创建</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="">自定义菜单选项</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">自定义菜单创建</li>
        </ol>
        <div class="btn btn-blue reportrange hide"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;report&nbsp;<i class="fa fa-angle-down"></i>
            <input type="hidden" name="datestart" />
            <input type="hidden" name="endstart" />
        </div>
        <div class="clearfix"></div>
    </div>
    <!--添加开始-->
    <div style="height: 100%">
        <div class="page-form">
            <form id="signup-form" action="?r=menu/menuinfo" method="post" class="form" >
                <div class="header-content">
                    <h1>菜单添加</h1>
                </div>
                <div class="body-content">
                    <div class="form-group">
                        <div class="input-icon right"><i class="fa fa-th-large"></i>
                            <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken;?>" />
                            <input type="text" placeholder="菜单名称" name="menu_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-icon right"><i class="fa fa-th-large"></i>
                            <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken;?>" />
                            <input type="text" placeholder="菜单内容" name="menu_comment" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="display: block" class="select">
                            <select name="user_id" class="form-control">
                                <option value="" selected disabled>用户选择</option>
                                <?php
                                foreach($user as $val) {
                                    ?>
                                    <option value="<?php echo $val['uid'] ?>"><?php echo $val['uname'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label style="display: block" class="select">
                            <select name="menu_type" id="menu_type" class="form-control">
                                <option value="" selected disabled>菜单类型</option>
                                <option value="0" >主菜单</option>
                                <?php
                                foreach($menu as $val) {
                                    ?>
                                    <option value="<?php echo $val['mid'] ?>"><?php echo $val['menu_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </label>
                    </div>

                   菜单类型：<div style="margin-bottom: 15px" class="row">
                        <div class="col-lg-6">
                            <label>
                                <input type="radio" name="son_type" value="click" class="form-control">发送消息
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label>
                                <input type="radio" name="son_type" value="view" class="form-control">跳转页面
                            </label>
                        </div>
                    </div>
                    <div class="form-group mbn">
                        <button type="reset" class="btn btn-warning" ><i class="fa fa-chevron-circle-left"> &nbsp;重置 </i></button>

                        <button type="submit" class="btn btn-info pull-right">提交 &nbsp;
                            <i class="fa fa-chevron-circle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
</div>

    <!--添加结束-->
</div>
<script src="jquery-2.1.4.min.js"></script>
<script>

    $('#menu_type').change(function(){
        if($(this).val()=='0' || $(this).val()==''){
            $('#son_type').hide();
        }else{
            $('#son_type').show();
        }
    })
</script>

