//发送Email和手机验证码
var jieqiVerify = {
  emailSet:{
    iid: 'email',
    tid: 'btnemailrand',
    cid: 'checkcode',
    pid: 'imgccode',
    wait: 60,
    count: 0
  },
  mobileSet:{
    iid: 'mobile',
    tid: 'btnmobilerand',
    cid: 'm_checkcode',
    pid: 'm_imgccode',
    wait: 60,
    count: 0
  },
  sendEmailRand: function () {
    var email = $_(jieqiVerify.emailSet.iid);
    if (email.getValue() == '') {
      alert('请先输入Email地址！');
      email.focus();
    } else {
      var url = '/emailverify.php?sendemail=1&type=randcode&email=' + email.getValue();
      var checkcode = $_(jieqiVerify.emailSet.cid);
      if(checkcode) url += '&checkcode=' + checkcode.value;
      Ajax.Request(url, {
        onLoading: jieqiVerify.sendEmailLoading,
        onComplete: jieqiVerify.sendEmailComplete
      });
    }
  },
  sendEmailLoading: function () {
    $_(jieqiVerify.emailSet.tid).setValue('正在发送...');
  },
  sendEmailComplete: function () {
    if (this.response.indexOf('成功') != -1) {
      jieqiVerify.emailSet.count = jieqiVerify.emailSet.wait;
      $_(jieqiVerify.emailSet.tid).setAttribute("disabled", true);
      setTimeout(jieqiVerify.sendEmailWait, 1000);
    } else {
      alert(this.response.replace(/<br[^<>]*>/g, '\n'));
      $_(jieqiVerify.emailSet.tid).setValue('发送验证码');
    }
  },
  sendEmailWait: function () {
    var ele = $_(jieqiVerify.emailSet.tid);
    if (jieqiVerify.emailSet.count <= 0) {
      ele.removeAttribute('disabled');
      ele.setValue('发送验证码');
    } else {
      ele.setValue('重新发送(' + jieqiVerify.emailSet.count + ')');
      jieqiVerify.emailSet.count--;
      setTimeout(jieqiVerify.sendEmailWait, 1000);
    }
  },
  sendMobileRand: function () {
    var mobile = $_(jieqiVerify.mobileSet.iid);
    if(!(/^1\d{10}$/.test(mobile.getValue()))){
      alert('请先输入手机号码！');
      mobile.focus();
    } else {
      var job = arguments.length > 1 ? arguments[1] : 'register';
      var url = '/mobileverify.php?act=send&job=' + job + '&mobile=' + mobile.getValue();
      var checkcode = $_(jieqiVerify.mobileSet.cid);
      if(checkcode) url += '&checkcode=' + checkcode.value;
      Ajax.Request(url, {
        onLoading: jieqiVerify.sendMobileLoading,
        onComplete: jieqiVerify.sendMobileComplete
      });
    }
  },
  sendMobileLoading: function () {
    $_(jieqiVerify.mobileSet.tid).setValue('正在发送...');
  },
  sendMobileComplete: function () {
    if (this.response.indexOf('成功') != -1) {
      jieqiVerify.mobileSet.count = jieqiVerify.mobileSet.wait;
      $_(jieqiVerify.mobileSet.tid).setAttribute('disabled', true);
      setTimeout(jieqiVerify.sendMobileWait, 1000);
      var imgccode = $_(jieqiVerify.mobileSet.pid);
      if(imgccode) imgccode.src = '/checkcode.php?rand='+Math.random();
    } else {
      alert(this.response.replace(/<br[^<>]*>/g, '\n'));
      $_(jieqiVerify.mobileSet.tid).setValue('发送验证码');
    }
  },
  sendMobileWait: function () {
    var ele = $_(jieqiVerify.mobileSet.tid);
    if (jieqiVerify.mobileSet.count <= 0) {
      ele.removeAttribute("disabled");
      ele.setValue('发送验证码');
    } else {
      ele.setValue('重新发送(' + jieqiVerify.mobileSet.count + ')');
      jieqiVerify.mobileSet.count--;
      setTimeout(jieqiVerify.sendMobileWait, 1000);
    }
  }
}
