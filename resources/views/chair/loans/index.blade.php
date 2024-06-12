@extends('layouts.chair')
@section('title')
Dashboard
@endsection

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Treasurer Loans</h1>
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif
        <ul class="space-y-4">
            @foreach ($loans as $loan)
            <li class="p-4 bg-white shadow-md rounded">
                <div class="flex justify-between">
                    <div>
                        <div><strong>Jumlah:</strong>Rp. {{ $loan->amount }}</div>
                        <div><strong>Status:</strong> {{ $loan->status }}</div>
                        <div><strong>Peminjam:</strong> {{ $loan->member->name }}</div>
                        <div><strong>Email:</strong> {{ $loan->member->email }}</div>
                        <div><strong>No Telepon:</strong> {{ $loan->member->phone_number }}</div>
                        <div>
                            <strong>Total pinjaman belum dibayar:</strong>
                            @if($loan->member->loans()->unpaid()->count() > 0)
                               Rp. {{ $loan->member->loans()->totalUnpaidAmount() }}
                            @else
                                Tidak ada
                            @endif
                        </div>
                    <button type="button" class="text-blue-300" data-toggle="modal" data-target="#loanDetailModal" onclick="loadLoanDetails({{ $loan->id }})">
                        Lihat detail...
                    </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('chair.loans.approve', $loan) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                        </form>
                        <form action="{{ route('chair.loans.reject', $loan) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
  <!-- Modal -->
    <div id="loanDetailModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="loan-details-content">
                                    <!-- Loan details will be loaded here by AJAX -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadLoanDetails(loanId) {
            fetch(`/loans/${loanId}/detail`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('loan-details-content').innerHTML = data;
                    document.getElementById('loanDetailModal').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching loan details:', error));
        }

        function closeModal() {
            document.getElementById('loanDetailModal').classList.add('hidden');
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('loanDetailModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
@endsection