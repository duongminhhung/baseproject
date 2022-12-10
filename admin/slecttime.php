<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if(isset($_GET['date']) and $_GET['date']!=null){
    $date = $_GET['date']; 
	$sql = " SELECT MONTH(timekepping.date) as month,Year(timekepping.date) as year, timekepping.emp_id,tblemployees.FirstName,tblemployees.LastName,tblemployees.salary,COUNT(*) as total, sum(case when ts >= '8:00:00' then 1 END) as late,
sum(case when te >= '18:00:00' then 1 END)
as ot  FROM timekepping, tblemployees where timekepping.emp_id = tblemployees.emp_id and MONTH(timekepping.date)= MONTH('$date') GROUP BY tblemployees.emp_id ";
	$result = mysqli_query($conn, $sql);

}else{
	 header('location:salary.php');

}

?>
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

	<?php  $sum =0; ?>

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
									<li class="breadcrumb-item active" aria-current="page">Staff</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 class="text-blue h4">Salary Staff</h2>
						<button style="margin-bottom: 10px;" type="button" id="export_button" class="btn btn-success btn-sm">Export</button>
						<form action="slecttime.php" method="get">
							<input type="date" id="theDate" name="date">
							<button>search</button>
						</form>
					</div>
					<div class="pb-20">
						<table id="employee_data" class="data-table table stripe hover nowrap">
							<thead>
								<tr>
								<th>ID Employee</th>
								<th>Name</th>
								<th>Month</th>
								<th>Day Work</th>
								<th>Day Late</th>
								<th>Over Time</th>
								<th>Salary</th>
								<th class="datatable-nosort"></th>

								</tr>
							</thead>
							<tbody>
								
								<?php foreach ($result as $item) { ?>
									<tr>
									<td><?php echo $item['emp_id']?></td>
                                    <td><?php echo $item['FirstName'] .' '. $item['LastName']?></td>
									<td><?php echo $item['month'].'/'.$item['year']?></td>
									<td><?php echo $item['total']?></td>
									<td><?php echo $item['late']?></td>
									<td><?php if($item['ot']!=null){
										echo $item['late'];
									}else{
										echo 0;
									}?></td>
                                    <td><?php 
									$sum+=$item['total']*$item['salary']- $item['late']*0.5 + $item['ot']*0.5;
									// echo $sum;
									// die();
									echo $item['total']*$item['salary']- $item['late']*0.5 + $item['ot']*0.5?>$</td>
                                    <td></td>
									</tr>
								<?php } ?>
							</tbody>
							<tr> <td></td>
							<td></td>
							<td></td><td></td><td></td><td></td>
								<td>Total: <?php  echo $sum?>$</td>
							</tr>
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
