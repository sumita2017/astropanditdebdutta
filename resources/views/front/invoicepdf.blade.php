<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Astro Achariya Debdutta Appoinment Invoice</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invtitle {
            text-align: center;
            color: #be994f;
            width: 100%;
            display: block;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 5px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 5px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="invtitle">
                                <h1>Appoinment Invoice</h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="title" style="width: 50%;">
                                <img src="{{ $image}}" style="width: 200px; background-color: #000" />
                            </td>
                            <td style="width: 50%;">
                                Invoice #:{{ $users->invoiceId}}<br />
                                Created:{{ $date}}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Customer Details<br />
                                Name:{{ $users->name }}<br />
                                Email:{{ $users->email }}<br />
                                Phone number:{{ $users->phoneNumber }}<br />
                            </td>
                            @php
                                $about_contact = aboutalldetails();
                            @endphp

                            <td>
                                {{ $about_contact->address }}<br />
                                @foreach ($about_contact->phone as $phone)
                                    +91{{$phone}}&nbsp;
                                @endforeach
                                <br />
                                <i class="fa fa-whatsapp" aria-hidden="true"></i> +91 {{ $about_contact->whatsapp }}
                                <br />
                                {{ $about_contact->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Transaction ID:{{ $users->merchantTransactionId }}<br />
                                Reference ID:{{ $users->pgTransactionId }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>
                <td></td>
            </tr>

            <tr class="details">
                <td>{{$users->type}}</td>
                <td></td>
            </tr>

            <tr class="heading">
                <td>Appoinment on {{date('jS \of F Y', strtotime($users->bookingDate)) }}</td>
                <td>Price</td>
            </tr>

            <tr class="item">
                <td>Appoinment Booking Fee</td>
                <td>
                    <img src="{{ $rupee }}" style="width: 11px;color:#333">{{$users->amount}}
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>Total:
                    <img src="{{ $rupee }}" style="width: 11px;color:#333">{{$users->amount}}
                </td>
            </tr>
            <tr class="total">
                <td></td>

                <td></td>
            </tr>
            <tr>
                <td>Date: {{date('jS F,Y')}}</td>

                <td></td>
            </tr>
        </table>
    </div>
</body>

</html>