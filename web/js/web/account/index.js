;
var account_index_ops = {
    init:function () {
        this.eventBind();
    },
    eventBind:function () {
        var that = this;

        $(".search").click(function () {
            $(".wrap_search").submit();
        });

        $(".remove").click(function () {
            if (!confirm("您确定删除吗?")) {
                return;
            }
            that.ops("remove", $(this).attr("data"));
        });

        $(".recover").click(function () {
            layer.confirm();
            that.ops("recover", $(this).attr("data"));
        });
    },

    ops: function(act, uid){
        callBack =
            {
            "ok": function ()
                {
                    $.ajax({
                        url: common_ops.buildWebUrl("/account/ops"),
                        type: "POST",
                        data: {act: act, uid: uid},
                        dataType: "json",
                        success: function (res) {
                            cb = null;
                            if (res.code == 200) {
                                cb = function() {
                                    window.location.href = window.location.href;
                                }
                            }
                            common_ops.alert(res.msg, cb);
                        }
                    })
                },
            "cancle": function ()
                {

                }
            };
        common_ops.confirm((act == "remove") ? "您确定删除吗?" : "您确定恢复吗", callBack);
    }
};

$(document).ready(function () {
    account_index_ops.init();
});