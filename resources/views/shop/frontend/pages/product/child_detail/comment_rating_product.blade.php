@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $formInputAttr = config('myconfig.template.form_element.input');
    $elements = [
        [
            'label'   => '',
            'element' => Form::file('albumImage[]', array_merge($formInputAttr,['multiple'=>'multiple','accept'=>'image/*'])),
            'fileAttach'   => (!empty($item['id'])) ? Template::showImageAttachPreview('comment', null,null, $item['id'],['btn' => 'delete']) : null ,
            'type'    => "fileAttachPreview",
            'widthInput' => 'col-12',
        ]
    ];
    $formInputWidth['widthInput'] = 'col-12';
@endphp
<div class="question-often mt-3">
    <div class="title-rating">
        Câu hỏi thường gặp
    </div>
    <ul class="list-question">
        <li class="catparentc">
            <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                <div class="vissubmenu"><i class="fas fa-angle-down"></i></div>
            </h3>
            <div class="submenua1">
                <ul>
                    <p>* Giúp kích hoạt cơ chế sản sinh Hormone sinh dục nam nội sinh một cách tự nhiên.</p>
                    <p>* Bổ thận tráng dương, tăng cường sinh lý, phục hồi khả năng sinh lý nam giới.</p>
                    <p>* Hỗ trợ điều trị rối loạn cương dương, xuất tinh sớm, di tinh, mộng tinh… làm chậm quá trình mãn dục nam.</p>
                    <p>* Giúp tăng cường lưu thông máu, tăng cường ham muốn, khắc phục tình trạng rối loạn cương dương ở nam giới.</p>
                </ul>
            </div>
        </li>
    </ul>
</div>
<div class="question-often content-rating-product mt-3">
    @include("$moduleName.pages.$controllerName.child_detail.content_rating")
</div>
<!-- <div class="content-comment-product">
  phần comment sản phẩm
</div> -->
<div class="modal" id="ratingModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Đánh giá sản phẩm</h5>
                <button type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="overflow: scroll">
              <div class="modal-body" style="height: 400px">
                  <!-- <div class="d-flex mb-2">
                      <div> <img src="{{asset($item['image'])}}" style="max-width: 100px; max-height:100px;" /></div>
                      <div class="font-weight-bold">{{$item['name']}}</div>
                  </div> -->
                  <div class="rating text-center mb-2" id="starRating">
                      <span class="star star-big active" data-rating="1">★</span>
                      <span class="star star-big active" data-rating="2">★</span>
                      <span class="star star-big active" data-rating="3">★</span>
                      <span class="star star-big active" data-rating="4">★</span>
                      <span class="star star-big active" data-rating="5">★</span>
                  </div>
                  <div class="content-quest">
                      <div class="row mb-3">
                          <div class="col-12 mb-3">
                              <input name="fullname" value="{{ e(Session::get('user')['fullname'] ?? '') }}" placeholder='Họ và tên'>
                          </div>
                          <div class="col-12">
                              <input name="phone" value="{{ e(Session::get('user')['phone'] ?? '') }}" placeholder='Số điện thoại'>
                          </div>
                      </div>
                      <div><textarea name="content" placeholder="Nhập nội dung (Vui lòng gõ tiếng Việt có dấu)..."></textarea></div>
                      <div class="tcy-upload-content text-center f-w-600">
                          {!! FormTemplate::show($elements,$formInputWidth)  !!}
                      </div>
                      <span class="btn btn-primary submit-comment rounded-pill btn-block" data-user="{{Session::has('user') ? Session::get('user')['user_id'] : ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="0" data-rating="5">Gửi</span>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="commentModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bình luận sản phẩm</h5>
        <button type="button" class="close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-quest">
            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <input name="fullname" value="{{ e(Session::get('user')['fullname'] ?? '') }}" placeholder='Họ và tên'>
                </div>
                <div class="col-12">
                    <input name="phone" value="{{ e(Session::get('user')['phone'] ?? '') }}" placeholder='Số điện thoại'>
                </div>
            </div>
          <textarea name="content" placeholder="Nhập nội dung câu hỏi"></textarea>
          <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id'] ?? ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="0">Gửi bình luận</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="replyModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replyModalLabel">Trả lời</h5>
        <button type="button" class="close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-quest">
            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <input name="fullname" value="{{ e(Session::get('user')['fullname'] ?? '') }}" placeholder='Họ và tên'>
                </div>
                <div class="col-12">
                    <input name="phone" value="{{ e(Session::get('user')['phone'] ?? '') }}" placeholder='Số điện thoại'>
                </div>
            </div>
          <textarea name="content" placeholder="Nhập nội dung câu hỏi"></textarea>
          <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id'] ?? ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="">Gửi bình luận</span>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .modal {
    background-color: rgba(0, 0, 0, 0.5); 
  }
</style>