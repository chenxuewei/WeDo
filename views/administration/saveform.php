
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">One Page</div>
        </div>
        
       
        
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <!--BEGIN CONTENT-->
    <div class="page-content">
        
            <h3 class="header-option-page mbxl">编辑公众号</h3>
            
                

                    
                        
                        <center>
                        <form action="?r=administration/up" method="post">
                            <table>
                            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>" />
                            <input type="hidden" name="aid" value="<?php echo $arr1['aid'] ?>" />
                                <tr>
                                    <td>公众号名称:</td>
                                    <td>
                                        <input type="text" name="aname" value="<?php echo $arr1['aname'] ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Appid:</td>
                                    <td>
                                       <input type="text" name="appid" value="<?php echo $arr1['appid'] ?>" /> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Appsecret：</td>
                                    <td>
                                        <input type="text" name="appsecret" value="<?php echo $arr1['appsecret'] ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>内容：</td>
                                    <td>
                                        <textarea name="account" ><?php echo $arr1['account'] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <input type="submit" value="编辑" />

                                    </td>
                                </tr>
                            </table>
                            </form>
                            </center>
 
            
        </div>
    </div>
    <!--END CONTENT-->
</div>