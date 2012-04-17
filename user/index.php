<?php
require_once '../init.php';
$id_section = 10;
$section = 'user';
$sub = '';
require_once INCLUDES.'header.php' ?>
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
					<?php
					$regions = fSession::get(SESSION_REGIONS);
					print_r($regions);
					?>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>