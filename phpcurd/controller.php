<?php

//initializing variable
$errors = array();

//connection to database
$db = mysqli_connect('localhost', 'root', '', 'sqlquery');

//Part of code to add employees
if (isset($_POST['add_employee']))
{
	
	// receive all input values from the form
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$salary = $_POST['salary'];
	$department = $_POST['department'];
    $city_id = $_POST['city'];
    $country_id = $_POST['country'];
    $state_id = $_POST['state'];
	$hobbies = $_POST['hobbies'];
	  
	//SQL query to check employee already exists  
	$user_check_query = "SELECT * FROM employees WHERE email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	  
	if ($user) {
	    if ($user['email'] === $email) {
	      array_push($errors, "Employee already exists");
	    }
    }

	  
	// Finally, register user if there are no errors in the form
	if (count($errors) == 0)
	{
	  	
	  	$query = "INSERT INTO employees (firstname, lastname, email, phone, department, city_id, state_id, country_id) 
	  			  VALUES('$firstname', '$lastname', '$email', '$phone', '$department', '$city_id', '$state_id' , '$country_id')";
	  	
	  	if (mysqli_query($db, $query))
	  	{
	      	$last_id = mysqli_insert_id($db);
	        $query1 = "INSERT INTO salary(emp_id, salary) VALUES ('$last_id' , '$salary')";
	        mysqli_query($db, $query1);
	      	      
	        foreach($hobbies as $hobby)
	        { 
	        	$sql = "INSERT INTO hobbies (emp_id, hobbies) VALUES ('$last_id','$hobby')";
	        	mysqli_query($db, $sql);     
	        }
	        header('location: index.php');
	    };	    
	  }
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//PHP code to update employees.
if (isset($_POST['update_emp']))
{
 
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];
    $hobbies = $_POST['hobbies'];
    $emp_id = $_POST['emp_id'];
    $city_id = $_POST['city'];
    $country_id = $_POST['country'];
    $state_id = $_POST['state'];
   
  	
    $query = "UPDATE employees SET
                firstname  = '$firstname', 
                lastname = '$lastname',
                email = '$email',
                phone = '$phone',
                department = '$department',
                country_id = '$country_id',
                city_id = '$city_id',
                state_id = '$state_id'
                WHERE emp_id = '$emp_id' ";
  	
  	if (mysqli_query($db, $query))
  	{         
      
        $query1 = "UPDATE salary SET salary = $salary WHERE emp_id = $emp_id";       
        mysqli_query($db, $query1);
    
        $delete_hobbies = "DELETE FROM hobbies WHERE emp_id = $emp_id";
        mysqli_query($db, $delete_hobbies);
      
      
        foreach($hobbies as $hobby)
        {        
            $sql = "INSERT INTO hobbies (emp_id, hobbies) VALUES ('$emp_id','$hobby')";
            mysqli_query($db, $sql);       
        }
      
  	    header('location: index.php?message=Employees Details updated successfully');
    }
    else{
        echo $db->error;
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//PHP code to delete employees
if (isset($_GET['id']))
{
    $emp_id = $_GET['id'];
    $delete_hobbies = "DELETE FROM hobbies WHERE emp_id = $emp_id";
    mysqli_query($db, $delete_hobbies);

    $delete_salary = "DELETE FROM salary WHERE emp_id = $emp_id";
    mysqli_query($db, $delete_salary);

    $delete_record = "DELETE FROM employees WHERE emp_id = $emp_id";
    mysqli_query($db, $delete_record);

    header('location: index.php?message=Employees Details deleted successfully');
}







///////////////////////////////////////////////////////////////////////////////////////////////////////
//part of code For ajax request for country state city list
if(isset($_POST["country_id"])){
	//alert("I am an alert box!");
    //Get all state data
	$country_id= $_POST['country_id'];
    $query = "SELECT * FROM states WHERE country_id = '$country_id' 
	ORDER BY name ASC";
	$run_query = mysqli_query($db, $query);
    
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display states list
    if($count > 0){
        echo '<option value="">Select state</option>';
        while($row = mysqli_fetch_array($run_query)){
		$state_id=$row['id'];
		$state_name=$row['name'];
        echo "<option value='$state_id'>$state_name</option>";
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"])){
	$state_id= $_POST['state_id'];
    //Get all city data
    $query = "SELECT * FROM cities WHERE state_id = '$state_id' 
	ORDER BY name ASC";
    $run_query = mysqli_query($db, $query);
    //Count total number of rows
    $count = mysqli_num_rows($run_query);
    
    //Display cities list
    if($count > 0){
        echo '<option value="">Select city</option>';
        while($row = mysqli_fetch_array($run_query)){
		$city_id=$row['id'];
		$city_name=$row['name']; 
        echo "<option value='$city_id'>$city_name</option>";
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}


?>