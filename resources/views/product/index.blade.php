<!DOCTYPE html>
<html lang="en">
<body>
<h1>Đây là trang sản phẩm</h1>

<table class="table">
    <thead style="background-color: aqua;">
        <tr>
           <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        
    </thead>
<tbody>
    <tr style="text-align: center;">
     <td >1</td>
     <td >Sản phẩm A</td>
        <td >100.000 VND</td>
        <td >
            <button class="button">Sửa</button>
            <button class="button">Xóa</button>
    </tr>
    <tr style ="text-align: center;">
    <td >2</td>
     <td >Sản phẩm B</td>
        <td >500.000 VND</td>
        <td >
            <button class="button">Sửa</button>
            <button class="button">Xóa</button>
    </tr>
</tbody>
</table>
<button type="submit" class="button" onclick="GoToAdd()">Thêm sản phẩm</button>
<script>
     function GoToAdd() {
        window.location.href = "{{ route('products.add') }}";
    }
</script>

<br>
<a href ="{{ route('home') }}">Quay lại home</a>
</body>
<head>
    <style>
        .button
        {
            width: auto;
            text-align: center;
         background-color: #4CAF50; 

        }
        .button:hover {
            background-color: #45a049;
        }
        .table {
            width: 100%;            
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table th, .table td{
             border: 1px solid black;
            border-collapse: collapse;
        }
</style>

</head>
</html>