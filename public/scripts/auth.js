$(() => {
    $("#login").on({
        click: function (e) {
            e.preventDefault();

            const login = $("[name='login']").val(),
                pass = $("[name='pass']").val(),
                save = $("[name='save']").val() || null;

            if (login === '' || pass === '') {
                alert('Введите логин и пароль!');
                return;
            }

            const request = $.ajax("/api/auth/?action=login", {
                type: "POST",
                dataType: "json",
                data: {
                    login: login,
                    pass: pass,
                    save: save,
                },
                success: data => {
                    if (data.status) {
                        console.log(data);
                        $('.auth__form').hide();
                        $('.auth__greeting .login').text(data.login);
                        $('.auth__greeting').show();
                    } else {
                        console.log(data);
                    }
                },
            });
        }
    });
});