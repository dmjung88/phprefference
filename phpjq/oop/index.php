<html>
<head>
	<title>Data</title>
</head>
<style type="text/css">
	table img{
		width: 200px;
	}
</style>
<body>
	<p>
		<button name="switch">버튼</button>
	</p>
	<p id="loading" style="display:none">
	Loading..............
	</p>
	
	<table border="1" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<td></td>
				<td><input type="text" name="productName"></td>
				<td><input type="text" name="description"></td>
				<td>
					<select name="category">
						<option value="-1">==</option>
					</select>
				</td>
				<td><input type="file" name="product_img"></td>
				<td><input type="submit" id="save" value="입력모드"></td>
			</tr>
			<tr>
				<th>No</th>
				<th>제품명</th>
				<th>카테고리</th>
				<th>설명</th>
				<th>Picture</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>	
</html>