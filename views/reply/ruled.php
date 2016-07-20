
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">添加规则</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><a href="">自定义回复</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active"><a href="?r=administration/index">添加规则</a></li>
                    </ol>
                    <div class="btn btn-blue reportrange hide"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;report&nbsp;<i class="fa fa-angle-down"></i>
                        <input type="hidden" name="datestart" />
                        <input type="hidden" name="endstart" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <center>
                <div class="page-content">
                    <div class="row">

                        <div class="col-lg-6">

                            <div class="portlet box portlet-blue">
                                <div class="portlet-header">
                                    <div class="caption">Sign Up Form</div>
                                    <div class="tools"><i class="fa fa-chevron-up"></i><i data-toggle="modal" data-target="#modal-config" class="fa fa-cog"></i><i class="fa fa-refresh"></i><i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="?r=reply/add" method="post" class="form-validate-signup">
                                   
                                <table width="200" height="300">
                                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>" />
                                    <tr>
                                        <td>规则用户:</td>
                                        <td>
                                            <select name="aid">
                                                <?php
                                    foreach($arr as $val){
                                    ?>
                                        <option value="<?php echo $val['aid'] ?>"><?php echo $val['aname'] ?></option>
                                    <?php
                                        }
                                    ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>标题:</td>
                                        <td>
                                            <input type="text" name="rename" /> 
                                         </td>
                                </tr>
                                <tr>
                                    <td>关键字：</td>
                                    <td>
                                       <input type="text" name="rekeyword" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>回复内容：</td>
                                    <td>
                                        <textarea name="trcontent"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="2">
                                        <input type="submit" class="btn btn-success btn-block" value="提交" />
                                        <input type="reset" class="btn btn-success btn-block" value="返回" />

                                    </td>
                                </tr>
                            </table>

                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </center> 
                <!--END CONTENT-->
            </div>