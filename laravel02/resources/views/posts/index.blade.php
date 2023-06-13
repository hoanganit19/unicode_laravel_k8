<h2>Danh sách bài viết</h2>
<table cellpadding="0" cellspacing="0" border="1" width="100%">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Chuyên mục</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $key => $post)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt' }}</td>
                <td>
                    @foreach ($post->categories as $category)
                        <span>{{ $category->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="/posts/delete/{{ $post->id }}" onclick="return confirm('Bạn có chắc chắn?')">Xóa</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
