<?php 
  include("config.php");
  session_start();
 
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["admin"] !== true){
    header("location: login.php");
    exit;
  } 

  $total_cases=(mysqli_query($link, "SELECT COUNT(*) FROM PATIENTS;") ->fetch_array()[0] );
  $date=date("Y-m-d");
  $new_cases=(mysqli_query($link, "SELECT COUNT('Visitor_Id') FROM samples_collected where Test_Date='".$date."' and Result='Positive';") ->fetch_array()[0] );
  $deceased=(mysqli_query($link, "SELECT count('Patient_Id') FROM patients where Status='deceased';") ->fetch_array()[0] );
  $recovered=(mysqli_query($link, "SELECT count('Patient_Id') FROM patients where Status='recovered';") ->fetch_array()[0] );
?>


<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="profile.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script type="module">
      document.getElementById('home-content').innerHTML=document.getElementById('dashboard').innerHTML;
  </script>
  <script type="text/javascript" src="script.js">  </script>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <span class="logo_name">EMS</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" id="nav1" class="active" onClick="dashboard();">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href='#' id="nav2" onClick="guidelines();">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Guidelines</span>
          </a>
        </li>
        <li>
          <a href="#" id="nav3" onClick="report();">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="#" id="nav4" onClick="asset();">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Asset Availability</span>
          </a>
        </li>
        <li>
          <a href="#" id="nav5" onClick="profile();">
            <i class='bx bx-user' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>

      <div class="profile-details">
        <img src="images/admin.png" alt="">
        <span class="admin_name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
      </div>


    </nav>
    <div class="home-content" id="home-content">
    </div>
    <div class="home-content" id="dashboard" style="display: none;">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Cases</div>
            <div class="number"><span><?php echo $total_cases; ?></span></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-user user'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">New Cases</div>
            <div class="number"><span><?php echo $new_cases; ?></span></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-user-plus user two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Deaths</div>
            <div class="number"><span><?php echo $deceased; ?></span></div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-user-x user three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Recovered</div>
            <div class="number"><span><?php echo $recovered; ?></span></div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-user-check user four' ></i>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">City-wise positivity rates</div><hr>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">City</li>
              <li><a href="#">Mumbai</a></li>
              <li><a href="#">Chennai</a></li>
              <li><a href="#">Delhi</a></li>
              <li><a href="#">Kolkata</a></li>
            </ul>
            <ul class="details">
            <li class="topic">State</li>
            <li><a href="#">Maharastra</a></li>
            <li><a href="#">Tamil Nadu</a></li>
            <li><a href="#">Delhi</a></li>
            <li><a href="#">West Bengal</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Number of tests</li>
            <li><a href="#">1</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Positivity Rate</li>
            <li><a href="#">100%</a></li>
            <li><a href="#">66.66%</a></li>
            <li><a href="#">0 %</a></li>
            <li><a href="#">0 %</a></li>
          </ul>
          </div>
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Contact Details</div><hr>
          <div class="subtitle">Doctors</div>
          <ul class="top-sales-details">
            <li>
            <a href="#">
              <span class="product">Anirudh</span>
            </a>
            <span class="price">1234123412</span>
          </li>
          <li>
            <a href="#">
              <span class="product">Ram</span>
            </a>
            <span class="price">1234123452</span>
          </li>
          
          <li>
            <a href="#">
              <span class="product">Kumar</span>
            </a>
            <span class="price">1234923414</span>
          </li><hr>
          <div class="subtitle">Lab Technicians</div>
          <li>
            <a href="#">
              <span class="product">Monika</span>
            </a>
            <span class="price">1234123672</span>
          </li>
          <li>
            <a href="#">
              <span class="product">Priya</span>
            </a>
            <span class="price">1234123415</span>
          </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="home-content" id="Guidelines" style="display: none;">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Guidelines</div><hr>
          <ol type="1" style="margin-left:5%;text-align: justify;">
            <li> Everyone 2 years or older who is not fully vaccinated should wear a mask in indoor public places.</li>
            <li> People who have a condition or are taking medications that weaken their immune system may not be fully protected even if they are fully vaccinated. They should continue to take all precautions recommended for unvaccinated people, including wearing a well-fitted mask, until advised otherwise by their healthcare provider.</li>
            <li> Avoid close contact with people who are sick. If possible, maintain 6 feet between the person who is sick and other household members.</li>
            <li> Avoid crowds and poorly ventilated spaces</li>
            <li> Wash your hands often with soap and water for at least 20 seconds especially after you have been in a public place, or after blowing your nose, coughing, or sneezing.</li>
            <li> Clean high touch surfaces regularly or as needed and after you have visitors in your home. This includes tables, doorknobs, light switches, countertops, handles, desks, phones, keyboards, toilets, faucets, and sinks.</li>
            <li> Monitoring symptoms is especially important if you are running errands, going into the office or workplace, and in settings where it may be difficult to keep a physical distance of 6 feet.</li>
          </ol>
        </div>
        </div>
      </div>



    <div class="home-content" id="report" style="display: none;">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Test Reports
            <a id="drop1" class="bx bxs-right-arrow" href="#" onclick="dropdown1();"></a>
          </div>
          <hr>
          <div id="test-report" class="sales-details" style="display:none;">
          <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> ID </td>
                  <td> Visitor Name </td>
                  <td> Gender </td>
                  <td> Result </td>
                  <td> Test Date </td>
              </tr>
              
              <?php 
                      $query = "SELECT * FROM users, samples_collected where User_Id=Visitor_Id";
                      $result = mysqli_query($link,$query);     
                      while($row=mysqli_fetch_array($result))
                      {
              ?>
                      <tr>
                          <td width="20%"><?php echo $row['User_Id']; ?></td>
                          <td width="20%"><?php echo $row['Name']; ?></td>
                          <td width="20%"><?php echo $row['Gender']; ?></td>
                          <td width="20%"><?php echo $row['Result']; ?></td>
                          <td width="20%"><?php echo $row['Test_Date']; ?></td>
                      </tr>          
              <?php 
                      }  
              ?>                                                                    
                     
              <br>
          </table>
          </div>

          <div class="title">Migrant Reports
            <a id="drop3" class="bx bxs-right-arrow" href="#" onclick="dropdown3();"></a>
          </div>
          <hr>
          <div id="migrant-report" class="sales-details" style="display:none;">

          <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> ID </td>
                  <td> Migrant Name </td>
                  <td> Gender </td>
                  <td> Origin </td>
                  <td> Destination </td>
              </tr>
              
              <?php 
                      $query2 = " select * from migrant_details,users where Migrant_Id=user_id ";
                      $result2 = mysqli_query($link,$query2);     
                      while($row=mysqli_fetch_array($result2))
                      {
              ?>
                      <tr>
                          <td width="20%"><?php echo $row['Migrant_Id']; ?></td>
                          <td width="20%"><?php echo $row['Name']; ?></td>
                          <td width="20%"><?php echo $row['Gender']; ?></td>
                          <td width="20%"><?php echo $row['Current_City']; ?></td>
                          <td width="20%"><?php echo $row['Next_City']; ?></td>
                      </tr>        
              <?php 
                      }  
              ?>                                                                    
                     
              <br>
          </table>
          </div>          

          <div class="title">Patient Reports
            <a id="drop2" class="bx bxs-right-arrow" href="#" onclick="dropdown2();"></a>
          </div>
          <hr>
          <div id="patient-report" class="sales-details" style="display:none;">
          <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> ID </td>
                  <td> Patient Name </td>
                  <td> Gender</td>
                  <td> Status </td>
              </tr>
              
              <?php 
                      $query1 = " select * from patients, users where user_id=Patient_Id;";
                      $result1 = mysqli_query($link,$query1);     
                      while($row=mysqli_fetch_array($result1))
                      {
              ?>
                      <tr>
                          <td width=25%><?php echo $row['Patient_Id']; ?></td>
                          <td width=25%><?php echo $row['patient_name']; ?></td>
                          <td width=25%><?php echo $row['Gender']; ?></td>
                          <td width=25%><?php echo $row['Status']; ?></td>
                      </tr>         
              <?php 
                      }  
              ?>                                                                    
                     
              <br>
          </table>
          </div>


          <div class="title">Critical Case Reports
            <a id="drop4" class="bx bxs-right-arrow" href="#" onclick="dropdown4();"></a>
          </div>
          <hr>
          <div id="critical-report" class="sales-details" style="display:none;">

          <table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> ID </td>
                  <td> Patient Name </td>
                  <td> Gender </td>
                  <td> Status </td>
              </tr>
              
              <?php 
                      $query3 = " select * from patients,users where user_id=Patient_Id and status='critical' ";
                      $result3 = mysqli_query($link,$query3);     
                      while($row=mysqli_fetch_array($result3))
                      {
              ?>
                      <tr>
                          <td width="25%"><?php echo $row['Patient_Id']; ?></td>
                          <td width="25%"><?php echo $row['patient_name']; ?></td>
                          <td width="25%"><?php echo $row['Gender']; ?></td>
                          <td width="25%"><?php echo $row['Status']; ?></td>
                          
                      </tr>        
              <?php 
                      }  
              ?>                                                                    
                     
              <br>
          </table>
          </div>    


        </div>
    </div>

    <div class="home-content" id="asset" style="display: none;">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Assets Available</div><br>
          <div class="title">Hospitals</div><hr>
          <table style="font-family: Arial, Helvetica, sans-serif; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> Asset ID </td>
                  <td> Type </td>
                  <td> Name </td>
                  <td> Vacancy </td>
              </tr>
              
              <?php 
                      $query4 = " select * from asset_availability where asset_type='hospital' ";
                      $result4 = mysqli_query($link,$query4);     
                      while($row=mysqli_fetch_array($result4))
                      {
              ?>
                      <tr>
                          <td width=25%><?php echo $row['Asset_Id']; ?></td>
                          <td width=25%><?php echo $row['Asset_Type']; ?></td>
                          <td width=25%><?php echo $row['Asset_Name']; ?></td>
                          <td width=25%><?php echo $row['Vacancy']; ?></td>                          
                      </tr>        
              <?php 
                      }  
              ?>                                                                    
                     
              
          </table><br>

          <div class="title">Testing Centers</div><hr>
          <table style="font-family: Arial, Helvetica, sans-serif; width: 100%;">
              <tr style="font-weight: bold;">
                  <td> Asset ID </td>
                  <td> Type </td>
                  <td> Name </td>
                  <td> Vacancy </td>
              </tr>
              
              <?php 
                      $query5 = " select * from asset_availability where asset_type='testingcenter' ";
                      $result5 = mysqli_query($link,$query5);     
                      while($row=mysqli_fetch_array($result5))
                      {
              ?>
                      <tr>
                          <td width=25%><?php echo $row['Asset_Id']; ?></td>
                          <td width=25%><?php echo $row['Asset_Type']; ?></td>
                          <td width=25%><?php echo $row['Asset_Name']; ?></td>
                          <td width=25%><?php echo $row['Vacancy']; ?></td>                          
                      </tr>        
              <?php 
                      }  
              ?>                                                                    
                     
              
          </table>
          
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
    </div>


    <div class="home-content" id="profile" style="display: none;">
    <form action='javascript:alert("Profile Details updated")'>
    <div class="container">
    <h1>Profile Details</h1>
    <hr>

    <label for="fname"><b>User Name</b> </label>
    <label for="lname" style="padding-left: 40%;"><b>User ID</b> </label><br>
    <input id="name" type="text" placeholder="Enter User Name" name="fname" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" required>
    <input id="name" type="text" placeholder="Enter User Id" disabled="disabled" name="fname" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>" required><br>
    
    <label for="gender"><b>Gender</b></label>
    <input type="text" placeholder="Enter Gender" disabled="disabled" name="gender" value="<?php echo htmlspecialchars($_SESSION["gender"]); ?>" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" disabled="disabled" name="psw" value="<?php echo htmlspecialchars($_SESSION["password"]); ?>" required>

    <label>
    </div>
    <div class="clearfix">
      <button type="submit" class="signupbtn">Update Profile</button>
      <button type="button" onclick="location.href= 'reset-password.php' " style="margin-left: 1vw; width: 45%; background-color:orangered;"> Reset Password</button>
    </div>
    </form>
        
    </div>
    <script type="text/javascript">
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
      }else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    </script>

  </section>
