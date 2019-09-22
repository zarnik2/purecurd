<?php
?>

<!doctype html>
<head>
	<script src="js/jquery-3.4.1.min.js"></script>
	<style>
	html,body{
		height:100vh;
		width:100vw;
		margin:0;
  		padding:0;
		/*overflow:hidden;*/
	}
	.container{
		height:100%;
		width:80%;
		top:0;
		padding:0 10% 0 10%;

	}
	.up_div,.low_div{
		width:100%;
		border:0 solid black;
	}
	.up_div{
		margin:0;
  		padding:0;
		height:20%;
		background:#ccc;
		display:table;
	}
	.low_div{
		height:80%;
		background:#dfdfdf;
		overflow-y:auto;
	}
	h3 {
		display:table-cell;
   		margin-top: 0;
   		text-align:center;
   		vertical-align:middle;
	}
	th{
		background:green;
		color:white;
	}
	tr{
		text-align:center;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="up_div">
			<h3>This is Upper DIV</h3>
		</div>
		<div class="low_div">
			<table  id="fixtable" style="width:100%">
				<thead>
					<tr>
						<th height="30">No</th>
						<th height="30">Date</th>
					    <th height="30">Firstname</th>
					    <th height="30">Lastname</th>
					    <th height="30">Age</th>
					    <th height="30">Emp No</th>

			  		</tr>
				</thead>
				<tbody id="tbody">
					<tr>
						<td width="5%" height="30"></td>
						<td width="10%" height="30"></td>
						<td width="20%" height="30"></td>
					    <td width="20%" height="30"></td>
					    <td width="20%" height="30"></td>
					    <td width="35%" height="30"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
	<script type="text/javascript">
		jQuery.fn.extend({
			fixHeaderTable: function() {
				$(this).attr({"cellpadding":"0","border":"0","cellspacing":"0"});
				$(this).children("thead").children("tr").css("position","fixed");
				$(this).children("tbody").children("tr").children("td").css("border","1px solid black");
		 		var count_of_header_col = $(this).children("thead").children("tr").children("th").length;
				var cols_width = [];
				for(var i = 0; i < count_of_header_col; i++){
					cols_width[i] = $(this).children("tbody").children("tr:nth-child(1)").children("td:nth-child("+(i+1)+")").width();
					$(this).children("thead").children("tr").children("th:nth-child("+(i+1)+")").css({"width":cols_width[i],"border":"1px solid black"});
				}	
  			}
		});
		$(document).ready(function(){
			var html = '';
				for(var i=0;i<100;i++){
					html += '<tr>';
					html += '<td height="23">'+(i+1)+'</td>';
					html += '<td height="23">27-12-1994</td>';
					html += '<td height="23">Jill Smith</td>';
					html += '<td height="23">Smith</td>';
					html += '<td height="23">50</td>';
					html += '<td height="23">E-00'+(i+1)+'</td>';
					html += '</tr>';
				}
			$('#tbody').append(html);
			// var count_of_header_col = $('#fixtable thead tr th').length;
			// var cols_width = [];
			// for(var i = 0; i < count_of_header_col; i++){
			// 	cols_width[i] = $('#fixtable tbody tr:nth-child(1) td:nth-child('+(i+1)+')').width();
			// 	$('#fixtable thead tr th:nth-child('+(i+1)+')').css({'width':cols_width[i]});
			// }
			$("#fixtable").fixHeaderTable();
			$(window).resize(function(){
				$("#fixtable").fixHeaderTable();
			})

		});
	</script>
</html>