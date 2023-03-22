<?php $count = 0; ?>
@foreach ($filter_point_info as $value)
    <?php
    $count++;
    $charged_points = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'point charges'], ['created_at', '=', $value->created_at]])
        ->sum('credit');

    $used_points = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '!=', 'redeem request'], ['created_at', '=', $value->created_at]])
        ->sum('debit');

    $total_invitors = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'get invitee video call point'], ['created_at', '=', $value->created_at]])
        ->sum('credit');

    $total_payment_redeems = DB::table('point_management')
        ->where([['status', '=', 1], ['trans_type', '=', 'redeem request'], ['created_at', '=', $value->created_at]])
        ->sum('debit');
    ?>
    <tr>
        <td>{{ $count }}</td>
        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
        <td>{{ $charged_points }}</td>
        <td>{{ $used_points }}</td>
        <td>{{ $total_invitors }}</td>
        <td>{{ $total_payment_redeems }}</td>
    </tr>
@endforeach
