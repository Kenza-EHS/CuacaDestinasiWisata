<!-- Badge Keterbaruan Informasi Cuaca -->
@if(isset($location) && $location->updated_at)
    <div class="flex items-center gap-2 p-3 my-3 text-sm text-blue-800 bg-blue-50 rounded-lg border border-blue-200">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <span class="font-semibold">Informasi Cuaca Diperbarui:</span>
            <span>{{ \Carbon\Carbon::parse($location->updated_at)->translatedFormat('d F Y, H:i') }} WIB</span>
            <span class="text-xs text-blue-600 font-medium">({{ \Carbon\Carbon::parse($location->updated_at)->diffForHumans() }})</span>
        </div>
    </div>
@else
    <div class="text-xs text-gray-500 italic my-2">
        Data cuaca diperbarui secara berkala.
    </div>
@endif