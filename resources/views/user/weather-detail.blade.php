<!-- Keterbaruan Informasi Cuaca untuk User -->
<div class="flex items-center text-sm text-gray-500 bg-blue-50 p-3 rounded-lg border border-blue-100 mb-4">
    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <span>
        Data cuaca diperbarui: 
        <strong>{{ $location->updated_at->translatedFormat('d F Y, H:i') }} WIB</strong> 
        <span class="text-gray-400">({{ $location->updated_at->diffForHumans() }})</span>
    </span>
</div>