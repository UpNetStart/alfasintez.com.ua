<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ООО Альфа Синтез");
?>

<div id="main-slider">
	<?// Top элементов каталога
	$APPLICATION->IncludeComponent(
			"bitrix:catalog.top",
			"main_slider",
			array(
					"IBLOCK_TYPE" => "references",
					"IBLOCK_ID" => "8",
					"ELEMENT_SORT_FIELD" => "sort",
					"ELEMENT_SORT_ORDER" => "asc",
					"ELEMENT_SORT_FIELD2" => "id",
					"ELEMENT_SORT_ORDER2" => "desc",
					"FILTER_NAME" => "",
					"HIDE_NOT_AVAILABLE" => "N",
					"ELEMENT_COUNT" => "9",
					"LINE_ELEMENT_COUNT" => "3",
					"PROPERTY_CODE" => array(
							0 => "SL_TARGET_URL",
							1 => "",
					),
					"OFFERS_LIMIT" => "5",
					"SECTION_URL" => "",
					"DETAIL_URL" => "",
					"SECTION_ID_VARIABLE" => "SECTION_ID",
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"CACHE_TYPE" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_NOTES" => "",
					"CACHE_GROUPS" => "N",
					"CACHE_FILTER" => "N",
					"ACTION_VARIABLE" => "action",
					"PRODUCT_ID_VARIABLE" => "id",
					"PRICE_CODE" => array(
							0 => "BASE",
					),
					"USE_PRICE_COUNT" => "N",
					"SHOW_PRICE_COUNT" => "1",
					"PRICE_VAT_INCLUDE" => "N",
					"CONVERT_CURRENCY" => "Y",
					"BASKET_URL" => "/personal/basket.php",
					"USE_PRODUCT_QUANTITY" => "N",
					"ADD_PROPERTIES_TO_BASKET" => "N",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"PARTIAL_PRODUCT_PROPERTIES" => "Y",
					"PRODUCT_PROPERTIES" => array(
					),
					"DISPLAY_COMPARE" => "N",
					"ROTATE_TIMER" => "30",
					"CURRENCY_ID" => "UAH"
			),
			false
	);?>
</div>

<div class="row">
	<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"tree",
			array(
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "2",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"COUNT_ELEMENTS" => "N",
					"TOP_DEPTH" => "2",
					"SECTION_FIELDS" => array(
							0 => "",
							1 => "",
					),
					"SECTION_USER_FIELDS" => array(
							0 => "",
							1 => "",
					),
					"SECTION_URL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_NOTES" => "",
					"CACHE_GROUPS" => "Y",
					"ADD_SECTIONS_CHAIN" => "Y"
			),
			false
	);?>
</div>

<? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "include/partners.inc.php"
		),
		false
);
?>


<? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "include/about.inc.php"
		),
		false
);
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

