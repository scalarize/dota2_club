/*
 * TreeSelect 树形选择控件
 * 基于 TreeView 和 PubSub实现
 *
 * 2013-02-25 liuwenbo@domob.cn
 * 2014-10-09 edit by zhouting@domob.cn
 * 201501013 modify by wangbaoguo@domob.cn:searchbox
 */

;(function($) {

	$.subscribe('click_jquery_treeselect_tree_select_all',function(target){
		$(target).closest('.jquery_treeselect_tree_wrapper').find('input[type="checkbox"]').attr('checked', 'checked');
		var tmpValue = [],
			tmpName = [];
		$(target).closest('.jquery_treeselect_tree_wrapper').find('.jquery_treeselect_tree').each(function(index, item){
			selectAll(item, tmpValue, tmpName);
		});
		$(target).closest('.jquery_treeselect').find('.searchbox_container input[type="checkbox"]').attr('checked','checked');

		$(target).closest('.jquery_treeselect').next().val(tmpValue.join(','));
		$(target).closest('.jquery_treeselect').find('.jquery_treeselect_selected').html(tmpName.join('<br/>'))
	}).subscribe('click_jquery_treeselect_tree_select_none', function(target){
		$(target).closest('.jquery_treeselect_tree_wrapper').find('input[type="checkbox"]').removeAttr('checked').prop("indeterminate", false);
		$(target).closest('.jquery_treeselect').find('.searchbox_container input[type="checkbox"]').removeAttr('checked');

		$(target).closest('.jquery_treeselect').next().val('');
		$(target).closest('.jquery_treeselect').find('.jquery_treeselect_selected').empty();
	}).subscribe('jquery_treeselect_searchvalue_changed',function (target) {
		var reg = new RegExp($(target).data('treeselect_search_preval'),'g');
		$(target).siblings('.searchselect').find('ul li').each(function () {
			if(reg.test($(this).data('pinyin'))||
				reg.test($(this).data('src'))){
				$(this).removeClass('hidden');
			}else{
				$(this).addClass('hidden');
			}
		});
	}).subscribe('treeselect_loading',function () {
		var $loading = $('<div class="loading_full"><i class="icon_loading"> <em class="rect1"></em> <em class="rect2"></em> <em class="rect3"></em> <em class="rect4"></em> <em class="rect5"></em> </i></div>');
		$(document.body).append($loading);
		$loading.fadeIn('150');
	}).subscribe('complete_treeselect_load',function () {
		$('.loading_full').fadeOut('150', function(){
			$(this).remove();
		});
	});

	var selectAll = function(treeContainer, tmpValue, tmpName) {
		if ($(treeContainer) == null) {
			return;
		}
		$(treeContainer).children('li').each(function(index, item) {
			if ($(item).children('label').find('input[type="checkbox"]').length > 0) {
				tmpValue.push($(item).children('label').find('input[type="checkbox"]').val());
				tmpName.push($(item).children('label').text());
			} else {
				selectAll($(item).children('ul'), tmpValue, tmpName);
			}
		});
	}	

	var __box = function(data, setting, guid){
		var $box = $('<div class="jquery_treeselect">'
						+'<div class="jquery_treeselect_tree_wrapper col">'
							+'<p class="jquery_treeselect_tree_actions">'
								+'<a href="javascript:void(0)" class="weak ac ac_jquery_treeselect_tree_select_all">全选</a>'
								+'<a href="javascript:void(0)" class="weak ac ac_jquery_treeselect_tree_select_none">全不选</a>'
							+'</p>'
						+'</div>'
						+'<div class="jquery_treeselect_selected_wrapper col">'
							+'<h3>'+ setting.selectedText +'</h3>'
							+'<div class="jquery_treeselect_selected">'
							+'</div>'
						+'</div>'
					+'</div>'
				);
		$box.find('.jquery_treeselect_tree_wrapper').append(__buildTree(data, guid).addClass('jquery_treeselect_tree'));
		return $box;
	}

	var da = [
				{
					"property": {
						"name": "iOS",
						"value": 30000,
						"id": 30000
					},
					"children": [
						{
							"property": {
								"name": "iPhone 系列",
								"value": "30000!81000000",
								"id": 81000000
							},
					    	"children": [
						        {
						          "property": {
						            "name": "iPhone 3G",
						            "value": "30000!81000000!81000001",
						            "id": "81000001"
						          }
						        }
						    ]
					    }
					]
				},
				{
					"property": {
						"name": "Aos",
						"value": 40000,
						"id": 40000
					}
				}
			];
	function __buildTree(data, guid, parentText){
		var $ul=$('<ul></ul>'),
			item,
			i=0;

		for(; i< data.length; i++){
			item = data[i].property;
			item.id = item.id || (item.value && (item.value+'').match(/[^!]+/g).pop()) || $.guid++;
			var type = item.hidden ? 'hidden' : 'checkbox';
			var value = item.hidden ? '' : (item.value||'');
			var showText = (parentText ? parentText + '-' : '') + item['name'];
			$ul.append('<li><label><input'+(item.id?' id="jquery_treeselect_'+guid+'_'+item.id+'"':'') +' type="'+type+'" value="'+value+'" data-showText="' + showText + '" /> '+item.name+'</label></li>');
			if(data[i].children && data[i].children.length){
				$ul.find('li:last').append(__buildTree(data[i].children, guid,showText));
			}
		}
		return $ul;
	}

	

	$.fn.extend({
		treeSelect: function(data, setting){
			setting = $.extend({
				__dataSource: 'json',
				selectedText: '已选择'
			}, setting);
			if(typeof data == "string"){
				setting.__dataSource = 'url';
			}
			function __initBox(data, $input){
				var guid = ++$.guid;
				$input.before(__box(data, setting, guid));
				$input.prev().find('.jquery_treeselect_tree').treeview({ //1.1s
					persist: "location",
					collapsed: true,
					unique: true
				});

				// TODO: customCheckbox 和 全选功能 不兼容
				// if($.fn.customCheckbox){
				// 	// $input.prev().find(':checkbox').change(__inputChange).customCheckbox();
				// } 50ms
				$input.prev().find('input[type="checkbox"]').change(function(e) {
				      var $t = $(this),
				      	  checked = $t.prop("checked"),
				          container = $t.closest('li'),
				          value = $t.val();

				      container.find('input').prop({
				          indeterminate: false,
				          checked: checked
				      });

				  		var tmpValue = $input.val();
				      function checkSiblings(el) {
				          var parent = el.parent().parent(),
				              all = true;
				  			
				          el.siblings().each(function() {
				              return all = ($t.children('label').find('input[type="checkbox"]').prop("checked") === checked);
				          });

				          if (all && checked) {
				              parent.children('label').find('input').prop({
				                  indeterminate: false,
				                  checked: checked
				              });
				              checkSiblings(parent);
				          } else if (all && !checked) {
				              parent.children('label').find('input').prop("checked", checked);
				              parent.children('label').find('input').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
				              checkSiblings(parent);
				          } else {
				          	var $pli = el.parents("li").children('label').find('input');
				              $pli.prop({
				                  indeterminate: true,
				                  checked: false
				              });
				          }
				        }
				        checkSiblings(container);
				        __showResult($t.closest('.jquery_treeselect'));
				        setTimeout(function () {
					        __updateSearchSelect($t.closest('.jquery_treeselect'));
				        },20);
				    });
				
				//6s
				if($input.val() != ""){
					var originData = $input.val().split(','),$input;
					for (var i = 0; i < originData.length; i++) {
						$input = $('#jquery_treeselect_'+guid+'_'+originData[i].match(/[^!]+/g).pop());
						$input.prop({'checked':!$input.prop('checked')}).change();
						// .parents('.jquery_treeselect_tree ul').show();
						$input.parents('.jquery_treeselect_tree ul').each(function () {
							$(this).show();
							$(this).siblings('.hitarea').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
							$(this).closest('li').removeClass('expandable').addClass('collapsable');
						});
					};
				}
			}

			function __addValue(txt, $input){
				var tmpValue = $input.val().split(',');
				tmpValue.push(txt);
				$input.val(tmpValue.join(','));
			}
			function __removeValue(txt, $input){
				var tmpValue = $input.val().split(','), 
					i=0;
				for(;i<tmpValue.length;i++){
					if(tmpValue[i] == txt)
					break;
				}
				tmpValue = tmpValue.slice(0,i).concat(tmpValue.slice(i+1));
				$input.val(tmpValue.join(','));
			}

			function __showResult($selector){
				var result = __getResult($selector.find('.jquery_treeselect_tree'));
				$selector.next().val(result.values.join(','));
				$selector.find('.jquery_treeselect_selected').html(result.names.join('<br />'));
			}

			function __getResult($tree){
				var tmpValue =[],
					tmpName =[];
				$tree.children('li').each(function(){
					var $input = $(this).children('label').find('input');
					if($input.is(':checked') && $input.val() != ""){
						tmpValue.push($input.val());
						// tmpName.push($input.parent().text());
						tmpName.push($input.attr('data-showText'));
					}else if($input.prop('indeterminate') || $input.val() == ""){
						var tmpResult = __getResult($(this).children('ul'));
						tmpValue = tmpValue.concat(tmpResult.values);
						tmpName = tmpName.concat(tmpResult.names);
					}
				});
				return {
						'values': tmpValue,
						'names': tmpName
					};
			}

			function __buildSearchBox (data,$input) {
				var container = '',
					content = '',
					lis = [],
					hasChildren = [],
					searechbox;
				//get list
				function __buildList (children) {
					hasChildren = [];
					for (var i = 0; i < children.length; i++) {
						children[i]['parentsName'] = children[i]['parentsName'] ? children[i]['parentsName'] + '-' + children[i]['property']['name']: children[i]['property']['name'];
						lis.push({
							'id':children[i]['property']['id'],
							'showName':children[i]['parentsName'],
							'name':children[i]['property']['name']});

						if(children[i].children){
							for (var j = 0; j < children[i]['children'].length; j++) {
								children[i]['children'][j]['parentsName'] = children[i]['parentsName'];
								hasChildren.push(children[i]['children'][j]);
							}
						}
					}
					if(!!hasChildren.length){
						__buildList(hasChildren);
					}
				}
				__buildList(data);

				for (var i = 0; i < lis.length; i++) {
					content += '<li data-pinyin="' + $.parsePinyin(lis[i]['name']) + '" data-src="' + lis[i]['name'] + '">' + lis[i]['showName'] + '<input type="checkbox" data-tagid="' + lis[i]['id'] + '" class="right"/></li>';
				}
				container = '<div class="searchbox_container"><input class="searchinput" placeholder="搜索" /><div class="searchselect hidden"><ul>' + content + '</ul></div></div>';

				$input.prev().find('.searchbox_container').remove();
				searechbox = $input.prev().prepend(container);

				searechbox.find('.searchinput').on('keyup',function () {
					var curval = $(this).val(),
						preval = $(this).data('treeselect_search_preval');
					if(curval !== preval){
						$(this).data('treeselect_search_preval',curval);
						$.publish('jquery_treeselect_searchvalue_changed',$(this));
					}
				}).on('click',function (e) {
					$(this).siblings('.searchselect').toggleClass('hidden');
					e.stopPropagation();
				});
				// 这种事件注册方式超慢，so用下面的代理方式
				// searechbox.find('.searchselect :checkbox').on('change',function () {
				// 	$(this).closest('.jquery_treeselect').find('.jquery_treeselect_tree.treeview input[value="' + $(this).data('tagid') + '"]').click();
				// });
				$(document.body).on('click','.searchselect :checkbox',function (e) {
					$(this).closest('.jquery_treeselect').find('.jquery_treeselect_tree.treeview input[value="' + $(this).data('tagid') + '"]').prop('checked',$(this).prop('checked')).change();
					e.stopImmediatePropagation();
				}).on('click',function () {
					$('.searchselect').addClass('hidden');
				});
			}

			function __updateSearchSelect ($tree) {
				var tmpValue,$t,$searchselect = $tree.find('.searchselect');
				if($searchselect.length > 0){
					$tree.find('.jquery_treeselect_tree_wrapper input[type="checkbox"]').each(function () {
						$t = $(this), tmpValue = $t.val();
						$searchselect.find('input[data-tagid="' + tmpValue + '"]').prop('checked',$t.is(':checked'));
					});
				}
			}

			return this.filter('input').each(function(){
				var $this= $(this);
				if($this.prev().is('.jquery_treeselect')){
					return;
				}
				if(setting.__dataSource == "url"){
					if(data){
						$.get(data, function(r){
							__initBox(r && r.data ? r.data : r, $this);
						}, 'json');
					}
				}else{
					__initBox(data, $this)
				}
				$this.on('setData', function(e, data){
					if(data.list)data=data.list;
					if($(this).prev().is('.jquery_treeselect')){
						$(this).val("").prev().remove();
					}
					__initBox(data, $(this));
				});
				$this.on('setSearchBox',function (e,data) {
					if(data.list)data=data.list;
					var $t = $(this);
					__buildSearchBox(data,$t);
				});
			});
		}
	});
	
})(jQuery);
