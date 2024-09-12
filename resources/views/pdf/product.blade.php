<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>

    <?php
    $category = DB::table('categories')->where('id', $product->category_id)->first();
    ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td> {{ $category->name }} </td>
                <td>{{ $product->price }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
