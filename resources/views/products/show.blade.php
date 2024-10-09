
<h2>Product</h2>


<table class="product-table">
    <thead>
        <tr>
            <th class="product-header">Name</th>
            <th class="product-header">Description</th>
            <th class="product-header">Price</th>
        </tr>
    </thead>
    <tbody>
        <tr class="product-row">
            <td class="product-cell">{{ $product->name }}</td>
            <td class="product-cell">{{ $product->description }}</td>
            <td class="product-cell">{{ $product->price }}</td>
        </tr>
    </tbody>
</table>


<style>
    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .product-header {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: left;
        padding: 10px;
        border-bottom: 2px solid #ddd;
    }
    .product-row:nth-child(even) {
        background-color: #f9f9f9;
    }
    .product-cell {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
</style>
