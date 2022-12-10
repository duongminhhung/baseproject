<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>ACI Leave System</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->

    <!-- jQuery UI Signature core CSS -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="../assets/css/jquery.signature.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>

    <link href="../src/css/jquery.signature.css" rel="stylesheet">
    <script src="../src/js/jquery.signature.js"></script>
  
    <style>
        .kbw-signature { width: 100%; height: 100px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
  
</head>

<?php include('../includes/config.php'); ?>
<?php include('../includes/session.php');?>

<?php 
    if(isset($_POST['upload']))
    {
        $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
        $row = mysqli_fetch_assoc($query);

        $firstname = $row['FirstName'];

        $cut = substr($firstname, 1, 2);

         $folderPath = "../signature/";
  
        $image_parts = explode(";base64,", $_POST['signed']);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);
          
        $file = $folderPath ."sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
          
        file_put_contents($file, $image_base64);

        $signature ="sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;

        $result = mysqli_query($conn,"update tblemployees set signature='$signature' where emp_id='$session_id'         
        ")or die(mysqli_error());
        if ($result) {
        echo "<script>alert('Signature Inserted successfully');</script>";
        } else{
          die(mysqli_error());
       }

}

?>

<?php
  $connect = mysqli_connect('localhost:3306', 'root', '', 'aci_leave');
	if(isset($_POST['apply'])){
        $today= date("Y-m-d");
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        
       $now = date("H:i:s");
        $sql = "select * from timekepping where date = '$today'";
        $result = mysqli_query($connect,$sql);
     
        $row = mysqli_num_rows($result);
       
        if($row==0){
           $sql = "INSERT INTO timekepping (id, emp_id, date, ts, te) VALUES (NULL, '$session_id', '$today', '$now', NULL)";
            $result = mysqli_query($connect,$sql);
            echo "<script>alert('you have started timekeeping');</script>";
        }else{
            
            echo "<script>alert('you have started timekeeping today, please come back tomorrow');</script>";
        }
        
    }
    if(isset($_POST['end'])){
        $today= date("Y-m-d");
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now = date("H:i:s");
        $sql = "select * from timekepping where date = '$today'"; $result = mysqli_query($connect,$sql);
        $fect = mysqli_fetch_array($result);
        $id = $fect['id'];
        $row = mysqli_num_rows($result);
        if($row==1){
            $sql = "UPDATE timekepping SET te = '$now' WHERE id = '$id'";
             $result = mysqli_query($connect,$sql);
             echo "<script>alert('you have finished the timekeeping');</script>";
         }else{
             echo "<script>alert('you have not started timekeeping, start timekeeping today');</script>";
         }
        
    }
	


?>

<body>
    
    
    <?php include('includes/navbar.php')?>

    <?php include('includes/right_sidebar.php')?>

    <?php include('includes/left_sidebar.php')?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Timekeeping</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Timekeeping</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 </div>
                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Staff Form</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">
                            <section>

                                <?php if ($role_id = 'Staff'): ?>
                                <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
                                    $row = mysqli_fetch_array($query);
                                ?>
                        
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >First Name </label>
                                            <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >Last Name </label>
                                            <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input name="postion" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Position_Staff']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Staff ID Number </label>
                                            <input name="staff_id" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Staff_ID']; ?>">
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Start&nbsp;Timekeeping</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-primary" name="end" id="end" data-toggle="modal">End&nbsp;Timekeeping</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                <!-- <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Approved outstanding from previous year(State days)</label>
                                            <input name="approved_outstanding" type="text" class="form-control" required="true" autocomplete="off" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Leave Entitlement </label>
                                            <input name="leave_entitled" type="text" class="form-control" required="true" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>  -->
                               
                                
                               
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

<script>
    const picker = document.getElementById('date_form');
    picker.addEventListener('input', function(e){
    var day = new Date(this.value).getUTCDay();
    if([6,0].includes(day)){
      e.preventDefault();
      this.value = '';
      alert('Weekends not allowed');
    } else {
        calc();
    }
   });

   const pickers = document.getElementById('date_to');
    pickers.addEventListener('input', function(e){
    var day = new Date(this.value).getUTCDay();
    if([6,0].includes(day)){
      e.preventDefault();
      this.value = '';
      alert('Weekends not allowed');
    }else {
        calc();
    }
   });

    // function calc_days(){
    //     const date_to = document.getElementById('date_to');
    //     const date_from = document.getElementById('date_form');
	// 	var days = 0;
	// 	if(date_to.value != ''){
	// 		var start = new Date(date_from.value);
	// 		var end = new Date(date_to.value);
	// 		var diffDate = (end - start) / (1000 * 60 * 60 * 24);
	// 		days = Math.round(diffDate);
    //        var work = document.getElementById("requested_days");
    //        work.value = days + 1;
	// 	}

	// }

    function calc() {
      const date_to = document.getElementById('date_to');
      const date_from = document.getElementById('date_form');
      result = getBusinessDateCount(new Date(date_from.value), new Date(date_to.value));
      var work = document.getElementById("requested_days");
      work.value = result;
}

    function getBusinessDateCount(startDate, endDate) {
        var elapsed, daysBeforeFirstSaturday, daysAfterLastSunday;
        var ifThen = function(a, b, c) {
            return a == b ? c : a;
        };

        elapsed = endDate - startDate;
        elapsed /= 86400000;

        daysBeforeFirstSunday = (7 - startDate.getDay()) % 7;
        daysAfterLastSunday = endDate.getDay();

        elapsed -= (daysBeforeFirstSunday + daysAfterLastSunday);
        elapsed = (elapsed / 7) * 5;
        elapsed += ifThen(daysBeforeFirstSunday - 1, -1, 0) + ifThen(daysAfterLastSunday, 6, 5);

        return Math.ceil(elapsed);
     }

    // function func(){
    //     var dropdown = document.getElementById("leave_type");
    //     var selection = dropdown.value;
    //     console.log(selection);
    //     var emailTextBox = document.getElementById("work_cover");
    //     // assign the email address here based on your need.
    //     emailTextBox.value = selection;
    //   }
</script>

    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
  
</body>
</html>