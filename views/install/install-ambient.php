<div class="panel panel-default">
    <div class="panel-heading">服务器信息</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">参数</th>
            <th>值</th>
            <th></th>
        </tr>
        <tr class="<?php if(isset($ret['server']['os']['class'])){echo $ret['server']['os']['class']; }?>">
            <td>服务器操作系统</td>
            <td><?php if(isset($ret['server']['os']['value'])){echo $ret['server']['os']['value']; }?></td>
            <td><?php if(isset($ret['server']['os']['remark'])){echo $ret['server']['os']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['server']['sapi']['class'])){echo $ret['server']['sapi']['class']; }?>">
            <td>Web服务器环境</td>
            <td><?php if(isset($ret['server']['sapi']['value'])){echo $ret['server']['sapi']['value']; }?></td>
            <td><?php if(isset($ret['server']['sapi']['remark'])){echo $ret['server']['sapi']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['server']['php']['class'])){echo $ret['server']['php']['class']; }?>">
            <td>PHP版本</td>
            <td><?php if(isset($ret['server']['php']['value'])){echo $ret['server']['php']['value']; }?></td>
            <td><?php if(isset($ret['server']['php']['remark'])){echo $ret['server']['php']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['server']['dir']['class'])){echo $ret['server']['dir']['class']; }?>">
            <td>程序安装目录</td>
            <td><?php if(isset($ret['server']['dir']['value'])){echo $ret['server']['dir']['value']; }?></td>
            <td><?php if(isset($ret['server']['dir']['remark'])){echo $ret['server']['dir']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['server']['disk']['class'])){echo $ret['server']['disk']['class']; }?>">
            <td>磁盘空间</td>
            <td><?php if(isset($ret['server']['disk']['value'])){echo $ret['server']['disk']['value']; }?></td>
            <td><?php if(isset($ret['server']['disk']['remark'])){echo $ret['server']['disk']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['server']['upload']['class'])){echo $ret['server']['upload']['class']; }?>">
            <td>上传限制</td>
            <td><?php if(isset($ret['server']['upload']['value'])){echo $ret['server']['upload']['value']; }?></td>
            <td><?php if(isset($ret['server']['upload']['remark'])){echo $ret['server']['upload']['remark']; }?></td>
        </tr>
    </table>
</div>

<div class="alert alert-info">PHP环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</div>
<div class="panel panel-default">
    <div class="panel-heading">PHP环境要求</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">选项</th>
            <th style="width:180px;">要求</th>
            <th style="width:50px;">状态</th>
            <th>说明及帮助</th>
        </tr>
        <tr class="<?php if(isset($ret['php']['version']['class'])){echo $ret['php']['version']['class'];}?>">
            <td>PHP版本</td>
            <td>5.4或者5.4以上</td>
            <td><?php if(isset($ret['php']['version']['value'])){echo $ret['php']['version']['value'];}?></td>
            <td><?php if(isset($ret['php']['version']['remark'])){echo $ret['php']['version']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['pdo']['class'])){echo $ret['php']['pdo']['class']; }?>">
            <td>MySQL</td>
            <td>支持(建议支持PDO)</td>
            <td><?php if(isset($ret['php']['mysql']['value'])){echo $ret['php']['mysql']['value']; }?></td>
            <td rowspan="2"><?php if(isset($ret['php']['pdo']['remark'])){echo $ret['php']['pdo']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['pdo']['class'])){echo $ret['php']['pdo']['class']; }?>">
            <td>PDO_MYSQL</td>
            <td>支持(强烈建议支持)</td>
            <td><?php if(isset($ret['php']['pdo']['value'])){echo $ret['php']['pdo']['value']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['curl']['class'])){echo $ret['php']['curl']['class']; }?>">
            <td>allow_url_fopen</td>
            <td>支持(建议支持cURL)</td>
            <td><?php if(isset($ret['php']['fopen']['value'])){echo $ret['php']['fopen']['value']; }?></td>
            <td rowspan="2"><?php if(isset($ret['php']['curl']['remark'])){echo $ret['php']['curl']['remark'];}?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['curl']['class'])){echo $ret['php']['curl']['class']; }?>">
            <td>cURL</td>
            <td>支持(强烈建议支持)</td>
            <td><?php if(isset($ret['php']['curl']['value'])){echo $ret['php']['curl']['value']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['ssl']['class'])){echo $ret['php']['ssl']['class']; }?>">
            <td>openSSL</td>
            <td>支持</td>
            <td><?php if(isset($ret['php']['ssl']['value'])){echo $ret['php']['ssl']['value']; }?></td>
            <td><?php if(isset($ret['php']['ssl']['remark'])){echo $ret['php']['ssl']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['gd']['class'])){echo $ret['php']['gd']['class']; }?>">
            <td>GD2</td>
            <td>支持</td>
            <td><?php if(isset($ret['php']['gd']['value'])){echo $ret['php']['gd']['value']; }?></td>
            <td><?php if(isset($ret['php']['gd']['remark'])){echo $ret['php']['gd']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['dom']['class'])){echo $ret['php']['dom']['class']; }?>">
            <td>DOM</td>
            <td>支持</td>
            <td><?php if(isset($ret['php']['dom']['value'])){echo $ret['php']['dom']['value']; }?></td>
            <td><?php if(isset($ret['php']['dom']['remark'])){echo $ret['php']['dom']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['session']['class'])){echo $ret['php']['session']['class']; }?>">
            <td>session.auto_start</td>
            <td>关闭</td>
            <td><?php if(isset($ret['php']['session']['value'])){echo $ret['php']['session']['value']; }?></td>
            <td><?php if(isset($ret['php']['session']['remark'])){echo $ret['php']['session']['remark'];  }?></td>
        </tr>
        <tr class="<?php if(isset($ret['php']['asp_tags']['class'])){echo $ret['php']['asp_tags']['class']; }?>">
            <td>asp_tags</td>
            <td>关闭</td>
            <td><?php if(isset($ret['php']['asp_tags']['value'])){echo $ret['php']['asp_tags']['value']; }?></td>
            <td><?php if(isset($ret['php']['asp_tags']['remark'])){echo $ret['php']['asp_tags']['remark']; }?></td>
        </tr>
    </table>
</div>

<div class="alert alert-info">系统要求微擎整个安装目录必须可写, 才能使用微擎所有功能。</div>
<div class="panel panel-default">
    <div class="panel-heading">目录权限监测</div>
    <table class="table table-striped">
        <tr>
            <th style="width:150px;">目录</th>
            <th style="width:180px;">要求</th>
            <th style="width:50px;">状态</th>
            <th>说明及帮助</th>
        </tr>
        <tr class="<?php if(isset($ret['write']['root']['class'])){echo $ret['write']['root']['class'];}?>">
            <td>/</td>
            <td>整目录可写</td>
            <td><?php if(isset($ret['write']['root']['value'])){echo $ret['write']['root']['value'];}?></td>
            <td><?php if(isset($ret['write']['root']['remark'])){echo $ret['write']['root']['remark']; }?></td>
        </tr>
        <tr class="<?php if(isset($ret['write']['data']['class'])){echo $ret['write']['data']['class']; }?>">
            <td>/</td>
            <td>data目录可写</td>
            <td><?php if(isset($ret['write']['data']['value'])){echo $ret['write']['data']['value']; }?></td>
            <td><?php if(isset($ret['write']['data']['remark'])){echo $ret['write']['data']['remark']; }?></td>
        </tr>
    </table>
</div>
<form class="form-inline" role="form" action="?r=install/mysql"  method="post">

    <input type="hidden" name="_csrf" value="<?php echo YII::$app->request->csrfToken;?>">
    <input type="hidden" name="do" id="do" />
    <ul class="pager">
        <li class="previous"><a href="?r=install/index" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
        <?php if(empty($ret['continue'])) {
        $continue = '<li class="previous disabled"><a href="javascript:;">请先解决环境问题后继续</a></li>';
        } else {
        $continue = '<li class="previous"><a href="javascript:;" onclick="$(\'#do\').val(\'continue\');$(\'form\')[0].submit();">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>';
        } ?>

        <?php if(isset($continue)){echo $continue; }?>
    </ul>
</form>