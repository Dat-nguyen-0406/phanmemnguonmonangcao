@extends('layout.admin')
@section('content')



<table class="table table-bordered">
    <tr>
        
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['price'] }}</td>
            <td>{{ $product['stock'] }}</td>
            
        </tr>
    @endforeach
</table>
@endsecion
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