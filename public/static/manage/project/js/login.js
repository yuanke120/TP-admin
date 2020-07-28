/**
 * 登陆模块
 * Author:YuanKe
 * Date:2020年1月12日
 */


layui.use(['layer', 'form', 'element', 'jquery', 'common'], function () {
    var layer = layui.layer,
        form = layui.form(),
        element = layui.element(),
        $ = layui.jquery,
        common = layui.common;

    form.on('submit(formLogin)', function(data){
        var loading = layer.load();
        common.ajax($('#login-form').attr('action'), 'post', 'json', data.field, function (res) {
            layer.close(loading);
            switch (res.code){
                case '200':
                    window.location.href = res.url;
                    break;
                default:
                    layer.msg(res.msg);
                    break;
            };
        });
        return false;
    });
});