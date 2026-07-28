<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Track Record Update (Audit Trail)</h2>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3">Waktu</th>
                <th class="p-3">Admin</th>
                <th class="p-3">Aksi</th>
                <th class="p-3">Target</th>
                <th class="p-3">Detail Perubahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($auditLogs as $log)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-sm">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="p-3 font-semibold text-blue-600">{{ $log->user->name ?? 'Sistem' }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 font-bold">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="p-3 font-medium">{{ $log->target }}</td>
                    <td class="p-3 text-gray-600">{{ $log->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada riwayat aktivitas update.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>