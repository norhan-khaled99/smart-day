@component('mail::message')
<div style="direction:rtl">
<div>
عزيزي العميل
</div>
<div>
نشكر لكم ثقتكم بطلب الخدمة
</div>
<div>
نرجو الاطلاع على الاسعار المرفقة
</div>
<div>
ولطلب التوضيح والتفاصيل نرجو التواصل مع فريق المبيعات
</div>
<div>
نرجو ان تنال خدماتنا رضاكم
</div>
<div>
اجمالي المبلغ {{$input['price']}}
</div>
<div>
الكود الخاص بك {{$input['code']}}
</div>
<div>
    [اضغط هنا للدخول إلى صفحة التقييم](http://127.0.0.1:8000/createfeedback?code={{ $input['code'] }})
</div>
</div>

@endcomponent
