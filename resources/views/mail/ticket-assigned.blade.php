<x-layouts.mail :message="$message">
    <p style="color: #2a2627;">New ticket <b>"{{ $ticket->subject }}"</b> has been assigned to you in <b>{{ $ticket->workspace->name }}</b> workspace.</p>
    <p style="margin-top: 30px; color: #2a2627;">Here are the ticket details:</p>
    <p style="margin-top: 10px; color: #2a2627;">Status: <b>{{ $ticket->status?->label() }}</b></p>
    <p style="margin-top: 10px; color: #2a2627;">Priority: <b>{{ $ticket->priority?->label() }}</b></p>
    <p style="margin-top: 30px; color: #2a2627;">And here is the ticket description:</p>
    <div style="margin-top: 10px; color: #2a2627; font-size: 18px">{{ $ticket->description }}</div>
</x-layouts.mail>
