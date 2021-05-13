//注册页面函数，发送Email和手机验证码
var jieqiRegister = {
  emailSet:{
    iid: 'email',
    tid: 'btnemailrand',
    wait: 60,
    count: 0
  },
  mobileSet:{
    iid: 'mobile',
    tid: 'btnmobilerand',
    wait: 60,
    count: 0
  },
  sendEmailRand: function (ele) {
    var email = document.getElementById(jieqiRegister.emailSet.iid);
    if (email.value == '') {
      alert('请先输入Email地址！');
      email.focus();
    } else {
      Ajax.Request('/emailverify.php?sendemail=1&type=randcode&email=' + email.value, {
        onLoading: jieqiRegister.sendEmailLoading,
        onComplete: jieqiRegister.sendEmailComplete
      });
    }
  },
  sendEmailLoading: function () {
    document.getElementById(jieqiRegister.emailSet.tid).value = '正在发送...';
  },
  sendEmailComplete: function () {
    if (this.response.indexOf('成功') != -1) {
      jieqiRegister.emailSet.count = jieqiRegister.emailSet.wait;
      document.getElementById(jieqiRegister.emailSet.tid).setAttribute("disabled", true);
      setTimeout(jieqiRegister.sendEmailWait, 1000);
    } else {
      alert(this.response.replace(/<br[^<>]*>/g, '\n'));
      document.getElementById(jieqiRegister.emailSet.tid).value = '发送验证码';
    }
  },
  sendEmailWait: function () {
    var ele = document.getElementById(jieqiRegister.emailSet.tid);
    if (jieqiRegister.emailSet.count <= 0) {
      ele.removeAttribute("disabled");
      ele.value = "发送验证码";
    } else {
      ele.value = "重新发送(" + jieqiRegister.emailSet.count + ")";
      jieqiRegister.emailSet.count--;
      setTimeout(jieqiRegister.sendEmailWait, 1000);
    }
  },
  sendMobileRand: function (ele) {
    var mobile = document.getElementById(jieqiRegister.mobileSet.iid);
    if(!(/^1\d{10}$/.test(mobile.value))){
      alert('请先输入手机号码！');
      mobile.focus();
    } else {
      Ajax.Request('/mobileverify.php?act=send&for=register&mobile=' + mobile.value, {
        onLoading: jieqiRegister.sendMobileLoading,
        onComplete: jieqiRegister.sendMobileComplete
      });
    }
  },
  sendMobileLoading: function () {
    document.getElementById(jieqiRegister.mobileSet.tid).value = '正在发送...';
  },
  sendMobileComplete: function () {
    if (this.response.indexOf('成功') != -1) {
      jieqiRegister.mobileSet.count = jieqiRegister.mobileSet.wait;
      document.getElementById(jieqiRegister.mobileSet.tid).setAttribute("disabled", true);
      setTimeout(jieqiRegister.sendMobileWait, 1000);
    } else {
      alert(this.response.replace(/<br[^<>]*>/g, '\n'));
      document.getElementById(jieqiRegister.mobileSet.tid).value = '获取验证码';
    }
  },
  sendMobileWait: function () {
    var ele = document.getElementById(jieqiRegister.mobileSet.tid);
    if (jieqiRegister.mobileSet.count <= 0) {
      ele.removeAttribute("disabled");
      ele.value = "获取验证码";
    } else {
      ele.value = "重新发送(" + jieqiRegister.mobileSet.count + ")";
      jieqiRegister.mobileSet.count--;
      setTimeout(jieqiRegister.sendMobileWait, 1000);
    }
  }
}

function sendemailrand(ele){
  jieqiRegister.sendEmailRand(ele);
}
function sendmobilerand(ele){
  jieqiRegister.sendMobileRand(ele);
}