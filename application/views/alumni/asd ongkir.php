<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cosume API Raja Ongkir Codeigniter</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
				  <div class="panel-heading">
						<h3 class="panel-title">Check Delivery Payment</h3>
					</div>
				  <div class="panel-body">

						<div class="form-group">
							<label for="from_province">From Province </label>
							<select class="form-control" name="from_province" id="from_province">
								<option value="" selected="" disabled="">- Select Province -</option>
								<?php $this->load->view('rajaongkir/getProvince2'); ?>
							</select>
						</div>

						<div class="form-group">
							<label for="from_city">From City </label>
							<select class="form-control" name="from_city" id="origin">
								<option value="" selected="" disabled="">- Select City -</option>
							</select>
						</div>

						<div class="form-group">
							<label for="to_province">To Province </label>
							<select class="form-control" name="to_province" id="to_province">
								<option value="" selected="" disabled="">- Select Province -</option>
								<?php $this->load->view('rajaongkir/getProvince'); ?>
							</select>
						</div>

						<div class="form-group">
							<label for="to_city">To City </label>
							<select class="form-control" name="destination" id="destination">
								<option value="" selected="" disabled="">- Select City -</option>
							</select>
					  </div>

						<div class="form-group">
							<label for="courier">Courier </label>
							<select class="form-control" name="courier" id="courier">
								<option value="">- Select Courier -</option>
								<option value="jne">JNE</option>
								<option value="pos">POS</option>
								<option value="tiki">TIKI</option>
							</select>
						</div>

						<div class="form-group">
							<label for="weight">Weight (gram)</label>
							<input type="text" class="form-control" name="weight" id="weight" value="100">
						</div>

						<div class="form-group">
					    <a type="button" onclick="tampil_data('data')" class="btn btn-success">Check In</a>
						</div>
				  </div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Delivery Payment List</h3>
					</div>
					<div class="panel-body">
						<div id="hasil"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-warning">
				  <div class="panel-heading">
				    <h3 class="panel-title">Cek Resi</h3>
				  </div>
				  <div class="panel-body">
				  	<input type="text" name="no_resi" placeholder="No Resi" id="no_resi" class="form-control">
					<br>
				    <button type="button" onclick="tampil_resi('data')" class="btn btn-info">Cek Resi</button>

				  </div>
				</div>
				<script>
					function tampil_resi(act){
					      var resi = $('#no_resi').val();

					      if(resi == ""){
					      	alert("harap isi data dengan lengkap");
					      }else{
					      	$.ajax({
					          url: "rajaongkir/getResi",
					          type: "GET",
					          data : {waybill: resi},
					          success: function (ajaxData){
					              //$('#tombol_export').show();
					              //$('#hasilReport').show();
					              $("#hasil_resi").html(ajaxData);
					          }
					      	});
					      }


					  };
				</script>
			</div>
			<div class="col-md-8">
				<div class="panel panel-success">
				  <div class="panel-heading">
				    <h3 class="panel-title">Cek Resi</h3>
				  </div>
				  <div class="panel-body">
				  	<ol>
					    <div id="hasil_resi">

					    </div>
				    </ol>
				  </div>
				</div>
			</div>

		</div>
		<footer>
			<div class="row">
				<div class="col-md-4">
					<p class="text-center">Copyright © <?php echo date('Y') ?> <a href="http://syabandz.blogspot.com/">Syabandz.Blogspot.Com</a></p>
				</div>
			</div>
		</footer>
	</div>
</div><br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
function tampil_data(act) {
	var w = $('#origin').val();
	var x = $('#destination').val();
	var y = $('#weight').val();
	var z = $('#courier').val();

	$.ajax({
			url: "rajaongkir/getCost",
			type: "GET",
			data : {origin: w, destination: x, berat: y, courier: z},
			success: function (ajaxData) {
					$("#hasil").html(ajaxData);
			}
	});
};



$(document).ready(function() {
	$("#from_province").click(function() {
		$.post("<?php echo base_url(); ?>rajaongkir/getCity/"+$('#from_province').val(),function(obj) {
			$('#origin').html(obj);
		});			
	});

	$("#to_province").click(function() {
		$.post("<?php echo base_url(); ?>rajaongkir/getCity/"+$('#to_province').val(),function(obj) {
			$('#destination').html(obj);
		});			
	});
});
</script>
</body>
</html>