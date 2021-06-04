<div class="w-full bg-primary rounded py-2 px-4 mb-2">
  <p class="mb-0 h5 my-2">
    <span>{{ backpack_auth()->user()->name }}</span>
  </p>

  <p class="mb-0">
    <i class="la la-calendar nav-icon"></i>
    <span class="px-2">{{ now()->format('D, j F Y') }}</span>
  </p>

  <p>
    <i class="la la-clock nav-icon"></i>
    <span id="realtimeWatch" class="px-2">{{ now()->format('H:i:s') }}</span>
  </p>
</div>