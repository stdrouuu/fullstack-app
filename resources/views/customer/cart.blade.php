@extends('customer.layouts.master')

@section('content')
    <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Keranjang</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item active text-primary">Silahkan periksa pesanan anda !</li>
            </ol>
        </div>
    <!-- Single Page Header End -->
<div class="container-fluid py-5">
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (empty($cart))
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart" style="width:100px; height:100px; margin-bottom:20px;">
                <h4 class="mb-3">Keranjang Anda Kosong.</h4>
                <p class="text-muted">Tambahkan menu favorit Anda ke keranjang!</p>
                <a href="{{ route('menu') }}" class="btn btn-primary mt-3">Lihat Menu</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subTotal = 0;
                        @endphp

                        @foreach ($cart as $item)
                            @php
                                $itemTotal = $item['price'] * $item['qty'];
                                $subTotal += $itemTotal;
                            @endphp
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img_item_upload/'. $item['image']) }}" 
                                            class="img-fluid me-5 rounded-circle" 
                                            style="width: 80px; height: 80px;" 
                                            alt="" 
                                            onerror="this.onerror=null;this.src='{{  $item['image'] }}';">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ 'Rp'. number_format($item['price'], 0, ',','.') }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            {{-- Ketika diklik akan mengurangi qty -1 --}}
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="updateQuantity('{{ $item['id'] }}', -1)">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input id="qty-{{ $item['id'] }}"
                                            type="text" 
                                            class="form-control form-control-sm text-center border-0 bg-transparent" 
                                            value="{{ $item['qty'] }}" 
                                            readonly>
                                        <div class="input-group-btn">
                                            {{-- Ketika diklik akan menambahkan qty +1 --}}
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="updateQuantity('{{ $item['id'] }}', 1)">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ 'Rp'. number_format($item['price'] * $item['qty'], 0, ',','.') }}</p>
                                </td>
                                <td>
                                    {{-- Ketika diklik akan menghapus item dari cart --}}
                                    <button class="btn btn-md rounded-circle bg-light border mt-4"
                                        onclick="confirmRemoveItem('{{ $item['id'] }}')">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @php
                $tax = $subTotal * 0.1;
                $total = $subTotal + $tax;
            @endphp

            <div class="d-flex justify-content-end">
                <a 
                href="{{ route('cart.clear') }}" 
                class="btn btn-danger" 
                onclick="event.preventDefault(); confirmClearCart();">
                Kosongkan Keranjang
                </a>
            </div>

            <div class="row g-4 justify-content-end mt-1">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal</h5>
                                <p class="mb-0">Rp{{ number_format($subTotal, 0, ',','.') }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 me-4">Pajak (10%)</p>
                                <div class="">
                                    <p class="mb-0">Rp{{ number_format($tax, 0, ',','.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top d-flex justify-content-between">
                            <h4 class="mb-0 ps-4 me-4">Total</h4>
                            <h5 class="mb-0 pe-4">Rp{{ number_format($total, 0, ',','.') }}</h5>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="mb-3">
                            <a href="{{ route('checkout') }}" 
                                class="btn border-secondary py-3 text-primary text-uppercase mb-4" 
                                type="button">
                                Lanjut ke Pembayaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection  


@section('script')
<script>
    // function untuk tambah item ke keranjang
    function updateQuantity(itemId, change) {
        var qtyInput = document.getElementById('qty-' + itemId);
        var currentQty = parseInt(qtyInput.value);
        var newQty = currentQty + change;

        if (newQty <= 0) {
            confirmRemoveItem(itemId);
            return;
        }

        fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: itemId, qty: newQty })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                qtyInput.value = newQty;
                location.reload();
            } else {
                alert(data.message); //alert ijo: jumlah item berhasil diperbarui
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate keranjang');
        });
    }

    // function untuk konfirmasi delete item + delete item dari keranjang pakai sweetalert2
    function removeItemFromCart(itemId) {
        fetch("{{ route('cart.remove') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: itemId })
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message || 'Item berhasil dihapus',
                timer: 1200,
                showConfirmButton: false
            });
            setTimeout(() => location.reload(), 1500);
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message ||'Terjadi kesalahan saat menghapus item.'
            });
        });
    }

    function confirmRemoveItem(itemId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Item ini akan dihapus dari keranjang!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                removeItemFromCart(itemId);

                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus!',
                    text: 'Item berhasil dihapus dari keranjang.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    function confirmClearCart() {
        Swal.fire({
            title:'Apakah Anda yakin?',
            text:'Semua item di keranjang akan dihapus!',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#d33',
            cancelButtonColor:'#6c757d',
            confirmButtonText:'Ya, hapus!',
            cancelButtonText:'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "{{ route('cart.clear') }}";
            }
        });
    }
</script>
@endsection
