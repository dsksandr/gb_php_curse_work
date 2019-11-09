$(() => {
    $('#clearForm').on({
        click: function () {
            $('input[type="text"]').val('');
            $('.equally span').text('');
        }
    });


    $(".submit").on({
        click: function (e) {
            const firstNumber = $("#firstNumber").val(),
                secondNumber = $("#secondNumber").val(),
                operator = $(e.target).data('value'),
                equally = $('.equally span');

            if (firstNumber === '') {
                equally.text('Введите первое число!');
                return;
            }

            if (secondNumber === '') {
                equally.text('Введите второе число!');
                return;
            }

            const request = $.ajax("/api.php?action=calculator", {
                type: "POST",
                dataType: "json",
                data: {
                    firstNumber: firstNumber,
                    secondNumber: secondNumber,
                    operator: operator,
                },
            });
            request.done(function (answer) {
                    equally.text(answer);
                },
            );
            request.fail(function (answer) {
                    equally.text(answer);
                },
            )
        }
    });
});