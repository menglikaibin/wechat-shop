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
        $.ajax({
            url: common_ops.buildWebUrl("/account/ops"),
            type: "POST",
            data: {
                act: act,
                uid: uid
            },
            dataType: "json",
            success: function (res) {
                common_ops.alert("success");
                if (res.code == 200) {
                    window.location.href = window.location.href;
                }
            }
        })
    }

};

$(document).ready(function () {
    account_index_ops.init();
});