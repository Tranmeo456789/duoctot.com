<style>
    .modal-filter-mobile {
    position: fixed; /* Cố định modal */
    top: 0; /* Căn từ trên cùng */
    left: 0; /* Căn từ bên trái */
    width: 100%; /* Modal chiếm toàn bộ chiều rộng */
    height: 100%; /* Modal chiếm toàn bộ chiều cao */
    background-color: rgba(0, 0, 0, 0.5); /* Màu nền trong suốt */
    z-index: 1050; /* Đặt z-index cao hơn các phần tử khác */
    display: none; /* Ẩn modal ban đầu */
}

.modal-dialog {
    position: relative; /* Đặt modal-dialog tương đối */
    max-width: 600px; /* Đặt chiều rộng tối đa cho modal */
    margin: 0 auto; /* Căn giữa modal */
    top: 20px; /* Căn cách từ trên xuống */
}

.modal-content {
    max-height: calc(100vh - 40px); /* Giới hạn chiều cao nội dung */
    overflow-y: auto; /* Cho phép cuộn dọc nếu nội dung vượt quá */
}
</style>
<div class="modal-filter-mobile" id="modalFilter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLabel">Bộ lọc nâng cao</h5>
                <button type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box-filter-advanced">
                    <div class="">
                        @include("$moduleName.pages.$controllerName.templates.listbox_select")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>