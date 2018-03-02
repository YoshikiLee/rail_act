$(function() {
  $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
  $(window).bind("load resize", function() {
    var topOffset = 50;
    var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
    if (width < 768) {
      $('div.navbar-collapse').addClass('collapse');
      topOffset = 100; // 2-row-menu
    } else {
      $('div.navbar-collapse').removeClass('collapse');
    }

    var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
    height = height - topOffset;
    if (height < 1) height = 1;
    if (height > topOffset) {
      $("#page-wrapper").css("min-height", (height) + "px");
    }
  });

  var url = window.location;
  // var element = $('ul.nav a').filter(function() {
  //     return this.href == url;
  // }).addClass('active').parent().parent().addClass('in').parent();
  var element = $('ul.nav a').filter(function() {
    return this.href == url;
  }).addClass('active').parent();

  while (true) {
    if (element.is('li')) {
      element = element.parent().addClass('in').parent();
    } else {
      break;
    }
  }
});

App={};
App.showPleaseWait=function () {
    pleaseWaitObj  = new BootstrapDialog({
        id:'myPleaseWait',
        type: BootstrapDialog.TYPE_DEFAULT,
        title: '<span class="glyphicon glyphicon-time"></span>',
        closable: true,
        closeByBackdrop: false,
        closeByKeyboard: false,
        message: $('<div class="progress"><div class="progress-bar progress-bar-striped active" style="width: 100%"></div></div>')
    });
    pleaseWaitObj.open();
};
App.hidePleaseWait=function (callback) {
    if(pleaseWaitObj){
        pleaseWaitObj.$modal.on('hidden.bs.modal', function (e) {
            if(callback){
                callback();
            }
        });
        pleaseWaitObj.close();
        pleaseWaitObj=null;
    }
};
App.ajax = function (options) {
    var pleaseWait = true;
    if(typeof options.pleaseWait != "undefined"){
        pleaseWait = options.pleaseWait;
    }
    var autoTrace = true;
    if(typeof options.autoTrace != "undefined"){
        autoTrace = options.autoTrace;
    }
    var successCallback = function(data, textStatus, jqXHR){
        if($.isFunction(options.app_success)){
            options.app_success(data, textStatus, jqXHR);
        }
    };
    var errorCallback = function(jqXHR, textStatus, errorThrown){
        if(!autoTrace) {
            return;
        }
        var json = null;
        if(jqXHR.status == 401 || jqXHR.status == 403){
            json = jqXHR.responseJSON;
            if(json === undefined){
                try{
                    json = JSON.parse(jqXHR.responseText);
                }catch(err){}
            }
            if(json && json.message){
                if(json.message == 'Unauthorized' && json.Location) {
                    location.href = json.Location;
                } else {
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_DANGER,
                        title: 'エラーです',
                        message: json.message,
                        buttons: [{
                            label: '閉じる',
                            cssClass: 'btn-default',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
                }
            }
        } else if(jqXHR.status == 500){
            json = jqXHR.responseJSON;
            if(json === undefined){
                try{
                    json = JSON.parse(jqXHR.responseText);
                }catch(err){}
            }
            if(json){
                if(json.status == 401){
                    var btnTitle = json.btnTitle;
                    if(json.btnKbn==2 || json.btnKbn==1){//CLOSE
                        btnTitle='閉じる';
                    }
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_DANGER,
                        title: 'エラーです',
                        message: json.message,
                        buttons: [{
                            label: btnTitle,
                            cssClass: 'btn-default',
                            action: function(dialogItself){
                                if(json.btnKbn==2 || json.btnKbn==1){//CLOSE
                                    dialogItself.close();
                                } else {
                                    location.reload();
                                }
                            }
                        }]
                    });
                } else if(json.status == 501){
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_DANGER,
                        title: 'エラーです',
                        message: json.message,
                        buttons: [{
                            label: '閉じる',
                            cssClass: 'btn-default',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
                }
            } else {
                var msg = null;
                if(errorThrown instanceof Object && errorThrown.hasOwnProperty('message')){
                    msg = errorThrown.message;
                } else {
                    msg = errorThrown.toString();
                }
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    title: 'エラーです',
                    message: msg
                });
            }
        } else if(jqXHR.status != 422){
            var msg = null;
            if(errorThrown instanceof Object && errorThrown.hasOwnProperty('message')){
                msg = errorThrown.message;
            } else {
                msg = errorThrown.toString();
            }
            BootstrapDialog.show({
                type: BootstrapDialog.TYPE_DANGER,
                title: 'エラーです',
                message: msg
            });
        }
        if($.isFunction(options.app_error)){
            options.app_error(jqXHR, textStatus, errorThrown);
        }
    };
    var defaults = {
        url: '',
        cache: false,
        timeout: 10000,
        type: "POST",
        data: null,
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            if(pleaseWait) {
                App.hidePleaseWait(function(){
                    successCallback(data, textStatus, jqXHR);
                });
            } else {
                successCallback(data, textStatus, jqXHR);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if(pleaseWait) {
                App.hidePleaseWait(function () {
                    errorCallback(jqXHR, textStatus, errorThrown);
                });
            } else {
                errorCallback(jqXHR, textStatus, errorThrown);
            }
        },
        complete: function (jqXHR, textStatus) {
            if(pleaseWait) {
                App.hidePleaseWait();
            }
        }
    };
    var settings = $.extend( {}, defaults, options );
    if(pleaseWait){
        App.showPleaseWait();
    }
    $.ajax(settings);
};
