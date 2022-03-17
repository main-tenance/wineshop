<?php

return [
    'main' => 'Главная',
    'name' => 'Ромашка-М',
    'company' => 'Компания Ромашка-М',
    'products' => 'Категории товаров компании Ромашка-М',
    'store' => [
        'caption' => 'Наш склад',
        'address' => '123456, Россия, Москва, ул. Ромашки, д. 1, стр. 1',
        'hours' => 'Время работы: с 8:00 до 16:00',
    ],
    'phone' => '79999999999',
    'phone_formatted' => '7 (999) 999-99-99',
    'email' => 'romashka@faker.com',
    'menu' => [
        'about' => 'О компании',
        'creators' => 'Производители',
        'profile' => 'Личный кабинет',
        'passport' => 'Passport',
        'makers' => 'Производители (админ)',
        'discounts' => 'Скидки (админ)',
    ],
    'attention' => 'Обращаем Ваше внимание! Наш сайт не является интернет-магазином, а представляет
                    собой информационный каталог вин и напитков. Все предлагаемые на сайте сведения о
                    продукции предназначены для ознакомительных целей и не носят рекламного характера.
                    ЧРЕЗМЕРНОЕ УПОТРЕБЛЕНИЕ АЛКОГОЛЯ ВРЕДИТ ВАШЕМУ ЗДОРОВЬЮ!',
    'more' => 'Подробнее',
    'username' => 'Логин',
    'password' => 'Пароль',
    'log_in' => 'Вход на сайт',
    'login' => 'Войти',
    'logout' => 'Выйти',
    'register' => 'Зарегистрироваться',
    'to_register' => 'Зарегистрировать',
    'login_rules' => 'Логин – не менее 3 символов без пробелов (латинские буквы, цифры, специальные знаки, как !,
        ?, %, $, _, #, @, точка.)',
    'password_rules' => 'Пароль – не менее 6 символов без пробелов (латинские буквы, цифры, специальные знаки, как !,
        ?, %, $, _, #, @, точка.)',
    'for_orders' => 'Для заказов',
    'subscribe' => 'Подписаться на рассылку',
    'i_agree' => 'Согласен с ',
    'personal_data_conditions' => 'условиями использования персональных данных',
    'subscription_agreement' => 'Согласен с получением рассылки',
    'categories' => [
        ['id' => 342, 'name' => 'Вино', 'svg' => 'wine'],
        ['id' => 339, 'name' => 'Игристое', 'svg' => 'sparkling_wine'],
        ['id' => 347, 'name' => 'Портвейн', 'svg' => 'port'],
        ['id' => 348, 'name' => 'Херес', 'svg' => 'sherry'],
        ['id' => 341, 'name' => 'Коньяк', 'svg' => 'cognac'],
        ['id' => 343, 'name' => 'Арманьяк', 'svg' => 'armagnac'],
        ['id' => 346, 'name' => 'Виски', 'svg' => 'whisky'],
        ['id' => 1887, 'name' => 'Джин', 'svg' => 'gin'],
        ['id' => 345, 'name' => 'Ром', 'svg' => 'rom'],
        ['id' => 577, 'name' => 'Пиво', 'svg' => 'beer'],
    ],
    'reg' => 'Регистрация',
    'authorization' => 'Авторизация',
    'registration' => [
        [
            'name' => 'NAME',
            'type' => 'text',
            'label' => 'Имя',
            'required' => 1,
        ],
        [
            'name' => 'LAST_NAME',
            'type' => 'text',
            'label' => 'Фамилия',
            'required' => 0,
        ],
        [
            'name' => 'EMAIL',
            'type' => 'text',
            'label' => 'E-mail',
            'required' => 0,
        ],
        [
            'name' => 'PASSWORD',
            'type' => 'text',
            'label' => 'Пароль',
            'required' => 0,
        ],
        [
            'name' => 'UF_VIP_PROMOCODE',
            'type' => 'text',
            'label' => 'Промокод VIP-клуба',
            'required' => 0,
            'placeholder' => 'Введите, если имеете',
        ],
        [
            'name' => 'UF_JURIDICAL_PERSON',
            'type' => 'checkbox',
            'label' => 'Я являюсь юридическим лицом',
            'required' => 0,
            'value' => 1,
        ],
        [
            'name' => 'UF_SEND_REGINFO',
            'type' => 'hidden',
            'label' => 'Отправить уведомление на email клиента',
            'required' => 0,
            'value' => 1,
        ],
    ],
    'save_updates' => 'Сохранить изменения',
    'info_saved' => 'Информация сохранена',
    'welcome_sms' => 'Добро пожаловать!',

];