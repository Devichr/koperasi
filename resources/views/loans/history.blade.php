@extends($layout)

@section('title', 'Riwayat Pinjaman')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pinjaman</h1>

    <form action="{{ route('loans.history') }}" method="GET" class="mb-4">
        <div class="flex items-center space-x-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Filter by Status:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="all">All</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
        </div>
    </form>

    <ul class="space-y-4">
        @forelse ($loans as $loan)
            <li class="p-4 bg-white shadow-md rounded">
                <div class="flex justify-between">
                    <div>
                        <div><strong>Jumlah:</strong> {{ $loan->amount }}</div>
                        <div><strong>Status:</strong> {{ $loan->status }}</div>
                        <div><strong>Tanggal:</strong> {{ $loan->created_at->format('d-m-Y') }}</div>
                        @if(auth()->user()->role !== 'anggota')
                            <div><strong>Peminjam:</strong> {{ $loan->member->name }}</div>
                            <div><strong>Email:</strong> {{ $loan->member->email }}</div>
                            <div><strong>No Telepon:</strong> {{ $loan->member->phone_number }}</div>
                        @endif
                    </div>
                </div>
            </li>
        @empty
            <li class="p-4 bg-white shadow-md rounded">No loans found.</li>
        @endforelse
    </ul>
</div>
@endsection