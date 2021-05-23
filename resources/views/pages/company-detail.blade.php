@extends('layouts.website')


@section('content')
<x-base>
  <x-header-wrapper>
    <div class="row">
      <div class="col-lg-8">
        <x-header-info>
          @slot('image_col')
          3
          @endslot
          @slot('data_col')
          9
          @endslot
          @slot('image_area')
          <div class="bg-white  rounded" style="height: auto;width:120px">
            <img class="img-fluid " src="{{ asset('images/websites/logo-company.png') }}" alt="">
          </div>
          @endslot
          @slot('data_area')
          <div>
            <div class="text-light text-center text-sm-left">Show</div>
            <div class="text-white text-center text-sm-left">
              <h3>Good Electronics</h3>
            </div>
            <div class="d-flex mb-3 justify-content-center justify-content-sm-start">
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-grey></x-rating-grey>
            </div>
            <div class="d-flex">
              <div class="text-success">Solutions : 21</div>
              <div class="text-danger ml-3">Complaints : 201</div>
            </div>
          </div>
          @endslot

        </x-header-info>

      </div>
      <div class="col-lg-4 ">
        <div>
          <x-progress>
            @slot('value')
            80
            @endslot
            5 stars
          </x-progress>
          <x-progress>
            @slot('value')
            10
            @endslot
            4 stars
          </x-progress>
          <x-progress>
            @slot('value')
            5
            @endslot
            3 stars
          </x-progress>
          <x-progress>
            @slot('value')
            3
            @endslot
            2 stars
          </x-progress>
          <x-progress>
            @slot('value')
            2
            @endslot
            1 stars
          </x-progress>
        </div>
      </div>
    </div>
    <div class="w-100 text-right mt-3">
      <a class="btn btn-success" href="/write-review">Review this Company</a>
    </div>
  </x-header-wrapper>
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="border-bottom border-dark w-100 pb-1 d-flex  align-items-center">
            <a class="text-dark mr-3 border rounded border-secondary py-1 px-2" href="">
              <h3 class="mb-0">
                Latest
              </h3>
            </a>
            <a class="text-dark" href="">
              <h3 class="mb-0">
                Oldest
              </h3>
            </a>
          </div>
          <div class="d-flex pt-3 mb-3 align-items-center">
            <a class="text-dark border rounded border-secondary py-1 px-2  mr-3" href="">
              <h5 class="mb-0">
                All
              </h5>
            </a>
            <a class="text-dark mr-3" href="">
              <h5 class="mb-0">

                5 Stars (75)
              </h5>
            </a>
            <a class="text-dark mr-3" href="">
              <h5 class="mb-0">
                4 Stars (75)
              </h5>
            </a>
            <a class="text-dark mr-3" href="">
              <h5 class="mb-0">
                3 Stars (75)
              </h5>
            </a>
            <a class="text-dark mr-3" href="">
              <h5 class="mb-0">
                2 Stars (75)
              </h5>
            </a>
            <a class="text-dark mr-3" href="">
              <h5 class="mb-0">
                1 Stars (75)
              </h5>
            </a>
          </div>
          <x-company-detail.card-review>

            <x-company-detail.user-review>

              @slot('user_avatar')
              avatar1.jpg
              @endslot
              @slot('user_name')
              John Doe
              @endslot
              @slot('rating')
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-grey></x-rating-grey>
              @endslot
              @slot('posted_date')
              Published 54 minutes ago
              @endslot
              @slot('review_title')
              "Awesome Company"
              @endslot
              @slot('review_content')
              Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.
              @endslot
              @slot('user_action')
              <review-action />
              @endslot
            </x-company-detail.user-review>
            <x-company-detail.company-reply>

              @slot('company_avatar')
              avatar.jpg
              @endslot
              @slot('company_name')
              Good Company
              @endslot

              @slot('posted_date')
              Published 54 minutes ago
              @endslot

              @slot('reply_content')
              Hi Monika,

              Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.

              Thanks
              @endslot
            </x-company-detail.company-reply>
          </x-company-detail.card-review>
          <x-company-detail.card-review>

            <x-company-detail.user-review>

              @slot('user_avatar')
              avatar2.jpg
              @endslot
              @slot('user_name')
              Brad Lee
              @endslot
              @slot('rating')
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-green></x-rating-green>
              <x-rating-grey></x-rating-grey>
              @endslot
              @slot('posted_date')
              Published a day ago
              @endslot
              @slot('review_title')
              "Great Company"
              @endslot
              @slot('review_content')
              Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.
              @endslot
              @slot('user_action')
              <review-action />
              @endslot
            </x-company-detail.user-review>

          </x-company-detail.card-review>

          <nav aria-label="">
            <ul class="pagination text-center justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>

        </div>
      </div>

    </div>
  </section>
</x-base>
@endsection
