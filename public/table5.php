<?php
?>

<!doctype html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/stickybits/3.6.7/jquery.stickybits.min.js"></script> -->
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
		height:30px;
		background:#ccc;
		position:relative;
		overflow-y:scroll;
		display:none;
		/*padding-right: -17px;*/
	}
	.low_div{
		max-height:80%;
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
		border:1px solid black;
	}
	tr{
		text-align:center;
		
	}
	td{
		border:1px solid black;
	}
	</style>
</head>
<body>
	<div class="container">
		<div style="height:100px"></div>
		<div class="low_div" id="parent_fixtable">
			<table  id="fixtable" style="width:100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th width="5%"  height="30">No</th>
						<th width="10%" height="30">Date</th>
					    <th width="20%" height="30">Firstname</th>
					    <th width="20%" height="30">Lastname</th>
					    <th width="20%" height="30">Age</th>
					    <th width="35%" height="30">Emp No</th>
			  		</tr>
				</thead>
				<tbody id="tbody">
				</tbody>
			</table>
		</div>
	</div>
</body>
	<script type="text/javascript">
		// jQuery.fn.extend({
		// 	fixHeaderTable: function() {
		// 		$(this).attr({"cellpadding":"0","border":"0","cellspacing":"0"});
		// 		$(this).children("thead").children("tr").css("position","fixed");
		// 		$(this).children("tbody").children("tr").children("td").css("border","1px solid black");
		//  		var count_of_header_col = $(this).children("thead").children("tr").children("th").length;
		// 		var cols_width = [];
		// 		for(var i = 0; i < count_of_header_col; i++){
		// 			cols_width[i] = $(this).children("tbody").children("tr:nth-child(1)").children("td:nth-child("+(i+1)+")").width();
		// 			$(this).children("thead").children("tr").children("th:nth-child("+(i+1)+")").css({"width":cols_width[i],"border":"1px solid black"});
		// 		}	
  // 			}
		// });
		$.fn.extend({
			fixHeaderTable : function(){
				$(this).parent().css("overflow-y","scroll");
				$(this).css("table-layout","fixed");
				$(this).children("tbody").children("tr").children("td").css("overflow","hidden");
				var $this_name = $(this).attr("id");
				var $html ='';
				$html += '<div id="'+$this_name+'headerTableDiv"></div>';
				$($html).insertBefore($(this).parent());
				var $th_height = $(this).children("thead").children("tr").children("th").attr('height');
				$("#"+$this_name+"headerTableDiv").css({"margin":"0","padding":"0","height":$th_height+"px","background":"#ccc","position":"relative","overflow-y":"scroll"});
				$html = '';
				$html += '<table  id="'+$this_name+'headerTable" style="width:100%;position:absolute;bottom:0;left:0;" cellpadding="0" cellspacing="0"></table>';
				$("#"+$this_name+"headerTableDiv").html($html);
				$("#"+$this_name+"headerTable").css("table-layout","fixed");
				$("#"+$this_name+"headerTable").children("tbody").children("tr").children("td").css("overflow","hidden");
				var $thead = $(this).children("thead").clone();
				$(this).children("thead").children("tr").children("th").css({'height':'auto'});
				$(this).children("thead").children("tr").children("th").text("");
				$(this).children("thead").css('visibility','hidden');
				$(this).css("margin-top","-2px");
				$("#"+$this_name+"headerTable").append($thead);
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
			$("#fixtable").fixHeaderTable();
			// var element = document.getElementById("some-stickybit-parent");
			// if (element.offsetHeight < element.scrollHeight) {
			//     var thead = $("#fixtable thead").clone();
			// 	$("#fixtable thead tr th").css({'height':'auto'});
			// 	$("#fixtable thead tr th").text('');
			// 	$("#fixtable thead").css('visibility','hidden');
			// 	$('#fixtable').css('margin-top','-2px');
			// 	$("#headertable").append(thead);
			// 	$("#up_div").show();
			// }
			
			// var count_of_header_col = $('#fixtable thead tr th').length;
			// var cols_width = [];
			// for(var i = 0; i < count_of_header_col; i++){
			// 	cols_width[i] = $('#fixtable tbody tr:nth-child(1) td:nth-child('+(i+1)+')').width();
			// 	$('#fixtable thead tr th:nth-child('+(i+1)+')').css({'width':cols_width[i]});
			// }
			// $("#fixtable").fixHeaderTable();
			// $(window).resize(function(){
			// 	$("#fixtable").fixHeaderTable();
			// })
			// $(window).scroll(function(){
			// 	var top = $("#fixtable").children("thead").children("tr").offset().top;
			// 	alert(top);
			// 	$("#fixtable").children("thead").children("tr").css({"position":"absolute","top":"0"});
			// })
			// $("#some-stickybit-parent").scroll(function(){
			// 	$("#fixtable").children("thead").children("tr").css({"position":"fixed"});
			// })
			// $('th').stickybits();
		});
	</script>
</html>