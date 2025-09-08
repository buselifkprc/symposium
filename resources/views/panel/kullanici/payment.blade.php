@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Payment Summary</h3>
                </div>
                <div class="card-body">
                    <h5>Selected Papers:</h5>
                    <ul>
                        @foreach($papers as $p)
                            <li>{{ $p->paper_title }} ({{ $p->registration->user->name ?? '-' }})</li>
                        @endforeach
                    </ul>

                    <hr>

                    <p><strong>Price per paper:</strong> ${{ $pricePerPaper }}</p>
                    <p><strong>Total amount:</strong> ${{ $total }}</p>

                    <div class="mt-4">
                        <p>Proceed with payment using the following account:</p>

                        <div class="w-full mt-4 p-4 space-y-2 border border-gray-200 bg-gray-50 rounded">
                            <p><strong>Account owner:</strong> YAZILIM VE SİBER GÜVENLİK DERNEĞİ</p>
                            <p><strong>IBAN (Dollar):</strong> TR59 0001 0015 6183 9337 9450 06</p>
                            <p><strong>SWIFT:</strong> TCZBTR2AXXX</p>
                            <p><strong>Bank Branch:</strong> 1561-İstasyon/Elazig-Turkey</p>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="#" class="btn btn-success px-5">Proceed to PayPal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
