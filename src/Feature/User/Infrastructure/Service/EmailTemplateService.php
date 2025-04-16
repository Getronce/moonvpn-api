<?php

namespace App\Feature\User\Infrastructure\Service;

class EmailTemplateService
{
    public function generateWelcomeEmailContent(string $email): string
    {
        return "
            <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f9;
                            margin: 0;
                            padding: 0;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        }
                        .container {
                            width: 100%;
                            max-width: 600px;
                            background-color: #4CAF50; /* Зеленый фон для окошка */
                            border-radius: 10px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            padding: 40px;
                            text-align: center;
                            color: white;
                            box-sizing: border-box;
                        }
                        h1 {
                            color: #fff;
                            font-size: 24px;
                            margin-bottom: 10px;
                        }
                        p {
                            font-size: 16px;
                            line-height: 1.5;
                            color: #fff;
                            margin-bottom: 20px;
                        }
                        .cta-button {
                            display: inline-block;
                            padding: 12px 20px;
                            background-color: #fff;
                            color: #4CAF50;
                            text-decoration: none;
                            border-radius: 5px;
                            font-size: 16px;
                            margin-top: 20px;
                        }
                        .footer {
                            margin-top: 30px;
                            font-size: 12px;
                            color: #ccc;
                            text-align: center;
                        }
                        /* Media query for smaller screens */
                        @media (max-width: 600px) {
                            .container {
                                padding: 20px;
                            }
                            h1 {
                                font-size: 20px;
                            }
                            p {
                                font-size: 14px;
                            }
                            .cta-button {
                                width: 100%;
                                padding: 15px;
                            }
                            .footer {
                                font-size: 10px;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h1>Добро пожаловать в наш сервис, $email!</h1>
                        <p>Спасибо за регистрацию. Мы рады, что вы с нами!</p>
                        <p>Если у вас возникнут вопросы или проблемы, не стесняйтесь обращаться к нашей поддержке.</p>
                        <a href='#' class='cta-button'>Перейти в сервис</a>
                        <div class='footer'>
                            <p>Если вы не регистрировались на нашем сервисе, игнорируйте это письмо.</p>
                            <p>&copy; 2025 Наш Сервис. Все права защищены.</p>
                        </div>
                    </div>
                </body>
            </html>
        ";
    }
}