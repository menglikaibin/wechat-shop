
var user_reset_pwd_ops = {
  init:function () {
      this.eventBind();
  },
  eventBind:function () {
      $("#save").click(function () {
          var btn_target = $(this);
          if (btn_target.hasClass("disabled")) {
              alert("正在处理,请稍后");
              return false;
          }

          var old_pwd = $("#old_password").val();
          var new_pwd = $("#new_password").val();

          if (old_pwd.length < 1) {
              alert("请输入原密码");
          }

          if (new_pwd.length < 6) {
              alert("请输入一个不小于6位数的新密码");
          }

          btn_target.addClass("disabled");

          $.ajax({
              url:'/web/user/reset-pwd',
              type:'POST',
              data:{
                  old_password:old_pwd,
                  new_password:new_pwd
              },
              dataType:'json',
              success: function (res) {
                  alert(res.msg);
                  btn_target.removeClass("disabled");
                  if (res.code == 200) {
                      window.location.reload();
                  }
              },
              error: function (res) {
                  console.log(res);
              }
          })

      });
  }
};

$(document).ready(function () {
    user_reset_pwd_ops.init();
});

