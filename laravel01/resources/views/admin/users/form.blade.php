@if ($errors->any())
    <p>Đã có lỗi xảy ra, vui lòng kiểm tra</p>
@endif
<div>
    <label for="">Tên</label> <br />
    <input type="text" name="name" placeholder="Tên..." value="{{ old('name') }}" /> <br />
    @error('name')
        <span style="color: red">{{ $message }}</span>
    @enderror
</div>
<div>
    <label for="">Email</label> <br />
    <input type="text" name="email" placeholder="Email..." value="{{ old('email') }}" /> <br />
    @error('email')
        <span style="color: red">{{ $message }}</span>
    @enderror
</div>
<button type="submit">Submit</button>
