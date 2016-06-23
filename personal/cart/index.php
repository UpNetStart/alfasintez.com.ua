<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "PROPS",
			2 => "DELETE",
			3 => "DELAY",
			4 => "PRICE",
			5 => "QUANTITY",
			6 => "SUM",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "Y",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
			0 => "SIZES_SHOES",
			1 => "SIZES_CLOTHES",
			2 => "COLOR_REF",
		),
		"USE_PREPAYMENT" => "N",
		"ACTION_VARIABLE" => "action"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>