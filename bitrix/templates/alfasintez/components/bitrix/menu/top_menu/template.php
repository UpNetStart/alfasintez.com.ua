<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (empty($arResult)) return;
?>

<div class="container">
		<ul class="nav_menu">
			<?foreach($arResult as $itemIdex => $arItem):?>
				<li class="menu-item">
					<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				</li>
			<?endforeach;?>
			<div class="search">
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
		</ul>
</div>
