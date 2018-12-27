/**公共函数**/
$.extend({

    /**
    *延迟2秒执行
    如：$.jump2("www.baidu.com")
    */
    jump2: function (url, isparent) {
        setTimeout(function () {
            if (isparent) {
                window.parent.location.href = url;
            } else {
                window.location.href = url;
            }
        }, 2000);
    },

    /**
     * 倒计时
     */
    isDownTime : 1,
    downTime: function (num,backFunc) {
        var count = function () {
            setTimeout(function () {
                num--;
                if(num<=0)$.isDownTime = 1;
                if(typeof(backFunc)=="function")backFunc(num);
                if(num>0){
                    count();
                }
            }, 1000);
        }
        if($.isDownTime==1){
            $.isDownTime = 2;
            count();
        }
    },

    /**
    *读取时间
    如：$.date("yyyy年mm月dd日 HH:ii:ss",'1519806485')
    */
    date: function (fmt, unixTime, timeZone) {
        if (typeof (timeZone) == 'number') {
            unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
        }
        var time = new Date(unixTime * 1000);
        var o = {
            "m+": time.getMonth() + 1, //月份
            "d+": time.getDate(), //日
            "h+": time.getHours() % 12 == 0 ? 12 : time.getHours() % 12, //小时
            "H+": time.getHours(), //小时
            "i+": time.getMinutes(), //分
            "s+": time.getSeconds(), //秒
            "q+": Math.floor((time.getMonth() + 3) / 3), //季度
            "S": time.getMilliseconds() //毫秒
        };
        var week = {
            "0": "/u65e5",
            "1": "/u4e00",
            "2": "/u4e8c",
            "3": "/u4e09",
            "4": "/u56db",
            "5": "/u4e94",
            "6": "/u516d"
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (time.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        if (/(E+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "/u661f/u671f" : "/u5468") : "") + week[time.getDay() + ""]);
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    },
    img: function (imgPath, type) {
        if (typeof imgPath == 'undefined') { return '/public/static/images/admin/nopic.gif' }
        if (imgPath == null) { return '/public/static/images/admin/nopic.gif' }
        type = typeof type == 'undefined' ? 'thumbnail' : type;
        imgPath.replace('\\', '');
        var rgExp = /^http:\/\/.*?\/.*?((jpg)|(png)|(gif)|(jpeg)|(bmp))$/i;
        var matches = imgPath.match(rgExp, 'i');
        if (imgPath.match(rgExp, 'i') != null) {
            return imgPath + '.' + type + '.' + matches[1];
        }
        return '/public/static/images/admin/nopic.gif';
    },
})
