<?php
/*
 * @description:
 *      该配置文件专门用于mis后台rtb专用的params
 *      所有rtb专用的params需要的配置都放在这里
 */

return array(
	'MIN_DAILY_BUDGET_YUAN' => 50, // 单日预算最低允许50元
	'MAX_DAILY_BUDGET_YUAN' => 1000000, // 单日预算最多允许100万元
	'MAX_BLACK_WHITE_LIST' => 10, //最多允许设置10个(媒体组，设备组)黑/白名单
	'CREATIVE_DEFAULT_COM_NAME' => '多盟智胜网络技术有限公司', // 当adcrm_company_account 表中无数据时用此默认公司名
	'DEBUG' => true,
);
