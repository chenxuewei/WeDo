<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">获取菜单配置</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="">自定义菜单选项</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">获取菜单配置</li>
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
            <form id="signup-form" action="?r=menu/getmenu" method="post" class="form" >
                <div class="header-content">
                    <h1>选择用户</h1>
                </div>
                    <div class="form-group">
                        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken;?>" />
                        <label style="display: block" class="select">
                            <select name="user_id" class="form-control">
                                <option value="" selected disabled>用户选择</option>
                                <?php
                                foreach($user as $val) {
                                    ?>
                                    <option value="<?php echo $val['aid'] ?>"><?php echo $val['aname'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group mbn">
                        <button type="submit" class="btn btn-info pull-right">查看 &nbsp;
                            <i class="fa fa-chevron-circle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--添加结束-->
</div>


