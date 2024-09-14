<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>

    <?php
    $category = DB::table('categories')->where('id', $product->category_id)->first();
    ?>

    <table class="table" style="border-collapse: collapse; width: 100%;">
        <thead class="thead-dark" style="background-color: #343a40; color: #fff;">
            <tr>
                <th style="border: 1px solid #dee2e6; padding: 8px;">ID</th>
                <th style="border: 1px solid #dee2e6; padding: 8px;">Name</th>
                <th style="border: 1px solid #dee2e6; padding: 8px;">Description</th>
                <th style="border: 1px solid #dee2e6; padding: 8px;">Category</th>
                <th style="border: 1px solid #dee2e6; padding: 8px;">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $product->id }}</td>
                <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $product->name }}</td>
                <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $product->description }}</td>
                <td style="border: 1px solid #dee2e6; padding: 8px;"> {{ $category->name }} </td>
                <td style="border: 1px solid #dee2e6; padding: 8px;">{{ $product->price }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
