<body>
	<!--wrapper-->
	<div class="wrapper">

		{include file="sidebar.tpl"}

		{include file="header.tpl"}
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				{$page_content}
			</div>
						  
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		{include file="footer.tpl"}
	</div>
	<!--end wrapper-->
	{include file="switcher.tpl"}
	{include file="scripts.tpl"}

</body>
</html>