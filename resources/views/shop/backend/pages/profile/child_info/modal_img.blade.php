<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="imageModalLabel">Thêm hình ảnh</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="btn-image" data-input="image" data-preview="image-thumb" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Chọn ảnh từ file
                            </a>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="imageUrlThumb" class="form-label">URL hình ảnh</label>
                    <input id="imageUrlThumb" name="detail[imageUrlThumb]" class="form-control" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" href="#" class="btn btn-primary btn-insert-url-thumb" value="Chèn link ảnh" disabled="">
            </div>
        </div>
    </div>
</div>