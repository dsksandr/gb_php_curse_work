'use strict';

$(() => {
    $("#login").on({
        click: function (e) {
            e.preventDefault();

            const login = $("[name='login']").val(),
                pass = $("[name='pass']").val(),
                save = $("[name='save']").prop("checked");

            if (login === '' || pass === '') {
                alert('Введите логин и пароль!');
                return;
            }

            const request = $.ajax("/api/auth/?action=login", {
                type: "POST",
                dataType: "json",
                data: JSON.stringify({
                    login: login,
                    pass: pass,
                    save: save,
                }),
                success: data => {
                    if (data['status']) {
                        console.log(data);
                        $('.auth__form').hide();
                        $('.auth__greeting .login').text(data['login']);
                        $('.auth__greeting').show();


                        if (data['access'] === 'admin' || data['access'] === 'root') {
                            const admin = '<li><a href="/admin/">Панель администратора</a></li>';
                            $('.header__menu').append(admin);
                        }
                    } else {
                        console.log(data);

                    }
                },
            });
        }
    });
    $("#logout").on({
        click: function (e) {
            e.preventDefault();

            const request = $.ajax("/api/auth/?action=logout", {
                type: "GET",
                dataType: "json",
                success: data => {
                    if (data['status']) {
                        console.log(data);
                        $(location).attr('href', data['http_referer']);
                    } else {
                        console.log(data);
                    }
                },
            });
        }
    });
});