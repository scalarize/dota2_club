# [D.O.T.A.] WEB 接口

- basics
	- http JSON data as interface
	- php JSON out
	- html as view

- interfaces
	- all player list
		- url: [/player/all](/player/all)
		- format: array of `<player_object_full>`
		- content sample:
```
[{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL","steam_personaname":"\u51cc\u51b0","steam_lastlogoff":1460563523,"steam_avatar":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db.jpg","steam_avatarmedium":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db_medium.jpg","steam_avatarfull":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db_full.jpg"},{"id":"4","steam_id":"76561198151621880","name":"\u5468\u79c0\u743c","ext":"","dota_id":"19135615","rank_score":"2000","current_rank":2025,"s2_history":"WLW","steam_personaname":"\u5c0f\u94bb\u98ce","steam_lastlogoff":1460566693,"steam_avatar":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/36\/36d2f7704063db4cf0a6bdc81dc92c07099de478.jpg","steam_avatarmedium":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/36\/36d2f7704063db4cf0a6bdc81dc92c07099de478_medium.jpg","steam_avatarfull":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/36\/36d2f7704063db4cf0a6bdc81dc92c07099de478_full.jpg"}]
```
	- player basic info, 基本信息, 不会调用 steam API
		- url: [/player/basic/3](/player/basic/3), 其中 3 为 player_id
		- format: `<player_object>`
		- content sample:
```
{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL","steam_personaname":"\u51cc\u51b0","steam_lastlogoff":1460563523,"steam_avatar":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db.jpg","steam_avatarmedium":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db_medium.jpg","steam_avatarfull":"https:\/\/steamcdn-a.akamaihd.net\/steamcommunity\/public\/images\/avatars\/a7\/a7f495822737eceb212d28bedefc88e32878e6db_full.jpg"}
```

	- player full info, 完整信息, 包括 steam profile 信息, 会调用 steam API, 可能稍慢
		- url: [/player/full/3](/player/full/3), 其中 3 为 player_id
		- format: `<player_object_full>`
		- content sample:
```
{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"}
```


	- player match history, 我参与的比赛
		- url: [/player/history/3](/player/history/3), 其中 3 为 player_id
		- format: map of:
			- basic: `<player_object>`
			- history: map of match_id => `<match_object>`
		- content sample:
```
{"basic":{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"},"history":{"54":{"id":"531","player_id":"3","win":"1","match_id":"54","stats":"1","side":"0"},"55":{"id":"546","player_id":"3","win":"1","match_id":"55","stats":"1","side":"1"}}}
```
	- player teammates, 我的队友
		- url: [/player/teammates/3](/player/teammates/3), 其中 3 为 player_id
		- format: map of:
			- basic: `<player_object>`
			- teammates: map of player_id => teammate info extends `<player_object>`, extra attributes:
				- win: 带这个腿飞过几场
				- lose: 被这个猪坑过几场
		- content sample:
```
{"basic":{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"},"teammates":{"17":{"id":"17","steam_id":"76561198143939519","name":"\u9ad8\u6960","ext":"","dota_id":"183673791","rank_score":"1500","current_rank":1500,"s2_history":"WLLW","win":1,"lose":0},"13":{"id":"13","steam_id":"76561198109776748","name":"\u6c6a\u5dcd","ext":"","dota_id":"149511020","rank_score":"3450","current_rank":3475,"s2_history":"WWLLW","win":1,"lose":2}}}
```
	- player opponents, 我的对手
		- url: [/player/opponents/3](/player/opponents/3), 其中 3 为 player_id
		- format: map of:
			- basic: `<player_object>`
			- opponents: map of player_id => opponent info extends `<player_object>`, extra attributes:
				- win: TA赢过我几场
				- lose: TA输给我几场
		- content sample:
```
{"basic":{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"},"opponents":{"22":{"id":"22","steam_id":"76561198099811172","name":"\u5f20\u6210\u5fd7","ext":"","dota_id":"139545444","rank_score":"2600","current_rank":2625,"s2_history":"LWW","win":0,"lose":1},"16":{"id":"16","steam_id":"76561198142599051","name":"\u9648\u4f1f","ext":"","dota_id":"182333323","rank_score":"1700","current_rank":1725,"s2_history":"LWLWLWW","win":1,"lose":1},"9":{"id":"9","steam_id":"76561198096104178","name":"\u848b\u6d69","ext":"","dota_id":"135838450","rank_score":"1800","current_rank":1775,"s2_history":"LWWLLLWLW","win":2,"lose":1}}}
```
	- all match list: 全部比赛列表
		- url: [/match/all](/match/all)
		- format: array of `<match_object>`
		- content sample:
```
[{"id":"55","match_id":"2278785978","date":"2016-04-08 00:10:25","info":"init match, no result","season":"2016s2","winner":"dire","attendants":{"dire":[{"id":"22","steam_id":"76561198099811172","name":"\u5f20\u6210\u5fd7","ext":"","dota_id":"139545444","rank_score":"2600","current_rank":2625,"s2_history":"LWW"},{"id":"16","steam_id":"76561198142599051","name":"\u9648\u4f1f","ext":"","dota_id":"182333323","rank_score":"1700","current_rank":1725,"s2_history":"LWLWLWW"},{"id":"9","steam_id":"76561198096104178","name":"\u848b\u6d69","ext":"","dota_id":"135838450","rank_score":"1800","current_rank":1775,"s2_history":"LWWLLLWLW"},{"id":"5","steam_id":"76561198005147110","name":"\u738b\u4e7e","ext":"","dota_id":"44881382","rank_score":"3800","current_rank":3850,"s2_history":"WLWW"},{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"}],"radiant":[{"id":"21","steam_id":"76561198107692943","name":"\u80e1\u6d69\u7136","ext":"","dota_id":"147427215","rank_score":"2500","current_rank":2500,"s2_history":"LW"},{"id":"15","steam_id":"76561198022244143","name":"\u767d\u8fea","ext":"","dota_id":"61978415","rank_score":"2900","current_rank":2800,"s2_history":"LLWLLWLL"},{"id":"12","steam_id":"76561198074308023","name":"\u5f90\u529b","ext":"","dota_id":"114042295","rank_score":"2600","current_rank":2650,"s2_history":"LWLWWLWW"},{"id":"10","steam_id":"76561198137830655","name":"\u9093\u4f1f","ext":"","dota_id":"177564927","rank_score":"2200","current_rank":2275,"s2_history":"LWWWW"},{"id":"8","steam_id":"76561198212184577","name":"\u9ec4\u4e50\u4e50","ext":"","dota_id":"251918849","rank_score":"2200","current_rank":2300,"s2_history":"LLWWWWWW"}]}},{"id":"54","match_id":"2278636914","date":"2016-04-07 23:03:02","info":"init match, no result","season":"2016s2","winner":"radiant","attendants":{"dire":[{"id":"22","steam_id":"76561198099811172","name":"\u5f20\u6210\u5fd7","ext":"","dota_id":"139545444","rank_score":"2600","current_rank":2625,"s2_history":"LWW"},{"id":"16","steam_id":"76561198142599051","name":"\u9648\u4f1f","ext":"","dota_id":"182333323","rank_score":"1700","current_rank":1725,"s2_history":"LWLWLWW"},{"id":"9","steam_id":"76561198096104178","name":"\u848b\u6d69","ext":"","dota_id":"135838450","rank_score":"1800","current_rank":1775,"s2_history":"LWWLLLWLW"},{"id":"8","steam_id":"76561198212184577","name":"\u9ec4\u4e50\u4e50","ext":"","dota_id":"251918849","rank_score":"2200","current_rank":2300,"s2_history":"LLWWWWWW"},{"id":"6","steam_id":"76561198071272300","name":"\u5f20\u6500","ext":"","dota_id":"111006572","rank_score":"3500","current_rank":3475,"s2_history":"L"}],"radiant":[{"id":"17","steam_id":"76561198143939519","name":"\u9ad8\u6960","ext":"","dota_id":"183673791","rank_score":"1500","current_rank":1500,"s2_history":"WLLW"},{"id":"13","steam_id":"76561198109776748","name":"\u6c6a\u5dcd","ext":"","dota_id":"149511020","rank_score":"3450","current_rank":3475,"s2_history":"WWLLW"},{"id":"11","steam_id":"76561198132022784","name":"\u4e8e\u58eb\u5bb8","ext":"","dota_id":"171757056","rank_score":"1500","current_rank":1425,"s2_history":"WLLLL"},{"id":"7","steam_id":"76561198156965858","name":"\u8881\u535a\u6587","ext":"","dota_id":"196700130","rank_score":"3000","current_rank":2900,"s2_history":"WLLLLL"},{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"}]}}]
```

	- match detail: 比赛详情
		- url: [/match/detail/67](/match/detail/67), 其中 67 为 match_id
		- format: map of:
			- id: match_id, 如 `"67"`
			- match_id: steam 比赛 id, 如 `"2288393590"`
			- date: 比赛时间, 如 `"2016-04-12 00:16:39"`
			- info: 不知道
			- season: 赛事所属的赛季, 如 `"2016s2"`
			- winner: 获胜方, radiant 为天辉, dire 为夜魇
			- attendants: 参赛选手, map of side => array of `<player_object>`, side 的数据定义与 winner 相同
		- sample
```
{"id":"67","match_id":"2288393590","date":"2016-04-12 00:16:39","info":"init match, no result","season":"2016s2","winner":"dire","attendants":{"radiant":[{"id":"3","steam_id":"76561198092469655","name":"\u51cc\u51b0","ext":"","dota_id":"132203927","rank_score":"2500","current_rank":2475,"s2_history":"WWLLL"},{"id":"7","steam_id":"76561198156965858","name":"\u8881\u535a\u6587","ext":"","dota_id":"196700130","rank_score":"3000","current_rank":2900,"s2_history":"WLLLLL"},{"id":"11","steam_id":"76561198132022784","name":"\u4e8e\u58eb\u5bb8","ext":"","dota_id":"171757056","rank_score":"1500","current_rank":1425,"s2_history":"WLLLL"},{"id":"15","steam_id":"76561198022244143","name":"\u767d\u8fea","ext":"","dota_id":"61978415","rank_score":"2900","current_rank":2800,"s2_history":"LLWLLWLL"},{"id":"18","steam_id":"76561198099200589","name":"\u66f2\u9510","ext":"","dota_id":"138934861","rank_score":"2000","current_rank":1975,"s2_history":"WWLLL"}],"dire":[{"id":"8","steam_id":"76561198212184577","name":"\u9ec4\u4e50\u4e50","ext":"","dota_id":"251918849","rank_score":"2200","current_rank":2300,"s2_history":"LLWWWWWW"},{"id":"9","steam_id":"76561198096104178","name":"\u848b\u6d69","ext":"","dota_id":"135838450","rank_score":"1800","current_rank":1775,"s2_history":"LWWLLLWLW"},{"id":"12","steam_id":"76561198074308023","name":"\u5f90\u529b","ext":"","dota_id":"114042295","rank_score":"2600","current_rank":2650,"s2_history":"LWLWWLWW"},{"id":"13","steam_id":"76561198109776748","name":"\u6c6a\u5dcd","ext":"","dota_id":"149511020","rank_score":"3450","current_rank":3475,"s2_history":"WWLLW"},{"id":"16","steam_id":"76561198142599051","name":"\u9648\u4f1f","ext":"","dota_id":"182333323","rank_score":"1700","current_rank":1725,"s2_history":"LWLWLWW"}]}}
```

- data objects
	- player_object
		- attributes
			- id: 内部 id, 如 `"3"`
			- steam_id: steam 系统的 id, 可以用来取 steam profile, 如 `"76561198092469655"`
			- name: 实际姓名, 如 `"凌冰"`
			- dota_id: 游戏内 ID, 加好友用这个, 如 `"132203927"`
			- rank_score: 初始水平分, 如 `"2500"`
			- current_rank: 当前水平分, 如 `2475`
			- s1_history: 赛季一战绩, W为胜, L为负, 如 `"WWLLL"`
			- s2_history: 赛季二战绩, W为胜, L为负, 如 `"WWLLL"`
	- player_object_full
		- extends player_object with extended attributes:
			- steam_personaname, steam 昵称, 如 `"凌冰"`
			- steam_avatar: steam 头像(小), URL
			- steam_avatarmedium: steam 头像(中), URL
			- steam_avatarfull: steam 头像(原始), URL
	- match_object
		- 一个 match_object 表示一次参赛信息, 它同时与一场比赛和一个参赛选手关联
		- attributes
			- id: 内部 id, 如 `"531"`
			- player_id: 参数选手 id, 如 `"3"`
			- win: 是否获胜, 0 为负, 1 为胜
			- match_id: 唯一的比赛 id, 如 `"54"`
			- stats: 不知道
			- side: 参赛选手在哪一方, 0 为天辉, 1 为夜魇
 
