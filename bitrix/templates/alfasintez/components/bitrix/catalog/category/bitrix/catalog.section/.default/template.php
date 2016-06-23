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

/* $arItem['CATALOG_WEIGHT'] -> Вес */
/* $arItem['CATALOG_HEIGHT'] -> Высота */
/* $arItem['CATALOG_WIDTH'] -> Ширина */
/* $arItem['CATALOG_LENGHT'] -> Длина */

$this->setFrameMode(true);

if (!empty($arResult['ITEMS']))
{
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);

	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as &$arProp)
		{
			$templateRow = '';
			if ('TEXT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_size full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_size';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				$templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
'
<span class="bx_item_section_name_gray">
	'.htmlspecialcharsex($arProp['NAME']).'
</span>
'.
'
<div class="bx_size_scroller_container">
<div class="bx_size">
<ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">
';
				foreach ($arProp['VALUES'] as $arOneValue)
				{
					$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
					$templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.';" title="'.$arOneValue['NAME'].'"><i></i><span class="cnt">'.$arOneValue['NAME'].'</span></li>';
				}
				$templateRow .= '</ul></div>'.
'<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'</div></div>';
			}
			elseif ('PICT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_scu full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_scu';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				$templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
				'<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
'<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
				foreach ($arProp['VALUES'] as $arOneValue)
				{
					$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
					$templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.'; padding-top: 0;"><i title="'.$arOneValue['NAME'].'"></i>'.
'<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$arOneValue['PICT']['SRC'].'\');" title="'.$arOneValue['NAME'].'"></span></span></li>';
				}
				$templateRow .= '</ul></div>'.
'<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'</div></div>';
			}
			$arSkuTemplate[$arProp['CODE']] = $templateRow;
		}
		unset($templateRow, $arProp);
	}

	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
	<div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
		<? foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
		$strMainID = $this->GetEditAreaId($arItem['ID']);

		$arItemIDs = array(
			'ID' => $strMainID,
			'PICT' => $strMainID.'_pict',
			'SECOND_PICT' => $strMainID.'_secondpict',
			'STICKER_ID' => $strMainID.'_sticker',
			'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
			'QUANTITY' => $strMainID.'_quantity',
			'QUANTITY_DOWN' => $strMainID.'_quant_down',
			'QUANTITY_UP' => $strMainID.'_quant_up',
			'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
			'BUY_LINK' => $strMainID.'_buy_link',
			'SUBSCRIBE_LINK' => $strMainID.'_subscribe',

			'PRICE' => $strMainID.'_price',
			'DSC_PERC' => $strMainID.'_dsc_perc',
			'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

			'PROP_DIV' => $strMainID.'_sku_tree',
			'PROP' => $strMainID.'_prop_',
			'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
			'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
		);

		$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

		$productTitle = (
			isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
			? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
			: $arItem['NAME']
		);

		$imgTitle = (
			isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
			? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
			: $arItem['NAME']
		);
		?>

	<div class="<? echo ($arItem['SECOND_PICT'] ? 'bx_catalog_item double' : 'bx_catalog_item'); ?>">
		<div class="bx_catalog_item_container" id="<? echo $strMainID; ?>">
			<div class="bx_catalog_item_title">
				<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $productTitle; ?>"><? echo $productTitle; ?></a>
			</div>



				<a id="<? echo $arItemIDs['PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images" style="background-image: url('<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>')" title="<? echo $imgTitle; ?>"><?
		if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
		{
		?>
				<div id="<? echo $arItemIDs['DSC_PERC']; ?>" class="bx_stick_disc right bottom" style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
		<?
		}
		if ($arItem['LABEL'])
		{
		?>
				<div id="<? echo $arItemIDs['STICKER_ID']; ?>" class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
		<?
		}
		?>
			</a><?
		if ($arItem['SECOND_PICT'])
		{
			?>
		<?/**/?>
			<a id="<? echo $arItemIDs['SECOND_PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images_double" style="background-image: url('<? echo (
					!empty($arItem['PREVIEW_PICTURE_SECOND'])
					? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
					: $arItem['PREVIEW_PICTURE']['SRC']
				); ?>');" title="<? echo $imgTitle; ?>">

			<?
			if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
			{
			?>
				<div id="<? echo $arItemIDs['SECOND_DSC_PERC']."s"; ?>" class="bx_stick_disc right bottom" style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
			<?
			}
			if ($arItem['LABEL'])
			{
			?>
				<div id="<? echo $arItemIDs['SECOND_STICKER_ID']; ?>" class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
			<?
			}
			?>
			</a><?
		}
		?>
		<div class="bx_catalog_item_price"><div id="<? echo $arItemIDs['PRICE']; ?>" class="bx_price">

				<?
		if (!empty($arItem['MIN_PRICE']))
		{
			if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
			{
				echo GetMessage(
					'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
					array(
						'#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'],
						'#MEASURE#' => GetMessage(
							'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
							array(
								'#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'],
								'#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']
							)
						)
					)
				);
			}
			else
			{



				echo "
				<div class='box-size-wrapper pull-right clearfix'>";
					?>
				<?
					if(($arItem['CATALOG_WIDTH'] != 0)||($arItem['CATALOG_LENGTH'] != 0)) {
						echo '
							<div class="box-size-volume pull-left">
								'.round((($arItem["CATALOG_WIDTH"] * $arItem["CATALOG_LENGTH"] * $arItem["CATALOG_HEIGHT"]) * 0.001), 0 ).' мл.
							</div>


							<div class="box-size-item-wrapper pull-right">
								<li class="box-size-item"> 		'.$arItem["CATALOG_WIDTH"].'		</li>
								<li class="box-size-item"> 		'.$arItem["CATALOG_LENGTH"].'		</li>
								<li class="box-size-item"> 		'.$arItem["CATALOG_HEIGHT"].'		</li>
							</div>
						';
					}
				?>

				</div>
				<?

				$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] = $arItem['PROPERTIES']['PR_IN_THE_BOX']['VALUE']*$arItem['CATALOG_WEIGHT'] * $arItem['MIN_PRICE']['PRINT_VALUE']*(70/1000);




				$arItem['PROPERTIES']['PR_COLOR_PRICE']['VALUE'];
				$arItem['PROPERTIES']['PR_OPACITY_PRICE']['VALUE'];

				$resultPrice = $arItem['PROPERTIES']['PR_IN_THE_BOX']['VALUE']*($arItem['CATALOG_WEIGHT'] *($arItem['PROPERTIES']['PR_OPACITY_PRICE']['VALUE']/1000));

				if($arItem['MIN_PRICE']['PRINT_VALUE'] == 0){
						echo "<div class='price-not-available pull-left' style='margin-top: 5px;'>";
						echo "Нет на складе";
				}else{
						echo "<div class='price-wrapper pull-left'>";
						echo $arItem['MIN_PRICE']['PRINT_VALUE'];
				}
				echo "</div>
	<br>";

			}
			if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
			{
				?> <span><? echo $arItem['MIN_PRICE']['PRINT_VALUE'] ?></span><?
			}
		}
		?>
			</div>
		</div>
			<?
		if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS']))
		{
			?><div class="bx_catalog_item_controls"><?
			if ($arItem['CAN_BUY'])
			{
				if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
				{
				?>
			<div class="bx_catalog_item_controls_blockone">
				<div style="display: inline-block;position: relative;">

				<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-
				</a>

				<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">

					<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>

					<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>">
						<? echo $arItem['CATALOG_MEASURE_NAME']; ?>
					</span>
			</div>
			</div>
				<?
				}
				?>
					<?/*Кнопка отправки заказа*/?>
					<div id="buy-link-btn-container" class="bx_catalog_item_controls_blocktwo">
				<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="javascript:void(0)" rel="nofollow"><?
				echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
				?>
				</a>
			</div>
				<?
			}
			else
			{
				?>

				<div class="bx_catalog_item_controls_blockone">
					<span class="bx_notavailable"><?
					echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
					?>
					</span>
				</div>

				<?
				if ('Y' == $arParams['PRODUCT_SUBSCRIPTION'] && 'Y' == $arItem['CATALOG_SUBSCRIPTION'])
				{
				?>
				<div class="bx_catalog_item_controls_blocktwo">
					<a id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><?
						echo ('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE'));
						?></a>
				</div><?
				}
			}
			?><div style="clear: both;"></div>
		</div>
		<?
			if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
			{
	?>
				<div class="bx_catalog_item_articul">

				<strong style="text-align: center">Рекомендуем для:</strong>
				<div style="clear:both"></div>
				<ul class="category-recommend-label">
					<? $arLinkElementsID = $arItem['PROPERTIES']['PR_FILTERS']['VALUE']; ?>
				<?
				foreach($arLinkElementsID as $arLinkElement){
				$arFilter = array(
				'IBLOCK_ID' => 5, // выборка элементов из инфоблока с ИД равным «5»
				'ACTIVE' => 'Y',  // выборка только активных элементов
				'ID' => $arLinkElement
				);

				$res = CIBlockElement::GetList(array(), $arFilter, false, false, array('NAME','DETAIL_PICTURE'));


				// вывод элементов
				while ($element = $res->GetNext()) {?>
							<?= '<li><img src="'.CFile::GetPath($element['DETAIL_PICTURE']).'" alt="" style="height:25px; width:25px;" title="'.$element['NAME'].'"></li>' ?>
						<?}
				}?>
				</ul>

	<?
				foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp) {
					?>




					<strong style="text-align: center"> <? echo $arOneProp['NAME']; ?> </strong>
					<?

						if(is_array($arOneProp['DISPLAY_VALUE'])) foreach($arOneProp['DISPLAY_VALUE'] as $disp) echo "<li>" . $disp . "</li>"; else echo "<li>" . $arOneProp['DISPLAY_VALUE'] . "</li>";
				}
	?>
				</div>
	<?
			}
			$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
			if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
			{
	?>
			<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: block; text-align: center;">
	<?
				if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
				{
					foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
					{
				?>
						<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
	<?
						if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
							unset($arItem['PRODUCT_PROPERTIES'][$propID]);
					}
				}
				$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
				if (!$emptyProductProperties) {?>
	<?}?>
			</div>
	<?
			}

			$arJSParams = array(
				'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
				'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => true,
				'SHOW_ABSENT' => true,
				'PRODUCT' => array(
					'ID' => $arItem['ID'],
					'NAME' => $productTitle,
					'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
					'CAN_BUY' => $arItem["CAN_BUY"],
					'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
					'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
					'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
					'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
					'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
					'ADD_URL' => $arItem['~ADD_URL'],
					'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
				),
				'BASKET' => array(
					'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'EMPTY_PROPS' => $emptyProductProperties
				),
				'VISUAL' => array(
					'ID' => $arItemIDs['ID'],
					'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
					'QUANTITY_ID' => $arItemIDs['QUANTITY'],
					'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
					'PRICE_ID' => $arItemIDs['PRICE'],
					'BUY_ID' => $arItemIDs['BUY_LINK'],
					'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
				),
				'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
			);
			unset($emptyProductProperties);
	?>

			<script type="text/javascript">
				var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
			</script>
		<?
		}
		else
		{
			if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
			{
				?>
			<div class="bx_catalog_item_controls no_touch">
				<?
				if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
				{
				?>
			<div class="bx_catalog_item_controls_blockone">
				<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
				<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
				<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
				<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"></span>
			</div>
				<?
				}
				?>
			<div class="bx_catalog_item_controls_blocktwo">
				<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="javascript:void(0)" rel="nofollow"><?
				echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
				?></a>
			</div>
					<div style="clear: both;"></div>
				</div>
				<?
			}
			else
			{
				?>
			<div class="bx_catalog_item_controls no_touch">
				<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
				echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
				?></a>
			</div>
				<?
			}
			?>
			<div class="bx_catalog_item_controls touch">
				<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
				echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
				?></a>
			</div>
			<?
			$boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
			$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
			if ($boolShowProductProps || $boolShowOfferProps)
			{
	?>
				<div class="bx_catalog_item_articul">
	<?
				if ($boolShowProductProps)
				{
					foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
					{
					?><br><strong style="text-align: center"><? echo $arOneProp['NAME']; ?></strong> <?
						echo (
							is_array($arOneProp['DISPLAY_VALUE'])
							? implode(' / ', $arOneProp['DISPLAY_VALUE'])
							: $arOneProp['DISPLAY_VALUE']
						);
					}
				}
				if ($boolShowOfferProps)
				{
	?>
					<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: block;"></span>
	<?
				}
	?>
				</div>
	<?
			}
			if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
			{
				if (!empty($arItem['OFFERS_PROP']))
				{
					$arSkuProps = array();
					?><div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>"><?
					foreach ($arSkuTemplate as $code => $strTemplate)
					{
						if (!isset($arItem['OFFERS_PROP'][$code]))
							continue;
						echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
					}
					foreach ($arResult['SKU_PROPS'] as $arOneProp)
					{
						if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
							continue;
						$arSkuProps[] = array(
							'ID' => $arOneProp['ID'],
							'SHOW_MODE' => $arOneProp['SHOW_MODE'],
							'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
						);
					}
					foreach ($arItem['JS_OFFERS'] as &$arOneJs)
					{
						if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
							$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
					}
					unset($arOneJs);
					?></div><?
					if ($arItem['OFFERS_PROPS_DISPLAY'])
					{
						foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
						{
							$strProps = '';
							if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
							{
								foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
								{
									$strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
										is_array($arOneProp['VALUE'])
										? implode(' / ', $arOneProp['VALUE'])
										: $arOneProp['VALUE']
									).'</strong>';
								}
							}
							$arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
						}
					}
					$arJSParams = array(
						'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
						'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
						'SHOW_ADD_BASKET_BTN' => false,
						'SHOW_BUY_BTN' => true,
						'SHOW_ABSENT' => true,
						'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
						'SECOND_PICT' => $arItem['SECOND_PICT'],
						'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
						'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
						'DEFAULT_PICTURE' => array(
							'PICTURE' => $arItem['PRODUCT_PREVIEW'],
							'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
						),
						'VISUAL' => array(
							'ID' => $arItemIDs['ID'],
							'PICT_ID' => $arItemIDs['PICT'],
							'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
							'QUANTITY_ID' => $arItemIDs['QUANTITY'],
							'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
							'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
							'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
							'PRICE_ID' => $arItemIDs['PRICE'],
							'TREE_ID' => $arItemIDs['PROP_DIV'],
							'TREE_ITEM_ID' => $arItemIDs['PROP'],
							'BUY_ID' => $arItemIDs['BUY_LINK'],
							'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
							'DSC_PERC' => $arItemIDs['DSC_PERC'],
							'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
							'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
						),
						'BASKET' => array(
							'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
							'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
							'SKU_PROPS' => $arItem['OFFERS_PROP_CODES']
						),
						'PRODUCT' => array(
							'ID' => $arItem['ID'],
							'NAME' => $productTitle
						),
						'OFFERS' => $arItem['JS_OFFERS'],
						'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
						'TREE_PROPS' => $arSkuProps,
						'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
					);
					?>
	<script type="text/javascript">
	var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
	</script>
					<?
				}
			}
		}
	?></div>
		</div><?
	} ?>
		<div style="clear: both;"></div>
	</div>





	<script type="text/javascript">
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>'
});
</script>


	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>

<div class="subcategory-view">
    <div class=""></div>
</div>
