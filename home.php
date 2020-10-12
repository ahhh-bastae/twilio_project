<?php
session_start();
if(!isset($_SESSION['welcomeID'])){
    header('location:login.php');
}

?>
<html>

<head>
<title>Home Page</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="homestyle.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
    <body>
        <a class="float-right logout" href="logout.php">LOGOUT </a>
        <h1>Welcome ID Number: <?php echo $_SESSION['welcomeID']; ?>  </h1>

            <div class="container" id="mainCont">
                <div class="tableCont">
                <h3>Contacts</h3>
                    <table>
                        <tr>
                            <th>ID Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Program</th>
                            <th>Action</th>
                        </tr>
                        <?php 

                            $con = mysqli_connect('localhost','root','');

                            mysqli_select_db($con, 'twilio_sms');    

                            $s = "select idNum, firstName, lastName, phoneNum, program from usertable";
                            $result = $con-> query($s);

                            

                            if($result-> num_rows > 0){
                                while($row = $result-> fetch_assoc()){
                                    echo "<tr><td>".$row["idNum"] ."</td><td>".$row["firstName"] ."</td><td>".$row["lastName"]
                                    ."</td><td>".$row["phoneNum"]."</td><td>". $row["program"]."</td><td>"."<button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#msgModal'>SMS</button> <button type='button' class='btn btn-secondary'>History</button>" ."</td></tr>";
                                }
                                echo"</table>";
                            }
                            else{
                                echo "0 result";
                            }
                            $con-> close();   
                        ?>
                    </table>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendToMany">Send Group</button>
                </div>
            </div>   
                            
            <div class="modal fade" role="dialog" id="msgModal" tabindex="-1">
                <div class="modal-dialog" id="modalSMS" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <form action="process.php" method="POST">

                                    <h3 class="modal-title">Send SMS</h3>
                                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                        </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="indivMsg">Phone Number</label>
                                        <input type="text" id="number" name="number" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userSMS">Type your message here</label>
                                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="type here"></textarea>
                                </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Send</button>
                                </div>
                            </form>
                        

                    </div>               
                </div>
            
            </div>



            <div class="modal fade" role="dialog" id="sendToMany" tabindex="-1">
                <div class="modal-dialog" id="modalSMS" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <form action="process.php" method="POST">
                                <h3 class="modal-title">Send SMS</h3>
                                <button class="close" type="button" data-dismiss="modal">&times;</button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="groupProg">Enter Program</label>
                                    <input type="text" name="groupProg" class="form-control" placeholder="Enter Course" required>
                                </div>
                                <div class="form-group">
                                    <label for="userSMS">Type your message here</label>
                                    <textarea class="form-control" id="userSMS" rows="3" placeholder="type here"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </form>
                        

                    </div>               
                </div>
            
            </div>




            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>                    
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    </body>
</html>