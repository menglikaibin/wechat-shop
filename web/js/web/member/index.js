;
let member_ops = {
    init: function () {
        this.eventBind();
    },
    eventBind: function () {
        let that = this;

        $(".remove").click(function () {
            that.ops("remove", $(this).attr("data"));
        });

        $(".recover").click(function () {
            that.ops("recover", $(this).attr("data"));
        });


        $(".wrap_search .search").click(function () {
            $(".wrap_search").submit();
        })
    },
    ops: function (act, id) {
        let callback = {
            'ok': function () {
                $.ajax({
                    url: common_ops.buildWebUrl("/member/ops"),
                    type: "post",
                    dataType: "json",
                    data: {
                        id: id,
                        act: act
                    },
                    success: function (res) {
                        let callback = null;
                        if (res.code === 200) {
                            callback = function () {
                                window.location.reload();
                            }
                        }
                        common_ops.alert(res.msg, callback);
                    }
                })
            },
            'cancel': null
        };

        common_ops.confirm(act === "remove" ? "确定删除?" : "确定恢复?", callback);
    }
};


$(document).ready(function () {
    member_ops.init();
});