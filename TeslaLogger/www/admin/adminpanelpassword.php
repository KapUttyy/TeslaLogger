<!DOCTYPE html>
<?php
require("language.php");
require_once("tools.php");
?>
<html lang="<?php echo $json_data["Language"]; ?>">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php t("Teslalogger Tesla Zugangsdaten"); ?></title>
	<link rel="stylesheet" href="static/jquery/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="static/teslalogger_style.css">
	<script src="static/jquery/jquery-1.12.4.js"></script>
	<script src="static/jquery/ui/1.12.1/jquery-ui.js"></script>
	<script src="jquery/jquery-migrate-1.4.1.min.js"></script>
	<script src="static/jquery/datatables/1.10.22/js/jquery.dataTables.min.js"></script>
	<link rel='stylesheet' id='genericons-css'  href='static/genericons.css?ver=3.0.3' type='text/css' media='all' />
	<link rel='stylesheet' href="static/jquery/datatables/1.10.22/css/jquery.dataTables.min.css">
</head>
<script>
function save() {
		 if ($("#password1").val() == null || $("#password1").val() == "") {
			alert("Bitte Passwort eingeben!");
		} else if ($("#password1").val() != $("#password2").val()) {
			alert("Passwörter stimmen nicht überein!");
		} else {			
			var d = {
					password: $("#password1").val(),
				};

			var jqxhr = $.post("teslaloggerstream.php", {url: "setadminpanelpassword", data: JSON.stringify(d)})
			.always(function (data) {
					window.location.href='index.php';
                    }
				);
		}
	}

	function deletepw()
	{
		if (confirm("Do you want to delete your password?"))
		{
			var d = {
					delete: 1
				};

			var jqxhr = $.post("teslaloggerstream.php", {url: "setadminpanelpassword", data: JSON.stringify(d)}).always(function () {
					alert("Check Logfile in one minute!");
					window.location.href='index.php';
				});
		}
	}
</script>
<body style="padding-top: 5px; padding-left: 10px;">
<div style="max-width: 1260px;">
<?php 
include "menu.php";
menu("Admin Panel Credentials");

if (isDocker())
{
	$filename = "/var/tmp/dockerwebserverversion";

	if (!file_exists($filename))
	{
		echo("<h1 style='color:red;'>Please update your Docker: <a href='https://github.com/bassmaster187/TeslaLogger/blob/master/docker_setup.md#docker-update--upgrade'>LINK</a></h1>");
	}
}

?>
<div>
<h1><?php t("Set password for Teslalogger's admin panel"); ?>:</h1>
<table>
<tr><td><b><?php t("Name"); ?>:</b></td><td>admin</td></tr>
<tr><td><?php t("Passwort"); ?>:</td><td><input id="password1" type="password" autocomplete="new-password" /></td></tr>
<tr><td><?php t("Passwort wiederholen"); ?>:</td><td><input id="password2" type="password" autocomplete="new-password" /></td></tr>
<tr><td colspan="2">
<button id="deletebutton" onclick="deletepw();" class="redbutton"><?php t("Löschen"); ?></button>
<button onclick="save();" style="float: right;"><?php t("Speichern"); ?></button></td></tr>
</table>
</div>
