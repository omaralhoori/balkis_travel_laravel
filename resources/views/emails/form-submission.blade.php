<x-mail::message>
# إرسال جديد للنموذج: {{ $form->title }}

تم استلام إرسال جديد بتاريخ {{ $submission->created_at?->format('Y-m-d H:i') }}.

@foreach ($labeledAnswers as $label => $value)
**{{ $label }}:** {{ $value }}

@endforeach

<x-mail::button :url="url('/admin/custom-forms/'.$form->id.'/edit')">
عرض النموذج في لوحة التحكم
</x-mail::button>

شكراً،<br>
{{ config('app.name') }}
</x-mail::message>
