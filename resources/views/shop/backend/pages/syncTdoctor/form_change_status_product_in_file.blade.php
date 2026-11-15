<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật trạng thái sản phẩm</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px 15px;
            margin: 0;
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
            font-size: 20px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #007bff;
        }
        .description {
            font-size: 12px;
            color: #777;
            margin-top: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: #dc3545;
            font-size: 13px;
            margin-bottom: 15px;
        }
        @media (max-width: 480px) {
            body {
                padding: 20px 12px;
            }
            .box {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
<div class="box">
    <h2>Cập nhật trạng thái sản phẩm</h2>
    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST"
          action="{{ route('fe.SyncTdoctor.updateChangeStatusProductInFile') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="product_list">Mã danh sách sản phẩm</label>
            <input
                type="text"
                name="product_list"
                id="product_list"
                placeholder="Nhập sp_thuoc"
                value="{{ old('product_list', 'sp_thuoc') }}"
                required>
            <div class="description">
                Danh sách hiện tại: sp_thuoc
            </div>
        </div>
        <div class="form-group">
            <label for="status_product">Trạng thái sản phẩm</label>
            <input
                type="text"
                name="status_product"
                id="status_product"
                placeholder=""
                value="{{ old('status_product') }}"
                required>

            <div class="description">
                Ví dụ: da_duyet hoặc sp_an
            </div>
        </div>
        <button type="submit"
                onclick="return confirm('Bạn có chắc chắn muốn cập nhật trạng thái toàn bộ sản phẩm trong danh sách?');">
            Cập nhật trạng thái
        </button>
    </form>
</div>
</body>
</html>
