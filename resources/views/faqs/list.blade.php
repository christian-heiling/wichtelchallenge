@php
$faqs = \App\Faq::all();
@endphp

<h3>Häufig gestellte Fragen</h3>
@foreach($faqs as $faq)
    <h4>{{ $faq->question }}</h4>
    {!! $faq->answer !!}
@endforeach