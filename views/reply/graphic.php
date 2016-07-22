<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">图文回复</div>
            </div>
            <ol class="breadcrumb page-breadcrumb">
                <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li><a href="">自定义回复</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active"><a href="?r=reply/graphic">图文回复</a></li>
            </ol>
            <div class="btn btn-blue reportrange hide"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;report&nbsp;<i class="fa fa-angle-down"></i>
                <input type="hidden" name="datestart" />
                <input type="hidden" name="endstart" />
            </div>
            <div class="clearfix"></div>
        </div>
    <!--添加开始-->
    <div style="height: 100%">
        <div>
            <div class="page-form" style="width: 80%" >
                <form id="signup-form" action="?r=reply/graphic" method="post" class="form" enctype="multipart/form-data" >
                    <div class="header-content">
                        <h1>添加图文</h1>
                    </div>
                    <div class="body-content">
                        <div class="form-group">
                            <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-send-o fa-fw jstree-themeicon-custom"></i>
                                <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken;?>" />
                                <input type="text" placeholder="规则用户：<?=$arr['aname']?>" disabled name="a_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-send-o fa-fw jstree-themeicon-custom"></i>
                                <input type="hidden" name="aid" value="<?=$arr['aid']?>" />
                                <input type="text" placeholder="标题" name="s_title" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-paperclip jstree-themeicon-custom"></i>
                                <input type="text" placeholder="关键字" name="s_guan" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-paperclip jstree-themeicon-custom"></i>
                                <input type="file" placeholder="图片" style="background:white" name="s_img" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-paperclip jstree-themeicon-custom"></i>
                                <input type="text" placeholder="图片URL" name="s_url" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon right"> 图片描述：
                                <textarea name="s_desc" id="editor"></textarea>
                            </div>
                        </div>

                        <div class="form-group mbn">
                            <button type="reset" class="btn btn-warning" ><i class="fa fa-chevron-circle-left"> &nbsp;重置 </i></button>

                            <button type="submit" class="btn btn-info pull-right">添加 &nbsp;
                                <i class="fa fa-chevron-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--添加结束-->
</div>
<script type="text/javascript" charset="utf-8" src="baidu/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="baidu/ueditor.all.min.js"> </script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>


