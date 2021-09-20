@component('mail::message')

# {{ $data['email'] }}

<!-- 
@component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

# {{ $data['name'] }} has uploaded the following file:<br>
# File: {{ $data['file_name'] }}<br>
{{ config('app.name') }}
@endcomponent
