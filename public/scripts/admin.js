// 'use strict';
//
// $(() => {
//     // $('.change_status:checked').on({
//     //     change: function (e) {
//     //
//     //         console.log(e.target);
//     //     }
//     // });
//     $('.change_status').on({
//         change: function (e) {
//
//             const id = $(e.target).attr('name'),
//                 value = $(e.target).val(),
//                 statusText = $(e.target).parent().text();
//
//             console.log(id, value);
//
//             const message = `Сменить статус заказа № ${id} на ${statusText}`;
//
//             let ischecked = $(this).attr('previousValue');
//             console.log(ischecked);
//             if (!ischecked)
//                 alert('uncheckd ' + $(this).val());
//
//             // if (!confirm(message)) {
//             //
//             //
//             //     return;
//             // }
//             // ;
//
//             // const request = $.ajax(
//             //     `/api/order/?action=change_status`,
//             //     {
//             //         type: "POST",
//             //         dataType: "json",
//             //         data: JSON.stringify({
//             //             email: email,
//             //         }),
//             //         success: data => {
//             //             console.log(data);
//             //             alert(`Ваш заказ зарегистрирован под номером ${data['order_num']}`);
//             //         }
//             //     });
//         }
//     })
// });
