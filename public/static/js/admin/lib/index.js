// 这个是layui 加载脚本的入口文件
layui.config({
	base : "/static/js/shop/lib/",
    debug:true,
    version : new Date().getTime() // 正式上线后去掉该参数
}).extend({
    newsAdd: '/new/newsAdd',
    linkSelect:'linkSelect',
    kind: 'kind',       //二次封装富文本编辑器，调用kind.init(obj); obj文本域对象
    kindEditor:'/editor/kindeditor',
});
window.onload = function(){
    
    // 如果页面添加了导航 则去掉 内边距
    if( $('#Js_title_navigation').length > 0 ){
        $(".childrenBody").css('padding-top','0px');
    }
    
} ;
