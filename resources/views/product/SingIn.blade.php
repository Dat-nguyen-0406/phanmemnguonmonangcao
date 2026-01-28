<form action="{{ route('CheckSingIn') }}" method="POST">
    @csrf
    <div >
        <label>Username:</label>
    <input type="text" name="username" placeholder="Username" required>
    </div>

    <div >
        <label>Password:</label>
    <input type="password" name="password" placeholder="Password" required>
    </div>

     <div >
        <label>Confirm Password:</label>
    <input type="password" name="repass" placeholder="Confirm Password" required>
    </div>

    <div >
        <label>MSSV:</label>
    <input type="text" name="mssv" placeholder="mssv" required>
    </div>
    
    <div >
        <label>Class:</label>
    <input type="text" name="lopmonhoc" placeholder="lopmonhoc" required>
    </div>
    <br>
    <select name="gioitinh">
        <option value="Nam">Nam</option>
        <option value="Nu">Nữ</option>
    </select>
    <button type="submit">Đăng ký</button>
</form>