@component('mail::message')

@if($statusId == status_active_id())
    Congratulations! Your loan has been approved and your bank account will be creditted shortly.
@elseif($statusId == status_rejected_id())
    Sorry! Your loan has been rejected due to some reasons. Please try again after some few days!
@elseif($statusId == status_completed_id())
    Your loan has been settled. You can now apply for another one.
@elseif($statusId == status_cancelled_id())
    Your loan has been cancelled. You can now apply for another one.
@elseif($statusId == status_pending_id())
    We have received your loan application. Please wait while we process it.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
