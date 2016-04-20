(function($) {
$(document).ready(function() {
	// 为表格添加对齐效果(用css太麻烦)
	$('form tr').find('td:eq(0)').addClass('table-left-header');
	$('form tr').find('td:eq(1)').addClass('table-right-content');

	var cancelSubmit = false;
	$('form.safe').submit(function(e){
		if (cancelSubmit) return false;
		$('#submitRow input:submit').attr('disabled', true);
	});

	$('form.safe').keydown(function(e){
		if (e.keyCode == 13 && e.target.type == 'text') {
			cancelSubmit = true;
			return;
		} 
		
		if (e.keyCode == 32) {
			if (e.target.type != 'text' && e.target.type != 'textarea'){
				cancelSubmit = true;
			}
		}
	});
	$('#submitRow input:submit').mousedown(function(){
		cancelSubmit = false;
	});
	// 为一些重要的表单添加提交确认
	$('form.important').submit(function() {
		return confirm('确定提交？');
	});

	$('a.requireConfirm').click(function(e){
		try {
			if (window && window.confirm) {
				return confirm('确定执行' + $(this).text() + ': ' + $(this).attr('rel') + ' ?');
			}
			return true;
		} catch(E) {
			console && console.log(E);
		}
	});

	var __navTimeout;
	// navbar 悬停展开
	
	$(document).on({
		mouseenter: function () {
			if (__navTimeout) clearTimeout(__navTimeout);
				var _obj = $(this);
				if (!_obj.hasClass('open')) {
				$(this).find('a.dropdown-toggle').click().blur();
			}
		},
		mouseleave: function () {
			if(__navTimeout)clearTimeout(__navTimeout);
				__navTimeout = setTimeout((function(){
				var li=$('div.nav-collapse li.open');
				if (li) {
					li.children('a.dropdown-toggle').click().blur();
				}
			}),300);
		}
	}, "div.nav-collapse li.dropdown");

	// select2
	$('select.select2').each(function(e){
		if ($(this).select2) {
			var data_ref = $(this).attr('data-ref');
			if (data_ref) {
				eval('var data=' + data_ref);
				$(this).select2({"data": data});
			} else {
				$(this).select2();
			}
		}
	});

	// bootstrap file input
	$('input[type=file]').each(function(e){
		if ($(this).bootstrapFileInput) {
			$(this).bootstrapFileInput();
		}
	});

	//收起展开 detail_group 结构
	$.subscribe('click_detail_group_toggle', __toggleDetailGroup);
	function __toggleDetailGroup(target){
		var $detail_group = $(target).closest('.detail_group');
		var shouldExpand = $(target).hasClass('detail_expand');
		var _id = $detail_group.attr('id');
		if (shouldExpand) {
			$detail_group.addClass('detail_group_expanded');
			if (_id) $.cookie('DSP.DG.' + _id, '1');
		}else{
			$detail_group.removeClass('detail_group_expanded')
			if (_id) $.cookie('DSP.DG.' + _id, '0');
		}
	}

	// 检查状态
	$('dl.detail_group').each(function(i){
		var remembered = $.cookie('DSP.DG.' + this.id);
		if (remembered == '1') {
			$.publish('click_detail_group_toggle', $(this).find('a.detail_expand')[0]);
		} else if (remembered == '0') {
			$.publish('click_detail_group_toggle', $(this).find('a.detail_close')[0]);
		}
	});
	$('td a[rel=tooltip]').each(function(){
		if($(this).children('i').length == 0) {
			if(!$(this).hasClass('disable_button')) {
				$(this).addClass('list_button');
				$('.list_hidden_button').hide();
			}
		}
	})
});
})(jQuery);

//设置cookie
function set_cookie(name,value){
	var days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + days*24*3600*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString() + ";path=/rtb/";
}
//获取cookie
function get_cookie(name){
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
		return unescape(arr[2]);
	else
		return '';
}

//查询消息
function query_message(){
	$.ajax({
		type: "GET",
		url: "/rtb/misc/querymessage",
		dataType: "json",
		success: function(res) {
			if(res != ''){
				set_message(res);
			}
		},
		error:function(e){
			if(e.status == 403){
				location.reload(true);
			}
		}
	});
};

//关闭悬浮框
function remove_open(){
	$(".dropdown").removeClass("open");
}
//数组排序
function sort_arr(m,n){
	return m>n?1:(m<n?-1:0);
}

function set_message(res){
	cookie_message_ids = get_cookie('message_ids');
	var li = '';
	var i = 0;
	var message_ids = 0;
	for(var i in res){
		li = li + '<li style="white-space:nowrap;"><a style="padding:3px 20px 3px 15px;max-width:330px;overflow:hidden;text-overflow:ellipsis;" href="/rtb/misc/inbox/'+res[i].id+'"><div style="width: 8px;height: 8px;background: red;display: inline-block;border-radius: 8px;margin-right:4px"></div>'+res[i].title+'</a></li>';
		message_ids = res[i].id + ',' + message_ids;
		if(i++ ==2){
			break;
		}
	}
	//插入到cookie
	if(message_ids != cookie_message_ids){
		if(cookie_message_ids.indexOf(",")<0){
			$(".inbox").addClass("open");
			set_cookie('message_ids',message_ids);
			setTimeout('remove_open()',10000);
		}else{
			c = cookie_message_ids.split(",");
			m = message_ids.split(",");
			if(c.sort(sort_arr).reverse()[0]<m.sort(sort_arr).reverse()[0]){
				$(".inbox").addClass("open");
				set_cookie('message_ids',message_ids);
				setTimeout('remove_open()',10000);
			}
		}
	}
	
	li = li + '<a href="/rtb/misc/inbox" style="float:right;font-size:11px;text-decoration:none;margin:10px 10px auto auto;">进入收件箱</a>';
	if(!($.isEmptyObject(res))){
		//加入下拉
		$(".inbox").addClass("dropdown");
		$(".inbox").html('<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class=" icon-bell"></i></a><ul id="" class="dropdown-menu"></ul>');
		//加入红色新消息气泡
		$(".inbox .dropdown-toggle").append('<div class="bubble">'+res.length+'</div>');
	}else{
		$(".inbox").removeClass("dropdown");
		$(".inbox").html('<a href="/rtb/misc/inbox"><i class=" icon-bell"></i> </a>');
	}

	$('.inbox ul').html(li);
}
$(document).ready(function(){
});

/* vim: set noexpandtab ts=4 sts=4 sw=4 : */
