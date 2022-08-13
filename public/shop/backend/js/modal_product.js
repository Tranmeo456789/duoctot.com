const btn_addfast_product=document.getElementById('btn-addfast-product');
const modal_wrapper_product = document.getElementById('modal-wrapper-product');
btn_addfast_product.addEventListener('click', ()=>{

    modal_wrapper_product.classList.add('show');
});
button_close.addEventListener('click', ()=>{
    modal_wrapper_product.classList.remove('show');
});
$('.modal-footer span').click(function(){
    button_close.click();
});