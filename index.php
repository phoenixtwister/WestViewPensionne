<?php
error_reporting(0);
include('connection.php');
include('actions/login-action.php');
//session check
if (isset($_SESSION['Customerid'])) {
    $user_check=$_SESSION['Customerid'];
    $sql = "SELECT * FROM tblusers WHERE Customer_ID = '$user_check'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $login_session = $row['Customer_ID'];
} //end
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Westview Pensione House - Cebu | Philippines</title>
    <!--Must be first-->
    <script type="text/javascript" src="hotelpage/js/datepicker.js"></script> 
    <script type="text/javascript" src="hotelpage/js/datepicker1.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="hotelpage/css/bootstrap.min.css" rel="stylesheet">
    <!--Icon-->
     <link href="hotelpage/images/westview.png" type="image/png" rel="icon">
    <!-- Custom CSS -->
    <link href="hotelpage/css/modern-business.css" rel="stylesheet">
    <link href="hotelpage/css/westview.css" rel="stylesheet">
    <link href="hotelpage/css/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <link href="hotelpage/css/datepicker2.css" rel="stylesheet" type="text/css" > 
 

    <!-- Custom Fonts -->
    <link href="hotelpage/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="hotelpage/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="hotelpage/js/main.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>  

</head>
<!--validate form-->
<script type="text/javascript" src="hotelpage/js/validateform.js"></script>
<!--set difference-->
<script type="text/javascript" src="hotelpage/js/setdiff.js"></script>

<body>

    <!-- Navigation -->
    <?php
        if (isset($_SESSION['Customerid'])) {
            if ($row['Verification']==0) {
                ?>
                <style type="text/css">
                .navbar-fixed-top {
                    top: 30px;
                }

                .popup-verify {
                    z-index: 6;
                    background: rgb(254, 255, 228);
                    border: solid 1px #EFFF00;
                    position: fixed;
                    width: 100%;
                    padding: 2px 10px;
                    margin: auto;
                    top: 0px;
                    left: 0px;
                    /* display: none; */
                }
                </style>
                
                  
                        
        <div class="popup-verify navbar-fixed-top">
        <div class="container">
                <table>
                    <tbody><tr>
                    <td><form method="POST" action="actions/resend.php"></td>
                        <th>Please verify your Account</th>
                        <td style="padding:0px 25px"></td><td>Enter Your Email Address: </td>
                        <td><input class="verify" name="verify" type="email"></td>
                        <td style="padding:0px 10px"><input class="verify" name="btnverify" type="submit" value="Resend"></td>
                        <td><input class="cancel-verify" name="cancel" type="button" value="Cancel"></td>
                    <td></form></td>
                    </tr>
                </tbody></table>
            </div>
            </div>
               
              
                <?php
            }
        }
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="nav-bar-head">
                <div class="head-logo">
                <div class=" logo">
                            <a href="index.php">
                                <img id="header-logo" src="hotelpage/images/westview.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['Customerid'])) {
            ?>
            <div class="nav-accnt" style="position: absolute;float: right;right:0px">
                    <form method="post" action="actions/logout.php">
                    <p style="margin:0px 5px;font-size: 13.5px;color:#FFF;"><i class="fa fa-fw fa-user "></i>Welcome <?php echo ucfirst($row["FirstName"]);?> [ <input style="background-color: transparent;border: transparent;" class="logout" name="logout" type="submit" value="Logout" /> ]</p>
                </form>
            </div>
            <?php
            }
            ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="room.php">Rooms</a>
                    </li>
                    <li>
                        <a href="promotions.php">Promotions</a>
                    </li>
                    <li>
                        <a href="location.php">Location</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                    <?php 
                    if (isset($login_session)) { 
                        if ($row['Type']=='Administrator') { ?>
                            <li class="dropdown">
                                <a href="adminpage/pages/index.php" class="portfolio-link" >Admin</a>
                            </li>
                        <?php
                        } else if($row['Type']=='Staff') {
                            echo '<li class="dropdown">
                                    <a href="adminpage/pages/index-staff.php" class="portfolio-link" >Staff</a>
                                 </li>';
                        } else {
                                echo '<li class="dropdown">
                                    <a href="userindex.php" class="portfolio-link" >Profile</a>
                                 </li>';
                        }
                    } else {
                    ?>
                    <li class="dropdown">
                        <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">Sign in </a>
                    </li>
                    <?php } 
                    $conn->close();
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!--Modal Login-->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Sign In to continue</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><div class="circle-mask"> <canvas id="canvas" class="circle" width="96" height="96"></canvas></div></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" value="" type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <a class="portfolio-link" data-toggle="modal" href="#forgotpassword">Forgot Password</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" name="submit" type="submit" value="Sign In" />
                                <a href="#registrationForm" data-toggle="modal" class="btn  btn-default btn-block">Create account</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Forgot Password-->
    <div class="portfolio-modal modal fade" id="forgotpassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="actions/forgotpassword.php">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email Address" name="emailaddress" value="" type="email">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" name="submit" type="submit" value="Submit" />
                                <a href="?" data-dismiss="modal" class="btn btn-default btn-block">Cancel</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Create Account modal-->
    <div class="portfolio-modal modal fade" id="registrationForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-color: rgb(51, 122, 183); color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Create Account</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="actions/regredirect.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input class="form-control" placeholder="Name" name="fname" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Lastname" name="lname" autofocus="" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" value="" type="text" required>
                                    <input id="pass" class="form-control" placeholder="Password" name="password" type="password" required>
                                    <input id="repass" class="form-control" placeholder="Retype Password" name="retypepassword" type="password" required>
                                    <i id="check" class="fa" ></i><b id="validate-status"></b>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="phone" autofocus="" type="text" required>
                                    <input class="form-control" placeholder="Email Address" name="email" autofocus="" type="email" required>
                                    Gender: <input name="gender" value="Male" autofocus="" type="radio" required> Male
                                    <input name="gender" value="Female" autofocus="" type="radio"> Female
                                    <select class="form-control" name="country" required>
                                        <option value="-1" selected="">Select...</option>
                                        <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
                                        <option value="Albania" title="Albania">Albania</option>
                                        <option value="Algeria" title="Algeria">Algeria</option>
                                        <option value="American Samoa" title="American Samoa">American Samoa</option>
                                        <option value="Andorra" title="Andorra">Andorra</option>
                                        <option value="Angola" title="Angola">Angola</option>
                                        <option value="Anguilla" title="Anguilla">Anguilla</option>
                                        <option value="Antarctica" title="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina" title="Argentina">Argentina</option>
                                        <option value="Armenia" title="Armenia">Armenia</option>
                                        <option value="Aruba" title="Aruba">Aruba</option>
                                        <option value="Australia" title="Australia">Australia</option>
                                        <option value="Austria" title="Austria">Austria</option>
                                        <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas" title="Bahamas">Bahamas</option>
                                        <option value="Bahrain" title="Bahrain">Bahrain</option>
                                        <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
                                        <option value="Barbados" title="Barbados">Barbados</option>
                                        <option value="Belarus" title="Belarus">Belarus</option>
                                        <option value="Belgium" title="Belgium">Belgium</option>
                                        <option value="Belize" title="Belize">Belize</option>
                                        <option value="Benin" title="Benin">Benin</option>
                                        <option value="Bermuda" title="Bermuda">Bermuda</option>
                                        <option value="Bhutan" title="Bhutan">Bhutan</option>
                                        <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                        <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana" title="Botswana">Botswana</option>
                                        <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil" title="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi" title="Burundi">Burundi</option>
                                        <option value="Cambodia" title="Cambodia">Cambodia</option>
                                        <option value="Cameroon" title="Cameroon">Cameroon</option>
                                        <option value="Canada" title="Canada">Canada</option>
                                        <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
                                        <option value="Chad" title="Chad">Chad</option>
                                        <option value="Chile" title="Chile">Chile</option>
                                        <option value="China" title="China">China</option>
                                        <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia" title="Colombia">Colombia</option>
                                        <option value="Comoros" title="Comoros">Comoros</option>
                                        <option value="Congo" title="Congo">Congo</option>
                                        <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
                                        <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
                                        <option value="Croatia" title="Croatia">Croatia</option>
                                        <option value="Cuba" title="Cuba">Cuba</option>
                                        <option value="Curaçao" title="Curaçao">Curaçao</option>
                                        <option value="Cyprus" title="Cyprus">Cyprus</option>
                                        <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
                                        <option value="Denmark" title="Denmark">Denmark</option>
                                        <option value="Djibouti" title="Djibouti">Djibouti</option>
                                        <option value="Dominica" title="Dominica">Dominica</option>
                                        <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador" title="Ecuador">Ecuador</option>
                                        <option value="Egypt" title="Egypt">Egypt</option>
                                        <option value="El Salvador" title="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea" title="Eritrea">Eritrea</option>
                                        <option value="Estonia" title="Estonia">Estonia</option>
                                        <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji" title="Fiji">Fiji</option>
                                        <option value="Finland" title="Finland">Finland</option>
                                        <option value="France" title="France">France</option>
                                        <option value="French Guiana" title="French Guiana">French Guiana</option>
                                        <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon" title="Gabon">Gabon</option>
                                        <option value="Gambia" title="Gambia">Gambia</option>
                                        <option value="Georgia" title="Georgia">Georgia</option>
                                        <option value="Germany" title="Germany">Germany</option>
                                        <option value="Ghana" title="Ghana">Ghana</option>
                                        <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
                                        <option value="Greece" title="Greece">Greece</option>
                                        <option value="Greenland" title="Greenland">Greenland</option>
                                        <option value="Grenada" title="Grenada">Grenada</option>
                                        <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam" title="Guam">Guam</option>
                                        <option value="Guatemala" title="Guatemala">Guatemala</option>
                                        <option+ value="Guinea" title="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana" title="Guyana">Guyana</option>
                                        <option value="Haiti" title="Haiti">Haiti</option>
                                        <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                        <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras" title="Honduras">Honduras</option>
                                        <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
                                        <option value="Hungary" title="Hungary">Hungary</option>
                                        <option value="Iceland" title="Iceland">Iceland</option>
                                        <option value="India" title="India">India</option>
                                        <option value="Indonesia" title="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq" title="Iraq">Iraq</option>
                                        <option value="Ireland" title="Ireland">Ireland</option>
                                        <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
                                        <option value="Israel" title="Israel">Israel</option>
                                        <option value="Italy" title="Italy">Italy</option>
                                        <option value="Jamaica" title="Jamaica">Jamaica</option>
                                        <option value="Japan" title="Japan">Japan</option>
                                        <option value="Jersey" title="Jersey">Jersey</option>
                                        <option value="Jordan" title="Jordan">Jordan</option>
                                        <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya" title="Kenya">Kenya</option>
                                        <option value="Kiribati" title="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait" title="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia" title="Latvia">Latvia</option>
                                        <option value="Lebanon" title="Lebanon">Lebanon</option>
                                        <option value="Lesotho" title="Lesotho">Lesotho</option>
                                        <option value="Liberia" title="Liberia">Liberia</option>
                                        <option value="Libya" title="Libya">Libya</option>
                                        <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania" title="Lithuania">Lithuania</option>
                                        <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
                                        <option value="Macao" title="Macao">Macao</option>
                                        <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="Madagascar" title="Madagascar">Madagascar</option>
                                        <option value="Malawi" title="Malawi">Malawi</option>
                                        <option value="Malaysia" title="Malaysia">Malaysia</option>
                                        <option value="Maldives" title="Maldives">Maldives</option>
                                        <option value="Mali" title="Mali">Mali</option>
                                        <option value="Malta" title="Malta">Malta</option>
                                        <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique" title="Martinique">Martinique</option>
                                        <option value="Mauritania" title="Mauritania">Mauritania</option>
                                        <option value="Mauritius" title="Mauritius">Mauritius</option>
                                        <option value="Mayotte" title="Mayotte">Mayotte</option>
                                        <option value="Mex?co" title="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco" title="Monaco">Monaco</option>
                                        <option value="Mongolia" title="Mongolia">Mongolia</option>
                                        <option value="Montenegro" title="Montenegro">Montenegro</option>
                                        <option value="Montserrat" title="Montserrat">Montserrat</option>
                                        <option value="Morocco" title="Morocco">Morocco</option>
                                        <option value="Mozambique" title="Mozambique">Mozambique</option>
                                        <option value="Myanmar" title="Myanmar">Myanmar</option>
                                        <option value="Namibia" title="Namibia">Namibia</option>
                                        <option value="Nauru" title="Nauru">Nauru</option>
                                        <option value="Nepal" title="Nepal">Nepal</option>
                                        <option value="Netherlands" title="Netherlands">Netherlands</option>
                                        <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand" title="New Zealand">New Zealand</option>
                                        <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
                                        <option value="Niger" title="Niger">Niger</option>
                                        <option value="Nigeria" title="Nigeria">Nigeria</option>
                                        <option value="Niue" title="Niue">Niue</option>
                                        <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway" title="Norway">Norway</option>
                                        <option value="Oman" title="Oman">Oman</option>
                                        <option value="Pakistan" title="Pakistan">Pakistan</option>
                                        <option value="Palau" title="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama" title="Panama">Panama</option>
                                        <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay" title="Paraguay">Paraguay</option>
                                        <option value="Peru" title="Peru">Peru</option>
                                        <option value="Philippines" title="Philippines">Philippines</option>
                                        <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
                                        <option value="Poland" title="Poland">Poland</option>
                                        <option value="Portugal" title="Portugal">Portugal</option>
                                        <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar" title="Qatar">Qatar</option>
                                        <option value="Réunion" title="Réunion">Réunion</option>
                                        <option value="Romania" title="Romania">Romania</option>
                                        <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda" title="Rwanda">Rwanda</option>
                                        <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
                                        <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
                                        <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" title="Samoa">Samoa</option>
                                        <option value="San Marino" title="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal" title="Senegal">Senegal</option>
                                        <option value="Serbia" title="Serbia">Serbia</option>
                                        <option value="Seychelles" title="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore" title="Singapore">Singapore</option>
                                        <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                        <option value="Slovakia" title="Slovakia">Slovakia</option>
                                        <option value="Slovenia" title="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia" title="Somalia">Somalia</option>
                                        <option value="South Africa" title="South Africa">South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                        <option value="South Sudan" title="South Sudan">South Sudan</option>
                                        <option value="Spain" title="Spain">Spain</option>
                                        <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan" title="Sudan">Sudan</option>
                                        <option value="Suriname" title="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland" title="Swaziland">Swaziland</option>
                                        <option value="Sweden" title="Sweden">Sweden</option>
                                        <option value="Switzerland" title="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand" title="Thailand">Thailand</option>
                                        <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo" title="Togo">Togo</option>
                                        <option value="Tokelau" title="Tokelau">Tokelau</option>
                                        <option value="Tonga" title="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia" title="Tunisia">Tunisia</option>
                                        <option value="Turkey" title="Turkey">Turkey</option>
                                        <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
                                        <option value="Uganda" title="Uganda">Uganda</option>
                                        <option value="Ukraine" title="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
                                        <option value="United States" title="United States">United States</option>
                                        <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay" title="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                        <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
                                        <option value="Yemen" title="Yemen">Yemen</option>
                                        <option value="Zambia" title="Zambia">Zambia</option>
                                        <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <input class="form-control" placeholder="City/State" name="city" autofocus="" type="text" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input value="Create an Account" name="submit" type="submit" class="btn  btn-primary btn-block">
                                 <input value="Cancel" data-dismiss="modal"  class="btn btn-default btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Wrapper for slides Note Images should be 1900x1080& -->
        <div class="carousel-inner" >
            <div class="item active">
                <div class="fill" style="background-image:url('hotelpage/images/sliderimages/sld3.jpg');"></div>
                <div class="carousel-caption">
                    
                    
                               
                </div>  
                
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('hotelpage/images/sliderimages/sld2.jpg');"></div>
                <div class="carousel-caption">
                   
                            
                </div>  
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('hotelpage/images/sliderimages/sld1.jpg');"></div>
                <div class="carousel-caption">
                  
                          
                </div>  
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container" id="checkavailability" style="background-color: #0C7BE9; color: rgb(255, 255, 255); position: absolute; float: left; left: 15px; right: 15px; border: 4px solid #fff; border-radius: 2%;">
       <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);" class="row">
        <div class="col-lg-12">
              <center>  <h1 class="page-header">
                    Easy Booking at Low Rates
                </h1>
              </center>
        </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                    <div class="panel-body">
                        <div class="row">
                                <form style="color:black;" role="form" method="post" action="adminpage/room/selectroom.php" name="index" onsubmit="return validateForm()">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                    <label  style="color:#444;"><h3><i class=" " style="color:#444;"></i> Arrival Date:</h3></label>
                                        <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="start" id="sd" value="" maxlength="10" readonly />
                                    </div> 
                            </div>
                            <div class="col-lg-4">
                     
                                    <div class="form-group">
                                    <label  style="color:#444;"><h3><i class="  " style="color:#444;"></i> Departure Date:</h3></label>
                                        <input style="text-align:center;background-color:#fff;color:#000;font-size:14pt;" type="text" class=" w8em format-d-m-y highlight-days-67 range-low-today form-control" name="end" id="ed" value="" maxlength="10" readonly />
                                    </div> 
                            </div>
                             <div class="col-lg-3">  
                                    <div class="form-group">
                                        <label></label>
                                        <center><br><br>
                                        <input name="numberofdays" type="hidden" />
                                       <button name="checkroom" type="submit" class="btn btn-lg btn-promo4" onclick="setDifference(this.form);"> Check availability and prices <i class="fa fa-fw fa-search  "></i></button>
                                       </center>
                                </form> 
                            </div>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top:250px;" ></div>
    <div class="container" >

        <!-- Marketing Icons Section -->
        <div class="row" style="margin-top:90px;">

            
            <div class="col-lg-4">
                    <div class="promo-panel promo-panel-default">
                      
                      <br>
                             
                          
                       
                            <blockquote style="border-color:green;">
                             
                                <p style="color:green;"> <span class="fa fa-thumbs-o-up fa-2x" style=""></span> Best Rate Guarantee</p>
                               
                            </blockquote>
                            <blockquote style="border-color:#DC143C;">
                                <p style="color:#DC143C;"><span class="fa fa-lock fa-2x" style=""></span> Secure Reservations</p>
                                
                                </small>
                            </blockquote>
                            <blockquote  style="border-color:orange;">
                                <p style="color:orange"><span class="fa fa-check fa-2x" style=""></span> Free Cancellation</p>
                               
                            </blockquote>
                             <blockquote style="border-color:#fff;">
                             <h3 class="page-header">Social Accounts</h3>
                           <a href="http://www.facebook.com/" target="_blank" class="btn btn-block btn-social btn-facebook">
                                <i class="fa fa-facebook"></i> Like us on Facebook
                            </a>
                            <a href="http://www.twitter.com/" target="_blank" class="btn btn-block btn-social btn-twitter">
                                <i class="fa fa-twitter"></i> Follow us Twitter
                            </a>
                          
                            </blockquote>
                    </div>
                    <!-- /.panel -->
                </div>
          
           <div class="col-lg-8">
                <h1 class="text-center">Welcome to our website!</h1>
                <h4 class="text-center">We introduce Westview Pension House  website</h4>
               <p class="text-center" style="font-size:14px;">The rooms of Westview Pension House in Cebu City, Philippines are a combination of functionality and style, offered at reasonable Cebu hotel rates. They feature hardwood floors and cozy lighting, providing an interesting contrast of burgundy tones and earth colors with light neutrals. Book now!</p>
           </div>
           <div class="col-md-4 col-sm-6">
                <a href="room.php">
                    <img class="img-responsive img-portfolio img-hover" src="hotelpage/images/sliderimages/room-700x450.jpg" alt="">
                </a>
            </div>
           <div class="col-md-4 col-sm-6">
                <a href="location.php">
                    <img class="img-responsive img-portfolio img-hover" src="hotelpage/images/sliderimages/gallery-700x450.jpg" alt="">
                </a>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Do you have comments? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i  class="fa fa-phone fa-3x "></i>
                    <p>+63(32)2727993</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i   class="fa fa-envelope-o fa-3x " ></i>
                    <p><a href="contact.php">westviewpensionehouse@gmail.com</a></p>
                </div>
            </div>
        </div>

      

        <!-- Footer -->
            <footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright 2015 by Westview Pensione House. All Rights Reserved.</p>

                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="hotelpage/js/jquery.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
     <script src="hotelpage/js/bootstrap.min.js"></script>



    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
