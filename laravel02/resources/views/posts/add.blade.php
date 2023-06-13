<form action="" method="post">
    <div>
        <label for="">Tiêu đề</label>
        <input type="text" name="title" placeholder="Tiêu đề" required />
    </div>
    <div>
        <label for="">Chuyên mục</label>
        @foreach ($categories as $category)
            <label style="display: block;">
                <input type="checkbox" value="{{ $category->id }}" name="categories[]" /> {{ $category->name }}
            </label>
        @endforeach
    </div>
    <button type="submit">Submit</button>
    @csrf
</form>
