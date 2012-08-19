<script type="text/javascript">
$(function () {
	

	var d2 = [[0, "Jul"], [1, "Aug"], [3, "Sept"], [4, "Oct"], [5, "Nov"], [6,"Dec"], [7,"Jan"], [8,"Feb"], [9,"Mar"], [10,"Apr"], [11,"May"], [12,"Jun"]];

						
	$.plot($("#placeholder"), [
	   
		{
			
			data: d2,
			bars: { show: true }
		}
	]);
});
</script>