<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><div class="contact-page">
	<div class="modal__address tab-show">
		<div class="title">
			Адрес:
		</div>
		 Республика Беларусь, индекс 220113, <br class="tab-hidden">
		г.Минск, Логойский тракт, д.15, корп.4<br>
                УНП 600269064
                IBAN BY24GTBN30128000000000080301
                в "Франсабанк" ОАО, г.Минск, пр-т Независимости, 95а, код GTBNBY22

	</div>
	<div class="row">
		<div class="ya-map-wr">
			<div id="ya-map" class="ya-map">
			</div>
		</div>
		<div class="contact-page__content">
			<div class="main__content single-article">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"index",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/includes/contact.php"
	)
);?>
			</div>
		</div>
	</div>
</div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>