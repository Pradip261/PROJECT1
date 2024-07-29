<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <style>
      h1{
          display: inline-block;
          color: white;
          padding-left: 10px;
          position: relative;
          bottom: 30px;
          font-weight: 900;
          font-size: 45px;
      }
      .header{
          display: flex;
          background: blue;
          position: fixed;
          top:0;
          left:0;
          width: 100%;
          height: 55px;
          padding: 0px 10px 10px 50px;
      }
      .navigation {
          position: absolute;
          left: 600px;
          right: 80px;
          display: flex;
          justify-content: space-between;
          padding: 5px ;
          margin: 10px 50px 0 0;
      }
      .navigation a{
          color: white;
          padding: 5px;
          text-decoration: none;
          font-size: 20px;
          font-weight: 600;
          border: none;
      }
      .navigation button{
          width: 100px;
          height: 35px;
          background-color: transparent;
          color: white;
          font-size: 20px;
          font-weight: 600;
          border: 2px solid white;
          border-radius: 5px;
      }
      .navigation button:hover{
          background-color: white;
          color: black;
      }
      .navigation a:hover{
          text-decoration: underline;
          color: red;
      }
      .navigation a:visited{
         border: 2px solid yellow;
      }
      .main{
        position: relative;
        top: 60px;
      }
    </style>
    
</head>
<body>
    <div class="header">
        <h1>Index</h1>
        <div class="navigation">
        <?php
        error_reporting(0);
        $url="localhost";
        $username="root";
        $password="";
        $conn=mysqli_connect($url,$username,$password,'pradip');
        if(!$conn){
            die("could not perform the query".mysqli_error());
        }
        ?>
        <a href="index6.php?action=home">Home</a>
        <a href="index6.php?action=logup">LogUp</a>
        <a href="index6.php?action=contact">Contact</a>
        <a href="index6.php?action=database">Database</a>
        <button>login</button>
        </div>
    </div>
    <div class="main">
        <?php 
        if($_REQUEST['action']=='home'){
        echo "hii";
        }
        if($_REQUEST['action']=='logup'){?>
           <div class="wrapper_logup">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="line_log_up"><label>Name:</label>
				<input type="text" name="Name" id="Name" class="form_control" required>
			</div>
			<div class="line_log_up"><label>E-mail:</label>
				<input type="email" name="Email" id="Email" class="form_control" required style="text-transform: lowercase;">
			</div>
			<div class="line_log_up"><label>Password:</label>
				<input type="Password" name="Password" id="Password" class="form_control" required>
			</div>
			<div class="line_log_up"><label>Phone Number:</label>
				<input type="Number" name="Phone_number" id="Phone_number" class="form_control" required>
			</div>
			<div class="line_log_up"><label id="add_lable">Address:</label>
				<textarea name="Address" id="Address" class="form_control" required></textarea>
			</div>
			<div class="line_log_up" id="kom">
				<label>GENDER:</label><input type="radio" name="gender" class="form_control_gender" id="g1" value="male"><span>Male</span>
						<input type="radio" name="gender" class="form_control_gender" id="g2" value="female"><span>Female</span>
			</div>
			<div class="line_log_up" id="kom">
				<label>SKILL:</label><input type="checkbox" name="skill[]" class="form_control" id="skill" value="C"><span>C</span>
						<input type="checkbox" name="skill[]" class="form_control" id="skill" value="C++"><span>C++</span>
						<input type="checkbox" name="skill[]" class="form_control" id="skill" value="PHP"><span>PHP</span>
						<input type="checkbox" name="skill[]" class="form_control" id="skill" value="others"><span>others</span>
			</div>
			<div class="line_log_up">
				<label>CITY:</label><select name="city" class="form_control" id="city">
						<option value="kolkata">KOLKATA</option>
						<option value="mumbai">MUMBAI</option>
						<option value="bengaluru">BENGALURU</option>
					</select>
			</div>
			<div class="line_log_up">
				<label>File Upload:</label><input type="file" name="file" id="file" class="form_control" required>
			</div>
			<button type="submit" name="submit" class="btn">Sign Up</button>
		</form>
</div>   <?php
        if($_REQUEST['submit']){
            echo "hi";
            error_reporting(0);
            include('dbc.php'); 
            $name=$_POST["Name"];
            $email=$_POST["Email"];
            $password=$_POST["Password"];
            //$pass=$password;
            $p_num=$_POST["Phone_number"];
            $adr=$_POST["Address"];
            $gen=$_POST["gender"];
            
            $skill=$_POST["skill"];
            $str=implode(',', $skill);
            $city=$_POST["city"];
            
            $nm=$_FILES['file']['Name'];
            $fol=time()."-".rand(0,99)."-".$nm;
            $path="upload/".$fol;
            $temp=$_FILES['file']['tmp_name'];
            move_uploaded_file($temp, $path);
            $role="user";
            
            $qr=mysqli_query($conn,"SELECT * from reg where Email='$email'");
            $qrr=mysqli_query($conn,"SELECT * from reg where Phone_number='$p_num'");
            
            if(mysqli_fetch_array($qr)){
                echo "Email Already Exist.";
            }
            elseif(mysqli_fetch_array($qrr)){
                echo "Phone Number Already Exist.";
            }
            else{
                $query="INSERT INTO reg(id, Name, Email, Phone_number, Password, Adress,Gender,Skill,City,file,role) VALUES('','$name','$email','$p_num','$password','$adr','$gen','$str','$city','$path','$role')";           
                $sql=mysqli_query($conn, $query) or die("Could Not Perform the query");
                header("location:index6.php?action=home");
                echo"<script>alert('insert successfull')</script>";
            }
        }
    }
        if($_REQUEST['action']=='contact'){
            echo "hello bell";
        }
        if($_REQUEST['action']=='database'){
            echo "hello tell me.";
        }
        ?> 
    </div>
</body>
</html>