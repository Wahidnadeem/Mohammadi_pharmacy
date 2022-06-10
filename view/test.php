<!DOCTYPE html>
<html>
	

	<head>
  <link rel="stylesheet" href="../assets/dist/css/persian-datepicker.min.css"/>
  <script src="../assets/dist/js/jquery.js" ></script>
  <script src="../assets/dist/js/persian-date.min.js"></script>
  <script src="../assets/dist/js/persian-datepicker.min.js"></script>
</head>
<body>
<input type="text" class="pedate" />

<script type="text/javascript">
	$(document).ready(function() {
  $(".pedate").pDatepicker({
    initialValueType: "gregorian",
    format: "YYYY/MM/DD",
    onSelect: "year"
  });
});

</script>

</body>
</html>