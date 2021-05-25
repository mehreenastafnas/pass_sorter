<!DOCTYPE html>
<html>
<head>
	<title>Pass Sorter</title>
<style>
	.dash_cus{
		margin-top:2%;
		background:#ebeff2;
		padding:50px 0px;
		height:90vh;
	}
	.pass_info{
		background:#fff;
		padding:20px 0px;
		box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
		overflow:hidden;
	}
	.pass_info h2 {
		font-size: 24px;
		margin-top: 0;
		font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
		padding-bottom: 5px;
		border-bottom: 1px solid #ebeff2;
	}
	input.form-control.cus_input:focus {
		box-shadow: none;
	}

	input.form-control.cus_input {
		border-radius: 0;
		/* border-color: rebeccapurple; */
	}
	label.col-md-3.col-form-label {
		font-size: 16px;
		font-weight: 400;
		font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
	}
	.form-control.cus_input_btn {
		background: #008400;
		color: #fff;
		border-radius: 0;
		border-color: #008400;
		font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
	}
	.form-control.cus_input_btn:hover{
		box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	} 
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>	
</head>
<body>


<div class="container-fluid dash_cus"> 
	<div class="container">
		<div class="row">
			<h2>Pass Sorter</h2>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="pass_info">
					<div class="col-md-12">
						<h2>Boarding Passes Form</h2>
					</div>
					<div class="col-sm-12">
						<form id="data" action="sorting.php" enctype="multipart/form-data" >
							<div class="form-group row">
								<label for="json_text" class="col-md-3 col-form-label">Enter JSON array</label>
								<div class="col-md-9">
									<textarea class="form-control cus_input" rows="20" id="json_text" name="json_text"></textarea>
								</div>
							</div>
							<hr/>
							<div class="form-group row">
								<label class="col-md-3 col-form-label"></label>
								<div class="col-md-9">
									<button class="form-control cus_input_btn">Submit</button>
								</div>
							</div>
						
						</form>
					</div>
				</div>		
			</div>
			<div class="col-md-6">
				<div class="pass_info">
					<div class="col-sm-12">
						<h2>Boarding Information Response: </h2>
					</div>
					<div class="col-md-12">
						<div id="response_here">
						</div>
					</div>
				</div>	
			</div>	
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
$("form#data").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	 $('#response_here').html('');
    $.ajax({
        url: 'sorting.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            $('#response_here').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
</body>
</html>