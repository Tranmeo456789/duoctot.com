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
        <h2>Cập nhật trạng thái sản phẩm</h2>
        <form method="POST" action="{{ route('fe.SyncTdoctor.updateChangeStatusProductInUser') }}">
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
                <label for="status_product">Trạng thái sản phẩm</label>
                <input
                    type="text"
                    name="status_product"
                    id="status_product"
                    placeholder="Nhập status_product"
                    required>
            </div>
            <button type="submit">
                Cập nhật trạng thái
            </button>
        </form>
    </div>
</body>
</html>