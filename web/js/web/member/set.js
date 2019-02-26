;
let member_set_ops = {
    init: function () {
        this.eventBind()
    },
    
    eventBind: function () {
        $(".wrap_member_set .save").click(function () {
            let btn_target = $(this);
            if (btn_target.hasClass("disabled")) {
                common_ops.alert("正在处理中,请不要重复点击");
                return;
            }
            let nickname_target = $(".wrap_member_set input[name=nickname]");
            let nickname = nickname_target.val();
            let mobile_target = $(".wrap_member_set input[name=mobile]");
            let mobile = mobile_target.val();

            btn_target.addClass("disabled");

            if (nickname.length < 1) {
                common_ops.tip("请输入符合规范的名字", nickname_target);
            }
            if (!(/^1[3578]\d{9}$/.test(mobile))) {
                common_ops.tip("请输入符合规范的手机号", mobile_target);
            }


            let data = {
                nickname: nickname,
                mobile: mobile,
                id: $(".wrap_member_set input[name=id]").val()
            };

            $.ajax({
                url: common_ops.buildWebUrl("/member/set"),
                type: "post",
                data: data,
                dataType: "json",
                success: function (res) {
                    btn_target.removeClass("disabled");
                    let callback = null;
                    if (res.code === 200) {
                        callback = function () {
                            window.location.href = common_ops.buildWebUrl("/member/index");
                        }
                    }
                    common_ops.alert(res.msg, callback);
                }
            })
        })
    }
};


$(document).ready(function () {
    member_set_ops.init()
});
