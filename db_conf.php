<?php
// Fuad
// Just for sql query tests


require "includes/dbconnection.php";

function dump($what){
	echo '<pre>'.print_r($what).'</pre>';
}

//CRUD

// CREATE
// $user = R::dispense('tbladmin');

// $user->adminName = "Fuad Qurbanzada";
// $user->username = "admin";
// $user->password = password_hash("123321aa", PASSWORD_DEFAULT);
// $user->adminRegDate = time();

// $id = R::store($user);
// R::load('tbladmin', $id);

// UPDATE
// $user = R::findOne('tbladmin', "username = ? AND admin_name = ?", ["admin", "Fuad Qurbanzada"] );
// echo $user->id;
// $user->password = "123321aa";  //password_hash("", PASSWORD_DEFAULT);

// $id = R::store($user);
// R::load('tbladmin', $id);

// $ret = mysqli_query($con,"select * from tbladmin where ID='1'");
// $row = mysqli_fetch_array($ret);

	// $report = R::dispense('reports');

	// $report->report_title = "Test";
	// $report->report_content = "Test report from nizami corpuse. Fed up uje =(";
	// $report->sent_date = date("Y-m-d H:i:s");

	// $id = R::store($report);
	// R::load('reports', $id);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DB Configuration</title>
</head>
<body>
<pre>
	<?php
	// $ret = mysqli_query($con,"select * from employeedetail");
	
	// while($row = mysqli_fetch_array($ret)){
	// 	echo $row['EmpFname'];
	// 	echo '<br>';
	// }
	
	// $allEmployees = R::getAll('SELECT * FROM employeedetail');
	// foreach ($allEmployees as $key => $value) {
	// 	echo $allEmployees[$key]['EmpFname'];
	// 	// echo $key;
	// 	echo '<br>';
	// 	// echo $value;
	// 	// echo '<br>	<br><br>';
	// }

	// echo count($allEmployees);

	// $user = R::findOne('tbladmin', "id = ?", [1]);
	// $user->admin_reg_date = date('Y-m-d H:i:s');
	// $id = R::store($user);
	// R::load('tbladmin', $id);
	// dump($user);

    // $user = R::findOne('employeedetail', "id = ?", [2]);

    // dump($user);

	// $owner = R::getAll('SELECT EmpFname,EmpLname FROM  employeedetail WHERE EmpCode = ?', [ 123465 ] );

	// dump($owner);

	// echo '<br><br><br><br>';
	// echo $owner[0]['EmpFname'];

	// $report = R::findOne( 'reports', "id = ?", [13] );
	
	// $report->accept = TRUE;
	// $id = R::store($report);
	// R::load('reports', $id);

	// $user = R::getAll( 'SELECT salary FROM employeedetail WHERE id = ?', [ 2 ] );

	// echo $user[0]['salary'];
	
// function check_salary($salary)
// {
// 	$pattern = '/[^0-9]/';
//   return ! (preg_match($pattern, $salary));
// }

// echo check_salary("1289289848684");



// $user = R::findOne('employeedetail', "id = ?", [ 2 ]);
// $user->EmpLname = "Coy";
// $id = R::store($user);
// R::load('employeedetail', $id);	

$user = R::findOne( 'employeedetail', "id = ?", [ 4 ] );

$user->emp_password = password_hash("12345", PASSWORD_DEFAULT);

$id = R::store($user);
R::load('employeedetail', $id);

	// if ('$2y$10$DRUv5YAmm16Jlbd82Frby.SLBv6kISb0kz2z04enHV8hJKOkJzAZq' == password_hash('123321aa', PASSWORD_DEFAULT)) {
	// 	echo "TRUE";
	// }else{
	// 	echo "gfasles";
	// }


// if (password_verify("123321aa", $user->emp_password)) {
// 	echo "GREAT";
// }else{
// 	echo "NOT GREAT";
// }

?>
</pre>
</body>
</html>
