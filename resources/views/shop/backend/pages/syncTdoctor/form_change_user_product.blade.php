<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật trạng thái sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }
        .box {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 11px;
            border: 0;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Cập nhật user các sản phẩm</h2>
        <form method="POST" action="{{ route('fe.SyncTdoctor.updateChangeUserProduct') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input
                    type="number"
                    name="user_id"
                    id="user_id"
                    placeholder="Nhập user_id"
                    required>
            </div>
            <div class="form-group">
                <label for="id_product_start">Id sản phẩm đầu</label>
                <input
                    type="text"
                    name="id_product_start"
                    id="status_product"
                    placeholder="Nhập id sp"
                    required>
            </div>
            <div class="form-group">
                <label for="id_product_end">Id sản phẩm cuối</label>
                <input
                    type="text"
                    name="id_product_end"
                    id="status_product"
                    placeholder="Nhập id sp"
                    required>
            </div>
            <div class="form-group">
                <label for="warehouse_id">Id kho hàng</label>
                <input
                    type="text"
                    name="warehouse_id"
                    id="status_product"
                    placeholder="Nhập id kho hàng"
                    required>
            </div>
            <button type="submit">
                Cập nhật trạng thái
            </button>
        </form>
    </div>
</body>
</html>