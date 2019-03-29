;
let user_bind_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        let that = this;
        $(".login_form_wrap .dologin").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                alert("正在处理!!请不要重复提交");
                return;
            }
            let mobile = $(".login_form_wrap input[name=mobile]").val();
            let img_captcha = $(".login_form_wrap input[name=img_captcha]").val();
            let captcha_code = $(".login_form_wrap input[name=captcha_code]").val();

            if (mobile.length < 1 || !/^[1-9]\d{10}$/.test(mobile)) {
                alert("请输入符合要求的手机号");
                return false;
            }
            if (img_captcha.length < 1) {
                alert("请输入图形验证码");
                return false;
            }
            if (captcha_code.length < 1) {
                alert("请输入手机验证码");
                return false;
            }

            btn_target.addClass("disabled");

            let data = {
                mobile: mobile,
                img_captcha: img_captcha,
                captcha_code: captcha_code,
                referer: $(".hide_wrap input[name=referer]").val()
            };

            $.ajax({
                url: common_ops.buildMUrl("/user/bin"),
                type: "post",
                data: data,
                dataType: "json",
                success: function (res) {
                    btn_target.removeClass("disabled");
                    alert(res.msg);
                    if (res.code !== 200) {
                        $("#img_captcha").click();
                        return;
                    }
                    window.location.href = res.data.url;
                }
            })
        });
    }
};

$(document).ready(function () {
    user_bind_ops.init();
});