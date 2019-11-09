$(() => {
    $("#login").on({
        click: function () {
            const login = $("[name='login']").val(),
                pass = $("[name='pass']").val(),
                save = $("[name='save']").val() || null;


            const request = $.ajax("/api.php?action=auth", {
                type: "POST",
                dataType: "json",
                data: {
                    login: login,
                    pass: pass,
                    save: save,
                },
            });
            request.done(function (answer) {
                    console.log(answer);
                    $('.auth__form').hide();
                    $('.auth__greeting .login').text(answer.login);
                    $('.auth__greeting').show();
                },
            );
            request.fail(function (answer) {
                    alert(answer);
                    console.log(answer);
                },
            )
        }
    });
});