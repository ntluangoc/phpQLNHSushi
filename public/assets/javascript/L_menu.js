$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//lấy id-> insert product to cart -> show modal notification
let modalN = document.querySelector("#modal_notification");
let modalM = document.querySelector(".modal_notification");
let closeMD = document.querySelector(".closeModal");
let idBookingTable = '';
if (document.querySelector('#idBookingTable') != null) {
    idBookingTable = document.querySelector('#idBookingTable').innerText;
}
console.log("idBookingTable: " + idBookingTable)
document.querySelectorAll('.btn-add-to-cart').forEach(button => {
    // Thêm sự kiện click cho mỗi button
    button.addEventListener('click', () => {
        // Lấy idProduct từ thuộc tính data-product-id của button
        const idFood = button.dataset.foodId;
        // Gửi idProduct đi sang file ASP khác
        if (idBookingTable.trim() == '') {
            $.ajax({
                type: 'POST',
                data:{idFood},
                url:'/customer/addFoodToCart',
                success:function (result){
                    console.log(result);
                    if (result === false){
                        let html =
                            '<p style="margin-top: 20px;" >Failed to add food to cart!</p>';
                        modalM.innerHTML = html;
                    } else {
                        document.querySelector(
                            '.name-product-notification'
                        ).innerText = button.dataset.foodName;
                        getTop5Cart();
                    }
                    modalN.setAttribute('style', 'display:flex');
                    modalN.classList.add('show_modal_notification');
                }
            })
        } else if (idBookingTable.trim() != '') {
            //console.log('chạy vào add bookingtable')
            $.ajax({
                type: 'POST',
                data:{idFood,idBookingTable},
                url:'/addFoodToBookingFood',
                success:function (result){
                    console.log(result);
                    if (result === false){
                            let html =
                                '<p style="margin-top: 20px;" >Failed to order food!</p>';
                            modalM.innerHTML = html;
                    } else {
                            document.querySelector(
                                '.name-product-notification'
                            ).innerText = button.dataset.foodName;
                            document.querySelector('.text-add-to').innerText =
                                'ordered';
                            getTop5Cart();
                    }
                    modalN.setAttribute('style', 'display:flex');
                    modalN.classList.add('show_modal_notification');

                }
            })
        }
    });
});
closeMD.addEventListener("click", function () {
    modalN.setAttribute("style", "display:none");
    modalN.classList.remove("show_modal_notification");
});
modalN.addEventListener("click", function () {
    modalN.setAttribute("style", "display:none");
    modalN.classList.remove("show_modal_notification");
});
///xóa food
$(function () {
    $('#confirm-delete').on('show.bs.modal', function (e) {
        let deleteButton = $(e.relatedTarget);
        let idFood = deleteButton.data('idfood');
        $('#idFood_input').val(idFood);
    });
});
