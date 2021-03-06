<form class="form-horizontal"  method="post" action="?r=install/success" role="form">
    <div class="panel panel-default">
        <div class="panel-heading">安装选项</div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">数据库选项</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库主机</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[server]" value="127.0.0.1">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库端口</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[duan]" value="3306">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库用户</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[username]" value="root">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库密码</label>
                <div class="col-sm-4">
                    <input class="form-control" aid="pass" type="password" name="db[password]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">表前缀</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[prefix]" value="wd_">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">数据库名称</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="db[name]" value="wedo">
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">管理选项</div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">管理员账号</label>
                <div class="col-sm-4">
                    <input class="form-control" type="username" name="user[username]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">管理员密码</label>
                <div class="col-sm-4">
                    <input class="form-control" type="password" name="user[password]">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-4">
                    <input class="form-control" type="password">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="do" id="do" />
    <ul class="pager">
        <li class="previous"><a href="?r=install/ambient" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
        <li class="previous"><a href="javascript:;" onclick="if(check(this)){jQuery('#do').val('continue');if($('input[name=type]').val() == 'remote'){alert('在线线安装时，安装程序会下载精简版快速完成安装，完成后请务必注册云服务更新到完整版。')}$('form')[0].submit();}">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
    </ul>
</form>
<script>
    var lock = false;
    function check(obj) {
        if(lock) {
            return;
        }
        $('.form-control').parent().parent().removeClass('has-error');
        var error = false;
        $('.form-control').each(function(){
            if($(this).val() == '') {
                if($(this).attr("name") == 'db[password]'){
                    error = false;
                }else{
                    $(this).parent().parent().addClass('has-error');
                    this.focus();
                    error = true;
                }
                
            }
        });
        if(error) {
            alert('请检查未填项');
            return false;
        }
        if($(':password').eq(1).val() != $(':password').eq(2).val()) {
            $(':password').parent().parent().addClass('has-error');
            alert('确认密码不正确.');
            return false;
        }
        lock = true;
        $(obj).parent().addClass('disabled');
        $(obj).html('正在执行安装');
        return true;
    }
</script>