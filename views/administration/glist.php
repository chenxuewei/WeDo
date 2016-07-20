            <?php
            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            ?>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">添加公众号</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><a href="">公众号管理</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">公众号添加</li>
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
                        <form id="signup-form" action="?r=administration/add" method="post" class="form" >
                            <div class="header-content">
                                <h1>添加公众号</h1>
                            </div>
                            <div class="body-content">
                                <div class="form-group">
                                    <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-send-o fa-fw jstree-themeicon-custom"></i>
                                        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken;?>" />
                                        <input type="text" placeholder="公众号名称" name="aname" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-icon right">
                                        <i class="jstree-icon jstree-themeicon fa fa-paperclip jstree-themeicon-custom"></i>
                                        <input type="text" placeholder="Appid" name="appid" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-icon right"><i class="jstree-icon jstree-themeicon fa fa-paperclip jstree-themeicon-custom"></i>
                                        <input type="text" placeholder="Appsecret" name="appsecret" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-icon right"> 内容：
                                        <textarea name="account" id="editor"></textarea>
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
<script type="text/javascript" charset="utf-8" src="baidu/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="baidu/ueditor.all.min.js"> </script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>

