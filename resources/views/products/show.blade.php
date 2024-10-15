<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-back {
            display: block;
            width: 150px;
            margin: 20px 0 20px 0px;
            padding: 10px;
            background-color: #283da7;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #7ae3e5;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .table thead th {
            font-weight: bold;
            background-color: #343a40;
            color: #fff;
            padding: 15px 20px;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table td {
            padding: 15px 20px;
            font-size: 1rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .table-striped tbody tr:hover {
            background-color: #e9ecef;
        }

        .table td:last-child {
            text-align: right;
        }

    </style>
</head>
<body>

<div class="container">
  <h1>Product List</h1>
  <a href="{{ route('products.index') }}" class="btn-back">Back</a>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
          </tr>
      </thead>
      <tbody>
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->description }}</td>
              <td>{{ number_format($product->price, 0) }}</td>
            </tr>
      </tbody>
  </table>
</div>

</body>
</html>
