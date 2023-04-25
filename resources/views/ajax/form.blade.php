@section('main')
    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$res['id']}}"></script>
    <!-- ده المكان اللى بعد مايخلص البوابه هيرجع عليه-->
    <form action="{{route('offer.show',$id)}}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>

@stop
