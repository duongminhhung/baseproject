<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblemployees where emp_id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Staff deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
		
	}
}

?>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today= date("Y-m-d");
	
$now = date("H:i:s");

$sql = "select * from timekepping, tblemployees where timekepping.emp_id = tblemployees.emp_id and date ='$today'";
// die($sql);
                                $result = mysqli_query($conn,$sql);
                                  ?>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

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
                                <h4>Leave Type List</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Signature Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 </div>
                 <div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">ALL Timekeeping Today</h2>
						<!-- <form action="slecttime.php" method="get">
							<input type="text" name="search">
							<input type="date" id="theDate" name="date">
							<button>search</button>
						</form> -->
					</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th>ID Employee</th>
								<th>Name</th>
								<th>Date</th>
								<th>Start</th>
								<th>End</th>
								<th>Status</th>
								<th class="datatable-nosort"></th>
								
							</tr>
						</thead>
						<tbody>
                                <?php foreach ($result as $item) {?>
                                    <tr>
                                    <td><?php echo $item['emp_id']?></td>
                                    <td><?php echo $item['FirstName'] .' '. $item['LastName']?></td>
                                    <td><?php
                                    $date=date_create($item['date']);
                                    echo date_format($date,"d/m/Y ");?></td>
                                    <td><?php echo $item['ts']?></td>
                                    <td><?php echo $item['te']?></td>
									<td><?php 
										$time_from = strtotime("8:00:00");
										$time_to = strtotime($item['ts']);
										if ($time_from > $time_to) {
												echo "Punctually";
												
											}else{
												echo "Late";}

												?></td>
                                    <td></td>
                                    </tr>
                              <?php }?>
						</tbody>
					</table>
			   </div>
			</div>
            </div>
        </div>
    </div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>