-<?php
-?>
-
-<!doctype html>
-<head>
-	<script src="js/jquery-3.4.1.min.js"></script>
-	<style>
-	html,body{
-		height:100vh;
-		width:100vw;
-		margin:0;
-  		padding:0;
-		/*overflow:hidden;*/
-	}
-	.container{
-		height:100%;
-		width:70%;
-		top:0;
-		padding:0 15% 0 15%;
-
-	}
-	.up_div{
-		width:100%;
-		margin:0;
-  		padding:0;
-		height:20%;
-		background:#ccc;
-		display:table;
-	}
-	.low_div{
-		height:70%;
-		width:100%;
-		background:#dfdfdf;
-	}
-	h3 {
-		display:table-cell;
-   		margin-top: 0;
-   		text-align:center;
-   		vertical-align:middle;
-	}
-	th{
-		background:green;
-		color:white;
-	}
-	tr{
-		text-align:center;
-	}
-	#header-fixed {
-    position: fixed;
-    top: 500px; display:none;
-    background-color:white;
-    overflow-y:auto;
-	}
-	</style>
-</head>
-<body>
-	<div class="container">
-		<div class="up_div">
-			<h3>Fixed Table Header</h3>
-		</div>
-		<div class="low_div">
-			<table style="width:100%" id="table-1" border="1" cellspacing="3" cellpadding="1">
-				<thead>
-					<tr>
-					    <th width="30%" height="30">Firstname</th>
-					    <th width="30%" height="30">Lastname</th>
-					    <th width="30%" height="30">Age</th>
-			  		</tr>
-				</thead>
-				<tbody id="tbody">
-				</tbody>
-			</table>
-		</div>
-	</div>
-</body>
-	<script type="text/javascript">
-		$(document).ready(function(){
-			$.fn.extend({
-				fixHeaderTable : function(){
-					$(this).parent().css({
-						"overflow-y":"scroll"
-					});
-					$(this).css({
-						"table-layout":"fixed"
-					});
-					$(this).children("tbody").children("tr").children("td").css({
-						"overflow":"hidden"
-					});
-					var $this_name = $(this).attr("id");
-					var $html ='';
-					$html += '<div id="'+$this_name+'headerTableDiv"></div>';
-					$($html).insertBefore($(this).parent());
-					var $th_height = $(this).children("thead").children("tr").children("th").attr('height');
-					var attributes = $(this).parent().prop("attributes");
-					$.each(attributes, function() {
-						if(this.name!="id"){
-							$("#"+$this_name+"headerTableDiv").attr(this.name, this.value);
-						}
-					});
-					$("#"+$this_name+"headerTableDiv").css(
-						{
-							"height":"auto"
-							,"display":"block"
-							,"overflow-x" : "hidden"
-							,"padding-bottom":"0"
-							,"margin-bottom":"0"
-						});
-					$(this).parent().css({
-						"padding-top":"0"
-						,"margin-top":"0"
-					});
-					$html = '';
-					$html += '<table  id="'+$this_name+'headerTable"></table>';
-					$("#"+$this_name+"headerTableDiv").html($html);
-					var attributes = $(this).prop("attributes");
-					$.each(attributes, function() {
-						if(this.name!="id"){
-							$("#"+$this_name+"headerTable").attr(this.name, this.value);
-						}
-					});
-					var $thead = $(this).children("thead").clone();
-					$("#"+$this_name+"headerTable").append($thead);
-					$(this).children("thead").children("tr").children("th").hide();
-				}
-			});
-			var html = '';
-				for(var i=0;i<20;i++){
-					html += '<tr class="row">';
-					html += '<td>Jill Smith '+i+'</td>';
-					html += '<td>Smith</td>';
-					html += '<td>50</td>';
-					html += '</tr>';
-					html += '<tr class="row">';
-					html += '<td>Eve</td>';
-					html += '<td>Jackson</td>';
-					html += '<td>94</td>';
-					html += '</tr>';
-				}
-			$('#tbody').html(html);
-			$("#table-1").fixHeaderTable();
-		});
-	</script>
-</html>