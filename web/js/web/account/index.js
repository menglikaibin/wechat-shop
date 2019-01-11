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
            that.ops("remove", $(this).attr("data"));
        })
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

            }
        })
    }

};

$(document).ready(function () {
    account_index_ops.init();
});