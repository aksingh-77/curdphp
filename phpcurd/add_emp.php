<?php include('controller.php'); ?>
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
    <!-- Font special for pages-->
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
                    <h2 class="title">ADD EMPLOYEE</h2>
                </div>
                <div class="card-body">
                	<?php include('errors.php'); ?>
                    <form method="POST" action="controller.php" enctype='multipart/form-data'>


                    <!-- Name Input Field  -->
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" id="firstname">
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name" id="lastname">
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Email Input Field -->
                        
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" id="email">
                                </div>
                            </div>
                        </div>




                        <!-- Phone Input Field  -->
                        <div class="form-row m-b-55">
                            <div class="name">Phone</div>
                            <div class="value">
                                <div class="row row-refine">
                                    
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="phone" id="phone" maxlength="10">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Salary Input Field -->
                        <div class="form-row m-b-55">
                            <div class="name">Salary</div>
                            <div class="value">
                                <div class="row row-refine">    
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="salary" id="salary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <!-- Department Input Field -->
                        <div class="form-row">
                            <div class="name">Department</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="department" id="department">
                                            <option disabled="disabled" value="" selected>Choose option</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Web developer">Web developer</option>
                                            <option value="App developer">App developer</option>
                                        </select>
                                        <div class="select-dropdown"><p id='departmenterror' style="color:red";></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>







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
                                                    $count = mysqli_num_rows($run_query);
                                                
                                                ?>
                                                <select name="country" id="country">
                                                    <option value="">Select Country</option>
                                                    <?php
                                                        if($count > 0){
                                                            while($row = mysqli_fetch_array($run_query)){
                                                                $country_id=$row['id'];
                                                                $country_name=$row['name'];
                                                                echo "<option value='$country_id'>$country_name</option>";
                                                            }
                                                        }
                                                        else{
                                                            echo '<option value="">Country not available</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <div class="select-dropdown"><p id='countryerror' style="color:red";></p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <select name="state" id="state">
                                                    <option disabled="disabled" selected value="">Choose State</option>
                                                </select>
                                                <div class="select-dropdown"><p id='stateerror' style="color:red";></p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <select name="city" id="city">
                                                    <option disabled="disabled" selected value="">Choose City</option>
                                                </select>
                                                <div class="select-dropdown"><p id='cityerror' style="color:red";></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








                        <!-- Hobbies input Field -->
                        <div class="form-row m-b-55">
                            <div class="name">Hobbies</div>
                            <div class="value hobbbies">
                                <div class="row row-spaces hobbies">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="hobbies[]" id="firstname">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <button class="add_more_button"><i class="far fa-plus-square " ></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        

                        
                        
                        <div>
                            <button class="btn btn--radius-2 btn--green" type="submit" name="add_employee" id="submitForm">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        // $('#submitForm').on('click', function () {
            
        //     checkDepartment();
        //     checkaddress();
        //     function checkDepartment(){
               
        //         var $val = $('#department').val();
                
        //         if($val==null){
        //             event.preventDefault();
        //             $('#departmenterror').html("Please Select the department");
        //             return false;
        //         }else{
        //             $('#departmenterror').html("");
        //             return true;
        //         }
        //     }

        //     function checkaddress(){
        //         var $country = $('#country').val();
        //         var $state = $('#state').val();
        //         var $city = $('#city').val();
              
        //         if($country==null||$state==null||$city==null){
        //             event.preventDefault();
        //             $('#countryerror').html("Please select complete address section");
        //             return false;
        //         }else{
        //             $('#countryerror').html("");
        //             return true;
        //         }
        //     }


        // });
    </script>
    

    <!-- cnd for bootstrap      -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.esm.min.js"></script> -->

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
