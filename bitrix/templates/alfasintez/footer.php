<div id="footer-wrapper" class="container-fluid">
    <div class="row">
        <div class="footer-sep-blue"></div>
        <div class="footer-sep">
        </div>

        <div class="container">
                <?
                    // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "include_area",
                        array(
                            // region Параметры компонента
                            "AREA_FILE_SHOW"    =>  "file",  // Показывать включаемую область : array ( 'page' => 'для страницы', 'sect' => 'для раздела', )
                            "AREA_FILE_PATH"  =>  "/include/footer.inc.php",   // Суффикс имени файла включаемой области
                            "AREA_FILE_SUFFIX"  =>  "inc",   // Суффикс имени файла включаемой области
                            "EDIT_TEMPLATE"     =>  "standard.php",      // Шаблон области по умолчанию : array ( 'standard.php' => '[standard.php] Стандартная страница', )
                            // endregion
                            "PATH" => "/include/footer.inc.php"
                        )
                    );
                    ?>
    </div>
    </div>
</div>


</div>
</body>
</html>