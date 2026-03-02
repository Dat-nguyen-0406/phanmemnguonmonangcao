<!DOCTYPE html>
<html lang="en">

<body>
    <form action="{{ route('products.add') }}" method="POST">
    @csrf 
    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm..." required>
    </div>

    <div class="form-group">
        <label for="price">Giá sản phẩm (VNĐ):</label>
        <input type="number" id="price" name="price" placeholder="Ví dụ: 200000" required>
    </div>

    <button type="submit" class="btn-submit">Lưu Sản Phẩm</button>
</form>


    <a href ="{{ route('products.index') }}">Quay lại danh sách sản phẩm</a>
</body>

    <head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm mới</title>
    <style>
       
       

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], 
        input[type="number"], 
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid black; 
            border-radius: 4px;
            box-sizing: border-box; 
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        
    </style>
</head>
</html>