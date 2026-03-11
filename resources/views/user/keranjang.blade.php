@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="container py-4">

    <h2 class="mb-4 fw-bold">🛒 Keranjang Saya</h2>

    @if ($cart->isEmpty())
        <div class="alert alert-info text-center">
            Keranjang Anda masih kosong.
            <br>
            <a href="{{ route('belanja.index') }}" class="btn btn-primary mt-2">Belanja Sekarang</a>
        </div>
    @else

    <form id="checkoutSelectedForm" action="{{ route('checkout.selected') }}" method="POST">
        @csrf

        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm">
                <thead class="bg-success text-white">
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                        </th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th width="120">Jumlah</th>
                        <th>Total</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cart as $item)
                    <tr>
                        {{-- Checkbox pilih produk --}}
                        <td class="text-center">
                            <input type="checkbox"
                                   class="form-check-input item-checkbox"
                                   name="selected_items[]"
                                   value="{{ $item->id }}">
                        </td>

                        {{-- Produk --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     width="60" class="rounded me-3 shadow-sm">
                                <div>
                                    <span class="fw-semibold">{{ $item->product->name }}</span>
                                    <br>
                                </div>
                            </div>
                        </td>

                        {{-- Harga --}}
                        <td class="fw-semibold">
                            Rp {{ number_format($item->product->price, 0, ',', '.') }}
                        </td>

                        {{-- Jumlah --}}
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number"
                                       name="quantity"
                                       min="1"
                                       value="{{ $item->quantity }}"
                                       class="form-control text-center"
                                       style="width: 80px;"
                                       onchange="this.form.submit()">
                            </form>
                        </td>

                        {{-- Total --}}
                        <td class="fw-bold">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('checkout.single', $item->id) }}"
                                   class="btn btn-success btn-sm w-100">
                                    Bayar
                                </a>

                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- RINGKASAN BELANJA --}}
        <div class="d-flex justify-content-end mt-4">
            <div class="card p-4 shadow-lg border-0" style="width: 380px;">
                <h5 class="fw-bold">Ringkasan Belanja</h5>
                <hr>

                <p class="d-flex justify-content-between">
                    <span>Total Produk Dipilih:</span>
                    <span id="selectedCount">0</span>
                </p>

                <p class="d-flex justify-content-between fs-5 fw-bold text-success">
                    <span>Total Harga Dipilih:</span>
                    <span id="selectedTotal">Rp 0</span>
                </p>

                <button type="submit" class="btn btn-success w-100 mt-2" id="checkoutSelectedBtn" disabled>
                    Checkout Produk Terpilih
                </button>
            </div>
        </div>

    </form>
    @endif

</div>

@endsection

@section('scripts')
<script>
    const selectAll = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const selectedTotal = document.getElementById('selectedTotal');
    const checkoutBtn = document.getElementById('checkoutSelectedBtn');

    const productData = @json(
        $cart->mapWithKeys(fn($i) => [
            $i->id => $i->product->price * $i->quantity
        ])
    );

    // Select all
    selectAll.addEventListener('change', function() {
        itemCheckboxes.forEach(cb => cb.checked = selectAll.checked);
        updateSummary();
    });

    // Update summary
    function updateSummary() {
        let count = 0;
        let total = 0;

        itemCheckboxes.forEach(cb => {
            if (cb.checked) {
                count++;
                total += productData[cb.value];
            }
        });

        selectedCount.innerText = count;
        selectedTotal.innerText = "Rp " + total.toLocaleString('id-ID');

        checkoutBtn.disabled = count === 0;
    }

    itemCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateSummary);
    });
</script>
@endsection
