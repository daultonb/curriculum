@component('mail::message')

# You have been assigned as a collaborator to a  course.

Please log in to see and edit the course/prgram by clicking on th below button.
@component('mail::button', ['url' => 'https://curriculum.ok.ubc.ca/login'])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
