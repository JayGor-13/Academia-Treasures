<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit();
}
$email = $_SESSION['email'];
require_once('display-user-info.php');
$query = "select * from registration where email='$email'";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error: " . mysqli_error($con);
    exit();
}

$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Macondo+Swash+Caps&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <title>User Profile</title>
    <style>
        .logout-btn {
    background-color: #f44336;
    color: white;
    margin-bottom: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.logout-btn:hover {
    background-color: #d32f2f;
}
* {
margin: 0;
padding: 1px 2px 0px 1px;
font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
border: border-box;
}

/* Navigation Bar */
.navbar{
height: 110px;
background-color: #FFFFFF;
color: black;
box-sizing: border-box;
display: flex;
align-items: center;
padding: 10px;
border-bottom: 2px solid black;
}

.nav-logo{
height: 80px;
width: 270px;
padding-bottom: 2px;
flex: 2;
}

.logo{
width: 270px;
height: 70%;
padding: 12.525px 0px;
}

nav{
flex: 3;
text-align: right;
}

nav ul{
display: inline-block;
list-style-type: none;
}

nav ul li{
display: inline-block;
margin-right: 70px;
}

a{
padding-bottom: 7px;
text-decoration: none;
color: #555;
font-size: larger;
}
a:hover{
border-bottom: 3px #1a4ad8 solid ;
}

.user-logo a:hover {
border-bottom: none;
}

.dropbtn {
background-color: transparent;
color: #555;
font-size: larger;
padding: 16px;
font-size: 16px;
border: none;
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f1f1f1;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
font-size: medium;
padding: 12px 16px;
text-decoration: none;
display: block;
text-align: left;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

/* ---- */ 

.user-profile-container{
    margin: 10px 10px 0px ;
    font-family: "Roboto+Slab" , "sans-serif";
}

.user-name{
    box-sizing: border-box;
    border-radius: 7px;
    background-color: rgb(234, 232, 232);
    padding-top: 30px;
    padding-left: 20px;
    height: 95px;
    font-size: larger;
}
.user-name p{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    margin-top: 10px;
    font-size: 15px;
    color: #454545;
    font-weight: 700;
}
.contact-details{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    margin-top: 10px;
    box-sizing: border-box;
    border: 1px solid #afafaf;
    border-radius: 7px;
    padding-top: 25px;
    padding-left: 20px;
    padding-bottom: 12px;
}

.contact-details h3{
    font-family: "Amazon Ember", Arial, sans-serif;
    font-size: 18px;
    font-weight: 700;
}

.contact-details h4{
    font-family: "Amazon Ember", Arial, sans-serif;
    padding-top: 20px;
    font-size: 14px;
    line-height: 20px;
}
.contact-details p{
    font-family: Arial, sans-serif;
    padding-top: 7px;
    font-size: 14px;
    color: #565959;
}

.more-info{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    margin-top: 10px;
    box-sizing: border-box;
    border: 1px solid #afafaf;
    border-radius: 7px;
    padding-top: 25px;
    padding-left: 20px;
    padding-bottom: 12px;
}

.more-info h3{
    font-family: "Amazon Ember", Arial, sans-serif;
    font-size: 18px;
    font-weight: 700;
}

.more-info h4{
    font-family: "Amazon Ember", Arial, sans-serif;
    padding-top: 20px;
    font-size: 14px;
    line-height: 20px;
}
.more-info p{
    font-family: Arial, sans-serif;
    padding-top: 7px;
    font-size: 14px;
    color: #565959;
}
    </style>
</head>
<body>
<div class="navbar">
    <div class="nav-logo">
        <img class="logo" src="images\academia-treasures-high-resolution-logo-transparent.png">
    </div>
    <nav>
        <ul>
            <li><a href="main.html">Home</a></li>
            <li>
                <div class="dropdown">
                    <a>Product</a>
                    <div class="dropdown-content">
                        <a href="material.html">Material</a>
                        <a href="draftingtools.html">Drafting Tools</a>
                        <a href="other.html">Other</a>
                    </div>
                </div>
            </li>
            <li><a href="">About</a></li>
            <li><a href="">Contact</a></li>
            <li class="user-logo"><a href="profile.php"><i class="fas fa-user" style="color: #555;"></i></a></li>
        </ul>
    </nav>
</div>
    <div class="user-profile-container">
        <h1 align="center">Your Profile</h1>
        <div class="user-name">
            <h3><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h3>
            <p>Account holder</p>
        </div>
        <div class="contact-details">
            <h3>Contact Details</h3>
            <h4>Mobile number</h4>
            <p><?php echo $row['number'];?></p>
            <h4>E-mail</h4>
            <p><?php echo $row['email'];?></p>
        </div>
        <div class="more-info">
            <h3>More Information</h3>
            <h4>College Name</h4>
            <p><?php echo $row['collegeName'];?></p>
        </div>
    </div>
    <?php
    mysqli_close($con);
    ?>
    <br>
    <div align="center">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn" name="logout">Logout</button>
            </form>
        <?php } ?>
    </div>
</body></html>