<div class="panel panel-default">
    <div class="panel-heading">阅读许可协议</div>
    <div class="panel-body" style="overflow-y:scroll;max-height:400px;line-height:20px;">
        <h3>版权所有 (c)2014，微度团队保留所有权利。 </h3>
        <p>
            感谢您选择微度 - 微信公众平台自助开源（以下简称WE7，WE7基于 PHP + MySQL的技术开发，全部源码开放。 <br />
            为了使你正确并合法的使用本软件，请你在使用前务必阅读清楚下面的协议条款：
        </p>
        <p>
            <strong>一、本授权协议适用且仅适用于微度系统(We7, MicroEngine. 以下简称微度)任何版本，微度官方对本授权协议的最终解释权。</strong>
        </p>
        <p>
            <strong>二、协议许可的权利 </strong>
        <ol>
            <li>您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途，而不必支付软件版权授权费用。</li>
            <li>您可以在协议规定的约束和限制范围内修改微度源代码或界面风格以适应您的网站要求。</li>
            <li>您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。</li>
            <li>获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。</li>
        </ol>
        </p>
        <p>
            <strong>三、协议规定的约束和限制 </strong>
        <ol>
            <li>未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目的或实现盈利的网站）。</li>
            <li>未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</li>
            <li>未经官方许可，禁止在微度的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</li>
            <li>如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。</li>
        </ol>
        </p>
        <p>
            <strong>四、有限担保和免责声明 </strong>
        <ol>
            <li>本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。</li>
            <li>用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。</li>
            <li>电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装  WE7，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</li>
            <li>如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。</li>
        </ol>
        </p>
    </div>
</div>
<form class="form-inline" role="form" action="?r=install/ambient" method="post">
    <ul class="pager">
        <li class="pull-left" style="display:block;padding:5px 10px 5px 0;">
            <div class="checkbox">
                <label>
                    <input type="hidden" name="_csrf" value="<?php echo YII::$app->request->csrfToken;?>">
                    <input type="checkbox"> 我已经阅读并同意此协议
                </label>
            </div>
        </li>
        <li class="previous"><a href="javascript:;" onclick="if(jQuery(':checkbox:checked').length == 1){jQuery('form')[0].submit();}else{alert('您必须同意软件许可协议才能安装！')};">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
    </ul>
</form>