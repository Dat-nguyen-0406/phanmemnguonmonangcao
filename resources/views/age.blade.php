<!DOCTYPE html>
<html>
<head>
    <title>Nhập tuổi</title>
</head>
<body>
    <h2>Vui lòng nhập tuổi của bạn</h2>
    <form action="{{ route('save.age') }}" method="POST">
        @csrf
        <input type="text" name="age" placeholder="Ví dụ: 20">
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>