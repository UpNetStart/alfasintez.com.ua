<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");

CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>/favicon.ico" />
    <?//$APPLICATION->ShowHead();
    echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
    $APPLICATION->ShowMeta("robots", false, true);
    $APPLICATION->ShowMeta("keywords", false, true);
    $APPLICATION->ShowMeta("description", false, true);
    $APPLICATION->ShowCSS(true, true);
    ?>
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/normalize.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/bootstrap.css")?>" />


    <?
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
</head>

<body>
<div id="panel clearfix"><?$APPLICATION->ShowPanel();?></div>


<div class="wrapper clearfix">

    <div id="header-wrapper" class="container-fluid clearfix">
        <div class="container">
            <div class="row top-items">
                    <div id="top-menu" class="container">
                        <? // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                        $APPLICATION->IncludeComponent(
                        	"bitrix:menu",
                        	"top_menu",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
                        	array(        
                        		// region Основные параметры         
                        		"ROOT_MENU_TYPE"         =>  "elements",  // Тип меню для первого уровня : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                        		// endregion         
                        		// region Настройки кеширования         
                        		"MENU_CACHE_TYPE"        =>  "N",     // Тип кеширования : array ( 'A' => 'Авто', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )         
                        		"MENU_CACHE_TIME"        =>  "3600",  // Время кеширования (сек.)          
                        		"MENU_CACHE_USE_GROUPS"  =>  "Y",     // Учитывать права доступа          
                        		"MENU_CACHE_GET_VARS"    =>  "",      // Значимые переменные запроса          
                        		// endregion         
                        		// region Дополнительные настройки         
                        		"MAX_LEVEL"              =>  "1",     // Уровень вложенности меню : array ( 1 => '1', 2 => '2', 3 => '3', 4 => '4', )         
                        		"CHILD_MENU_TYPE"        =>  "elements",  // Тип меню для остальных уровней : array ( 'left' => 'Левое меню', 'top' => 'Верхнее меню', 'bottom' => 'Нижнее меню', )
                        		"USE_EXT"                =>  "N",     // Подключать файлы с именами вида .тип_меню.menu_ext.php          
                        		"DELAY"                  =>  "N",     // Откладывать выполнение шаблона меню          
                        		"ALLOW_MULTI_SELECT"     =>  "N",     // Разрешить несколько активных пунктов одновременно          
                        		// endregion 
                        	)
                        ); ?>
                    </div>
            </div>

            <div class="header-contents">
                <div class="row">
                <a href="/" id="logo" class="logo-wrapper col-sm-3 col-md-3 col-lg-3 col-xs-3">
                        <img class="logo-img" src="<?php echo SITE_TEMPLATE_PATH ?>/images/main-elements/logo.png" alt=""> </a>


                <div class="phone col-sm-3 col-md-3 col-lg-3 col-xs-3">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "standard.php",
                            "PATH" => "/include/telephone.php"
                        )
                    );?>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div id="main-menu" class="container">
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    </div>


    <div id="navigation" class="container">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "-"
        ),
            false,
            Array('HIDE_ICONS' => 'Y')
        );?>
    </div>

    <div id="content" class="container">

