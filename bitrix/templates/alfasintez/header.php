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
        <div class="row">
        <div class="container">
                <div class="top-items">
                    <a href="/" id="logo" class="logo-wrapper pull-left">
                        <img class="logo-img" src="<?php echo SITE_TEMPLATE_PATH ?>/images/main-elements/logo.png" alt="">
                    </a>

                    <div class="top-menu header-elements-wrapper pull-left">
                            <? // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top_elements",                  // [bottom_menu, catalog_native, top_menu, .default, blue_tabs, catalog_horizontal, catalog_vertical, grey_tabs, horizontal_multilevel, tree, vertical_multilevel]
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
                    <div class="phone-header pull-left">
                        <?
                        // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "include_area",
                            array(
                                // region Параметры компонента
                                "AREA_FILE_SHOW"    =>  "file",  // Показывать включаемую область : array ( 'page' => 'для страницы', 'sect' => 'для раздела', )
                                "AREA_FILE_PATH"  =>  "/include/phone.php",   // Суффикс имени файла включаемой области
                                "AREA_FILE_SUFFIX"  =>  "",   // Суффикс имени файла включаемой области
                                "EDIT_TEMPLATE"     =>  "standard.php",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
                                "PATH" => "/include/phone.php"
                                // endregion
                            )
                        );
                        ?>
                    </div>

                    <div class="cart header-elements-wrapper pull-right">
                        <?
                        // Ссылка на корзину
                        $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            ".default",               // [eshop_adapt, .default]
                            array(
                                //  region Основные параметры
                                "PATH_TO_BASKET"      =>  "={SITE_DIR.personal/cart/}",  // Страница корзины
                                "SHOW_NUM_PRODUCTS"   =>  "Y",                           // Показывать количество товаров
                                "SHOW_TOTAL_PRICE"    =>  "Y",                           // Показывать общую сумму по товарам
                                "SHOW_EMPTY_VALUES"   =>  "Y",                           // Выводить нулевые значения в пустой корзине
                                // endregion
                                // region Персональный раздел
                                "SHOW_PERSONAL_LINK"  =>  "Y",                           // Отображать персональный раздел
                                "PATH_TO_PERSONAL"    =>  "={SITE_DIR.personal/}",       // Страница персонального раздела
                                // endregion
                                // region Авторизация
                                "SHOW_AUTHOR"         =>  "N",                           // Добавить возможность авторизации
                                "PATH_TO_REGISTER"    =>  "={SITE_DIR.login/}",          // Страница регистрации
                                "PATH_TO_PROFILE"     =>  "={SITE_DIR.personal/}",       // Страница профиля
                                // endregion
                                // region Список товаров
                                "SHOW_PRODUCTS"       =>  "Y",                           // Показывать список товаров
                                // endregion
                                // region Внешний вид
                                "POSITION_FIXED"      =>  "N",                           // Отображать корзину поверх шаблона
                                // endregion
                            )
                        );
                        ?>

                        <?if ($APPLICATION->GetCurPage(true) == SITE_DIR."index.php"):?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "sect",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                                Array('HIDE_ICONS' => 'Y')
                            );?>
                        <?endif?>
                    </div>
                    <div class="search pull-right">
                        <?$APPLICATION->IncludeComponent("bitrix:search.title", "main-searching", array(
                            "NUM_CATEGORIES" => "1",
                            "TOP_COUNT" => "5",
                            "CHECK_DATES" => "N",
                            "SHOW_OTHERS" => "N",
                            "PAGE" => SITE_DIR."catalog/",
                            "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
                            "CATEGORY_0" => array(
                                0 => "iblock_catalog",
                            ),
                            "CATEGORY_0_iblock_catalog" => array(
                                0 => "all",
                            ),
                            "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                            "SHOW_INPUT" => "Y",
                            "INPUT_ID" => "title-search-input",
                            "CONTAINER_ID" => "search",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "SHOW_PREVIEW" => "Y",
                            "PREVIEW_WIDTH" => "75",
                            "PREVIEW_HEIGHT" => "75",
                            "CONVERT_CURRENCY" => "Y"
                        ),
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu-bg container-fluid clearfix">
        <div class="sep-bg row"></div>
        <div class="menu-bg row">
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
    </div>

<div id="content-wrapper" class="container-fluid">
    <div class="left-bg">
        <div class="right-bg">
    <div class="sep-bg"></div>
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