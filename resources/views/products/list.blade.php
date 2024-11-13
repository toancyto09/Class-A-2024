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
        
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-create {
            display: block;
            width: 150px;
            margin: 20px 0 20px 0px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-create:hover {
            background-color: #218838;
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

        .action-buttons{
            display: flex;
            align-items: center;
        }

        .action-buttons a {
            margin-left: 10px;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .action-buttons a.btn-update {
            background-color: #ffc107;
        }

        .action-buttons a.btn-update:hover {
            background-color: #e0a800;
        }

        .action-buttons a.btn-detail {
            background-color: #17a2b8;
        }

        .action-buttons a.btn-detail:hover {
            background-color: #138496;
        }

        .action-buttons a.btn-delete {
            background-color: #dc3545;
        }

        .action-buttons a.btn-delete:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('products') }}">About</a></li>
                <li><a href="{{ route('tasks') }}">Services</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
    
                @auth
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>
    <h1>Product List</h1>

    <!-- Button to create new product -->
    <a href="{{ route('products.create') }}" class="btn-create">Create Product</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price, 0) }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Detail</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-update">Update</a>
                        <a href="{{ route('products.destroy', $product->id) }}" class="btn-delete" 
                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $product->id }}').submit();">
                            Delete
                        </a>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
