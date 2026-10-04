<?php
	include_once 'td_includes.php';

	if(!isset($_SESSION['userslug'])){
		header("location:".$baseurl.'login.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			include_once 'html_title.php';
			include_once 'pluggin_header.php';
		?>
	</head>

	<body class="text-left" ng-app="tdipllp">
		<div id="wrapper">
			<?php

				include_once 'html_header.php';
				include_once 'html_menu_bar.php';

				if ($_GET['page']=='home') {
					include_once 'View/html_home_page.php';
				}

			    else if ($_GET['page']=='create_match') {
					include_once 'View/html_create_match.php';
				}



				else if ($_GET['page']=='match_batting') {
					include_once 'match_batting.php';
				}

				else if ($_GET['page']=='add_player') {
					include_once 'View/html_add_player.php';
				}


				else if ($_GET['page']=='every_ball') {
					include_once 'View/html_ever_ball.php';
				}

				  else if ($_GET['page']=='sstc_html') {
					include_once 'sstc_html.php';
				}

			    else if ($_GET['page']=='view_match_detail') {
					include_once 'view_match_detail.php';
				}

				else if ($_GET['page']=='example_page') {
					include_once 'View/exampless.php';
				}

			    else if ($_GET['page']=='pdf_page') {
					include_once 'View/pdf.php';
				}

			

				else if ($_GET['page']=='signout') {
					unset($_SESSION['userslug']);
					header("location:".$baseurl.'login.php');
				}

				




				include_once 'pluggin_footer.php';

			?>
		</div>
	</body>
</html>