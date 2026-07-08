<a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}"
   id="floating-contact-btn"
   data-track-source="Floating WhatsApp Button"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="{{ __('Contact Us') }}"
   class="floating-contact-btn group fixed bottom-5 end-5 sm:bottom-6 sm:end-6 z-40 inline-flex items-center gap-2.5 px-4 py-3 sm:px-5 sm:py-3.5 rounded-2xl
          bg-bg-main/70 backdrop-blur-xl border border-primary/25
          shadow-lg shadow-secondary/10 hover:shadow-xl hover:shadow-primary/15
          hover:border-primary/40 hover:-translate-y-0.5
          transition-all duration-300 ease-out">
    <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-primary/10 text-primary group-hover:bg-primary/15 transition-colors shrink-0">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.5-5.729-1.446L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.625 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966C16.312 1.975 13.893 1.05 11.997 1.05c-5.444 0-9.87 4.374-9.874 9.802-.002 1.968.528 3.888 1.533 5.568L2.63 21.26l4.017-1.106zM17.487 14.39c-.3-.15-1.774-.875-2.029-.968-.256-.093-.442-.14-.628.14-.186.28-.72.968-.883 1.156-.163.187-.326.21-.628.06-2.583-1.293-4.22-2.483-5.251-4.267-.272-.471.2-.437.773-1.439.083-.166.04-.31-.02-.46-.06-.15-.56-1.35-.767-1.85-.203-.49-.41-.42-.56-.427-.145-.007-.31-.008-.476-.008-.166 0-.437.062-.665.31-.228.25-.87.85-.87 2.07 0 1.22.885 2.4 1.009 2.56.124.16 1.74 2.657 4.214 3.725.588.254 1.047.406 1.406.52.593.189 1.13.162 1.556.098.475-.07 1.474-.603 1.68-.186.204-.417.204-.774.102-.924-.102-.15-.406-.3-.707-.15z"/>
        </svg>
    </span>
    <span class="hidden sm:inline text-sm font-bold text-primary">{{ __('Contact Us') }}</span>
</a>
