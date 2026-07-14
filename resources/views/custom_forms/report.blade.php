<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تقرير: {{ $form->title }}</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; color: #333; margin: 24px; }
        h1 { color: #765C39; margin-bottom: 4px; }
        .meta { color: #666; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: right; vertical-align: top; }
        th { background: #f5f0e8; color: #4A566C; }
        tr:nth-child(even) { background: #fafafa; }
        .toolbar { margin-bottom: 16px; display: flex; gap: 12px; }
        .btn { background: #765C39; color: #fff; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; }
        @media print {
            .toolbar { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <button class="btn" onclick="window.print()">طباعة / حفظ PDF</button>
        <a class="btn" href="{{ route('custom_forms.admin.export', $form) }}">تصدير Excel (CSV)</a>
    </div>

    <h1>{{ $form->title }}</h1>
    <p class="meta">عدد الإرسالات: {{ $form->submissions->count() }} | تاريخ التقرير: {{ now()->format('Y-m-d H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>التاريخ</th>
                @foreach ($form->fields as $field)
                    <th>{{ $field->label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($form->submissions as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->created_at?->format('Y-m-d H:i') }}</td>
                    @foreach ($form->fields as $field)
                        @php
                            $value = $submission->answers[$field->field_key] ?? null;
                            $display = is_array($value) ? implode(', ', $value) : ($value ?? '—');
                        @endphp
                        <td>{{ $display }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ 2 + $form->fields->count() }}">لا توجد إرسالات بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
