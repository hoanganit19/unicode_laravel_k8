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

<div>
    <label for="">Trạng thái</label> <br />
    <select name="status" id="">
        <option value="0" {{ old('status') == 0 ? 'selected' : false }}>Chưa kích hoạt
        </option>
        <option value="1" {{ old('status') == 1 ? 'selected' : false }}>Kích hoạt</option>
    </select>
</div>

<div>
    <label for="">Nhóm</label> <br />
    <select name="group_id" id="">
        @if ($groups)
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : false }}>
                    {{ $group->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>

<button type="submit">Submit</button>
