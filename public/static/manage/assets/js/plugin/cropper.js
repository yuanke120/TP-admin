/**
 * cropper
 * User: YuanKe
 * Date: 19-11-23
 * Time: 下午1:06
 */

layui.use(['layer', 'jquery', 'cropper'], function () {
    var $ = layui.jquery;

    $(document).ready(function () {
        UploadAvatar();
    });

    function UploadAvatar() {
        var o = $(".img-crop > img");
        $(o).cropper({
            aspectRatio: 1/1, preview: ".img-preview", done: function () {
            }
        });
        var r = $("#inputImage");
        window.FileReader ? r.change(function () {
            var e, i = new FileReader, t = this.files;
            t.length && (e = t[0], /^image\/\w+$/.test(e.type) ? (i.readAsDataURL(e), i.onload = function () {
                r.val(""), o.cropper("reset", !0).cropper("replace", this.result)
            }) : showMessage('请上传图片！'))
        }) : r.addClass("hide"), $("#upload").click(function () {
            $(this).attr({"disabled":"disabled"});
            $(this).text('上传中');
            alert(o.cropper("getDataURL"));
            // simpleAjax($("#upload_avatar_url").text(),"POST","json",{
            //     "avatar":o.cropper("getDataURL")
            // },function (res) {
            //     switch (res.code) {
            //         case "N200":
            //             alertSuccess(res.msg,null);
            //             setTimeout(function () {
            //                 $("#avatar1",window.parent.document).attr('src',o.cropper("getDataURL"));
            //                 $("#avatar2",window.parent.document).attr('src',o.cropper("getDataURL"));
            //             }, 2000);
            //             break;
            //         default:
            //             alertError(res.msg,null);
            //             break;
            //     }
            // });
            $("#upload").removeAttr("disabled");
            $(this).text('确认保存');
        }), $("#zoomIn").click(function () {
            o.cropper("zoom", .1)
        }), $("#zoomOut").click(function () {
            o.cropper("zoom", -.1)
        }), $("#rotateLeft").click(function () {
            o.cropper("rotate", 90)
        }), $("#rotateRight").click(function () {
            o.cropper("rotate", -90)
        }), $("#setDrag").click(function () {
            o.cropper("setDragMode", "crop")
        })
    };
});