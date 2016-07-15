<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">查看公众号属性</div>
        </div>
        <ol class="breadcrumb page-breadcrumb">
            <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><a href="#">Frontend</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">查看公众号属性</li>
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
                    
                        <td align="center">Appid</td>
                        <td align="center">Token</td>
                        
                    </tr>
                    <tbody>
                   
                        <tr>
                            
                            <td align="center"><?= $arr2['appid'] ?></td>
                            <td align="center"><?= $arr2['atoken'] ?></td>
                            
                        </tr>
                        
                        </tbody>
                        </thead>
                        </table>
                               
</div>
</div>