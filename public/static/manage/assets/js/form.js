/**
 * 表单
 * Author:YuanKe
 * Date:2020年1月12日
 */

layui.use(['form', 'element', 'jquery'], function () {
    var form = layui.form(),
        element = layui.element(),
        $ = layui.jquery;

    form.on('submit(formDemo)', function(data){
        layer.msg(JSON.stringify(data.field));
        return false;
    });

    var active = {
        doGoBack: function () {
            var url = $(this).data('href');
            window.location.href = url;
        }
    };

    $('.do-action').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
});