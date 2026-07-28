@extends('layouts.admin') {{-- Sesuaikan dengan layout admin kamu --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Perubahan Data (Audit Logs)</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Waktu</th>
                    <th class="py-3 px-6 text-left">Admin</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                    <th class="py-3 px-6 text-left">Target Lokasi</th>
                    <th class="py-3 px-6 text-left">Detail Perubahan</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($auditLogs as $log)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{ $log->created_at->translatedFormat('d M Y, H:i:s') }}
                        </td>
                        <td class="py-3 px-6 text-left font-semibold text-blue-600">
                            {{ $log->user->name ?? 'Sistem' }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs font-bold">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left font-medium">
                            {{ $log->target }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $log->description }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            Belum ada catatan aktivitas update.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="p-4">
            {{ $auditLogs->links() }}
        </div>
    </div>
</div>
@endsection