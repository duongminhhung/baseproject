<?php include('includes/header.php') ?>
<?php include('../includes/session.php') ?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM tblemployees where emp_id = " . $delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Staff deleted Successfully');</script>";
		echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
	}
}

?>
<?php
$today = date("Y-m-d");
$now = date("H:i:s");

$sql = "select * from timekepping, tblemployees where timekepping.emp_id = tblemployees.emp_id";
// die($sql);
$result = mysqli_query($conn, $sql);
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
	<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
	<?php include('includes/navbar.php') ?>

	<?php include('includes/right_sidebar.php') ?>

	<?php include('includes/left_sidebar.php') ?>

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
						<h2 class="text-blue h4">ALL Timekeeping</h2>
						<button type="button" id="export_button" class="btn btn-success btn-sm">Export</button>
					</div>
					<div class="pb-20">
						<table id="employee_data" class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th scope="col">ID Employee</th>
									<th scope="col">Name</th>
									<th scope="col">Date</th>
									<th scope="col">Start</th>
									<th scope="col">End</th>
									<th scope="col">Status</th>
									<th scope="col" class="datatable-nosort"></th>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($result as $item) { ?>
									<tr>
										<td scope="row"><?php echo $item['emp_id'] ?></td>
										<td><?php echo $item['FirstName'] . ' ' . $item['LastName'] ?></td>
										<td><?php
											$date = date_create($item['date']);
											echo date_format($date, "d/m/Y "); ?></td>
										<td><?php echo $item['ts'] ?></td>
										<td><?php echo $item['te'] ?></td>
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
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script>
		function html_table_to_excel(type) {
			var data = document.getElementById('employee_data');

			var file = XLSX.utils.table_to_book(data, {
				sheet: "sheet1"
			});

			XLSX.write(file, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			});

			XLSX.writeFile(file, 'file.' + type);
		}

		const export_button = document.getElementById('export_button');

		export_button.addEventListener('click', () => {
			html_table_to_excel('xlsx');
		});
	</script>
	<?php include('includes/scripts.php') ?>

</body>

</html>