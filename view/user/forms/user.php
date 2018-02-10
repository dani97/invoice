<?php
	require 'menu.php';
	require '../../util/urllib.php';
	if($_SESSION['user_type']=="admin") {
?>
<div class="form-container">
	<div class="products" id="user-list">
			<?php
				$data = array();
				$data['token'] = $_SESSION['token'];
				$data['user_id'] = $_SESSION['user_id'];
				$data = json_encode($data);
				$response = json_decode(url::postData("http://localhost/invoice/user/users.php",$data),true);
				if($response['status']=="success"){
					$users = $response['data'];
					foreach ($users as $user) {

						echo "<div class='product'>";
						echo "<div class='icon'>";
						echo "<i class='fas fa-user-circle fa-3x'></i></div>";
						echo "<div class='right'>";
						echo "<p> Name :".$user['user_name']."</p>";
						echo "<p> Type : ".$user['user_type']."</p></div></div>";
					}
				}
				
			?>
		</div>
	</div>
<?php 
}
else {
	header("location : http://localhost/invoice/view/forms");
}
?>