<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>ADD EMPLOYEES</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">EDIT EMPLOYEE</h2>
                </div>
                <div class="card-body">
                <?php
                    $emp_id = $_GET['id'];
                    //database connection
                    $db = mysqli_connect('localhost', 'root', '', 'sqlquery');

                    $query = "SELECT * FROM employees WHERE emp_id = $emp_id";
                    $result = mysqli_query($db, $query); 
                    while ($row = mysqli_fetch_array ($result)){
                        
                    

                ?>
                	
                    <form method="POST" action="controller.php" enctype='multipart/form-data'> 
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>" >
                                            <input class="input--style-5" type="text" name="first_name" id="firstname" value='<?php echo $row['firstname']; ?>' >
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name" id="lastname" value='<?php echo $row['lastname']; ?>'>
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" id="email" value='<?php echo $row['email']; ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Phone</div>
                            <div class="value">
                                <div class="row row-refine">
                                    
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="phone" id="phone" maxlength="10" value='<?php echo $row['phone']; ?>'>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row m-b-55">
                            <div class="name">Salary</div>
                            <div class="value">
                                <div class="row row-refine">
                                    
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                        <?php 
                                         $sql_salary = "SELECT salary FROM salary WHERE emp_id = $emp_id";
                                         $salary = mysqli_query($db, $sql_salary); 
                                         while ($sal = mysqli_fetch_array ($salary)){
                                             echo "<input class='input--style-5' type='text' name='salary' id='salary' value=".$sal['salary']." >";
                                          } 

                                        ?>

                                        
                                            
                                     </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Department</div>
                            <div class="value">
                                <div class="input-group">
                                    

                                        <?php

                                        $selection = array('Admin', 'Web developer','App developer');
                                        echo '<select name="department" id="department">
                                            <option value="" disabled>Please Select Option</option>';

                                        foreach ($selection as $selection) {
                                            if ($row['department'] == $selection)
                                            echo '<option selected value="'.$selection.'">'.$selection.'</option>';
                                            else
                                            echo '<option value="'.$selection.'">'.$selection.'</opton>';                                           
                                        }

                                        echo '</select>';
                                        ?>
                                        

                                      
                                    
                                </div>
                            </div>
                        </div>




                        <!-- Section for address -->
                        <!-- Address Input Field -->
                        <div class="form-row m-b-55">
                            <div class="name">Address</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-1">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <?php
                                                
                                                    $query = "SELECT * FROM countries  ORDER BY name ASC";
                                                    $run_query = mysqli_query($db, $query);
                                                    $countCountry = mysqli_num_rows($run_query);
                                                
                                                ?>
                                                <select name="country" id="country">
                                                    <option value="">Select Country</option>
                                                    <?php
                                                        if($countCountry > 0){
                                                            while($country_list = mysqli_fetch_array($run_query)){
                                                                $country_id=$country_list['id'];
                                                                $country_name=$country_list['name'];
                                                                if($row['country_id']==$country_id){
                                                                    echo "<option value='$country_id' selected>$country_name</option>";
                                                                }
                                                                else{
                                                                    echo "<option value='$country_id'>$country_name</option>";
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            echo '<option value="">Country not available</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                            <?php
                                                $check = $row['country_id'];
                                                $state = "SELECT * FROM states WHERE country_id = $check ORDER BY name ASC";
                                                $getState = mysqli_query($db, $state);
                                                $countState = mysqli_num_rows($getState);
                                            
                                            ?>
                                            <select name="state" id="state">
                                                <option value="" disabled>Select State</option>
                                                <?php
                                                    if($countState > 0){
                                                        while($State_list = mysqli_fetch_array($getState)){
                                                            $state_id=$State_list['id'];
                                                            $state_name=$State_list['name'];
                                                            if($row['state_id']==$state_id){
                                                                echo "<option value='$state_id' selected>$state_name</option>";
                                                            }
                                                            else{
                                                                echo "<option value='$state_id'>$state_name</option>";
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        echo '<option value="">State not available</option>';
                                                    }
                                                ?>
                                            </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                            <?php
                                                $checkState = $row['state_id'];
                                                $city = "SELECT * FROM cities WHERE state_id = $checkState ORDER BY name ASC";
                                                $getCity = mysqli_query($db, $city);
                                                $countCity = mysqli_num_rows($getCity);
                                            
                                            ?>
                                            <select name="city" id="city">
                                                <option value="" disabled>Select State</option>
                                                <?php
                                                    if($countCity > 0){
                                                        while($City_list = mysqli_fetch_array($getCity)){
                                                            $city_id=$City_list['id'];
                                                            $city_name=$City_list['name'];
                                                            if($row['city_id']==$city_id){
                                                                echo "<option value='$city_id' selected>$city_name</option>";
                                                            }
                                                            else{
                                                                echo "<option value='$city_id'>$city_name</option>";
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        echo '<option value="">City not available</option>';
                                                    }
                                                ?>
                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        






                        <!-- Section for hobbies -->
                        <div class="form-row m-b-55">
                            <div class="name">Hobbies</div>
                            <div class="value">
                                <div class="row row-refine">
                                    
                                    <div class="col-9">
                                        <div class="input-group-desc hobbies">
                                            
                                            <?php 
                                               $sql_hobby = "SELECT * FROM hobbies WHERE emp_id = $emp_id";
                                               $hobby = mysqli_query($db, $sql_hobby); 
                                                while ($hoobby = mysqli_fetch_array ($hobby)){
                                                   echo "<div class='col-6'><input type='text' name='hobbies[]' class='input--style-5' value=".$hoobby['hobbies']." >
                                                   <button class='add_more_button'><i class='far fa-plus-square' ></i></button><a href='#' class='remove_field' style='margin-left:10px;'><i class='far fa-minus-square'></i></a>
                                                       
                                                   </div>";
                                                }
                        
                    

                                            ?>
                                        
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit" name="update_emp" id="submitForm">UPDATE</button>
                        </div>
                    </form>
                    <?php

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/global.js"></script>
    <script src="js/script.js"></script>
    
    
</body>
</html>

