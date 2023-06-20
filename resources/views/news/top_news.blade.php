@extends('layout.layout')

@section('title','news')

@section('content')
    <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32 text-center">
      <form action="{{ route('AllNews') }}" method="GET">
        <div class="flex justify-between align-items-center">
            <div class="flex w-3/4 justify-center align-items-center rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
              <input type="text" name="search" id="buscador" autocomplete=""
              value="{{ $search }}"
              class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
              <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <img class="img-small" src="{{asset('img/search.icon.png')}}" alt="">
              </button>
            </div>
            <a href="/" class="text-indigo-800 hover:text-indigo-600">Regresar</a>
        </div>

      <h2 class="mb-12 pb-4 text-center text-3xl font-bold">
        Mas visitados
      </h2>

        <div class="grid gap-6 lg:grid-cols-3 xl:gap-x-12">
          @if($arrayNews)
            @foreach ($arrayNews->items() as $new)
              <div class="mb-6 mt-5 lg:mb-0">
                <div
                  class="size-card relative block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                  <div class="flex">
                    <div
                      class="relative mx-4 -mt-4 overflow-hidden rounded-lg bg-cover bg-no-repeat shadow-lg dark:shadow-black/20"
                      data-te-ripple-init data-te-ripple-color="light">
                      <img src="{{ ($new->getAttributes()['url_to_image']) ? $new->getAttributes()['url_to_image'] : URL::to('/img/no-image.png') }}" class="img-cover" />
                      <a href="#!">
                        <div
                          class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,98.4%,.15)]">
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="p-6 content-card">
                    <h5 class="mb-3 text-lg font-bold">{{ $new->getAttributes()['title'] }}</h5>
                    <p class="mb-4 text-neutral-500 dark:text-neutral-300">
                      <small>Published <u> {{ $new->getAttributes()['published_at'] }}</u> by
                        <a >{{ $new->getAttributes()['author'] }}</a></small>
                    </p>
                    <a href="{{ $new->getAttributes()['url'] }}" target="_blank" rel="noopener" data-te-ripple-color="light"
                      class="inline-block rounded-full bg-indigo-800 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">Read
                      more</a>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          </div>
          <div class="row mt-6">
            <div class="col-md-12">
                {{ $arrayNews->links('pagination::tailwind') }}
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- Section: Design Block -->
  </div>
  <!-- Container for demo purpose -->
@endsection
