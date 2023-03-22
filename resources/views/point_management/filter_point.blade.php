<?php $count = 0; ?>
@if ($filter_point->count() > 0)
    @foreach ($filter_point->get() as $value)
        <?php $count++; ?>
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $value->id }}</td>
            <td>{{ $value->trans_type }}</td>
            <td>{{ $value->phone_number }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->invitee_ph }}</td>
            <td>{{ $value->invitee_name }}</td>
            <td>{{ $value->partner_ph }}</td>
            <td>{{ $value->partner_name }}</td>
            <td>{{ $value->dates }}</td>
            <td>{{ $value->start_time }}</td>
            <td>{{ $value->end_time }}</td>
            <td>{{ $value->period }}</td>
            <td>{{ $value->debit }}</td>
            <td>{{ $value->credit }}</td>
            <td>{{ $value->balance }}</td>
            <td>
                <button type="button" name="show_history" id="show_history" class="btn btn-sm btn-primary"
                    onclick="payment_redeem({{ $value->id }})">Check</button>
            </td>
        </tr>
    @endforeach
    @else
    <tr>
        <td class="text-center" colspan="15"> No Data Found</td>
    </tr>
@endif
