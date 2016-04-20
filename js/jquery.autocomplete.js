/*
	Yige AutoComplete, tuotai yu minecomplete, bi jquery-ui de haoduole.
	author:	liuwenbo@domob.cn
*/

$.fn.extend({
	autoComplete:function(setting){
		setting=$.extend({
			keyRegx:/^[a-zA-Z0-9\u4e00-\u9fa5_]+$/,		//关键字的强验证正则
			srvName:'default_srvname_'+($.guid++),		//服务名称
			srv:'/rtb/template/autoTemplate',			//服务地址
			delay:200,									//按键后到搜索的延时
			onSelect:undefined							//选择后回调
		},setting);

		/*
		[
			{
				id: 111,
				label: '178 - 冰天雪地 - cairot',
				value: '178 - 冰天雪地 - cairot'
			}
		]
		*/

		var KEY = {
			UP: 38,
			DOWN: 40,
			DEL: 46,
			TAB: 9,
			RETURN: 13,
			ESC: 27,
			COMMA: 188,
			PAGEUP: 33,
			PAGEDOWN: 34,
			BACKSPACE: 8
		};
		
		if(!(autoComplete=$.event['_autoCompleteCache'+setting.srvName])){			//autoComplete主程序,试图在服务名称相同时不再次实例化
			$.event['_autoCompleteCache'+setting.srvName]=autoComplete=(function(){			//保存到全局缓存
				var autoComplete={
					handler:function(e){
						if(e.keyCode==KEY.RETURN){
							if(autoComplete.resultPanel.isHidden){
								return true;
							}else{
								e.preventDefault();
								autoComplete.resultPanel.select();
								return false;
							}
						}
						if(e.keyCode==KEY.ESC)return;
						clearTimeout(this._checkTimeout);
						autoComplete.target=this;
						this._checkTimeout=setTimeout((function(){autoComplete.check()}), setting.delay);
					},
					keydown:function(e){
						if(autoComplete.resultPanel.isHidden)return;
						switch(e.keyCode) {
							case KEY.ESC:
								e.preventDefault();
								autoComplete.resultPanel.hide();
								return false;
							case KEY.UP:
								e.preventDefault();
								autoComplete.resultPanel.goPrev();
								return false;
							case KEY.DOWN:
								e.preventDefault();
								autoComplete.resultPanel.goNext();
								return false;
							case KEY.RETURN:
								e.preventDefault();
								autoComplete.resultPanel.select();
								return false;
						}
					},
					focus_handler:function(e){
						clearTimeout(this._checkTimeout);
						autoComplete.target=this;
						this._checkTimeout=setInterval((function(){autoComplete.check()}), setting.delay);
					},
					blur_handler:function(e){
						clearTimeout(this._checkTimeout);
					},
					keyword:'',
					check:function(){
						var key=$(this.target).val();
						if(this.keyword==key)return;
						this.keyword=key;
						if(this.request){this.request.abort();this.request=null}			//如果有尚未完成的请求,偷悄悄的干掉他.
						if(key){
							// if(!this.resultPanel.isHidden)return;
							// this.content=$.textbox.selectionBefore(this.target);
							this.initList();
						}else{
							this.resultPanel.hide();
						}
					},
					cache:{},
					initList:function(){
						var tmp;

						if(tmp=this.cache[this.keyword]){
							if(tmp.total){
								this.resultPanel.update(this.target,this.cache[this.keyword].list);
							}else{
								this.resultPanel.hide();
							}
						}else{
							if(this.keyword.length>1&&(tmp=this.cache[this.keyword.substr(0,this.keyword.length-1)])&&!tmp.total){
								this.cache[this.keyword]={
										list:[],
										total:0
									};
								this.initList();
							}else{

								var that=this;
								this.request=$.getJSON(setting.srv,
									{term:this.keyword},
									function(r){
										if(r.code){
											$.log(r);//log error
											if(r.code==2){
												$.error(r); //throw out die error.
											}
											return;
										}
										/*data:{
											list:[]
											total:3
										}*/
										that.cache[that.keyword]={
											list: r,
											total: r.length
										};
										that.initList();
									});
							}
						}
					},
					select:function(resultIndex){
						$(this.target).val(this.cache[this.keyword].list[resultIndex].label);
						if(setting.onSelect)setting.onSelect.call(this.target,this.cache[this.keyword].list[resultIndex]);
						this.resultPanel.hide();
						this.keyword=$(this.target).val();
					}
				};
				autoComplete.resultPanel={
					isHidden:true,
					$panel:$('<ul id="autoComplete_resultPanel" class="dropdown-menu"></ul>').hide().appendTo($('body').click(function(){
						autoComplete.resultPanel.hide();
					})).click(function(e){
						autoComplete.resultPanel.select(e);
					}),
					update:function(target,results){
						if(!results.length)this.hide();
						this.$panel.empty();
						if(setting.resultTop)this.$panel.append(setting.resultTop);
						this.$panel.append(this._buildList(results));
						this.$panel.find('li:first').addClass('selected');
						if(setting.followMine){
							autoComplete.panel.update(target);
							this.show(autoComplete.panel.$mine);
						}else{
							this.show(target);
						}
						return this;
					},
					_buildList:function(results){
						var tmp=[];
						for (var index = 0; index < results.length; index++) {
							tmp.push('<li resultIndex="'+index+'"><a href="javascript:void(0)" title="'+results[index].label+'">'+results[index].label+'</a></li>');
						};
						return tmp.join('');
					},
					show:function(target){
						if(target){
							var $target=$(target)
							this.$panel.css({
								top:$target.offset().top+$target.outerHeight(),
								left:$target.offset().left,
								width:(setting.followMine?240:$target.outerWidth())
							});
						}
						this.$panel.show();
						this.isHidden=false;
						return this;
					},
					hide:function(){
						this.$panel.hide();
						this.isHidden=true;
						//autoComplete.keyword='';
						return this;
					},
					select:function(e){

						var $tmp;
						if(e&&e.target&&($tmp=$(e.target).parent())&&$tmp.is('li')){
							this.$panel.children('.selected').removeClass('selected');
							$tmp.addClass('selected');
						}
						if(this.$panel.children('.selected').length)
							autoComplete.select(this.$panel.children('.selected').attr('resultIndex'));
						this.hide();
					},
					goPrev:function(){
						if(this.$panel.children('.selected').prev().length)
							this.$panel.children('.selected').removeClass('selected').prev().addClass('selected');
					},
					goNext:function(){
						if(this.$panel.children('.selected').next().length)
						this.$panel.children('.selected').removeClass('selected').next().addClass('selected');
					}
				}
				return autoComplete;
			})();
		}
		
		return this.filter("input").each(function(){
			$(this).keyup(autoComplete.handler).mouseup(autoComplete.handler).keydown(autoComplete.keydown)
				.focus(autoComplete.focus_handler)
				.blur(autoComplete.blur_handler)
			;
		});
	}
});

