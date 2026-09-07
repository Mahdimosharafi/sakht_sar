# نصب قالب سخت‌سر

## نکته مهم درباره خطای «style.css کم است»

فایل ZIP گزینه **Code → Download ZIP** در صفحه اصلی مخزن، کل پروژه را شامل می‌شود و برای نصب مستقیم در وردپرس مناسب نیست؛ چون فایل `style.css` داخل مسیر `wp-content/themes/sakht-sar` قرار دارد.

برای نصب بدون خطا، فقط ZIP ساخته‌شده توسط GitHub Actions را دریافت کنید. در ZIP صحیح، ساختار باید به این شکل باشد:

```text
sakht-sar-theme.zip
└── sakht-sar/
    ├── style.css
    ├── index.php
    ├── functions.php
    ├── header.php
    └── ...
```

## دریافت بسته نصب‌شدنی

1. وارد بخش **Actions** مخزن شوید.
2. اجرای موفق workflow با نام **Build Sakht Sar WordPress Theme** را باز کنید.
3. در بخش **Artifacts**، فایل `sakht-sar-wordpress` را دانلود کنید.
4. ZIP دانلودشده را Extract نکنید و از مسیر **نمایش ← پوسته‌ها ← افزودن پوسته ← بارگذاری پوسته** در وردپرس نصب کنید.
5. قالب `Sakht Sar` را فعال کنید.
6. افزونه **Sakht Sar Core** را نیز از مسیر `wp-content/plugins/sakht-sar-core` نصب و فعال کنید.
7. بعد از فعال‌سازی Core، یک‌بار به **تنظیمات ← پیوندهای یکتا** بروید و ذخیره را بزنید.

## مدیریت محتوا

محتوای اصلی سایت با Custom Post Typeهای `ss_place`, `ss_trip`, `ss_event`, `ss_magazine`, `ss_gallery`, `ss_video` مدیریت می‌شود.

## سفارشی‌سازی

تنظیمات اصلی هدر، Hero، وضعیت هوا و فوتر از **نمایش ← سفارشی‌سازی ← سخت‌سر | تنظیمات سایت** قابل مدیریت است.
