<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">查看公众号属性</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="?r=index/index">后台</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="?r=administration/sel">公众号管理</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="?r=administration/attribute">查看公众号属性</li>
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
                    
                        <td align="center">Url</td>
                        <td align="center">Token</td>
                        
                    </tr>
                    <tbody>
                   
                        <tr>
                            
                            <td align="center">
                                <input type="text" id="aurl"  value="<?php echo $arr2['aurl']?>" style="width:350px;"/>
                               <button id="url">复制</button> 
                            </td>
                            <td align="center">
                               <input type="text" id="atoken"  value="<?php echo $arr2['atoken']?>" style="width:200px;"/> 
                               <button id="token">复制</button>
                            </td>
                            
                        </tr>
                        
                        </tbody>
                        </thead>
                        </table>
                               
</div>
</div>
<script>
    $('#url').click(function(){
        var Url=document.getElementById("aurl");
        Url.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        alert("URL地址已经复制到您的粘贴板");
    })

    $('#token').click(function(){
        var Url=document.getElementById("aurl");
        Url.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        alert("Token地址已经复制到您的粘贴板");
    })
</script>