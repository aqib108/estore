<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Invoice</title>

    <style>
     body { font-family: DejaVu Sans, sans-serif; }
        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .sub-total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .to {
            margin-top: 5px;
        }

    </style>
</head>
<body onload="generatePDF()">
<div id="content">
 <table class="w-full">
        <tr>
            <td class="w-half" style="text-align: left;">
                <img src="{{ asset('assets/front/images/logo.png') }}" alt="creative Glass" width="200" />
            </td>
            <td class="w-half" style="text-align: right;">
                <h2>Order # {{ encryptOrderNumber($orderData->id) }}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>To:</h4>
                    </div>
                    <div class="to">{{ $orderData?->billing_user_name }}</div>
                    <div class="to">{{ $orderData?->billing_email }}</div>
                    <div class="to">{{ $orderData?->billing_phone_number }}</div>
                    <div class="to">{{ $orderData?->billing_city }}</div>
                    <div class="to">{{ $orderData?->billing_address }}</div>
                </td>
                <td class="w-half">
                    <div style="margin-left: 250px;">
                        <h4>From:</h4>
                    </div>
                    <div style="margin-left: 250px;margin-top: 5px;">{{ getSetting('title') }}</div>
                    <div style="margin-left: 250px;margin-top: 5px;">{{ getSetting('email') }}</div>
                    <div style="margin-left: 250px;margin-top: 5px;">{{ getSetting('phone') }}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="margin-top">
        <table class="products">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            @foreach($OrderItemdata as $key=>$val)
            <tr class="items" style="text-align: center;">
                <td >{{$loop->iteration}}</td>
                <td>{{ $val->product->title }}</td>
                <td>{{$val->quantity}}</td>
                <td>{{$val->unit_price}}</td>
                <td>{{$val->total}}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="sub-total">
        Sub Total: ${{ $orderData->sub_total }} USD
    </div>
    <div class="total">
        Grand Total: ${{ $orderData->grand_total }} USD
    </div>

    <div class="footer margin-top">
        <div style="text-align: center;">Thank you</div>
        <div style="text-align: center;margin-top:10px">&copy; {{ getSetting('title') }}</div>
    </div>
</div>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>
    <script>    
    var pdfredirectRoute = {
        "userPdfRedirectRoute":"{{route('account.profile')}}",
        "adminPdfRedirectRoute":"{{route('orders.index')}}"
    };
    function generatePDF() {
        const urlParams = new URLSearchParams(window.location.search);

    // Get the value of the 'back_url' parameter
        const backUrl = urlParams.get('back_url');
        // Select the HTML element to convert
        const element = document.getElementById('content');
        // Options for the PDF generation
        const options = {
            margin: 10,
            filename: 'order-invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Call html2pdf function with the element and options
         html2pdf(element, options).then(() => {
            // PDF generation completed, navigate back to the previous page
            if(backUrl=='admin'){
             window.location.href=pdfredirectRoute.adminPdfRedirectRoute;
            } else if(backUrl=='user'){
             window.location.href=pdfredirectRoute.userPdfRedirectRoute;
            }
            
            
        });
    }
</script>
</body>
</html>
