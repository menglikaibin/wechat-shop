;
let upload = {
    error: function (msg) {
        $.alert(msg);
    },
    success: function (file_key, type) {
        if (!file_key) {
            return;
        }
        let html = '<img src="'+common_ops.buildPicUrl("brand",file_key)+'"/>'
            +'<span class="fa fa-times-circle del del_image" data="'+file_key+'"></span>';

        if( $(".upload_pic_wrap .pic-each").size() > 0 ){
            $(".upload_pic_wrap .pic-each").html( html );
        }else{
            $(".upload_pic_wrap").append('<span class="pic-each">'+ html + '</span>');
        }
        brand_image_ops.delete_img();
    }
};

let brand_image_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        $(".set_pic").click(function () {
            $("#brand_image_wrap").modal("show");
        });

        $("#brand_image_wrap .upload_pic_wrap input[name=pic]").change(function () {
            $("#brand_image_wrap .upload_pic_wrap").submit();
        });

        $("#brand_image_wrap .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理请不要重复提交");
                return;
            }

            if ($("#brand_image_wrap .pic_each").size() < 1) {
                common_ops.alert("请上传图片");
                return;
            }

            btn_target.addClass("disabled");

            $.ajax({
                url: common_ops.buildWwwUrl("/brand/set-image"),
                type: "post",
                dataType: "json",
                data: {image_key: $("#brand_image_wrap .pic_each .del_image")},
                success: function (res) {
                    btn_target.removeClass("disabled");
                    let callback = null;
                    if (res.code == 200) {
                        callback = function () {
                            window.location.reload();
                        }
                    }

                    common_ops.alert(res.msg, callback);
                }
            })

        });
    },
    delete_img: function () {
        $("#brand_image_wrap .del_image").unbind().click(function () {
            $(this).parent().remove();
        })
    }
};

$(document).ready(function () {
    brand_image_ops.init();
});