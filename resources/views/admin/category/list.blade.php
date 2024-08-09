<div class="pt-3 sm:pt-5">
    <table class="table table-bordered table_deg">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-secondary">Edit</a>
                    <a href="{{ route('category.delete', $category->id) }}" onclick="confirmation(event)" class="btn btn-outline-danger" style="color: white;">Delete</a>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
