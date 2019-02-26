;
let account_set_ops = {
    init: function () {
        this.eventBind();
    },

    eventBind: function () {
        $(".wrap_account_set .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理,请不要重复提交");
                return;
            }

            let nickname = $(".wrap_account_set input[name=nickname]").val();
            let mobile = $(".wrap_account_set input[name=mobile]").val();
            let email = $(".wrap_account_set input[name=email]").val();
            let login_name = $(".wrap_account_set input[name=login_name]").val();
            let login_pwd = $(".wrap_account_set input[name=login_pwd]").val();

            if (nickname.length < 1) {
                common_ops.tip("请输入符合规范的姓名", $(".wrap_account_set input[name=nickname]"));
                return;
            }
            if(!(/^1[34578]\d{9}$/.test(mobile))){
                common_ops.tip("手机号码有误，请重填", $(".wrap_account_set input[name=mobile]"));
                return false;
            }
            if (!(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email))) {
                common_ops.tip("请输入符合规范的邮箱", $(".wrap_account_set input[name=email]"));
                return;
            }
            if (login_name.length < 1) {
                common_ops.tip("请输入符合规范的登录名", $(".wrap_account_set input[name=login_name]"));
                return;
            }
            if (login_pwd.length < 6) {
                common_ops.tip("请输入符合规范的密码", $(".wrap_account_set input[name=login_pwd]"));
                return;
            }

            btn_target.addClass("disabled");

            let data = {
                "nickname": nickname,
                "mobile": mobile,
                "email": email,
                "login_name": login_name,
                "login_pwd": login_pwd,
                "id": $(".wrap_account_set input[name=id]").val()
            };

            $.ajax({
                type: "post",
                url: common_ops.buildWebUrl("/account/set"),
                dataType: "json",
                data: data,
                success: function (res) {
                    btn_target.removeClass("disabled");
                    let callback = null;
                    
                    if (res.code == 200) {
                        callback = function () {
                            window.location.href = common_ops.buildWebUrl("/account/index");
                        }
                    }
                    
                    common_ops.alert(res.msg, callback);
                }
            })
        })
    }
};

$(document).ready(function () {
    account_set_ops.init();
});