<x-layouts.mail :message="$message">
    <p style="color: #2a2627;">Hi,</p>
    <p style="color: #2a2627;">a new account for you has been created in <b>{{ $workspace->name }}</b> workspace.</p>
    <p style="margin-top: 30px; color: #2a2627;">Here are your login details:</p>
    <p style="margin-top: 10px; color: #2a2627;">username: <b>{{ $username }}</b></p>
    <p style="color: #2a2627;">password: <b>{{ $password  }}</b></p>
    <p style="margin-top: 10px; color: #2a2627;">Please change your password, after you login <a href="{{ route('dashboard.login') }}" style="color: #e60076; text-decoration: underline">here</a>.</p>
</x-layouts.mail>
