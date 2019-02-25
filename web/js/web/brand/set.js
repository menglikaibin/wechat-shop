;
upload = {
    error: function (msg) {
        common_ops.alert(msg);
    },

    success: function (image_key) {
        let url = common_ops.buildPicUrl("brand", image_key);
        let html =
            '<img src="' + url + '">' +
            '<span class="fa fa-times-circle del del_image" data="' + image_key + '">' +
                '<i>' +
                '</i>' +
            '</span>';
        let ele = $(".upload_pic_wrap .pic-each");
        if (ele.size() > 0) {
            ele.html(html);
        } else {
            $(".upload_pic_wrap").append('<span class="pic-each">' + html + '</span>')
        }

        brand_set_ops.delImage();
    }
};

let brand_set_ops = {
    init : function () {
        this.eventBind();
        this.delImage();
    },
    
    eventBind: function () {
        $(".wrap_brand_set .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理,请不要重复点击");
                return;
            }

            let name_target = $(".wrap_brand_set input[name=name]");
            let name = name_target.val();

            let image_key = $(".wrap_brand_set .pic-each .del_image").attr("data");

            let mobile_target = $(".wrap_brand_set input[name=mobile]");
            let mobile = mobile_target.val();

            let address_target = $(".wrap_brand_set input[name=address]");
            let address = address_target.val();

            let description_target = $(".wrap_brand_set textarea[name=description]");
            let description = description_target.val();

            if (name.length < 1) {
                common_ops.tip("请输入符合规范的品牌名称", name_target);
                return;
            }
            if ($(".wrap_brand_set .pic-each .del_image").size < 1) {
                common_ops.alert("请上传品牌logo");
                return;
            }
            if (!(/^1[34578]\d{9}$/.test(mobile))) {
                common_ops.tip("请输入符合规范的手机号", mobile_target);
                return;
            }
            if (address.length < 1) {
                common_ops.tip("请输入符合规范的地址", address_target);
                return;
            }
            if (description.length < 2) {
                common_ops.tip("请输入符合规范的描述", description_target);
                return;
            }

            btn_target.addClass("disabled");

            let data = {
                name: name,
                image_key: image_key,
                mobile: mobile,
                address: address,
                description: description,
            };

            $.ajax({
                url: common_ops.buildWebUrl("/brand/set"),
                type: "post",
                data: data,
                dataType: "json",
                success: function (res) {
                    btn_target.removeClass("disabled");

                    let callback = null;
                    if (res.code == 200) {
                        callback = function () {
                            window.location.href = common_ops.buildWebUrl("/brand/info");
                        }
                    }
                    
                    common_ops.alert(res.msg, callback);
                }
            })
        });

        $(".wrap_brand_set .upload_pic_wrap input[name=pic]").change(function () {
            $(".wrap_brand_set .upload_pic_wrap").submit();
        });
    },

    delImage: function () {
        $(".wrap_brand_set .del_image").unbind().click(function () {
            $(this).parent().remove();
        })
    }
};


$(document).ready(function () {
    brand_set_ops.init();
});