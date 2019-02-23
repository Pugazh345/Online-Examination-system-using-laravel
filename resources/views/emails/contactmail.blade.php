@component('mail::message')
# A Visitor Wants to Contact You !

Details of the Visitor:

@component('mail::table')
| Name          | Phone         |    Email    |       Course  |     Location  |
|:-------------:|:-------------:|   :--------:|:-------------:|     :--------:|
|  {{ $name }}  | {{ $phone }}  | {{ $email }}| {{ $course }} |{{ $location }}|
           
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
