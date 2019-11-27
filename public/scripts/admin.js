'use strict';

$(() => {
  $('.change_status').on({
    click: function(e) {

      const id = $(e.target).attr('name'),
        value = $(e.target).val(),
        statusText = $(e.target).parent().text();

      const message = `Изменить статус заказа № ${id} на ${statusText}`;

      if (!confirm(message)) {
        e.preventDefault();
        return;
      }

      const radio = $(`input[type="radio"][name="${e.target.name}"]`);
      radio.prop('disabled', true);

      const request = $.ajax(
        `/api/order/?action=change_status`,
        {
          type: 'POST',
          dataType: 'json',
          data: JSON.stringify({
            id: id,
            status: value,
          }),
          success: data => {
            if (data.status) {
              alert('Статус заказа изменен');
            }
            radio.prop('disabled', false);
            console.log(data);
          }
        });
    }
  })
});
