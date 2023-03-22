@extends('layouts.master')
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
    <div class="content-body">

        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Your business dashboard template</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
                    </ol>
                </div>
            </div>


            @if (isset($payment_detail))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <h4 class="card-title">Payment Request</h4>
                            </div>
                            <div class="card-body" style="overflow: scroll;">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                                        <div class="form-group">
                                            <label>Name: </label> <label>{{ $payment_detail->name }}</label>
                                            <br>
                                            <label>Phone: </label> <label>{{ $payment_detail->phone_number }}</label>
                                            <br>
                                            <label>Total Balance</label> <label><?php echo $payment_detail->debit + $payment_detail->balance; ?></label>
                                            <br>
                                            <label>Total Payment request</label>
                                            <label>{{ $payment_detail->debit }}</label>
                                        </div>
                                    </div>
                                </div>
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Request Day</th>
                                            <th>Paid Day</th>
                                            <th>Bank Name</th>
                                            <th>Bank Account</th>
                                            <th>Depositor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ajax_request">
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $payment_detail->debit }}</td>
                                            <td>{{ date('y-m-d') }}</td>
                                            <td><input type="date" name="paid_day" id="paid_day" class="form-control">
                                            </td>
                                            <td><input type="text" name="bank_name" id="bank_name" class="form-control">
                                            </td>
                                            <td><input type="text" name="bank_account" id="bank_account"
                                                    class="form-control">
                                            </td>
                                            <td><input type="text" name="depositor" id="depositor" class="form-control">
                                            </td>
                                            <td><input type="submit" name="submit" id="submit" class="btn btn-success"
                                                    value="Submit" onclick="payment_redeem({{ $payment_detail->id }})">
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($pending_pay_detail))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <h4 class="card-title">Pending Payment Request</h4>
                            </div>
                            <div class="card-body" style="overflow: scroll;">

                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.no</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Request Day</th>
                                            <th>Paid Day</th>
                                            <th>Bank Name</th>
                                            <th>Bank Account</th>
                                            <th>Depositor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ajax_request">
                                        @if($pending_pay_detail->count() > 0)
                                        @foreach ($pending_pay_detail->get(); as $value)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $value->payment_amount }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->paid_day)) }}</td>
                                                <td>{{ $value->bank_name }}</td>
                                                <td>{{ $value->bank_account }}</td>
                                                <td>{{ $value->depositor }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center"> No Payment Redeem Found</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function payment_redeem(id) {
            var payment_amount = '<?php if(isset($payment_detail->debit)) echo $payment_detail->debit; ?>';
            var pm_id = '<?php if(isset($payment_detail->id)) echo $payment_detail->id; ?>';
            var paid_day = $("#paid_day").val();
            var bank_name = $("#bank_name").val();
            var bank_account = $("#bank_account").val();
            var depositor = $("#depositor").val();

            $.ajax({
                type: 'GET',
                url: "<?php echo url('/'); ?>/add-payment-redeem",
                data: {
                    payment_amount: payment_amount,
                    paid_day: paid_day,
                    bank_name: bank_name,
                    bank_account: bank_account,
                    depositor: depositor,
                    pm_id: pm_id
                },
                success: function(res) {
                    if (res == 'done') {
                        alert('Payment redeem add successfully');
                    }
                }
            })
        }
    </script>
@endsection
