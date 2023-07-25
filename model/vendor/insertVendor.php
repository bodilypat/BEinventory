<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['vendorStatus'])){
		
		$fullName = htmlentities($_POST['venFullName']);
		$email = htmlentities($_POST['venEmail']);
		$mobile = htmlentities($_POST['venMobile']);
		$phone2 = htmlentities($_POST['venPhone2']);
		$address = htmlentities($_POST['venAddress']);
		$address2 = htmlentities($_POST['venAddress2']);
		$city = htmlentities($_POST['venCity']);
		$district = htmlentities($_POST['venDistrict']);
		$status = htmlentities($_POST['venStatus']);
	
		if(isset($fullName) && isset($mobile) && isset($address)) {
			// Validate mobile number
			if(filter_var($mobile, FILTER_VALIDATE_INT) === 0 || filter_var($mobile, FILTER_VALIDATE_INT)) {
				// Valid mobile number
			} else {
				// Mobile is wrong
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number.</div>';
				exit();
			}
			
			// Check if mobile phone is empty
			if($mobile == ''){
				// Mobile phone 1 is empty
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter mobile phone number.</div>';
				exit();
			}
			
			// Validate second phone number only if it's provided by user
			if(!empty($phone2)){
				if(filter_var($phone2, FILTER_VALIDATE_INT) === false) {
					// Phone number 2 is not valid
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number 2.</div>';
					exit();
				}
			}
			
			// Validate email only if it's provided by user
			if(!empty($email)) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
					// Email is not valid
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email.</div>';
					exit();
				}
			}
			
			// Validate address, address2 and city
			// Validate address
			if($address == ''){
				// Address 1 is empty
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address.</div>';
				exit();
			}
			
			// Start the insert process
			$sql = 'INSERT INTO vendor(fullName, email, mobile, phone2, address, address2, city, district, status) VALUES(:fullName, :email, :mobile, :phone2, :address, :address2, :city, :district, :status)';
			$statement = $conn->prepare($sql);
			$statement->execute(['fullName' => $fullName, 'email' => $email, 'mobile' => $mobile, 'phone2' => $phone2, 'address' => $address, 'address2' => $address2, 'city' => $city, 'district' => $district, 'status' => $status]);
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor added to database</div>';
		} else {
			// One or more fields are empty
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	
	}
?>
    
