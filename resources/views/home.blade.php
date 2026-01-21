<!DOCTYPE html>
<html lang="en">


<h1>Đây là trang chủ</h1>
<h3>Xem sản phẩm</h3>
<button onclick="goToProduct()">xem</button>
<br>

<h3>Xem bàn cờ</h3>
    <p>Nhập kích thước bàn cờ (n):</p>
    <input type="number" id="inputN" value="8" min="1" style="width: 50px;">
    
    <button onclick="goToChessboard()">Xem bàn cờ</button>
<script>

    function goToProduct() {
        window.location.href = "{{ route('products.index') }}";
    }
    
    function goToChessboard() {
      var n = document.getElementById("inputN").value;

      var url = "{{ route('banco.viewsbanco', ['n' => ':n']) }}";
        window.location.href = url.replace(':n', n);
    }
</script>

</html>