# YoMail by CodeBitz.dev

YoMail is a package that provides a real time inbox for the outgoing emails from your Laravel app. Using this you can view

- HTML preview of the email.
- Meta data about the email (to, from, cc, bcc etc)
- Source code preview of the email.
- Attachments.

Watch the video for more info.

## Introduction


## Installation

`composer require codebitz/yomail`

## How to use

Once the package has been downloaded then run the artisan command:

`php artisan yomail:install`

This will do three things:
- Run the migrations for the package.
- Copy the assets (JS,CSS) into the public directory `/vendor/yomail`.
- Create the `yomail.php` config file.

Once you have run the installation you can visit your project domain followed by `/yomail` example `example.local/yomail`. Here you will be greeted with the YoMail interface.

## Settings

Here are the optional settings for YoMail which you can add to the `.env` file. Below is the settings and their defaults.

```
YOMAIL_ROUTE=yomail  \\ the default route for the inbox ie example.local/yomail
YOMAIL_REFRESH=1000  \\ how often the inbox will check for new emails (in milliseconds)
YOMAIL_ENABLED=true  \\ If YoMail should be enabled or not
```
