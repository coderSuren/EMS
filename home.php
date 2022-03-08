<?php 
  include("config.php");
  session_start();

  if (isset($_SESSION["loggedin"])){

    if ($_SESSION["admin"]== true){
        header("location: admin.php");
        exit;
    }
    else if ($_SESSION["admin"]== false){
        header("location: visitor.php");
        exit;
    }
  }    

  $total_cases=(mysqli_query($link, "SELECT COUNT(*) FROM PATIENTS;") ->fetch_array()[0] );
  $date=date("Y-m-d");
  $new_cases=(mysqli_query($link, "SELECT COUNT('Visitor_Id') FROM samples_collected where Test_Date='".$date."' and Result='Positive'; ") ->fetch_array()[0] );
  $deceased=(mysqli_query($link, "SELECT count('Patient_Id') FROM patients where Status='deceased';") ->fetch_array()[0] );
  $recovered=(mysqli_query($link, "SELECT count('Patient_Id') FROM patients where Status='recovered';") ->fetch_array()[0] );
?>



<!DOCTYPE html>
  <head>
    <link rel="stylesheet" href="home.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style type="text/css">
      
    </style>
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

      <div class="Login">
      <a href="login.php" target="blank"><input type=button value='Login'></a>
      </div>

      <div class="Signup">
      <a href="signup.php" target="blank" onclick="myFunction()"><input type=button value='Signup'></a>
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
      <h1>&nbsp;&nbsp;&nbsp;Please Login to view Reports</h1>
    </div>

    <div class="home-content" id="asset" style="display: none;">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Assets Available</div>
          <div class="title">Hospitals</div><hr>
          <div class="sales-details">
          <ul class="details">
            <li class="topic">Center Name</li>
            <li><a href="#">Apollo</a></li>
            <li><a href="#">Medex</a></li>
          </ul>
          <ul class="details">
              <li class="topic">City</li>
              <li><a href="#">Chennai</a></li>
              <li><a href="#">Delhi</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Vaccancy</li>
            <li><a href="#">1</a></li>
            <li><a href="#">1</a></li>
          </ul>
          </div>

          <div class="title">Testing Centers</div><hr>
          <div class="sales-details">
          <ul class="details">
            <li class="topic">Center Name</li>
            <li><a href="#">GMC</a></li>
            <li><a href="#">KMCH</a></li>
          </ul>
          <ul class="details">
              <li class="topic">City</li>
              <li><a href="#">Mumbai</a></li>
              <li><a href="#">Chennai</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Vaccancy</li>
            <li><a href="#">1</a></li>
            <li><a href="#">1</a></li>
          </ul>
          </div>
          
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
    </div>


    <div class="home-content" id="profile" style="display: none;">
      <h1>&nbsp;&nbsp;&nbsp;Please Login to view Profile</h1>
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
</body>
</html>

