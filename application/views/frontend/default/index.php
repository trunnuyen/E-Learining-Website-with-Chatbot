<!DOCTYPE html>
<html lang="en">

<head>

	


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	


	

	<link name="favicon" type="image/x-icon" href="<?php echo base_url() . 'uploads/system/bonkassemble.jpg' ?>" rel="shortcut icon" />
	<?php include 'includes_top.php'; ?>


</head>

<body class="gray-bg">
	<?php
	if ($this->session->userdata('user_login')) {
		include 'logged_in_header.php';
	} else {
		include 'logged_out_header.php';
	}
	include $page_name . '.php';
	include 'footer.php';
	include 'includes_bottom.php';
	include 'modal.php';
	?>
	<!-- <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
	<df-messenger intent="WELCOME" chat-title="Chatbot" agent-id="3765a756-7f42-4c35-b6ed-46c9a1c7dbf9" language-code="en" chat-icon="https://cdn-icons-png.flaticon.com/512/4712/4712035.png"></df-messenger>
	<style>
		df-messenger {
			--df-messenger-bot-message: #878fac;
			--df-messenger-button-titlebar-color: #13bf8e;
			--df-messenger-chat-background-color: #fafafa;
			--df-messenger-font-color: white;
			--df-messenger-send-icon: #878fac;
			--df-messenger-user-message: #13bf8e;
		}
	</style> -->
	<script type="text/javascript" id="zsiqchat">
		var $zoho = $zoho || {};
		$zoho.salesiq = $zoho.salesiq || {
			widgetcode: "c0a6b769e3f578722c281203b401bc9ee18e6a5f258081459114f36763fdf7361a2010ab7b6727677d37b27582c0e9c4",
			values: {},
			ready: function() {}
		};
		var d = document;
		s = d.createElement("script");
		s.type = "text/javascript";
		s.id = "zsiqscript";
		s.defer = true;
		s.src = "https://salesiq.zoho.com/widget";
		t = d.getElementsByTagName("script")[0];
		t.parentNode.insertBefore(s, t);
	</script>
</body>

</html>