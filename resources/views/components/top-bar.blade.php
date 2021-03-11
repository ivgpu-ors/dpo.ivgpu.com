<section id="top" class="fixed top-0 w-full bg-white shadow-md z-50">
  <div class="container mx-auto h-12 flex items-center px-4">
    <a href="/" class="font-semibold font-head text-xl text-gray-700 mb-0">
      На главную
    </a>
    <a href="{{ route('account.orders') }}" class="ml-auto flex items-center">
      @auth()
        @if(Auth::user()->photo)
          <img src="{{ Auth::user()->photo }}" alt="Фото пользователя" class="rounded rounded-full h-8 mr-3">
        @endif
        <span>{{ Auth::user()->first_name }}</span>
      @endauth

      @guest()
        <span>Войти</span>
      @endguest

      <svg viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" class="h-6 ml-2">
        <path
          d="m71.95 30.5c-6.6412 0-12.025 3.8688-12.025 12.17s5.3838 15.031 12.025 15.031 12.025-6.7297 12.025-15.031-5.3838-12.17-12.025-12.17zm-4.5094 27.202c-11.622 0-19.541 9.4216-19.541 21.044v3.0062s3.0062 9.0188 24.05 9.0188 24.05-9.0188 24.05-9.0188v-3.0062c0-11.622-7.9185-21.044-19.541-21.044 0 0-1.5031 1.44-4.5094 1.44s-4.5094-1.44-4.5094-1.44z"
          fill="currentColor"/>
        <path
          d="m33.044 27.043a52.267 52.267 0 0 1 56.96-11.33 52.267 52.267 0 0 1 32.265 48.288 52.267 52.267 0 0 1-32.265 48.288 52.267 52.267 0 0 1-56.96-11.33"
          fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="8"/>
        <path
          d="m4 61.6h32.182l-14.121-14.339c-1.3448-1.3655-1.3448-3.5574 0-4.9229 1.3338-1.2857 3.4621-1.2304 4.7273 0.12291l18.788 19.077c1.3448 1.3655 1.3448 3.5574 0 4.9229l-18.788 19.077c-1.3328 1.3533-3.5155 1.3533-4.8483 0-1.2776-1.3644-1.2237-3.5017 0.12105-4.8l14.121-14.339h-32.182c-1.1046 0-2-0.89543-2-2.4s0.89543-2.4 2-2.4z"
          fill="currentColor"/>
      </svg>
    </a>
  </div>
</section>
