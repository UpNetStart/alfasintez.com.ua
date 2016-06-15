<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>



<?$APPLICATION->IncludeComponent(
    "bitrix:furniture.catalog.index",
    "list_all",
    Array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "2",
        "IBLOCK_BINDING" => "element",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000",
        "CACHE_GROUPS" => "Y"
    )
);?>
